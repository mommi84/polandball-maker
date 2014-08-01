<?php

include "functions.php";

$strip = createStrip(1);

$eyegap = 20;
createBall($strip, "Poland", 120, 250, "right", $eyegap);
createBall($strip, "Germany", 260, 250, "left", $eyegap);

addText($strip, "polandball is of generatings!", "left", 120, 170);

header('Content-type: image/png');
header('Content-Disposition: filename="polandball.png"');
imagepng($strip->getResult(), null, 9);
exit;

?>
