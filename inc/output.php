<?php
//Process the plugin options and return html code to display icons and links
function socialConnect_outputFunction() {

	//Set up the array used to process the options and whatnot
	$sc_sites = array(	array("Twitter", "twitter","http://twitter.com/",""),
						array("Facebook", "facebook", "http://www.facebook.com/",""),
						array("Google+", "googleplus", "http://", ""),
						array("You Tube", "youtube", "http://www.youtube.com/", ""),
						array("Tumblr", "tumblr", "http://", ".tumblr.com"),
						array("Linked In", "linkedin", "http://", ""),
						array("Pinterest", "pinterest", "http://pinterest.com/", ""),
						array("Vimeo", "vimeo", "http://vimeo.com/", ""),
						array("Flickr", "flickr", "http://flickr.com/", ""),
						array("Email", "email", "mailto:", ""),
						array("RSS", "rss", "http://", "")
					);
	$sc_count = 11;
	reset($sc_sites);

	// Grab the option values from WP database
	for ($i = 0; $i < $sc_count; $i++) {
		${'sc_'.$sc_sites[$i][1]} = get_option('sc_'.$sc_sites[$i][1]);
	}
	$sc_iconSet = "elegant-themes";
	$sc_imgPath = plugins_url().'/social-connect-widget/img/'.$sc_iconSet.'/';
	$sc_imgSize = "40";
	$sc_target = "_blank";
	$sc_modalHeading = '<h3>'.get_option('sc_modalHeading').'</h3>';

	// Generate the code used to display the icons
	for ($i = 0; $i < $sc_count; $i++) {
		if (${'sc_'.$sc_sites[$i][1]}) {
			${'sc_'.$sc_sites[$i][1].'_link'} = $sc_sites[$i][2].${'sc_'.$sc_sites[$i][1]}.$sc_sites[$i][3];
			${'sc_'.$sc_sites[$i][1].'_output'} = '<a target="'.$sc_target.'" href="'.${'sc_'.$sc_sites[$i][1].'_link'}.'" title="'.$sc_sites[$i][0].'"><img src="'.$sc_imgPath.$sc_sites[$i][1].'.png" alt="'.${'sc_'.$sc_sites[$i][0]}.'" width="'.$sc_imgSize.'" /></a>';
			${'sc_'.$sc_sites[$i][1].'_modal'} = '<p>' . ${'sc_'.$sc_sites[$i][1].'_output'} . '<a href = "'.${'sc_'.$sc_sites[$i][1].'_link'}.'" target="'.$sc_target.'" title="'.${'sc_'.$sc_sites[$i][1].'_link'}.'">'.$sc_sites[$i][0].'</a></p>';
		}
	}

	$sc_header = '<div class="sc-container"><div class="sc-icons">';
	$sc_footer = '</div></div>';
	
	// Loop to consolidate the modal code
	for ($i = 0; $i < $sc_count; $i++) { $sc_modal_sites = $sc_modal_sites . ${'sc_'.$sc_sites[$i][1].'_modal'}; }

	$sc_modal = '	<div id="sc-modalContent">'.
						$sc_modalHeading .
						$sc_modal_sites .
    					'<div id="sc-credit"><p>Social Connect by <a href="http://scryb.es" target="_blank" title="Click for info">Scrybes WordPress Hosting</a></p></div>
					</div> 
					<div style="display:none">
						<img src="http://wordpress.scryb.es/wp-content/plugins/social-connect-widget/img/other/x.png" alt="">
					</div>';
	
	// Loop to consolidate the output code
	for ($i = 0; $i < $sc_count; $i++) { $sc_icon_output = $sc_icon_output . ${'sc_'.$sc_sites[$i][1].'_output'}; }
	
	//Consolidate and put the code in order
	$socialConnect_output = $sc_header . $sc_icon_output . $sc_footer . $sc_modal;
	
	// Finally, spit out the code
	return $socialConnect_output;
}
?>