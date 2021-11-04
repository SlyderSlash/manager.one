<?php
class Users{
    private $connexion;
    private $table = "users"; 


    public $id;
    public $name;
    public $email;

    public function __construct($db){
        $this->connexion = $db;
    }
    public function newUser(){
        try{
            $sql = "INSERT INTO " . $this->table . " (name, email) VALUES (:name, :email)";
            
            $query = $this->connexion->prepare($sql);
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
        
            $query->bindParam(":name", $this->name);
            $query->bindParam(":email", $this->email);
            
            $response = $query->execute();
            if ($response) {
                return true;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
    public function getUser(){
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
    
        $query = $this->connexion->prepare( $sql );
    
        $query->bindParam(':id', $this->id);
    
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        $this->name = $row['name'];
        $this->email = $row['email'];
    }
    public function getUsers(){
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->connexion->prepare($sql);
        $query->execute();
    
        return $query;
    }
    public function deleteUser(){
        try
        {
            $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        
            $query = $this->connexion->prepare( $sql );
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $query->bindParam(":id", $this->id);
            $query->execute();

            return true;
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}