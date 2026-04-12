<!-- INCLUDE header.tpl -->

<div id="pageTitle">{L_PAGE_TITLE}</div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div class="main">
<!-- IF S_FORM -->
<form class="message" action="{U_ACTION}" method="post">
    <p>
	<span class="label">{L_TO}</span><br/>
	<select id="target" name="target" autofocus><option value="{S_TO_HOTEL}">{L_TO_HOTEL}</option><option value="{S_TO_ROOM}">{L_TO_ROOM}</option></select><br/>
    </p>
    <p>
	<span id="to_room" style="display:none;"><input type="text" id="to_room_name" name="to_room_name" value="{S_ROOM_NAME}" width="80" placeholder="{L_ROOM_NAME}">
    </p>
    <p>
	<span id="to_hotel" class="label">{L_SUBJECT}<br/>
	{S_SUBJECT}</span>
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
<div class="message"><center><a href="{S_REDIRECT_URL}" class="redirect">{S_NOTE}</a></center></div>
</p>

<script type="text/javascript">
    setTimeout(function() { 
	window.location.href = $("a")[0].href; 
    }, 3000);
</script>
<!-- ELSE -->
<script type="text/javascript">
 // window.onload($("#to_room").hide());
  
  $( "#target" ).change(function () {
	if($("#target").has('option:selected:contains({S_TO_ROOM})').length){
	    $("#to_hotel").hide();
	    $("#to_room").show();
	    $("#to_room_name").focus();
	}
	else
	{
	    $("#to_hotel").show();        
	    $("#to_room").hide();
	}
    });
    
    //window.onload($("#to_room").hide());

<!-- ENDIF -->

</script>
</div>

<!-- INCLUDE footer.tpl -->
