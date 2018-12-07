<?php
header( 'Access-Control-Allow-Origin: *' );
header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );
header( 'Content-Type:application/json' );
// Senderkey für Entwickler
$senderKey = 'Platzhalter';

// Test RBL für Reumannplatz => 4101
$rblReumann = 4101;

// Test RBL für Karlsplatz/Oper (Nightline) => 1678
$rblNightline = 1678;

$dataLink = 'http://www.wienerlinien.at/ogd_realtime/monitor?rbl=' . $rblNightline . '&sender=' . $senderKey;

$data = file_get_contents($dataLink, 'r');
$dataEncoded = json_decode($data);

//var_dump($dataEncoded->data->monitors[2]->lines[0]->name);
$monitors = $dataEncoded->data->monitors;

function validate() {}

function getCardString($val) {
    global $senderKey;
    $dataLink = 'http://www.wienerlinien.at/ogd_realtime/monitor?rbl=' . $val . '&trafficInfos&sender=' . $senderKey;
    $data = file_get_contents($dataLink);
    $dataEncoded = json_decode($data);

    $dataTitle = $dataEncoded->data->monitors;
    $responseArray = [];

    foreach ($dataTitle AS $value) {
        if (!array_key_exists('reponse', $responseArray)) {
            $responseArray['response'] = [];
        }
        array_push($responseArray['response'], $value->lines[0]->name);
        array_push($responseArray['response'], $value->lines[0]->departures->departure[0]->departureTime->countdown);
        array_push($responseArray['response'], $value->lines[0]->towards);
    }

    $finalize = json_encode($responseArray);

    return $finalize;

}
//var_dump(getCardString('1678'));
if (array_key_exists('getLiveData', $_GET))
switch ($_GET['getLiveData']) {
    case 'rbl':
        $rblNumber = $_GET['rblNumber'];
        $finString = getCardString($rblNumber);
        echo json_encode($finString);

}
