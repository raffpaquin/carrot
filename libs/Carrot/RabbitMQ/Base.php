<?php

	namespace Carrot\RabbitMQ;

	use PhpAmqpLib\Connection\AMQPConnection;


	class Base{

		private $_connection = null;
		private $_channel = null;

		private function _getConnection(){
			if (false === isset($this->_connection)) {
				global $config;
				$this->_connection = new AMQPConnection($config['host'], $config['port'], $config['user'], $config['pass']);
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