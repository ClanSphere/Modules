<?php
$cs_lang = cs_translate('liga_manager');
$data = array();

if(isset($_POST['submit'])) {
  $data['create']['liga_name'] = $_POST['liga_name'];
  $data['create']['liga_year'] = $_POST['liga_year'];
  $data['create']['liga_max_teams'] = $_POST['liga_max_teams'];
  $data['create']['liga_order'] = $_POST['liga_order'];  
  $data['create']['liga_points_win'] = $_POST['liga_points_win'];
  $data['create']['liga_points_draw'] = $_POST['liga_points_draw'];
  $data['create']['liga_points_loose'] = $_POST['liga_points_loose'];        
	
  $error = 0;
  $errormsg = $cs_lang['error'];
  if(empty($data['create']['liga_name'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga_name'];
	$error++;
  }
  if(empty($data['create']['liga_year'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga_year'];
	$error++;
  }
  if(empty($data['create']['liga_max_teams'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga_max_teams'];
	$error++;
  }  
  if(empty($data['create']['liga_order'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga_order'];
	$error++;
  }   
  if(empty($data['create']['liga_points_win']) AND empty($data['create']['liga_points_draw']) AND empty($data['create']['liga_points_loose'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_points'];
	$error++;
  }   
} else {
  $data['create']['liga_name'] = '';
  $data['create']['liga_year'] = '';
  $data['create']['liga_max_teams'] = ''; 
  $data['create']['liga_order'] = ''; 
  $data['create']['liga_points_win'] = '';
  $data['create']['liga_points_draw'] = '';
  $data['create']['liga_points_loose'] = '';
}

if(!isset($_POST['submit'])) {
  $data['head']['body_text'] = $cs_lang['create_body'];
} elseif(!empty($error)) {
  $data['head']['body_text'] = $errormsg;
} 

if(!isset($_POST['submit']) OR !empty($error)) {
  $data['url']['create'] = cs_url('liga_manager','create_liga');
} else {
  $data['create']['liga_max_teams'] = (int) $data['create']['liga_max_teams'];
  $data['create']['liga_order'] = (int) $data['create']['liga_order'];
  $liga_cells = array_keys($data['create']);
  $liga_save = array_values($data['create']);
  cs_sql_insert(__FILE__,'liga_manager_ligen',$liga_cells,$liga_save);
  cs_redirect($cs_lang['create_done'],'liga_manager','manage_ligen');
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','create_liga');
?>