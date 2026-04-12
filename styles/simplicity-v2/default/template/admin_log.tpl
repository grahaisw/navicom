<!-- INCLUDE admin_header.tpl -->
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<form method="post" id="mcp" action="{U_ACTION}">
			
			    <div class="inner"><span class="corners-top2"><span></span></span>

			    <fieldset class="display-options" style="float: left">
			  {L_SEARCH_KEYWORDS}: <input type="text" name="keywords" value="{S_KEYWORDS}" />&nbsp;<input type="submit" class="button2" name="filter" value="{L_SEARCH}" />
			    </fieldset>

			<table cellspacing="1" class="table1">
			<thead>
			<tr>
			  <th>{L_TIME}</th>
			  <th>{L_USERNAME}</th>
			  <th>{L_ACTION}</th>
			  <th>{L_MODULE}</th>
			  <th>{L_MAC}</th>
			  <!-- IF S_CLEAR_ALLOWED --><th>{L_MARK}</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_LOGS -->
			  <!-- BEGIN log -->
			  <!-- IF log.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td><a href="{log.U_TIME}" rel="facebox">{log.TIME}</a></td>
			    <td>{log.USERNAME}</td>
			    <td>{log.ACTION}</td>
			    <td>{log.MODULE}</td>
			    <td>{log.MAC}</td>
			    <!-- IF S_CLEAR_ALLOWED --><td style="width: 5%" align="center"><input type="checkbox" name="mark[]" value="{log.ID}" /></td><!-- ENDIF -->
			  </tr>
			<!-- END log -->
			<!-- ELSE -->
			  <tr>
			    <td class="bg1" colspan="<!-- IF S_CLEAR_ALLOWED -->6<!-- ELSE -->5<!-- ENDIF -->" align="center"><span class="gen">{L_NO_ENTRIES}</span></td>
			  </tr>
			<!-- ENDIF -->
			</tbody>
			</table>
		
		<!-- IF PAGINATION -->
			<div class="pagination">
			    <a href="#" onclick="jumpto(); return false;" title="{L_JUMP_TO_PAGE}">{S_ON_PAGE}</a> &bull; <span>{PAGINATION}</span>
			</div>
		<!-- ENDIF -->

			<fieldset class="display-options">
			    {L_DISPLAY_LOG}: &nbsp;{S_LIMIT_DAYS}&nbsp;{L_SORT_BY}: {S_SORT_KEY} {S_SORT_DIR}
			    <input class="button2" type="submit" value="{L_GO}" name="sort" />
			    {S_FORM_TOKEN}
			</fieldset>
			<hr />

			</span></span></div>
  
</form>

<br />


		    </div>
		 </div>

		 <span class="corners-bottom"><span></span></span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<!-- INCLUDE overall_footer.tpl -->