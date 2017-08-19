<?php
/*
Plugin Name: Angular form plugin
Plugin URI: http://www.deltabee.com/paypalform
Description: a plugin with paypal integration using angularjs
Version: 1.0
Author: Priyanshi Agrawal 
Author URI: http://deltabee.com/Wordpress-Team/Priyanshi
License: Use this how you like!
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);
defined( 'ABSPATH' ) OR exit;
register_activation_hook(   __FILE__, array( 'Yourstory', 'on_activation' ) );
register_deactivation_hook( __FILE__, array( 'Yourstory', 'on_deactivation' ) );
register_uninstall_hook(    __FILE__, array( 'Yourstory', 'on_uninstall' ) );	

class Yourstory {
    public function __construct()
    {
	  add_shortcode('yourstory', array($this, 'yourstory'));	
	  add_action( 'wp_footer', array($this,'yourstory_scripts'));
	  add_action( 'wp_enqueue_scripts', array($this, 'yourstory_styles'));
	  add_action( 'wp_enqueue_scripts', array($this, 'yourstory_scripts'));
	}
	function yourstory($params = array()) {
		extract(shortcode_atts(array(
	    'file' => 'default'
		), $params));
		return '<div ng-app="angularApp"><ng-view></ng-view></div>';
	}

	function on_activation(){
		global $wpdb;
		$table_name = $wpdb->prefix . "payments_master";
		$table2_name = $wpdb->prefix . "payments_mastermeta"; 
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "DROP TABLE IF EXISTS $table_name;";
		$sql .= "DROP TABLE IF EXISTS $table2_name;";
		$sql .= "CREATE TABLE $table_name (
		  pm_id mediumint(9) NOT NULL AUTO_INCREMENT,
		  txn_id varchar(255) NOT NULL,
		  payer_id varchar(50) NOT NULL,
		  first_name varchar(50) NOT NULL,
		  last_name varchar(50) NOT NULL,
		  business_email varchar(100) NOT NULL,
		  quantity int(11) NOT NULL,
		  payment_date datetime,
		  PRIMARY KEY  (pm_id)
		) $charset_collate;";

		$sql .= "CREATE TABLE $table2_name (
		  meta_id mediumint(9) NOT NULL AUTO_INCREMENT,
		  pm_id mediumint(9) NOT NULL,
		  item_name varchar(50) NOT NULL,
		  meta_key varchar(255) NOT NULL,
		  meta_value varchar(255) NOT NULL,
		  PRIMARY KEY  (meta_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		return;
	}


	function on_deactivation(){
		global $wpdb;
		$table_name = $wpdb->prefix . "payments_master"; 
		$charset_collate = $wpdb->get_charset_collate();
	    $sql = "DROP TABLE IF EXISTS $table_name;";
	    $wpdb->query($sql);
	    return;
	}

	function insert_data(){
		
	}

	function on_uninstall(){
		if ( ! current_user_can( 'activate_plugins' ) )
	    return;
		if ( __FILE__ != WP_UNINSTALL_PLUGIN )
	    return;		
	}
	function yourstory_styles(){
		wp_register_style( 'yourstory', plugins_url( '/assets/style.css', __FILE__ ) );
		wp_enqueue_style( 'yourstory' );
	}
	function generate_form()
	{   ob_start(); 
		include_once('assets/form.html');
		
		return ob_get_clean();
	}
	function yourstory_scripts(){
		wp_enqueue_script( 'angular',  plugin_dir_url( __FILE__ ) .'assets/angular.min.js', false );
		wp_enqueue_script( 'angular-route',  plugin_dir_url( __FILE__ ) .'assets/angular-route.js', false );
		wp_enqueue_script( 'angular-app',  plugin_dir_url( __FILE__ ) .'assets/app.js', false );
		
	}

}
$Yourstory = new Yourstory();

?>