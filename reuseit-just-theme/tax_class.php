<?php 
	error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php';
global $wpdb;
	rocket_clean_domain();
	if(isset($_REQUEST['type_of_user'])){ 
		if($_REQUEST['type_of_user'] == 'company'){
			WC()->session->set( 'my_custom_tax_rate_company', 1 );
		} else {
				  
			WC()->session->__unset( 'my_custom_tax_rate_company' );
		}
	}

?>