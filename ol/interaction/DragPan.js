var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
/**
 * @module ol/interaction/DragPan
 */
import { scale as scaleCoordinate, rotate as rotateCoordinate } from '../coordinate.js';
import { easeOut } from '../easing.js';
import { noModifierKeys, primaryAction, focus } from '../events/condition.js';
import { FALSE } from '../functions.js';
import PointerInteraction, { centroid as centroidFromPointers } from './Pointer.js';
/**
 * @typedef {Object} Options
 * @property {import("../events/condition.js").Condition} [condition] A function that takes an {@link module:ol/MapBrowserEvent~MapBrowserEvent} and returns a boolean
 * to indicate whether that event should be handled.
 * Default is {@link module:ol/events/condition~noModifierKeys} and {@link module:ol/events/condition~primaryAction}.
 * In addition, if there is a `tabindex` attribute on the map element,
 * {@link module:ol/events/condition~focus} will also be applied.
 * @property {import("../Kinetic.js").default} [kinetic] Kinetic inertia to apply to the pan.
 */
/**
 * @classdesc
 * Allows the user to pan the map by dragging the map.
 * @api
 */
var DragPan = /** @class */ (function (_super) {
    __extends(DragPan, _super);
    /**
     * @param {Options=} opt_options Options.
     */
    function DragPan(opt_options) {
        var _this = _super.call(this, {
            stopDown: FALSE
        }) || this;
        var options = opt_options ? opt_options : {};
        /**
         * @private
         * @type {import("../Kinetic.js").default|undefined}
         */
        _this.kinetic_ = options.kinetic;
        /**
         * @type {import("../pixel.js").Pixel}
         */
        _this.lastCentroid = null;
        /**
         * @type {number}
         */
        _this.lastPointersCount_;
        /**
         * @type {boolean}
         */
        _this.panning_ = false;
        /**
         * @private
         * @type {import("../events/condition.js").Condition}
         */
        _this.condition_ = options.condition ? options.condition : defaultCondition;
        /**
         * @private
         * @type {boolean}
         */
        _this.noKinetic_ = false;
        return _this;
    }
    /**
     * @private
     * @param {import("../MapBrowserEvent").default} mapBrowserEvent Event.
     * @return {boolean} Condition passes.
     */
    DragPan.prototype.conditionInternal_ = function (mapBrowserEvent) {
        var pass = true;
        if (mapBrowserEvent.map.getTargetElement().hasAttribute('tabindex')) {
            pass = focus(mapBrowserEvent);
        }
        return pass && this.condition_(mapBrowserEvent);
    };
    /**
     * @inheritDoc
     */
    DragPan.prototype.handleDragEvent = function (mapBrowserEvent) {
        if (!this.panning_) {
            this.panning_ = true;
            this.getMap().getView().beginInteraction();
        }
        var targetPointers = this.targetPointers;
        var centroid = centroidFromPointers(targetPointers);
        if (targetPointers.length == this.lastPointersCount_) {
            if (this.kinetic_) {
                this.kinetic_.update(centroid[0], centroid[1]);
            }
            if (this.lastCentroid) {
                var delta = [
                    this.lastCentroid[0] - centroid[0],
                    centroid[1] - this.lastCentroid[1]
                ];
                var map = mapBrowserEvent.map;
                var view = map.getView();
                scaleCoordinate(delta, view.getResolution());
                rotateCoordinate(delta, view.getRotation());
                view.adjustCenterInternal(delta);
            }
        }
        else if (this.kinetic_) {
            // reset so we don't overestimate the kinetic energy after
            // after one finger down, tiny drag, second finger down
            this.kinetic_.begin();
        }
        this.lastCentroid = centroid;
        this.lastPointersCount_ = targetPointers.length;
        mapBrowserEvent.originalEvent.preventDefault();
    };
    /**
     * @inheritDoc
     */
    DragPan.prototype.handleUpEvent = function (mapBrowserEvent) {
        var map = mapBrowserEvent.map;
        var view = map.getView();
        if (this.targetPointers.length === 0) {
            if (!this.noKinetic_ && this.kinetic_ && this.kinetic_.end()) {
                var distance = this.kinetic_.getDistance();
                var angle = this.kinetic_.getAngle();
                var center = view.getCenterInternal();
                var centerpx = map.getPixelFromCoordinateInternal(center);
                var dest = map.getCoordinateFromPixelInternal([
                    centerpx[0] - distance * Math.cos(angle),
                    centerpx[1] - distance * Math.sin(angle)
                ]);
                view.animateInternal({
                    center: view.getConstrainedCenter(dest),
                    duration: 500,
                    easing: easeOut
                });
            }
            if (this.panning_) {
                this.panning_ = false;
                view.endInteraction();
            }
            return false;
        }
        else {
            if (this.kinetic_) {
                // reset so we don't overestimate the kinetic energy after
                // after one finger up, tiny drag, second finger up
                this.kinetic_.begin();
            }
            this.lastCentroid = null;
            return true;
        }
    };
    /**
     * @inheritDoc
     */
    DragPan.prototype.handleDownEvent = function (mapBrowserEvent) {
        if (this.targetPointers.length > 0 && this.conditionInternal_(mapBrowserEvent)) {
            var map = mapBrowserEvent.map;
            var view = map.getView();
            this.lastCentroid = null;
            // stop any current animation
            if (view.getAnimating()) {
                view.cancelAnimations();
            }
            if (this.kinetic_) {
                this.kinetic_.begin();
            }
            // No kinetic as soon as more than one pointer on the screen is
            // detected. This is to prevent nasty pans after pinch.
            this.noKinetic_ = this.targetPointers.length > 1;
            return true;
        }
        else {
            return false;
        }
    };
    return DragPan;
}(PointerInteraction));
/**
 * @param {import("../MapBrowserPointerEvent.js").default} mapBrowserEvent Browser event.
 * @return {boolean} Combined condition result.
 */
function defaultCondition(mapBrowserEvent) {
    return noModifierKeys(mapBrowserEvent) && primaryAction(mapBrowserEvent);
}
export default DragPan;
//# sourceMappingURL=DragPan.js.map