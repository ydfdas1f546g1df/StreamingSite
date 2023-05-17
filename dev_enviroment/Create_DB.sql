drop database test;
CREATE DATABASE test;

USE test;

CREATE TABLE tbl_series
(
    id          int AUTO_INCREMENT NOT NULL,
    name        varchar(50)        NOT NULL,
    showName    varchar(200)  DEFAULT 'Series',
    description varchar(1000) DEFAULT 'Hosted By Streaming Site',
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
    created      date         DEFAULT CURDATE(),
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
CREATE TABLE tbl_verified
(
    token int,
    user  int,
    FOREIGN KEY tbl_verified (user) REFERENCES tbl_users (id)
)


CREATE TABLE `tableName`
(
    `639-1 code`            VARCHAR(512),
    `ISO language name`     VARCHAR(512),
    `Native name (endonym)` VARCHAR(512)
);

INSERT INTO `tableName` (`639-1 code`, `ISO language name`, `Native name (endonym)`)
VALUES ('aa', 'Afar', 'Afaraf'),
       ('ab', 'Abkhaz', 'аҧсуа бызшәа'),
       ('ae', 'Avestan', 'avesta'),
       ('af', 'Afrikaans', 'Afrikaans'),
       ('ak', 'Akan', 'Akan'),
       ('am', 'Amharic', 'አማርኛ'),
       ('an', 'Aragonese', 'aragonés'),
       ('ar', 'Arabic', 'اللغة العربية'),
       ('as', 'Assamese', 'অসমীয়া'),
       ('av', 'Avaric', 'авар мацӀ'),
       ('ay', 'Aymara', 'aymar aru'),
       ('az', 'Azerbaijani', 'azərbaycan dili'),
       ('ba', 'Bashkir', 'башҡорт теле'),
       ('be', 'Belarusian', 'беларуская мова'),
       ('bg', 'Bulgarian', 'български език'),
       ('bh', 'Bihari', 'भोजपुरी'),
       ('bi', 'Bislama', 'Bislama'),
       ('bm', 'Bambara', 'bamanankan'),
       ('bn', 'Bengali', 'বাংলা'),
       ('bo', 'Tibetan', 'བོད་ཡིག'),
       ('br', 'Breton', 'brezhoneg'),
       ('bs', 'Bosnian', 'bosanski jezik'),
       ('ca', 'Catalan', 'Català'),
       ('ce', 'Chechen', 'нохчийн мотт'),
       ('ch', 'Chamorro', 'Chamoru'),
       ('co', 'Corsican', 'corsu'),
       ('cr', 'Cree', 'ᓀᐦᐃᔭᐍᐏᐣ'),
       ('cs', 'Czech', 'čeština'),
       ('cu', 'Old Church Slavonic', 'ѩзыкъ словѣньскъ'),
       ('cv', 'Chuvash', 'чӑваш чӗлхи'),
       ('cy', 'Welsh', 'Cymraeg'),
       ('da', 'Danish', 'dansk'),
       ('de', 'German', 'Deutsch'),
       ('dv', 'Divehi', 'Dhivehi'),
       ('dz', 'Dzongkha', 'རྫོང་ཁ'),
       ('ee', 'Ewe', 'Eʋegbe'),
       ('el', 'Greek', 'Ελληνικά'),
       ('en', 'English', 'English'),
       ('eo', 'Esperanto', 'Esperanto'),
       ('es', 'Spanish', 'Español'),
       ('et', 'Estonian', 'eesti'),
       ('eu', 'Basque', 'euskara'),
       ('fa', 'Persian', 'فارسی'),
       ('ff', 'Fula', 'Fulfulde'),
       ('fi', 'Finnish', 'suomi'),
       ('fj', 'Fijian', 'Vakaviti'),
       ('fo', 'Faroese', 'føroyskt'),
       ('fr', 'French', 'Français'),
       ('fy', 'Western Frisian', 'Frysk'),
       ('ga', 'Irish', 'Gaeilge'),
       ('gd', 'Scottish Gaelic', 'Gàidhlig'),
       ('gl', 'Galician', 'galego'),
       ('gu', 'Gujarati', 'ગુજરાતી'),
       ('gv', 'Manx', 'Gaelg'),
       ('ha', 'Hausa', 'هَوُسَ'),
       ('he', 'Hebrew', 'עברית'),
       ('hi', 'Hindi', 'हिन्दी'),
       ('ho', 'Hiri Motu', 'Hiri Motu'),
       ('hr', 'Croatian', 'Hrvatski'),
       ('ht', 'Haitian', 'Kreyòl ayisyen'),
       ('hu', 'Hungarian', 'magyar'),
       ('hy', 'Armenian', 'Հայերեն'),
       ('hz', 'Herero', 'Otjiherero'),
       ('ia', 'Interlingua', 'Interlingua'),
       ('id', 'Indonesian', 'Bahasa Indonesia'),
       ('ie', 'Interlingue', 'Interlingue'),
       ('ig', 'Igbo', 'Asụsụ Igbo'),
       ('ii', 'Nuosu', 'ꆈꌠ꒿ Nuosuhxop'),
       ('ik', 'Inupiaq', 'Iñupiaq'),
       ('io', 'Ido', 'Ido'),
       ('is', 'Icelandic', 'Íslenska'),
       ('it', 'Italian', 'Italiano'),
       ('iu', 'Inuktitut', 'ᐃᓄᒃᑎᑐᑦ'),
       ('ja', 'Japanese', '日本語'),
       ('jv', 'Javanese', 'basa Jawa'),
       ('ka', 'Georgian', 'ქართული'),
       ('kg', 'Kongo', 'Kikongo'),
       ('ki', 'Kikuyu', 'Gĩkũyũ'),
       ('kj', 'Kwanyama', 'Kuanyama'),
       ('kk', 'Kazakh', 'қазақ тілі'),
       ('kl', 'Kalaallisut', 'kalaallisut'),
       ('km', 'Khmer', 'ខេមរភាសា'),
       ('kn', 'Kannada', 'ಕನ್ನಡ'),
       ('ko', 'Korean', '한국어'),
       ('kr', 'Kanuri', 'Kanuri'),
       ('ks', 'Kashmiri', 'कश्मीरी'),
       ('ku', 'Kurdish', 'Kurdî'),
       ('kv', 'Komi', 'коми кыв'),
       ('kw', 'Cornish', 'Kernewek'),
       ('ky', 'Kyrgyz', 'Кыргызча'),
       ('la', 'Latin', 'latine'),
       ('lb', 'Luxembourgish', 'Lëtzebuergesch'),
       ('lg', 'Ganda', 'Luganda'),
       ('li', 'Limburgish', 'Limburgs'),
       ('ln', 'Lingala', 'Lingála'),
       ('lo', 'Lao', 'ພາສາ'),
       ('lt', 'Lithuanian', 'lietuvių kalba'),
       ('lu', 'Luba-Katanga', 'Tshiluba'),
       ('lv', 'Latvian', 'latviešu valoda'),
       ('mg', 'Malagasy', 'fiteny malagasy'),
       ('mh', 'Marshallese', 'Kajin M̧ajeļ'),
       ('mi', 'Māori', 'te reo Māori'),
       ('mk', 'Macedonian', 'македонски јазик'),
       ('ml', 'Malayalam', 'മലയാളം'),
       ('mn', 'Mongolian', 'Монгол хэл'),
       ('mr', 'Marathi', 'मराठी'),
       ('ms', 'Malay', 'Bahasa Malaysia'),
       ('mt', 'Maltese', 'Malti'),
       ('my', 'Burmese', 'ဗမာစာ'),
       ('na', 'Nauru', 'Ekakairũ Naoero'),
       ('nb', 'Norwegian Bokmål', 'Norsk bokmål'),
       ('nd', 'Northern Ndebele', 'isiNdebele'),
       ('ne', 'Nepali', 'नेपाली'),
       ('ng', 'Ndonga', 'Owambo'),
       ('nl', 'Dutch', 'Nederlands'),
       ('nn', 'Norwegian Nynorsk', 'Norsk nynorsk'),
       ('no', 'Norwegian', 'Norsk'),
       ('nr', 'Southern Ndebele', 'isiNdebele'),
       ('nv', 'Navajo', 'Diné bizaad'),
       ('ny', 'Chichewa', 'chiCheŵa'),
       ('oc', 'Occitan', 'occitan'),
       ('oj', 'Ojibwe', 'ᐊᓂᔑᓈᐯᒧᐎᓐ'),
       ('om', 'Oromo', 'Afaan Oromoo'),
       ('or', 'Oriya', 'ଓଡ଼ିଆ'),
       ('os', 'Ossetian', 'ирон æвзаг'),
       ('pa', 'Panjabi', 'ਪੰਜਾਬੀ'),
       ('pi', 'Pāli', 'पाऴि'),
       ('pl', 'Polish', 'Polski'),
       ('ps', 'Pashto', 'پښتو'),
       ('pt', 'Portuguese', 'Português'),
       ('qu', 'Quechua', 'Runa Simi'),
       ('rm', 'Romansh', 'rumantsch grischun'),
       ('rn', 'Kirundi', 'Ikirundi'),
       ('ro', 'Romanian', 'Română'),
       ('ru', 'Russian', 'Русский'),
       ('rw', 'Kinyarwanda', 'Ikinyarwanda'),
       ('sa', 'Sanskrit', 'संस्कृतम्'),
       ('sc', 'Sardinian', 'sardu'),
       ('sd', 'Sindhi', 'सिन्धी'),
       ('se', 'Northern Sami', 'Davvisámegiella'),
       ('sg', 'Sango', 'yângâ tî sängö'),
       ('si', 'Sinhala', 'සිංහල'),
       ('sk', 'Slovak', 'slovenčina'),
       ('sl', 'Slovenian', 'slovenščina'),
       ('sn', 'Shona', 'chiShona'),
       ('so', 'Somali', 'Soomaaliga'),
       ('sq', 'Albanian', 'Shqip'),
       ('sr', 'Serbian', 'српски језик'),
       ('ss', 'Swati', 'SiSwati'),
       ('st', 'Southern Sotho', 'Sesotho'),
       ('su', 'Sundanese', 'Basa Sunda'),
       ('sv', 'Swedish', 'Svenska'),
       ('sw', 'Swahili', 'Kiswahili'),
       ('ta', 'Tamil', 'தமிழ்'),
       ('te', 'Telugu', 'తెలుగు'),
       ('tg', 'Tajik', 'тоҷикӣ'),
       ('th', 'Thai', 'ไทย'),
       ('ti', 'Tigrinya', 'ትግርኛ'),
       ('tk', 'Turkmen', 'Türkmen'),
       ('tl', 'Tagalog', 'Wikang Tagalog'),
       ('tn', 'Tswana', 'Setswana'),
       ('to', 'Tonga', 'faka Tonga'),
       ('tr', 'Turkish', 'Türkçe'),
       ('ts', 'Tsonga', 'Xitsonga'),
       ('tt', 'Tatar', 'татар теле'),
       ('tw', 'Twi', 'Twi'),
       ('ty', 'Tahitian', 'Reo Tahiti'),
       ('ug', 'Uyghur', 'ئۇيغۇرچە‎'),
       ('uk', 'Ukrainian', 'Українська'),
       ('ur', 'Urdu', 'اردو'),
       ('uz', 'Uzbek', 'Ўзбек'),
       ('ve', 'Venda', 'Tshivenḓa'),
       ('vi', 'Vietnamese', 'Tiếng Việt'),
       ('vo', 'Volapük', 'Volapük'),
       ('wa', 'Walloon', 'walon'),
       ('wo', 'Wolof', 'Wollof'),
       ('xh', 'Xhosa', 'isiXhosa'),
       ('yi', 'Yiddish', 'ייִדיש'),
       ('yo', 'Yoruba', 'Yorùbá'),
       ('za', 'Zhuang', 'Saɯ cueŋƅ'),
       ('zh', 'Chinese', '中文'),
       ('zu', 'Zulu', 'isiZulu');

INSERT INTO `tbl_languages` (`id`, `name`)
SELECT `639-1 code`, `ISO language name`
FROM `tablename`;
insert into tbl_genre (`name`) value ('genre')

use test;

INSERT INTO tbl_users (name, username, email, passwordHash, admin) VALUE ('Administartor', 'admin', 'admin@streamingsite.com',
                                                                          'c775e7b757ede630cd0aa1113bd102661ab38829ca52a6422ab782862f268646',
                                                                          TRUE);

INSERT INTO tbl_apitoken (id, user, expire) VALUE ('ijouhiuboubsdofsssosdnfosundfo', 1, '2023-12-12');

INSERT INTO tbl_users (name, username, email, passwordHash, admin) VALUE ('Colin Heggli', 'colin',
                                                                          'colin.heggli@gmail.com',
                                                                          'c775e7b757ede630cd0aa1113bd102661ab38829ca52a6422ab782862f268646',
                                                                          true);

INSERT INTO tbl_apitoken (id, user, expire) VALUE ('alojhsdvsddvsdvsdvsdvsafdbdbsd', 2, '2023-12-12');

CREATE TABLE tbl_admin_settings
(
    id          int NOT NULL AUTO_INCREMENT,
    name        varchar(100) DEFAULT 'setting',
    showName    varchar(100) DEFAULT 'setting',
    description varchar(500) DEFAULT 'setting',
    sel1        varchar(500) DEFAULT 'OFF',
    sel2        varchar(500) DEFAULT 'ON',
    state       boolean      DEFAULT FALSE,
    PRIMARY KEY tbl_admin_settings_id_primary (id)
);

insert into tbl_admin_settings (name, showName, description, sel1, sel2, state)
values ('safari', 'Prohibit Safari', 'Do not allow Safari users to use this website page.', 'OFF', 'ON', false),
       ('macos', 'Prohibit MacOS', 'Do not allow MacOS users to use the website.', 'OFF', 'ON', false),
       ('verify', 'Verification', 'Allow users to verify their email address.', 'OFF', 'ON', true),
       ('maintenance', 'Maintenance mode',
        'During maintenance or implementation of new features, only admins can enter the site.', 'OFF', 'ON', true),
       ('popular', 'Popular Series', 'Sort series by index or views.', 'Index', 'Views', true);



