<?php
$cs_lang = cs_translate('liga_manager');
$data = array();
$ttl_id = (int) $_GET['ttl_id'];

if(isset($_GET['agree'])) {
  cs_sql_delete(__FILE__,'liga_manager_ttl',$ttl_id);
  cs_redirect($cs_lang['del_true'],'liga_manager','manage_ttl');
}
if(isset($_GET['cancel'])) {
  cs_redirect($cs_lang['del_false'],'liga_manager','manage_ttl');
}

$data['head']['body_text'] = sprintf($cs_lang['del_rly'], $ttl_id);
$data['lang']['content'] = cs_link($cs_lang['confirm'],'liga_manager','remove_ttl','ttl_id=' . $ttl_id . '&amp;agree');
$data['lang']['content'] .= ' - ';
$data['lang']['content'] .= cs_link($cs_lang['cancel'],'liga_manager','remove_ttl','ttl_id=' . $ttl_id . '&amp;cancel');
echo cs_subtemplate(__FILE__,$data,'liga_manager','remove_ttl');
?>