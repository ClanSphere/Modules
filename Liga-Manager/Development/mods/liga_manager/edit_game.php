<?php
$cs_lang = cs_translate('liga_manager');
$data = array();
require('mods/liga_manager/functions.php');

if(isset($_POST['submit'])) {
  $data['edit']['liga_id'] = $_POST['liga_id'];
  $data['edit']['team1_id'] = $_POST['team1_id'];
  $data['edit']['team2_id'] = $_POST['team2_id'];
  $data['edit']['score_team1'] = $_POST['score_team1'];  
  $data['edit']['score_team2'] = $_POST['score_team2'];    
  $data['edit']['games_time'] = cs_datepost('games_time','unix');
  $data['edit']['games_day'] = $_POST['day_id'];
  $data['data']['gam_id'] = (int) $_POST['gam_id'];

  
  $error = 0;
  $errormsg = $cs_lang['error'];
  if(empty($data['edit']['liga_id'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_liga'];
	$error++;
  }
  if(empty($data['edit']['team1_id'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team1'];
	$error++;
  }
  if(empty($data['edit']['team2_id'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_team2'];
	$error++;
  }
  if(!empty($data['edit']['team1_id']) AND !empty($data['edit']['team2_id']) AND $data['edit']['team1_id'] == $data['edit']['team2_id']) {
    $errormsg .= cs_html_br(1) . $cs_lang['same_team'];
    $error++;  
  }
  if(empty($data['edit']['games_day'])) {
    $errormsg .= cs_html_br(1) . $cs_lang['no_day'];
	$error++;
  }  
} else {
  $data['data']['gam_id'] = (int) $_GET['gam_id'];
  $select = 'liga_manager_games_id, liga_id, team1_id, team2_id, games_time, games_day, score_team1, score_team2';
  $where = "liga_manager_games_id = '" . $data['data']['gam_id'] . "'";
  $game = cs_sql_select(__FILE__,'liga_manager_games',$select,$where,0,0,1);
  $data['edit'] = $game;
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
    $data['url']['edit'] = cs_url('liga_manager','edit_game');
	$ligen_data = cs_sql_select(__FILE__,'liga_manager_ligen','*',0,'liga_order DESC',0,0);
    $data['dropdown']['liga'] = cs_liga_dropdown('liga_id','liga_name',$ligen_data,$data['edit']['liga_id'],'liga_manager_ligen_id');
    $team1 = cs_sql_select(__FILE__,'liga_manager_teams','*',0,'team_name DESC',0,0);
    $data['dropdown']['team1'] = cs_dropdown('team1_id','team_name',$team1,$data['edit']['team1_id'],'liga_manager_teams_id'); 
    $data['dropdown']['team2'] = cs_dropdown('team2_id','team_name',$team1,$data['edit']['team2_id'],'liga_manager_teams_id'); 
	$data['edit']['games_time'] = cs_dateselect('games_time','unix',$data['edit']['games_time'],2000);
	$day = array();
    $where = "liga_manager_ligen_id = '" . $data['edit']['liga_id'] . "'";
    $liga = cs_sql_select(__FILE__,'liga_manager_ligen','liga_manager_ligen_id, liga_max_teams',$where,0,0,1);
    $max_days = ($liga['liga_max_teams'] - 1) * 2;
    for($run=0; $run<$max_days; $run++) {
      $runb = $run+1;
      $day[] = array('day' => $runb, 'day_id' => $runb);
    }
    $data['dropdown']['day'] = cs_dropdown('day_id','day',$day,$data['edit']['games_day'],'day_id');
} else {
  if($data['edit']['score_team1'] > $data['edit']['score_team2']) {
    $data['edit']['winning_team_id'] = $data['edit']['team1_id'];
  } elseif($data['edit']['score_team1'] < $data['edit']['score_team2']) {
    $data['edit']['winning_team_id'] = $data['edit']['team2_id'];
  } else {
    $data['edit']['winning_team_id'] = 0;
  }
  $game_cells = array_keys($data['edit']);
  $game_save = array_values($data['edit']);
  cs_sql_update(__FILE__,'liga_manager_games',$game_cells,$game_save,$data['data']['gam_id']);
  cs_redirect($cs_lang['changes_done'],'liga_manager','manage_games');
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','edit_game');
?>