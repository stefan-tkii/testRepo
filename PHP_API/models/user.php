<?php
    class user
    {
        private $conn;
        public $Id;
        public $table = 'user';
        public $firstname;
        public $lastname;
        public $ssid;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read()
        {
            $query = "SELECT * FROM user";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement;
        }

        public function read_single($id)
        {
            $query = "SELECT * FROM user WHERE Id = '$id' LIMIT 1";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $this->Id = $row['Id'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->ssid = $row['ssid'];
        }

        public function read_single_ssid($ssid)
        {
            $query = "SELECT * FROM user WHERE ssid = '$ssid' LIMIT 1";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $this->Id = $row['Id'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->ssid = $row['ssid'];
        }

        public function create()
        {
            $query = 'INSERT INTO ' . $this->table . '
            SET
                firstname = :firstname,
                lastname = :lastname,
                ssid = :ssid';
            $statement = $this->conn->prepare($query);
            $this->firstname = htmlspecialchars(strip_tags($this->firstname));
            $this->lastname = htmlspecialchars(strip_tags($this->lastname));
            $this->ssid = htmlspecialchars(strip_tags($this->ssid));
            $statement->bindParam(':firstname', $this->firstname);
            $statement->bindParam(':lastname', $this->lastname);
            $statement->bindParam(':ssid', $this->ssid);
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