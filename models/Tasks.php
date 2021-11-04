<?php
class Tasks{
    private $connexion;
    private $table = "tasks"; 


    public $id;
    public $user_id;
    public $title;
    public $description;
    public $creation_date;
    public $status;

    public function __construct($db){
        $this->connexion = $db;
    }
    public function newTask(){
        try{
            $sql = "INSERT INTO " . $this->table . " (title, description, status, user_id, creation_date) VALUES (:title, :description, :status, :user_id, NOW())";
            
            $query = $this->connexion->prepare($sql);
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->status=htmlspecialchars(strip_tags($this->status));
        
            $query->bindParam(":title", $this->title);
            $query->bindParam(":user_id", $this->user_id);
            $query->bindParam(":description", $this->description);
            $query->bindParam(":status", $this->status);
            
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
    public function getTasks($user){
        if ($user == false){
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->connexion->prepare($sql);
        $query->execute();
    
        return $query;
        }
        else{
            $sql = "SELECT * FROM " . $this->table . " WHERE user_id=:user_id";
            $query = $this->connexion->prepare($sql);
            $query->bindParam(":user_id", $user);
            $query->execute();
        
            return $query;
        }
    }
    public function getTask(){
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
    
        $query = $this->connexion->prepare( $sql );
    
        $query->bindParam(':id', $this->id);
    
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        $this->title = $row['title'];
        $this->user_id = $row['user_id'];
        $this->description = $row['description'];
        $this->creation_date = $row['creation_date'];
        $this->status = $row['status'];
    }
    public function deleteTask(){
        try{
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