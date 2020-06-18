-- Part 1 Q 1
SELECT * FROM albums;
SELECT * FROM artists
WHERE name LIKE '%spirit%';

-- Add an artist named Spirit of Troy first
INSERT INTO artists (name)
VALUES ('Spirit of Troy');

-- Add album Fight On by artist Spirit of Troy
INSERT INTO albums(title, artist_id)
VALUES('Fight On', 276);

-- Double check that the album was actually added
SELECT * 
FROM albums
ORDER BY album_id DESC;

SELECT * FROM genres;

-- Update track "All My Love" composed by E. Schrody and L. Dimant 
-- to be in the Fight On album & composed by Tommy Trojan
SELECT * FROM tracks
WHERE name = 'All My Love';

-- This will update TWO tracks that are named 'All My Love'
UPDATE tracks
SET composer = 'Tommy Trojan'
WHERE name = 'All My Love';

UPDATE tracks
SET composer = 'Tommy Trojan', album_id = 348
-- Use primary key to ensure only ONE record is updated
WHERE track_id = 3316;

-- Delete the album 'Fight On'
SELECT * FROM albums
WHERE album_id = 348;

-- Can't delete an album that is referenced by another table (All My Love)
DELETE FROM albums
WHERE album_id = 348;

-- Make 'All My Love' s album id to NULL
UPDATE tracks
SET album_id = null
WHERE track_id = 3316;

SELECT * FROM albums
ORDER BY album_id DESC;
-- Create a view that display all albums and their artist names
-- only show album id, album title, and artist name
CREATE OR REPLACE VIEW album_artists AS
SELECT albums.album_id, albums.title, artists.name
FROM albums
LEFT JOIN artists
	ON albums.artist_id = artists.artist_id;

-- "Calling" the view    
SELECT * FROM album_artists
-- can add other commands like WHERE, ORDER BY etc like a table
WHERE name = 'Accept';

UPDATE album_artists
SET title = 'does it work?'
WHERE album_id = 3;

SELECT * FROM album_artists;

SELECT COUNT(*), COUNT(composer) AS composer_count
FROM tracks;

-- In tracks, what's the longest track? shortest track? average track?
SELECT MIN(milliseconds), MAX(milliseconds), AVG(milliseconds)
FROM tracks;

-- How long is album id 1?
SELECT SUM(milliseconds)
FROM tracks
WHERE album_id = 1;

-- Find shortest track for EACH album
SELECT album_id, MIN(milliseconds)
FROM tracks
GROUP BY album_id;

-- Show artists and number of albums for each artists
SELECT album_id, artists.name, albums.artist_id, COUNT(*)
FROM albums
LEFT JOIN artists
	ON artists.artist_id = albums.artist_id
GROUP BY albums.artist_id;

SELECT * FROM tracks
WHERE name LIKE '%20%';

DELETE FROM tracks
WHERE track_id = 122;