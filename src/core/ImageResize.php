<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/7/2016
 * Time: 4:27 AM
 */
namespace Src\Core;

class ImageResize
{
	private $image;
	private $width;
	private $height;
	private $resizedImage;

	public function __construct($imageFile)
	{
		$this->image = $this->openImage($imageFile);
		$this->height = imagesy($this->image);
		$this->width = imagesx($this->image);
	}

	private function openImage($imageFile)
	{
		$extension = strtolower(strrchr($imageFile['image']['name'], '.'));

		switch ($extension) {
			case '.jpg':
			case '.jpeg':
				$img = @imagecreatefromjpeg($imageFile['image']['tmp_name']);
				break;
			case '.gif':
				$img = @imagecreatefromgif($imageFile);
				break;
			case '.png':
				$img = @imagecreatefrompng($imageFile);
				break;
			default:
				$img = false;
				break;
		}

		return $img;
	}

	public function saveImage($savePath, $imageQuality="100")
	{
		// *** Get extension
		$extension = strrchr($savePath, '.');
		$extension = strtolower($extension);

		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				if (imagetypes() & IMG_JPG) {
					imagejpeg($this->resizedImage, $savePath, $imageQuality);
				}
				break;

			case '.gif':
				if (imagetypes() & IMG_GIF) {
					imagegif($this->resizedImage, $savePath);
				}
				break;

			case '.png':
				// *** Scale quality from 0-100 to 0-9
				$scaleQuality = round(($imageQuality/100) * 9);

				// *** Invert quality setting as 0 is best, not 9
				$invertScaleQuality = 9 - $scaleQuality;

				if (imagetypes() & IMG_PNG) {
					imagepng($this->resizedImage, $savePath, $invertScaleQuality);
				}
				break;

			// ... etc

			default:
				// *** No extension - No save.
				break;
		}

		imagedestroy($this->resizedImage);
	}

	public function resizeImage($newWidth, $newHeight)
	{

		// *** Get optimal width and height - based on $option
		$optionArray = $this->getDimensions($newWidth, $newHeight);

		$optimalWidth = $optionArray['optimalWidth'];
		$optimalHeight = $optionArray['optimalHeight'];

		// *** Resample - create image canvas of x, y size
		$this->resizedImage = imagecreatetruecolor($optimalWidth, $optimalHeight);
		imagecopyresampled($this->resizedImage, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width,
			$this->height);


		// *** if option is 'crop', then crop too
	}

	private function getDimensions($newWidth, $newHeight)
	{
		$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
		$optimalWidth = $optionArray['optimalWidth'];
		$optimalHeight = $optionArray['optimalHeight'];

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function getSizeByAuto($newWidth, $newHeight)
	{
		if ($this->height < $this->width)
			// *** Image to be resized is wider (landscape)
		{
			$optimalWidth = $newWidth;
			$optimalHeight= $this->getSizeByFixedWidth($newWidth);
		}
		elseif ($this->height > $this->width)
			// *** Image to be resized is taller (portrait)
		{
			$optimalWidth = $this->getSizeByFixedHeight($newHeight);
			$optimalHeight= $newHeight;
		}
		else
			// *** Image to be resizerd is a square
		{
			if ($newHeight < $newWidth) {
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
			} else if ($newHeight > $newWidth) {
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
			} else {
				// *** Sqaure being resized to a square
				$optimalWidth = $newWidth;
				$optimalHeight= $newHeight;
			}
		}

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function getSizeByFixedHeight($newHeight)
	{
		$ratio = $this->width / $this->height;
		$newWidth = $newHeight * $ratio;
		return $newWidth;
	}

	private function getSizeByFixedWidth($newWidth)
	{
		$ratio = $this->height / $this->width;
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}

	/**
	 * @return mixed
	 */
	public function getResizedImage()
	{
		return $this->resizedImage;
	}

	/**
	 * @return bool|resource
	 */
	public function getImage()
	{
		return $this->image;
	}

}
