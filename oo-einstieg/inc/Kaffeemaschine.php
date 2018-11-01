<?php
/* 
    Klassen werden mit class eingeleitet
    Regeln zur Namensgebung wie bei Funktionen
    Konvention: erstes Zeiche ist Großbuchstabe
    Die Datei sollte so heißen wie die Klasse heißt
    Konvention: eine Klasse pro Datei
*/
class Kaffeemaschine {
    // Klassen -eigenschaften/-attribute
    /* 
        Der Zugriff von außen wird über Zugriffsoperatoren gesteuert
        - public -    können von außen gelesen und geschrieben werden
        - protected - können nur innerhalb der Klasse und von abgeleiteten  
                      Klassen gelesen und geschrieben werden
        - private   - können nur innerhalb dieser Klasse gelesen und geschrieben
                      werden
    */
    protected $kaffee = 'Arabica';
    protected $wasser = 'Hochquellwasser';
    protected $strom = '230V';
    protected $allowedKaffeSorten = [
        'Arabica',
        'Robusta',
        'Liberica'
    ];
    
    /* 
        Ein Konstruktor muss immer wie unten __construct benannt werden.
        Er dient zur Initialisierung der Klassen-Eigenschaften und kann 
        bereits auf Klassenmethoden zugreifen.
        Die übergebenen Werte sollten auf Gültigkeit validiert werden.

        $this wird in der Klasse verwendet und steht für: ich, mein, meines
        Da die Klasse noch nicht weiß, wie die Objekte heißen werden, wird
        $this als "vorläufiger Name" verwendet.

        Funktionen können default Arguments erhalten. Wird das Argument nicht
        mitgegeben, wird der definierte Standardwert zugewiesen.

        Default arguments können mit required arguments gemischt werden. Dann
        müssen sie aber an das Ende der Liste gesetzt werden.

        Bsp:
        function reisePlan($passportNr, $country, $currency='€', $language='en') { ... }
        Aufruf: reisePlan('P12345656', 'Frankreich');
        Aufruf für Euro und deutsch:
        Default Arguments: die Reihenfolge muss beachtet werden. gibt es mehrere
        optionale Parameter, müssen alle davor optionalen beim Aufruf trotzdem 
        mitgegeben werden.
        reisePlan('P12345656', 'Deutschland', '€', 'de');
    */
    public function __construct(string $sorte='Arabica', 
                                int $spannung=220,
                                string $wasser='Leitungswasser') {
        // Wir nutzen die Filter Funktionalität von setKaffee im Konstruktor
        $this->setKaffee($sorte);
        $this->strom = $spannung;
        $this->wasser = $wasser;
    }   

    /* 
        Methoden sind Funktionen, die der Klasse zugeordnet sind.
        Der Zugriff auf diese werden ebenfalls über public, protected, private
        gesteuert.
        Sie werden, wie Attribute, über den Zugriffsoperator am Objekt  
        aufgerufen.
    */
    public function machKaffee() {
        return 'Hier dein leckerer ' . $this->kaffee . ' Kaffee, er wurde mit ' . $this->wasser . ' und ' . $this->strom . ' erstellt. Lass ihn dir schmecken!';
    }

    /**
     * Kaffeesorte kann auf eine der erlaubten Sorten gesetzt werden
     *
     * @param string $sorte
     * @return void
     */
    public function setKaffee(string $sorte) {
        if (in_array($sorte, $this->allowedKaffeSorten)) {
            $this->kaffee = $sorte;
        }
    }

}