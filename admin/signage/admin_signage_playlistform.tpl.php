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
            <?php if ($this->_rootref['S_FORM']) {  ?>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
            <input type="hidden" id="type" name="type" value="" />
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td width="85%"><input name="name" type="text" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" size="80"/>
			    </td>
			</tr>

			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?>:</label></td>
			    <td><textarea  name="description" id="description" rows="5" cols="40">
				  <?php echo (isset($this->_rootref['S_DESCRIPTION'])) ? $this->_rootref['S_DESCRIPTION'] : ''; ?></textarea>
			    </td>
			</tr>
			<tr>
			    <td><label for="node"><?php echo ((isset($this->_rootref['L_TYPE'])) ? $this->_rootref['L_TYPE'] : ((isset($user->lang['TYPE'])) ? $user->lang['TYPE'] : '{ TYPE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_TYPE'])) ? $this->_rootref['S_TYPE'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?>/><label>&nbsp;</label></td>
			</tr>
            <!--<tr>
			    <td><label for="loop"><?php echo ((isset($this->_rootref['L_LOOP'])) ? $this->_rootref['L_LOOP'] : ((isset($user->lang['LOOP'])) ? $user->lang['LOOP'] : '{ LOOP }')); ?>:</label></td>
			    <td><input id="loop" name="loop_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_LOOP'])) ? $this->_rootref['S_LOOP'] : ''; ?>/></td>
			</tr>-->
            <tr>
			    <td><label for="content"><?php echo ((isset($this->_rootref['L_CONTENT'])) ? $this->_rootref['L_CONTENT'] : ((isset($user->lang['CONTENT'])) ? $user->lang['CONTENT'] : '{ CONTENT }')); ?>:</label></td>
			    <td id="playlist_content"><?php echo (isset($this->_rootref['S_CONTENT'])) ? $this->_rootref['S_CONTENT'] : ''; ?></td>
			</tr>
            <tr id="pl_duration" <?php echo (isset($this->_rootref['S_STYLE'])) ? $this->_rootref['S_STYLE'] : ''; ?>>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DURATION'])) ? $this->_rootref['L_DURATION'] : ((isset($user->lang['DURATION'])) ? $user->lang['DURATION'] : '{ DURATION }')); ?>:</label></td>
			    <td width="85%"><input name="duration" type="text" value="<?php echo (isset($this->_rootref['S_DURATION'])) ? $this->_rootref['S_DURATION'] : ''; ?>" size="5"/> second
			    </td>
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
            <?php } if ($this->_rootref['S_DETAIL']) {  ?>
			<table cellspacing="1">
			<tr>
			    <td><label for="global"><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?></td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_DESCRIPTION'])) ? $this->_rootref['S_DESCRIPTION'] : ''; ?></td>
			</tr>
            <tr>
			    <td><label><?php echo ((isset($this->_rootref['L_TYPE'])) ? $this->_rootref['L_TYPE'] : ((isset($user->lang['TYPE'])) ? $user->lang['TYPE'] : '{ TYPE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_TYPE'])) ? $this->_rootref['S_TYPE'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CONTENT'])) ? $this->_rootref['L_CONTENT'] : ((isset($user->lang['CONTENT'])) ? $user->lang['CONTENT'] : '{ CONTENT }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_CONTENT'])) ? $this->_rootref['S_CONTENT'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?></td>
			</tr>

			</table>
			<hr />  
            <?php } ?>
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
$(document).ready(function() {
    
});

function get_content(type_id, url) {
    if(type_id == 1) {
        $("#pl_duration").show();
    } else {
        $("#pl_duration").hide();
    }
    $.ajax({
        url: "signage_ajax.php",
        cache: false,
        type: "POST",
        data: "mod=playlist&type_id=" + type_id,
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