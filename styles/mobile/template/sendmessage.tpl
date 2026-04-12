<!-- INCLUDE header.tpl -->

<!-- main container -->
    <div class="container">
	<h2>{L_PAGE_TITLE}</h2>
	
	<!-- IF S_FORM -->
	<form class="message" action="{U_ACTION}" method="post">
	    <p>
		<span class="label">{L_SUBJECT}</span><br/>
		<!--<input type="text" name="subject" value="{S_SUBJECT}" width="200">-->
		{S_SUBJECT}
	    </p>
	    <p>
		<span class="label">{L_CONTENT}</span><br/>
		<textarea type="text" name="message" rows="4">{S_CONTENT}</textarea> 
	    </p>
	    <p>
	    {S_FORM_TOKEN}<input type="submit" name="submit" value="{L_SUBMIT}">
	    </p>       
	</form>​
	<!-- ENDIF -->
	<!-- IF S_SUCCESS -->
	<p>
	<div class="message"><center><a id="redirect" href="{S_REDIRECT_URL}" class="redirect">{S_NOTE}</a></center></div>
	</p>

	<script type="text/javascript">
	    setTimeout(function() { 
		window.location.href = $("#redirect")[0].href; 
	    }, 3000);
	</script>

	<!-- ENDIF -->

    </div><!--/.container-->

<!-- INCLUDE footer.tpl -->