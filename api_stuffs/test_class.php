<?php

         $person_table = "person";
         $class_table = "class";
         $enroll_student_table = "enroll_student";
         $faculty_data_table = "faculty_data";

        $sql = "SELECT c.class_id, c.course_id, c.course_title, c.section, c.time, c.room_no  FROM class as c, take_class as t WHERE t.class_id=c.class_id and t.faculty_id=1720000111";

        echo "<pre>\n";
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=nsu_online_classroom',
            'root', '');

        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($rows);

        echo "</pre>\n";




        $classroom_api = array(
            'token' => 1,
            'success' => 'Enter Classroom',
            'user_id' => 1721277042
        );
        echo json_encode($classroom_api);

?>