<?php
header('Content-type: text/css');
require_once('../../../../wp-load.php');
$iconSpace = get_option('sc_css_iconSpace') / 2;
$iconAlign = get_option('sc_css_iconAlign');
$sc_imgSize = '40';
?>

.sc-container {text-align:<?php echo $iconAlign; ?>;}
.sc-icons {display: inline-block; margin-top:-<?php echo $iconSpace; ?>px; margin-bottom:-<?php echo $iconSpace; ?>px;}
.sc-icons img {vertical-align:middle;}
.sc-icons a {display: inline-block; margin:<?php echo $iconSpace; ?>px <?php echo $iconSpace; ?>px; height: <?php echo $sc_imgSize; ?>px;}