<?php		

function imageresize($blobcontents, $max_width, $max_height) {

	$im = imagecreatefromstring($blobcontents);
	$new = imagecreatetruecolor($max_width, $max_height);

	$x = imagesx($im);
	$y = imagesy($im);

	if ($x > $max_width || $y > $max_height) {
	
		// Calculate the scaling we need to do to fit the image inside our frame
		$scale      = min($max_width/$x, $max_height/$y);
	
		// Get the new dimensions
		$new_width  = ceil($scale*$x);
		$new_height = ceil($scale*$y);
	
		imagecopyresampled($new, $im, 0, 0, 0, 0, $new_width, $new_height, $x, $y);
	
		imagedestroy($im);
		
		return $new;
	} 
	
	else {
		
		return $im;
	} 
	
}
	
?>
