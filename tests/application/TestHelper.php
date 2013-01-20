<?php
require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/Framework/IncompleteTestError.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestSuite.php';
require_once 'PHPUnit/Runner/Version.php';
require_once 'PHPUnit/TextUI/TestRunner.php';
require_once 'PHPUnit/Util/Filter.php';

error_reporting ( E_ALL | E_STRICT );
date_default_timezone_set ( 'Europe/London' );

$root = realpath ( dirname ( __FILE__ ) . '/../../' );
$paths = array (
		get_include_path (),
		"$root/library",
		"$root/tests",
		"$root/application" 
);
set_include_path ( implode ( PATH_SEPARATOR, $paths ) );

defined ( 'APPLICATION_PATH' ) 
	or define ( 'APPLICATION_PATH', realpath ( dirname ( __FILE__ ) 
				. '/../../application' ) );
	
require_once 'ControllerTestCase.php';

Zend_Session::$_unitTestEnabled = true;
Zend_Session::start ();

PHPUnit_Util_Filter::addDirectoryToFilter ( "$root/tests" );
PHPUnit_Util_Filter::addDirectoryToFilter ( "$root/library/Zend" );
