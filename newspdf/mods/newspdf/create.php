<?php
// ClanSphere 2010 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('newspdf');

require_once 'mods/categories/functions.php';

$data['head']['body'] = '';

$cs_news['categories_id'] = '';
$cs_news['news_headline'] = '';
$cs_news['news_text'] = '';
$cs_news['news_time'] = cs_time();
$cs_news['users_id'] = $account['users_id'];
$cs_news['news_public'] = 0;

$options = cs_sql_option(__FILE__, 'newspdf');

$news_pdf = '';

$pdf_path = $cs_main['def_path'] . '/' . $options['pdf_upload_to'];

$pdf_sources = cs_paths($pdf_path);
unset($pdf_sources['index.html']);

$page_start = empty($_POST['page_start']) ? 1 : $_POST['page_start'];
$page_end   = empty($_POST['page_end']) ? 99 : $_POST['page_end'];

if (isset($_POST['submit'])) {

  $cs_news['categories_id'] = empty($_POST['categories_name']) ? $_POST['categories_id'] : cs_categories_create('news', $_POST['categories_name']);
  $cs_news['news_headline'] = $_POST['news_headline'];
  
  $news_pdf = empty($_POST['news_pdf']) ? '' : $_POST['news_pdf'];

  $news_pdf = isset($pdf_sources[$news_pdf]) ? $news_pdf : '';

  $error = '';

  if(empty($cs_news['categories_id']))
    $error .= $cs_lang['no_cat'] . cs_html_br(1);
  if(empty($cs_news['news_headline']))
    $error .= $cs_lang['no_headline'] . cs_html_br(1);
  if(empty($news_pdf))
    $error .= $cs_lang['no_pdf'] . cs_html_br(1);
  if(!extension_loaded('imagick'))
    $error .= $cs_lang['no_imagick'];
}

if(!isset($_POST['submit']) and !isset($_POST['preview'])) {
  $data['head']['body'] = $cs_lang['create_info'];
}
elseif(!empty($error)) {
  $data['head']['body'] = $error;
}

if(!empty($error) or !isset($_POST['submit'])) {
  
  $data['categories']['dropdown'] = cs_categories_dropdown('news',$cs_news['categories_id']);
  $data['news']['news_headline'] = cs_secure($cs_news['news_headline']);

  $data['if']['source'] = 0;

  if($pdf_sources != array()) {
  
    $data['if']['source'] = 1;

    $data['sources'] = array();

    foreach($pdf_sources AS $file => $num) {

      $selected = ($file == $news_pdf) ? 'checked="checked" ' : '';
      $data['sources'][] = array('file' => cs_secure($file), 'selected' => $selected);
    }
  }

  $data['pages'] = array('start' => $page_start, 'end' => $page_end);
  
  echo cs_subtemplate(__FILE__, $data, 'newspdf', 'create');
  
} else {

  require_once 'mods/newspdf/functions.php';

  $cs_news['news_text'] = cs_pdf_to_img($news_pdf, $page_start, $page_end);

  $news_cells = array_keys($cs_news);
  $news_save = array_values($cs_news);
  cs_sql_insert(__FILE__, 'news', $news_cells, $news_save);

  $news_id = cs_sql_insertid(__FILE__);
  
  if(!empty($news_id)) {

    cs_redirect('', 'news', 'edit', 'id=' . $news_id);
  }
}