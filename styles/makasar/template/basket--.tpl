<!-- INCLUDE header.tpl -->

<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->

<div id="divVideoContainer" class="divVideoContainer">
    <video id="media" class="videoControl" loop></video>
</div>
<!--
<div id="apDiv2">
    <video autoplay loop id="home"><source src="../../../../vod/wonderful-indonesia-bali.mp4" type="video/mp4"></video> 
</div>-->
    
<div id="divChannelList">
    <div id="divChannelListItems">
    </div>
</div>



<div id="pageTitle">{L_PAGE_TITLE}</div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>

<div id="divBasket">

<form action="basket.php?o=1" method="post" >
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <!-- BEGIN somerow -->
  <tr>
    <td>{somerow.GUEST_QTY}</td>
    <td>{somerow.GUEST_ITEM}</td>
    <td><input type="hidden" name="code" value="{somerow.GUEST_ID}"/>
	<a href="{somerow.U_DELETE}" id="DeleteLink"><img src="{somerow.ICON_PATH}/delete.png" /></a>
	</td>
  </tr>
  <!-- END somerow -->

  <tr>
    <td colspan="3"><input type="hidden" name="code" value="{GUEST_ROOM}"/>
	<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="{L_CONFIRM}" />
	<input class="button blue close" type="submit" name="btnClear" id="btnClear" value="{L_CLEAR_FORM}" />
	<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="{L_CANCEL}" />
	</td>
  </tr>  
 
</table>
</form>

</div>




<div id="divControlContainer">
	
</div>

<input type="hidden" name="chIndex" id="chIndex" value="" />
<!--<div id="runningText"><marquee scrollamount="10" loop="" style="width:1280px;">Selamat Datang di Panghegar Hotel</marquee></div>
<div id="runningText">TES DRIVE BWAHAHAHHAHA</div> -->

<!-- INCLUDE footer.tpl -->