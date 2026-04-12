<!-- INCLUDE header.tpl -->

<!-- main container -->
    <div class="container">
	<h2>{L_PAGE_TITLE}</h2>
	<!-- IF S_VIEWBILL_EMPTY -->
	<div class="row" id="divMessage">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
		<div>{S_MESSAGE}</div>
		</div>
		<div class="col-sm-3"></div>
	</div>
	<!-- ENDIF -->
	
	<!-- IF S_VIEWBILL_EXIST -->
	<div class="row" style="margin-bottom:5px;font-weight: bold;">
	    <div class="col-sm-3 divbg">{L_DATE}</div><div class="col-sm-6 divbg">{L_ITEM}</div><div class="col-sm-3 divbg">{L_AMOUNT}</div>
	    
	</div>
	
	<!-- BEGIN viewbill -->
	<div class="row" style="margin-bottom:5px;">
	    <div class="col-sm-3 divbg">{viewbill.S_DATE}</div><div class="col-sm-6 divbg">{viewbill.S_TITLE}</div><div class="col-sm-3 divbgRight">{viewbill.S_PRICE}</div>
	    
	</div>
	<!-- END viewbill -->
	
	<div class="row" style="margin-bottom:5px;font-weight: bold;">
	    <div class="col-sm-3 divbg">&nbsp;</div><div class="col-sm-6 divbg">{L_TOTAL_AMOUNT}</div><div class="col-sm-3 divbgRight">{S_TOTAL_AMOUNT}</div>
	</div>
	<!-- ENDIF -->
	
    </div><!-- /.container-->


<!-- INCLUDE footer.tpl -->