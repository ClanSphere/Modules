<?php
$cs_lang = cs_translate('codepaste');

$cp_id = $_REQUEST['id'];
settype($cp_id,'integer');

$select = 'codepaste_id, codepaste_views';
$where = "codepaste_id = '" . $cp_id . "'";
$codepaste = cs_sql_select(__FILE__,'codepaste',$select,$where,0,0,1);
$codepaste_views = $codepaste['codepaste_views'];
$codepaste_views = $codepaste_views + 1;
$cp_cells = array('codepaste_views');
$cp_save = array($codepaste_views);
cs_sql_update(__FILE__,'codepaste',$cp_cells,$cp_save,$cp_id);

$tables = 'codepaste cp INNER JOIN {pre}_users usr ON cp.users_id = usr.users_id';
$tables .= ' INNER JOIN {pre}_categories cat ON cp.codepaste_version = cat.categories_id';
$select = 'usr.users_nick AS users_nick, usr.users_id AS users_id, usr.users_country AS users_country, cp.codepaste_name AS codepaste_name, cp.codepaste_date AS codepaste_date, cp.codepaste_textold AS codepaste_textold,';
$select .= ' cp.codepaste_textnew AS codepaste_textnew, cp.codepaste_mod AS codepaste_mod, cp.codepaste_file AS codepaste_file,';
$select .= ' cp.codepaste_info AS codepaste_info, cp.codepaste_views AS codepaste_views, cat.categories_name AS categories_name';
$select .= ' , cp.codepaste_type AS codepaste_type, cp.codepaste_path AS codepaste_path';
$where = "codepaste_id = '$cp_id'";
$cs_cp = cs_sql_select(__FILE__,$tables,$select,$where);

$tpl_data = array();

$tpl_data['users']['id']      = $cs_cp['users_id'];
$tpl_data['users']['nick']    = $cs_cp['users_nick'];
$tpl_data['users']['country'] = $cs_cp['users_country'];
$tpl_data['codepaste']['name']    = $cs_cp['codepaste_name'];
$tpl_data['codepaste']['version'] = $cs_cp['categories_name'];
$tpl_data['codepaste']['type']    = $cs_cp['codepaste_type'];
$tpl_data['codepaste']['mod']     = $cs_cp['codepaste_mod'];
$tpl_data['codepaste']['file']    = $cs_cp['codepaste_file'];
$tpl_data['codepaste']['path']    = $cs_cp['codepaste_path'];
$tpl_data['codepaste']['date']    = cs_date('date',$cs_cp['codepaste_date'],1);
$tpl_data['codepaste']['info']    = cs_secure($cs_cp['codepaste_info'], 1, 1);
$tpl_data['codepaste']['textold'] = cs_secure('[php]' . $cs_cp['codepaste_textold'] . '[/php]',1);
$tpl_data['codepaste']['textnew'] = cs_secure('[php]' . $cs_cp['codepaste_textnew'] . '[/php]',1);

$tpl_data['if']['modfile'] = empty($cs_cp['codepaste_path']) ? true : false;
$tpl_data['if']['path']    = empty($cs_cp['codepaste_path']) ? false : true;

echo cs_subtemplate(__FILE__, $tpl_data, 'codepaste', 'view');

$com_where      = "comments_mod = 'codepaste' AND comments_fid = '$cp_id'";
$comments_count = cs_sql_count(__FILE__,'comments',$com_where);

require_once('mods/comments/functions.php');
if (!empty($comments_count)) {
	echo cs_html_br(1);
	cs_comments_view($cp_id, 'codepaste', 'view', $comments_count);
}
echo cs_html_br(1);
cs_comments_add($cp_id,'codepaste');

?>
