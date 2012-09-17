function checkStatus() {
	$.getJSON("/configuration/status/get/heating", function(json) {
		if(json.Result == "OK") {
			if(json.Record == "true") {
				$('#heatingStatus').html('<img src="/images/circle_green.png" />');
			} else {
				$('#heatingStatus').html('<img src="/images/circle_red.png" />');
			}
		} else {
			alert(json.Message);
		}
	});
	$.getJSON("/configuration/status/get/water", function(json) {
		if(json.Result == "OK") {
			if(json.Record == "true") {
				$('#hwStatus').html('<img src="/images/circle_green.png" />');
			} else {
				$('#hwStatus').html('<img src="/images/circle_red.png" />');
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
		$.getJSON("/configuration/boost/toggle/heating", function(json) {
			if (json.Result == "OK") {
				$dialog.html("Heating boost set");
			} else {
				$dialog.html("Oops something went wrong");
			}
		});
		$dialog.dialog('open');
		// prevent the default action, e.g., following a link
		return false;
	});

	$('#waterBoost').click(function() {
		$.getJSON("/configuration/boost/toggle/water", function(json) {
			if (json.Result == "OK") {
				$dialog.html("Hot water boost set");
			} else {
				$dialog.html("Oops something went wrong");
			}
		});
		$dialog.dialog('open');
		// prevent the default action, e.g., following a link
		return false;
	});
});

$(document).ready(function() {
	$( "input:submit" ).button();
	
	//Days
	$.getJSON('/api/days', function(data) {
		  var items = [];
		  $.each(data.Options, function(key, val) {
		    items.push(val.DisplayText + ': <input type="checkbox" value="1" name="days-' + val.Value + '"/> ');
		  });

		  $('<div/>', {
		    'class': 'my-new-list',
		    html: items.join('')
		  }).appendTo('#formDays');
		});
	
	//Groups
	$.getJSON('/api/groups/get', function(data) {
		  var items = [];
		  $.each(data.Records, function(key, val) {
		    items.push('<option value="' + val.id + '">' + val.name + '</option>');
		  });

		  $('<select/>', {
		    'class': 'my-new-list',
		    html: items.join('')
		  }).appendTo('#formGroup');
		});
	
	//Hour On/Off
	var hours = [];
	for( var i = 0; i < 24; i++) {
		hours.push(i);
	}
	var items = [];
	 $.each(hours, function(key, val) {
		 items.push('<option value="' + val + '">' + val + '</option>');
	 });

	 $('<select/>', {
			'class': 'my-new-list',
			html: items.join('')
			}).appendTo('#formHourOn');
	 $('<select/>', {
			'class': 'my-new-list',
			html: items.join('')
			}).appendTo('#formHourOff');
	 
	//Minute On/Off
	var minutes = [];
	for( var i = 0; i < 60; i++) {
		minutes.push(i);
	}
	var items = [];
	 $.each(minutes, function(key, val) {
		 items.push('<option value="' + val + '">' + val + '</option>');
	 });

	 $('<select/>', {
			'class': 'my-new-list',
			html: items.join('')
			}).appendTo('#formMinuteOn');
	 $('<select/>', {
			'class': 'my-new-list',
			html: items.join('')
			}).appendTo('#formMinuteOff');
	
	$(function() {
		$( "#accordion" ).accordion({ collapsible: true, active: false });
	});
	$('.accordion .head').click(function() {
		$(this).next().toggle('slow');
		return false;
	}).next().hide();
});