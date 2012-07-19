<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: create.php 587 2011-03-31 06:38:06Z hajo $

$cs_lang = cs_translate('feedback');

$data = array();

$cs_feedback['feedback_name'] = '';
$cs_feedback['feedback_switch'] = 0;
$cs_feedback['feedback_question'] = '';

if(isset($_POST['submit'])) {

  $cs_feedback['feedback_name'] = $_POST['feedback_name'];
  $cs_feedback['feedback_switch'] = empty($_POST['feedback_switch']) ? 0 : 1;
  $cs_feedback['feedback_question'] = empty($cs_main['rte_html']) ? $_POST['feedback_question'] : cs_abcode_inhtml($_POST['feedback_question'], 'add');
  
  $error = '';

  if(empty($cs_feedback['feedback_name']))
    $error .= $cs_lang['no_name'] . cs_html_br(1);

  $where = "feedback_name = '" . cs_sql_escape($cs_feedback['feedback_name']) . "'";
  $search_collision = cs_sql_count(__FILE__,'feedback',$where);
  if(!empty($search_collision)) {
    $error .= $cs_lang['collision'] . cs_html_br(1);
  }
}

if(!isset($_POST['submit']))
  $data['head']['body'] = $cs_lang['body_create'];
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

 echo cs_subtemplate(__FILE__,$data,'feedback','create');
}
else {

  $feedback_cells = array_keys($cs_feedback);
  $feedback_save = array_values($cs_feedback);
  cs_sql_insert(__FILE__,'feedback',$feedback_cells,$feedback_save);

 cs_redirect($cs_lang['create_done'],'feedback');
}