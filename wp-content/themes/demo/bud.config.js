import {basename} from 'node:path'

String.prototype.toKebabCase = function () {
  return this.match(
    /[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g,
  ).join('-');
};

/**
 * Build configuration
 *
 * @see {@link https://roots.io/docs/sage/ sage documentation}
 * @see {@link https://bud.js.org/guides/configure/ bud.js configuration guide}
 *
 * @typedef {import('@roots/bud').Bud} Bud
 * @param {Bud} app
 */
export default async (app) => {
  const blocksEntrypoint = 'app/Blocks/*.php';

  /**
   * Get list of entrypoints for blocks
   */
  const blocksAssets = Object.assign(
    ...app.globSync(blocksEntrypoint).map(block => {

      const name = basename(block, '.php')
        .toKebabCase()
        .toLowerCase();

      const files = app.globSync([
        `@scripts/blocks/${name}.js`,
        `@styles/blocks/${name}.{scss,css}`
      ]);

      if (files.length !== 0) {
        return {[name]: files};
      }
    }).filter(block => !!block) //Return only truthy values
  )

  /**
   * Application entrypoints
   * @see {@link https://bud.js.org/docs/bud.entry/}
   */
  app
    .entry({
      app: ['@scripts/app', '@styles/app'],
      editor: ['@scripts/editor', '@styles/editor'],
      swiper: ['@styles/lib/swiper.scss'],
      ...blocksAssets
    })

    /**
     * Directory contents to be included in the compilation
     * @see {@link https://bud.js.org/docs/bud.assets/}
     */
    .assets(['images'])

    /**
     * Matched files trigger a page reload when modified
     * @see {@link https://bud.js.org/docs/bud.watch/}
     */
    .watch(['resources/views', 'app'])

    /**
     * Proxy origin (`WP_HOME`)
     * @see {@link https://bud.js.org/docs/bud.proxy/}
     */
    .proxy('http://demo.lndo.site')

    /**
     * Development origin
     * @see {@link https://bud.js.org/docs/bud.serve/}
     */
    .serve('http://localhost:3000')

    /**
     * URI of the `public` directory
     * @see {@link https://bud.js.org/docs/bud.setPublicPath/}
     */
    .setPublicPath('/app/themes/sage/public/')

    /**
     * Generate WordPress `theme.json`
     *
     * @note This overwrites `theme.json` on every build.
     *
     * @see {@link https://bud.js.org/extensions/sage/theme.json/}
     * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/}
     */
    .wpjson.settings({
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        duotone: [],
      },
      background: false,
      typography: {
        customFontSize: false,
      },
    })
    .useTailwindColors(true) // true limits the theme.json colors option to the extend {} at tailwind config
    .useTailwindFontFamily()
    .useTailwindFontSize()
    .enable()
};
