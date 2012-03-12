<?php
$cs_lang = cs_translate('liga_manager');
$data = array();
$data['url']['create'] = cs_url('liga_manager','create_ttl');

if(isset($_POST['submit'])) {
  $data['create']['liga_id'] = $_POST['liga_id'];
  $data['create']['team_id'] = $_POST['team_id'];

  $error = 0;
  $errormsg = $cs_lang['error'];
  
  if(empty($data['create']['liga_id'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga'];
	$error++;
  }
  if(empty($data['create']['team_id'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team'];
	$error++;
  }  
  $select = 'team_id, liga_id';
  $where = "liga_id = '" . $data['create']['liga_id'] . "' AND team_id = '" . $data['create']['team_id'] . "'";
  $check = cs_sql_select(__FILE__,'liga_manager_ttl',$select,$where,0,0,1);
  if(!empty($check)) {
    $errormsg .= cs_html_br(1) . $cs_lang['team_exist'];
	$error++;
  }  
  $select = 'liga_manager_ligen_id, liga_max_teams';
  $where = "liga_manager_ligen_id = '" . $data['create']['liga_id'] . "'";
  $check = cs_sql_select(__FILE__,'liga_manager_ligen',$select,$where,0,0,1);
  $liga_max_teams = $check['liga_max_teams'];
  $where = "liga_id = '" . $data['create']['liga_id'] . "'";
  $check2 = cs_sql_count(__FILE__,'liga_manager_ttl',$where);
  echo $check2;
  if($liga_max_teams == $check2) {
    $errormsg .= cs_html_br(1) . $cs_lang['max_teams_exist'];
	$error++;
  }
} else {
  $data['create']['liga_id'] = '';
  $data['create']['team_id'] = '';
}
if(!isset($_POST['submit'])) {
  $data['head']['body_text'] = $cs_lang['create_body'];
} elseif(!empty($error)) {
  $data['head']['body_text'] = $errormsg;
} 
if(isset($_POST['cancel'])) {
  cs_redirect($cs_lang['cancel'],'liga_manager','manage_ttl');
}
if(!isset($_POST['submit']) OR !empty($error)) {
  $ligen_data = cs_sql_select(__FILE__,'liga_manager_ligen','*',0,'liga_order DESC',0,0);
  $data['dropdown']['liga'] = cs_dropdown('liga_id','liga_name',$ligen_data,$data['create']['liga_id'],'liga_manager_ligen_id');
  $teams_data = cs_sql_select(__FILE__,'liga_manager_teams','*',0,'team_name DESC',0,0);
  $data['dropdown']['team'] = cs_dropdown('team_id','team_name',$teams_data,$data['create']['team_id'],'liga_manager_teams_id');  
} else {
  $ttl_cells = array_keys($data['create']);
  $ttl_save = array_values($data['create']);
  cs_sql_insert(__FILE__,'liga_manager_ttl',$ttl_cells,$ttl_save);
  cs_redirect($cs_lang['create_done'],'liga_manager','manage_ttl');
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','create_ttl');
?>