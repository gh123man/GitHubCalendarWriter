<?php

$im = imagecreate(110, 7);

imagecolorallocate($im, 0, 0, 0);
$textColor = imagecolorallocate($im, 233, 14, 91);

//imagestring($im, 1, 0, 0,  "HELLO WORLD", $textColor);

$font = './Comic_Sans_MS.ttf';
imagettftext($im, 6, 0, 7, 6, $textColor, $font, "HELLO WORLD");




for ($i = 0; $i < 110; $i++) {
    for ($j = 0; $j < 7; $j++) {
        $c = imagecolorat ($im, $i, $j);
        echo $c;
    }
    echo "\n";
}

imagepng($im);
imagedestroy($im);
?>
