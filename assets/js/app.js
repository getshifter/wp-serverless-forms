import Router from './modules/DomBasedRouter';
import { commonInit, commonFinalize } from './modules/commonScripts';

/**
 * ES6 module implementation of Paul Irish's DOM based routing
 * @link https://gist.github.com/nathanaelnsmith/efc1ce2dd0b78db11632d47727361319
 *
 * Javascript in `common` will fire on every page. The init() functions of each
 * route, starting with `common`, will fire first. Once the init() functions of
 * all routes have fired, the finalize() functions will fire.
 *
 * To add a page specific js, add the classname for a page, replacing all hyphens
 * with underscores (ex: 'front-page' should be 'front_page').
 *
 * See: assets/js/modules/DomBasedRouter.js
 *
 */
let routes = {
  'common': {
    init() {
      commonInit();
    },
    finalize() {
      commonFinalize();
    }
  }
};

let router = new Router(routes);

router.load();
