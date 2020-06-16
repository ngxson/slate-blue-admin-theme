<?php

/*
Plugin Name: Slate Blue Admin Theme
Plugin URI: https://ngxson.com/
Description: A clean, simplified WordPress Admin theme
Author: ngxson
Version: 1.0.0
Author URI: https://ngxson.com/
*/

function slate_files() {
  wp_enqueue_style( 'slate-admin-theme', plugins_url('css/slate.css', __FILE__), array(), '1.2.10' );
  wp_enqueue_script( 'slate', plugins_url( 'js/slate.js', __FILE__ ), array( 'jquery' ), '1.2.10' );
}
add_action( 'admin_enqueue_scripts', 'slate_files' );

function slate_add_editor_styles() {
  add_editor_style( plugins_url('css/editor-style.css', __FILE__ ) );
}
add_action( 'after_setup_theme', 'slate_add_editor_styles' );

function slate_colors() {
	include( 'css/dynamic.php' );
	$site_icon = get_site_icon_url();
	$site_icon = ( $site_icon === '' || is_network_admin() )
		? site_url( '/wp-admin/images/w-logo-white.png' ) : $site_icon;
	?>
		<style>
			.edit-post-fullscreen-mode-close.has-icon,
			.edit-post-fullscreen-mode-close.has-icon:hover,
			.menu-icon-dashboard div.wp-menu-image.dashicons-myhome {
				background-image: url('<?php echo esc_html($site_icon); ?>') !important;
				background-size: contain;
				float: left !important;
				background-repeat: no-repeat;
  			background-position: center;
				background: center / contain no-repeat url('<?php echo esc_html($site_icon); ?>') !important;
			}
			.menu-top-first.menu-icon-dashboard > .wp-menu-name {
				font-weight: normal !important;
				color: white !important;
				height: 1em;
  			overflow: hidden;
  			padding-top: 4px !important;
  			padding-left: 0 !important;
  			line-height: 1.6em;
			}
			a.menu-top-first.menu-icon-dashboard,
			li.menu-top-first.menu-icon-dashboard {
			  margin-top: 20px !important;
				margin-bottom: 12px !important;
			}

			.edit-post-fullscreen-mode-close > svg {
				display: none;
			}

			.menu-icon-dashboard div.wp-menu-image.dashicons-before.dashicons-myhome {
				border-radius: 500px;
				width: 36px !important;
  			height: 36px !important;
			}
		</style>
	<?php
}

add_action( 'admin_head', 'slate_colors' );

function slate_get_user_admin_color() {
	$user_id = get_current_user_id();
	$user_info = get_userdata($user_id);
	if ( !( $user_info instanceof WP_User ) ) {
		return;
	}
	$user_admin_color = $user_info->admin_color;
	return $user_admin_color;
}

// page name admin menu
add_action('admin_menu', function () {
  global $menu;
  $menu[2][0] = get_bloginfo('name');
  $menu[2][6] = 'dashicons-myhome';
});

add_action('network_admin_menu', function () {
  global $menu;
  $menu[2][0] = 'Network Admin';
  $menu[2][6] = 'dashicons-myhome';
});

?>
