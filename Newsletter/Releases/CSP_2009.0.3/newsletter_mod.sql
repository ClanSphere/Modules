CREATE TABLE {pre}_newsletter_user (
	newsletter_user_id {serial},
	email varchar(255) NOT NULL default '',
	ip varchar(15) NOT NULL default '',
	time int(14) NOT NULL default '0',
	PRIMARY KEY (newsletter_user_id)
){engine};