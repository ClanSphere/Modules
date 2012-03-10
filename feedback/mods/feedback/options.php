<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: options.php 587 2011-03-31 06:38:06Z hajo $

$cs_lang = cs_translate('feedback');

$data = array();

if(isset($_POST['submit'])) {

  $save = array();
  $save['mail_subject'] = $_POST['mail_subject'];
  $save['mail_detail'] = $_POST['mail_detail'];
  $save['mail_short'] = $_POST['mail_short'];

  require_once 'mods/clansphere/func_options.php';
  
  cs_optionsave('feedback', $save);
  cs_redirect($cs_lang['success'], 'options','roots');
} 
else {

  $data['options'] = cs_sql_option(__FILE__, 'feedback');

  echo cs_subtemplate(__FILE__,$data,'feedback','options');
}