<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('<?php echo ((isset($this->_rootref['L_CONFIRM_DELETE'])) ? $this->_rootref['L_CONFIRM_DELETE'] : ((isset($user->lang['CONFIRM_DELETE'])) ? $user->lang['CONFIRM_DELETE'] : '{ CONFIRM_DELETE }')); ?>');
    });
});


function wcgf_getXmlHttp() {
	var xHttp = null;
	try { xHttp = new XMLHttpRequest(); }
	catch (e) {
		try { xHttp = new ActiveXObject("Msxml2.XMLHTTP"); }
		catch (e) { xHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
	}
	return xHttp;
}

function checkStatus(ip, node_id, mode) {
	var loading = '<img src="./../styles/simplicity-v2/default/imageset/ajax-loader.gif" width="20" />';
	$("#"+ node_id).html(loading);
	console.log(ip + ' ' + mode);
	$.ajax({
		url: "./../ajax.php",
		cache: false,
		type: "GET",
		data: "mod=check_status_stb&ip=" + ip,
		success: function(response){  console.log(response);
			if(response == 'OFF') {
				if(mode == 'reboot') {
					alert("Perintah Reboot Gagal. STB Offline");
				} else {
					$("#"+ node_id).html('<span style="color:red">' + response + '</span>');
				}
			} else if(response == 'ON') {
				if(mode == 'reboot') {
					xmlhttpPostToReboot(ip);
				} else {
					$("#"+ node_id).html('<span style="color:green">' + response + '</span>');
				}
			}
			
		}
	});
}

function xmlhttpPostToReboot(hostname) {
	var xmlhttp = wcgf_getXmlHttp();
	document.getElementById("status").innerHTML = "<font color='C9C9C9'>Connecting...</font>";
	if (location.port)
		var httpPort = location.protocol.match(/https/) ? location.port : parseInt(location.port);
	else
		var httpPort = 80;

	var strURL = 'http://' + hostname + ':' + httpPort + '/rService';
	//var strURL = 'http://' + hostname + '/rService';
	strURL += "?type=SYS&action=middleware&operation=reboot";

	// strURL = "Response.aspx";
	//alert(strURL);
	xmlhttp.open('GET', strURL, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(null);
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4) {
			alert("Perintah Reboot Berhasil");
		}
		/*
		if (xmlhttp.readyState == 0) {
			document.getElementById("status").innerHTML = "<font color='red'>Request not initialized.</font>";
			console.log("Request not initialized");
		}
		if (xmlhttp.readyState == 1) {
			document.getElementById("status").innerHTML = "<font color='green'>Server is connected.</font>";
			console.log("Server is connected");
		}
		if (xmlhttp.status == 0 && xmlhttp.readyState == 2) {
			document.getElementById("status").innerHTML = "<font color='blue'>Request Sent</font>";
			//alert("Perintah Reboot Berhasil");
			console.log("Request received");
		}
		if (xmlhttp.readyState == 3) {
			document.getElementById("status").innerHTML = "<font color='C9C9C9'>Request Processing...</font>";
		}
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("status").innerHTML = "<font color='C9C9C9'>Reboot request Send Successfully...</font>";
			console.log(xmlhttp.responseText);
		}
		if (xmlhttp.status == 404) {
			document.getElementById("status").innerHTML = "<font color='red'>Server not found.</font>";
			consloe.log("Server not found");
		}
		*/
	}
	
	//window.setTimeout("clearText()", 20000);
}


