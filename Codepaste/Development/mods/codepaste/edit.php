<?php

$cs_lang = cs_translate('codepaste');

$cs_cp_id = $_GET['id'];
settype($cs_cp_id,'integer');


/**
 * Securitycheck
 */
$cp_user_sql = cs_sql_select(__FILE__, 'codepaste', 'users_id', "codepaste_id = '$cs_cp_id'");

if ($account['access_codepaste'] < 4 && $account['users_id'] !== $cp_user_sql['users_id']) {

    include_once('mods/errors/403.php');
    return false;
}



$tpl_data = array();

if(isset($_POST['submit'])) {

    $cs_cp_id = $_POST['codepaste_id'];
    settype($cs_cp_id,'integer');

    $cs_cp['codepaste_name']    = $_POST['codepaste_name'];
    $cs_cp['codepaste_date']    = $_POST['codepaste_date'];
    $cs_cp['codepaste_type']    = $_POST['codepaste_type'];
    $cs_cp['codepaste_path']    = $_POST['codepaste_path'];
    $cs_cp['codepaste_mod']     = $_POST['codepaste_mod'];
    $cs_cp['codepaste_file']    = $_POST['codepaste_file'];
    $cs_cp['codepaste_version'] = $_POST['categories_id'];
    $cs_cp['codepaste_info']    = $_POST['codepaste_info'];
    $cs_cp['codepaste_textold'] = $_POST['codepaste_textold'];
    $cs_cp['codepaste_textnew'] = $_POST['codepaste_textnew'];

    $error    = 0;
    $errormsg = $cs_lang['error'] . cs_html_br(1);

    if(empty($cs_cp['codepaste_name'])) {

        $error++;
        $errormsg .= $cs_lang['no_name'] . cs_html_br(1);
    }

    if ((empty($cs_cp['codepaste_file']) || empty($cs_cp['codepaste_mod'])) && empty($cs_cp['codepaste_path'])) {

      $error++;
      $errormsg .= $cs_lang['nor_modfile_path'] . cs_html_br(1);
    }

    if(empty($cs_cp['codepaste_version'])) {

        $error++;
        $errormsg .= $cs_lang['no_version'] . cs_html_br(1);
    }

    if(empty($cs_cp['codepaste_info'])) {

        $error++;
        $errormsg .= $cs_lang['no_info'] . cs_html_br(1);
    }

    if(empty($cs_cp['codepaste_textold'])) {

        $error++;
        $errormsg .= $cs_lang['no_textold'] . cs_html_br(1);
    }

    if(empty($cs_cp['codepaste_textnew'])) {

        $error++;
        $errormsg .= $cs_lang['no_textnew'] . cs_html_br(1);
    }

} else {

    $tables = 'codepaste cp INNER JOIN {pre}_users usr ON cp.users_id = usr.users_id';
    $tables.= ' INNER JOIN {pre}_categories cat ON cp.codepaste_version = cat.categories_id';

    $select = 'usr.users_nick AS users_nick, usr.users_id AS users_id, usr.users_country AS users_country, cp.codepaste_name AS codepaste_name, cp.codepaste_textold AS codepaste_textold,';
    $select.= ' cp.codepaste_textnew AS codepaste_textnew, cp.codepaste_mod AS codepaste_mod, cp.codepaste_file AS codepaste_file,';
    $select.= ' cp.codepaste_info AS codepaste_info, cat.categories_name AS categories_name, cp.codepaste_date AS codepaste_date,';
    $select.= ' cp.codepaste_version AS codepaste_version, cp.codepaste_id AS codepaste_id, cp.codepaste_type AS codepaste_type, cp.codepaste_path AS codepaste_path';

    $where = "codepaste_id = '" . $cs_cp_id . "'";

    $cs_cp = cs_sql_select(__FILE__,$tables,$select,$where);
}

if(!isset($_POST['submit'])) {

    $tpl_data['head']['info']      = $cs_lang['body_create'];
    $tpl_data['if']['create_done'] = false;
}

