	ALTER TABLE config ADD event_overwrite_protection TINYINT(1) DEFAULT NULL;
ALTER TABLE service ADD show_online TINYINT(1) DEFAULT NULL;
ALTER TABLE servicecategory ADD slug VARCHAR(255) NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD thumbnail VARCHAR(255) DEFAULT NULL, ADD description LONGTEXT NOT NULL, ADD position SMALLINT NOT NULL, ADD show_online TINYINT(1) DEFAULT NULL;


UPDATE `servicecategory` SET `slug`='massagen' WHERE  `id`=1;
UPDATE `servicecategory` SET `slug`='ruegener-heilkreide' WHERE  `id`=2;
UPDATE `servicecategory` SET `slug`='sanft-entschlacken' WHERE  `id`=3;
UPDATE `servicecategory` SET `slug`='hot-stone' WHERE  `id`=4;
UPDATE `servicecategory` SET `slug`='sanddorn' WHERE  `id`=5;
UPDATE `servicecategory` SET `slug`='paare' WHERE  `id`=6;
UPDATE `servicecategory` SET `slug`='kosmetik' WHERE  `id`=7;
UPDATE `servicecategory` SET `slug`='verwoehnangebote' WHERE  `id`=8;
UPDATE `servicecategory` SET `slug`='naturheilpraxis' WHERE  `id`=9;
UPDATE `servicecategory` SET `slug`='sonderangebote' WHERE  `id`=10;
UPDATE servicecategory SET show_online = 1 WHERE id != 10;
UPDATE service SET show_online = 1;

