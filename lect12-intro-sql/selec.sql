-- Select all columns from the table named tracks
-- Workbench limits to 1000 records max
SELECT * 
FROM tracks;
SELECT * FROM artists;

-- Display tracks that cost more than 0.99.
-- Sort them from shortest to longest (in length)
SELECT * 
FROM tracks
WHERE unit_price > 0.99
ORDER BY milliseconds DESC;

-- Display tracks that cost more than 0.99.
-- Sort them from shortest to longest (in length)
-- Only show the track id, name, price, and length
SELECT track_id, name, unit_price, milliseconds 
FROM tracks
WHERE unit_price > 0.99
ORDER BY milliseconds DESC;

-- Display tracks that have a composer
-- Only show the track id, name, composer, price
SELECT track_id, name, composer, unit_price
FROM tracks
WHERE composer IS NOT NULL;


-- Display tracks that have 'you' or 'day' in their titles
SELECT * FROM tracks
WHERE name LIKE '%you%' OR name LIKE '%day%';


-- Display tracks composed by U2 that have 'you' or 'day' 
-- in their titles
SELECT * 
FROM tracks
WHERE (name LIKE '%you%' OR name LIKE '%day%') AND composer LIKE '%u2%';


-- Display all albums and artists corresponding to each album.
-- Only show album title and artist name
SELECT title AS album_title, name AS artist_name
FROM albums
LEFT JOIN artists
	ON albums.artist_id = artists.artist_id;

-- Display all Jazz tracks
SELECT tracks.name AS track_name, genres.name AS genre_name,
albums.title AS album_name, artists.name AS artist_name
FROM tracks
LEFT JOIN genres
	ON tracks.genre_id = genres.genre_id
LEFT JOIN albums
	on tracks.album_id = albums.album_id
LEFT JOIN artists
	ON albums.artist_id = artists.artist_id
WHERE tracks.genre_id = 2;



