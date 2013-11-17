<?php

	namespace Workers;

	class Example{
		
		public static function callback($message){

			$is_success = rand(0,1);
			if ($is_success) {
				return true;
			}else{
				return false;
			}
		}
	} 