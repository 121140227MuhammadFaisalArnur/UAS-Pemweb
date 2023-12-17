CREATE TABLE IF NOT EXISTS murid (
    nim VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(50) NOT NULL,
    religion VARCHAR(50) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    browser VARCHAR(255),
    ip_address VARCHAR(50) NOT NULL,
    PRIMARY KEY (nim)
);