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
require_once(INCL_DIR.'html_functions.php');
dbconn(false);
loggedinorreturn();
parked();
/*********************************************************************
09 Seedbonus - Credits to Sir_Snugglebunny also the original coders
Updated for 09 - Nov 28th 2009
**********************************************************************/
$lang = array_merge( load_language('global'), load_language('mybonus') );

$HTMLOUT ='';

function I_smell_a_rat($var){
 if ((0 + $var) == 1)
 	$var = 0 + $var;
 else
 	stderr("Error", "I smell a rat!");
}

$bonus = htmlspecialchars($CURUSER['seedbonus'], 1);

/////////freeleech
if (isset($_GET["freeleech_success"]) && $_GET["freeleech_success"]){
$freeleech_success = 0 + $_GET["freeleech_success"];
if($freeleech_success != '1' && $freeleech_success != '2')
stderr("Error", "I smell a rat on freeleech!");
if($freeleech_success == '1'){

if ($_GET["norefund"] != '0') {
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}/smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>
$CURUSER[username] you have set the tracker <b>Free Leech !</b> <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='W00t' /><br /><br />Remaining ".htmlspecialchars($_GET['norefund'])." points have been contributed towards the next freeleech period automatically!".
"<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
} else {
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>
$CURUSER[username] you have set the tracker <b>Free Leech !</b> <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='W00t' /><br />".
"<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
}

die;
}
if($freeleech_success == '2'){
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>".
"$CURUSER[username] you have contributed towards making the tracker Free Leech ! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='W00t' /><br />".
"<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;
}
}
////////doubleup
if (isset($_GET["doubleup_success"]) && $_GET["doubleup_success"]){
$doubleup_success = 0 + $_GET["doubleup_success"];
if($doubleup_success != '1' && $doubleup_success != '2')
stderr("Error", "I smell a rat on freeleech!");
if($doubleup_success == '1'){

if ($_GET["norefund"] != '0') {
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>
$CURUSER[username] you have set the tracker <b>Double Up !</b> <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='W00t' /><br /><br />Remaining ".htmlspecialchars($_GET['norefund'])." points have been contributed towards the next Double upload period automatically!".
"<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
} else {
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>
$CURUSER[username] you have set the tracker <b>Double Up !</b> <img src={$TBDEV['pic_base_url']}smilies/w00t.gif alt='w00t' title='W00t' /><br />".
"<b /r> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
}

die;
}
if($doubleup_success == '2'){
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>".
"$CURUSER[username] you have contributed towards making the tracker Double Upload ! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='W00t' /><br />".
"<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;
}
}
/////////Halfdownload
if (isset($_GET["halfdown_success"]) && $_GET["halfdown_success"]){
$halfdown_success = 0 + $_GET["halfdown_success"];
if($halfdown_success != '1' && $halfdown_success != '2')
stderr("Error", "I smell a rat on halfdownload!");
if($halfdown_success == '1'){

if ($_GET["norefund"] != '0') {
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>
$CURUSER[username] you have set the tracker <b>Half Download !</b> <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='W00t' /><br /><br />Remaining ".htmlspecialchars($_GET['norefund'])." points have been contributed towards the next Half download period automatically!".
"<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
} else {
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>
$CURUSER[username] you have set the tracker <b>Half Download !</b> <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='W00t' /><br />".
"<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
}

die;
}
if($halfdown_success == '2'){
$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b>".
"$CURUSER[username] you have contributed towards making the tracker Half Download ! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='W00t' /><br />".
"<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />".
"</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;
}
}
//////////

switch (true){
case (isset($_GET['up_success'])):
I_smell_a_rat($_GET['up_success']);

$amt = (int)$_GET['amt'];

switch ($amt) {
case $amt == 275.0:
$amt = '1 GB';
break;
case $amt == 350.0:
$amt = '2.5 GB';
break;
case $amt == 550.0:
$amt = '5 GB';
break;
case $amt == 1000.0:
$amt = '10 GB';
break;
case $amt == 2000.0:
$amt = '25 GB';
break;
case $amt == 4000.0:
$amt = '50 GB';
break;
case $amt == 8000.0:
$amt = '100 GB';
break;
case $amt == 40000.0:
$amt = '520 GB';
break;
default:
$amt = '1 TB';
}

$HTMLOUT .= "<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>
<td class='clearalt6' align='left'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td>
<td class='clearalt6' align='left'><b>Congratulations ! </b>".$CURUSER['username']." you have just increased your upload amount by ".$amt."!
<img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br /><br /><br /><br /> click to go back to your 
<a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['anonymous_success'])):{
I_smell_a_rat($_GET['anonymous_success']);
}
$HTMLOUT .= "<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>
<td class='clearalt6' align='left'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td>
<td class='clearalt6' align='left'><b>Congratulations ! </b>".$CURUSER['username']." you have just purchased Anonymous profile for 14 days!
<img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br /><br /><br /><br /> click to go back to your 
<a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['freeyear_success'])):{
I_smell_a_rat($_GET['freeyear_success']);
}
$HTMLOUT .= "<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>
<td class='clearalt6' align='left'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td>
<td class='clearalt6' align='left'><b>Congratulations ! </b>".$CURUSER['username']." you have just purchased freeleech for one year!
<img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br /><br /><br /><br /> click to go back to your 
<a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['freeslots_success'])):{
I_smell_a_rat($_GET['freeslots_success']);
}

$HTMLOUT .= "<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>
<td class='clearalt6' align='left'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td>
<td class='clearalt6' align='left'><b>Congratulations ! </b>".$CURUSER['username']." you have got your self 3 freeleech slots!!
<img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br /><br /><br /><br /> click to go back to your 
<a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['itrade_success'])):{
I_smell_a_rat($_GET['itrade_success']);
}

$HTMLOUT .= "<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>
<td class='clearalt6' align='left'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td>
<td class='clearalt6' align='left'><b>Congratulations ! </b>".$CURUSER['username']." you have got your self 200 points !!
<img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br /><br /><br /><br /> click to go back to your 
<a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['itrade2_success'])):{
I_smell_a_rat($_GET['itrade2_success']);
}

