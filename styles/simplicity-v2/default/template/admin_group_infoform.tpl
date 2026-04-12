<!-- INCLUDE admin_header.tpl -->
<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
    });
});

</script>
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>
			    

			<div class="inner">

			<span class="corners-top2"><span>
		<!-- IF S_FORM -->
			<span class="navigation"><label>{L_LABEL}</label></span></br>
			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_GROUP}:</label></td>
			    <td width="85%">{S_GROUP}</td>
			</tr>
			<tr>
			    <td width="15%"><label>{L_TITLE}:</label></td>
			    <td width="85%"><input name="title" type="text" value="{S_TITLE}" size="60"/></td>
			</tr>
			<tr>
			    <td width="15%"><label>{L_LOGO}:</label></td>
			    <td width="85%"><input name="logo" type="text" value="{S_LOGO}" size="30"/></td>
			</tr>
			<tr>
			    <td><label>{L_WELCOME_SCREEN}:</label></td>
			    <td><textarea name="welcome_text" id="welcome_text">{S_WELCOME_SCREEN}</textarea></td>
			</tr>
			
			<tr id="trType">
			    <td width="15%"><label>{L_TYPE}:</label></td>
			    <td width="85%">
					<input name="type" type="radio" value="1" {S_CHECKED_TEXT} />Text
					<input name="type" type="radio" value="2" {S_CHECKED_IMAGE} />Image
					<input name="type" type="radio" value="3" {S_CHECKED_FULLSCREEN} />Img Fullscreen
					<input name="type" type="radio" value="4" {S_CHECKED_VIDEO} />Video
				</td>
			</tr>
			<!-- BEGIN texts -->
			<tr id="trText{texts.COUNTER_TEXT}" class="trText" style="{S_DISPLAY_TEXT}">
				<td><label>{L_CONTENT}:</label></td>
				<td><textarea name="content_text{texts.COUNTER_TEXT}">{texts.CONTENT_TEXT}</textarea>&nbsp;<a href="#" onclick="javascript:remove({texts.COUNTER_TEXT}, '1');">remove</a></td>
			</tr>
			<!-- END texts -->
			
			<!-- BEGIN images -->
			<tr id="trImage{images.COUNTER_IMAGE}" class="trImage" style="{S_DISPLAY_IMAGE}">
			    <td><label>{L_CONTENT}:</label></td>
			    <td><input name="content_image{images.COUNTER_IMAGE}" type="text" value="{images.CONTENT_IMAGE}" size="30"/>&nbsp;<a href="#" onclick="javascript:remove({images.COUNTER_IMAGE}, '2');">remove</a></td>
			</tr>
			<!-- END images -->
			
			<!-- BEGIN fullscreens -->
			<tr id="trImage{fullscreens.COUNTER_FULLSCREEN}" class="trImage" style="{S_DISPLAY_IMAGE}">
			    <td><label>{L_CONTENT}:</label></td>
			    <td><input name="content_image{fullscreens.COUNTER_FULLSCREEN}" type="text" value="{fullscreens.CONTENT_FULLSCREEN}" size="30"/>&nbsp;<a href="#" onclick="javascript:remove({fullscreens.COUNTER_FULLSCREEN}, '3');">remove</a></td>
			</tr>
			<!-- END fullscreens -->
			
			<!-- BEGIN videos -->
			<tr id="trVideo{videos.COUNTER_VIDEO}" class="trVideo" style="{S_DISPLAY_VIDEO}">
			    <td><label>{L_CONTENT}:</label></td>
			    <td><input name="content_video{videos.COUNTER_VIDEO}" type="text" value="{videos.CONTENT_VIDEO}" size="30"/></td>
			</tr>
			<!-- END videos -->
			
			<!-- IF S_ADD -->
			<tr id="trText0" style="{S_DISPLAY_TEXT}" class="trText">
				<td><label>{L_CONTENT}:</label></td>
				<td><textarea name="content_text0">{S_CONTENT_TEXT}</textarea>&nbsp;<a href="#" onclick="javascript:remove(0, '1');">remove</a></td>
			</tr>
			<tr id="trImage0" style="{S_DISPLAY_IMAGE}" class="trImage">
			    <td><label>{L_CONTENT}:</label></td>
			    <td><input name="content_image0" type="text" value="{S_CONTENT_IMAGE}" size="30"/>&nbsp;<a href="#" onclick="javascript:remove(0, '2');">remove</a></td>
			</tr>
			<tr id="trFullscreen0" style="{S_DISPLAY_FULLSCREEN}" class="trFullscreen">
			    <td><label>{L_CONTENT}:</label></td>
			    <td><input name="content_fullscreen0" type="text" value="{S_CONTENT_FULLSCREEN}" size="30"/>&nbsp;<a href="#" onclick="javascript:remove(0, '3');">remove</a></td>
			</tr>
			<tr id="trVideo0" style="{S_DISPLAY_VIDEO}" class="trVideo">
			    <td><label>{L_CONTENT}:</label></td>
			    <td><input name="content_video0" type="text" value="{S_CONTENT_VIDEO}" size="30"/>&nbsp;<a href="#" onclick="javascript:remove(0, '4');">remove</a></td>
			</tr>
			<!-- ENDIF -->
			<tr>
				<td>&nbsp;</td>
				<td><a href="#" onclick="javascript:add();">Add Content</a></td>
			</tr>
			<!--<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td><input type="text" name="image" class="inputbox autowidth"  value="{S_THUMBNAIL}"><br/>
			    <input id="thumbnail_enabled" name="thumbnail_enabled" type="checkbox" class="radio" {V_THUMBNAIL_ENABLED}/><label>{L_THUMBNAIL_ENABLED}</label></td>
			</tr>-->
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {V_ENABLED}/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
			    <td><p class="submit-buttons">
			    <input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />&nbsp;
				</p>{S_FORM_TOKEN}</td>
			</tr>
			<input type="hidden" id="counter_text" name="counter_text" value="{S_TOTAL_TEXT}" />
			<input type="hidden" id="counter_image" name="counter_image" value="{S_TOTAL_IMAGE}" />
			<input type="hidden" id="counter_fullscreen" name="counter_fullscreen" value="{S_TOTAL_FULLSCREEN}" />
			<input type="hidden" id="counter_video" name="counter_video" value="{S_TOTAL_VIDEO}" />
			</table>
			
			<hr />
			
			</form>
		<!-- ENDIF -->
		
			</div>
		      
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>
	
	<script>
	$('#mcp input[name=type]').on('change', function() {
		var type = $('input[name=type]:checked', '#mcp').val();
		
		if(type == '2') {
			var counter_image = $("#counter_image").val();
			var next_counter_image = 0;
			var image_exist = $("tr").hasClass("trImage");
			
			if(!image_exist) {
				var next_counter_image = 0;
				var string = '<tr id="trImage'+next_counter_image+'" class="trImage"><td><label>{L_CONTENT}:</label></td><td><input name="content_image'+next_counter_image+'" type="text" value="{S_CONTENT_IMAGE}" size="30"/></td></tr>';
			
				$(string).insertAfter("#trType");	
			}
			
			$(".trImage").show();
			$(".trText").hide();
			$(".trFullscreen").hide();
			$(".trVideo").hide();
		} else if(type == '1') {
			var counter_text = $("#counter_text").val(); 
			var next_counter_text = 0;
			var text_exist = $("tr").hasClass("trText");
			
			if(!text_exist) { 
				var string = '<tr id="trText'+next_counter_text+'" class="trText"><td><label>{L_CONTENT}:</label></td><td><textarea name="content_text'+next_counter_text+'">{S_CONTENT}</textarea></td></tr>';
			
				$(string).insertAfter("#trType");
			}
			
			$(".trText").show();
			$(".trImage").hide();
			$(".trFullscreen").hide();
			$(".trVideo").hide();
		} else if(type == '3') {
			var counter_fullscreen = $("#counter_fullscreen").val(); 
			var next_counter_fullscreen = 0;
			var fullscreen_exist = $("tr").hasClass("trFullscreen");
			
			if(!fullscreen_exist) { 
				var string = '<tr id="trFullscreen'+next_counter_fullscreen+'" class="trFullscreen"><td><label>{L_CONTENT}:</label></td><td><input name="content_fullscreen'+next_counter_fullscreen+'" type="text" value="{S_CONTENT_FULLSCREEN}" size="30"/></td></tr>';
			
				$(string).insertAfter("#trType");
			}
			
			$(".trFullscreen").show();
			$(".trText").hide();
			$(".trImage").hide();
			$(".trVideo").hide();
		} else if(type == '4') {
			var counter_video = $("#counter_video").val(); 
			var next_counter_video = 0;
			var video_exist = $("tr").hasClass("trVideo");
			
			if(!video_exist) { 
				var string = '<tr id="trVideo'+next_counter_video+'" class="trVideo"><td><label>{L_CONTENT}:</label></td><td><input name="content_video'+next_counter_video+'" type="text" value="{S_CONTENT_VIDEO}" size="30"/></td></tr>';
			
				$(string).insertAfter("#trType");
			}
			
			$(".trVideo").show();
			$(".trImage").hide();
			$(".trFullscreen").hide();
			$(".trText").hide();
		}
	});
	
	function add() {
		var type = $('input[name=type]:checked', '#mcp').val();
		if(type == '1') {
			var counter_text = $("#counter_text").val(); 
			var next_counter_text = parseInt(counter_text) + parseInt(1);
			
			var string = '<tr id="trText'+next_counter_text+'" class="trText"><td><label>{L_CONTENT}:</label></td><td><textarea name="content_text'+next_counter_text+'">{S_CONTENT}</textarea>&nbsp;<a href="#" onclick="javascript:remove('+next_counter_text+', \''+type+'\');">remove</a></td></tr>';
		
			$(string).insertAfter("#trText"+counter_text);
			counter_text++;
			$("#counter_text").val(counter_text);
			
		} else if(type == '2') {
			var counter_image = $("#counter_image").val();
			var next_counter_image = parseInt(counter_image) + parseInt(1);
			
			var string = '<tr id="trImage'+next_counter_image+'" class="trImage"><td><label>{L_CONTENT}:</label></td><td><input name="content_image'+next_counter_image+'" type="text" value="{S_CONTENT_IMAGE}" size="30"/>&nbsp;<a href="#" onclick="javascript:remove('+next_counter_image+', \''+type+'\');">remove</a></td></tr>';
			
			$(string).insertAfter("#trImage"+counter_image);
			counter_image++;
			$("#counter_image").val(counter_image);
		} else if(type == '3') {
			var counter_fullscreen = $("#counter_fullscreen").val();
			var next_counter_fullscreen = parseInt(counter_fullscreen) + parseInt(1);
			
			var string = '<tr id="trFullscreen'+next_counter_fullscreen+'" class="trFullscreen"><td><label>{L_CONTENT}:</label></td><td><input name="content_fullscreen'+next_counter_fullscreen+'" type="text" value="{S_CONTENT_FULLSCREEN}" size="30"/>&nbsp;<a href="#" onclick="javascript:remove('+next_counter_fullscreen+', \''+type+'\');">remove</a></td></tr>';
			
			$(string).insertAfter("#trFullscreen"+counter_fullscreen);
			counter_fullscreen++;
			$("#counter_fullscreen").val(counter_fullscreen);
		} else if(type == '4') {
			var counter_video = $("#counter_video").val();
			var next_counter_video = parseInt(counter_video) + parseInt(1);
			
			var string = '<tr id="trVideo'+next_counter_video+'" class="trVideo"><td><label>{L_CONTENT}:</label></td><td><input name="content_video'+next_counter_video+'" type="text" value="{S_CONTENT_VIDEO}" size="30"/>&nbsp;<a href="#" onclick="javascript:remove('+next_counter_video+', \''+type+'\');">remove</a></td></tr>';
			
			$(string).insertAfter("#trVideo"+counter_video);
			counter_video++;
			$("#counter_video").val(counter_video);
		}
		
		
	}
	
	function remove(counter, type) { 
		if(type == '1') {
			$("#trText" + counter).remove();
			counter--;
			$("#counter_text").val(counter);
			
		} else if(type == '2') {
			$("#trImage" + counter).remove();
			counter--;
			$("#counter_image").val(counter);
		} else if(type == '3') {
			$("#trFullscreen" + counter).remove();
			counter--;
			$("#counter_fullscreen").val(counter);
		} else if(type == '4') {
			$("#trVideo" + counter).remove();
			counter--;
			$("#counter_video").val(counter);
		}
	}
	</script>

<!-- INCLUDE overall_footer.tpl -->