<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/3/2016
 * Time: 12:36 PM
 */

namespace Src\Core;

use Src\Core\Session;

class Upload
{
	protected $fileName;
	protected $uploadDirectory;
	protected $validExtension;
	protected $maxSize;
	protected $maHeight;
	protected $maxWidth;
	protected $tmpName;
	protected $fileType;

	/**
	 * @return mixed
	 */
	public function getUploadDirectory()
	{
		return $this->uploadDirectory;
	}

	/**
	 * @param mixed $uploadDirectory
	 */
	public function setUploadDirectory($uploadDirectory)
	{
		$this->uploadDirectory = $uploadDirectory;
	}

	/**
	 * @return mixed
	 */
	public function getValidExtension()
	{
		return $this->validExtension;
	}

	/**
	 * @param mixed $validExtension
	 */
	public function setValidExtension($validExtension)
	{
		$this->validExtension = $validExtension;
	}

	/**
	 * @return mixed
	 */
	public function getMaxSize()
	{
		return $this->maxSize;
	}

	/**
	 * @param mixed $maxSize
	 */
	public function setMaxSize($maxSize)
	{
		$this->maxSize = $maxSize;
	}

	/**
	 * @return mixed
	 */
	public function getMaHeight()
	{
		return $this->maHeight;
	}

	/**
	 * @param mixed $maHeight
	 */
	public function setMaHeight($maHeight)
	{
		$this->maHeight = $maHeight;
	}

	/**
	 * @return mixed
	 */
	public function getMaxWidth()
	{
		return $this->maxWidth;
	}

	/**
	 * @param mixed $maxWidth
	 */
	public function setMaxWidth($maxWidth)
	{
		$this->maxWidth = $maxWidth;
	}

	/**
	 * @return mixed
	 */
	public function getFileName()
	{
		return $this->fileName;
	}

	/**
	 * @param mixed $fileName
	 */
	public function setFileName($fileName)
	{
		$this->fileName = $fileName;
	}


	/**
	 * @return mixed
	 */
	public function getTmpName()
	{
		return $this->tmpName;
	}

	/**
	 * @param mixed $tmpName
	 */
	public function setTmpName($tmpName)
	{
		$this->tmpName = $tmpName;
	}


	public function validateDirectory()
	{
		$uploadDirectory = $this->uploadDirectory;

		if (!$uploadDirectory) {
			var_dump('ERROR: The directory variable is empty.');
			return false;
		}

		if (!is_dir($uploadDirectory)) {
			var_dump("ERROR: The directory '$uploadDirectory' does not exist.");
			return false;
		}

		if (!is_writable($uploadDirectory)) {
			var_dump("ERROR: The directory '$uploadDirectory' does not writable.");
			return false;
		}

		if (substr($uploadDirectory, -1) != "/") {

			//var_dump('ERROR: The traling slash does not exist.');
			$newDirectory = $uploadDirectory . "/";

			$this->setUploadDirectory($newDirectory);

			$this->validateDirectory();

		} else {
			//$this->SetMessage("MESSAGE: The traling slash exist.");
			return true;
		}
	}

	public function validateExtension()
	{
		$fileName = trim($this->fileName);
		$filePath = pathinfo($fileName);
		$extension = strtolower($filePath['extension']);
		$validExtension = $this->validExtension;

		if ( in_array($extension, $validExtension) ) {
			return true;
		} else {
			Session::setFlash('ERROR: Invalid file extension');
			return false;
		}
	}

	public function validateSize()
	{
		$maximumFileSize = $this->maxSize;
		$tempFileName = $this->getTmpName();
		$tempFileSize = filesize($tempFileName);

		if ($maximumFileSize <= $tempFileSize) {

			Session::setFlash("ERROR: The file is too big. It must be less than $maximumFileSize and it is $tempFileSize.");
			return false;
		}

		return true;
	}

	public function ValidateExistance()
	{
		$fileName = $this->fileName;
		$uploadDirectory = $this->uploadDirectory;
		$file = $uploadDirectory . $fileName;

		if (file_exists($file)) {
			Session::setFlash("Message: The file '$fileName' already exist.");
			$uniqueName = rand() . $fileName;
			$this->setFileName($uniqueName);
			$this->validateExistance();
		} else {
			Session::setFlash("Message: The file name '$fileName' does not exist.");
			return false;
		}
	}

	public function uploadFile()
	{

		if ( !$this->validateExtension() ) {
			var_dump('Error 1');exit;
		}

		else if ( $this->validateExistance() ) {
			var_dump('Error 3 ');exit;
		}

		else if ( $this->validateDirectory() ) {
			var_dump($this->validateDirectory());
		}

		else {

			$fileName = $this->fileName;

			$tempFileName = $this->tmpName;
			$uploadDirectory = $this->uploadDirectory;

			if (is_uploaded_file($tempFileName)) {
				move_uploaded_file($tempFileName, $uploadDirectory . $fileName);
				return true;
			} else {
				return false;
			}

		}

	}

}
