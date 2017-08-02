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
    'acceptable_sugar_flavors' => array(
        'CE',
        'CORP',
        'PRO',
        'ENT'
    ),
    'acceptable_sugar_versions' => array(
        '6.*.*',
        '7.*.*'
    ),
    'is_uninstallable' => true,
    'remove_tables' => 'prompt',
    'name' => 'SQL Fiddle',
    'author' => 'Sohan U. S. Tirpude',
    'description' => 'SQL Fiddle for SugarCRM',
    'published_date' => '2017/08/01',
    'version' => 'v1.0',
    'type' => 'module'
);

$installdefs = array(
    'id' => 'SQLFiddle',
    //'image_dir' => '<basepath>/images',
    'beans' => array(
        array(
            'module' => 'SQLFiddle',
            'class' => 'SQLFiddle',
            'path' => 'modules/SQLFiddle/SQLFiddle.php',
            'tab' => true,
        )
    ),
    'language' => array(
        array(
            'from' => '<basepath>/language/en_us.SQLFiddle.php',
            'to_module' => 'application',
            'language' => 'en_us'
        )
    ),
    'copy' => array(
        array(
            'from' => '<basepath>/modules/SQLFiddle',
            'to' => 'modules/SQLFiddle',
        )
    )
);
