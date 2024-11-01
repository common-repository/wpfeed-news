<?php

/**

 * WPFeed Form Settings.

 *

 * Class that renders out the HTML for the settings screen and contains helpful

 * methods to simply the maintainance of the admin screen.

 *

 * @package		WpFeed-News

 * @author		dileep Awasthi

 * @since		Post Snippets 1.5

 */

class WpFeed_form

{
	private $plugin_options;
	public function set_options( $options )

	{

		$this->plugin_options = $options;

	}
	public function render()

	{

?>
<div class=wrap>

    <h2>News Feed Url</h2>



	<form method="post" action="">

	<?php wp_nonce_field('update-options'); ?>

	<?php $feed_options = $this->plugin_options; ?>

    <table class="form-table">

    <tr><td colspan="2">
    <div style="border:1px solid #C60; text-align:center; padding:4px; font-weight:bold;">
    Copy the shortcode given with textbox (e.g. [wpfeed-news url="url1"]) and paste into page or post where you want to display the news
    </div></td></tr>
    <tr valign="top">

    <th scope="row"><label for="Feed URL">Feed URL</label></th>

    <td><input name="url1" type="text" id="url1" value="<?php echo $feed_options['url1']; ?>" class="regular-text" /> Copy -> [wpfeed-news url="url1"]</td>

    </tr>
    <tr valign="top">

    <th scope="row"><label for="Feed URL">Feed URL</label></th>

    <td><input name="url2" type="text" id="url2" value="<?php echo $feed_options['url2']; ?>" class="regular-text" /> Copy -> [wpfeed-news url="url2"]</td>

    </tr>
    <tr valign="top">

    <th scope="row"><label for="Feed URL">Feed URL</label></th>

    <td><input name="url3" type="text" id="url3" value="<?php echo $feed_options['url3']; ?>" class="regular-text" /> Copy -> [wpfeed-news url="url3"]</td>

    </tr>
    <tr valign="top">

    <th scope="row"><label for="Feed URL">Feed URL</label></th>

    <td><input name="url4" type="text" id="url4" value="<?php echo $feed_options['url4']; ?>" class="regular-text" /> Copy -> [wpfeed-news url="url4"]</td>

    </tr>
    <tr valign="top">

    <th scope="row"><label for="Feed URL">Feed URL</label></th>

    <td><input name="url5" type="text" id="url5" value="<?php echo $feed_options['url5']; ?>" class="regular-text" /> Copy -> [wpfeed-news url="url5"]</td>

    </tr>
    
    <tr><td colspan="2">
    
    <input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Changes', 'wpfeed-news' ) ?>" />

    </td></tr></table>

</div>





<?php

	}
}

