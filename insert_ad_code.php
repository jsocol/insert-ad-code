<?php
/*
 * Plugin Name: Insert Ad Code
 * Plugin URI: http://jamessocol.com/blog/2007/12/wordpress-plugin-insert-ad-code.php
 * Description: Automatically inserts ad code (ie: from Openads, AdSense, etc) into posts.
 * Version: 1.1.0
 * Author: James Socol
 * Author URI: http://jamessocol.com/
 */

/*  Copyright 2007  James Socol  (email : me@jamessocol.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$js_insert_ad_code_version = '1.1.0';
$js_insert_ad_code_textdomain = 'js_insert_ad_code';

// Add the page to the options menu
function js_insert_ad_code_admin_menu() {
	global $js_insert_ad_code_textdomain;
	add_options_page(__('Insert Ad Code Manager', $js_insert_ad_code_textdomain), __('Insert Ad Code', $js_insert_ad_code_textdomain), 'manage_options', __FILE__, 'js_insert_ad_code_admin_page');
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
	<p><strong><?php _e('Insert Ad Code', $js_insert_ad_code_textdomain); ?></strong> <?php _e('is meant to be used with a program like <a href="http://google.com/adsense/" title="Google AdSense" target="_blank">Google AdSense</a> or an external script like <a href="http://www.openads.org/" title="Openads Ad Server" target="_blank">Openads</a>. <strong>Insert Ad Code</strong> does not rotate ads, nor keep track of impressions, clicks, or conversions. It just inserts code.', $js_insert_ad_code_textdomain); ?></p>
	<form action="options.php" method="post">
		<?php if (function_exists('wp_nonce_field')) { wp_nonce_field('update-options'); } ?>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php echo join(',', $optionvars); ?>"/>
		
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
			<input type="text" name="js_insert_ad_code_custom_tag" id="js_insert_ad_code_custom_tag" value="<?php echo get_option('js_insert_ad_code_custom_tag'); ?>" style="width: 50%" /> <label for="js_insert_ad_code_custom_tag"><strong><?php _e('Custom Tag', $js_insert_ad_code_textdomain); ?></strong></label> 
			<small>(<a href="javascript:;" onclick="document.getElementById('js_insert_ad_code_custom_tag').value='&lt;!--insert ads--&gt;';"><?php _e('default'); ?></a>)</small></p>
		
		<!-- finally, what should the code be? -->
		<p><label for="js_insert_ad_code_html"><?php _e('What code should I insert?', $js_insert_ad_code_textdomain); ?></label><br />
			<textarea name="js_insert_ad_code_html" id="js_insert_ad_code_html" style="width: 50%; height: 200px" wrap="virtual"><?php echo get_option('js_insert_ad_code_html'); ?></textarea></p>
		
		<!-- submit the form -->
		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" />
		</p>
    </form>
	<p><strong><?php _e('Insert Ad Code', $js_insert_ad_code_textdomain); ?> <?php echo $js_insert_ad_code_version; ?></strong> <?php _e('by', $js_insert_ad_code_textdomain); ?> <a href="http://jamessocol.com">James Socol</a>.</p>
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