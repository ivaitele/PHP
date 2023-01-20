###
1. Parašykite užklausą, kuri ištrauktų visus įrašus iš lentelės "Employees" ir atvaizduotų jų vardus ir pavardes.

# Kuriama "Employees" lentelė
create table Employees
(
    id         INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name  VARCHAR(50),
    alga_eur   DECIMAL(10, 2),
    email      VARCHAR(50),
    PRIMARY KEY (id)
);

#
Ivedami duomenys i "Employees" lentele

insert into Employees (first_name, last_name, alga_eur, email)
VALUES ('Dalius', 'Dalaitis', 2000, 'pirma@gmail.com'),
       ('Rina', 'Rinaite', 1500, 'asd@gmail.com'),
       ('Saulius', 'Saulenas', 1000, 'ass@gmail.com')

# Atvaizduojami visi Employees lenteles irasai (vardai,pavardes)

select first_name, last_name
from Employees;

###
2. Parašykite užklausą, kuri atnaujintų darbuotojo algas lentelėje "Employees", kurio ID yra "2", į 10% didesnę nei dabartinė alga.

# Sukuriame nauja stulpeli "alga_eur"  Employees lenteleje

###
alter table Employees
    add alga_eur dec(10, 2);

update Employees
set alga_eur = alga_eur * 1.1
where id = 2;

####
3. Parašykite užklausą, kuri ištrintų visus įrašus iš lentelės "Orders", kurie yra senesni nei 1 metai.

# Kuriama "Orders" lentelė

create table Orders
(
    id         INT NOT NULL AUTO_INCREMENT,
    Order_date date,
    PRIMARY KEY (id)
);
#
Ivedami duomenys i lentele

insert into Orders (Order_date)
VALUES ('2020-05-07'),
       ('2022-01-01'),
       ('2023-01-01');

#
Ištrinami duomenys senesni nei 1 metai.

delete from Orders where order_date < DATE_SUB(NOW(), interval 1 year);

##
4. Parašykite užklausą, kuri į lentelę "Customers" įterptų naują įrašą su vardu "John", pavarde "Doe" ir el. pašto adresu "john.doe@email.com".

# Kuriama "Customers" lentelė
create table Customers
(
    id         INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name  VARCHAR(50),
    email      VARCHAR(50),
    PRIMARY KEY (id)
);
#
Iterpiami duomenys

insert into Customers (first_name, last_name, email)
VALUES ('John', 'Doe', 'john.doe@email.com');

###########################################################3
alter table `groups`
    add foreign key (address_id) references addresses (id);

alter table `groups`
    add foreign key (state) references states (id);

alter table `persons`
    add foreign key (address_id) references addresses (id);

##################################
adresai su country iso
SELECT id
FROM addresses
WHERE country_iso NOT IN (SELECT iso From countries);

update addresses
set country_iso ='LT'
WHERE country_iso NOT IN (SELECT iso From countries);

alter table countries
    add index (iso);

alter table `addresses`
    add foreign key (country_iso) references countries (iso);
#############################################################################
alter table `users`
    add foreign key (state) references states (id);

alter table `person2gruop`
    add foreign key (person_id) references persons (id);

alter table `person2gruop`
    add foreign key (groups_id) references `groups` (id);

############################
Uzduodtys JOIN ###################
######1 Kiek 'useriu' kurių 'state' yra 'Inactive'  būsenoje.

select count(*) from users
    JOIN states on users.state = states.id
    where states.title = 'Active';

#######2
Kiek 'gruops' kuriu 'state' yra 'Active' būsenoje.
select count(*) from `groups`
      JOIN states on `groups`.state = states.id
where states.title = 'Active';

####
3 ####
select persons.first_name, persons.last_name, addresses.city, countries.title
from persons
         JOIN addresses ON persons.address_id = addresses.id
         JOIN countries ON addresses.id = countries.id;

#################################################################################################3
use akademija;
select count(*)
from users
         JOIN states on users.state = states.id
where states.title = 'Active';

select count(*)
from `groups`
         left JOIN states on `groups`.state = states.id
where states.title = 'Active';

select persons.first_name, persons.last_name, addresses.city, countries.title
from persons
         JOIN addresses ON persons.address_id = addresses.id
         JOIN countries ON addresses.id = countries.id
