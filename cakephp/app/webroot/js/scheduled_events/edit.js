$(function() {
	$('select[name="data[TimeInfo][ti_DISCRIMINATOR]"]').change(function() {
		console.log($(this).val());
		var val = $(this).val();
		
		$('#time-info .repeat').hide();
		$('#time-info .repeat .weekly').hide();
		
		if (val === 'NonRepeatingTimeInfo') {
			$('#time-info .repeat').hide();
		} else {
			$('#time-info .repeat').show();
		}
		
		if (val === 'DailyRepeatingTimeInfo') {
			$('#time-info .repeat .daily').show();
			$('#time-info .interval-help').html('day(s)');
		} else {
			$('#time-info .repeat .daily').hide();
		}
		
		if (val === 'WeeklyRepeatingTimeInfo') {
			$('#time-info .repeat.weekly').show();
			$('#time-info .interval-help').html('week(s)');
		} else {
			$('#time-info .repeat.weekly').hide();
		}
	});
	
	$('select[name="data[TimeInfo][ti_DISCRIMINATOR]"]').trigger('change');
});
