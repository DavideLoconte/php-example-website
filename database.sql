-- Create a new database
CREATE DATABASE website;
\c website;

CREATE TABLE Users (
    username VARCHAR(50) PRIMARY KEY,   -- Unique username
    password TEXT NOT NULL         -- Hashed password
);

CREATE TABLE Posts (
    post_id SERIAL PRIMARY KEY,        -- Auto-incremented post ID
    username VARCHAR(50) NOT NULL,     -- User who made the post
    content VARCHAR(500) NOT NULL,     -- Post content (limit 500 characters)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp
    FOREIGN KEY (username) REFERENCES Users(username)
);


