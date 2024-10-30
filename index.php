<?php
/**
 * Plugin Name: Bookitme Appointment Scheduler
 * Plugin URI: http://www.bookitme.com/appointment-scheduler/
 * Description: Easy interface to include shortcode for display booking calendar and timeline from bookitme.com
 * Version: 1.2.5
 * Author: Anthony Gate
 * Author URI: http://www.bookitme.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */
// Plugin Directory 
define('BOOKITME_APPOINTMENTS_DIR', dirname(__FILE__));

register_activation_hook(__FILE__,'register_project_template');
register_deactivation_hook(__FILE__,'deregister_project_template');

function register_bookitme_appointments_template() {
    $template_destination =get_template_destination();
    $template_source = get_bookitme_appointments_source();
    copy_page_bookitme_appointments($template_source, $template_destination);
}

function deregister_bookitme_appointments_template() {
    $theme_dir = get_template_directory();
    $template_path = $theme_dir . '/page-bookitme.php';
    if (file_exists($template_path)) {
        unlink($template_path);
    }
}

function get_bookitme_appointments_destination() {
    return get_template_directory() . '/page-bookitme.php';
}

function get_bookitme_appointments_source() {
    return dirname(__FILE__) . '/lib/templates/page-bookitme.php';
}

function copy_page_bookitme_appointments($template_source, $template_destination) {
    if (!file_exists($template_destination)) {
        touch($template_destination);
        if (null != ( $template_handle = @fopen($template_source, 'r') )) {
            if (null != ( $template_content = fread($template_handle, filesize($template_source)) )) {
                fclose($template_handle);
            }
        }
        if (null != ( $template_handle = @fopen($template_destination, 'r+') )) {
            if (null != fwrite($template_handle, $template_content, strlen($template_content))) {
                fclose($template_handle);
            }
        }
    }
}

//Admin Option
include_once( BOOKITME_APPOINTMENTS_DIR . '/lib/functions/admin1.php' );
// Shortcodes
include_once( BOOKITME_APPOINTMENTS_DIR . '/lib/functions/shortcodes.php' );
?>
