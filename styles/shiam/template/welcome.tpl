<!-- INCLUDE header.tpl -->

<!-- Bground Video -->

<!-- IF S_BGROUND_CLIP -->
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}" type="video/mp4">
</video> 
<!-- ENDIF -->


<div id="divHomeClip">
    <video autoplay loop mute width="700" id="HomeClip"><source src="{T_HOME_CLIP_PATH}" type="video/mp4"></video>
</div>

<div id="apDiv2"></div>
    
<div id="apDiv3">
  <span align="center"><!--<h3><strong>{S_WELCOME_TITLE}</strong><br/>{S_GUEST_NAME}</h3>--></span>
  <p>{S_WELCOME_CONTENT}</p>
</div>

<div id="posterLayer">{L_NOTICE}</div>
<!-- <div id=posterLayer></div> -->
<!--<div id="runningText"><marquee scrollamount="10" loop="" style="width:1280px;">Selamat Datang di Panghegar Hotel</marquee></div>
<div id="runningText">TES DRIVE BWAHAHAHHAHA</div> -->

<!-- INCLUDE footer.tpl -->