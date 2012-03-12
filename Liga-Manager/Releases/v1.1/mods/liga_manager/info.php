<?php
$cs_lang = cs_translate('liga_manager');

$mod_info['name']	= $cs_lang['mod_name'];
$mod_info['version'] = $cs_main['version_name'];
$mod_info['released'] = $cs_main['version_date'];
$mod_info['creator']	= 'Fr33z3m4n';
$mod_info['team']	= 'ClanSphere, Fastwebs24';
$mod_info['url']		= 'www.clansphere.net, www.fastwebs24.de';
$mod_info['text']	= $cs_lang['mod_info'];
$mod_info['icon'] = 'games';
$mod_info['show'] = array('clansphere/admin' => 4);
$mod_info['categories']  = FALSE;
$mod_info['protected'] = TRUE;
$mod_info['tables'] = array('liga_manager');

?>