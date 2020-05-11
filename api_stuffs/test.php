<?php
    class Test {
        private $conn;
        private $person_table = "person";
        private $class_table = "class";
        private $enroll_student_table = "enroll_student";
        private $faculty_data_table = "faculty_data";

        public $sql = "SELECT c.class_id, c.course_id, c.course_title, c.section, c.time, c.room_no, p.name as faculty_name FROM $this->class_table as c, enroll_student as e, person as p, faculty_data as f, take_class as t WHERE t.class_id=c.class_id and t.faculty_id=f.faculty_iD and f.person_id=p.person_id and e.class_id=c.class_id and e.nsu_id=1722231042";


    }

?>