where persons.address_id is not null;

########## 4 Suskaičiuoti kiek yra studentų tik aktyviose "Active" grupėse.
######### Pavaizduoti Grupės pavadinimą ir studentų skaičių tose grupese.

select count(person_id) as kiekis, groups.title
from person2gruop
         left join `groups` on persons2group.group_id = `groups`.id
         left join states on `groups`.id = states.id
where states.title = 'Suspended'
group by `groups`.id;

select groups_suspended.id, groups_suspended.title as ieskoma_grupe, count(person_id) as kiekis
from person2gruop
         join (select *
               from `groups`
               where state in (select id from states where `groups`.title like 'Suspended')) as groups_suspended
              on person2gruop.groups_id = groups_suspended.id
group by groups_suspended.id;

############# 5 Uzduotis Atvaizduoti tik dieninių (Kai grupės pavadinimas baigiasi 'D' raide) studijų studentų:
############   a) sąrašą  b) bendrą skaičių

select persons.first_name, `groups`.title
from person2gruop
         left join persons on persons.id = person2gruop.person_id
         left join `groups` on `groups`.id = person2gruop.groups_id
where `groups`.title like '%D';

select count(persons.id) as studentu_skaicius
from person2gruop
         left join `persons` on persons.id = person2gruop.person_id
         left join `groups` on `groups`.id = person2gruop.groups_id
where `groups`.title like '%D';

########### 6 Pavaizduoti pasirinktos grupės studentus ir pilną adresą viename stulpelyje.
############  (Užklausos salygoje ieskoti pagal grupės pavadinimą ne ID)

select persons.id, persons.first_name, concat(addresses.city, addresses.street) as adresas
from persons
         join addresses ON persons.address_id = addresses.id
         join person2gruop on persons.id = person2gruop.person_id
         join `groups` on person2gruop.groups_id = `groups`.id
where `groups`.title = 'CS_PHP_D';

select *
from persons
         JOIN person2gruop ON persons.id = person2gruop.person_id
         JOIN `groups` ON person2gruop.groups_id = `groups`.id
where `groups`.title = 'CS_PHP_D';


select count(*)
from users
         JOIN states on users.state = states.id
where states.title = 'Active';

select count(*)
from `groups`
         JOIN states on `groups`.state = states.id
where states.title = 'Active';

select persons.first_name, persons.last_name, addresses.city, countries.title
from persons
         JOIN addresses ON persons.address_id = addresses.id
         JOIN countries ON addresses.id = countries.id
where persons.address_id is not null;

select count(person_id) as kiekis, groups.title
from person2gruop
         left join `groups` on person2group.groups_id = `groups`.id
         join states on `groups`.id = states.id
where states.title = 'Suspended'
group by `groups`.id;

####### 6 Pavaizduoti pasirinktos grupės studentus ir pilną adresą viename stulpelyje.
#### (Užklausos salygoje ieskoti pagal grupės pavadinimą ne ID)

select groups_suspended.id, groups_suspended.title as ieskoma_grupe, count(person_id) as kiekis
from person2gruop
         join (select *
               from `groups`
               where state in (select id from states where `groups`.title like 'Suspended')) as groups_suspended
              on person2gruop.groups_id = groups_suspended.id
group by groups_suspended.id;

#### 7 Surasti visus asmenis (‘persons’) kurie neturi vardo (first_name’) arba pavardės (‘last_name’) ir turi
### neaktyvų (‘Inactive’) vartotoją (‘users’’) (Jei tokių duomenų nėra prieš atliekant užduotį reikia
### pakoreguoti persons lentos  duomenis ir pašalinti keleta vardu ir pavardziu)

select first_name, last_name from persons
  left join users u on persons.id = u.person_id
  left join states s on u.state = s.id
where  (persons.first_name is null
or persons.last_name is null) and s.title = 'Active';

#### 8 Suskaičiuoti kiek grupių naudojasi tais pačiais adresais. Atvaizduoti kiekio stulpelį ir
###    pilna adresą kaip vieną stulpelį. (viso 2 stulpeliai)

select count(`groups`.address_id) as kiekis, concat(a.city,' ', a.street) adresas  from `groups`
left join addresses a on `groups`.address_id = a.id
group by address_id having count(*) > 1;

