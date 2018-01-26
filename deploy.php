<?php
$TITLE   = 'Git Deploy';

echo <<<EOT
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>$TITLE</title>
</head>
<body style="font-weight: bold; padding: 0 10px;">
EOT;

// Check whether client is allowed to trigger an update
$allowed_ips = array(
	'207.97.227.', '50.57.128.', '108.171.174.', '50.57.231.', '204.232.175.', '192.30.252.', // GitHub
	'195.37.139.','193.174.' // VZG
);
$allowed = false;
$headers = apache_request_headers();
if (@$headers["X-Forwarded-For"]) {
    $ips = explode(",",$headers["X-Forwarded-For"]);
    $ip  = $ips[0];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
echo $ip;
foreach ($allowed_ips as $allow) {
    if (stripos($ip, $allow) !== false) {
        $allowed = true;
        break;
    }
}
if (!$allowed) {
	header('HTTP/1.1 403 Forbidden');
 	echo "<span style=\"color: #000000\">You shall not pass!</span>\n";
    echo "</pre>\n</body>\n</html>";
    exit;
}
flush();

// Actually run the update
$commands = array(	
'git fetch --all',
'git reset --hard origin/master',
'git pull origin master',
);

$output = "\n";
$log = "####### ".date('Y-m-d H:i:s'). " #######\n";

foreach($commands AS $command){
    // Run it
    $tmp = shell_exec("$command 2>&1");
    // Output
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";
    $log  .= "\$ $command\n".trim($tmp)."\n";
}
$log .= "\n";
file_put_contents ('deploy-log.txt',$log,FILE_APPEND);
echo $output; 
?>
</pre>
</body>
</html>