<?php
if (! defined ( 'PHPUnit_MAIN_METHOD' )) {
	define ( 'PHPUnit_MAIN_METHOD', 'SF_Application_AllTests::main' );
}
require_once dirname ( __FILE__ ) . '/TestHelper.php';
require_once 'controllers/indexControllerTest.php';

class SF_Application_AllTests {
	public static function main() {
		PHPUnit_TextUI_TestRunner::run ( self::suite () );
	}
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite ( 'Caramite Application Tests' );
		$suite->addTestSuite ( 'IndexControllerTest' );
		return $suite;
	}
}

if (PHPUnit_MAIN_METHOD == 'SF_Application_AllTests::main') {
	SF_Unit_AllTests::main ();
}
