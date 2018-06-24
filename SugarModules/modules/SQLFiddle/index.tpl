<link rel="stylesheet" type="text/css" href="custom/include/SQLFiddle/plugin/codemirror/codemirror.css">
<link rel="stylesheet" type="text/css" href="custom/include/SQLFiddle/plugin/jstree/jstree.min.css">
<script src="custom/include/SQLFiddle/plugin/jstree/jstree.min.js"></script>
<link rel="stylesheet" type="text/css" href="custom/include/SQLFiddle/css/custom.css">
<script src="custom/include/SQLFiddle/plugin/codemirror/codemirror.js"></script>
<script src="custom/include/SQLFiddle/js/sql.js"></script>
<body onload="init();">
	<h1>SQL Fiddle</h1>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 leftpane">
				<div id="db_tree" class="demo">
				</div>
			</div>
			<div class="col-sm-9 rightpane">
				<div>
					<form>
						<textarea class="codemirror-textarea" id="code" name="code">{$QUERY}</textarea>
						<br>
						<input type="button" class="btn btn-default" name="preview-form-submit" id="preview-form-submit" value="Submit">
					</form>
				</div>
				<div id="preview-comment">
					{$QUERY}
				</div>
			</div>
		</div>
	</div>
	{literal}
	<script language="javascript">
		$('#db_tree').jstree({
           	'core' : {
				'data' : {
					'url' : 'text.json',
					'dataType' : 'json'
				}
			}
		});
		var init = function() {
			var mime = 'text/x-mysql';

			window.editor = CodeMirror.fromTextArea(document.getElementById('code'), {
				mode: mime,
				indentWithTabs: true, 
				smartIndent: true,
				lineNumbers: true,
				matchBrackets: true,
				autofocus: true
			});
		}
		$(document).ready(function(){
			$('#preview-form-submit').click(function(){
				$.post('index.php?entryPoint=GetDbDetails',
				{
					data:window.editor.getValue()
				},
				function(response,status){
					var JSONobj = $.parseJSON(response);
					$('#preview-comment').html('');
					if(JSONobj['error']) {
						$('#preview-comment').html('<p>'+JSONobj['error']+'</p>');
					} else {
						if(JSONobj['affected_count'] || JSONobj['affected_count'] == '0') {
							var text = '';
							if(JSONobj['affected_count'] > '1') {
								text = 's';
							}
							divStructure = '<p>Total '+ JSONobj['affected_count']+' record'+text+' affected.</p><br>';
						} else {
							var divStructure = '';
							if(JSONobj['count'].length != '') {
								divStructure = '<p>Total '+ JSONobj['count']+' records returned.</p><br>';
							}
							divStructure += '<table><tbody><thead><tr>'
							var result = JSONobj['result'];
							var tableHeaders = Object.keys(result[0]);

							var i=0;

							while (tableHeaders.length>i) {
								divStructure += '<th>' + tableHeaders[i] + '</th>';
								i++;
							}

							divStructure += '</tr></thead><tbody>';
					
							for (var key in result) {
								if (result.hasOwnProperty(key)) {
									var val = result[key];
									divStructure += '<tr>';
									for (var subkey in val) {
										divStructure += '<td>' + val[subkey] + '</td>';
									}
									divStructure += '</tr>';
								}
							}
							divStructure += '</tbody></table>';
						}
						$('#preview-comment').html(divStructure);
					}			    
				});
			});
		});
	</script>
	{/literal}
</body>