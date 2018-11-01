<?php
class User {
    protected $db;  // DB Objekt
    protected $id;
    protected $username;
    protected $email;
    protected $isLogged = false;
    public $error = '';

    public function __construct(SpiderDB $db)
    {
        $this->db = $db;
    }

    public function login_db(string $username)
    {
        $sql = "SELECT user.username , user.password FROM `user` WHERE username = ?";

        $stmt = $this->db->connection->prepare($sql);
        if(!$stmt){
            die ('db->connection failed');
        }        
        if ($stmt->bind_param('s', $username) === false){
            die("stmt->bind_param failed");
        }        
        if ($stmt->execute() !== false){
            $res = $stmt->get_result();
        }
        while($row = $res->fetch_assoc()){
            return $row;
        }
    }

    public function loggedIn(array $session) : bool
    {
        if (array_key_exists('loggedIn', $session) && $session['loggedIn'] === true) {
            return true;
        }
        return false;
    }

    public function saveScore(int $score)
    {
        # code...
    }

    public function getScore() : int
    {
        # code...
    }

    public function register(string $username, string $password, string $email)
    {
        $sql = <<<SQL
        INSERT INTO user (username, password, email)
        VALUES (?, ?, ?)
SQL;
        $res = $this->db->query($sql, [$username, $password, $email]);
        return $res;
    }
}