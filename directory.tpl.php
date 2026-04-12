<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?><!-- main container -->
    <div class="container">

      <!-- 2-column layout 
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9"> -->

          <!-- jumbotron 
          <div class="jumbotron">	-->
            
	    <div id="container">
		<h2><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></h2>

		<ul class="pgwSlider">
		<?php $_directory_count = (isset($this->_tpldata['directory'])) ? sizeof($this->_tpldata['directory']) : 0;if ($_directory_count) {for ($_directory_i = 0; $_directory_i < $_directory_count; ++$_directory_i){$_directory_val = &$this->_tpldata['directory'][$_directory_i]; ?>

		    <li><img src="<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/directories/600x400/<?php echo $_directory_val['S_IMAGE']; ?>" alt="<?php echo $_directory_val['S_TITLE']; ?>" data-description="<?php echo $_directory_val['S_CONTENT']; ?>"></li>
		<?php }} ?>

		</ul>

	    </div>
            
          <!--  
          </div>	-->

 <!--
        </div>

   
      </div>/row-->

    </div><!--/.container-->


<?php $this->_tpl_include('footer.tpl'); ?>