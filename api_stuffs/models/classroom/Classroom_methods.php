<?php
    include_once "../../tools/injection_checking.php";

    class Classroom
    {

        // DB variables
        public $user_id; // for both faculty and student
        public $token;
        public $success;
        public $error_message = "Initially No Problem";
        public $message = false;
        public $course_id;

        // Classroom Properties
        public $course_title;
        public $section;
        public $time;
        public $room_no;
        public $faculty_name;

        // Classroom er jnno jesob data ana hbe !
        // For Students and Teacher Common
        private $conn;
        private $person_table = "person";
        private $class_table = "class";
        private $take_class_table = "take_class";
        private $enroll_student_table = "enroll_student";
            private $faculty_data_table = "faculty_data"; //For Student Only

        public function __construct($db)
        {
            $this->conn = $db;
        }


        public function classroom_student()
        {
            // Action Shuru ! khela hbe !
            // initializing haturi for preventing Injections
            $haturi = new Tools();
            //checking Injections
            if (!$haturi->test_input($this->user_id) || !$haturi->test_input($this->token)) {
                $this->conn = null;
                $this->error_message = "HTML Injection Detected"; // Injection Detected ... Character: 23
            }
            else{

                // sql for retrieving data for classroom
                $sql = 'SELECT c.class_id, c.course_id, c.course_title, c.section, c.time, c.room_no, p.name as faculty_name FROM ' . $this->class_table . ' as c, ' . $this->enroll_student_table . ' as e, ' . $this->person_table . ' as p, ' . $this->faculty_data_table . ' as f, ' . $this->take_class_table . ' as t WHERE t.class_id=c.class_id and t.faculty_id=f.faculty_iD and f.person_id=p.person_id and e.class_id=c.class_id and e.nsu_id= :nsu_id ';

                // Prepare Statement
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(
                    ':nsu_id' => $this->user_id
                ));
                $this->token = 1;
                $this->message = true;
                return $stmt;
            }
        }
        public function classroom_faculty()
        {
            // Action Shuru ! khela hbe !
            // initializing haturi for preventing Injections
            $haturi = new Tools();
            //checking Injections
            if ( !$haturi->test_input($this->user_id) || !$haturi->test_input($this->token) ) {
                $this->conn = null;
                $this->error_message = "HTML Injection Detected"; // Injection Detected ... Character: 23
            }
            else{

                // sql for retrieving data for classroom
                $sql = 'SELECT c.class_id, c.course_id, c.course_title, c.section, c.time, c.room_no  FROM '. $this->class_table .' as c, ' . $this->take_class_table . ' as t WHERE t.class_id=c.class_id and t.faculty_id= :faculty_id';

                // Prepare Statement
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(
                    ':faculty_id' => $this->user_id
                ));
                $this->message = true;
                $this->token = 0;
                return $stmt;
            }
        }
    }

?>