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
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td width="85%"><input name="name" type="text" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" size="80"/>
			    </td>
			</tr>

			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_FILE'])) ? $this->_rootref['L_FILE'] : ((isset($user->lang['FILE'])) ? $user->lang['FILE'] : '{ FILE }')); ?>:</label></td>
			    <td><input name="file" type="text" value="<?php echo (isset($this->_rootref['S_FILE'])) ? $this->_rootref['S_FILE'] : ''; ?>" size="80"/>
			    </td>
			</tr>
            <tr>
			    <td><label><?php echo ((isset($this->_rootref['L_ADS'])) ? $this->_rootref['L_ADS'] : ((isset($user->lang['ADS'])) ? $user->lang['ADS'] : '{ ADS }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ADS'])) ? $this->_rootref['S_ADS'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?>/><label>&nbsp;</label></td>
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
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_FILE'])) ? $this->_rootref['L_FILE'] : ((isset($user->lang['FILE'])) ? $user->lang['FILE'] : '{ FILE }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_FILE'])) ? $this->_rootref['S_FILE'] : ''; ?></td>
			</tr>
             <tr>
			    <td>&nbsp;</td>
			    <td><video id="myVideo" src="<?php echo (isset($this->_rootref['S_FILE_PATH'])) ? $this->_rootref['S_FILE_PATH'] : ''; ?>" width="300" height="300" preload="auto" controls="controls" ></video>
			    </td>
			</tr>
            <tr>
			    <td><label><?php echo ((isset($this->_rootref['L_DURATION'])) ? $this->_rootref['L_DURATION'] : ((isset($user->lang['DURATION'])) ? $user->lang['DURATION'] : '{ DURATION }')); ?>:</label></td>
			    <td id="duration"></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_ADS'])) ? $this->_rootref['L_ADS'] : ((isset($user->lang['ADS'])) ? $user->lang['ADS'] : '{ ADS }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ADS'])) ? $this->_rootref['S_ADS'] : ''; ?></td>
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

    <script>
    var myVideoPlayer = document.getElementById('myVideo');
    myVideoPlayer.addEventListener('loadedmetadata', function() {
        var duration = myVideoPlayer.duration;
        var min = Math.floor(duration/60);
        var sec = Math.round(duration%60);
        if(min < 10) min = "0" + min;
        if(sec < 10) sec = "0" + sec;
        document.getElementById('duration').innerHTML = min + ":" + sec;
    });
    
    </script>
    
<?php $this->_tpl_include('overall_footer.tpl'); ?>