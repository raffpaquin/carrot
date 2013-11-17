#!/usr/bin/php
<?php	

	require_once __DIR__.'/../libs/Carrot/autoload.php';

	try {

		#Do we have an event
		if (true === empty($argv['event'])) {
			throw new Exception('Please provide an event name');
		}

		#Is the event valid?
		if (false === isset($queue[$argv['event']])) {
			throw new Exception('Please provide a valid event');
		}else{
			$event_key = $argv['event'];
			$event_data = $queue[$event_key];
		}

		#Do we have data?
		if (true === empty($argv['payload'])) {
			throw new Exception('Please provide the event payload');
		}else{
			$payload_json = $argv['payload'];
		}

		#Is the data valid JSON
		$payload_array = json_decode($payload_json,true);
		if (json_last_error() != JSON_ERROR_NONE) {
			throw new Exception('Please provide the paylaod in valid json format.');
		}



		#Create the F&O Producer and push the event
		$producer = new \Frankoak\Producer($event_key, $event_data);
		$producer->setRoutingKey('frankoak.'.$environement);
		$producer->push(new PhpAmqpLib\Message\AMQPMessage($payload_json, array('content_type' => 'text/json')));

	}catch(Exception $e){
		echo PHP_EOL.
			'ERROR: '.$e->getMessage().PHP_EOL.PHP_EOL.
			'Usage: php task.php -event eventName -payload jsonFormatedPayload [-mode stage]'.PHP_EOL;
	}