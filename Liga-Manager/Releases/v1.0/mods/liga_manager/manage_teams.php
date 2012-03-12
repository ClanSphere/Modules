<?php
$cs_lang = cs_translate('liga_manager');
$data = array();

$start = empty($_REQUEST['start']) ? 0 : $_REQUEST['start'];

$data['url']['create_team'] = cs_url('liga_manager','create_team');
$data['count']['teams'] = cs_sql_count(__FILE__,'liga_manager_teams');
$data['url']['back'] = cs_url('liga_manager','manage');
$data['pages']['list'] = cs_pages('liga_manager','manage_teams',$data['count']['teams'],$start,0,0);

$data['msg']['redirect'] = cs_getmsg();


$select = 'liga_manager_teams_id, team_name, team_short';
$teams = cs_sql_select(__FILE__,'liga_manager_teams',$select,0,0,$start,$account['users_limit']);
$data['teams'] = array();
if(!empty($teams)) {
  for($run=0; $run<count($teams); $run++) {
    $data['teams'][$run]['team_name'] = $teams[$run]['team_name'];
    $data['teams'][$run]['team_short'] = $teams[$run]['team_short'];
    $data['teams'][$run]['edit'] = cs_link(cs_icon('edit'),'liga_manager','edit_team','team_id=' . $teams[$run]['liga_manager_teams_id']);
    $data['teams'][$run]['remove'] = cs_link(cs_icon('editdelete'),'liga_manager','remove_team','team_id=' . $teams[$run]['liga_manager_teams_id']);
  }
}
echo cs_subtemplate(__FILE__,$data,'liga_manager','manage_teams');
?>