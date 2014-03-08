DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id`           BIGINT(10)  NOT NULL AUTO_INCREMENT,
  `ldapunique`   BIGINT(10)  NOT NULL UNIQUE,
  `login_name`   VARCHAR(12) NOT NULL UNIQUE,
  `screen_name`  VARCHAR(30) NOT NULL,
  `kg_id`        INT(3) NOT NULL,
  `biography`    TEXT, 
  `timeadded`    TIMESTAMP, -- 自動でタイムスタンプ追加
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `talks`;
CREATE TABLE `talks` (
  `id`        BIGINT(10) NOT NULL AUTO_INCREMENT,
  `user_id`   BIGINT(10) NOT NULL,
  FOREIGN KEY (`user_id`)
  REFERENCES users(`id`),
  `slides`    VARCHAR(500), -- スライドのURL
  `week_id`   INT(3),
  FOREIGN KEY (`week_id`)
  REFERENCES lt_weeks(`id`),
  `timeadded` TIMESTAMP, -- 自動でタイムスタンプ追加
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `lt_weeks`;
CREATE TABLE `lt_weeks` ( -- LTを実施する週、日付を設定。管理メニューから編集。
  `id`   INT(3) NOT NULL AUTO_INCREMENT,
  `week` INT(2), -- 何週目
  `date` DATE, -- 日付
);

DROP TABLE IF EXISTS `kg`;
CREATE TABLE `kg` (
  `id`    INT(3) NOT NULL AUTO_INCREMENT,
  `name`  VARCHAR(20) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);


