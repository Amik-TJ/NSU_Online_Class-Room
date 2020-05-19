<?php
include_once "../../../tools/injection_checking.php";

class Create_assignment {
    // DB vars to input
    public $class_id;
    public $post_id;
    public $secret_message;
    public $created_by;
    public $token;
    public $priority;
    public $material = false;
    public $post_text;
    public $assignment_title;
    public $assignment_due_date;


    public $error_message = "Initially There is no Error";
    public $message = false;



    // THings that i will need to execute query || DB connections and Tables
    private $conn;
    private $post_table = "post";

    // Constructor for initializing DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Injection Checking
    public function injection_checking(){
        $haturi = new Tools();
        if(!$haturi->test_input($this->class_id)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in Class ID";
        }elseif(!$haturi->test_input($this->secret_message)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in Secret Message";
        }elseif(!$haturi->test_input($this->created_by)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in Created By";
        }elseif(!$haturi->test_input($this->token)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in token";
        }elseif(!$haturi->test_input($this->priority)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in priority";
        }elseif(!$haturi->test_input($this->material)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in material";
        }elseif(!$haturi->test_input($this->assignment_title)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in Assignment Title";
        }else{
            $this->message = true;
            $this->error_message = "There is no HTML injection";
        }
    }

    public function null_checking(){
        if(empty($this->class_id)) {
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Class Id is null";
        }elseif (empty($this->secret_message)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Secret Message is null";
        }elseif (empty($this->created_by)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Created by is null";
        }elseif (is_null($this->token)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "token is null";
        }elseif (empty($this->priority)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "priority is null";
        }elseif (empty($this->assignment_title)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Assignment Title is null";
        }elseif (empty($this->assignment_due_date)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Assignment Due Date is null";
        } else{
            $this->message = true;
            $this->error_message = " Nothing is Null";
        }
    }
    public function set_assignment(){
        // Genarating Post ID
        $sql = 'SELECT * FROM '.$this->post_table;
        $stmt = $this->conn->query($sql);
        $num = $stmt->rowCount();
        $post_num = $num+1;
        $this->post_id = $this->class_id.'_'.$post_num;

        // Inserting  Post Data in Database Post Table
        $sql = 'INSERT INTO post( post_serial , post_id, class_id, created_time, created_by, token, priority, material, post_text) VALUES ( '.$post_num.', :post_id , :class_id , now() , :created_by , :token , :priority , :material , :post_text )';
        if($stmt = $this->conn->prepare($sql)){
            // Executing Query for inserting into Post Table
            if($stmt->execute(array(
                ':post_id' => $this->post_id,
                ':class_id' => $this->class_id,
                ':created_by' => $this->created_by,
                ':token' => $this->token,
                ':priority' => $this->priority,
                ':material' => $this->material,
                ':post_text' => $this->post_text))){
                $this->message = true;
                $this->error_message = "Query Executed Successfully for Post Table";
            }else{
                $this->conn = null;
                $this->message = false;
                $this->error_message = "Problem on Executing Query for post table";
            }
        }else{
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Problem on Preparing Query for Post Table";
        }

        // Assignment due date needs to be formatted for DB
        $this->assignment_due_date = strtotime($this->assignment_due_date);
        $this->assignment_due_date = date('Y-m-d H:i:s' , $this->assignment_due_date);


        // Inserting  Assignment Data in Database assignment_notice Table
        $sql2 = "INSERT INTO assignment_notice( post_id, priority, assignment_title, due_date) VALUES ( :post_id , :priority , :assignment_title , :assignment_due_date )";
        if($stmt2 = $this->conn->prepare($sql2)){
            // Executing Query for inserting into Post Table
            if($stmt2->execute(array(
                ':post_id' => $this->post_id,
                ':priority' => $this->priority,
                ':assignment_title' => $this->assignment_title,
                ':assignment_due_date' => $this->assignment_due_date))){
                $this->message = true;
                $this->error_message = "Query Executed Successfully for Assignment Table";
                return $stmt2;
            }else{
                $this->conn = null;
                $this->message = false;
                $this->error_message = "Problem on Executing Query for Assignment table";
            }
        }else{
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Problem on Preparing Query for Assignment Table";
        }
    }
}
?>
