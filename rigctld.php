<?php
/**
 * @brief        rigctld API
 * @date         2018-12-03
 * @author       Tobias Mädel <t.maedel@alfeld.de>
 * @copyright    MIT-licensed
 *
 */
class rigctldAPI
{
	private $host; 
	private $port;
	private $socket = false; 
	function __construct($host = "127.0.0.1", $port = 4532)
	{
		$this->host = $host; 
		$this->port = $port;

		$this->connect();
	}
	function __destruct()
	{
		fclose($this->fp);
	}

	public function connect()
	{
		$this->fp = fsockopen($this->host, $this->port, $errno, $errstr, 5);
		if (!$this->fp) 
			return false; 

		return true;
	}
	private function runCommand($command, $returnSize = 1)
	{
		if ($this->fp === false)
			return false; 

		if (feof($this->fp))
		{
			$this->fp = false;
			return false; 
		}
		
		stream_set_timeout($this->fp, 2);

		fwrite($this->fp, $command . "\n");
		$result = "";
		for ($i=0; $i < $returnSize; $i++)
		{ 
			$result .= trim(fgets($this->fp)) . "\n";
		}
		
		return trim($result);
	}

	public function getFrequency()
	{
		return $this->runCommand("f");
	}

	public function getMode()
	{
		$mode = $this->runCommand("m", 2); 
		if ($mode === false)
			return false; 

		$mode = explode("\n", $mode); 

		return [
			"mode" => $mode[0],
			"passband" => $mode[1]
		];
	}
}
