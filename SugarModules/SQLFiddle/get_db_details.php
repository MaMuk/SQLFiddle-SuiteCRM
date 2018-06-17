<?php
    
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    ini_set("error_reporting", 0);

    if(isset($_POST['data']) && !empty($_POST["data"]))
    {
        global $db;

        $sql = mb_convert_encoding($_POST["data"], "UTF-8", "HTML-ENTITIES");

        $execute = $db->query($sql);

	$error = $db->lastDbError();
	$result = array();

        if($error) {
            $result['error'] = $error;
        } else {
            $final = array();
            $row_count = $db->getRowCount($execute);
            if($row_count) {
                while($row = $db->fetchByAssoc($execute)) {
                    array_push($final, $row);
                }

                $result['count'] = $row_count;
                if(count($final) > 0) {
                    $result['result'] = $final;            
                }
            } else {
                $affected_row_count = $db->getAffectedRowCount($execute);
                $result['affected_count'] = $affected_row_count;
            }
        }
        print_r(json_encode($result));
    }

    function set_db_tree() {

	global $db, $sugar_config;

        $dbname = $sugar_config['dbconfig']['db_name'];

        $post_data = array('id' => $dbname,'text' => $dbname, 'children' => array());
        
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

