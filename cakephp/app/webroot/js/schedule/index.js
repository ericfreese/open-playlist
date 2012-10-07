$(function() {
	$('#calendar').fullCalendar({
		height: 475,
		defaultView: 'agendaWeek',
		allDaySlot: false,
		header: false,
		slotMinutes: 15,
		selectable: true,
		viewDisplay: function(view) {
			$('#title').html(view.title);
		},
		events: function(start, end, callback) {
			var eventsLoaded = $.ajax({
				url: 'api/events_between.json',
				dataType: 'json',
				data: {
					'start': start.getTime() / 1000,
					'end': end.getTime() / 1000,
					'conditions': JSON.stringify({
						'Event.e_DISCRIMINATOR': 'ShowEvent'
					})
				}
			});
			
			$.when(eventsLoaded).then(function(events) {
				var startDateTime,
					eventType,
					fcEvents = [];
				
				for (var i = 0; i < events.response.length; i++) {
					startDateTime = new Date(events.response[i].ScheduledEventInstance.sei_StartDateTime * 1000);
					eventType = events.response[i].ScheduledEvent.Event.e_DISCRIMINATOR.replace('Event', '');
					fcEvents.push({
						'allDay': false,
						'title': events.response[i].ScheduledEvent.Event.e_Title,
						'url': '#',
						'editSeriesUrl': '/scheduled_events/edit/' + events.response[i].ScheduledEvent.se_Id,
						'editInstanceUrl': '/' + (eventType.charAt(0).toLowerCase() + eventType.slice(1)).replace(/([A-Z])/g, '_$1').toLowerCase() + '_instances/add/' + events.response[i].ScheduledEvent.se_Id + '/' + startDateTime.getTime() / 1000,
						'start': startDateTime,
						'end': new Date(startDateTime.getTime() + events.response[i].ScheduledEventInstance.sei_Duration * 60 * 1000),
						'className': [ 'fc-' + eventType.toLowerCase() ]
					});
				}
				
				callback(fcEvents);
			});
		},
		select: function(startDate, endDate, allDay, jsEvent, view) {
			window.location = '/scheduled_events/add/?start=' + (startDate.getTime() / 1000) + '&duration=' + (endDate.getTime() - startDate.getTime()) / 1000 / 60;
		},
		eventClick: function(event, jsEvent, view) {
			jsEvent.preventDefault();
			
			$('#edit-event .modal-header h3').html(event.title + ' &mdash; ' + $.fullCalendar.formatDate(event.start, 'ddd MMM d h(:mm)tt'));
			$('#edit-event .modal-footer a.edit-series').attr('href', event.editSeriesUrl);
			$('#edit-event .modal-footer a.edit-instance').attr('href', event.editInstanceUrl);
			
			$('#edit-event').modal();
		},
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
