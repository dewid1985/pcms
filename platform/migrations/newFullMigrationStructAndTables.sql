-- Database generated with pgModeler (PostgreSQL Database Modeler).
-- pgModeler  version: 0.8.0-alpha2
-- PostgreSQL version: 9.4
-- Project Site: pgmodeler.com.br
-- Model Author: ---




-- Database creation must be done outside an multicommand file.
-- These commands were put in this file only for convenience.
-- -- object: pcms | type: DATABASE --
-- -- DROP DATABASE pcms;
-- CREATE DATABASE pcms
-- 	ENCODING = 'UTF8'
-- 	LC_COLLATE = 'C'
-- 	LC_CTYPE = 'C'
-- 	TABLESPACE = pg_default
-- 	OWNER = pgsql
-- ;
-- -- ddl-end --
-- 

-- object: common | type: SCHEMA --
-- DROP SCHEMA common;
CREATE SCHEMA common;
ALTER SCHEMA common OWNER TO pcms;
-- ddl-end --

-- object: users | type: SCHEMA --
-- DROP SCHEMA users;
CREATE SCHEMA users;
ALTER SCHEMA users OWNER TO pcms;
-- ddl-end --

-- object: logs | type: SCHEMA --
-- DROP SCHEMA logs;
CREATE SCHEMA logs;
-- ddl-end --

-- object: multimedia | type: SCHEMA --
-- DROP SCHEMA multimedia;
CREATE SCHEMA multimedia;
-- ddl-end --

SET search_path TO pg_catalog,public,common,users,logs,multimedia;
-- ddl-end --

-- object: common.project | type: TABLE --
-- DROP TABLE common.project;
CREATE TABLE common.project(
  id serial NOT NULL,
  name character varying(31) NOT NULL,
  title character varying(127) NOT NULL,
  CONSTRAINT project_pkey PRIMARY KEY (id),
  CONSTRAINT uk__project_name UNIQUE (name)

);
-- ddl-end --
ALTER TABLE common.project OWNER TO pcms;
-- ddl-end --

-- object: users.user | type: TABLE --
-- DROP TABLE users.user;
CREATE TABLE users.user(
  id serial,
  email varchar(128) NOT NULL,
  password varchar(256) NOT NULL,
  nickname varchar(32),
  deleted boolean NOT NULL,
  moderation boolean NOT NULL,
  banned boolean,
  CONSTRAINT pk__user_id PRIMARY KEY (id),
  CONSTRAINT uk__user_emal UNIQUE (email)

);
-- ddl-end --
-- object: users.admin | type: TABLE --
-- DROP TABLE users.admin;
CREATE TABLE users.admin(
  id serial,
  login varchar(32),
  password varchar(256),
  email varchar(128) NOT NULL,
  phone varchar(16) NOT NULL,
  xmpp_account varchar(40),
  blocked boolean,
  CONSTRAINT pk__admin PRIMARY KEY (id),
  CONSTRAINT uk__admin_login UNIQUE (login),
  CONSTRAINT uk__admin_email UNIQUE (email),
  CONSTRAINT uk__admin_phone UNIQUE (phone),
  CONSTRAINT uk__xmpp_account UNIQUE (xmpp_account)

);
-- ddl-end --
-- object: hstore | type: EXTENSION --
-- DROP EXTENSION hstore CASCADE;
-- CREATE EXTENSION hstore
-- WITH SCHEMA users;
-- ddl-end --

