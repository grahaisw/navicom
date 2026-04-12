<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>


<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="<?php echo (isset($this->_rootref['T_BG_CLIP_PATH'])) ? $this->_rootref['T_BG_CLIP_PATH'] : ''; ?>/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->
<div id="pageTitle"><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div id="apDiv4"><img src="<?php echo ((isset($this->_rootref['L_QR_IMAGE'])) ? $this->_rootref['L_QR_IMAGE'] : ((isset($user->lang['QR_IMAGE'])) ? $user->lang['QR_IMAGE'] : '{ QR_IMAGE }')); ?>"></div>
<div id="apDiv5"><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?>: <?php echo (isset($this->_rootref['S_ROOM'])) ? $this->_rootref['S_ROOM'] : ''; ?> <br/><?php echo (isset($this->_rootref['S_GUEST'])) ? $this->_rootref['S_GUEST'] : ''; ?> <p><span class="connectivity"><?php echo ((isset($this->_rootref['L_NOTE'])) ? $this->_rootref['L_NOTE'] : ((isset($user->lang['NOTE'])) ? $user->lang['NOTE'] : '{ NOTE }')); ?></span></div>

<?php $this->_tpl_include('footer.tpl'); ?>