$HTMLOUT .= "<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>
<td class='clearalt6' align='left'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td>
<td class='clearalt6' align='left'><b>Sorry ! </b>".$CURUSER['username']." you just got yourself 2 freeslots !!
<img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='W00t' title='W00t' /><br /><br /><br /><br /> click to go back to your 
<a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['pirate_success'])):{
I_smell_a_rat($_GET['pirate_success']);
} 
$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr>
<tr><td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/pirate2.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'>
<b>Congratulations! </b>".$CURUSER['username']." you have got yourself Pirate Status and Freeleech for two weeks! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br />
<br /> Click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Points</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['king_success'])):{
I_smell_a_rat($_GET['king_success']);
} 
$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr>
<tr><td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/king.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'>
<b>Congratulations! </b>".$CURUSER['username']." you have got yourself King Status and Freeleech for one month! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br />
<br /> Click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Points</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['dload_success']));{
I_smell_a_rat($_GET['dload_success']);
}

$amt = (int)$_GET['amt'];

switch ($amt) {
case $amt == 75.0:
    $amt = '1 GB';
    break;
case $amt == 150.0:
    $amt = '2.5 GB';
    break;
default:
    $amt = '5 GB';
}

$HTMLOUT .="<table width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>".
"<td class='clearalt6 align='left'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good Karma' /></td>".
"<td class='clearalt6' align='left'><b>Congratulations ! </b>".$CURUSER['username']." you have just decreased your download amount by ".$amt."!".
"<img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' /><br /><br /><br /><br /> click to go back to your ".
"<a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['class_success'])):
I_smell_a_rat($_GET['class_success']);
 
$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr>
<tr><td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'>
<b>Congratulations! </b>".$CURUSER['username']." you have got yourself VIP Status for one month! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br />
<br /> Click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Points</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['smile_success'])):
I_smell_a_rat($_GET['smile_success']);
 
$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr>
<tr><td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'>
<b>Congratulations! </b>".$CURUSER['username']." you have got yourself a set of custom smilies for one month! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br />
<br /> Click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Points</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['warning_success'])):
I_smell_a_rat($_GET['warning_success']);
 
$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr>
<tr><td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'>
<b>Congratulations! </b>".$CURUSER['username']." you have removed your warning for the low price of 1000 points!! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br />
<br /> Click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Points</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['invite_success'])):
I_smell_a_rat($_GET['invite_success']);
 
$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr><td align='left' class='clearalt6'>
<img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'>
<b>Congratulations! </b>".$CURUSER['username']." you have got your self 3 new invites! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br /><br />
click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;


case (isset($_GET['freeslots_success'])):
I_smell_a_rat($_GET['freeslots_success']);

$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr><td align='left' class='clearalt6'>
<img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'>
<b>Congratulations! </b>".$CURUSER['username']." you have got your self 3 freeleech slots! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br /><br />
click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['title_success'])):
I_smell_a_rat($_GET['title_success']);
 
$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>
<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'>
<b>Congratulations! </b>".$CURUSER['username']." you are now known as <b>".$CURUSER['title']."</b>! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br />
<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['ratio_success'])):
I_smell_a_rat($_GET['ratio_success']);

$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr>
<td align='left' class='clearalt6'><img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'><b>Congratulations! </b> ".$CURUSER['username']." you
have gained a 1 to 1 ratio on the selected torrent, and the difference in MB has been added to your total upload! <img src='{$TBDEV['pic_base_url']}smilies/w00t.gif' alt='w00t' title='w00t' /><br />
<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br />
</td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['gift_fail'])):
I_smell_a_rat($_GET['gift_fail']);

$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Huh?</h1></td></tr><tr><td align='left' class='clearalt6'>
<img src='{$TBDEV['pic_base_url']}smilies/cry.gif' alt='bad_karma' title='Bad karma' /></td><td align='left' class='clearalt6'><b>Not so fast there Mr. fancy pants!</b><br />
<b>".$CURUSER['username']."...</b> you can not spread the karma to yourself...<br />If you want to spread the love, pick another user! <br />
<br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;
case (isset($_GET['gift_fail_user'])):
I_smell_a_rat($_GET['gift_fail_user']);

$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Error</h1></td></tr><tr><td align='left' class='clearalt6'>
<img src='{$TBDEV['pic_base_url']}smilies/cry.gif' alt='bad_karma' title='Bad karma' /></td><td align='left' class='clearalt6'><b>Sorry ".$CURUSER['username']."...</b>
<br /> No User with that username <br /><br /> click to go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.
<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;
case (isset($_GET['gift_fail_points'])):
I_smell_a_rat($_GET['gift_fail_points']);

$HTMLOUT .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Oops!</h1></td></tr><tr><td align='left' class='clearalt6'>
<img src='{$TBDEV['pic_base_url']}smilies/cry.gif' alt='oups' title='Bad karma' /></td><td align='left' class='clearalt6'><b>Sorry </b>".$CURUSER['username']." you dont have enough Karma points
<br /> go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;

case (isset($_GET['gift_success'])): 
I_smell_a_rat($_GET['gift_success']);
 
$HTMLOUT  .="<table align='center' width='80%'><tr><td class='colhead' align='left' colspan='2'><h1>Success!</h1></td></tr><tr><td align='left' class='clearalt6'>
<img src='{$TBDEV['pic_base_url']}smilies/karma.gif' alt='good_karma' title='Good karma' /></td><td align='left' class='clearalt6'><b>Congratulations! ".$CURUSER['username']." </b>
you have spread the Karma well.<br /><br />Member <b>".htmlspecialchars($_GET['usernamegift'])."</b> will be pleased with your kindness!<br /><br />This is the message that was sent:<br />
<b>Subject:</b> Someone Loves you!<br /> <p>You have been given a gift of <b>".(0 + $_GET['gift_amount_points'])."</b> Karma points by ".$CURUSER['username']."</p><br />
You may also <a class='altlink' href='{$TBDEV['baseurl']}/sendmessage.php?receiver=".(0 + $_GET['gift_id'])."'>send ".htmlspecialchars($_GET['usernamegift'])." a message as well</a>, or go back to your <a class='altlink' href='mybonus.php'>Karma Bonus Point</a> page.<br /><br /></td></tr></table>";
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
die;
}

