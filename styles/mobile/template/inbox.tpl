<!-- INCLUDE header.tpl -->

<!-- main container -->
    <div class="container">
	<h2>{L_PAGE_TITLE}</h2>
	<dl class="Zebra_Accordion">
	<!-- BEGIN inbox -->
	    <div class="tes">
	    <dt><span class="time">{inbox.S_TIME}</span><span class="from">{L_FROM}: {inbox.S_FROM}</span></dt>
	    <dd>{inbox.S_CONTENT}</dd>
	    </div>
	<!-- END inbox -->

	</dl>

	
    </div><!--/.container-->

<div id="sendMessage"><a id="send" name="send" href="{URL_SEND_MESSAGE}">{L_SEND_MESSAGE}</a></div>
<!-- INCLUDE footer.tpl -->