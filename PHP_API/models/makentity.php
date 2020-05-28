<?php
    class makentity
    {
        private $conn;
        public $Id;
        public $table = 'makentity';
        public $field;
        public $userId;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function readAllByUser($userId)
        {
            $query = "SELECT * FROM makentity WHERE userId = '$userId'";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement;
        }

        public function create_entity()
        {
            $query = 'INSERT INTO ' . $this->table . '
            SET
                field = :field,
                userId = :userId';
            $statement = $this->conn->prepare($query);
            $this->field = htmlspecialchars(strip_tags($this->field));
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $statement->bindParam(':field', $this->field);
            $statement->bindParam(':userId', $this->userId);
            if($statement->execute())
            {
                return true;
            }
            printf("Error: %s.\n", $statement->error);
            return false;
        }
    }
?>