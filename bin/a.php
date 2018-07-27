
<?php
$tokens = token_get_all(file_get_contents("b.php"));
$a = "";
foreach ($tokens as $token) {
    if (is_array($token)) {
        // echo "Line {$token[2]}: ", token_name($token[0]), " ('{$token[1]}')", PHP_EOL;
        $a.=$token[1];
        switch ($token[0]) {
        	case T:
        		# code...
        		break;
        	
        	default:
        		# code...
        		break;
        }
    } else {
    	$a.=$token;
    }
}


var_dump($a);