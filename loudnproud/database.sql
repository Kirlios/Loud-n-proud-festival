DROP DATABASE IF EXISTS loudnproud;
CREATE DATABASE loudnproud CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE loudnproud;

CREATE TABLE artists (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(100) NOT NULL,
    image_url       VARCHAR(500) DEFAULT '',
    origin          VARCHAR(50)  DEFAULT 'US',
    stage           VARCHAR(100) DEFAULT 'Main Stage',
    performance_day VARCHAR(50)  DEFAULT 'Day 1',
    popularity      INT          DEFAULT 0,
    is_headliner    TINYINT(1)   DEFAULT 0
);

CREATE TABLE tickets (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50)  NOT NULL,
    price       INT          NOT NULL,
    description TEXT
);

-- image_url left empty — PHP fetches from Wikipedia API (or serves local SVG for EsDeeKid)
INSERT INTO artists (name, image_url, origin, stage, performance_day, popularity, is_headliner) VALUES
-- HEADLINERS
('Kendrick Lamar',     '', 'US', 'Main Stage',  'Day 1', 100, 1),
('Skepta',             '', 'UK', 'Main Stage',  'Day 2', 96,  1),
('J. Cole',            '', 'US', 'Black Stage', 'Day 1', 95,  1),  -- headliner (replaced Separ)
('EsDeeKid',           '', 'UK', 'Black Stage', 'Day 2', 90,  1),

-- FULL LINEUP
('Tyler, the Creator', '', 'US', 'Main Stage',  'Day 1', 97,  0),
('Travis Scott',       '', 'US', 'Red Stage',   'Day 1', 94,  0),
('21 Savage',          '', 'US', 'Red Stage',   'Day 2', 91,  0),
('Denzel Curry',       '', 'US', 'Black Stage', 'Day 1', 87,  0),
('Dave',               '', 'UK', 'Main Stage',  'Day 1', 92,  0),
('Little Simz',        '', 'UK', 'Black Stage', 'Day 2', 89,  0),
('Stormzy',            '', 'UK', 'Red Stage',   'Day 1', 91,  0),
('Central Cee',        '', 'UK', 'Red Stage',   'Day 2', 88,  0),
('Separ',              '', 'SK', 'Main Stage',  'Day 2', 93,  0),  -- moved to full lineup
('Nik Tendo',          '', 'CZ', 'Black Stage', 'Day 1', 85,  0),
('Calin',              '', 'CZ', 'Red Stage',   'Day 2', 83,  0),  -- CZ (fixed)
('Kontrafakt',         '', 'SK', 'Red Stage',   'Day 1', 82,  0),
('Pil C',              '', 'SK', 'Black Stage', 'Day 2', 80,  0),  -- SK (fixed)
('Ektor',              '', 'CZ', 'Red Stage',   'Day 1', 79,  0),
('Vec',                '', 'SK', 'Black Stage', 'Day 2', 77,  0),
('Majk Spirit',        '', 'SK', 'Red Stage',   'Day 2', 75,  0);

INSERT INTO tickets (name, price, description) VALUES
('Basic Pass',    79,  '1-day entry to all stages'),
('Full Festival', 149, 'All days — full access'),
('VIP',           299, 'VIP zone, open bar & exclusive vibe');
