#
# Table structure for table 'xoops_xim'
#
CREATE TABLE xim` (
  ref int(11) NOT NULL auto_increment,
  uid1 int(5) NOT NULL default '0',
  uid2 int(5) NOT NULL default '0',
  blocked int(5) NOT NULL default '1',
  approved int(1) NOT NULL default '0',
  PRIMARY KEY (ref),
  UNIQUE KEY REF (ref),
  KEY uid1 (uid1,uid2)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;