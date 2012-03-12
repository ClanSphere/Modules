ALTER TABLE {pre}_access ADD access_liga_manager int(2) NOT NULL default '0';
UPDATE {pre}_access SET access_liga_manager = '0' WHERE access_id = '1';
UPDATE {pre}_access SET access_liga_manager = '2' WHERE access_id = '2';
UPDATE {pre}_access SET access_liga_manager = '3' WHERE access_id = '3';
UPDATE {pre}_access SET access_liga_manager = '4' WHERE access_id = '4';
UPDATE {pre}_access SET access_liga_manager = '5' WHERE access_id = '5';

CREATE TABLE {pre}_liga_manager_teams (
  liga_manager_teams_id {serial},
  team_name varchar(250) NOT NULL default '',
  team_short varchar(250) NOT NULL default '',
  PRIMARY KEY (liga_manager_teams_id)
){engine};

CREATE TABLE {pre}_liga_manager_ligen (
  liga_manager_ligen_id {serial},
  liga_name varchar(250) NOT NULL default '',
  liga_year varchar(250) NOT NULL default '',
  liga_max_teams int(4) NOT NULL default '0',
  liga_order int(4) NOT NULL default '0',
  liga_points_win int(4) NOT NULL default '0',
  liga_points_draw int(4) NOT NULL default '0',
  liga_points_loose int(4) NOT NULL default '0',
  PRIMARY KEY (liga_manager_ligen_id)
){engine};

CREATE TABLE {pre}_liga_manager_ttl (
  liga_manager_ttl_id {serial},
  liga_id int(4) NOT NULL default '0',
  team_id int(4) NOT NULL default '0',
  PRIMARY KEY  (liga_manager_ttl_id)
){engine};

CREATE TABLE {pre}_liga_manager_games (
  liga_manager_games_id {serial},
  liga_id int(4) NOT NULL default '0',
  team1_id int(4) NOT NULL default '0',
  team2_id int(4) NOT NULL default '0',
  games_time varchar(14) NOT NULL default '0',
  score_team1 int(5) NOT NULL default '0',
  score_team2 int(5) NOT NULL default '0',
  winning_team_id int(4) NOT NULL default '0',
  PRIMARY KEY  (liga_manager_games_id)
){engine};

