<?php

	namespace Workers;

	class Example2{
		
		public static function callback($message){

			$is_success = rand(0,1);
			if ($is_success) {
				echo 'Task DONE'.PHP_EOL;
				return true;
			}else{
				echo 'ERROR WHILE DOING THE TASK'.PHP_EOL;
				return false;
			}
		}
	} 