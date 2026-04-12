<!-- INCLUDE admin_header.tpl -->
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<form method="post" id="mcp" action="{U_USER_ACTION}">
			    <div class="inner">
			    <strong>{L_USER}</strong>
			    <span class="corners-top2"><span>

			    <fieldset class="display-options">
				{S_USER}
				<input class="button2" type="submit" value="{L_SUBMIT}" name="submit" />
				{S_FORM_USER}
			    </fieldset>

			    </div>
			</form>
			<form method="post" id="mcp" action="{U_MODULE_ACTION}">
			    <div class="inner">
			    <strong>{L_MODULE}</strong>
			    <span class="corners-top2"><span>

			    <fieldset class="display-options">
				{S_MODULE}
				<input class="button2" type="submit" value="{L_SUBMIT}" name="submit" />
				{S_FORM_MODULE}
			    </fieldset>
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