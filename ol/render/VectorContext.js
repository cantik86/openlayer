/**
 * @module ol/render/VectorContext
 */
/**
 * @classdesc
 * Context for drawing geometries.  A vector context is available on render
 * events and does not need to be constructed directly.
 * @api
 */
var VectorContext = /** @class */ (function () {
    function VectorContext() {
    }
    /**
     * Render a geometry with a custom renderer.
     *
     * @param {import("../geom/SimpleGeometry.js").default} geometry Geometry.
     * @param {import("../Feature.js").FeatureLike} feature Feature.
     * @param {Function} renderer Renderer.
     */
    VectorContext.prototype.drawCustom = function (geometry, feature, renderer) { };
    /**
     * Render a geometry.
     *
     * @param {import("../geom/Geometry.js").default} geometry The geometry to render.
     */
    VectorContext.prototype.drawGeometry = function (geometry) { };
    /**
     * Set the rendering style.
     *
     * @param {import("../style/Style.js").default} style The rendering style.
     */
    VectorContext.prototype.setStyle = function (style) { };
    /**
     * @param {import("../geom/Circle.js").default} circleGeometry Circle geometry.
     * @param {import("../Feature.js").default} feature Feature.
     */
    VectorContext.prototype.drawCircle = function (circleGeometry, feature) { };
    /**
     * @param {import("../Feature.js").default} feature Feature.
     * @param {import("../style/Style.js").default} style Style.
     */
    VectorContext.prototype.drawFeature = function (feature, style) { };
    /**
     * @param {import("../geom/GeometryCollection.js").default} geometryCollectionGeometry Geometry collection.
     * @param {import("../Feature.js").default} feature Feature.
     */
    VectorContext.prototype.drawGeometryCollection = function (geometryCollectionGeometry, feature) { };
    /**
     * @param {import("../geom/LineString.js").default|import("./Feature.js").default} lineStringGeometry Line string geometry.
     * @param {import("../Feature.js").FeatureLike} feature Feature.
     */
    VectorContext.prototype.drawLineString = function (lineStringGeometry, feature) { };
    /**
     * @param {import("../geom/MultiLineString.js").default|import("./Feature.js").default} multiLineStringGeometry MultiLineString geometry.
     * @param {import("../Feature.js").FeatureLike} feature Feature.
     */
    VectorContext.prototype.drawMultiLineString = function (multiLineStringGeometry, feature) { };
    /**
     * @param {import("../geom/MultiPoint.js").default|import("./Feature.js").default} multiPointGeometry MultiPoint geometry.
     * @param {import("../Feature.js").FeatureLike} feature Feature.
     */
    VectorContext.prototype.drawMultiPoint = function (multiPointGeometry, feature) { };
    /**
     * @param {import("../geom/MultiPolygon.js").default} multiPolygonGeometry MultiPolygon geometry.
     * @param {import("../Feature.js").FeatureLike} feature Feature.
     */
    VectorContext.prototype.drawMultiPolygon = function (multiPolygonGeometry, feature) { };
    /**
     * @param {import("../geom/Point.js").default|import("./Feature.js").default} pointGeometry Point geometry.
     * @param {import("../Feature.js").FeatureLike} feature Feature.
     */
    VectorContext.prototype.drawPoint = function (pointGeometry, feature) { };
    /**
     * @param {import("../geom/Polygon.js").default|import("./Feature.js").default} polygonGeometry Polygon geometry.
     * @param {import("../Feature.js").FeatureLike} feature Feature.
     */
    VectorContext.prototype.drawPolygon = function (polygonGeometry, feature) { };
    /**
     * @param {import("../geom/Geometry.js").default|import("./Feature.js").default} geometry Geometry.
     * @param {import("../Feature.js").FeatureLike} feature Feature.
     */
    VectorContext.prototype.drawText = function (geometry, feature) { };
    /**
     * @param {import("../style/Fill.js").default} fillStyle Fill style.
     * @param {import("../style/Stroke.js").default} strokeStyle Stroke style.
     */
    VectorContext.prototype.setFillStrokeStyle = function (fillStyle, strokeStyle) { };
    /**
     * @param {import("../style/Image.js").default} imageStyle Image style.
     * @param {import("./canvas.js").DeclutterGroup=} opt_declutterGroup Declutter.
     */
    VectorContext.prototype.setImageStyle = function (imageStyle, opt_declutterGroup) { };
    /**
     * @param {import("../style/Text.js").default} textStyle Text style.
     * @param {import("./canvas.js").DeclutterGroups=} opt_declutterGroups Declutter.
     */
    VectorContext.prototype.setTextStyle = function (textStyle, opt_declutterGroups) { };
    return VectorContext;
}());
export default VectorContext;
//# sourceMappingURL=VectorContext.js.map