-- object: users.user_info | type: TABLE --
-- DROP TABLE users.user_info;
CREATE TABLE users.user_info(
  id serial,
  user_id integer NOT NULL,
  last_name varchar(64) NOT NULL,
  first_name varchar(64) NOT NULL,
  middle_name varchar(64) NOT NULL,
  birthday timestamptz NOT NULL,
  settings hstore NOT NULL,
  open_id boolean NOT NULL,
  registred_at timestamptz NOT NULL,
  created_at timestamptz NOT NULL,
  registred boolean NOT NULL,
  last_login timestamptz,
  signature varchar(256),
  preview boolean NOT NULL,
  preview_image_type_id smallint,
  phone varchar(13),
  CONSTRAINT pk__user_info PRIMARY KEY (id),
  CONSTRAINT uk__user_id UNIQUE (user_id)

);
-- ddl-end --
-- object: users.admin_profile | type: TABLE --
-- DROP TABLE users.admin_profile;
CREATE TABLE users.admin_profile(
  id serial,
  admin_id integer,
  last_name varchar(64) NOT NULL,
  first_name varchar(64) NOT NULL,
  middle_name varchar(64) NOT NULL,
  created_at timestamptz NOT NULL,
  password_expires_time timestamptz NOT NULL,
  alias hstore,
  settings hstore,
  status varchar(256),
  CONSTRAINT pk__admin_info PRIMARY KEY (id),
  CONSTRAINT uk__admin_info_admin_id UNIQUE (admin_id)

);
-- ddl-end --
-- object: users.auth_type | type: TABLE --
-- DROP TABLE users.auth_type;
CREATE TABLE users.auth_type(
  id serial NOT NULL,
  name varchar(64) NOT NULL,
  settings hstore,
  CONSTRAINT pk__auth_type PRIMARY KEY (id),
  CONSTRAINT uk__auth_type_id UNIQUE (name)

);
-- ddl-end --
-- object: users.auth_common | type: TABLE --
-- DROP TABLE users.auth_common;
CREATE TABLE users.auth_common(
  id serial NOT NULL,
  user_info_id integer NOT NULL,
  auth_type_id integer NOT NULL,
  token varchar(128) NOT NULL,
  refresh_token varchar(128),
  profile_url varchar(128),
  CONSTRAINT pk__auth_common PRIMARY KEY (id)

);
-- ddl-end --
-- object: common.newsmaker | type: TABLE --
-- DROP TABLE common.newsmaker;
CREATE TABLE common.newsmaker(
  id serial,
  last_name varchar(64),
  first_name varchar(64),
  middle_name varchar(64),
  job varchar(256),
  job_title varchar(256),
  job_phone integer,
  home_phone integer,
  mobile_phone integer,
  info text,
  CONSTRAINT pk__news_macker_id PRIMARY KEY (id)

);
-- ddl-end --
-- object: common.module | type: TABLE --
-- DROP TABLE common.module;
CREATE TABLE common.module(
  id serial,
  name varchar(32) NOT NULL,
  title varchar(64),
  CONSTRAINT pk_module PRIMARY KEY (id),
  CONSTRAINT uk__module_name UNIQUE (name)

);
-- ddl-end --
-- object: users.module_operation | type: TABLE --
-- DROP TABLE users.module_operation;
CREATE TABLE users.module_operation(
  id serial,
  name varchar(32) NOT NULL,
  role_id smallint NOT NULL,
  module_id smallint,
  CONSTRAINT pk__module_operation PRIMARY KEY (id)

);
-- ddl-end --
-- object: common.project_module | type: TABLE --
-- DROP TABLE common.project_module;
CREATE TABLE common.project_module(
  id serial,
  module_id smallint,
  project_id smallint,
  disabled boolean NOT NULL,
  CONSTRAINT pk_project_module PRIMARY KEY (id)

);
-- ddl-end --
-- object: users.role | type: TABLE --
-- DROP TABLE users.role;
CREATE TABLE users.role(
  id serial,
  name varchar(32),
  CONSTRAINT pk__admin_role PRIMARY KEY (id),
  CONSTRAINT uk__admin_role_name UNIQUE (name)

);
-- ddl-end --
-- object: users.admin_role | type: TABLE --
-- DROP TABLE users.admin_role;
CREATE TABLE users.admin_role(
  id serial NOT NULL,
  admin_id smallint,
  role_id smallint
);
-- ddl-end --
-- object: index__user_nickname | type: INDEX --
-- DROP INDEX users.index__user_nickname;
CREATE INDEX index__user_nickname ON users.user
USING btree
(
  nickname ASC NULLS LAST
);
-- ddl-end --

-- object: index__auth_common_user_info_id | type: INDEX --
-- DROP INDEX users.index__auth_common_user_info_id;
CREATE INDEX index__auth_common_user_info_id ON users.auth_common
USING btree
(
  user_info_id ASC NULLS LAST
);
-- ddl-end --

-- object: index__auth_common_auth_type_id | type: INDEX --
-- DROP INDEX users.index__auth_common_auth_type_id;
CREATE INDEX index__auth_common_auth_type_id ON users.auth_common
USING btree
(
  auth_type_id ASC NULLS LAST
);
-- ddl-end --

-- object: index__user_info_phone | type: INDEX --
-- DROP INDEX users.index__user_info_phone;
CREATE INDEX index__user_info_phone ON users.user_info
USING btree
(
  phone ASC NULLS LAST
);
-- ddl-end --

-- object: index__user_info_last_name | type: INDEX --
-- DROP INDEX users.index__user_info_last_name;
CREATE INDEX index__user_info_last_name ON users.user_info
USING btree
(
  last_name ASC NULLS LAST
);
-- ddl-end --

-- object: index__user_info_first_name | type: INDEX --
-- DROP INDEX users.index__user_info_first_name;
CREATE INDEX index__user_info_first_name ON users.user_info
USING btree
(
  first_name ASC NULLS LAST
);
-- ddl-end --

-- object: index__user_info_middle_name | type: INDEX --
-- DROP INDEX users.index__user_info_middle_name;
CREATE INDEX index__user_info_middle_name ON users.user_info
USING btree
(
  middle_name ASC NULLS LAST
);
-- ddl-end --

