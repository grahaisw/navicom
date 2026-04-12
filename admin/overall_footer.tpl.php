<?php if (!defined('IN_TONJAW')) exit; ?><div id="page-footer">

	<div class="copyright"><?php echo (isset($this->_rootref['CREDIT_LINE'])) ? $this->_rootref['CREDIT_LINE'] : ''; ?>

		<?php if ($this->_rootref['DEBUG_OUTPUT']) {  ?><br /><?php echo (isset($this->_rootref['DEBUG_OUTPUT'])) ? $this->_rootref['DEBUG_OUTPUT'] : ''; } ?>

	</div>
</div>


</body>
<?php if ($this->_rootref['S_DATETIME_PICKER']) {  ?>

<script type="text/javascript" language="javascript" src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js"></script>
<script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.datetimepicker.css"/>
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
<?php } ?>


</html>