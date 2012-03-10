<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: edit.php 587 2011-03-31 06:38:06Z hajo $

$cs_lang = cs_translate('feedback');
$cs_post = cs_post('id');
$cs_get = cs_get('id');

$feedback_id = empty($cs_get['id']) ? 0 : $cs_get['id'];
if (!empty($cs_post['id']))  $feedback_id = $cs_post['id'];

$select = 'feedback_name, feedback_switch, feedback_question';
$cs_feedback = cs_sql_select(__FILE__,'feedback',$select,"feedback_id = '" . $feedback_id . "'");

if(isset($_POST['submit'])) {

  $cs_feedback['feedback_name'] = $_POST['feedback_name'];
  $cs_feedback['feedback_switch'] = empty($_POST['feedback_switch']) ? 0 : 1;
  $cs_feedback['feedback_question'] = empty($cs_main['rte_html']) ? $_POST['feedback_question'] : cs_abcode_inhtml($_POST['feedback_question'], 'add');

  $error = '';

  if(empty($cs_feedback['feedback_name']))
    $error .= $cs_lang['no_name'] . cs_html_br(1);

  $where = "feedback_name = '" . cs_sql_escape($cs_feedback['feedback_name']) . "'"
         . " AND feedback_id != " . (int) $feedback_id;
  $search_collision = cs_sql_count(__FILE__,'feedback',$where);
  if(!empty($search_collision)) {
    $error .= $cs_lang['collision'] . cs_html_br(1);
  }
}

if(!isset($_POST['submit']))
  $data['head']['body'] = $cs_lang['body_edit'];
elseif(!empty($error))
  $data['head']['body'] = $error;

if(!empty($error) OR !isset($_POST['submit'])) {

  $data['data'] = $cs_feedback;

  $data['data']['switch_on'] = !empty($cs_feedback['feedback_switch']) ? 'checked="checked"' : '';
  $data['data']['switch_off'] = empty($cs_feedback['feedback_switch']) ? 'checked="checked"' : '';

  if(empty($cs_main['rte_html'])) {
    $data['if']['abcode'] = TRUE;
    $data['if']['rte_html'] = FALSE;
    $data['abcode']['smileys'] = cs_abcode_smileys('feedback_question');
    $data['abcode']['features'] = cs_abcode_features('feedback_question');
  } else {
    $data['if']['abcode'] = FALSE;
    $data['if']['rte_html'] = TRUE;
    $data['rte']['html'] = cs_rte_html('feedback_question',$cs_feedback['feedback_question']);
  }

  $data['feedback']['id'] = $feedback_id;

 echo cs_subtemplate(__FILE__,$data,'feedback','edit');
}
else {

  $feedback_cells = array_keys($cs_feedback);
  $feedback_save = array_values($cs_feedback);
  cs_sql_update(__FILE__,'feedback',$feedback_cells,$feedback_save,$feedback_id);
  
  cs_redirect($cs_lang['changes_done'], 'feedback');
} 