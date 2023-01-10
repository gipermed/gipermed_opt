<?php
echo "<pre>";

$contents = file_get_contents("redirects.txt");
$lines = explode(PHP_EOL, $contents);

$counter = 0;
foreach($lines as $line) {
	$expline = explode(' ', trim($line));
	if ($expline[2] != $expline[3]) {
		echo "Redirect 301 " . $expline[2] . " https://gipermed.ru" . $expline[3] . PHP_EOL;
		$counter++;
	}
}

echo "Non-repeating total: " . $counter;

echo "</pre>";
?>