CREATE TABLE users (
  id        SERIAL PRIMARY KEY,
  email     VARCHAR (255),
  password  VARCHAR (255),
  avatar    VARCHAR (2048),
  confirmation_token VARCHAR (255)
);