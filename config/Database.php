<?php
        class Database{
            private $host = "n2o93bb1bwmn0zle.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
            private $db_name = "l4xnb26w67g3gdv6";
            private $username = "yxkoza672htgnu04";
            private $password = "wb3e0nmud6xg8y5e";
            public $connexion;
        
            public function getConnection(){
                $this->connexion = null;
        
                try{
                    $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                    $this->connexion->exec("set names utf8");
                }catch(PDOException $exception){ 
                    echo "Erreur de connexion : " . $exception->getMessage();
                }
                return $this->connexion;
            }   
        }


