-- object: social | type: SCHEMA --
-- DROP SCHEMA social;
CREATE SCHEMA social;
-- ddl-end --


-- object: social.app | type: TABLE --
-- DROP TABLE social.app;
CREATE TABLE social.app(
	id serial NOT NULL,
	name varchar(32) NOT NULL,
	social_network smallint NOT NULL,
	app_id bigint NOT NULL,
	app_secret_key text NOT NULL,
	created_at timestamptz,
	created_admin_id bigint,
	picture boolean,
	CONSTRAINT pk__app PRIMARY KEY (id)
);
-- ddl-end --
-- NOTE: below all the code for some key referrer objects are attached
-- as a convinience in order to permit you to test the whole object's
-- SQL definition at once. When exporting or generating the SQL for
-- the whole database model all objects will be placed at their
-- original positions.

-- object: fk_admin_id | type: CONSTRAINT --
-- ALTER TABLE social.app DROP CONSTRAINT fk_admin_id;
ALTER TABLE social.app ADD CONSTRAINT fk_admin_id FOREIGN KEY (created_admin_id)
REFERENCES users.admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --



-- ddl-end --

-- object: social.app_admin | type: TABLE --
-- DROP TABLE social.app_admin;
CREATE TABLE social.app_admin(
	id serial,
	app_id smallint,
	app_access_token text,
	name text,
	social_admin_id bigint,
	CONSTRAINT pk_app_admin PRIMARY KEY (id)

);
-- ddl-end --
-- NOTE: below all the code for some key referrer objects are attached
-- as a convinience in order to permit you to test the whole object's
-- SQL definition at once. When exporting or generating the SQL for
-- the whole database model all objects will be placed at their
-- original positions.

