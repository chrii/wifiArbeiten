// when the document is ready
$().ready(function() {
  // create the game
  var game = new Tetris();

  // when the game ends
  game.bind("gameover", function() {
    // stop the music
    $("#korobeiniki").remove();
    // let the player know
    alert("Game over!");
  });

  // bind the game to the body (as rivets view)
  var view = rivets.bind(document.body, {
    game: game
  });
  // make the view available
  $(document.body).data("view", view);

  // when clicking the game area
  $(".tetris").one("click", function() {
    // start the game
    game.start();

    // when pressing a key
    $(document).on("keydown", function(event) {
      // switch key code
      switch (event.keyCode) {
        // left cursor key
        case 37: game.moveLeft();  break;
        // right cursor key
        case 39: game.moveRight(); break;
        // down cursor key
        case 40: game.moveDown();  break;
        // up cursor key
        case 38: game.rotate();    break;
      }
    });

    // start the music
    $(document.body).append($("<audio>").attr({
      id: "korobeiniki",
      autoplay: "true",
      controls: "false",
      loop: "true",
      src: "thirdparty/audio/Korobeiniki.mp3"
    })
    // don't show the player, let it play in the backgroun
    .hide());
  });
});
