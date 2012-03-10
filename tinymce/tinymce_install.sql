INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('tinymce', 'skin', '');

ALTER TABLE {pre}_access ADD access_tinymce int(8) NOT NULL default '0';