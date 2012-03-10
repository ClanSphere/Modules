<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: rte_init.php 264 2010-05-31 04:55:46Z hajo $

global $account, $cs_main;

if(empty($account['access_tinymce']) AND $cs_main['rte_html'] == 'tinymce')
  $cs_main['rte_html'] = '';
else {

  # fetch options for tinymce
  $op_tinymce = cs_sql_option(__FILE__, 'tinymce');

  # set language and other options
  global $com_lang;
  $_SESSION['tinymce_lang'] = empty($com_lang['short']) ? 'en' : $com_lang['short'];
  $_SESSION['tinymce_mode'] = $cs_main['rte_html'] == 'tinymce' ? 1 : 0;
  $_SESSION['tinymce_mode_abcode'] = $cs_main['rte_more'] == 'tinymce' ? 1 : 0;
  $_SESSION['tinymce_skin'] = $op_tinymce['skin'];

  cs_scriptload('tinymce', 'javascript', 'jquery.tinymce.js');
  cs_scriptload('tinymce', 'javascript', 'tiny_mce.js');
  cs_scriptload('tinymce', 'javascript', 'tiny_init.php');

  if($cs_main['rte_html'] == 'tinymce') {
    function cs_rte_html($name, $value = '') {

      # handle abcode html tag behavior
      global $cs_main;
      $value = cs_abcode_inhtml($value, 'del');
      $value = str_replace(array("\n","\r"),array('',''),$value);
      $value = htmlentities($value, ENT_QUOTES, $cs_main['charset']);
      $data = array('tinymce');
      $data['tinymce']['name'] = $name;
      $data['tinymce']['value'] = $value;

      return cs_subtemplate(__FILE__, $data, 'tinymce', 'rte_html');
    }
  }
}