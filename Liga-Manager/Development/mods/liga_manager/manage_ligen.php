<?php
$cs_lang = cs_translate('liga_manager');
$data = array();

$start = empty($_REQUEST['start']) ? 0 : $_REQUEST['start'];
$cs_sort[1] = 'liga_order DESC';
$cs_sort[2] = 'liga_order ASC';
$sort = empty($_REQUEST['sort']) ? 1 : $_REQUEST['sort'];
$order = $cs_sort[$sort];

$data['url']['create_liga'] = cs_url('liga_manager','create_liga');
$data['count']['ligen'] = cs_sql_count(__FILE__,'liga_manager_ligen');
$data['url']['back'] = cs_url('liga_manager','manage');
$data['pages']['list'] = cs_pages('liga_manager','manage_ligen',$data['count']['ligen'],$start,0,0);

$data['msg']['redirect'] = cs_getmsg();

$data['sort']['order'] = cs_sort('liga_manager', 'manage_ligen', $start, 0, 1, $sort);

$select = 'liga_manager_ligen_id, liga_name, liga_year, liga_max_teams, liga_order';
$ligen = cs_sql_select(__FILE__,'liga_manager_ligen',$select,0,$order,$start,$account['users_limit']);
if(!empty($ligen)) {
  for($run=0; $run<count($ligen); $run++) {
    $data['ligen'][$run]['liga_name'] = $ligen[$run]['liga_name'];
    $data['ligen'][$run]['liga_year'] = $ligen[$run]['liga_year'];
	$data['ligen'][$run]['liga_max_teams'] = $ligen[$run]['liga_max_teams'];
	$data['ligen'][$run]['liga_order'] = $ligen[$run]['liga_order'];
    $data['ligen'][$run]['edit'] = cs_link(cs_icon('edit'),'liga_manager','edit_liga','liga_id=' . $ligen[$run]['liga_manager_ligen_id']);
    $data['ligen'][$run]['remove'] = cs_link(cs_icon('editdelete'),'liga_manager','remove_liga','liga_id=' . $ligen[$run]['liga_manager_ligen_id']);
  }
} else {
  $data['ligen'] = array();
}

echo cs_subtemplate(__FILE__,$data,'liga_manager','manage_ligen');
?>