#!/usr/bin/php
<?php
/**
 * @brief        Cloudlog rigctld Interface
 * @date         2018-12-02
 * @author       Tobias Mädel <t.maedel@alfeld.de>
 * @copyright    MIT-licensed
 *
 */

include("config.php");
include("rigctld.php"); 

$rigctl = new rigctldAPI($rigctl_host, $rigctl_port); 

$lastFrequency = false; 
$lastMode = false; 

while (true)
{
	$data = $rigctl->getFrequencyAndMode();

	// check if we've gotten a proper response from rigctld
	if ($data !== false)
	{
		// only send POST to cloudlog if the settings have changed
		if ($lastFrequency != $data['frequency'] || $lastMode != $data['mode'] )
		{
			$data = [
				"radio" => $radio_name,
				"frequency" => $data['frequency'],
				"mode" => $data['mode'],

				/* Found these additional parameter in magicbug's SatPC32 application. 
				   I'm not much of a satellite op yet, so I'm not sure how these should be implemented (probably with the secondary VFOs?)
				   PR or Issues with details welcome! 

				   I'm still sending these values in order to mitigate a nasty "Message: Undefined variable: uplink_mode" PHP error in one of the AJAX calls.
				*/ 
				"sat_name" => "",
				"downlink_freq" => 0,
				"uplink_freq" => 0,
				"downlink_mode" => 0,
				"uplink_mode" => 0,
				"key" => $cloudlog_apikey
			];

			postInfoToCloudlog($cloudlog_url, $data);
			$lastMode = $data['mode'];
			$lastFrequency = $data['frequency'];

			echo "Updated info. Frequency: " . $data['frequency'] . " - Mode: " . $data['mode'] . "\n";
		}
		
	}
	else
	{
		$rigctl->connect();
	}

	sleep($interval);
}


function postInfoToCloudlog($url, $data)
{
	$json = json_encode($data, JSON_PRETTY_PRINT);
	$ch = curl_init( $url . '/index.php/api/radio' );
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'Content-Length: ' . strlen($json)
	]); 

	$result = curl_exec($ch);
	//var_dump($result);
}
