<?php

/**
 * Represents a field within a game's map.
 */
class Field {

  /**
   * The block occupying the field.
   * @var Block
   */
  private $block;

  /**
   * Returns the block occupying the field.
   *
   * @return Block
   *  The block occupying the field.
   */
  public function getBlock() {
    // return the block occupying the field
    return $this->block;
  }

  /**
   * Sets the block occupying the field.
   *
   * @param Block $block
   *  The block that shall occupy the field.
   * @return Field
   *  The field for chained method calling.
   */
  public function setBlock($block) : Field {
    // remember the block
    $this->block = $block;
    // return the block for chained method calling
    return $this;
  }

}
