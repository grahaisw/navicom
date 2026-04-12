<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

<script type="text/javascript">
    function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}
</script>

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">
			<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			<a href="<?php echo (isset($this->_rootref['U_ADD'])) ? $this->_rootref['U_ADD'] : ''; ?>"><?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?></a>
			<?php } ?>

			<span class="corners-top2"><span>
		<?php if ($this->_rootref['S_FORM']) {  ?>

			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">


	<table cellspacing="1">
	<tr>
	    <td width="20%"><label for="resv_id"><?php echo ((isset($this->_rootref['L_RESV_ID'])) ? $this->_rootref['L_RESV_ID'] : ((isset($user->lang['RESV_ID'])) ? $user->lang['RESV_ID'] : '{ RESV_ID }')); ?>:</label></td>
	    <td width="80%"><input name="resv_id" type="text" id="resv_id" value="<?php echo (isset($this->_rootref['S_RESV_ID'])) ? $this->_rootref['S_RESV_ID'] : ''; ?>" /></td>
	</tr>
	<tr>
	    <td><label for="room"><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_ROOM'])) ? $this->_rootref['S_ROOM'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="firstname"><?php echo ((isset($this->_rootref['L_FIRSTNAME'])) ? $this->_rootref['L_FIRSTNAME'] : ((isset($user->lang['FIRSTNAME'])) ? $user->lang['FIRSTNAME'] : '{ FIRSTNAME }')); ?>:</label></td>
	    <td><input name="firstname" type="text" id="firstname" value="<?php echo (isset($this->_rootref['S_FIRSTNAME'])) ? $this->_rootref['S_FIRSTNAME'] : ''; ?>" /></td>
	</tr>
	<tr>
	    <td><label for="lastname"><?php echo ((isset($this->_rootref['L_LASTNAME'])) ? $this->_rootref['L_LASTNAME'] : ((isset($user->lang['LASTNAME'])) ? $user->lang['LASTNAME'] : '{ LASTNAME }')); ?>:</label></td>
	    <td><input name="lastname" type="text" id="lastname" value="<?php echo (isset($this->_rootref['S_LASTNAME'])) ? $this->_rootref['S_LASTNAME'] : ''; ?>" /></td>
	</tr>
	<tr>
	    <td><label for="fullname"><?php echo ((isset($this->_rootref['L_FULLNAME'])) ? $this->_rootref['L_FULLNAME'] : ((isset($user->lang['FULLNAME'])) ? $user->lang['FULLNAME'] : '{ FULLNAME }')); ?>:</label></td>
	    <td><input name="fullname" type="text" id="fullname" value="<?php echo (isset($this->_rootref['S_FULLNAME'])) ? $this->_rootref['S_FULLNAME'] : ''; ?>" /></td>
	</tr>
	<tr>
	    <td><label for="salutation"><?php echo ((isset($this->_rootref['L_SALUTATION'])) ? $this->_rootref['L_SALUTATION'] : ((isset($user->lang['SALUTATION'])) ? $user->lang['SALUTATION'] : '{ SALUTATION }')); ?>:</label></td>
	    <td><input name="salutation" type="text" id="salutation" value="<?php echo (isset($this->_rootref['S_SALUTATION'])) ? $this->_rootref['S_SALUTATION'] : ''; ?>" /></td>
	</tr>
	<tr>
	    <td><label for="group"><?php echo ((isset($this->_rootref['L_GROUP'])) ? $this->_rootref['L_GROUP'] : ((isset($user->lang['GROUP'])) ? $user->lang['GROUP'] : '{ GROUP }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_GROUP'])) ? $this->_rootref['S_GROUP'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="startdatetime"><?php echo ((isset($this->_rootref['L_ARRIVAL_DATE'])) ? $this->_rootref['L_ARRIVAL_DATE'] : ((isset($user->lang['ARRIVAL_DATE'])) ? $user->lang['ARRIVAL_DATE'] : '{ ARRIVAL_DATE }')); ?>:</label></td>
	    <td><input name="startdatetime" type="text" id="startdatetime" value="<?php echo (isset($this->_rootref['S_ARRIVAL_DATE'])) ? $this->_rootref['S_ARRIVAL_DATE'] : ''; ?>"/>
	    <input id="pickstartdatetime" type="button" value="<?php echo ((isset($this->_rootref['L_PICK'])) ? $this->_rootref['L_PICK'] : ((isset($user->lang['PICK'])) ? $user->lang['PICK'] : '{ PICK }')); ?>"/></td>
	</tr>
	<tr>
	    <td><label for="permanent"><?php echo ((isset($this->_rootref['L_PERMANENT_GUEST'])) ? $this->_rootref['L_PERMANENT_GUEST'] : ((isset($user->lang['PERMANENT_GUEST'])) ? $user->lang['PERMANENT_GUEST'] : '{ PERMANENT_GUEST }')); ?>:</label></td>
	    <td><input id="permanent" name="permanent" type="checkbox" class="radio" <?php echo (isset($this->_rootref['V_PERMANENT_GUEST'])) ? $this->_rootref['V_PERMANENT_GUEST'] : ''; ?>/><label>&nbsp;</label></td>
	</tr>
	<tr>
	    <td>&nbsp;</td>
	    <td><p class="submit-buttons">
	<input class="button1" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;
	</p></td>
	</tr>
	</table>
	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

	
	</form>
	
		<?php } if ($this->_rootref['S_DETAIL']) {  ?>

			<table cellspacing="1">
	<tr>
	    <td width="200"><label for="resv_id"><?php echo ((isset($this->_rootref['L_RESV_ID'])) ? $this->_rootref['L_RESV_ID'] : ((isset($user->lang['RESV_ID'])) ? $user->lang['RESV_ID'] : '{ RESV_ID }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_RESV_ID'])) ? $this->_rootref['S_RESV_ID'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="room"><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_ROOM'])) ? $this->_rootref['S_ROOM'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="firstname"><?php echo ((isset($this->_rootref['L_FIRSTNAME'])) ? $this->_rootref['L_FIRSTNAME'] : ((isset($user->lang['FIRSTNAME'])) ? $user->lang['FIRSTNAME'] : '{ FIRSTNAME }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_FIRSTNAME'])) ? $this->_rootref['S_FIRSTNAME'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="lastname"><?php echo ((isset($this->_rootref['L_LASTNAME'])) ? $this->_rootref['L_LASTNAME'] : ((isset($user->lang['LASTNAME'])) ? $user->lang['LASTNAME'] : '{ LASTNAME }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_LASTNAME'])) ? $this->_rootref['S_LASTNAME'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="fullname"><?php echo ((isset($this->_rootref['L_FULLNAME'])) ? $this->_rootref['L_FULLNAME'] : ((isset($user->lang['FULLNAME'])) ? $user->lang['FULLNAME'] : '{ FULLNAME }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_FULLNAME'])) ? $this->_rootref['S_FULLNAME'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="salutation"><?php echo ((isset($this->_rootref['L_SALUTATION'])) ? $this->_rootref['L_SALUTATION'] : ((isset($user->lang['SALUTATION'])) ? $user->lang['SALUTATION'] : '{ SALUTATION }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_SALUTATION'])) ? $this->_rootref['S_SALUTATION'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="group"><?php echo ((isset($this->_rootref['L_GROUP'])) ? $this->_rootref['L_GROUP'] : ((isset($user->lang['GROUP'])) ? $user->lang['GROUP'] : '{ GROUP }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_GROUP'])) ? $this->_rootref['S_GROUP'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="startdatetime"><?php echo ((isset($this->_rootref['L_ARRIVAL_DATE'])) ? $this->_rootref['L_ARRIVAL_DATE'] : ((isset($user->lang['ARRIVAL_DATE'])) ? $user->lang['ARRIVAL_DATE'] : '{ ARRIVAL_DATE }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_ARRIVAL_DATE'])) ? $this->_rootref['S_ARRIVAL_DATE'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="permanent"><?php echo ((isset($this->_rootref['L_PERMANENT_GUEST'])) ? $this->_rootref['L_PERMANENT_GUEST'] : ((isset($user->lang['PERMANENT_GUEST'])) ? $user->lang['PERMANENT_GUEST'] : '{ PERMANENT_GUEST }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_PERMANENT_GUEST'])) ? $this->_rootref['S_PERMANENT_GUEST'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="message_count"><?php echo ((isset($this->_rootref['L_MESSAGE_COUNT'])) ? $this->_rootref['L_MESSAGE_COUNT'] : ((isset($user->lang['MESSAGE_COUNT'])) ? $user->lang['MESSAGE_COUNT'] : '{ MESSAGE_COUNT }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_MESSAGE_COUNT'])) ? $this->_rootref['S_MESSAGE_COUNT'] : ''; ?></td>
	</tr>
	<tr>
	    <td></td>
	    <td><?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			<input type="button" name="btnCheckout" id="btnCheckout" value="<?php echo ((isset($this->_rootref['L_CHECKOUT'])) ? $this->_rootref['L_CHECKOUT'] : ((isset($user->lang['CHECKOUT'])) ? $user->lang['CHECKOUT'] : '{ CHECKOUT }')); ?>" onclick="window.location.href='<?php echo (isset($this->_rootref['U_CHECKOUT'])) ? $this->_rootref['U_CHECKOUT'] : ''; ?>';" style="cursor: pointer;">&nbsp;&nbsp;
			
			<input type="button" name="btnSend" id="btnSend" value="<?php echo ((isset($this->_rootref['L_SEND_MESSAGE'])) ? $this->_rootref['L_SEND_MESSAGE'] : ((isset($user->lang['SEND_MESSAGE'])) ? $user->lang['SEND_MESSAGE'] : '{ SEND_MESSAGE }')); ?>" onclick="PopupCenter('<?php echo (isset($this->_rootref['U_SEND_MESSAGE'])) ? $this->_rootref['U_SEND_MESSAGE'] : ''; ?>', '<?php echo (isset($this->_rootref['RESV_ID'])) ? $this->_rootref['RESV_ID'] : ''; ?>',700,450);" style="cursor: pointer;" />
	    <?php } ?></td>

	</tr>
	</table>
	<hr />
	
	<h1><?php echo ((isset($this->_rootref['L_GUEST_BILL'])) ? $this->_rootref['L_GUEST_BILL'] : ((isset($user->lang['GUEST_BILL'])) ? $user->lang['GUEST_BILL'] : '{ GUEST_BILL }')); ?></h1>
	<table cellspacing="1" class="table1">
	<thead>
	    <tr>
		<th width="60"><?php echo ((isset($this->_rootref['L_NO'])) ? $this->_rootref['L_NO'] : ((isset($user->lang['NO'])) ? $user->lang['NO'] : '{ NO }')); ?></th>
		<th><?php echo ((isset($this->_rootref['L_DATE'])) ? $this->_rootref['L_DATE'] : ((isset($user->lang['DATE'])) ? $user->lang['DATE'] : '{ DATE }')); ?></th>
		<th><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?></th>
		<th><?php echo ((isset($this->_rootref['L_CREDIT'])) ? $this->_rootref['L_CREDIT'] : ((isset($user->lang['CREDIT'])) ? $user->lang['CREDIT'] : '{ CREDIT }')); ?></th>
		<th><?php echo ((isset($this->_rootref['L_DEBIT'])) ? $this->_rootref['L_DEBIT'] : ((isset($user->lang['DEBIT'])) ? $user->lang['DEBIT'] : '{ DEBIT }')); ?></th>
	    </tr>
	</thead>
	<tbody>
	<?php if ($this->_rootref['S_BILLS']) {  $_bill_count = (isset($this->_tpldata['bill'])) ? sizeof($this->_tpldata['bill']) : 0;if ($_bill_count) {for ($_bill_i = 0; $_bill_i < $_bill_count; ++$_bill_i){$_bill_val = &$this->_tpldata['bill'][$_bill_i]; if (!($_bill_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

	    <td><?php echo $_bill_val['S_NO']; ?></td>
	    <td><?php echo $_bill_val['S_DATE']; ?></td>
	    <td><?php echo $_bill_val['S_DESCRIPTION']; ?></td>
	    <td><?php echo $_bill_val['S_CREDIT']; ?></td>
	    <td><?php echo $_bill_val['S_DEBIT']; ?></td>
	</tr>
	<?php }} } ?>

	</tbody>
	</table>
	<b><?php echo ((isset($this->_rootref['L_TOTAL_BALANCE'])) ? $this->_rootref['L_TOTAL_BALANCE'] : ((isset($user->lang['TOTAL_BALANCE'])) ? $user->lang['TOTAL_BALANCE'] : '{ TOTAL_BALANCE }')); ?> : <?php echo (isset($this->_rootref['S_TOTAL_BALANCE'])) ? $this->_rootref['S_TOTAL_BALANCE'] : ''; ?> <?php echo ((isset($this->_rootref['L_CURRENCY'])) ? $this->_rootref['L_CURRENCY'] : ((isset($user->lang['CURRENCY'])) ? $user->lang['CURRENCY'] : '{ CURRENCY }')); ?></b>
	
	
	
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