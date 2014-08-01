<?php

use PHPImageWorkshop\ImageWorkshop;
require_once(__DIR__.'/PHPImageWorkshop/ImageWorkshop.php');
require_once(__DIR__.'/PHPImageWorkshop/Core/ImageWorkshopLayer.php');
require_once(__DIR__.'/PHPImageWorkshop/Core/ImageWorkshopLib.php');

function createStrip($type) {
	return ImageWorkshop::initFromPath(__DIR__.'/strips/strip'.$type.'.png');
}

function addText($strip, $text, $direction, $posx, $posy) {
	$fontPath = __DIR__."/fonts/UnmaskedBB.otf";
	$fontSize = 12;
	$fontColor = "000000";
	$textRotation = 0;
	//$backgroundColor = "FF0000",
	$layer = ImageWorkshop::initTextLayer($text, $fontPath, $fontSize, $fontColor, $textRotation);
	$strip->addLayerOnTop($layer, $posx, $posy, 'LT');
	$speech = ImageWorkshop::initFromPath(__DIR__.'/speech/line.png');
	if($direction == "left")
		$speech->flip('horizontal');
	$speech->resizeInPixel(14, null, true);
	$offset = (int)($fontSize * strlen($text) / 3.5);
	$strip->addLayerOnTop($speech, $posx + $offset, $posy + 20, 'LT');
}

function createBall($strip, $country, $posx, $posy, $direction, $eyegap) {
	switch($direction) {
	case "left":	$eyeoffset = 20; break;
	case "center":	$eyeoffset = 33; break;
	case "right":	$eyeoffset = 50; break;
	}
	$flag = ImageWorkshop::initFromPath(__DIR__.'/flags/'.$country.'.png');
	$mask = ImageWorkshop::initFromPath(__DIR__.'/masks/ball.png');
	$eye1 = ImageWorkshop::initFromPath(__DIR__.'/eyes/round.png');
	$eye2 = ImageWorkshop::initFromPath(__DIR__.'/eyes/round.png');
	$flag->resizeInPixel(100, 100, false);
	$mask->resizeInPixel(100, null, true);
	$eye1->resizeInPixel(13, null, true);
	$eye2->resizeInPixel(13, null, true);
	$strip->addLayerOnTop($flag, $posx, $posy, 'LT');
	$strip->addLayerOnTop($mask, $posx, $posy, 'LT');
	$strip->addLayerOnTop($eye1, $posx + $eyeoffset, $posy + 20, 'LT');
	$strip->addLayerOnTop($eye2, $posx + $eyeoffset + $eyegap, $posy + 20, 'LT');
}

?>
