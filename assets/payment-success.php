<?php
	echo "payment done successfully";

 		require_once( 'http://wp.ktec.co.il/wp-config.php' );
		global $wpdb;
		$table2_name = $wpdb->prefix . "payments_mastermeta";
		$item_name = $_POST['item_name'];
		$wpdb->insert( $table2_name, array(
		'meta_key' => $item_name
		
		) );
		
		

?>