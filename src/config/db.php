<?php
	class db{
		//properties
        private $dbhost = 'localhost';
        private $dbuser = 'it58160637';
        private $dbpass = '17350490-';
        private $dbname = 'it58160637';
        // Connect
        public function connect(){
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }