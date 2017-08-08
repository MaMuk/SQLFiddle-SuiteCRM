<?php

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

//if the form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['code'])) {
	$comment = $_POST['code'];
}

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SQL Fiddle</title>
        <link rel="stylesheet" href="custom/include/SQLFiddle/plugin/codemirror/codemirror.css" />
        <link rel="stylesheet" href="custom/include/SQLFiddle/plugin/jstree/jstree.min.css" />
        <link rel="stylesheet" href="custom/include/SQLFiddle/css/custom.css" />
        <script src="custom/include/SQLFiddle/plugin/codemirror/codemirror.js"></script>
        <script src="custom/include/SQLFiddle/js/sql.js"></script>
        <script>
	    var init = function() {
	        var mime = "<?php echo $db_type ?>";
			    
	        window.editor = CodeMirror.fromTextArea(document.getElementById('code'), {
	            mode: mime,
	            indentWithTabs: true,
	            smartIndent: true,
	            lineNumbers: true,
   	            matchBrackets : true,
	            autofocus: true
	        });
	    };
        </script>
    </head>
    <body onload="init();">
        <h1>SQL Fiddle</h1>
        <div class="container-fluid">
        <div class="row">
        <div class="col-sm-3 leftpane">
        	<div id="db_tree" class="demo"></div>
        </div>
        <div class="col-sm-9 rightpane">
        	<div>
	        <form>
	            <textarea class="codemirror-textarea" id="code" name="code"><?php echo $comment; ?></textarea>
	            <br>
	            <input type="button" class="btn btn-default" name="preview-form-submit" id="preview-form-submit" value="Submit">
	        </form>
	        </div>
        <div id="preview-comment"><?php echo $comment; ?></div>
        </div></div></div>
    </body>

    <script src="custom/include/SQLFiddle/plugin/jstree/jstree.min.js"></script>

    <script>

        $('#db_tree').jstree({
            'core' : {
                'data' : {
                    "url" : "text.json",
                    "dataType" : "json" 
                }
            }
        });

        $(document).ready(function(){
    	    $("#preview-form-submit").click(function(){
                $.post("index.php?entryPoint=GetDbDetails", //Required URL of the page on server
                { // Data Sending With Request To Server
                    data:window.editor.getValue()
                },
                function(response,status){ // Required Callback Function
                    
                    var JSONobj = $.parseJSON(response);

                    var divStructure = "<table><tbody><thead><tr>"

                    var tableHeaders = Object.keys(JSONobj[0]);

                    var i=0;

                    while (tableHeaders.length>i) {
                        //console.log(tableHeaders[i]);
                        divStructure += "<th>" + tableHeaders[i] + "</th>";
                        i++;
                    }

                    divStructure += "</tr></thead><tbody>";
                    
                    for (var key in JSONobj) {
                        if (JSONobj.hasOwnProperty(key)) {
                            var val = JSONobj[key];
                            divStructure += "<tr>";
                            for (var subkey in val) {
                                //console.log(subkey + " : " + val[subkey]);
                                divStructure += "<td>" + val[subkey] + "</td>";
                            }
                            divStructure += "</tr>";
                        }
                    }
                    divStructure += "</tbody></table>";

                    $("#preview-comment").html(divStructure);
                });
	        });
	    });
    </script>
</html>

