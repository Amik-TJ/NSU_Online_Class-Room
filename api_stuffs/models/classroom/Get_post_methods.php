<?php
    include_once "../../tools/injection_checking.php";

    class Get_post {
        // DB vars
        public $class_id;
        //public $post_id;
        public $rows; // for comments
        public $post_priority = 3;
        public $secret_message;
        public $error_message = "Initially There is no Error";
        public $message = false;
        public $comments_arr = array(
            'success' => 0,
            'error_message' => "Initially No Error for Comments"
        );

        /*// THings that I will get from Query
        public $post_id;
        public $creator_id;
        public $creator_name;
        public $created_time;
        public $post_text;
        public $post_material;*/

        // Things that i will neeed to execute query DB conn and Tables
        private $conn;
        private $post_table = "post";
        private $person_table = "person";
        private $comments_table = "comments";

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

        // Comments Method
        public function comments($post_id){
            if (empty($post_id)){
                $comments_arr['error_message'] = "Post ID is Null";
            }else{
                $this->comments_arr = array(
                    'success' => 0,
                    'error_message' => "There is No Comments for this post"
                );

                $query = 'SELECT c.post_id, c.commiter_id, p.name as commiter_name, c.comments FROM '.$this->comments_table.' as c, person as p WHERE c.commiter_id=p.person_id and c.post_id = "'.$post_id.'"';

                if($cmnt = $this->conn->query($query)){
                    $num = $cmnt->rowCount();
                    if( $num > 0 ){
                        $rows = $cmnt->fetchALL(PDO::FETCH_ASSOC);
                        $this->comments_arr = array(
                            'success' => 1,
                            'data' => array($rows)
                        );
                    }
                }else{
                    $comments_arr['error_message'] = "There is a problem on Comments Query";
                }
            }

        }
    }
?>