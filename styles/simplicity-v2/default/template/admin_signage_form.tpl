<!-- INCLUDE admin_header.tpl -->

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<div class="inner">
			<!-- IF S_ADD_UPDATE -->
			<a href="{U_ADD}" rel="facebox">{L_ADD}</a>
			<!-- ENDIF -->
			<span class="corners-top2"><span>
			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_NAME}:</label></td>
			    <td width="85%"><input id="name" name="name" type="text" value="{S_NAME}" size="80"/>
			    </td>
			</tr>
			<tr>
			    <td><label>{L_SIGNAGE}:</label></td>
			    <td>{S_SIGNAGE}</td>
			</tr>
            <tr>
			    <td><label>{L_REGION}:</label></td>
			    <td>{S_REGION}</td>
			</tr>
            <tr>
			    <td><label>{L_TYPE}:</label></td>
			    <td>{S_TYPE}</td>
			</tr>
            <tr>
			    <td><label for="enabled">{L_PLAYLIST}:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {S_PLAYLIST} /><label>&nbsp;</label></td>
			</tr>
            <tr id="def_playlist" {S_PLAYLIST_STYLE}>
			    <td><label>{L_DEFAULT_PLAYLIST}:</label></td>
			    <td>{S_DEFAULT_PLAYLIST}</td>
			</tr>
			
            <tr id="def_source" {S_OTHER_STYLE}>
			    <td><label>{L_SOURCE}:</label></td>
			    <td>{S_SOURCE}</td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
			    <td><p class="submit-buttons">
			    <input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />&nbsp;
				</p>{S_FORM_TOKEN}</td>
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
    
<!-- INCLUDE overall_footer.tpl -->