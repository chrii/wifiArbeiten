<?php

/**
 * Represents a block consisting of many single 1x1 blocks.
 */
class BlockGroup extends Block {

  /**
   * The map of single 1x1 blocks this block consists of.
   * @var Map
   */
  protected $blocks;

  /**
   * Creates a block consisting of many single 1x1 blocks.
   * Beware, that the map can not be changed anymore later on. Once a block belongs to a map, it does belong to that map.
   * The block's position within the map on the other hand can always be changed afterwards.
   *
   * @param Map $map
   *  The map the block belongs to.
   * @param int $width
   *  The desired width of the block.
   * @param int $height
   *  The desired height of the block.
   */
  public function __construct(Map $map, int $width, int $height) {
    // call the parent constructor
    parent::__construct($map);

    // create the map of single 1x1 blocks this block consists of
    $this->blocks = new Map($width, $height);
  }

  /**
   * Returns the block's width.
   *
   * @return int
   *  The block's width.
   */
  public function getWidth() : int {
    // return the block's width
    return $this->blocks->getWidth();
  }

  /**
   * Returns the block's height.
   *
   * @return int
   *  The block's height.
   */
  public function getHeight() : int {
    // return the block's height
    return $this->blocks->getHeight();
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
      // loop all rows
      for ($y = 1; $y <= $this->blocks->getHeight(); $y++) {
        // loop all columns
        for ($x = 1; $x <= $this->blocks->getWidth(); $x++) {
          // get the current cells's field
          $field = $this->blocks->getFieldAt($x, $y);
          // check if the field is occoupied by a block
          if ($field->getBlock()) {
            // paint the single 1x1 block for the current field
            $this->map->paint($field->getBlock(), $this->x + $x - 1, $this->y - $y + 1);
          }
        }
      }

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
      // loop all rows
      for ($y = 1; $y <= $this->blocks->getHeight(); $y++) {
        // loop all columns
        for ($x = 1; $x <= $this->blocks->getWidth(); $x++) {
          // get the current cell's field
          $field = $this->blocks->getFieldAt($x, $y);
          // check if the field is occoupied by a block
          if ($field->getBlock()) {
            // clear the single 1x1 block
            $this->map->clear($field->getBlock(), $this->x + $x - 1, $this->y - $y + 1);
          }
        }
      }

      // the block was cleared
      return true;
    } else {
      // the block was not cleared
      return false;
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
    // loop all single 1x1 blocks
    foreach ($this->getBlocks() as $block) {
      // check if the current single 1x1 block can be at the given position within the given map or if the other block occupying the field is one of our own blocks
      if (!$map->canHave($block, $x + $block->x - 1, $y - $block->y + 1) && (!$map->getFieldAt($x + $block->x - 1, $y - $block->y + 1) || !in_array($map->getFieldAt($x + $block->x - 1, $y - $block->y + 1)->getBlock(), $this->getBlocks(), true))) {
        // the block can't be at the position given by x- and y-coordinate
        return false;
      }
    }

    // the block can be at the position given by x- and y-coordinate
    return true;
  }

  /**
   * Creates a block consisting of many single 1x1 blocks from the given definition.
   *
   * @param Map $map
   *  The map to associate the block with.
   * @param string[]
   *  The block's definition, row by row. A "X"-character (uppercase) is interpreted as a single 1x1 block being set,
   *  every other character is interpreted as no single 1x1 block set.
   * @return BlockGroup
   *  The block consisting of many single 1x1 blocks as by the given definition.
   */
  public static function parse(Map $map, array $definitions) : BlockGroup {
    // create a sufficiently large block
    $blockGroup = new BlockGroup($map, strlen($definitions[0]), count($definitions));
    // loop the definition's rows
    for ($i = 0; $i < count($definitions); $i++) {
      // loop the row's columns
      for ($j = 0; $j < strlen($definitions[$i]); $j++) {
        // check if the current cell shall have a single 1x1 block being set
        if ($definitions[$i][$j] == "X") {
          // set a single 1x1 block for the current cell's field
          $blockGroup->blocks->getFieldAt($j + 1, $i + 1)->setBlock(new Block($blockGroup->blocks, $j + 1, $i + 1));
        }
      }
    }

    // return the block
    return $blockGroup;
  }

  /**
   * Returns all single 1x1 blocks contained in this block.
   * There is a specific deterministic order, but you should nevertheless not rely on it.
   *
   * @return Block[]
   *  All single 1x1 blocks contained in this block.
   */
  public function getBlocks() {
    // loop all rows
    for ($y = 1; $y <= $this->blocks->getHeight(); $y++) {
      // loop all columns
      for ($x = 1; $x <= $this->blocks->getWidth(); $x++) {
        // get the current cell's field
        $field = $this->blocks->getFieldAt($x, $y);
        // check if the field is occupied by a block
        if ($field->getBlock()) {
          // add the block to the blocks
          $blocks[] = $field->getBlock();
        }
      }
    }

    // return the blocks
    return $blocks;
  }

  /**
   * Returns a rotated version of the block.
   * The rotated version is rotated at 90 degrees clockwise.
   * The rotated block is associated with the same map, but is not yet positioned.
   *
   * @return BlockGroup
   *  The rotated version of the block.
   */
  public function rotate() : BlockGroup {
    // create a sufficiently large block
    $blockGroup = new BlockGroup($this->map, $this->blocks->getHeight(), $this->blocks->getWidth());
    // loop all rows
    for ($y = 1; $y <= $this->blocks->getHeight(); $y++) {
      // loop all columns
      for ($x = 1; $x <= $this->blocks->getWidth(); $x++) {
        // get the current cell's field
        $field = $this->blocks->getFieldAt($x, $y);
        // check if the field is occupied by a block
        if ($field->getBlock()) {
          // set the block at the correct position of the rotated block
          $blockGroup->blocks->getFieldAt($this->blocks->getHeight() - $y + 1, $x)->setBlock(new Block($blockGroup->blocks, $this->blocks->getHeight() - $y + 1, $x));
        }
      }
    }

    // return the rotated block
    return $blockGroup;
  }

}
