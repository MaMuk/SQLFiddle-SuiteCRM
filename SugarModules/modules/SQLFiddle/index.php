<?php

//initially
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
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="custom/include/SQLFiddle/css/custom.css" />
        <script src="custom/include/SQLFiddle/plugin/codemirror/codemirror.js"></script>
        <script src="custom/include/SQLFiddle/js/sql.js"></script>

        <script>
	    var init = function() {
	        var mime = 'text/x-mariadb';
			    
	        // get mime type
	        if (window.location.href.indexOf('mime=') > -1) {
	            mime = window.location.href.substr(window.location.href.indexOf('mime=') + 5);
	        }
			    
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
        	<div style="height: 65%">
	        <form id="preview-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	            <textarea class="codemirror-textarea" id="code" name="code"><?php echo $comment; ?></textarea>
	            <br>
	            <input type="submit" class="btn btn-default" name="preview-form-submit" id="preview-form-submit" value="Submit">
	        </form>
	        </div>
        <div id="preview-comment"><?php echo $comment; ?></div>
        </div></div></div>
    </body>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
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
    </script>
</html>
