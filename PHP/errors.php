<?php

#get absolute path
//echo getcwd();


date_default_timezone_set('America/Chicago');
ini_set('display_errors','0');			// Best practise on production sites
ini_set('log_errors','1');			// We need to log them otherwise this script will be pointless!
ini_set('error_log','/home/content/a/x/i/axizjoel/html/fakeweb/error_log/my-test-errors.log');	// Full path to a writable file - include the file name
error_reporting(E_ALL ^ E_NOTICE);		// What errors to log - see: http://www.php.net/error_reporting



/*
 * PHP Error type
 */

# 1 E_ERROR: A fatal error that causes script termination
# 2 E_WARNING: Run-time warning that does not cause script termination
# 3 E_PARSE: Compile time parse error.
# 4 E_NOTICE: Run time notice caused due to error in code
# 5 E_CORE_ERROR: Fatal errors that occur during PHP's initial startup (installation)
# 6 E_CORE_WARNING: Warnings that occur during PHP's initial startup
# 7 E_COMPILE_ERROR: Fatal compile-time errors indication problem with script.
# 8 E_USER_ERROR: User-generated error message.
# 9 E_USER_WARNING: User-generated warning message.
# 10 E_USER_NOTICE: User-generated notice message.
# 11 .E_STRICT: Run-time notices.
# 12 E_RECOVERABLE_ERROR: Catchable fatal error indicating a dangerous error
# 13 E_ALL: Catches all errors and warnings

date_default_timezone_set('America/Chicago');

/*
 * 
 * Catch normal error
 */

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline){
	$date = date('Y-m-d H:i:s');
	error_log("[$date]:[error_type]->$errno [error_message]->$errstr [file]->$errfile [line]->$errline".PHP_EOL, 3, "/home/content/a/x/i/axizjoel/html/fakeweb/PDO/my-errors.log");
	return false;
}

set_error_handler("myErrorHandler");

/*
 * 
 * Catch Fatal Error
 */
register_shutdown_function('shutdownFunction');

function shutDownFunction() {
	$error = error_get_last();
	if ($error['type'] == 1) {
		//do your stuff
		$date = date('Y-m-d H:i:s');
		$type = $error['type'];
		$message = $error['message'];
		$file = $error['file'];
		$line = $error['line'];
		error_log("*FATAL* [$date]:[error_message]->$message [file]->$file [line]->$line".PHP_EOL, 3, "/home/content/a/x/i/axizjoel/html/fakeweb/PDO/my-errors.log");
	}
	return false;
}


?>
