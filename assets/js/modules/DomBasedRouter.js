/**
 * ES6 module implementation of Paul Irish's DOM based routing
 * @link https://gist.github.com/nathanaelnsmith/efc1ce2dd0b78db11632d47727361319
 *
 */

export default (routes) => {
  return {
    fire (func,funcname, args){
      funcname = (funcname === undefined) ? 'init' : funcname;
      if (func !== '' && routes[func] && typeof routes[func][funcname] == 'function'){
        routes[func][funcname](args);
      }
    },
    load() {
      // Path URLs
      let Router = this;

      // hit up common first.
      Router.fire('common');
      Router.fire('common','finalize');
    }
  };
};
