<?php

	return array(
		'local' => array(
			'amqp' => array(
				'user' => 'guest',
				'pass' => 'guest',
				'host' => 'localhost',
				'port' => 5672,
				'vhost' => '/local',
			)
		),
		'stage' => array(
			'amqp' => array(
				'user' => 'guest',
				'pass' => 'guest',
				'host' => 'localhost',
				'port' => 5672,
				'vhost' => '/stage',
			)
		),
		'prod' => array(
			'amqp' => array(
				'user' => 'guest',
				'pass' => 'guest',
				'host' => 'localhost',
				'port' => 5672,
				'vhost' => '/prod',
			)
		),
	);