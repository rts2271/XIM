<?php
#####################################################
# Xim .90
# Xoops Instant Messenger
# 	Ralph Smith
#	http://www.mercnet.org
#  
#  Licence : GPL V 2
#####################################################

function imgo() {
	Header("Location: im.php");
}

function im_make_clickable($text) {
	$ret = eregi_replace(" ([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])", " <a href=\"\\1://\\2\\3\" target=\"_blank\" target=\"_new\">\\1://\\2\\3</a>", $text);
	$ret = eregi_replace(" (([a-z0-9_]|\\-|\\.)+@([^[:space:]]*)([[:alnum:]-]))", " <a href=\"mailto:\\1\" target=\"_new\">\\1</a>", $ret);
	return($ret);
}

function im_bbencode($message) {
	$matchCount = preg_match_all("#\[code\](.*?)\[/code\]#si", $message, $matches);
		for ($i = 0; $i < $matchCount; $i++){
		$currMatchTextBefore = preg_quote($matches[1][$i]);
		$currMatchTextAfter = htmlspecialchars($matches[1][$i]);
		$message = preg_replace("#\[code\]$currMatchTextBefore\[/code\]#si", "<!-- BBCode Start --><TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><tr valign=\"top\"><TD><font class=\"pn-sub\">Code:</font><HR></TD></TR><tr valign=\"top\"><TD><FONT class=\"pn-sub\"><PRE>$currMatchTextAfter</PRE></FONT></TD></TR><tr valign=\"top\"><TD><HR></TD></TR></TABLE><!-- BBCode End -->", $message);
		}
	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	$message = preg_replace("#\[quote\](.*?)\[/quote]#si", "<!-- BBCode Quote Start --><TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><tr valign=\"top\"><TD><font class=\"pn-sub\">Quote:</font><HR></TD></TR><tr valign=\"top\"><TD><FONT class=\"pn-sub\"><BLOCKQUOTE>\\1</BLOCKQUOTE></FONT></TD></TR><tr valign=\"top\"><TD><HR></TD></TR></TABLE><!-- BBCode Quote End -->", $message);
	// [b] and [/b] for bolding text.
	$message = preg_replace("#\[b\](.*?)\[/b\]#si", "<!-- BBCode Start --><B>\\1</B><!-- BBCode End -->", $message);
	// [i] and [/i] for italicizing text.
	$message = preg_replace("#\[i\](.*?)\[/i\]#si", "<!-- BBCode Start --><I>\\1</I><!-- BBCode End -->", $message);
	// [url]www.phpbb.com[/url] code..
	$message = preg_replace("#\[url\](http://)?(.*?)\[/url\]#si", "<!-- BBCode Start --><A HREF=\"http://\\2\" TARGET=\"_blank\">\\2</A><!-- BBCode End -->", $message);
	// [url=www.phpbb.com]phpBB[/url] code..
	$message = preg_replace("#\[url=(http://)?(.*?)\](.*?)\[/url\]#si", "<!-- BBCode Start --><A HREF=\"http://\\2\" TARGET=\"_blank\">\\3</A><!-- BBCode End -->", $message);
	// [email]user@domain.tld[/email] code..
	$message = preg_replace("#\[email\](.*?)\[/email\]#si", "<!-- BBCode Start --><A HREF=\"mailto:\\1\">\\1</A><!-- BBCode End -->", $message);
	// [img]image_url_here[/img] code..
	$message = preg_replace("#\[img\](.*?)\[/img\]#si", "<!-- BBCode Start --><IMG SRC=\"\\1\"><!-- BBCode End -->", $message);
	// unordered list code..
	$matchCount = preg_match_all("#\[list\](.*?)\[/list\]#si", $message, $matches);
		for ($i = 0; $i < $matchCount; $i++){
		$currMatchTextBefore = preg_quote($matches[1][$i]);
		$currMatchTextAfter = preg_replace("#\[\*\]#si", "<LI>", $matches[1][$i]);
		$message = preg_replace("#\[list\]$currMatchTextBefore\[/list\]#si", "<!-- BBCode ulist Start --><UL>$currMatchTextAfter</UL><!-- BBCode ulist End -->", $message);
		}
	$matchCount = preg_match_all("#\[list=([a1])\](.*?)\[/list\]#si", $message, $matches);
		for ($i = 0; $i < $matchCount; $i++){
		$currMatchTextBefore = preg_quote($matches[2][$i]);
		$currMatchTextAfter = preg_replace("#\[\*\]#si", "<LI>", $matches[2][$i]);
		$message = preg_replace("#\[list=([a1])\]$currMatchTextBefore\[/list\]#si", "<!-- BBCode olist Start --><OL TYPE=\\1>$currMatchTextAfter</OL><!-- BBCode olist End -->", $message);
		}
	return($message);
}

