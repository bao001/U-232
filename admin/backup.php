<?php
/**
 *   http://btdev.net:1337/svn/test/Installer09_Beta
 *   Licence Info: GPL
 *   Copyright (C) 2010 BTDev Installer v.1
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless,putyn.
 **/
/**
* Updated Database Backup Manager for TBDEV.NET 09
*/
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

$lang = array_merge( $lang );

/* add your ids and uncomment this check*/
$allowed_ids = array(1);
if (!in_array($CURUSER['id'], $allowed_ids))
    stderr('Error', 'Access Denied!');
   
$HTMLOUT ='';
/**
* Configs Start
*/
	/**
	* Change to the class allowed to access this page, use an array for more classes
	*
	* example: $required_class = array(UC_SYSOP, UC_ADMINISTRATOR);
	*/
	$required_class = UC_SYSOP;
	/**
	* Set to true to compress the backed up database using gzip
	*/
	$use_gzip = true;
	/**
	* Set's the document root, change only if you know what you are doing
	*/
	$ROOT = $_SERVER['DOCUMENT_ROOT'].'/';
	/**
	* The path to the gzip.exe file, no begining slash
	*/
	$gzip_path = $ROOT.'include/gzip/gzip.exe';
	/**
	* The path to your backup folder, no begining/ending slash
	*
	* example: $backupdir = $ROOT.'include/backups';
	*/
	$backupdir = $ROOT.'include/backup';
	/**
	* The path to the mysqldump file, used to backup the databases
	*/
	$mysqldump_path = 'c:/AppServ/mysql/bin/mysqldump';
	//$mysqldump_path = '/usr/bin/mysqldump';  //==Linux
	/**
	* Set to true, to be redirected to the download page after backup
	*/
	$autodl = true;
	/**
	* Set to true, to automatically delete de file after download
	*/
	$autodel = true;
	/**
	* Set to false if you don't want to write the actions to the log
	*/
	$write2log = true;
  /**
   * Configs End
   */
   
if (is_array($required_class))
{
if (!in_array($CURUSER['class'], $required_class))
stderr("Error", "Access denied!");
}
else
{
if ($CURUSER['class'] <> $required_class)
stderr("Error", "Access denied!");
}

$mode = (isset($_GET['mode']) ? $_GET['mode'] : (isset($_POST['mode']) ? $_POST['mode'] : ''));

