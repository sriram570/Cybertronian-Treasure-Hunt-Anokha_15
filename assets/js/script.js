$(function(){
	
	var note = $('#note'),
		ts = new Date("February 20, 2015 10:00:00"),
		newYear = true;
		
	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		ts = (new Date()).getTime() + 1*24*60*60*1000;
		newYear = false;
		console.log("hello");
	}
	
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
		//	message += days + " day" + ( days==1 ? '':'s' ) + ", ";
		//	message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
		//	message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
		//	message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
		//	if(newYear){
		//		message += "left for beginning your HUNT!";
		//	}
		//	else {
				message += "The HUNT begins in";
		//	}
			
			note.html(message);
		}	
	});
	
});
