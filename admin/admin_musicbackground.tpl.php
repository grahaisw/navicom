<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

<!-- <script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('<?php echo ((isset($this->_rootref['L_CONFIRM_DELETE'])) ? $this->_rootref['L_CONFIRM_DELETE'] : ((isset($user->lang['CONFIRM_DELETE'])) ? $user->lang['CONFIRM_DELETE'] : '{ CONFIRM_DELETE }')); ?>');
    });
});

</script> -->
	<style type="text/css">
		.hilang{
			display: none;;
		}
	</style>
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>
			<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <span class="navigation"><a href="<?php echo (isset($this->_rootref['U_ADD'])) ? $this->_rootref['U_ADD'] : ''; ?>" rel="facebox"><img src="<?php echo (isset($this->_rootref['ICON_PATH'])) ? $this->_rootref['ICON_PATH'] : ''; ?>/add.png" alt="<?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?>" title="<?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?>" width="20" /><?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?></a></span>
			<?php } ?>


			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			    <div class="inner">

			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th width="60"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?></th>
			  <th class="hilang"><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
			  <th class="hilang"><?php echo ((isset($this->_rootref['L_GROUP'])) ? $this->_rootref['L_GROUP'] : ((isset($user->lang['GROUP'])) ? $user->lang['GROUP'] : '{ GROUP }')); ?></th>
			  <th class="hilang"><?php echo ((isset($this->_rootref['L_ALLOW_ADS'])) ? $this->_rootref['L_ALLOW_ADS'] : ((isset($user->lang['ALLOW_ADS'])) ? $user->lang['ALLOW_ADS'] : '{ ALLOW_ADS }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></th>
			  <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>

			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_MUSIC']) {  $_music_count = (isset($this->_tpldata['music'])) ? sizeof($this->_tpldata['music']) : 0;if ($_music_count) {for ($_music_i = 0; $_music_i < $_music_count; ++$_music_i){$_music_val = &$this->_tpldata['music'][$_music_i]; if (!($_music_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><a href="<?php echo $_music_val['U_NAME']; ?>"><img src="<?php echo $_music_val['THUMBNAIL_PATH']; ?>160x235/<?php echo $_music_val['THUMBNAIL']; ?>" alt="<?php echo $_music_val['NAME']; ?>" width="60"></a></td>
			    <td class="hilang"><strong><a href="<?php echo $_music_val['U_NAME']; ?>"><?php echo $_music_val['NAME']; ?></a></strong>
				<br/><?php echo $_music_val['L_CAST']; ?>: <?php echo $_music_val['S_CAST']; ?>

				<br/><?php echo $_music_val['L_DIRECTOR']; ?>: <?php echo $_music_val['S_DIRECTOR']; ?></td>
			    <td class="hilang"><?php echo $_music_val['GROUP']; ?><input type="hidden" name="music_id[]" value="<?php echo $_music_val['S_MID']; ?>"/></td>
			    <td class="hilang"><?php echo $_music_val['ALLOW_ADS']; ?></td>
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_<?php echo $_music_val['S_MID']; ?>" <?php echo $_music_val['V_ENABLED']; ?>/><label>&nbsp;</label></td>
			    <?php } else { ?>

			    <td><?php echo $_music_val['ENABLED']; ?></td>
			    <?php } if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_music_val['U_UPDATE']; ?>"><img src="<?php echo $_music_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_music_val['L_UPDATE']; ?>" title="<?php echo $_music_val['L_UPDATE']; ?>" /></a></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_music_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_music_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_music_val['L_DELETE']; ?>" title="<?php echo $_music_val['L_DELETE']; ?>" /></a>
			    </td>
			    <?php } ?>

			  </tr>
			<?php }} } ?>

			</tbody>
			</table>
			<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			<fieldset class="display-options">
			    <input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" name="submit" />
			    <?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

			</fieldset>
			<?php } ?>

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