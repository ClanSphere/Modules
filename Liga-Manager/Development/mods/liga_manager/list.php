<?php
$cs_lang = cs_translate('liga_manager');

// Color Classes
// Rank 1
$rank_center_1 = 'centerb';
$rank_left_1 = 'leftb';
// last 3 Ranks
$rank_center_last = 'bottom';
$rank_left_last = 'bottom';

$data = array();
function multiarray_sort($arg1,$arg2) {
  $return = $arg2['points'] - $arg1['points'];
  return $return == 0 ? $arg2['dif'] > $arg1['dif'] : $return;
} 

if(empty($_GET['liga_id'])) {
  $data['if']['liga'] = false;
  $data['if']['overview'] = true;  
  $select = 'liga_manager_ligen_id, liga_name, liga_year, liga_order';
  $ligen = cs_sql_select(__FILE__,'liga_manager_ligen',$select,0,'liga_order DESC',0,0);
  $data['ligen'] = array();
  if(!empty($ligen)) {
    for($run=0; $run<count($ligen); $run++) {
	  $link = $ligen[$run]['liga_name'] . ' ' . $ligen[$run]['liga_year'];
	  $data['ligen'][$run]['liga_name'] = cs_link($link,'liga_manager','list','liga_id=' . $ligen[$run]['liga_manager_ligen_id']);
	  
	}
  }
} else {
  $data['if']['liga'] = true;
  $data['if']['overview'] = false;  
  
  // Get Last Game-Day
  $last_day = cs_sql_select(__FILE__,'liga_manager_games','liga_id, games_day',"liga_id = '" . $_GET['liga_id'] . "'",'games_day DESC',0,1);
  $select = 'liga_manager_games_id, liga_id, team1_id, team2_id, games_time, games_day, score_team1, score_team2, winning_team_id';
  $where = "liga_id = '" . $_GET['liga_id'] . "' AND games_day = '" . $last_day['games_day'] . "'";
  $games_day = cs_sql_select(__FILE__,'liga_manager_games',$select,$where,0,0,0);
  if(!empty($games_day)) {
  $data['day']['overview'] = sprintf($cs_lang['games_day_overview'], $last_day['games_day']);
    for($run=0; $run<count($games_day); $run++) {
      $data['games'][$run]['run'] = $run+1;
      $where = "liga_manager_teams_id = '" . $games_day[$run]['team1_id'] . "'";
      $team1 = cs_sql_select(__FILE__,'liga_manager_teams','liga_manager_teams_id, team_name',$where,0,0,1);
	  $data['games'][$run]['team1'] = $team1['team_name'];
      $where = "liga_manager_teams_id = '" . $games_day[$run]['team2_id'] . "'";
      $team2 = cs_sql_select(__FILE__,'liga_manager_teams','liga_manager_teams_id, team_name',$where,0,0,1);
	  $data['games'][$run]['team2'] = $team2['team_name'];	
	  $data['games'][$run]['time'] = cs_date('unix',$games_day[$run]['games_time'],1);
	  $data['games'][$run]['goals'] = $games_day[$run]['score_team1'] . ' : ' . $games_day[$run]['score_team2'];
    }
  } else {
    $data['games'] = '';
	$data['day']['overview'] = 'Keine Spieltage eingetragen';
  }
  
  
  $select = 'liga_manager_ligen_id, liga_name, liga_year, liga_points_win, liga_points_draw';
  $where = "liga_manager_ligen_id = '" . $_GET['liga_id'] . "'";
  $data['liga'] = cs_sql_select(__FILE__,'liga_manager_ligen',$select,$where,0,0,1);
  
  $from = 'liga_manager_ttl ttl INNER JOIN {pre}_liga_manager_teams tea ON ttl.team_id = tea.liga_manager_teams_id';
  $select = 'ttl.liga_manager_ttl_id AS ttl_id, ttl.liga_id AS liga_id, ttl.team_id AS team_id, tea.team_name AS team_name';
  $where = "liga_id = '" . $data['liga']['liga_manager_ligen_id'] . "'";
  $teams = cs_sql_select(__FILE__,$from,$select,$where,0,0,0);
  for($run=0; $run<count($teams); $run++) {
    $select = 'liga_manager_games_id, liga_id, team1_id, team2_id, games_time, score_team1, score_team2, winning_team_id';
	$where = "liga_id = '" . $teams[$run]['liga_id'] . "'";
	$where .=" AND team1_id = '" . $teams[$run]['team_id'] . "' OR liga_id = '" . $teams[$run]['liga_id'] . "'";
	$where .= " AND team2_id = '" . $teams[$run]['team_id'] . "'";
    $team_game = cs_sql_select(__FILE__,'liga_manager_games',$select,$where,0,0,0);
	$games = 0;
    $wins = 0;
	$draws = 0;
	$loose = 0;
	$team_points = 0;
    $goal_win = 0;
    $goal_loose = 0;
	for($runb = 0; $runb<count($team_game); $runb++) {
	  $games++;
	  if($teams[$run]['team_id'] == $team_game[$runb]['winning_team_id']) {
	    $team_points = $team_points + $data['liga']['liga_points_win'];
	    $wins++;
	  } elseif($team_game[$runb]['winning_team_id'] == 0) {
	    $team_points = $team_points + $data['liga']['liga_points_draw'];
		$draws++;
	  } else {
	    $loose++;
	  }
	  if($teams[$run]['team_id'] == $team_game[$runb]['team1_id']) {
	    $goal_win = $goal_win + $team_game[$runb]['score_team1'];
        $goal_loose = $goal_loose + $team_game[$runb]['score_team2'];
	  } else {
	    $goal_win = $goal_win + $team_game[$runb]['score_team2'];
        $goal_loose = $goal_loose + $team_game[$runb]['score_team1'];
	  }
	}
    $data['teams'][$run]['team_name'] = $teams[$run]['team_name'];
	$data['teams'][$run]['games'] = $games;
	$data['teams'][$run]['wins'] = $wins;
	$data['teams'][$run]['draws'] = $draws;	
	$data['teams'][$run]['loose'] = $loose;
	$data['teams'][$run]['goal_wins'] = $goal_win;
	$data['teams'][$run]['goal_loose'] = $goal_loose;
	$data['teams'][$run]['dif'] = $goal_win - $goal_loose;
	$data['teams'][$run]['points'] = $team_points;
  }
  usort($data['teams'], "multiarray_sort");
  $count = count($data['teams']);
  for($run=0; $run<$count; $run++) {
    $runb = $run+1;
    $data['teams'][$run]['place'] = $runb;
	// Rank 1
    $data['teams'][$run]['class'] = $runb == 1 ? $rank_center_1 : 'centerc';
    $data['teams'][$run]['class2'] = $runb == 1 ? $rank_left_1 : 'leftc';  
	
	// Last 3 Ranks
	if($runb == $count OR $runb == $count-1 OR $runb == $count-2) {
      $data['teams'][$run]['class'] = $rank_center_last;
      $data['teams'][$run]['class2'] = $rank_left_last;
	} 

  }   
}
$data['url']['back'] = cs_url('liga_manager');
echo cs_subtemplate(__FILE__,$data,'liga_manager','list');
?>