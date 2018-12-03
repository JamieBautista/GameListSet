CREATE TABLE user_account(
	`user_id` VARCHAR(4) NOT NULL, 
	`username` VARCHAR(20) NOT NULL, 
	`password` VARCHAR(20) NOT NULL, 
	`creation_date` DATETIME NOT NULL, 
	PRIMARY KEY (user_id, username)
);

INSERT INTO user_account VALUES ('1000', 'Admin', 'password', NOW());
INSERT INTO user_account VALUES ('1001', 'Jamie G', 'password', NOW());

CREATE TABLE current_money(
	user_id VARCHAR(4) NOT NULL, 
	currency VARCHAR(20) NOT NULL DEFAULT 'Philippine Peso', 
	current_savings REAL NOT NULL DEFAULT 0.00, 
	PRIMARY KEY (user_id, currency), 
	FOREIGN KEY (user_id) REFERENCES user_account (user_id)
	 ON DELETE CASCADE
);

INSERT INTO current_money (user_id, currency) VALUES ('1000', 'Philippine Peso');
INSERT INTO current_money (user_id, currency) VALUES ('1001', 'US Dollars');

CREATE TABLE list(
	user_id VARCHAR(4) NOT NULL, 
	list_id VARCHAR(5) NOT NULL, 
	list_name VARCHAR(20) NOT NULL DEFAULT 'Default', 
	PRIMARY KEY (list_id), 
	FOREIGN KEY (user_id) REFERENCES user_account (user_id)
	 ON DELETE CASCADE
);

INSERT INTO list VALUES ('1000', '10000', 'Default');
INSERT INTO list VALUES ('1001', '10001', 'Default');

CREATE TABLE games( 
	list_id VARCHAR(5) NOT NULL, 
	game_num INT NOT NULL, 
	title VARCHAR(30), 
	summary VARCHAR(200), 
	genre VARCHAR(20), 
	console VARCHAR(20), 
	price REAL, 
	PRIMARY KEY (list_id, game_num), 
	FOREIGN KEY (list_id) REFERENCES list (list_id)
	 ON DELETE CASCADE
);

INSERT INTO games VALUES ('10000', 1, 'The Sims', 'Its a life simulator', 'Simulation', 'PC', 599.95);
INSERT INTO games VALUES ('10000', 2, 'Cinderella Phenomenon', 'You are a princess', 'Visual Novel', 'PC', 0);

CREATE TABLE status ( 
	list_id VARCHAR(5) NOT NULL, 
	game_num INT NOT NULL, 
	status_type VARCHAR(15),
	plans VARCHAR(200),
	date_set DATE, 
	PRIMARY KEY (list_id, game_num), 
	FOREIGN KEY (list_id, game_num) REFERENCES games (list_id, game_num)
	 ON DELETE CASCADE
);

INSERT INTO status VALUES ('10000', 1, 'Not Yet Bought', 'Buy on December', NOW());
INSERT INTO status VALUES ('10000', 2, 'Bought', 'Play after sem ends', NOW());