function updateImages(json) {
	//Heating
	if (json.Heating == "ON") {
		$('#heating').attr('src', '/images/circle_green.png');
	} else if (json.Heating == "OFF") {
		$('#heating').attr('src', '/images/circle_red.png');
	}

	//Water
	if (json.Water == "ON") {
		$('#water').attr('src', '/images/circle_green.png');
	} else if (json.Water == "OFF") {
		$('#water').attr('src', '/images/circle_red.png');
	}
	
	//Heating Boost
	if (json.HeatingBoost == "ON") {
		$('#heatingBoost').attr('src', '/images/on.png');
		if (typeof json.HeatingBoostTime !== "undefined") {
			var timestamp = parseInt(json.HeatingBoostTime);
			var now = new Date().getTime();
			var remaining = Math.round( (timestamp - now) / 1000 / 60 );
			$('#heatingBoostTime').html(remaining + " minutes");
		}
	} else if (json.HeatingBoost == "OFF") {
		$('#heatingBoost').attr('src', '/images/off.png');
		$('#heatingBoostTime').html("");
	}
	
	//Water Boost
	if (json.WaterBoost == "ON") {
		$('#waterBoost').attr('src', '/images/on.png');
		var t = json.WaterBoostTime;
		if (typeof json.WaterBoostTime !== "undefined") {
			var timestamp = parseInt(json.WaterBoostTime);
			var date = new Date(timestamp);
			$('#waterBoostTime').html(date.getHours() + ":" + date.getMinutes());
		}
	} else if (json.WaterBoost == "OFF") {
		$('#waterBoost').attr('src', '/images/off.png');
		$('#waterBoostTime').html("");
	}
}

function checkStatus() {
	$.getJSON("/api/heating/status/", function(json) {
		if(json.Result == "OK") {
			updateImages(json);
		} else {
			alert(json.Message);
		}
	});
	t = setTimeout('checkStatus()', 30000);
}
$(document).ready(checkStatus());

$(document).ready(function() {

	var $loading = "Toggling...";
	var $dialog = $('<div></div>')
		.html($loading)
		.dialog({
			autoOpen: false,
			title: 'Toggling Boost',
			close: function(ev, ui) { $(this).html($loading); }
		});

	$('#heatingBoost').click(function() {
		$.post("/api/heating/boost/toggle/heating", function(json) {
			if (json.Result == "OK") {
				updateImages(json);
				$dialog.html("Heating boost set");
			} else {
				$dialog.html("Oops something went wrong");
			}
		}, "json");
		$dialog.dialog('open');
		// prevent the default action, e.g., following a link
		return false;
	});

	$('#waterBoost').click(function() {
		$.post("/api/heating/boost/toggle/water", function(json) {
			if (json.Result == "OK") {
				updateImages(json);
				$dialog.html("Hot water boost set");
			} else {
				$dialog.html("Oops something went wrong");
			}
		}, "json");
		$dialog.dialog('open');
		// prevent the default action, e.g., following a link
		return false;
	});
});