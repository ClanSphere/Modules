<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: options.php 615 2011-05-28 12:17:28Z hajo $

$cs_lang = cs_translate('tinymce');

if(isset($_POST['submit'])) {

  $save = array();
  $save['skin'] = $_POST['skin'];
  
  require 'mods/clansphere/func_options.php';
  
  cs_optionsave('tinymce', $save);
  
  cs_redirect($cs_lang['success'], 'options', 'roots');

}

$data = array();

$data['op'] = cs_sql_option(__FILE__,'tinymce');

$skin[0]['skin'] = 'default';
$skin[0]['path'] = 'default';
$skin[1]['skin'] = 'highcontrast';
$skin[1]['path'] = 'highcontrast';
$skin[2]['skin'] = 'o2k7';
$skin[2]['path'] = 'o2k7';
$skin[3]['skin'] = 'o2k7/silver';
$skin[3]['path'] = 'o2k7 - silver';
$skin[4]['skin'] = 'o2k7/black';
$skin[4]['path'] = 'o2k7 - black';

$data['op']['skin'] = cs_dropdown('skin', 'path', $skin, $data['op']['skin']);

echo cs_subtemplate(__FILE__,$data,'tinymce','options');