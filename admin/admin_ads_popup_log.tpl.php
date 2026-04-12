<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>
<style type="text/css">
	.xls{
		background-color: #e9e9e9;
		background-image: -moz-linear-gradient(center top , #fff 0%, #e9e9e9 100%);
		border: 1px solid #999;
		border-radius: 2px;
		box-sizing: border-box;
		color: black;
		cursor: pointer;
		font-size: 0.88em;
		margin-right: 2px;
		padding: 0.5em 1em;
		position: absolute;
		top: 183px;
		right: 108px;
		z-index:1;
	}
	.xls a{
		text-decoration: none;
		color: #000;
	}
</style>

    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>
			<?php if ($this->_rootref['S_SUBSCRIBER_LOG']) {  ?>
			<!--<a href="<?php echo (isset($this->_rootref['U_LOG'])) ? $this->_rootref['U_LOG'] : ''; ?>">&raquo; View All Log</a><br/><br/>-->
			<?php } else { ?>
			<!--<a href="<?php echo (isset($this->_rootref['U_LOG'])) ? $this->_rootref['U_LOG'] : ''; ?>">&raquo; View Log Per Subscriber</a><br/><br/>-->
			<?php } ?>
			
			<span>Date: <input type="text" id="startdatetime3" class="datepicker" size="10" value="<?php echo (isset($this->_rootref['S_DATEFROM'])) ? $this->_rootref['S_DATEFROM'] : ''; ?>"> - <input type="text" id="enddatetime3" class="datepicker" size="10" value="<?php echo (isset($this->_rootref['S_DATEEND'])) ? $this->_rootref['S_DATEEND'] : ''; ?>">
			<!--<input class="button1" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />--></span>

			<?php if ($this->_rootref['S_SUBSCRIBER_LOG']) {  ?>
			<span class="xls" style="float: right;"><a href="#" onclick="exportXLS('pop_subs_log');">Export Detail  </a></span>
			<?php } else { ?>
			<span  class="xls" style="float: right;"><a href="#" onclick="alllog('pop_log');">Export Detail  </a></span>
			<?php } ?>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			
			    <div class="inner">
				<span class="corners-top2"></span>

			    <!--<fieldset class="display-options" style="float: left">
			  <?php echo ((isset($this->_rootref['L_SEARCH_KEYWORDS'])) ? $this->_rootref['L_SEARCH_KEYWORDS'] : ((isset($user->lang['SEARCH_KEYWORDS'])) ? $user->lang['SEARCH_KEYWORDS'] : '{ SEARCH_KEYWORDS }')); ?>: <input type="text" name="keywords" value="<?php echo (isset($this->_rootref['S_KEYWORDS'])) ? $this->_rootref['S_KEYWORDS'] : ''; ?>" />&nbsp;<input type="submit" class="button2" name="filter" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" />
			    </fieldset>-->

			<table cellspacing="1" class="table1" id="dtable3">
			<thead>
			<tr>
				<?php if ($this->_rootref['S_SUBSCRIBER_LOG']) {  ?><th><?php echo ((isset($this->_rootref['L_SUBSCRIBER_NAME'])) ? $this->_rootref['L_SUBSCRIBER_NAME'] : ((isset($user->lang['SUBSCRIBER_NAME'])) ? $user->lang['SUBSCRIBER_NAME'] : '{ SUBSCRIBER_NAME }')); ?></th><?php } ?>
				<th><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
				<th><?php echo ((isset($this->_rootref['L_TOTAL_VIEWED'])) ? $this->_rootref['L_TOTAL_VIEWED'] : ((isset($user->lang['TOTAL_VIEWED'])) ? $user->lang['TOTAL_VIEWED'] : '{ TOTAL_VIEWED }')); ?></th>
				<?php if ($this->_rootref['S_CLEAR_ALLOWED']) {  ?><th><?php echo ((isset($this->_rootref['L_MARK'])) ? $this->_rootref['L_MARK'] : ((isset($user->lang['MARK'])) ? $user->lang['MARK'] : '{ MARK }')); ?></th><?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_LOGS']) {  $_log_count = (isset($this->_tpldata['log'])) ? sizeof($this->_tpldata['log']) : 0;if ($_log_count) {for ($_log_i = 0; $_log_i < $_log_count; ++$_log_i){$_log_val = &$this->_tpldata['log'][$_log_i]; if (!($_log_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } if ($this->_rootref['S_SUBSCRIBER_LOG']) {  ?><td><?php echo $_log_val['SUBSCRIBER_NAME']; ?></td><?php } ?>
			    <td><?php echo $_log_val['NAME']; ?></td>
			    <td><?php echo $_log_val['TOTAL_WATCHED']; ?></td>
			    <?php if ($this->_rootref['S_CLEAR_ALLOWED']) {  ?><td style="width: 5%" align="center"><input type="checkbox" name="mark[]" value="<?php echo $_log_val['ID']; ?>" /></td><?php } ?>
			  </tr>
			<?php }} } else { ?>
			  <tr>
			    <td class="bg1" colspan="<?php if ($this->_rootref['S_CLEAR_ALLOWED']) {  ?>6<?php } else { ?>5<?php } ?>" align="center"><span class="gen"><?php echo ((isset($this->_rootref['L_NO_ENTRIES'])) ? $this->_rootref['L_NO_ENTRIES'] : ((isset($user->lang['NO_ENTRIES'])) ? $user->lang['NO_ENTRIES'] : '{ NO_ENTRIES }')); ?></span></td>
			  </tr>
			<?php } ?>
			</tbody>
			</table>
		
		<?php if ($this->_rootref['PAGINATION']) {  ?>
			<div class="pagination">
			    <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['S_ON_PAGE'])) ? $this->_rootref['S_ON_PAGE'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span>
			</div>
		<?php } ?>

			<!--<fieldset class="display-options">
			    <?php echo ((isset($this->_rootref['L_DISPLAY_LOG'])) ? $this->_rootref['L_DISPLAY_LOG'] : ((isset($user->lang['DISPLAY_LOG'])) ? $user->lang['DISPLAY_LOG'] : '{ DISPLAY_LOG }')); ?>: &nbsp;<?php echo (isset($this->_rootref['S_LIMIT_DAYS'])) ? $this->_rootref['S_LIMIT_DAYS'] : ''; ?>&nbsp;<?php echo ((isset($this->_rootref['L_SORT_BY'])) ? $this->_rootref['L_SORT_BY'] : ((isset($user->lang['SORT_BY'])) ? $user->lang['SORT_BY'] : '{ SORT_BY }')); ?>: <?php echo (isset($this->_rootref['S_SORT_KEY'])) ? $this->_rootref['S_SORT_KEY'] : ''; ?> <?php echo (isset($this->_rootref['S_SORT_DIR'])) ? $this->_rootref['S_SORT_DIR'] : ''; ?>
			    <input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" name="sort" />
			    <?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>
			</fieldset>-->
			<hr />

			</span></span></div>
  
			</form>

