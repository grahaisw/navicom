<!-- INCLUDE header.tpl -->

<div id="pageTitle">{L_SUBTITLE}</div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div id="AirportTitle">{L_PAGE_TITLE}</div>

<!-- IF S_FIDS -->
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

<div id="divLastupdate">{L_LASTUPDATE}: {S_LASTUPDATE}, {S_SOURCE}</div>
<div id="mainDiv">
    <div id="divSafeContainer">
	<div id="divChannelList">
	    <div id="divChannelListHeader">
		<div id="divFieldHeader">
		    <span class="spanChannlHeader">{L_AIRLINE}</span>
		    <span class="spanChannlHeader2">{L_FLIGHT}</span>
		    <span class="spanChannlHeader3">{L_ORIGIN_DESTINATION}</span> 
		    <span class="spanChannlHeader4">{L_SCHEDULE}</span> 
		    <span class="spanChannlHeader5">{L_GATE}</span> 
		    <span class="spanChannlHeader6">{L_REMARK}</span> 
		</div>
	    </div>
	    <div id="divChannelListItems">
		<!-- BEGIN flight -->
		<div class="flight-row divChannelItems flight-{flight.S_FLIGHT}" id="flight-{flight.S_FLIGHT}">
		    <span class="spanChannlItem flight-airline">{flight.S_AIRLINE}</span>
		    <span class="spanChannlItem2">{flight.S_FLIGHT}</span>
		    <span class="spanChannlItem3 flight-destination">{flight.S_ORIGIN_DESTINATION}</span>
		    <span class="spanChannlItem4 flight-time">{flight.S_SCHEDULE}</span>
		    <span class="spanChannlItem5">{flight.S_GATE}</span>
		    <span class="spanChannlItem6 flight-status">{flight.S_REMARK}</span>
		</div>
		<!-- END flight -->
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
<div id="flight"><a id="change" name="change" href="{S_URL}">{L_TOGGLE}</a></div>
<!-- ENDIF -->
<div id="divVideoContainer" class="divVideoContainer">
    <audio id="media" class="videoControl" loop autoplay src="{S_MB}"></audio>
</div>
<!-- IF S_SELECT -->
<div id="mainDiv">
    <div id="divSafeContainer1">
	<!-- BEGIN airport -->
	<div class="flight1"><a id="change" href="{airport.S_URL}">{airport.S_AIRPORT_CODE} {airport.S_AIRPORT_NAME}</a> </div><br/>
	<!-- END airport -->
    </div>
</div>
<!-- ENDIF -->

<!-- INCLUDE footer.tpl -->