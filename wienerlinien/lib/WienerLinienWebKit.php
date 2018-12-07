<?php
/**
 * PATTERN
 *  Aufbau Haltestellen CSV
 *  "HALTESTELLEN_ID";"TYP";"DIVA";"NAME";"GEMEINDE";"GEMEINDE_ID";"WGS84_LAT";"WGS84_LON";"STAND"
 *  214460106;"stop";60200001;"Absberggasse";"Wien";90001;48.1738010728644;16.3898072745249;""
 * 
 *  Aufbau Linien CSV
 *  "LINIEN_ID";"BEZEICHNUNG";"REIHENFOLGE";"ECHTZEIT";"VERKEHRSMITTEL";"STAND"
 *   214433717;"D";10;1;"ptTram";""
 *  
 *  Aufbau Steig CSV
 *  "STEIG_ID";"FK_LINIEN_ID";"FK_HALTESTELLEN_ID";"RICHTUNG";"REIHENFOLGE";"RBL_NUMMER";"BEREICH";"STEIG";"STEIG_WGS84_LAT";"STEIG_WGS84_LON";"STAND"
 *  214688219;214432881;214550430;"H";1;"";"";"";48.1598050642344;15.6348810760565;""
 * 
 */
class WienerLinienWebKit {
    public $hst = [];
    public $lin = [];
    public $stg = [];


    public function __construct($haltestelle, $linie, $steig) {
        
        //Nimmt den Wiener Linien Source und convertiert die Datensätze in Arrays
        $this->hst = $this->convSource($haltestelle);
        $this->lin = $this->convSource($linie);
        $this->stg = $this->convSource($steig);

    }

    /**
     * Offenen DatenStream von fopen übergeben ($val)
     * Löst von jedem (fgets) Datensatz die Apostrophe auf und schreibt ein Array 
     * mit Zeileninhalt
     */
    protected function convSource($val) {
        $arr = [];
        while($sentence = fgets($val)) {
            $resource = str_replace('"', '', $sentence);
            $resource = explode(';', $resource);
            $arr[] = $resource;
        }
        array_shift($arr);
        return $arr;
    }


    public function getStationsByCoords($way = 'H') {
        // Ausgabe der Fahrzeugtyp -> Fahrtlinie -> Station -> Lon/Lat Daten
        $stationsByLine = [];

        // Liniendaten werden ausgelesen
        foreach ($this->lin AS $linien) {
            $linienID = $linien[0];
            $linienName = $linien[1];
            $linienTyp = $linien[4];

            // Fragt ab ob im Ausgangs-Array ein Key mit dem LinienTyp vorhanden ist
            // Wenn nicht, dann erstelle diesen und füge ein leeres Array hinzu
            if (!array_key_exists($linienTyp, $stationsByLine)) {
                $stationsByLine[$linienTyp] = [];

            }
            // Nach Prüfung ob der Key vorhanden ist, füge diesem Key die Linie als Key hinzu
            // Dieser Key hat ein weiteres Array
            $stationsByLine[$linienTyp][$linienName] = ['stationen' => [], 'lonlatrbl' => []];

            // Prüft bei jedem Liniendaten Durchlauf ob in den Steigdaten die Halstestellen ID zu finden ist
            foreach ($this->stg AS $steigDaten) {
                $linienSteigID = $steigDaten[1];
                $haltestellenID = $steigDaten[2];
                $richtung = $steigDaten[3];
                $rbl = $steigDaten[5];

                // Passen die Liniendaten zu den Steigdaten?
                if ($linienSteigID === $linienID) {
                    
                    //Wenn ja, dann nimm den Datensatz und durchsuche die Haltestellendaten an der Stelle der Stationsnamen
                    foreach ($this->hst AS $haltestellenDaten) {
                        $haltestelleStation = $haltestellenDaten[0];
                        $halstestellenName = $haltestellenDaten[3];
                        $latitude = $haltestellenDaten[6];
                        $longitude = $haltestellenDaten[7];
                        
                        // Wenn die Haltestellenstation mit den ID Daten aus der Steig CSV übereinstimmen, dann schreibe 
                        // den Halstestellen Namen ind die KoordinatenDaten in das Array
                        // $way Variable setzt die Richtung 'H' (als Standard gesetzt) für Hinweg und 'R' für Rückweg
                        if ($haltestellenID === $haltestelleStation && $richtung === $way) {
                            if (empty($rbl)) {
                                $rbl = '';
                            }
                            array_push($stationsByLine[$linienTyp][$linienName]['stationen'], [$halstestellenName, [$latitude, $longitude, $rbl]]);
                            //array_push($stationsByLine[$linienTyp][$linienName]['lonlatrbl'], [$latitude, $longitude, $rbl]);
                        }
                    }
                }
            }
        }
        return $stationsByLine;
    }

    // ptTram ptBusNight ptTrainS ptMetro ptTramVRT ptTramWLB ptBusCity
    public function getLineToJson($LineOfChoice, $src = 'singleStations.json',  $way='H') {
        $jsonPrepare = new stdClass();
        $jsonPrepare->lineData = [];

        $jsonPrepare->lineData[] = $this->getStationsByCoords($way)[$LineOfChoice];
        $jsonPrepare->timeStamp = date('Y-m-d H:i:s');

        $readyData = json_encode($jsonPrepare);
        file_put_contents($src , $readyData);
    }

    public function getAllToJson($src = 'allLines.json', $way='H') {

        $jsonPrepare = new stdClass();
        $jsonPrepare->lineData = [];

        $jsonPrepare->lineData['bim'] = $this->getStationsByCoords($way)['ptTram'];
        $jsonPrepare->lineData['nightline'] =  $this->getStationsByCoords($way)['ptBusNight'];
        $jsonPrepare->lineData['schnellbahn'] =$this->getStationsByCoords($way)['ptTrainS'];
        $jsonPrepare->lineData['ubahn'] = $this->getStationsByCoords($way)['ptMetro'];
        $jsonPrepare->lineData['bimVRT'] = $this->getStationsByCoords($way)['ptTramVRT'];
        $jsonPrepare->lineData['bimWLB'] = $this->getStationsByCoords($way)['ptTramWLB'];
        $jsonPrepare->lineData['postBus'] = $this->getStationsByCoords($way)['ptBusCity'];
        $jsonPrepare->timeStamp = date('Y-m-d H:i:s');


        $readyData = json_encode($jsonPrepare);
        file_put_contents($src, $readyData);
    }

}
