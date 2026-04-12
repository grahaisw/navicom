<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>


<div class="title"><!--<h1 style="font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;"><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?><h1>--></div>
<!--<div id="divLogo"></div>-->
<?php if ($this->_rootref['S_HOTSPOT']) {  ?>

<div id="hotspot"><p style="text-align:center;"> <?php echo ((isset($this->_rootref['L_HOTSPOT_INFO'])) ? $this->_rootref['L_HOTSPOT_INFO'] : ((isset($user->lang['HOTSPOT_INFO'])) ? $user->lang['HOTSPOT_INFO'] : '{ HOTSPOT_INFO }')); ?></p>
        <div style="width:79px;display:inline-block;"><?php echo ((isset($this->_rootref['L_HOTSPOT_USER'])) ? $this->_rootref['L_HOTSPOT_USER'] : ((isset($user->lang['HOTSPOT_USER'])) ? $user->lang['HOTSPOT_USER'] : '{ HOTSPOT_USER }')); ?></div><div style="display:inline-block;">: <?php echo (isset($this->_rootref['S_HOTSPOT_USER'])) ? $this->_rootref['S_HOTSPOT_USER'] : ''; ?></div><br>
        <div style="width:79px;display:inline-block;"><?php echo ((isset($this->_rootref['L_HOTSPOT_PWD'])) ? $this->_rootref['L_HOTSPOT_PWD'] : ((isset($user->lang['HOTSPOT_PWD'])) ? $user->lang['HOTSPOT_PWD'] : '{ HOTSPOT_PWD }')); ?></div><div style="display:inline-block;">: <?php echo (isset($this->_rootref['S_HOTSPOT_PWD'])) ? $this->_rootref['S_HOTSPOT_PWD'] : ''; ?></div>
</div>
<?php } $this->_tpl_include('footer.tpl'); ?>