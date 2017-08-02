<?php 
$admin_option_defs = array();
$admin_option_defs['SQLFiddleAdmin'] = array(
	'SQL Fiddle', 'LBL_SQL_FIDDLE_ADMIN', 'LBL_SQL_FIDDLE_ADMIN_DESCRIPTION', './index.php?module=SQLFiddle&action=index'
	);

// Loop through the menus and add to the Users group
$tmp_menu_set = false;
foreach ($admin_group_header as $key => $values)
{
	print_r($values[0]);
	if ($values[0] == 'LBL_STUDIO_TITLE')
	{
		if ($sugar_config['sugar_version'] < 5.2)
			$admin_group_header[$key][3]['SQLFiddleAdmin'] = $admin_option_defs['SQLFiddleAdmin'];
		else
			$admin_group_header[$key][3]['Administration']['SQLFiddleAdmin'] = $admin_option_defs['SQLFiddleAdmin'];
		$tmp_menu_set = true;
	}
}

// Else create new group
if (!$tmp_menu_set)
	if ($sugar_config['sugar_version'] < 5.2)
		$admin_group_header[] = array('SQL_FIDDLE_ADMIN_TITLE','',false,$admin_option_defs,'SQL_FIDDLE_ADMIN_DESC');
	else
		$admin_group_header[] = array('SQL_FIDDLE_ADMIN_TITLE','',false,array('Administration' => $admin_option_defs),'SQL_FIDDLE_ADMIN_DESC');
?>
