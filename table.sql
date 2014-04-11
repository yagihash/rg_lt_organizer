DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `talks`;
DROP TABLE IF EXISTS `lt_weeks`;
DROP TABLE IF EXISTS `kgs`;
DROP TABLE IF EXISTS `years`;
DROP TABLE IF EXISTS `tracers`;

CREATE TABLE `users` (
           `id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
   `login_name` VARCHAR(12) NOT NULL UNIQUE,
  `screen_name` VARCHAR(30) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
        `kg_id` INT(3) NOT NULL,
    `biography` TEXT, 
      `year_id` INT(3) NOT NULL,
    `mail_auth` INT(1),
    `mail_hash` VARCHAR(500),
    `timeadded` TIMESTAMP, -- 自動でタイムスタンプ追加
  PRIMARY KEY (`id`)
);

CREATE TABLE `lt_weeks` ( -- LTを実施する週、日付を設定。管理メニューから編集。
           `id` INT(3) NOT NULL AUTO_INCREMENT,
         `week` INT(2), -- 何週目
         `date` DATE, -- 日付
  PRIMARY KEY (`id`)
);

CREATE TABLE `talks` (
           `id` BIGINT(10) NOT NULL AUTO_INCREMENT,
      `user_id` BIGINT(10) NOT NULL,
       `title` VARCHAR(500),
       `slide` VARCHAR(500), -- スライドのURL
      `lt_week_id` INT(3),
      `order` INT(3), -- 発表順
    `timeadded` TIMESTAMP, -- 自動でタイムスタンプ追加
  FOREIGN KEY (`user_id`)
    REFERENCES users(`id`),
  FOREIGN KEY (`lt_week_id`)
    REFERENCES lt_weeks(`id`),
  PRIMARY KEY (`id`)
);

CREATE TABLE `kgs` (
           `id` INT(3) NOT NULL AUTO_INCREMENT,
         `name` VARCHAR(20) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);

CREATE TABLE `years` (
           `id` INT(3) NOT NULL AUTO_INCREMENT,
         `name` VARCHAR(20) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);

-- 攻撃検知用のテーブル
CREATE TABLE `tracers` (
           `id` INT(3) NOT NULL AUTO_INCREMENT,
         `user_id` VARCHAR(20) NOT NULL UNIQUE,
         `logtype` INT(3), -- 普通の 0, エラー 1, 攻撃っぽいの 10,
            `text` VARCHAR(512), -- 内容詳細
  PRIMARY KEY (`id`)
);



-- 学年は固定なので直接書く
INSERT INTO years(name) VALUES ('B1');
INSERT INTO years(name) VALUES ('B2');
INSERT INTO years(name) VALUES ('B3');
INSERT INTO years(name) VALUES ('B4');
INSERT INTO years(name) VALUES ('M1');
INSERT INTO years(name) VALUES ('M2');
INSERT INTO years(name) VALUES ('Faculty');
INSERT INTO years(name) VALUES ('Other');

-- WEEKも固定っぽいので書く
INSERT INTO lt_weeks(week,date) VALUES(3,'2014-04-24');
INSERT INTO lt_weeks(week,date) VALUES(7,'2014-05-22');
INSERT INTO lt_weeks(week,date) VALUES(9,'2014-06-12');

-- テスト用ユーザ
INSERT INTO `users` (`login_name`, `screen_name`, `kg_id`, `biography`, `year_id`) VALUES ('test', 'I am a test account', 2, NULL, 5);
INSERT INTO `users` (`login_name`, `screen_name`, `kg_id`, `biography`, `year_id`) VALUES ('yagihash', 'yagihash', 2, NULL, 5);

-- テスト用kg
INSERT INTO kgs(name) VALUES ('ISC');
INSERT INTO kgs(name) VALUES ('CPSF');