function im_smile($message) {
	$message = str_replace(":)", "<IMG SRC=\"../../images/smilies/icon_smile.gif\">", $message);
	$message = str_replace(":-)", "<IMG SRC=\"../../images/smilies/icon_smile.gif\">", $message);
	$message = str_replace(":(", "<IMG SRC=\"../../images/smilies/icon_frown.gif\">", $message);
	$message = str_replace(":-(", "<IMG SRC=\"../../images/smilies/icon_frown.gif\">", $message);
	$message = str_replace(":-D", "<IMG SRC=\"../../images/smilies/icon_biggrin.gif\">", $message);
	$message = str_replace(":D", "<IMG SRC=\"../../images/smilies/icon_biggrin.gif\">", $message);
	$message = str_replace(";)", "<IMG SRC=\"../../images/smilies/icon_wink.gif\">", $message);
	$message = str_replace(";-)", "<IMG SRC=\"../../images/smilies/icon_wink.gif\">", $message);
	$message = str_replace(":o", "<IMG SRC=\"../../images/smilies/icon_eek.gif\">", $message);
	$message = str_replace(":O", "<IMG SRC=\"../../images/smilies/icon_eek.gif\">", $message);
	$message = str_replace(":-o", "<IMG SRC=\"../../images/smilies/icon_eek.gif\">", $message);
	$message = str_replace(":-O", "<IMG SRC=\"../../images/smilies/icon_eek.gif\">", $message);
	$message = str_replace("8)", "<IMG SRC=\"../../images/smilies/icon_cool.gif\">", $message);
	$message = str_replace("8-)", "<IMG SRC=\"../../images/smilies/icon_cool.gif\">", $message);
	$message = str_replace(":?", "<IMG SRC=\"../../images/smilies/icon_confused.gif\">", $message);
	$message = str_replace(":-?", "<IMG SRC=\"../../images/smilies/icon_confused.gif\">", $message);
	$message = str_replace(":p", "<IMG SRC=\"../../images/smilies/icon_razz.gif\">", $message);
	$message = str_replace(":P", "<IMG SRC=\"../../images/smilies/icon_razz.gif\">", $message);
	$message = str_replace(":-p", "<IMG SRC=\"../../images/smilies/icon_razz.gif\">", $message);
	$message = str_replace(":-P", "<IMG SRC=\"../../images/smilies/icon_razz.gif\">", $message);
	$message = str_replace(":-|", "<IMG SRC=\"../../images/smilies/icon_mad.gif\">", $message);
	$message = str_replace(":|", "<IMG SRC=\"../../images/smilies/icon_mad.gif\">", $message);
	return($message);
}

function getMyApprovals($uid){
	
}

