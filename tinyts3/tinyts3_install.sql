ALTER TABLE {pre}_access ADD access_tinyts3 int(8) NOT NULL default '0';

INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('tinyts3', 'host', '');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('tinyts3', 'query_port', '');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('tinyts3', 'client_port', '');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('tinyts3', 'dns', '');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('tinyts3', 'ttl', '60');