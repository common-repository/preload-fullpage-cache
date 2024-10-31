<?php
/*
Plugin Name: Preload Fullpage Cache
Version: 1.0.2
Plugin URI: https://www.tinywp.in/preload-fullpage-cache/
Author: Pothi Kalimuthu
Author URI: https://www.tinywp.com/
Description: Preloads any new or updated post into fullpage cache.
*/

// disable executing this script directly
defined( 'ABSPATH'  ) or die( 'No script kiddies please!' );

if( !class_exists('PRELOAD_FULLPAGE_CACHE') ) {
    class PRELOAD_FULLPAGE_CACHE
    {
        function __construct() {
            add_action( 'wp_insert_post', array( $this, 'preload_desktop' ),  900, 3 ); // let's fetch the post very late
            add_action( 'wp_insert_post', array( $this, 'preload_mobile' ),   990, 3 ); // let's fetch mobile version even later
            add_action( 'wp_insert_post', array( $this, 'preload_amp' ), 999, 3 ); // let's fetch AMP version at last; only works on posts
        }

        // verison to fetch: desktop
        // user-agent: Firefox 116 on macOS Big Sur 11.7.9
        function preload_desktop( $post_ID, $post, $update ) {
            $desktop_url = get_permalink( $post_ID );
            $desktop_url_args = array(
                'httpversion' => '1.1',
                'user-agent'  => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/116.0', // Firefox on macOS
            );
            wp_remote_get( $desktop_url, $desktop_url_args );
        }

        // version to fetch: mobile
        // user-agent: iPad Air (from Chrome)
        function preload_mobile( $post_ID, $post, $update ) {
            $mobile_url = get_permalink( $post_ID );
            $mobile_url_args = array(
                'httpversion' => '1.1',
                'user-agent'  => 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1',
            ); 
            wp_remote_get( $mobile_url, $mobile_url_args );
        }

        // version to fetch: amp
        // user-agent: Chrome 62 on a macOS Sierra 10.12.6
        function preload_amp( $post_ID, $post, $update ) {
            $amp_url = get_permalink( $post_ID ) . 'amp/';
            $amp_url_args = array(
                'httpversion' => '1.1',
                'user-agent'  => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.89 Safari/537.36',
            );
            wp_remote_get( $amp_url, $amp_url_args );
        }
    } // class PRELOAD_FULLPAGE_CACHE

    // initialize the plugin by creating a new object
    $GLOBALS['preload-fullpage-cache'] = new PRELOAD_FULLPAGE_CACHE();

} // if class_exists PRELOAD_FULLPAGE_CACHE