function onlinelist() {
	global $xoopsTpl, $xoopsConfig, $xoopsUser, $xoopsOption, $xoopsDB, $HTTP_COOKIE_VARS;
	$online =& xoops_gethandler('online');
	$myid =$xoopsUser->getVar("uid", "E");
	$myname =$xoopsUser->getVar("uname", "E");
	xoops_header();
	messageNotification();
	move();
	$myApprovals=array();
	$myApprovals=getMyApprovals($myid);
	echo "<script language=\"javascript\">\nfunction IM(IM) { var MainWindow = window.open (IM, \"_blank\",\"width=300,height=370,toolbar=no,location=no,menubar=no,scrollbars=no,resizeable=no,status=no\");}\n</script></head><body onload=setInterval('self.location.reload()',20000)>";
	echo "<center><table  width=\"300px;\" class='outer'><tr class='odd'><td align='center'>";
	echo "<a href=im.php>"._WHOISONLINE."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
	echo "<a href=im.php?task=friends>"._MF_TITLE."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
	echo "<a href=im.php?task=mod>"._LIST."</a></td></tr></table>";
	echo '<table width=\"300px;\" cellspacing="2" class="outer">';
	echo "<tr valign=\"top\"><td></td><td>User</td><td>Site Location</td><td>Options</td></tr>";
	$s = $xoopsDB->query("SELECT online_uid, online_uname, online_module FROM ".$xoopsDB->prefix("online")." ORDER BY online_uid DESC");
		while (list($online_uid,$online_uname,$online_module)= $xoopsDB->fetchRow($s)) {
		if($myid==$online_uid){
		$mymodule=$online_module;	
		}
		$isAdmin = false;
		$isFriend=false;
		$isMe=false;
		$isApproved=false;
		$isRequester=false;
		$ref=0;
		$app=0;
			if($online_uid!=0) {
				if($myid==$online_uid){
				$isMe=true;
				}
			echo "<tr align='center' class=\"odd\"><td>";
			$s1 = $xoopsDB->query("SELECT user_avatar FROM ".$xoopsDB->prefix("users")." where uid=$online_uid");
			$r1  = $xoopsDB->fetchArray($s1);
			echo "<img src='".XOOPS_URL."/uploads/$r1[user_avatar]' width=\"100\" height=\"100\" >";
			echo "</td><td valign='top'><a href=\"javascript:window.opener.location='".XOOPS_URL."/userinfo.php?uid=$online_uid';javascript:window.location='im.php';\"><font size=2>$online_uname</font></a>";
			$s3 = $xoopsDB->query("SELECT name FROM ".$xoopsDB->prefix("modules")." where mid=$online_module");
			$r3  = $xoopsDB->fetchArray($s3);
			echo "</td><td valign='top'><font size=2>$r3[name]</font></td><td valign='top'>";
if(!isMe){
			echo "<a href=\"javascript:IM('".XOOPS_URL."/pmlite.php?send2=1&to_userid=$online_uid','pmlite',450,370);\">PM 
			<img src=\"".XOOPS_URL."/images/icons/pm_small.gif\" border=\"0\" width=\"27\" height=\"17\" alt=\"\" /></a>";
}
			$s4 = $xoopsDB->query("SELECT ref FROM ".$xoopsDB->prefix("xim")." WHERE uid1= '$myid' AND uid2= '$online_uid'");
			$r4 = $xoopsDB->fetchRow($s4);
				if(!empty($r4[0])){
				$isFriend=true;	
				}
			$s6 = $xoopsDB->query("SELECT ref, approved FROM ".$xoopsDB->prefix("xim")." WHERE uid1= '$online_uid' AND uid2= '$myid'");
			$r6 = $xoopsDB->fetchRow($s6);
			$s7 = $xoopsDB->query("SELECT ref, approved FROM ".$xoopsDB->prefix("xim")." WHERE uid1= '$myid' AND uid2= '$online_uid'");
			$r7 = $xoopsDB->fetchRow($s7);
				if(!empty($r6[0])){
				$isFriend=true;	
					if($r6[1]>0){
					$isApproved=true;
					}
				}
				if(!empty($r7[0])){
				$isFriend=true;
					if($r7[1]==1){
					$isApproved=true;
					$isRequester=true;
					}
					if($r7[1]==0){
					$isApproved=false;
					$isRequester=true;
					}	
				}
			if(!$isMe){
					if (!$isFriend) {
					echo "<br /><a href=\"im.php?task=add&fid=$online_uid\"><img src=\"images/green_check.gif\" /> Add</a>";
					}
					if ($isFriend) {
						if($isApproved){
						echo "<br /><a href=\"im.php?task=remove&fid=$online_uid\"><img src=\"images/red_x.gif\" />Remove</a>";
						echo "<br /><a href=\"im.php?task=send&fid=$online_uid\"><img src=\"images/download.gif\" /> Send File</a>";
						}else{
							if($isRequester){
							echo "<br />Awaiting Approval";	
							}
						}
					}
				}
			if($isMe){
			$s8 = $xoopsDB->query("SELECT ref, uid1 FROM ".$xoopsDB->prefix("xim")." WHERE uid2= '$myid' AND blocked='0' AND approved= '0'");
			while (list($ref,$uid1)= $xoopsDB->fetchRow($s8)) {	
					$s8=$xoopsDB->query("SELECT uname FROM ".$xoopsDB->prefix("users")." WHERE uid=$uid1");
					$r8 = $xoopsDB->fetchRow($s8);
					$fname=$r8[0];		
					echo "<br /><font size=1><a href=\"im.php?task=approve&fid=$uid1\">$fname</a><br /><font size=1>requests to be added</font><br /><font size=1>click their name to add</font><br />";	
			}		
				}
			echo "</td></tr>";
			
				}
			$upon=$online->write($myid, $myname, time(), $mymodule, $_SERVER['REMOTE_ADDR']);
			
	}
echo '</table><br/>';
echo "</center>";
xoops_footer();
}

