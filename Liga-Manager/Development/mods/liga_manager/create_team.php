<?php
$cs_lang = cs_translate('liga_manager');
$data = array();

if(isset($_POST['submit'])) {
  $data['create']['team_name'] = $_POST['team_name'];
  $data['create']['team_short'] = $_POST['team_short'];
    
  $error = 0;
  $errormsg = $cs_lang['error'];
  if(empty($data['create']['team_name'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team_name'];
	$error++;
  }
  if(empty($data['create']['team_short'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team_short'];
	$error++;
  }
} else {
  $data['create']['team_name'] = '';
  $data['create']['team_short'] = '';
}

if(!isset($_POST['submit'])) {
  $data['head']['body_text'] = $cs_lang['create_body'];
} elseif(!empty($error)) {
  $data['head']['body_text'] = $errormsg;
} 

if(!isset($_POST['submit']) OR !empty($error)) {
  $data['url']['create'] = cs_url('liga_manager','create_team');
} else {
  $liga_cells = array_keys($data['create']);
  $liga_save = array_values($data['create']);
  cs_sql_insert(__FILE__,'liga_manager_teams',$liga_cells,$liga_save);
  cs_redirect($cs_lang['create_done'],'liga_manager','manage_teams');
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','create_team');
?>