//=== exchange
if (isset($_GET['exchange'])){
I_smell_a_rat($_GET['exchange']);

$userid = 0 + $CURUSER['id'];
if (!is_valid_id($userid))
stderr("Error", "That is not your user ID!");

$option = 0 + $_POST['option'];

$res_points = sql_query("SELECT * FROM bonus WHERE id =" . sqlesc($option));
$arr_points = mysql_fetch_assoc($res_points);

$art = $arr_points['art'];
$points = $arr_points['points'];
$minpoints = $arr_points['minpoints'];

if ($points <= 0)
stderr("Error", "I smell a rat!");

$seedbonus=htmlspecialchars($bonus-$points,1);
$upload = $CURUSER['uploaded'];
$download = $CURUSER['downloaded'];
$bonuscomment = $CURUSER['bonuscomment'];
$free_switch = $CURUSER['free_switch'];
$warned = $CURUSER['warned'];

if($bonus < $minpoints)
stderr("Sorry", "you do not have enough Karma points!");

switch ($art){
case 'traffic':
//=== trade for one upload credit
$up = $upload + $arr_points['menge'];
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for upload bonus.\n " .$bonuscomment;
sql_query("UPDATE users SET uploaded = $upload + $arr_points[menge], seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?up_success=1&amt=$points");
die;
break;
 
case 'anonymous':
//=== trade for 14 days Anonymous profile
$anonymous_until = (86400 * 14 + time());
if ($CURUSER['anonymous_until'] >= 1)
stderr("Error", "Time shall unfold what plighted cunning hides\n\nWho cover faults, at last shame them derides.");
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for 14 days Anonymous profile.\n " .$bonuscomment;
sql_query("UPDATE users SET anonymous_until = '$anonymous_until', seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?anonymous_success=1");
die;
break;

case 'traffic2':
//=== trade for download credit
$down = $download - $arr_points['menge'];
if ($CURUSER['downloaded'] == 0)
stderr("Error", "Time shall unfold what plighted cunning hides\n\nWho cover faults, at last shame them derides.");
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for download credit removal.\n " .$bonuscomment;
sql_query("UPDATE users SET downloaded = $download - $arr_points[menge], seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?dload_success=1&amt=$points");
die;
break;

case 'freeyear':
//=== trade for years freeleech
$free_switch = (365 * 86400 + time());
if ($CURUSER['free_switch'] != 0)
stderr("Error", "Time shall unfold what plighted cunning hides\n\nWho cover faults, at last shame them derides.");
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for One year of freeleech.\n " .$bonuscomment;
sql_query("UPDATE users SET free_switch = $free_switch, seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?freeyear_success=1");
die;
break;

case 'freeslots':
//=== trade for freeslots
$freeslots = $CURUSER['freeslots'];
$slots = $freeslots+$arr_points['menge'];
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for freeslots.\n " .$bonuscomment;
sql_query("UPDATE users SET freeslots = '$slots', seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?freeslots_success=1");
die;
break;

case 'itrade':
//=== trade for points
$invites = $CURUSER['invites'];
$inv = $invites+$arr_points['menge'];
if ($CURUSER['invites'] == 0)
stderr("Error", "Time shall unfold what plighted cunning hides\n\nWho cover faults, at last shame them derides.");
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " invites for bonus points.\n" .$bonuscomment;
sql_query("UPDATE users SET invites = invites - 1, seedbonus = seedbonus + 200 WHERE id = '$userid' AND invites = '$invites +1'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?itrade_success=1");
die;
break;

case 'itrade2':
//=== trade for slots
$invites = $CURUSER['invites'];
$inv = $invites+$arr_points['menge'];
if ($CURUSER['invites'] == 0)
stderr("Error", "Time shall unfold what plighted cunning hides\n\nWho cover faults, at last shame them derides.");
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " invites for bonus points.\n" .$bonuscomment;
sql_query("UPDATE users SET invites = invites - 1, freeslots = freeslots + 2 WHERE id = '$userid' AND invites = '$invites +1'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?itrade2_success=1");
die;
break;

case 'pirate':
//=== trade for 2 weeks pirate status 
if ($CURUSER['pirate'] != 0 OR $CURUSER['king'] != 0)
stderr("Error", "Now why would you want to add what you already have?<br />go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page and think that one over.");
$pirate = (86400 * 14 + time());
$free_switch = (14 * 86400 + time());
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for 2 weeks Pirate + freeleech Status.\n " .$bonuscomment;
sql_query("UPDATE users SET free_switch = $free_switch, pirate = '$pirate', seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?pirate_success=1");
die;
break;

case 'king':
//=== trade for one month king status 
if ($CURUSER['king'] != 0 OR $CURUSER['pirate'] != 0)
stderr("Error", "Now why would you want to add what you already have?<br />go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page and think that one over.");
$king = (86400 * 30 + time());
$free_switch = (30 * 86400 + time());
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for 1 month King + freeleech Status.\n " .$bonuscomment;
sql_query("UPDATE users SET free_switch = $free_switch, king = '$king', seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?king_success=1");
die;
break;

//--- Freeleech
case 'freeleech':
$points2 = 59999; //== Adjust so that its you can only contribute 1 point under the the bonus option amount doubled - current 30000 x 2 = 60000 - 1 = 59999
$pointspool = $arr_points['pointspool'];
$points= htmlspecialchars($points,1);
$donation = 0 + $_POST['donate'];
$seedbonus = ($bonus - $donation);
if($bonus < $donation || $donation <= 0 ||$donation > $points2){
stderr("Error", " <br />Points: ".htmlspecialchars($donation)." <br /> Bonus: ".htmlspecialchars($bonus)." <br /> Donation: ".htmlspecialchars($donation)." <br />Time shall unfold what plighted cunning hides\n\nWho cover faults, at last shame them derides.<br /> Click to go back to your <a class='altlink' href='./mybonus.php'>Karma Bonus Point</a> page.<br />");
die;
}
if(($pointspool+$donation) >= $arr_points["points"] ){
$now = time();
$end = (86400 * 3 + time());
$message = "FreeLeech [ON]";
$sql = "INSERT INTO `events`(`userid`,`overlayText`, `startTime`, `endTime`, `displayDates`, `freeleechEnabled`) VALUES ('$userid', '$message', '$now', '$end', '1', '1');";
$norefund = ($donation + $pointspool) % $points;
sql_query($sql)or sqlerr(__FILE__, __LINE__);
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$donation. " Points contributed for freeleech.\n " .$bonuscomment;
sql_query("UPDATE users SET seedbonus = '$seedbonus',  bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
$sql2 = "UPDATE bonus SET pointspool = '$norefund' WHERE id = '11' LIMIT 1";
sql_query($sql2)or sqlerr(__FILE__, __LINE__);
write_bonus_log($CURUSER["id"], $donation, $type = "freeleech");
header("Refresh: 0; url={$TBDEV['baseurl']}//mybonus.php?freeleech_success=1&norefund=$norefund");
die;
} else {
// add to the pool
$sql = "UPDATE bonus SET pointspool = pointspool + '$donation' WHERE id = '11' LIMIT 1";
sql_query($sql)or sqlerr(__FILE__, __LINE__);
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$donation. " Points contributed for freeleech.\n " .$bonuscomment;
sql_query("UPDATE users SET seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
write_bonus_log($CURUSER["id"], $donation, $type = "freeleech");
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?freeleech_success=2");
die;
}
die;
break;

//--- doubleupload
case 'doubleup':
$points2 = 59999; //== Adjust so that its you can only contribute 1 point under the the bonus option amount doubled - current 30000 x 2 = 60000 - 1 = 59999
$pointspool = $arr_points['pointspool'];
$points= htmlspecialchars($points,1);
$donation = 0 + $_POST['donate'];
$seedbonus = ($bonus - $donation);
if($bonus < $donation || $donation <= 0 ||$donation > $points2){
stderr("Error", " <br />Points: ".htmlspecialchars($donation)." <br /> Bonus: ".htmlspecialchars($bonus)." <br /> Donation: ".htmlspecialchars($donation)." <br />Time shall unfold what plighted cunning hides\n\nWho cover faults, at last shame them derides.<br /> Click to go back to your <a class='altlink' href='./mybonus.php'>Karma Bonus Point</a> page.<br />");
die;
}
if(($pointspool+$donation) >= $arr_points["points"] ){
$now = time();
$end = (86400 * 3 + time());
$message = "DoubleUpload [ON]";
$sql = "INSERT INTO `events`(`userid`,`overlayText`, `startTime`, `endTime`, `displayDates`, `duploadEnabled`) VALUES ('$userid', '$message', '$now', '$end', '1', '1');";
$norefund = ($donation + $pointspool) % $points;
sql_query($sql)or sqlerr(__FILE__, __LINE__);
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$donation. " Points contributed for doubleupload.\n " .$bonuscomment;
sql_query("UPDATE users SET seedbonus = '$seedbonus',  bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
$sql2 = "UPDATE bonus SET pointspool = '$norefund' WHERE id = '12' LIMIT 1";
sql_query($sql2)or sqlerr(__FILE__, __LINE__);
write_bonus_log($CURUSER["id"], $donation, $type = "doubleupload");
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?doubleup_success=1&norefund=$norefund");
die;
} else {
// add to the pool
$sql = "UPDATE bonus SET pointspool = pointspool + '$donation' WHERE id = '12' LIMIT 1";
sql_query($sql)or sqlerr(__FILE__, __LINE__);
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$donation. " Points contributed for doubleupload.\n " .$bonuscomment;
sql_query("UPDATE users SET seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
write_bonus_log($CURUSER["id"], $donation, $type = "doubleupload");
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?doubleup_success=2");
die;
}
die;
break;

//---Halfdownload
case 'halfdown':
$points2 = 59999; //== Adjust so that its you can only contribute 1 point under the the bonus option amount doubled - current 30000 x 2 = 60000 - 1 = 59999
$pointspool = $arr_points['pointspool'];
$points= htmlspecialchars($points,1);
$donation = 0 + $_POST['donate'];
$seedbonus = ($bonus - $donation);
if($bonus < $donation || $donation <= 0 ||$donation > $points2){
stderr("Error", " <br />Points: ".htmlspecialchars($donation)." <br /> Bonus: ".htmlspecialchars($bonus)." <br /> Donation: ".htmlspecialchars($donation)." <br />Time shall unfold what plighted cunning hides\n\nWho cover faults, at last shame them derides.<br /> Click to go back to your <a class='altlink' href='./mybonus.php'>Karma Bonus Point</a> page.<br />");
die;
}
if(($pointspool+$donation) >= $arr_points["points"] ){
$now = time();
$end = (86400 * 3 + time());
$message = "HalfDownload [ON]";
$sql = "INSERT INTO `events`(`userid`,`overlayText`, `startTime`, `endTime`, `displayDates`, `hdownEnabled`) VALUES ('$userid', '$message', '$now', '$end', '1', '1');";
$norefund = ($donation + $pointspool) % $points;
sql_query($sql)or sqlerr(__FILE__, __LINE__);
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$donation. " Points contributed for Halfdownload.\n " .$bonuscomment;
sql_query("UPDATE users SET seedbonus = '$seedbonus',  bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
$sql2 = "UPDATE bonus SET pointspool = '$norefund' WHERE id = '13' LIMIT 1";
mysql_query($sql2)or sqlerr(__FILE__, __LINE__);
write_bonus_log($CURUSER["id"], $donation, $type = "halfdownload");
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?halfdown_success=1&norefund=$norefund");
die;
} else {
// add to the pool
$sql = "UPDATE bonus SET pointspool = pointspool + '$donation' WHERE id = '13' LIMIT 1";
sql_query($sql)or sqlerr(__FILE__, __LINE__);
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points contributed for halfdownload.\n " .$bonuscomment;
sql_query("UPDATE users SET seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
write_bonus_log($CURUSER["id"], $donation, $type = "halfdownload");
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?halfdown_success=2");
die;
}
die;
break;

case 'ratio':
//=== trade for one torrent 1:1 ratio
$torrent_number = 0 + $_POST['torrent_id'];
$res_snatched = sql_query("SELECT s.uploaded, s.downloaded, t.name FROM snatched AS s LEFT JOIN torrents AS t ON t.id = s.torrentid WHERE s.userid = '$userid' AND torrentid = ".sqlesc($torrent_number)." LIMIT 1") or sqlerr(__FILE__, __LINE__);
$arr_snatched = mysql_fetch_assoc($res_snatched);
if ($arr_snatched['name'] == '')
stderr("Error", "No torrent with that ID!<br />Back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.");
if ($arr_snatched['uploaded'] >= $arr_snatched['downloaded'])
stderr("Error", "Your ratio on that torrent is fine, you must have selected the wrong torrent ID.<br />Back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page.");
sql_query("UPDATE snatched SET uploaded = '$arr_snatched[downloaded]' WHERE userid = '$userid' AND torrentid = ".sqlesc($torrent_number)) or sqlerr(__FILE__, __LINE__);
$difference = $arr_snatched['downloaded'] - $arr_snatched['uploaded'];
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for 1 to 1 ratio on torrent: ".$arr_snatched['name']." ".$torrent_number.", ".$difference." added .\n " .$bonuscomment;
sql_query("UPDATE users SET uploaded = $upload + $difference, bonuscomment = '$bonuscomment', seedbonus = '$seedbonus' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?ratio_success=1");
die;
break;

case 'class':
//=== trade for one month VIP status 
if ($CURUSER['class'] > UC_VIP)
stderr("Error", "Now why would you want to lower yourself to VIP?<br />go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page and think that one over.");
$vip_until = (86400 * 28 + time());
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for 1 month VIP Status.\n " .$bonuscomment;
sql_query("UPDATE users SET class = ".UC_VIP.", vip_added = 'yes', vip_until = '$vip_until', seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?class_success=1");
die;
break;

case 'warning':
//=== trade for removal of warning :P
if ($CURUSER['warned'] == 0)
stderr("Error", "How can we remove a warning that isn't there?<br />go back to your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Point</a> page and think that one over.");
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for removing warning.\n " .$bonuscomment;
$res_warning = sql_query("SELECT modcomment FROM users WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
$arr = mysql_fetch_assoc($res_warning);
$modcomment = htmlspecialchars($arr['modcomment']);
$modcomment = get_date( time(), 'DATE', 1 ) . " - Warning removed by - Bribe with Karma.\n". $modcomment;
$modcom = sqlesc($modcomment);
sql_query("UPDATE users SET warned = '0', seedbonus = '$seedbonus', bonuscomment = '$bonuscomment', modcomment = $modcom WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
$dt = sqlesc(time());
$subject = sqlesc("Warning removed by Karma.");
$msg = sqlesc("Your warning has been removed by the big Karma payoff... Please keep on your best behaviour from now on.\n");
sql_query("INSERT INTO messages (sender, receiver, added, msg, subject) VALUES(0, $userid, $dt, $msg, $subject)") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?warning_success=1");
die;
break;

case 'smile':
//=== trade for one month special smilies :P
$smile_until = (86400 * 28 + time());
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for 1 month of custom smilies.\n " .$bonuscomment;
sql_query("UPDATE users SET smile_until = '$smile_until', seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?smile_success=1");
die;
break;

case 'invite':
//=== trade for invites
$invites = $CURUSER['invites'];
$inv = $invites+$arr_points['menge'];
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for invites.\n " .$bonuscomment;
sql_query("UPDATE users SET invites = '$inv', seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?invite_success=1");
die;
break;

case 'title':
//=== trade for special title
/**** the $words array are words that you DO NOT want the user to have... use to filter "bad words" & user class...
the user class is just for show, but what the hell :P Add more or edit to your liking.
*note if they try to use a restricted word, they will recieve the special title "I just wasted my karma" *****/
$title = strip_tags($_POST['title']);
$words = array('fuck', 'shit', 'Moderator', 'Administrator', 'Admin', 'pussy', 'Sysop', 'cunt', 'nigger', 'VIP', 'Super User', 'Power User', 'ADMIN', 'SYSOP', 'MODERATOR', 'ADMINISTRATOR');
$title = str_replace($words, "I just wasted my karma", $title);
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points for custom title. Old title was $CURUSER[title] new title is ".$title.".\n " .$bonuscomment;
sql_query("UPDATE users SET title = ".sqlesc($title).", seedbonus = ".sqlesc($seedbonus).", bonuscomment = ".sqlesc($bonuscomment)." WHERE id = ".sqlesc($userid)."") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?title_success=1");
die;
break;

case 'gift_1':
//=== trade for giving the gift of karma
$points = 0 + $_POST['bonusgift'];
$usernamegift = htmlentities(trim($_POST['username']));
$res = sql_query("SELECT id,seedbonus,bonuscomment,username FROM users WHERE username=" . sqlesc($usernamegift));
$arr = mysql_fetch_assoc($res);
$useridgift = $arr['id'];
$userseedbonus = $arr['seedbonus'];
$bonuscomment_gift = $arr['bonuscomment'];
$usernamegift = $arr['username'];

$check_me = array(100,200,300,400,500,1000,5000,10000,20000,50000,100000);
if (!in_array($points, $check_me))
stderr("Error", "I smell a rat!");

if($bonus >= $points){
$points= htmlspecialchars($points,1);
$bonuscomment = get_date( time(), 'DATE', 1 ) . " - " .$points. " Points as gift to $usernamegift .\n " .$bonuscomment;
$bonuscomment_gift = get_date( time(), 'DATE', 1 ) . " - recieved " .$points. " Points as gift from $CURUSER[username] .\n " .$bonuscomment_gift;
$seedbonus=$bonus-$points;
$giftbonus1=$userseedbonus+$points;
if ($userid==$useridgift){
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?gift_fail=1");
die;
}
if (!$useridgift){
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?gift_fail_user=1");
die;
}
sql_query("SELECT bonuscomment,id FROM users WHERE id = '$useridgift'") or sqlerr(__FILE__, __LINE__);
//=== and to post to the person who gets the gift!
sql_query("UPDATE users SET seedbonus = '$seedbonus', bonuscomment = '$bonuscomment' WHERE id = '$userid'") or sqlerr(__FILE__, __LINE__);
sql_query("UPDATE users SET seedbonus = '$giftbonus1', bonuscomment = '$bonuscomment_gift' WHERE id = '$useridgift'");
//===send message
$subject = sqlesc("Someone Loves you"); 
$added = sqlesc(time());
$msg = sqlesc("You have been given a gift of $points Karma points by ".$CURUSER['username']);
sql_query("INSERT INTO messages (sender, subject, receiver, msg, added) VALUES(0, $subject, $useridgift, $msg, $added)") or sqlerr(__FILE__, __LINE__);
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?gift_success=1&gift_amount_points=$points&usernamegift=$usernamegift&gift_id=$useridgift");
die;
}
else{
header("Refresh: 0; url={$TBDEV['baseurl']}/mybonus.php?gift_fail_points=1");
die;
}
break;
}
}

//==== This is the default page
$HTMLOUT .="<div class='roundedCorners' style='text-align:left;width:80%;border:1px solid black;padding:5px;'>
<div style='background:transparent;height:25px;'>
<span style='font-weight:bold;font-size:12pt;'> Karma Bonus Point's system :</span></div>";
//== 09 Ezeros freeleech contribution - Bigjoos.Ezero
$fpoints ="";
$dpoints ="";
$hpoints ="";
$freeleech_enabled ="";
$double_upload_enabled ="";
$half_down_enabled ="";
$top_donators ="";
$top_donators2 ="";
$top_donators3 ="";
// eZER0's mod for bonus contribution
// Limited this to 3 because of performance reasons and i wanted to go through last 3 events, anyway the most we can have
// is that halfdownload is enabled, double upload is enabled as well as freeleech !
function mysql_fetch_all($query, $default_value = Array())
{
    $r = @sql_query($query);
    $result = Array();
    if ($err = mysql_error())return $err;
    if (@mysql_num_rows($r))
        while ($row = mysql_fetch_array($r))$result[] = $row;
    if (count($result) == 0)
        return $default_value;
    return $result;
}

function write_bonus_log($userid, $amount, $type){
  $added = time();
  $donation_type = $type;
  sql_query("INSERT INTO bonuslog (id, donation, type, added_at) VALUES('$userid', '$amount', '$donation_type', $added)") or sqlerr(__FILE__, __LINE__);
}
    
    $scheduled_events = mysql_fetch_all("SELECT * from `events` ORDER BY `startTime` DESC LIMIT 3;", array());
    if (is_array($scheduled_events)){
        foreach ($scheduled_events as $scheduled_event) {
            if (is_array($scheduled_event) && array_key_exists('startTime', $scheduled_event) &&
                array_key_exists('endTime', $scheduled_event)){
                $startTime = 0;
                $endTime = 0;
                $startTime = $scheduled_event['startTime'];
                $endTime = $scheduled_event['endTime'];
                if (time() < $endTime && time() > $startTime){
                    if (array_key_exists('freeleechEnabled', $scheduled_event)) {
                        $freeleechEnabled = $scheduled_event['freeleechEnabled'];
                        if ($scheduled_event['freeleechEnabled']){
                            $freeleech_start_time = $scheduled_event['startTime'];
                            $freeleech_end_time = $scheduled_event['endTime'];
                            $freeleech_enabled = true;
                        }
                    }
                    if (array_key_exists('duploadEnabled', $scheduled_event)){
                        $duploadEnabled = $scheduled_event['duploadEnabled'];
                        if ($scheduled_event['duploadEnabled']){
                            $double_upload_start_time = $scheduled_event['startTime'];
                            $double_upload_end_time = $scheduled_event['endTime'];
                            $double_upload_enabled = true;
                        }
                    }
                    if (array_key_exists('hdownEnabled', $scheduled_event)) {
                        $hdownEnabled = $scheduled_event['hdownEnabled'];    
                        if ($scheduled_event['hdownEnabled']){
                            $half_down_start_time = $scheduled_event['startTime'];
                            $half_down_end_time = $scheduled_event['endTime'];
                            $half_down_enabled = true;
                        }
                        }
                        }
                        }
                        }
                        }

    $sql = "SELECT `pointspool`, `points` FROM `bonus` WHERE `art` = 'freeleech' OR `art` = 'doubleup' OR `art` = 'halfdown'";
    $res = sql_query($sql)  or print (mysql_error());
    $row = mysql_fetch_assoc($res);
    $row2 = mysql_fetch_assoc($res);
    $row3 = mysql_fetch_assoc($res);
    $fpointspool = $row["pointspool"];
    $dpointspool = $row2["pointspool"];
    $hpointspool = $row3["pointspool"];
    if($fpoints == 0) $fpoints = 1;
    if($dpoints == 0) $dpoints = 1;
    if($hpoints == 0) $hpoints = 1;
    $free_leech_percentage = round(($fpointspool / $fpoints) / 1000, 0);
    $double_upload_percentage = round(($dpointspool / $dpoints) / 1000, 0);    
    $half_down_open_percentage = round(($hpointspool / $hpoints) / 1000, 0);  
    //== Make this code more DRY! put it in a function somewhere and then call it for each of the percentages ???
        if($free_leech_percentage <= 25){
            $fcolor = "red";    
        } elseif($free_leech_percentage <= 50) {
            $fcolor = "#da00e0";
        } else {
            $fcolor = "darkgreen";
        }
        if($double_upload_percentage <= 25){
            $dcolor = "red";    
        } elseif($double_upload_percentage <= 50) {
            $dcolor = "#da00e0";
        } else {
            $dcolor = "darkgreen";
        }
        if($half_down_open_percentage <= 25){
            $hcolor = "red";    
        } elseif($half_down_open_percentage <= 50) {
            $hcolor = "#da00e0";
        } else {
            $hcolor = "darkgreen";
        }
    if($freeleech_enabled){
        $fstatus = "<strong><font color=\"yellow\">&nbsp;ON&nbsp;</font></strong>";
    } else {
        $fstatus = $free_leech_percentage ."&nbsp;%";
    }
    if($double_upload_enabled){
        $dstatus = "<strong><font color=\"yellow\">&nbsp;ON&nbsp;</font></strong>";
    } else {
        $dstatus = $double_upload_percentage ."&nbsp;%";
    }
    if($half_down_enabled){
        $hstatus = "<strong><font color=\"yellow\">&nbsp;ON&nbsp;</font></strong>";
    } else {
        $hstatus = $half_down_open_percentage ."&nbsp;%";
    }
    //==09 Ezeros freeleech contribution top 10 - pdq.Bigjoos  
    $sql = "SELECT bonuslog.id, SUM(bonuslog.donation) as total, users.username FROM bonuslog left join users ON bonuslog.id=users.id WHERE bonuslog.type = 'freeleech' GROUP BY bonuslog.id ORDER BY total DESC LIMIT 10;";
    $res2 = sql_query($sql);
    while($row = mysql_fetch_assoc($res2)){
    $top_donators_id = $row["id"];
    $damount_donated = $row["total"];
    $top_donators_username = $row['username'];
    $top_donators .= "<li><a href='{$TBDEV['baseurl']}/userdetails.php?id=$top_donators_id'>" . $top_donators_username . "</a> ( $damount_donated )</li>";
    }

    $sql = "SELECT bonuslog.id, SUM(bonuslog.donation) as total, users.username FROM bonuslog left join users ON bonuslog.id=users.id WHERE bonuslog.type = 'doubleupload' GROUP BY bonuslog.id ORDER BY total DESC LIMIT 10;";
    $res2 = sql_query($sql);
    while($row = mysql_fetch_assoc($res2)){
    $top_donators_id = $row["id"];
    $damount_donated = $row["total"];
    $top_donators_username = $row['username'];
    $top_donators2 .= "<li><a href='{$TBDEV['baseurl']}/userdetails.php?id=$top_donators_id'>" . $top_donators_username . "</a> ( $damount_donated )</li>";
    }

    $sql = "SELECT bonuslog.id, SUM(bonuslog.donation) as total, users.username FROM bonuslog left join users ON bonuslog.id=users.id WHERE bonuslog.type = 'halfdownload' GROUP BY bonuslog.id ORDER BY total DESC LIMIT 10;";
    $res2 = sql_query($sql);
    while($row = mysql_fetch_assoc($res2)){
    $top_donators_id = $row["id"];
    $damount_donated = $row["total"];
    $top_donators_username = $row['username'];
    $top_donators3 .= "<li><a href='{$TBDEV['baseurl']}/userdetails.php?id=$top_donators_id'>" . $top_donators_username . "</a> ( $damount_donated )</li>";
    }
    //==End
            //== Show the percentages
            $HTMLOUT .="<div align='center' style='background:transparent;height:25px;'>&nbsp;FreeLeech&nbsp;[&nbsp;";
            if($freeleech_enabled){
            $HTMLOUT .="<font color=\"yellow\"><strong>&nbsp;ON</strong></font>&nbsp;".get_date($freeleech_start_time, 'DATE') . "&nbsp;-&nbsp;" .get_date($freeleech_end_time, 'DATE');
            } else {
            $HTMLOUT .="<font color=\"" . $fcolor . "\"><strong>" . $fstatus . "</strong></font>";
            }
            $HTMLOUT .="&nbsp;]";
    
            $HTMLOUT .="&nbsp;DoubleUpload&nbsp;[&nbsp;";
            if($double_upload_enabled){
            $HTMLOUT .="<font color=\"yellow\"><strong>&nbsp;ON</strong></font>&nbsp;".get_date($double_upload_start_time, 'DATE') . "&nbsp;-&nbsp;" .get_date($double_upload_end_time, 'DATE');
            } else {
            $HTMLOUT .="<font color=\"" . $dcolor . "\"><strong>" . $dstatus . "</strong></font>";
            }
            $HTMLOUT .="&nbsp;]";
            
            $HTMLOUT .="&nbsp;Half Download&nbsp;[&nbsp;";
            if($half_down_enabled){
            $HTMLOUT .="<font color=\"yellow\"><strong>&nbsp;ON</strong></font>&nbsp;".get_date($half_down_start_time, 'DATE') . "&nbsp;-&nbsp;" .get_date($half_down_end_time, 'DATE');
            } else {
            $HTMLOUT .="<font color=\"" . $hcolor . "\"><strong>" . $hstatus . "</strong></font>";
            }
            $HTMLOUT .="&nbsp;]</div>";
            //==End

            $HTMLOUT .="<table align='center' width='100%' border='1' cellspacing='0' cellpadding='5'>
            <tr>
            <td align='center' colspan='4' style='background:transparent;height:25px;'>
            Exchange your <a class='altlink' href='{$TBDEV['baseurl']}/mybonus.php'>Karma Bonus Points</a> [ current ".$bonus." ] for goodies!
            <br /><br />[ If no buttons appear, you have not earned enough bonus points to trade. ]<br /><br />
            </td></tr>
            <tr>
            <td style='background:transparent;height:25px;' align='left'>Description</td>
            <td style='background:transparent;height:25px;' align='center'>Points</td>
            <td style='background:transparent;height:25px;' align='center'>Trade</td></tr>";

            $res = @sql_query("SELECT * FROM bonus WHERE enabled = 'yes' ORDER BY id ASC");
            while ($gets = mysql_fetch_assoc($res)){
            //=======change colors
            $count1='';
            $count1= (++$count1)%2;
            $class = 'clearalt'.($count1==0?'6':'7');
            $otheroption = "<table align='center' width='100%'>
            <tr>
            <td class='".$class."'><b>Username:</b>
            <input type='text' name='username' size='20' maxlength='24' /></td>
            <td class='".$class."'> <b>to be given: </b>
            <select name='bonusgift'> 
            <option value='100.0'> 100.0</option> 
            <option value='200.0'> 200.0</option> 
            <option value='300.0'> 300.0</option> 
            <option value='400.0'> 400.0</option>
            <option value='500.0'> 500.0</option>
            <option value='1000.0'> 1000.0</option>
            <option value='5000.0'> 5000.0</option>
            <option value='10000.0'> 20000.0</option>
            <option value='20000.0'> 20000.0</option>
            <option value='50000.0'> 50000.0</option>
            <option value='100000.0'> 100000.0</option>
            </select> Karma points!</td></tr></table>";

  switch (true){
 	case ($gets['id'] == 5):
 	$HTMLOUT .="<tr><td align='left' class='".$class."'><form action='{$TBDEV['baseurl']}/mybonus.php?exchange=1' method='post'><input type='hidden' name='option' value='".$gets['id']."' /> <input type='hidden' name='art' value='".$gets['art']."' /><h1><font color='#CECFF3'>".$gets['bonusname']."</font></h1>".$gets['description']."<br /><br />Enter the <b>Special Title</b> you would like to have <input type='text' name='title' size='30' maxlength='30' /> click Exchange! </td><td align='center' class='".$class."'>".$gets['points']."</td>";
  break;
  case ($gets['id'] == 7):
  $HTMLOUT .="<tr><td align='left' class='".$class."'><form action='{$TBDEV['baseurl']}/mybonus.php?exchange=1' method='post'><input type='hidden' name='option' value='".$gets['id']."' /> <input type='hidden' name='art' value='".$gets['art']."' /><h1><font color='#CECFF3'>".$gets['bonusname']."</font></h1>".$gets['description']."<br /><br />Enter the <b>username</b> of the person you would like to send karma to, and select how many points you want to send and click Exchange!<br />".$otheroption."</td><td align=center class='".$class."'>min.<br />".$gets['points']."<br />max.<br />100000.0</td>";
  break;
  case ($gets['id'] == 9):
  $HTMLOUT .="<tr><td align='left' class='".$class."'><form action='{$TBDEV['baseurl']}/mybonus.php?exchange=1' method='post'><input type='hidden' name='option' value='".$gets['id']."' /> <input type='hidden' name='art' value='".$gets['art']."' /><h1><font color='#CECFF3'>".$gets['bonusname']."</font></h1>".$gets['description']."</td><td align='center' class='".$class."'>min.<br />".$gets['points']."</td>";
  break;
  case ($gets['id'] == 10):
  $HTMLOUT .="<tr><td align='left' class='".$class."'><form action='{$TBDEV['baseurl']}/mybonus.php?exchange=1' method='post'><input type='hidden' name='option' value='".$gets['id']."' /> <input type='hidden' name='art' value='".$gets['art']."' /><h1><font color='#CECFF3'>".$gets['bonusname']."</font></h1>".$gets['description']."<br /><br />Enter the <b>ID number of the Torrent:</b> <input type='text' name='torrent_id' size='4' maxlength='8' /> you would like to buy a 1 to 1 ratio on.</td><td align='center' class='".$class."'>min.<br />".$gets['points']."</td>";
  break;
  case ($gets['id'] == 11):
  $HTMLOUT .="<tr><td align='left' class='".$class."'><form action='{$TBDEV['baseurl']}/mybonus.php?exchange=1' method='post'><input type='hidden' name='option' value='".$gets['id']."' /> <input type='hidden' name='art' value='".$gets['art']."' /><h1><font color=\"#CECFF3\">".$gets["bonusname"]."</font></h1>".$gets['description']."<br /><h4>Top 10 Contributors </h4> <ol>".$top_donators." </ol> <br />Enter the <b>amount to contribute</b><input type='text' name='donate' size='10' maxlength='10' /></td><td align='center' class='".$class."'>" .$gets['minpoints'] ." <br /></td>";
  break;
  case ($gets['id'] == 12):
  $HTMLOUT .="<tr><td align='left' class='".$class."'><form action='{$TBDEV['baseurl']}/mybonus.php?exchange=1' method='post'><input type='hidden' name='option' value='".$gets['id']."' /> <input type='hidden' name='art' value='".$gets['art']."' /><h1><font color=\"#CECFF3\">".$gets["bonusname"]."</font></h1>".$gets['description']."<br /><h4>Top 10 Contributors </h4> <ol>".$top_donators2." </ol> <br />Enter the <b>amount to contribute</b><input type='text' name='donate' size='10' maxlength='10' /></td><td align='center' class='".$class."'>" .$gets['minpoints'] ." <br /></td>";
  break;
  case ($gets['id'] == 13):
  $HTMLOUT .="<tr><td align='left' class='".$class."'><form action='{$TBDEV['baseurl']}/mybonus.php?exchange=1' method='post'><input type='hidden' name='option' value='".$gets['id']."' /> <input type='hidden' name='art' value='".$gets['art']."' /><h1><font color=\"#CECFF3\">".$gets["bonusname"]."</font></h1>".$gets['description']."<br /><h4>Top 10 Contributors </h4> <ol>".$top_donators3." </ol> <br />Enter the <b>amount to contribute</b><input type='text' name='donate' size='10' maxlength='10' /></td><td align='center' class='".$class."'>" .$gets['minpoints'] ." <br /></td>";
  break;
  default:
  $HTMLOUT .="<tr><td align='left' class='".$class."'><form action='{$TBDEV['baseurl']}/mybonus.php?exchange=1' method='post'><input type='hidden' name='option' value='".$gets['id']."' /> <input type='hidden' name='art' value='".$gets['art']."' /><h1><font color='#CECFF3'>".$gets['bonusname']."</font></h1>".$gets['description']."</td><td align='center' class='".$class."'>".$gets['points']."</td>";
  }


  if($bonus >= $gets['points'] OR $bonus >= $gets['minpoints']) {
  switch (true){
  case ($gets['id'] == 7):
  $HTMLOUT .="<td class='".$class."'><input class='button' type='submit' name='submit' value='Karma Gift!' /></td></form>";
  break;
  case ($gets['id'] == 11 ):
  $HTMLOUT .="<td align='center' class='".$class."'>". ($gets['points'] - $gets['pointspool']) . " <br />Points needed! <br /><input class='button' type='submit' name='submit' value='Contribute!' /></td></form>";
  break;
  case ($gets['id'] == 12 ):
  $HTMLOUT .="<td align='center' class='".$class."'>". ($gets['points'] - $gets['pointspool']) . " <br />Points needed! <br /><input class='button' type='submit' name='submit' value='Contribute!' /></td></form>";
  break;
  case ($gets['id'] == 13 ):
  $HTMLOUT .="<td align='center' class='".$class."'>". ($gets['points'] - $gets['pointspool']) . " <br />Points needed! <br /><input class='button' type='submit' name='submit' value='Contribute!' /></td></form>";
  break;
  default:
  $HTMLOUT .="<td class='".$class."'><input class='button' type='submit' name='submit' value='Exchange!' /></td></form>";
  }
  }
  else 
  $HTMLOUT .="<td class='".$class."' align='center'><b>more points needed</b></td></form>";
  }

  $HTMLOUT .="</tr></table>
  <div style='background:transparent;height:25px;'>
  <span style='font-weight:bold;font-size:12pt;'>What the hell are these Karma Bonus points,
  and how do I get them?</span></div>
  <table align='center' width='100%'>
  <tr>
  <td class='clearalt6'>For every hour that you seed a torrent, you are awarded with 1 Karma Bonus Point... <br />
  If you save up enough of them, you can trade them in for goodies like bonus GB(s) to increase your upload stats,<br /> 
  also to get more invites, or doing the real Karma booster... give them to another user !<br />
  This is awarded on a per torrent basis (max of 1000) even if there are no leechers on the Torrent you are seeding! <br />
  <h1>Other things that will get you karma points : </h1>
  &#186;&nbsp;Uploading a new torrent = 15 points
  <br />&#186;&nbsp;Filling a request = 10 points
  <br />&#186;&nbsp;Comment on torrent = 3 points
  <br />&#186;&nbsp;Saying thanks = 2 points
  <br />&#186;&nbsp;Rating a torrent = 2 points
  <br />&#186;&nbsp;Making a post = 1 point
  <br />&#186;&nbsp;Starting a topic = 2 points 
  <br />
  <h1>Some things that will cost you karma points:</h1>
  <br />
  &#186;&nbsp;Upload credit
  <br />&#186;&nbsp;Custom title
  <br />&#186;&nbsp;One month VIP status
  <br />&#186;&nbsp;A 1:1 ratio on a torrent
  <br />&#186;&nbsp;Buying off your warning
  <br />&#186;&nbsp;One month custom smilies for the forums and comments
  <br />&#186;&nbsp;Getting extra invites
  <br />&#186;&nbsp;Getting extra freeslots
  <br />&#186;&nbsp;Giving a gift of karma points to another user
  <br />&#186;&nbsp;Asking for a re-seed
  <br />&#186;&nbsp;Making a request
  <br />&#186;&nbsp;Freeleech, Doubleupload, Halfdownload contribution
  <br />&#186;&nbsp;Anonymous profile
  <br />&#186;&nbsp;Download reduction
  <br />&#186;&nbsp;Freeleech for a year
  <br />&#186;&nbsp;Pirate or King status
  <br />&#186;&nbsp;But keep in mind that everything that can get you karma can also be lost...<br /><br />
  Ie : if you up a torrent then delete it, you will gain and then lose 15 points, making a post and having it deleted will do the same... and there are other hidden bonus karma points all 
  over the site which is another way to help out your ratio ! 
  <br /><br />&#186;&nbsp;*Please note, staff can give or take away points for breaking the rules, or doing good for the community.
  <br />
  <div align='center'><br />
  <a class='altlink' href='{$TBDEV['baseurl']}/index.php'><b>Back to homepage</b></a></div>
  </td></tr></table></div>";
  
print stdhead($CURUSER['username'] . "'s Karma Bonus Points Page") . $HTMLOUT . stdfoot();
?>