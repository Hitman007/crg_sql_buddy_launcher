<?php
/*
Plugin Name: SQL Buddy Launcher
Plugin URI: http://customrayguns.com/plugin-sql-buddy4wordpress/
Description: Access the database directly with SQL Buddy from the Wordpress dashboard.
Version: 1.0
Author: Custom Ray Guns
Author URI: http://customrayguns.com
License: GPL2
*/

function PluginUrl() {

        //Try to use WP API if possible, introduced in WP 2.6
        if (function_exists('plugins_url')) return trailingslashit(plugins_url(basename(dirname(__FILE__))));

        //Try to find manually... can't work if wp-content was renamed or is redirected
        $path = dirname(__FILE__);
        $path = str_replace("\\","/",$path);
        $path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
        return $path;
    }

// Launches SQL Buddy and passess db credentials via session
function crg_sqlbuddy_launch(){
	$sql_buddy_login_location = PluginUrl() . "calvinlough-sqlbuddy/login.php";
	$martian_location = PluginUrl() . "martian.jpg";
	session_start();
	$_SESSION['crg_host'] = DB_HOST;
	$_SESSION['crg_user'] = DB_USER;
	$_SESSION['crg_password'] = DB_PASSWORD;
	$_SESSION['crg_name'] = DB_NAME;
	$a = DB_HOST;
	$b = DB_USER;
	$c = DB_PASSWORD;
	$d = DB_NAME;
	echo ("<br /><br />
	<h2>SQL Buddy Launcher</h2>
	<table>
	<tr><td><img src = \"" . $martian_location . "\" height = \"200px\" align = MIDDLE></td>
	<td>
	<form action = \"" . $sql_buddy_login_location . "\" target = \"_BLANK\" method = \"POST\">
	<input type = \"submit\" value = \"Launch SQL Buddy\" /> <span style = \"font-size:.8em;\">(Be patient! It may take a few seconds to launch.)</span>
	<input type = \"hidden\" value = \"" . $a . "\" name = \"HOST\" id = \"HOST\" />
	<input type = \"hidden\" value = \"" . $b . "\" name = \"USER\" id = \"USER\" />
	<input type = \"hidden\" value = \"" . $c . "\" name = \"PASS\" id = \"PASS\" />
	<input type = \"hidden\" value = \"" . $d . "\" name = \"DATABASE\" id = \"DATABASE\" />
	
	
	</form><br />
	Wordpress plugin by <a href = \"http://customrayguns.com/plugin-sql-buddy4wordpress\">CustomRayGuns.com</a><br />
	SQL Buddy by <a href = \"http://sqlbuddy.com\">Calvin Lough</a>.</td></tr></table>");
}

// Hook for adding admin menus
add_action('admin_menu', 'crg_add_pages');

// action function for above hook
function crg_add_pages() {
// Add a new top-level menu
	add_menu_page(__('SQL Buddy','menu-test'), __('SQL Buddy','menu-test'), 'manage_options', 'mt-top-level-handle', 'crg_sqlbuddy_launch' );
}

x
?>
