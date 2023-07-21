CREATE TABLE users (
  id INT NOT NULL unique AUTO_INCREMENT ,
 name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL unique,
  password VARCHAR(255) NOT NULL unique,
  gender VARCHAR(20) NOT NULL,
  college_name VARCHAR(255) NOT NULL,
   phone VARCHAR(10) NOT NULL ,
   city VARCHAR(255);
  PRIMARY KEY(id)
);
CREATE table bookings(
  id int not null unique AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
     email VARCHAR(255) NOT NULL unique,
      gender VARCHAR(20) NOT NULL,
       phone VARCHAR(10) NOT NULL ,
         college_name VARCHAR(255) NOT NULL,
          PRIMARY KEY(id)
)

CREATE TABLE cities(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE properties(

    id int not null AUTO_INCREMENT,
    city_id int not null ,
    name VARCHAR(255) not null ,
    address VARCHAR(255) not null ,
    description longtext NOT NULL,
    gender enum('male','female','unisex') not null,
    rent int not null ,
    rating_clean float(2,1) NOT NULL,
    rating_food float(2,1) not null,
    rating_safety float(2,1) not null,
    PRIMARY KEY(id),
    foreign key(city_id) references cities(id)
);

CREATE TABLE amenities(
  id INT NOT NULL unique  AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  type VARCHAR(25) NOT NULL,
  icon VARCHAR(30) NOT NULL,
  PRIMARY KEY(id)

);

CREATE TABLE property_amenities(
  id INT NOT NULL AUTO_INCREMENT,
  property_id INT NOT NULL,
  amenity_id INT NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(property_id) REFERENCES properties(id),
  FOREIGN KEY(amenity_id) REFERENCES amenities(id)
);

CREATE TABLE testinomials(
      id INT NOT NULL AUTO_INCREMENT,
  property_id INT NOT NULL,
  user_name VARCHAR(100) NOT NULL,
  content LONGTEXT NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(property_id) REFERENCES properties(id)
);

CREATE TABLE interested_users_properties (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  property_id INT NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(user_id) REFERENCES users(id),
  FOREIGN KEY(property_id) REFERENCES properties(id)
);




