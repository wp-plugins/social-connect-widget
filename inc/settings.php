<?php
if ( is_admin() ){
	// Call the html code for the admin menu page
	add_action('admin_menu', 'socialConnect_adminMenu');
	//Hook in the css and whatnot
	function socialConnect_adminMenu() {
		$sc_adminMenu = add_options_page('Social Connect Widget Settings', 'Social Connect Widget', 'manage_options', 'social-connect-settings', 'socialConnect_optionsPage');
		add_action('admin_print_styles-' . $sc_adminMenu, 'socialConnect_loadCSS');
	}
	
	function socialConnect_optionsPage() { ?>
		<div id="sc-body">
			<div id="sc-main">
				<div id="icon-options-general" class="icon32"><br></div>
				<h1>Social Connect Widget</h1>
				<p>Setup the options for Social Connect below. If you don't want a particular icon to appear simply leave the field blank and it won't be displayed. Add the icons to your site <em>via</em> the <a href="/wp-admin/widgets.php">Widgets</a> page, or anywhere else you like using the shortcode <strong>[social-connect]</strong>.</p>
				<p>The plugin now features a new set of flat social media icons which can be selected below. If there is an icon set that you would like included in the next release send us a request <em>via</em> the <a href="http://www.newspress.io/about">NewsPress website</a>.</p>
				<p>The Social Connect Widget is brought to you by <a href="http://www.newspress.io">NewsPress</a>, delivering bytesize WordPress news to your inbox. Visit us at <a href="http://www.newspress.io">www.newspress.io</a> to check out our content, sign up for the newsletter or join the community and start submitting your own WordPress news stories.</p>
				<p>If you have any comments, feedback, bug reports or feature requests please <a href="http://www.newspress.io/about" target="_blank">contact us</a> <em>via</em> the <a href="http://www.newspress.io/about">NewsPress website</a>.</p>
				<h2>Settings</h2>
				<form method="post" action="options.php">
					<?php wp_nonce_field('update-options'); ?>
					<table width="600">
						<tr>
							<td class="siteTitle">Twitter</td>
							<td>http://www.twitter.com/ <input name="sc_twitter" type="text" id="sc_twitter" value="<?php echo get_option('sc_twitter'); ?>" /></td>
						</tr>
						<tr valign="top">
							<td class="siteTitle">Facebook</td>
							<td>http://www.facebook.com/ <input name="sc_facebook" type="text" id="sc_facebook" value="<?php echo get_option('sc_facebook'); ?>" /></td>
						</tr>
						<tr>
							<td class="siteTitle">Google+ URL</td>
							<td>http:// <input name="sc_googleplus" type="text" id="sc_googleplus" value="<?php echo get_option('sc_googleplus'); ?>" size="35" /></td>
						</tr>
						<tr>
							<td class="siteTitle">YouTube</td>
							<td>www.youtube.com/ <input name="sc_youtube" type="text" id="sc_youtube" value="<?php echo get_option('sc_youtube'); ?>" /></td>
						</tr>
						<tr>
							<td class="siteTitle">Tumblr</td>
							<td>http:// <input name="sc_tumblr" type="text" id="sc_tumblr" value="<?php echo get_option('sc_tumblr'); ?>" />.tumblr.com</td>
						</tr>
						<tr>
							<td class="siteTitle">LinkedIn URL</td>
							<td>http:// <input name="sc_linkedin" type="text" id="sc_linkedin" value="<?php echo get_option('sc_linkedin'); ?>" size="35" /></td>
						</tr>
						<tr>
							<td class="siteTitle">Pinterest Username</td>
							<td>http://pinterest.com/ <input name="sc_pinterest" type="text" id="sc_pinterest" value="<?php echo get_option('sc_pinterest'); ?>" /></td>
						</tr>
						<tr>
							<td class="siteTitle">Vimeo User ID</td>
							<td>http://vimeo.com/ <input name="sc_vimeo" type="text" id="sc_vimeo" value="<?php echo get_option('sc_vimeo'); ?>" /></td>
						</tr>
						<tr>
							<td class="siteTitle">Flickr URL</td>
							<td>http://www.flickr.com/ <input name="sc_flickr" type="text" id="sc_flickr" value="<?php echo get_option('sc_flickr'); ?>" /></td>
						</tr>
						<tr>
							<td class="siteTitle">Email Address</td>
							<td>mailto: <input name="sc_email" type="text" id="sc_email" value="<?php echo get_option('sc_email'); ?>" size="35" /></td>
						</tr>						
						<tr>
							<td class="siteTitle">RSS</td>
							<td>http:// <input name="sc_rss" type="text" id="sc_rss" value="<?php echo get_option('sc_rss'); ?>" size="35" /></td>
						</tr>
					</table>
					<br />
					<hr />
					<br />
					<table width="600">
						<tr>
							<td class="siteTitle">Icon Spacing</td>
							<td><input name="sc_css_iconSpace" type="text" id="sc_css_iconSpace" value="<?php echo get_option('sc_css_iconSpace'); ?>" size="3" />&nbsp;px</td>
						</tr>
						<tr>
							<td class="siteTitle">Icon Alignment</td>
							<td>
								<select name="sc_css_iconAlign">
									<option value="left" <?php if (get_option('sc_css_iconAlign')=="left") echo 'selected="selected"'; ?> >Left</option>
									<option value="right" <?php if (get_option('sc_css_iconAlign')=="right") echo 'selected="selected"'; ?> >Right</option>
									<option value="center" <?php if (get_option('sc_css_iconAlign')=="center") echo 'selected="selected"'; ?> >Middle</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="siteTitle">Display (right-click) Dialogue</td>
							<td><input name="sc_displayModal" type="checkbox" id="sc_displayModal" value="TRUE" <?php if (get_option('sc_displayModal')==TRUE) echo 'checked="checked" '; ?> />&nbsp;<small>(Note: Includes a link to NewsPress in the footer)</small></td>
						</tr>
						<tr>
							<td class="siteTitle">Right Click Heading</td>
							<td><input name="sc_modalHeading" type="text" id="sc_modalHeading" value="<?php echo get_option('sc_modalHeading'); ?>" /></td>
						</tr>
						<tr>
							<td class="siteTitle">Icon Set</td>
							<td>
								<select name="sc_iconSet">
									<option value="elegant-themes" <?php if (get_option('sc_iconSet')=="elegant-themes") echo 'selected="selected"'; ?> >Elegant Themes</option>
									<option value="boxxed" <?php if (get_option('sc_iconSet')=="boxxed") echo 'selected="selected"'; ?> >Boxxed</option>
								</select>
							</td>
						</tr>
					</table>
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="page_options" value="sc_twitter,sc_facebook,sc_googleplus,sc_youtube,sc_tumblr,sc_pinterest,sc_linkedin,sc_vimeo,sc_flickr,sc_email,sc_rss,sc_css_iconSpace,sc_css_iconAlign,sc_displayModal,sc_modalHeading,sc_iconSet" />
					<p><input class="button button-primary" type="submit" value="<?php _e('Save Changes') ?>" /></p>
				</form>
			</div>
			<div id="sc-sideBanner-container">
				<iframe id="sc-newspress-iframe" src="http://www.newspress.io"></iframe>
			</div>
			<div style="clear:both;"></div>
			<div>
				<h2>Preview</h2>
				<p>The output below is a live preview of what the social connect icons will look like when they are added to your site.</p><br />
			<?php echo socialConnect_shortcodeHandler(); ?>
			</div>
			<br />
			<p style="font-style: italic; font-size: 13px; line-height: 20px;">
			<?php
				// Credits
				if (get_option('sc_iconSet')) {
				echo "Icons by ";
				switch (get_option('sc_iconSet')) {
					case 'elegant-themes':
						echo '<a href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=13301_0_1_10" target="_blank">Elegant Themes</a>';
						break;
					case 'boxxed':
						echo '<a href="http://www.twelveskip.com/" target="_blank">TwelveSkip</a>';
						break;
				}
			}?>
			</p>
		</div> <?php
	}
}
?>