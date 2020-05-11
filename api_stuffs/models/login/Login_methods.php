<?php
    include_once "../../tools/injection_checking.php";
    class Login {


        // DB Tables
        private $conn;
        private $person_table = "person";
        private $student_table = "student_data";
        private $faculty_table = "faculty_data";

        // Login Properties
        public $user_id;
        public $password;
        public $error_message = 'Initailly No problem';
        public $message = false;

        //Login korar por database thike ja ja ana lagbe

        // For Student
        public $student_name;


        // For Teacher
        public $faculty_name;
        public $faculty_id;

        // Common for both Faculty and Student
        public $email;
        public $gender;

        public function __construct($db)
        {
            $this->conn = $db;
        }


        public function login_student (){
            // Action Shuru ! khela hbe !
            // initializing haturi for preventing Injections
            $haturi = new Tools();
            //checking Injections
            if ( !$haturi->test_input($this->user_id) || !$haturi->test_input($this->password)){
                $this->conn = null;
                $this->error_message = "HTML Injection Detected"; // Injection Detected ... Character: 23

            }else{
                // SQL
                $sql = 'SELECT password FROM '. $this->person_table .' where person_id=(SELECT person_id FROM '. $this->student_table .' where nsu_id= :user_id )';

                // Prepare Statement
                $stmt = $this->conn->prepare($sql);

                // Execute Query
                $stmt->execute(array(
                    ':user_id' => $this->user_id
                ));
                // Recieve Password from Database
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Comparing Password
                if ( $row['password'] === $this->password ) {
                    // Digging data from database after successfull login
                    $sql = 'SELECT p.name , p.email, p.gender from '.$this->person_table.' as p, student_data as s where p.person_id=s.person_id and s.nsu_id= :user_id ';

                    // Prepare Statement
                    $stmt = $this->conn->prepare($sql);
                    // Execute Query
                    $stmt->execute(array(
                        ':user_id' => $this->user_id
                    ));

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    $this->student_name = $row['name'];
                    $this->email = $row['email'];
                    $this->gender= $row['gender'];
                    $this->error_message = "No errors";
                    $this->message = true;
               }
                else {
                    $this->conn = null;
                    $this->error_message = "Password didn't match"; // character :21
                }
            }
        }

        public function login_teacher (){
            // Action Shuru ! khela hbe !
            // initializing haturi for preventing Injections
            $haturi = new Tools();
            //checking Injections
            if ( !$haturi->test_input($this->user_id) || !$haturi->test_input($this->password)){
                $this->conn = null;
                return $this->error_message = "HTML Injection Detected"; // Injection Detected ... Character: 23

            }else{
                // SQL
                $sql = 'SELECT password FROM '.$this->person_table.' where person_id=(SELECT person_id FROM '.$this->faculty_table.' where faculty_initial= :user_id )';

                // Prepare Statement
                $stmt = $this->conn->prepare($sql);

                // Execute Query
                $stmt->execute(array(
                    ':user_id' => $this->user_id
                ));
                // Recieve Password from Database
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Comparing Password
                if ( $row['password'] === $this->password ) {
                    // Digging data from database after successfull login
                    $sql = 'SELECT p.name , p.email, p.gender, f.faculty_id from '.$this->person_table.' as p, '.$this->faculty_table.' as f where p.person_id=f.person_id and f.faculty_initial= :user_id';

                    // Prepare Statement
                    $stmt = $this->conn->prepare($sql);
                    // Execute Query
                    $stmt->execute(array(
                        ':user_id' => $this->user_id
                    ));

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    $this->faculty_name = $row['name'];
                    $this->faculty_id = $row['faculty_id'];
                    $this->email = $row['email'];
                    $this->gender= $row['gender'];
                    $this->error_message = "No errors";
                    $this->message = true;
                }
                else {
                    $this->conn = null;
                    $this->error_message = "Password didn't match"; // character :21
                }
            }
        }
    }
?>