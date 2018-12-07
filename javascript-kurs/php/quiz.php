<?php
  header( 'Access-Control-Allow-Origin: *' );
  header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );
  header( 'Content-Type:application/json' );
  sleep(1); 
  $antwort = new stdClass();

function getFragen() {
  $jsondatei = file_get_contents( 'fragen.json' );
  // {"fragen":[]}
  // {"fragen":[{...}]}
  // {"fragen":[{...},{...},{...}]}
  $json = json_decode( $jsondatei );
  return $json->fragen; // Array!
}

/*
$fragen -> ARRAY mit FragenObjekte
*/
function saveFragen( $fragen ) {
  $json = new stdClass();
  $json->fragen = $fragen;
  $jsondatei = json_encode( $json );
  file_put_contents( 'fragen.json', $jsondatei ); // überschreiben!
}

  // CODE lt. quizcms.api.txt
  // Daten in fragen.json speichern
/*
  if ( !isset( $_POST['requestart']  )) {
    echo '{"error":"no requestart"}';
    exit;
  }
*/
  switch( $_POST['requestart'] ) {
    case "speichern":
      $alleFragen = getFragen();
      $neueFrage = new stdClass();
      $neueFrage->frage = $_POST['frage'];
      /*$neueFrage->antworten = array(
        $_POST['antwort1'],
        $_POST['antwort2'],
        $_POST['antwort3'],
        $_POST['antwort4']
      );*/
      $neueFrage->antworten = array();
      $neueFrage->antworten[] = $_POST['antwort1'];
      $neueFrage->antworten[] = $_POST['antwort2'];
      $neueFrage->antworten[] = $_POST['antwort3'];
      $neueFrage->antworten[] = $_POST['antwort4'];
      $neueFrage->richtig = $_POST['richtig'];
      $neueFrage->schwierigkeit = $_POST['schwierigkeit'];

      // füge neue Frage zu den anderen Fragen hinzu
      $alleFragen[] = $neueFrage;



      saveFragen( $alleFragen );
      echo '{"gespeichert":true}';

    break;

    case "ausgabe":
      $alleFragen = getFragen();
      $response = new stdClass();
      $response->fragen = $alleFragen;
      echo json_encode(  $response );

    break;

    case "loeschen":
      $ix = $_POST['index'];
      $alleFragen = getFragen();
      array_splice($alleFragen, $ix, 1);
      saveFragen( $alleFragen );
      echo '{"geloescht":true}';
    break;

  }
