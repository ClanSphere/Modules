ALTER TABLE {pre}_codepaste CHANGE codepaste_datei codepaste_file VARCHAR(25) NOT NULL DEFAULT '';

ALTER TABLE {pre}_codepaste ADD codepaste_path VARCHAR(50) NOT NULL DEFAULT '' AFTER codepaste_file;

ALTER TABLE {pre}_codepaste ADD codepaste_type VARCHAR(5) NOT NULL DEFAULT '' AFTER codepaste_path;