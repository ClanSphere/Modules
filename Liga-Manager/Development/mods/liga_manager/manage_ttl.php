<?php
$cs_lang = cs_translate('liga_manager');

$liga_id = empty($_REQUEST['where']) ? 0 : (int) $_REQUEST['where'];
$start = empty($_REQUEST['start']) ? 0 : (int) $_REQUEST['start'];
$where = empty($_REQUEST['where']) ? 0 : "liga_id = '" . (int) $_REQUEST['where'] . "'";

$data = array();
$data['url']['create'] = cs_url('liga_manager','create_ttl');
$data['count']['ttl'] = cs_sql_count(__FILE__,'liga_manager_ttl',$where);
$data['url']['back'] = cs_url('liga_manager','manage');
$data['pages']['list'] = cs_pages('liga_manager','manage_ttl',$data['count']['ttl'] ,$start,0,0);

$data['url']['form'] = cs_url('liga_manager','manage_ttl');
$ligen_data = cs_sql_select(__FILE__,'liga_manager_ligen','*',0,'liga_order DESC',0,0);
$data['head']['dropdown'] = cs_dropdown('where','liga_name',$ligen_data,$liga_id,'liga_manager_ligen_id');
$data['head']['button'] = cs_html_vote('submit',$cs_lang['show'],'submit');

$data['head']['getmsg'] = cs_getmsg();

$from = 'liga_manager_ttl ttl INNER JOIN {pre}_liga_manager_ligen lig ON ttl.liga_id = lig.liga_manager_ligen_id';
$from .= ' INNER JOIN {pre}_liga_manager_teams tea ON ttl.team_id = tea.liga_manager_teams_id';
$select = 'ttl.liga_manager_ttl_id AS ttl_id, tea.team_name AS team_name, lig.liga_name AS liga_name, ttl.liga_id AS liga_id';
$ttl = cs_sql_select(__FILE__,$from,$select,$where,0,$start,$account['users_limit']);
$data['ttl'] = array();
if(!empty($ttl)) {
  for($run=0; $run<count($ttl); $run++)  {
    $data['ttl'][$run]['team_name'] = $ttl[$run]['team_name'];
    $data['ttl'][$run]['liga_name'] = $ttl[$run]['liga_name'];
	$data['ttl'][$run]['edit'] = cs_link(cs_icon('editdelete'),'liga_manager','remove_ttl','ttl_id=' . $ttl[$run]['ttl_id']);
  }
}

echo cs_subtemplate(__FILE__,$data,'liga_manager','manage_ttl');
?>