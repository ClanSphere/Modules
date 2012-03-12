<?php
function cs_liga_dropdown($name,$list,$array,$select = 0, $key = 0) {
  global $com_lang;
  
  $key = empty($key) ? $name : $key;
  $var = cs_html_select(1,$name,'onchange="javascript:cs_ajax_getcontent(\'mods/liga_manager/get_data.php?liga1=\'+this.value,\'team_1\'); javascript:cs_ajax_getcontent(\'mods/liga_manager/get_data.php?liga2=\'+this.value,\'team_2\'); javascript:cs_ajax_getcontent(\'mods/liga_manager/get_data.php?day=\'+this.value,\'game_day\');"');
  $var .= cs_html_option('----',0,0);
  $loop = count($array);
  for($run=0; $run < $loop; $run++) {
    $sel = $select == $array[$run][$key] ? 1 : 0;
	$content = 	htmlentities($array[$run][$list], ENT_QUOTES, $com_lang['charset']);
	$var .= cs_html_option($content,$array[$run][$key],$sel);
  }
  return $var . cs_html_select(0);
}
function cs_team_dropdown($name,$list,$array,$select = 0, $key = 0) {
  global $com_lang;
  
  $key = empty($key) ? $name : $key;
  $var = cs_html_select(1,$name,'onchange="javascript:cs_ajax_getcontent(\'mods/liga_manager/get_data.php?team=\'+this.value,\'team\'); "');
  $var .= cs_html_option('----',0,0);
  $loop = count($array);
  for($run=0; $run < $loop; $run++) {
    $sel = $select == $array[$run][$key] ? 1 : 0;
	$content = 	htmlentities($array[$run][$list], ENT_QUOTES, $com_lang['charset']);
	$var .= cs_html_option($content,$array[$run][$key],$sel);
  }
  return $var . cs_html_select(0);
}
?>