<?php
class Database  {
    private $host = 'sql310.epizy.com';
    private $user = 'epiz_25258172';
    private $pass = 'cUYpXkW4nSKQ';
    private $db   = 'epiz_25258172_oopjquery';
    private $myconn;

    public function connect() {
        $con = mysqli_connect($this->host, 
            $this->user, 
            $this->pass, 
            $this->db
        );

        if (!$con) {
            die('Could not connect to database!');
        } else {
            $this->myconn = $con;
        }
        return $this->myconn;
    }

    public function close() {
        mysqli_close($this->myconn);
    }

}
