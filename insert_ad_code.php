<?php
/**
 * Plugin Name: Insert Ad Code
 * Plugin URI: http://jamessocol.com/projects/insert_ad_code.php
 * Description: Automatically inserts ad code (ie: from Openads, AdSense, etc) into posts.
 * Version: 1.2.0
 * Author: James Socol
 * Author URI: http://jamessocol.com/
 * 
 * Translations:
 * 	nl_NL: Jeroen Heymans <jeroen.heymans@live.be>
 */

/** Copyright 2009  James Socol  (email : me@jamessocol.com)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

$js_insert_ad_code_version = '1.2.0';
$js_insert_ad_code_textdomain = 'js_insert_ad_code';

// Add the page to the options menu
function js_insert_ad_code_admin_menu() {
	global $js_insert_ad_code_textdomain;
	add_options_page(__('Insert Ad Code Manager', $js_insert_ad_code_textdomain), __('Insert Ad Code', $js_insert_ad_code_textdomain), 'manage_options', __FILE__, 'js_insert_ad_code_admin_page');

	// WPMU 2.7
	if ( function_exists('register_setting') ) {
		register_setting('js_insert_ad_code_options','js_insert_ad_code_enable');
		register_setting('js_insert_ad_code_options','js_insert_ad_code_type');
		register_setting('js_insert_ad_code_options','js_insert_ad_code_custom_tag');
		register_setting('js_insert_ad_code_options','js_insert_ad_code_html');
	}
}

/**
 * The Admin page
 */
function js_insert_ad_code_admin_page() {
	global $js_insert_ad_code_version, $js_insert_ad_code_textdomain;
	$optionvars = array(
		'js_insert_ad_code_enable',
		'js_insert_ad_code_type',
		'js_insert_ad_code_custom_tag',
		'js_insert_ad_code_html');
?>
<div class="wrap">
	<h2><?php _e('Insert Ad Code Manager', $js_insert_ad_code_textdomain); ?></h2>
	<p><strong><?php _e('Insert Ad Code', $js_insert_ad_code_textdomain); ?></strong> <?php _e('helps turn your blog into a money-maker by automatically inserting ads&mdash;or any other HTML&mdash;into your posts.', $js_insert_ad_code_textdomain); ?></p>
	<p><strong><?php _e('Insert Ad Code', $js_insert_ad_code_textdomain); ?></strong> <?php _e('is meant to be used with a program like <a href="http://google.com/adsense/" title="Google AdSense" target="_blank">Google AdSense</a> or an external script like <a href="http://www.openads.org/" title="Openads Ad Server" target="_blank">Openads</a>', $js_insert_ad_code_textdomain); ?>. <strong><?php _e('Insert Ad Code', $js_insert_ad_code_textdomain); ?></strong> <?php _e('does not rotate ads, nor keep track of impressions, clicks, or conversions. It just inserts code.', $js_insert_ad_code_textdomain); ?></p>
	<form action="options.php" method="post">
		<?php if (function_exists('settings_fields')) { settings_fields('js_insert_ad_code_options'); } else if (function_exists('wp_nonce_field')) { wp_nonce_field('update-options'); ?>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php echo join(',', $optionvars); ?>"/>
	<?php } // if nonce_field ?>
		
		<!-- enable or disable insert ad code -->
		<p><?php _e('Enable'); ?> <strong><?php _e('Insert Ad Code', $js_insert_ad_code_textdomain); ?></strong>?<br />
			<input type="radio" name="js_insert_ad_code_enable" id="js_insert_ad_code_enable_yes" value="1"<?php if (get_option('js_insert_ad_code_enable')==1):?> checked="checked"<?php endif; ?> /> <label for="js_insert_ad_code_enable_yes"><strong><?php _e('Yes', $js_insert_ad_code_textdomain); ?></strong></label> &nbsp;
			<input type="radio" name="js_insert_ad_code_enable" id="js_insert_ad_code_enable_no" value="0"<?php if ( get_option('js_insert_ad_code_enable')!=1):?> checked="checked"<?php endif;?> /> <label for="js_insert_ad_code_enable_no"><strong><?php _e('No', $js_insert_ad_code_textdomain); ?></strong></label></p>
		
		<!-- use 'more' tags or custom tags -->
		<p><?php _e('Should I insert ads after the WordPress', $js_insert_ad_code_textdomain); ?> <strong>&lt;!--more--&gt;</strong> <?php _e('tag, or should I use a custom tag (see below)?', $js_insert_ad_code_textdomain); ?><br />
			<input type="radio" name="js_insert_ad_code_type" id="js_insert_ad_code_type_more" value="more"<?php if (get_option('js_insert_ad_code_type')=='more'):?> checked="checked"<?php endif; ?> /> <label for="js_insert_ad_code_type_more"><strong>&lt;!--more--&gt;</strong></label> &nbsp;
			<input type="radio" name="js_insert_ad_code_type" id="js_insert_ad_code_type_custom" value="custom"<?php if ( get_option('js_insert_ad_code_type')!='more'):?> checked="checked"<?php endif;?> /> <label for="js_insert_ad_code_type_custom"><strong><?php echo htmlspecialchars(get_option('js_insert_ad_code_custom_tag')); ?></strong></label></p>
		
		<!-- define a custom tag -->
		<p><?php _e('If I should look for a custom tag, what should the tag be?', $js_insert_ad_code_textdomain); ?><br />
			<label for="js_insert_ad_code_custom_tag"><strong><?php _e('Custom Tag', $js_insert_ad_code_textdomain); ?></strong></label> <input type="text" name="js_insert_ad_code_custom_tag" id="js_insert_ad_code_custom_tag" value="<?php echo get_option('js_insert_ad_code_custom_tag'); ?>" style="width: 50%" /> 
			<small>(<a href="javascript:;" onclick="document.getElementById('js_insert_ad_code_custom_tag').value='&lt;!--insert ads--&gt;';"><?php _e('default'); ?></a>)</small></p>
		
		<!-- finally, what should the code be? -->
		<p><label for="js_insert_ad_code_html"><?php _e('What code should I insert?', $js_insert_ad_code_textdomain); ?></label><br />
			<textarea name="js_insert_ad_code_html" id="js_insert_ad_code_html" style="width: 90%; height: 300px" wrap="virtual"><?php echo get_option('js_insert_ad_code_html'); ?></textarea></p>
		
		<!-- submit the form -->
		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" />
		</p>
    </form>
	<p><strong><a href="http://jamessocol.com/projects/insert_ad_code.php" title="<?php _e('Insert Ad Code', $js_insert_ad_code_textdomain); ?>"><?php _e('Insert Ad Code', $js_insert_ad_code_textdomain); ?> <?php echo $js_insert_ad_code_version; ?></strong></a> <?php _e('by', $js_insert_ad_code_textdomain); ?> <a href="http://jamessocol.com">James Socol</a>.</p>
</div>
<?php
}

