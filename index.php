<?php
#####################################################
# Xim .90
# Xoops Instant Messenger
# 	Ralph Smith
#	http://www.mercnet.org
#  
#  Licence : GPL V 2
#####################################################
$xoopsOption['template_main'] = 'xim_index.html';
include("includes/functions.php");
include("xoops_version.php");
include("header.php");
require(XOOPS_ROOT_PATH.'/header.php');
$myts =& MyTextSanitizer::getInstance();
include(XOOPS_ROOT_PATH."/footer.php");
?>