function approveFriend($fid){
	global $xoopsConfig, $xoopsDB, $xoopsUser;
	xoops_header();
	$myid=$xoopsUser->uid();
	$s="SELECT ref FROM ".$xoopsDB->prefix("xim")." WHERE uid1=$myid AND uid2=$fid";
	$s2="SELECT ref FROM ".$xoopsDB->prefix("xim")." WHERE uid1=$fid AND uid2=$myid";
	$r = $xoopsDB->fetchRow($s);
	$r2 = $xoopsDB->fetchRow($s2);
	$s2 ="UPDATE ".$xoopsDB->prefix("xim")." SET approved='1'";
	$r2=$xoopsDB->queryF($s2);
	echo "User Added";
	Header("Location: im.php");
	echo "Failed";
	exit;	
	xoops_footer();	
}

function messageNotification(){
	global $xoopsConfig, $xoopsDB, $xoopsUser;
	$myid =$xoopsUser->getVar("uid", "E");
	$sql = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("priv_msgs")." WHERE to_userid = '$myid' AND read_msg='0'");
		if ($row = $xoopsDB->getRowsNum($sql)) {
			while ($msgs = $xoopsDB->fetchArray($sql)) {
			echo "<SCRIPT LANGUAGE=\"JavaScript\">\n
			var telwin = null;\n
			telwin = window.open(\"im.php?task=imread&msg_id=$msgs[msg_id]\", \"$priv_msg[msg_time]\", \"width=450,height=370,toolbar=no,location=no,menubar=no,scrollbars=yes,resizeable=no,status=no\");\n
			</SCRIPT>\n\n";
			}
		}	
}

function addFriend($fid) {
	global $xoopsConfig, $xoopsDB, $xoopsUser;
	xoops_header();
	$myid=$xoopsUser->uid();
	$s="SELECT ref FROM ".$xoopsDB->prefix("xim")." WHERE uid1=$myid AND uid2=$fid";
	$s2="SELECT ref FROM ".$xoopsDB->prefix("xim")." WHERE uid1=$fid AND uid2=$myid";
	$r = $xoopsDB->fetchRow($s);
	$r2 = $xoopsDB->fetchRow($s2);
	if((empty($r[0]))AND(empty($r2[0]))){
	$s2 ="INSERT INTO ".$xoopsDB->prefix("xim")." (uid1, uid2, blocked, approved) VALUES ($myid, $fid, '0', '0')";
	$r2=$xoopsDB->queryF($s2);
	echo "User Added";
	Header("Location: im.php");
	}else{
	echo "Failed";
	exit;	
	}
	xoops_footer();
}

