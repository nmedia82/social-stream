<?php
/**
 * handling ajax request for installer
 * 	
 */
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

include_once dirname(__FILE__) . '/classInstaller.php';

$installer = new NM_LV_Installer();

if(!IS_AJAX) {
	die('Restricted access');
} else {
	if (isset($_REQUEST) && $_REQUEST['action'] == 'test') {
		extract($_REQUEST);
		$connect = mysql_connect($host, $user, $pass) or die("Unable to Connect to '$dbhost'");
		mysql_select_db($db) or die("Could not open the db '$db'");

		echo 'success';

	}
	if (isset($_REQUEST) && $_REQUEST['action'] == 'install') {
		extract($_REQUEST);
		$installer -> set_env_file($user, $db, $pass);
		$installer -> run_migrations();
		echo 'Installation Completed! Please remove install directory from your project as soon as possible';
	}
}