<!-- INCLUDE admin_header.tpl -->
<script type="text/javascript">
$(function() {
    $('#submit').click(function() {
        return confirm('{L_CONFIRM_SYNC}');
    });
});

</script>

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			    <div class="inner"><span class="corners-top2"><span></span></span>
				<div id="hotel-info">
				    
				</div>
				<br/>
				<div id="pms-info">
				    <form method="post" id="mcp" action="{U_ACTION}">
					<input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />
				    </form>
				</div>

			<hr />

			    </div>
  
			<br />


		    </div>
		 </div>

		 <span class="corners-bottom"><span></span></span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<!-- INCLUDE overall_footer.tpl -->