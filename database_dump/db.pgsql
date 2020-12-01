BEGIN TRANSACTION;

create table accesses (
    access_type varchar(100) PRIMARY KEY
);

create table employee (
    employee_id SERIAL PRIMARY KEY,
    employee_password varchar(100) NOT NULL,
    first_name varchar(100) NOT NULL,
    last_name varchar(100),
    contact_no varchar(100),
    access_type varchar(100) NOT NULL,
    foreign key(access_type) references accesses(access_type)
);

create table customer (
    contact_no varchar(20) PRIMARY KEY,
    first_name varchar(100) NOT NULL,
    last_name varchar(100)
);

create table category (
    category_id SERIAL PRIMARY KEY,
    category_name varchar(100) NOT NULL
);

create table dealers (
    dealer_id SERIAL PRIMARY KEY,
    dealer_name varchar(100) NOT NULL,
    dealer_contact_no varchar(20)
);

create table taxes (
    tax_name varchar PRIMARY KEY,
    tax_percent float NOT NULL
);

create table bill_book (
    bill_id SERIAL PRIMARY KEY,
    contact_no varchar,
    net_discount float DEFAULT 0,
    total_payment money NOT NULL,
    total_tax float NOT NULL DEFAULT 0,
    datetime timestamp NOT NULL,
    foreign key(contact_no) references customer(contact_no)
);

create table purchase_book (
    purchase_id SERIAL PRIMARY KEY,
    dealer_id INTEGER,
    net_payment money NOT NULL,
    datetime timestamp NOT NULL,
    foreign key(dealer_id) references dealers(dealer_id)
);


create table inventory (
    item_id SERIAL PRIMARY KEY,
    item_name varchar NOT NULL,
    category_id INTEGER,
    item_price money NOT NULL,
    item_quantity integer NOT NULL,
    item_discount float DEFAULT 0,
    item_tax float DEFAULT 0,
    foreign key(category_id) references category(category_id)
);

create table purchased_items (
    purchase_id INTEGER,
    item_id  INTEGER,
    item_name varchar NOT NULL,
    item_base_price money NOT NULL,
    item_quantity integer,
    foreign key(item_id) references inventory(item_id),
    foreign key(purchase_id) references purchase_book(purchase_id)
);

create table sold_items (
    bill_id INTEGER,
    item_id  INTEGER,
    item_quantity varchar NOT NULL,
    item_price money NOT NULL,
    item_discount float,
    item_tax float,
    foreign key(item_id) references inventory(item_id),
    foreign key(bill_id) references bill_book(bill_id)
);

insert into accesses values('owner');
insert into accesses values('cashier');
insert into accesses values('manager');

insert into employee(employee_password, first_name, access_type)
values('123', 'Davie', 'owner');

END TRANSACTION;

