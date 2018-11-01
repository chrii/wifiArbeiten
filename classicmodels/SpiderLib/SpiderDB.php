<?php
class SpiderDB {
    protected $connection;
    protected $host;
    protected $user;
    protected $password;
    protected $database;
    protected $error = '';  // der zuletzt aufgetretene Fehler wird gespeichert

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

    public function query(string $sql, array $params) {
        // replace ? durch %s
        // Original Parameter in Methoden/Funktionen IMMER unangetastet lassen
        
        $sqlNew = str_replace('?', "'%s'", $sql);
        $sqlNew = vsprintf($sqlNew, $params);

        // Quotes um jeden Wert in params legen
        /* 
        $sqlNew = str_replace('?', '%s', $sql);
        $newParams = [];
        foreach ($params as $val) {
            $newParams[] = "'" . $val . "'";
        }

        $sqlNew = vsprintf($sqlNew, $newParams); */

        return $this->connection->query($sqlNew);
    }

}