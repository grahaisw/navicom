<!-- INCLUDE admin_header.tpl -->
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
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<div class="inner">
			<!-- IF S_ADD_UPDATE -->
			<a href="{U_ADD}">{L_ADD}</a>
			<!-- ENDIF -->
			<span class="corners-top2"><span>
		<!-- IF S_FORM -->
			<form method="post" id="mcp" action="{U_ACTION}">


	<table cellspacing="1">
	<tr>
	    <td width="20%"><label for="resv_id">{L_RESV_ID}:</label></td>
	    <td width="80%"><input name="resv_id" type="text" id="resv_id" value="{S_RESV_ID}" /></td>
	</tr>
	<tr>
	    <td><label for="room">{L_ROOM}:</label></td>
	    <td>{S_ROOM}</td>
	</tr>
	<tr>
	    <td><label for="firstname">{L_FIRSTNAME}:</label></td>
	    <td><input name="firstname" type="text" id="firstname" value="{S_FIRSTNAME}" /></td>
	</tr>
	<tr>
	    <td><label for="lastname">{L_LASTNAME}:</label></td>
	    <td><input name="lastname" type="text" id="lastname" value="{S_LASTNAME}" /></td>
	</tr>
	<tr>
	    <td><label for="fullname">{L_FULLNAME}:</label></td>
	    <td><input name="fullname" type="text" id="fullname" value="{S_FULLNAME}" /></td>
	</tr>
	<tr>
	    <td><label for="salutation">{L_SALUTATION}:</label></td>
	    <td><input name="salutation" type="text" id="salutation" value="{S_SALUTATION}" /></td>
	</tr>
	<tr>
	    <td><label for="group">{L_GROUP}:</label></td>
	    <td>{S_GROUP}</td>
	</tr>
	<tr>
	    <td><label for="startdatetime">{L_ARRIVAL_DATE}:</label></td>
	    <td><input name="startdatetime" type="text" id="startdatetime" value="{S_ARRIVAL_DATE}"/>
	    <input id="pickstartdatetime" type="button" value="{L_PICK}"/></td>
	</tr>
	<tr>
	    <td><label for="permanent">{L_PERMANENT_GUEST}:</label></td>
	    <td><input id="permanent" name="permanent" type="checkbox" class="radio" {V_PERMANENT_GUEST}/><label>&nbsp;</label></td>
	</tr>
	<tr>
	    <td>&nbsp;</td>
	    <td><p class="submit-buttons">
	<input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />&nbsp;
	</p></td>
	</tr>
	</table>
	{S_FORM_TOKEN}
	
	</form>
	
		<!-- ENDIF -->
		<!-- IF S_DETAIL -->
			<table cellspacing="1">
	<tr>
	    <td width="200"><label for="resv_id">{L_RESV_ID}:</label></td>
	    <td>{S_RESV_ID}</td>
	</tr>
	<tr>
	    <td><label for="room">{L_ROOM}:</label></td>
	    <td>{S_ROOM}</td>
	</tr>
	<tr>
	    <td><label for="firstname">{L_FIRSTNAME}:</label></td>
	    <td>{S_FIRSTNAME}</td>
	</tr>
	<tr>
	    <td><label for="lastname">{L_LASTNAME}:</label></td>
	    <td>{S_LASTNAME}</td>
	</tr>
	<tr>
	    <td><label for="fullname">{L_FULLNAME}:</label></td>
	    <td>{S_FULLNAME}</td>
	</tr>
	<tr>
	    <td><label for="salutation">{L_SALUTATION}:</label></td>
	    <td>{S_SALUTATION}</td>
	</tr>
	<tr>
	    <td><label for="group">{L_GROUP}:</label></td>
	    <td>{S_GROUP}</td>
	</tr>
	<tr>
	    <td><label for="startdatetime">{L_ARRIVAL_DATE}:</label></td>
	    <td>{S_ARRIVAL_DATE}</td>
	</tr>
	<tr>
	    <td><label for="permanent">{L_PERMANENT_GUEST}:</label></td>
	    <td>{S_PERMANENT_GUEST}</td>
	</tr>
	<tr>
	    <td><label for="message_count">{L_MESSAGE_COUNT}:</label></td>
	    <td>{S_MESSAGE_COUNT}</td>
	</tr>
	<tr>
	    <td></td>
	    <td><!-- IF S_ADD_UPDATE -->
			<input type="button" name="btnCheckout" id="btnCheckout" value="{L_CHECKOUT}" onclick="window.location.href='{U_CHECKOUT}';" style="cursor: pointer;">&nbsp;&nbsp;
			
			<input type="button" name="btnSend" id="btnSend" value="{L_SEND_MESSAGE}" onclick="PopupCenter('{U_SEND_MESSAGE}', '{RESV_ID}',700,450);" style="cursor: pointer;" />
	    <!-- ENDIF --></td>

	</tr>
	</table>
	<hr />
	
	<h1>{L_GUEST_BILL}</h1>
	<table cellspacing="1" class="table1">
	<thead>
	    <tr>
		<th width="60">{L_NO}</th>
		<th>{L_DATE}</th>
		<th>{L_DESCRIPTION}</th>
		<th>{L_CREDIT}</th>
		<th>{L_DEBIT}</th>
	    </tr>
	</thead>
	<tbody>
	<!-- IF S_BILLS -->
	<!-- BEGIN bill -->
	<!-- IF bill.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
	    <td>{bill.S_NO}</td>
	    <td>{bill.S_DATE}</td>
	    <td>{bill.S_DESCRIPTION}</td>
	    <td>{bill.S_CREDIT}</td>
	    <td>{bill.S_DEBIT}</td>
	</tr>
	<!-- END bill -->
	<!-- ENDIF -->
	</tbody>
	</table>
	<b>{L_TOTAL_BALANCE} : {S_TOTAL_BALANCE} {L_CURRENCY}</b>
	
	
	
		<!-- ENDIF -->
			</div>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<!-- INCLUDE overall_footer.tpl -->