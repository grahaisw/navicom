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

			<form method="post" id="mcp" action="{U_ACTION}">
			    <div class="inner">
			    <!-- IF S_ADD_UPDATE -->
			    <!-- <a href="{U_ADD}" rel="facebox">{L_ADD}</a> -->
			    <!-- ENDIF -->
			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th width="20%">{L_DATETIME}</th>
			  <th>{L_ROOM}</th>
			  <th>{L_SUBJECT}</th>
			  <th>{L_CONTENT}</th>
			  <th>&nbsp;</th>
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_GUEST_MESSAGE -->
			  <!-- BEGIN message -->
			  <!-- IF message.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{message.DATETIME}</td>
			    <td>{message.ROOM}</td>
			    <td>{message.SUBJECT}</td>
			    <td>{message.CONTENT}</td>
			    
			    <!-- IF message.S_NOT_READ -->
			    <td style="width: 5%" align="center">
				<a href="{message.U_READ}" rel="facebox" id="ProcessLink"><img src="{message.ICON_PATH}/process-accept.png" alt="{message.L_READ}" title="{message.L_READ}" /></a></td>
			    <!-- ELSE -->
			    <td>{message.READ}</td>
			    <!-- ENDIF -->
			    
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center">
				<a href="{message.U_DELETE}" id="DeleteLink"><img src="{message.ICON_PATH}/delete.png" alt="{messagee.L_DELETE}" title="{message.L_DELETE}" /></a>
			    <input type="hidden" name="message_id[]" value="{message.S_MID}"/></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END message -->
			<!-- ENDIF -->
			</tbody>
			</table>
			<hr />

			</div>
</form>
<br />
<center><img src="{T_JS_PATH}loading.gif" id="loading" style="display:none;" /></center>
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear">
		 <!-- IF S_SOUND -->
		  <audio autoplay>
		      <source src="{T_MEDIA_AUDIO_PATH}a1.mp3" type="audio/mpeg">
		      Your browser does not support the audio element.
		  </audio> 
		 <!-- ENDIF -->
		 </div>
	    </div>
	</div>

    </div>

<!-- INCLUDE overall_footer.tpl -->