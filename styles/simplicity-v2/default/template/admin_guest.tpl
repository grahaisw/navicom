<!-- INCLUDE admin_header.tpl -->
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<form method="post" id="mcp" action="{U_ACTION}">
			    <div class="inner">
			    <!-- IF S_ADD_UPDATE -->
			    <a href="{U_ADD}" rel="facebox">{L_ADD}</a>
			    <!-- ENDIF -->
			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th width="60">{L_RESV_ID}</th>
			  <th>{L_ROOM}</th>
			  <th>{L_NAME}</th>
			  <th>{L_ARRIVAL}</th>
			  <th>{L_GROUP}</th>
			  <th width="80">{L_ROOM_SHARE}</th>
			</tr>
			</thead>
			<tbody>
			<!-- IF S_GUESTS -->
			  <!-- BEGIN guest -->
			  <!-- IF guest.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{guest.S_RESV_ID}</td>
			    <td>{guest.S_ROOM}</td>
			    <td><strong><a href="{guest.U_NAME}">{guest.S_NAME}</a></strong> {guest.S_SALUTATION}</td>
			    <td>{guest.S_ARRIVAL}</td>
			    <td>{guest.S_GROUP}</td>
			    <td>{guest.S_ROOM_SHARE}</td>
			  </tr>
			<!-- END guest -->
			<!-- ENDIF -->
			</tbody>
			</table>
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