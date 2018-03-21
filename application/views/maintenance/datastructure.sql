/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state` varchar(2) NOT NULL,
  `description` text NOT NULL,
  `area_code` varchar(3) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `zip_code` text NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


/*Table structure for table `options` */

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `key` varchar(64) NOT NULL,
  `value` text,
  `label` varchar(64) DEFAULT NULL,
  `input_type` varchar(32) DEFAULT 'text' COMMENT 'text, textarea',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `options` */

insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('city_page_layout','city.php','City Page Layout','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('city_title_format','%city_name%, %state_abbr% | %site_title%','City Title Format','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('default_frontpage_layout','frontpage','Default Frontpage/Index Layout','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('default_page_layout','page.php','Default Page Layout','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('default_sidebar','sidebar.php','Default Sidebar','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('email_admin','','System Email Address','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('footer_copyright','All right reserved Web2rank Philippines','Footer Copyright','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('frontpage_id','1','Front Page / Index Page','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('meta_descriptions','','Meta Descriptions','textarea',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('meta_keywords','','Meta Keywords','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('page_not_found','page_not_found.php','Not Found Page','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('page_title_format','%page_title% | %site_title%','Page Title Format','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('record_per_page','10','Records Per Page','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('site_title','Awesome Site Title','Site Title','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('state_page_layout','state.php','State Page Layout','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('state_title_format','%state_name% | %site_title% ','States Title Format','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('tag_line','A very awesome site for a very awesome baby cms','Tag Line of Site','text',NULL);
insert  into `options`(`key`,`value`,`label`,`input_type`,`description`) values ('theme','dev_theme','Theme','text',NULL);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text,
  `layout` varchar(64) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `date_added` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=publish, 2=draft, 3=trash',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

insert  into `pages`(`id`,`title`,`slug`,`content`,`layout`,`meta_key`,`meta_description`,`date_added`,`status`) 
values (1,'Frontpage','frontpage','<p>frontpage of the site</p>\r\n','page.php','','',NULL,1);

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


/*Table structure for table `states` */

DROP TABLE IF EXISTS `states`;

CREATE TABLE `states` (
  `abbr` varchar(2) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`abbr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `states` */