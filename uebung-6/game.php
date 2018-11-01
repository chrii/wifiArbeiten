<?php

// add the classes directory to the
set_include_path(get_include_path() . PATH_SEPARATOR . 'tetris/classes');
// register a namespace-capable class-loader
spl_autoload_register(function($className) {
  // load the class file
  require(str_replace('\\', '/', $className) . '.php');
});

// parse the blockchain
$blockchain = knitchain\Blockchain::parse(json_decode(file_get_contents('game.json')));

// ...
