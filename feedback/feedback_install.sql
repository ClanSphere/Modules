ALTER TABLE {pre}_access ADD access_feedback int(8) NOT NULL default '0';

INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('feedback', 'mail_detail', '');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('feedback', 'mail_short', '');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('feedback', 'mail_subject', '');

CREATE TABLE {pre}_feedback (
	feedback_id {serial},
  feedback_name varchar(200) NOT NULL default '',
  feedback_switch int(2) NOT NULL default '0',
  feedback_question text,
	PRIMARY KEY (feedback_id),
  UNIQUE (feedback_name)
){engine};

CREATE TABLE {pre}_feedbackmail (
	feedbackmail_id {serial},
  feedback_id int(8) NOT NULL default '0',
  feedbackmail_nick varchar(80) NOT NULL default '',
  feedbackmail_email varchar(200) NOT NULL default '',
  feedbackmail_time int(14) NOT NULL default '0',
	feedbackmail_text text,
	PRIMARY KEY (feedbackmail_id),
  UNIQUE (feedback_id, feedbackmail_email)
){engine};

CREATE INDEX {pre}_feedbackmail_feedback_id_index ON {pre}_feedbackmail (feedback_id);