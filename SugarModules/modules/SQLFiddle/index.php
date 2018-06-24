<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not a valid entry point');

$query = null;

require_once('custom/include/SQLFiddle/get_db_details.php');

set_db_tree();

if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['code'])) {
    $query = $_POST['code'];
}

$sugar_smarty = new Sugar_Smarty();

$sugar_smarty->assign("QUERY", $query);
	
echo $sugar_smarty->display('modules/SQLFiddle/index.tpl');