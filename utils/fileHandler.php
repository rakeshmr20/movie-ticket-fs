<?php
// Developed by Rakesh M R

/**
 * File Handlers
 */
class FileProcess
{
	private $fileName;
	private $fileHandler;
	private $fileData;

	function __construct($fName)
	{
		$this->fileName = $fName;
		$this->fileHandler = fopen($this->fileName, 'a+');
	}
	function __destruct()
	{
		$this->fileName = null;
		fclose($this->fileHandler);
	}
	// Methods to handle file processing
	// Read all data
	function readFile()
	{
		$this->fileData = fread($this->fileHandler, filesize($this->fileName));
		return $this->fileData;
	}
	// Get all data as array
	function getAllData()
	{
		if (!$this->fileData) {
			$this->readFile();
		}
		if ($this->fileData) {
			$finalData = array();
			$fullDataArray = explode("|", $this->fileData, -1);
			foreach ($fullDataArray as $key => $value) {
				$singleDataArray = explode("~", $value, -1);
				array_push($finalData, $singleDataArray);
			}
			return $finalData;
		} else {
			return false;
		}
	}
	// Get single movie
	function getSingleData($id)
	{
		if (!$this->fileData) {
			$this->readFile();
		}
		if ($this->fileData) {
			$fullDataArray = explode("|", $this->fileData, -1);
			foreach ($fullDataArray as $key => $value) {
				$singleDataArray = explode("~", $value, -1);
				// print_r($singleDataArray);
				if ($singleDataArray[0] === $id) {
					return $singleDataArray;
				}
			}
			return false;
		} else {
			return false;
		}
	}

	// Append any data
	function appendFile($data)
	{
		try {
			fwrite($this->fileHandler, $data);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	// Create new file or overwrite existing file
	function writeToFile($data)
	{
		$handler = fopen($this->fileName, 'w');
		fwrite($handler, $data);
		fclose($handler);
	}
	// Delete a file
	function deleteFile()
	{
		unlink($this->fileName);
		$this->fileName = null;
	}
}

/**
 * User handlers
 */
class UserManagement
{
	private $fname;
	private $fHandler;
	private $usersData;
	private $userData;
	private $flag = false;
	// Handlers for JSON Data
	function __construct()
	{
		$this->fname = 'database/users.txt';
		$this->fHandler = fopen($this->fname, 'a+');
	}
	function __destruct()
	{
		fclose($this->fHandler);
	}
	function getAllUsers()
	{
		$this->usersData = fread($this->fHandler, filesize($this->fname));
		return $this->usersData;
	}
	function getSingleUser($userName='', $userId='')
	{
		$this->getAllUsers();
		$allUsersArray = explode("|", $this->usersData, -1);
		foreach ($allUsersArray as $key => $value) {
			$this->userData = explode("~", $value, -1);
			if ($this->userData[1]===$userName || $this->userData[0] === $userId) {
				$this->flag = true;
				break;
			}
		}
		if ($this->flag == true) {
			return $this->userData;
		} else {
			return false;
		}
	}
	// 1~kashi~pass~100~hash|2~name~pass~200~hash|
	function addUser($userName, $pHash)
	{
		if (!$this->getSingleUser($userName)) {
			$data = ''.uniqid().'~'.$userName.'~'.$pHash.'~200~';
			$finalData = $data.strval(sha1($data)).'|';
			// echo($finalData);
			fwrite($this->fHandler, $finalData);
			return true;
		} else {
			return false;
		}
		
	}
	// Get user Count
	function getUserCount($uStatus)
	{
		$count = 0;
		if (!$this->usersData) {
			$this->getAllUsers();
		}
		$allUsersArray = explode("|", $this->usersData, -1);
		foreach ($allUsersArray as $key => $value) {
			$this->userData = explode("~", $value, -1);
			if ($this->userData[3]=== $uStatus) {
				++$count;
			}
		}
		return $count;
	}
}

?>