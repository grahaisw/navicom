<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>


<video autoplay loop id="bgvid">
	<source src="<?php echo (isset($this->_rootref['S_MOVIE'])) ? $this->_rootref['S_MOVIE'] : ''; ?>" type="video/mp4">
</video>

<?php $this->_tpl_include('footer.tpl'); ?>