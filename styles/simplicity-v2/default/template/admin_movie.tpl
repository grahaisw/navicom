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
			<!-- IF S_MOVIES -->
			  <!-- BEGIN movie -->
			  <!-- IF movie.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td><a href="{movie.U_NAME}"><img src="{movie.THUMBNAIL_PATH}160x235/{movie.THUMBNAIL}" alt="{movie.NAME}" width="60"></a></td>
			    <td><strong><a href="{movie.U_NAME}">{movie.NAME}</a></strong>
				<br/>{movie.L_CAST}: {movie.S_CAST}
				<br/>{movie.L_DIRECTOR}: {movie.S_DIRECTOR}</td>
			    <td>{movie.GROUP}<input type="hidden" name="movie_id[]" value="{movie.S_MID}"/></td>
			    <td>{movie.ALLOW_ADS}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{movie.S_MID}" {movie.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{movie.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{movie.U_UPDATE}"><img src="{movie.ICON_PATH}/edit.png" alt="{movie.L_UPDATE}" title="{movie.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{movie.U_DELETE}" id="DeleteLink"><img src="{movie.ICON_PATH}/delete.png" alt="{movie.L_DELETE}" title="{movie.L_DELETE}" /></a>
			    </td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END movie -->
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