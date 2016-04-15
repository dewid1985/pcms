
INSERT INTO users.white_ip_list (ip_address, active) VALUES ('192.168.0.102', TRUE);

INSERT INTO users.admin (login, password, email, phone)
VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'dewid@dewid.ru', '89153294181');

INSERT INTO users.admin (login, password, email, phone)
VALUES ('amelin_m', '4307a044cc783c6fc455f7a1cb31f1e6', 'ams@pravda.ru', '89057497948');

INSERT INTO common.project (name, title) VALUES ('Pravda', 'правда');

INSERT INTO common.rubric_data (short_name, description, meta_keywords, meta_description) VALUES
  ('правда', 'правда', 'правда', 'правда');

INSERT INTO common.rubric (project_id, rubric_data_id, name, path, enabled, created_at)
VALUES (
  (SELECT id
   FROM common.project
   WHERE name = 'Pravda'),
  (SELECT id
   FROM common.rubric_data
   WHERE short_name = 'правда'),
  (SELECT name
   FROM common.project
   WHERE name = 'Pravda'),
  'Pravda',
  TRUE,
  now()
);

INSERT INTO multimedia.images_size (name, title, width, height) VALUES ('ico','Иконка','200','200');
INSERT INTO multimedia.images_size (name, title, width, height) VALUES ('preview-flour-image-pravda','Квадратное превью (Правда)','83','83');
INSERT INTO multimedia.images_size (name, title, width, height) VALUES ('preview-small-image-pravda','Превью (Правда)','120','90');
INSERT INTO multimedia.images_size (name, title, width, height) VALUES ('preview-medium-image-pravda','Превью Среднее (Правда)','178','133');
INSERT INTO multimedia.images_size (name, title, width, height) VALUES ('preview-big-image-pravda','Превью Большое (Правда)','200','150');
INSERT INTO multimedia.images_size (name, title, width, height) VALUES ('preview-five-image-pravda','Превью для ВАЖНОЙ новости (Правда)','370','190');


