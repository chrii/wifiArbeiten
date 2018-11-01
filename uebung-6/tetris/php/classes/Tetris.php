<?php

/**
 * Represents the logic of a Tetris game.
 */
class Tetris {

  /**
   * The levels.
   *
   * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
   * @var array[]
   */
  const LEVELS = [
    ['name' => '0',  'speed' => 1000 / self::FPS * 53, 'lines' => 0],
    ['name' => '1',  'speed' => 1000 / self::FPS * 49, 'lines' => 10],
    ['name' => '2',  'speed' => 1000 / self::FPS * 45, 'lines' => 20],
    ['name' => '3',  'speed' => 1000 / self::FPS * 41, 'lines' => 30],
    ['name' => '4',  'speed' => 1000 / self::FPS * 37, 'lines' => 40],
    ['name' => '5',  'speed' => 1000 / self::FPS * 33, 'lines' => 50],
    ['name' => '6',  'speed' => 1000 / self::FPS * 28, 'lines' => 60],
    ['name' => '7',  'speed' => 1000 / self::FPS * 22, 'lines' => 70],
    ['name' => '8',  'speed' => 1000 / self::FPS * 17, 'lines' => 80],
    ['name' => '9',  'speed' => 1000 / self::FPS * 11, 'lines' => 90],
    ['name' => '10', 'speed' => 1000 / self::FPS * 10, 'lines' => 100],
    ['name' => '11', 'speed' => 1000 / self::FPS * 9,  'lines' => 110],
    ['name' => '12', 'speed' => 1000 / self::FPS * 8,  'lines' => 120],
    ['name' => '13', 'speed' => 1000 / self::FPS * 7,  'lines' => 130],
    ['name' => '14', 'speed' => 1000 / self::FPS * 6,  'lines' => 140],
    ['name' => '15', 'speed' => 1000 / self::FPS * 6,  'lines' => 150],
    ['name' => '16', 'speed' => 1000 / self::FPS * 5,  'lines' => 160],
    ['name' => '17', 'speed' => 1000 / self::FPS * 5,  'lines' => 170],
    ['name' => '18', 'speed' => 1000 / self::FPS * 4,  'lines' => 180],
    ['name' => '19', 'speed' => 1000 / self::FPS * 4,  'lines' => 190],
    ['name' => '20', 'speed' => 1000 / self::FPS * 3,  'lines' => 200]
  ];

  /**
   * Frames per seconds of Tetris implementation on the GameBoy.
   * This is only needed for calculating the below values from FPS to ms.
   *
   * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
   * @var int
   */
  const FPS = 59.73;

  /**
   * The time to wait before spwaning a new block.
   *
   * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
   * @var int
   */
  const ARE = 1000 / self::FPS * 2;

  /**
   * The time to wait before spwaning a new block after having cleared rows / awarded points.
   *
   * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
   * @var int
   */
  const LINE_CLEAR_ARE = 1000 / self::FPS * 93;

  /**
   * The time to wait before moving to the left or to the right again after the first request.
   *
   * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
   * @var int
   */
  const INITIAL_DAS = 1000 / self::FPS * 23;

  /**
   * The time to wait before moving to the left or to the right again after the second and for all requests thereafter.
   *
   * @see http://tetris.wikia.com/wiki/Tetris_(Game_Boy)
   * @var int
   */
  const DAS = 1000 / self::FPS * 9;

