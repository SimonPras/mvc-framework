-- edit start
-- Id personId phone email isActive comment createdAt updatedAt

DROP PROCEDURE IF EXISTS spEditContact;

DELIMITER //

CREATE PROCEDURE spEditContact
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de conventions
  personId int(6), 
  phone varchar(20),
  email varchar(320),
  isActive bit,
  comment varchar(250),
  Id int(6)

) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        UPDATE contact SET 
            personId = personId,
            phone = phone,
            email = email,
            isActive = isActive,
            comment = comment,
            updatedAt = SYSDATE(6)
        WHERE id = Id;
    COMMIT;
END //
DELIMITER ;