if (empty($mode))
{
$HTMLOUT.="<script type='text/javascript'>
	/*<![CDATA[*/
	var checkflag = 'false';
	var marked_row = new Array;
	
	function check(field)
	{
		if (checkflag == 'false')
		{
			for (i = 0; i < field.length; i++)
				field[i].checked = true;
			
			checkflag = 'true';
			
			return 'Un-Check All';
		}
		else
		{
			for (i = 0; i < field.length; i++)
				field[i].checked = false;
			
			checkflag = 'false';
			
			return 'Check All';
		}
	};
	/*]]>*/
	</script>";
 
 $HTMLOUT .= begin_main_frame();
 $HTMLOUT.="<br /><h1 align='center'>Welcome {$CURUSER['username']} to the Database Backup Manager.<br />
 Click<a href='{$TBDEV['baseurl']}/admin.php?action=backup&amp;mode=backup'><b>&nbsp;Here&nbsp;</b></a>to backup now.<br />
 Click<a href='{$TBDEV['baseurl']}/admin.php?action=backup&amp;mode=check'><b>&nbsp;Here&nbsp;</b></a>to check config.</h1>";
 
 $HTMLOUT.="<br /><h1 align='center'></h1>";
 
 $res = mysql_query('SELECT db.id, db.name, db.added, u.id AS uid, u.username '.
					   'FROM dbbackup AS db '.
					   'LEFT JOIN users AS u ON u.id = db.userid '.
					   'ORDER BY db.added DESC') or sqlerr(__FILE__, __LINE__);
	if (mysql_num_rows($res) > 0)
	{
	$HTMLOUT.="<form method='post' action='admin.php?action=backup&amp;mode=delete'>
    <input type='hidden' name='action' value='delete' />
    <table align='center' cellpadding='5' width='75%'>
		<tr>
		<td class='colhead' width='100%'>Name</td>
		<td class='colhead' align='center'>Added on</td>
    <td class='colhead' style='white-space:nowrap;'>Added by</td>
		<td class='colhead' align='center'><input style='margin:0' type='checkbox' title='Mark All' onclick=\"this.value=check(form);\" /></td>
		</tr>";
		while ($arr = mysql_fetch_assoc($res))
		{
		$HTMLOUT.="<tr>
			<td><a href='admin.php?action=backup&amp;mode=download&amp;id=".(int)$arr['id']."'>".htmlspecialchars($arr['name'])."</a></td>
			<td style='white-space:nowrap;'>".get_date($arr['added'], 'DATE',1,0)."</td>
      <td align='center'>";
			if (!empty($arr['username']))
			{
			$HTMLOUT.="<a href='{$TBDEV['baseurl']}/userdetails.php?id=".(int)$arr['uid']."'>".$arr['username']."</a>";
			}
			else
			{
			$HTMLOUT.="unknown[".(int)$arr['uid']."]";
			}
			$HTMLOUT.="</td>
			<td><input type='checkbox' style='margin:0' name='ids[]' title='Mark' value='".(int)$arr['id']."' /></td>
			</tr>";
		  }
		 $HTMLOUT.="<tr>
     <td colspan='4' align='center'>
     <input type='button' value='Check All' onclick=\"this.value=check(form);\" />
     <input type='submit' value='Delete Selected' onclick=\"return confirm('Are you sure you want to delete the selected backups?');\" />
		 </td></tr></table></form>";
	   }
	   else
	   {
		 $HTMLOUT.= begin_frame();
		 $HTMLOUT.="<h2 align='center'>Nothing Found</h2>";
		 $HTMLOUT.= end_frame();
	   }
	   $HTMLOUT.="<br />";
     stdmsg("Options", "<div align='center'><a href='admin.php?action=backup&amp;mode=backup'>Database Backup</a>&nbsp;&nbsp;-&nbsp;&nbsp;<a href='admin.php?action=backup&mode=check'>Settings Check</a></div>");
	
	   if (!empty($_GET))
		 $HTMLOUT.="<br />";
	
	if (isset($_GET['backedup']))
		stdmsg("Success", "Database backed up.");
	else if (isset($_GET['deleted']))
		stdmsg("Success", "Backup(s) Deleted.");
	else if (isset($_GET['noselection']))
		stdmsg("Error", "Please select a backup to delete.");
	
	$HTMLOUT.= end_main_frame(); 
	print stdhead('DataBase Backup Manager') . $HTMLOUT . stdfoot();
}

