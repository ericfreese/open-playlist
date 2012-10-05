$(function() {
	$('#calendar').fullCalendar({
		height: 475,
		defaultView: 'agendaWeek',
		allDaySlot: false,
		header: false,
		viewDisplay: function(view) {
			$('#title').html(view.title);
		},
		events: function(start, end, callback) {
			var eventsLoaded = $.ajax({
				url: 'api/events_between.json',
				dataType: 'json',
				data: {
					'start': start.getTime() / 1000,
					'end': end.getTime() / 1000
				}
			});
			
			$.when(eventsLoaded).then(function(events) {
				var startDateTime,
					fcEvents = [];
				
				for (var i = 0; i < events.response.length; i++) {
					startDateTime = new Date(events.response[i].ScheduledEventInstance.sei_StartDateTime * 1000);
					fcEvents.push({
						allDay: false,
						title: events.response[i].ScheduledEvent.Event.e_Title,
						start: startDateTime,
						end: new Date(startDateTime.getTime() + events.response[i].ScheduledEventInstance.sei_Duration * 60 * 1000),
					});
				}
				
				callback(fcEvents);
			});
		},
		dayClick:  function(date, allDay, jsEvent, view) {
			window.location = '/scheduled_events/add';
		}
	});
	
	$('#previous').click(function() {
		$('#calendar').fullCalendar('prev');
		return false;
	});
	
	$('#next').click(function() {
		$('#calendar').fullCalendar('next');
		return false;
	});
});
