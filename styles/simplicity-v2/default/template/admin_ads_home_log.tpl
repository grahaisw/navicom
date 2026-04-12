<!-- INCLUDE admin_header.tpl -->
<style type="text/css">
	.xls{
		background-color: #e9e9e9;
		background-image: -moz-linear-gradient(center top , #fff 0%, #e9e9e9 100%);
		border: 1px solid #999;
		border-radius: 2px;
		box-sizing: border-box;
		color: black;
		cursor: pointer;
		font-size: 0.88em;
		margin-right: 2px;
		padding: 0.5em 1em;
		position: absolute;
		top: 183px;
		right: 108px;
		z-index:1;
	}
	.xls a{
		text-decoration: none;
		color: #000;
	}
</style>

    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>
			<!-- IF S_SUBSCRIBER_LOG -->
			<!--<a href="{U_LOG}">&raquo; View All Log</a><br/><br/>-->
			<!-- ELSE -->
			<!--<a href="{U_LOG}">&raquo; View Log Per Subscriber</a><br/><br/>-->
			<!-- ENDIF -->
			
			<span>Date: <input type="text" id="startdatetime3" class="datepicker" size="10" value="{S_DATEFROM}"> - <input type="text" id="enddatetime3" class="datepicker" size="10" value="{S_DATEEND}">
			<!--<input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />--></span>

			<!-- IF S_SUBSCRIBER_LOG -->
			<span class="xls" style="float: right;"><a href="#" onclick="exportXLS('home_subs_log');">Export Detail  </a></span>
			<!-- ELSE -->
			<span  class="xls" style="float: right;"><a href="#" onclick="alllog('home_log');">Export Detail  </a></span>
			<!-- ENDIF -->

			<form method="post" id="mcp" action="{U_ACTION}">
			
			    <div class="inner">
				<span class="corners-top2"></span>

			    <!--<fieldset class="display-options" style="float: left">
			  {L_SEARCH_KEYWORDS}: <input type="text" name="keywords" value="{S_KEYWORDS}" />&nbsp;<input type="submit" class="button2" name="filter" value="{L_SEARCH}" />
			    </fieldset>-->

			<table cellspacing="1" class="table1" id="dtable3">
			<thead>
			<tr>
				<!-- IF S_SUBSCRIBER_LOG --><th>{L_SUBSCRIBER_NAME}</th><!-- ENDIF -->
				<th>{L_NAME}</th>
				<th>{L_TOTAL_VIEWED}</th>
				<!-- IF S_CLEAR_ALLOWED --><th>{L_MARK}</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_LOGS -->
			  <!-- BEGIN log -->
			  <!-- IF log.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <!-- IF S_SUBSCRIBER_LOG --><td>{log.SUBSCRIBER_NAME}</td><!-- ENDIF -->
			    <td>{log.NAME}</td>
			    <td>{log.TOTAL_WATCHED}</td>
			    <!-- IF S_CLEAR_ALLOWED --><td style="width: 5%" align="center"><input type="checkbox" name="mark[]" value="{log.ID}" /></td><!-- ENDIF -->
			  </tr>
			<!-- END log -->
			<!-- ELSE -->
			  <tr>
			    <td class="bg1" colspan="<!-- IF S_CLEAR_ALLOWED -->6<!-- ELSE -->5<!-- ENDIF -->" align="center"><span class="gen">{L_NO_ENTRIES}</span></td>
			  </tr>
			<!-- ENDIF -->
			</tbody>
			</table>
		
		<!-- IF PAGINATION -->
			<div class="pagination">
			    <a href="#" onclick="jumpto(); return false;" title="{L_JUMP_TO_PAGE}">{S_ON_PAGE}</a> &bull; <span>{PAGINATION}</span>
			</div>
		<!-- ENDIF -->

			<!--<fieldset class="display-options">
			    {L_DISPLAY_LOG}: &nbsp;{S_LIMIT_DAYS}&nbsp;{L_SORT_BY}: {S_SORT_KEY} {S_SORT_DIR}
			    <input class="button2" type="submit" value="{L_GO}" name="sort" />
			    {S_FORM_TOKEN}
			</fieldset>-->
			<hr />

			</span></span></div>
  
			</form>

<br />


		    </div>
		 </div>
		 <input type="hidden" id="ads_type" value="{S_TYPE}" />
		 <input type="hidden" id="mode" value="{S_MODE}" />
		 <span class="corners-bottom"><span></span></span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

     <script type="text/javascript">

     		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10) {
		    dd='0'+dd
		} 

		if(mm<10) {
		    mm='0'+mm
		} 
		today = yyyy+'-'+mm+'-'+dd;
	function exportXLS(mode) {
	
		// alert("data");
		var start2 = $("#startdatetime3").val();
		var end2 = $("#enddatetime3").val();
				if(start2 == ''){
			start = '1970-01-01';
		}else{
			start = start2;
		}
		if(end2 == ''){
			end= today;
		}else{
			end = end2;
		}
	location.href = 'excel.php?mode=' + mode + '&start=' + start + '&end=' + end;
}

function alllog(mode) {

	var start2 = $("#startdatetime3").val();
		var end2 = $("#enddatetime3").val();
				if(start2 == ''){
			start = '1970-01-01';
		}else{
			start = start2;
		}
		if(end2 == ''){
			end= today;
		}else{
			end = end2;
		}
		// alert("data");
	location.href = 'excel.php?mode=' + mode + '&start=' + start + '&end=' + end;
}
</script>

<!-- INCLUDE overall_footer.tpl -->