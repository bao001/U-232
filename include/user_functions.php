<?php
/**
 *   http://btdev.net:1337/svn/test/Installer09_Beta
 *   Licence Info: GPL
 *   Copyright (C) 2010 BTDev Installer v.1
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless,putyn.
 **/
//=== Anonymous function
function get_anonymous()
{
global $CURUSER;
return $CURUSER["anonymous_until"];
}
/////////////// REP SYSTEM /////////////
//$CURUSER['reputation'] = 650;
function get_reputation($user, $mode = '', $rep_is_on = TRUE)
{
global $TBDEV;

$member_reputation = "";
if( $rep_is_on )
{
include 'cache/rep_cache.php';
//@include(CACHE_DIR.'rep_cache.php');
// ok long winded file checking, but it's much better than file_exists
if( ! isset( $reputations ) || ! is_array( $reputations ) || count( $reputations ) < 1)
{
return '<span title="Cache doesn\'t exist or zero length">Reputation: Offline</span>';
}

$user['g_rep_hide'] = isset( $user['g_rep_hide'] ) ? $user['g_rep_hide'] : 0;

// uncomment if you use anonymous mod(s)
$user['username'] =  ($user['anonymous'] != 'yes') ? $user['username'] : 'Anonymous';

// Hmmm...bit of jiggery-pokery here, couldn't think of a better way.
$max_rep = max(array_keys($reputations));
if($user['reputation'] >= $max_rep)
{
$user_reputation = $reputations[$max_rep];
}
else
foreach($reputations as $y => $x)
{
if( $y > $user['reputation'] ) { $user_reputation = $old; break; }
$old = $x;
}

//$rep_is_on = TRUE;
//$CURUSER['g_rep_hide'] = FALSE;

$rep_power = $user['reputation'];
$posneg = '';
if( $user['reputation'] == 0 )
{
$rep_img = 'balance';
$rep_power = $user['reputation'] * -1;
}
elseif( $user['reputation'] < 0 )
{
$rep_img = 'neg';
$rep_img_2 = 'highneg';
$rep_power = $user['reputation'] * -1;
}
else
{
$rep_img = 'pos';
$rep_img_2 = 'highpos';
}
/**
if( $rep_power > 500 )
{
// work out the bright green shiny bars, cos they cost 100 points, not the normal 100
$rep_power = ( $rep_power - ($rep_power - 500) ) + ( ($rep_power - 500) / 2 );
}
**/
// shiny, shiny, shiny boots...
// ok, now we can work out the number of bars/pippy things  
$pips = 12;
switch ($mode)
{
case 'comments':
$pips = 12;
break;
case 'torrents':
$pips = 1003;
break;
case 'users':
$pips = 970;
break;
case 'posts':
$pips = 12;
break;
default:
$pips = 12; // statusbar
}

$rep_bar = intval($rep_power / 100);
if( $rep_bar > 10 )
{
$rep_bar = 10;
}

if( $user['g_rep_hide'] ) // can set this to a group option if required, via admin?
{
$posneg = 'off';
$rep_level = 'rep_off';
}
else
{ // it ain't off then, so get on with it! I wanna see shiny stuff!!
$rep_level = $user_reputation ? $user_reputation : 'rep_undefined';// just incase

for( $i = 0; $i <= $rep_bar; $i++ )
{
if( $i >= 5 )
{
$posneg .= "<img src='pic/rep/reputation_$rep_img_2.gif' border='0' alt=\"Reputation Power $rep_power\n{$user['username']} $rep_level\" title=\"Reputation Power $rep_power {$user['username']} $rep_level\" />";
}
else
{
$posneg .= "<img src='pic/rep/reputation_$rep_img.gif' border='0' alt=\"Reputation Power $rep_power\n{$user['username']} $rep_level\" title=\"Reputation Power $rep_power {$user['username']} $rep_level\" />";
}
}
}

// now decide the locale
if($mode != '')
return "Rep: ".$posneg . "<br /><br /><a href='javascript:;' onclick=\"PopUp('{$TBDEV['baseurl']}/reputation.php?pid={$user['id']}&amp;locale=".$mode."','Reputation',400,241,1,1);\"><img src='{$TBDEV['pic_base_url']}forumicons/giverep.jpg' border='0' alt='Add reputation:: {$user['username']}' title='Add reputation:: {$user['username']}' /></a>";
else
return " ".$posneg;


} // END IF ONLINE

// default
return '<span title="Set offline by admin setting">Rep System Offline</span>';
}
////////////// REP SYSTEM END //////////
function autoshout($msg) {
global $TBDEV;
require_once(INCL_DIR.'bbcode_functions.php');
sql_query('INSERT INTO shoutbox(userid,date,text,text_parsed)VALUES ('.$TBDEV['bot_id'].','.time().','.sqlesc($msg).','.sqlesc(format_comment($msg)).')');
}

