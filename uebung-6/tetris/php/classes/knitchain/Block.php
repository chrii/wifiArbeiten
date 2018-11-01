<?php

namespace knitchain;

class Block {

  public $createdAt;
  public $docs;
  public $docsLimit;
  public $previousHash;
  public $index;
  public $closed;
  public $hash;
  public $nonce;

  public function __construct(int $index, string $previousHash = '', int $docsLimit = 2) {
    $this->createdAt = time();
    $this->docs = [];
    $this->docsLimit = $docsLimit;
    $this->previousHash = $previousHash;
    $this->index = $index;
    $this->closed = false;
    $this->hash = '';
    $this->nonce = 0;
  }

  public function createDoc(string $value) {
    if ($value !== null && !$this->closed) {
      $doc = new Doc($value);
      $this->docs[] = $doc;

      if (count($this->docs) == $this->docsLimit) {
        $this->closed = true;
      }
    }
  }

  public function calculateHash() {
    return hash('sha256', $this->index . $this->previousHash . $this->createdAt . json_encode($this->docs) . $this->nonce);
  }

  public function mineBlock(int $difficulty) {
    $this->hash = $this->calculateHash();
    while (substr($this->hash, 0, $difficulty) != str_repeat('0', $difficulty)) {
      $this->nonce++;
      $this->hash = $this->calculateHash();
    }
  }

}
