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
			  <th width="8%">{L_ORDER}</th>
			  <th>{L_THUMBNAIL}</th>
			  <th>{L_NAME}</th>
			  <th>{L_GROUP}</th>
			  <th>{L_ALLOW_ADS}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_TVS -->
			  <!-- BEGIN tv -->
			  <!-- IF tv.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="text" name="order_{tv.S_TID}" value="{tv.ORDER}"  maxlength="3" size="5" /></td>
			    <!-- ELSE -->
			    <td>{tv.ORDER}</td>
			    <!-- ENDIF -->
			    <td><a href="{tv.U_NAME}"><img src="{tv.THUMBNAIL}" alt="{tv.NAME}" height="60"></a></td>
			    <td><strong><a href="{tv.U_NAME}">{tv.NAME}</a></strong><br/>{tv.URL}</td>
			    <td>{tv.GROUP}<input type="hidden" name="tv_id[]" value="{tv.S_TID}"/></td>
			    <td>{tv.ALLOW_ADS}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{tv.S_TID}" {tv.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{tv.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{tv.U_UPDATE}"><img src="{tv.ICON_PATH}/edit.png" alt="{tv.L_UPDATE}" title="{tv.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{tv.U_DELETE}" id="DeleteLink"><img src="{tv.ICON_PATH}/delete.png" alt="{tv.L_DELETE}" title="{tv.L_DELETE}" /></a>
			    </td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END tv -->
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