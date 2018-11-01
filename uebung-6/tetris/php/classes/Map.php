<?php

/**
 * Represents an area within which blocks can be positioned.
 */
class Map {

  /**
   * The map's width in blocks.
   * @var int
   */
  private $width;

  /**
   * The map's height in blocks.
   * @var int
   */
  private $height;

  /**
   * The map's rows, containing the columns.
   * @var array<Field[]>
   */
  private $rows = [];

  /**
   * Constructs an area within which blocks can be positioned.
   * A single map isn't necessarily the game's area, the game's area might consist of various maps or a map might only
   * be used to group blocks for whatever reason.
   *
   * @param int $width
   *  The map's width in blocks.
   * @param int $height
   *  The map's height in blocks.
   */
  public function __construct(int $width, int $height) {
    // remember the width
    $this->width = $width;
    // remember the height
    $this->height = $height;

    // loop as many rows as have to be created (height)
    for ($y = 0; $y < $this->height; $y++) {
      // the current row
      $row = [];
      // loop as many fields as have to be created (width)
      for ($x = 0; $x < $this->width; $x++) {
        // create a new field and add it to the current row
        $row[] = new Field();
      }

      // add the current row to the rows
      $this->rows[] = $row;
    }
  }

  /**
   * Returns the map's width.
   *
   * @return int
   *  The map's width.
   */
  public function getWidth() : int {
    // return the private property as-is
    return $this->width;
  }

  /**
   * Returns the map's height.
   *
   * @return int
   *  The map's height.
   */
  public function getHeight() : int {
    // return the private property as-is
    return $this->height;
  }

  /**
   * Returns the map's rows.
   *
   * @return array<Field[]>
   *  The map's rows.
   */
  public function getRows() : array {
    // return the private property as-is
    return $this->rows;
  }

  /**
   * Returns the field at the given x- and y-coordinate.
   *
   * @param int $x
   *  The x-coordinate.
   * @param int $y
   *  The y-coordinate.
   * @return Field|null
   *  The field at the given x- and y-coordinate.
   */
  public function getFieldAt(int $x, int $y) {
    // return the field at the given x- and y-coordinate
    return $this->rows[count($this->rows) - $y] ? $this->rows[count($this->rows) - $y][$x - 1] : null;
  }

  /**
   * Checks and returns, if the given block can be (could be moved to) at the given x- and y-coordinate.
   *
   * @param int $x
   *  The x-coordinate.
   * @param int $y
   *  The y-coordinate.
   * @return bool
   *  True, if the given block can be at the given position, false otherwise.
   */
  public function canHave(Block $block, int $x, int $y) {
    // delegate to the block, the block knows better how it is going to paint itself
    return $block->canBeAt($this, $x, $y);
  }

  /**
   * Paints the block at the given x- and y-coordinate.
   * Painting doesn't actually do anything more than letting the block logically occoupy a field. Rendering code has to
   * take care of painting, whatever that means.
   *
   * @param Block $block
   *  The block to paint.
   * @param int $x
   *  The x-coordinate.
   * @param int $y
   *  The y-coordinate.
   * @return Map
   *  The map for chained method calling.
   */
  public function paint(Block $block, int $x, int $y) : Map {
    // occoupy the field at the given position with the given block
    $this->getFieldAt($x, $y)->setBlock($block);
    // return the map for chained method calling
    return $this;
  }

  /**
   * Clears the given x- and y-coordinate.
   * Clearing doesn't actually do anything more than disoccupying the field currently occupied by the block. Rendering
   * code has to take care of clearing, whatever that means.
   *
   * @param int $x
   *  The x-coordinate.
   * @param int $y
   *  The y-coordinate.
   * @return map
   *  The map for chained method calling.
   */
  public function clear(Block $block, int $x, int $y) : Map {
    // disoccupy the field at the given position
    $this->getFieldAt($x, $y)->setBlock(null);
    // return the map for chained method calling
    return $this;
  }

}
