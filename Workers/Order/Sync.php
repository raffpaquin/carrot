<?php

	namespace Workers\Order;

	class Sync{
		
		public static function callback($message){


			$mySql = '';





			$is_success = rand(0,1);
			if ($is_success) {
				return true;
			}else{
				return false;
			}
		}
	} 