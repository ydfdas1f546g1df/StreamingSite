use test;

INSERT INTO tbl_users (name, username, email, passwordHash, admin) VALUE ('Administartor', 'admin', 'test@test.com', '7ce1add0d288b35e45c616c518379675ffd3cb1c80b3f31f314d01e509057f81', TRUE);

INSERT INTO tbl_users (name, username, email, passwordHash, admin) VALUE ('User', 'user', 'test@test.com', '7ce1add0d288b35e45c616c518379675ffd3cb1c80b3f31f314d01e509057f81', TRUE);