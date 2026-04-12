<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>


<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="<?php echo (isset($this->_rootref['T_BG_CLIP_PATH'])) ? $this->_rootref['T_BG_CLIP_PATH'] : ''; ?>/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->
<div id="pageTitle"><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div id="apDiv4"></div>
<div id="apDiv5"><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?>: <?php echo (isset($this->_rootref['S_ROOM'])) ? $this->_rootref['S_ROOM'] : ''; ?> <br/> <p>
    <span class="status-update">
    <form name="update" method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" >
    <label for="housekeeper_id"><?php echo ((isset($this->_rootref['L_USER'])) ? $this->_rootref['L_USER'] : ((isset($user->lang['USER'])) ? $user->lang['USER'] : '{ USER }')); ?><br><input name="housekeeper_id" id="housekeeper_id" value="" /><br><br>
	<label for="status_code"><?php echo ((isset($this->_rootref['L_STATUS'])) ? $this->_rootref['L_STATUS'] : ((isset($user->lang['STATUS'])) ? $user->lang['STATUS'] : '{ STATUS }')); ?><br><?php echo (isset($this->_rootref['S_STATUS'])) ? $this->_rootref['S_STATUS'] : ''; ?> <input name="submit" id="submit" class="button-primary" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" type="submit"></label>
    <p class="submit">
      <?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

      
    
    </form>
    </span>
</div>

<script type="text/javascript">
     document.forms.update.submit.focus();
</script>
<?php $this->_tpl_include('footer.tpl'); ?>