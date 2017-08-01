<?php

    function set_db_tree() {

        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "sugarcrm";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $post_data = array('id' => $dbname,'text' => $dbname, 'children' => array());
        
        //echo "Connected successfully";

        $sql = "SHOW tables";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_assoc()) {
                
                array_push($post_data['children'], array("id" => $row['Tables_in_sugarcrm'], "text" => $row['Tables_in_sugarcrm'], "children" => array()));
               
                
                $sql1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$dbname."' AND TABLE_NAME = '".$row['Tables_in_sugarcrm']."'";
                $result1 = $conn->query($sql1);

                while($row1 = $result1->fetch_assoc()) {
                    
                    array_push($post_data['children'][$i]['children'], array("id" => $row1['COLUMN_NAME'], "text" => $row1['COLUMN_NAME']));
                }
                $i++;
            }
        } else {
            echo "0 results";
        }

        $myfile = fopen("text.json", "w") or die("Unable to open file!");
        fwrite($myfile, json_encode($post_data));
        fclose($myfile);

        $conn->close();
    }
?>