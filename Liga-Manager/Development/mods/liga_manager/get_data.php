<?php
// ClanSphere 2008 - www.clansphere.net
// $Id: $  

@error_reporting(E_ALL);

@ini_set('arg_separator.output','&amp;');
@ini_set('session.use_trans_sid','0');
@ini_set('session.use_cookies','1');
@ini_set('session.use_only_cookies','1');
@ini_set('display_errors','on');
@ini_set('magic_quotes_runtime','off');

$cs_logs = array('errors' => '', 'sql' => '', 'queries' => 0, 'warnings' => 0, 'dir' => 'logs');

chdir('../../');
require_once('system/core/functions.php');

if(file_exists('setup.php')) {
  require_once('setup.php');
  require_once('system/database/' . $cs_db['type'] . '.php');
  $cs_db['con'] = cs_sql_connect($cs_db);
  $cs_main = cs_sql_option(__FILE__,'clansphere');
}
else
{
  die('<a href="install.php">Installation required</a> or missing setup.php');
}

require('system/output/xhtml_10.php');
require('system/core/tools.php');

if(!empty($_GET['liga1'])) {
  $liga_id = cs_sql_escape($_GET['liga1']);
  $from = "liga_manager_ttl ttl INNER JOIN {pre}_liga_manager_teams tea ON ttl.team_id = tea.liga_manager_teams_id";
  $select = "ttl.team_id AS team_id, tea.liga_manager_teams_id AS liga_manager_teams_id, tea.team_name AS team_name";
  $where = "liga_id = '" . $liga_id . "'";
  $team1 = cs_sql_select(__FILE__,$from,$select,$where,'team_name DESC',0,0);
  echo cs_dropdown('team1_id','team_name',$team1,0,'liga_manager_teams_id'); 
}
if(!empty($_GET['liga2'])) {
  $liga_id = cs_sql_escape($_GET['liga2']);
  $from = "liga_manager_ttl ttl INNER JOIN {pre}_liga_manager_teams tea ON ttl.team_id = tea.liga_manager_teams_id";
  $select = "ttl.team_id AS team_id, tea.liga_manager_teams_id AS liga_manager_teams_id, tea.team_name AS team_name";
  $where = "liga_id = '" . $liga_id . "'";
  $team2 = cs_sql_select(__FILE__,$from,$select,$where,'team_name DESC',0,0);
  echo cs_dropdown('team2_id','team_name',$team2,0,'liga_manager_teams_id'); 
}
if(!empty($_GET['team'])) {
  $liga_id = cs_sql_escape($_GET['team']);
  $team = array();
  $teams = cs_sql_select(__FILE__,'liga_manager_teams','liga_manager_teams_id, team_name',0,0,0,0);
  for($run=0; $run<count($teams); $run++) {
    $ttl = cs_sql_count(__FILE__,'liga_manager_ttl',"liga_id = '" . $liga_id . "' AND team_id = '" . $teams[$run]['liga_manager_teams_id'] . "'");
	if(empty($ttl)) {
	  $team[] = array('team_name' => $teams[$run]['team_name'], 'team_id' => $teams[$run]['liga_manager_teams_id']);
	} 
  }
  echo cs_dropdown('team_id','team_name',$team,0,'team_id');
}
if(!empty($_GET['day'])) {
  $liga_id = cs_sql_escape($_GET['day']);
  $day = array();
  $where = "liga_manager_ligen_id = '" . $liga_id . "'";
  $liga = cs_sql_select(__FILE__,'liga_manager_ligen','liga_manager_ligen_id, liga_max_teams',$where,0,0,1);
  $max_days = ($liga['liga_max_teams'] - 1) * 2;
  for($run=0; $run<$max_days; $run++) {
    $runb = $run+1;
    $day[] = array('day' => $runb, 'day_id' => $runb);
  }
  echo cs_dropdown('day_id','day',$day,0,'day_id');
}
?>