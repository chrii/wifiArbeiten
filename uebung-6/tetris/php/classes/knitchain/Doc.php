<?php

namespace knitchain;

class Doc {

  public $value;
  public $createdAt;

  public function __construct(string $value) {
    $this->value = $value;
    $this->createdAt = time();
  }

}
