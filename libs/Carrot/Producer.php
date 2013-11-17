<?php

	namespace Carrot;

	class Producer extends RabbitMQ\Base{
		
		private $_routing_key = 'default';
		private $_queue = null;
		private $_exchange_name = null;

		const EXCHANGE_PREFIX = 'exchange.';

		public function __construct($event_name, $event_data){
			if (false === empty($event_data['queues']) && false === empty($event_name)) {
				$this->_setExchange($event_name);
				$this->_setQueues($event_data['queues']);
			}else{
				throw new \Exception('Invalid params.');
			}
		}

		private function _setExchange($exchange_name){
			if (false === empty($this->_exchange_name)) {
				return false;
			}

			$this->_exchange_name = self::EXCHANGE_PREFIX.$exchange_name;
			$this->_getChannel()->exchange_declare($this->_exchange_name, 'topic', false, true, false);

			return true;
		}
		

		private function _setQueues($queues){
			if (false === empty($this->_queue)) {
				return false;
			}

			foreach ($queues as $class => $routing) {

				#We don't have a key, so let's put the value as the key (class) and use the default routing policy
				if (is_int($class)) {
					$class = $routing;
					$routing = '*';
				}

				#Create the queue and link it with the exchange
				$this->_getChannel()->queue_declare($class, false, true, false, false);
				$this->_getChannel()->queue_bind($class, $this->_getExchangeName(), $routing);
			}

			return true;
		}

		public function push($message){
			$this->_getChannel()->basic_publish($message, $this->_getExchangeName(), $this->_routing_key);
		}

		public function setRoutingKey($key){

			if (true === empty($key)) {
				return false;
			}

			$this->_routing_key = $key;

			return true;
		}

	
		protected function _getExchangeName(){
			return $this->_exchange_name;
		}
	}