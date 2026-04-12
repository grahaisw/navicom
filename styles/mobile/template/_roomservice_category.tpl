<!-- INCLUDE header.tpl -->


<!-- main container -->
    <div class="container">
		<h2>{L_PAGE_TITLE}</h2>
		
		<ul class="nav nav-tabs">
			<!-- BEGIN category -->
			<li class="{category.S_ACTIVE_STYLE}"><a data-toggle="tab" href="#m{category.S_ID}">{category.S_CAT_TITLE}</a></li>
			<!-- END category -->
		</ul>

		<div class="tab-content">
			
			<div style="position: relative; width: 100%; background-color: #969595; overflow: hidden;">
				<div style="position: relative; left: 50%; width: 5000px; text-align: center; margin-left: -2500px;">
					<!-- Jssor Slider Begin -->
					<div id="slider1_container" style="position: relative; margin: 0 auto;
						top: 0px; left: 0px; width: 980px; height: 400px; background-color: #635e5e;">
						
						<!-- Slides Container -->
						<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 980px;
							height: 400px; overflow: hidden;">
							
							<!-- BEGIN category -->
							<div id="menu{category.S_ID}">
								<div style="position: absolute; width: 480px; height: 300px; top: 10px; left: 10px;
									text-align: left; line-height: 1.8em; font-size: 12px;">
									<br />
									<span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 36px;
										color: #FFFFFF;">{category.S_CAT_TITLE}</span>
									<br />
									<br />
									<span style="display: block; line-height: 1.1em; font-size: 2.5em; color: #FFFFFF;">{category.S_DESCRIPTION}</span>
									<br />
									<span style="display: block; line-height: 1.1em; font-size: 1.5em; color: #FFFFFF;"><img src="{T_MEDIA_IMAGE_FNB_PATH}/600x400/{category.S_THUMBNAIL}.jpg" width="180px"/>
									<font color="red">{category.S_CAT_TITLE}°C</font> - <font color="blue">{category.S_CAT_TITLE}°C</font>
									</span>
									<br />
									<br />
								</div>
								<img src="{T_IMAGESET_PATH}/city/600x400/{category.S_THUMBNAIL}.jpg" style="position: absolute; top: 0px; left: 380px; width: 600px; height: 400px;" />
								<img u="thumb" src="{T_IMAGESET_PATH}/city/600x400/{category.S_THUMBNAIL}.jpg" />
							</div>

							<!-- END category -->
							
						</div>
						<!-- Direction Navigator Skin Begin -->
						<style>
							/* jssor slider direction navigator skin 07 css */
							/*
							.jssord07l              (normal)
							.jssord07r              (normal)
							.jssord07l:hover        (normal mouseover)
							.jssord07r:hover        (normal mouseover)
							.jssord07ldn            (mousedown)
							.jssord07rdn            (mousedown)
							*/
							.jssord07l, .jssord07r, .jssord07ldn, .jssord07rdn
							{
								position: absolute;
								cursor: pointer;
								display: block;
								background: url(../img/d07.png) no-repeat;
								overflow: hidden;
							}
							.jssord07l
							{
								background-position: -5px -35px;
							}
							.jssord07r
							{
								background-position: -65px -35px;
							}
							.jssord07l:hover
							{
								background-position: -125px -35px;
							}
							.jssord07r:hover
							{
								background-position: -185px -35px;
							}
							.jssord07ldn
							{
								background-position: -245px -35px;
							}
							.jssord07rdn
							{
								background-position: -305px -35px;
							}
						</style>
						<!-- Arrow Left -->
						<span u="arrowleft" class="jssord07l" style="width: 50px; height: 50px; top: 123px;
							left: 8px;"></span>
						<!-- Arrow Right -->
						<span u="arrowright" class="jssord07r" style="width: 50px; height: 50px; top: 123px;
							right: 8px"></span>
						<!-- Direction Navigator Skin End -->
						<!-- ThumbnailNavigator Skin Begin -->
						<div u="thumbnavigator" class="jssort04" style="position: absolute; width: 600px;
							height: 60px; right: 0px; bottom: 0px;">
							<!-- Thumbnail Item Skin Begin -->
							<style>
								/* jssor slider thumbnail navigator skin 04 css */
								/*
								.jssort04 .p            (normal)
								.jssort04 .p:hover      (normal mouseover)
								.jssort04 .pav          (active)
								.jssort04 .pav:hover    (active mouseover)
								.jssort04 .pdn          (mousedown)
								*/
								.jssort04 .w, .jssort04 .pav:hover .w
								{
									position: absolute;
									width: 60px;
									height: 30px;
									border: #0099FF 1px solid;
								}
								* html .jssort04 .w
								{
									width: /**/ 62px;
									height: /**/ 32px;
								}
								.jssort04 .pdn .w, .jssort04 .pav .w
								{
									border-style: solid;
								}
								.jssort04 .c
								{
									width: 62px;
									height: 32px;
									filter: alpha(opacity=45);
									opacity: .45;
									transition: opacity .6s;
									-moz-transition: opacity .6s;
									-webkit-transition: opacity .6s;
									-o-transition: opacity .6s;
								}
								.jssort04 .p:hover .c, .jssort04 .pav .c
								{
									filter: alpha(opacity=0);
									opacity: 0;
								}
								.jssort04 .p:hover .c
								{
									transition: none;
									-moz-transition: none;
									-webkit-transition: none;
									-o-transition: none;
								}
							</style>
							<div u="slides" style="bottom: 25px; right: 30px;">
								<div u="prototype" class="p" style="position: absolute; width: 62px; height: 32px; top: 0; left: 0;">
									<div class="w">
										<thumbnailtemplate style="width: 100%; height: 100%; border: none; position: absolute; top: 0; left: 0;"></thumbnailtemplate>
									</div>
									<div class="c" style="position: absolute; background-color: #000; top: 0; left: 0">
									</div>
								</div>
							</div>
							<!-- Thumbnail Item Skin End -->
						</div>
						<!-- ThumbnailNavigator Skin End -->
						<a style="display: none" href="http://www.jssor.com">Responsive Slider</a>
					</div>
					<!-- Jssor Slider End -->
				</div>
			</div>
			
			
			<!-- BEGIN category -->
			<div id="m{category.S_ID}" class="tab-pane fade{category.S_ACTIVE_STYLE2}">
			  <h3>{category.S_CAT_TITLE}</h3>
			  <p>{category.S_DESCRIPTION}</p>
			</div>
			<!-- END category -->
		</div>
	</div>
	
	


<!-- INCLUDE footer.tpl -->