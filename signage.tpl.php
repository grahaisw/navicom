<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>
    
    <div id="template" style="overflow:hidden;">
        <?php if (isset($this->_rootref['S_TEMPLATE'])) { $this->_tpl_include($this->_rootref['S_TEMPLATE']); } ?>
    </div>
    </body></html>