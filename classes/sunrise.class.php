<?php

	// Check that class doesn't exists
	if ( !class_exists( 'Sunrise_Plugin_Framework_2' ) ) {

		/**
		 * Sunrise Plugin Framework Class
		 *
		 * @author  Vladimir Anokhin <ano.vladimir@gmail.com>
		 * @link    http://gndev.info/sunrise/
		 */
		class Sunrise_Plugin_Framework_2 {

			/** @var string Plugin meta */
			var $meta;

			/** @var string Plugin base name */
			var $basename;

			/** @var string Short plugin slug */
			var $slug;

			/** @var string Plugin version */
			var $version;

			/** @var string Plugin textdomain */
			var $textdomain;

			/** @var string Full plugin name */
			var $name;

			/** @var string Plugin directory URL - http://example.com/wp-content/plugins/plugin-slug */
			var $url;

			/** @var string Relative path to includes directory */
			var $includes;

			/** @var string Relative path to views directory */
			var $views;

			/** @var string Relative path to assets directory */
			var $assets;

			/** @var string Plugin control panel URL */
			var $admin_url;

			/** @var string Plugin option name. This option contains all plugin settings */
			var $option;

			/** @var array Set of fields for options page */
			var $options;

			/** @var string Options page config */
			var $settings;

			/**
			 * Constructor
			 *
			 * @param        $file
			 * @param array  $args
			 */
			function __construct( $file, $args = array() ) {
				// Default args
				$defaults = array( 'includes' => 'inc', 'views' => 'inc/views', 'assets' => 'assets' );
				// Prepare initial data
				$this->file = $file;
				$this->args = wp_parse_args( $args, $defaults );
				// Check that function get_plugin_data exists
				if ( !function_exists( 'get_plugin_data' ) )
					require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				// Read plugin meta
				$this->meta = get_plugin_data( $this->file, false );
				// Init plugin data
				$this->basename = plugin_basename( $this->file );
				$this->slug = sanitize_key( $this->meta['Name'] );
				$this->version = sanitize_text_field( $this->meta['Version'] );
				$this->textdomain = sanitize_html_class( $this->meta['TextDomain'] );
				$this->name = $this->meta['Name'];
				$this->url = plugins_url( '', $this->file );
				$this->option = $this->slug . '_options';
				$this->includes = trailingslashit( path_join( plugin_dir_path( $this->file ), trim( $this->args['includes'], '/' ) ) );
				$this->views = trailingslashit( path_join( plugin_dir_path( $this->file ), trim( $this->args['views'], '/' ) ) );
				$this->assets = trim( $this->args['assets'], '/' );
				// Make plugin available for translation
				load_plugin_textdomain( $this->textdomain, false, trailingslashit( path_join( dirname( $this->basename ), trim( $this->meta['DomainPath'], '/' ) ) ) );
			}

			function debug() {
				die( '<pre>' . print_r( $this, true ) . '</pre>' );
			}

			/**
			 * Conditional tag to check there is settings page
			 */
			function is_settings() {
				global $pagenow;
				return is_admin() && $pagenow == $this->settings['parent'] && $_GET['page'] == $this->slug;
			}

			/**
			 * Register assets
			 */
			function register_assets() {
				wp_register_style( 'sunrise-plugin-framework', $this->assets( 'css', 'sunrise.css' ), false, $this->version, 'all' );
				wp_register_script( 'sunrise-plugin-framework-form', $this->assets( 'js', 'form.js' ), array( 'jquery' ), $this->version, false );
				wp_register_script( 'sunrise-plugin-framework', $this->assets( 'js', 'sunrise.js' ), array( 'sunrise-plugin-framework-form' ), $this->version, false );
			}

			/**
			 * Enqueue assets
			 */
			function enqueue_assets() {
				if ( !$this->is_settings() ) return;
				foreach ( array( 'thickbox', 'farbtastic', 'sunrise-plugin-framework' ) as $style ) {
					wp_enqueue_style( $style );
				}
				foreach ( array( 'jquery', 'media-upload', 'thickbox', 'farbtastic', 'sunrise-plugin-framework-form',
				                 'sunrise-plugin-framework' ) as $script ) {
					wp_enqueue_script( $script );
				}
			}

			/**
			 * Helper function to get assets url by type
			 */
			function assets( $type = 'css', $file = 'sunrise.css' ) {
				return implode( '/', array_filter( array( trim( $this->url, '/' ), trim( $this->assets, '/' ),
				                                          trim( $type, '/' ), trim( $file, '/' ) ) ) );
			}

			/**
			 * Set plugin settings to default
			 */
			function default_settings( $manual = false ) {
				// Settings page is created
				if ( $manual || !get_option( $this->option ) ) {
					// Create array with default options
					$defaults = array();
					// Loop through available options
					foreach ( (array) $this->options as $value ) $defaults[$value['id']] = $value['std'];
					// Insert default options
					update_option( $this->option, $defaults );
				}
			}

			/**
			 * Get single option value
			 *
			 * @param mixed $option Option ID to return. If false, all options will be returned
			 *
			 * @return mixed $option Returns option by specified key
			 */
			function get_option( $option = false ) {
				// Get options from database
				$options = get_option( $this->option );
				// Check option is specified
				$value = ( $option ) ? $options[$option] : $options;
				// Return result
				return ( is_array( $value ) ) ? array_filter( $value, 'esc_attr' ) : esc_attr( stripslashes( $value ) );
			}

			/**
			 * Update single option value
			 *
			 * @param mixed $key   Option ID to update
			 * @param mixed $value New value
			 *
			 * @return mixed $option Returns option by specified key
			 */
			function update_option( $key = false, $value = false ) {
				// Prepare variables
				$settings = get_option( $this->option );
				$new_settings = array();
				// Prepare data
				foreach ( $settings as $id => $val ) $new_settings[$id] = ( $id == $key ) ? $value : $val;
				// Update option and return operation result
				return update_option( $this->option, $new_settings );
			}

			/**
			 * Action to save/reset options
			 */
			function manage_options() {
				// Check this is settings page
				if ( !$this->is_settings() ) return;
				// ACTION: RESET
				if ( $_GET['action'] == 'reset' ) {
					// Prepare variables
					$new_options = array();
					// Prepare data
					foreach ( $this->options as $value ) $new_options[$value['id']] = $value['std'];
					// Save new options
					if ( update_option( $this->option, $new_options ) ) {
						// Redirect
						wp_redirect( $this->admin_url . '&message=1' );
						exit;
					}
					// Option doesn't updated
					else {
						// Redirect
						wp_redirect( $this->admin_url . '&message=2' );
						exit;
					}
				}
				// ACTION: SAVE
				elseif ( $_POST['action'] == 'save' ) {
					// Prepare vars
					$new_options = array();
					// Prepare data
					foreach ( $this->options as $value ) {
						$new_options[$value['id']] = ( is_array( $_POST[$value['id']] ) ) ? $_POST[$value['id']]
							: htmlspecialchars( $_POST[$value['id']] );
					}
					// Save new options
					if ( update_option( $this->option, $new_options ) ) {
						// Redirect
						wp_redirect( $this->admin_url . '&message=3' );
						exit;
					}
					// Options not saved
					else {
						// Redirect
						wp_redirect( $this->admin_url . '&message=4' );
						exit;
					}
				}
			}

			/**
			 * Register options page
			 *
			 * @param array $args    Options page config
			 * @param array $options Set of fields for options page
			 */
			function add_options_page( $args, $options = array() ) {
				// Save options
				$this->options = $options;
				// Prepare defaults
				$defaults = array( 'parent' => 'options-general.php', 'menu_title' => $this->name,
				                   'page_title' => $this->name, 'capability' => 'manage_options', 'link' => true );
				// Parse args
				$this->settings = wp_parse_args( $args, $defaults );
				// Define admin url
				$this->admin_url = admin_url( $this->settings['parent'] . '?page=' . $this->slug );
				// Register and enqueue assets
				add_action( 'admin_head', array( &$this, 'register_assets' ) );
				add_action( 'admin_footer', array( &$this, 'enqueue_assets' ) );
				// Insert default settings if it's doesn't exists
				add_action( 'admin_init', array( &$this, 'default_settings' ) );
				// Manage options
				add_action( 'admin_menu', array( &$this, 'manage_options' ) );
				// Add settings page
				add_action( 'admin_menu', array( &$this, 'options_page' ) );
				// Add settings link to plugins dashboard
				if ( $this->settings['link'] ) add_filter( 'plugin_action_links_' . $this->basename, array( &$this,
				                                                                                            'add_settings_link' ) );
			}

			/**
			 * Register settings page
			 */
			function options_page() {
				add_submenu_page( $this->settings['parent'], __( $this->settings['page_title'], $this->textdomain ), __( $this->settings['menu_title'], $this->textdomain ), $this->settings['capability'], $this->slug, array( &$this,
				                                                                                                                                                                                                                'render_options_page' ) );
			}

			/**
			 * Display settings page
			 */
			function render_options_page() {
				$backend_file = $this->views . 'settings.php';
				if ( file_exists( $backend_file ) ) require_once $backend_file;
			}

			/**
			 * Add settings link to plugins dashboard
			 */
			function add_settings_link( $links ) {
				$links[] = '<a href="' . $this->admin_url . '">' . __( 'Settings', $this->textdomain ) . '</a>';
				return $links;
			}

			/**
			 * Display settings panes
			 */
			function render_panes() {
				// Get current settings
				$settings = get_option( $this->option );
				// Options loop
				foreach ( $this->options as $option ) {
					// Get option file path
					$option_file = $this->views . $option['type'] . '.php';
					// Check that file exists and include it
					if ( file_exists( $option_file ) ) include( $option_file );
					else
						trigger_error( 'Option file <strong>' . $option_file . '</strong> not found!', E_USER_NOTICE );
				}
			}

			/**
			 * Display settings tabs
			 */
			function render_tabs() {
				foreach ( $this->options as $option ) {
					if ( $option['type'] == 'opentab' ) {
						$active = ( isset( $active ) ) ? ' sunrise-plugin-tab-inactive'
							: ' nav-tab-active sunrise-plugin-tab-active';
						echo '<span class="nav-tab' . $active . '">' . $option['name'] . '</span>';
					}
				}
			}

			/**
			 * Show notifications
			 */
			function notifications( $notifications ) {
				$file = $this->views . 'notifications.php';
				if ( file_exists( $file ) ) include $file;
			}

		}

	}
?>