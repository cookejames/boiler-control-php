$(document).ready(function() {
	$( "input:submit, input:reset" ).button();
	
	$(function() {
		$( "#accordion" ).accordion({ collapsible: true, active: false });
	});
	$('.accordion .head').click(function() {
		$(this).next().toggle('slow');
		return false;
	}).next().hide();
	
	// bind form using ajaxForm 
    $('#multiAdd').ajaxForm({ 
        // dataType identifies the expected content type of the server response 
        dataType:  'json', 
        beforeSubmit: function() {$("#multiAddSubmit").attr('disabled', 'disabled');},
        // success identifies the function to invoke when the server response 
        // has been received 
        success:   processJson 
    }); 
	
    function processJson(json) { 
        
        var text = "Schedules added";
        if(json.Result == "OK") { //reset accordian
        	$('#multiAdd').resetForm();
            $('#tableContainer').jtable('reload');
            $( "#accordion" ).accordion("activate", false);
        }
        else if(json.Result == "ERROR") {
        	text = json.Message;
        }
        $("#multiAddSubmit").removeAttr('disabled');
    	var $dialog = $('<div></div>')
    		.html(text)
    		.dialog({
    			autoOpen: false,
    			title: 'Adding schedules',
    			close: function(ev, ui) { $(this).html(text); }
    		});
    	
    	$dialog.dialog('open');

    }
});