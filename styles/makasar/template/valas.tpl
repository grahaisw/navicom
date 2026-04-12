<!-- INCLUDE header.tpl -->
<style type="text/css">
	table{
		color: #f4f4f4;
		font-size: 25px;
		width: 100%;
	}
	table th{
		text-align: center;
		background: #806200;
	}
	table td{
		text-align: right;
		background: #161616;
		padding: 3px 10px;
	}
	h1,h2,h3,h4,p{
		padding: 0;
		margin: 0;
	}
	h1{
		font-size: 40px!important;
	}
	#container{
		width: 90%;
		margin: auto;
		/*background: #f00;*/
	}
	#bingkai{
		padding: 20px;
	}
	.tengah{
		text-align: center!important;
	}
</style>
<div class="title"><!--<h1 style="font-family: {S_USER_LANG};">{L_TITLE}<h1>--></div>
<!--<div id="divLogo"></div>-->
<!-- IF S_HOTSPOT -->
<!-- <div id="hotspot"><p style="text-align:center;"> {L_HOTSPOT_INFO}</p> -->
        <!-- <div style="width:79px;display:inline-block;">{L_HOTSPOT_USER}</div><div style="display:inline-block;">: {S_HOTSPOT_USER}</div><br> -->
        <!-- <div style="width:79px;display:inline-block;">{L_HOTSPOT_PWD}</div><div style="display:inline-block;">: {S_HOTSPOT_PWD}</div> -->
<!-- </div> -->

 <div id="divVideoContainer" class="divVideoContainer">
    <video id="media" class="videoControl" style="display:none; "  autoplay loop src="{S_MB}"></video>
</div>
<div id="container">
	<div id="bingkai">
		<h1>Valas</h1>
		<table>
		<thead>
			<tr>
				<th>Mata Uang</th>
				<th>Jual</th>
				<th>Beli</th>
			</tr>
		</thead>
		<tbody>
			<!-- IF S_VALAS -->
			  <!-- BEGIN valas -->
			<tr>
				<td class="tengah">{valas.NAME}</td>
				<td>{valas.JUAL}</td>
				<td>{valas.BELI}</td>
			</tr>
				<!-- END valas -->
			<!-- ENDIF -->
		</tbody>
	</table>
	</div>
</div>
	
<!-- ENDIF -->
<!-- INCLUDE footer.tpl -->

