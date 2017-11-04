INSERT INTO corportal_sodis_db.core_user (`username`, `do_created`, `do_lastauth`) 
    VALUES('root',FROM_UNIXTIME(0),FROM_UNIXTIME(0));
INSERT INTO corportal_sodis_db.core_user (`username`,`do_created`, `do_lastauth`)
    SELECT u.`name`, FROM_UNIXTIME(u.created), NOW() FROM portal2.users u WHERE u.uid > 0;
  