<?php

$installer = $this;

$installer->startSetup();

$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('background')};
CREATE TABLE {$this->getTable('background')} (
  `background_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `content` text NOT NULL default '',
  `bg_type` VARCHAR(100) NOT NULL,
  `page_id` INT NOT NULL,
  `page_id_cat` INT NOT NULL,
  `page_id_cms` INT NOT NULL,
  `page_id_value` INT NOT NULL,
  `image_url` VARCHAR(255) NOT NULL,
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`background_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup(); 