-- object: index__admin_info_last_name | type: INDEX --
-- DROP INDEX users.index__admin_info_last_name;
CREATE INDEX index__admin_info_last_name ON users.admin_profile
USING btree
(
  last_name ASC NULLS LAST
);
-- ddl-end --

-- object: index__admin_info_first_name | type: INDEX --
-- DROP INDEX users.index__admin_info_first_name;
CREATE INDEX index__admin_info_first_name ON users.admin_profile
USING btree
(
  first_name ASC NULLS LAST
);
-- ddl-end --

-- object: index__admin_info_middle_name | type: INDEX --
-- DROP INDEX users.index__admin_info_middle_name;
CREATE INDEX index__admin_info_middle_name ON users.admin_profile
USING btree
(
  middle_name ASC NULLS LAST
);
-- ddl-end --

-- object: users.user_registration_facts | type: TABLE --
-- DROP TABLE users.user_registration_facts;
CREATE TABLE users.user_registration_facts(
  id serial,
  user_id integer,
  project_id smallint,
  registred_at timestamptz,
  CONSTRAINT pk_user_registration_facts PRIMARY KEY (id)

);
-- ddl-end --
-- object: index_project_title | type: INDEX --
-- DROP INDEX common.index_project_title;
CREATE INDEX index_project_title ON common.project
USING btree
(
  title ASC NULLS LAST
);
-- ddl-end --

-- object: index__module_operation_name | type: INDEX --
-- DROP INDEX users.index__module_operation_name;
CREATE INDEX index__module_operation_name ON users.module_operation
USING btree
(
  name ASC NULLS LAST
);
-- ddl-end --

-- object: logs.admin_auth_logs | type: TABLE --
-- DROP TABLE logs.admin_auth_logs;
CREATE TABLE logs.admin_auth_logs(
  id serial,
  system_user boolean,
  admin_id integer,
  entry_at timestamptz,
  login varchar,
  password varchar,
  ip varchar(15),
  captcha varchar(16),
  blocked_ip boolean,
  date_blocking_ip timestamptz,
  black_ip_list_id integer,
  successful boolean,
  white_ip_list_id integer,
  admin_code_id smallint,
  CONSTRAINT pk__admin_auth_logs PRIMARY KEY (id)

);
-- ddl-end --
-- object: users.black_ip_list | type: TABLE --
-- DROP TABLE users.black_ip_list;
CREATE TABLE users.black_ip_list(
  id serial,
  ip_address varchar(15) NOT NULL,
  expires timestamptz NOT NULL,
  active boolean NOT NULL,
  CONSTRAINT pk__black_id_list PRIMARY KEY (id)

);
-- ddl-end --
-- object: index__black_ip_list | type: INDEX --
-- DROP INDEX users.index__black_ip_list;
CREATE INDEX index__black_ip_list ON users.black_ip_list
USING btree
(
  ip_address ASC NULLS LAST
);
-- ddl-end --

-- object: users.white_ip_list | type: TABLE --
-- DROP TABLE users.white_ip_list;
CREATE TABLE users.white_ip_list(
  id serial,
  ip_address varchar(15) NOT NULL,
  active boolean NOT NULL,
  CONSTRAINT pk__preferred_ip_adress PRIMARY KEY (id)

);
-- ddl-end --
-- object: index__user_white_ip_list_ip_address | type: INDEX --
-- DROP INDEX users.index__user_white_ip_list_ip_address;
CREATE INDEX index__user_white_ip_list_ip_address ON users.white_ip_list
USING btree
(
  ip_address ASC NULLS LAST
);
-- ddl-end --

-- object: users.admin_code | type: TABLE --
-- DROP TABLE users.admin_code;
CREATE TABLE users.admin_code(
  id serial,
  code integer,
  created_at timestamptz,
  active boolean,
  type_id integer,
  user_id integer,
  CONSTRAINT pk__user_code PRIMARY KEY (id)

);
-- ddl-end --
-- object: index__admin_auth_log | type: INDEX --
-- DROP INDEX logs.index__admin_auth_log;
CREATE INDEX index__admin_auth_log ON logs.admin_auth_logs
USING btree
(
  admin_id ASC NULLS LAST
);
-- ddl-end --

-- object: index__admin_auth_logs_black_ip_list_id | type: INDEX --
-- DROP INDEX logs.index__admin_auth_logs_black_ip_list_id;
CREATE INDEX index__admin_auth_logs_black_ip_list_id ON logs.admin_auth_logs
USING btree
(
  black_ip_list_id ASC NULLS LAST
);
-- ddl-end --

-- object: index__admin_auth_logs_white_ip_list_id | type: INDEX --
-- DROP INDEX logs.index__admin_auth_logs_white_ip_list_id;
CREATE INDEX index__admin_auth_logs_white_ip_list_id ON logs.admin_auth_logs
USING btree
(
  white_ip_list_id ASC NULLS LAST
);
-- ddl-end --

