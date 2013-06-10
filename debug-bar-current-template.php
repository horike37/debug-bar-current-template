<?php
/*
  Plugin Name: Debug Bar Current Template
  Plugin URI: http://kakunin-pl.us/
  Description: Show the current template file name in the debug bar.
  Author: horike takahiro
  Version: 0.1.5
  Author URI: http://kakunin-pl.us/
  Text Domain: debug-bar-current-template
  Domain Path: /languages/

  License:
  Released under the GPL license
  http://www.gnu.org/copyleft/gpl.html

  Copyright 2013 (email : horike37@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

add_filter( 'debug_bar_panels', 'debug_bar_current_templete_panel' );
if ( ! function_exists( 'debug_bar_current_templete_panel' ) ) {
    function debug_bar_current_templete_panel( $panels ) {
    	require_once( 'class-debug-bar-current-templete.php' );
        $panels[] = new Debug_Bar_Template_File_Name();
        return $panels;
    }
}
