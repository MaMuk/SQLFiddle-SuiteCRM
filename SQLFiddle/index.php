<?php

//initially
$comment = null;

require_once('get_db_details.php');

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
        <title>SQL Mode for CodeMirror</title>
        <link rel="stylesheet" href="plugin/codemirror/lib/codemirror.css" />
        <link rel="stylesheet" href="css/style.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="css/custom.css"> -->
    
        <script src="plugin/codemirror/lib/codemirror.js"></script>
        <script src="js/sql.js"></script>
        <style>
        	body, html {
			  width: 100%;
			  height: 95%;
			  margin: 0;
			}
			.row {				
			  width: 100%;
			  height: 100%;
			  margin: 0;	
			}

			.container-fluid {
			  width: 100%;
			  height: 100%;
			}

			.leftpane {
			    width: 25%;
			    height: 100%;
			    float: left;
			    border-collapse: collapse;
			}
			.rightpane {
			  width: 75%;
			  height: 100%;
			  position: relative;
			  float: right;
			  border-collapse: collapse;
			}
			#db_tree {
			    position: absolute;
			    top: 0;
			    bottom: 0;
			    margin: 0 0;
			    width: 100%;
			    max-width: 98%;
			    overflow: auto;
			    font: 10px Verdana, sans-serif;
			    box-shadow: 0 0 5px #ccc;
			    padding: 10px;
			    border-radius: 7px;
		    }
			.CodeMirror {
			    box-shadow: 0 0 5px #ccc;			    
    			border-radius: 7px;
			    height: 50vh;
			}
			#preview-comment {
				max-width: 100%;
			    overflow: auto;
			    font: 10px Verdana, sans-serif;
			    box-shadow: 0 0 5px #ccc;
			    padding: 10px;
			    border-radius: 7px;
                height: 35%;
			}
        </style>

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
        <h1>SQL Mode for CodeMirror</h1>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/jstree.min.js"></script>

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
