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
			  <th>{L_ID}</th>
			  <th>{L_NAME}</th>
			  <th>{L_FLAG}</th>
			  <th>{L_ENABLED}</th>
			  <th>{L_EXIST}</th>
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_LANG -->
			  <!-- BEGIN lang -->
			  <!-- IF lang.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{lang.ID}</td>
			    <td>{lang.NAME}</td>
			    <td><img src="{lang.FLAG_FILE}" alt="{lang.NAME}" height="15"></td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="hidden" name="lid[]" value="{lang.S_LID}"/>
			    <input type="checkbox" name="mark_{lang.S_LID}" {lang.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{lang.ENABLED}</td>
			    <!-- ENDIF -->
			    <td>{lang.EXIST}</td>
			    <!-- IF S_DELETE -->
			    <td style="width: 10%" align="center"><a href="{lang.U_UPDATE}" rel="facebox"><img src="{lang.ICON_PATH}/edit.png" alt="{lang.L_UPDATE}" title="{lang.L_UPDATE}" /></a>&nbsp;<a href="{lang.U_DELETE}" id="DeleteLink"><img src="{lang.ICON_PATH}/delete.png" alt="{lang.L_DELETE}" title="{lang.L_DELETE}" /></a></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END lang -->
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