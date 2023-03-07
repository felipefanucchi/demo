import domReady from '@roots/sage/client/dom-ready';

/**
 * Editor entrypoint
 */
domReady(() => {

});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
import.meta.webpackHot?.accept(console.error);
