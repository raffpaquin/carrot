<?php

	function __autoload($name) {
		$path = str_replace('\\', '/', $name).'.php';;
		include_once 'libs/'.$path;
	}

	$queue = parse_ini_file('etc/carrot.ini',true);
	$config = parse_ini_file('etc/server.ini',true);

	#Format argv in format myDoc.php -key1 value -key2 value 
	array_shift($argv);
	$final = array();
	$latest_key = '';
	foreach($argv as $k => $v){
		if (0 === $k%2) {
			$latest_key = substr($v, 1);
			
		}elseif(!empty($latest_key)){
			$final[$latest_key] = $v;
		}
	}
	$argv = $final;


	#Do we have environement infos
	if (false === empty($argv['mode'])) {
		if (in_array(mb_strtolower($argv['mode']), array(\Carrot\Environment\Status::STAGE,\Carrot\Environment\Status::PROD,\Carrot\Environment\Status::LOCAL))) {
			$environement = $argv['mode'];
		}else{
			$environement = \Carrot\Environment\Status::STAGE;
		}
	}else{
		$environement = \Carrot\Environment\Status::STAGE;
	}

	define('ENV',$environement);

	$config = $config[ENV];