<br />


		    </div>
		 </div>
		 <input type="hidden" id="ads_type" value="<?php echo (isset($this->_rootref['S_TYPE'])) ? $this->_rootref['S_TYPE'] : ''; ?>" />
		 <input type="hidden" id="mode" value="<?php echo (isset($this->_rootref['S_MODE'])) ? $this->_rootref['S_MODE'] : ''; ?>" />
		 <span class="corners-bottom"><span></span></span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>
    <script type="text/javascript">

    		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10) {
		    dd='0'+dd
		} 

		if(mm<10) {
		    mm='0'+mm
		} 
		today = yyyy+'-'+mm+'-'+dd;
	function exportXLS(mode) {
		var start2 = $("#startdatetime3").val();
		var end2 = $("#enddatetime3").val();
				if(start2 == ''){
			start = '1970-01-01';
		}else{
			start = start2;
		}
		if(end2 == ''){
			end= today;
		}else{
			end = end2;
		}
	location.href = 'excel.php?mode=' + mode + '&start=' + start + '&end=' + end;
}

function alllog(mode) {
	var start2 = $("#startdatetime3").val();
		var end2 = $("#enddatetime3").val();
				if(start2 == ''){
			start = '1970-01-01';
		}else{
			start = start2;
		}
		if(end2 == ''){
			end= today;
		}else{
			end = end2;
		}
		// alert("data");
	location.href = 'excel.php?mode=' + mode + '&start=' + start + '&end=' + end;
}
</script>


<?php $this->_tpl_include('overall_footer.tpl'); ?>