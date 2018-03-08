<?php
namespace App\Utils;
/**
 *
 */
class ImageFormat{

	public static function format ($image){


		list($w, $h) = getimagesize($image);

		if($w > $h){
			$diff  = ($w - $h) * 0.5;
			$diffW = $h;
			$diffH = $h;
			$diffY = 0;
			$diffX = $diff;
		}elseif($w < $h){
			$diff  = ($h - $w) * 0.5;
			$diffW = $w;
			$diffH = $w;
			$diffY = $diff;
			$diffX = 0;
		}elseif($w === $h){
			$diffW = $w;
			$diffH = $h;
			$diffY = 0;
			$diffX = 0;
		}


		$thumbW = 1000;
		$thumbH = 1000;

		$thumbnail = imagecreatetruecolor($thumbW, $thumbH);

		$baseImage = imagecreatefromjpeg($image);

		imagecopyresampled($thumbnail, $baseImage, 0, 0, $diffX, $diffY, $thumbW, $thumbH, $diffW, $diffH);

		imagejpeg($thumbnail, $image, 60);
	}
}
