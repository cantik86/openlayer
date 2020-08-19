/**
 * @module ol/format/XLink
 */


/**
 * @const
 * @type {string}
 */
const NAMESPACE_URI = 'http://www.w3.org/1999/xlink';


/**
 * @param {Element} node Node.
 * @return {string|undefined} href.
 */
export function readHref(node) {
  return node.getAttributeNS(NAMESPACE_URI, 'href');
}
