<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>

<div id="pageTitle"><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div class="main">
<?php if ($this->_rootref['S_FORM']) {  ?>
<form class="message" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" method="post">
    <p>
	<span class="label"><?php echo ((isset($this->_rootref['L_TO'])) ? $this->_rootref['L_TO'] : ((isset($user->lang['TO'])) ? $user->lang['TO'] : '{ TO }')); ?></span><br/>
	<select id="target" name="target" autofocus><option value="<?php echo (isset($this->_rootref['S_TO_HOTEL'])) ? $this->_rootref['S_TO_HOTEL'] : ''; ?>"><?php echo ((isset($this->_rootref['L_TO_HOTEL'])) ? $this->_rootref['L_TO_HOTEL'] : ((isset($user->lang['TO_HOTEL'])) ? $user->lang['TO_HOTEL'] : '{ TO_HOTEL }')); ?></option><option value="<?php echo (isset($this->_rootref['S_TO_ROOM'])) ? $this->_rootref['S_TO_ROOM'] : ''; ?>"><?php echo ((isset($this->_rootref['L_TO_ROOM'])) ? $this->_rootref['L_TO_ROOM'] : ((isset($user->lang['TO_ROOM'])) ? $user->lang['TO_ROOM'] : '{ TO_ROOM }')); ?></option></select><br/>
    </p>
    <p>
	<span id="to_room" style="display:none;"><input type="text" id="to_room_name" name="to_room_name" value="<?php echo (isset($this->_rootref['S_ROOM_NAME'])) ? $this->_rootref['S_ROOM_NAME'] : ''; ?>" width="80" placeholder="<?php echo ((isset($this->_rootref['L_ROOM_NAME'])) ? $this->_rootref['L_ROOM_NAME'] : ((isset($user->lang['ROOM_NAME'])) ? $user->lang['ROOM_NAME'] : '{ ROOM_NAME }')); ?>">
    </p>
    <p>
	<span id="to_hotel" class="label"><?php echo ((isset($this->_rootref['L_SUBJECT'])) ? $this->_rootref['L_SUBJECT'] : ((isset($user->lang['SUBJECT'])) ? $user->lang['SUBJECT'] : '{ SUBJECT }')); ?><br/>
	<?php echo (isset($this->_rootref['S_SUBJECT'])) ? $this->_rootref['S_SUBJECT'] : ''; ?></span>
    </p>
    <p>
	<span class="label"><?php echo ((isset($this->_rootref['L_CONTENT'])) ? $this->_rootref['L_CONTENT'] : ((isset($user->lang['CONTENT'])) ? $user->lang['CONTENT'] : '{ CONTENT }')); ?></span><br/>
	<textarea type="text" name="message" rows="4"><?php echo (isset($this->_rootref['S_CONTENT'])) ? $this->_rootref['S_CONTENT'] : ''; ?></textarea> 
    </p>
    <p>
	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?><input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>">
    </p>       
</form>​
<?php } if ($this->_rootref['S_SUCCESS']) {  ?>
<p>
<div class="message"><center><a href="<?php echo (isset($this->_rootref['S_REDIRECT_URL'])) ? $this->_rootref['S_REDIRECT_URL'] : ''; ?>" class="redirect"><?php echo (isset($this->_rootref['S_NOTE'])) ? $this->_rootref['S_NOTE'] : ''; ?></a></center></div>
</p>

<script type="text/javascript">
    setTimeout(function() { 
	window.location.href = $("a")[0].href; 
    }, 3000);
</script>
<?php } else { ?>
<script type="text/javascript">
 // window.onload($("#to_room").hide());
  
  $( "#target" ).change(function () {
	if($("#target").has('option:selected:contains(<?php echo (isset($this->_rootref['S_TO_ROOM'])) ? $this->_rootref['S_TO_ROOM'] : ''; ?>)').length){
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

<?php } ?>

</script>
</div>

<?php $this->_tpl_include('footer.tpl'); ?>