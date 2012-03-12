<?php
$cs_lang = cs_translate('liga_manager');
$data = array();
$data['url']['ligen'] = cs_url('liga_manager','manage_ligen');
$data['count']['ligen'] = cs_sql_count(__FILE__,'liga_manager_ligen');
$data['url']['teams'] = cs_url('liga_manager','manage_teams');
$data['count']['teams'] = cs_sql_count(__FILE__,'liga_manager_teams');
$data['url']['ttl'] = cs_url('liga_manager','manage_ttl');
$data['url']['games'] = cs_url('liga_manager','manage_games');

echo cs_subtemplate(__FILE__,$data,'liga_manager','manage');
?>