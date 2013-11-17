<?php

	namespace Carrot\RabbitMQ;

	use PhpAmqpLib\Connection\AMQPConnection;


	class Base{

		private $_connection = null;
		private $_channel = null;

		private function _getConnection(){
			if (false === isset($this->_connection)) {
				global $config;
				$amqp = $config['amqp'];
				$this->_connection = new AMQPConnection($amqp['host'], $amqp['port'], $amqp['user'], $amqp['pass']);
			}

			return $this->_connection;
		}

		protected function _getChannel(){
			if (false === isset($this->_channel)) {
				$this->_channel = $this->_getConnection()->channel();
			}

			return $this->_channel;
		}

	}




	/*
		register_shutdown_function(function() use ($channel, $connection) {
			$channel->close();
			$connection->close();
		});
	*/