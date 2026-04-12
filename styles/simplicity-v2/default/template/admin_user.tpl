<!-- INCLUDE admin_header.tpl -->
<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
    });
});

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
			  <th>{L_FULLNAME}</th>
			  <th>{L_NAME}</th>
			  <th>{L_GROUPNAME}</th>
			  <th>{L_LAST_VISIT}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_PRIVILEDGE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_USER -->
			  <!-- BEGIN user -->
			  <!-- IF user.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td><a href="{user.U_DETAIL}" rel="facebox">{user.FULLNAME}</a></td>
			    <td>{user.NAME}</td>
			    <td>{user.GROUPNAME}</td>
			    <td>{user.LAST_VISIT}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="hidden" name="uid[]" value="{user.S_UID}"/>
			    <input type="checkbox" name="mark_{user.S_UID}" {user.V_ENABLED}/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center"><a href="{user.U_UPDATE}" rel="facebox"><img src="{user.ICON_PATH}/edit.png" alt="{user.L_UPDATE}" title="{user.L_UPDATE}" /></a></td>
			    <!-- ELSE -->
			    <td>{user.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{user.U_DELETE}" id="DeleteLink"><img src="{user.ICON_PATH}/delete.png" alt="{user.L_DELETE}" title="{user.L_DELETE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_PRIVILEDGE --><td><a href="{user.U_PRIVILEDGE}" id="PrivilegeLink"><img src="{user.ICON_PATH}/privileges.png" alt="{user.L_PRIVILEDGE}" title="{user.L_PRIVILEDGE}" /></a></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END user -->
			<!-- ELSE -->
			  <tr>
			    <td class="bg1" colspan="<!-- IF S_ADD_UPDATE -->6<!-- ELSE -->4<!-- ENDIF -->" align="center"><span class="gen">{L_NO_ENTRIES}</span></td>
			  </tr>
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
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<!-- INCLUDE overall_footer.tpl -->