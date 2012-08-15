<?php
/*
Plugin Name: MojoLive Profile Widget
Plugin URI: http://github.com/jblotus/mojolive-wordpress-plugin
Description: This widget will allow you to display parts of your mojoLive profile on your template.
Version: 0.1
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

  /**
   * The default amount of time (seconds) that profile data should be cached
   * @var int
   */
  public $CACHE_TTL = 1200;
  /**
   * The cache ley prefix for the mojolive api profile data
   * @var string
   */
  public $CACHE_KEY_PREFIX = 'mojolive-widget-profile-user-';

  public $WIDGET_DESCRIPTION = 'Displays your mojoLive score on your sidebar';

  /**
   * The widget constructor. Specifies the classname and description, instantiates
   * the widget, loads localization files, and includes necessary scripts and
   * styles.`
   */
  public function __construct() {

    load_plugin_textdomain( 'mojolive-widget-locale', false, plugin_dir_path( __FILE__ ) . '/lang/' );

    register_activation_hook( __FILE__, array( &$this, 'activate' ) );
    register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );

    parent::__construct(
      'mojolive-widget',
      'mojolive Profile Widget',
      array(
        'classname'   =>  'mojolive-widget-class',
        'description' =>  __( $this->WIDGET_DESCRIPTION, 'mojolive-widget-locale' )
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

    $username  = !empty($instance['username']) ? $instance['username'] : null;
    $cache_key = $this->CACHE_KEY_PREFIX . $username;
    $cache_ttl = !empty($instance['cache_ttl']) ? $instance['cache_ttl'] : $this->CACHE_TTL;

    // Try to get profile json from cache
    if ( false === ( $user = get_transient( $cache_key ) ) ) {
      $user = $this->load_user($username);
      set_transient( $cache_key, $user, 1 );
    }

    $score       = !empty($user['score']) ? $user['score'] : null;
    $image_url   = !empty($user['image']) ? $user['image'] : null;
    $profile_url = !empty($user['profile']) ? $user['profile'] : null;
    //the following vars are not yet being used
    //$full_name   = !empty($user['full_name']) ? $user['full_name'] : null;
    //$geography   = !empty($user['geography']) ? $user['geography'] : null;
    //$tagline     = !empty($user['tagline']) ? $user['tagline'] : null;
    // Display the widget
    include( plugin_dir_path(__FILE__) . '/views/widget.php' );

    echo $after_widget;
  }

  public function load_user($username)
  {
    $uri = 'http://mojolive.com/api/v1/user?username=' . $username . '&appname=jblotus-mojolive-wordpress-plugin';
    $response = wp_remote_get($uri);

    if (is_wp_error($response)) {
      echo 'Something went wrong!';
    }

    $body = wp_remote_retrieve_body($response);
    $user = (array)json_decode($body);
    return $user;
  } // end widget

  /**
   * Processes the widget's options to be saved.
   *
   * @new_instance  The previous instance of values before the update.
   * @old_instance  The new instance of values to be generated via the update.
   */
  public function update( $new_instance, $old_instance ) {

    $instance = $old_instance;
    $instance['username']  = strip_tags(stripslashes($new_instance['username']));
    $instance['cache_ttl'] = !empty($new_instance['cache_ttl']) ? (integer) $new_instance['cache_ttl'] : $this->CACHE_TTL;

    //since we are saving this would be a good time to clear the cache
    delete_transient($this->CACHE_KEY_PREFIX . $new_instance['username']);
    return $instance;

  } // end widget

  /**
   * Generates the administration form for the widget.
   *
   * @instance  The array of keys and values for the widget.
   */
  public function form( $instance ) {

    $instance = wp_parse_args(
      (array) $instance,
      array(
        'username'  =>  ''
      )
    );

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
  } // end activate

  /**
   * Fired when the plugin is deactivated.
   *
   * @params  $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
   */
  public function deactivate( $network_wide ) {
  } // end deactivate

  /**
   * Registers and enqueues admin-specific styles.
   */
  public function register_admin_styles() {

    wp_enqueue_style( 'mojolive-widget-admin-styles', plugins_url( '/css/admin.css', __FILE__ ) );

  } // end register_admin_styles

  /**
   * Registers and enqueues admin-specific JavaScript.
   */
  public function register_admin_scripts() {

    wp_register_script( 'mojolive-widget-admin-script', plugins_url( '/js/admin.js', __FILE__ ) );
    wp_enqueue_script( 'mojolive-widget-admin-script' );

  } // end register_admin_scripts

  /**
   * Registers and enqueues widget-specific styles.
   */
  public function register_widget_styles() {

    wp_register_style( 'mojolive-widget-styles', plugins_url( 'css/widget.css', __FILE__ ) );
    wp_enqueue_style( 'mojolive-widget-styles' );

  } // end register_widget_styles

  /**
   * Registers and enqueues widget-specific scripts.
   */
  public function register_widget_scripts() {

    wp_register_script( 'mojolive-widget-script', plugins_url( 'js/admin.js', __FILE__ ) );
    wp_enqueue_script( 'mojolive-widget-script' );

  } // end register_widget_scripts

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget("Mojolive_Widget");' ) );
