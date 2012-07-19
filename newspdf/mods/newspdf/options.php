<?php
// ClanSphere 2010 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('newspdf');

if(isset($_POST['submit'])) {

  $save = array();
  $save['img_max_width'] = (int) $_POST['img_max_width'];
  $save['img_max_height'] = (int) $_POST['img_max_height'];
  $save['img_upload_to'] = $_POST['img_upload_to'];
  $save['pdf_dpi_x'] = (int) $_POST['pdf_dpi_x'];
  $save['pdf_dpi_y'] = (int) $_POST['pdf_dpi_y'];
  $save['pdf_upload_to'] = $_POST['pdf_upload_to'];
  
  require_once 'mods/clansphere/func_options.php';
  
  cs_optionsave('newspdf', $save);
  
  cs_redirect($cs_lang['success'], 'options', 'roots');
}

$data = array();

$data['op'] = cs_sql_option(__FILE__, 'newspdf');

$data['op']['pdf_dpi_x'] = empty($data['op']['pdf_dpi_x']) ? '' : $data['op']['pdf_dpi_x'];
$data['op']['pdf_dpi_y'] = empty($data['op']['pdf_dpi_y']) ? '' : $data['op']['pdf_dpi_y'];

$data['im'] = array('version' => '-', 'version_id' => '-', 'formats' => '-');

if(extension_loaded('imagick')) {

    $img = new IMagick();

    $version = $img->getVersion();

    $data['im']['version']    = $version['versionString'];
    $data['im']['version_id'] = $version['versionNumber'];
    
    $formats = $img->queryFormats('*PDF*');

    if(is_array($formats)) {
    
        $data['im']['formats'] = implode(' ', $formats);
    }
}

echo cs_subtemplate(__FILE__,$data,'newspdf','options');