{$EDITOR}

<body onload="init();">                                                                                                                                                                                     
    <h1>SQL Fiddle</h1>                                                                                                                                                                                     
        <div class="container-fluid">                                                                                                                                                                           
            <div class="row">                                                                                                                                                                                                   <div class="col-sm-3 leftpane">                                                                                                                                                                                      <div id="db_tree" class="demo"></div>  
                </div>
                <div class="col-sm-9 rightpane"><div>
                <form>                                                                                                                                                                                                              <textarea class="codemirror-textarea" id="code" name="code">{$QUERY}</textarea>
                    <br>
                    <input type="button" class="btn btn-default" name="preview-form-submit" id="preview-form-submit" value="Submit">
                </form>
           </div>                                                                                                                                                                                              
           <div id="preview-comment">{$QUERY}</div>                                                                                                                                                      </div>
</body>
{$JSTREE}
{$DATATABLE}
