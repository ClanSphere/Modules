<?php
$cs_lang = cs_translate('liga_manager');

$data = array();

if(isset($_POST['submit'])) {
  $data['edit']['liga_name'] = $_POST['liga_name'];
  $data['edit']['liga_year'] = $_POST['liga_year'];
  $data['edit']['liga_max_teams'] = $_POST['liga_max_teams'];
  $data['edit']['liga_order'] = $_POST['liga_order'];  
  $data['edit']['liga_points_win'] = $_POST['liga_points_win'];
  $data['edit']['liga_points_draw'] = $_POST['liga_points_draw'];
  $data['edit']['liga_points_loose'] = $_POST['liga_points_loose'];    
  $liga_id = (int) $_POST['liga_id'];
    
  $error = 0;
  $errormsg = $cs_lang['error'];
  if(empty($data['edit']['liga_name'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga_name'];
	$error++;
  }
  if(empty($data['edit']['liga_year'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga_year'];
	$error++;
  }
  if(empty($data['edit']['liga_max_teams'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga_max_teams'];
	$error++;
  }  
  if(empty($data['edit']['liga_order'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga_order'];
	$error++;
  }   
  if(empty($data['edit']['liga_points_win']) OR empty($data['edit']['liga_points_draw'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_points'];
	$error++;
  }    
} else {
  $liga_id = (int) $_GET['liga_id'];
  $select = 'liga_manager_ligen_id, liga_name, liga_year, liga_max_teams, liga_order, liga_points_win, liga_points_draw, liga_points_loose';
  $where = "liga_manager_ligen_id = '" . $liga_id . "'";
  $data['edit'] = cs_sql_select(__FILE__,'liga_manager_ligen',$select,$where,0,0,1);
}

if(!isset($_POST['submit'])) {
  $data['head']['body_text'] = $cs_lang['create_body'];
} elseif(!empty($error)) {
  $data['head']['body_text'] = $errormsg;
} 

if(!isset($_POST['submit']) OR !empty($error)) {
  $data['data']['liga_id'] = $liga_id;
  $data['url']['edit'] = cs_url('liga_manager','edit_liga');
} else {
  $data['edit']['liga_max_teams'] = (int) $data['edit']['liga_max_teams'];
  $data['edit']['liga_order'] = (int) $data['edit']['liga_order'];
  $liga_cells = array_keys($data['edit']);
  $liga_save = array_values($data['edit']);
  cs_sql_update(__FILE__,'liga_manager_ligen',$liga_cells,$liga_save,$liga_id);
  cs_redirect($cs_lang['changes_done'],'liga_manager','manage_ligen');
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','edit_liga');
?>