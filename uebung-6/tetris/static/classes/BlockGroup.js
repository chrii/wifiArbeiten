/**
 * Represents a block consisting of many single 1x1 blocks.
 * Beware, that the map can not be changed anymore later on. Once a block belongs to a map, it does belong to that map.
 * The block's position within the map on the other hand can always be changed afterwards.
 *
 * @param {Map} map
 *  The map the block belongs to.
 * @param {Number} width
 *  The desired width of the block.
 * @param {Number} height
 *  The desired height of the block.
 */
function BlockGroup(map, width, height) {
  // mixin Block constructor
  Block.call(this, map);

  // private property
  var _blocks = new Map(width, height);
  // define a public getter
  Object.defineProperty(this, "blocks", {
    /**
     * Returns the map of single 1x1 blocks this block consists of.
     *
     * @return {Map}
     *  The map of single 1x1 blocks.
     */
    get: function() {
      // return the private property
      return _blocks;
    }
  });
}

/**
 * Paints the block.
 * The block will be painted, if both x-coordinate and y-coordinate are set.
 *
 * @return {Boolean}
 *  True, if the block was painted, false otherwise.
 */
BlockGroup.prototype.paint = function() {
  // check if the block's x- and y-coordinate are set
  if (!isNaN(this.x) && !isNaN(this.y)) {
    // loop all rows
    for (var y = 1; y <= this.blocks.height; y++) {
      // loop all columns
      for (var x = 1; x <= this.blocks.width; x++) {
        // get the current cells's field
        var field = this.blocks.getFieldAt(x, y);
        // check if the field is occoupied by a block
        if (field.block) {
          // paint the single 1x1 block for the current field
          this.map.paint(field.block, this.x + x - 1, this.y - y + 1);
        }
      }
    }

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
BlockGroup.prototype.clear = function() {
  // check if the block's x- and y-coordinate are set
  if (!isNaN(this.x) && !isNaN(this.y)) {
    // loop all rows
    for (var y = 1; y <= this.blocks.height; y++) {
      // loop all columns
      for (var x = 1; x <= this.blocks.width; x++) {
        // get the current cell's field
        var field = this.blocks.getFieldAt(x, y);
        // check if the field is occoupied by a block
        if (field.block) {
          // clear the single 1x1 block
          this.map.clear(this.x + x - 1, this.y - y + 1);
        }
      }
    }

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
 * @see {Block}::canMove()
 */
BlockGroup.prototype.canMove = Block.prototype.canMove;

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
BlockGroup.prototype.canBeAt = function(map, x, y) {
  // closure caching
  var blockGroup = this;
  // loop all single 1x1 blocks
  return this.getBlocks().every(function(block) {
    // check if the current single 1x1 block can be at the given position within the given map or if the other block occupying the field is one of our own blocks
    return map.canHave(block, x + block.x - 1, y - block.y + 1) || (map.getFieldAt(x + block.x - 1, y - block.y + 1) &&
        blockGroup.getBlocks().indexOf(map.getFieldAt(x + block.x - 1, y - block.y + 1).block) >= 0);
  });
}

/**
 * Creates a block consisting of many single 1x1 blocks from the given definition.
 *
 * @param {Map} map
 *  The map to associate the block with.
 * @param {String[]}
 *  The block's definition, row by row. A "X"-character (uppercase) is interpreted as a single 1x1 block being set,
 *  every other character is interpreted as no single 1x1 block set.
 * @return {BlockGroup}
 *  The block consisting of many single 1x1 blocks as by the given definition.
 */
BlockGroup.parse = function(map, definitions) {
  // create a sufficiently large block
  var blockGroup = new BlockGroup(map, definitions[0].length, definitions.length);
  // loop the definition's rows
  for (var i = 0; i < definitions.length; i++) {
    // loop the row's columns
    for (var j = 0; j < definitions[i].length; j++) {
      // check if the current cell shall have a single 1x1 block being set
      if (definitions[i][j] == "X") {
        // set a single 1x1 block for the current cell's field
        blockGroup.blocks.getFieldAt(j + 1, i + 1).block = new Block(blockGroup.blocks, j + 1, i + 1);
      }
    }
  }

  // return the block
  return blockGroup;
}

/**
 * Returns all single 1x1 blocks contained in this block.
 * There is a specific deterministic order, but you should nevertheless not rely on it.
 *
 * @return {Block[]}
 *  All single 1x1 blocks contained in this block.
 */
BlockGroup.prototype.getBlocks = function() {
  // all single 1x1 blocks
  var blocks = [];
  // loop all rows
  for (var y = 1; y <= this.blocks.height; y++) {
    // loop all columns
    for (var x = 1; x <= this.blocks.width; x++) {
      // get the current cell's field
      var field = this.blocks.getFieldAt(x, y);
      // check if the field is occupied by a block
      if (field.block) {
        // add the block to the blocks
        blocks.push(field.block);
      }
    }
  }

  // return the blocks
  return blocks;
}

/**
 * Returns a rotated version of the block.
 * The rotated version is rotated at 90 degrees clockwise.
 * The rotated block is associated with the same map, but is not yet positioned.
 *
 * @return {BlockGroup}
 *  The rotated version of the block.
 */
BlockGroup.prototype.rotate = function() {
  // create a sufficiently large block
  var blockGroup = new BlockGroup(this.map, this.blocks.height, this.blocks.width);
  // loop all rows
  for (var y = 1; y <= this.blocks.height; y++) {
    // loop all columns
    for (var x = 1; x <= this.blocks.width; x++) {
      // get the current cell's field
      var field = this.blocks.getFieldAt(x, y);
      // check if the field is occupied by a block
      if (field.block) {
        // set the block at the correct position of the rotated block
        blockGroup.blocks.getFieldAt(this.blocks.height - y + 1, x).block =
            new Block(blockGroup.blocks, this.blocks.height - y + 1, x);
      }
    }
  }

  // return the rotated block
  return blockGroup;
}
