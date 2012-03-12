<?php
$cs_lang = cs_translate('liga_manager');
$data = array();

if(isset($_POST['submit'])) {
  $data['edit']['team_name'] = $_POST['team_name'];
  $data['edit']['team_short'] = $_POST['team_short'];
  $team_id = (int) $_POST['team_id'];
      
  $error = 0;
  $errormsg = $cs_lang['error'];
  if(empty($data['edit']['team_name'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team_name'];
	$error++;
  }
  if(empty($data['edit']['team_short'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team_short'];
	$error++;
  }
} else {
  $team_id = (int) $_GET['team_id'];
  $select = 'liga_manager_teams_id, team_name, team_short';
  $where = "liga_manager_teams_id = '" . $team_id . "'";
  $team = cs_sql_select(__FILE__,'liga_manager_teams',$select,$where,0,0,1);
  $data['edit'] = $team;
}

if(!isset($_POST['submit'])) {
  $data['head']['body_text'] = $cs_lang['create_body'];
} elseif(!empty($error)) {
  $data['head']['body_text'] = $errormsg;
} 

if(!isset($_POST['submit']) OR !empty($error)) {
  $data['data']['team_id'] = $team_id;
  $data['url']['create'] = cs_url('liga_manager','edit_team');
} else {
  $team_cells = array_keys($data['edit']);
  $team_save = array_values($data['edit']);
  cs_sql_update(__FILE__,'liga_manager_teams',$team_cells,$team_save,$team_id);
  cs_redirect($cs_lang['changes_done'],'liga_manager','manage_teams');
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','edit_team');
?>