<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">
			<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>
			<a href="<?php echo (isset($this->_rootref['U_ADD'])) ? $this->_rootref['U_ADD'] : ''; ?>" rel="facebox"><?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?></a>
			<?php } ?>
			<span class="corners-top2"><span>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td width="85%"><input id="name" name="name" type="text" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" size="80"/>
			    </td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_SIGNAGE'])) ? $this->_rootref['L_SIGNAGE'] : ((isset($user->lang['SIGNAGE'])) ? $user->lang['SIGNAGE'] : '{ SIGNAGE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_SIGNAGE'])) ? $this->_rootref['S_SIGNAGE'] : ''; ?></td>
			</tr>
            <tr>
			    <td><label><?php echo ((isset($this->_rootref['L_REGION'])) ? $this->_rootref['L_REGION'] : ((isset($user->lang['REGION'])) ? $user->lang['REGION'] : '{ REGION }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_REGION'])) ? $this->_rootref['S_REGION'] : ''; ?></td>
			</tr>
            <tr>
			    <td><label><?php echo ((isset($this->_rootref['L_TYPE'])) ? $this->_rootref['L_TYPE'] : ((isset($user->lang['TYPE'])) ? $user->lang['TYPE'] : '{ TYPE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_TYPE'])) ? $this->_rootref['S_TYPE'] : ''; ?></td>
			</tr>
            <tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_PLAYLIST'])) ? $this->_rootref['L_PLAYLIST'] : ((isset($user->lang['PLAYLIST'])) ? $user->lang['PLAYLIST'] : '{ PLAYLIST }')); ?>:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_PLAYLIST'])) ? $this->_rootref['S_PLAYLIST'] : ''; ?> /><label>&nbsp;</label></td>
			</tr>
            <tr id="def_playlist" <?php echo (isset($this->_rootref['S_PLAYLIST_STYLE'])) ? $this->_rootref['S_PLAYLIST_STYLE'] : ''; ?>>
			    <td><label><?php echo ((isset($this->_rootref['L_DEFAULT_PLAYLIST'])) ? $this->_rootref['L_DEFAULT_PLAYLIST'] : ((isset($user->lang['DEFAULT_PLAYLIST'])) ? $user->lang['DEFAULT_PLAYLIST'] : '{ DEFAULT_PLAYLIST }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_DEFAULT_PLAYLIST'])) ? $this->_rootref['S_DEFAULT_PLAYLIST'] : ''; ?></td>
			</tr>
			
            <tr id="def_source" <?php echo (isset($this->_rootref['S_OTHER_STYLE'])) ? $this->_rootref['S_OTHER_STYLE'] : ''; ?>>
			    <td><label><?php echo ((isset($this->_rootref['L_SOURCE'])) ? $this->_rootref['L_SOURCE'] : ((isset($user->lang['SOURCE'])) ? $user->lang['SOURCE'] : '{ SOURCE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_SOURCE'])) ? $this->_rootref['S_SOURCE'] : ''; ?></td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
			    <td><p class="submit-buttons">
			    <input class="button1" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;
				</p><?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?></td>
			</tr>

			</table>
			
			<hr />
			
			</form>
			</div>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<script type="text/javascript">

$("#enabled").on("click", function(){
    if($('#enabled').is(':checked')) {
        $("#def_playlist").show();
        //$("#def_type").hide();
        $("#def_source").hide();       
    } else {
        $("#playlist_id").find('option:selected').removeAttr('selected');
        $("#def_playlist").hide();
        //$("#def_type").show();
        $("#def_source").show();   
    }
    
    var type_id = $("#type_id").val();
    get_content(type_id);
});
  

function get_content(type_id) {   
    var param = "";
    if($('#enabled').is(':checked')) {
        var param = "&is_playlist=true";
    }
    $.ajax({
        url: "signage_ajax.php",
        cache: false,
        type: "POST",
        data: "mod=signage&type_id=" + type_id + param,
        success: function(response){
            $(".playlist option").each(function() {
                $(this).remove();
            });
            $(".playlist").append(response);
            
        }
    });
}

</script>
    
<?php $this->_tpl_include('overall_footer.tpl'); ?>