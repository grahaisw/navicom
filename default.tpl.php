<?php if (!defined('IN_TONJAW')) exit; ?><style>

#region1 {

    width:800px;

    height:100px;

    display:block;

    position:absolute;

    top:500px;

    /*background-color:red;*/

}

#region2 {

    width:800px;

    height:506px;

    display:block;

    position:absolute;

    top:0px;
    left: 20px;

    /*background-color:blue;*/

}

#region3 {

    width:444px;

    height:345px;

    position:absolute;

    top:0;

    right:0;

    /*background-color:yellow;*/

}

#region4 {

    width:408px;

    height:348px;

    position:absolute;

    top:300px;

    right:0;

    color:#fff;
    opacity: 0.9;

    /*background-color:green;*/

}

.marq {

    /*padding:0 20px 20px 20px;*/

    color:#fff;

    font-size:20px;

}   

.marq th {

    background-color:red;

	text-align:left;

}

#region5 {

    width:1280px;

    height:30px;

    padding-top:5px;

    position:absolute;

    top:600px;
    font-family: Arial;
    font-weight: bold;
    font-size:60px;

    color:#000;

    /*background-color:#08233F; */

}

#fids {

    display:none;

}

#fids_region1 {

    width:981px;

    height:780px;

    display:inline-block;

    position:absolute;

    top:0;

    color:#fff;

    /*background-color:red;*/

}

#fids_region2 {

    width:300px;

    height:420px;

    /*display:none;*/

    position:absolute;

    top:0;

    right:0;

    border-left: 1px solid #fff;

    border-bottom: 1px solid #fff;

    background-color:#000;

}

#fids_region3 {

    width:300px;

    height:265px;

    /*display:none;*/

    position:absolute;

    top:421px;

    right:0;

    color:#fff;

    border-left: 1px solid #fff;

    background-color:#000;

}

#emergency {

    width:1280px;

    height:600px;

    display:none;

    top:0;

    position:absolute;

}

#fullscreen {

    width:1280px;

    height:700px;

    display:none;

    top:0;

    position:absolute;

}

</style>

<p id="sql" style="color:#fff"></p>



<input type="hidden" id="region1_type" value="<?php echo (isset($this->_rootref['S_TYPE_1'])) ? $this->_rootref['S_TYPE_1'] : ''; ?>" />

<input type="hidden" id="region1_header" value="<?php echo (isset($this->_rootref['S_HEADER_1'])) ? $this->_rootref['S_HEADER_1'] : ''; ?>" />

<input type="hidden" id="region2_type" value="<?php echo (isset($this->_rootref['S_TYPE_2'])) ? $this->_rootref['S_TYPE_2'] : ''; ?>" />

<input type="hidden" id="region2_header" value="<?php echo (isset($this->_rootref['S_HEADER_2'])) ? $this->_rootref['S_HEADER_2'] : ''; ?>" />

<input type="hidden" id="region3_type" value="<?php echo (isset($this->_rootref['S_TYPE_3'])) ? $this->_rootref['S_TYPE_3'] : ''; ?>" />

<input type="hidden" id="region3_header" value="<?php echo (isset($this->_rootref['S_HEADER_3'])) ? $this->_rootref['S_HEADER_3'] : ''; ?>" />

<input type="hidden" id="region4_type" value="<?php echo (isset($this->_rootref['S_TYPE_4'])) ? $this->_rootref['S_TYPE_4'] : ''; ?>" />

<input type="hidden" id="region4_header" value="<?php echo (isset($this->_rootref['S_HEADER_4'])) ? $this->_rootref['S_HEADER_4'] : ''; ?>" />

<input type="hidden" id="region5_type" value="<?php echo (isset($this->_rootref['S_TYPE_5'])) ? $this->_rootref['S_TYPE_5'] : ''; ?>" />

<input type="hidden" id="region5_header" value="<?php echo (isset($this->_rootref['S_HEADER_5'])) ? $this->_rootref['S_HEADER_5'] : ''; ?>" />



<!-- SIGNAGE REGIONS -->

