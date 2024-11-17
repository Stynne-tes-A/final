<?php

class User{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::connect();
    }
    public function getUserDataFromSession(){
        if(isset($_SESSION["user_id"])){
            $userid = $_SESSION["user_id"];
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = :USER_ID");
            $stmt->bindParam(":USER_ID", $userid) ;
            $stmt->execute() ;
            return $stmt->fetch(PDO::FETCH_OBJ) ;

};
    }
    public function search($search) {
        $stmt = $this->pdo->prepare("
            SELECT * 
            FROM users 
            WHERE username LIKE ? 
            OR fullName LIKE ? 
            OR email LIKE ?
        ");
    
        // Add wildcards to the search query
        $search = "%{$search}%";
    
        // Bind the values correctly
        $stmt->bindValue(1, $search, PDO::PARAM_STR);
        $stmt->bindValue(2, $search, PDO::PARAM_STR);
        $stmt->bindValue(3, $search, PDO::PARAM_STR);
    
        // Execute and return the results
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
}