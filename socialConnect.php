<?php
/*
 * Plugin Name: Social Connections Widget
 * Version: 1.1
 * Plugin URI: http://scryb.es/
 * Description: A widget designed to easily add icons and links to your social pages on all the major networks.
 * Author: Scrybes WordPress Hosting
 * Author URI: http://scryb.es/
 */
?>
<?php
function addHeaderCode() {
	echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/social-connect-widget/css/style.css" />' . "\n";
}
function my_plugin_create_table()
{
	global $wpdb; 
	if($wpdb->get_var("show tables like SCW_Stats") != 'SCW_Stats') 
	{
		$sql = "CREATE TABLE SCW_Stats (
		id mediumint(9) NOT NULL,
		facebook tinytext NOT NULL,
		twitter tinytext NOT NULL,
                googleplus tinytext NOT NULL,
                youtube tinytext NOT NULL,
		rss tinytext NOT NULL,
		UNIQUE KEY id (id)
		);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
}
register_activation_hook( __FILE__, 'my_plugin_create_table' );
class scWidget extends WP_Widget
{
	function scWidget(){
		$widget_ops = array('classname' => 'widget_hello_world', 'description' => __( "Add icons and links to your social network pages. Works nicely in footer areas. Simply leave fields blank to hide icons.") );
		$control_ops = array('width' => 300, 'height' => 300);
		$this->WP_Widget('helloworld', __('Social Connection Links Widget'), $widget_ops, $control_ops);
	}	
	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', $instance['title'] );
		$facebook = empty($instance['facebook']) ? '' : $instance['facebook'];
		$twitter = empty($instance['twitter']) ? '' : $instance['twitter'];
                $googleplus = empty($instance['googleplus']) ? '' : $instance['googleplus'];
                $youtube = empty($instance['youtube']) ? '' : $instance['youtube'];
		$rss = empty($instance['rss']) ? '' : $instance['rss'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
				
		echo '<div> ';
		
if (!($twitter==''))
{ echo  '<a target="_blank" href="http://twitter.com/'.$twitter.'" id="followTwitter"><img src="'.get_bloginfo('url').'/wp-content/plugins/social-connect-widget/img/twitter.png" class="scwLogos" alt="Twitter" /></a>' ; }

if (!($facebook=='')) 
{ echo '<a target="_blank" href="http://www.facebook.com/'.$facebook.'" id="followFacebook"><img src="'.get_bloginfo('url').'/wp-content/plugins/social-connect-widget/img/facebook.png" class="scwLogos" alt="Facebook" /></a>' ; }

if (!($googleplus=='')) 
{ echo '<a target="_blank" href="'.$googleplus.'" id="followGooglePlus"><img src="'.get_bloginfo('url').'/wp-content/plugins/social-connect-widget/img/googleplus.png" class="scwLogos" alt="Google+" /></a>' ; }

if (!($youtube=='')) 
{ echo '<a target="_blank" href="http://www.youtube.com/'.$youtube.'" id="followYouTube"><img src="'.get_bloginfo('url').'/wp-content/plugins/social-connect-widget/img/youtube.png" class="scwLogos" alt="YouTube" /></a>' ; }

if (!($rss=='')) 
{ echo '<a target="_blank" href="http://feeds.feedburner.com/'.$rss.'" id="subscribeRSS"><img src="'.get_bloginfo('url').'/wp-content/plugins/social-connect-widget/img/rss.png" class="scwLogos" alt="RSS"/></a>' ; }

   echo '</div>' ;	
   	
		echo $after_widget;
	}
	/*Plugin Update */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['facebook'] = strip_tags(stripslashes($new_instance['facebook']));
		$instance['twitter'] = strip_tags(stripslashes($new_instance['twitter']));
                $instance['googleplus'] = strip_tags(stripslashes($new_instance['googleplus']));
                $instance['youtube'] = strip_tags(stripslashes($new_instance['youtube']));
		$instance['rss'] = strip_tags(stripslashes($new_instance['rss']));		
		global $wpdb;
			$wpdb->insert( 'SCW_Stats', array(
			'id'	=> 1,
			'facebook' => $instance['facebook'], 
			'twitter' => $instance['twitter'],
                        'googleplus' => $instance['googleplus'],
                        'youtube' => $instance['youtube'],
			'rss' => $instance['rss']
			) 
		);		
		global $wpdb;
			$wpdb->update( 'SCW_Stats', 
			array( 
				'facebook' => $instance['facebook'], 
				'twitter' => $instance['twitter'],
                                'googleplus' => $instance['googleplus'],
                                'youtube' => $instance['youtube'],
				'rss' => $instance['rss']
			),
			array(
				'id' => 1
			) 
		);	
		return $instance;
	}	
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('facebook'=>'scrybes', 'twitter'=>'scrybes', 'googleplus'=>'http://gplus.to/scryb.es', 'youtube'=>'', 'rss'=>'scrybes') );		
		$facebook = htmlspecialchars($instance['facebook']);
		$twitter = htmlspecialchars($instance['twitter']);
                $googleplus = htmlspecialchars($instance['googleplus']);
                $youtube = htmlspecialchars($instance['youtube']);
		$rss = htmlspecialchars($instance['rss']);	
		?>
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
			</p>
		<?php
		echo '<p><label for="' . $this->get_field_name('facebook') . '">' . ('Facebook URL handle:') . ' <input id="' . $this->get_field_id('facebook') . '" name="' . $this->get_field_name('facebook') . '" type="text" value="' . $facebook . '" style="width:100%;"/></label></p>';
		echo '<p><label for="' . $this->get_field_name('twitter') . '">' . ('Twitter handle:') . ' <input id="' . $this->get_field_id('twitter') . '" name="' . $this->get_field_name('twitter') . '" type="text" value="' . $twitter . '" style="width:100%;"/></label></p>';
		echo '<p><label for="' . $this->get_field_name('googleplus') . '">' . ('Google+ URL:') . ' <input id="' . $this->get_field_id('googleplus') . '" name="' . $this->get_field_name('googleplus') . '" type="text" value="' . $googleplus . '" style="width:100%;"/></label></p>';
		echo '<p><label for="' . $this->get_field_name('youtube') . '">' . ('YouTube Channel Name:') . ' <input id="' . $this->get_field_id('youtube') . '" name="' . $this->get_field_name('youtube') . '" type="text" value="' . $youtube . '" style="width:100%;"/></label></p>';
		echo '<p><label for="' . $this->get_field_name('rss') . '">' . __('Feedburner name:') . ' <input style="width:100%;" id="' . $this->get_field_id('rss') . '" name="' . $this->get_field_name('rss') . '" type="text" value="' . $rss . '" /></label></p>';
	}
}
function SC_Widget() {
	register_widget('scWidget');
}	
add_action('widgets_init', 'SC_Widget');
add_action('wp_head', 'addHeaderCode');
?>