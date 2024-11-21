CREATE TABLE user(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    balance DECIMAL(10, 2) NOT NULL DEFAULT 10000,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE stall(
    stall_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    available BOOLEAN DEFAULT TRUE
);

CREATE TABLE transaction(
    transaction_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    stall_id INT NOT NULL,
    user_id INT NOT NULL,
    years_contract INT NOT NULL,
    start_date DATE NOT NULL,
    paid BOOLEAN DEFAULT 0,
    payment_method ENUM('Gcash', 'Cash', 'Credit Card'),
    amount_paid DECIMAL(10, 2) DEFAULT 0,
    total_price DECIMAL(10, 2) NOT NULL,
    transaction_date DATE NOT NULL DEFAULT CURRENT_DATE(),
    FOREIGN KEY (stall_id) REFERENCES stall(stall_id),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);

CREATE TABLE admin(
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL
);

INSERT INTO admin (username, password) VALUES ('test-admin', 'admin123');