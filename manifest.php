<?php
/* * *******************************************************************************
* This file is part of KReporter. KReporter is an enhancement developed
* by aac services k.s.. All rights are (c) 2016 by aac services k.s.
*
* This Version of the KReporter is licensed software and may only be used in
* alignment with the License Agreement received with this Software.
* This Software is copyrighted and may not be further distributed without
* witten consent of aac services k.s.
*
* You can contact us at info@kreporter.org
******************************************************************************* */
$manifest = array(
    'acceptable_sugar_versions' => array (
	'regex_matches' => array (
    	   0 => "6\\.5\\.*",
	   1 => "6\\.6\\.*",
	   2 => "6\\.7\\.*",
	),
    ),
    'acceptable_sugar_flavors' =>
     array(
  	'CE',
        'CORP',
        'PRO',
        'ENT'
     ),
    'latest_supported_version' => '6.5.24',
    'readme'=>'README.md',
    'key'=>'sqlfiddle',
    'author' => 'Sohan U. S. Tirpude',
    'description' => 'SQL Fiddle for CRM',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'SQL Fiddle',
    'published_date' => '2017-08-08 00:00:01',
    'type' => 'module',
    'version' => '1.0.0',
    'remove_tables' => '',
);

$installdefs = array(
    'id' => 'SQLFiddle',
    'beans' => array(
        0 =>
        array(
            'module' => 'SQLFiddle',
            'class' => 'SQLFiddle',
            'path' => 'modules/SQLFiddle/SQLFiddle.php',
            'tab' => true,
        )
    ),
    'administration' => array (
        0 => 
        array (
            'from' => '<basepath>/administration/SQLFiddleAdmin.menu.php',
        ),
    ),
    'language' => array(
        0 =>
        array(
            'from' => '<basepath>/language/en_us.SQLFiddle.php',
            'to_module'=> 'Administration',
	    'language'=>'en_us'
        ),
        1 =>
        array(
            'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
            'to_module'=> 'application',
            'language'=>'en_us'
        ),
    ),
    'copy' => array(
        0 =>
        array(
            'from' => '<basepath>/SugarModules/modules/SQLFiddle',
            'to' => 'modules/SQLFiddle',
        ),
	1 =>
	array(
	    'from' => '<basepath>/SugarModules/SQLFiddle',
	    'to' => 'custom/include/SQLFiddle',
	),
    ),
    'entrypoints' => array (
        array (
            'from' => '<basepath>/SugarModules/EntryPointRegistry/SQLFiddleEntryPoint_registry.php',
            'to_module' => 'application',
        ),
    ),
);
