<?php
    include_once "../../tools/injection_checking.php";

    class Get_post {
        // DB vars
        public $class_id;
        public $post_priority = 3;
        public $secret_message;
        public $error_message = "Initially There is no Error";
        public $message = false;

        // THings that I will get from Query
        public $post_id;
        public $creator_id;
        public $creator_name;
        public $created_time;
        public $post_text;
        public $post_material;

        // Things that i will neeed to execute query DB conn and Tables
        private $conn;
        private $post_table = "post";
        private $person_table = "person";

        // Constructor for initializing DB connection
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function posts(){
            // Action Shuru ! khela hbe !
            // initializing haturi for preventing Injections
            $haturi = new Tools();
            //checking Injections
            if (!$haturi->test_input($this->class_id)) {
                $this->conn = null;
                $this->error_message = "HTML Injection Detected"; // Injection Detected ... Character: 23
            }else{
                // SQL
                $sql = 'SELECT ps.post_id, ps.created_by as creator_id, p.name as creator_name,ps.created_time, ps.post_text, ps.material as post_material FROM ' .$this->post_table. ' as ps, '.$this->person_table.' as p WHERE ps.created_by=p.person_id and ps.class_id= :class_id and ps.priority=' .$this->post_priority;

                // Prepare Statement
                if($stmt = $this->conn->prepare($sql)){
                    if($stmt->execute(array(':class_id' => $this->class_id)))
                    {
                        $this->message = true;
                        return $stmt;
                    }else{
                        $this->conn = null;
                        $this->error_message = "Problem on Executing Query";
                        $this->message = false;
                    }

                }else{
                    $this->conn = null;
                    $this->error_message = "Problem on Preparing Query";
                    $this->message = false;
                }
            }
        }
    }
?>