<?php
$cs_lang = cs_translate('newsletter');
$data = array();
$data['if']['subscribe'] 	= false;
$data['if']['unsubscribe']	= false;
$data['if']['error']		= false;

$cs_options = cs_sql_option(__FILE__,'clansphere');

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
		$where = "newsletter_user_email = '" . $email . "'";
		$check = cs_sql_select(__FILE__,'newsletter_user',$select,$where,0,0,1);
		if(empty($check)) {
			include_once 'mods/users/functions.php';
			$key = generate_code(15);
			$save_cells = array('newsletter_user_email','newsletter_user_ip','newsletter_user_time','newsletter_user_key');
			$save_data = array($email,cs_getip(),cs_time(), $key);
			cs_sql_insert(__FILE__,'newsletter_user',$save_cells,$save_data);
			$title = $cs_lang['entry'];
			$link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?mod=newsletter&action=activate&key=' . $key;
			$message = $cs_lang['entry_msg'];
			$message .= cs_html_link($link,$cs_lang['email'] . ' ' . $cs_lang['confirm']);
			$message .= $cs_lang['entry_msg2'] . 	$cs_options['def_org'];
			cs_mail($email,$title,$message,0,'text/html');
			$data['subscribe']['msg'] = $cs_lang['subscribe'];
		}
		else {
			$data['subscribe']['msg'] = $cs_lang['subscribe_err'];
		}
	}
	elseif($type == 'unsubscribe' AND empty($error)) {
		$data['if']['unsubscribe'] = true;
		$select = 'newsletter_user_id';
		$where = "newsletter_user_email = '" . $email . "'";
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