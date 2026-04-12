<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			    <div class="inner">
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <a href="<?php echo (isset($this->_rootref['U_ADD'])) ? $this->_rootref['U_ADD'] : ''; ?>" rel="facebox"><?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?></a>
			    <?php } ?>

			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th width="60"><?php echo ((isset($this->_rootref['L_RESV_ID'])) ? $this->_rootref['L_RESV_ID'] : ((isset($user->lang['RESV_ID'])) ? $user->lang['RESV_ID'] : '{ RESV_ID }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ARRIVAL'])) ? $this->_rootref['L_ARRIVAL'] : ((isset($user->lang['ARRIVAL'])) ? $user->lang['ARRIVAL'] : '{ ARRIVAL }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_GROUP'])) ? $this->_rootref['L_GROUP'] : ((isset($user->lang['GROUP'])) ? $user->lang['GROUP'] : '{ GROUP }')); ?></th>
			  <th width="80"><?php echo ((isset($this->_rootref['L_ROOM_SHARE'])) ? $this->_rootref['L_ROOM_SHARE'] : ((isset($user->lang['ROOM_SHARE'])) ? $user->lang['ROOM_SHARE'] : '{ ROOM_SHARE }')); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_GUESTS']) {  $_guest_count = (isset($this->_tpldata['guest'])) ? sizeof($this->_tpldata['guest']) : 0;if ($_guest_count) {for ($_guest_i = 0; $_guest_i < $_guest_count; ++$_guest_i){$_guest_val = &$this->_tpldata['guest'][$_guest_i]; if (!($_guest_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><?php echo $_guest_val['S_RESV_ID']; ?></td>
			    <td><?php echo $_guest_val['S_ROOM']; ?></td>
			    <td><strong><a href="<?php echo $_guest_val['U_NAME']; ?>"><?php echo $_guest_val['S_NAME']; ?></a></strong> <?php echo $_guest_val['S_SALUTATION']; ?></td>
			    <td><?php echo $_guest_val['S_ARRIVAL']; ?></td>
			    <td><?php echo $_guest_val['S_GROUP']; ?></td>
			    <td><?php echo $_guest_val['S_ROOM_SHARE']; ?></td>
			  </tr>
			<?php }} } ?>

			</tbody>
			</table>
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