-- object: index__admin_auth_logs_user_code_id | type: INDEX --
-- DROP INDEX logs.index__admin_auth_logs_user_code_id;
CREATE INDEX index__admin_auth_logs_user_code_id ON logs.admin_auth_logs
USING btree
(
  admin_code_id ASC NULLS LAST
);
-- ddl-end --

-- object: index__user_code_user_id | type: INDEX --
-- DROP INDEX users.index__user_code_user_id;
CREATE INDEX index__user_code_user_id ON users.admin_code
USING btree
(
  user_id ASC NULLS LAST
);
-- ddl-end --

-- object: common.article_draft | type: TABLE --
-- DROP TABLE common.article_draft;
CREATE TABLE common.article_draft(
  id serial,
  article_id integer,
  admin_id integer,
  title varchar(256),
  anons varchar(1024),
  text text,
  author varchar,
  meta_description varchar(256),
  meta_keywords varchar(256),
  rubrics hstore,
  modified_at timestamptz,
  preview varchar(256),
  images hstore,
  CONSTRAINT pk__article_draft PRIMARY KEY (id)

);
-- ddl-end --

-- Appended SQL commands --
CREATE INDEX index_fti_articles_draft_title ON common.article_draft USING GIN (to_tsvector('utf8_russian', title));
CREATE INDEX index_fti_articles_draft_anons ON common.article_draft USING GIN (to_tsvector('utf8_russian', anons));
CREATE INDEX index_fti_articles_draft_text ON common.article_draft USING GIN (to_tsvector('utf8_russian', text));
CREATE INDEX index_fti_articles_draft_meta_description ON common.article_draft USING GIN (to_tsvector('utf8_russian', meta_description));
CREATE INDEX index_fti_articles_draft_meta_keywords ON common.article_draft USING GIN (to_tsvector('utf8_russian', meta_keywords));
-- ddl-end --

-- object: common.article | type: TABLE --
-- DROP TABLE common.article;
CREATE TABLE common.article(
  id serial,
  project_id smallint,
  article_draft_id integer,
  article_published_id integer,
  created_at timestamptz,
  published_at timestamptz,
  published boolean,
  CONSTRAINT pk__article PRIMARY KEY (id)

);
-- ddl-end --
-- object: ltree | type: EXTENSION --
-- DROP EXTENSION ltree CASCADE;
-- CREATE EXTENSION ltree
-- WITH SCHEMA common;
-- -- ddl-end --

-- object: common.rubric | type: TABLE --
-- DROP TABLE common.rubric;
CREATE TABLE common.rubric(
  id serial,
  project_id integer,
  rubric_data_id integer,
  name varchar(64),
  path ltree,
  enabled boolean,
  created_at timestamptz,
  modified_at timestamptz,
  CONSTRAINT pk__rubric PRIMARY KEY (id)

);
-- ddl-end --
-- object: common.rubric_data | type: TABLE --
-- DROP TABLE common.rubric_data;
CREATE TABLE common.rubric_data(
  id serial,
  short_name varchar(64),
  description varchar(256),
  meta_keywords varchar(256),
  meta_description varchar(256),
  CONSTRAINT pk__rubric_data PRIMARY KEY (id)

);
-- ddl-end --

-- Appended SQL commands --
CREATE INDEX index_fti_rubric_data_short_name
ON common.rubric_data
USING gin
(to_tsvector('utf8_russian'::regconfig, short_name::text));

CREATE INDEX index_fti_rubric_data_description
ON common.rubric_data
USING gin
(to_tsvector('utf8_russian'::regconfig, description::text));
-- ddl-end --

-- object: common.article_published | type: TABLE --
-- DROP TABLE common.article_published;
CREATE TABLE common.article_published(
  id serial,
  admin_id integer,
  title varchar(256),
  anons varchar(1024),
  text text,
  author varchar(256),
  meta_description varchar(256),
  meta_keywords varchar(256),
  rubrics hstore,
  modified_at timestamptz,
  preview varchar(256),
  images hstore,
  CONSTRAINT pk__article_published PRIMARY KEY (id)

);
-- ddl-end --

-- Appended SQL commands --
CREATE INDEX index_fti_articles_published_title ON common.article_published USING GIN (to_tsvector('utf8_russian', title));
CREATE INDEX index_fti_article_published_anons ON common.article_published USING GIN (to_tsvector('utf8_russian', anons));
CREATE INDEX index_fti_article_published_text ON common.article_published USING GIN (to_tsvector('utf8_russian', text));
CREATE INDEX index_fti_article_published_meta_description ON common.article_published USING GIN (to_tsvector('utf8_russian', meta_description));
CREATE INDEX index_fti_article_published_meta_keywords ON common.article_published USING GIN (to_tsvector('utf8_russian', meta_keywords));
-- ddl-end --

