<?php

return [
	'soap' => 'http://api.payamak-panel.com/post/Send.asmx?wsdl',
	'username' => env('PAYAMAK_USERNAME'),
	'password' => env('PAYAMAK_PASSWORD'),
	'phone_number' => env('PAYAMAK_PHONE'),

	'queue' => /** 'name' or nil...*/ null,
];