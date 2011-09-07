<?php
/**
 *   http://btdev.net:1337/svn/test/Installer09_Beta
 *   Licence Info: GPL
 *   Copyright (C) 2010 BTDev Installer v.1
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless,putyn.
 **/
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'bittorrent.php');
    require_once(INCL_DIR.'user_functions.php');
    require_once(INCL_DIR.'pager_functions.php');
    require_once(INCL_DIR.'html_functions.php');


    dbconn(false);
    loggedinorreturn();
	
	$lang = array_merge(load_language('global'), load_language('contactstaff'));
	
	if($_SERVER['REQUEST_METHOD']  == 'POST') {
	
		$msg = isset($_POST['msg']) ? $_POST['msg'] : '';
		$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
		$returnto = isset($_POST['returnto']) ? $_POST['returnto'] : $_SERVER['PHP_SELF'];

		if (empty($msg))
			stderr($lang['contactstaff_error'],$lang['contactstaff_no_msg']);

		if (empty($subject))
			stderr($lang['contactstaff_error'],$lang['contactstaff_no_sub']);

		if(sql_query('INSERT INTO staffmessages (sender, added, msg, subject) VALUES('.$CURUSER['id'].', '.time().', '.sqlesc($msg).', '.sqlesc($subject).')')) {
			header('Refresh: 3; url='.urldecode($returnto)); //redirect but wait 3 seconds
			stderr($lang['contactstaff_success'],$lang['contactstaff_success_msg']);
		} else
			stderr($lang['contactstaff_error'],sprintf($lang['contactstaff_mysql_err'],mysql_error()));
	} else  {
   
    $HTMLOUT  ="<form method='post' name='message' action='".$_SERVER['PHP_SELF']."'>
				 <table class='main' width='450' border='0' cellspacing='0' cellpadding='2'>
				  <tr><td align='center' colspan='2'>
					<h1>{$lang['contactstaff_title']}</h1>
					<p class='small'>{$lang['contactstaff_info']}</p>
				  </td></tr>
				  <tr><td align='right'>
					{$lang['contactstaff_subject']}
				  </td><td align='left'>
					<input type='text' size='50' name='subject' style='margin-left: 5px;' />
				  </td></tr>
		<tr><td align='center' colspan='2'>";
        if (isset($_GET['returnto']))
			$HTMLOUT .="<input type='hidden' name='returnto' value='".urlencode($_GET['returnto'])."' />";
        $HTMLOUT .="<textarea name='msg' cols='80' rows='15'></textarea>
                       </td>
                     </tr>
                    <tr><td align='center' colspan='2'><input type='submit' value='{$lang['contactstaff_sendit']}' class='btn' /></td></tr>
                    </table>
        </form>";

    print stdhead($lang['contactstaff_header']).$HTMLOUT . stdfoot();
	}
?>