-- object: common.news_draft | type: TABLE --
-- DROP TABLE common.news_draft;
CREATE TABLE common.news_draft(
  id serial,
  news_id integer,
  admin_id integer,
  title varchar(256),
  anons varchar(1024),
  text text,
  meta_description varchar(256),
  meta_keywords varchar(256),
  rubrics hstore,
  modified_at timestamptz,
  preview varchar(256),
  CONSTRAINT pk__news_draft PRIMARY KEY (id)

);
-- ddl-end --

-- Appended SQL commands --
CREATE INDEX index_fti_news_draft_title ON common.news_draft USING GIN (to_tsvector('utf8_russian', title));
CREATE INDEX index_fti_news_draft_anons ON common.news_draft USING GIN (to_tsvector('utf8_russian', anons));
CREATE INDEX index_fti_news_draft_text ON common.news_draft USING GIN (to_tsvector('utf8_russian', text));
CREATE INDEX index_fti_news_draft_meta_description ON common.news_draft USING GIN (to_tsvector('utf8_russian', meta_description));
CREATE INDEX index_fti_news_draft_meta_keywords ON common.news_draft USING GIN (to_tsvector('utf8_russian', meta_keywords));
-- ddl-end --

-- object: common.news | type: TABLE --
-- DROP TABLE common.news;
CREATE TABLE common.news(
  id serial,
  project_id smallint,
  news_draft_id integer,
  news_published_id integer,
  created_at timestamptz,
  published_at timestamptz,
  published boolean,
  CONSTRAINT pk__news PRIMARY KEY (id)

);
-- ddl-end --
-- object: common.news_published | type: TABLE --
-- DROP TABLE common.news_published;
CREATE TABLE common.news_published(
  id serial,
  admin_id integer,
  title varchar(256),
  anons varchar(1024),
  text text,
  meta_description varchar(256),
  meta_keywords varchar(256),
  rubrics hstore,
  modified_at timestamptz,
  preview varchar(256),
  CONSTRAINT pk__news_published PRIMARY KEY (id)

);
-- ddl-end --

-- Appended SQL commands --
CREATE INDEX index_fti_news_published_title ON common.news_published USING GIN (to_tsvector('utf8_russian', title));
CREATE INDEX index_fti_news_published_anons ON common.news_published USING GIN (to_tsvector('utf8_russian', anons));
CREATE INDEX index_fti_news_published_text ON common.news_published USING GIN (to_tsvector('utf8_russian', text));
CREATE INDEX index_fti_news_published_meta_description ON common.news_published USING GIN (to_tsvector('utf8_russian', meta_description));
CREATE INDEX index_fti_news_published_meta_keywords ON common.news_published USING GIN (to_tsvector('utf8_russian', meta_keywords));
-- ddl-end --

-- object: index__project_name | type: INDEX --
-- DROP INDEX common.index__project_name;
CREATE INDEX index__project_name ON common.project
USING btree
(
  name ASC NULLS LAST
);
-- ddl-end --

-- object: index__role_name | type: INDEX --
-- DROP INDEX users.index__role_name;
CREATE INDEX index__role_name ON users.role
USING btree
(
  name ASC NULLS LAST
);
-- ddl-end --

-- object: index__module_operation_role_id | type: INDEX --
-- DROP INDEX users.index__module_operation_role_id;
CREATE INDEX index__module_operation_role_id ON users.module_operation
USING btree
(
  name ASC NULLS LAST
);
-- ddl-end --

-- object: index__module_operation_module_id | type: INDEX --
-- DROP INDEX users.index__module_operation_module_id;
CREATE INDEX index__module_operation_module_id ON users.module_operation
USING btree
(
  module_id ASC NULLS LAST
);
-- ddl-end --

-- object: index__admin_password | type: INDEX --
-- DROP INDEX users.index__admin_password;
CREATE INDEX index__admin_password ON users.admin
USING btree
(
  password ASC NULLS LAST
);
-- ddl-end --

-- object: index__admin_login | type: INDEX --
-- DROP INDEX users.index__admin_login;
CREATE INDEX index__admin_login ON users.admin
USING btree
(
  login ASC NULLS LAST
);
-- ddl-end --

-- object: index__rubric_path | type: INDEX --
-- DROP INDEX common.index__rubric_path;
CREATE INDEX index__rubric_path ON common.rubric
USING btree
(
  path ASC NULLS LAST
);
-- ddl-end --

-- object: index__rubric_name | type: INDEX --
-- DROP INDEX common.index__rubric_name;
CREATE INDEX index__rubric_name ON common.rubric
USING btree
(
  name ASC NULLS LAST
);
-- ddl-end --

-- object: index__rubric_rubric_data_id | type: INDEX --
-- DROP INDEX common.index__rubric_rubric_data_id;
CREATE INDEX index__rubric_rubric_data_id ON common.rubric
USING btree
(
  rubric_data_id ASC NULLS LAST
);
-- ddl-end --

