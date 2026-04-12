<div id="page-footer">

	<div class="copyright">{CREDIT_LINE}
		<!-- IF DEBUG_OUTPUT --><br />{DEBUG_OUTPUT}<!-- ENDIF -->
	</div>
</div>


</body>
<!-- IF S_DATETIME_PICKER -->
<script type="text/javascript" language="javascript" src="{T_JS_PATH}jquery.js"></script>
<script src="{T_JS_PATH}jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="{T_JS_PATH}jquery.datetimepicker.css"/>
<script>
$('#startdatetime').datetimepicker();
$('#enddatetime').datetimepicker();
//$('#startdatetime').datetimepicker({value:'2015/04/15 05:03',step:10});
/*    
var logic = function( currentDateTime ){
    if( currentDateTime.getDay()==6 ){
	this.setOptions({
	minTime:'11:00'
    });
    }else
	this.setOptions({
	minTime:'8:00'
    });
};
*/
$('#pickstartdatetime').click(function(){
	$('#startdatetime').datetimepicker('show');
});
$('#pickenddatetime').click(function(){
	$('#enddatetime').datetimepicker('show');
});
</script>
<!-- ENDIF -->

</html>