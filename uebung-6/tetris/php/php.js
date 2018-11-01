// when the document is ready
$().ready(function() {
  // get the game
  var game = $(document.body).data("view").models.game;

  // load the knitchain module
  Knitchain = require("knitchain");
  // create a blockchain
  blockchain = new Knitchain(1, 10);

  /**
   * Serializes the map into a single string which can easily be stored and transmitted.
   *
   * @return {string}
   *  The serialized map.
   */
  Map.prototype.serialize = function() {
    // the map's serialized rows
    var serializations = [];
    // loop all rows
    for (var i = 0; i < this.rows.length; i++) {
      // the serialized row
      var serialization = "";
      // loop all columns
      for (var j = 0; j < this.rows[i].length; j++) {
        // serialize the current field
        serialization += this.rows[i][j].block ? "X" : ".";
      }
      // add the serialized row
      serializations.push(serialization);
    }

    // return the serialized map
    return serializations.join(",");
  }

  // when the game clears a row
  game.bind("clear", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "clear"
    }));
  });

  game.bind("clearfalldown", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "clearfalldown"
    }));
  });

  game.bind("change:lines", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "change:lines",
      lines: game.lines
    }));
  });

  game.bind("change:level", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "change:level",
      level: game.level
    }));
  });

  game.bind("change:points", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "change:points",
      points: game.points
    }));
  });

  game.bind("falldown", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "falldown"
    }));
  });

  game.bind("fallendown", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "fallendown"
    }));
  });

  game.bind("spawn", function(block, x, y) {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "spawn",
      map: game.map.serialize(),
      block: block.blocks.serialize().split(",").reverse().join(","),
      x: x,
      y: y
    }));
  });

  game.bind("gameover", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "gameover",
      map: game.map.serialize()
    }));

    // ask the player if to submit the game to the highscore list
    if (confirm("Möchtest du dich in die Highscore-Liste eintragen?")) {
      // as the player for its name
      var name = prompt("Unter welchem Namen willst du dich in die Highscore-Liste eintragen?");

      // check if the player provided a name
      if (name) {
        // submit the game to the highscore list
        $.ajax({
          method: "post",
          dataType: "json",
          url: "../highscore.php",
          data: {
            blockchain: JSON.stringify(blockchain)
          },
          success: function(success) {
            // check if server detected fraud
            if (!success) {
              // show an error message
              alert("Tut mir leid, der Server meint einen Schummelversuch erkannt zu haben :-P");
            }
          },
          error: function() {
            // show an error message
            alert("Tut mir leid, beim Speichern ist ein Fehler aufgetreten :-(");
          }
        });
      }
    }
  });

  game.bind("start", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "start",
      map: game.map.serialize()
    }));
  });

  game.bind("rotate", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "rotate"
    }));
  });

  game.bind("left", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "left"
    }));
  });

  game.bind("right", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "right"
    }));
  });

  game.bind("down", function() {
    // add the event to the blockchain
    blockchain.insertData(JSON.stringify({
      action: "down"
    }));
  });
});
