<?php
/*
Plugin Name: MojoLive Profile Widget
Plugin URI: http://github.com/jblotus/mojolive-wordpress-plugin
Description: This widget will allow you to display parts of your mojoLive profile on your template.
Version: 0.01
Author: James Fuller <jblotus@gmail.com>
Author URI: http://www.jblotus.com
Author Email: jblotus@gmail.com
License:

  Copyright 2012 James Fuller (jblotus@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Mojolive_Widget extends WP_Widget {

  /*--------------------------------------------------*/
  /* Constructor
  /*--------------------------------------------------*/
  
  /**
   * The widget constructor. Specifies the classname and description, instantiates
   * the widget, loads localization files, and includes necessary scripts and
   * styles.
   */
  public function __construct() {
  
    load_plugin_textdomain( 'mojolive-widget-locale', false, plugin_dir_path( __FILE__ ) . '/lang/' );
    
    register_activation_hook( __FILE__, array( &$this, 'activate' ) );
    register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );
    
    parent::__construct(
      'mojolive-widget-id',
      'Mojolive_Widget',
      array(
        'classname'   =>  'mojolive-widget-class',
        'description' =>  __( 'Mojolive description', 'mojolive-widget-locale' )
      )
    );
    
    // Register admin styles and scripts
    add_action( 'admin_print_styles', array( &$this, 'register_admin_styles' ) );
    add_action( 'admin_enqueue_scripts', array( &$this, 'register_admin_scripts' ) );
  
    // Register site styles and scripts
    add_action( 'wp_enqueue_scripts', array( &$this, 'register_widget_styles' ) );
    add_action( 'wp_enqueue_scripts', array( &$this, 'register_widget_scripts' ) );
    
  } // end constructor

  /*--------------------------------------------------*/
  /* Widget API Functions
  /*--------------------------------------------------*/
  
  /**
   * Outputs the content of the widget.
   *
   * @args      The array of form elements
   * @instance    The current instance of the widget
   */
  public function widget( $args, $instance ) {
  
    extract( $args, EXTR_SKIP );
    
    echo $before_widget;

    echo "FOOOOO";
    
      // TODO: This is where you retrieve the widget values
    
    // Display the widget
    include( plugin_dir_path(__FILE__) . '/views/widget.php' );
    
    echo $after_widget;
    
  } // end widget
  
  /**
   * Processes the widget's options to be saved.
   *
   * @new_instance  The previous instance of values before the update.
   * @old_instance  The new instance of values to be generated via the update.
   */
  public function update( $new_instance, $old_instance ) {
    
    $instance = $old_instance;
    
      // TODO Update the widget with the new values
    
    return $instance;
    
  } // end widget
  
  /**
   * Generates the administration form for the widget.
   *
   * @instance  The array of keys and values for the widget.
   */
  public function form( $instance ) {
  
      // TODO define default values for your variables
    $instance = wp_parse_args(
      (array) $instance,
      array(
        ''  =>  ''
      )
    );
  
      // TODO store the values of widget in a variable
    
    // Display the admin form
      include( plugin_dir_path(__FILE__) . '/views/admin.php' );
    
  } // end form

  /*--------------------------------------------------*/
  /* Public Functions
  /*--------------------------------------------------*/
  
  /**
   * Fired when the plugin is activated.
   *
   * @params  $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
   */
  public function activate( $network_wide ) {
    // TODO define activation functionality here
  } // end activate
  
  /**
   * Fired when the plugin is deactivated.
   *
   * @params  $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
   */
  public function deactivate( $network_wide ) {
    // TODO define deactivation functionality here    
  } // end deactivate
  
  /**
   * Registers and enqueues admin-specific styles.
   */
  public function register_admin_styles() {
  
    // TODO change 'mojolive-widget' to the name of your plugin
    wp_enqueue_style( 'mojolive-widget-admin-styles', plugins_url( 'mojolive-widget/css/admin.css' ) );
  
  } // end register_admin_styles

  /**
   * Registers and enqueues admin-specific JavaScript.
   */ 
  public function register_admin_scripts() {
  
    // TODO change 'mojolive-widget' to the name of your plugin
    wp_register_script( 'mojolive-widget-admin-script', plugins_url( 'mojolive-widget/js/admin.js' ) );
    wp_enqueue_script( 'mojolive-widget-admin-script' );
  
  } // end register_admin_scripts
  
  /**
   * Registers and enqueues widget-specific styles.
   */
  public function register_widget_styles() {
  
    // TODO change 'mojolive-widget' to the name of your plugin
    wp_register_style( 'mojolive-widget-widget-styles', plugins_url( 'mojolive-widget/css/admin.css' ) );
    wp_enqueue_style( 'mojolive-widget-widget-styles' );
  
  } // end register_widget_styles
  
  /**
   * Registers and enqueues widget-specific scripts.
   */
  public function register_widget_scripts() {
  
    // TODO change 'mojolive-widget' to the name of your plugin
    wp_register_script( 'mojolive-widget-admin-script', plugins_url( 'mojolive-widget/js/admin.js' ) );
    wp_enqueue_script( 'mojolive-widget-widget-script' );
  
  } // end register_widget_scripts
  
} // end class
// TODO remember to change 'Mojolive_Widget' to match the class name definition
add_action( 'widgets_init', create_function( '', 'register_widget("Mojolive_Widget");' ) ); 
?>