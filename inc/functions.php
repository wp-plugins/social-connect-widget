<?php
//Load css sheet for the main WordPress pages
function addHeaderCode() {
	wp_enqueue_style('socialConnect-style', plugins_url('/social-connect-widget/css/socialConnect-style.php'));
	wp_enqueue_style('tipTip-style', plugins_url('/social-connect-widget/css/tipTip.css'));

	wp_enqueue_script('jquery');
	wp_enqueue_script('tipTip', plugins_url('/social-connect-widget/js/jquery.tipTip.js'), __FILE__, '' , 'all');
	wp_enqueue_script('socialConnectScripts', plugins_url('/social-connect-widget/js/socialConnect.scripts.js'), __FILE__, '' , 'all');
	if (get_option('sc_displayModal')) {
		wp_enqueue_style('simpleModal-style', plugins_url('/social-connect-widget/css/simpleModal.php'));
		wp_enqueue_script('simpleModal', plugins_url('/social-connect-widget/js/jquery.simplemodal.js'), __FILE__, '' , 'all');
	}
}

//Function to do the work of the plugin and return shortcode text
function socialConnect_shortcodeHandler() {
	$socialConnect_output = socialConnect_outputFunction();
	return $socialConnect_output;
}

// Runs on plugin install
function socialConnect_install() {
	//Populate new option fields with default values
	global $wpdb;

	$sc_twitter = '';
	$sc_facebook = '';
	$sc_googleplus = '';
	$sc_youtube = '';
	$sc_tumblr = '';
	$sc_linkedin = '';
	$sc_pinterest = '';
	$sc_vimeo ='';
	$sc_flickr ='';
	$sc_instagram ='';
	$sc_email ='';
    $sc_rss = 'feeds.feedburner.com/news/press';
        
	$sc_css_iconSpace = '20';
	$sc_css_iconAlign = 'left';
	$sc_modalHeading = 'Connect with Us';
	$sc_displayModal = 'true';
	$sc_iconSet = 'boxxed';
	$sc_css_iconDesaturate = '0';
	$sc_imgSize = '40';

	// Creates new database fields
	add_option("sc_version", $sc_version, '', 'yes');

	add_option("sc_twitter", $sc_twitter, '', 'yes');
	add_option("sc_facebook", $sc_facebook, '', 'yes');
	add_option("sc_googleplus", $sc_googleplus, '', 'yes');
	add_option("sc_youtube", $sc_youtube, '', 'yes');
	add_option("sc_tumblr", $sc_tumblr, '', 'yes');
	add_option("sc_linkedin", $sc_linkedin, '', 'yes');
	add_option("sc_pinterest", $sc_pinterest, '', 'yes');
	add_option("sc_vimeo", $sc_vimeo, '', 'yes');
	add_option("sc_flickr", $sc_flickr, '', 'yes');
	add_option("sc_instagram", $sc_instagram, '', 'yes');
	add_option("sc_email", $sc_email, '', 'yes');
	add_option("sc_rss", $sc_rss, '', 'yes');
	
	add_option("sc_css_iconSpace", $sc_css_iconSpace, '', 'yes');
	add_option("$sc_css_iconAlign", $sc_css_iconAlign, '', 'yes');
	add_option("sc_modalHeading", $sc_modalHeading, '', 'yes');
	add_option("sc_displayModal", $sc_displayModal, '', 'yes');
	add_option("sc_iconSet", $sc_iconSet, '', 'yes');
	add_option("sc_css_iconDesaturate", $sc_css_iconDesaturate, '', 'yes');
	add_option("sc_imgSize", $sc_imgSize, '', 'yes');
}

// Runs on plugin update
function socialconnect_update() {
	global $sc_version;
    if (get_option( 'sc_version' ) != $sc_version | !get_option( 'sc_version' )) {      
        // Add new version number and new option defaults for existing users
        update_option("sc_version", $sc_version, '', 'yes');
        update_option("sc_css_iconDesaturate", '0', '', 'yes');
        update_option("sc_css_imgSize", '40', '', 'yes');
    }
}

// Display admin notice
function socialConnect_adminNotice() {
	global $current_user;
	global $sc_version;
	$user_id = $current_user->ID;
	// Check that the user hasn't already clicked to ignore the message
	if ( ! get_user_meta($user_id, $sc_version + '_notice_ignore') ) {
		echo '<div class="updated"><p>';
		printf(__('Important! Please check you configuration for Social Connect Widget on the <a href="' . $url = admin_url() . 'options-general.php?page=social-connect-settings">settings page.</a> | <a href="%1$s">Hide Notice</a>'), '?notice_ignore=0');
		echo "</p></div>";
	}
}

// Ignore the admin notice
function socialConnect_adminNotice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	// If user clicks to ignore the notice, add that to their user meta
	if ( isset($_GET['notice_ignore']) && '0' == $_GET['notice_ignore'] ) {
		add_user_meta($user_id, $sc_version + '_notice_ignore', 'true', true);
	}
}

//Runs on deactivation and deletes the database fields
function socialConnect_remove() {
	delete_option('sc_twitter');
	delete_option('sc_facebook');
	delete_option('sc_googleplus');
	delete_option('sc_youtube');
	delete_option('sc_tumblr');
	delete_option('sc_linkedin');
	delete_option('sc_pinterest');
	delete_option('sc_vimeo');
	delete_option('sc_flickr');
	delete_option('sc_instagram');
	delete_option('sc_email');
	delete_option('sc_rss');
	
	delete_option('sc_css_iconSpace');
	delete_option('sc_css_iconAlign');
	delete_option('sc_modalHeading');
	delete_option('sc_displayModal');
	delete_option('sc_iconSet');
	delete_option('sc_css_iconDesaturate');
	delete_option('sc_imgSize');
}

//Register the widget
function socialConnect_registerWidget() {
	register_widget('socialConnect_widget');
}

// Function to register and then enqueue styles, scripts and fonts on the admin settings page
function socialConnect_loadCSS() {
	wp_enqueue_style('socialConnect_settingsCSS', plugins_url().'/social-connect-widget/css/socialConnect-settings.css', __FILE__, '', 'all');
	wp_enqueue_style('sinple-slider-css', plugins_url().'/social-connect-widget/css/simple-slider.css', __FILE__, '', 'all');
	wp_enqueue_script('simpleSlider', plugins_url('/social-connect-widget/js/jquery.simple-slider.js'), __FILE__, '' , 'all');
	wp_enqueue_script('socialConnect_settingsJS', plugins_url('/social-connect-widget/js/socialConnect.settings-scripts.js'), __FILE__, '' , 'all');
	add_action('admin_init', 'addHeaderCode');
?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />
<?php
}

// Generate links back to author site with Google Analytics tracking based on version number
function socialConnect_npLink($url, $link) {
	 	global $sc_version;
	 	if (!$link) {
	 		$link = 'NewsPress';
	 	}
		$sc_npLink = '<a href="http://www.newspress.io/' . $url . '?utm_source=sc-widget&utm_medium=wordpress&utm_content=' . $sc_version . '&utm_campaign=Social%20Connect%20Widget">' . $link . '</a>';
		return $sc_npLink;
	 }
?>