<div id="nonrunningtext">

    <div id="region1">

        <input type="hidden" id="region1_content" value="<?php echo (isset($this->_rootref['S_CONTENT_1'])) ? $this->_rootref['S_CONTENT_1'] : ''; ?>" />

        <input type="hidden" id="region1_content_duration" value="<?php echo (isset($this->_rootref['S_DURATION_1'])) ? $this->_rootref['S_DURATION_1'] : ''; ?>" />

        <input type="hidden" id="region1_schedule" value="" />

        <input type="hidden" id="region1_schedule_stop" value="" />

        <input type="hidden" id="region1_schedule_duration" value="" />

        <input type="hidden" id="region1_counter" value="" />

        <input type="hidden" id="region1_data" value="" />

        <input type="hidden" id="region1_dataCount" value="" />       

        <!--<img src="" width="100%" height="100%" />-->

    </div>

    <div id="region2">

        <input type="hidden" id="region2_content" value="<?php echo (isset($this->_rootref['S_CONTENT_2'])) ? $this->_rootref['S_CONTENT_2'] : ''; ?>" />

        <input type="hidden" id="region2_content_duration" value="<?php echo (isset($this->_rootref['S_DURATION_2'])) ? $this->_rootref['S_DURATION_2'] : ''; ?>" />

        <input type="hidden" id="region2_schedule" value="" />

        <input type="hidden" id="region2_schedule_stop" value="" />

        <input type="hidden" id="region2_schedule_duration" value="" />

        <input type="hidden" id="region2_counter" value="" />

        <input type="hidden" id="region2_data" value="" />

        <input type="hidden" id="region2_dataCount" value="" />       

    </div>

    <div id="region3">

        <input type="hidden" id="region3_content" value="<?php echo (isset($this->_rootref['S_CONTENT_3'])) ? $this->_rootref['S_CONTENT_3'] : ''; ?>" />

        <input type="hidden" id="region3_content_duration" value="<?php echo (isset($this->_rootref['S_DURATION_3'])) ? $this->_rootref['S_DURATION_3'] : ''; ?>" />

        <input type="hidden" id="region3_schedule" value="" />

        <input type="hidden" id="region3_schedule_stop" value="" />

        <input type="hidden" id="region3_schedule_duration" value="" />

        <input type="hidden" id="region3_counter" value="" />

        <input type="hidden" id="region3_data" value="" />

        <input type="hidden" id="region3_dataCount" value="" />        

        <!--<img src="" width="100%" height="100%" />-->

    </div>

    <div id="region4">

        <input type="hidden" id="region4_content" value="<?php echo (isset($this->_rootref['S_CONTENT_4'])) ? $this->_rootref['S_CONTENT_4'] : ''; ?>" />

        <input type="hidden" id="region4_content_duration" value="<?php echo (isset($this->_rootref['S_DURATION_4'])) ? $this->_rootref['S_DURATION_4'] : ''; ?>" />

        <input type="hidden" id="region4_schedule" value="" />

        <input type="hidden" id="region4_schedule_stop" value="" />

        <input type="hidden" id="region4_schedule_duration" value="" />

        <input type="hidden" id="region4_counter" value="" />

        <input type="hidden" id="region4_data" value="" />

        <input type="hidden" id="region4_dataCount" value="" />        

        <?php if ($this->_rootref['S_IMAGE']) {  ?>

        <!--<img src="" width="100%" height="100%" style="margin-top:0" />-->

        <?php } if ($this->_rootref['S_RSS']) {  ?>

        <!--<p><marquee scrollamount="3" loop="" scrolldelay="3" direction="up" style="height:100%"><?php echo (isset($this->_rootref['S_CONTENT_4'])) ? $this->_rootref['S_CONTENT_4'] : ''; ?></marquee></p>-->

        <?php } ?>

    </div>

</div>



<!-- FIDS -->

<div id="fids">   

    <div id="fids_region1">

        <div id="airline" style="width:420px;height:200px;display:inline-block;">

            <img src="" width="100%" height="100%" />

        </div>

        <div id="flight_number" align="center" style="width:550px;height:200px;display:inline-block;position:absolute;top:0;padding-top:50px;font-family:Arial;font-size:106px;"></div>

        <div id="destination" style="width:100%;height:120px;margin-top:10px;font-family:Arial;font-size:96px;"></div>

        <div style="width:100%;height:120px;margin-top:20px;font-family:Arial;font-size:80px;">

            <div id="dep_gate" style="float:left;"></div>

            <div id="dep_time" style="float:right;padding:0 15px;"></div>

        </div>

        <div id="message" align="center" style="width:100%;height:120px;margin-top:10px;font-family:Arial;font-size:96px;background-color:red;"></div>

    </div>

    <div id="fids_region2">

        <table id="fids_queue" style="color:#fff;width:100%;margin-top:20px;font-family:Arial" cellspacing="0" cellpadding="2" border="0"></table>

    </div>

    <div id="fids_region3">

        <p id="fids_date" style="font-size:40px;margin:0;padding:30px 10px 0 0;text-align:right;"></p><p id="fids_time" style="font-size:80px;margin-top:20px;text-align:center;"></p>

    </div>

</div>



<!-- EMERGENCY -->

<div id="emergency">

    <img src="media/images/signage/emergency.gif" width="100%" height="100%" />

	<div id="emergency_msg" style="width:100%;height:60px;background-color:#fff;color:red;text-align:center;font-size:46px;font-weight:bold;"></div>

</div>



<!-- FULLSCREEN CLIP -->

<div id="fullscreen"></div>



<!-- RUNNING TEXT -->

<div id="region5">

    <input type="hidden" id="region5_content" value="<?php echo (isset($this->_rootref['S_CONTENT_5'])) ? $this->_rootref['S_CONTENT_5'] : ''; ?>" />

    <input type="hidden" id="region5_content_duration" value="<?php echo (isset($this->_rootref['S_DURATION_5'])) ? $this->_rootref['S_DURATION_5'] : ''; ?>" />

    <input type="hidden" id="region5_schedule" value="" />

    <input type="hidden" id="region5_schedule_stop" value="" />

    <input type="hidden" id="region5_schedule_duration" value="" />

    <input type="hidden" id="region5_counter" value="" />

    <input type="hidden" id="region5_data" value="" />

    <input type="hidden" id="region5_dataCount" value="" />    

    <marquee scrollamount="10" loop="" scrolldelay="3"></marquee>

</div>

<input type="hidden" id="emergency_stop" value="" />

<input type="hidden" id="urgency_id" value="" />



<script>

var total_region = 5;

var video_region = 2;

var runningtext_region = 5;

var start = 0;

var is_fullscreen = 0;

var myVar, myVar1, myVar2, myVar3, myVar4, myVar5, myFIDS;

</script>

<script type="text/javascript" language="javascript" src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>signage.js"></script>