<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: mail.php 587 2011-03-31 06:38:06Z hajo $

$cs_lang = cs_translate('feedback');

$captcha = extension_loaded('gd') ? 1 : 0;
$data = array();
$error = 0;
$errormsg = '';

$id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];
settype($id,'integer');

$select = 'feedback_name, feedback_switch, feedback_question';
$cs_feedback = cs_sql_select(__FILE__, 'feedback', $select, 'feedback_id = ' . $id);

$data['feedback']['id'] = $id;
$data['feedback']['name'] = cs_secure($cs_feedback['feedback_name']);
$data['feedback']['question'] = cs_secure($cs_feedback['feedback_question'], 1, 1, 1, 1);

$captcha = 0;
if(empty($account['users_id']) AND extension_loaded('gd')) {
  $captcha = 1;
}

$data['if']['captcha'] = 0;

$mail['nick'] = empty($_POST['nick']) ? '' : $_POST['nick'];
$mail['email'] = empty($_POST['email']) ? '' : $_POST['email'];
$mail['text']  = empty($_POST['text']) ? '' : trim($_POST['text']);

if(isset($_POST['submit'])) {
  
  if(empty($account['users_id'])) {
    if (!cs_captchacheck($_POST['captcha'])) {
      $error++;
      $errormsg .= $cs_lang['captcha_false'] . cs_html_br(1);
    }
  }

  include_once 'mods/contact/trashmail.php';

  if(empty($mail['nick'])) { 
    $error++; 
    $errormsg .= $cs_lang['error_nick'].' '. cs_html_br(1); 
  }

  if(empty($mail['text'])) { 
    $error++; 
    $errormsg .= $cs_lang['error_text'].' '. cs_html_br(1); 
  }

  if(!preg_match("/^[0-9a-zA-Z._\\-]+@[0-9a-zA-Z._\\-]{2,}\\.[a-zA-Z]{2,4}\$/",$mail['email'])) {
    $error++; 
    $errormsg .= $cs_lang['error_email'] . cs_html_br(1); 
  }
  elseif(cs_trashmail($mail['email'])) {
    $error++;
    $errormsg .= $cs_lang['error_email'] . cs_html_br(1);
  }

  if(empty($cs_feedback['feedback_switch'])) { 
    $error++; 
    $errormsg .= $cs_lang['error_switch'].' '. cs_html_br(1); 
  }

  $where = "feedbackmail_email = '" . cs_sql_escape($mail['email']) . "'"
         . ' AND feedback_id = ' . (int) $id;
  $search_collision = cs_sql_count(__FILE__,'feedbackmail',$where);
  if(!empty($search_collision)) {
    $error++; 
    $errormsg .= $cs_lang['error_exists'].' '. cs_html_br(1); 
  }
}

if(!isset($_POST['submit'])) {
  $data['data']['body_mail'] = $cs_lang['body_mail'];
  $mail['nick'] = empty($account['users_nick']) ? $mail['nick'] : $account['users_nick'];
  $mail['email'] = empty($account['users_email']) ? $mail['email'] : $account['users_email'];
}
elseif(!empty($error)) {
  $data['data']['body_mail'] = $errormsg;
}
else {
  $data['data']['body_mail'] = $cs_lang['success'];
}

if(!empty($error) OR !isset($_POST['submit'])) {

  $data['if']['form'] = TRUE;
  $data['if']['done'] = FALSE;

  foreach($mail AS $key => $value)
    $data['mail'][$key] = cs_secure($value);

  if(!empty($captcha)) {
    $data['if']['captcha'] = 1;
  }
}
else {
  $data['if']['form'] = FALSE;
  $data['if']['done'] = TRUE;

  $mail_cells = array('feedback_id', 'feedbackmail_nick', 'feedbackmail_email', 'feedbackmail_time', 'feedbackmail_text');
  $mail_save = array($id, $mail['nick'], $mail['email'], cs_time(), $mail['text']);
  cs_sql_insert(__FILE__,'feedbackmail',$mail_cells,$mail_save);

  # Mail preferences
  $opt_feedback = cs_sql_option(__FILE__, 'feedback');
  $subject = empty($opt_feedback['mail_subject']) ? $cs_lang['feedback'] : $opt_feedback['mail_subject'];
  $subject .= ' // ' . date('d.m.Y') . ' // ' . $cs_feedback['feedback_name'] . ' // ' . $mail['nick'];

  # Short info mail
  $message = sprintf($cs_lang['mailtxt_short'],date('d.m.Y'),date('H:i'),$cs_feedback['feedback_name'],$mail['nick']);
  cs_mail($opt_feedback['mail_short'],$subject,$message);

  # Detailed info mail
  $message = sprintf($cs_lang['mailtxt_detail'],date('d.m.Y'),date('H:i'),$cs_feedback['feedback_name'],$mail['nick'],$mail['email'],$mail['text']);
  cs_mail($opt_feedback['mail_detail'],$subject,$message);
}

$data['captcha']['img'] = cs_html_img('mods/captcha/generate.php?time=' . cs_time());

echo cs_subtemplate(__FILE__,$data,'feedback','mail');