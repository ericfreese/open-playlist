$(function() {
	$('#calendar').fullCalendar({
		height: 475,
		defaultView: 'agendaWeek',
		allDaySlot: false,
		events: function(start, end, callback) {
			$.ajax({
				url: 'api/scheduled_event_instances.json',
				dataType: 'json',
				data: {
					contain: JSON.stringify(['ScheduledEvent.Event'])
				}
			}).then(function(data) {
				var startDateTime, events = [];
				for (var i = 0; i < data.response.length; i++) {
					startDateTime = new Date(data.response[i].ScheduledEventInstance.sei_StartDateTime);
					events.push({
						allDay: false,
						title: data.response[i].ScheduledEvent.Event.e_Title,
						start: startDateTime,
						end: new Date(startDateTime.getTime() + data.response[i].ScheduledEventInstance.sei_Duration * 60 * 1000),
					});
				}
				callback(events);
			});
		}
	});
});
