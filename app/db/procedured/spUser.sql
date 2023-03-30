-- Id personId phone email isActive comment createdAt updatedAt

DROP PROCEDURE IF EXISTS spAddAccount;

DELIMITER //

CREATE PROCEDURE spAddAccount
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de conventions
  p_typePersoonId int(6)
  p_voornaam varchar(60),
  p_tussenvoegsel varchar(30),
  p_achternaam varchar(50),
  p_roepnaam varchar(60),
  p_isVolwassen bit,
) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        INSERT INTO person (firstname, infix, lastname, dateOfBirth, createdAt, updatedAt) VALUES (p_firstname, p_infix, p_lastname, p_dateOfBirth, SYSDATE(6), SYSDATE(6));
        INSERT INTO user (personId, username, password, createdAt, updatedAt) VALUES ((SELECT Id FROM person ORDER BY id DESC LIMIT 1), p_username, p_password, SYSDATE(6), SYSDATE(6));
    COMMIT;
END //
DELIMITER ;
