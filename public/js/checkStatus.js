function updateImages(json) {
	if(json.Heating == "ON") {
		$('#heatingBoost').attr('src', '/images/on.png');
	} else {
		$('#heatingBoost').attr('src', '/images/off.png');
	}
	if(json.Water == "ON") {
		$('#waterBoost').attr('src', '/images/on.png');
	} else {
		$('#waterBoost').attr('src', '/images/off.png');
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