<?php
/*
Plugin Name: WpFeed news
Plugin URI: http://logicsart.com/
Description: Easy and simple setup of Feeds with shortcodes. Display news from given url on the page and post.
Version: 1.0
Author: Dileep Awasthi
Author URI: http://logicsart.com/*/
class WpFeed_news
{
	// -------------------------------------------------------------------------
	// Define constant variables and data arrays
	// -------------------------------------------------------------------------
	var $plugin_options = 'feednews_options';

	public function __construct() {

		// Define the domain for translations

		$this->init_hooks();

	}



	/**
	* Initializes the hooks for the plugin
	*
	* @return	Nothing
	*/

	function init_hooks() 
	{
		add_action('admin_menu', array(&$this,'wp_admin'));
		add_shortcode('wpfeed-news', array(&$this,'wpfeed_news'));
		add_action( 'wp_head', array($this, 'add_css'), 999 );
	}
	
	function add_css()
	{
		echo '<style>.wpFeedNews{margin:0;padding:0;list-style:none;}</style>';	
	}
	/**
	* Create and register shortcode
	*
	*/

	function wpfeed_news($atts) 
	{
		$x = extract(shortcode_atts(array(
			'url' => '',
		), $atts));
		return $this->generate_html($url);
	}

	

	/**
	* Generate the Form
	*
	*/

	function generate_html($url) {
		$feed_options = get_option($this->plugin_options);
		$newurl = (!$newurl) ? $feed_options[$url] : $newurl;
		$data = $this->getFeed($newurl);
		return $data;
		}
	
	function getFeed($feed_url) 
	{
		$content = file_get_contents($feed_url);
		$x = new SimpleXmlElement($content);
		$data = "<ul class='wpFeedNews'>";
		foreach($x->channel->item as $entry) 
		{
			$data .= "<li><a href='$entry->link' target='_blank' title='$entry->title'>" . $entry->title . "</a><div style='min-height:127px;'>".$entry->description."</div></li>";
		}
		$data .= "</ul>";
		return $data;
	}

	/**
	* The Admin Page and all it's functions
	*
	*/

	function wp_admin()	
	{
		if (function_exists('add_options_page'))
			add_options_page( 'Feed News', 'Wp Feed News', 'administrator', basename(__FILE__), array(&$this, 'options_page') );
	}



	function admin_message($message) 
	{
		if ( $message ) 
		{
			echo '<div class="updated"><p><strong>'.$message.'</strong></p></div>';
		}

	}
	
	function options_page() 
	{
		if (isset($_POST['Submit'])) 
		{
			$feed_options['url1'] = trim( $_POST['url1'] );
			$feed_options['url2'] = trim( $_POST['url2'] );
			$feed_options['url3'] = trim( $_POST['url3'] );
			$feed_options['url4'] = trim( $_POST['url4'] );
			$feed_options['url5'] = trim( $_POST['url5'] );
			
			update_option($this->plugin_options, $feed_options);
			$this->admin_message( __( 'urls settings have been updated.', 'wpfeed-news' ) );
		}

		// Render the settings screen

		$settings = new WpFeed_form();
		$settings->set_options( get_option($this->plugin_options));
		$settings->render();
	}

}
// -----------------------------------------------------------------------------
// Start the plugin
// -----------------------------------------------------------------------------
// Load external classes

	if (is_admin()) 
	{
		require plugin_dir_path(__FILE__).'feedform.php';
	}

add_action('plugins_loaded', create_function('','global $wpFeed; $wpFeed = new WpFeed_news();'));


// -----------------------------------------------------------------------------
// Helper functions
// -----------------------------------------------------------------------------
# esc_attr isn't available in WordPress < 2.8.

if (!function_exists('esc_attr')) :
function esc_attr($arg) 
{
	return attribute_escape($arg);
}
endif;
?>