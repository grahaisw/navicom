<!-- INCLUDE header.tpl -->

<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->
<div id="pageTitle">{L_PAGE_TITLE}</div>
<!--<div id="apDiv2"></div>-->
<div id="apDiv3"></div>
<div id="apDiv4"></div>
<div id="apDiv5">{L_ROOM}: {S_ROOM} <br/> <p>
    <span class="status-update">
    <form name="update" method="post" action="{U_ACTION}" >
    <!--<label for="housekeeper_id">{L_USER}<br><input name="housekeeper_id" id="housekeeper_id" value=""/><br><br>-->
	<label for="status_code">{L_STATUS}<br>{S_STATUS} <input name="submit" id="submit" class="button-primary" value="{L_SUBMIT}" type="submit"></label>
    <p class="submit">
      {S_HIDDEN_FIELDS}
      
    
    </form>
    </span>
</div>

<script type="text/javascript">
     document.forms.update.submit.focus();
</script>
<!-- INCLUDE footer.tpl -->
