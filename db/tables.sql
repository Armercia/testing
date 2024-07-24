CREATE DATABASE IF NOT EXISTS Abari;
USE Abari;

CREATE TABLE IF NOT EXISTS users (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    bio TEXT,
    email VARCHAR(100) UNIQUE,
    user_img_url VARCHAR(255) UNIQUE,
    gender ENUM('male', 'female', 'other') DEFAULT 'other',
    user_type ENUM('voter', 'admin', 'candidate') NOT NULL,
    status ENUM('active', 'inactive', 'banned') DEFAULT 'active',
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS elections (
    election_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NOT NULL,
    create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS votes (
    vote_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    election_id INT UNSIGNED,
    voter_id INT UNSIGNED,
    candidate_id INT UNSIGNED,
    vote_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (election_id) REFERENCES elections(election_id),
    FOREIGN KEY (voter_id) REFERENCES users(user_id),
    FOREIGN KEY (candidate_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS election_candidates (
    election_candidate_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    election_id INT UNSIGNED,
    user_id INT UNSIGNED,
    FOREIGN KEY (election_id) REFERENCES elections(election_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS election_voters (
    election_voter_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    election_id INT UNSIGNED,
    user_id INT UNSIGNED,
    FOREIGN KEY (election_id) REFERENCES elections(election_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
