<!-- INCLUDE admin_header.tpl -->

<script type="text/javascript">
$(function() {
    $('#ProcessLink').click(function() {
	return confirm('{L_CONFIRM_PROCESS}');
    });
});

function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}


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
			  <th>{L_DATETIME}</th>
			  <th>{L_ROOM}</th>
			  <th>{L_NAME}</th>
			  <th>{L_ITEM}</th>
			  <th>{L_DECLINED}</th>
			  <th>{L_RECEIVED}</th>
			  <th>{L_APPROVED}</th>
			  <th>{L_DELETE}</th>
			</tr>
			</thead>
			<tbody>
			<!-- IF S_BUFFERS -->
			  <!-- BEGIN buffer -->
			  <!-- IF buffer.S_ROW_COUNT is even --><tr class="bg1" valign="top"><!-- ELSE --><tr  valign="top" class="bg2"><!-- ENDIF -->
			    <td>{buffer.DATETIME}</td>
			    <td><b>{buffer.ROOM}</b></td>
			    <td>{buffer.RESV_ID} <br/><b>{buffer.NAME}</b></td>
			    <td><b>{buffer.ITEM}</b><p>
			    {L_DATETIME}: <b>{buffer.TIME}</b><br/>
			    {L_QTY}: <b>{buffer.QTY}</b><br/>
			    {L_CAR_TERAPHIST}: <b>{buffer.CAR_TERAPHIST}</b><br/>
			    {L_NOTE}: <b>{buffer.NOTE}</b><br/>
			    </p></td>
			    <td style="width: 5%" align="center">
				<!-- IF buffer.S_NOT_RECEIVED -->
				<a href="{buffer.U_DECLINED}" rel="facebox" id="ProcessLink"><img src="{buffer.ICON_PATH}/details_close.png" alt="{buffer.L_DECLINED}" title="{buffer.L_DECLINED}" /></a>
				<!-- ELSE -->
				{buffer.DECLINED}
				<!-- ENDIF -->
			    </td>
			    <td style="width: 5%" align="center">
				<input type="hidden" name="buffer_id[]" value="{buffer.S_NID}"/>
				<!-- IF buffer.S_NOT_RECEIVED -->
				<a href="{buffer.U_RECEIVED}" rel="facebox" id="ProcessLink"><img src="{buffer.ICON_PATH}/process-accept.png" alt="{buffer.L_RECEIVED}" title="{buffer.L_RECEIVED}" /></a>
				<!-- ELSE -->
				{buffer.RECEIVED}
				<!-- ENDIF -->
			    </td>
			    <!-- IF buffer.S_NOT_APPROVED -->
			    <td style="width: 5%; color:#DF0101;" align="center">
			    <!-- ELSE -->
			    <td style="width: 5%; color:#04B404;" align="center">
			    <!-- ENDIF -->
				{buffer.APPROVED}
			    </td>
			    
			    <td><!-- IF S_ADD_UPDATE -->
			    
			    <a href="{buffer.U_DELETE}"><img src="{buffer.ICON_PATH}/delete.png" alt="{buffer.L_DELETE}" title="{buffer.L_DELETE}" /></a>

			    <!-- ELSE -->
			    &nbsp;
			    <!-- ENDIF --></td>
			  </tr>
			<!-- END buffer -->
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
		 <!--
		  <audio autoplay>
		      <source src="{T_MEDIA_AUDIO_PATH}a1.mp3" type="audio/mpeg">
		      Your browser does not support the audio element.
		  </audio>
		  -->
		 <!-- ENDIF -->
		 </div>
	    </div>
	</div>

    </div>

<!-- INCLUDE overall_footer.tpl -->