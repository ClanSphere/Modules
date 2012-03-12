<?php
$cs_lang = cs_translate('liga_manager');
$data = array();

$start = empty($_REQUEST['start']) ? 0 : $_REQUEST['start'];
$sort = empty($_REQUEST['sort']) ? 1 : $_REQUEST['sort'];

$data['url']['create'] = cs_url('liga_manager','create_game');
$data['count']['games'] = cs_sql_count(__FILE__,'liga_manager_games');
$data['pages']['list'] = cs_pages('liga_manager','manage_games',$data['count']['games'],$start,0,0);
$data['url']['back'] = cs_url('liga_manager','manage');

$select = 'liga_manager_ligen_id, liga_max_teams, liga_name';
$ligen = cs_sql_select(__FILE__,'liga_manager_ligen',$select,0,0,0,0);
$data['ligen'] = array();
$data['if']['liga'] = false;
if(!empty($ligen)) {
  $data['if']['liga'] = true;
  for($run=0; $run<count($ligen); $run++) {
    $where = "liga_id = '" . $ligen[$run]['liga_manager_ligen_id'] . "'";
    $teams = cs_sql_count(__FILE__,'liga_manager_ttl',$where);
	$sum = $ligen[$run]['liga_max_teams'] - $teams;
	if(!empty($sum)) {
	  $data['ligen'][$run]['if']['not_enough'] = true;
	  $data['ligen'][$run]['liga_name'] = sprintf($cs_lang['not_enough_teams'], $ligen[$run]['liga_name']);
	} else {
	  $data['ligen'][$run]['if']['not_enough'] = false;
    }
  }
} 

$select = 'liga_manager_games_id, liga_id, team1_id, team2_id, games_time, score_team1, score_team2, winning_team_id';
$games = cs_sql_select(__FILE__,'liga_manager_games',$select,0,'games_time DESC',0,$account['users_limit']);
$data['games'] = array();
if(!empty($games)) {
  for($run=0; $run<count($games); $run++) {
    $select = 'liga_manager_ligen_id, liga_name';
    $where = "liga_manager_ligen_id = '" . $games[$run]['liga_id'] . "'";
    $liga = cs_sql_select(__FILE__,'liga_manager_ligen',$select,$where,0,0,1);
    $data['games'][$run]['liga'] = $liga['liga_name'];
	
	$select = 'liga_manager_teams_id, team_short';
    $where = "liga_manager_teams_id = '" . $games[$run]['team1_id'] . "'";
    $team1 = cs_sql_select(__FILE__,'liga_manager_teams',$select,$where,0,0,1);
	$data['games'][$run]['team1'] = $team1['team_short'];
	
    $where = "liga_manager_teams_id = '" . $games[$run]['team2_id'] . "'";
    $team2 = cs_sql_select(__FILE__,'liga_manager_teams',$select,$where,0,0,1);
	$data['games'][$run]['team2'] = $team2['team_short'];
	
	$data['games'][$run]['score'] = $games[$run]['score_team1'] . ' : ' . $games[$run]['score_team2'];
	$data['games'][$run]['time'] = cs_date('unix',$games[$run]['games_time'],0);
	$data['games'][$run]['edit'] = cs_link(cs_icon('edit'),'liga_manager','edit_game','gam_id=' . $games[$run]['liga_manager_games_id']);
	$data['games'][$run]['remove'] = cs_link(cs_icon('editdelete'),'liga_manager','remove_game','gam_id=' . $games[$run]['liga_manager_games_id']);	
	
  }
}  
echo cs_subtemplate(__FILE__,$data,'liga_manager','manage_games');
?>