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
			  <th>{L_IMAGE_ENABLED}</th>
			  <th>{L_CLIP_ENABLED}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_DIRECTORY -->
			  <!-- BEGIN directory_promo -->
			  <!-- IF directory_promo.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{directory_promo.ORDER}</td>
			    <td><a href="{directory_promo.U_TITLE}">{directory_promo.TITLE}</a></td>
			    <td><img src="{directory_promo.THUMBNAIL" alt="{directory_promo.TITLE}" />
			    <input type="hidden" name="directory_id[]" value="{directory_promo.S_DID}"/></td>
			    <td>{directory_promo.IMAGE_ENABLED}</td>
			    <td>{directory_promo.CLIP_ENABLED}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{directory_promo.S_DID}" {directory_promo.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{directory_promo.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{directory_promo.U_UPDATE}"><img src="{directory_promo.ICON_PATH}/edit.png" alt="{directory_promo.L_UPDATE}" title="{directory_promo.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{directory_promo.U_DELETE}" id="DeleteLink"><img src="{directory_promo.ICON_PATH}/delete.png" alt="{directory_promo.L_DELETE}" title="{directory_promo.L_DELETE}" /></a></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END directory_promo -->
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