function deleteFriend($uidd) {
	global $xoopsConfig, $xoopsDB, $xoopsUser;
		if (is_numeric($uidd)==false) {
		header("Location: ./im.php");
		}
	$myid=$xoopsUser->uid();
	$s="DELETE FROM ".$xoopsDB->prefix("xim")." WHERE (uid1=$uidd AND uid2=$myid)";
	$r=mysql_query($s);
	$s="DELETE FROM ".$xoopsDB->prefix("xim")." WHERE (uid1=$myid AND uid2=$uidd)";
	$r=mysql_query($s);
	return true;
}

function friendExists() {

}

function updateLastseen(){
	global $xoopsDB, $xoopsUser, $REMOTE_ADDR;
	$past = time() - 300; // anonymous records are deleted after 10 minutes
	$userpast = time() - 8640000; // user records idle for the past 100 days are deleted
	$ip = $REMOTE_ADDR;
		if ($xoopsUser) {
		$uid = $xoopsUser->getVar("uid");
		$uname = $xoopsUser->getVar("uname");
		} else {
		$uid = 0;
		$uname = "Anonymous";
		}
	$sql = "SELECT * FROM ".$xoopsDB->prefix("online")." WHERE online_uname=".$uname."";
		if ( $uid == 0 ) {
		$sql .= " AND ip='".$ip."'";
		}
	$result = $xoopsDB->query($sql);
	list($getRowsNum) = $xoopsDB->fetchRow($result);
}

function imcompose($to, $subject, $msg_id) {
	echo "<SCRIPT LANGUAGE=\"JavaScript\">
	document.location.href=\"".XOOPS_URL."/pmlite.php?reply=1&msg_id=".$msg_id."\"
	</SCRIPT>";
	exit;
}

