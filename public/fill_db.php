INSERT INTO your_table_name (proizvod_id, ucionica_id, datum, vrijeme, user_id)
SELECT
FLOOR(RAND() * 100) + 1, -- Random proizvod_id between 1 and 100
FLOOR(RAND() * 100) + 1, -- Random ucionica_id between 1 and 100
DATE_ADD('2020-01-01', INTERVAL FLOOR(RAND() * 1461) DAY), -- Random date between 2020 and 2023 (inclusive)
MAKETIME(FLOOR(RAND() * 9) + 10, FLOOR(RAND() * 60), 0), -- Random time between 10:00:00 and 18:59:59
FLOOR(RAND() * 1000) + 1 -- Random user_id between 1 and 1000
FROM
information_schema.tables
LIMIT 10;