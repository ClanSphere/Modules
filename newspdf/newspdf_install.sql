ALTER TABLE {pre}_access ADD access_newspdf int(8) NOT NULL default '0';

INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('newspdf', 'img_max_width', '500');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('newspdf', 'img_max_height', '800');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('newspdf', 'img_upload_to', 'uploads/newspdf/images');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('newspdf', 'pdf_dpi_x', '');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('newspdf', 'pdf_dpi_y', '');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('newspdf', 'pdf_upload_to', 'uploads/newspdf/sources');