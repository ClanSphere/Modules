<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: tiny_init.php 400 2010-10-01 08:21:51Z hajo $

// copy domain and session settings from clansphere servervars
$domain = htmlspecialchars($_SERVER['HTTP_HOST'], ENT_QUOTES);
$domain = (strpos($domain, '.') !== FALSE) ? $domain : '';

session_name('cs' . md5($domain));
session_start();

// set content type header to identify this file as javascript
header('Content-type: application/javascript');

$lang = empty($_SESSION['tinymce_lang']) ? 'en' : $_SESSION['tinymce_lang'];
$mode = empty($_SESSION['tinymce_mode']) ? 0 : $_SESSION['tinymce_mode'];
$mode_abcode = empty($_SESSION['tinymce_mode_abcode']) ? 0 : $_SESSION['tinymce_mode_abcode'];
$skin = empty($_SESSION['tinymce_skin']) ? array() : explode('/', $_SESSION['tinymce_skin']);
$skin_info = !empty($skin[0]) ? $skin[0] : 'default';
$skin_varn = !empty($skin[1]) ? $skin[1] : '';
?>
$(function() {
<?php
if(!empty($mode_abcode)) {
?>
  $(document).bind('csAjaxLoad', function(event,element) {
    $(element).find('textarea.rte_abcode').tinymce({
      mode                                : 'specific_textareas',
      editor_selector                     : 'rte_abcode',
      theme                               : 'advanced',
      language                            : '<?php echo $lang; ?>',
      skin                                : '<?php echo $skin_info; ?>',
      skin_variant                        : '<?php echo $skin_varn; ?>',
      plugins                             : 'autoresize, clansphere_abcode, clansphere_features, contextmenu, inlinepopups, searchreplace',
      theme_advanced_buttons1             : 'link,unlink,image,hr, | ,quote,php,clipbox,threadlink, | ,search,replace,help',
      theme_advanced_buttons2             : 'justifyleft,justifycenter,justifyright,justifyfull, | ,bold,italic,underline,strikethrough, | ,indent,bullist,numlist, | ,undo,redo',
      theme_advanced_buttons3             : 'formatselect,fontsizeselect,forecolor, | , removeformat,cleanup',
      theme_advanced_toolbar_location     : 'top',
      theme_advanced_toolbar_align        : 'left',
      theme_advanced_statusbar_location   : 'bottom',
      theme_advanced_resizing             : true,
      theme_advanced_resize_horizontal    : false,
      theme_advanced_resizing_use_cookie  : false,
      theme_advanced_font_sizes           : '8=8pt,10=10pt,12=12pt,20=20pt,50=50pt',
      theme_advanced_blockformats         : 'h1,h2,h3,h4,h5,h6',
      remove_linebreaks                   : false,
      convert_fonts_to_spans              : false,
      entity_encoding                     : 'raw'
    });
  }).triggerHandler('csAjaxLoad', document.body);
<?php
}
if(!empty($mode)) {
?>
  $(document).bind('csAjaxLoad', function(event,element) {
    $(element).find('textarea.rte_html').tinymce({
      mode                                : 'specific_textareas',
      editor_selector                     : 'rte_html',
      theme                               : 'advanced',
      language                            : '<?php echo $lang; ?>',
      skin                                : '<?php echo $skin_info; ?>',
      skin_variant                        : '<?php echo $skin_varn; ?>',
      plugins                             : "advhr,advimage,advlink,autoresize,contextmenu,emotions,fullscreen,iespell,inlinepopups,layer,media,nonbreaking,pagebreak,paste,preview,print,safari,save,searchreplace,style,table,visualchars,xhtmlxtras",
      theme_advanced_buttons1             : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons2             : "pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,preview,|,forecolor,backcolor",
      theme_advanced_buttons3             : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,fullscreen",
      theme_advanced_buttons4             : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,pagebreak",
      theme_advanced_toolbar_location     : "top",
      theme_advanced_toolbar_align        : "left",
      theme_advanced_statusbar_location   : "bottom",
      theme_advanced_resizing             : true,
      theme_advanced_resize_horizontal    : false,
      theme_advanced_resizing_use_cookie  : false,
      use_native_selects                  : true
    });
  }).triggerHandler('csAjaxLoad', document.body);
<?php
}
?>
});