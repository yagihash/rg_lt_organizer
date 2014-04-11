DROP TABLE 'kgs';
CREATE TABLE 'kgs' ( 'id' INTEGER PRIMARY KEY AUTOINCREMENT, 'name' VARCHAR(20) NOT NULL UNIQUE );

INSERT INTO 'kgs' VALUES ('1', 'ISC');
INSERT INTO 'kgs' VALUES ('2', 'CPSF');

DROP TABLE 'lt_weeks';
CREATE TABLE 'lt_weeks' ( 'id' INTEGER PRIMARY KEY AUTOINCREMENT, 'week' INT(2) , 'date' DATE );

INSERT INTO 'lt_weeks' VALUES ('1', '3', '2014-04-24');
INSERT INTO 'lt_weeks' VALUES ('2', '7', '2014-05-22');
INSERT INTO 'lt_weeks' VALUES ('3', '9', '2014-06-12');

DROP TABLE 'talks';
CREATE TABLE 'talks' ( 'id' INTEGER PRIMARY KEY AUTOINCREMENT, 'user_id' BIGINT(10) NOT NULL , 'title' VARCHAR(500) , 'slide' VARCHAR(500) , 'lt_week_id' INT(3) , 'order' INT(3) , 'timeadded' TIMESTAMP DEFAULT (DATETIME('now','localtime')) );

DROP TABLE 'tracers';
CREATE TABLE 'tracers' ( 'id' INTEGER PRIMARY KEY AUTOINCREMENT, 'user_id' VARCHAR(20) NOT NULL UNIQUE , 'logtype' INT(3) , 'text' VARCHAR(512) );

DROP TABLE 'users';
CREATE TABLE 'users' ( 'id' INTEGER PRIMARY KEY, 'login_name' VARCHAR(12) NOT NULL, 'screen_name' VARCHAR(30) NOT NULL, 'password' VARCHAR(255) NOT NULL DEFAULT "", 'kg_id' INT(3) NOT NULL, 'biography' TEXT, 'year_id' INT(3) NOT NULL, 'mail_auth' INT(1), 'mail_hash' VARCHAR(500), 'timeadded' TIMESTAMP );

INSERT INTO 'users' VALUES ('1', 'test', 'I am a test account', '', '2', NULL, '5', NULL, NULL, NULL);
INSERT INTO 'users' VALUES ('2', 'yagihash', 'yagihash', '', '2', NULL, '5', NULL, NULL, NULL);
DROP TABLE 'years';
CREATE TABLE 'years' ( 'id' INTEGER PRIMARY KEY AUTOINCREMENT, 'name' VARCHAR(20) NOT NULL UNIQUE );

INSERT INTO 'years' VALUES ('1', 'B1');
INSERT INTO 'years' VALUES ('2', 'B2');
INSERT INTO 'years' VALUES ('3', 'B3');
INSERT INTO 'years' VALUES ('4', 'B4');
INSERT INTO 'years' VALUES ('5', 'M1');
INSERT INTO 'years' VALUES ('6', 'M2');
INSERT INTO 'years' VALUES ('7', 'Faculty');
INSERT INTO 'years' VALUES ('8', 'Other');
