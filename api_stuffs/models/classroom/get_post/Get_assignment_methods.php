<?php
    include_once "../../../tools/injection_checking.php";

    class Assignment {
        // DB vars
        public $class_id;
        //public $post_priority = 2; Not Used in the query
        public $secret_message;
        public $error_message = "Initially There is no Error";
        public $message = false;


        // Things that i will get from Query
        public $assignment_title;
        public $created_time;
        public $assignment_due_date;
        public $material;
        public $post_text;

        // THings that i will need to execute query || DB connections and Tables
        private $conn;
        private $assignment_notice_table = "assignment_notice";
        private $post_table = "post";

        // Constructor for initializing DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function get_assignment(){
            // Checking SQL injection for Class ID
            $haturi = new Tools();
            if(!$haturi->test_input($this->class_id)){
                $this->conn = null;
                $this->error_message = "Html Injection detected on Class ID";
            }else{
                $sql = 'select p.post_id, an.assignment_title, p.created_time , an.due_date as assignment_due_date, p.material, p.post_text FROM '.$this->assignment_notice_table.' as an, '.$this->post_table.' as p where p.class_id= :class_id and p.post_id=an.post_id ORDER BY p.created_time ASC';

                // Prepare Statement
                if($stmt = $this->conn->prepare($sql)){
                    // Executing Query
                    if($stmt->execute(array(':class_id' => $this->class_id))){
                        $this->message = true;
                        return $stmt;
                    }else{
                        $this->conn = null;
                        $this->error_message = "Problem on Executing Query";
                    }
                }else{
                    $this->conn = null;
                    $this->error_message = "Problem on Preparing Query";
                }
            }
        }
    }
?>