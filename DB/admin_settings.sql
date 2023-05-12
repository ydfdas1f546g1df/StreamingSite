drop table tbl_admin_settings;
CREATE TABLE tbl_admin_settings
(
    id           int         NOT NULL AUTO_INCREMENT,
    name         varchar(100) DEFAULT 'setting',
    showName     varchar(100) DEFAULT 'setting',
    description  varchar(500) DEFAULT 'setting',
    state        boolean      DEFAULT FALSE,
    PRIMARY KEY tbl_admin_settings_id_primary (id)
);

insert into tbl_admin_settings (name, showName, description, state)
values
    ('safari', 'Prohibit Safari', 'Do not allow Safari users to use this website page.', false),
    ('macos','Prohibit MacOS', 'Do not allow MacOS users to use the website.', false),
    ('verify','Verification', 'Allow users to verify their email address.', true),
    ('maintenance', 'Maintenance mode', 'During maintenance or implementation of new features, only admins can enter the site.', true);

# CREATE TABLE tbl_users
# (
#     id           int         NOT NULL AUTO_INCREMENT,
#     name         varchar(100) DEFAULT 'User',
#     username     varchar(30) NOT NULL UNIQUE,
#     email        varchar(50) NOT NULL,
#     passwordHash char(64)    NOT NULL,
#     admin        boolean      DEFAULT FALSE,
#     bio          varchar(300) DEFAULT 'This Website is the Best',
#     created      date         DEFAULT CURDATE(),
#     PRIMARY KEY tbl_users_id_primary (id)
# );