<!DOCTYPE html>
<html>
  <head>
    <base href="static/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="tetris.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rivets/0.9.6/rivets.bundled.min.js"></script>
    <script src="thirdparty/microevent.js"></script>

    <script src="rivets.js"></script>
    <script src="classes/Block.js"></script>
    <script src="classes/BlockGroup.js"></script>
    <script src="classes/Field.js"></script>
    <script src="classes/Map.js"></script>
    <script src="games/Tetris.js"></script>
    <script src="tetris.js"></script>

    <script src="thirdparty/knitchain.js"></script>
    <script src="../php.js"></script>
  </head>
  <body>
    <h4 class="text-center">Tetris</h4>
    <h5 class="text-center">Punkte: <span rv-text="game:points"></span></h5>
    <h6 class="text-center">Zeilen: <span rv-text="game:lines"></span></h6>
    <h6 class="text-center">Level: <span rv-text="game:level.name"></span></h6>
    <div class="container tetris">
      <div class="row" rv-each-row="game:map:rows">
        <div class="col-sm" rv-each-cell="row" rv-class="cell:class">&nbsp;</div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"   integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
