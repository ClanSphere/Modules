<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: manage.php 587 2011-03-31 06:38:06Z hajo $

$cs_lang = cs_translate('feedback');
$cs_post = cs_post('start,sort');
$cs_get = cs_get('start,sort');
$data = array();

$start = empty($cs_get['start']) ? 0 : $cs_get['start'];
if (!empty($cs_post['start']))  $start = $cs_post['start'];
$sort = empty($cs_get['sort']) ? 1 : $cs_get['sort'];
if (!empty($cs_post['sort']))  $sort = $cs_post['sort'];

$cs_sort[1] = 'feedback_id DESC';
$cs_sort[2] = 'feedback_id ASC';
$cs_sort[3] = 'feedback_name ASC';
$cs_sort[4] = 'feedback_name DESC';
$cs_sort[5] = 'feedback_switch DESC, feedback_name ASC';
$cs_sort[6] = 'feedback_switch ASC, feedback_name DESC';
$order = $cs_sort[$sort];

$data['count']['all'] = cs_sql_count(__FILE__,'feedback');
$data['pages']['list'] = cs_pages('feedback','manage',$data['count']['all'],$start,0,$sort);

$data['head']['message'] = cs_getmsg();

$data['sort']['id'] = cs_sort('feedback','manage',$start,0,1,$sort);
$data['sort']['name'] = cs_sort('feedback','manage',$start,0,3,$sort);
$data['sort']['switch'] = cs_sort('feedback','manage',$start,0,5,$sort);

$select = 'feedback_id, feedback_name, feedback_switch';
$data['feedback'] = cs_sql_select(__FILE__,'feedback',$select,0,$order,$start,$account['users_limit']);
$count_feedback = count($data['feedback']);

for ($run = 0; $run < $count_feedback; $run++) {
  $data['feedback'][$run]['feedback_name'] = cs_secure($data['feedback'][$run]['feedback_name']);
  $data['feedback'][$run]['switch'] = empty($data['feedback'][$run]['feedback_switch']) ? $cs_lang['off'] : $cs_lang['on'];
  $data['feedback'][$run]['entries'] = cs_sql_count(__FILE__, 'feedbackmail', 'feedback_id = ' . (int) $data['feedback'][$run]['feedback_id']);
}

echo cs_subtemplate(__FILE__,$data,'feedback','manage');