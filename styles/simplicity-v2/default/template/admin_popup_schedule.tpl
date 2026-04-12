<!-- INCLUDE admin_header.tpl -->
<script type="text/javascript" language="javascript" src="{T_DATATABLE_PATH}js/bootstrap.min.js"></script>

<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
    });
});

</script>
<style type="text/css">
	th,td{
		text-align: center;
	}
	.table-bordered{
		border:1px solid #f00!important;
	}
	.table{
		border-style: 1px solid #444;
	}
	.btn{
		margin-top: 5px;
		margin-bottom: 5px;
	}
	.kotak{
		float: left;
		border-top:1px solid #444;
		padding: 10px 3px;
		margin-bottom: 3px;
	}
	.kotak a{
		padding: 4px 5px;
		margin: 1px 2px;
		background: #449d44;
		border-radius: 3px;
		border-color: #4cae4c;
		color: #f4f4f4;
		text-decoration: none;
		font-size: 11px;
	}

	.biru{
		background: #337ab7!important;
		border-color: #2e6da4!important;
	}
	.xls{
		position: absolute;
		top: 60px;
		right: 80px;
		background: #e9e9e9;
		padding: 5px;
		border: 1px solid #999;
		font-size: 13px;
		border-radius: 2px;
		z-index: 999999999;
	}
	.xls a{
		text-decoration: none;
		color: #000;
	}


</style>
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1><br>
			<span class="xls" style="float: right;"><a href="#" onclick="exportXLS('schedule');">Export Schedule</a></span>
			<!-- BEGIN popup -->
			<div class="kotak">
			<a href="{U_TITLE}&time={popup.NAME}" class="biru" ><i class="fa fa-calendar" aria-hidden="true"></i></a>
				<a href="{U_ADD}&time={popup.NAME}">{popup.NAME}</a> 
			</div>
			

		
<!-- END popup -->
		

			</div>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

    <script type="text/javascript">

		// var today = new Date();
		// var dd = today.getDate();
		// var mm = today.getMonth()+1; //January is 0!
		// var yyyy = today.getFullYear();

		// if(dd<10) {
		//     dd='0'+dd
		// } 

		// if(mm<10) {
		//     mm='0'+mm
		// } 
		// today = yyyy+'-'+mm+'-'+dd;
	function exportXLS(mode) {
		// var start2 = $("#startdatetime3").val();
		// var end2 = $("#enddatetime3").val();
		// 		if(start2 == ''){
		// 	start = '1970-01-01';
		// }else{
		// 	start = start2;
		// }
		// if(end2 == ''){
		// 	end= today;
		// }else{
		// 	end = end2;
		// }
		// alert("data");
	location.href = 'excel.php?mode=' + mode;
}


</script>

<!-- INCLUDE overall_footer.tpl -->