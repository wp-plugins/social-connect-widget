<?php
header('Content-type: text/css');
require_once('../../../../wp-load.php');
$iconSpace = get_option('sc_css_iconSpace') / 2;
?>

/* Simple Modal Settings */
#sc-modalContent {display: none;}

/* Overlay */
#simplemodal-overlay {background-color: #000;}

/* Container */
#sc-modalContent {color: #bbb; background-color: #333; border: 4px solid #444; padding: 12px !important;}
#simplemodal-container .simplemodal-data {padding: 8px;}
#simplemodal-container code {background: #141414; border-left: 3px solid #65B43D; color: #bbb; display: block; font-size: 12px; margin-bottom: 12px; padding: 4px 6px 6px;}
#simplemodal-container a {color: #ddd;}
#simplemodal-container a.modalCloseImg {background: url(../img/other/x.png) no-repeat; width: 25px; height: 29px; display: inline; z-index: 3200; position: absolute; top: -10px; right: -12px; cursor: pointer;}
#simplemodal-container h3 {color: #84b8d9; font-size: large;}

/* Content */
#sc-modalContent img {vertical-align: middle; margin-right: 15px;}
#sc-modalContent a {text-decoration: none;}
#sc-modalContent p {margin-top: <?php echo $iconSpace; ?>px; margin-bottom: 0px;}
#sc-credit p {font-size: x-small; text-align: center; margin: 15px 15px 15px 0;}