function displayUsersList($beg_in, $let_in) {
	global $xoopsConfig, $xoopsDB, $xoopsUser;
	$ModName = "Messenger";
	$myid =$xoopsUser->getVar("uid", "E");
	messageNotification();
	move();
	$isadmin = false;
	echo "<title>".$xoopsConfig['sitename']." - $ModName</title>
	<script language=\"javascript\">\nfunction IM(IM) { var MainWindow = window.open (IM, \"_blank\",\"width=450,height=370,toolbar=no,location=no,menubar=no,scrollbars=no,resizeable=no,status=no\");}\n</script>
	</head><body onload=setInterval('self.location.reload()',20000)>";
	echo "<center><table class='outer'><tr class='odd'><td align='center'>";
	echo "<p class=normal><a href=im.php><font size=2>"._WHOISONLINE."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
	echo "<a href=im.php?task=friends>"._MF_TITLE."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
	echo "<a href=im.php?task=mod>"._LIST."</a></font></td></tr></table>";
	$myid=$xoopsUser->uid();
	$p = $xoopsConfig["prefix"];
		if (is_numeric($beg_in)==false) {
		$beg_in=0;
		}else {
			if ($beg_in<1) {
			$beg_in=0;
			}
		}
			if ($let_in) {
			$let_in=strip_tags($let_in);
			}
		$tranche=20;
		$inf=$beg_in;
		$sup=$beg_in+$tranche;
		$s1 ="SELECT uid, uname, level FROM ".$xoopsDB->prefix("users")." WHERE level>0 AND uid!=$myid LIMIT $inf, $tranche";
		$s2 ="SELECT uid1, uid2 FROM ".$xoopsDB->prefix("xim")." WHERE uid1=$myid OR uid2=$myid AND blocked='0'";
		$r1 = $xoopsDB->query($s1);
		$s3="SELECT Count(*) from ".$xoopsDB->prefix("users")." WHERE level>0 AND uid!=$myid";
		$rt2 = $xoopsDB->query($s2);
			while (list($rep) = $xoopsDB->fetchRow($result2)) {
			$numusers = $rep;
			}
		$ismyfriend=array();
			while (list($uid,$fuid) = $xoopsDB->fetchRow($result1) ) {
			$ismyfriend[$fuid]=1;
			}
			if ($let_in) {
			$let_in1=strtoupper($let_in);
			$let_in2=strtolower($let_in);
			$sqlstr="SELECT uid, uname, level FROM ".$xoopsDB->prefix("users")." WHERE (((uname LIKE '$let_in1%') OR (uname LIKE '$let_in2%')) AND level>0 AND uid!=$myid)";
			}
		$result = $xoopsDB->query($sqlstr) or die($xoopsDB->error() );
		$prevlink="";
		$nextlink="";
			if ($sup<$numusers) {
			$nextlink="<a href='im.php?task=mod&beg=$sup'>"._MF_NEXT."</a>";
			$aff_sup=$sup;
			}else{
			$aff_sup=$numusers;
			}
		$prevn=$inf-$tranche;
			if ($prevn>=0) {
			$prevlink="<a href='im.php?task=mod&beg=$prevn'>"._MF_PREVIOUS."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$aff_inf=$inf+1;
			}else{
			$aff_inf=1;
			}
			$numz=0;
			$numpage=1;
			$pagesLinks="";
				while ($numz<$numusers) {
				$pagesLinks.="<a href='im.php?task=mod&beg=$numz'>$numpage</a>&nbsp;&nbsp;";
				$numz+=$tranche;
				$numpage++;
				}
			echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\"><tr><th colspan=\"4\">";
			echo "<font size=2><a href='im.php?task=mod'>"._MF_ALL."</a>&nbsp;&nbsp;";
			echo "<a href='im.php?task=mod&letter=A'>A</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=B'>B</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=C'>C</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=D'>D</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=E'>E</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=F'>F</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=G'>G</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=H'>H</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=I'>I</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=J'>J</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=K'>K</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=L'>L</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=M'>M</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=N'>N</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=O'>O</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=P'>P</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=Q'>Q</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=R'>R</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=S'>S</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=T'>T</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=U'>U</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=V'>V</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=W'>W</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=X'>X</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=Y'>Y</a>&nbsp;";
			echo "<a href='im.php?task=mod&letter=Z'>Z</a></font>";
			echo "</th></tr>";
				while ($userinfo = $xoopsDB->fetchArray($result) ) {
				$userinfo = new XoopsUser($userinfo['uid']);
				$zuid=$userinfo->uid();
				$zuname=$userinfo->uname();
				$zavatar=$userinfo->user_avatar();
				echo "<tr class='odd'><td align='center' valign='top'>";
				echo "<img src=\"".$xoopsConfig['xoops_url']."/uploads/".$zavatar."\" name=\"avatar\" id=\"avatar\" width=\"100\" height='100'>";
				echo "</td><td align='center'  valign='top'>";
					if ($ismyfriend[$zuid]!=1) {
			        echo "<a href='".XOOPS_URL."/userinfo.php?uid=$zuid' target=new><font size=2>".ucfirst($zuname)."</font></a>";
        			}else{
        			echo "<a href=\"javascript:window.opener.location='".XOOPS_URL."/userinfo.php?uid=$zuid';javascript:window.location='im.php?task=mod';\"><font color='#D13313' size=2><b>".ucfirst($zuname)."</b></font></a>";
        			}
				echo "</td><td align=center  valign='top'>";
					if ($ismyfriend[$zuid]!=1) {
        			echo "<a href=\"im.php?task=add&uid=$zuid\"><font size=1>Add</font></a>";
        			}else{
        			echo "<a href=\"im.php?task=remove&uid=$zuid\"><font size=1>Remove</font></a>";
        			}
				echo "</td><td align=center valign='top'><a href=\"javascript:IM('".XOOPS_URL."/pmlite.php?send2=1&to_userid=$zuid','pmlite',450,370);\">
<img src=\"".XOOPS_URL."/images/icons/pm_small.gif\" border=\"0\" width=\"27\" height=\"17\" alt=\"\" /></a></td></tr>";
				}
			echo "</table>";
			echo "<br /><center>";
				if (!isset($let_in)) {
				echo _MF_MEMBERS." ".$aff_inf." ". _MF_TO." ".$aff_sup."<br /><br />";
				echo $prevlink.$nextlink;
					if ($numpage>2 && $numpage<20) {
					echo "<br />"._MF_PAGES." ";
					echo $pagesLinks;
					}
				if ($numpage>20) {
				echo "";
				}
			}
		echo "</center>";
		}

