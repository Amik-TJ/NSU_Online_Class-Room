<?php
    class Tools {

        // Testing Injections
        function test_input($data){
            // It will return true if valid
            // Putting data in a temporary var to to check injection
            // $hold_on = Original Value
            $hold_on = $data;
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return strcmp($hold_on, $data)? false : true ; // if equal, strcmp will return 0 .
        }
    }
?>