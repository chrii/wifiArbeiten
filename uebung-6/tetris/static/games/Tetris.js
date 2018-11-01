/**
 * Represents the logic of a Tetris game.
 *
 * @param {Map} [map = new Map(10, 18)]
 *  The map to use.
 */
function Tetris(map) {
  // check if map is set, if not default to a standard-sized Tetris map
  map = map === undefined ? new Map(10, 18) : map;

  // mixin events
  MicroEvent.mixin(this);

  // define a public getter
  Object.defineProperty(this, "map", {
    /**
     * Returns the Tetris map.
     *
     * @return {Map}
     *  The tetris map.
     */
    get: function() {
      // return the private property as-is
      return map;
    }
  });

  // private property
  var _points = 0;
  // define a public getter
  Object.defineProperty(this, "points", {
    /**
     * Returns the points.
     *
     * @return {Map}
     *  The points.
     */
    get: function() {
      // return the private property as-is
      return _points;
    }
  });

  // private property
  var _lines = 0;
  // define a public getter
  Object.defineProperty(this, "lines", {
    /**
     * Returns the lines.
     *
     * @return {Map}
     *  The lines.
     */
    get: function() {
      // return the private property as-is
      return _lines;
    }
  });

  // private property
  var _level = Tetris.LEVELS[0];
  // define a public getter
  Object.defineProperty(this, "level", {
    /**
     * Returns the level.
     *
     * @return {Map}
     *  The level.
     */
    get: function() {
      // return the private property as-is
      return _level;
    }
  });

  // the block currently falling down
  var _block;
  // define a public getter
  Object.defineProperty(this, "block", {
    /**
     * Returns the block currently falling down.
     *
     * @return {BlockGroup}
     *  The block currently falling down.
     */
    get: function() {
      // return the private property as-is
      return _block;
    }
  });

  // closure caching
  var game = this;
  /**
   * Clears full rows and awards points.
   *
   * @return {Boolean}
   *  True, if any row were cleared or points were awarded, false otherwise.
   */
  function clearRows() {
    // number of rows cleared
    var lines = 0;
    // number of points to award
    var points = 0;

    // loop all rows
    for (var i = game.map.rows.length - 1; i >= 0; i--) {
      // check if the current row is full
      if (game.map.rows[i].every(function(field) {
        // check if the current field is occupied by a block
        return field.block != null;
      })) {
        // loop all fields
        game.map.rows[i].forEach(function(field) {
          // clear the current field
          field.block = null;
        });

        // trigger an event
        game.trigger("clear", game.map.rows[i]);

        // one more row was cleared
        lines++;
        // award the points
        points += lines * game.map.width;

        // loop all rows above the cleared row
        for (var j = i; j > 0; j--) {
          // loop all columns
          for (var k = 0; k < game.map.rows[j].length; k++) {
            // let the current column's block fall down into the cleared row
            game.map.rows[j][k].block = game.map.rows[j - 1][k].block;
          }

          // trigger an event
          game.trigger("clearfalldown", game.map.rows[j - 1], game.map.rows[j]);
        }

        // re-check the current row, a full row might have fallen down
        i++;
      }
    }

    // check if rows were cleared
    if (lines > 0) {
      // add all rows at once
      _lines += lines;
      // trigger an event
      game.trigger("change:lines");

      // get the level to play at the current number of rows
      _level = Tetris.LEVELS.filter(function(level) {
        // check if the current level has been reached
        return _lines >= level.lines;
      }).reverse().slice(0, 1)[0];
      // trigger an event
      game.trigger("change:level");
    }

    // check if points were awarded
    if (points > 0) {
      // add all points at once
      _points += points;
      // trigger an event
      game.trigger("change:points");
    }

    // return if rows were cleared or points were awarded
    return lines > 0 || points > 0;
  };

  /**
   * Starts the game.
   *
   * @return {Tetris}
   *  The game for chained method calling.
   */
  this.start = function() {
    // closure caching
    var game = this;

    // trigger an event
    this.trigger("start");

    // span a block
    (function spwan() {
      // get a random Tetris block
      _block = BlockGroup.parse(game.map, Tetris.BLOCKS[Math.floor(Math.random() * Tetris.BLOCKS.length)]);

      // calculate the x-coordinate the block shall spawn
      var x = Math.floor(game.map.width / 2 - _block.blocks.width / 2 + 1);
      // calculate the y-coordinate the block shall spwan
      var y = game.map.height;

      // check if there is enough space to spwan the block
      if (game.map.canHave(_block, x, y)) {
        // move the block to its starting position
        _block.x = x;
        _block.y = y;

        // let the black fall down
        (function fallDown(speed) {
          // check if speed is set, if not default to 1000ms
          speed = speed ? speed : 1000;

          // let the block fall down
          var interval = setInterval(function() {
            // check if the block can fall down
            if (_block.canMove()) {
              // let the block fall down
              _block.y--;

              // trigger an event
              game.trigger("falldown", _block);
            } else {
              // stop falling down
              clearInterval(interval);

              // trigger an event
              game.trigger("fallendown", _block);

              // spawn a new block after clearing rows and waiting a little bit
              setTimeout(spwan, clearRows() ? Tetris.LINE_CLEAR_ARE : Tetris.ARE);
            }
          }, speed);
        })(game.level.speed);

        // trigger an event
        game.trigger("spawn", _block, x, y);
      } else {
        game.trigger("gameover");
      }
    })();

    // return the game for chained method calling
    return this;
  }

  /**
   * Rotates the currently moving block.
   *
   * @return {Tetris}
   *  The game for chained method calling.
   */
  this.rotate = function() {
    // rotate the block
    var rotatedBlock = _block.rotate();

    // calculate the x-difference so that the block appears to be roated in-place (i.e. centric)
    var diffX = (_block.blocks.width - rotatedBlock.blocks.width) / 2;
    diffX = diffX < 0 ? Math.floor(diffX) : Math.ceil(diffX);

    // calculate the y-difference so that the block appears to be roated in-place (i.e. centric)
    var diffY = (_block.blocks.height - rotatedBlock.blocks.height) / 2;
    diffY = diffY < 0 ? Math.floor(diffY) : Math.ceil(diffY);

    // calculate the rotated block's x-coordinate
    var x = _block.x + diffX;
    // calculate the roated block's y-coordinate
    var y = _block.y - diffY;

    // clear the block
    _block.clear();

    // check if there is enough space for the rotated block
    if (this.map.canHave(rotatedBlock, x, y)) {
      // position the rotated block
      rotatedBlock.x = x;
      rotatedBlock.y = y;

      // replace the currently moving block with the rotated block
      _block = rotatedBlock;

      // paint the rotated block
      _block.paint();

      // trigger an event
      this.trigger("rotate");
    } else {
      // re-paint the not-rotated block as-was
      _block.paint();
    }

    // return the game for chained method calling
    return this;
  }
}

