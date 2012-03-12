<?php

$cs_lang = cs_translate('codepaste');

$tpl_data = array();

if(isset($_POST['submit'])) {

    $cs_cp['users_id']          = $account['users_id'];
    $cs_cp['codepaste_name']    = $_POST['codepaste_name'];
    $cs_cp['codepaste_date']    = cs_time();
    $cs_cp['codepaste_type']    = $_POST['codepaste_type'];
    $cs_cp['codepaste_path']    = $_POST['codepaste_path'];
    $cs_cp['codepaste_mod']     = $_POST['codepaste_mod'];
    $cs_cp['codepaste_file']    = $_POST['codepaste_file'];
    $cs_cp['codepaste_version'] = $_POST['categories_id'];
    $cs_cp['codepaste_info']    = $_POST['codepaste_info'];
    $cs_cp['codepaste_textold'] = $_POST['codepaste_textold'];
    $cs_cp['codepaste_textnew'] = $_POST['codepaste_textnew'];
    $cs_cp['codepaste_views']   = 0;

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

    $cs_cp['users_id']          = $account['users_id'];
    $cs_cp['codepaste_name']    = '';
    $cs_cp['codepaste_date']    = cs_time();
    $cs_cp['codepaste_type']    = 'php';
    $cs_cp['codepaste_path']    = '';
    $cs_cp['codepaste_mod']     = '';
    $cs_cp['codepaste_file']    = '';
    $cs_cp['codepaste_version'] = '';
    $cs_cp['codepaste_info']    = '';
    $cs_cp['codepaste_textold'] = '';
    $cs_cp['codepaste_textnew'] = '';
    $cs_cp['codepaste_views']   = 0;
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

$tpl_data['head']['action'] = $cs_lang['head_create'];

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

    $select     = 'users_id, users_nick, users_country';
    $where      = "users_id = '" . $account['users_id'] . "'";
    $cs_cp_user = cs_sql_select(__FILE__,'users',$select,$where,0,0,1);

    $tpl_data['users']['id']      = $cs_cp_user['users_id'];
    $tpl_data['users']['nick']    = $cs_cp_user['users_nick'];
    $tpl_data['users']['country'] = $cs_cp_user['users_country'];

    $tpl_data['codepaste']['action'] = 'create';
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

    $tpl_data['if']['edit'] = false;
    $tpl_data['if']['php']  = $cs_cp['codepaste_type'] == 'php' ? true : false;
    $tpl_data['if']['tpl']  = $cs_cp['codepaste_type'] == 'tpl' ? true : false;

    $tpl_data['auto_file']['display']  = empty($cs_cp['codepaste_path']) ? 'block' : 'none';
    $tpl_data['nauto_file']['display'] = !empty($cs_cp['codepaste_path']) ? 'block' : 'none';

    echo cs_subtemplate(__FILE__, $tpl_data, 'codepaste', 'action_form');
}

else {

  $cp_cells = array_keys($cs_cp);

  $cp_save = array_values($cs_cp);

  cs_sql_insert(__FILE__,'codepaste',$cp_cells,$cp_save);

  cs_redirect($cs_lang['create_done'], 'codepaste', 'list');

}

?>

