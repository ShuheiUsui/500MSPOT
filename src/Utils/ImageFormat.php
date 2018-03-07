<?php
namespace App\Utils;
/**
 *
 */
class ImageFormat{

	public static function format ($image){

		//元の画像のサイズを取得する
		list($w, $h) = getimagesize($image);
		//元画像の縦横の大きさを比べてどちらかにあわせる
		// なおかつ縦横の差をコピー開始位置として使えるようセット
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

		//サムネイルのサイズ
		$thumbW = 1000;
		$thumbH = 1000;
		//サムネイルになる土台の画像を作る
		$thumbnail = imagecreatetruecolor($thumbW, $thumbH);
		//元の画像を読み込む
		$baseImage = imagecreatefromjpeg($image);
		//サムネイルになる土台の画像に合わせて元の画像を縮小しコピーペーストする
		imagecopyresampled($thumbnail, $baseImage, 0, 0, $diffX, $diffY, $thumbW, $thumbH, $diffW, $diffH);
		//圧縮率60で保存する
		imagejpeg($thumbnail, $image, 60);
	}
}
