#!/usr/bin/php
<?php

	require_once __DIR__.'/../libs/Carrot/autoload.php';

	try {
		#Do we have an event
		if (true === empty($argv['worker'])) {
			throw new Exception('Please enter a valid worker name');
		}else{
			$queue_name = $argv['worker'];
		}


		#Create the F&O Producer and push the event
		$worker = new \Carrot\Worker($queue_name);
		$worker->work();


	} catch (Exception $e) {
		echo PHP_EOL.
			'ERROR: '.$e->getMessage().PHP_EOL.PHP_EOL.
			'Usage: php worker.php -worker workerClass [-mode stage]'.PHP_EOL;
	}