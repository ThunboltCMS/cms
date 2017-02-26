<?php

function chooseBool() {
	echo 'Your choose (y/n): ';
	$stdin = fopen('php://stdin', 'r');
	$response = strtolower(fgetc($stdin));
	if (!in_array($response, ['y', 'n'])) {
		warning('Please type y or n');

		return chooseBool();
	}

	return $response === 'y';
}

function error($msg) {
	fprintf(STDERR, "\033[31m" . $msg . "\033[39m\n");
	exit(1);
}

function warning($msg) {
	fprintf(STDOUT, "\033[33m" . $msg . "\033[39m\n");
}

function info($msg) {
	fprintf(STDOUT, $msg . "\n");
}

function bold($msg) {
	return "\033[1m" . $msg . "\033[22m";
}

function command($msg) {
	fprintf(STDOUT, "\033[35m" . bold($msg) . "\033[39m\n");
}

function existScript($name) {
	exec('command -v ' . $name, $x, $return);

	return $return === 0;
}
