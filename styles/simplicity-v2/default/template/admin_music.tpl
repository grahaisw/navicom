<!-- INCLUDE admin_header.tpl -->
<!-- <script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
    });
});

</script> -->
	
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
			  <th width="60">{L_THUMBNAIL}</th>
			  <th>{L_NAME}</th>
			  <th>{L_GROUP}</th>
			  <th>{L_ALLOW_ADS}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_MUSIC -->
			  <!-- BEGIN music -->
			  <!-- IF music.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td><a href="{music.U_NAME}"><img src="{music.THUMBNAIL_PATH}160x235/{music.THUMBNAIL}" alt="{music.NAME}" width="60"></a></td>
			    <td><strong><a href="{music.U_NAME}">{music.NAME}</a></strong>
				<br/>{music.L_CAST}: {music.S_CAST}
				<br/>{music.L_DIRECTOR}: {music.S_DIRECTOR}</td>
			    <td>{music.GROUP}<input type="hidden" name="music_id[]" value="{music.S_MID}"/></td>
			    <td>{music.ALLOW_ADS}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{music.S_MID}" {music.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{music.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{music.U_UPDATE}"><img src="{music.ICON_PATH}/edit.png" alt="{music.L_UPDATE}" title="{music.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{music.U_DELETE}" id="DeleteLink"><img src="{music.ICON_PATH}/delete.png" alt="{music.L_DELETE}" title="{music.L_DELETE}" /></a>
			    </td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END music -->
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