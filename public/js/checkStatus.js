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
			var now = new Date().getTime();
			var remaining = Math.round( (timestamp - now) / 1000 / 60 );
			$('#waterBoostTime').html(remaining + " minutes");
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

function setupDialog(dialogId, postName, timeId, buttonId) {
    $( dialogId ).dialog({
        autoOpen: false,
        height: 150,
        width: 250,
        modal: true,
        buttons: {
          "Toggle": function() {
        	  $.post("/api/heating/boost/toggle/" + postName +"/time/" + 
        			  $(timeId).val(), function(json) {
      			if (json.Result == "OK") {
      				updateImages(json);
      			} else {
      				$dialog.html("Oops something went wrong");
      			}
      		}, "json");
              $( this ).dialog( "close" );
          },
          "Cancel": function() {
            $( this ).dialog( "close" );
          }
        },
        close: function() {
          $(timeId).val( "60" );
        }
      });
	
	$(buttonId).click(function() {
		if ($(buttonId).attr('src') == '/images/on.png') {
			$(timeId).prop('disabled', true);
		} else if ($(buttonId).attr('src') == '/images/off.png') {
			$(timeId).prop('disabled', false);
		}
		
		$( dialogId ).dialog( "open" );
	});
}

$(document).ready(function() {
	setupDialog("#heating-boost-dialog", "heating", "#heatTime", "#heatingBoost");
	setupDialog("#water-boost-dialog", "water", "#waterTime", "#waterBoost");
});