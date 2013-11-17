<?php

	return array(
		/*Event*/
		'order.order' => array(
			'name' => 'Customer make a purchase',
			'queues' => array(
				'\Frankoak\Worker\Order\Sync\Cloud' 	=> 'frankoak.#',
				'\Frankoak\Worker\Order\Sync\Bi'		=> 'frankoak.prod',
				'\Frankoak\Worker\Order\Fraud\Test' 	=> 'frankoak.prod',
				'\Frankoak\Worker\Order\Ops\Customs' 	=> 'frankoak.prod',
			)
		),

		'customer.login' => array(

		),
	);