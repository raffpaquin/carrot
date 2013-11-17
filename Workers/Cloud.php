<?php

	namespace Workers;

	class Cloud{
		
		public static function callback($message){

            $is_success = rand(0,1);
            if (false /*is_success*/) {
                echo 'Job is success'."\n";
                return true;
            }else{
                echo 'Job is failing'."\n";
                return false;
            }
		}
	} 