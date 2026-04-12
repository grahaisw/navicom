<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			    <div class="inner">
			    <strong><?php echo ((isset($this->_rootref['L_USER'])) ? $this->_rootref['L_USER'] : ((isset($user->lang['USER'])) ? $user->lang['USER'] : '{ USER }')); ?></strong>
			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th><?php echo ((isset($this->_rootref['L_NAME1'])) ? $this->_rootref['L_NAME1'] : ((isset($user->lang['NAME1'])) ? $user->lang['NAME1'] : '{ NAME1 }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_NAME2'])) ? $this->_rootref['L_NAME2'] : ((isset($user->lang['NAME2'])) ? $user->lang['NAME2'] : '{ NAME2 }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_NAME3'])) ? $this->_rootref['L_NAME3'] : ((isset($user->lang['NAME3'])) ? $user->lang['NAME3'] : '{ NAME3 }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_READ'])) ? $this->_rootref['L_READ'] : ((isset($user->lang['READ'])) ? $user->lang['READ'] : '{ READ }')); ?></th>  
			  <th><?php echo ((isset($this->_rootref['L_UPDATE'])) ? $this->_rootref['L_UPDATE'] : ((isset($user->lang['UPDATE'])) ? $user->lang['UPDATE'] : '{ UPDATE }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_DELETE'])) ? $this->_rootref['L_DELETE'] : ((isset($user->lang['DELETE'])) ? $user->lang['DELETE'] : '{ DELETE }')); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_PRIVILEDGE']) {  $_priviledge_count = (isset($this->_tpldata['priviledge'])) ? sizeof($this->_tpldata['priviledge']) : 0;if ($_priviledge_count) {for ($_priviledge_i = 0; $_priviledge_i < $_priviledge_count; ++$_priviledge_i){$_priviledge_val = &$this->_tpldata['priviledge'][$_priviledge_i]; if (!($_priviledge_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><?php echo $_priviledge_val['NAME1']; ?></td>
			    <td><?php echo $_priviledge_val['NAME2']; ?></td>
			    <td><a href="<?php echo $_priviledge_val['U_NAME3']; ?>"><?php echo $_priviledge_val['NAME3']; ?></a></td>
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <td style="width: 5%" align="center">
				<input type="hidden" name="module_id[]" value="<?php echo $_priviledge_val['S_MID']; ?>"/>
				<input type="checkbox" name="read_<?php echo $_priviledge_val['S_MID']; ?>" <?php echo $_priviledge_val['V_RID']; ?>/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center">
				<input type="hidden" name="priv_id[]" value="<?php echo $_priviledge_val['S_PID']; ?>"/>
				<input type="checkbox" name="edit_<?php echo $_priviledge_val['S_MID']; ?>" <?php echo $_priviledge_val['V_EID']; ?>/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center">
				<input type="checkbox" name="delete_<?php echo $_priviledge_val['S_MID']; ?>" <?php echo $_priviledge_val['V_DID']; ?>/><label>&nbsp;</label></td>
			    <?php } else { ?>

			    <td style="width: 5%" align="center"><?php echo $_priviledge_val['READ']; ?></td>
			    <td style="width: 5%" align="center"><?php echo $_priviledge_val['UPDATE']; ?></td>
			    <td style="width: 5%" align="center"><?php echo $_priviledge_val['DELETE']; ?></td>
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