function parked()
{
global $CURUSER;
if ($CURUSER["parked"] == "yes")
stderr("Error", "<b>Your account is currently parked.</b>");
}


function get_ratio_color($ratio)
  {
    if ($ratio < 0.1) return "#ff0000";
    if ($ratio < 0.2) return "#ee0000";
    if ($ratio < 0.3) return "#dd0000";
    if ($ratio < 0.4) return "#cc0000";
    if ($ratio < 0.5) return "#bb0000";
    if ($ratio < 0.6) return "#aa0000";
    if ($ratio < 0.7) return "#990000";
    if ($ratio < 0.8) return "#880000";
    if ($ratio < 0.9) return "#770000";
    if ($ratio < 1) return "#660000";
    if (($ratio >= 1.0) && ($ratio < 2.0)) return "#006600";
    if (($ratio >= 2.0) && ($ratio < 3.0)) return "#007700";
    if (($ratio >= 3.0) && ($ratio < 4.0)) return "#008800";
    if (($ratio >= 4.0) && ($ratio < 5.0)) return "#009900";
    if (($ratio >= 5.0) && ($ratio < 6.0)) return "#00aa00";
    if (($ratio >= 6.0) && ($ratio < 7.0)) return "#00bb00";
    if (($ratio >= 7.0) && ($ratio < 8.0)) return "#00cc00";
    if (($ratio >= 8.0) && ($ratio < 9.0)) return "#00dd00";
    if (($ratio >= 9.0) && ($ratio < 10.0)) return "#00ee00";
    if ($ratio >= 10) return "#00ff00";
    return "#777777";
  }

  function get_slr_color($ratio)
  {
    if ($ratio < 0.025) return "#ff0000";
    if ($ratio < 0.05) return "#ee0000";
    if ($ratio < 0.075) return "#dd0000";
    if ($ratio < 0.1) return "#cc0000";
    if ($ratio < 0.125) return "#bb0000";
    if ($ratio < 0.15) return "#aa0000";
    if ($ratio < 0.175) return "#990000";
    if ($ratio < 0.2) return "#880000";
    if ($ratio < 0.225) return "#770000";
    if ($ratio < 0.25) return "#660000";
    if ($ratio < 0.275) return "#550000";
    if ($ratio < 0.3) return "#440000";
    if ($ratio < 0.325) return "#330000";
    if ($ratio < 0.35) return "#220000";
    if ($ratio < 0.375) return "#110000";
    if (($ratio >= 1.0) && ($ratio < 2.0)) return "#006600";
    if (($ratio >= 2.0) && ($ratio < 3.0)) return "#007700";
    if (($ratio >= 3.0) && ($ratio < 4.0)) return "#008800";
    if (($ratio >= 4.0) && ($ratio < 5.0)) return "#009900";
    if (($ratio >= 5.0) && ($ratio < 6.0)) return "#00aa00";
    if (($ratio >= 6.0) && ($ratio < 7.0)) return "#00bb00";
    if (($ratio >= 7.0) && ($ratio < 8.0)) return "#00cc00";
    if (($ratio >= 8.0) && ($ratio < 9.0)) return "#00dd00";
    if (($ratio >= 9.0) && ($ratio < 10.0)) return "#00ee00";
    if ($ratio >= 10) return "#00ff00";
    return "#777777";
  }
  
/** class functions - pdq 2010 **/
/** START **/
define('UC_MIN', 0);   // minimum class
define('UC_MAX', 6);   // maximum class
define('UC_STAFF', 4); // start of staff classes

   $class_names = array(
        UC_USER                 => 'User',
        UC_POWER_USER           => 'Power User',
        UC_VIP                  => 'VIP',
        UC_UPLOADER             => 'Uploader',
        UC_MODERATOR            => 'Moderator',
        UC_ADMINISTRATOR        => 'Administrator',
        UC_SYSOP                => 'SysOp');
        
   $class_colors = array(
        UC_USER                 => '8E35EF',
        UC_POWER_USER           => 'f9a200',
        UC_VIP                  => '009F00',
        UC_UPLOADER             => '0000FF',
        UC_MODERATOR            => 'FE2E2E',
        UC_ADMINISTRATOR        => 'B000B0',
        UC_SYSOP                => '4080B0');

   $class_images = array(
        UC_USER                 => $TBDEV['pic_base_url'].'class/user.gif',
        UC_POWER_USER           => $TBDEV['pic_base_url'].'class/power.gif',
        UC_VIP                  => $TBDEV['pic_base_url'].'class/vip.gif',
        UC_UPLOADER             => $TBDEV['pic_base_url'].'class/uploader.gif',
        UC_MODERATOR            => $TBDEV['pic_base_url'].'class/moderator.gif',
        UC_ADMINISTRATOR        => $TBDEV['pic_base_url'].'class/administrator.gif',
        UC_SYSOP                => $TBDEV['pic_base_url'].'class/sysop.gif');
        
   function get_user_class_name($class) {
        global $class_names;
        $class = (int)$class;
        if (!valid_class($class))
            return '';
        if (isset($class_names[$class]))
            return $class_names[$class];
        else
            return '';
    }
    
    function get_user_class_color($class) {
        global $class_colors;
        $class = (int)$class;
        if (!valid_class($class))
            return '';
        if (isset($class_colors[$class]))
            return $class_colors[$class];
        else
            return '';
    }
    
    function get_user_class_image($class) {
        global $class_images;
        $class = (int)$class;
        if (!valid_class($class))
            return '';
        if (isset($class_images[$class]))
            return $class_images[$class];
        else
            return '';
    }
    
    function valid_class($class) {
        $class = (int)$class;
        return (bool)($class >= UC_MIN && $class <= UC_MAX);
    }

    function min_class($min = UC_MIN, $max = UC_MAX) {
        global $CURUSER;
        $minclass = (int)$min;
        $maxclass = (int)$max;
        if (!isset($CURUSER))
            return false;
        if (!valid_class($minclass) || !valid_class($maxclass))
            return false;
        if ($maxclass < $minclass)
            return false;
        return (bool)($CURUSER['class'] >= $minclass && $CURUSER['class'] <= $maxclass);
    }
       
