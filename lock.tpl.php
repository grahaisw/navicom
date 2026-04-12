<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>


<script>
window.addEventListener("keydown", keysPressed, false);
window.addEventListener("keyup", keysReleased, false);
 
var keys = [];
 
function keysPressed(e) {
    keys[e.keyCode] = true;
    if (keys[49] && keys[57] && keys[13] && keys[406]) {
        location.href= 'tv_channel_hk.php';
    }    
    if (keys[49] && keys[57] && keys[13] && keys[404]) {
        location.href= 'roomupdate.php';
        e.preventDefault(); 
    }
}
function keysReleased(e) {
    keys[e.keyCode] = false;
}
</script>
<div class="bground"></div>
<div class="title"><h1><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?><h1></div>
<!--<div id="divChannelCover">	
	<div id="divChannelIndexNO"></div>
	<div id="divChannelIndexIndicator"></div>	
</div>-->
<?php $this->_tpl_include('footer.tpl'); ?>