
select * from `groups` where id in (2, 3, 8);

SELECT max(id)
from `groups`;

select *
from persons
where first_name like '%on%'
order by first_name desc
    limit 5;

insert into persons (first_name, last_name, code, phone, email, address_id)
VALUES ('Dalius', 'Dalaitis', 50301010001, 37065634562, 'pirma@gmail.com', 2),
       ('Rina', 'Rinaite', 60201010002, 37065634562, 'asd@gmail.com', 2),
       ('Saulius', 'Saulenas', 50121010003, 3745634562, 'ass@gmail.com', 2),
       ('Kristina', 'Kritaite', 62551010002, 370656334562, 'ad@gmail.com', 2),
       ('Marius', 'Marinaitis', 53341010003, 370646334562, '123@gmail.com', 2);

select count(distinct `title`)
from `groups`;

SELECT COUNT(`address_id`) AS seimos_nariai, address_id FROM `persons`
GROUP BY `address_id`
HAVING COUNT(`address_id`) >= 2;

SELECT *
FROM persons
WHERE first_name LIKE '%jon%';

UPDATE `persons`
SET `first_name` = 'Jonas'
WHERE first_name like '%jon%';



UPDATE `persons`
SET address_id = -1
WHERE address_id between 15 and 30;

SELECT count(id)
FROM persons
WHERE address_id = -1;

UPDATE `groups`
SET `state_id` = -1
where `state_id` = 0;

SELECT count(id)
FROM `groups`
WHERE state_id = -1;


SELECT *
FROM `persons`
WHERE first_name like 'H%';

UPDATE persons
SET address_id =3
WHERE id IN (select * from (SELECT id FROM persons where first_name = 'H%' order by id DESC limit 10) persons);

select *
from persons
order by id desc
    limit 10;

ALTER TABLE `states`
    MODIFY title varchar(50);

UPDATE users t1
    INNER JOIN `groups` t2
ON t1.id = t2.id
    SET t1.state_id = t2.state_id;

UPDATE users
SET users.state_id = (
    SELECT groups.state_id
    FROM `groups`
    WHERE `groups`.state_id = `users`.state_id