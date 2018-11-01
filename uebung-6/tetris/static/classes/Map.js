/**
 * Represents an area within which blocks can be positioned.
 * A single map isn't necessarily the game's area, the game's area might consist of various maps or a map might only
 * be used to group blocks for whatever reason.
 *
 * @param {Number} width
 *  The map's width in blocks.
 * @param {Number} height
 *  The map's height in blocks.
 */
function Map(width, height) {
  // mixin events
  MicroEvent.mixin(this);

  // define a public getter
  Object.defineProperty(this, "width", {
    /**
     * Returns the map's width.
     *
     * @return {Number}
     *  The map's width.
     */
    get: function() {
      // return the private property as-is
      return width;
    }
  });

  // define a public getter
  Object.defineProperty(this, "height", {
    /**
     * Returns the map's height.
     *
     * @return {Number}
     *  The map's height.
     */
    get: function() {
      // return the private property as-is
      return height;
    }
  });

  // the rows
  var rows = [];
  // loop as many rows as have to be created (height)
  for (var y = 0; y < height; y++) {
    // the current row
    var row = [];
    // loop as many fields as have to be created (width)
    for (var x = 0; x < width; x++) {
      // create a new field and add it to the current row
      row.push(new Field());
    }

    // add the current row to the rows
    rows.push(row);
  }

  // define a public getter
  Object.defineProperty(this, "rows", {
    /**
     * Returns the map's rows.
     *
     * @return {Array<Field>[]}
     *  The map's rows.
     */
    get: function() {
      // return the private property as-is
      return rows;
    }
  });

  /**
   * Returns the field at the given x- and y-coordinate.
   *
   * @param {Number} x
   *  The x-coordinate.
   * @param {Number} y
   *  The y-coordinate.
   * @return {Field|Null|Undefined}
   *  The field at the given x- and y-coordinate.
   */
  this.getFieldAt = function(x, y) {
    // return the field at the given x- and y-coordinate
    return rows[rows.length - y] ? rows[rows.length - y][x - 1] : null;
  }
}

/**
 * Checks and returns, if the given block can be (could be moved to) at the given x- and y-coordinate.
 *
 * @param {Number} x
 *  The x-coordinate.
 * @param {Number} y
 *  The y-coordinate.
 * @return {Boolean}
 *  True, if the given block can be at the given position, false otherwise.
 */
Map.prototype.canHave = function(block, x, y) {
  // delegate to the block, the block knows better how it is going to paint itself
  return block.canBeAt(this, x, y);
}

/**
 * Paints the block at the given x- and y-coordinate.
 * Painting doesn't actually do anything more than letting the block logically occoupy a field. Rendering code has to
 * take care of painting, whatever that means.
 *
 * @param {Block} block
 *  The block to paint.
 * @param {Number} x
 *  The x-coordinate.
 * @param {Number} y
 *  The y-coordinate.
 * @return {Map}
 *  The map for chained method calling.
 */
Map.prototype.paint = function(block, x, y) {
  // occoupy the field at the given position with the given block
  this.getFieldAt(x, y).block = block;

  // trigger an event
  this.trigger("paint", block, x, y);

  // return the map for chained method calling
  return this;
}

/**
 * Clears the given x- and y-coordinate.
 * Clearing doesn't actually do anything more than disoccupying the field currently occupied by the block. Rendering
 * code has to take care of clearing, whatever that means.
 *
 * @param {Number} x
 *  The x-coordinate.
 * @param {Number} y
 *  The y-coordinate.
 * @return {Map}
 *  The map for chained method calling.
 */
Map.prototype.clear = function(x, y) {
  // disoccupy the field at the given position
  this.getFieldAt(x, y).block = null;

  // trigger an event
  this.trigger("clear", x, y);

  // return the map for chained method calling
  return this;
}