-- object: index_rubric_data_short_name | type: INDEX --
-- DROP INDEX common.index_rubric_data_short_name;
CREATE INDEX index_rubric_data_short_name ON common.rubric_data
USING btree
(
  short_name ASC NULLS LAST
);
-- ddl-end --

-- object: index__article_created_ad | type: INDEX --
-- DROP INDEX common.index__article_created_ad;
CREATE INDEX index__article_created_ad ON common.article
USING btree
(
  created_at ASC NULLS LAST
);
-- ddl-end --

-- object: index_article_published_at | type: INDEX --
-- DROP INDEX common.index_article_published_at;
CREATE INDEX index_article_published_at ON common.article
USING btree
(
  published_at ASC NULLS LAST
);
-- ddl-end --

-- object: index__article_published_rubrics | type: INDEX --
-- DROP INDEX common.index__article_published_rubrics;
CREATE INDEX index__article_published_rubrics ON common.article_published
USING btree
(
  rubrics ASC NULLS LAST
);
-- ddl-end --

-- object: index__articles_published_modified_at | type: INDEX --
-- DROP INDEX common.index__articles_published_modified_at;
CREATE INDEX index__articles_published_modified_at ON common.article_published
USING btree
(
  modified_at ASC NULLS LAST
);
-- ddl-end --

-- object: index__article_draft_rubrics | type: INDEX --
-- DROP INDEX common.index__article_draft_rubrics;
CREATE INDEX index__article_draft_rubrics ON common.article_draft
USING btree
(
  rubrics ASC NULLS LAST
);
-- ddl-end --

-- object: index__article_draft_modified_at | type: INDEX --
-- DROP INDEX common.index__article_draft_modified_at;
CREATE INDEX index__article_draft_modified_at ON common.article_draft
USING btree
(
  modified_at ASC NULLS LAST
);
-- ddl-end --

-- object: index__news_published_modified_at | type: INDEX --
-- DROP INDEX common.index__news_published_modified_at;
CREATE INDEX index__news_published_modified_at ON common.news_published
USING btree
(
  modified_at ASC NULLS LAST
);
-- ddl-end --

-- object: index__news_published_rubrics | type: INDEX --
-- DROP INDEX common.index__news_published_rubrics;
CREATE INDEX index__news_published_rubrics ON common.news_published
USING btree
(
  rubrics ASC NULLS LAST
);
-- ddl-end --

-- object: index__news_draft_modified_at | type: INDEX --
-- DROP INDEX common.index__news_draft_modified_at;
CREATE INDEX index__news_draft_modified_at ON common.news_draft
USING btree
(
  modified_at ASC NULLS LAST
);
-- ddl-end --

-- object: index__news_draft_rubrics | type: INDEX --
-- DROP INDEX common.index__news_draft_rubrics;
CREATE INDEX index__news_draft_rubrics ON common.news_draft
USING btree
(
  rubrics ASC NULLS LAST
);
-- ddl-end --

-- object: multimedia.images | type: TABLE --
-- DROP TABLE multimedia.images;
CREATE TABLE multimedia.images(
  id serial,
  name varchar(32),
  title varchar(32),
  description varchar(256),
  tags varchar(512),
  mime_type varchar(128),
  source_file varchar(256),
  prepared_file varchar(256),
  ico_file varchar(256),
  uploaded_at timestamptz,
  root_directory varchar(256),
  CONSTRAINT pk__images PRIMARY KEY (id)

);
-- ddl-end --

-- Appended SQL commands --
CREATE INDEX index__fti_images_title ON multimedia.images
USING GIN (to_tsvector('utf8_russian' :: REGCONFIG, title :: TEXT));

CREATE INDEX index__fti_images_description ON multimedia.images
USING GIN (to_tsvector('utf8_russian' :: REGCONFIG, description :: TEXT));

CREATE INDEX index__fti_images_tags ON multimedia.images
USING GIN (to_tsvector('utf8_russian' :: REGCONFIG, tags :: TEXT));

-- ddl-end --

-- object: multimedia.cropped_images | type: TABLE --
-- DROP TABLE multimedia.cropped_images;
CREATE TABLE multimedia.cropped_images(
  id serial,
  images_id bigint NOT NULL,
  images_size_id bigint NOT NULL,
  path varchar(256),
  cropped_at timestamptz,
  CONSTRAINT pk__cropped_images PRIMARY KEY (id)

);
-- ddl-end --
-- object: multimedia.images_size | type: TABLE --
-- DROP TABLE multimedia.images_size;
CREATE TABLE multimedia.images_size(
  id serial,
  name varchar(32),
  title varchar(32),
  width integer,
  height integer,
  CONSTRAINT pk__sizes_to_crop_image PRIMARY KEY (id)

);
-- ddl-end --
-- object: index__images_id | type: INDEX --
-- DROP INDEX multimedia.index__images_id;
CREATE INDEX index__images_id ON multimedia.cropped_images
USING btree
(
  images_id ASC NULLS LAST
);
-- ddl-end --

