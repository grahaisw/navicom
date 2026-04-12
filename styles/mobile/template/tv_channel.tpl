<!-- INCLUDE header.tpl -->

<!-- main container -->
    <div class="container">
    <h2>{L_PAGE_TITLE}</h2>
      

      <!-- 2-column layout -->
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">

          <!-- jumbotron -->
	    
	    <div style="display:none;" class="html5gallery" data-skin="light"  data-autoplayvideo="true" data-width="720" data-height="400" data-thumbwidth="60" data-thumbheight="60" data-responsive="true">

		<!-- BEGIN channel -->
		<div class="panel-body" style="text-align: center;">
		<a href="{channel.S_URL}">
		<img src="{T_IMAGESET_PATH}/icontv/60x60/{channel.S_THUMBNAIL}" alt="{channel.S_TITLE}" data-description="{channel.S_TITLE}"></a>
		</div>
		<!-- END channel -->
   
	    </div>



          <div class="row">

           
          </div><!--/row-->
        </div><!--/span-->


      </div><!--/row-->

    </div><!--/.container-->

<!-- INCLUDE footer.tpl -->