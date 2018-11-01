/**
 * Represents one single 1x1 block.
 * Beware, that the map can not be changed anymore later on. Once a block belongs to a map, it does belong to that map.
 * The block's position within the map on the other hand can always be changed afterwards.
 *
 * @param {Map} map
 *  The map the block belongs to.
 * @param {Number} [x]
 *  The x-coordinate of the block within the map.
 * @param {Number} [y]
 *  The y-coordinate of the block within the map.
 */
function Block(map, x, y) {
  // mixin events
  MicroEvent.mixin(this);

  // define a public getter
  Object.defineProperty(this, "map", {
    /**
     * Returns the map the block belongs to.
     *
     * @return {Map}
     *  The map the block belongs to.
     */
    get: function() {
      // return the private property as-is
      return map;
    }
  });

  // private property
  var _x = x;

  // define a public getter and setter
  Object.defineProperty(this, "x", {
    /**
     * Returns the block's current x-coordinate.
     *
     * @return {Number}
     *  The block's current x-coordinate.
     */
    get: function() {
      // return the private property as-is
      return _x;
    },
    /**
     * Sets the block's current x-coordinate.
     *
     * @param {Number} x
     *  The block's x-coordinate to set.
     * @return {Undefined}
     *  Setters can not return anything.
     */
    set: function(x) {
      // clear the block
      this.clear();
      // remember the new x-coordinate
      _x = x;
      // paint the block
      this.paint();

      // trigger an event
      this.trigger("change:x");
    }
  });

  // private property
  var _y = y;

  // define a public getter and setter
  Object.defineProperty(this, "y", {
    /**
     * Returns the block's current x-coordinate.
     *
     * @return {Number}
     *  The block's current x-coordinate.
     */
    get: function() {
      // return the private property as-is
      return _y;
    },
    /**
     * Sets the block's current y-coordinate.
     *
     * @param {Number} y
     *  The block's y-coordinate to set.
     * @return {Undefined}
     *  Setters can not return anything.
     */
    set: function(y) {
      // clear the block from its current position
      this.clear();
      // remember the y-coordinate
      _y = y;
      // paint the block to its new position
      this.paint();

      // trigger an event
      this.trigger("change:y");
    }
  });

  // paint the block
  this.paint();
}

/**
 * Paints the block.
 * The block will be painted, if both x-coordinate and y-coordinate are set.
 *
 * @return {Boolean}
 *  True, if the block was painted, false otherwise.
 */
Block.prototype.paint = function() {
  // check if the block's x- and y-coordinate are set
  if (!isNaN(this.x) && !isNaN(this.y)) {
    // paint the block
    this.map.paint(this, this.x, this.y);

    // trigger an event
    this.trigger("paint");

    // the block was painted
    return true;
  } else {
    // the block was not painted
    return false;
  }
}

/**
 * Clears the block.
 * The block will be cleared, if both x-coordinate and y-coordinate are set.
 *
 * @return {Boolean}
 *  True, if the block was cleared, false otherwise.
 */
Block.prototype.clear = function() {
  // check if the block's x- and y-coordinate are set
  if (!isNaN(this.x) && !isNaN(this.y)) {
    // clear the block
    this.map.clear(this.x, this.y);

    // trigger an event
    this.trigger("clear");

    // the block was cleared
    return true;
  } else {
    // the block was not cleared
    return false;
  }
}

/**
 * Checks if the block can be moved into the given direction by the given distane.
 *
 * @param {String} [direction = "down"]
 *  The direction can be one of the following directions: "left", "right", "up", "down", "leftup", "rightup", "leftdown"
 *  or "rightdown".
 * @param {Number} [distance = 1]
 *  The distance in blocks from the current x- and y-coordinate.
 * @return {Boolean}
 *  True, if the block can be moved into the given direction, false otherwise.
 */
Block.prototype.canMove = function(direction, distance) {
  // check if direction is set, if not default to "down"
  direction = direction === undefined ? "down" : direction;
  // check if distance is set, if not default to 1
  distance = distance === undefined ? 1 : distance;

  // switch the direction
  switch (direction) {
    case "left":
      // check if block can move to the left
      return this.canBeAt(this.map, this.x - distance, this.y);
    case "right":
      // check if block can move to the right
      return this.canBeAt(this.map, this.x + distance, this.y);
    case "down":
      // check if block can move down
      return this.canBeAt(this.map, this.x, this.y - distance);
    case "up":
    case "leftup":
    case "rightup":
    case "leftdown":
    case "rightdown":
    default:
      // throw an error
      throw "Direction " + direction + " is currently not yet supported.";
  }
}

// FIXME check why a map is accepted, a block normally only lives in the context of its own map
/**
 * Checks if the block can be at the position given by x- and y-coordinate within the given map.
 *
 * @param {Map} map
 *  The map for which to check if the block can be at the given position.
 * @param {Number} x
 *  The x-coordinate of the field to check.
 * @param {Number} y
 *  The y-coordinate of the field to check.
 * @return {Boolean}
 *  True, if the block can be at the position given by x- and y-coordinate, false otherwise.
 */
Block.prototype.canBeAt = function(map, x, y) {
  // get the map's field for the given x- and y-coordinate
  var field = map.getFieldAt(x, y);

  // check if the field is not yet taken by another block or the other block is just ourself
  return field && (!field.block || field.block == this);
}
