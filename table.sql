DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
           `id` BIGINT(10)  NOT NULL AUTO_INCREMENT,
   `ldapunique` BIGINT(10)  NOT NULL UNIQUE,
   `login_name` VARCHAR(12) NOT NULL UNIQUE,
  `screen_name` VARCHAR(30) NOT NULL,
        `kg_id` INT(3) NOT NULL,
    `biography` TEXT, 
      `year_id` INT(3) NOT NULL,
    `timeadded` TIMESTAMP, -- 自動でタイムスタンプ追加

  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `talks`;
CREATE TABLE `talks` (
           `id` BIGINT(10) NOT NULL AUTO_INCREMENT,
      `user_id` BIGINT(10) NOT NULL,
       `title` VARCHAR(500),
       `slide` VARCHAR(500), -- スライドのURL
      `week_id` INT(3),
    `timeadded` TIMESTAMP, -- 自動でタイムスタンプ追加
  FOREIGN KEY (`user_id`)
    REFERENCES users(`id`),
  FOREIGN KEY (`week_id`)
    REFERENCES lt_weeks(`id`),
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `lt_weeks`;
CREATE TABLE `lt_weeks` ( -- LTを実施する週、日付を設定。管理メニューから編集。
           `id` INT(3) NOT NULL AUTO_INCREMENT,
         `week` INT(2), -- 何週目
         `date` DATE, -- 日付

  PRIMARY KEY (`id`)

);

DROP TABLE IF EXISTS `kgs`;
CREATE TABLE `kgs` (
           `id` INT(3) NOT NULL AUTO_INCREMENT,
         `name` VARCHAR(20) NOT NULL UNIQUE,
  
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `years`;
CREATE TABLE `years` (
           `id` INT(3) NOT NULL AUTO_INCREMENT,
         `name` VARCHAR(20) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);

-- 攻撃検知用のテーブル
DROP TABLE IF EXISTS `tracers`;
CREATE TABLE `tracers` (
           `id` INT(3) NOT NULL AUTO_INCREMENT,
         `user_id` VARCHAR(20) NOT NULL UNIQUE,
         `logtype` INT(3), -- 普通の 0, エラー 1, 攻撃っぽいの 10,
            `text` VARCHAR(512), -- 内容詳細
  PRIMARY KEY (`id`)
);



-- 学年は固定なので直接書く
INSERT INTO years(name) VALUES ("B1");
INSERT INTO years(name) VALUES ("B2");
INSERT INTO years(name) VALUES ("B3");
INSERT INTO years(name) VALUES ("B4");
INSERT INTO years(name) VALUES ("M1");
INSERT INTO years(name) VALUES ("M2");
INSERT INTO years(name) VALUES ("Faculty");
INSERT INTO years(name) VALUES ("Other");