elseif(!empty($error)) {

    $tpl_data['head']['info']      = $errormsg;
    $tpl_data['if']['create_done'] = false;
}

else {

    $tpl_data['head']['info']      = $cs_lang['create_done'];
    $tpl_data['if']['create_done'] = true;
    $tpl_data['continue']['action'] = $account['access_codepaste'] < 4 ? 'list' : 'manage';
}

$tpl_data['head']['action'] = $cs_lang['head_edit'];

echo cs_subtemplate(__FILE__, $tpl_data, 'codepaste', 'action_head');



if(!empty($error) OR !isset($_POST['submit'])) {

    unset($tpl_data);

    $select        = 'categories_id, categories_name';
    $where         = "categories_mod = 'codepaste'";
    $cs_cp_version = cs_sql_select(__FILE__,'categories',$select,$where,'categories_name',0,0);
    for ($run = 0; $run < count($cs_cp_version); $run++) {

        $tpl_data['version'][$run]['id']       = $cs_cp_version[$run]['categories_id'];
        $tpl_data['version'][$run]['name']     = $cs_cp_version[$run]['categories_name'];

        if ($cs_cp_version[$run]['categories_id'] == $cs_cp['codepaste_version']) {
        	$tpl_data['version'][$run]['selected'] = ' selected="selected"';
        } else {
            $tpl_data['version'][$run]['selected'] = '';
        }
    }

    $from       = 'codepaste cp INNER JOIN {pre}_users usr ON cp.users_id = usr.users_id';
    $select     = 'usr.users_id AS users_id, users_nick, users_country';
    $where      = "codepaste_id = '$cs_cp_id'";
    $cs_cp_user = cs_sql_select(__FILE__,$from,$select,$where,0,0,1);

    $tpl_data['users']['id']      = $cs_cp_user['users_id'];
    $tpl_data['users']['nick']    = $cs_cp_user['users_nick'];
    $tpl_data['users']['country'] = $cs_cp_user['users_country'];

    $tpl_data['codepaste']['action'] = 'edit';
    $tpl_data['codepaste']['id']     = $cs_cp_id;
    $tpl_data['codepaste']['name']   = $cs_cp['codepaste_name'];
    $tpl_data['codepaste']['date']   = cs_date('date',$cs_cp['codepaste_date'],1);
    $tpl_data['codepaste']['date_ts'] = $cs_cp['codepaste_date'];
    $tpl_data['codepaste']['type']   = $cs_cp['codepaste_type'];
    $tpl_data['codepaste']['path']   = $cs_cp['codepaste_path'];
    $tpl_data['codepaste']['mod']    = $cs_cp['codepaste_mod'];
    $tpl_data['codepaste']['file']   = $cs_cp['codepaste_file'];
    $tpl_data['codepaste']['info']   = $cs_cp['codepaste_info'];
    $tpl_data['codepaste']['textold'] = $cs_cp['codepaste_textold'];
    $tpl_data['codepaste']['textnew'] = $cs_cp['codepaste_textnew'];

    $tpl_data['if']['edit'] = true;
    $tpl_data['if']['php']  = $cs_cp['codepaste_type'] == 'php' ? true : false;
    $tpl_data['if']['tpl']  = $cs_cp['codepaste_type'] == 'tpl' ? true : false;

    $tpl_data['auto_file']['display']  = empty($cs_cp['codepaste_path']) ? 'block' : 'none';
    $tpl_data['nauto_file']['display'] = !empty($cs_cp['codepaste_path']) ? 'block' : 'none';

    echo cs_subtemplate(__FILE__, $tpl_data, 'codepaste', 'action_form');
}

else {

    $cp_cells = array_keys($cs_cp);
    $cp_save  = array_values($cs_cp);

    cs_sql_update(__FILE__,'codepaste',$cp_cells,$cp_save,$cs_cp_id);

    cs_redirect($cs_lang['changes_done'], 'codepaste', 'list');
}

?>

