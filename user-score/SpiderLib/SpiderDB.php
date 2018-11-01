<?php
class SpiderDB {
    // TODO Connection zurück auf private
    public $connection;
    protected $host;
    protected $user;
    protected $password;
    protected $database;
    protected $error = '';  // der zuletzt aufgetretene Fehler wird gespeichert
    protected $errorNo = '';  // der zuletzt aufgetretene Fehlercode wird gespeichert

    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        // Tritt ein Fehler auf, wird dieser in $error gespeichert
        if ($this->connection->connect_error !== NULL) {
            // TODO: Fehlermeldungen spezifizieren, z.b zusätzlich Fehlernummer, etc.
            $this->error = $this->connection->connect_error;
            $this->errorNo = $this->connection->connect_errno;
        }

    }

    /**
     * Gibt die letzte Fehlermeldung zurück
     *
     * @return string
     */
    public function getError() : string {
        return $this->error;
    }

     /**
     * Gibt den letzten Fehlercode zurück
     *
     * @return string
     */
    public function getErrorNo() : string {
        return $this->errorNo;
    }

    public function query(string $sql, array $params=[]) {
        // replace ? durch %s
        // Original Parameter in Methoden/Funktionen IMMER unangetastet lassen
        /**
         * str_replace tauscht die ? aus dem SQL-Query gegen %s.
         * vsprintf iteriert das in $params übergebene Array und tauscht der Reihe nach die %s aus dem String 
         * gegen den Inhalt des Arrays
         */
        $sqlNew = str_replace('?', "'%s'", $sql);
        $sqlNew = vsprintf($sqlNew, $params);


        //$sqlNew = vsprintf($sqlNew, $newParams);
        $res = $this->connection->query($sqlNew);

        if ($res === false) {
            $this->error = $this->connection->error;
            $this->errorNo = $this->connection->connect_errno;
        }
        
        return $res;
    }
    public function query_prepared(string $sql , array $params=[]){

    }
}