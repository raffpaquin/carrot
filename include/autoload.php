<?php

	function __autoload($name) {
		$path = str_replace('\\', '/', $name).'.php';;
		include_once $path;
	}

	$queue = include 'queue.php';
	$config = include 'config.php';

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
		if (in_array(mb_strtolower($argv['mode']), array(\Frankoak\Environment\Status::STAGE,\Frankoak\Environment\Status::PROD,\Frankoak\Environment\Status::LOCAL))) {
			$environement = $argv['mode'];
		}else{
			$environement = \Frankoak\Environment\Status::STAGE;
		}
	}else{
		$environement = \Frankoak\Environment\Status::STAGE;
	}

	define('ENV',$environement);

	$config = $config[ENV];