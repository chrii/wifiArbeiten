<?php
  header( 'Access-Control-Allow-Origin: *' );
  header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );


/*
XML
<response>
  <checked isok="true" />
  <number>123</number>
</response>
*/

/*
JSON
  {"x":1}
  {"x":1,"y":"STRING"}
  {"x":1,"y":"STRING","z":true}
  {"x":1,"y":"STRING","z":true,"a":[4,6,"a",true]}
  {"o":{"a":1.4,"b":[{"x":7},{"y":5}]}}

  {"a":[]}

  JSON ist immer ein Objekt!
  Attribut-Bezeichnung immer ""
  Datentypen für Attribute
  - Zahlen (Integer,Float)
  - String (immer ")
  - Boolean (true/false)
  - Array []
  - Objekte {}
*/

  //meineDaten.json

  //MIME-Type
  header( 'Content-Type:application/json' );
  /*
  $text = '{"a":1,"b":2}';
  $o = json_decode( $text );
  $o->a = 3;
  $text = json_encode( $o );
  */

  $antwort = new stdClass(); // erzeugt Objekt

  //"5,3" => "5.3"
  $antwort->x = str_replace( ',' , '.' , $_POST['x'] ); // wandelt , in . um

  if ( is_numeric( $antwort->x ) ) {
    $antwort->check = true;
  } else {
    $antwort->check = false;
  }

  echo json_encode( $antwort ); // wandelt Objekt in JSON um

  /*

  echo is_numeric( $_POST['x']) ? 'Ja' : 'Nein';

  */
