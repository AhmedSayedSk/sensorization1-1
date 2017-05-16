<?php

return [
	// Set your paypal credential
	"client_id" => "AeI1MEhZbkQgW9VV7X_Xu6U6wikcTgjm4N9fxEKiWnpEJx8u2ee-_sOVuQ-70RECdiWcoMwZs3zNa84v",
	"secret" => "ELZ5wcshie5rr8UF79TQ3ZZdTbZ4IpFxwcpszcsikq8pxW47nNj7i_-CN1sep-KocaG1f5lNMV3GBSWc",

	// SDK configuration
	"settings" => [

		// Available options: sandbox / live
		"mode" => "sandbox", 

		// Specify the max request time in seconds
		"http.ConnectionTimeOut" => 90,

		// Wather want to log to a file
		"log.LogEnabled" => true,

		// Specify the file that to write on
		"log.FileName" => storage_path() . "/logs/paypal.log",

		/*
		* Available option `FINE`, `INFO`, `WARN` or `ERROR`
		* Logging is most verbose in the `FINE` level and decreases as you
		* proceed towards `ERROR`
		*/
		"log.LogLevel" => 'FINE'

	],
]

?>