<?php
$cs_lang = cs_translate('codepaste');

$start = empty($_REQUEST['start']) ? 0 : $_REQUEST['start'];
$cs_sort[1] = 'codepaste_date DESC';
$cs_sort[2] = 'codepaste_date ASC';
$cs_sort[3] = 'codepaste_name ASC';
$cs_sort[4] = 'codepaste_name DESC';
$cs_sort[5] = 'codepaste_mod ASC';
$cs_sort[6] = 'codepaste_mod DESC';
$cs_sort[7] = 'codepaste_version ASC';
$cs_sort[8] = 'codepaste_version DESC';

$sort = empty($_REQUEST['sort']) ? 1 : $_REQUEST['sort'];

$order = $cs_sort[$sort];

$cp_count = cs_sql_count(__FILE__,'codepaste');


$select = 'codepaste_id, users_id, codepaste_date, codepaste_textold, codepaste_textnew, codepaste_mod, codepaste_file,';
$select .= ' codepaste_info, codepaste_version, codepaste_name, codepaste_views, codepaste_type, codepaste_path';
$cs_cp = cs_sql_select(__FILE__,'codepaste',$select,0,$order,$start,$account['users_limit']);
$cp_loop = count($cs_cp);


$tpl_data = array();

$tpl_data['head']['count']   = $cp_count;
$tpl_data['head']['pages_navigation'] = cs_pages('codepaste','list',$cp_count,$start,0,$sort);
$tpl_data['sort']['date']    = cs_sort('codepaste','list',$start,0,1,$sort);
$tpl_data['sort']['name']    = cs_sort('codepaste','list',$start,0,3,$sort);
$tpl_data['sort']['mod']     = cs_sort('codepaste','list',$start,0,5,$sort);
$tpl_data['sort']['version'] = cs_sort('codepaste','list',$start,0,7,$sort);

for ($run = 0; $run < $cp_loop; $run++) {

    $select    = 'categories_id, categories_name';
    $where     = "categories_id = '" . $cs_cp[$run]['codepaste_version'] . "'";
    $cs_cp_cat = cs_sql_select(__FILE__,'categories',$select,$where,0,0,1);

    $tpl_data['codepaste'][$run]['id']   = $cs_cp[$run]['codepaste_id'];
    $tpl_data['codepaste'][$run]['date'] = cs_date('date',$cs_cp[$run]['codepaste_date'],0);
    $tpl_data['codepaste'][$run]['name'] = $cs_cp[$run]['codepaste_name'];
    $tpl_data['codepaste'][$run]['mod']  = $cs_cp[$run]['codepaste_mod'];
    $tpl_data['codepaste'][$run]['file'] = $cs_cp[$run]['codepaste_file'];
    $tpl_data['codepaste'][$run]['path'] = $cs_cp[$run]['codepaste_path'];
    $tpl_data['codepaste'][$run]['type'] = $cs_cp[$run]['codepaste_type'];
    $tpl_data['codepaste'][$run]['version'] = $cs_cp_cat['categories_name'];
    $tpl_data['codepaste'][$run]['views']   = $cs_cp[$run]['codepaste_views'];
    $tpl_data['codepaste'][$run]['comment'] = cs_sql_count(__FILE__,'comments',"comments_mod = 'codepaste' AND comments_fid = '" . $cs_cp[$run]['codepaste_id'] . "'");

    $tpl_data['codepaste'][$run]['if']['useredit'] = $account['users_id'] == $cs_cp[$run]['users_id'] ? true : false;
    $tpl_data['codepaste'][$run]['if']['modfile'] = empty($cs_cp[$run]['codepaste_path']) ? true : false;
    $tpl_data['codepaste'][$run]['if']['path']    = empty($cs_cp[$run]['codepaste_path']) ? false : true;

}

if ($run == 0) {
	$tpl_data['codepaste'][$run]['id']   = '';
  $tpl_data['codepaste'][$run]['date'] = '';
  $tpl_data['codepaste'][$run]['name'] = '';
  $tpl_data['codepaste'][$run]['mod']  = '';
  $tpl_data['codepaste'][$run]['file'] = '';
  $tpl_data['codepaste'][$run]['path'] = '';
  $tpl_data['codepaste'][$run]['type'] = '';
  $tpl_data['codepaste'][$run]['version'] = '';
  $tpl_data['codepaste'][$run]['views']   = '';
  $tpl_data['codepaste'][$run]['comment'] = '';

  $tpl_data['codepaste'][$run]['if']['useredit'] = false;
  $tpl_data['codepaste'][$run]['if']['modfile'] = true;
  $tpl_data['codepaste'][$run]['if']['path']    = false;

}

$tpl_data['head']['message'] = cs_getmsg();

echo cs_subtemplate(__FILE__, $tpl_data, 'codepaste');

?>