function displayFriendsList($beg_in) {
	global $xoopsTpl, $xoopsConfig, $xoopsUser, $xoopsOption, $xoopsDB, $HTTP_COOKIE_VARS;
	xoops_header();
	$ModName = "Messenger";
	$myid =$xoopsUser->getVar("uid", "E");
	messageNotification();
	move();
	$isadmin = false;
	$zavatar=null;
	$zuid=null;
	$zuname=null;
	echo "<title>".$xoopsConfig['sitename']." - $ModName</title>
	<script language=\"javascript\">\nfunction IM(IM) { var MainWindow = window.open (IM, \"_blank\",\"width=450,height=370,toolbar=no,location=no,menubar=no,scrollbars=no,resizeable=no,status=no\");}\n</script>
	</head><body onload=setInterval('self.location.reload()',20000)>";
	echo "<center><table class='outer'><tr class='odd'><td align='center'>";
	echo "<p class=normal><a href=im.php>"._WHOISONLINE."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
	echo "<a href=im.php?task=friends>"._MF_TITLE."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
	echo "<a href=im.php?task=mod>"._LIST."</a></font></td></tr></table>";

	$s4="SELECT Count(*) FROM ".$xoopsDB->prefix("xim")." WHERE uid1=$myid OR uid2=$myid AND blocked= '0' AND approved = '1'";
	$r4 = $xoopsDB->query($s4);
		while (list($rep) = $xoopsDB->fetchRow($r4)) {
        $numfriends = $rep;
        }
    echo "<table cellspacing=\"1\" class=\"outer\"><tr><th colspan=\"4\">
		<font size=2>"._MF_FRIENDSLIST_HAVE."<b>$numfriends</b>"._MF_FRIENDSLIST_ACTUAL."</font></th></tr>";
	$r2=$xoopsDB->query("SELECT ref FROM ".$xoopsDB->prefix("xim")." WHERE uid1=$myid OR uid2=$myid AND blocked= '0' AND approved = '1'");
	while($fa = $xoopsDB->fetchRow($r2)) {
		foreach($fa as $k => $v){	
		$s3=$xoopsDB->query("SELECT uid1, uid2 FROM ".$xoopsDB->prefix("xim")." WHERE ref=$v");
		$ui = $xoopsDB->fetchArray($s3);
		foreach($ui as $k1 => $v1){	
			if($v1!=$myid){
			$fid=$v1;	
			}
		}
		$userinfo = new XoopsUser($fid);
   		$zuid=$userinfo->uid();
    	$zuname=$userinfo->uname();
    	$zavatar=$userinfo->user_avatar();
    	echo "<tr class='odd'><td width=\"110px;\" align='center' valign='top'>";
		echo "<img src=\"".$xoopsConfig['xoops_url']."/uploads/".$zavatar."\" name=\"avatar\" id=\"avatar\" width=\"100\" height=\"100\"'>";
		echo "</td><td width=\"150px;\"align=center valign='top'>";
		echo "<a href=\"javascript:window.opener.location='".XOOPS_URL."/userinfo.php?uid=$zuid';javascript:window.location='im.php?task=friends';\"><font size=2>".ucfirst($zuname)."</font></a>";
		echo "</td><td width=\"150px;\" align=center valign='top'>";
		echo "<a href='javascript:IM(\"".$xoopsConfig['xoops_url']."/pmlite.php?send2=1&amp;to_userid=".$zuid."\",\"pmlite\",450,370);'><img src=\"".XOOPS_URL."/images/icons/pm_small.gif\" border=\"0\" width=\"27\" height=\"17\" alt=\"\" /> PM User</a>";
		echo "<br /><a href=\"im.php?task=remove&uid=$zuid\"><img src=\"images/red_x.gif\" />Remove</a>";
		echo "<br /><a href=\"im.php?task=send&fid=$online_uid\"><img src=\"images/download.gif\" /> Send File</a></td></tr>";
		}
}
		echo "</table>";
		echo "<br>";
		echo "</center>";
		xoops_footer();
}

