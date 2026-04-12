<!-- INCLUDE admin_header.tpl -->
<script type="text/javascript">
$(document).ready(function() {
		var table = $('#tnode').DataTable({
			 

		 });

		table.buttons().container()
			.appendTo($('.dataTables_filter', table.table().container()));


        $('#tnode tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });


        var table = $('#tnode').DataTable();

      
    } );
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
    });
});

</script>
<!--<style type="text/css">
	th,td{
		text-align: center;
	}
	.table-bordered{
		border:1px solid #f00!important;
	}
	.table{
		border-style: 1px solid #444;
	}


</style>-->
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>Popup List</h1>



			<table cellspacing="1" class="table table-bordered table-striped" >
			<thead>

			
			</thead>
			<tbody cellspacing="1">
		

			</tbody>
			</table>
			<table cellspacing="1" id="tnode" class="table1">
				<thead>
					<tr>
						<th>{L_ADS_NAME}</th>
						<th>{L_DATE}</th>
						<th>{L_TIME}</th>
						<th>{L_ZONE}</th>
						<th>{L_CHANNEL}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
					</tr>
				</thead>
			
				<tbody>
				<!-- BEGIN popup -->
					<!-- IF tv.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
						
						<td>{popup.NAME}</td>
						<td>{popup.START} - {popup.END}</td>
						<td>{popup.TIME}</td>
						<td>{popup.ZONE}</td>
						<td>{popup.CHANNEL}</td>

			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{popup.U_UPDATE}" rel="facebox"><img src="{popup.ICON_PATH}/edit.png" alt="{popup.L_UPDATE}" title="{popup.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{popup.U_DELETE}&time={popup.TIMES}" id="DeleteLink"><img src="{popup.ICON_PATH}/delete.png" alt="{popup.L_DELETE}" title="{popup.L_DELETE}" /></a>
			    </td>
			    <!-- ENDIF -->
					</tr>
				<!-- END popup -->
				</tbody>
				
				
			</table>
			
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