/**
 * Moves the currently moving block to the left.
 *
 * @return {Tetris}
 *  The game for chained method calling.
 */
Tetris.prototype.moveLeft = function() {
  // check if the block can be moved to the left
  if (this.block.canMove("left")) {
    // move the block to the left
    this.block.x--;

    // trigger an event
    this.trigger("left");
  }

  // return the game for chained method calling
  return this;
}

/**
 * Moves the currently moving block to the right.
 *
 * @return {Tetris}
 *  The game for chained method calling.
 */
Tetris.prototype.moveRight = function() {
  // check if the block can be moved to the right
  if (this.block.canMove("right")) {
    // move the block to the right
    this.block.x++;

    // trigger an event
    this.trigger("right");
  }

  // return the game for chained method calling
  return this;
}

/**
 * Moves the currently moving block down.
 *
 * @return {Tetris}
 *  The game for chained method calling.
 */
Tetris.prototype.moveDown = function() {
  // check if the block can be moved down
  if (this.block.canMove("down")) {
    // move the block down
    this.block.y--;

    // trigger an event
    this.trigger("down");
  }

  // return the game for chained method calling
  return this;
}

/**
 * Defines the Tetris blocks.
 *
 * @var {Array<String[]>}
 */
Tetris.BLOCKS = [[
    "XXXX"
  ], [
    "XXX",
    "..X"
  ], [
    "XXX",
    "X.."
  ], [
    "XX",
    "XX"
  ], [
    ".XX",
    "XX."
  ], [
    "XXX",
    ".X."
  ], [
    "XX.",
    ".XX"
  ]
];

/**
 * Frames per seconds of Tetris implementation on the GameBoy.
 * This is only needed for calculating the below values from FPS to ms.
 *
 * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
 * @var {Number}
 */
Tetris.FPS = 59.73;

/**
 * The levels.
 *
 * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
 * @var {Object[]}
 */
Tetris.LEVELS = [
  {name: "0",  speed: 1000 / Tetris.FPS * 53, lines: 0},
  {name: "1",  speed: 1000 / Tetris.FPS * 49, lines: 10},
  {name: "2",  speed: 1000 / Tetris.FPS * 45, lines: 20},
  {name: "3",  speed: 1000 / Tetris.FPS * 41, lines: 30},
  {name: "4",  speed: 1000 / Tetris.FPS * 37, lines: 40},
  {name: "5",  speed: 1000 / Tetris.FPS * 33, lines: 50},
  {name: "6",  speed: 1000 / Tetris.FPS * 28, lines: 60},
  {name: "7",  speed: 1000 / Tetris.FPS * 22, lines: 70},
  {name: "8",  speed: 1000 / Tetris.FPS * 17, lines: 80},
  {name: "9",  speed: 1000 / Tetris.FPS * 11, lines: 90},
  {name: "10", speed: 1000 / Tetris.FPS * 10, lines: 100},
  {name: "11", speed: 1000 / Tetris.FPS * 9,  lines: 110},
  {name: "12", speed: 1000 / Tetris.FPS * 8,  lines: 120},
  {name: "13", speed: 1000 / Tetris.FPS * 7,  lines: 130},
  {name: "14", speed: 1000 / Tetris.FPS * 6,  lines: 140},
  {name: "15", speed: 1000 / Tetris.FPS * 6,  lines: 150},
  {name: "16", speed: 1000 / Tetris.FPS * 5,  lines: 160},
  {name: "17", speed: 1000 / Tetris.FPS * 5,  lines: 170},
  {name: "18", speed: 1000 / Tetris.FPS * 4,  lines: 180},
  {name: "19", speed: 1000 / Tetris.FPS * 4,  lines: 190},
  {name: "20", speed: 1000 / Tetris.FPS * 3,  lines: 200}
];

/**
 * The time to wait before spwaning a new block.
 *
 * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
 * @var {Number}
 */
Tetris.ARE = 1000 / Tetris.FPS * 2;

/**
 * The time to wait before spwaning a new block after having cleared rows / awarded points.
 *
 * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
 * @var {Number}
 */
Tetris.LINE_CLEAR_ARE = 1000 / Tetris.FPS * 93;

/**
 * The time to wait before moving to the left or to the right again after the first request.
 *
 * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
 * @var {Number}
 */
Tetris.INITIAL_DAS = 1000 / Tetris.FPS * 23;

/**
 * The time to wait before moving to the left or to the right again after the second and for all requests thereafter.
 *
 * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
 * @var {Number}
 */
Tetris.DAS = 1000 / Tetris.FPS * 9;
