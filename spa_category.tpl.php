<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?><!-- main container -->
    <div class="container">
		<h2><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></h2>
		
		<div class="row" style="background:url(media/images/bground/watermark2.jpg) center bottom;height:400px;font-size:16px;">
			<div class="col-sm-4">
				<?php $_category_count = (isset($this->_tpldata['category'])) ? sizeof($this->_tpldata['category']) : 0;if ($_category_count) {for ($_category_i = 0; $_category_i < $_category_count; ++$_category_i){$_category_val = &$this->_tpldata['category'][$_category_i]; ?>
				<a href="<?php echo $_category_val['S_CAT_URL']; ?>">
					<div class="row">
						<div style="margin:15px 0 0 15px;background-color:#fff;height:40px;color:#000;background-position:right;border-radius: 0 50px 50px 0;padding:5px 10px;opacity:0.7;"><?php echo $_category_val['S_CAT_TITLE']; ?></div>
					</div>
				</a>
				<?php }} ?>
				<div class="col-xs-12 col-sm-8"></div>
			</div>
		</div>
		
	</div>
	
	


<?php $this->_tpl_include('footer.tpl'); ?>