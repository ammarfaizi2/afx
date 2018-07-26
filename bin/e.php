<?php
$a = explode("eval(", file_get_contents("b.php"), 2);
ob_start();
eval("?>".$a[0]." print(".$a[1]);
$clean = ob_get_clean();
$a = explode("eval(", $clean, 2);
ob_start();
eval("?>".$a[0]." print(".$a[1]);
$clean = ob_get_clean();
ob_start();
$a = explode("eval(", $clean, 2);
eval($a[0]);
$clean = ob_get_clean();
eval(str_replace("eval", "print", $clean));