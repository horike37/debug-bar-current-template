<?php
load_plugin_textdomain( Debug_Bar_Template_File_Name::TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
class Debug_Bar_Template_File_Name extends Debug_Bar_Panel {
	const TEXT_DOMAIN = 'debug-bar-current-template';

	public function init() {
		$this->title( __( 'Current Templete', self::TEXT_DOMAIN ) );
	}

	public function prerender() {
		$this->set_visible( true );
	}

	public function render() {

		global $template;

		$template_file_name		 = basename( $template );
		$template_relative_path	 = str_replace( ABSPATH . 'wp-content/', '', $template );

		$current_theme		 = wp_get_theme();
		$current_theme_name	 = $current_theme->Name;
		$parent_theme_name	 = '';

		if ( is_child_theme() ) {
			$child_theme_name	 = '<h3>' . __( 'Theme name: ', self::TEXT_DOMAIN ) . '</h3>' . $current_theme_name;
			$parent_theme_name	 = $current_theme->parent()->Name;
			$parent_theme_name	 = ' (' . $parent_theme_name . __( "'s child", self::TEXT_DOMAIN ) . ")";
			$parent_or_child	 = $child_theme_name . $parent_theme_name;
		} else {
			$parent_or_child = '<h3>' .__( 'Theme name: ', self::TEXT_DOMAIN ) . '</h3>' . $current_theme_name . ' (' . __( 'NOT a child theme', self::TEXT_DOMAIN ) . ')';
		}

		$included_files = get_included_files();

		sort( $included_files );
		$included_files_list = '';
		foreach ( $included_files as $filename ) {
			if ( strstr( $filename, 'themes' ) ) {
				$filepath = strstr( $filename, 'themes' );
				if ( $template_relative_path == $filepath ) {
					$included_files_list .= '';
				} else {
					$included_files_list .= "$filepath <br />\n";
				}
			}
		}
?>
<div id="debug-bar-current-templete">
<h3><?php _e( 'Template:', self::TEXT_DOMAIN ); ?></h3><p><span class="show-template-name"> <?php echo $template_file_name; ?></span></p>
<h3><?php _e( 'Template relative path:', self::TEXT_DOMAIN ); ?></h3><p><span class="show-template-name"> <?php echo $template_relative_path; ?></span></p>
<?php echo $parent_or_child; ?>
<h3><?php _e( 'Also, below template files are included:', self::TEXT_DOMAIN ); ?></h3><div id="included-files-list"><?php echo $included_files_list; ?></div>
</div>
<?php
	}

}