<?php

namespace knitchain;

class Blockchain {

  public static function parse(string $data) : Blockchain {
    $data = json_decode($data);

    $blockchain = new Blockchain($data->difficulty, $data->docsLimit);
    $blockchain->chain = array_map(function($data) {
      $block = new Block($data->index, $data->previousHash, $data->docsLimit);
      $block->createdAt = $data->createdAt;
      $block->docs = array_map(function($data) {
        $doc = new Doc($data->value);
        $doc->createdAt = $data->createdAt;

        return $doc;
      }, $data->docs);
      $block->closed = $data->closed;
      $block->hash = $data->hash;
      $block->nonce = $data->nonce;

      return $block;
    }, $data->chain);

    $blockchain->latest = $blockchain->chain[count($blockchain->chain) - 1];

    return $blockchain;
  }

  public $chain = [];
  public $latest;
  public $difficulty;
  public $docsLimit;

  public function __construct(int $difficulty = 4, int $docsLimit = 2) {
    $this->difficulty = $difficulty;
    $this->docsLimit = $docsLimit;
  }

  public function getLatest() {
    return $this->chain[count($this->chain) - 1];
  }

  public function insertData(string $value) {
    if (!$this->latest) {
      $this->latest = new Block(0, '', $this->docsLimit);
      $this->insertData($value);
      $this->chain[] = $this->latest;
      return $this->latest;
    }

    if ($this->latest->closed) {
      $this->latest = new Block(count($this->chain), $this->latest->hash, $this->docsLimit);
      $this->insertData($value);
      $this->chain[] = $this->latest;
      return $this->latest;
    }

    $this->latest->createDoc($value);
    $this->latest->mineBlock($this->difficulty);

    return $this->latest;
  }

  public function isValid(int $index = null) {
    if ($index !== null) {
      return $this->_isValid($index);
    }

    for ($i = 0; $i < count($this->chain); $i++) {
      if (!$this->_isValid($i)) {
        return false;
      }
    }

    return true;
  }

  private function _isValid(int $index = 0) {
    if (!$this->chain[$index]) {
      return false;
    }

    $currentBlock = $this->chain[$index];
    $previousBlock = $this->chain[$index - 1];

    if ($currentBlock->hash != $currentBlock->calculateHash()) {
      return false;
    }

    if ($index >= 1) {
      if ($currentBlock->previousHash != $previousBlock->hash) {
        return false;
      }
    }

    if ($index < count($this->chain) - 1) {
      $index++;
      $this->_isValid($index);
    }

    return true;
  }

}
