<?php
  header( 'Access-Control-Allow-Origin: *' );
  header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );
  header( 'Content-Type:application/json' );
  sleep(1);
  

function getJson() {
    $rawData = file_get_contents('fragen.json');
    if (!empty($rawData)) {
     $jsonDecoded = json_decode($rawData);
     return $jsonDecoded->fragen;
    } else {
      return false;
    }
};

function writeJson($value) {
    $jsonData = new stdClass();
    $jsonData->fragen = $value;
    $jsonEncoded = json_encode($jsonData);
    file_put_contents('fragen.json' , $jsonEncoded);
}


if (array_key_exists('requestType' , $_POST)) {
  switch ($_POST['requestType']) {
    case 'post': 
        $jsonData = getJson();

        if ($jsonData !== false) {
          $questObject = new stdClass();
          $questObject->frage = $_POST['frage'];
          $questObject->antworten = [];
          $questObject->antworten[] = $_POST['antwort1'];
          $questObject->antworten[] = $_POST['antwort2'];
          $questObject->antworten[] = $_POST['antwort3'];
          $questObject->antworten[] = $_POST['antwort4'];
          $questObject->richtig = $_POST['richtig'];
          $questObject->schwierigkeit = $_POST['schwierigkeit'];

          $jsonData[] = $questObject;
          writeJson($jsonData);

          //echo json_encode('{"gespeichert":true}');
          echo '{"gespeichert":true}';

        } else {
          echo '{"gespeichert":false}';
        }
    break;
    case 'get':
        $jsonData = getJson();

        $data = new stdClass();
        $data->fragen = $jsonData;

        echo json_encode($data);
    break;
    case 'delete':
        $jsonData = getJson();
        $deleteQuery = $_POST['index'];
        array_splice($jsonData, $deleteQuery, 1);
        writeJson($jsonData);
        echo '{"gelöscht":true}';
    break;
  }
}
