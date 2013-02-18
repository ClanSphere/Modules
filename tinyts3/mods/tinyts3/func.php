<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: $

function cs_ts3_status($host, $query_port, $client_port) {

  # exit when port data is not available
  if(empty($query_port) OR empty($client_port))
    return false;

  $timeout = 5;

  ini_set("default_socket_timeout", $timeout);

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

    fclose($ts3_con);

    # format fetched data for later usage
    $info = array();
    $info['userlist'] = array();
    $user = explode(' ', $result['user']);
    foreach($user AS $part)
    {
      $parted = explode('=', $part, 2);
      $unknown = substr($parted[1], 0, 15);
      if($parted[0] == 'client_nickname' AND $unknown != 'Unknown\sfrom\s')
        $info['userlist'][] = str_replace(array('\/','\s','\p'), array('/',' ','|'), $parted[1]);
    }

    $conf = explode(' ', $result['info']);
    $vars = array();
    foreach($conf AS $part)
    {
      $parted = explode('=', $part, 2);
      $vars[$parted[0]] = isset($parted[1]) ? $parted[1] : '';
    }

    $info['version'] = isset($vars['virtualserver_version']) ? $vars['virtualserver_version'] : 'Error';
    $info['maxclients'] = isset($vars['virtualserver_maxclients']) ? (int) $vars['virtualserver_maxclients'] : '0';
    $info['online'] = isset($vars['virtualserver_clientsonline']) ? (int) $vars['virtualserver_clientsonline'] : '0';

    # remove one client count due to the query user
    if(!empty($info['online']))
      $info['online']--;

    # remove build info to shorten version information
    $end = strpos($info['version'], '\s');
    $info['version'] = substr($info['version'], 0, $end);

    return $info;
  }
}