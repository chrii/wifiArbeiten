<?php

/**
 * Represents one single 1x1 block.
 */
class Block {

  /**
   * The map the block belongs to.
   * @var Map
   */
  protected $map;

  /**
   * The block's current x-coordinate.
   * @var int
   */
  protected $x;

  /**
   * The block's current y-coordinate.
   * @var int
   */
  protected $y;

  /**
   * Creates a single 1x1 block.
   * Beware, that the map can not be changed anymore later on. Once a block belongs to a map, it does belong to that map.
   * The block's position within the map on the other hand can always be changed afterwards.
   *
   * @param Map $map
   *  The map the block belongs to.
   * @param int [$x]
   *  The x-coordinate of the block within the map.
   * @param int [$y]
   *  The y-coordinate of the block within the map.
   */
  public function __construct(Map $map, int $x = null, int $y = null) {
    // remember the map
    $this->map = $map;
    // remember the x-coordinate
    $this->x = $x;
    // remember the y-coordinate
    $this->y = $y;

    // paint the block
    $this->paint();
  }

  /**
   * Returns the map the block belongs to.
   *
   * @return Map
   *  The map the block belongs to.
   */
  public function getMap() : Map {
    // return the private property as-is
    return $this->map;
  }

  /**
   * Returns the block's current x-coordinate.
   *
   * @return int
   *  The block's current x-coordinate.
   */
  public function getX() : int {
    // return the private property as-is
    return $this->x;
  }

  /**
   * Sets the block's current x-coordinate.
   *
   * @param int $x
   *  The block's current x-coordinate.
   * @return Block
   *  The block for chained method calling.
   */
  public function setX(int $x) : Block {
    // clear the block
    $this->clear();
    // remember the new x-coordinate
    $this->x = $x;
    // paint the block
    $this->paint();

    // return the block for chained method calling
    return $this;
  }

  /**
   * Returns the block's current y-coordinate.
   *
   * @return int
   *  The block's current y-coordinate.
   */
  public function getY() : int {
    // return the private property as-is
    return $this->y;
  }

  /**
   * Sets the block's current y-coordinate.
   *
   * @param int $y
   *  The block's current y-coordinate.
   * @return Block
   *  The block for chained method calling.
   */
  public function setY(int $y) : Block {
    // clear the block
    $this->clear();
    // remember the new y-coordinate
    $this->y = $y;
    // paint the block
    $this->paint();

    // return the block for chained method calling
    return $this;
  }

  /**
   * Paints the block.
   * The block will be painted, if both x-coordinate and y-coordinate are set.
   *
   * @return bool
   *  True, if the block was painted, false otherwise.
   */
  public function paint() : bool {
    // check if the block's x- and y-coordinate are set
    if ($this->x && $this->y) {
      // paint the block
      $this->map->paint($this, $this->x, $this->y);
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
   * @return bool
   *  True, if the block was cleared, false otherwise.
   */
  public function clear() : bool {
    // check if the block's x- and y-coordinate are set
    if ($this->x && $this->y) {
      // clear the block
      $this->map->clear($this, $this->x, $this->y);
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
   * @param string [$direction = 'down']
   *  The direction can be one of the following directions: "left", "right", "up", "down", "leftup", "rightup", "leftdown"
   *  or "rightdown".
   * @param int [$distance = 1]
   *  The distance in blocks from the current x- and y-coordinate.
   * @return bool
   *  True, if the block can be moved into the given direction, false otherwise.
   */
  public function canMove(string $direction = 'down', int $distance = 1) : bool {
    // switch the direction
    switch ($direction) {
      case 'left':
        // check if block can move to the left
        return $this->canBeAt($this->map, $this->x - $distance, $this->y);
      case 'right':
        // check if block can move to the right
        return $this->canBeAt($this->map, $this->x + $distance, $this->y);
      case 'down':
        // check if block can move down
        return $this->canBeAt($this->map, $this->x, $this->y - $distance);
      case 'up':
      case 'leftup':
      case 'rightup':
      case 'leftdown':
      case 'rightdown':
      default:
        // throw an exception
        throw new Exception("Direction $direction is currently not yet supported.");
    }
  }

  // FIXME check why a map is accepted, a block normally only lives in the context of its own map
  /**
   * Checks if the block can be at the position given by x- and y-coordinate within the given map.
   *
   * @param Map $map
   *  The map for which to check if the block can be at the given position.
   * @param int $x
   *  The x-coordinate of the field to check.
   * @param int $y
   *  The y-coordinate of the field to check.
   * @return bool
   *  True, if the block can be at the position given by x- and y-coordinate, false otherwise.
   */
  public function canBeAt(Map $map, int $x, int $y) : bool {
    // get the map's field for the given x- and y-coordinate
    $field = $map->getFieldAt($x, $y);

    // check if the field is not yet taken by another block or the other block is just ourself
    return $field && (!$field->getBlock() || $field->getBlock() === $this);
  }

}
