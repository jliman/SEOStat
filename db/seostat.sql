-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2010 at 11:25 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6-1+lenny9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_backlink_stat`
--

CREATE TABLE IF NOT EXISTS `tbl_backlink_stat` (
  `id_profile` int(10) unsigned NOT NULL,
  `stat_date` date NOT NULL,
  `year` mediumint(4) unsigned NOT NULL,
  `month` tinyint(2) unsigned NOT NULL,
  `week` tinyint(2) unsigned NOT NULL,
  `backlink1` int(11) unsigned NOT NULL default '0' COMMENT 'backlinkwatch.com',
  `backlink2` int(11) unsigned NOT NULL default '0' COMMENT 'backlinkcheck.com',
  `backlink3` int(11) unsigned NOT NULL COMMENT 'yahoo siteexplorer',
  PRIMARY KEY  (`id_profile`,`stat_date`),
  KEY `id_profile` (`id_profile`),
  KEY `stat_date` (`stat_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `tbl_facebook_stat`
--

CREATE TABLE IF NOT EXISTS `tbl_facebook_stat` (
  `id_profile` int(10) unsigned NOT NULL,
  `stat_date` date NOT NULL,
  `year` mediumint(4) unsigned NOT NULL,
  `month` tinyint(2) unsigned NOT NULL,
  `week` tinyint(2) unsigned NOT NULL,
  `interactions` int(11) unsigned NOT NULL default '0',
  `comments` int(11) unsigned NOT NULL default '0',
  `wallposts` int(11) unsigned NOT NULL default '0',
  `fans` int(11) unsigned NOT NULL default '0',
  `likes` int(11) unsigned NOT NULL default '0',
  `unsubscribe` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id_profile`,`stat_date`),
  KEY `id_profile` (`id_profile`),
  KEY `stat_date` (`stat_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `tbl_ga_stat`
--

CREATE TABLE IF NOT EXISTS `tbl_ga_stat` (
  `id_profile` int(10) unsigned NOT NULL,
  `stat_date` date NOT NULL,
  `year` mediumint(4) unsigned NOT NULL,
  `month` tinyint(2) unsigned NOT NULL,
  `week` tinyint(2) unsigned NOT NULL,
  `day` enum('1','2','3','4','5','6','7') NOT NULL default '1' COMMENT '1 = Monday',
  `hour` time NOT NULL,
  `pageview` int(11) unsigned NOT NULL,
  `visit` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id_profile`,`stat_date`,`hour`),
  KEY `id_profile` (`id_profile`),
  KEY `stat_date` (`stat_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `tbl_group`
--

CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `is_active` enum('1','0') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


--
-- Table structure for table `tbl_group_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_group_profile` (
  `id_group` int(10) unsigned NOT NULL,
  `id_profile` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id_group`,`id_profile`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `tbl_index_stat`
--

CREATE TABLE IF NOT EXISTS `tbl_index_stat` (
  `id_profile` int(10) unsigned NOT NULL,
  `stat_date` date NOT NULL,
  `year` mediumint(4) unsigned NOT NULL,
  `month` tinyint(2) unsigned NOT NULL,
  `week` tinyint(2) unsigned NOT NULL,
  `google` int(11) unsigned NOT NULL default '0',
  `yahoo` int(11) unsigned NOT NULL default '0',
  `bing` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_profile`,`stat_date`),
  KEY `id_profile` (`id_profile`),
  KEY `stat_date` (`stat_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `tbl_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_profile` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `ga_username` varchar(255) NOT NULL,
  `ga_passwd` varchar(255) NOT NULL,
  `ga_profileid` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `fb_pageid` varchar(20) NOT NULL,
  `twitter_page` varchar(255) NOT NULL,
  `is_wordpress` enum('0','1') NOT NULL default '0',
  `is_blogger` enum('0','1') NOT NULL default '0',
  `is_active` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;


--
-- Table structure for table `tbl_rank_stat`
--

CREATE TABLE IF NOT EXISTS `tbl_rank_stat` (
  `id_profile` int(10) unsigned NOT NULL,
  `stat_date` date NOT NULL,
  `year` mediumint(4) unsigned NOT NULL,
  `month` tinyint(2) unsigned NOT NULL,
  `week` tinyint(2) unsigned NOT NULL,
  `alexa_rank` int(11) unsigned NOT NULL default '0',
  `google_pagerank` tinyint(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_profile`,`stat_date`),
  KEY `id_profile` (`id_profile`),
  KEY `stat_date` (`stat_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `tbl_target`
--

CREATE TABLE IF NOT EXISTS `tbl_target` (
  `id_profile` int(10) unsigned NOT NULL,
  `year` mediumint(4) unsigned NOT NULL,
  `month` tinyint(2) unsigned NOT NULL,
  `visit` int(10) unsigned NOT NULL,
  `pageview` int(10) unsigned NOT NULL,
  `alexarank` int(10) unsigned NOT NULL,
  `googlepagerank` int(10) unsigned NOT NULL,
  `googleindexedpage` int(10) unsigned NOT NULL,
  `yahooindexedpage` int(10) unsigned NOT NULL,
  `bingindexedpage` int(10) unsigned NOT NULL,
  `twitterfollower` int(10) unsigned NOT NULL,
  `facebookfan` int(10) unsigned NOT NULL,
  `yahoobacklink` int(10) unsigned NOT NULL,
  `blwbacklink` int(10) unsigned NOT NULL,
  `blcbacklink` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id_profile`,`year`,`month`),
  KEY `id_profile` (`id_profile`),
  KEY `year` (`year`),
  KEY `month` (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `tbl_twitter_stat`
--

CREATE TABLE IF NOT EXISTS `tbl_twitter_stat` (
  `id_profile` int(10) unsigned NOT NULL,
  `stat_date` date NOT NULL,
  `year` mediumint(4) unsigned NOT NULL,
  `month` tinyint(2) unsigned NOT NULL,
  `week` tinyint(2) unsigned NOT NULL,
  `following` int(11) unsigned NOT NULL default '0',
  `followers` int(11) unsigned NOT NULL default '0',
  `listed` int(11) unsigned NOT NULL default '0',
  `tweets` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_profile`,`stat_date`),
  KEY `id_profile` (`id_profile`),
  KEY `stat_date` (`stat_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `id_userlevel` int(11) NOT NULL,
  PRIMARY KEY  (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE IF NOT EXISTS `tbl_user_level` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL,
  PRIMARY KEY  (`userlevelid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`userlevelid`, `userlevelname`) VALUES
(-1, 'Administrator'),
(0, 'Default'),
(1, 'App Admin'),
(2, 'View Only');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level_permissions`
--

CREATE TABLE IF NOT EXISTS `tbl_user_level_permissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(80) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY  (`userlevelid`,`tablename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_level_permissions`
--

INSERT INTO `tbl_user_level_permissions` (`userlevelid`, `tablename`, `permission`) VALUES
(0, 'tbl_backlink_stat', 0),
(0, 'tbl_facebook_stat', 0),
(0, 'tbl_ga_stat', 0),
(0, 'tbl_group', 0),
(0, 'tbl_group_profile', 0),
(0, 'tbl_index_stat', 0),
(0, 'tbl_profile', 0),
(0, 'tbl_rank_stat', 0),
(0, 'tbl_target', 0),
(0, 'tbl_twitter_stat', 0),
(0, 'v_backlink_before_last_date', 0),
(0, 'v_backlink_last_date', 0),
(0, 'v_dashboard', 0),
(0, 'v_facebook_before_last_date', 0),
(0, 'v_facebook_last_date', 0),
(0, 'v_ga_before_last_date', 0),
(0, 'v_ga_last_date', 0),
(0, 'v_ga_stat_daily', 0),
(0, 'v_index_before_last_date', 0),
(0, 'v_index_last_date', 0),
(0, 'v_rank_before_last_date', 0),
(0, 'v_rank_last_date', 0),
(0, 'v_twitter_before_last_date', 0),
(0, 'v_twitter_last_date', 0),
(0, 'tbl_user', 0),
(0, 'tbl_user_level', 0),
(0, 'tbl_user_level_permissions', 0),
(1, 'tbl_backlink_stat', 15),
(2, 'tbl_backlink_stat', 8),
(1, 'tbl_facebook_stat', 15),
(2, 'tbl_facebook_stat', 8),
(1, 'tbl_ga_stat', 15),
(2, 'tbl_ga_stat', 8),
(1, 'tbl_group', 15),
(2, 'tbl_group', 8),
(1, 'tbl_group_profile', 15),
(2, 'tbl_group_profile', 8),
(1, 'tbl_index_stat', 15),
(2, 'tbl_index_stat', 8),
(1, 'tbl_profile', 15),
(2, 'tbl_profile', 8),
(1, 'tbl_rank_stat', 15),
(2, 'tbl_rank_stat', 8),
(1, 'tbl_target', 15),
(2, 'tbl_target', 8),
(1, 'tbl_twitter_stat', 15),
(2, 'tbl_twitter_stat', 8),
(1, 'v_backlink_before_last_date', 15),
(2, 'v_backlink_before_last_date', 8),
(1, 'v_backlink_last_date', 15),
(2, 'v_backlink_last_date', 8),
(1, 'v_dashboard', 15),
(2, 'v_dashboard', 8),
(1, 'v_facebook_before_last_date', 15),
(2, 'v_facebook_before_last_date', 8),
(1, 'v_facebook_last_date', 15),
(2, 'v_facebook_last_date', 8),
(1, 'v_ga_before_last_date', 15),
(2, 'v_ga_before_last_date', 8),
(1, 'v_ga_last_date', 15),
(2, 'v_ga_last_date', 8),
(1, 'v_ga_stat_daily', 15),
(2, 'v_ga_stat_daily', 8),
(1, 'v_index_before_last_date', 15),
(2, 'v_index_before_last_date', 8),
(1, 'v_index_last_date', 15),
(2, 'v_index_last_date', 8),
(1, 'v_rank_before_last_date', 15),
(2, 'v_rank_before_last_date', 8),
(1, 'v_rank_last_date', 15),
(2, 'v_rank_last_date', 8),
(1, 'v_twitter_before_last_date', 15),
(2, 'v_twitter_before_last_date', 8),
(1, 'v_twitter_last_date', 15),
(2, 'v_twitter_last_date', 8),
(1, 'tbl_user', 15),
(2, 'tbl_user', 8),
(1, 'tbl_user_level', 15),
(2, 'tbl_user_level', 8),
(1, 'tbl_user_level_permissions', 15),
(2, 'tbl_user_level_permissions', 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_backlink_before_last_date`
--
CREATE TABLE IF NOT EXISTS `v_backlink_before_last_date` (
`id_profile` int(10) unsigned
,`before_last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_backlink_last_date`
--
CREATE TABLE IF NOT EXISTS `v_backlink_last_date` (
`id_profile` int(10) unsigned
,`last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_dashboard`
--
CREATE TABLE IF NOT EXISTS `v_dashboard` (
`id_group` int(10) unsigned
,`id_profile` int(10) unsigned
,`name` varchar(255)
,`url` varchar(255)
,`bw_backlink` int(11) unsigned
,`bc_backlink` int(11) unsigned
,`yahoo_backlink` int(11) unsigned
,`backlink_asof` date
,`bw_backlink_before` int(11) unsigned
,`bc_backlink_before` int(11) unsigned
,`yahoo_backlink_before` int(11) unsigned
,`fans` int(11) unsigned
,`unsubscribe` int(11) unsigned
,`facebook_asof` date
,`fans_before` int(11) unsigned
,`unsubscribe_before` int(11) unsigned
,`followers` int(11) unsigned
,`tweets` int(11) unsigned
,`twitter_asof` date
,`followers_before` int(11) unsigned
,`tweets_before` int(11) unsigned
,`pageview` decimal(33,0)
,`visit` decimal(33,0)
,`ga_asof` date
,`pageview_before` decimal(33,0)
,`visit_before` decimal(33,0)
,`indexed_google` int(11) unsigned
,`indexed_yahoo` int(11) unsigned
,`indexed_bing` int(11) unsigned
,`indexed_asof` date
,`indexed_google_before` int(11) unsigned
,`indexed_yahoo_before` int(11) unsigned
,`indexed_bing_before` int(11) unsigned
,`alexa_rank` int(11) unsigned
,`google_pagerank` tinyint(2) unsigned
,`rank_asof` date
,`alexa_rank_before` int(11) unsigned
,`google_pagerank_before` tinyint(2) unsigned
,`year` mediumint(4) unsigned
,`month` tinyint(2) unsigned
,`visit_target` decimal(11,0)
,`pageview_target` decimal(11,0)
,`alexa_rank_target` decimal(11,0)
,`google_pagerank_target` decimal(11,0)
,`indexed_google_target` decimal(11,0)
,`indexed_yahoo_target` decimal(11,0)
,`indexed_bing_target` decimal(11,0)
,`followers_target` decimal(11,0)
,`fans_target` decimal(11,0)
,`yahoo_backlink_target` decimal(11,0)
,`bw_backlink_target` decimal(11,0)
,`bc_backlink_target` decimal(11,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_facebook_before_last_date`
--
CREATE TABLE IF NOT EXISTS `v_facebook_before_last_date` (
`id_profile` int(10) unsigned
,`before_last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_facebook_last_date`
--
CREATE TABLE IF NOT EXISTS `v_facebook_last_date` (
`id_profile` int(10) unsigned
,`last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ga_before_last_date`
--
CREATE TABLE IF NOT EXISTS `v_ga_before_last_date` (
`id_profile` int(10) unsigned
,`before_last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ga_last_date`
--
CREATE TABLE IF NOT EXISTS `v_ga_last_date` (
`id_profile` int(10) unsigned
,`last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ga_stat_daily`
--
CREATE TABLE IF NOT EXISTS `v_ga_stat_daily` (
`id_profile` int(10) unsigned
,`stat_date` date
,`pageview` decimal(33,0)
,`visit` decimal(33,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_index_before_last_date`
--
CREATE TABLE IF NOT EXISTS `v_index_before_last_date` (
`id_profile` int(10) unsigned
,`before_last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_index_last_date`
--
CREATE TABLE IF NOT EXISTS `v_index_last_date` (
`id_profile` int(10) unsigned
,`last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_rank_before_last_date`
--
CREATE TABLE IF NOT EXISTS `v_rank_before_last_date` (
`id_profile` int(10) unsigned
,`before_last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_rank_last_date`
--
CREATE TABLE IF NOT EXISTS `v_rank_last_date` (
`id_profile` int(10) unsigned
,`last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_twitter_before_last_date`
--
CREATE TABLE IF NOT EXISTS `v_twitter_before_last_date` (
`id_profile` int(10) unsigned
,`before_last_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_twitter_last_date`
--
CREATE TABLE IF NOT EXISTS `v_twitter_last_date` (
`id_profile` int(10) unsigned
,`last_date` date
);
-- --------------------------------------------------------

--
-- Structure for view `v_backlink_before_last_date`
--
DROP TABLE IF EXISTS `v_backlink_before_last_date`;

CREATE VIEW `v_backlink_before_last_date` AS select `r`.`id_profile` AS `id_profile`,max(`r`.`stat_date`) AS `before_last_date` from (`tbl_backlink_stat` `r` join `v_backlink_last_date` `v` on((`r`.`id_profile` = `v`.`id_profile`))) where (`r`.`stat_date` < `v`.`last_date`) group by `r`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_backlink_last_date`
--
DROP TABLE IF EXISTS `v_backlink_last_date`;

CREATE VIEW `v_backlink_last_date` AS select `tbl_backlink_stat`.`id_profile` AS `id_profile`,max(`tbl_backlink_stat`.`stat_date`) AS `last_date` from `tbl_backlink_stat` group by `tbl_backlink_stat`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_dashboard`
--
DROP TABLE IF EXISTS `v_dashboard`;

CREATE VIEW `v_dashboard` AS select sql_no_cache `gp`.`id_group` AS `id_group`,`p`.`id` AS `id_profile`,`p`.`name` AS `name`,`p`.`url` AS `url`,`bls`.`backlink1` AS `bw_backlink`,`bls`.`backlink2` AS `bc_backlink`,`bls`.`backlink3` AS `yahoo_backlink`,`bl`.`last_date` AS `backlink_asof`,`bls2`.`backlink1` AS `bw_backlink_before`,`bls2`.`backlink2` AS `bc_backlink_before`,`bls2`.`backlink3` AS `yahoo_backlink_before`,`f2`.`fans` AS `fans`,`f2`.`unsubscribe` AS `unsubscribe`,`f1`.`last_date` AS `facebook_asof`,`f4`.`fans` AS `fans_before`,`f4`.`unsubscribe` AS `unsubscribe_before`,`t2`.`followers` AS `followers`,`t2`.`tweets` AS `tweets`,`t1`.`last_date` AS `twitter_asof`,`t4`.`followers` AS `followers_before`,`t4`.`tweets` AS `tweets_before`,`g2`.`pageview` AS `pageview`,`g2`.`visit` AS `visit`,`g1`.`last_date` AS `ga_asof`,`g4`.`pageview` AS `pageview_before`,`g4`.`visit` AS `visit_before`,`i2`.`google` AS `indexed_google`,`i2`.`yahoo` AS `indexed_yahoo`,`i2`.`bing` AS `indexed_bing`,`i1`.`last_date` AS `indexed_asof`,`i4`.`google` AS `indexed_google_before`,`i4`.`yahoo` AS `indexed_yahoo_before`,`i4`.`bing` AS `indexed_bing_before`,`r2`.`alexa_rank` AS `alexa_rank`,`r2`.`google_pagerank` AS `google_pagerank`,`r1`.`last_date` AS `rank_asof`,`r4`.`alexa_rank` AS `alexa_rank_before`,`r4`.`google_pagerank` AS `google_pagerank_before`,`t`.`year` AS `year`,`t`.`month` AS `month`,coalesce(`t`.`visit`,0) AS `visit_target`,coalesce(`t`.`pageview`,0) AS `pageview_target`,coalesce(`t`.`alexarank`,0) AS `alexa_rank_target`,coalesce(`t`.`googlepagerank`,0) AS `google_pagerank_target`,coalesce(`t`.`googleindexedpage`,0) AS `indexed_google_target`,coalesce(`t`.`yahooindexedpage`,0) AS `indexed_yahoo_target`,coalesce(`t`.`bingindexedpage`,0) AS `indexed_bing_target`,coalesce(`t`.`twitterfollower`,0) AS `followers_target`,coalesce(`t`.`facebookfan`,0) AS `fans_target`,coalesce(`t`.`yahoobacklink`,0) AS `yahoo_backlink_target`,coalesce(`t`.`blwbacklink`,0) AS `bw_backlink_target`,coalesce(`t`.`blcbacklink`,0) AS `bc_backlink_target` from ((((((((((((((((((((((((((`tbl_profile` `p` join `tbl_group_profile` `gp` on((`p`.`id` = `gp`.`id_profile`))) left join `v_backlink_last_date` `bl` on((`bl`.`id_profile` = `p`.`id`))) left join `tbl_backlink_stat` `bls` on(((`bls`.`id_profile` = `p`.`id`) and (`bls`.`stat_date` = `bl`.`last_date`)))) left join `v_backlink_before_last_date` `bl2` on((`bl2`.`id_profile` = `p`.`id`))) left join `tbl_backlink_stat` `bls2` on(((`bls2`.`id_profile` = `p`.`id`) and (`bls2`.`stat_date` = coalesce(`bl2`.`before_last_date`,`bl`.`last_date`))))) left join `v_facebook_last_date` `f1` on((`f1`.`id_profile` = `p`.`id`))) left join `tbl_facebook_stat` `f2` on(((`f2`.`id_profile` = `p`.`id`) and (`f2`.`stat_date` = `f1`.`last_date`)))) left join `v_facebook_before_last_date` `f3` on((`f3`.`id_profile` = `p`.`id`))) left join `tbl_facebook_stat` `f4` on(((`f4`.`id_profile` = `p`.`id`) and (`f4`.`stat_date` = coalesce(`f3`.`before_last_date`,`f1`.`last_date`))))) left join `v_twitter_last_date` `t1` on((`t1`.`id_profile` = `p`.`id`))) left join `tbl_twitter_stat` `t2` on(((`t2`.`id_profile` = `p`.`id`) and (`t2`.`stat_date` = `t1`.`last_date`)))) left join `v_twitter_before_last_date` `t3` on((`t3`.`id_profile` = `p`.`id`))) left join `tbl_twitter_stat` `t4` on(((`t4`.`id_profile` = `p`.`id`) and (`t4`.`stat_date` = coalesce(`t3`.`before_last_date`,`t1`.`last_date`))))) left join `v_ga_last_date` `g1` on((`g1`.`id_profile` = `p`.`id`))) left join `v_ga_stat_daily` `g2` on(((`g2`.`id_profile` = `p`.`id`) and (`g2`.`stat_date` = `g1`.`last_date`)))) left join `v_ga_before_last_date` `g3` on((`g3`.`id_profile` = `p`.`id`))) left join `v_ga_stat_daily` `g4` on(((`g4`.`id_profile` = `p`.`id`) and (`g4`.`stat_date` = coalesce(`g3`.`before_last_date`,`g1`.`last_date`))))) left join `v_index_last_date` `i1` on((`i1`.`id_profile` = `p`.`id`))) left join `tbl_index_stat` `i2` on(((`i2`.`id_profile` = `p`.`id`) and (`i2`.`stat_date` = `i1`.`last_date`)))) left join `v_index_before_last_date` `i3` on((`i3`.`id_profile` = `p`.`id`))) left join `tbl_index_stat` `i4` on(((`i4`.`id_profile` = `p`.`id`) and (`i4`.`stat_date` = coalesce(`i3`.`before_last_date`,`i1`.`last_date`))))) left join `v_rank_last_date` `r1` on((`r1`.`id_profile` = `p`.`id`))) left join `tbl_rank_stat` `r2` on(((`r2`.`id_profile` = `p`.`id`) and (`r2`.`stat_date` = `r1`.`last_date`)))) left join `v_rank_before_last_date` `r3` on((`r3`.`id_profile` = `p`.`id`))) left join `tbl_rank_stat` `r4` on(((`r4`.`id_profile` = `p`.`id`) and (`r4`.`stat_date` = coalesce(`r3`.`before_last_date`,`r1`.`last_date`))))) left join `tbl_target` `t` on(((`t`.`id_profile` = `p`.`id`) and (`t`.`year` = year(`g1`.`last_date`)) and (`t`.`month` = month(`g1`.`last_date`))))) where (`p`.`is_active` = _latin1'1');

-- --------------------------------------------------------

--
-- Structure for view `v_facebook_before_last_date`
--
DROP TABLE IF EXISTS `v_facebook_before_last_date`;

CREATE VIEW `v_facebook_before_last_date` AS select `r`.`id_profile` AS `id_profile`,max(`r`.`stat_date`) AS `before_last_date` from (`tbl_facebook_stat` `r` join `v_facebook_last_date` `v` on((`r`.`id_profile` = `v`.`id_profile`))) where (`r`.`stat_date` < `v`.`last_date`) group by `r`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_facebook_last_date`
--
DROP TABLE IF EXISTS `v_facebook_last_date`;

CREATE VIEW `v_facebook_last_date` AS select `tbl_facebook_stat`.`id_profile` AS `id_profile`,max(`tbl_facebook_stat`.`stat_date`) AS `last_date` from `tbl_facebook_stat` group by `tbl_facebook_stat`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_ga_before_last_date`
--
DROP TABLE IF EXISTS `v_ga_before_last_date`;

CREATE VIEW `v_ga_before_last_date` AS select sql_no_cache `r`.`id_profile` AS `id_profile`,max(`r`.`stat_date`) AS `before_last_date` from (`tbl_ga_stat` `r` join `v_ga_last_date` `v` on((`r`.`id_profile` = `v`.`id_profile`))) where (`r`.`stat_date` < `v`.`last_date`) group by `r`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_ga_last_date`
--
DROP TABLE IF EXISTS `v_ga_last_date`;

CREATE VIEW `v_ga_last_date` AS select sql_no_cache `tbl_ga_stat`.`id_profile` AS `id_profile`,max(`tbl_ga_stat`.`stat_date`) AS `last_date` from `tbl_ga_stat` where (`tbl_ga_stat`.`stat_date` < (curdate() - interval 1 day)) group by `tbl_ga_stat`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_ga_stat_daily`
--
DROP TABLE IF EXISTS `v_ga_stat_daily`;

CREATE VIEW `v_ga_stat_daily` AS select `g`.`id_profile` AS `id_profile`,`g`.`stat_date` AS `stat_date`,sum(`g`.`pageview`) AS `pageview`,sum(`g`.`visit`) AS `visit` from `tbl_ga_stat` `g` group by `g`.`id_profile`,`g`.`stat_date`;

-- --------------------------------------------------------

--
-- Structure for view `v_index_before_last_date`
--
DROP TABLE IF EXISTS `v_index_before_last_date`;

CREATE VIEW `v_index_before_last_date` AS select `r`.`id_profile` AS `id_profile`,max(`r`.`stat_date`) AS `before_last_date` from (`tbl_index_stat` `r` join `v_index_last_date` `v` on((`r`.`id_profile` = `v`.`id_profile`))) where (`r`.`stat_date` < `v`.`last_date`) group by `r`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_index_last_date`
--
DROP TABLE IF EXISTS `v_index_last_date`;

CREATE VIEW `v_index_last_date` AS select `tbl_index_stat`.`id_profile` AS `id_profile`,max(`tbl_index_stat`.`stat_date`) AS `last_date` from `tbl_index_stat` group by `tbl_index_stat`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_rank_before_last_date`
--
DROP TABLE IF EXISTS `v_rank_before_last_date`;

CREATE VIEW `v_rank_before_last_date` AS select `r`.`id_profile` AS `id_profile`,max(`r`.`stat_date`) AS `before_last_date` from (`tbl_rank_stat` `r` join `v_rank_last_date` `v` on((`r`.`id_profile` = `v`.`id_profile`))) where (`r`.`stat_date` < `v`.`last_date`) group by `r`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_rank_last_date`
--
DROP TABLE IF EXISTS `v_rank_last_date`;

CREATE VIEW `v_rank_last_date` AS select `tbl_rank_stat`.`id_profile` AS `id_profile`,max(`tbl_rank_stat`.`stat_date`) AS `last_date` from `tbl_rank_stat` group by `tbl_rank_stat`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_twitter_before_last_date`
--
DROP TABLE IF EXISTS `v_twitter_before_last_date`;

CREATE VIEW `v_twitter_before_last_date` AS select `r`.`id_profile` AS `id_profile`,max(`r`.`stat_date`) AS `before_last_date` from (`tbl_twitter_stat` `r` join `v_twitter_last_date` `v` on((`r`.`id_profile` = `v`.`id_profile`))) where (`r`.`stat_date` < `v`.`last_date`) group by `r`.`id_profile`;

-- --------------------------------------------------------

--
-- Structure for view `v_twitter_last_date`
--
DROP TABLE IF EXISTS `v_twitter_last_date`;

CREATE VIEW `v_twitter_last_date` AS select `tbl_twitter_stat`.`id_profile` AS `id_profile`,max(`tbl_twitter_stat`.`stat_date`) AS `last_date` from `tbl_twitter_stat` group by `tbl_twitter_stat`.`id_profile`;
