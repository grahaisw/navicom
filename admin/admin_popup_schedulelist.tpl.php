<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

<script type="text/javascript">
$(document).ready(function() {
		var table = $('#tnode').DataTable({
			 

		 });

		table.buttons().container()
			.appendTo($('.dataTables_filter', table.table().container()));


        $('#tnode tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });


        var table = $('#tnode').DataTable();

      
    } );
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('<?php echo ((isset($this->_rootref['L_CONFIRM_DELETE'])) ? $this->_rootref['L_CONFIRM_DELETE'] : ((isset($user->lang['CONFIRM_DELETE'])) ? $user->lang['CONFIRM_DELETE'] : '{ CONFIRM_DELETE }')); ?>');
    });
});

</script>
<!--<style type="text/css">
	th,td{
		text-align: center;
	}
	.table-bordered{
		border:1px solid #f00!important;
	}
	.table{
		border-style: 1px solid #444;
	}


</style>-->
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>Popup List</h1>



			<table cellspacing="1" class="table table-bordered table-striped" >
			<thead>

			
			</thead>
			<tbody cellspacing="1">
		

			</tbody>
			</table>
			<table cellspacing="1" id="tnode" class="table1">
				<thead>
					<tr>
						<th><?php echo ((isset($this->_rootref['L_ADS_NAME'])) ? $this->_rootref['L_ADS_NAME'] : ((isset($user->lang['ADS_NAME'])) ? $user->lang['ADS_NAME'] : '{ ADS_NAME }')); ?></th>
						<th><?php echo ((isset($this->_rootref['L_DATE'])) ? $this->_rootref['L_DATE'] : ((isset($user->lang['DATE'])) ? $user->lang['DATE'] : '{ DATE }')); ?></th>
						<th><?php echo ((isset($this->_rootref['L_TIME'])) ? $this->_rootref['L_TIME'] : ((isset($user->lang['TIME'])) ? $user->lang['TIME'] : '{ TIME }')); ?></th>
						<th><?php echo ((isset($this->_rootref['L_ZONE'])) ? $this->_rootref['L_ZONE'] : ((isset($user->lang['ZONE'])) ? $user->lang['ZONE'] : '{ ZONE }')); ?></th>
						<th><?php echo ((isset($this->_rootref['L_CHANNEL'])) ? $this->_rootref['L_CHANNEL'] : ((isset($user->lang['CHANNEL'])) ? $user->lang['CHANNEL'] : '{ CHANNEL }')); ?></th>
			  <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>

					</tr>
				</thead>
			
				<tbody>
				<?php $_popup_count = (isset($this->_tpldata['popup'])) ? sizeof($this->_tpldata['popup']) : 0;if ($_popup_count) {for ($_popup_i = 0; $_popup_i < $_popup_count; ++$_popup_i){$_popup_val = &$this->_tpldata['popup'][$_popup_i]; if (!($_tv_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

						
						<td><?php echo $_popup_val['NAME']; ?></td>
						<td><?php echo $_popup_val['START']; ?> - <?php echo $_popup_val['END']; ?></td>
						<td><?php echo $_popup_val['TIME']; ?></td>
						<td><?php echo $_popup_val['ZONE']; ?></td>
						<td><?php echo $_popup_val['CHANNEL']; ?></td>

			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_popup_val['U_UPDATE']; ?>" rel="facebox"><img src="<?php echo $_popup_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_popup_val['L_UPDATE']; ?>" title="<?php echo $_popup_val['L_UPDATE']; ?>" /></a></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_popup_val['U_DELETE']; ?>&time=<?php echo $_popup_val['TIMES']; ?>" id="DeleteLink"><img src="<?php echo $_popup_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_popup_val['L_DELETE']; ?>" title="<?php echo $_popup_val['L_DELETE']; ?>" /></a>
			    </td>
			    <?php } ?>

					</tr>
				<?php }} ?>

				</tbody>
				
				
			</table>
			
			</div>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>