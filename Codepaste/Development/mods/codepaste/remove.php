<?php

$cs_lang = cs_translate('codepaste');

$cs_cp_id   = $_GET['id'];
settype($cs_cp_id, 'integer');

$cs_cp_form = 1;

$tpl_data   = array();

if(isset($_POST['agree'])) {
  $cs_cp_id = $_POST['id'];
  settype($cs_cp_id, 'integer');
  cs_sql_delete(__FILE__,'codepaste',$cs_cp_id);
  cs_redirect($cs_lang['del_true'], 'codepaste');
}

if(isset($_POST['cancel'])) {
  cs_redirect($cs_lang['del_false'], 'codepaste');
}

if(!empty($cs_cp_form)) {
  $tpl_data['codepaste']['id'] = $cs_cp_id;
  $tpl_data['verify']['erasing'] = sprintf($cs_lang['verify_erasing'], $cs_cp_id);
}

echo cs_subtemplate(__FILE__, $tpl_data, 'codepaste', 'remove');

?>
