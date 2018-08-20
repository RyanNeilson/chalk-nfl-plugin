<?php
/*
* Plugin Name: Chalk NFL Teams
* Description: Displays NFL teams sorted by conference and division
* Version: 1.0.0
* Author: Ryan Neilson
* Author URI: https://neilsonwebdesign.com
* License: GPLv2 or later
*/

/**
* @package ChalkNFLPlugin
*/


/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/*
The Activate and Deactivate functions should be uncommented if the user wishes to create a custom post type for use with this plugin.
*/

//use Inc\Activate;
//use Inc\Deactivate;
use Inc\Admin;
use Inc\Display;

class ChalkNFLTeams
{

    public $plugin;

    function __construct() {

        $this->plugin = plugin_basename( __FILE__ );

    }

    function register() {
    
        add_shortcode('chalkNFLteams', array( $this, 'sort_and_display' ));
       
        add_action( 'admin_menu', array( $this, 'add_admin_page' ) );

        add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );  

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

    }

    //Add link from plugin activation page to plugin settings page
    public function settings_link( $links ) {

        $settings_link = '<a href="Admin.php?page=chalk_NFL_teams">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }

    //Add the plugin admin page to the WP dashboard
    public function add_admin_page() {
        
        add_menu_page( 'Chalk NFL Teams', 'Chalk NFL Teams', 'manage_options', 'chalk_NFL_teams', array( $this, 'admin_stuff' ), '
dashicons-shield-alt', 110);
    
    }

    //Code for displaying the admin settings page
    public function admin_stuff() {

        Admin::build_page();
    
    }

    // Enqueue Styles
    function enqueue() {

        wp_register_style( 'chalkstyle', plugins_url( '/assets/chalkstyle.css', __FILE__ ) );
        wp_enqueue_style( 'chalkstyle' );
        wp_register_style('chalk-googleFonts', 'http://fonts.googleapis.com/css?family=Didact+Gothic|Merriweather:700');
        wp_enqueue_style( 'chalk-googleFonts');
        
    }


    

    //Uncomment the functions below if generating a custom post type
    
    /*function activate() {
        
        Activate::activate();

    }

    function deactivate() {
    
        Deactivate::deactivate();

    }*/



    //Sort the JSON data and display it via shortcode
    function sort_and_display() {

        Display::display();

    }
    
}

$chalkNFLTeams = new ChalkNFLTeams(); 
$chalkNFLTeams->register();


//register_activation_hook( __FILE__, array( $chalkNFLTeams, 'activate') );

//register_deactivation_hook( __FILE__, array( 'Deactivate', 'deactivate'));
 

?>
