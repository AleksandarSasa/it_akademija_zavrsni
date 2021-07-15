<?php 
class Database{
    protected $location;
    protected $username;
    protected $password;
    protected $DBname;
    protected $db;
    public function __construct($a,$b,$c,$d){
        $this->location=$a;
        $this->username=$b;
        $this->password=$c;
        $this->DBname=$d;
    }
    public function query($upit){
        return mysqli_query($this->db, $upit);
    }
    public function connect(){
        $this->db=@mysqli_connect($this->location, $this->username,$this->password,$this->DBname);
        if (!$this->db) {
            return false;
        }
        else {
            $this->query("SET NAMES utf8");
            return $this->db;
        }
    }
    public function error(){
        return mysqli_error($this->db);
    }
    public function errno(){
        return mysqli_errno($this->db);
    }
    public function fobject($a){
        return mysqli_fetch_object($a);
    }
    public function insert_id(){
        return mysqli_insert_id($this->db);
    }
    
}

?>