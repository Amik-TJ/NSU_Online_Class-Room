<?php
include_once "../../../tools/injection_checking.php";

class Exam {
    // DB vars
    public $class_id;
    // public $post_priority = 2; Not Used in the query
    public $secret_message;
    public $error_message = "Initially There is no Error";
    public $message = false;


    /*// Things that i will get from Query
    public $exam_title;
    public $created_time;
    public $exam_time_date;
    public $post_text;
    public $material;*/


    // THings that i will need to execute query || DB connections and Tables
    private $conn;
    private $exam_notice_table = "exam_notice";
    private $post_table = "post";

    // Constructor for initializing DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get_exam(){
        // Checking SQL injection for Class ID
        $haturi = new Tools();
        if(!$haturi->test_input($this->class_id)){
            $this->conn = null;
            $this->error_message = "Html Injection detected on Class ID";
        }else{
            // Query
            $sql = 'SELECT p.post_id, en.exam_title, p.created_time, en.exam_time_date, p.post_text, p.material FROM '.$this->exam_notice_table.' as en, '.$this->post_table.' as p WHERE en.post_id=p.post_id and p.class_id= :class_id';

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