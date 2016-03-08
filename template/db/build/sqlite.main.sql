create table roles (
    role_id INTEGER PRIMARY KEY AUTOINCREMENT,
    name varchar(50)
);

insert into roles (name) values ('admin');
insert into roles (name) values ('user');

create table organizations (
    org_id INTEGER PRIMARY KEY AUTOINCREMENT,
    role_id integer,
    name varchar(50),
    is_enabled bool default true,
    created_on int default null,
    FOREIGN KEY(role_id) REFERENCES roles(role_id)
);
CREATE INDEX organizations_idx1 ON organizations(role_id);
CREATE INDEX organizations_idx2 ON organizations(is_enabled);


insert into organizations (role_id,name) values (1,'Admin Org');
insert into organizations (role_id,name) values (2,'British General Products');
insert into organizations (role_id,name) values (2,'Canadian Stuff Manufacturing');
insert into organizations (role_id,name) values (2,'Dutch Processing inc');
insert into organizations (role_id,name) values (2,'East Timor Export Co.');
update organizations set created_on = strftime('%s','now');

create table users (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    org_id int,
    email varchar(255),
    password varchar(255),
    first_name varchar(255),
    last_name varchar(255),
    is_enabled bool default 1,
    last_login int default null,
    created_on int default null,
    force_password_change bool default 0,
    register_key varchar(255) default '',
    FOREIGN KEY(org_id) REFERENCES organizations(org_id)
);

CREATE INDEX users_idx1 ON users(org_id);
CREATE INDEX users_idx2 ON users(is_enabled);
CREATE INDEX users_idx3 ON users(email);
CREATE INDEX users_idx4 ON users(register_key);

create table user_auth_tokens (
    token_id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id int,
    token varchar(255),
    created_on int default null,
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);
CREATE INDEX user_auth_tokens_idx1 ON user_auth_tokens(user_id);
CREATE INDEX user_auth_tokens_idx2 ON user_auth_tokens(token);


-- password is: password1
insert into users (org_id,email,password,first_name,last_name) values (1,'admin@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Alice','Atlanta');
insert into users (org_id,email,password,first_name,last_name) values (2,'user1@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Bob','Baltimore');
insert into users (org_id,email,password,first_name,last_name) values (2,'user2@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Charlie','Chicago');
insert into users (org_id,email,password,first_name,last_name) values (2,'user3@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Denise','Detroit');
insert into users (org_id,email,password,first_name,last_name) values (3,'user4@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Edgar','Escondido');
insert into users (org_id,email,password,first_name,last_name) values (3,'user5@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Fran','Fremont');
insert into users (org_id,email,password,first_name,last_name) values (3,'user6@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','George','Glendale');
insert into users (org_id,email,password,first_name,last_name) values (4,'user7@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Hattie','Honolulu');
insert into users (org_id,email,password,first_name,last_name) values (4,'user8@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Isaac','Indianapolis');
insert into users (org_id,email,password,first_name,last_name) values (4,'user9@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Julie','Jacksonville');
insert into users (org_id,email,password,first_name,last_name) values (4,'user10@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Kieran','Knoxville');
insert into users (org_id,email,password,first_name,last_name) values (4,'user11@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Lucy','Louisville');
insert into users (org_id,email,password,first_name,last_name) values (4,'user12@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Michael','Minneapolis');
insert into users (org_id,email,password,first_name,last_name) values (5,'user13@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Nancy','Newark');
insert into users (org_id,email,password,first_name,last_name) values (5,'user14@localhost.com','$2y$10$wHDMMT8IfEa9lEMzd2kQAuZvA2BwKNKPtwSE7ZNpQOBlO9Zlz0ORi','Oliver','Omaha');

update users set created_on = strftime('%s','now'), force_password_change = 0;

create table patches (
    patch_id INTEGER PRIMARY KEY AUTOINCREMENT,
    identifier varchar(255),
    applied_on_date TIMESTAMP default CURRENT_TIMESTAMP
);




create table addresses (
    address_id INTEGER PRIMARY KEY AUTOINCREMENT,
    org_id integer,
    name varchar(50),
    street_1 varchar(255),
    street_2 varchar(255),
    city varchar(255),
    region_id varchar(7),
    postal_code varchar(20),
    country_id varchar(2),
    phone_number_1 varchar(20),
    phone_number_2 varchar(20),
    FOREIGN KEY(org_id) REFERENCES organizations(org_id),
    FOREIGN KEY(region_id) REFERENCES regions(region_id),
    FOREIGN KEY(country_id) REFERENCES countries(country_id)
);

CREATE INDEX addresses_idx1 ON addresses(org_id);

insert into addresses (org_id,name,street_1,street_2,city,region_id,postal_code,country_id,phone_number_1,phone_number_2)
    values 
    (1, 'Admin office','100 Alpha St','Suite A','Atlanta','US-AL','30303-0001','US','(111) 111-1111','(111) 111-1111 ext 111'),
    (1, 'Adjunct office','100 Aleph Ave','Apt A','Atlanta','US-AL','30301-0001','US','(111) 111-2222','(111) 111-2222 ext 111'),
    (2, 'Base Camp','200 Base St','Suite B','Birmingham','GB-BIR','B74','GB','(020) 2222 2222','(020) 2222 2222 ext 222'),
    (2, 'Beta Site','210 Beta Ave','Apt B','Bradford','GB-BRD','B71','GB','(020) 2222 2444','(020) 2222 2444 ext 225'),
    (3, 'Central Command','300 Canada str','Suite C','Calgary','CA-AB','T20','CA','(333) 333 3333','(333) 333 3333 ext 333'),
    (4, 'Downtown Branch','400 Denmark ave','Suite D','Duluth','US-MN','56666','US','(444) 444-4444','(444) 444-4444 ext 444'),
    (5, 'Eastern Office','500 Excelsior ave','Suite E','East Chicago','US-IL','61666','US','(555) 555-5555','(555) 555-5555 ext 555');


CREATE TABLE `phinxlog` (`version` BIGINT NULL, `start_time` DATETIME NULL, `end_time` DATETIME NULL);
