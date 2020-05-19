<?php
include_once "../../../tools/injection_checking.php";

class Create_comment {
    // DB vars to input
    public $post_id;
    public $secret_message;
    public $commiter_id;
    public $comments;


    public $error_message = "Initially There is no Error";
    public $message = false;



    // THings that i will need to execute query || DB connections and Tables
    private $conn;
    private $comment_table = "comments";
    private $post_table = "post";

    // Constructor for initializing DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Injection Checking
    public function injection_checking(){
        $haturi = new Tools();
        if(!$haturi->test_input($this->post_id)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in Post ID";
        }elseif(!$haturi->test_input($this->secret_message)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in Secret Message";
        }elseif(!$haturi->test_input($this->commiter_id)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Html Injection detected in Commiter ID";
        }else{
            $this->message = true;
            $this->error_message = "There is no HTML injection";
        }
    }

    public function null_checking(){
        if(empty($this->post_id)) {
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Post Id is null";
        }elseif (empty($this->secret_message)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Secret Message is null";
        }elseif (empty($this->commiter_id)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Commiter is null";
        }elseif (empty($this->comments)){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Comments is null";
        }else{
            $this->message = true;
            $this->error_message = " Nothing is Null";
        }
    }
    public function set_comment(){

        // Checking Either Post Exist or Not
        $sql = 'SELECT * FROM '.$this->post_table.' WHERE post_id="'.$this->post_id. '";';
        $stmt = $this->conn->query($sql);
        $num = $stmt->rowCount();
        if(! $num > 0 ){
            $this->conn = null;
            $this->message = false;
            $this->error_message = "No Such Post Found for Comment";
            return;
        }
        // Inserting  Post Data in Database Post Table
        $sql = 'INSERT INTO '.$this->comment_table.'(post_id, commiter_id, comments) VALUES ( :post_id , :commiter_id , :comments )';
        if($stmt = $this->conn->prepare($sql)){
            // Executing Query for inserting into Post Table
            if($stmt->execute(array(
                ':post_id' => $this->post_id,
                ':commiter_id' => $this->commiter_id,
                ':comments' => $this->comments
                                    )
                             )
             ){
                $this->message = true;
                $this->error_message = "Query Executed Successfully for Comments Table";
            }else{
                $this->conn = null;
                $this->message = false;
                $this->error_message = "Problem on Executing Query for Comments table";
            }
        }else{
            $this->conn = null;
            $this->message = false;
            $this->error_message = "Problem on Preparing Query for Comments Table";
        }
    }
}
?>
