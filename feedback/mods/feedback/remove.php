<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: remove.php 587 2011-03-31 06:38:06Z hajo $
$cs_lang = cs_translate('feedback');
$cs_get = cs_get('id,agree,cancel');

if(isset($cs_get['agree'])) {
  cs_sql_delete(__FILE__, 'feedback', $cs_get['id']);
  cs_sql_delete(__FILE__, 'feedbackmail', $cs_get['id'], 'feedback_id');
  cs_redirect($cs_lang['del_true'], 'feedback');
}

if(isset($cs_get['cancel'])) {
  cs_redirect($cs_lang['del_false'], 'feedback');
}


$feedback = cs_sql_select(__FILE__,'feedback','feedback_name','feedback_id = ' . $cs_get['id'],0,0,1);
if(!empty($feedback)) {
  $data = array();
  $data['lang']['remove'] = $cs_lang['head_remove'];
  $data['lang']['body'] = sprintf($cs_lang['remove_entry'],$cs_lang['feedback'],$feedback['feedback_name']);
  $data['lang']['content'] = cs_link($cs_lang['confirm'],'feedback','remove','id=' . $cs_get['id'] . '&amp;agree');
  $data['lang']['content'] .= ' - ';
  $data['lang']['content'] .= cs_link($cs_lang['cancel'],'feedback','remove','id=' . $cs_get['id'] . '&amp;cancel');
  echo cs_subtemplate(__FILE__,$data,'feedback','remove');
}
else {
  cs_redirect('','feedback');
}