<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: details.php 587 2011-03-31 06:38:06Z hajo $

$cs_lang = cs_translate('feedback');
$cs_post = cs_post('start,sort');
$cs_get = cs_get('start,sort');

$data = array();

$id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];
settype($id,'integer');

$select = 'feedback_name, feedback_switch, feedback_question';
$cs_feedback = cs_sql_select(__FILE__, 'feedback', $select, 'feedback_id = ' . $id);

$data['feedback']['id'] = $id;
$data['feedback']['name'] = cs_secure($cs_feedback['feedback_name']);
$data['feedback']['question'] = cs_secure($cs_feedback['feedback_question'], 1, 1, 1, 1);

$start = empty($cs_get['start']) ? 0 : $cs_get['start'];
if (!empty($cs_post['start']))  $start = $cs_post['start'];
$sort = empty($cs_get['sort']) ? 1 : $cs_get['sort'];
if (!empty($cs_post['sort']))  $sort = $cs_post['sort'];

$cs_sort[1] = 'feedbackmail_time DESC';
$cs_sort[2] = 'feedbackmail_time ASC';
$cs_sort[3] = 'feedbackmail_email ASC';
$cs_sort[4] = 'feedbackmail_email DESC';
$order = $cs_sort[$sort];

$data['count']['all'] = cs_sql_count(__FILE__,'feedbackmail', 'feedback_id = ' . (int) $id);
$data['pages']['list'] = cs_pages('feedback','details',$data['count']['all'],$start,0,$sort);

$data['head']['message'] = cs_getmsg();

$data['sort']['time'] = cs_sort('feedback','details',$start,0,1,$sort);
$data['sort']['email'] = cs_sort('feedback','details',$start,0,3,$sort);

$select = 'feedbackmail_id, feedbackmail_time, feedbackmail_email, feedbackmail_text';
$data['feedbackmail'] = cs_sql_select(__FILE__,'feedbackmail',$select,'feedback_id = ' . (int) $id,$order,$start,$account['users_limit']);
$count_feedback = count($data['feedbackmail']);

for ($run = 0; $run < $count_feedback; $run++) {
  $data['feedbackmail'][$run]['email'] = cs_secure($data['feedbackmail'][$run]['feedbackmail_email']);
  $data['feedbackmail'][$run]['date'] = cs_date('unix', $data['feedbackmail'][$run]['feedbackmail_time'], 1);
  $data['feedbackmail'][$run]['text'] = cs_secure($data['feedbackmail'][$run]['feedbackmail_text']);
}

echo cs_subtemplate(__FILE__,$data,'feedback','details');