function format_username($user, $icons = true) {
        global $TBDEV;
        $user['id']    = (int)$user['id'];
        $user['class'] = (int)$user['class'];
        if ($user['id'] == 0)
            return 'System';
        elseif ($user['username'] == '')
            return 'unknown['.$user['id'].']';
        $username = '<span style="color:#'.get_user_class_color($user['class']).';"><b>'.$user['username'].'</b></span>';
        $str = '<span style="white-space: nowrap;"><a class="user_'.$user['id'].'" href="'.$TBDEV['baseurl'].'/userdetails.php?id='.$user['id'].'"target="_blank">'.$username.'</a>';
        if ($icons != false) {
            $str .= ($user['donor'] == 'yes' ? '<img src="'.$TBDEV['pic_base_url'].'star.png" alt="Donor" title="Donor" />' : '');
            $str .= ($user['warned'] >= 1 ? '<img src="'.$TBDEV['pic_base_url'].'warned.png" alt="Warned" title="Warned" />' : '');
            $str .= ($user['leechwarn'] >= 1 ? '<img src="'.$TBDEV['pic_base_url'].'warned.png" alt="Leech Warned" title="Leech Warned" />' : '');
            $str .= ($user['enabled'] != 'yes' ? '<img src="'.$TBDEV['pic_base_url'].'disabled.gif" alt="Disabled" title="Disabled" />' : '');
            $str .= ($user['chatpost'] == 0 ?  '<img src="'.$TBDEV['pic_base_url'].'chatpos.gif" alt="No Chat" title="Shout disabled" />'  : '');
            $str .= ($user['pirate'] != 0 ? '<img src="'.$TBDEV['pic_base_url'].'pirate.png" alt="Pirate" title="Pirate" />' : '');
            $str .= ($user['king'] != 0 ? '<img src="'.$TBDEV['pic_base_url'].'king.png" alt="King" title="King" />' : '');
        }
        $str .= "</span>\n";
        return $str;
}

function is_valid_id($id)
{
  return is_numeric($id) && ($id > 0) && (floor($id) == $id);
}

function member_ratio($up, $down) {
    switch(true) {
        case ($down > 0 && $up > 0): 
        $ratio = '<span style="color:'.get_ratio_color($up/$down).';">'.number_format($up/$down, 3).'</span>';
        break;
        case ($down > 0 && $up == 0): 
        $ratio = '<span style="color:'.get_ratio_color(1/$down).';">'.number_format(1/$down, 3).'</span>';
        break;
        case ($down == 0 && $up > 0): 
        $ratio=  '<span style="color: '.get_ratio_color($up/1).';">inf</span>';
        break;
       default:
       $ratio = '---';
   }
return $ratio;
}

//== Made by putyn@tbdev
function blacklist($fo) {
	global $TBDEV;
	$blacklist = file_exists($TBDEV['nameblacklist']) && is_array(unserialize(file_get_contents($TBDEV['nameblacklist']))) ? unserialize(file_get_contents($TBDEV['nameblacklist'])) : array();
	if(isset($blacklist[$fo]) && $blacklist[$fo] == 1)
	return false;
	return true;
}

function get_server_load($windows = 0) {
if(class_exists("COM")) {
$wmi = new COM("WinMgmts:\\\\.");
$cpus = $wmi->InstancesOf("Win32_Processor"); 
$i = 1;
// Use the while loop on PHP 4 and foreach on PHP 5
//while ($cpu = $cpus->Next()) {
foreach($cpus as $cpu) {
$cpu_stats=0;
$cpu_stats += $cpu->LoadPercentage;
$i++;
}
return round($cpu_stats/2); // remove /2 for single processor systems
}
}
/** end functions **/
?>