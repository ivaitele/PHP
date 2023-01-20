
CREATE FUNCTION skaiciuoti (country varchar(255))
    RETURNS int DETERMINISTIC
BEGIN
    DECLARE ats int;
SELECT COUNT(*) INTO ats FROM addresses WHERE addresses.country_iso = country;
return ats;
END;

SELECT iso, skaiciuoti(iso) FROM akademija.countries;

SELECT skaiciuotiDublikatus(iso) AS kiekis, iso from countries HAVING kiekis > 0 ORDER BY kiekis DESC;
####################################Proceduros###########################################
use eshop;
##### 1
CREATE PROCEDURE remove_expired_customers(period int)
BEGIN
delete from Customers where Customers.Date < NOW() - interval period day ;
END;

##### 2

CREATE PROCEDURE increase_salary()
BEGIN
update Employees set salary = salary * 1.1 ;
END;

### 3
# INSERT INTO OrdersProductsName (order_product_id, product_name)
# SELECT
          #     OrdersProducts.id,
              #     Products.name
# FROM Orders
                               #     JOIN OrdersProducts ON Orders.id = OrdersProducts.order_id
          #     JOIN Products ON Products.id = OrdersProducts.product_id;

CREATE PROCEDURE create_orders_products_name()
BEGIN
INSERT INTO OrdersProductsName (order_product_id, product_name)
SELECT
    OrdersProducts.id,
    Products.name
FROM Orders
         JOIN OrdersProducts ON Orders.id = OrdersProducts.order_id
         JOIN Products ON Products.id = OrdersProducts.product_id;
END;

call create_orders_products_name();

#### 4


### 5

CREATE PROCEDURE count_orders_period(date_from date, date_to date)
BEGIN
    SET @from = date_from;
    SET @to = date_to;

insert into order_statistics(date_from, date_to, total)
SELECT @from, @to, count(*) from Orders where created_at between date_from and date_to;
END;

call count_orders_period('2023-01-18', '2023-01-20');



#######################  demo
SELECT
    Orders.state,
    Orders.created_at,
    Products.name,
    Products.price,
    OrdersProducts.quantity,
    Products.price * OrdersProducts.quantity AS total
FROM Orders
         JOIN OrdersProducts ON Orders.id = OrdersProducts.order_id
         JOIN Products ON Products.id = OrdersProducts.product_id
         JOIN Customers ON Customers.id = Orders.customer_id;


SELECT * FROM Orders WHERE Orders.id = 555;

UPDATE Products
    JOIN OrdersProducts ON OrdersProducts.product_id = Products.id
    JOIN Orders ON OrdersProducts.order_id = Orders.id
    SET in_store = in_store - OrdersProducts.quantity

WHERE Orders.id = 555;


CREATE PROCEDURE order_pay(order_id INT)
BEGIN

UPDATE Products
    JOIN OrdersProducts ON OrdersProducts.product_id = Products.id
    JOIN Orders ON OrdersProducts.order_id = Orders.id
    SET in_store = in_store - OrdersProducts.quantity

WHERE Orders.id = order_id AND Orders.state = 'draft';

UPDATE Orders SET state = 'payed' WHERE id = order_id;
END;


call order_pay(555);
##################################

# Procedures 4

CREATE PROCEDURE login_user(
    IN user_name varchar(50),
    IN password varchar(32),
    OUT found_user varchar(50),
    OUT status varchar(50)
)
BEGIN

SELECT Users.user_name INTO found_user FROM Users
WHERE Users.user_name = user_name AND BINARY Users.password = password;

SET status = 'User found, happy days!';
        IF (found_user IS NULL) THEN
            SET status = 'Incorrect username or password!';
end if;

SELECT found_user, status;
END;

call login_user('JonaS', 'jonas123', @result, @status);
SELECT @result, @status;
##################################

SELECT COUNT(*) FROM Customers GROUP BY 1 = 1;


SELECT * FROM Departments
                  JOIN Employees E on Departments.id = E.department_id
WHERE Departments.id = 2;


CREATE FUNCTION get_employees(department_id int)
    RETURNS varchar(50) DETERMINISTIC
BEGIN
    DECLARE result varchar(50);
SELECT E.first_name INTO result FROM Departments
                                         JOIN Employees E on Departments.id = E.department_id
WHERE Departments.id = department_id;
return result;
END;

SELECT *, get_employees(1) FROM Orders