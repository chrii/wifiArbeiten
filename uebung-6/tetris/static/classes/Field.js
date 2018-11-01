/**
 * Represents a field within a game's map.
 */
function Field() {
  // mixin events
  MicroEvent.mixin(this);

  // private property
  var _block = null;

  // define a public getter and setter
  Object.defineProperty(this, "block", {
    /**
     * Returns the block occoupying the field.
     *
     * @return {Block}
     *  The block occoupying the field.
     */
    get: function() {
      // return the private property as-is
      return _block;
    },
    /**
     * Sets the block occoupying the field.
     *
     * @param {Block} block
     *  The block occoupying the field.
     * @return {Undefined}
     *  Setters can not return anything.
     */
    set: function(block) {
      // remember the block
      _block = block;

      // trigger an event
      this.trigger("change:block");
      this.trigger("change:class");
    }
  });

  // FIXME hardcoded HTML/CSS dependency
  // define a public getter
  Object.defineProperty(this, "class", {
    /**
     * Returns the CSS classes to apply to the HTML-element representing this field.
     *
     * @return {String}
     *  The CSS classes to apply to the HTML-element representing this field.
     */
    get: function() {
      // FIXME hardcoded Bootstrap dependency
      // return the CSS classes
      return "col-sm " + (_block ? "block" : "empty");
    }
  });
}