else if ($mode == "backup")
{
  global $TBDEV;
	$mysql_host = $TBDEV['mysql_host'];
	$mysql_user = $TBDEV['mysql_user'];
	$mysql_pass = $TBDEV['mysql_pass'];
	$mysql_db = $TBDEV['mysql_db'];
	
	$ext = $mysql_db.'-'.date('d').'-'.date('m').'-'.date('Y').'_'.date('H').'-'.date('i').'-'.date('s').'_'.date('D').".sql";
	
	$filepath = $backupdir.'/'.$ext;
	
	exec("$mysqldump_path --default-character-set=latin1 -h $mysql_host -u $mysql_user -p$mysql_pass $mysql_db > $filepath");
	if ($use_gzip)
		exec($gzip_path.' '.$filepath);
	
	mysql_query("INSERT INTO dbbackup (name, added, userid) VALUES (".sqlesc($ext.($use_gzip ? '.gz' : '')).", ".sqlesc(time()).", ".sqlesc($CURUSER['id']).")") or sqlerr(__FILE__, __LINE__);
	
	$location = 'action=backup';
	
	if ($autodl)
	{
		$id = mysql_insert_id();
		
		$location = 'action=backup&mode=download&id='.$id;
	}
	
	if ($write2log)
		write_log($CURUSER['username'].'('.get_user_class_name($CURUSER['class']).') successfully backed-up the database.');
	
	header("Location: admin.php?".$location);
}
else if ($mode == "download")
{
	$id = (isset($_GET['id']) ? (int)$_GET['id'] : 0);
	if (!is_valid_id($id))
		stderr('Error', 'Invalid ID!');
	
	$res = mysql_query("SELECT name FROM dbbackup WHERE id = ".sqlesc($id)) or sqlerr(__FILE__, __LINE__);
	$arr = mysql_fetch_assoc($res);
	
	$filename = $backupdir.'/'.$arr['name'];
	
	if (!is_file($filename))
		stderr('Error', 'Inexistent filename.');
	
	$file_extension = strtolower(substr(strrchr($filename,"."), 1));
	switch ($file_extension)
	{
		case "sql":
			$ctype = "application/sql";
		break;
		
		case "sql.gz":
		case "gz":
			$ctype = "application/x-gzip";
		break;
	
		default:
			$ctype = "application/force-download";
	}
	
	if ($write2log)
		write_log($CURUSER['username'].'('.get_user_class_name($CURUSER['class']).') downloaded a database('.$arr['name'].').');
	
	header('Refresh: 0; url=admin.php'.($autodl && !$autodel ? '' : '?action=backup&mode=delete&id='.$id));

	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private", false);
	header("Content-Type: $ctype");
	header("Content-Disposition: attachment; filename=\"".basename($filename)."\";");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($filename));
	
	readfile($filename);
}
else if ($mode == 'delete')
{
	$ids = (isset($_POST["ids"]) ? $_POST["ids"] : (isset($_GET['id']) ? array($_GET['id']) : array()));
	if (!empty($ids))
	{
		foreach ($ids as $id)
			if (!is_valid_id($id))
				stderr('Error', 'Invalid ID!');
		
		$res = mysql_query("SELECT name FROM dbbackup WHERE id IN (".implode(', ', $ids).")") or sqlerr(__FILE__, __LINE__);
		$count = mysql_num_rows($res);
		
		if ($count > 0)
		{
			while ($arr = mysql_fetch_assoc($res))
			{
				$filename = $backupdir.'/'.$arr['name'];
				
				if (is_file($filename))
					unlink($filename);
			}
		
			mysql_query('DELETE FROM dbbackup WHERE id IN ('.implode(', ', $ids).')') or sqlerr(__FILE__, __LINE__);
			
			if ($write2log)
				write_log($CURUSER['username'].'('.get_user_class_name($CURUSER['class']).') successfully deleted '.$count.' database'.($count > 1 ? 's' : '').'.');
			
			$location = 'backup';
		}
		else
			$location = 'noselection';
	}
	else
		$location = 'noselection';
	
	header('Location:admin.php?action='.$location);
}
else if ($mode == "check")
{
	$HTMLOUT.= begin_main_frame();
	$HTMLOUT.="<table align='center' cellpadding='5' width='55%'>
	 <tr>
   <td class='colhead' colspan='2'>Settings Check(<a href='admin.php?action=backup'>Go back</a>)</td>
	 </tr>
	 <tr>
   <td>Use gzip compression<br /><font class='small'>Optional</font></td>
   <td width='1%' align='center'><b>". ($use_gzip ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
	 </tr>
   <tr>
   <td>Correct path to gzip<br /><font class='small'>".$gzip_path."</font></td>
   <td width='1%' align='center'><b>". (is_file($gzip_path) ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
   </tr>
   <tr>
   <td>Correct path to backup folder<br /><font class='small'>".$backupdir."</font></td>
   <td width='1%' align='center'><b>". (is_dir($backupdir) ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
	 </tr>
   <tr>
   <td>Readable backup folder</td>
   <td width='1%' align='center'><b>". (is_readable($backupdir) ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
	 </tr>
   <tr>
   <td>Writable backup folder</td>
   <td width='1%' align='center'><b>". (is_writable($backupdir) ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
	 </tr>
   <tr>
   <td>Correct path to the mysqldump file<br /><font class='small'>".$mysqldump_path."</font></td>
   <td width='1%' align='center'><b>". (preg_match('/mysqldump/i', exec($mysqldump_path)) ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
	 </tr>
   <tr>
   <td>Automatically download file after backup</td>
   <td width='1%' align='center'><b>". ($autodl ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
	 </tr>
   <tr>
   <td>Automatically delete backup after download</td>
   <td width='1%' align='center'><b>". ($autodel ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
	 </tr>
   <tr>
   <td>Write actions to log(backup/download/delete)</td>
   <td width='1%' align='center'><b>". ($write2log ? "<font color='green'>Yes</font>" : "<font color='red'>No</font>")."</b></td>
	 </tr></table>";
	 $HTMLOUT.= end_main_frame();
	 print stdhead('Backup Manager Config Checker') . $HTMLOUT . stdfoot();
}
else
stderr('Sorry', 'Unknown action!');
?>