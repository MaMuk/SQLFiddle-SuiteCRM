<?php
    
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    if(isset($_POST['data']) && !empty($_POST["data"]))
    {
        global $db;

        $sql = $_POST["data"];

        $execute = $db->query($sql);
        $final = array();

        while($row = $db->fetchByAssoc($execute)) {
            //$GLOBALS['log']->fatal("Result: " .print_r($row, true));            
            array_push($final, $row);
        }

        print_r(json_encode($final));
    }

    function set_db_tree() {

	    global $db, $sugar_config;

        $dbname = $sugar_config['dbconfig']['db_name'];

        $post_data = array('id' => $dbname,'text' => $dbname, 'children' => array());
        
        //echo "Connected successfully";

        $sql = "SHOW tables";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $db->fetchByAssoc($result)) {
                
                array_push($post_data['children'], array("id" => $row['Tables_in_' .$dbname], "text" => $row['Tables_in_' .$dbname], "children" => array()));
               
                
                $sql1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$dbname."' AND TABLE_NAME = '".$row['Tables_in_' .$dbname]."'";
                $result1 = $db->query($sql1);

                while($row1 = $db->fetchByAssoc($result1)) {
                    
                    array_push($post_data['children'][$i]['children'], array("id" => $row1['COLUMN_NAME'], "text" => $row1['COLUMN_NAME']));
                }
                $i++;
            }
        } else {
            echo "No result found";
        }

        $myfile = fopen("text.json", "w") or die("Unable to open file!");
        fwrite($myfile, json_encode($post_data));
        fclose($myfile);

    }
?>