-- object: index__images_size_id | type: INDEX --
-- DROP INDEX multimedia.index__images_size_id;
CREATE INDEX index__images_size_id ON multimedia.cropped_images
USING btree
(
  images_size_id ASC NULLS LAST
);
-- ddl-end --

-- object: fk__user_id | type: CONSTRAINT --
-- ALTER TABLE users.user_info DROP CONSTRAINT fk__user_id;
ALTER TABLE users.user_info ADD CONSTRAINT fk__user_id FOREIGN KEY (user_id)
REFERENCES users.user (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__admin_id | type: CONSTRAINT --
-- ALTER TABLE users.admin_profile DROP CONSTRAINT fk__admin_id;
ALTER TABLE users.admin_profile ADD CONSTRAINT fk__admin_id FOREIGN KEY (admin_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__auth_type_id | type: CONSTRAINT --
-- ALTER TABLE users.auth_common DROP CONSTRAINT fk__auth_type_id;
ALTER TABLE users.auth_common ADD CONSTRAINT fk__auth_type_id FOREIGN KEY (auth_type_id)
REFERENCES users.auth_type (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__user_info_id | type: CONSTRAINT --
-- ALTER TABLE users.auth_common DROP CONSTRAINT fk__user_info_id;
ALTER TABLE users.auth_common ADD CONSTRAINT fk__user_info_id FOREIGN KEY (user_info_id)
REFERENCES users.user_info (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__module_id | type: CONSTRAINT --
-- ALTER TABLE users.module_operation DROP CONSTRAINT fk__module_id;
ALTER TABLE users.module_operation ADD CONSTRAINT fk__module_id FOREIGN KEY (module_id)
REFERENCES common.module (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__role_id | type: CONSTRAINT --
-- ALTER TABLE users.module_operation DROP CONSTRAINT fk__role_id;
ALTER TABLE users.module_operation ADD CONSTRAINT fk__role_id FOREIGN KEY (role_id)
REFERENCES users.role (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__module_id | type: CONSTRAINT --
-- ALTER TABLE common.project_module DROP CONSTRAINT fk__module_id;
ALTER TABLE common.project_module ADD CONSTRAINT fk__module_id FOREIGN KEY (module_id)
REFERENCES common.module (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__project_id | type: CONSTRAINT --
-- ALTER TABLE common.project_module DROP CONSTRAINT fk__project_id;
ALTER TABLE common.project_module ADD CONSTRAINT fk__project_id FOREIGN KEY (project_id)
REFERENCES common.project (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__admin_id | type: CONSTRAINT --
-- ALTER TABLE users.admin_role DROP CONSTRAINT fk__admin_id;
ALTER TABLE users.admin_role ADD CONSTRAINT fk__admin_id FOREIGN KEY (admin_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__role_id | type: CONSTRAINT --
-- ALTER TABLE users.admin_role DROP CONSTRAINT fk__role_id;
ALTER TABLE users.admin_role ADD CONSTRAINT fk__role_id FOREIGN KEY (role_id)
REFERENCES users.role (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk_user_id | type: CONSTRAINT --
-- ALTER TABLE users.user_registration_facts DROP CONSTRAINT fk_user_id;
ALTER TABLE users.user_registration_facts ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id)
REFERENCES users.user (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__project_id | type: CONSTRAINT --
-- ALTER TABLE users.user_registration_facts DROP CONSTRAINT fk__project_id;
ALTER TABLE users.user_registration_facts ADD CONSTRAINT fk__project_id FOREIGN KEY (project_id)
REFERENCES common.project (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__admin_id | type: CONSTRAINT --
-- ALTER TABLE logs.admin_auth_logs DROP CONSTRAINT fk__admin_id;
ALTER TABLE logs.admin_auth_logs ADD CONSTRAINT fk__admin_id FOREIGN KEY (admin_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__black_ip_list_id | type: CONSTRAINT --
-- ALTER TABLE logs.admin_auth_logs DROP CONSTRAINT fk__black_ip_list_id;
ALTER TABLE logs.admin_auth_logs ADD CONSTRAINT fk__black_ip_list_id FOREIGN KEY (black_ip_list_id)
REFERENCES users.black_ip_list (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__pereferred_ip_address | type: CONSTRAINT --
-- ALTER TABLE logs.admin_auth_logs DROP CONSTRAINT fk__pereferred_ip_address;
ALTER TABLE logs.admin_auth_logs ADD CONSTRAINT fk__pereferred_ip_address FOREIGN KEY (white_ip_list_id)
REFERENCES users.white_ip_list (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk_user_code_id | type: CONSTRAINT --
-- ALTER TABLE logs.admin_auth_logs DROP CONSTRAINT fk_user_code_id;
ALTER TABLE logs.admin_auth_logs ADD CONSTRAINT fk_user_code_id FOREIGN KEY (admin_code_id)
REFERENCES users.admin_code (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__admin_id | type: CONSTRAINT --
-- ALTER TABLE users.admin_code DROP CONSTRAINT fk__admin_id;
ALTER TABLE users.admin_code ADD CONSTRAINT fk__admin_id FOREIGN KEY (user_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__article_id | type: CONSTRAINT --
-- ALTER TABLE common.article_draft DROP CONSTRAINT fk__article_id;
ALTER TABLE common.article_draft ADD CONSTRAINT fk__article_id FOREIGN KEY (article_id)
REFERENCES common.article (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk_admin_id | type: CONSTRAINT --
-- ALTER TABLE common.article_draft DROP CONSTRAINT fk_admin_id;
ALTER TABLE common.article_draft ADD CONSTRAINT fk_admin_id FOREIGN KEY (admin_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__article_draft_id | type: CONSTRAINT --
-- ALTER TABLE common.article DROP CONSTRAINT fk__article_draft_id;
ALTER TABLE common.article ADD CONSTRAINT fk__article_draft_id FOREIGN KEY (article_draft_id)
REFERENCES common.article_draft (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__project_id | type: CONSTRAINT --
-- ALTER TABLE common.article DROP CONSTRAINT fk__project_id;
ALTER TABLE common.article ADD CONSTRAINT fk__project_id FOREIGN KEY (project_id)
REFERENCES common.project (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__article_published_id | type: CONSTRAINT --
-- ALTER TABLE common.article DROP CONSTRAINT fk__article_published_id;
ALTER TABLE common.article ADD CONSTRAINT fk__article_published_id FOREIGN KEY (article_published_id)
REFERENCES common.article_published (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__rubric_data_id | type: CONSTRAINT --
-- ALTER TABLE common.rubric DROP CONSTRAINT fk__rubric_data_id;
ALTER TABLE common.rubric ADD CONSTRAINT fk__rubric_data_id FOREIGN KEY (rubric_data_id)
REFERENCES common.rubric_data (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__project_id | type: CONSTRAINT --
-- ALTER TABLE common.rubric DROP CONSTRAINT fk__project_id;
ALTER TABLE common.rubric ADD CONSTRAINT fk__project_id FOREIGN KEY (project_id)
REFERENCES common.project (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__admin_id | type: CONSTRAINT --
-- ALTER TABLE common.article_published DROP CONSTRAINT fk__admin_id;
ALTER TABLE common.article_published ADD CONSTRAINT fk__admin_id FOREIGN KEY (admin_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__news_id | type: CONSTRAINT --
-- ALTER TABLE common.news_draft DROP CONSTRAINT fk__news_id;
ALTER TABLE common.news_draft ADD CONSTRAINT fk__news_id FOREIGN KEY (news_id)
REFERENCES common.news (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__admin_id | type: CONSTRAINT --
-- ALTER TABLE common.news_draft DROP CONSTRAINT fk__admin_id;
ALTER TABLE common.news_draft ADD CONSTRAINT fk__admin_id FOREIGN KEY (admin_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__project_id | type: CONSTRAINT --
-- ALTER TABLE common.news DROP CONSTRAINT fk__project_id;
ALTER TABLE common.news ADD CONSTRAINT fk__project_id FOREIGN KEY (project_id)
REFERENCES common.project (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__news_draft_id | type: CONSTRAINT --
-- ALTER TABLE common.news DROP CONSTRAINT fk__news_draft_id;
ALTER TABLE common.news ADD CONSTRAINT fk__news_draft_id FOREIGN KEY (news_draft_id)
REFERENCES common.news_draft (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__news_published_id | type: CONSTRAINT --
-- ALTER TABLE common.news DROP CONSTRAINT fk__news_published_id;
ALTER TABLE common.news ADD CONSTRAINT fk__news_published_id FOREIGN KEY (news_published_id)
REFERENCES common.news_published (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk_admin_id | type: CONSTRAINT --
-- ALTER TABLE common.news_published DROP CONSTRAINT fk_admin_id;
ALTER TABLE common.news_published ADD CONSTRAINT fk_admin_id FOREIGN KEY (admin_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__images_id | type: CONSTRAINT --
-- ALTER TABLE multimedia.cropped_images DROP CONSTRAINT fk__images_id;
ALTER TABLE multimedia.cropped_images ADD CONSTRAINT fk__images_id FOREIGN KEY (images_id)
REFERENCES multimedia.images (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__images_size_id | type: CONSTRAINT --
-- ALTER TABLE multimedia.cropped_images DROP CONSTRAINT fk__images_size_id;
ALTER TABLE multimedia.cropped_images ADD CONSTRAINT fk__images_size_id FOREIGN KEY (images_size_id)
REFERENCES multimedia.images_size (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --



