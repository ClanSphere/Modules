INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('ckeditor', 'skin', 'kama');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('ckeditor', 'height', '400');

ALTER TABLE {pre}_access ADD access_ckeditor int(8) NOT NULL default '0';