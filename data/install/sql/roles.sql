SET NAMES 'utf8';
INSERT INTO corportal_sodis_db.core_role(id, parent_id, role) VALUES (1, NULL, 'guest');
INSERT INTO corportal_sodis_db.core_role(id, parent_id, role) VALUES (2, 1, 'member');
INSERT INTO corportal_sodis_db.core_role(id, parent_id, role) VALUES (3, 2, 'admin');
