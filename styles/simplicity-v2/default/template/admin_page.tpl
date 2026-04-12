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
			  <th>{L_PAGE_ID}</th>
			  <th>{L_TITLE}</th>
			  <th>{L_IN_MENU}</th>
			  <th>{L_ALLOW_ADS}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_PAGE -->
			  <!-- BEGIN page -->
			  <!-- IF page.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{page.PAGE_ID}</td>
			    <td><a href="{page.U_TITLE}">{page.TITLE}</a></td>
			    <td>{page.IN_MENU}</td>
			    <td>{page.ALLOW_ADS}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="hidden" name="page_id[]" value="{page.S_PID}"/>
			    <input type="checkbox" name="mark_{page.S_PID}" {page.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{page.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{page.U_UPDATE}"><img src="{page.ICON_PATH}/edit.png" alt="{page.L_UPDATE}" title="{page.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{page.U_DELETE}" id="DeleteLink"><img src="{page.ICON_PATH}/delete.png" alt="{page.L_DELETE}" title="{page.L_DELETE}" /></a>
			    <input type="hidden" name="page_id[]" value="{page.S_PID}"/></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END page -->
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