<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: list.php 587 2011-03-31 06:38:06Z hajo $

$cs_lang = cs_translate('feedback');
$cs_post = cs_post('start,sort');
$cs_get = cs_get('start,sort');

$start = empty($cs_get['start']) ? 0 : $cs_get['start'];
if (!empty($cs_post['start']))  $start = $cs_post['start'];
$sort = empty($cs_get['sort']) ? 1 : $cs_get['sort'];
if (!empty($cs_post['sort']))  $sort = $cs_post['sort'];

$cs_sort[1] = 'feedback_id DESC';
$cs_sort[2] = 'feedback_id ASC';
$cs_sort[3] = 'feedback_name ASC';
$cs_sort[4] = 'feedback_name DESC';
$order = $cs_sort[$sort];

$tables = 'feedback';
$where = 'feedback_switch = 1';
$data['head']['feedback_count'] = cs_sql_count(__FILE__,$tables,$where);
$data['head']['pages'] = cs_pages('feedback','list',$data['head']['feedback_count'],$start,0,$sort);

$select = 'feedback_id, feedback_name';
$cs_feedback = cs_sql_select(__FILE__,$tables,$select,$where,$order,$start,$account['users_limit']);
$feedback_loop = count($cs_feedback);

$data['sort']['id'] = cs_sort('feedback','list',$start,0,1,$sort);
$data['sort']['name'] = cs_sort('feedback','list',$start,0,3,$sort);

for($run=0; $run<$feedback_loop; $run++) {

  $sec_head = cs_secure($cs_feedback[$run]['feedback_name']);
  $cs_feedback[$run]['feedback_name'] = cs_link($sec_head,'feedback','mail','id=' . $cs_feedback[$run]['feedback_id']);
}

$data['feedback'] = $cs_feedback;

echo cs_subtemplate(__FILE__,$data,'feedback','list');