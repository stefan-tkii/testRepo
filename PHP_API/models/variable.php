<?php
    class variable
    {
        private $conn;
        public $Id;
        public $userId;
        public $testfieldId;
        public $table = 'variable';
        public $count;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read_related($userId)
        {
            $query = "SELECT * FROM variable WHERE userId = '$userId'";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement; 
        }

        public function create()
        {
            $query = 'INSERT INTO ' . $this->table . '
            SET
                count = :count,
                userId = :userId,
                testfieldId = :testfieldId';
            $statement = $this->conn->prepare($query);
            $this->count = htmlspecialchars(strip_tags($this->count));
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $this->testfieldId = htmlspecialchars(strip_tags($this->testfieldId));
            $statement->bindParam(':count', $this->count);
            $statement->bindParam(':userId', $this->userId);
            $statement->bindParam(':testfieldId', $this->testfieldId);
            if($statement->execute())
            {
                return true;
            }
            printf("Error: %s.\n", $statement->error);
            return false;
        }

        public function delete()
        {
            $query = 'DELETE FROM ' . $this->table . ' WHERE Id = :Id';
            $statement = $this->conn->prepare($query);
            $this->Id = htmlspecialchars(strip_tags($this->Id));
            $statement->bindParam(':Id', $this->Id);
            if($statement->execute())
            {
                return true;
            }
            printf("Error: %s.\n", $statement->error);
            return false;
        }
    }
?>