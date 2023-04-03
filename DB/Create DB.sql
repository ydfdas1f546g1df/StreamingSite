CREATE DATABASE test;

USE test;

CREATE TABLE tbl_series
(
    id          int AUTO_INCREMENT NOT NULL,
    name        varchar(50)        NOT NULL,
    showName    varchar(100) DEFAULT 'Serie',
    description varchar(100) DEFAULT 'Hosted By Streaming Site',
    PRIMARY KEY tbl_series_id_primary (id)
);


CREATE TABLE tbl_season
(
    id     int AUTO_INCREMENT NOT NULL,
    series int                NOT NULL,
    season int                NOT NULL,
    PRIMARY KEY tbl_season_id_primary (id),
    FOREIGN KEY tbl_season_series_foreign (series) REFERENCES tbl_series (id)
);


CREATE TABLE tbl_genre
(
    id   int AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    PRIMARY KEY tbl_genre_id_primary (id)
);


CREATE TABLE tbl_regisseur
(
    id   int AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    PRIMARY KEY tbl_regisseur_id_primary (id)
);


CREATE TABLE tbl_languages
(
    id   char(2)      NOT NULL,
    name varchar(100) NOT NULL,
    PRIMARY KEY tbl_languages_id_primary (id)
);


CREATE TABLE tbl_resolutions
(
    id     int NOT NULL AUTO_INCREMENT,
    height int NOT NULL,
    width  int NOT NULL,
    PRIMARY KEY tbl_resolutions_id_primary (id)
);


CREATE TABLE tbl_filetypes
(
    id        int         NOT NULL AUTO_INCREMENT,
    extension varchar(10) NOT NULL,
    PRIMARY KEY tbl_filetypes_id_primary (id)
);


CREATE TABLE tbl_users
(
    id           int         NOT NULL AUTO_INCREMENT,
    name         varchar(100) DEFAULT 'User',
    username     varchar(30) NOT NULL UNIQUE,
    email        varchar(50) NOT NULL,
    passwordHash char(64)    NOT NULL,
    admin        boolean      DEFAULT FALSE,
    bio          varchar(300) DEFAULT 'This Website is the Best',
    PRIMARY KEY tbl_users_id_primary (id)
);


CREATE TABLE tbl_apiToken
(
    id     char(30) UNIQUE NOT NULL,
    user   int             NOT NULL,
    expire date            NOT NULL,
    PRIMARY KEY tbl_apiToken_id_primary (id),
    FOREIGN KEY tbl_apiToken_user_foreign (user) REFERENCES tbl_users (id)
);


CREATE TABLE tbl_episode
(
    id          int AUTO_INCREMENT,
    name        varchar(100) NOT NULL,
    description varchar(300) DEFAULT 'Description',
    regisseur   int,
    watchcount  int UNSIGNED DEFAULT 0,
    genre       int          NOT NULL,
    upload      date         DEFAULT CURDATE(),
    language    char(2)      NOT NULL,
    season      int          NOT NULL,
    episode     int          NOT NULL,
    PRIMARY KEY tbl_episode_id_primary (id),
    FOREIGN KEY tbl_episode_regisseur (regisseur) REFERENCES tbl_regisseur (id),
    FOREIGN KEY tbl_episode_genre (genre) REFERENCES tbl_genre (id),
    FOREIGN KEY tbl_episode_language (language) REFERENCES tbl_languages (id),
    FOREIGN KEY tbl_episode_season (season) REFERENCES tbl_season (id)
);


CREATE TABLE tbl_watched
(
    user    int NOT NULL,
    episode int NOT NULL,
    FOREIGN KEY tbl_watched_user_foreign (user) REFERENCES tbl_users (id),
    FOREIGN KEY tbl_watched_episode_foreign (episode) REFERENCES tbl_episode (id)
);


CREATE TABLE tbl_watchlist
(
    user   int NOT NULL,
    series int NOT NULL,
    FOREIGN KEY tbl_watchlist_user_foreign (user) REFERENCES tbl_users (id),
    FOREIGN KEY tbl_watchlist_series_foreign (series) REFERENCES tbl_series (id)
);


CREATE TABLE tbl_formatsAvailable
(
    filetype   int,
    episode    int,
    resolution int,
    FOREIGN KEY tbl_formatsAvailable_filetype (filetype) REFERENCES tbl_filetypes (id),
    FOREIGN KEY tbl_formatsAvailable_episode (episode) REFERENCES tbl_episode (id),
    FOREIGN KEY tbl_formatsAvailable_resolution (resolution) REFERENCES tbl_resolutions (id)
);