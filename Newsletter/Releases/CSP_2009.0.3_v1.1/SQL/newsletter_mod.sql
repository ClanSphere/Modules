CREATE TABLE {pre}_newsletter_user (
	newsletter_user_id {serial},
	newsletter_user_email varchar(255) NOT NULL default '',
	newsletter_user_ip varchar(15) NOT NULL default '',
	newsletter_user_time int(14) NOT NULL default '0',
	newsletter_user_active int NOT NULL default '0',
	newsletter_user_key varchar(255) NOT NULL default '0',
	PRIMARY KEY (newsletter_user_id)
){engine};