</script>
	
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
			  <!--<th><?php echo ((isset($this->_rootref['L_MAC'])) ? $this->_rootref['L_MAC'] : ((isset($user->lang['MAC'])) ? $user->lang['MAC'] : '{ MAC }')); ?></th>-->
			  <th><?php echo ((isset($this->_rootref['L_IP'])) ? $this->_rootref['L_IP'] : ((isset($user->lang['IP'])) ? $user->lang['IP'] : '{ IP }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_LAST_FLIGHT'])) ? $this->_rootref['L_LAST_FLIGHT'] : ((isset($user->lang['LAST_FLIGHT'])) ? $user->lang['LAST_FLIGHT'] : '{ LAST_FLIGHT }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_LAST_CHANNEL'])) ? $this->_rootref['L_LAST_CHANNEL'] : ((isset($user->lang['LAST_CHANNEL'])) ? $user->lang['LAST_CHANNEL'] : '{ LAST_CHANNEL }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_STATUS'])) ? $this->_rootref['L_STATUS'] : ((isset($user->lang['STATUS'])) ? $user->lang['STATUS'] : '{ STATUS }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_RESTART'])) ? $this->_rootref['L_RESTART'] : ((isset($user->lang['RESTART'])) ? $user->lang['RESTART'] : '{ RESTART }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></th>
			  <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>

			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_NODES']) {  $_node_count = (isset($this->_tpldata['node'])) ? sizeof($this->_tpldata['node']) : 0;if ($_node_count) {for ($_node_i = 0; $_node_i < $_node_count; ++$_node_i){$_node_val = &$this->_tpldata['node'][$_node_i]; if (!($_node_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <!--<td><?php echo $_node_val['MAC']; ?></td>-->
			    <td><?php echo $_node_val['IP']; ?></td>
			    <td><?php echo $_node_val['NAME']; ?></td>
			    <td><?php echo $_node_val['DESCRIPTION']; ?></td>
				<td><?php echo $_node_val['ROOM']; ?></td>
				<td><?php echo $_node_val['LAST_FLIGHT']; ?></td>
				<td><?php echo $_node_val['LAST_CHANNEL']; ?></td>
				<td id="<?php echo $_node_val['S_NID']; ?>" style="width: 5%" align="center"><img src="<?php echo $_node_val['ICON_PATH']; ?>/signal.png" alt="<?php echo ((isset($this->_rootref['L_CHECK_STATUS'])) ? $this->_rootref['L_CHECK_STATUS'] : ((isset($user->lang['CHECK_STATUS'])) ? $user->lang['CHECK_STATUS'] : '{ CHECK_STATUS }')); ?>" title="<?php echo ((isset($this->_rootref['L_CHECK_STATUS'])) ? $this->_rootref['L_CHECK_STATUS'] : ((isset($user->lang['CHECK_STATUS'])) ? $user->lang['CHECK_STATUS'] : '{ CHECK_STATUS }')); ?>" onclick="checkStatus('<?php echo $_node_val['IP']; ?>', '<?php echo $_node_val['S_NID']; ?>', 'check');" style="cursor:pointer" /></td>
				<td style="width: 5%" align="center"><img src="<?php echo $_node_val['ICON_PATH']; ?>/restart.png" alt="<?php echo ((isset($this->_rootref['L_RESTART'])) ? $this->_rootref['L_RESTART'] : ((isset($user->lang['RESTART'])) ? $user->lang['RESTART'] : '{ RESTART }')); ?>" title="<?php echo ((isset($this->_rootref['L_RESTART'])) ? $this->_rootref['L_RESTART'] : ((isset($user->lang['RESTART'])) ? $user->lang['RESTART'] : '{ RESTART }')); ?>" onclick="checkStatus('<?php echo $_node_val['IP']; ?>', 0, 'reboot');" style="cursor:pointer" /></td>
				<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><td style="width: 5%" align="center">
			    <input type="hidden" name="nid[]" value="<?php echo $_node_val['S_NID']; ?>"/>
			    <input type="checkbox" name="mark_<?php echo $_node_val['S_NID']; ?>" <?php echo $_node_val['V_ENABLED']; ?>/><label>&nbsp;</label></td>
			    <?php } else { ?>

			    <td><?php echo $_node_val['ENABLED']; ?></td>
			    <?php } if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_node_val['U_UPDATE']; ?>" rel="facebox"><img src="<?php echo $_node_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_node_val['L_UPDATE']; ?>" title="<?php echo $_node_val['L_UPDATE']; ?>" /></a></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_node_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_node_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_node_val['L_DELETE']; ?>" title="<?php echo $_node_val['L_DELETE']; ?>" /></a>
			    <input type="hidden" name="nid[]" value="<?php echo $_node_val['S_NID']; ?>"/></td>
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
			<div id="status" style= "height:30px;text-align:center;font-weight:bold;font-size:18px;"></div>
			<input type="hidden" id="stbStatus" value="oo" />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>
	

<?php $this->_tpl_include('overall_footer.tpl'); ?>