<?php

function cs_ts3_status($host, $query_port, $client_port) {

  if(empty($query_port) OR empty($client_port))
    return false;

  $timeout = 10;

  $ts3_con = @fsockopen($host, $query_port, $errno, $errstr, $timeout);

  if(!empty($errno)) {
    cs_error(__FILE__, 'cs_ts3_status - ' . $errno . ' - ' . $errstr);
    return false;
  }
  else {
    $nl = "\n";
    $result = array();

    stream_set_timeout($ts3_con, $timeout);

    $result['connect'] = fread($ts3_con, 4096);
    $result['welcome'] = fread($ts3_con, 4096);

    fwrite($ts3_con, "use port=" . $client_port . $nl);
    $result['status'] = fread($ts3_con, 4096);

    fwrite($ts3_con, 'serverinfo' . $nl);
    $result['info'] = fread($ts3_con, 4096);
    $result['info_status'] = fread($ts3_con, 4096);
  
    fwrite($ts3_con, 'clientlist' . $nl);
    $result['user'] = fread($ts3_con, 4096);
    $result['user_status'] = fread($ts3_con, 4096);

    $user = str_replace(array('\/','\s','\p'), array('/',' ','|'), $result['user']);
    $user = explode(' ', $user);

    $userlist = '';
    foreach($user AS $part)
    {
      $parted = explode('=', $part, 2);
      if($parted[0] == 'client_nickname' AND $parted[1] != 'Unknown')
        $userlist .= (strlen($parted[1]) > 10) ? ', ' . substr($parted[1], 0, 8) . '..' : ', ' . $parted[1];
    }
    $userlist = substr($userlist, 2);
    if(strlen($userlist) > 70)
      $userlist = substr($userlist, 0, 70) . '..';

    $conf = str_replace(array('\/','\s','\p'), array('/',' ','|'), $result['info']);
    $conf = explode(' ', $conf);

    $vars = array();
    foreach($conf AS $part)
    {
      $parted = explode('=', $part, 2);
      $vars[$parted[0]] = isset($parted[1]) ? $parted[1] : '';
    }

    # remove one client count due to the query user
    if(!empty($vars['virtualserver_clientsonline']))
      $vars['virtualserver_clientsonline']--;

    $vars['virtualserver_clientlist'] = $userlist;

    return $vars;
  }
}