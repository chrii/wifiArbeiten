<?php

/**
 * Serializes the given game's map.
 *
 * @return string
 *  The game's serialized map.
 */
function stringify(Tetris $game) : string {
  // loop all rows
  foreach ($game->getMap()->getRows() as $row) {
    // the current row's serialization
    $string = '';
    // loop all columns
    for ($i = 0; $i < count($row); $i++) {
      // serialize the current field
      $string .= $row[$i]->getBlock() ? 'X' : '.';
    }
    // add the current row's serialization to the list
    $strings[] = $string;
  }

  // return the serialized map
  return implode(',', $strings);
}

// add the classes directory to the
set_include_path(get_include_path() . PATH_SEPARATOR . 'classes');
// register a namespace-capable class-loader
spl_autoload_register(function($className) {
  // load the class file
  require(str_replace('\\', '/', $className) . '.php');
});

// parse the blockchain
$blockchain = knitchain\Blockchain::parse($_POST['blockchain']);

// create a gemt
$game = new Tetris();

// loop all blocks
foreach ($blockchain->chain as $block) {
  // loop all documents of the current block
  foreach ($block->docs as $doc) {
    // get the current document's data
    $data = json_decode($doc->value);

    // switch the action
    switch ($data->action) {
      case 'start':
        // start the game
        $game->start();
        break;
      case 'spawn':
        // get the spawned block
        $tetrisBlock = BlockGroup::parse($game->getMap(), explode(',', $data->block));
        // spawn the block
        $game->spawn($tetrisBlock);
        break;
      case 'falldown':
      case 'down':
        // move the block down / let the block fall down
        $game->moveDown();
        break;
      case 'rotate':
        // rotate the currently moving block
        $game->rotate();
        break;
      case 'left':
        // move the currently moving block to the left
        $game->moveLeft();
        break;
      case 'right':
        // move the currently moving block to the right
        $game->moveRight();
        break;
      case 'clear':
      case 'clearfalldown':
      case 'fallendown':
      case 'change:lines':
      case 'change:level':
      case 'change:points':
        // clear rows and award points
        $game->clearRows();
        break;
    }

    // check if the current action awarded points or lines or the level changed
    if (in_array($data->action, ['change:lines', 'change:level', 'change:points'])) {
      // the property that changed
      $property = explode(':', $data->action)[1];
      // the property's getter method name
      $getter = 'get' . ucfirst($property);
      // get the property's value from the blockchain's document
      $value1 = json_decode(json_encode($data->$property), true);
      // get the property's value from the simulated game
      $value2 = $game->$getter();

      // check if the level changed
      if ($property == 'level') {
        // the level changed, the values are associative arrays, sort their keys, key order doesn't matter when diffing
        ksort($value1);
        ksort($value2);
      }

      // check if value fom the blockchain's document differs from the simulated game's value
      if (json_encode($value1) != json_encode($value2)) {
        // fraud detected, let the caller know
        header('Content-Type: application/json');
        echo(json_encode(false));
        exit();
      }
    } else if (in_array($data->action, ['spawn'])) {
      // check if the serialized map from the blockchain's document differs from the simulated game's serialized map
      if ($data->map != stringify($game)) {
        // fraud detected, let the caller know
        header('Content-Type: application/json');
        echo(json_encode(false));
        exit();
      }
    }
  }
}

// no fraud detected, let the caller know
header('Content-Type: application/json');
echo(json_encode(true));
exit();
