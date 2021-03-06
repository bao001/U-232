<?php
/**
 *   http://btdev.net:1337/svn/test/Installer09_Beta
 *   Licence Info: GPL
 *   Copyright (C) 2010 BTDev Installer v.1
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless,putyn.
 **/
/*+----------------------------------------------------+*/
/*| made by putyn @ tbdev 31/05/2009 updated 30/09/2009|*/
/*+----------------------------------------------------+*/
if ( ! defined( 'IN_TBDEV_ADMIN' ) )
{
	$HTMLOUT='';
	$HTMLOUT .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
		\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<title>Error!</title>
		</head>
		<body>
	<div style='font-size:33px;color:white;background-color:red;text-align:center;'>Incorrect access<br />You cannot access this file directly.</div>
	</body></html>";
	print $HTMLOUT;
	exit();
}

require_once(INCL_DIR.'user_functions.php');
require_once(INCL_DIR.'html_functions.php');
/** new way **/
if (!min_class(UC_ADMINISTRATOR)) // or just simply: if (!min_class(UC_STAFF))
header( "Location: {$TBDEV['baseurl']}/index.php");

	
	//dont forget to edit this 
	$maxclass = UC_SYSOP;
	$firstclass = UC_USER;
	$use_subject = true;
	
	$lang = array_merge( $lang, load_language('inviteadd') );
	function mkpositive($n)
	{
		return strstr((string)$n,"-") ? 0 : $n ; // this will return 0 for negative numbers 
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$classes = isset($_POST["classes"]) ? $_POST["classes"] : '';
		
		$all = (is_array($classes) && $classes[0] == 255 ? true : false );
		
		if(empty($classes) || sizeof($classes) == 0 )
			stderr($lang['inviteadd_error'],$lang['inviteadd_noclass']);
		$a_do = array("add","remove","remove_all");
		$do = isset($_POST["do"]) && in_array($_POST["do"],$a_do) ? $_POST["do"] : "";
		if(empty($do))
			stderr($lang['inviteadd_error'],sprintf($lang['inviteadd_aunknown'],str_replace('_',' ',join(',',$a_do))));
			
		$invites = isset($_POST["invites"]) ? 0+$_POST["invites"] : 0;
		if($invites == 0 && ($do == "add" || $do == "remove"))
			stderr($lang['inviteadd_error'],$lang['inviteadd_error2']);
			
		$sendpm = isset($_POST["pm"]) && $_POST["pm"] == "yes" ? true : false;
		
		$pms = array();
		$users = array();
		//select the users
		$q1 = mysql_query("SELECT id,invites,username FROM users ".($all ? "" : "WHERE class in (".join(",",$classes).")" )." ORDER BY id desc ") or sqlerr(__FILE__, __LINE__);
		if(mysql_num_rows($q1) == 0)
		stderr($lang['inviteadd_error'],"");
			while($a = mysql_fetch_assoc($q1))
			{
				$users[] = "(".$a["id"].", ".($do == "remove_all" ? 0 : ($do == "add" ? $a["invites"] + $invites : mkpositive($a["invites"] - $invites))) .")";
				if($sendpm)
				{
					$subject = sqlesc($do == "remove_all" || $do == "remove" ?  $lang['inviteadd_subject_r'] : $lang['inviteadd_subject_a']);
					switch($do) {
						case 'remove_all' : $body = sprintf($lang['inviteadd_body_removeall'],$a['username'],$TBDEV['site_name']);
					break;
						case 'remove' : $body = sprintf($lang['inviteadd_body_remove'],$a['username'],$invites, ($invites > 1 ? 's' : ''),$TBDEV['site_name']);
					break;
						case 'add' : $body = sprintf($lang['inviteadd_body_add'],$a['username'],$invites, ($invites > 1 ? 's' : ''),$TBDEV['site_name']);
					break;
					}
					$pms[] = "(0,".$a['id'].",".sqlesc(time()).",".sqlesc($body)." ".($use_subject ? ",$subject" : "").")" ;
				}
			}
			
			if(sizeof($users) > 0)
				$r = mysql_query("INSERT INTO users(id,invites) VALUES ".join(",",$users)." ON DUPLICATE key UPDATE invites=values(invites) ") or sqlerr(__FILE__, __LINE__);
			if(sizeof($pms) > 0)
				$r1 = mysql_query("INSERT INTO messages (sender, receiver, added, msg ".($use_subject ? ", subject" : "").") VALUES ".join(",",$pms)." ") or sqlerr(__FILE__, __LINE__);
				
			if($r && ($sendpm ? $r1 : true))
			{
				header("Refresh: 2; url=\"admin.php?action=inviteadd\"");
				stderr($lang['inviteadd_success'],$lang['inviteadd_done']);
			}
			else
				stderr($lang['inviteadd_error'],$lang['inviteadd_wrong']);
	}
	$HTMLOUT ='';
	$HTMLOUT .= "<form action=\"admin.php?action=inviteadd\" method=\"post\">
	<table width=\"500\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\" align=\"center\">
	  <tr>
		<td valign=\"top\" align=\"right\">{$lang['inviteadd_classes']}</td>
		<td width=\"100%\" align=\"left\" colspan=\"3\">";
				$HTMLOUT .= "<label for=\"all\"><input type=\"checkbox\" name=\"classes[]\" value=\"255\" id=\"all\" />{$lang['inviteadd_allclasses']}</label><br/>\n";
				for($i=$firstclass;$i<$maxclass+1; $i++ )
				$HTMLOUT .= "<label for=\"c$i\"><input type=\"checkbox\" name=\"classes[]\" value=\"$i\" id=\"c$i\" />".get_user_class_name($i)." </label><br/>\n";
	$HTMLOUT .= "</td>
	  </tr>
	  <tr>
		<td valign=\"top\" align=\"center\" >{$lang['inviteadd_options']}</td>
		<td valign=\"top\">{$lang['inviteadd_action']}
		  <select name=\"do\" >
			<option value=\"add\">{$lang['inviteadd_badd']}</option>
			<option value=\"remove\">{$lang['inviteadd_bremove']}</option>
			<option value=\"remove_all\">{$lang['inviteadd_ball']}</option>
		  </select></td>
		<td>Invites <input type=\"text\" maxlength=\"2\" name=\"invites\" size=\"5\" />
		</td>
		<td >{$lang['inviteadd_sendpm']}<select name=\"pm\" ><option value=\"no\">{$lang['inviteadd_no']}</option><option value=\"yes\">{$lang['inviteadd_yes']}</option></select></td></tr>
		<tr><td colspan=\"4\" align=\"center\"><input type=\"submit\" value=\"{$lang['inviteadd_do']}\" /></td></tr>
	</table>
	</form>";
	
	print(stdhead($lang['inviteadd_stdhead']).begin_frame().$HTMLOUT.end_frame().stdfoot());
?>
