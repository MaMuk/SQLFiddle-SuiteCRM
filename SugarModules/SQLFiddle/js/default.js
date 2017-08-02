$(document).ready(function(){
	//code here...
	var code = $(".codemirror-textarea")[0];
	var editor = CodeMirror.fromTextArea(code, {
		mode: 'text/x-mysql',
		indentWithTabs: true,
		smartIndent: true,
		lineNumbers: true,
		matchBrackets : true,
		autofocus: true
	});

	//when form submitted
	$("#preview-form").submit(function(e){
		var value = editor.getValue();
		if(value.length == 0) {
			alert("Missing comment!");
		}
	});
});