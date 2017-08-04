<?php
    
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    $GLOBALS['log']->fatal("POST DATA: " .print_r($_POST, true));

    if($_POST["data"])
    {
        global $db;

        $sql = $_POST["data"];

        $execute = $db->query($sql);
        $final = array();

        while($row = $db->fetchByAssoc($execute)) {          
            array_push($final, $row);
        }

        print_r(json_encode($final));
    }

    function set_db_tree() {

        global $db;

        $post_data = array('id' => $dbname,'text' => $dbname, 'children' => array());
        

        $sql = "SHOW tables";
        $result = $db->query($sql);

        if ($db->getRowCount($result) > 0) {
            // output data of each row
            $i = 0;
            while($row = $db->fetchByAssoc($result)) {
                
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

    }
?>
