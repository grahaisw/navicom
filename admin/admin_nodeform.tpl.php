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

function xmlhttpPostForIndex(hostname) {

	var xmlhttp = wcgf_getXmlHttp();
	var url_server = $("#url_server").val();
	var strUrl = 'http://' + url_server + '/index.php';
	
	if (hostname == "") {
		alert("IP Address is empty!");
		return false;
	}

	if (location.port)
		var httpPort = location.protocol.match(/https/) ? location.port : parseInt(location.port);
	else
		var httpPort = 80;

	var strURL = 'http://' + hostname + ':' + httpPort + '/portal';
	//strURL += "/?url=" + strUrl;
	strURL += "?url=" + strUrl;

	// strURL = "Response.aspx";
	console.log(strURL);
	xmlhttp.open('GET', strURL, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(null);
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 0) {
			//document.getElementById("status").innerHTML = "<font color='red'>Request not initialized.</font>";
			console.log("Request not initialized");
		}
		if (xmlhttp.readyState == 1) {
			//document.getElementById("status").innerHTML = "<font color='green'>Server is connected.</font>";
			console.log("Server is connected");
		}
		if (xmlhttp.readyState == 2) {
			//document.getElementById("status").innerHTML = "<font color='blue'>Request send.</font>";
			console.log("Request received");
		}
		if (xmlhttp.readyState == 3) {
			//document.getElementById("status").innerHTML = "<font color='C9C9C9'>Request Processing...</font>";
		}
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//document.getElementById("status").innerHTML = "<font color='C9C9C9'>Url Send Successfully...</font>";
			console.log(xmlhttp.responseText);
		}
		if (xmlhttp.status == 404) {
			//document.getElementById("status").innerHTML = "<font color='red'>Server not found.</font>";
			consloe.log("Server not found");
		}
		
		xmlhttpPostForURL(hostname);
	}
}

function xmlhttpPostForURL(hostname) {

	var xmlhttp = wcgf_getXmlHttp();
	var url_server = $("#url_server").val();
	var strUrl = 'http://' + url_server + '/tv_channel.php';
	if (hostname == "") {
		alert("IP Address is empty!");
		return false;
	}

	if (location.port)
		var httpPort = location.protocol.match(/https/) ? location.port : parseInt(location.port);
	else
		var httpPort = 80;

	var strURL = 'http://' + hostname + ':' + httpPort + '/portal';
	//strURL += "/?url=" + strUrl;
	strURL += "?url=" + strUrl;

	// strURL = "Response.aspx";
	console.log(strURL);
	xmlhttp.open('GET', strURL, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(null);
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 0) {
			//document.getElementById("status").innerHTML = "<font color='red'>Request not initialized.</font>";
			console.log("Request not initialized");
		}
		if (xmlhttp.readyState == 1) {
			//document.getElementById("status").innerHTML = "<font color='green'>Server is connected.</font>";
			console.log("Server is connected");
		}
		if (xmlhttp.readyState == 2) {
			//document.getElementById("status").innerHTML = "<font color='blue'>Request send.</font>";
			console.log("Request received");
		}
		if (xmlhttp.readyState == 3) {
			//document.getElementById("status").innerHTML = "<font color='C9C9C9'>Request Processing...</font>";
		}
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//document.getElementById("status").innerHTML = "<font color='C9C9C9'>Url Send Successfully...</font>";
			console.log(xmlhttp.responseText);
		}
		if (xmlhttp.status == 404) {
			//document.getElementById("status").innerHTML = "<font color='red'>Server not found.</font>";
			consloe.log("Server not found");
		}
	}
}

function setChannel() {
	var tv_channel_id = $("#tv_channel_id").val();
	var ip = $("#ip").val();
	// alert(ip);
	$.ajax({
		url: "./../ajax.php",
		cache: false,
		type: "GET",
		data: "mod=last_channel&tv_channel_id=" + tv_channel_id + "&ip=" + ip,
		success: function(response){
				xmlhttpPostForIndex(ip);
			}
	});
}

</script>

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">
			<span class="corners-top2"><span>
			<span class="navigation"><label><?php echo ((isset($this->_rootref['L_LABEL'])) ? $this->_rootref['L_LABEL'] : ((isset($user->lang['LABEL'])) ? $user->lang['LABEL'] : '{ LABEL }')); ?></label></span></br>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label for="mac"><?php echo ((isset($this->_rootref['L_MAC'])) ? $this->_rootref['L_MAC'] : ((isset($user->lang['MAC'])) ? $user->lang['MAC'] : '{ MAC }')); ?>:</label></td>
			    <td width="85%"><input name="mac" type="text" id="mac" value="<?php echo (isset($this->_rootref['S_MAC'])) ? $this->_rootref['S_MAC'] : ''; ?>" /></td>
			</tr>
			<tr>
			    <td><label for="ip"><?php echo ((isset($this->_rootref['L_IP'])) ? $this->_rootref['L_IP'] : ((isset($user->lang['IP'])) ? $user->lang['IP'] : '{ IP }')); ?>:</label></td>
			    <td><input name="ip" type="text" id="ip" value="<?php echo (isset($this->_rootref['S_IP'])) ? $this->_rootref['S_IP'] : ''; ?>" /></td>
			</tr>
			<tr>
			    <td><label for="name"><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td><input name="name" type="text" id="name" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" /></td>
			</tr>
			<tr>
			    <td><label for="description"><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?>:</label></td>
			    <td><textarea name="description" id="description" rows="5" cols="40"><?php echo (isset($this->_rootref['S_DESCRIPTION'])) ? $this->_rootref['S_DESCRIPTION'] : ''; ?></textarea>
			    </td>
			</tr>
			<tr>
			    <td><label for="name"><?php echo ((isset($this->_rootref['L_URL'])) ? $this->_rootref['L_URL'] : ((isset($user->lang['URL'])) ? $user->lang['URL'] : '{ URL }')); ?>:</label></td>
			    <td><input name="url" type="text" id="url" value="<?php echo (isset($this->_rootref['S_URL'])) ? $this->_rootref['S_URL'] : ''; ?>" size="60"/></td>
			</tr>
			<tr>
			    <td><label for="lid"><?php echo ((isset($this->_rootref['L_LANG'])) ? $this->_rootref['L_LANG'] : ((isset($user->lang['LANG'])) ? $user->lang['LANG'] : '{ LANG }')); ?>:</label></td>
			    <td><input name="lid" type="text" id="lid" value="<?php echo (isset($this->_rootref['S_ID'])) ? $this->_rootref['S_ID'] : ''; ?>" maxlength="2" size="2" disabled/></td>
			</tr>
			<tr>
			    <td><label for="lid"><?php echo ((isset($this->_rootref['L_CHANNEL'])) ? $this->_rootref['L_CHANNEL'] : ((isset($user->lang['CHANNEL'])) ? $user->lang['CHANNEL'] : '{ CHANNEL }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_CHANNEL'])) ? $this->_rootref['S_CHANNEL'] : ''; ?> <a href="#" onclick="setChannel();">Set STB to this channel</a></td>
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
			<input type="hidden" id="url_server" value="<?php echo (isset($this->_rootref['S_URL_SERVER'])) ? $this->_rootref['S_URL_SERVER'] : ''; ?>" />
			<hr />
			
			</form>
			</div>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>
    <script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('mac');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>


<?php $this->_tpl_include('overall_footer.tpl'); ?>