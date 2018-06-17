<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not a valid entry point');

global $sugar_config;

switch ($sugar_config['dbconfig']['db_type']) {
    case 'mysql':
        $db_type = "text/x-mysql";
        break;

    case 'mssql':
        $db_type = "text/x-mssql";
        break;

    default:
        $db_type = "text/x-mysql";
        break;
}

$comment = null;

require_once('custom/include/SQLFiddle/get_db_details.php');

set_db_tree();

if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['code'])) {
    $comment = $_POST['code'];
}

$sugar_smarty = new Sugar_Smarty();

$sugar_smarty->assign("DBTYPE", $db_type);

$sugar_smarty->assign("QUERY", $comment);
    
echo '<link rel="stylesheet" type="text/css" href="custom/include/SQLFiddle/plugin/codemirror/codemirror.css">';

echo '<link rel="stylesheet" type="text/css" href="custom/include/SQLFiddle/plugin/jstree/jstree.min.css">';

echo '<script src="custom/include/SQLFiddle/plugin/jstree/jstree.min.js"></script>';

echo '<link rel="stylesheet" type="text/css" href="custom/include/SQLFiddle/css/custom.css">';

echo '<script src="custom/include/SQLFiddle/plugin/codemirror/codemirror.js"></script>';

echo '<script src="custom/include/SQLFiddle/js/sql.js"></script>';

$editor = "<script>
           var init = function() {
                var mime = '$db_type';

                window.editor = CodeMirror.fromTextArea(document.getElementById('code'), {
                    mode: mime,
                    indentWithTabs: true, 
                    smartIndent: true,
                    lineNumbers: true,
                    matchBrackets: true,
                    autofocus: true
                });
            }
            </script>";

$sugar_smarty->assign("EDITOR", $editor);

$jstree = "<script>                                                                        
           $('#db_tree').jstree({
                'core' : {
		    'data' : {                                                                                              
		        'url' : 'text.json',
                        'dataType' : 'json'                                                  
		    }
		}
           });
           </script>";

$sugar_smarty->assign("JSTREE", $jstree);

$show_table = "<script>
                $(document).ready(function(){
                    $('#preview-form-submit').click(function(){
                        $.post('index.php?entryPoint=GetDbDetails',
                        {
                            data:window.editor.getValue()
                        },
			function(response,status){ // Required Callback Function
 			    var JSONobj = $.parseJSON(response);
                    	    $("#preview-comment").html('');
                            if(JSONobj['error']) {
                                $("#preview-comment").html("<p>"+JSONobj['error']+"</p>");
                    	    } else {
                        	if(JSONobj['affected_count']) {
                                    var text = '';
                            	    if(JSONobj['affected_count'] > '1') {
                                        text = 's';
                                    }
                                    divStructure = "<p>Total "+ JSONobj['affected_count']+" record"+text+" affected.</p><br>";
                        	} else {
                            	    var divStructure = '';
                            	    if(JSONobj['count'].length != '') {
                            	        divStructure = "<p>Total "+ JSONobj['count']+" records returned.</p><br>";
                            	    }
                            	    divStructure += "<table><tbody><thead><tr>"
                            	    var result = JSONobj['result'];
                                    var tableHeaders = Object.keys(result[0]);

                            	    var i=0;

                            	    while (tableHeaders.length>i) {
                                	divStructure += "<th>" + tableHeaders[i] + "</th>";
                                	i++;
                            	    }

	                            divStructure += "</tr></thead><tbody>";
                            
           	                    for (var key in result) {
                                	if (result.hasOwnProperty(key)) {
                                    	    var val = result[key];
                                    	    divStructure += "<tr>";
                                    	    for (var subkey in val) {
                                        	divStructure += "<td>" + val[subkey] + "</td>";
                                    	    }
                                    	    divStructure += "</tr>";
                                	}
                            	    }
                            	    divStructure += "</tbody></table>";
                        	}
                        	$("#preview-comment").html(divStructure);
                   	    }			    
			});
                    });
                });
</script>";

$sugar_smarty->assign('DATATABLE', $show_table);

if(file_exists('custom/modules/SQLFiddle/index.tpl')) {
    echo $sugar_smarty->display('custom/modules/SQLFiddle/index.tpl');
} else {
    echo $sugar_smarty->display('modules/SQLFiddle/index.tpl');
}


