ALTER TABLE multimedia.images ALTER COLUMN description TYPE VARCHAR(1024) USING description::VARCHAR(1024);
ALTER TABLE multimedia.images ALTER COLUMN title TYPE VARCHAR(512) USING title::VARCHAR(512);
ALTER TABLE multimedia.images ALTER COLUMN name TYPE VARCHAR(512) USING name::VARCHAR(512);