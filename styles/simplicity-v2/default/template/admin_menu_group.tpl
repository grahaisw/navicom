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
			  <th>{L_ORDER}</th>
			  <th>{L_TITLE}</th>
			  <th>{L_THUMBNAIL}</th>
			  <th>{L_MEMBERS}</th>
			  <th>{L_IN_MOBILE}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_MENU -->
			  <!-- BEGIN menu -->
			  <!-- IF menu.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{menu.ORDER}</td>
			    <td><a href="{menu.U_TITLE}">{menu.TITLE}</a>
			    <input type="hidden" name="menu_id[]" value="{menu.S_NID}"/></td>
			    <td>{menu.THUMBNAIL}</td>
			    <td>{menu.MEMBERS}</td>
			    <td>{menu.IN_MOBILE}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{menu.S_NID}" {menu.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{menu.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{menu.U_UPDATE}"><img src="{menu.ICON_PATH}/edit.png" alt="{menu.L_UPDATE}" title="{menu.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{menu.U_DELETE}" id="DeleteLink"><img src="{menu.ICON_PATH}/delete.png" alt="{menu.L_DELETE}" title="{menu.L_DELETE}" /></a></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END menu -->
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