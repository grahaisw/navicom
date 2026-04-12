<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>


		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">

			<span class="corners-top2"><span>
		<?php if ($this->_rootref['S_FORM']) {  ?>

			<span class="navigation"><label><?php echo ((isset($this->_rootref['L_LABEL'])) ? $this->_rootref['L_LABEL'] : ((isset($user->lang['LABEL'])) ? $user->lang['LABEL'] : '{ LABEL }')); ?></label></span></br>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td width="85%"><input name="name" type="text" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" size="60"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_URL_UDP'])) ? $this->_rootref['L_URL_UDP'] : ((isset($user->lang['URL_UDP'])) ? $user->lang['URL_UDP'] : '{ URL_UDP }')); ?>:</label></td>
			    <td><input name="url_udp" type="text" value="<?php echo (isset($this->_rootref['S_URL_UDP'])) ? $this->_rootref['S_URL_UDP'] : ''; ?>" size="60"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_URL_HTTP'])) ? $this->_rootref['L_URL_HTTP'] : ((isset($user->lang['URL_HTTP'])) ? $user->lang['URL_HTTP'] : '{ URL_HTTP }')); ?>:</label></td>
			    <td><input name="url_http" type="text" value="<?php echo (isset($this->_rootref['S_URL_HTTP'])) ? $this->_rootref['S_URL_HTTP'] : ''; ?>" size="60"/></td>
			</tr>
			<?php if ($this->_rootref['THUMBNAIL_FILE']) {  ?>

			<tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_THUMBNAIL_FILE'])) ? $this->_rootref['S_THUMBNAIL_FILE'] : ''; ?>" alt="<?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>" height="50"></td>
			</tr>
			<?php } ?>

			<tr>
			    <td><label for="thumbnail"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail" value="<?php echo (isset($this->_rootref['S_THUMBNAIL'])) ? $this->_rootref['S_THUMBNAIL'] : ''; ?>" size="50" /></td>
			</tr>
			<tr>
			    <td><label for="group"><?php echo ((isset($this->_rootref['L_GROUPNAME'])) ? $this->_rootref['L_GROUPNAME'] : ((isset($user->lang['GROUPNAME'])) ? $user->lang['GROUPNAME'] : '{ GROUPNAME }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_GROUPNAME'])) ? $this->_rootref['S_GROUPNAME'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_ORDER'])) ? $this->_rootref['L_ORDER'] : ((isset($user->lang['ORDER'])) ? $user->lang['ORDER'] : '{ ORDER }')); ?>:</label></td>
			    <td><input name="order" type="text" value="<?php echo (isset($this->_rootref['S_ORDER'])) ? $this->_rootref['S_ORDER'] : ''; ?>" maxlength="3" size="5"/></td>
			</tr>
			<tr>
			    <td><label for="allow_ads"><?php echo ((isset($this->_rootref['L_ALLOW_ADS'])) ? $this->_rootref['L_ALLOW_ADS'] : ((isset($user->lang['ALLOW_ADS'])) ? $user->lang['ALLOW_ADS'] : '{ ALLOW_ADS }')); ?>:</label></td>
			    <td><input id="allow_ads" name="allow_ads_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ALLOW_ADS'])) ? $this->_rootref['S_ALLOW_ADS'] : ''; ?>/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?>/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
			    <td><p class="submit-buttons">
			    <input class="button1" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;
				</p><?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?></td>
			</tr>

			</table>
			<hr />
			
			</form>
		<?php } if ($this->_rootref['S_DETAIL']) {  if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <span class="navigation"><a href="<?php echo (isset($this->_rootref['U_EDIT'])) ? $this->_rootref['U_EDIT'] : ''; ?>" rel="facebox"><img src="<?php echo (isset($this->_rootref['ICON_PATH'])) ? $this->_rootref['ICON_PATH'] : ''; ?>/edit.png" alt="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" title="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" width="20" /><?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?></a></span></br>
			<?php } ?>

			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td width="85%"><strong><?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?></strong></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_URL_UDP'])) ? $this->_rootref['L_URL_UDP'] : ((isset($user->lang['URL_UDP'])) ? $user->lang['URL_UDP'] : '{ URL_UDP }')); ?>:</label></td>
			    <td><video width="300" autoplay><source src="<?php echo (isset($this->_rootref['S_URL_UDP'])) ? $this->_rootref['S_URL_UDP'] : ''; ?>"></video></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_URL_HTTP'])) ? $this->_rootref['L_URL_HTTP'] : ((isset($user->lang['URL_HTTP'])) ? $user->lang['URL_HTTP'] : '{ URL_HTTP }')); ?>:</label></td>
			    <td><video width="300" autoplay><source src="<?php echo (isset($this->_rootref['S_URL_HTTP'])) ? $this->_rootref['S_URL_HTTP'] : ''; ?>"></video></td>
			</tr>
			<?php if ($this->_rootref['THUMBNAIL_FILE']) {  ?>

			<tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_THUMBNAIL_FILE'])) ? $this->_rootref['S_THUMBNAIL_FILE'] : ''; ?>" ></td>
			</tr>
			<?php } ?>

			<tr>
			    <td><label for="thumbnail"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_THUMBNAIL'])) ? $this->_rootref['S_THUMBNAIL'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="group"><?php echo ((isset($this->_rootref['L_GROUPNAME'])) ? $this->_rootref['L_GROUPNAME'] : ((isset($user->lang['GROUPNAME'])) ? $user->lang['GROUPNAME'] : '{ GROUPNAME }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_GROUPNAME'])) ? $this->_rootref['S_GROUPNAME'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_ORDER'])) ? $this->_rootref['L_ORDER'] : ((isset($user->lang['ORDER'])) ? $user->lang['ORDER'] : '{ ORDER }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ORDER'])) ? $this->_rootref['S_ORDER'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="allow_ads"><?php echo ((isset($this->_rootref['L_ALLOW_ADS'])) ? $this->_rootref['L_ALLOW_ADS'] : ((isset($user->lang['ALLOW_ADS'])) ? $user->lang['ALLOW_ADS'] : '{ ALLOW_ADS }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ALLOW_ADS'])) ? $this->_rootref['S_ALLOW_ADS'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?></td>
			</tr>

			</table>
			<hr />
		<?php } ?>

			</div>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>