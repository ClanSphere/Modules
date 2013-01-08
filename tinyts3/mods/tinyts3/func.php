<?php

function cs_ts3_status($host, $query_port, $client_port) {

  # max length for user nicks (some chars like space count as two)
  $maxnick = 20;
  # max length for all user nicks as combined string
  $maxlen = 70;

  # exit when port data is not available
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
    
    $user = explode(' ', $result['user']);
    $userlist = '';
    foreach($user AS $part)
    {
      $parted = explode('=', $part, 2);
      $unknown = substr($parted[1], 0, 15);
      if($parted[0] == 'client_nickname' AND $unknown != 'Unknown\sfrom\s')
        $userlist .= (strlen($parted[1]) > $maxnick) ? ', ' . substr($parted[1], 0, ($maxnick-2)) . '..' : ', ' . $parted[1];
    }
    $userlist = substr($userlist, 2);
    $userlist = str_replace(array('\/','\s','\p'), array('/',' ','|'), $userlist);
    if(strlen($userlist) > $maxlen)
      $userlist = substr($userlist, 0, ($maxlen-2)) . '..';

    $conf = explode(' ', $result['info']);
    $vars = array();
    foreach($conf AS $part)
    {
      $parted = explode('=', $part, 2);
      $vars[$parted[0]] = isset($parted[1]) ? $parted[1] : '';
    }

    # remove one client count due to the query user
    if(!empty($vars['virtualserver_clientsonline']))
      $vars['virtualserver_clientsonline']--;
      
    # remove build info to shorten version information
    $end = strpos($vars['virtualserver_version'], '\s');
    $vars['virtualserver_version'] = substr($vars['virtualserver_version'], 0, $end);

    # set optimized userlist as clientlist var
    $vars['virtualserver_clientlist'] = $userlist;

    return $vars;
  }
}