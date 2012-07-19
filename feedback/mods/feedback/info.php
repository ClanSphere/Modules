<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: info.php 587 2011-03-31 06:38:06Z hajo $

$cs_lang = cs_translate('feedback');

$mod_info['name']       = $cs_lang['mod_name'];
$mod_info['version']    = '2011.3 v1';
$mod_info['released']   = '2012-02-06';
$mod_info['creator']    = 'ClanSphere';
$mod_info['team']       = 'ClanSphere';
$mod_info['url']        = 'www.clansphere.net';
$mod_info['text']       = $cs_lang['mod_text'];
$mod_info['icon']       = 'kontact';
$mod_info['show']       = array('options/roots' => 5, 'clansphere/admin' => 3);
$mod_info['categories'] = TRUE;
$mod_info['comments']   = FALSE;
$mod_info['protected']  = FALSE;
$mod_info['tables']     = array('feedback', 'feedbackmail');