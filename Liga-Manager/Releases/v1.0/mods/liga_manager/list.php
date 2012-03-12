<?php
$cs_lang = cs_translate('liga_manager');
$data = array();

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
  $select = 'liga_manager_ligen_id, liga_name, liga_year';
  $where = "liga_manager_ligen_id = '" . $_GET['liga_id'] . "'";
  $data['liga'] = cs_sql_select(__FILE__,'liga_manager_ligen',$select,$where,0,0,1);
  
  $from = 'liga_manager_ttl ttl INNER JOIN {pre}_liga_manager_teams tea ON ttl.team_id = tea.liga_manager_teams_id';
  $select = 'ttl.liga_manager_ttl_id AS ttl_id, ttl.liga_id AS liga_id, ttl.team_id AS team_id, tea.team_name AS team_name';
  $where = "liga_id = '" . $data['liga']['liga_manager_ligen_id'] . "'";
  $teams = cs_sql_select(__FILE__,$from,$select,$where,0,0,0);
  for($run=0; $run<count($teams); $run++) {
    $select = 'liga_manager_games_id, liga_id, team1_id, team2_id, games_time, score_team1, score_team2, winning_team_id';
	$where = "liga_id = '" . $teams[$run]['liga_id'] . "'";
	$where .=" AND team1_id = '" . $teams[$run]['team_id'] . "' OR team2_id = '" . $teams[$run]['team_id'] . "'";
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
	    $team_points = $team_points + 3;
	    $wins++;
	  } elseif($team_game[$runb]['winning_team_id'] == 0) {
	    $team_points = $team_points +1;
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
	$data['teams'][$run]['points'] = $team_points;
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
}
usort($data['teams'], "sorter");
function sorter($a, $b) {
  $test = strnatcasecmp($b["points"], $a["dif"]);
  $test = strnatcasecmp($b["dif"], $a["dif"]);
  return $test;
}
for($run=0; $run<count($data['teams']); $run++) {
  $data['teams'][$run]['place'] = $run+1;
  $data['teams'][$run]['class'] = $run == 0 ? 'centerb' : 'centerc';
  $data['teams'][$run]['class2'] = $run == 0 ? 'leftb' : 'leftc';  
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','list');
?>