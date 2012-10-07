<?php
class ScheduledEvent extends AppModel {
	var $name = 'ScheduledEvent';
	
	var $useTable = 'ScheduledEvent';
	var $primaryKey = 'se_Id';
	// var $displayField = 'e_Title';
	
	var $belongsTo = array(
		'Event' => array(
			'foreignKey' => 'se_EventId'
		),
		'TimeInfo' => array(
			'foreignKey' => 'se_TimeInfoId'
		)
	);
	
	var $hasMany = array(
		'ScheduledEventInstance' => array(
			'className' => 'ScheduledEventInstance',
			'foreignKey' => 'sei_ScheduledEventId',
			'order' => 'sei_StartDateTime',
			'dependent' => true
		)
	);
	
	public function findBetween($start, $end, $conditions = array()) {
		return $this->find('all', array('conditions' => array_merge($conditions, array(
			'TimeInfo.ti_StartDateTime <' => date('Y-M-d H:i:s', $end),
			'OR' => array(
				array(
					'AND' => array(
						'TimeInfo.ti_DISCRIMINATOR' => 'NonRepeatingTimeInfo',
						'UNIX_TIMESTAMP(TimeInfo.ti_StartDateTime) + TimeInfo.ti_Duration * 60 >' => $start
					)
				),
				array(
					'AND' => array(
						'TimeInfo.ti_DISCRIMINATOR !=' => 'NonRepeatingTimeInfo',
						'OR' => array(
							'TimeInfo.ti_EndDate' => null,
							'UNIX_TIMESTAMP(TimeInfo.ti_EndDate) + TimeInfo.ti_Duration * 60 + 86400 >' => $start
						)
					)
				)
			)
		))));
	}
	
	public function getInstancesBetween($scheduledEvents, $start, $end) {
		$seInstances = array();
		
		foreach ($scheduledEvents as $scheduledEvent) {
			// Index existing instances by date
			foreach ($scheduledEvent['ScheduledEventInstance'] as $scheduledEventInstance) {
				$existingInstances[date('Y-M-d', strtotime($scheduledEventInstance['sei_StartDateTime']))] = $scheduledEventInstance;
			}
			
			switch ($scheduledEvent['TimeInfo']['ti_DISCRIMINATOR']) {
				case 'NonRepeatingTimeInfo':
					if (isset($existingInstances[date('Y-M-d', strtotime($scheduledEvent['TimeInfo']['ti_StartDateTime']))])) {
						array_push($seInstances, $existingInstances[date('Y-M-d', strtotime($scheduledEvent['TimeInfo']['ti_StartDateTime']))]);
					} else {
						array_push($seInstances, array(
							'ScheduledEventInstance' => array(
								'sei_ScheduledEventId' => $scheduledEvent['ScheduledEvent']['se_Id'],
								'sei_StartDateTime' => strtotime($scheduledEvent['TimeInfo']['ti_StartDateTime']),
								'sei_Duration' => $scheduledEvent['TimeInfo']['ti_Duration']
							),
							'ScheduledEvent' => array(
								'se_Id' => $scheduledEvent['ScheduledEvent']['se_Id'],
								'se_EventId' => $scheduledEvent['ScheduledEvent']['se_EventId'],
								'Event' => array(
									'e_DISCRIMINATOR' => $scheduledEvent['Event']['e_DISCRIMINATOR'],
									'e_Title' => $scheduledEvent['Event']['e_Title']
								)
							)
						));
					}
					break;
				case 'DailyRepeatingTimeInfo':
					// $endDateTime = ($this->EndDate && $this->EndDate > 0 ? $this->EndDate + $this->Duration * 60 + 86400 : $timeWindowEnd);
					for ($startDateTime = strtotime($scheduledEvent['TimeInfo']['ti_StartDateTime']); $startDateTime < $end; $startDateTime = strtotime('+'.$scheduledEvent['TimeInfo']['ti_Interval'].' day', $startDateTime)) {
						if ($startDateTime + $scheduledEvent['TimeInfo']['ti_Duration'] * 60 > $start && $startDateTime < $end) {
							array_push($seInstances, array(
								'ScheduledEventInstance' => array(
									'sei_ScheduledEventId' => $scheduledEvent['ScheduledEvent']['se_Id'],
									'sei_StartDateTime' => $startDateTime,
									'sei_Duration' => $scheduledEvent['TimeInfo']['ti_Duration']
								),
								'ScheduledEvent' => array(
									'se_Id' => $scheduledEvent['ScheduledEvent']['se_Id'],
									'se_EventId' => $scheduledEvent['ScheduledEvent']['se_EventId'],
									'Event' => array(
										'e_DISCRIMINATOR' => $scheduledEvent['Event']['e_DISCRIMINATOR'],
										'e_Title' => $scheduledEvent['Event']['e_Title']
									)
								)
							));
						}
					}
					break;
				case 'WeeklyRepeatingTimeInfo':
					$startDateTime = strtotime($scheduledEvent['TimeInfo']['ti_StartDateTime']);
					do {
						for ($i = 0; $i < 7; $i++) {
							if ($scheduledEvent['TimeInfo']['ti_WeeklyOn'.date('l', $startDateTime)] && $startDateTime + $scheduledEvent['TimeInfo']['ti_Duration'] * 60 > $start && $startDateTime < $end) {
								array_push($seInstances, array(
									'ScheduledEventInstance' => array(
										'sei_ScheduledEventId' => $scheduledEvent['ScheduledEvent']['se_Id'],
										'sei_StartDateTime' => $startDateTime,
										'sei_Duration' => $scheduledEvent['TimeInfo']['ti_Duration']
									),
									'ScheduledEvent' => array(
										'se_Id' => $scheduledEvent['ScheduledEvent']['se_Id'],
										'se_EventId' => $scheduledEvent['ScheduledEvent']['se_EventId'],
										'Event' => array(
											'e_DISCRIMINATOR' => $scheduledEvent['Event']['e_DISCRIMINATOR'],
											'e_Title' => $scheduledEvent['Event']['e_Title']
										)
									)
								));
							}
							$startDateTime = strtotime('+1 day', $startDateTime);
						}
						$startDateTime = strtotime('+'.($scheduledEvent['TimeInfo']['ti_Interval'] - 1).' week', $startDateTime);
					} while ($startDateTime < $end);
					break;
			}
			
			
		}
		
		return $seInstances;
	}
}
?>
