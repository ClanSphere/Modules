<?php
error_reporting(E_ALL);
ini_set("display_errors","on");
$cs_lang = cs_translate('newsletter');
$data = array();
$data['if']['subscribe'] 	= false;
$data['if']['unsubscribe']	= false;
$data['if']['error']		= false;

if(isset($_POST['submit'])) {

	$email 		= trim($_POST['email']);
	$type 		= trim($_POST['type']);

	$error = 0;
	$errormsg = '<b>Es sind Fehler aufgetreten !!<b/><br />';

	if(empty($email)) {
		$error++;
		$errormsg .= cs_html_br(1) . '- die E-Mail Adresse ist ung&uuml;ltig.';
	}

	if($type == 'subscribe' AND empty($error)) {
		$data['if']['subscribe'] = true;
		$select = 'newsletter_user_id';
		$where = "email = '" . $email . "'";
		$check = cs_sql_select(__FILE__,'newsletter_user',$select,$where,"",0,1);
		if(empty($check)) {
			$save_cells = array('email','ip','time');
			$save_data = array($email,cs_getip(),cs_time());
			cs_sql_insert(__FILE__,'newsletter_user',$save_cells,$save_data);
			$data['subscribe']['msg'] = $cs_lang['subscribe'];
		}
		else {
			$data['subscribe']['msg'] = $cs_lang['subscribe_err'];
		}
	}
	elseif($type == 'unsubscribe' AND empty($error)) {
		$data['if']['unsubscribe'] = true;
		$select = 'newsletter_user_id';
		$where = "email = '" . $email . "'";
		$check = cs_sql_select(__FILE__,'newsletter_user',$select,$where,"",0,1);
		if(!empty($check)) {
			cs_sql_delete(__FILE__,'newsletter_user',$check['newsletter_user_id']);
			$data['unsubscribe']['msg'] = $cs_lang['unsubscribe'];
		}
		else {
			$data['unsubscribe']['msg'] = $cs_lang['unsubscribe_err'];
		}	

	}
	else {
		$data['if']['error'] = true;
		$data['error']['msg'] = $errormsg;
	}
}
echo cs_subtemplate(__FILE__,$data,'newsletter','subscribe');