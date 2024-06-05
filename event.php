<?php
class event{
    private $conn;
    public $id;
    public $title;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM event";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query = "INSERT INTO event SET title=:title";
        $stmt = $this->conn->prepare($query);
        $this->title=htmlspecialchars(strip_tags($this->title));
        $stmt->bindParam(":title", $this->title);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update(){
        $query = "UPDATE event SET title = :title WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function delete(){
        $query = "DELETE FROM event WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}

?>