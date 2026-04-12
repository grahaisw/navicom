<!-- INCLUDE admin_header.tpl -->

<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
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
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<div class="inner">
			<span class="corners-top2"><span>
			<span class="navigation"><label>{L_LABEL}</label></span></br>
			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label for="mac">{L_MAC}:</label></td>
			    <td width="85%"><input name="mac" type="text" id="mac" value="{S_MAC}" /></td>
			</tr>
			<tr>
			    <td><label for="ip">{L_IP}:</label></td>
			    <td><input name="ip" type="text" id="ip" value="{S_IP}" /></td>
			</tr>
			<tr>
			    <td><label for="name">{L_NAME}:</label></td>
			    <td><input name="name" type="text" id="name" value="{S_NAME}" /></td>
			</tr>
			<tr>
			    <td><label for="description">{L_DESCRIPTION}:</label></td>
			    <td><textarea name="description" id="description" rows="5" cols="40">{S_DESCRIPTION}</textarea>
			    </td>
			</tr>
			<tr>
			    <td><label for="name">{L_URL}:</label></td>
			    <td><input name="url" type="text" id="url" value="{S_URL}" size="60"/></td>
			</tr>
			<tr>
			    <td><label for="lid">{L_LANG}:</label></td>
			    <td><input name="lid" type="text" id="lid" value="{S_ID}" maxlength="2" size="2" disabled/></td>
			</tr>
			<tr>
			    <td><label for="lid">{L_CHANNEL}:</label></td>
			    <td>{S_CHANNEL} <a href="#" onclick="setChannel();">Set STB to this channel</a></td>
			</tr>
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {S_ENABLED}/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
			    <td><p class="submit-buttons">
			    <input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />&nbsp;
				</p>{S_FORM_TOKEN}</td>
			</tr>

			</table>
			<input type="hidden" id="url_server" value="{S_URL_SERVER}" />
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


<!-- INCLUDE overall_footer.tpl -->