SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (1,2,NOW());
INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (1,3,NOW());
INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (1,100,NOW());
INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (2,1,NOW());
INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (2,3,NOW());
INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (2,100,NOW());
INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (100,2,NOW());
INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (100,3,NOW());
INSERT INTO ashiato (member_id_from , member_id_to, r_date) values (100,1,NOW());

SET FOREIGN_KEY_CHECKS = 1;