  /**
   * Defines the Tetris blocks.
   *
   * @var array<string[]>
   */
  const BLOCKS = [[
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
   * The Tetris map.
   * @var Map
   */
  private $map;

  /**
   * The points.
   * @var int
   */
  private $points = 0;

  /**
   * The lines.
   * @var int
   */
  private $lines = 0;

  /**
   * The level.
   * @var array
   */
  private $level = self::LEVELS[0];

  /**
   * The block currently falling down.
   * @var Block
   */
  private $block;

  /**
   * Creates the logic of a Tetris game.
   *
   * @param Map [$map = new Map(10, 18)]
   *  The map to use.
   */
  public function __construct($map = null) {
    // check if map is not set
    if (!$map) {
      // default to a standard-sized Tetris map
      $map = new Map(10, 18);
    }

    // remember the map
    $this->map = $map;
  }

  /**
   * Returns the Tetris map.
   *
   * @return Map
   *  The Tetris map.
   */
  public function getMap() : Map {
    // return the private property as-is
    return $this->map;
  }

  /**
   * Returns the points.
   *
   * @return int
   *  The points.
   */
  public function getPoints() : int {
    // return the private property as-is
    return $this->points;
  }

  /**
   * Returns the lines.
   *
   * @return int
   *  The lines.
   */
  public function getLines() : int {
    // return the private property as-is
    return $this->lines;
  }

  /**
   * Returns the level.
   *
   * @return array
   *  The level
   */
  public function getLevel() : array {
    // return the private property as-is
    return $this->level;
  }

  /**
   * Returns the block currently falling down.
   *
   * @return Block
   *  The block currently falling down.
   */
  public function getBlock() : Block {
    // return the private property as-is
    return $this->block;
  }

  /**
   * Clears full rows and awards points.
   *
   * @return bool
   *  True, if any row were cleared or points were awarded, false otherwise.
   */
  public function clearRows() : bool {
    // loop all rows
    for ($i = count($this->map->getRows()) - 1; $i >= 0; $i--) {
      // if the current row is full
      $isFull = true;
      // loop all columns
      for ($j = 0; $j < count($this->map->getRows()[$i]); $j++) {
        // check if the current row is still full, after considering the current column
        $isFull = $isFull && $this->map->getRows()[$i][$j]->getBlock();
      }

      // check if the current row is full
      if ($isFull) {
        // loop all columns
        for ($j = 0; $j < count($this->map->getRows()[$i]); $j++) {
          // clear the current field
          $this->map->getRows()[$i][$j]->setBlock(null);
        }

        // one more row was cleared
        $lines++;
        // award the points
        $points += $lines * $this->map->getWidth();

        // loop all rows above the cleared row
        for ($j = $i; $j > 0; $j--) {
          // loop all columns
          for ($k = 0; $k < count($this->map->getRows()[$j]); $k++) {
            // let the current column's block fall down into the cleared row
            $this->map->getRows()[$j][$k]->setBlock($this->map->getRows()[$j - 1][$k]->getBlock());
          }
        }

        // re-check the current row, a full row might have fallen down
        $i++;
      }
    }

    // check if rows were cleared
    if ($lines > 0) {
      // add all rows at once
      $this->lines += $lines;

      // get the level to play at the current number of rows
      $this->level = array_reverse(array_filter(self::LEVELS, function($level) {
        // check if the current level has been reached
        return $this->lines >= $level['lines'];
      }))[0];
    }

    // check if points were awarded
    if ($points > 0) {
      // add all points at once
      $this->points += $points;
    }

    // return if rows were cleared or points were awarded
    return $lines > 0 || $points > 0;
  }

  /**
   * Spawns the given or a random block.
   * The currently falling down block is locked to its current position.
   *
   * @param Block $block
   *  The new block to spawn.
   * @return bool
   *  True, if it was possible to spawn the new block, false otherwise.
   */
  public function spawn(Block $block = null) : bool {
    // check if the block to spawn is given
    if ($block) {
      // the given block is the new block falling down
      $this->block = $block;
    } else {
      // a random block is the new block falling down
      $this->block = BlockGroup::parse($this->map, self::BLOCKS[rand(0, count(self::BLOCKS) - 1)]);
    }

    // calculate the x-coordinate the block shall spawn
    $x = floor($this->map->getWidth() / 2 - $this->block->getWidth() / 2 + 1);
    // calculate the y-coordinate the block shall spwan
    $y = $this->map->getHeight();

    // check if there is enough space to spwan the block
    if ($this->map->canHave($this->block, $x, $y)) {
      // move the block to its starting position
      $this->block->setX($x);
      $this->block->setY($y);

      // the new block was spawned
      return true;
    } else {
      // there was not enough space to spawn the new block
      return false;
    }
  }

  /**
   * Starts the game.
   *
   * @return Tetris
   *  The game for chained method calling.
   */
  public function start() : Tetris {
    // return the game for chained method calling
    return $this;
  }

  /**
   * Rotates the currently moving block.
   *
   * @return Tetris
   *  The game for chained method calling.
   */
  public function rotate() : Tetris {
    // rotate the block
    $rotatedBlock = $this->block->rotate();

    // calculate the x-difference so that the block appears to be roated in-place (i.e. centric)
    $diffX = ($this->block->getWidth() - $rotatedBlock->getWidth()) / 2;
    $diffX = $diffX < 0 ? floor($diffX) : ceil($diffX);

    // calculate the y-difference so that the block appears to be roated in-place (i.e. centric)
    $diffY = ($this->block->getHeight() - $rotatedBlock->getHeight()) / 2;
    $diffY = $diffY < 0 ? floor($diffY) : ceil($diffY);

    // calculate the rotated block's x-coordinate
    $x = $this->block->getX() + $diffX;
    // calculate the roated block's y-coordinate
    $y = $this->block->getY() - $diffY;

    // clear the block
    $this->block->clear();

    // check if there is enough space for the rotated block
    if ($this->map->canHave($rotatedBlock, $x, $y)) {
      // position the rotated block
      $rotatedBlock->setX($x);
      $rotatedBlock->setY($y);

      // replace the currently moving block with the rotated block
      $this->block = $rotatedBlock;

      // paint the rotated block
      $this->block->paint();
    } else {
      // re-paint the not-rotated block as-was
      $this->block->paint();
    }

    // return the game for chained method calling
    return $this;
  }

  /**
   * Moves the currently moving block to the left.
   *
   * @return Tetris
   *  The game for chained method calling.
   */
  public function moveLeft() : Tetris {
    // check if the block can be moved to the left
    if ($this->block->canMove('left')) {
      // move the block to the left
      $this->block->setX($this->block->getX() - 1);
    }

    // return the game for chained method calling
    return $this;
  }

  /**
   * Moves the currently moving block to the right.
   *
   * @return Tetris
   *  The game for chained method calling.
   */
  public function moveRight() : Tetris {
    // check if the block can be moved to the right
    if ($this->block->canMove('right')) {
      // move the block to the right
      $this->block->setX($this->block->getX() + 1);
    }

    // return the game for chained method calling
    return $this;
  }

  /**
   * Moves the currently moving block down.
   *
   * @return Tetris
   *  The game for chained method calling.
   */
  public function moveDown() : Tetris {
    // check if the block can be moved down
    if ($this->block->canMove('down')) {
      // move the block down
      $this->block->setY($this->block->getY() - 1);
    }

    // return the game for chained method calling
    return $this;
  }

}