-- object: fk__app_id | type: CONSTRAINT --
-- ALTER TABLE social.app_admin DROP CONSTRAINT fk__app_id;
ALTER TABLE social.app_admin ADD CONSTRAINT fk__app_id FOREIGN KEY (app_id)
REFERENCES social.app (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: social.app_admin_pages | type: TABLE --
-- DROP TABLE social.app_admin_pages;
CREATE TABLE social.app_admin_pages(
	id serial,
	app_admin_id smallint,
	name varchar(256),
	category varchar(256),
	page_id bigint,
	access_token text,
	permissions hstore,
	CONSTRAINT pk__admin_pages PRIMARY KEY (id)

);
-- ddl-end --
-- NOTE: below all the code for some key referrer objects are attached
-- as a convinience in order to permit you to test the whole object's
-- SQL definition at once. When exporting or generating the SQL for
-- the whole database model all objects will be placed at their
-- original positions.

-- object: social.app_admin_group | type: TABLE --
-- DROP TABLE social.app_admin_group;
CREATE TABLE social.app_admin_group(
	id serial,
	app_admin_id smallint,
	name varchar(256),
	privacy varchar(128),
	group_id bigint,
	CONSTRAINT pk__app_admin_group PRIMARY KEY (id)

);
-- ddl-end --
-- NOTE: below all the code for some key referrer objects are attached
-- as a convinience in order to permit you to test the whole object's
-- SQL definition at once. When exporting or generating the SQL for
-- the whole database model all objects will be placed at their
-- original positions.

-- object: fk__app_admin | type: CONSTRAINT --
-- ALTER TABLE social.app_admin_group DROP CONSTRAINT fk__app_admin;
ALTER TABLE social.app_admin_group ADD CONSTRAINT fk__app_admin FOREIGN KEY (app_admin_id)
REFERENCES social.app_admin (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: social.flow | type: TABLE --
-- DROP TABLE social.flow;
CREATE TABLE social.flow(
	id serial,
	name varchar(256),
	access_token varchar(256),
	secret_key varchar(256),
	deleted BOOLEAN,
	CONSTRAINT pk__flow PRIMARY KEY (id)

);
-- ddl-end --


-- object: social.flow_dimension_page | type: TABLE --
-- DROP TABLE social.flow_dimension_page;
CREATE TABLE social.flow_dimension_page(
	id serial,
	flow_id bigint,
	page_id bigint,
	CONSTRAINT pk_flow_dimension_page PRIMARY KEY (id)

);
-- ddl-end --
-- NOTE: below all the code for some key referrer objects are attached
-- as a convinience in order to permit you to test the whole object's
-- SQL definition at once. When exporting or generating the SQL for
-- the whole database model all objects will be placed at their
-- original positions.

-- object: fk__flow | type: CONSTRAINT --
-- ALTER TABLE social.flow_dimension_page DROP CONSTRAINT fk__flow;
ALTER TABLE social.flow_dimension_page ADD CONSTRAINT fk__flow FOREIGN KEY (flow_id)
REFERENCES social.flow (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__app_admin_pages | type: CONSTRAINT --
-- ALTER TABLE social.flow_dimension_page DROP CONSTRAINT fk__app_admin_pages;
ALTER TABLE social.flow_dimension_page ADD CONSTRAINT fk__app_admin_pages FOREIGN KEY (page_id)
REFERENCES social.app_admin_pages (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: social.flow_dimension_group | type: TABLE --
-- DROP TABLE social.flow_dimension_group;
CREATE TABLE social.flow_dimension_group(
	id serial,
	flow_id bigint,
	group_id bigint,
	CONSTRAINT pk_flow_dimension_group PRIMARY KEY (id)

);
-- ddl-end --
-- NOTE: below all the code for some key referrer objects are attached
-- as a convinience in order to permit you to test the whole object's
-- SQL definition at once. When exporting or generating the SQL for
-- the whole database model all objects will be placed at their
-- original positions.

-- object: fk_flow | type: CONSTRAINT --
-- ALTER TABLE social.flow_dimension_group DROP CONSTRAINT fk_flow;
ALTER TABLE social.flow_dimension_group ADD CONSTRAINT fk_flow FOREIGN KEY (flow_id)
REFERENCES social.flow (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__app_admin_group | type: CONSTRAINT --
-- ALTER TABLE social.flow_dimension_group DROP CONSTRAINT fk__app_admin_group;
ALTER TABLE social.flow_dimension_group ADD CONSTRAINT fk__app_admin_group FOREIGN KEY (group_id)
REFERENCES social.app_admin_group (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: social.published_link | type: TABLE --
-- DROP TABLE social.published_link;
CREATE TABLE social.published_link(
  id serial,
  flow_id bigint,
  description varchar(256),
  link_url varchar(512),
  img_url varchar(512),
  published boolean,
  published_at timestamptz,
  created_at timestamptz,
  CONSTRAINT pk__published_link PRIMARY KEY (id)

);
-- ddl-end --
-- NOTE: below all the code for some key referrer objects are attached
-- as a convinience in order to permit you to test the whole object's
-- SQL definition at once. When exporting or generating the SQL for
-- the whole database model all objects will be placed at their
-- original positions.

-- object: fk__flow | type: CONSTRAINT --
-- ALTER TABLE social.published_link DROP CONSTRAINT fk__flow;
ALTER TABLE social.published_link ADD CONSTRAINT fk__flow FOREIGN KEY (flow_id)
REFERENCES social.flow (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: social.published_data | type: TABLE --
-- DROP TABLE social.published_data;
CREATE TABLE social.published_data(
	id serial,
	published_link_id bigint,
	social_network smallint,
	app_admin_pages_id bigint,
	app_admin_group_id bigint,
	post_id varchar,
	CONSTRAINT pk__published_data PRIMARY KEY (id)

);
-- ddl-end --
-- NOTE: below all the code for some key referrer objects are attached
-- as a convinience in order to permit you to test the whole object's
-- SQL definition at once. When exporting or generating the SQL for
-- the whole database model all objects will be placed at their
-- original positions.

-- object: fk__published_link | type: CONSTRAINT --
-- ALTER TABLE social.published_data DROP CONSTRAINT fk__published_link;
ALTER TABLE social.published_data ADD CONSTRAINT fk__published_link FOREIGN KEY (published_link_id)
REFERENCES social.published_link (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__app_admin_pages | type: CONSTRAINT --
-- ALTER TABLE social.published_data DROP CONSTRAINT fk__app_admin_pages;
ALTER TABLE social.published_data ADD CONSTRAINT fk__app_admin_pages FOREIGN KEY (app_admin_pages_id)
REFERENCES social.app_admin_pages (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


-- object: fk__app_admin_group | type: CONSTRAINT --
-- ALTER TABLE social.published_data DROP CONSTRAINT fk__app_admin_group;
ALTER TABLE social.published_data ADD CONSTRAINT fk__app_admin_group FOREIGN KEY (app_admin_group_id)
REFERENCES social.app_admin_group (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


