INSERT INTO nations (name)
    VALUES ('JPN');
INSERT INTO nations (name)
    VALUES ('USA');
INSERT INTO nations (name)
    VALUES ('GER');
INSERT INTO nations (name)
    VALUES ('ITA');
INSERT INTO products (name,nation_id,description,created)
    VALUES ('日本酒', '1', '日本酒です', NOW());
INSERT INTO products (name,nation_id,description,created)
    VALUES ('赤ワイン', '4', '赤ワインです。', NOW());
INSERT INTO products (name,nation_id,description,created)
    VALUES ('Beer', '3', 'ビールです。', NOW());