function imread($msg_id) {
	global $ModName, $xoopsConfig, $xoopsDB, $xoopsUser;
	$myid =$xoopsUser->getVar("uid", "E");
	$sql = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("priv_msgs")." WHERE msg_id=$msg_id AND to_userid='$myid' AND read_msg='0'");
	$priv_msg = $xoopsDB->fetchArray($sql);
	$from_userid = $priv_msg[from_userid];
	$fromuser = $xoopsDB->query("select uname from ".$xoopsDB->prefix("users")." where uid = '$from_userid'");
	$fname = $xoopsDB->fetchArray($fromuser);
	$from_user = $fname[uname];
	$subject = stripslashes($priv_msg[subject]);
	$msg_image = stripslashes($priv_msg[msg_image]);
	$message = stripslashes($priv_msg[msg_text]);
	$msgtime = formatTimestamp($priv_msg['msg_time']);
	mysql_query("UPDATE ".$xoopsDB->prefix("priv_msgs")." SET read_msg='1' WHERE msg_id='$priv_msg[msg_id]'");
	echo "<title>"._INCOMINGFROM." $from_user !</title>\n";
	move();
	echo "</head>\n";
	echo "<body LEFTMARGIN=3 MARGINWIDTH=3 TOPMARGIN=3 MARGINHEIGHT=3>";
	echo "<embed src=\"".XOOPS_URL."/modules/xim/newmessage.wav\" autostart=\"true\" hidden=\"true\" loop=\"false\"><table width=100% cellspacing=1 cellpadding=3 class='outer'><tr><td>";
	$result = $xoopsDB->query("SELECT uid, user_avatar FROM ".$xoopsDB->prefix("users")." WHERE uname='$from_user'");
	$result2  = $xoopsDB->fetchArray($result);
	echo "<tr><th colspan='2' align='left'><font size=2>"._INCOMINGFROM." $from_user</font></td></tr><tr class='odd'><td valign='top' align='center'>";
	echo "<img src=\"".XOOPS_URL."/uploads/$result2[user_avatar]\" alt=\"\"/>";
	echo "</td><td><img src='".XOOPS_URL."/images/subject/$msg_image' alt='' />&nbsp;<font size=2>"._SENTAT." $msgtime</font>";
	echo "<hr /><b><font size=2>$subject</font></b><br /><br /><font size=2>\n";
	$myts =& MyTextSanitizer::getInstance();
	$message = $myts->makeTboxData4Show($message);
	echo "$message";
	echo "</font><br /><br /></td></tr></table><br>";
	echo "<FORM METHOD=POST task=\"im.php\" TARGET=_self>
	<input type=HIDDEN name=\"to\" value=\"$from_user\">
	<input type=HIDDEN name=\"subject\" value=\"$subject\">
	<input type=HIDDEN name=\"prev_msg\" value=\"".$priv_msg[msg_id]."\">";
	echo "<CENTER><TABLE WIDTH=100% BORDER=0>
    <TR>
    <TD COLSPAN=2 ALIGN=\"CENTER\">
	<SELECT NAME=\"task\">
	<OPTION VALUE=\"imcompose\"> "._REPLY."
	<OPTION VALUE=\"buddel\"> "._DELETEON."
	</SELECT>
	</TD>
    </TR>
    <TR>
    <TD VALIGN=\"TOP\"  ALIGN=\"CENTER\"><INPUT TYPE=\"submit\" VALUE=\""._CONTINU."\"></TD>
    <TD VALIGN=\"TOP\"  ALIGN=\"CENTER\"></FORM></TD>
    </TR>
	</TABLE></CENTER>
	</body>
	</html>";
	exit;
}

function complainFriend($fid){

}

function blockFriend($fid){
	
}

function move() {
echo "<SCRIPT LANGUAGE=\"javascript\">
<!--
window.moveTo(10,10);
//-->
</SCRIPT>";
}

?>