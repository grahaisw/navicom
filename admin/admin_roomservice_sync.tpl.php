<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>
<script type="text/javascript">
$(function() {
    $('#submit').click(function() {
        return confirm('<?php echo ((isset($this->_rootref['L_CONFIRM_SYNC'])) ? $this->_rootref['L_CONFIRM_SYNC'] : ((isset($user->lang['CONFIRM_SYNC'])) ? $user->lang['CONFIRM_SYNC'] : '{ CONFIRM_SYNC }')); ?>');
    });
});

</script>

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			    <div class="inner"><span class="corners-top2"><span></span></span>
				<div id="hotel-info">
				    
				</div>
				<br/>
				<div id="pms-info">
				    <form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
					<input class="button1" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />
				    </form>
				</div>

			<hr />

			    </div>
  
			<br />


		    </div>
		 </div>

		 <span class="corners-bottom"><span></span></span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>