<?php

	$sunrise_file = __FILE__;

	// Check that class doesn't exists
	if ( !class_exists( 'Sunrise_Plugin_Framework' ) ) {

		/**
		 * Sunrise Plugin Framework Class
		 *
		 * @author Vladimir Anokhin <ano.vladimir@gmail.com>
		 * @link http://gndev.info/sunrise/
		 * @version 1.3.0
		 */
		class Sunrise_Plugin_Framework {

			/** @var string Plugin Framework version */
			var $sunrise_version = '1.3.0';

			/** @var string Plugin URL - plugin page (from meta description) */
			var $plugin_url;

			/** @var string Plugin version */
			var $version;

			/** @var string Plugin textdomain */
			var $textdomain;

			/** @var string Short plugin slug */
			var $slug;

			/** @var string Full plugin name */
			var $name;

			/** @var string Plugin URL - http://example.com/wp-content/plugins/plugin-slug */
			var $url;

			/** @var string Plugin control panel URL */
			var $admin_url;

			/** @var string Plugin option name. This option contains all plugin settings */
			var $option;

			/** @var string Plugin menu location. Default is submenu of 'options-general.php' */
			var $settings_parent;

			/** @var string Plugin settings title */
			var $settings_page_title;

			/** @var string Plugin settings menu label */
			var $settings_menu_title;

			/** @var string Required capability to access plugin page */
			var $settings_capability;

			/** @var string Create settings link at plugins dashboard or not */
			var $settings_link;

			/** @var string Relative path to includes directory */
			var $includes;

			/** @var string Relative path to assets directory */
			var $assets_dir;

			/**
			 * Constructor
			 *
			 * @param string $inc Relative path to includes directory. Default: 'inc/sunrise'
			 * @param string $assets Relative path to assets directory. Default: 'assets'
			 */
			function __construct( $inc = 'inc/sunrise', $assets = 'assets' ) {

				global $sunrise_file;

				// Get plugin slug
				$this->slug = array_shift( array_values( explode( '/', plugin_basename( $sunrise_file ) ) ) );

				// Check that function get_plugins exists
				if ( !function_exists( 'get_plugins' ) )
					require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

				// Get plugin meta
				$meta = get_plugins( '/' . $this->slug );

				// Initialize plugin data
				$this->plugin_url = $meta[$this->slug . '.php']['PluginURI'];
				$this->version = $meta[$this->slug . '.php']['Version'];
				$this->textdomain = $this->slug;
				$this->name = $meta[$this->slug . '.php']['Name'];
				$this->url = path_join( plugins_url(), $this->slug );
				$this->option = str_replace( '-', '_', $this->slug ) . '_options';
				$this->includes = implode( '/', array( WP_PLUGIN_DIR, $this->slug, trim( $inc, '/' ) ) );
				$this->assets_dir = trim( $assets, '/' );

				// Make plugin available for translation
				load_plugin_textdomain( $this->textdomain, false, $this->slug . '/languages/' );
				// Enqueue assets
				add_action( 'init', array( &$this, 'enqueue_assets' ) );
				// Insert default settings if it's doesn't exists
				add_action( 'admin_init', array( &$this, 'default_settings' ) );
				// Manage options
				add_action( 'admin_menu', array( &$this, 'manage_options' ) );
			}

			/**
			 * Conditional tag to check there is settings page
			 */
			function is_settings() {
				global $pagenow;
				return is_admin() && $pagenow == $this->settings_parent && $_GET['page'] == $this->slug;
			}

			/**
			 * Enqueue assets
			 */
			function enqueue_assets() {
				// Enqueue admin page assets
				if ( $this->is_settings() && $this->settings_parent ) {
					wp_enqueue_style( 'thickbox' );
					wp_enqueue_style( 'farbtastic' );
					wp_enqueue_style( 'sunrise-plugin-framework', $this->assets( 'css', 'sunrise.css' ), false, $this->version, 'all' );
					wp_enqueue_script( 'jquery' );
					wp_enqueue_script( 'media-upload' );
					wp_enqueue_script( 'thickbox' );
					wp_enqueue_script( 'farbtastic' );
					wp_enqueue_script( 'sunrise-plugin-framework-form', $this->assets( 'js', 'form.js' ), array( 'jquery' ), $this->version, false );
					wp_enqueue_script( 'sunrise-plugin-framework', $this->assets( 'js', 'sunrise.js' ), array( 'sunrise-plugin-framework-form' ), $this->version, false );
				}
				// Assets file path
				$assets_file = $this->includes . '/assets.php';
				// Check that file exists and include it
				if ( file_exists( $assets_file ) )
					require_once $assets_file;
			}

			/**
			 * Helper function to get assets url by type
			 */
			function assets( $type = 'css', $file = 'sunrise.css' ) {
				return implode( '/', array(
						trim( $this->url, '/' ),
						trim( $this->assets_dir, '/' ),
						trim( $type, '/' ),
						trim( $file, '/' )
					) );
			}

			/**
			 * Set plugin settings to default
			 */
			function default_settings( $manual = false ) {
				// Settings page is created
				if ( $this->settings_parent ) {
					if ( $manual || !get_option( $this->option ) ) {
						// Create array with default options
						$defaults = array( );
						// Loop through available options
						foreach ( $this->get_options() as $value ) {
							$defaults[$value['id']] = $value['std'];
						}
						// Insert default options
						update_option( $this->option, $defaults );
					}
				}
			}

			/**
			 * Get plugin options
			 *
			 * @return mixed $options Returns options from options.php or false if file doesn't exists
			 */
			function get_options() {
				// Prepare vars
				$options = array( );
				// Check that file exists and include it
				$options_file = $this->includes . '/options.php';
				if ( file_exists( $options_file ) )
					require $options_file;
				// Return options if it's set
				return ( isset( $options ) ) ? $options : false;
			}

			/**
			 * Get single option value
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
			 * @return mixed $option Returns option by specified key
			 */
			function update_option( $key = false, $value = false ) {
				// Prepare variables
				$settings = get_option( $this->option );
				$new_settings = array( );
				// Prepare data
				foreach ( $settings as $id => $val )
					$new_settings[$id] = ( $id == $key ) ? $value : $val;
				// Update option and return operation result
				return update_option( $this->option, $new_settings );
			}

			/**
			 * Save/reset options
			 */
			function manage_options() {
				// Check this is settings page
				if ( !$this->is_settings() )
					return;
				// ACTION: SAVE
				if ( $_POST['action'] == 'save' ) {
					// Prepare vars
					$options = $this->get_options();
					$new_options = array( );
					// Prepare data
					foreach ( $options as $value )
						$new_options[$value['id']] = ( is_array( $_POST[$value['id']] ) ) ? $_POST[$value['id']] : htmlspecialchars( $_POST[$value['id']] );
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
				// ACTION: RESET
				elseif ( $_GET['action'] == 'reset' ) {
					// Prepare variables
					$options = $this->get_options();
					$new_options = array( );
					// Prepare data
					foreach ( $options as $value ) {
						$new_options[$value['id']] = $value['std'];
					}
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
			}

			/**
			 * Register settings page
			 *
			 * @param mixed $options Settings page params
			 */
			function add_settings_page( $options ) {
				// Settings page parent
				$this->settings_parent = ( isset( $options['parent'] ) ) ? $options['parent'] : 'options-general.php';
				// Settings page title
				$this->settings_page_title = ( isset( $options['page_title'] ) ) ? $options['page_title'] : $this->name;
				// Settings page menu name
				$this->settings_menu_title = ( isset( $options['menu_title'] ) ) ? $options['menu_title'] : $this->name;
				// Settings page capability
				$this->settings_capability = ( isset( $options['capability'] ) ) ? $options['capability'] : 'manage_options';
				// Settings link in plugins dashboard
				$this->settings_link = ( $options['settings_link'] ) ? true : false;
				// Redefine admin url
				$this->admin_url = admin_url( $this->settings_parent . '?page=' . $this->slug );
				// Add settings page
				add_action( 'admin_menu', array( &$this, 'settings_page' ) );
				// Add settings link to plugins dashboard
				if ( $this->settings_link )
					add_filter( 'plugin_action_links_' . $this->slug . '/' . $this->slug . '.php', array( &$this, 'add_settings_link' ) );
			}

			/**
			 * Register settings page
			 */
			function settings_page() {
				add_submenu_page( $this->settings_parent, __( $this->settings_page_title, $this->textdomain ), __( $this->settings_menu_title, $this->textdomain ), $this->settings_capability, $this->slug, array( &$this, 'render_settings_page' ) );
			}

			/**
			 * Display settings page
			 */
			function render_settings_page() {
				$backend_file = $this->includes . '/views/settings.php';
				if ( file_exists( $backend_file ) )
					require_once $backend_file;
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
				// Get plugin options
				$options = $this->get_options();
				// Get current settings
				$settings = get_option( $this->option );
				// Options loop
				foreach ( $options as $option ) {
					// Get option file path
					$option_file = $this->includes . '/views/' . $option['type'] . '.php';
					// Check that file exists and include it
					if ( file_exists( $option_file ) )
						include( $option_file );
					else
						trigger_error( 'Option file <strong>' . $option_file . '</strong> not found!', E_USER_NOTICE );
				}
			}

			/**
			 * Display settings tabs
			 */
			function render_tabs() {
				// Tabs
				foreach ( $this->get_options() as $option ) {
					if ( $option['type'] == 'opentab' ) {
						$active = ( isset( $active ) ) ? ' sunrise-plugin-tab-inactive' : ' nav-tab-active sunrise-plugin-tab-active';
						echo '<span class="nav-tab' . $active . '">' . $option['name'] . '</span>';
					}
				}
			}

			/**
			 * Show notifications
			 */
			function notifications( $notifications ) {
				$n_file = $this->includes . '/views/notifications.php';
				if ( file_exists( $n_file ) )
					include $n_file;
			}

		}

	}
?>