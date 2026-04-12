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
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>
			<!-- IF S_ADD_UPDATE -->
			    <span class="navigation"><a href="{U_ADD}" rel="facebox"><img src="{ICON_PATH}/add.png" alt="{L_ADD}" title="{L_ADD}" width="20" />{L_ADD}</a></span>
			<!-- ENDIF -->

			<form method="post" id="mcp" action="{U_ACTION}">
			    <div class="inner">
			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <!--<th>{L_MAC}</th>-->
			  <th>{L_IP}</th>
			  <th>{L_NAME}</th>
			  <th>{L_DESCRIPTION}</th>
			  <th>{L_ROOM}</th>
			  <th>{L_LAST_FLIGHT}</th>
			  <th>{L_LAST_CHANNEL}</th>
			  <th>{L_STATUS}</th>
			  <th>{L_RESTART}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_NODES -->
			  <!-- BEGIN node -->
			  <!-- IF node.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <!--<td>{node.MAC}</td>-->
			    <td>{node.IP}</td>
			    <td>{node.NAME}</td>
			    <td>{node.DESCRIPTION}</td>
				<td>{node.ROOM}</td>
				<td>{node.LAST_FLIGHT}</td>
				<td>{node.LAST_CHANNEL}</td>
				<td id="{node.S_NID}" style="width: 5%" align="center"><img src="{node.ICON_PATH}/signal.png" alt="{L_CHECK_STATUS}" title="{L_CHECK_STATUS}" onclick="checkStatus('{node.IP}', '{node.S_NID}', 'check');" style="cursor:pointer" /></td>
				<td style="width: 5%" align="center"><img src="{node.ICON_PATH}/restart.png" alt="{L_RESTART}" title="{L_RESTART}" onclick="checkStatus('{node.IP}', 0, 'reboot');" style="cursor:pointer" /></td>
				<!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="hidden" name="nid[]" value="{node.S_NID}"/>
			    <input type="checkbox" name="mark_{node.S_NID}" {node.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{node.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{node.U_UPDATE}" rel="facebox"><img src="{node.ICON_PATH}/edit.png" alt="{node.L_UPDATE}" title="{node.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{node.U_DELETE}" id="DeleteLink"><img src="{node.ICON_PATH}/delete.png" alt="{node.L_DELETE}" title="{node.L_DELETE}" /></a>
			    <input type="hidden" name="nid[]" value="{node.S_NID}"/></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END node -->
			<!-- ENDIF -->
			</tbody>
			</table>
			<!-- IF S_ADD_UPDATE -->
			<fieldset class="display-options">
			    <input class="button2" type="submit" value="{L_SUBMIT}" name="submit" />
			    {S_FORM_TOKEN}
			</fieldset>
			<!-- ENDIF -->
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
	

<!-- INCLUDE overall_footer.tpl -->