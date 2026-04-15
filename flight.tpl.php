<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>

<div id="pageTitle"><?php echo ((isset($this->_rootref['L_SUBTITLE'])) ? $this->_rootref['L_SUBTITLE'] : ((isset($user->lang['SUBTITLE'])) ? $user->lang['SUBTITLE'] : '{ SUBTITLE }')); ?></div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div id="AirportTitle"><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></div>

<?php if ($this->_rootref['S_FIDS']) {  ?>
<script>
	// alert("X");
	console.log("flight.tpl");
	console.log("Graha Test...");
	window.setInterval("checkEmergency()", 5000);
	//window.setInterval("stopEmergency()", 1000);
	window.setInterval("checkRunningtext()", 60000);
	window.setInterval("checkFlightStatus()", 2000);

	var timeDisplay = timeDisplay || {};

	if (typeof timeDisplay === 'undefined') { var timeDisplay = function() {}; }

	if (typeof timeDisplay.dtetimer !== 'function') {
		timeDisplay.dtetimer = function() {
			console.log("Mocking dtetimer: Prevented crash on STB");
		};
	}

	var media = media || {};
	media._object = media._object || {
		Fn_Play_Pause: function() {},
		Fn_Up_KeyDownHandler: function() {},
		Fn_Down_KeyDownHandler: function() {}
	};

	var myFIDS;
	var list = new Array();
	var notif_duration;
	var flag = 0;

	// --- WebSocket FIDS Integration ---
	var fidsSocket = null;
	var fidsSocketReconnectDelay = 5000;

	function formatTime(isoString) {
		if (!isoString) return '';
		try {
			var d = new Date(isoString);
			var h = ('0' + d.getHours()).slice(-2);
			var m = ('0' + d.getMinutes()).slice(-2);
			return h + ':' + m;
		} catch (e) {
			return isoString;
		}
	}

	function sendLogToSTB(msg) {
		console.log("Sending log...");
		// $.ajax({
		// 	url: 'ajax.php?mod=stb_log',
		// 	type: 'POST',
		// 	data: { msg: msg },
		// 	success: function() {
		// 		console.log("Remote log sent");
		// 	}
		// });

		// var xhr = new XMLHttpRequest();
		// // Gunakan parameter GET tambahan agar terlihat di log Apache jika POST gagal
		// xhr.open("POST", "ajax.php?mod=stb_log", true);
		// xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// xhr.onreadystatechange = function() {
		// 	if(xhr.readyState == 4 && xhr.status == 200) {
		// 		// Log berhasil terkirim
		// 	}
		// }
		// // Kirim dengan format string manual agar STB tidak bingung
		// xhr.send("msg=" + encodeURIComponent(msg));

		var img = new Image();
		// Kita kirim lewat parameter URL (GET) agar pasti terbaca oleh PHP
		img.src = "ajax.php?mod=stb_log&msg=" + encodeURIComponent(msg) + "&t=" + new Date().getTime();
	}

	window.onerror = function(message, source, lineno, colno, error) {
		var errorDetail = "JS_ERROR: " + message + " | Source: " + source + " | Line: " + lineno + " | Column: " + colno + " | Error: " + error;
		sendLogToSTB(errorDetail);
	};

	function connectFidsWebSocket() {
		if (fidsSocket && (fidsSocket.readyState === 0 || fidsSocket.readyState === 1)) {
			return;
		}

		//jangan lupa ubah ke 192.168.1.10 ketika ingin test di STB
		var fidsSocketUrl = 'ws://192.168.1.10:8888';
		fidsSocket = new WebSocket(fidsSocketUrl);

		fidsSocket.onopen = function() {
			console.log('[FIDS WS] Connected to ws://192.168.1.10:8888');
			sendLogToSTB("WS_CONNECTED: Terhubung ke " + fidsSocketUrl);
		};

		fidsSocket.onmessage = function(event) {
			try {
				var data = JSON.parse(event.data);

				// Normalize flight number (strip non-alphanumeric, matching normalizeFlightNumber)
				var flightNo = (data.callsign || '').replace(/[^A-Za-z0-9]/g, '');
				console.log('Flight No : '+ 'flight-' + flightNo);
				var elements = document.getElementsByClassName('flight-' + flightNo);

				if (!elements || elements.length === 0) {
					console.log('[FIDS WS] No elements found for flight: ' + flightNo);
					sendLogToSTB('[FIDS WS] No elements found for flight: ' + flightNo);
					return;
				} else {
					console.log('ID : '+data.id);
					console.log('Callsign : '+data.callsign);
					console.log('Airline : '+data.airline);
					console.log('Airport : '+data.airport3);
					console.log('Status : '+data.ad);

					sendLogToSTB('ID : '+data.id);
					sendLogToSTB('Callsign : '+data.callsign);
					sendLogToSTB('Airline : '+data.airline);
					sendLogToSTB('Airport : '+data.airport3);
					sendLogToSTB('Status : '+data.ad);
				}

				for (var i = 0; i < elements.length; i++) {
					var el = elements[i];
					var airlineElem   = el.querySelector('.flight-airline');
					var statusElem    = el.querySelector('.flight-status');
					var timeElem      = el.querySelector('.flight-time');
					var destElem      = el.querySelector('.flight-destination');

					if (airlineElem && data.airline) {
						airlineElem.textContent = data.airline;
					}
					if (destElem && data.airport3) {
						destElem.textContent = data.airport3;
					}
					if (timeElem) {
						var displayTime = data.est ? data.est : formatTime(data.time);
						if (displayTime) timeElem.textContent = displayTime;
					}
					if (statusElem && data.ad) {
						statusElem.textContent = data.ad;
						statusElem.style.color = '#d59349';
					}
				}

				// Array.from(elements).forEach(el => {
				// 	var airlineElem   = el.querySelector('.flight-airline');
				// 	var statusElem    = el.querySelector('.flight-status');
				// 	var timeElem      = el.querySelector('.flight-time');
				// 	var destElem      = el.querySelector('.flight-destination');
				//
				// 	if (airlineElem && data.airline) {
				// 		airlineElem.innerText = data.airline;
				// 	}
				// 	if (destElem && data.airport3) {
				// 		destElem.innerText = data.airport3;
				// 	}
				// 	if (timeElem) {
				// 		var displayTime = data.est ? data.est : formatTime(data.time);
				// 		if (displayTime) timeElem.innerText = displayTime;
				// 	}
				// 	if (statusElem && data.ad) {
				// 		statusElem.innerText = data.ad;
				// 		statusElem.style.color = '#d59349';
				// 	}
				// });

			} catch (e) {
				console.log('[FIDS WS] Failed to parse message:', e.data);
				sendLogToSTB('[FIDS WS] Failed to parse message: '+ e.data);
			}
		};

		fidsSocket.onerror = function(e) {
			console.log('[FIDS WS] WebSocket error:', e);
			sendLogToSTB("WS_ERROR: Gagal terhubung ke " + fidsSocketUrl + ". Cek Firewall/IP.");
			sendLogToSTB("WS_ERROR: " + JSON.stringify(e));
		};

		fidsSocket.onclose = function() {
			console.log('[FIDS WS] Connection closed. Reconnecting in ' + (fidsSocketReconnectDelay / 1000) + 's...');
			sendLogToSTB("WS_CLOSED: Koneksi terputus.");
			setTimeout(connectFidsWebSocket, fidsSocketReconnectDelay);
		};
	}

	// Start WebSocket connection when the page loads
	document.addEventListener('DOMContentLoaded', function() {
		console.log("Document ready...");
		sendLogToSTB("Document ready...");
		if (document.querySelector('.flight-row')) {
			console.log("Start connecting...");
			sendLogToSTB("Start connecting...");
			connectFidsWebSocket();
		}
	});
	// --- End WebSocket FIDS Integration ---
</script>

<div id="divLastupdate"><?php echo ((isset($this->_rootref['L_LASTUPDATE'])) ? $this->_rootref['L_LASTUPDATE'] : ((isset($user->lang['LASTUPDATE'])) ? $user->lang['LASTUPDATE'] : '{ LASTUPDATE }')); ?>: <?php echo (isset($this->_rootref['S_LASTUPDATE'])) ? $this->_rootref['S_LASTUPDATE'] : ''; ?>, <?php echo (isset($this->_rootref['S_SOURCE'])) ? $this->_rootref['S_SOURCE'] : ''; ?></div>
<div id="mainDiv">
    <div id="divSafeContainer">
	<div id="divChannelList">
	    <div id="divChannelListHeader">
		<div id="divFieldHeader">
		    <span class="spanChannlHeader"><?php echo ((isset($this->_rootref['L_AIRLINE'])) ? $this->_rootref['L_AIRLINE'] : ((isset($user->lang['AIRLINE'])) ? $user->lang['AIRLINE'] : '{ AIRLINE }')); ?></span>
		    <span class="spanChannlHeader2"><?php echo ((isset($this->_rootref['L_FLIGHT'])) ? $this->_rootref['L_FLIGHT'] : ((isset($user->lang['FLIGHT'])) ? $user->lang['FLIGHT'] : '{ FLIGHT }')); ?></span>
		    <span class="spanChannlHeader3"><?php echo ((isset($this->_rootref['L_ORIGIN_DESTINATION'])) ? $this->_rootref['L_ORIGIN_DESTINATION'] : ((isset($user->lang['ORIGIN_DESTINATION'])) ? $user->lang['ORIGIN_DESTINATION'] : '{ ORIGIN_DESTINATION }')); ?></span> 
		    <span class="spanChannlHeader4"><?php echo ((isset($this->_rootref['L_SCHEDULE'])) ? $this->_rootref['L_SCHEDULE'] : ((isset($user->lang['SCHEDULE'])) ? $user->lang['SCHEDULE'] : '{ SCHEDULE }')); ?></span> 
		    <span class="spanChannlHeader5"><?php echo ((isset($this->_rootref['L_GATE'])) ? $this->_rootref['L_GATE'] : ((isset($user->lang['GATE'])) ? $user->lang['GATE'] : '{ GATE }')); ?></span> 
		    <span class="spanChannlHeader6"><?php echo ((isset($this->_rootref['L_REMARK'])) ? $this->_rootref['L_REMARK'] : ((isset($user->lang['REMARK'])) ? $user->lang['REMARK'] : '{ REMARK }')); ?></span> 
		</div>
	    </div>
	    <div id="divChannelListItems">
		<?php $_flight_count = (isset($this->_tpldata['flight'])) ? sizeof($this->_tpldata['flight']) : 0;if ($_flight_count) {for ($_flight_i = 0; $_flight_i < $_flight_count; ++$_flight_i){$_flight_val = &$this->_tpldata['flight'][$_flight_i]; ?>
		<div class="flight-row divChannelItems flight-<?php echo $_flight_val['S_FLIGHT']; ?>" id="flight-<?php echo $_flight_val['S_FLIGHT']; ?>">
		    <span class="spanChannlItem flight-airline"><?php echo $_flight_val['S_AIRLINE']; ?></span>
		    <span class="spanChannlItem2"><?php echo $_flight_val['S_FLIGHT']; ?></span>
		    <span class="spanChannlItem3 flight-destination"><?php echo $_flight_val['S_ORIGIN_DESTINATION']; ?></span>
		    <span class="spanChannlItem4 flight-time"><?php echo $_flight_val['S_SCHEDULE']; ?></span>
		    <span class="spanChannlItem5"><?php echo $_flight_val['S_GATE']; ?></span>
		    <span class="spanChannlItem6 flight-status"><?php echo $_flight_val['S_REMARK']; ?></span>
		</div>
		<?php }} ?>
	    </div>
	    <div id="divChannelListScrollBar" style="position:relative;left:1060px">
		<div id="DV_Scrolluparrow" onclick="media._object.Fn_Up_KeyDownHandler();"></div>
		<div id="DV_Scrollprogress" onclick="media._object.Fn_Click_ScrollBar();">
		    <div id="DV_Scrollshaft"></div>
		</div>
		<div id="DV_Scrolldownarrow" onclick="media._object.Fn_Down_KeyDownHandler();"></div>
	    </div>
	</div>
	<div id="divVideoContainer" class="divVideoContainer" style="position:relative;left:1980px">
	    <video id="media" class="videoControl" loop></video>
	</div>
	
    </div>
</div>
<div id="flight"><a id="change" name="change" href="<?php echo (isset($this->_rootref['S_URL'])) ? $this->_rootref['S_URL'] : ''; ?>"><?php echo ((isset($this->_rootref['L_TOGGLE'])) ? $this->_rootref['L_TOGGLE'] : ((isset($user->lang['TOGGLE'])) ? $user->lang['TOGGLE'] : '{ TOGGLE }')); ?></a></div>
<?php } ?>
<div id="divVideoContainer" class="divVideoContainer">
    <audio id="media" class="videoControl" loop autoplay src="<?php echo (isset($this->_rootref['S_MB'])) ? $this->_rootref['S_MB'] : ''; ?>"></audio>
</div>
<?php if ($this->_rootref['S_SELECT']) {  ?>
<div id="mainDiv">
    <div id="divSafeContainer1">
	<?php $_airport_count = (isset($this->_tpldata['airport'])) ? sizeof($this->_tpldata['airport']) : 0;if ($_airport_count) {for ($_airport_i = 0; $_airport_i < $_airport_count; ++$_airport_i){$_airport_val = &$this->_tpldata['airport'][$_airport_i]; ?>
	<div class="flight1"><a id="change" href="<?php echo $_airport_val['S_URL']; ?>"><?php echo $_airport_val['S_AIRPORT_CODE']; ?> <?php echo $_airport_val['S_AIRPORT_NAME']; ?></a> </div><br/>
	<?php }} ?>
    </div>
</div>
<?php } $this->_tpl_include('footer.tpl'); ?>