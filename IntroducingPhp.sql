
CREATE TABLE `contatcs` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `message` TEXT default NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO `myTable` (`name`,`message`)
VALUES
  ("Whoopi","Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla"),
  ("Miriam","rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in,"),
  ("Iona","mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla"),
  ("Kato","mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus"),
  ("Stewart","morbi tristique senectus et netus et malesuada fames ac turpis"),
  ("Thomas","arcu. Vestibulum ante ipsum primis in faucibus orci luctus et"),
  ("Zane","enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum"),
  ("Kenyon","et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien,"),
  ("Akeem","cursus, diam at pretium aliquet, metus urna convallis erat, eget"),
  ("Bert","magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor"),
  ("Naomi","pede, ultrices a, auctor non, feugiat nec, diam. Duis mi"),
  ("Sandra","nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula."),
  ("Illana","Cum sociis natoque penatibus et magnis dis parturient montes, nascetur"),
  ("Grady","pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero"),
  ("Linda","Cras eu tellus eu augue porttitor interdum. Sed auctor odio"),
  ("Yetta","egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est,"),
  ("Skyler","Duis sit amet diam eu dolor egestas rhoncus. Proin nisl"),
  ("George","mauris ipsum porta elit, a feugiat tellus lorem eu metus."),
  ("Brooke","sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus"),
  ("Edward","nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet");