/**
 * The filter to insert the ads
 */
function js_insert_ad_code_filter( $content ) {
	global $id;

	// make sure the plugin is enabled
	if ( get_option('js_insert_ad_code_enable')!='1' ) {
		return $content;
	}

	// we're only gonna do this on single posts, for now
	if ( !is_single() ) {
		return $content;
	}

	// now we need to get a couple settings
	
	// first, get the code to insert
	$html = get_option('js_insert_ad_code_html');
	
	// if the switch is set to use the <!--more--> tag, set the 
	// tag to <!--more-->, otherwise, use the custom tag
	if ( get_option('js_insert_ad_code_type') == 'more' ) {
		// wordpress <2.3 uses an 'a' tag here. >2.3 uses a span tag. this should
		// work with either.
		return preg_replace("#\<(a|span) id\=\"more-$id\"\>\</\\1\>#", $html."$0", $content, 1);
	} else {
		$tag = get_option('js_insert_ad_code_custom_tag');
		return preg_replace('#'.preg_quote($tag, '#').'#', $html, $content, 1);
	}
	
	// just in case...
	return $content;
}

/**
 * Activation Hook to add settings
 */
function js_insert_ad_code_activate () {
	// Add the options
	add_option('js_insert_ad_code_enable', 0, 'Activate or Deactivate Insert Ad Code', 'yes');
	add_option('js_insert_ad_code_type', 'more', 'Whether Insert Ad Code uses the "more" tag or a custom tag', 'yes');
	add_option('js_insert_ad_code_custom_tag', '<!--insert ads-->', 'A custom tag to trigger ad inserts from Insert Ad Code.', 'yes');
	add_option('js_insert_ad_code_html', '', 'HTML for Insert Ad Code to insert.', 'yes');
}

/**
 * Deactivation Hook to remove settings
 */
function js_insert_ad_code_deactivate () {
	// Remove the options
	delete_option('js_insert_ad_code_enable');
	delete_option('js_insert_ad_code_type');
	delete_option('js_insert_ad_code_custom_tag');
	delete_option('js_insert_ad_code_html');
}

// Register everything
load_plugin_textdomain($js_insert_ad_code_textdomain, 'wp-content/plugins/insert_ad_code');
register_activation_hook(__FILE__, 'js_insert_ad_code_activate');
register_deactivation_hook(__FILE__, 'js_insert_ad_code_deactivate');
add_action('admin_menu', 'js_insert_ad_code_admin_menu');
add_filter('the_content', 'js_insert_ad_code_filter', 50);
?>
