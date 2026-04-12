<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			    <div class="inner"><span class="corners-top2"><span></span></span>
				<div id="hotel-info">
				    <h2><?php echo (isset($this->_rootref['S_HOTEL_NAME'])) ? $this->_rootref['S_HOTEL_NAME'] : ''; ?></h2>
				    <p><?php echo (isset($this->_rootref['S_HOTEL_ADDRESS'])) ? $this->_rootref['S_HOTEL_ADDRESS'] : ''; ?></p>
				    <p><?php echo ((isset($this->_rootref['L_HOTEL_PHONE'])) ? $this->_rootref['L_HOTEL_PHONE'] : ((isset($user->lang['HOTEL_PHONE'])) ? $user->lang['HOTEL_PHONE'] : '{ HOTEL_PHONE }')); ?>: <?php echo (isset($this->_rootref['S_HOTEL_PHONE'])) ? $this->_rootref['S_HOTEL_PHONE'] : ''; ?>. <?php echo ((isset($this->_rootref['L_HOTEL_FAX'])) ? $this->_rootref['L_HOTEL_FAX'] : ((isset($user->lang['HOTEL_FAX'])) ? $user->lang['HOTEL_FAX'] : '{ HOTEL_FAX }')); ?>: <?php echo (isset($this->_rootref['S_HOTEL_FAX'])) ? $this->_rootref['S_HOTEL_FAX'] : ''; ?></p>
				    <p><?php echo ((isset($this->_rootref['L_HOTEL_EMAIL'])) ? $this->_rootref['L_HOTEL_EMAIL'] : ((isset($user->lang['HOTEL_EMAIL'])) ? $user->lang['HOTEL_EMAIL'] : '{ HOTEL_EMAIL }')); ?>: <?php echo (isset($this->_rootref['S_HOTEL_EMAIL'])) ? $this->_rootref['S_HOTEL_EMAIL'] : ''; ?></p>
				</div>
				<br/>
				<div id="pms-info">
				    <h2><?php echo (isset($this->_rootref['S_PMS_NAME'])) ? $this->_rootref['S_PMS_NAME'] : ''; ?></h2>
				    <p><?php echo ((isset($this->_rootref['L_PMS_VERSION'])) ? $this->_rootref['L_PMS_VERSION'] : ((isset($user->lang['PMS_VERSION'])) ? $user->lang['PMS_VERSION'] : '{ PMS_VERSION }')); ?>: <?php echo (isset($this->_rootref['S_PMS_VERSION'])) ? $this->_rootref['S_PMS_VERSION'] : ''; ?></p>
				    <p><?php echo ((isset($this->_rootref['L_PMS_VENDOR'])) ? $this->_rootref['L_PMS_VENDOR'] : ((isset($user->lang['PMS_VENDOR'])) ? $user->lang['PMS_VENDOR'] : '{ PMS_VENDOR }')); ?>: <?php echo (isset($this->_rootref['S_PMS_VENDOR'])) ? $this->_rootref['S_PMS_VENDOR'] : ''; ?></p>
				    <p><?php echo ((isset($this->_rootref['L_PMS_WEBSITE'])) ? $this->_rootref['L_PMS_WEBSITE'] : ((isset($user->lang['PMS_WEBSITE'])) ? $user->lang['PMS_WEBSITE'] : '{ PMS_WEBSITE }')); ?>: <?php echo (isset($this->_rootref['S_PMS_WEBSITE'])) ? $this->_rootref['S_PMS_WEBSITE'] : ''; ?></p>
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