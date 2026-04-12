<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_USER_ACTION'])) ? $this->_rootref['U_USER_ACTION'] : ''; ?>">
			    <div class="inner">
			    <strong><?php echo ((isset($this->_rootref['L_USER'])) ? $this->_rootref['L_USER'] : ((isset($user->lang['USER'])) ? $user->lang['USER'] : '{ USER }')); ?></strong>
			    <span class="corners-top2"><span>

			    <fieldset class="display-options">
				<?php echo (isset($this->_rootref['S_USER'])) ? $this->_rootref['S_USER'] : ''; ?>

				<input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" name="submit" />
				<?php echo (isset($this->_rootref['S_FORM_USER'])) ? $this->_rootref['S_FORM_USER'] : ''; ?>

			    </fieldset>

			    </div>
			</form>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_MODULE_ACTION'])) ? $this->_rootref['U_MODULE_ACTION'] : ''; ?>">
			    <div class="inner">
			    <strong><?php echo ((isset($this->_rootref['L_MODULE'])) ? $this->_rootref['L_MODULE'] : ((isset($user->lang['MODULE'])) ? $user->lang['MODULE'] : '{ MODULE }')); ?></strong>
			    <span class="corners-top2"><span>

			    <fieldset class="display-options">
				<?php echo (isset($this->_rootref['S_MODULE'])) ? $this->_rootref['S_MODULE'] : ''; ?>

				<input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" name="submit" />
				<?php echo (isset($this->_rootref['S_FORM_MODULE'])) ? $this->_rootref['S_FORM_MODULE'] : ''; ?>

			    </fieldset>
			    <hr />

			    </div>
			</form>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>