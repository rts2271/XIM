<?php
#####################################################
# Xim .90
# Xoops Instant Messenger
# 	Ralph Smith
#	http://www.mercnet.org
#  
#  Licence : GPL V 2
#####################################################
include("header.php");
include("includes/functions.php");
$myid=$xoopsUser->uid();
$task = isset($HTTP_GET_VARS['task']) ? trim($HTTP_GET_VARS['task']) : '';
$task = isset($HTTP_POST_VARS['task']) ? trim($HTTP_POST_VARS['task']) : $task;
$type = isset($HTTP_GET_VARS['type']) ? trim($HTTP_GET_VARS['type']) : '';
$type = isset($HTTP_POST_VARS['type']) ? trim($HTTP_POST_VARS['type']) : $type;
$msg_id = isset($HTTP_GET_VARS['msg_id']) ? trim($HTTP_GET_VARS['msg_id']) : '';
$msg_id = isset($HTTP_POST_VARS['msg_id']) ? trim($HTTP_POST_VARS['msg_id']) : $msg_id;
$fid = isset($HTTP_GET_VARS['fid']) ? trim($HTTP_GET_VARS['fid']) : '';
$fid = isset($HTTP_POST_VARS['fid']) ? trim($HTTP_POST_VARS['fid']) : $fid;

switch($task)  {
        case "block":
        block($tid);
        break;
        case "read":
        imread($msg_id, $msg_time);
        break;
        case "imcompose":
        imcompose($to, $subject, $prev_msg);
        break;
        case "friends":
        displayFriendsList($beg);
        break;
	    case "mod":
        displayUsersList($beg, $letter);
        break;
	    case "add":
        addFriend($fid);
        break;
        case "approve":
        approveFriend($fid);
        break;
	    case "remove":
        deleteFriend($myid);
        break;
        case "complain":
        complainFriend($fid);
        break;
        case "block":
        blockFriend($fid);
        break;
        default:
        onlinelist();
        break;
}

?>
