<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: info.php 3009 2009-05-03 14:57:11Z hajo $

$cs_lang = cs_translate('newsletter');

$mod_info['name']    = $cs_lang['mod_name'];
$mod_info['version']  = $cs_main['version_name'];
$mod_info['released']  = $cs_main['version_date'];
$mod_info['creator']  = 'Drag0n';
$mod_info['team']    = 'ClanSphere';
$mod_info['url']    = 'www.clansphere.net';
$mod_info['text']    = $cs_lang['mod_text'];
$mod_info['icon']     = 'mail';
$mod_info['show']     = array('clansphere/admin' => 5);
$mod_info['categories']  = FALSE;
$mod_info['comments']  = FALSE;
$mod_info['protected']  = FALSE;
$mod_info['tables']    = array('newsletter');