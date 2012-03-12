<?php
$cs_lang = cs_translate('liga_manager');
$data = array();


if(isset($_POST['submit'])) {
  $data['create']['liga_id'] = $_POST['liga_id'];
  $data['create']['team1_id'] = $_POST['team1_id'];
  $data['create']['team2_id'] = $_POST['team2_id'];
  $data['create']['score_team1'] = $_POST['score_team1'];  
  $data['create']['score_team2'] = $_POST['score_team2'];    
  $data['create']['games_time'] = cs_datepost('games_time','unix');
  
  $error = 0;
  $errormsg = $cs_lang['error'];
  if(empty($data['create']['liga_id'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga'];
	$error++;
  }
  if(empty($data['create']['team1_id'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team1'];
	$error++;
  }
  if(empty($data['create']['team2_id'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team2'];
	$error++;
  }
  if(!empty($data['create']['team1_id']) AND !empty($data['create']['team2_id']) AND $data['create']['team1_id'] == $data['create']['team2_id']) {
    $errormsg .= cs_html_br(1) . $cs_lang['same_team'];
    $error++;  
  }
} else {
  $data['create']['liga_id'] = '';
  $data['create']['team1_id'] = '';
  $data['create']['team2_id'] = '';  
  $data['create']['score_team1'] = '0';
  $data['create']['score_team2'] = '0';
  $data['create']['games_time'] = cs_time();
}

if(!isset($_POST['submit'])) {
  $data['head']['body_text'] = $cs_lang['create_body'];
} elseif(!empty($error)) {
  $data['head']['body_text'] = $errormsg;
} 
if(isset($_POST['cancel'])) {
  cs_redirect($cs_lang['cancel'],'liga_manager','manage_games');
}

if(!isset($_POST['submit']) OR !empty($error)) {
    $data['url']['create'] = cs_url('liga_manager','create_game');
	$ligen_data = cs_sql_select(__FILE__,'liga_manager_ligen','*',0,'liga_order DESC',0,0);
    $data['dropdown']['liga'] = cs_dropdown('liga_id','liga_name',$ligen_data,$data['create']['liga_id'],'liga_manager_ligen_id');
    $team1 = cs_sql_select(__FILE__,'liga_manager_teams','*',0,'team_name DESC',0,0);
    $data['dropdown']['team1'] = cs_dropdown('team1_id','team_name',$team1,$data['create']['team1_id'],'liga_manager_teams_id'); 
    $data['dropdown']['team2'] = cs_dropdown('team2_id','team_name',$team1,$data['create']['team2_id'],'liga_manager_teams_id'); 
	$data['create']['games_time'] = cs_dateselect('games_time','unix',$data['create']['games_time'],2000);
} else {
  if($data['create']['score_team1'] > $data['create']['score_team2']) {
    $data['create']['winning_team_id'] = $data['create']['team1_id'];
  } elseif($data['create']['score_team1'] < $data['create']['score_team2']) {
    $data['create']['winning_team_id'] = $data['create']['team2_id'];
  } else {
    $data['create']['winning_team_id'] = 0;
  }
  $game_cells = array_keys($data['create']);
  $game_save = array_values($data['create']);
  cs_sql_insert(__FILE__,'liga_manager_games',$game_cells,$game_save);
  cs_redirect($cs_lang['create_done'],'liga_manager','manage_games');
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','create_game');
?>