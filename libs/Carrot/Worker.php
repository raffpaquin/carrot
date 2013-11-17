<?php

	namespace Carrot;

	class Worker extends RabbitMQ\Base{
		
		private $_callback = null;
		private $_queue_name = null;

		public function __construct($queue_name){

			try{
				$this->_callback = $queue_name.'::callback';
			}catch(Exception $e){
				echo "Invalid queue name\n";
	    		exit(1);
			}
			
			$this->_queue_name = $queue_name;
		}

		public function work(){
			$callback = $this->_callback;
			$this->_getChannel()->basic_consume($this->_queue_name, '', false, false, false, false, function($message) use($callback){
				
				#Convert to JSON
				$message->body = json_decode($message->body);

				#If the message is kill, we kill the process
				if (isset($message->body->action) && $message->body->action === 'kill') {
					$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
					$message->delivery_info['channel']->basic_cancel($message->delivery_info['consumer_tag']);
				}else{

					//var_dump($message->delivery_info);
					echo "Nouvelle task ".time()."\n";

					try{
						$result = call_user_func($callback, array($message));
					}catch(\Exception $e){
						$result = false;
					}

					if (true === $result) {
						$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
					}else{
						$message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag'], false, true);
					}
				}
			});

			while(count($this->_getChannel()->callbacks)) {
				$this->_getChannel()->wait();
			}
		}
	}