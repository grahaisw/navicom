<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>


		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			
			<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>

			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_POST_ACTION'])) ? $this->_rootref['U_POST_ACTION'] : ''; ?>">

			    <div class="inner"><span class="corners-top2"><span></span></span>

			     <fieldset class="display-options" style="float: left">
			  <?php echo ((isset($this->_rootref['L_SEARCH_KEYWORDS'])) ? $this->_rootref['L_SEARCH_KEYWORDS'] : ((isset($user->lang['SEARCH_KEYWORDS'])) ? $user->lang['SEARCH_KEYWORDS'] : '{ SEARCH_KEYWORDS }')); ?>: <input type="text" name="keywords" value="<?php echo (isset($this->_rootref['S_KEYWORDS'])) ? $this->_rootref['S_KEYWORDS'] : ''; ?>" />&nbsp;<input type="submit" class="button2" name="filter" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" />
			    </fieldset>

			<table cellspacing="1" class="table1">
			<thead>
			<tr>
			  <th><?php echo ((isset($this->_rootref['L_MAC'])) ? $this->_rootref['L_MAC'] : ((isset($user->lang['MAC'])) ? $user->lang['MAC'] : '{ MAC }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_IP'])) ? $this->_rootref['L_IP'] : ((isset($user->lang['IP'])) ? $user->lang['IP'] : '{ IP }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_LAST_ACTIVITY'])) ? $this->_rootref['L_LAST_ACTIVITY'] : ((isset($user->lang['LAST_ACTIVITY'])) ? $user->lang['LAST_ACTIVITY'] : '{ LAST_ACTIVITY }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_MODULE'])) ? $this->_rootref['L_MODULE'] : ((isset($user->lang['MODULE'])) ? $user->lang['MODULE'] : '{ MODULE }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_BROWSER'])) ? $this->_rootref['L_BROWSER'] : ((isset($user->lang['BROWSER'])) ? $user->lang['BROWSER'] : '{ BROWSER }')); ?></th>
			  <?php if ($this->_rootref['S_CLEAR_ALLOWED']) {  ?><th><?php echo ((isset($this->_rootref['L_MARK'])) ? $this->_rootref['L_MARK'] : ((isset($user->lang['MARK'])) ? $user->lang['MARK'] : '{ MARK }')); ?></th><?php } ?>

			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_SESSIONS']) {  $_session_count = (isset($this->_tpldata['session'])) ? sizeof($this->_tpldata['session']) : 0;if ($_session_count) {for ($_session_i = 0; $_session_i < $_session_count; ++$_session_i){$_session_val = &$this->_tpldata['session'][$_session_i]; if (!($_session_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><?php echo $_session_val['MAC']; ?></td>
			    <td><?php echo $_session_val['NODE']; ?></td>
			    <td><?php echo $_session_val['USERNAME']; ?></td>
			    <td><?php echo $_session_val['LAST_ACTIVITY']; ?></td>
			    <td><?php echo $_session_val['MODULE']; ?></td>
			    <td><?php echo $_session_val['BROWSER']; ?></td>
			    <?php if ($this->_rootref['S_CLEAR_ALLOWED']) {  ?><td style="width: 5%" align="center"><input type="checkbox" name="mark[]" value="<?php echo $_session_val['ID']; ?>" /></td><?php } ?>

			  </tr>
			<?php }} } else { ?>

			  <tr>
			    <td class="bg1" colspan="<?php if ($this->_rootref['S_CLEAR_ALLOWED']) {  ?>5<?php } else { ?>4<?php } ?>" align="center"><span class="gen"><?php echo ((isset($this->_rootref['L_NO_ENTRIES'])) ? $this->_rootref['L_NO_ENTRIES'] : ((isset($user->lang['NO_ENTRIES'])) ? $user->lang['NO_ENTRIES'] : '{ NO_ENTRIES }')); ?></span></td>
			  </tr>
			<?php } ?>

			</tbody>
			</table>

			<?php if ($this->_rootref['PAGINATION']) {  ?>

			<div class="pagination">
			    <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['S_ON_PAGE'])) ? $this->_rootref['S_ON_PAGE'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span>
			</div>
			<?php } ?>

			
			<fieldset class="display-options">
			    <?php echo ((isset($this->_rootref['L_DISPLAY_LOG'])) ? $this->_rootref['L_DISPLAY_LOG'] : ((isset($user->lang['DISPLAY_LOG'])) ? $user->lang['DISPLAY_LOG'] : '{ DISPLAY_LOG }')); ?>: &nbsp;<?php echo (isset($this->_rootref['S_LIMIT_DAYS'])) ? $this->_rootref['S_LIMIT_DAYS'] : ''; ?>&nbsp;<?php echo ((isset($this->_rootref['L_SORT_BY'])) ? $this->_rootref['L_SORT_BY'] : ((isset($user->lang['SORT_BY'])) ? $user->lang['SORT_BY'] : '{ SORT_BY }')); ?>: <?php echo (isset($this->_rootref['S_SORT_KEY'])) ? $this->_rootref['S_SORT_KEY'] : ''; ?> <?php echo (isset($this->_rootref['S_SORT_DIR'])) ? $this->_rootref['S_SORT_DIR'] : ''; ?>

			    <input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" name="sort" />
			    <?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

			</fieldset>
			
			</span></span></div>

</form>

<br />


		    </div>
		 </div>

		 <span class="corners-bottom"><span></span></span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>