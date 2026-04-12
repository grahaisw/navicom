<!-- INCLUDE admin_header.tpl -->

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			
			<h2>{L_TITLE}</h2>

			<form method="post" id="mcp" action="{U_POST_ACTION}">

			    <div class="inner"><span class="corners-top2"><span></span></span>

			     <fieldset class="display-options" style="float: left">
			  {L_SEARCH_KEYWORDS}: <input type="text" name="keywords" value="{S_KEYWORDS}" />&nbsp;<input type="submit" class="button2" name="filter" value="{L_SEARCH}" />
			    </fieldset>

			<table cellspacing="1" class="table1">
			<thead>
			<tr>
			  <th>{L_MAC}</th>
			  <th>{L_IP}</th>
			  <th>{L_USERNAME}</th>
			  <th>{L_LAST_ACTIVITY}</th>
			  <th>{L_MODULE}</th>
			  <th>{L_BROWSER}</th>
			  <!-- IF S_CLEAR_ALLOWED --><th>{L_MARK}</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_SESSIONS -->
			  <!-- BEGIN session -->
			  <!-- IF session.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{session.MAC}</td>
			    <td>{session.NODE}</td>
			    <td>{session.USERNAME}</td>
			    <td>{session.LAST_ACTIVITY}</td>
			    <td>{session.MODULE}</td>
			    <td>{session.BROWSER}</td>
			    <!-- IF S_CLEAR_ALLOWED --><td style="width: 5%" align="center"><input type="checkbox" name="mark[]" value="{session.ID}" /></td><!-- ENDIF -->
			  </tr>
			<!-- END session -->
			<!-- ELSE -->
			  <tr>
			    <td class="bg1" colspan="<!-- IF S_CLEAR_ALLOWED -->5<!-- ELSE -->4<!-- ENDIF -->" align="center"><span class="gen">{L_NO_ENTRIES}</span></td>
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