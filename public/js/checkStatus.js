function checkStatus() {
	$.getJSON("/api/configuration/status/", function(json) {
		if(json.Result == "OK") {
			if(json.Records.heating == "true") {
				$('#heatingBoost').attr('src', '/images/on.png');
			} else {
				$('#heatingBoost').attr('src', '/images/off.png');
			}
			if(json.Records.water == "true") {
				$('#waterBoost').attr('src', '/images/on.png');
			} else {
				$('#waterBoost').attr('src', '/images/off.png');
			}
		} else {
			alert(json.Message);
		}
	});
	t = setTimeout('checkStatus()', 10000);
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
		$.post("/api/configuration/boost/toggle/heating", function(json) {
			if (json.Result == "OK") {
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
		$.post("/api/configuration/boost/toggle/water", function(json) {
			if (json.Result == "OK") {
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