<?php
$s = false;
echo time();
echo "<br>";
echo hexdec(bin2hex(openssl_random_pseudo_bytes(5, $s)));
echo "<br>";
echo $s;
$s = false;
echo "<br>";
echo bin2hex(openssl_random_pseudo_bytes(5, $s));
echo "<br>";
echo $s;
$s = True;

?>
