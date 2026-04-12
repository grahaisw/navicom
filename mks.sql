--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: __sessions; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE __sessions (
    session_id character(32) DEFAULT ''::bpchar NOT NULL,
    session_user_id integer DEFAULT 0,
    session_start integer DEFAULT 0,
    session_time integer DEFAULT 0,
    session_ip character varying(40) DEFAULT ''::character varying,
    session_browser character varying(150) DEFAULT ''::character varying,
    session_username character varying(100),
    session_mac character varying(30),
    session_module character varying(100),
    session_node_id integer DEFAULT 0
);


ALTER TABLE public.__sessions OWNER TO navicom;

--
-- Name: _testing; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE _testing (
    testing_no character varying(10),
    testing_name character varying(20)
);


ALTER TABLE public._testing OWNER TO navicom;

--
-- Name: ads; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE ads (
    ads_id integer NOT NULL,
    ads_location_id integer,
    ads_type character varying,
    ads_image character varying(255),
    ads_text text,
    ads_clip character varying(255),
    ads_start integer,
    ads_end integer,
    ads_defunct integer DEFAULT 0
);


ALTER TABLE public.ads OWNER TO navicom;

--
-- Name: ads_counter; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE ads_counter (
    ads_counter_id integer NOT NULL,
    ads_id integer,
    ads_counter_value integer DEFAULT 1,
    node_id integer
);


ALTER TABLE public.ads_counter OWNER TO navicom;

--
-- Name: ads_locations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE ads_locations (
    ads_location_id integer NOT NULL,
    ads_location_type character varying(10),
    ads_location_name character varying(100),
    ads_location_description text,
    ads_location_price money,
    ads_location_price_unit character varying(50),
    ads_location_enabled integer DEFAULT 0
);


ALTER TABLE public.ads_locations OWNER TO navicom;

--
-- Name: ads_locations_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE ads_locations_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ads_locations_seq OWNER TO navicom;

--
-- Name: ads_locations_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE ads_locations_seq OWNED BY ads_locations.ads_location_id;


--
-- Name: ads_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE ads_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ads_seq OWNER TO navicom;

--
-- Name: ads_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE ads_seq OWNED BY ads.ads_id;


--
-- Name: airport_fids; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE airport_fids (
    fids_id bigint NOT NULL,
    airport_id integer,
    fids_flight character varying(10),
    fids_airline_code character varying(5),
    fids_airline character varying(100),
    fids_city character varying(100),
    fids_time character varying(10),
    fids_terminal character varying(5),
    fids_gate character varying(3),
    fids_type integer,
    fids_remark text,
    fids_lastupdate integer
);


ALTER TABLE public.airport_fids OWNER TO navicom;

--
-- Name: airport_fids_fids_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE airport_fids_fids_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.airport_fids_fids_id_seq OWNER TO navicom;

--
-- Name: airport_fids_fids_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE airport_fids_fids_id_seq OWNED BY airport_fids.fids_id;


--
-- Name: airports; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE airports (
    airport_id integer NOT NULL,
    airport_code character varying(5),
    airport_name character varying(100),
    airport_description text,
    airport_enabled integer DEFAULT 0
);


ALTER TABLE public.airports OWNER TO navicom;

--
-- Name: airports_airport_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE airports_airport_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.airports_airport_id_seq OWNER TO navicom;

--
-- Name: airports_airport_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE airports_airport_id_seq OWNED BY airports.airport_id;


--
-- Name: browsers; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE browsers (
    browsers_id integer NOT NULL,
    browsers_name character varying(50),
    browsers_description text,
    browsers_enabled boolean DEFAULT false
);


ALTER TABLE public.browsers OWNER TO navicom;

--
-- Name: browsers_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE browsers_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.browsers_seq OWNER TO navicom;

--
-- Name: browsers_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE browsers_seq OWNED BY browsers.browsers_id;


--
-- Name: business_center_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE business_center_translations (
    translation_id integer NOT NULL,
    business_centers_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.business_center_translations OWNER TO navicom;

--
-- Name: business_center_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE business_center_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.business_center_translations_translation_id_seq OWNER TO navicom;

--
-- Name: business_center_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE business_center_translations_translation_id_seq OWNED BY business_center_translations.translation_id;


--
-- Name: business_centers; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE business_centers (
    business_centers_id integer NOT NULL,
    business_centers_image character varying(100),
    business_centers_image_enabled integer DEFAULT 0,
    business_centers_clip character varying(200),
    business_centers_clip_enabled integer DEFAULT 0,
    business_centers_enabled integer DEFAULT 0,
    business_centers_order integer DEFAULT 0
);


ALTER TABLE public.business_centers OWNER TO navicom;

--
-- Name: business_centers_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE business_centers_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.business_centers_seq OWNER TO navicom;

--
-- Name: business_centers_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE business_centers_seq OWNED BY business_centers.business_centers_id;


--
-- Name: car_rental_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE car_rental_translations (
    translation_id integer NOT NULL,
    car_rentals_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.car_rental_translations OWNER TO navicom;

--
-- Name: car_rental_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE car_rental_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.car_rental_translations_translation_id_seq OWNER TO navicom;

--
-- Name: car_rental_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE car_rental_translations_translation_id_seq OWNED BY car_rental_translations.translation_id;


--
-- Name: car_rentals; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE car_rentals (
    car_rentals_id integer NOT NULL,
    car_rentals_image character varying(100),
    car_rentals_image_enabled integer DEFAULT 0,
    car_rentals_clip character varying(200),
    car_rentals_clip_enabled integer DEFAULT 0,
    car_rentals_enabled integer DEFAULT 0,
    car_rentals_order integer DEFAULT 0
);


ALTER TABLE public.car_rentals OWNER TO navicom;

--
-- Name: car_rentals_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE car_rentals_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.car_rentals_seq OWNER TO navicom;

--
-- Name: car_rentals_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE car_rentals_seq OWNED BY car_rentals.car_rentals_id;


--
-- Name: car_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE car_translations (
    translation_id integer NOT NULL,
    car_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.car_translations OWNER TO navicom;

--
-- Name: car_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE car_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.car_translations_translation_id_seq OWNER TO navicom;

--
-- Name: car_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE car_translations_translation_id_seq OWNED BY car_translations.translation_id;


--
-- Name: cars; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE cars (
    car_id integer NOT NULL,
    car_thumbnail character varying(100),
    car_enabled smallint DEFAULT 0
);


ALTER TABLE public.cars OWNER TO navicom;

--
-- Name: cars_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE cars_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cars_seq OWNER TO navicom;

--
-- Name: cars_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE cars_seq OWNED BY cars.car_id;


--
-- Name: contactus; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE contactus (
    contactus_id integer NOT NULL,
    contactus_image character varying(100),
    contactus_image_enabled integer DEFAULT 0,
    contactus_clip character varying(200),
    contactus_clip_enabled integer DEFAULT 0,
    contactus_enabled integer DEFAULT 0,
    contactus_order integer DEFAULT 0
);


ALTER TABLE public.contactus OWNER TO navicom;

--
-- Name: contactus_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE contactus_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contactus_seq OWNER TO navicom;

--
-- Name: contactus_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE contactus_seq OWNED BY contactus.contactus_id;


--
-- Name: contactus_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE contactus_translations (
    translation_id integer NOT NULL,
    contactus_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.contactus_translations OWNER TO navicom;

--
-- Name: contactus_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE contactus_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contactus_translations_translation_id_seq OWNER TO navicom;

--
-- Name: contactus_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE contactus_translations_translation_id_seq OWNED BY contactus_translations.translation_id;


--
-- Name: dining_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE dining_translations (
    translation_id integer NOT NULL,
    dinings_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.dining_translations OWNER TO navicom;

--
-- Name: dining_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE dining_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dining_translations_translation_id_seq OWNER TO navicom;

--
-- Name: dining_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE dining_translations_translation_id_seq OWNED BY dining_translations.translation_id;


--
-- Name: dinings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE dinings (
    dinings_id integer NOT NULL,
    dinings_image character varying(100),
    dinings_image_enabled integer DEFAULT 0,
    dinings_clip character varying(200),
    dinings_clip_enabled integer DEFAULT 0,
    dinings_enabled integer DEFAULT 0,
    dinings_order integer DEFAULT 0
);


ALTER TABLE public.dinings OWNER TO navicom;

--
-- Name: dinings_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE dinings_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dinings_seq OWNER TO navicom;

--
-- Name: dinings_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE dinings_seq OWNED BY dinings.dinings_id;


--
-- Name: directories; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE directories (
    directory_id integer NOT NULL,
    directory_image character varying(100),
    directory_image_enabled integer DEFAULT 0,
    directory_clip character varying(200),
    directory_clip_enabled integer DEFAULT 0,
    directory_enabled integer DEFAULT 0,
    directory_order integer DEFAULT 0
);


ALTER TABLE public.directories OWNER TO navicom;

--
-- Name: directories2; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE directories2 (
    directory2_id integer NOT NULL,
    directory2_image character varying(100),
    directory2_image_enabled smallint DEFAULT 0,
    directory2_clip character varying(100),
    directory2_clip_enabled smallint DEFAULT 0,
    directory2_enabled smallint DEFAULT 0,
    directory2_order integer
);


ALTER TABLE public.directories2 OWNER TO navicom;

--
-- Name: directories2_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE directories2_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.directories2_seq OWNER TO navicom;

--
-- Name: directories2_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE directories2_seq OWNED BY directories2.directory2_id;


--
-- Name: directories_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE directories_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.directories_seq OWNER TO navicom;

--
-- Name: directories_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE directories_seq OWNED BY directories.directory_id;


--
-- Name: directory2_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE directory2_translations (
    translation_id integer NOT NULL,
    directory2_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.directory2_translations OWNER TO navicom;

--
-- Name: directory2_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE directory2_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.directory2_translations_translation_id_seq OWNER TO navicom;

--
-- Name: directory2_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE directory2_translations_translation_id_seq OWNED BY directory2_translations.translation_id;


--
-- Name: directory_promo_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE directory_promo_translations (
    translation_id integer NOT NULL,
    directory_promo_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.directory_promo_translations OWNER TO navicom;

--
-- Name: directory_promo_translations_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE directory_promo_translations_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.directory_promo_translations_seq OWNER TO navicom;

--
-- Name: directory_promo_translations_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE directory_promo_translations_seq OWNED BY directory_promo_translations.translation_id;


--
-- Name: directory_promos; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE directory_promos (
    directory_promo_id integer NOT NULL,
    directory_promo_image character varying(100),
    directory_promo_image_enabled integer DEFAULT 0,
    directory_promo_clip character varying(100),
    directory_promo_clip_enabled integer DEFAULT 0,
    directory_promo_order integer,
    directory_promo_enabled integer DEFAULT 0
);


ALTER TABLE public.directory_promos OWNER TO navicom;

--
-- Name: directory_promos_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE directory_promos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.directory_promos_seq OWNER TO navicom;

--
-- Name: directory_promos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE directory_promos_seq OWNED BY directory_promos.directory_promo_id;


--
-- Name: directory_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE directory_translations (
    translation_id integer NOT NULL,
    directory_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.directory_translations OWNER TO navicom;

--
-- Name: directory_translations_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE directory_translations_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.directory_translations_seq OWNER TO navicom;

--
-- Name: directory_translations_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE directory_translations_seq OWNED BY directory_translations.translation_id;


--
-- Name: doctor_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE doctor_translations (
    translation_id integer NOT NULL,
    doctors_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.doctor_translations OWNER TO navicom;

--
-- Name: doctor_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE doctor_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.doctor_translations_translation_id_seq OWNER TO navicom;

--
-- Name: doctor_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE doctor_translations_translation_id_seq OWNED BY doctor_translations.translation_id;


--
-- Name: doctors; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE doctors (
    doctors_id integer NOT NULL,
    doctors_image character varying(100),
    doctors_image_enabled integer DEFAULT 0,
    doctors_clip character varying(200),
    doctors_clip_enabled integer DEFAULT 0,
    doctors_enabled integer DEFAULT 0,
    doctors_order integer DEFAULT 0
);


ALTER TABLE public.doctors OWNER TO navicom;

--
-- Name: doctors_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE doctors_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.doctors_seq OWNER TO navicom;

--
-- Name: doctors_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE doctors_seq OWNED BY doctors.doctors_id;


--
-- Name: drop_pickup_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE drop_pickup_translations (
    translation_id integer NOT NULL,
    drop_pickups_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.drop_pickup_translations OWNER TO navicom;

--
-- Name: drop_pickup_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE drop_pickup_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.drop_pickup_translations_translation_id_seq OWNER TO navicom;

--
-- Name: drop_pickup_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE drop_pickup_translations_translation_id_seq OWNED BY drop_pickup_translations.translation_id;


--
-- Name: drop_pickups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE drop_pickups (
    drop_pickups_id integer NOT NULL,
    drop_pickups_image character varying(100),
    drop_pickups_image_enabled integer DEFAULT 0,
    drop_pickups_clip character varying(200),
    drop_pickups_clip_enabled integer DEFAULT 0,
    drop_pickups_enabled integer DEFAULT 0,
    drop_pickups_order integer DEFAULT 0
);


ALTER TABLE public.drop_pickups OWNER TO navicom;

--
-- Name: drop_pickups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE drop_pickups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.drop_pickups_seq OWNER TO navicom;

--
-- Name: drop_pickups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE drop_pickups_seq OWNED BY drop_pickups.drop_pickups_id;


--
-- Name: emergencies; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE emergencies (
    emergency_id integer NOT NULL,
    emergency_code character varying(2),
    emergency_name character varying(50)
);


ALTER TABLE public.emergencies OWNER TO navicom;

--
-- Name: emergencies_emergency_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE emergencies_emergency_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.emergencies_emergency_id_seq OWNER TO navicom;

--
-- Name: emergencies_emergency_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE emergencies_emergency_id_seq OWNED BY emergencies.emergency_id;


--
-- Name: forget_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE forget_translations (
    translation_id integer NOT NULL,
    forgets_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.forget_translations OWNER TO navicom;

--
-- Name: forget_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE forget_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.forget_translations_translation_id_seq OWNER TO navicom;

--
-- Name: forget_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE forget_translations_translation_id_seq OWNED BY forget_translations.translation_id;


--
-- Name: forgets; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE forgets (
    forgets_id integer NOT NULL,
    forgets_image character varying(100),
    forgets_image_enabled integer DEFAULT 0,
    forgets_clip character varying(200),
    forgets_clip_enabled integer DEFAULT 0,
    forgets_enabled integer DEFAULT 0,
    forgets_order integer DEFAULT 0
);


ALTER TABLE public.forgets OWNER TO navicom;

--
-- Name: forgets_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE forgets_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.forgets_seq OWNER TO navicom;

--
-- Name: forgets_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE forgets_seq OWNED BY forgets.forgets_id;


--
-- Name: galleries; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE galleries (
    galleries_id integer NOT NULL,
    galleries_image character varying(100),
    galleries_image_enabled integer DEFAULT 0,
    galleries_clip character varying(200),
    galleries_clip_enabled integer DEFAULT 0,
    galleries_enabled integer DEFAULT 0,
    galleries_order integer DEFAULT 0
);


ALTER TABLE public.galleries OWNER TO navicom;

--
-- Name: galleries_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE galleries_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.galleries_seq OWNER TO navicom;

--
-- Name: galleries_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE galleries_seq OWNED BY galleries.galleries_id;


--
-- Name: gallery_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE gallery_translations (
    translation_id integer NOT NULL,
    galleries_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.gallery_translations OWNER TO navicom;

--
-- Name: gallery_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE gallery_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.gallery_translations_translation_id_seq OWNER TO navicom;

--
-- Name: gallery_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE gallery_translations_translation_id_seq OWNED BY gallery_translations.translation_id;


--
-- Name: guest_baskets; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_baskets (
    guest_basket_id bigint NOT NULL,
    guest_reservation_id bigint,
    guest_service_code character varying(20),
    guest_service_item character varying(50),
    guest_service_price numeric,
    guest_service_qty integer,
    room_name character varying(20),
    guest_service_note text,
    guest_service_guestname character varying(50),
    guest_service_approved smallint DEFAULT 0,
    guest_basket_type character(1) DEFAULT 'F'::bpchar,
    guest_basket_option character varying(100),
    guest_basket_datetime integer
);


ALTER TABLE public.guest_baskets OWNER TO navicom;

--
-- Name: guest_baskets_guest_basket_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_baskets_guest_basket_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_baskets_guest_basket_id_seq OWNER TO navicom;

--
-- Name: guest_baskets_guest_basket_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_baskets_guest_basket_id_seq OWNED BY guest_baskets.guest_basket_id;


--
-- Name: guest_bills; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_bills (
    guest_bill_id integer NOT NULL,
    guest_reservation_id bigint,
    guest_bill_date integer,
    guest_bill_category character varying(20),
    guest_bill_description character varying(100),
    guest_bill_remark character varying(255),
    guest_bill_reference character varying(50),
    guest_bill_debit numeric,
    guest_bill_credit numeric,
    guest_bill_balance numeric,
    guest_bill_quantity integer,
    guest_bill_price numeric
);


ALTER TABLE public.guest_bills OWNER TO navicom;

--
-- Name: guest_bills_guest_bill_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_bills_guest_bill_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_bills_guest_bill_id_seq OWNER TO navicom;

--
-- Name: guest_bills_guest_bill_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_bills_guest_bill_id_seq OWNED BY guest_bills.guest_bill_id;


--
-- Name: guest_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_groups (
    guest_groups_id integer NOT NULL,
    guest_groups_code integer,
    guest_groups_name character varying(100),
    guest_groups_enabled integer DEFAULT 0
);


ALTER TABLE public.guest_groups OWNER TO navicom;

--
-- Name: guest_groups_detail; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_groups_detail (
    guest_groups_detail_id integer NOT NULL,
    guest_groups_detail_content text,
    guest_groups_info_id integer,
    guest_groups_detail_order integer
);


ALTER TABLE public.guest_groups_detail OWNER TO navicom;

--
-- Name: guest_groups_detail_guest_groups_detail_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_groups_detail_guest_groups_detail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_groups_detail_guest_groups_detail_id_seq OWNER TO navicom;

--
-- Name: guest_groups_detail_guest_groups_detail_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_groups_detail_guest_groups_detail_id_seq OWNED BY guest_groups_detail.guest_groups_detail_id;


--
-- Name: guest_groups_info; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_groups_info (
    guest_groups_info_id integer NOT NULL,
    guest_groups_info_title character varying(100),
    guest_groups_info_logo character varying(50),
    guest_groups_info_welcome text,
    guest_groups_info_type character varying(10),
    guest_groups_info_enabled integer DEFAULT 0,
    guest_groups_code integer
);


ALTER TABLE public.guest_groups_info OWNER TO navicom;

--
-- Name: guest_groups_info_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_groups_info_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_groups_info_seq OWNER TO navicom;

--
-- Name: guest_groups_info_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_groups_info_seq OWNED BY guest_groups_info.guest_groups_info_id;


--
-- Name: guest_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_groups_seq OWNER TO navicom;

--
-- Name: guest_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_groups_seq OWNED BY guest_groups.guest_groups_id;


--
-- Name: guest_messages; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_messages (
    guest_message_id integer NOT NULL,
    guest_reservation_id bigint,
    guest_message_subject character varying(255),
    guest_message_content text,
    guest_message_date integer,
    guest_message_importance integer,
    guest_message_read integer DEFAULT 0,
    guest_message_ref_id integer,
    guest_message_from character varying(50),
    room_name character varying(20),
    guest_message_to bigint
);


ALTER TABLE public.guest_messages OWNER TO navicom;

--
-- Name: guest_messages_guest_message_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_messages_guest_message_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_messages_guest_message_id_seq OWNER TO navicom;

--
-- Name: guest_messages_guest_message_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_messages_guest_message_id_seq OWNED BY guest_messages.guest_message_id;


--
-- Name: guest_orders; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_orders (
    guest_order_id integer NOT NULL,
    guest_reservation_id bigint,
    guest_order_roomname character varying(20),
    guest_order_guestname character varying(50),
    guest_order_received smallint DEFAULT 0,
    guest_order_received_date integer,
    guest_order_approved smallint DEFAULT 0,
    guest_order_type character(1) DEFAULT 'T'::bpchar
);


ALTER TABLE public.guest_orders OWNER TO navicom;

--
-- Name: guest_orders_detail; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_orders_detail (
    guest_orders_detail_id integer NOT NULL,
    guest_order_id integer,
    guest_order_code character varying(20),
    guest_order_item character varying(100),
    guest_order_price numeric,
    guest_order_qty smallint,
    guest_order_note text
);


ALTER TABLE public.guest_orders_detail OWNER TO navicom;

--
-- Name: guest_orders_detail_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_orders_detail_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_orders_detail_seq OWNER TO navicom;

--
-- Name: guest_orders_detail_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_orders_detail_seq OWNED BY guest_orders_detail.guest_orders_detail_id;


--
-- Name: guest_orders_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_orders_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_orders_seq OWNER TO navicom;

--
-- Name: guest_orders_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_orders_seq OWNED BY guest_orders.guest_order_id;


--
-- Name: guest_request_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_request_translations (
    translation_id integer NOT NULL,
    guest_request_id integer,
    language_id character(2),
    translation_title character varying(50),
    translation_description text
);


ALTER TABLE public.guest_request_translations OWNER TO navicom;

--
-- Name: guest_request_translations_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_request_translations_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_request_translations_seq OWNER TO navicom;

--
-- Name: guest_request_translations_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_request_translations_seq OWNED BY guest_request_translations.translation_id;


--
-- Name: guest_requests; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_requests (
    guest_request_id integer NOT NULL,
    guest_request_value character varying(50),
    guest_request_enabled smallint DEFAULT 0
);


ALTER TABLE public.guest_requests OWNER TO navicom;

--
-- Name: guest_requests_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_requests_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_requests_seq OWNER TO navicom;

--
-- Name: guest_requests_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_requests_seq OWNED BY guest_requests.guest_request_id;


--
-- Name: guest_services; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_services (
    guest_service_id integer NOT NULL,
    guest_reservation_id bigint,
    guest_service_roomname character varying(40),
    guest_service_code character varying(20),
    guest_service_note text,
    guest_service_qty integer,
    guest_service_guestname character varying(50),
    guest_service_item character varying(50),
    guest_service_received smallint DEFAULT 0,
    guest_service_approved smallint DEFAULT 0,
    guest_service_received_date integer,
    guest_service_type character varying(2) DEFAULT 'F'::bpchar,
    guest_service_posted smallint DEFAULT 0
);


ALTER TABLE public.guest_services OWNER TO navicom;

--
-- Name: COLUMN guest_services.guest_service_id; Type: COMMENT; Schema: public; Owner: navicom
--

COMMENT ON COLUMN guest_services.guest_service_id IS 'date timenow';


--
-- Name: guest_services_detail; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guest_services_detail (
    guest_services_detail_id bigint NOT NULL,
    guest_service_id integer,
    guest_service_code character varying(20),
    guest_service_item character varying(50),
    guest_service_price numeric,
    guest_service_qty smallint,
    guest_service_note text
);


ALTER TABLE public.guest_services_detail OWNER TO navicom;

--
-- Name: guest_services_detail_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE guest_services_detail_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guest_services_detail_seq OWNER TO navicom;

--
-- Name: guest_services_detail_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE guest_services_detail_seq OWNED BY guest_services_detail.guest_services_detail_id;


--
-- Name: guests; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE guests (
    guest_reservation_id bigint NOT NULL,
    guest_arrival_date integer NOT NULL,
    guest_departure_date integer,
    guest_firstname character varying(50),
    guest_lastname character varying(50),
    guest_fullname character varying(80),
    guest_salutation character varying(10),
    guest_groupname character varying(50),
    guest_room_share integer DEFAULT 0,
    room_name character varying(50),
    guest_message integer DEFAULT 0,
    guest_checkin_type integer DEFAULT 0,
    guest_payment_method character varying(50) DEFAULT 0,
    guest_language character varying(2),
    guest_resv_no character varying(50),
    guest_resv_line_no character varying(50),
    guest_bill_request character(1) DEFAULT 0,
    guest_field5 character varying(255),
    guest_field6 character varying(255),
    guest_allow_post integer DEFAULT 0,
    guest_group integer DEFAULT 0,
    guest_vip integer DEFAULT 0,
    guest_honeymoon integer DEFAULT 0,
    guest_sync_status integer DEFAULT 0,
    guest_connect_room character varying(25),
    guest_allow_viewbill integer DEFAULT 0,
    guest_compliment smallint DEFAULT 0,
    guest_house_use smallint DEFAULT 0,
    guest_permanent smallint DEFAULT 0,
    guest_bill_lastupdate integer
);


ALTER TABLE public.guests OWNER TO navicom;

--
-- Name: hotspots; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE hotspots (
    hotspot_id integer NOT NULL,
    room_name character varying(20) NOT NULL,
    hotspot_password character varying(20),
    hotspot_rule smallint
);


ALTER TABLE public.hotspots OWNER TO navicom;

--
-- Name: hotspots_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE hotspots_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.hotspots_seq OWNER TO navicom;

--
-- Name: hotspots_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE hotspots_seq OWNED BY hotspots.hotspot_id;


--
-- Name: inhouse_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE inhouse_translations (
    translation_id integer NOT NULL,
    inhouses_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.inhouse_translations OWNER TO navicom;

--
-- Name: inhouse_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE inhouse_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inhouse_translations_translation_id_seq OWNER TO navicom;

--
-- Name: inhouse_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE inhouse_translations_translation_id_seq OWNED BY inhouse_translations.translation_id;


--
-- Name: inhouses; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE inhouses (
    inhouses_id integer NOT NULL,
    inhouses_image character varying(100),
    inhouses_image_enabled integer DEFAULT 0,
    inhouses_clip character varying(200),
    inhouses_clip_enabled integer DEFAULT 0,
    inhouses_enabled integer DEFAULT 0,
    inhouses_order integer DEFAULT 0
);


ALTER TABLE public.inhouses OWNER TO navicom;

--
-- Name: inhouses_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE inhouses_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inhouses_seq OWNER TO navicom;

--
-- Name: inhouses_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE inhouses_seq OWNED BY inhouses.inhouses_id;


--
-- Name: interest_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE interest_translations (
    translation_id integer NOT NULL,
    interest_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.interest_translations OWNER TO navicom;

--
-- Name: interest_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE interest_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.interest_translations_translation_id_seq OWNER TO navicom;

--
-- Name: interest_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE interest_translations_translation_id_seq OWNED BY interest_translations.translation_id;


--
-- Name: interests; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE interests (
    interest_id integer NOT NULL,
    interest_image character varying(100),
    interest_image_enabled integer DEFAULT 0,
    interest_clip character varying(200),
    interest_clip_enabled integer DEFAULT 0,
    interest_enabled integer DEFAULT 0,
    interest_order integer DEFAULT 0
);


ALTER TABLE public.interests OWNER TO navicom;

--
-- Name: interests_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE interests_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.interests_seq OWNER TO navicom;

--
-- Name: interests_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE interests_seq OWNED BY interests.interest_id;


--
-- Name: languages; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE languages (
    language_id character(2) NOT NULL,
    language_name character varying(50),
    language_enabled integer DEFAULT 0,
    language_flag character varying(30)
);


ALTER TABLE public.languages OWNER TO navicom;

--
-- Name: laundry; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE laundry (
    laundry_id integer NOT NULL,
    laundry_image character varying(100),
    laundry_image_enabled integer DEFAULT 0,
    laundry_clip character varying(200),
    laundry_clip_enabled integer DEFAULT 0,
    laundry_enabled integer DEFAULT 0,
    laundry_order integer DEFAULT 0
);


ALTER TABLE public.laundry OWNER TO navicom;

--
-- Name: laundry_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE laundry_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.laundry_seq OWNER TO navicom;

--
-- Name: laundry_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE laundry_seq OWNED BY laundry.laundry_id;


--
-- Name: laundry_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE laundry_translations (
    translation_id integer NOT NULL,
    laundry_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.laundry_translations OWNER TO navicom;

--
-- Name: laundry_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE laundry_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.laundry_translations_translation_id_seq OWNER TO navicom;

--
-- Name: laundry_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE laundry_translations_translation_id_seq OWNED BY laundry_translations.translation_id;


--
-- Name: logs; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE logs (
    log_time integer NOT NULL,
    log_action character varying(50),
    log_data text,
    log_user character varying(50),
    log_module character varying(50),
    log_mac character varying(30),
    log_browser character varying(200)
);


ALTER TABLE public.logs OWNER TO navicom;

--
-- Name: COLUMN logs.log_time; Type: COMMENT; Schema: public; Owner: navicom
--

COMMENT ON COLUMN logs.log_time IS 'tanggal log';


--
-- Name: massage_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE massage_translations (
    translation_id integer NOT NULL,
    massage_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.massage_translations OWNER TO navicom;

--
-- Name: massage_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE massage_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.massage_translations_translation_id_seq OWNER TO navicom;

--
-- Name: massage_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE massage_translations_translation_id_seq OWNED BY massage_translations.translation_id;


--
-- Name: massages; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE massages (
    massage_id integer NOT NULL,
    massage_image character varying(100),
    massage_image_enabled integer DEFAULT 0,
    massage_clip character varying(200),
    massage_clip_enabled integer DEFAULT 0,
    massage_enabled integer DEFAULT 0,
    massage_order integer DEFAULT 0
);


ALTER TABLE public.massages OWNER TO navicom;

--
-- Name: massages_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE massages_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.massages_seq OWNER TO navicom;

--
-- Name: massages_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE massages_seq OWNED BY massages.massage_id;


--
-- Name: meetingevent_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE meetingevent_translations (
    translation_id integer NOT NULL,
    meetingevents_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.meetingevent_translations OWNER TO navicom;

--
-- Name: meetingevent_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE meetingevent_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.meetingevent_translations_translation_id_seq OWNER TO navicom;

--
-- Name: meetingevent_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE meetingevent_translations_translation_id_seq OWNED BY meetingevent_translations.translation_id;


--
-- Name: meetingevents; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE meetingevents (
    meetingevents_id integer NOT NULL,
    meetingevents_image character varying(100),
    meetingevents_image_enabled integer DEFAULT 0,
    meetingevents_clip character varying(200),
    meetingevents_clip_enabled integer DEFAULT 0,
    meetingevents_enabled integer DEFAULT 0,
    meetingevents_order integer DEFAULT 0
);


ALTER TABLE public.meetingevents OWNER TO navicom;

--
-- Name: meetingevents_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE meetingevents_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.meetingevents_seq OWNER TO navicom;

--
-- Name: meetingevents_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE meetingevents_seq OWNED BY meetingevents.meetingevents_id;


--
-- Name: menu_group_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE menu_group_translations (
    translation_id integer NOT NULL,
    menu_group_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.menu_group_translations OWNER TO navicom;

--
-- Name: menu_group_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE menu_group_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.menu_group_translations_translation_id_seq OWNER TO navicom;

--
-- Name: menu_group_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE menu_group_translations_translation_id_seq OWNED BY menu_group_translations.translation_id;


--
-- Name: menu_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE menu_groups (
    menu_group_id integer NOT NULL,
    menu_group_thumbnail character varying(50),
    menu_group_enabled smallint DEFAULT 0,
    menu_group_order smallint,
    menu_group_runningtext_enabled smallint DEFAULT 1,
    menu_group_in_mobile smallint DEFAULT 0,
    menu_group_in_stb smallint DEFAULT 1,
    menu_group_in_empty_room smallint DEFAULT 0
);


ALTER TABLE public.menu_groups OWNER TO navicom;

--
-- Name: menu_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE menu_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.menu_groups_seq OWNER TO navicom;

--
-- Name: menu_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE menu_groups_seq OWNED BY menu_groups.menu_group_id;


--
-- Name: menu_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE menu_translations (
    translation_id integer NOT NULL,
    menu_id integer,
    language_id character varying(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.menu_translations OWNER TO navicom;

--
-- Name: menu_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE menu_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.menu_translations_translation_id_seq OWNER TO navicom;

--
-- Name: menu_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE menu_translations_translation_id_seq OWNED BY menu_translations.translation_id;


--
-- Name: menus; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE menus (
    menu_id integer NOT NULL,
    menu_thumbnail character varying(100),
    menu_url character varying(255) NOT NULL,
    menu_enabled integer DEFAULT 0,
    menu_order integer DEFAULT 0,
    menu_runningtext_enabled integer DEFAULT 0,
    menu_in_mobile integer DEFAULT 0,
    menu_in_stb integer DEFAULT 1,
    menu_in_empty_room smallint DEFAULT 1,
    menu_group_id integer
);


ALTER TABLE public.menus OWNER TO navicom;

--
-- Name: menus_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE menus_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.menus_seq OWNER TO navicom;

--
-- Name: menus_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE menus_seq OWNED BY menus.menu_id;


--
-- Name: modules; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE modules (
    module_id integer NOT NULL,
    module_name character varying(100),
    module_file character varying(50),
    module_description text,
    module_in_admin integer DEFAULT 1,
    module_enabled integer DEFAULT 0,
    module_order integer DEFAULT 0
);


ALTER TABLE public.modules OWNER TO navicom;

--
-- Name: modules_detail_cat; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE modules_detail_cat (
    module_detail_cat_id integer NOT NULL,
    module_detail_cat_name character varying(30) NOT NULL
);


ALTER TABLE public.modules_detail_cat OWNER TO navicom;

--
-- Name: modules_child_cat_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE modules_child_cat_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.modules_child_cat_seq OWNER TO navicom;

--
-- Name: modules_child_cat_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE modules_child_cat_seq OWNED BY modules_detail_cat.module_detail_cat_id;


--
-- Name: modules_detail; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE modules_detail (
    module_detail_id integer NOT NULL,
    module_detail_name character varying(30),
    module_detail_desc character varying(100),
    module_detail_file character varying(30),
    module_id integer,
    module_detail_cat_id integer,
    module_detail_enabled integer DEFAULT 0
);


ALTER TABLE public.modules_detail OWNER TO navicom;

--
-- Name: modules_child_module_child_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE modules_child_module_child_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.modules_child_module_child_id_seq OWNER TO navicom;

--
-- Name: modules_child_module_child_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE modules_child_module_child_id_seq OWNED BY modules_detail.module_detail_id;


--
-- Name: modules_module_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE modules_module_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.modules_module_id_seq OWNER TO navicom;

--
-- Name: modules_module_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE modules_module_id_seq OWNED BY modules.module_id;


--
-- Name: movie_group_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE movie_group_translations (
    translation_id integer NOT NULL,
    movie_group_id integer,
    language_id character(2),
    translation_title character varying(100)
);


ALTER TABLE public.movie_group_translations OWNER TO navicom;

--
-- Name: movie_group_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE movie_group_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movie_group_translations_translation_id_seq OWNER TO navicom;

--
-- Name: movie_group_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE movie_group_translations_translation_id_seq OWNED BY movie_group_translations.translation_id;


--
-- Name: movie_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE movie_groupings (
    movie_grouping_id integer NOT NULL,
    movie_id integer,
    movie_group_id integer
);


ALTER TABLE public.movie_groupings OWNER TO navicom;

--
-- Name: movie_groupings_movie_grouping_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE movie_groupings_movie_grouping_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movie_groupings_movie_grouping_id_seq OWNER TO navicom;

--
-- Name: movie_groupings_movie_grouping_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE movie_groupings_movie_grouping_id_seq OWNED BY movie_groupings.movie_grouping_id;


--
-- Name: movie_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE movie_groups (
    movie_group_id integer NOT NULL,
    movie_group_description text,
    movie_group_enabled integer DEFAULT 0
);


ALTER TABLE public.movie_groups OWNER TO navicom;

--
-- Name: movie_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE movie_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movie_groups_seq OWNER TO navicom;

--
-- Name: movie_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE movie_groups_seq OWNED BY movie_groups.movie_group_id;


--
-- Name: movie_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE movie_translations (
    translation_id integer NOT NULL,
    movie_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.movie_translations OWNER TO navicom;

--
-- Name: movie_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE movie_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movie_translations_translation_id_seq OWNER TO navicom;

--
-- Name: movie_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE movie_translations_translation_id_seq OWNED BY movie_translations.translation_id;


--
-- Name: movies; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE movies (
    movie_id integer NOT NULL,
    movie_price numeric,
    movie_casts character varying(200),
    movie_director character varying(100),
    movie_enabled integer DEFAULT 0,
    movie_url character varying(255),
    movie_thumbnail character varying(100),
    movie_trailer character varying(100),
    movie_allow_ads integer DEFAULT 0,
    movie_code character varying(20)
);


ALTER TABLE public.movies OWNER TO navicom;

--
-- Name: movies_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE movies_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movies_seq OWNER TO navicom;

--
-- Name: movies_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE movies_seq OWNED BY movies.movie_id;


--
-- Name: node_target_gate_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE node_target_gate_groupings (
    node_target_gate_grouping_id integer NOT NULL,
    target_gate_name character varying(10),
    node_id integer,
    direction character varying(3)
);


ALTER TABLE public.node_target_gate_groupings OWNER TO navicom;

--
-- Name: node_target_gate_groupings_node_target_gate_grouping_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE node_target_gate_groupings_node_target_gate_grouping_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.node_target_gate_groupings_node_target_gate_grouping_id_seq OWNER TO navicom;

--
-- Name: node_target_gate_groupings_node_target_gate_grouping_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE node_target_gate_groupings_node_target_gate_grouping_id_seq OWNED BY node_target_gate_groupings.node_target_gate_grouping_id;


--
-- Name: nodes; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE nodes (
    node_id integer NOT NULL,
    node_name character varying(100),
    node_mac character varying(50),
    node_description text,
    node_enabled integer DEFAULT 0,
    node_url character varying(255),
    node_lang_id character(2),
    room_id integer DEFAULT 0,
    node_welcome_screen integer DEFAULT 0,
    node_last_url text,
    node_ip character varying(25)
);


ALTER TABLE public.nodes OWNER TO navicom;

--
-- Name: nodes_node_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE nodes_node_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nodes_node_id_seq OWNER TO navicom;

--
-- Name: nodes_node_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE nodes_node_id_seq OWNED BY nodes.node_id;


--
-- Name: occupancy_daily; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE occupancy_daily (
    occupancy_daily_id integer NOT NULL,
    occupancy_daily_date character varying(10),
    occupancy_daily_totalroom integer,
    occupancy_daily_nonpaying integer,
    occupancy_daily_time integer,
    occupancy_daily_code character varying(1) DEFAULT 'd'::character varying
);


ALTER TABLE public.occupancy_daily OWNER TO navicom;

--
-- Name: COLUMN occupancy_daily.occupancy_daily_date; Type: COMMENT; Schema: public; Owner: navicom
--

COMMENT ON COLUMN occupancy_daily.occupancy_daily_date IS 'yyyy-mm-dd';


--
-- Name: occupancy_daily_occupancy_daily_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE occupancy_daily_occupancy_daily_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.occupancy_daily_occupancy_daily_id_seq OWNER TO navicom;

--
-- Name: occupancy_daily_occupancy_daily_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE occupancy_daily_occupancy_daily_id_seq OWNED BY occupancy_daily.occupancy_daily_id;


--
-- Name: occupancy_detail; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE occupancy_detail (
    occupancy_detail_id integer NOT NULL,
    occupancy_detail_room character varying(20),
    occupancy_detail_guestname character varying(50),
    occupancy_detail_nonpaying integer DEFAULT 0,
    occupancy_detail_date character varying(10),
    occupancy_detail_time integer
);


ALTER TABLE public.occupancy_detail OWNER TO navicom;

--
-- Name: COLUMN occupancy_detail.occupancy_detail_date; Type: COMMENT; Schema: public; Owner: navicom
--

COMMENT ON COLUMN occupancy_detail.occupancy_detail_date IS 'yyyy-mm-dd';


--
-- Name: occupancy_detail_occupancy_detail_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE occupancy_detail_occupancy_detail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.occupancy_detail_occupancy_detail_id_seq OWNER TO navicom;

--
-- Name: occupancy_detail_occupancy_detail_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE occupancy_detail_occupancy_detail_id_seq OWNED BY occupancy_detail.occupancy_detail_id;


--
-- Name: outlet_indirect_buffer; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE outlet_indirect_buffer (
    outlet_indirect_buffer_id integer NOT NULL,
    guest_reservation_id integer,
    guest_order_roomname character varying(20),
    guest_order_guestname character varying(50),
    guest_order_received smallint DEFAULT 0,
    guest_order_received_date integer,
    guest_order_approved smallint DEFAULT 0,
    guest_order_type character(1),
    guest_order_code character varying(20),
    guest_order_item character varying(100),
    guest_order_price numeric,
    guest_order_qty smallint,
    guest_order_note text,
    guest_order_time integer,
    guest_order_equip character varying(50)
);


ALTER TABLE public.outlet_indirect_buffer OWNER TO navicom;

--
-- Name: outlet_indirect_buffer_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE outlet_indirect_buffer_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.outlet_indirect_buffer_seq OWNER TO navicom;

--
-- Name: outlet_indirect_buffer_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE outlet_indirect_buffer_seq OWNED BY outlet_indirect_buffer.outlet_indirect_buffer_id;


--
-- Name: page_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE page_translations (
    page_translation_id integer NOT NULL,
    page_id integer,
    page_translation_title character varying(255),
    page_translation_content text,
    language_id character(2)
);


ALTER TABLE public.page_translations OWNER TO navicom;

--
-- Name: page_translations_page_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE page_translations_page_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.page_translations_page_translation_id_seq OWNER TO navicom;

--
-- Name: page_translations_page_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE page_translations_page_translation_id_seq OWNED BY page_translations.page_translation_id;


--
-- Name: pages; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE pages (
    page_id integer NOT NULL,
    page_thumbnail character varying(100),
    page_clip character varying(255),
    page_clip_enabled integer DEFAULT 0,
    page_in_menu integer DEFAULT 0,
    page_enabled integer DEFAULT 0,
    page_allow_ads integer DEFAULT 0
);


ALTER TABLE public.pages OWNER TO navicom;

--
-- Name: pages_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE pages_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pages_seq OWNER TO navicom;

--
-- Name: pages_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE pages_seq OWNED BY pages.page_id;


--
-- Name: permissions; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE permissions (
    permission_id integer NOT NULL,
    permission_user_id integer,
    permission_module_id integer,
    permission_value character(3)
);


ALTER TABLE public.permissions OWNER TO navicom;

--
-- Name: permissions_permission_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE permissions_permission_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissions_permission_id_seq OWNER TO navicom;

--
-- Name: permissions_permission_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE permissions_permission_id_seq OWNED BY permissions.permission_id;


--
-- Name: popup_promo_schedule; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE popup_promo_schedule (
    popup_schedule_id integer NOT NULL,
    popup_schedule_time integer,
    popup_schedule_duration integer,
    popup_id integer
);


ALTER TABLE public.popup_promo_schedule OWNER TO navicom;

--
-- Name: popup_promo_schedule_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE popup_promo_schedule_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.popup_promo_schedule_id_seq OWNER TO navicom;

--
-- Name: popup_promo_schedule_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE popup_promo_schedule_id_seq OWNED BY popup_promo_schedule.popup_schedule_id;


--
-- Name: popup_promos; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE popup_promos (
    popup_id integer NOT NULL,
    popup_title character varying(100),
    popup_description text,
    popup_image character varying(100),
    popup_enabled integer DEFAULT 0
);


ALTER TABLE public.popup_promos OWNER TO navicom;

--
-- Name: popup_promos_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE popup_promos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.popup_promos_id_seq OWNER TO navicom;

--
-- Name: popup_promos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE popup_promos_id_seq OWNED BY popup_promos.popup_id;


--
-- Name: publicplace_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE publicplace_translations (
    translation_id integer NOT NULL,
    publicplaces_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.publicplace_translations OWNER TO navicom;

--
-- Name: publicplace_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE publicplace_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.publicplace_translations_translation_id_seq OWNER TO navicom;

--
-- Name: publicplace_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE publicplace_translations_translation_id_seq OWNED BY publicplace_translations.translation_id;


--
-- Name: publicplaces; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE publicplaces (
    publicplaces_id integer NOT NULL,
    publicplaces_image character varying(100),
    publicplaces_image_enabled integer DEFAULT 0,
    publicplaces_clip character varying(200),
    publicplaces_clip_enabled integer DEFAULT 0,
    publicplaces_enabled integer DEFAULT 0,
    publicplaces_order integer DEFAULT 0
);


ALTER TABLE public.publicplaces OWNER TO navicom;

--
-- Name: publicplaces_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE publicplaces_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.publicplaces_seq OWNER TO navicom;

--
-- Name: publicplaces_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE publicplaces_seq OWNED BY publicplaces.publicplaces_id;


--
-- Name: recreational_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE recreational_translations (
    translation_id integer NOT NULL,
    recreationals_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.recreational_translations OWNER TO navicom;

--
-- Name: recreational_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE recreational_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recreational_translations_translation_id_seq OWNER TO navicom;

--
-- Name: recreational_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE recreational_translations_translation_id_seq OWNED BY recreational_translations.translation_id;


--
-- Name: recreationals; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE recreationals (
    recreationals_id integer NOT NULL,
    recreationals_image character varying(100),
    recreationals_image_enabled integer DEFAULT 0,
    recreationals_clip character varying(200),
    recreationals_clip_enabled integer DEFAULT 0,
    recreationals_enabled integer DEFAULT 0,
    recreationals_order integer DEFAULT 0
);


ALTER TABLE public.recreationals OWNER TO navicom;

--
-- Name: recreationals_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE recreationals_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recreationals_seq OWNER TO navicom;

--
-- Name: recreationals_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE recreationals_seq OWNED BY recreationals.recreationals_id;


--
-- Name: resortmap_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE resortmap_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.resortmap_translations_translation_id_seq OWNER TO navicom;

--
-- Name: resortmap_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE resortmap_translations (
    translation_id integer DEFAULT nextval('resortmap_translations_translation_id_seq'::regclass) NOT NULL,
    resortmaps_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.resortmap_translations OWNER TO navicom;

--
-- Name: resortmaps_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE resortmaps_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.resortmaps_seq OWNER TO navicom;

--
-- Name: resortmaps; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE resortmaps (
    resortmaps_id integer DEFAULT nextval('resortmaps_seq'::regclass) NOT NULL,
    resortmaps_image character varying(100),
    resortmaps_image_enabled integer DEFAULT 0,
    resortmaps_clip character varying(200),
    resortmaps_clip_enabled integer DEFAULT 0,
    resortmaps_enabled integer DEFAULT 0,
    resortmaps_order integer DEFAULT 0
);


ALTER TABLE public.resortmaps OWNER TO navicom;

--
-- Name: rooms; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE rooms (
    room_id integer NOT NULL,
    room_name character varying(20) NOT NULL,
    room_description text,
    room_enabled integer DEFAULT 0,
    room_key character varying(255),
    zone_id integer
);


ALTER TABLE public.rooms OWNER TO navicom;

--
-- Name: rooms_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE rooms_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rooms_seq OWNER TO navicom;

--
-- Name: rooms_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE rooms_seq OWNED BY rooms.room_id;


--
-- Name: roomsuite_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE roomsuite_translations (
    translation_id integer NOT NULL,
    roomsuites_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.roomsuite_translations OWNER TO navicom;

--
-- Name: roomsuite_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE roomsuite_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roomsuite_translations_translation_id_seq OWNER TO navicom;

--
-- Name: roomsuite_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE roomsuite_translations_translation_id_seq OWNED BY roomsuite_translations.translation_id;


--
-- Name: roomsuites; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE roomsuites (
    roomsuites_id integer NOT NULL,
    roomsuites_image character varying(100),
    roomsuites_image_enabled integer DEFAULT 0,
    roomsuites_clip character varying(200),
    roomsuites_clip_enabled integer DEFAULT 0,
    roomsuites_enabled integer DEFAULT 0,
    roomsuites_order integer DEFAULT 0
);


ALTER TABLE public.roomsuites OWNER TO navicom;

--
-- Name: roomsuites_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE roomsuites_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roomsuites_seq OWNER TO navicom;

--
-- Name: roomsuites_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE roomsuites_seq OWNED BY roomsuites.roomsuites_id;


--
-- Name: runningtext_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE runningtext_groupings (
    message_id integer,
    room_id integer,
    message_grouping_id bigint NOT NULL
);


ALTER TABLE public.runningtext_groupings OWNER TO navicom;

--
-- Name: runningtext_groupings_message_grouping_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE runningtext_groupings_message_grouping_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.runningtext_groupings_message_grouping_id_seq OWNER TO navicom;

--
-- Name: runningtext_groupings_message_grouping_id_seq1; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE runningtext_groupings_message_grouping_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.runningtext_groupings_message_grouping_id_seq1 OWNER TO navicom;

--
-- Name: runningtext_groupings_message_grouping_id_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE runningtext_groupings_message_grouping_id_seq1 OWNED BY runningtext_groupings.message_grouping_id;


--
-- Name: runningtext_logs; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE runningtext_logs (
    runningtext_log_time integer NOT NULL,
    runningtext_log_user character varying(50),
    runningtext_log_browser character varying(200),
    message_id integer,
    message_text text
);


ALTER TABLE public.runningtext_logs OWNER TO navicom;

--
-- Name: runningtext_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE runningtext_translations (
    message_id integer,
    language_id character varying(2),
    translation_message text,
    translation_description text,
    translation_id integer NOT NULL
);


ALTER TABLE public.runningtext_translations OWNER TO navicom;

--
-- Name: runningtext_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE runningtext_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.runningtext_translations_translation_id_seq OWNER TO navicom;

--
-- Name: runningtext_translations_translation_id_seq1; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE runningtext_translations_translation_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.runningtext_translations_translation_id_seq1 OWNER TO navicom;

--
-- Name: runningtext_translations_translation_id_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE runningtext_translations_translation_id_seq1 OWNED BY runningtext_translations.translation_id;


--
-- Name: runningtext_zone_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE runningtext_zone_groupings (
    message_zone_grouping_id bigint NOT NULL,
    message_id integer,
    zone_id integer
);


ALTER TABLE public.runningtext_zone_groupings OWNER TO navicom;

--
-- Name: runningtext_zone_groupings_runningtext_zone_grouping_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE runningtext_zone_groupings_runningtext_zone_grouping_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.runningtext_zone_groupings_runningtext_zone_grouping_id_seq OWNER TO navicom;

--
-- Name: runningtext_zone_groupings_runningtext_zone_grouping_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE runningtext_zone_groupings_runningtext_zone_grouping_id_seq OWNED BY runningtext_zone_groupings.message_zone_grouping_id;


--
-- Name: runningtexts; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE runningtexts (
    message_global integer DEFAULT 0 NOT NULL,
    message_enabled integer NOT NULL,
    message_id integer NOT NULL,
    message_schedule_start integer,
    message_schedule_end integer,
    message_daily integer,
    message_order integer
);


ALTER TABLE public.runningtexts OWNER TO navicom;

--
-- Name: COLUMN runningtexts.message_global; Type: COMMENT; Schema: public; Owner: navicom
--

COMMENT ON COLUMN runningtexts.message_global IS '0=target,1=global';


--
-- Name: runningtexts_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE runningtexts_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.runningtexts_seq OWNER TO navicom;

--
-- Name: runningtexts_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE runningtexts_seq OWNED BY runningtexts.message_id;


--
-- Name: service_group_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE service_group_translations (
    translation_id integer NOT NULL,
    service_group_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.service_group_translations OWNER TO navicom;

--
-- Name: service_group_translations_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE service_group_translations_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_group_translations_seq OWNER TO navicom;

--
-- Name: service_group_translations_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE service_group_translations_seq OWNED BY service_group_translations.translation_id;


--
-- Name: service_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE service_groups (
    service_group_id integer NOT NULL,
    service_group_description text,
    service_group_enabled integer DEFAULT 0,
    service_group_thumbnail character varying(100),
    service_group_allow_ads integer DEFAULT 0,
    service_group_order integer DEFAULT 0,
    service_group_clip character varying(100)
);


ALTER TABLE public.service_groups OWNER TO navicom;

--
-- Name: service_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE service_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_groups_seq OWNER TO navicom;

--
-- Name: service_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE service_groups_seq OWNED BY service_groups.service_group_id;


--
-- Name: service_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE service_translations (
    translation_id integer NOT NULL,
    service_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.service_translations OWNER TO navicom;

--
-- Name: service_translations_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE service_translations_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_translations_seq OWNER TO navicom;

--
-- Name: service_translations_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE service_translations_seq OWNED BY service_translations.translation_id;


--
-- Name: services; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE services (
    service_id integer NOT NULL,
    service_price numeric,
    service_thumbnail character varying(100),
    service_enabled integer DEFAULT 0,
    service_allow_ads integer DEFAULT 0,
    service_order integer DEFAULT 0,
    service_group_id integer,
    service_code character varying(20),
    service_updated smallint DEFAULT 0,
    service_currency character varying(3)
);


ALTER TABLE public.services OWNER TO navicom;

--
-- Name: services_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE services_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.services_seq OWNER TO navicom;

--
-- Name: services_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE services_seq OWNED BY services.service_id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE sessions (
    id bigint NOT NULL,
    session_id character varying(50),
    session_user_id integer,
    session_start integer,
    session_time integer,
    session_ip character varying(40),
    session_browser character varying(150),
    session_username character varying(100),
    session_mac character varying(30),
    session_module character varying(100),
    session_node_id integer
);


ALTER TABLE public.sessions OWNER TO navicom;

--
-- Name: sessions_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE sessions_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sessions_seq OWNER TO navicom;

--
-- Name: sessions_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE sessions_seq OWNED BY sessions.id;


--
-- Name: shop_group_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE shop_group_translations (
    translation_id integer NOT NULL,
    shop_group_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.shop_group_translations OWNER TO navicom;

--
-- Name: shop_group_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE shop_group_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.shop_group_translations_translation_id_seq OWNER TO navicom;

--
-- Name: shop_group_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE shop_group_translations_translation_id_seq OWNED BY shop_group_translations.translation_id;


--
-- Name: shop_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE shop_groups (
    shop_group_id integer NOT NULL,
    shop_group_thumbnail character varying(100),
    shop_group_order smallint,
    shop_group_allow_ads smallint DEFAULT 0,
    shop_group_enabled smallint DEFAULT 0,
    shop_group_clip character varying(100)
);


ALTER TABLE public.shop_groups OWNER TO navicom;

--
-- Name: shop_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE shop_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.shop_groups_seq OWNER TO navicom;

--
-- Name: shop_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE shop_groups_seq OWNED BY shop_groups.shop_group_id;


--
-- Name: shop_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE shop_translations (
    translation_id integer NOT NULL,
    shop_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.shop_translations OWNER TO navicom;

--
-- Name: shop_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE shop_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.shop_translations_translation_id_seq OWNER TO navicom;

--
-- Name: shop_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE shop_translations_translation_id_seq OWNED BY shop_translations.translation_id;


--
-- Name: shops; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE shops (
    shop_id integer NOT NULL,
    shop_price numeric,
    shop_thumbnail character varying(100),
    shop_enabled smallint DEFAULT 0,
    shop_allow_ads smallint DEFAULT 0,
    shop_code character varying(20),
    shop_order integer,
    shop_group_id integer,
    shop_updated smallint DEFAULT 0,
    shop_currency character varying(3)
);


ALTER TABLE public.shops OWNER TO navicom;

--
-- Name: shops_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE shops_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.shops_seq OWNER TO navicom;

--
-- Name: shops_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE shops_seq OWNED BY shops.shop_id;


--
-- Name: signage_ads; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_ads (
    signage_ads_id integer NOT NULL,
    signage_ads_name character varying(50),
    signage_ads_address text,
    signage_ads_cp character varying(50),
    signage_ads_phone character varying DEFAULT 100,
    signage_ads_email character varying DEFAULT 50,
    signage_ads_enabled integer DEFAULT 0
);


ALTER TABLE public.signage_ads OWNER TO navicom;

--
-- Name: signage_ads_logs; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_ads_logs (
    signage_ads_log_id integer NOT NULL,
    signage_ads_id integer,
    signage_ads_type character varying(50),
    signage_ads_name character varying(100),
    playlist_content_id integer,
    playlist_content_source character varying(255),
    signage_ads_log_time integer
);


ALTER TABLE public.signage_ads_logs OWNER TO navicom;

--
-- Name: signage_ads_signage_ads_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_ads_signage_ads_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_ads_signage_ads_id_seq OWNER TO navicom;

--
-- Name: signage_ads_signage_ads_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_ads_signage_ads_id_seq OWNED BY signage_ads.signage_ads_id;


--
-- Name: signage_clips; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_clips (
    signage_clip_id integer NOT NULL,
    signage_clip_name character varying(100),
    signage_clip_file character varying(255),
    signage_ads_id integer,
    signage_clip_enabled integer DEFAULT 0
);


ALTER TABLE public.signage_clips OWNER TO navicom;

--
-- Name: signage_clips_signage_clip_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_clips_signage_clip_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_clips_signage_clip_id_seq OWNER TO navicom;

--
-- Name: signage_clips_signage_clip_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_clips_signage_clip_id_seq OWNED BY signage_clips.signage_clip_id;


--
-- Name: signage_content_schedules; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_content_schedules (
    signage_content_schedule_id integer NOT NULL,
    signage_content_schedule_name character varying(50),
    signage_content_schedule_start integer,
    signage_content_schedule_end integer,
    signage_region_grouping_id integer,
    signage_content_schedule_enabled integer DEFAULT 0,
    playlist_id integer,
    signage_content_schedule_fullscreen integer DEFAULT 0
);


ALTER TABLE public.signage_content_schedules OWNER TO navicom;

--
-- Name: signage_content_schedules_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_content_schedules_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_content_schedules_seq OWNER TO navicom;

--
-- Name: signage_content_schedules_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_content_schedules_seq OWNED BY signage_content_schedules.signage_content_schedule_id;


--
-- Name: signage_generals; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_generals (
    signage_general_id integer NOT NULL,
    signage_general_title character varying(255),
    signage_general_date integer,
    signage_general_remark text,
    signage_general_enabled integer DEFAULT 0
);


ALTER TABLE public.signage_generals OWNER TO navicom;

--
-- Name: signage_generals_signage_general_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_generals_signage_general_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_generals_signage_general_id_seq OWNER TO navicom;

--
-- Name: signage_generals_signage_general_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_generals_signage_general_id_seq OWNED BY signage_generals.signage_general_id;


--
-- Name: signage_images; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_images (
    signage_image_id integer NOT NULL,
    signage_image_name character varying(50),
    signage_image_file character varying(255),
    signage_ads_id integer DEFAULT 0,
    signage_image_enabled integer DEFAULT 0
);


ALTER TABLE public.signage_images OWNER TO navicom;

--
-- Name: signage_images_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_images_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_images_seq OWNER TO navicom;

--
-- Name: signage_images_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_images_seq OWNED BY signage_images.signage_image_id;


--
-- Name: signage_playlist_contents; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_playlist_contents (
    playlist_content_id integer NOT NULL,
    playlist_content_source character varying(255),
    playlist_id integer
);


ALTER TABLE public.signage_playlist_contents OWNER TO navicom;

--
-- Name: signage_playlist_contents_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_playlist_contents_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_playlist_contents_seq OWNER TO navicom;

--
-- Name: signage_playlist_contents_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_playlist_contents_seq OWNED BY signage_playlist_contents.playlist_content_id;


--
-- Name: signage_playlists; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_playlists (
    playlist_id integer NOT NULL,
    playlist_name character varying(50),
    playlist_description text,
    playlist_type character varying(20),
    playlist_enabled integer DEFAULT 0,
    playlist_loop integer DEFAULT 0,
    playlist_duration integer
);


ALTER TABLE public.signage_playlists OWNER TO navicom;

--
-- Name: signage_playlists_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_playlists_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_playlists_seq OWNER TO navicom;

--
-- Name: signage_playlists_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_playlists_seq OWNED BY signage_playlists.playlist_id;


--
-- Name: signage_region_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_region_groupings (
    signage_region_grouping_id integer NOT NULL,
    signage_id integer,
    region_id integer,
    playlist_id integer,
    default_source character varying(255),
    default_type character varying(20),
    signage_region_grouping_name character varying(100)
);


ALTER TABLE public.signage_region_groupings OWNER TO navicom;

--
-- Name: signage_region_groupings_signage_region_grouping_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_region_groupings_signage_region_grouping_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_region_groupings_signage_region_grouping_id_seq OWNER TO navicom;

--
-- Name: signage_region_groupings_signage_region_grouping_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_region_groupings_signage_region_grouping_id_seq OWNED BY signage_region_groupings.signage_region_grouping_id;


--
-- Name: signage_regions; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_regions (
    region_id integer NOT NULL,
    region_name character varying(20),
    region_description text,
    region_enabled integer DEFAULT 0,
    region_type character varying(20),
    region_position integer
);


ALTER TABLE public.signage_regions OWNER TO navicom;

--
-- Name: signage_regions_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_regions_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_regions_seq OWNER TO navicom;

--
-- Name: signage_regions_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_regions_seq OWNED BY signage_regions.region_id;


--
-- Name: signage_room_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_room_groupings (
    signage_room_grouping_id integer NOT NULL,
    signage_id integer,
    room_id integer
);


ALTER TABLE public.signage_room_groupings OWNER TO navicom;

--
-- Name: signage_room_groupings_signage_room_grouping_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_room_groupings_signage_room_grouping_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_room_groupings_signage_room_grouping_id_seq OWNER TO navicom;

--
-- Name: signage_room_groupings_signage_room_grouping_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_room_groupings_signage_room_grouping_id_seq OWNED BY signage_room_groupings.signage_room_grouping_id;


--
-- Name: signage_rss; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_rss (
    signage_rss_id integer DEFAULT nextval('signage_images_seq'::regclass) NOT NULL,
    signage_rss_name character varying(50),
    signage_rss_file character varying(255),
    signage_ads_id integer DEFAULT 0,
    signage_rss_enabled integer DEFAULT 0
);


ALTER TABLE public.signage_rss OWNER TO navicom;

--
-- Name: signage_templates; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_templates (
    template_id integer NOT NULL,
    template_name character varying(50),
    template_description text,
    template_enabled integer DEFAULT 0
);


ALTER TABLE public.signage_templates OWNER TO navicom;

--
-- Name: signage_templates_template_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_templates_template_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_templates_template_id_seq OWNER TO navicom;

--
-- Name: signage_templates_template_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_templates_template_id_seq OWNED BY signage_templates.template_id;


--
-- Name: signage_texts; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_texts (
    signage_text_id integer DEFAULT nextval('signage_images_seq'::regclass) NOT NULL,
    signage_text_name character varying(50),
    signage_text_file character varying(255),
    signage_ads_id integer DEFAULT 0,
    signage_text_enabled integer DEFAULT 0
);


ALTER TABLE public.signage_texts OWNER TO navicom;

--
-- Name: signage_urgencies; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_urgencies (
    signage_urgency_id integer NOT NULL,
    signage_urgency_duration integer,
    signage_urgency_enabled integer DEFAULT 0,
    emergency_code character varying(2),
    signage_urgency_airline character varying(100),
    signage_urgency_flight_no character varying(50),
    signage_urgency_destination character varying(100),
    signage_urgency_departure_gate character varying(20),
    signage_urgency_departure_time character varying(10),
    signage_urgency_message text,
    signage_urgency_priority_order integer,
    signage_urgency_flag character varying(20),
    signage_urgency_display character varying(10)
);


ALTER TABLE public.signage_urgencies OWNER TO navicom;

--
-- Name: signage_urgencies_signage_urgency_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_urgencies_signage_urgency_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_urgencies_signage_urgency_id_seq OWNER TO navicom;

--
-- Name: signage_urgencies_signage_urgency_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_urgencies_signage_urgency_id_seq OWNED BY signage_urgencies.signage_urgency_id;


--
-- Name: signage_urgency_room_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_urgency_room_groupings (
    signage_urgency_room_grouping_id integer NOT NULL,
    signage_urgency_id integer,
    room_id integer
);


ALTER TABLE public.signage_urgency_room_groupings OWNER TO navicom;

--
-- Name: signage_urgency_room_grouping_signage_urgency_room_grouping_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_urgency_room_grouping_signage_urgency_room_grouping_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_urgency_room_grouping_signage_urgency_room_grouping_seq OWNER TO navicom;

--
-- Name: signage_urgency_room_grouping_signage_urgency_room_grouping_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_urgency_room_grouping_signage_urgency_room_grouping_seq OWNED BY signage_urgency_room_groupings.signage_urgency_room_grouping_id;


--
-- Name: signage_urgency_zone_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_urgency_zone_groupings (
    signage_urgency_zone_grouping_id integer NOT NULL,
    signage_urgency_id integer,
    zone_id integer
);


ALTER TABLE public.signage_urgency_zone_groupings OWNER TO navicom;

--
-- Name: signage_urgency_zone_grouping_signage_urgency_zone_grouping_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_urgency_zone_grouping_signage_urgency_zone_grouping_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_urgency_zone_grouping_signage_urgency_zone_grouping_seq OWNER TO navicom;

--
-- Name: signage_urgency_zone_grouping_signage_urgency_zone_grouping_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_urgency_zone_grouping_signage_urgency_zone_grouping_seq OWNED BY signage_urgency_zone_groupings.signage_urgency_zone_grouping_id;


--
-- Name: signage_zone_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signage_zone_groupings (
    signage_zone_grouping_id integer NOT NULL,
    signage_id integer,
    zone_id integer
);


ALTER TABLE public.signage_zone_groupings OWNER TO navicom;

--
-- Name: signage_zone_groupings_signage_zone_grouping_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signage_zone_groupings_signage_zone_grouping_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signage_zone_groupings_signage_zone_grouping_id_seq OWNER TO navicom;

--
-- Name: signage_zone_groupings_signage_zone_grouping_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signage_zone_groupings_signage_zone_grouping_id_seq OWNED BY signage_zone_groupings.signage_zone_grouping_id;


--
-- Name: signages; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE signages (
    signage_id integer NOT NULL,
    signage_name character varying(30),
    signage_description text,
    signage_enabled integer DEFAULT 0,
    template_id integer
);


ALTER TABLE public.signages OWNER TO navicom;

--
-- Name: signages_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE signages_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.signages_seq OWNER TO navicom;

--
-- Name: signages_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE signages_seq OWNED BY signages.signage_id;


--
-- Name: souvernir_group_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE souvernir_group_translations (
    translation_id integer NOT NULL,
    souvernir_group_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.souvernir_group_translations OWNER TO navicom;

--
-- Name: souvernir_group_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE souvernir_group_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.souvernir_group_translations_translation_id_seq OWNER TO navicom;

--
-- Name: souvernir_group_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE souvernir_group_translations_translation_id_seq OWNED BY souvernir_group_translations.translation_id;


--
-- Name: souvernir_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE souvernir_groups (
    souvernir_group_id integer NOT NULL,
    souvernir_group_thumbnail character varying(100),
    souvernir_group_order integer,
    souvernir_group_allow_ads smallint,
    souvernir_group_enabled smallint
);


ALTER TABLE public.souvernir_groups OWNER TO navicom;

--
-- Name: souvernir_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE souvernir_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.souvernir_groups_seq OWNER TO navicom;

--
-- Name: souvernir_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE souvernir_groups_seq OWNED BY souvernir_groups.souvernir_group_id;


--
-- Name: souvernir_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE souvernir_translations (
    translation_id integer NOT NULL,
    souvernir_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.souvernir_translations OWNER TO navicom;

--
-- Name: souvernir_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE souvernir_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.souvernir_translations_translation_id_seq OWNER TO navicom;

--
-- Name: souvernir_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE souvernir_translations_translation_id_seq OWNED BY souvernir_translations.translation_id;


--
-- Name: souvernirs; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE souvernirs (
    souvernir_id integer NOT NULL,
    souvernir_price numeric,
    souvernir_thumbnail character varying(100),
    souvernir_enabled smallint DEFAULT 0,
    souvernir_allow_ads smallint DEFAULT 0,
    souvernir_order integer,
    souvernir_group_id integer,
    souvernir_code character varying(20)
);


ALTER TABLE public.souvernirs OWNER TO navicom;

--
-- Name: souvernirs_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE souvernirs_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.souvernirs_seq OWNER TO navicom;

--
-- Name: souvernirs_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE souvernirs_seq OWNED BY souvernirs.souvernir_id;


--
-- Name: spa_group_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE spa_group_translations (
    translation_id integer NOT NULL,
    spa_group_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.spa_group_translations OWNER TO navicom;

--
-- Name: spa_group_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE spa_group_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spa_group_translations_translation_id_seq OWNER TO navicom;

--
-- Name: spa_group_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE spa_group_translations_translation_id_seq OWNED BY spa_group_translations.translation_id;


--
-- Name: spa_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE spa_groups (
    spa_group_id integer NOT NULL,
    spa_group_description text,
    spa_group_thumbnail character varying(100),
    spa_group_enabled smallint DEFAULT 0,
    spa_group_allow_ads smallint DEFAULT 0,
    spa_group_order smallint,
    spa_group_clip character varying(100)
);


ALTER TABLE public.spa_groups OWNER TO navicom;

--
-- Name: spa_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE spa_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spa_groups_seq OWNER TO navicom;

--
-- Name: spa_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE spa_groups_seq OWNED BY spa_groups.spa_group_id;


--
-- Name: spa_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE spa_translations (
    translation_id integer NOT NULL,
    spa_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.spa_translations OWNER TO navicom;

--
-- Name: spa_translations_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE spa_translations_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spa_translations_seq OWNER TO navicom;

--
-- Name: spa_translations_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE spa_translations_seq OWNED BY spa_translations.translation_id;


--
-- Name: spas; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE spas (
    spa_id integer NOT NULL,
    spa_price numeric,
    spa_thumbnail character varying(100),
    spa_enabled smallint,
    spa_allow_ads smallint,
    spa_order smallint,
    spa_group_id integer,
    spa_code character varying(20),
    spa_clip character varying(100),
    spa_currency character varying(3)
);


ALTER TABLE public.spas OWNER TO navicom;

--
-- Name: spas_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE spas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spas_seq OWNER TO navicom;

--
-- Name: spas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE spas_seq OWNED BY spas.spa_id;


--
-- Name: style_schedules; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE style_schedules (
    style_schedule_id integer NOT NULL,
    style_schedule_start integer,
    style_schedule_end integer,
    style_id integer,
    style_schedule_enabled integer,
    style_schedule_node text,
    style_schedule_name character varying(50)
);


ALTER TABLE public.style_schedules OWNER TO navicom;

--
-- Name: style_schedules_style_schedule_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE style_schedules_style_schedule_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.style_schedules_style_schedule_id_seq OWNER TO navicom;

--
-- Name: style_schedules_style_schedule_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE style_schedules_style_schedule_id_seq OWNED BY style_schedules.style_schedule_id;


--
-- Name: styles; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE styles (
    style_id integer NOT NULL,
    style_name character varying(50),
    style_description text,
    style_active integer,
    style_admin integer DEFAULT 0,
    style_tablet integer DEFAULT 0
);


ALTER TABLE public.styles OWNER TO navicom;

--
-- Name: styles_style_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE styles_style_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.styles_style_id_seq OWNER TO navicom;

--
-- Name: styles_style_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE styles_style_id_seq OWNED BY styles.style_id;


--
-- Name: sync_flag; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE sync_flag (
    sync_id integer NOT NULL,
    sync_code character varying(20),
    sync_request smallint DEFAULT 0,
    sync_status smallint DEFAULT 0
);


ALTER TABLE public.sync_flag OWNER TO navicom;

--
-- Name: sync_flag_sync_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE sync_flag_sync_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sync_flag_sync_id_seq OWNER TO navicom;

--
-- Name: sync_flag_sync_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE sync_flag_sync_id_seq OWNED BY sync_flag.sync_id;


--
-- Name: target_gates; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE target_gates (
    target_gate_id integer NOT NULL,
    target_gate_name character varying(10),
    target_gate_description text,
    target_gate_enabled integer DEFAULT 0
);


ALTER TABLE public.target_gates OWNER TO navicom;

--
-- Name: target_gates_target_gate_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE target_gates_target_gate_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.target_gates_target_gate_id_seq OWNER TO navicom;

--
-- Name: target_gates_target_gate_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE target_gates_target_gate_id_seq OWNED BY target_gates.target_gate_id;


--
-- Name: teraphist_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE teraphist_translations (
    translation_id integer NOT NULL,
    teraphist_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.teraphist_translations OWNER TO navicom;

--
-- Name: teraphist_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE teraphist_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.teraphist_translations_translation_id_seq OWNER TO navicom;

--
-- Name: teraphist_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE teraphist_translations_translation_id_seq OWNED BY teraphist_translations.translation_id;


--
-- Name: teraphists; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE teraphists (
    teraphist_id integer NOT NULL,
    teraphist_thumbnail character varying(100),
    teraphist_enabled smallint DEFAULT 0
);


ALTER TABLE public.teraphists OWNER TO navicom;

--
-- Name: teraphists_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE teraphists_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.teraphists_seq OWNER TO navicom;

--
-- Name: teraphists_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE teraphists_seq OWNED BY teraphists.teraphist_id;


--
-- Name: themes; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE themes (
    theme_id integer NOT NULL,
    theme_start integer,
    theme_end integer,
    theme_name character varying(100),
    theme_description text,
    theme_enabled boolean DEFAULT false
);


ALTER TABLE public.themes OWNER TO navicom;

--
-- Name: themes_theme_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE themes_theme_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.themes_theme_id_seq OWNER TO navicom;

--
-- Name: themes_theme_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE themes_theme_id_seq OWNED BY themes.theme_id;


--
-- Name: tour_group_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tour_group_translations (
    translation_id integer NOT NULL,
    tour_group_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.tour_group_translations OWNER TO navicom;

--
-- Name: tour_group_translations_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tour_group_translations_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tour_group_translations_seq OWNER TO navicom;

--
-- Name: tour_group_translations_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tour_group_translations_seq OWNED BY tour_group_translations.translation_id;


--
-- Name: tour_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tour_groups (
    tour_group_id integer NOT NULL,
    tour_group_description text,
    tour_group_thumbnail character varying(100),
    tour_group_enabled smallint DEFAULT 0,
    tour_group_allow_ads smallint DEFAULT 0,
    tour_group_order smallint,
    tour_group_clip character varying(100)
);


ALTER TABLE public.tour_groups OWNER TO navicom;

--
-- Name: tour_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tour_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tour_groups_seq OWNER TO navicom;

--
-- Name: tour_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tour_groups_seq OWNED BY tour_groups.tour_group_id;


--
-- Name: tour_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tour_translations (
    translation_id integer NOT NULL,
    tour_id integer,
    language_id character(2),
    translation_title character varying(100),
    translation_description text
);


ALTER TABLE public.tour_translations OWNER TO navicom;

--
-- Name: tour_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tour_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tour_translations_translation_id_seq OWNER TO navicom;

--
-- Name: tour_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tour_translations_translation_id_seq OWNED BY tour_translations.translation_id;


--
-- Name: tours; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tours (
    tour_id integer NOT NULL,
    tour_price numeric,
    tour_thumbnail character varying(100),
    tour_enabled smallint DEFAULT 0,
    tour_clip character varying(100),
    tour_order smallint,
    tour_group_id integer,
    tour_code character varying(20),
    tour_allow_ads smallint DEFAULT 0,
    tour_currency character varying(3)
);


ALTER TABLE public.tours OWNER TO navicom;

--
-- Name: tours_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tours_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tours_seq OWNER TO navicom;

--
-- Name: tours_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tours_seq OWNED BY tours.tour_id;


--
-- Name: tv_channel_group_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tv_channel_group_translations (
    translation_id integer NOT NULL,
    tv_channel_group_id integer,
    language_id character(2),
    translation_title character varying(100)
);


ALTER TABLE public.tv_channel_group_translations OWNER TO navicom;

--
-- Name: tv_channel_group_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tv_channel_group_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tv_channel_group_translations_translation_id_seq OWNER TO navicom;

--
-- Name: tv_channel_group_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tv_channel_group_translations_translation_id_seq OWNED BY tv_channel_group_translations.translation_id;


--
-- Name: tv_channel_groupings; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tv_channel_groupings (
    tv_channel_grouping_id integer NOT NULL,
    tv_channel_group_id integer,
    tv_channel_id integer
);


ALTER TABLE public.tv_channel_groupings OWNER TO navicom;

--
-- Name: tv_channel_groupings_tv_channel_grouping_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tv_channel_groupings_tv_channel_grouping_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tv_channel_groupings_tv_channel_grouping_id_seq OWNER TO navicom;

--
-- Name: tv_channel_groupings_tv_channel_grouping_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tv_channel_groupings_tv_channel_grouping_id_seq OWNED BY tv_channel_groupings.tv_channel_grouping_id;


--
-- Name: tv_channel_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tv_channel_groups (
    tv_channel_group_id integer NOT NULL,
    tv_channel_group_description text,
    tv_channel_group_enabled integer DEFAULT 0,
    tv_channel_group_thumbnail character varying(100),
    tv_channel_group_order smallint
);


ALTER TABLE public.tv_channel_groups OWNER TO navicom;

--
-- Name: tv_channel_groups_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tv_channel_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tv_channel_groups_seq OWNER TO navicom;

--
-- Name: tv_channel_groups_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tv_channel_groups_seq OWNED BY tv_channel_groups.tv_channel_group_id;


--
-- Name: tv_channels; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tv_channels (
    tv_channel_id integer NOT NULL,
    tv_channel_name character varying(100) NOT NULL,
    tv_channel_url_http character varying(255),
    tv_channel_thumbnail character varying(100),
    tv_channel_order integer DEFAULT 0,
    tv_channel_url_udp character varying(255),
    tv_channel_allow_ads integer DEFAULT 0,
    tv_channel_enabled integer DEFAULT 0
);


ALTER TABLE public.tv_channels OWNER TO navicom;

--
-- Name: tv_channels_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tv_channels_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tv_channels_seq OWNER TO navicom;

--
-- Name: tv_channels_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tv_channels_seq OWNED BY tv_channels.tv_channel_id;


--
-- Name: tv_promos; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE tv_promos (
    tv_promo_id integer NOT NULL,
    tv_promo_title character varying(100),
    tv_promo_description text,
    tv_promo_thumbnail character varying(100),
    tv_promo_start integer,
    tv_promo_end integer,
    tv_promo_default integer DEFAULT 0,
    tv_promo_enabled integer DEFAULT 0
);


ALTER TABLE public.tv_promos OWNER TO navicom;

--
-- Name: tv_promos_tv_promo_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE tv_promos_tv_promo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tv_promos_tv_promo_id_seq OWNER TO navicom;

--
-- Name: tv_promos_tv_promo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE tv_promos_tv_promo_id_seq OWNED BY tv_promos.tv_promo_id;


--
-- Name: user_groups; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE user_groups (
    user_group_id integer NOT NULL,
    user_group_name character varying(50),
    user_group_description text,
    user_group_enabled integer DEFAULT 0
);


ALTER TABLE public.user_groups OWNER TO navicom;

--
-- Name: user_groups_user_group_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE user_groups_user_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_groups_user_group_id_seq OWNER TO navicom;

--
-- Name: user_groups_user_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE user_groups_user_group_id_seq OWNED BY user_groups.user_group_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE users (
    user_id integer NOT NULL,
    user_name character varying(50),
    user_fullname character varying(100),
    user_password character varying(50),
    user_description text,
    user_group_id integer,
    language_id character(2) DEFAULT 'en'::bpchar,
    user_enabled integer DEFAULT 0,
    user_lastvisit integer
);


ALTER TABLE public.users OWNER TO navicom;

--
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE users_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO navicom;

--
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE users_user_id_seq OWNED BY users.user_id;


--
-- Name: view_modules; Type: VIEW; Schema: public; Owner: navicom
--

CREATE VIEW view_modules AS
 SELECT m.module_id,
    d.module_detail_id,
    d.module_detail_name,
    d.module_detail_desc,
    d.module_detail_file,
    c.module_detail_cat_id,
    c.module_detail_cat_name,
    m.module_name,
    d.module_detail_enabled
   FROM modules_detail d,
    modules_detail_cat c,
    modules m
  WHERE ((d.module_id = m.module_id) AND (d.module_detail_cat_id = c.module_detail_cat_id))
  ORDER BY c.module_detail_cat_name, d.module_detail_name;


ALTER TABLE public.view_modules OWNER TO navicom;

--
-- Name: view_user_permissions; Type: VIEW; Schema: public; Owner: navicom
--

CREATE VIEW view_user_permissions AS
 SELECT u.user_id,
    u.user_name,
    u.user_fullname,
    g.user_group_name,
    p.permission_id,
    p.permission_module_id,
    p.permission_value
   FROM ((users u
     JOIN user_groups g ON ((u.user_group_id = g.user_group_id)))
     LEFT JOIN permissions p ON ((u.user_id = p.permission_user_id)))
  WHERE (u.user_enabled = 1);


ALTER TABLE public.view_user_permissions OWNER TO navicom;

--
-- Name: view_priviledges; Type: VIEW; Schema: public; Owner: navicom
--

CREATE VIEW view_priviledges AS
 SELECT m.module_id,
    m.module_detail_id,
    m.module_detail_name,
    m.module_detail_desc,
    m.module_detail_file,
    m.module_detail_cat_id,
    m.module_detail_cat_name,
    m.module_name,
    m.module_detail_enabled,
    p.user_id,
    p.user_name,
    p.user_fullname,
    p.user_group_name,
    p.permission_id,
    p.permission_module_id,
    p.permission_value
   FROM (view_modules m
     LEFT JOIN view_user_permissions p ON ((p.permission_module_id = m.module_detail_id)));


ALTER TABLE public.view_priviledges OWNER TO navicom;

--
-- Name: wakeup_call_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE wakeup_call_translations (
    translation_id integer NOT NULL,
    wakeup_calls_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.wakeup_call_translations OWNER TO navicom;

--
-- Name: wakeup_call_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE wakeup_call_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wakeup_call_translations_translation_id_seq OWNER TO navicom;

--
-- Name: wakeup_call_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE wakeup_call_translations_translation_id_seq OWNED BY wakeup_call_translations.translation_id;


--
-- Name: wakeup_calls; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE wakeup_calls (
    wakeup_calls_id integer NOT NULL,
    wakeup_calls_image character varying(100),
    wakeup_calls_image_enabled integer DEFAULT 0,
    wakeup_calls_clip character varying(200),
    wakeup_calls_clip_enabled integer DEFAULT 0,
    wakeup_calls_enabled integer DEFAULT 0,
    wakeup_calls_order integer DEFAULT 0
);


ALTER TABLE public.wakeup_calls OWNER TO navicom;

--
-- Name: wakeup_calls_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE wakeup_calls_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wakeup_calls_seq OWNER TO navicom;

--
-- Name: wakeup_calls_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE wakeup_calls_seq OWNED BY wakeup_calls.wakeup_calls_id;


--
-- Name: weather; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE weather (
    weather_id integer NOT NULL,
    weather_city character varying(50),
    weather_enabled integer DEFAULT 0,
    weather_city_full character varying(100),
    weather_country_icon character varying(50),
    weather_today_text character varying(200),
    weather_today_condition character varying(30),
    weather_today_icon character varying(20),
    weather_today_icon_url character varying(100),
    weather_today_temp_f_min character varying(10),
    weather_today_temp_f_max character varying(10),
    weather_today_temp_c_min character varying(10),
    weather_today_temp_c_max character varying(10),
    weather_day1_text character varying(15),
    weather_day1_condition character varying(30),
    weather_day1_icon character varying(20),
    weather_day1_icon_url character varying(100),
    weather_day1_temp_f_min character varying(10),
    weather_day1_temp_f_max character varying(10),
    weather_day1_temp_c_min character varying(10),
    weather_day1_temp_c_max character varying(10),
    weather_day2_text character varying(15),
    weather_day2_condition character varying(30),
    weather_day2_icon character varying(20),
    weather_day2_icon_url character varying(100),
    weather_day2_temp_f_min character varying(10),
    weather_day2_temp_f_max character varying(10),
    weather_day2_temp_c_min character varying(10),
    weather_day2_temp_c_max character varying(10),
    weather_day3_text character varying(15),
    weather_day3_condition character varying(30),
    weather_day3_icon character varying(20),
    weather_day3_icon_url character varying(100),
    weather_day3_temp_f_min character varying(10),
    weather_day3_temp_f_max character varying(10),
    weather_day3_temp_c_min character varying(10),
    weather_day3_temp_c_max character varying(10),
    weather_exist integer DEFAULT 0
);


ALTER TABLE public.weather OWNER TO navicom;

--
-- Name: weather_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE weather_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.weather_seq OWNER TO navicom;

--
-- Name: weather_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE weather_seq OWNED BY weather.weather_id;


--
-- Name: whatson; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE whatson (
    whatson_id integer NOT NULL,
    whatson_image character varying(100),
    whatson_image_enabled integer DEFAULT 0,
    whatson_clip character varying(200),
    whatson_clip_enabled integer DEFAULT 0,
    whatson_enabled integer DEFAULT 0,
    whatson_order integer DEFAULT 0
);


ALTER TABLE public.whatson OWNER TO navicom;

--
-- Name: whatson_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE whatson_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.whatson_seq OWNER TO navicom;

--
-- Name: whatson_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE whatson_seq OWNED BY whatson.whatson_id;


--
-- Name: whatson_translations; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE whatson_translations (
    translation_id integer NOT NULL,
    whatson_id integer,
    language_id character(2),
    translation_title character varying(255),
    translation_description text
);


ALTER TABLE public.whatson_translations OWNER TO navicom;

--
-- Name: whatson_translations_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE whatson_translations_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.whatson_translations_translation_id_seq OWNER TO navicom;

--
-- Name: whatson_translations_translation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE whatson_translations_translation_id_seq OWNED BY whatson_translations.translation_id;


--
-- Name: zones; Type: TABLE; Schema: public; Owner: navicom; Tablespace: 
--

CREATE TABLE zones (
    zone_id integer NOT NULL,
    zone_name character varying(50),
    zone_description text,
    zone_enabled integer DEFAULT 0
);


ALTER TABLE public.zones OWNER TO navicom;

--
-- Name: zones_zone_id_seq; Type: SEQUENCE; Schema: public; Owner: navicom
--

CREATE SEQUENCE zones_zone_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.zones_zone_id_seq OWNER TO navicom;

--
-- Name: zones_zone_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: navicom
--

ALTER SEQUENCE zones_zone_id_seq OWNED BY zones.zone_id;


--
-- Name: ads_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY ads ALTER COLUMN ads_id SET DEFAULT nextval('ads_seq'::regclass);


--
-- Name: ads_location_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY ads_locations ALTER COLUMN ads_location_id SET DEFAULT nextval('ads_locations_seq'::regclass);


--
-- Name: fids_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY airport_fids ALTER COLUMN fids_id SET DEFAULT nextval('airport_fids_fids_id_seq'::regclass);


--
-- Name: airport_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY airports ALTER COLUMN airport_id SET DEFAULT nextval('airports_airport_id_seq'::regclass);


--
-- Name: browsers_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY browsers ALTER COLUMN browsers_id SET DEFAULT nextval('browsers_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY business_center_translations ALTER COLUMN translation_id SET DEFAULT nextval('business_center_translations_translation_id_seq'::regclass);


--
-- Name: business_centers_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY business_centers ALTER COLUMN business_centers_id SET DEFAULT nextval('business_centers_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY car_rental_translations ALTER COLUMN translation_id SET DEFAULT nextval('car_rental_translations_translation_id_seq'::regclass);


--
-- Name: car_rentals_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY car_rentals ALTER COLUMN car_rentals_id SET DEFAULT nextval('car_rentals_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY car_translations ALTER COLUMN translation_id SET DEFAULT nextval('car_translations_translation_id_seq'::regclass);


--
-- Name: car_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY cars ALTER COLUMN car_id SET DEFAULT nextval('cars_seq'::regclass);


--
-- Name: contactus_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY contactus ALTER COLUMN contactus_id SET DEFAULT nextval('contactus_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY contactus_translations ALTER COLUMN translation_id SET DEFAULT nextval('contactus_translations_translation_id_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY dining_translations ALTER COLUMN translation_id SET DEFAULT nextval('dining_translations_translation_id_seq'::regclass);


--
-- Name: dinings_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY dinings ALTER COLUMN dinings_id SET DEFAULT nextval('dinings_seq'::regclass);


--
-- Name: directory_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY directories ALTER COLUMN directory_id SET DEFAULT nextval('directories_seq'::regclass);


--
-- Name: directory2_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY directories2 ALTER COLUMN directory2_id SET DEFAULT nextval('directories2_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY directory2_translations ALTER COLUMN translation_id SET DEFAULT nextval('directory2_translations_translation_id_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY directory_promo_translations ALTER COLUMN translation_id SET DEFAULT nextval('directory_promo_translations_seq'::regclass);


--
-- Name: directory_promo_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY directory_promos ALTER COLUMN directory_promo_id SET DEFAULT nextval('directory_promos_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY directory_translations ALTER COLUMN translation_id SET DEFAULT nextval('directory_translations_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY doctor_translations ALTER COLUMN translation_id SET DEFAULT nextval('doctor_translations_translation_id_seq'::regclass);


--
-- Name: doctors_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY doctors ALTER COLUMN doctors_id SET DEFAULT nextval('doctors_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY drop_pickup_translations ALTER COLUMN translation_id SET DEFAULT nextval('drop_pickup_translations_translation_id_seq'::regclass);


--
-- Name: drop_pickups_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY drop_pickups ALTER COLUMN drop_pickups_id SET DEFAULT nextval('drop_pickups_seq'::regclass);


--
-- Name: emergency_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY emergencies ALTER COLUMN emergency_id SET DEFAULT nextval('emergencies_emergency_id_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY forget_translations ALTER COLUMN translation_id SET DEFAULT nextval('forget_translations_translation_id_seq'::regclass);


--
-- Name: forgets_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY forgets ALTER COLUMN forgets_id SET DEFAULT nextval('forgets_seq'::regclass);


--
-- Name: galleries_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY galleries ALTER COLUMN galleries_id SET DEFAULT nextval('galleries_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY gallery_translations ALTER COLUMN translation_id SET DEFAULT nextval('gallery_translations_translation_id_seq'::regclass);


--
-- Name: guest_basket_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_baskets ALTER COLUMN guest_basket_id SET DEFAULT nextval('guest_baskets_guest_basket_id_seq'::regclass);


--
-- Name: guest_bill_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_bills ALTER COLUMN guest_bill_id SET DEFAULT nextval('guest_bills_guest_bill_id_seq'::regclass);


--
-- Name: guest_groups_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_groups ALTER COLUMN guest_groups_id SET DEFAULT nextval('guest_groups_seq'::regclass);


--
-- Name: guest_groups_detail_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_groups_detail ALTER COLUMN guest_groups_detail_id SET DEFAULT nextval('guest_groups_detail_guest_groups_detail_id_seq'::regclass);


--
-- Name: guest_groups_info_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_groups_info ALTER COLUMN guest_groups_info_id SET DEFAULT nextval('guest_groups_info_seq'::regclass);


--
-- Name: guest_message_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_messages ALTER COLUMN guest_message_id SET DEFAULT nextval('guest_messages_guest_message_id_seq'::regclass);


--
-- Name: guest_order_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_orders ALTER COLUMN guest_order_id SET DEFAULT nextval('guest_orders_seq'::regclass);


--
-- Name: guest_orders_detail_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_orders_detail ALTER COLUMN guest_orders_detail_id SET DEFAULT nextval('guest_orders_detail_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_request_translations ALTER COLUMN translation_id SET DEFAULT nextval('guest_request_translations_seq'::regclass);


--
-- Name: guest_request_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_requests ALTER COLUMN guest_request_id SET DEFAULT nextval('guest_requests_seq'::regclass);


--
-- Name: guest_services_detail_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY guest_services_detail ALTER COLUMN guest_services_detail_id SET DEFAULT nextval('guest_services_detail_seq'::regclass);


--
-- Name: hotspot_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY hotspots ALTER COLUMN hotspot_id SET DEFAULT nextval('hotspots_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY inhouse_translations ALTER COLUMN translation_id SET DEFAULT nextval('inhouse_translations_translation_id_seq'::regclass);


--
-- Name: inhouses_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY inhouses ALTER COLUMN inhouses_id SET DEFAULT nextval('inhouses_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY interest_translations ALTER COLUMN translation_id SET DEFAULT nextval('interest_translations_translation_id_seq'::regclass);


--
-- Name: interest_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY interests ALTER COLUMN interest_id SET DEFAULT nextval('interests_seq'::regclass);


--
-- Name: laundry_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY laundry ALTER COLUMN laundry_id SET DEFAULT nextval('laundry_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY laundry_translations ALTER COLUMN translation_id SET DEFAULT nextval('laundry_translations_translation_id_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY massage_translations ALTER COLUMN translation_id SET DEFAULT nextval('massage_translations_translation_id_seq'::regclass);


--
-- Name: massage_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY massages ALTER COLUMN massage_id SET DEFAULT nextval('massages_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY meetingevent_translations ALTER COLUMN translation_id SET DEFAULT nextval('meetingevent_translations_translation_id_seq'::regclass);


--
-- Name: meetingevents_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY meetingevents ALTER COLUMN meetingevents_id SET DEFAULT nextval('meetingevents_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY menu_group_translations ALTER COLUMN translation_id SET DEFAULT nextval('menu_group_translations_translation_id_seq'::regclass);


--
-- Name: menu_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY menu_groups ALTER COLUMN menu_group_id SET DEFAULT nextval('menu_groups_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY menu_translations ALTER COLUMN translation_id SET DEFAULT nextval('menu_translations_translation_id_seq'::regclass);


--
-- Name: menu_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY menus ALTER COLUMN menu_id SET DEFAULT nextval('menus_seq'::regclass);


--
-- Name: module_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY modules ALTER COLUMN module_id SET DEFAULT nextval('modules_module_id_seq'::regclass);


--
-- Name: module_detail_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY modules_detail ALTER COLUMN module_detail_id SET DEFAULT nextval('modules_child_module_child_id_seq'::regclass);


--
-- Name: module_detail_cat_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY modules_detail_cat ALTER COLUMN module_detail_cat_id SET DEFAULT nextval('modules_child_cat_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY movie_group_translations ALTER COLUMN translation_id SET DEFAULT nextval('movie_group_translations_translation_id_seq'::regclass);


--
-- Name: movie_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY movie_groupings ALTER COLUMN movie_grouping_id SET DEFAULT nextval('movie_groupings_movie_grouping_id_seq'::regclass);


--
-- Name: movie_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY movie_groups ALTER COLUMN movie_group_id SET DEFAULT nextval('movie_groups_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY movie_translations ALTER COLUMN translation_id SET DEFAULT nextval('movie_translations_translation_id_seq'::regclass);


--
-- Name: movie_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY movies ALTER COLUMN movie_id SET DEFAULT nextval('movies_seq'::regclass);


--
-- Name: node_target_gate_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY node_target_gate_groupings ALTER COLUMN node_target_gate_grouping_id SET DEFAULT nextval('node_target_gate_groupings_node_target_gate_grouping_id_seq'::regclass);


--
-- Name: node_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY nodes ALTER COLUMN node_id SET DEFAULT nextval('nodes_node_id_seq'::regclass);


--
-- Name: occupancy_daily_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY occupancy_daily ALTER COLUMN occupancy_daily_id SET DEFAULT nextval('occupancy_daily_occupancy_daily_id_seq'::regclass);


--
-- Name: occupancy_detail_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY occupancy_detail ALTER COLUMN occupancy_detail_id SET DEFAULT nextval('occupancy_detail_occupancy_detail_id_seq'::regclass);


--
-- Name: outlet_indirect_buffer_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY outlet_indirect_buffer ALTER COLUMN outlet_indirect_buffer_id SET DEFAULT nextval('outlet_indirect_buffer_seq'::regclass);


--
-- Name: page_translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY page_translations ALTER COLUMN page_translation_id SET DEFAULT nextval('page_translations_page_translation_id_seq'::regclass);


--
-- Name: page_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY pages ALTER COLUMN page_id SET DEFAULT nextval('pages_seq'::regclass);


--
-- Name: permission_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY permissions ALTER COLUMN permission_id SET DEFAULT nextval('permissions_permission_id_seq'::regclass);


--
-- Name: popup_schedule_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY popup_promo_schedule ALTER COLUMN popup_schedule_id SET DEFAULT nextval('popup_promo_schedule_id_seq'::regclass);


--
-- Name: popup_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY popup_promos ALTER COLUMN popup_id SET DEFAULT nextval('popup_promos_id_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY publicplace_translations ALTER COLUMN translation_id SET DEFAULT nextval('publicplace_translations_translation_id_seq'::regclass);


--
-- Name: publicplaces_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY publicplaces ALTER COLUMN publicplaces_id SET DEFAULT nextval('publicplaces_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY recreational_translations ALTER COLUMN translation_id SET DEFAULT nextval('recreational_translations_translation_id_seq'::regclass);


--
-- Name: recreationals_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY recreationals ALTER COLUMN recreationals_id SET DEFAULT nextval('recreationals_seq'::regclass);


--
-- Name: room_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY rooms ALTER COLUMN room_id SET DEFAULT nextval('rooms_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY roomsuite_translations ALTER COLUMN translation_id SET DEFAULT nextval('roomsuite_translations_translation_id_seq'::regclass);


--
-- Name: roomsuites_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY roomsuites ALTER COLUMN roomsuites_id SET DEFAULT nextval('roomsuites_seq'::regclass);


--
-- Name: message_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY runningtext_groupings ALTER COLUMN message_grouping_id SET DEFAULT nextval('runningtext_groupings_message_grouping_id_seq1'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY runningtext_translations ALTER COLUMN translation_id SET DEFAULT nextval('runningtext_translations_translation_id_seq1'::regclass);


--
-- Name: message_zone_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY runningtext_zone_groupings ALTER COLUMN message_zone_grouping_id SET DEFAULT nextval('runningtext_zone_groupings_runningtext_zone_grouping_id_seq'::regclass);


--
-- Name: message_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY runningtexts ALTER COLUMN message_id SET DEFAULT nextval('runningtexts_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY service_group_translations ALTER COLUMN translation_id SET DEFAULT nextval('service_group_translations_seq'::regclass);


--
-- Name: service_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY service_groups ALTER COLUMN service_group_id SET DEFAULT nextval('service_groups_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY service_translations ALTER COLUMN translation_id SET DEFAULT nextval('service_translations_seq'::regclass);


--
-- Name: service_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY services ALTER COLUMN service_id SET DEFAULT nextval('services_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY sessions ALTER COLUMN id SET DEFAULT nextval('sessions_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY shop_group_translations ALTER COLUMN translation_id SET DEFAULT nextval('shop_group_translations_translation_id_seq'::regclass);


--
-- Name: shop_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY shop_groups ALTER COLUMN shop_group_id SET DEFAULT nextval('shop_groups_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY shop_translations ALTER COLUMN translation_id SET DEFAULT nextval('shop_translations_translation_id_seq'::regclass);


--
-- Name: shop_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY shops ALTER COLUMN shop_id SET DEFAULT nextval('shops_seq'::regclass);


--
-- Name: signage_ads_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_ads ALTER COLUMN signage_ads_id SET DEFAULT nextval('signage_ads_signage_ads_id_seq'::regclass);


--
-- Name: signage_clip_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_clips ALTER COLUMN signage_clip_id SET DEFAULT nextval('signage_clips_signage_clip_id_seq'::regclass);


--
-- Name: signage_content_schedule_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_content_schedules ALTER COLUMN signage_content_schedule_id SET DEFAULT nextval('signage_content_schedules_seq'::regclass);


--
-- Name: signage_general_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_generals ALTER COLUMN signage_general_id SET DEFAULT nextval('signage_generals_signage_general_id_seq'::regclass);


--
-- Name: signage_image_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_images ALTER COLUMN signage_image_id SET DEFAULT nextval('signage_images_seq'::regclass);


--
-- Name: playlist_content_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_playlist_contents ALTER COLUMN playlist_content_id SET DEFAULT nextval('signage_playlist_contents_seq'::regclass);


--
-- Name: playlist_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_playlists ALTER COLUMN playlist_id SET DEFAULT nextval('signage_playlists_seq'::regclass);


--
-- Name: signage_region_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_region_groupings ALTER COLUMN signage_region_grouping_id SET DEFAULT nextval('signage_region_groupings_signage_region_grouping_id_seq'::regclass);


--
-- Name: region_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_regions ALTER COLUMN region_id SET DEFAULT nextval('signage_regions_seq'::regclass);


--
-- Name: signage_room_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_room_groupings ALTER COLUMN signage_room_grouping_id SET DEFAULT nextval('signage_room_groupings_signage_room_grouping_id_seq'::regclass);


--
-- Name: template_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_templates ALTER COLUMN template_id SET DEFAULT nextval('signage_templates_template_id_seq'::regclass);


--
-- Name: signage_urgency_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_urgencies ALTER COLUMN signage_urgency_id SET DEFAULT nextval('signage_urgencies_signage_urgency_id_seq'::regclass);


--
-- Name: signage_urgency_room_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_urgency_room_groupings ALTER COLUMN signage_urgency_room_grouping_id SET DEFAULT nextval('signage_urgency_room_grouping_signage_urgency_room_grouping_seq'::regclass);


--
-- Name: signage_urgency_zone_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_urgency_zone_groupings ALTER COLUMN signage_urgency_zone_grouping_id SET DEFAULT nextval('signage_urgency_zone_grouping_signage_urgency_zone_grouping_seq'::regclass);


--
-- Name: signage_zone_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signage_zone_groupings ALTER COLUMN signage_zone_grouping_id SET DEFAULT nextval('signage_zone_groupings_signage_zone_grouping_id_seq'::regclass);


--
-- Name: signage_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY signages ALTER COLUMN signage_id SET DEFAULT nextval('signages_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY souvernir_group_translations ALTER COLUMN translation_id SET DEFAULT nextval('souvernir_group_translations_translation_id_seq'::regclass);


--
-- Name: souvernir_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY souvernir_groups ALTER COLUMN souvernir_group_id SET DEFAULT nextval('souvernir_groups_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY souvernir_translations ALTER COLUMN translation_id SET DEFAULT nextval('souvernir_translations_translation_id_seq'::regclass);


--
-- Name: souvernir_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY souvernirs ALTER COLUMN souvernir_id SET DEFAULT nextval('souvernirs_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY spa_group_translations ALTER COLUMN translation_id SET DEFAULT nextval('spa_group_translations_translation_id_seq'::regclass);


--
-- Name: spa_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY spa_groups ALTER COLUMN spa_group_id SET DEFAULT nextval('spa_groups_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY spa_translations ALTER COLUMN translation_id SET DEFAULT nextval('spa_translations_seq'::regclass);


--
-- Name: spa_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY spas ALTER COLUMN spa_id SET DEFAULT nextval('spas_seq'::regclass);


--
-- Name: style_schedule_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY style_schedules ALTER COLUMN style_schedule_id SET DEFAULT nextval('style_schedules_style_schedule_id_seq'::regclass);


--
-- Name: style_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY styles ALTER COLUMN style_id SET DEFAULT nextval('styles_style_id_seq'::regclass);


--
-- Name: sync_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY sync_flag ALTER COLUMN sync_id SET DEFAULT nextval('sync_flag_sync_id_seq'::regclass);


--
-- Name: target_gate_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY target_gates ALTER COLUMN target_gate_id SET DEFAULT nextval('target_gates_target_gate_id_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY teraphist_translations ALTER COLUMN translation_id SET DEFAULT nextval('teraphist_translations_translation_id_seq'::regclass);


--
-- Name: teraphist_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY teraphists ALTER COLUMN teraphist_id SET DEFAULT nextval('teraphists_seq'::regclass);


--
-- Name: theme_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY themes ALTER COLUMN theme_id SET DEFAULT nextval('themes_theme_id_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tour_group_translations ALTER COLUMN translation_id SET DEFAULT nextval('tour_group_translations_seq'::regclass);


--
-- Name: tour_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tour_groups ALTER COLUMN tour_group_id SET DEFAULT nextval('tour_groups_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tour_translations ALTER COLUMN translation_id SET DEFAULT nextval('tour_translations_translation_id_seq'::regclass);


--
-- Name: tour_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tours ALTER COLUMN tour_id SET DEFAULT nextval('tours_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tv_channel_group_translations ALTER COLUMN translation_id SET DEFAULT nextval('tv_channel_group_translations_translation_id_seq'::regclass);


--
-- Name: tv_channel_grouping_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tv_channel_groupings ALTER COLUMN tv_channel_grouping_id SET DEFAULT nextval('tv_channel_groupings_tv_channel_grouping_id_seq'::regclass);


--
-- Name: tv_channel_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tv_channel_groups ALTER COLUMN tv_channel_group_id SET DEFAULT nextval('tv_channel_groups_seq'::regclass);


--
-- Name: tv_channel_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tv_channels ALTER COLUMN tv_channel_id SET DEFAULT nextval('tv_channels_seq'::regclass);


--
-- Name: tv_promo_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY tv_promos ALTER COLUMN tv_promo_id SET DEFAULT nextval('tv_promos_tv_promo_id_seq'::regclass);


--
-- Name: user_group_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY user_groups ALTER COLUMN user_group_id SET DEFAULT nextval('user_groups_user_group_id_seq'::regclass);


--
-- Name: user_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY users ALTER COLUMN user_id SET DEFAULT nextval('users_user_id_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY wakeup_call_translations ALTER COLUMN translation_id SET DEFAULT nextval('wakeup_call_translations_translation_id_seq'::regclass);


--
-- Name: wakeup_calls_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY wakeup_calls ALTER COLUMN wakeup_calls_id SET DEFAULT nextval('wakeup_calls_seq'::regclass);


--
-- Name: weather_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY weather ALTER COLUMN weather_id SET DEFAULT nextval('weather_seq'::regclass);


--
-- Name: whatson_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY whatson ALTER COLUMN whatson_id SET DEFAULT nextval('whatson_seq'::regclass);


--
-- Name: translation_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY whatson_translations ALTER COLUMN translation_id SET DEFAULT nextval('whatson_translations_translation_id_seq'::regclass);


--
-- Name: zone_id; Type: DEFAULT; Schema: public; Owner: navicom
--

ALTER TABLE ONLY zones ALTER COLUMN zone_id SET DEFAULT nextval('zones_zone_id_seq'::regclass);


--
-- Data for Name: __sessions; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY __sessions (session_id, session_user_id, session_start, session_time, session_ip, session_browser, session_username, session_mac, session_module, session_node_id) FROM stdin;
d3176f06917c186ee5a76a2d5b1b2bbf	1	1400809864	1400809864	127.0.0.1	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0	Navicom Root, root	00:00:00:00:00:00	Priviledges	0
38465d61e009f1c76d2c6115eb18ebae	0	1398150986	1398150986	192.168.0.109	Mozilla/5.0 (Linux; Android 4.2.2; POLYTRON_R3500 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.166 Mobile Safari/537.36	Android Yudi	8c:c5:e1:1d:15:da	Dashboard	14
8e5e92d36bba9f7dadc5b307e5741847	6	1409754517	1409754517	127.0.0.1	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0	Admin, admin	00:00:00:00:00:00	Page	0
3d7679b0d7314f8e2a04115b5bd536c7	0	1397700101	1397700101	192.168.0.128	Mozilla/5.0 (Linux; U; Android 4.2.2;en-us; Lenovo B8000-H/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2.2 Mobile Safari/534.30	Android	50:3c:c4:38:f2:b0	Dashboard	12
a000a7a1bce81371cb3c638327d54217	0	1397700129	1397700129	192.168.0.129	Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; GT-I8262 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30	Daeng Android	18:26:66:b1:56:2f	Dashboard	13
e017d4658c5d3433e3a6e5245417912e	0	1398649391	1398649391	192.168.0.104	Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36	Yudi Laptop	74:2f:68:d4:fb:08	Dashboard	16
ee77d57effba4f3c3bb6f387c5107f1a	0	1398156824	1398156824	192.168.0.247	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	STB-26	00:00:a2:00:06:c9		15
b7289d3ee714e6928c8aaedf50e6971b	0	1397143218	1397143218	192.168.0.31	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	STB Uji Coba 5	00:00:a1:00:03:d6		10
4d58182a7fdb1c670ef17117c7d7d662	0	1398741013	1398741013	192.168.0.247	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	STB-25	00:00:a2:00:00:fe	Dashboard	9
992c3865adbedf1eaf66a4d039fc224c	0	1424767308	1424767308	192.168.0.29	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0	sendy lenovo	28:d2:44:f4:b4:0a	Dashboard	19
10d47a94d56afb91b18c8f1c4ff7d115	0	1427454052	1427454052	192.168.0.247	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	STB-1	00:00:a1:00:02:f0		8
4f4c4ee83c23dc9ff8fe885d4d744366	0	1427082603	1427082603	192.168.0.248	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	STB-8	00:00:a1:00:07:f5		2
32a8cf0fa0308d19a6f8091633d2e609	0	1427814265	1427814265	192.168.0.247	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	STB-9	00:00:a1:00:03:37		11
291d9d28d45ceb73378958351fdeb6ce	0	1427958663	1427958663	192.168.0.100	Mozilla/5.0 (Linux; Android 4.2.2; R831K Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96 Mobile Safari/537.36	stb-202	00:00:a1:00:06:6c		7
4e5b043a04747057430112ba98621d4c	0	1427958698	1427958698	192.168.0.17	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0	L	28:d2:44:f4:b4:0a		1
52864878b0ff1ab7c8a59e8f1a5d5f4b	5	1428841131	1428841131	::1	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0	Roberto Tonjaw, tonjaw		Nodes/STB	0
f1d7a992470b27e3c834e261ca294305	0	1427852329	1427852329	127.0.0.1	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0	localhost	00:00:00:00:00:00		18
c0df9cb21c2718662dec9acef6d0533b	0	1427958588	1427958588	192.168.0.248	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	stb-201	00:00:a2:00:02:f1		6
\.


--
-- Data for Name: _testing; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY _testing (testing_no, testing_name) FROM stdin;
27	0::1031
2	0::1022
\.


--
-- Data for Name: ads; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY ads (ads_id, ads_location_id, ads_type, ads_image, ads_text, ads_clip, ads_start, ads_end, ads_defunct) FROM stdin;
\.


--
-- Data for Name: ads_counter; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY ads_counter (ads_counter_id, ads_id, ads_counter_value, node_id) FROM stdin;
\.


--
-- Data for Name: ads_locations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY ads_locations (ads_location_id, ads_location_type, ads_location_name, ads_location_description, ads_location_price, ads_location_price_unit, ads_location_enabled) FROM stdin;
\.


--
-- Name: ads_locations_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('ads_locations_seq', 1, false);


--
-- Name: ads_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('ads_seq', 1, false);


--
-- Data for Name: airport_fids; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY airport_fids (fids_id, airport_id, fids_flight, fids_airline_code, fids_airline, fids_city, fids_time, fids_terminal, fids_gate, fids_type, fids_remark, fids_lastupdate) FROM stdin;
161	1	GA 713	GA	Garuda Indonesia	Jakarta CGK	00:40	2	9	1	On Time	1414029602
162	1	JT 300	JT	Lion Air	Surabaya	00:17	1	E	1	Delayed	1414029602
163	1	QZ 922	QZ	Air Asia	Singapore	00:30	2	7	1	Departed	1414029602
164	1	SJ 442	SJ	Sriwijaya Air	Jakarta CGK	00:45	2	5	1	Departed	1414029602
165	1	QZ 467	QZ	Air Asia	Bangkok	00:50	2	3	1	Departed	1414029602
166	1	GA 217	GA	Garuda Indonesia	Medan	01:03	1	1	1	Boarding	1414029602
167	1	JT 3212	JT	Lion Air	Banjarmasin	01:15	2	4	1	Delayed	1414029602
168	1	ID 2250	ID	Batik Air	Jakarta CGK	01:10	1	7	1	Boarding	1414029602
169	1	QG 340	QG	Citilink	Jakarta HLP	01:15	2	6	1	Boarding	1414029602
170	1	JT 220	JT	Lion Air	Pekanbaru	01:27	2	2	1	Boarding	1414029602
171	1	GA 109	GA	Garuda Indonesia	Surabaya	01:30	1	10	1	Check-In	1414029602
172	1	IW 808	IW	Wings Air	Jakarta CGK	01:50	1	1	1	Check-In	1414029602
173	1	QZ 201	QZ	Air Asia	Yogyakarta	01:50	2	8	1	Boarding	1414029602
174	1	QZ 455	QZ	Air Asia	Kuala Lumpur	01:50	1	4	1	Boarding	1414029602
175	1	JT 676	JT	Lion Air	Ambon	02:05	1	9	1	Check-In	1414029602
176	1	QG 224	QG	Citilink	Yogyakarta	02:20	2	3	1	Delayed	1414029602
177	1	IW 772	IW	Wings Air	Jakarta CGK	02:30	1	7	1	Check-In	1414029602
178	1	TR 2279	TR	Tiger Air	Singapore	02:45	2	6	1	Check-In	1414029602
179	1	GA 5621	GA	Garuda Indonesia	Manado	02:55	1	8	1	Check-In	1414029602
180	1	SJ 455	SJ	Sriwijaya Air	Pekanbaru	03:10	2	3	1	Delayed	1414029602
181	1	GA 712	GA	Garuda Indonesia	Jakarta CGK	00:10	2	2	0	Landed	1414029602
182	1	JT 300	JT	Lion Air	Surabaya	00:17	1	E	0	Delayed	1414029602
183	1	GA 433	GA	Garuda Indonesia	Jakarta CGK	00:20	2	8	0	Landed	1414029602
184	1	QZ 8911	QZ	Air Asia	Bandung	00:25	1	5	0	Landed	1414029602
185	1	SJ 231	SJ	Sriwijaya Air	Jakarta CGK	00:27	2	1	0	Delayed	1414029602
186	1	QG 9882	QG	Citilink	Jakarta CGK	00:30	2	3	0	Landed	1414029602
187	1	JT 288	JT	Lion Air	Medan	00:35	1	7	0	Delayed	1414029602
188	1	JT 776	JT	Lion Air	Surabaya	00:38	2	3	0	Landed	1414029602
189	1	QZ 656	QZ	Air Asia	Kuala Lumpur	00:42	2	10	0	Landed	1414029602
190	1	GA 117	GA	Garuda Indonesia	Makasar	01:10	2	2	0	Delayed	1414029602
191	1	QG 7612	QG	Citilink	Semarang	01:22	1	2	0	Landed	1414029602
192	1	ID 812	ID	Batik Air	Jakarta CGK	01:23	2	4	0	Landed	1414029602
193	1	SJ 889	SJ	Sriwijaya Air	Lampung	01:26	2	9	0	Landed	1414029602
194	1	IW 1330	IW	Wings Air	Jakarta CGK	01:30	2	6	0	Delayed	1414029602
195	1	QZ 7886	QZ	Air Asia	Balikpapan	01:43	1	9	0	Delayed	1414029602
196	1	JT 212	JT	Lion Air	Makasar	02:00	2	12	0	Delayed	1414029602
197	1	GA 992	GA	Garuda Indonesia	Manado	02:10	1	7	0	Landed	1414029602
198	1	QG 388	QG	Citilink	Bandung	02:15	1	2	0	Landed	1414029602
199	1	XN 832	XN	Xpress Air	Jakarta CGK	02:35	1	5	0	Delayed	1414029602
200	1	QZ 834	QZ	Air Asia	Bangkok	02:40	2	7	0	Landed	1414029602
\.


--
-- Name: airport_fids_fids_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('airport_fids_fids_id_seq', 200, true);


--
-- Data for Name: airports; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY airports (airport_id, airport_code, airport_name, airport_description, airport_enabled) FROM stdin;
1	DPS	Ngurah Rai International Airport	Denpasar - Bali - Indonesia	1
2	CGK	Soekarno-Hatta International Airport	Cengkareng - Jakarta - Indonesia	0
\.


--
-- Name: airports_airport_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('airports_airport_id_seq', 2, true);


--
-- Data for Name: browsers; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY browsers (browsers_id, browsers_name, browsers_description, browsers_enabled) FROM stdin;
\.


--
-- Name: browsers_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('browsers_seq', 1, false);


--
-- Data for Name: business_center_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY business_center_translations (translation_id, business_centers_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
7	1	  		
8	1	  		
9	1	  		
10	1	  		
3	1	en	Business Center	
11	1	  		
5	1	id	Pusat Bisnis	
6	1	jp	ビジネスセンター	
12	1	  		
13	1	  		
\.


--
-- Name: business_center_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('business_center_translations_translation_id_seq', 13, true);


--
-- Data for Name: business_centers; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY business_centers (business_centers_id, business_centers_image, business_centers_image_enabled, business_centers_clip, business_centers_clip_enabled, business_centers_enabled, business_centers_order) FROM stdin;
1	business-center	0		0	1	1
\.


--
-- Name: business_centers_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('business_centers_seq', 1, true);


--
-- Data for Name: car_rental_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY car_rental_translations (translation_id, car_rentals_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
3	1	en	Car Rental	
4	1	  		
5	1	id	Rental Mobil	
6	1	jp	レンタカー	
7	1	  		
8	1	  		
\.


--
-- Name: car_rental_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('car_rental_translations_translation_id_seq', 8, true);


--
-- Data for Name: car_rentals; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY car_rentals (car_rentals_id, car_rentals_image, car_rentals_image_enabled, car_rentals_clip, car_rentals_clip_enabled, car_rentals_enabled, car_rentals_order) FROM stdin;
1	car-rental	0		0	1	1
\.


--
-- Name: car_rentals_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('car_rentals_seq', 1, true);


--
-- Data for Name: car_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY car_translations (translation_id, car_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	de	Bus	
3	1	en	Bus	
4	1	fr	Bus	
5	1	id	Bis	
6	1	  		
7	1	  		
8	1	ru	Bus	
9	2	  		
10	2	de	Alphard	
11	2	en	Alphard	
12	2	fr	Alphard	
13	2	id	Alphard	
14	2	jp	Alphard	
15	2	  		
16	2	ru	Alphard	
\.


--
-- Name: car_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('car_translations_translation_id_seq', 16, true);


--
-- Data for Name: cars; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY cars (car_id, car_thumbnail, car_enabled) FROM stdin;
1	bus.jpg	1
2		1
\.


--
-- Name: cars_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('cars_seq', 2, true);


--
-- Data for Name: contactus; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY contactus (contactus_id, contactus_image, contactus_image_enabled, contactus_clip, contactus_clip_enabled, contactus_enabled, contactus_order) FROM stdin;
2	pleasecall-ext2	0		0	0	2
1	contactus	0		0	1	1
\.


--
-- Name: contactus_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('contactus_seq', 2, true);


--
-- Data for Name: contactus_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY contactus_translations (translation_id, contactus_id, language_id, translation_title, translation_description) FROM stdin;
2	1	  		
4	1	  		
6	1	jp	お問い合わせ	
7	1	  		
8	1	  		
9	2	  		
12	2	  		
13	2	  		
10	2	en	Contact Us	
11	2	id	Hubungi Kami	
14	2	  		
15	1	  		
1	1	cn	联系我们	
3	1	en	Contact Us	
5	1	id	Hubungi Kami	
17	1	  		
16	1	kr		
\.


--
-- Name: contactus_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('contactus_translations_translation_id_seq', 17, true);


--
-- Data for Name: dining_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY dining_translations (translation_id, dinings_id, language_id, translation_title, translation_description) FROM stdin;
1	2	  		
2	2	  		
4	2	  		
7	2	  		
8	2	  		
9	3	  		
10	3	  		
12	3	  		
15	3	  		
16	3	  		
17	2	  		
18	2	  		
19	2	  		
20	2	  		
21	2	  		
23	2	  		
6	2	jp	イベントクラブプレミアラウンジ	多忙な一日を過ごした後、リラックスして、私たちのクラブプレミアラウンジでおくつろぎください。 22階に位置し、ラウンジでは、街のスカイラインの素晴らしい景色を楽しんで、ライブジャズの滑らかな音に溝切りながらから選択するための素晴らしい雰囲気は、飲料の完全なメニューを友人やビジネスパートナーを満たすために用意されています。&lt;br/&gt;\n&lt;br/&gt;\n&lt;b&gt;からオープン06.00 - 01.00&lt;/b&gt;
24	2	  		
34	2	  		
25	2	  		
26	2	  		
28	3	  		
29	3	  		
14	3	jp	Kicir-Kicirレストラン	その温かく居心地の良い内装の、私たちのKicir-kicirレストランでは、インドネシアや世界の料理のおいしそうな選択を提供しています。便利なロビーの隣に位置し、レストランは24時間快適に198名まで収容オープンしています。&lt;br/&gt;\n&lt;br/&gt;\n朝食ビュッフェ&lt;BR/&gt;の私達の幅広い選択とここにあなたの良い朝を開始\n&lt;br/&gt;\n朝食ビュッフェ：06.00から10.30&lt;br/&gt;\n&lt;br/&gt;\n24時間利用可能なアラカルトメニュー
30	3	  		
31	3	  		
32	2	  		
33	2	  		
35	2	  		
36	4	cn	联系我们	
37	4	  		
38	4	en	Contact Us	
39	4	  		
40	4	id	Hubungi Kami	
41	4	jp	お問い合わせ	
42	4	  		
43	4	  		
44	2	  		
45	2	  		
46	3	  		
47	3	  		
48	2	  		
22	2	cn	Kunyit	Kunyit餐廳提供巴厘島與最道地的文化。研發非常著名的“megibung”作為傳統的巴厘飲食風格，Kunyit提供每日早餐，午餐和晚餐從上午六點至十點半。
49	2	  		
50	3	  		
3	2	en	Kunyit Restaurant	Bali and its culture are best provided in Kunyit Restaurant. Developing very well known “megibung” as Balinese traditional eating style, Kunyit available for Breakfast, Lunch and Dinner from 6.00 am to 10. 30 pm daily.\n\nShould you interest to make a dining reservation at Kunyit Restaurant, kindly contact our Guest Service by dialing extension '0'
56	3	  		
51	3	  		
52	3	  		
27	3	cn	海沙	專注在新鮮度，海沙餐廳的全天營業的互動體驗，結合了開放式廚房的概念與特地營造當地市集的氣氛，客人可以在非常專業的廚師一起烹煮菜餚。提供每日早餐，午餐和晚餐。營業時早上六點到晚上十一點，在下午時是點心的概念。
11	3	en	Sands Restaurant	With emphasis on freshness, Sands Restaurant’s all day dining interactive experience incorporates an open kitchen concept and market place atmosphere where guests can cook together with highly skilled chefs.&lt;br/&gt;&lt;br/&gt; Available for breakfast, lunch and Dinner between 6.00 am and 11.00 pm daily, with touches of Tapas served in the afternoons.\n\nShould you interest to make a dining reservation at Sands Restaurant, kindly contact our Guest Service by dialing extension '0'.
53	3	  		
5	2	id	Kunyit Restaurant	Cita rasa asli dari budaya Bali dan Indonesia dalam pilihan terbaik tersedia di Kunyit Restaurant. Mengangkat tema “Megibung” sebagai budaya tradisional yang turun temurun masih dilakukan di Bali dengan makan bersama-sama, Kunyit Restaurant tersedia untuk sarapan pagi, makan siang dan juga makan malam dari pukul 6.00 pagi hingga puluk 10.30 malam.\n\nSilahkan menghubungi Guest Service di ekstensi '0' apabila Anda ingin memesan meja di Kunyit Restaurant.
55	2	kr	Kunyit 발리	발리와 발리의 문화는 Kunyit Restaurant에서 가장 잘 제공됩니다. 발리 전통 식사 예절로 유명한 “megibung”을 가장 잘 계승해왔으며, Kunyit Restaurant에서는 아침, 점심, 저녁식사를 매일 오전 6시부터 오후 10:30까지 제공해 드립니다. &lt;br&gt;&lt;br&gt;\nKunyit Restaurant에서의 저녁식사 예약에 관심을 가지고 계시면, 내선번호 0번을 누르시고 Guest Service에 연락해 주시기 바랍니다.
54	2	  		
13	3	id	Sands Restaurant	Sands Restoran menyajikan kesegaran baru dengan konsep open kitchen dan pasar senggol dimana pengunjung dapat berinteraksi dan memiliki pengalaman memasak bersama Chef The Anvaya. &lt;br/&gt;&lt;br/&gt;Tersedia untuk sarapan pagi, makan siang dan makan malam, Sands Restoran beroperasi dari pukul 6 pagi hingga pukul 11 malam dengan special menu Tapas yang di sajikan pada sore hari.\n\nSilahkan menghubungi Guest Service kami di ekstensi '0' apabila Anda ingin memesan meja di Sands Restaurant.
58	3	  		
82	5	cn	Lobby Lounge	在巴厘島ANVAYA海灘度假村的大堂酒廊，是為了與人連結的地方。酒店大堂眺望花園，連接湖和主要游泳池的壯麗景色。訂製為那些與西方和本地的元素結合的小吃，包括糕點和甜品，而當地特色的下午茶是不容錯過。從每天上午凌晨1時至天凌晨5時，大堂酒廊的獨特設計，為早晨提前退房與延遲退房的客人提供早餐。
59	2	  		
60	2	  		
61	2	  		
62	2	  		
63	2	  		
64	2	  		
65	2	  		
66	2	  		
67	2	  		
68	2	  		
69	2	  		
70	2	  		
71	2	  		
72	2	  		
73	2	  		
74	3	  		
83	5	en	Lobby Lounge	The Lobby Lounge of The ANVAYA Beach Resort- Bali, is the place to meet and be seen. Located in the main Lobby of the resort featuring stunning views of the garden, lagoons and main swimming pool. &lt;br/&gt;&lt;br/&gt;Crafted for those looking for both western and locally influenced light snacks, including pastries and sweets, while a locally infused High Tea is not to be missed. &lt;br/&gt;&lt;br/&gt;\nAvailable from 9.00 am to 12.00 am midnight, the unique design of the Lobby Lounge offers breakfast for guests departing early while for guests with late departures.
75	3	  		
84	5	id	Lobby Lounge	Lobby Lounge The Anvaya Beach Resort Bali merupakan tempat untuk bertemu atau sekilas menyapa. Tempat ini menawarkan pemandangan yang indah ke arah taman, kolam renang lagoon dan kolam renang di tengah taman. &lt;br/&gt;&lt;br/&gt;Bagi Anda yang menyukai teh dan kopi pada sore hari, nikmati kesegaran jajanan bali termasuk juga sajian roti untuk sore yang lebih menyenangkan. &lt;br/&gt;&lt;br/&gt;Lobby Lounge dengan desain yang unik beroperasi dari pukul 9 pagi hingga pukul 12 malam, juga menyiapkan kotak makan untuk tamu yang check out lebih awal atau tamu yang check in di larut malam.
76	3	  		
87	5	  		
77	3	  		
92	5	  		
78	3	  		
88	2	  		
79	3	  		
89	2	  		
80	2	  		
81	3	  		
86	5	kr	Lobby Lounge	
85	5	  		
101	5	  		
102	5	  		
103	2	  		
90	5	  		
91	3	  		
57	3	kr	샌즈 &amp; 와인 셀라	특산품 : 타파스 보완 캘리포니아 스타일의 요리와 이국적인 향토 요리. &lt;BR/&gt; 가능 : 07.00-23.00 &lt;br/&gt; 서빙 : 아침 식사, 점심 식사, 저녁 식사 &lt;br/&gt; &lt;br/&gt; 총 좌석 수 : 340 &lt;br/&gt; 야외 좌석 수 : 154 &lt;br/&gt; 갑판 좌석에 : 비치 좌석 &lt;br/&gt; 64 : 46 &lt;br/&gt; 테라스 좌석 : 문 좌석에서 16 &lt;br/&gt; : 186 &lt;br/&gt; 바 좌석 수 : 18
93	2	  		
94	2	  		
95	2	  		
96	2	  		
97	3	  		
98	3	  		
99	5	  		
100	5	  		
\.


--
-- Name: dining_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('dining_translations_translation_id_seq', 103, true);


--
-- Data for Name: dinings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY dinings (dinings_id, dinings_image, dinings_image_enabled, dinings_clip, dinings_clip_enabled, dinings_enabled, dinings_order) FROM stdin;
3	sands	0		0	1	2
5	lobbylounge	0		0	1	3
2	kunyit	0		0	1	1
\.


--
-- Name: dinings_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('dinings_seq', 5, true);


--
-- Data for Name: directories; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY directories (directory_id, directory_image, directory_image_enabled, directory_clip, directory_clip_enabled, directory_enabled, directory_order) FROM stdin;
3	amartapura-ballroom	0		0	1	2
5	rooftop-swimming-pool	0		0	1	3
1	swimmingpool	0		0	1	4
2	beach	0		0	1	1
\.


--
-- Data for Name: directories2; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY directories2 (directory2_id, directory2_image, directory2_image_enabled, directory2_clip, directory2_clip_enabled, directory2_enabled, directory2_order) FROM stdin;
\.


--
-- Name: directories2_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('directories2_seq', 1, false);


--
-- Name: directories_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('directories_seq', 10, true);


--
-- Data for Name: directory2_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY directory2_translations (translation_id, directory2_id, language_id, translation_title, translation_description) FROM stdin;
\.


--
-- Name: directory2_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('directory2_translations_translation_id_seq', 1, false);


--
-- Data for Name: directory_promo_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY directory_promo_translations (translation_id, directory_promo_id, language_id, translation_title, translation_description) FROM stdin;
9	2	  		
14	2	  		
15	2	  		
17	2	  		
10	2	de	Promo 1	
11	2	en	Promo 1	
12	2	fr	Promo 1	
13	2	id	Promo 1	
18	2	  		
19	2	  		
16	2	ru	Promo 1	
20	3	  		
25	3	  		
26	3	  		
28	4	  		
29	4	de	Promo3	
30	4	en	Promo3	
31	4	fr	Promo3	
32	4	id	Promo3	
33	4	  		
34	4	  		
35	4	ru	Promo3	
36	3	  		
21	3	de	Promo2	
22	3	en	Promo2	
23	3	fr	Promo2	
24	3	id	Promo2	
37	3	  		
38	3	  		
27	3	ru	Promo2	
39	5	  		
40	5	de	Promo4	
41	5	en	Promo4	
42	5	fr	Promo4	
43	5	id	Promo4	
44	5	  		
45	5	  		
46	5	ru	Promo4	
47	6	  		
48	6	de	Promo5	
49	6	en	Promo5	
50	6	fr	Promo5	
51	6	id	Promo5	
52	6	  		
53	6	  		
54	6	ru	Promo5	
55	7	  		
56	7	de	Promo6	
57	7	en	Promo6	
58	7	fr	Promo6	
59	7	id	Promo6	
60	7	  		
61	7	  		
62	7	ru	Promo6	
\.


--
-- Name: directory_promo_translations_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('directory_promo_translations_seq', 62, true);


--
-- Data for Name: directory_promos; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY directory_promos (directory_promo_id, directory_promo_image, directory_promo_image_enabled, directory_promo_clip, directory_promo_clip_enabled, directory_promo_order, directory_promo_enabled) FROM stdin;
2	promo1	0		0	1	1
4	promo3	0		0	3	1
3	promo2	0		0	2	1
5	promo4	0		0	4	1
6	promo5	0		0	5	1
7	promo6	0		0	6	1
\.


--
-- Name: directory_promos_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('directory_promos_seq', 7, true);


--
-- Data for Name: directory_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY directory_translations (translation_id, directory_id, language_id, translation_title, translation_description) FROM stdin;
20	3	fr	Club House	Exclusivement nommés et prévu pour Regent Résidences seulement, le Club House est conçu pour compléter tous les événements spéciaux et les rassemblements. Gracieusement style dans un style classique et entièrement équipée avec une salle de réception polyvalente spacieuse et installation de garde-manger moderne, il est situé dans une zone de jardins luxuriants verts complets avec des caractéristiques de l'eau sophistiqués.
10	2	de	Golden Beach	Ein 200 Meter von semi-private swimmable goldenen Sandstrand an der Vorderseite des Resorts ist mit Liegestühlen und hallo-Speed-Breitband-und WiFi-Internetzugang ausgestattet.
24	3	ru	Club House	Исключительно назначен и предусмотрено Regent Резиденции только, Club House призвана дополнить все специальные мероприятия и собрания. Любезно стиле в классическом стиле и полностью оснащены просторной многоцелевой зал приема и современной кладовой объекта, он установлен на площади в пышной зелени садов, полных сложных функций воды.
5	1	fr	Suite Premier	4 unités de suite spacieuse 136m² donnant sur jardin et caractéristiques de l'eau verdoyantes et 4 unités de suite spacieuse 136m² donnant sur l'île de Nusa Lembongan et l'océan Indien.
31	4	kr	결혼식	뷔페로 구성된 전채, 수프, 메인 코스, 디저트, 음식 노점 (최소 보증에 해당 각 30 %)
17	3	cn	Paseban休息室	有现场音乐演奏万隆最令人惊叹的时尚聚集地，报答你的感官，从我们无尽的鸡尾酒，党和放松，而我们的现场乐队整个晚上进行。在Paseban你将踏上这堆高的感官之旅。
18	3	de	Club House	Exklusiv eingerichtete und sofern für Regent Residences nur das Clubhaus ist für alle Veranstaltungen und Versammlungen zu ergänzen. Gnädig im klassischen Stil und mit einem großzügigen Mehrzweckempfangsraum und moderne Speisekammer Anlage voll ausgestattete, es auf einer Fläche von üppigen grünen Gärten mit Wasserspielen anspruchsvolle gestylt.
40	5	ru	Deluxe Suite	53 единиц большой 90sqm люкс с видом пышных зеленых садовых и водных объектов и 25 единиц большой 90sqm люкс с видом на остров Нуса Лембонган и Индийском океане.
8	1	ru	Премьер Люкс	4 единицы просторном люксе 136sqm с видом пышных зеленых садовых и водных объектов и 4 единицы просторном люксе 136sqm с видом на остров Нуса Лембонган и Индийском океане.
19	3	en	Club House	Exclusively appointed and provided for Regent Residences only, the Club House is designed to complement all special events and gatherings. Graciously styled in classic style and fully-equipped with a spacious multi-purpose reception room and modern pantry facility, it is set in an area of lush green gardens complete with sophisticated water features.
22	3	jp	Pasebanラウンジ	ライブミュージック毎晩バンドンで最も驚くほどスタイリッシュな集いの場で、私たちの無限のカクテルメニュー、当事者からあなたの感覚を報いる私たちのライブバンド、夜を通して行いながらリラックス。 Pasebanであなたの五感を盛り上げ旅に乗り出す。
38	5	jp	ミーティングルーム	標準MEETING機器を含む\n\n1（1）のポータブルスクリーン、無料インターネットアクセス*、標準のサウンドシステム＆2マイク、紙とフリップチャート＆中の無料液晶プロジェクター\n\n2マーカー、メモ帳＆鉛筆、ヘッドテーブルと受付用の標準フラワーアレンジメント、看板、キャンディー＆ミネラルウォーター、\n\nヘッドテーブルの受付、名テーブルカード\n\n注：\n\n追加の機器をリクエストでき、すべての料金は、21％のサービス料と税金が含まれてい\n\n適用*ご利用条件
27	4	en	Regent Boutique	Regent Bali’s boutique, located at the Lobby area, featuring luxury high-end designers’ brands – from bags, shoes, clothing, jewelry and other accessories. Opening hours is from 9am to 8pm, Monday to Sunday.
28	4	fr	Regent Boutique	La boutique de Regent Bali, situé dans la zone Lobby, avec les marques de luxe haut de gamme - designers de sacs, chaussures, vêtements, bijoux et autres accessoires. Heures d'ouverture est 9 heures-20 heures, du lundi au dimanche.
45	2	  		
46	2	  		
47	5	  		
48	5	  		
49	5	  		
64	1	  		
9	2	cn	大堂酒廊	喜欢怀旧和历史感，你坐下来用长清凉饮料用最好的印尼选定的茶，咖啡，鸡尾酒和无酒精鸡尾酒，雪茄和前一个时代的梦想。无论是对你最好的鸡尾酒或下午茶非正式会议，同时享受令人放松的休息娱乐。
13	2	id	Golden Beach	A 200 meter dari swimmable daerah pantai emas-pasir semi-swasta yang terletak di depan resor ini dilengkapi dengan kursi dan hi-speed broadband dan koneksi internet WiFi.
2	1	en	Premier Suite	4 units of spacious 136sqm suite overlooking lush green garden and water features and 4 units of spacious 136sqm suite overlooking the island of Nusa Lembongan and the Indian Ocean.
3	1	id	Premier Suite	4 unit 136sqm suite yang luas yang menghadap ke taman dan fitur air hijau subur dan 4 unit luas 136sqm suite menghadap Pulau Nusa Lembongan dan Samudera Hindia.
15	2	kr	로비 라운지	당신이 최고 인도네시아 선택한 차와 커피, 칵테일, 목 테일, 시가와 이전 시대의 꿈과 긴 시원한 음료와 함께 다시 앉아 그리움과 역사의 느낌을 즐길 수 있습니다. 라운지 엔터테인먼트 휴식을 즐기면서 선호하는 칵테일 또는 높은 차에 비공식 회의에 대한 여부.
99	9	id	Lobby Lounge	The ditunjuk Lobby Lounge, yang menghadap taman tropis yang spektakuler dan laut lebih, menawarkan teh sore, makanan ringan dan minuman koktail. Ini adalah tempat yang tenang untuk pra bersantai atau post-dinner minum dengan teman-teman.\n \nSebuah pilihan yang baik dari teh serta kopi lokal dan internasional khas Bali Kopi, serta anggur premium, sampanye, anggur oleh kaca, klasik, koktail buah kontemporer dan segar.\n \nBuka 11-12 pagi, melayani makanan ringan dan teh sore. Jumlah kapasitas tempat duduk adalah 80 kursi.
102	9	ru	Lobby Lounge	Хорошо оборудованные Lobby Lounge, который выходит на впечатляющие тропические сады и океан вне, предлагает послеобеденный чай, легкие закуски и коктейли. Это спокойное место для спокойного до или после ужина с друзьями.\n \nПрекрасный выбор чаев, а также международного и отличительные местного кофе Бали Копи, а также премиальных вин, шампанского, вина стеклом, классические, современные и свежие фруктовые коктейли.\n \nОткройте с 11 до 12 утра, где подают легкие закуски и послеобеденный чай. Общая вместимость составляет 80 мест.
26	4	de	Regent Boutique	Regent Bali Boutique, in der Lobby-Bereich, mit luxuriösen High-End-Designer &quot;Marken - von Taschen, Schuhe, Kleidung, Schmuck und andere Accessoires. Öffnungszeiten ist von 9.00 bis 08.00 Uhr, Montag bis Sonntag.
32	4	ru	Regent Бутик	Бутик Regent Бали, расположенный в районе лобби, показывая брендов роскоши высокого класса дизайнеров - от сумок, обуви, одежды, ювелирных изделий и других аксессуаров. Часы работы является с 9 утра до 8 вечера, с понедельника по воскресенье.
30	4	jp	結婚式	ビュッフェから前菜、スープ、メインコース、デザート、そして食べ物の屋台（最低保証に等しい各30％）
100	9	  		
101	9	  		
104	7	  		
25	4	cn	婚礼	自助餐包括开胃菜，汤，主菜，甜点和小吃摊（各30％等于最低保证）
105	7	  		
12	2	fr	Golden Beach	A 200 mètres de la zone baignade semi-privée plage au sable doré située à l'avant de la station est équipée de chaises longues et haut débit salut-vitesse et connexion Internet WiFi.
23	3	kr	Paseban 라운지	라이브 음악을 매일 밤 반둥에서 가장 놀랄만큼 멋진 모임 장소로, 우리의 끝없는 칵테일 메뉴, 파티에서 당신의 감각을 보상하고 우리의 라이브 밴드가 저녁을 수행하는 동안 진정. Paseban에서 당신은 감각을 북돋워 여행에 착수 할 것이다.
16	2	ru	Golden Beach	А в 200 метрах от полу-частного swimmable золотым песком пляжной зоны, расположенной в передней части курорта оборудован шезлонгами и широкополосной привет скорость и WiFi доступом в Интернет.
29	4	id	Regent Boutique	Butik Regent Bali, terletak di daerah Lobby, menampilkan merek-merek mewah high-end desainer '- dari tas, sepatu, pakaian, perhiasan dan aksesoris lainnya. Jam buka adalah 09:00-08:00, Senin sampai Minggu.
34	5	de	Deluxe Suite	53 Einheiten der großen 90qm Suite mit Blick auf saftig grünen Gärten und Wasserspielen und 25 Einheiten von großen 90qm Suite mit Blick auf die Insel Nusa Lembongan und den Indischen Ozean.
36	5	fr	Suite de Luxe	53 unités de grande suite de 90m ² donnant sur jardin et caractéristiques de l'eau verdoyantes et 25 unités de grande suite de 90m ² avec vue sur l'île de Nusa Lembongan et l'océan Indien.
78	6	ru	Premier Spa Suite	2 единицы обширным набором 181sqm с видом пышных зеленых садовых и водных объектов и 2 единицы обширным набором 181sqm с видом на остров Нуса Лембонган и Индийском океане.
21	3	id	Club House	Eksklusif ditunjuk dan disediakan untuk Regent Residences saja, Club House dirancang untuk semua acara khusus dan pertemuan. Anggun bergaya dalam gaya klasik dan lengkap dengan multi-tujuan penerimaan kamar yang luas dan fasilitas dapur modern, sudah diatur di daerah taman hijau yang rimbun lengkap dengan fitur air yang canggih.
80	7	de	Layang Layang	Konzentration dieses Restaurants auf authentischen indonesischen und klassische Gerichte; zusammen mit einigen bemerkenswerten pan-asiatischen Spezialitäten, gibt Layang Layang eine umfassende und vielseitige Speisekarte mit vorwiegend lokalen Produkten.\n \nMit unverwechselbaren indonesische Gerichte wie Sop Buntut (Indonesian Ochsenschwanzsuppe), Soto Ayam (indonesische Hühnerbrühe) und bemerkenswerte pan-asiatische Gerichte einschließlich Singapur Laksa, vietnamesische Pho, indische Gewürzbrote und Auswahl von Currys, japanischen und chinesischen Nudelgerichte unter anderem. Layang Layang Spezialitäten der traditionellen Desserts sind vereist cendol, es campur und Eis kacang.\n \nEine feine Auswahl an Tees sowie internationale und lokale Besonderheit Kaffee Kopi Bali sowie Premium-Weine, Champagner, Weine im Glas, klassische, zeitgenössische und frische Fruchtcocktails.
63	1	  		
41	3	  		
42	3	  		
43	3	  		
44	2	  		
35	5	en	Deluxe Suite	53 units of large 90sqm suite overlooking lush green garden and water features and 25 units of large 90sqm suite overlooking the island of Nusa Lembongan and the Indian Ocean.
37	5	id	Deluxe Suite	53 unit 90sqm suite besar yang menghadap ke taman dan fitur air hijau subur dan 25 unit 90sqm suite besar yang menghadap ke Pulau Nusa Lembongan dan Samudera Hindia.
50	1	  		
65	3	  		
51	1	  		
52	1	  		
53	4	  		
54	4	  		
55	4	  		
56	2	  		
57	2	  		
58	2	  		
59	5	  		
60	5	  		
61	5	  		
109	1	  		
62	1	  		
110	1	  		
66	3	  		
67	3	  		
68	4	  		
69	4	  		
70	4	  		
71	6	  		
76	6	  		
77	6	  		
79	7	  		
84	7	  		
85	7	  		
87	8	  		
92	8	  		
93	8	  		
95	9	  		
103	7	  		
83	7	id	Layang Layang	Konsentrasi ini restoran di otentik masakan Indonesia dan klasik; bersama-sama dengan beberapa terkenal spesialisasi pan-Asia, memberikan Layang Layang menu luas dan eklektik yang menampilkan produk terutama bersumber secara lokal.\n \nMenampilkan masakan Indonesia khas seperti Sop Buntut (Oxtail Soup Indonesia), Soto Ayam (Chicken Broth Indonesia) dan terkenal pan-Asia piring termasuk Singapore Laksa, Pho Vietnam, India roti dibumbui dan seleksi kari, Jepang dan Cina hidangan mie antara lain. Spesialisasi Layang Layang murah dari makanan penutup es tradisional cendol, es campur dan es kacang.\n \nSebuah pilihan yang baik dari teh serta kopi lokal dan internasional khas Bali Kopi, serta anggur premium, sampanye, anggur oleh kaca, klasik, koktail buah kontemporer dan segar.
88	8	de	Beachfront Swimming Pool	Ein 50m-Sportbecken unendlich (1,5 m Tiefe) mit eingelassener Sitzbereiche auf beiden Seiten praktisch direkt am Strand gegenüber Nyala Beach Club &amp; Grill entfernt. Acht am Strand Cabanas sind vor dem Pool mit direktem Zugang zum Sanur goldenen Strand entfernt.\n \nDie Pool-Terrasse ist an der Vorderseite des Nyala Beach Club &amp; Grill und neben der Hauptpool mit Blick auf Sanur goldenen Strand und den Indischen Ozean. Eine Auswahl von gesunden Wellnessgerichte sind als &quot;nach - Behandlung&quot; verfügbar Küche, um die Ergebnisse zu verbessern. Offen für das Mittagessen von 10.00 Uhr bis 18.30 Uhr, am Infinity-Pool und Terrasse (24 Plätze) ist der ideale Ort, um während des Tages zu entspannen
91	8	id	Beachfront Swimming Pool	Sebuah 50m infinity kolam putar (1.5m mendalam) dengan daerah tempat duduk cekung di kedua sisi terletak benar-benar tepat di pantai seberang Nyala Beach Club &amp; Grill. Delapan cabanas pantai yang terletak di depan kolam renang dengan akses langsung ke Sanur golden beach.\n \nThe Pool Terrace terletak di depan Nyala Beach Club &amp; Grill dan di samping kolam renang utama, menghadap Pantai Sanur emas dan Samudera Hindia. Sebuah pilihan hidangan spa yang sehat yang tersedia sebagai &quot;setelah - pengobatan&quot; masakan untuk meningkatkan hasil. Terbuka untuk makan siang dari 10:00-06:30, infinity Pool Terrace (24 kursi) adalah tempat yang ideal untuk bersantai di siang hari
98	9	fr	Lobby Lounge	Le Lobby Lounge bien équipée, qui donne sur les jardins tropicaux spectaculaires et l'océan au-delà, offre le thé, des repas légers et des cocktails. C'est un lieu tranquille pour une pré relaxant ou un verre après le dîner avec des amis.\n \nUne belle sélection de thés ainsi que café local et international distinctif de Bali Kopi, ainsi que des vins haut de gamme, champagne, vins au verre, classique, cocktails de fruits frais et contemporains.\n \nOuvert de 11 h à 12 h, servant des repas légers et le thé l'après-midi. La capacité totale d'accueil est de 80 places.
106	5	  		
107	5	  		
108	5	  		
4	1	de	Premier Suite	4 Einheiten geräumige Suite mit Blick auf 136sqm saftig grünen Gärten und Wasserspielen und 4 Einheiten geräumige Suite 136sqm Blick auf die Insel Nusa Lembongan und den Indischen Ozean.
111	1	  		
112	6	  		
72	6	de	Premier Spa Suite	2 Einheiten umfassenden 181sqm Suite mit Blick auf saftig grünen Gärten und Wasserspielen und 2 Einheiten umfassenden 181sqm Suite mit Blick auf die Insel Nusa Lembongan und den Indischen Ozean.
73	6	en	Premier Spa Suite	2 units of extensive 181sqm suite overlooking lush green garden and water features and 2 units of extensive 181sqm suite overlooking the island of Nusa Lembongan and the Indian Ocean.
74	6	fr	Premier Spa Suite	2 unités de la gamme complète de 181sqm donnant sur jardin et caractéristiques de l'eau luxuriants et 2 unités de la gamme complète de 181sqm donnant sur l'île de Nusa Lembongan et l'océan Indien.
75	6	id	Premier Spa Suite	2 unit 181sqm ekstensif menghadap fitur taman dan air hijau subur dan 2 unit 181sqm ekstensif menghadap Pulau Nusa Lembongan dan Samudera Hindia.
113	6	  		
114	6	  		
115	7	  		
81	7	en	Layang Layang	This restaurant‘s concentration on authentic Indonesian and classic dishes; together with some notable pan-Asian specialties, gives Layang Layang a wide-ranging and eclectic menu featuring predominantly locally-sourced products.\n \nFeaturing distinctive Indonesian dishes such as Sop Buntut (Indonesian Oxtail Soup), Soto Ayam (Indonesian Chicken Broth) and notable pan-Asian dishes including Singapore Laksa, Vietnamese Pho, Indian spiced breads and selection of curries, Japanese and Chinese noodle dishes amongst others. Layang Layang’s specialties of traditional iced desserts are cendol, es campur and ice kacang.\n \nA fine selection of teas as well as international and distinctive local coffee of Bali Kopi, as well as premium wines, champagne, wines by the glass, classic, contemporary and fresh fruit cocktails.
82	7	fr	Layang Layang	La concentration de ce restaurant sur ​​plats indonésiens et classiques authentiques; avec quelques spécialités pan-asiatiques notables, donne Layang Layang un menu vaste et éclectique, avec des produits principalement d'origine locale.\n \nAvec des plats indonésiens distinctifs tels que Sop Buntut (soupe de queue de boeuf indonésien), Soto Ayam (indonésien bouillon de poulet) et des plats pan-asiatique notables, dont Singapour Laksa, Pho vietnamien, pains indiens épicés et de sélection des currys, plats de nouilles japonaises et chinoises, entre autres. Les spécialités de Layang Layang de desserts glacés traditionnels sont cendol, es campur et kacang de glace.\n \nUne belle sélection de thés ainsi que café local et international distinctif de Bali Kopi, ainsi que des vins haut de gamme, champagne, vins au verre, classique, cocktails de fruits frais et contemporains.
116	7	  		
117	7	  		
155	3	  		
156	3	  		
157	3	  		
158	3	  		
86	7	ru	Layang Layang	Концентрация этого ресторана на подлинных индонезийских и классических блюд; вместе с некоторыми примечательными пан-азиатской кухни, дает Layang Layang широкомасштабного и эклектичное меню с участием преимущественно локально-источников продуктов.\n \nБлагодаря отличительные индонезийской кухни, такие как Соп Buntut (индонезийский суп из бычьих хвостов), Сото айам (индонезийской куриный бульон) и заметные азиатской кухни, включая Сингапур Laksa, вьетнамский Пхо, индийский пряный хлеба и выбор карри, японские и китайские блюда из лапши среди других. Специальностей Layang Layang в традиционных замороженных десертов Cendol, эс Campur и лед kacang.\n \nПрекрасный выбор чаев, а также международного и отличительные местного кофе Бали Копи, а также премиальных вин, шампанского, вина стеклом, классические, современные и свежие фруктовые коктейли.
118	3	  		
119	3	  		
120	3	  		
121	8	  		
89	8	en	Beachfront Swimming Pool	A 50m infinity lap pool (1.5m depth) with sunken seating areas on both sides is located literally right on the beachfront opposite Nyala Beach Club &amp; Grill. Eight beachfront cabanas are located in front of the pool with direct access to Sanur golden beach.\n \nThe Pool Terrace is located at the front of Nyala Beach Club &amp; Grill and alongside the main swimming pool, overlooking Sanur golden beach and the Indian Ocean. A selection of healthy spa dishes are available as “after – treatment” cuisine to enhance the results. Open for lunch from 10am – 6.30pm, the infinity Pool Terrace (24 seats) is the ideal venue to unwind during the day
90	8	fr	Beachfront Swimming Pool	Une piscine 50m à débordement (1,5 m de profondeur) avec des sièges creux sur les deux côtés se trouve littéralement sur le front de mer en face de Nyala Beach Club &amp; Grill. Huit cabines en bord de mer sont situés en face de la piscine avec accès direct à la plage de Sanur or.\n \nLa terrasse de la piscine est situé à l'avant de Nyala Beach Club &amp; Grill et à côté de la piscine principale, donnant sur la plage de Sanur or et l'océan Indien. Une sélection de plats de spa santé sont disponibles en &quot;post - traitement&quot; cuisine pour améliorer les résultats. Ouvert pour le déjeuner de 10 heures-18h30, la piscine à débordement terrasse (24 places) est le lieu idéal pour se détendre pendant la journée
122	8	  		
123	8	  		
94	8	ru	Пляж Бассейн	50m бесконечности плавательный бассейн (1,5 м глубина) с затонувших гостиными с обеих сторон находится буквально прямо на пляже напротив Ньяла Beach Club &amp; Grill. Восемь пляжные домики расположены в передней части бассейна с прямым доступом к Санур пляжа с золотым песком.\n \nPool Terrace находится в передней части Ньяла Beach Club &amp; Grill и рядом с главным бассейном, видом Санур золотой пляж и Индийский океан. Подборка здоровых спа блюд доступны как &quot;после - лечение&quot; кухни для повышения результатов. Открыт на обед с 10 утра - 6:30 вечера, пейзажный бассейн Терраса (24 мест) является идеальным местом для отдыха в течение дня
124	4	  		
125	4	  		
126	4	  		
127	2	  		
128	2	  		
129	2	  		
130	9	  		
131	9	  		
132	9	  		
133	2	  		
134	2	  		
135	2	  		
136	9	  		
96	9	de	Lobby Lounge	Die gut ausgestattete Lobby Lounge, die die spektakulären tropischen Gärten und das Meer hinaus blickt, bietet Tee am Nachmittag, leichte Mahlzeiten und Cocktails. Dies ist ein ruhiger Ort für einen erholsamen vor oder nach dem Abendessen einen Drink mit Freunden.\n \nEine feine Auswahl an Tees sowie internationale und lokale Besonderheit Kaffee Kopi Bali sowie Premium-Weine, Champagner, Weine im Glas, klassische, zeitgenössische und frische Fruchtcocktails.\n \nVon 11 Uhr bis 12 Uhr, leichte Mahlzeiten und Nachmittagstee. Gesamtkapazität beträgt 80 Plätze.
97	9	en	Lobby Lounge	The well-appointed Lobby Lounge, which overlooks the spectacular tropical gardens and the ocean beyond, offers afternoon tea, light meals and cocktails. This is a tranquil venue for a relaxing pre or post-dinner drink with friends.\n \nA fine selection of teas as well as international and distinctive local coffee of Bali Kopi, as well as premium wines, champagne, wines by the glass, classic, contemporary and fresh fruit cocktails.\n \nOpen from 11 to 12 am, serving light meals and afternoon tea. Total seating capacity is 80 seats.
137	9	  		
138	9	  		
139	4	  		
140	4	  		
141	4	  		
142	10	  		
143	10	de		
145	10	fr		
146	10	id		
147	10	  		
148	10	  		
149	10	ru		
144	10	en	Dear Valued Guest	Should you need any information about our hotel and restaurant, please refer to the hotel directory placed on your working desk.\n\n&lt;p&gt;Enjoy your stay with us,&lt;br/&gt;\n&lt;strong&gt;Hotel Management&lt;/strong&gt;&lt;/p&gt;
150	2	  		
151	2	  		
152	2	  		
14	2	jp	ロビーラウンジ	あなたは最高のインドネシア選ば紅茶やコーヒー、カクテル、ノンアルコール、葉巻とそれ以前の時代の夢と長い冷たいドリンクを飲みながらくつろいとして懐かしさと歴史の感覚をお楽しみください。ラウンジエンターテイメントをリラックスし楽しみながら優先カクテルやハイティーの上、非公式会合のためかどうか。
153	2	  		
154	2	  		
159	3	  		
160	5	  		
161	5	  		
162	5	  		
163	5	  		
164	5	  		
165	1	  		
166	1	  		
167	1	  		
6	1	jp	Pakuanカフェ	食べ物はこれがPakuanカフェに反映されている喜びです、私たちの独特の国際および地元スンダ料理をあなたの味覚を楽しま：食べ物は、おいしい新鮮な、健全な、そして非常に満足すべきである。 2（2）のプライベートルームと経験真スンダおもてなしと居心地の良いダイニングルームに落ち着く来る。 Pakuanレストランはエレガントな朝食とランチに大規模な国際色豊かなビュッフェを提供して終日営業のレストラン、朝食、ランチ、ディナーにアラカルトサービスです。
168	1	  		
169	1	  		
33	5	cn	会议室	包括标准会议EQUIPMENTS\n\n免费液晶投影机与一（1）便携式屏幕，免费上网*，标准音响系统和2个麦克风，挂图纸＆\n\n2标记，便笺和铅笔，为表头和前台标准插花，招牌，糖果和矿泉水，\n\n接待处，名称表卡表头\n\n \n\n注意事项：\n\n附加设备可根据要求，所有价格已包括21％服务费及政府税\n\n*条款及细则适用
170	5	  		
39	5	kr	룸 회의	표준 회의 장비의 포함\n\n하나 (1) 휴대용 스크린, 무료 인터넷 접속 * 표준 사운드 시스템 &amp; 2 마이크, 종이 플립 차트 및 무료 LCD 프로젝터\n\n2 마커, 메모 패드 및 연필, 헤드 테이블과 리셉션 데스크를위한 표준 꽃꽂이, 간판, 사탕 &amp; 미네랄 워터,\n\n헤드 테이블 리셉션 데스크, 이름 테이블 카드\n\n참고 :\n\n추가 장비는 요청에 사용할 수 있습니다, ​​모든 요금은 21 %의 봉사료와 정부의 세금이 포함됩니다\n\n적용 * 약관과 조건
171	1	  		
1	1	cn	Pakuan咖啡馆	食物是一种享受，这是体现在Pakuan咖啡厅，满足您的味觉与我们独特的国际和当地巽美食：饮食应以美味，新鲜，健康，而且非常令人满意。来融入我们舒适的用餐室，2（2）私人客房和体验真正的巽他的热情好客。 Pakuan餐厅是一个优雅的全日餐厅，提供丰富的国际自助早餐，午餐和点菜服务，提供早餐，午餐和晚餐。
172	1	  		
7	1	kr	Pakuan 카페	음식이이 Pakuan 커피 숍에 반영되어 기쁨, 우리의 독특한 국제 및 지역 다인 요리와 미각을 즐겁게 : 음식, 맛있는 신선한, 건강에 좋은, 매우 만족해야한다. 2 (2) 개인 객실과 경험 진정한 순다어 환대와 우리의 아늑한 식당에 정착되어 있습니다. Pakuan 레스토랑 우아한 아침 식사와 점심 식사를위한 광범위한 국제적인 뷔페를 제공하고 하루 종일 레스토랑, 아침 식사, 점심 식사, 저녁 식사를위한 일품 요리 서비스입니다.
11	2	en	Golden Beach	A 200 meters of semi-private swimmable golden-sand beach area located at the front of the resort is equipped with loungers and hi-speed broadband and WiFi internet connection.
173	2	  		
\.


--
-- Name: directory_translations_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('directory_translations_seq', 173, true);


--
-- Data for Name: doctor_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY doctor_translations (translation_id, doctors_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
3	1	en	Medical Assistance	
4	1	  		
5	1	id	Bantuan Kesehatan	
6	1	jp	医療扶助	
7	1	  		
8	1	  		
\.


--
-- Name: doctor_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('doctor_translations_translation_id_seq', 8, true);


--
-- Data for Name: doctors; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY doctors (doctors_id, doctors_image, doctors_image_enabled, doctors_clip, doctors_clip_enabled, doctors_enabled, doctors_order) FROM stdin;
1	doctor	0		0	1	1
\.


--
-- Name: doctors_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('doctors_seq', 1, true);


--
-- Data for Name: drop_pickup_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY drop_pickup_translations (translation_id, drop_pickups_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
7	1	  		
8	1	  		
9	1	cn	掉落及提货	
3	1	en	Drop &amp; Pick Up	
5	1	id	Drop &amp; Pick Up	
6	1	jp	ドロップ＆ピックアップ	
\.


--
-- Name: drop_pickup_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('drop_pickup_translations_translation_id_seq', 9, true);


--
-- Data for Name: drop_pickups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY drop_pickups (drop_pickups_id, drop_pickups_image, drop_pickups_image_enabled, drop_pickups_clip, drop_pickups_clip_enabled, drop_pickups_enabled, drop_pickups_order) FROM stdin;
1	drop-pickup	0		0	1	1
\.


--
-- Name: drop_pickups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('drop_pickups_seq', 1, true);


--
-- Data for Name: emergencies; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY emergencies (emergency_id, emergency_code, emergency_name) FROM stdin;
1	FI	Fire
2	FL	Flood
3	EQ	Earthquake
4	VI	Violence
\.


--
-- Name: emergencies_emergency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('emergencies_emergency_id_seq', 4, true);


--
-- Data for Name: forget_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY forget_translations (translation_id, forgets_id, language_id, translation_title, translation_description) FROM stdin;
1	2	  		
2	2	  		
4	2	  		
7	2	  		
8	2	  		
9	2	  		
10	2	  		
11	2	  		
12	2	  		
13	2	  		
14	2	  		
15	2	  		
16	2	  		
17	2	  		
18	2	  		
19	2	  		
20	2	  		
21	2	  		
22	2	  		
23	2	  		
24	2	  		
25	2	  		
26	2	  		
6	2	jp	あなたが何かを忘れていますか？	
27	2	  		
28	2	  		
29	2	  		
30	2	  		
32	2	  		
34	2	  		
31	2	cn	难道你忘了什么东西？	
3	2	en	Do You Forget Something?	
5	2	id	Lupa Sesuatu?	
35	2	  		
33	2	kr	당신은 뭔가를 잊어합니까?	
\.


--
-- Name: forget_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('forget_translations_translation_id_seq', 35, true);


--
-- Data for Name: forgets; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY forgets (forgets_id, forgets_image, forgets_image_enabled, forgets_clip, forgets_clip_enabled, forgets_enabled, forgets_order) FROM stdin;
1	forget-something	0		0	1	1
2	forgot-something	0		0	1	1
\.


--
-- Name: forgets_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('forgets_seq', 2, true);


--
-- Data for Name: galleries; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY galleries (galleries_id, galleries_image, galleries_image_enabled, galleries_clip, galleries_clip_enabled, galleries_enabled, galleries_order) FROM stdin;
1	bfp	0		0	1	1
2	bfp2	0		0	1	2
3	bfps	0		0	1	3
4	bfpsp	0		0	1	4
5	bfw	0		0	1	5
6	bl1	0		0	1	6
7	db	0		0	1	7
8	dc	0		0	1	8
9	dpa	0		0	1	9
10	gd1	0		0	1	10
11	ko	0		0	1	11
12	kr	0		0	1	12
13	kr2	0		0	1	13
14	ll	0		0	1	14
15	ml3	0		0	1	15
16	ml7	0		0	1	16
17	mp2	0		0	1	17
18	mp4	0		0	1	18
19	mp5	0		0	1	19
20	mr	0		0	1	20
21	pkla	0		0	1	21
22	ps	0		0	1	22
23	ps2	0		0	1	23
24	pstr	0		0	1	24
25	ptla	0		0	1	25
26	sp	0		0	1	26
27	spn	0		0	1	27
\.


--
-- Name: galleries_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('galleries_seq', 27, true);


--
-- Data for Name: gallery_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY gallery_translations (translation_id, galleries_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
7	1	  		
8	1	  		
10	1	  		
11	1	  		
12	1	  		
13	1	  		
14	1	  		
15	1	  		
6	1	jp	ホテルディレクトリー	
16	1	  		
17	1	  		
19	2	  		
21	2	  		
24	2	  		
25	2	  		
27	3	  		
29	3	  		
31	3	jp	ホテルディレクトリー	
32	3	  		
33	3	  		
35	4	  		
37	4	  		
39	4	jp	ホテルディレクトリー	
40	4	  		
41	4	  		
43	5	  		
45	5	  		
47	5	jp	ホテルディレクトリー	
48	5	  		
49	5	  		
50	2	  		
51	2	  		
23	2	jp	ホテルディレクトリー	
52	2	  		
53	2	  		
73	7	kr	갱도	
74	8	cn	画廊	
75	8	en	Gallery	
54	1	  		
76	8	id	Galeri	
102	8	  		
78	8	kr	갱도	
56	2	  		
79	9	cn	画廊	
80	9	en	Gallery	
81	9	id	Galeri	
58	3	  		
103	9	  		
83	9	kr	갱도	
84	10	cn	画廊	
60	4	  		
85	10	en	Gallery	
86	10	id	Galeri	
104	10	  		
62	5	  		
67	6	  		
72	7	  		
77	8	  		
82	9	  		
87	10	  		
131	17	cn	画廊	
132	17	en	Gallery	
133	17	id	Galeri	
89	10	  		
134	17	  		
93	11	  		
9	1	cn	画廊	
3	1	en	Gallery	
5	1	id	Galeri	
95	1	  		
55	1	kr	갱도	
18	2	cn	画廊	
20	2	en	Gallery	
22	2	id	Galeri	
96	2	  		
57	2	kr	갱도	
26	3	cn	画廊	
28	3	en	Gallery	
30	3	id	Galeri	
97	3	  		
59	3	kr	갱도	
34	4	cn	画廊	
36	4	en	Gallery	
38	4	id	Galeri	
98	4	  		
61	4	kr	갱도	
42	5	cn	画廊	
44	5	en	Gallery	
46	5	id	Galeri	
99	5	  		
63	5	kr	갱도	
64	6	cn	画廊	
65	6	en	Gallery	
66	6	id	Galeri	
100	6	  		
68	6	kr	갱도	
69	7	cn	画廊	
70	7	en	Gallery	
71	7	id	Galeri	
101	7	  		
88	10	kr	갱도	
90	11	cn	画廊	
91	11	en	Gallery	
92	11	id	Galeri	
105	11	  		
94	11	kr	갱도	
106	12	cn	画廊	
107	12	en	Gallery	
108	12	id	Galeri	
109	12	  		
110	12	kr	갱도	
111	13	cn	画廊	
112	13	en	Gallery	
113	13	id	Galeri	
114	13	  		
115	13	kr	갱도	
116	14	cn	画廊	
117	14	en	Gallery	
118	14	id	Galeri	
119	14	  		
120	14	kr	갱도	
121	15	cn	画廊	
122	15	en	Gallery	
123	15	id	Galeri	
124	15	  		
125	15	kr	갱도	
126	16	cn	画廊	
127	16	en	Gallery	
128	16	id	Galeri	
129	16	  		
130	16	kr	갱도	
135	17	kr	갱도	
136	18	cn	画廊	
137	18	en	Gallery	
138	18	id	Galeri	
139	18	  		
140	18	kr	갱도	
141	19	cn	画廊	
142	19	en	Gallery	
143	19	id	Galeri	
144	19	  		
145	19	kr	갱도	
146	20	cn	画廊	
147	20	en	Gallery	
148	20	id	Galeri	
149	20	  		
150	20	kr	갱도	
151	21	cn	画廊	
152	21	en	Gallery	
153	21	id	Galeri	
154	21	  		
155	21	kr	갱도	
156	22	cn	画廊	
157	22	en	Gallery	
158	22	id	Galeri	
159	22	  		
160	22	kr	갱도	
161	23	cn	画廊	
162	23	en	Gallery	
163	23	id	Galeri	
164	23	  		
165	23	kr	갱도	
166	24	cn	画廊	
167	24	en	Gallery	
168	24	id	Galeri	
169	24	  		
170	24	kr	갱도	
171	25	cn	画廊	
172	25	en	Gallery	
173	25	id	Galeri	
174	25	  		
175	25	kr	갱도	
176	26	cn	画廊	
177	26	en	Gallery	
178	26	id	Galeri	
179	26	  		
180	26	kr	갱도	
181	27	cn	画廊	
182	27	en	Gallery	
183	27	id	Galeri	
184	27	  		
185	27	kr	갱도	
\.


--
-- Name: gallery_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('gallery_translations_translation_id_seq', 185, true);


--
-- Data for Name: guest_baskets; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_baskets (guest_basket_id, guest_reservation_id, guest_service_code, guest_service_item, guest_service_price, guest_service_qty, room_name, guest_service_note, guest_service_guestname, guest_service_approved, guest_basket_type, guest_basket_option, guest_basket_datetime) FROM stdin;
1498573649	37194	IND0000292	Bebek Betutu	192390	0	6208		Aldho Willy Fernanta	0	F	: 	0
1504258972	54135	IND0000018	Aglio e Olio	83490	1	5321		Chenzhuo Zhao	0	F	: 	0
1500300313	42577	IND0000322	Ayam panggang kalas	156090	1	2326		Alex Moscow	0	F	: 	0
1503801843	53435	IND0000381	beringer classic	786500	0	2243		Henry Susanto	0	F	: 	0
1495187163	31904	IND0000003	Sop Buntut	211750	2	3115		Arie Dharmanto	0	F	: 	0
1494599823	30415	IND0000305	Mie Rebus	114950	1	6508		Stephen Loquet	0	F	: 	0
1494843363	30841	IND0000014	Steak Sandwiches	139150	1	2510		Boniface Lisa	0	F	: 	0
1496065488	33036	IND0000294	French Fries	42350	1	6107		Florence Chen	0	F	: 	0
1496065553	33036	IND0000363	Potato Wedges	42350	1	6107		Florence Chen	0	F	: 	0
1500648263	43298	IND0000082	Cappucino	42350	0	3132		Asdghik Melkonian	0	F	: 	0
1495468396	32868	IND0000015	Beef Burger With Cheese	151250	1	6509		Ashlea Brown	0	F	: 	0
1495536247	32909	IND0000015	Beef Burger With Cheese	151250	1	2206		Lynda Diane Gregory	0	F	: 	0
1495536454	32909	IND0000260	Bali Hai	54450	1	2206		Lynda Diane Gregory	0	F	: 	0
1496571678	34055	IND0000302	Aglio e Olio	83490	0	3101		Renato Domini	0	F	: 	0
1504850267	56753	IND0000002	Mie Goreng Jawa	139150	1	1215		Natasha Warnock Lai	0	F	: 	0
1503836863	53800	IND0000301	Bolognaise Meat Sauce	102850	1	3205		Iwan Pontjowinoto	0	F	: 	0
1498230353	36097	IND0000368	Aneka Be Pasih Megoreng	284350	0	2119		Ailin Sumimoto	0	F	: 	0
1494682003	30532	IND0000294	French Fries	42350	1	5315		Eric Gunawan	0	F	: 	0
1499606505	37298	IND0000015	Beef Burger With Cheese	151250	1	6509		Filip Hagen	0	F	: 	0
1495198925	31612	IND0000305	Mie Rebus	114950	1	2137		Tisya Taroreh	0	F	: 	0
1495198983	31612	IND0000303	Soto Ayam Lamongan	151250	1	2137		Tisya Taroreh	0	F	: 	0
1503585993	52894	IND0000305	Mie Rebus	114950	1	2216		Adhika Bhatara Syahrial	0	F	: 	0
1500102586	41995	IND0000020	Carbonara Sauce	102850	1	3152		Grace Ticoalu	0	F	: 	0
1494909586	31322	IND0000014	Steak Sandwiches	139150	1	2136		Sharon Lee Thorne	0	F	: 	0
1494909675	31322	IND0000002	Mie Goreng Jawa	139150	1	2136		Sharon Lee Thorne	0	F	: 	0
1494736460	22581	IND0000303	Soto Ayam Lamongan	151250	1	2201		Sven Walter	0	F	: 	0
1494736509	22581	IND0000015	Beef Burger With Cheese	151250	1	2201		Sven Walter	0	F	: 	0
1494744656	30804	IND0000302	Aglio e Olio	83490	1	5102		Nila Widowati	0	F	: 	0
1494744899	30931	IND0000015	Beef Burger With Cheese	151250	1	6302		Kenny Neville	0	F	: 	0
1494744976	30931	IND0000294	French Fries	42350	1	6302		Kenny Neville	0	F	: 	0
1498042345	35870	IND0000015	Beef Burger With Cheese	151250	1	1310		Michael Patterson	0	F	: 	0
1495259189	32222	IND0000300	Carbonara Sauce	102850	1	2316		Inneke	0	F	: 	0
1494753566	30940	IND0000308	Ayam pelalah	71390	1	5520		Hiu ting Au	0	F	: 	0
1498042403	35870	IND0000294	French Fries	42350	1	1310		Michael Patterson	0	F	: 	0
1494918420	31270	IND0000292	Bebek Betutu	192390	0	6212		Kadar Lusman SE	0	F	: 	0
1498042507	35870	IND0000380	30 Mile	786500	1	1310		Michael Patterson	0	F	: 	0
1501861450	47039	IND0000381	beringer classic	786500	1	1511		Eri Nakamura	0	F	: 	0
1502654748	49626	IND1000039	Aglio e Olio	83490	1	3525		Ankit Agarwal	0	F	: 	0
1505502480	58728	IND1000033	Soup Buntut	211750	1	3507		Dong Qinglong	0	F	: 	0
1495285992	32313	IND0000313	Sate lilit ikan	114950	1	3105		Erwin K	0	F	: 	0
1499684266	40378	IND0000001	Nasi Goreng Kampoeng	139150	1	1311		Fellycia Tobing	0	F	: 	0
1494776868	30720	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	2130		Gregory Budianto	0	F	: 	0
1502688624	49824	IND0000294	French Fries	42350	2	2141		Rebecca Mizzi	0	F	: 	0
1496244604	22581	IND0000420	Indonesian Sahur Menu	0	0	2201		Sven Walter	0	F	: 	0
1495340904	32391	IND0000081	Cafe Latte	42350	1	2122		Artem Smoliar	0	F	: 	0
1495032533	30848	IND0000014	Steak Sandwiches	139150	0	2524		Kleyhans Madeleine	0	F	: 	0
1502724148	50133	IND0000002	Mie Goreng Jawa	139150	1	2231		Dewi Damayanti	0	F	: 	0
1495084439	31514	IND0000001	Nasi Goreng Kampoeng	139150	1	6217		Pandu Bagja	0	F	: 	0
1497187744	34550	IND0000291	Bebek Goreng Kunyit	192390	2	6217		Reinaldo Freitas	0	F	: 	0
1496251492	33630	IND0000322	Ayam panggang kalas	156090	2	6101		Savanna Fleming	0	F	: 	0
1496251576	33630	IND0000377	Chocolate Summer Cake	78650	1	6101		Savanna Fleming	0	F	: 	0
1496251591	33630	IND0000370	Apple Crumble	66550	1	6101		Savanna Fleming	0	F	: 	0
1496251660	33630	IND0000390	Plaga Rose - Bottle	434390	1	6101		Savanna Fleming	0	F	: 	0
1505563508	58560	IND0000303	Soto Ayam Lamongan	151250	0	6509		Tan Selfita Nurcahya	0	F	: 	0
1496823723	0	IND0000024	Tiramisu Cake	102850	0				0	F	: 	0
1496838337	34232	IND0000015	Beef Burger With Cheese	151250	1	6115		Lien De Leenheer	0	F	: 	0
1495419117	32056	IND0000368	Aneka Be Pasih Megoreng	284350	0	2229		Dadan Juhana c/o	0	F	: 	0
1495419140	32056	IND0000368	Aneka Be Pasih Megoreng	284350	0	2229		Dadan Juhana c/o	0	F	: 	0
1495419217	32056	IND0000323	Babi kecap	163350	0	2229		Dadan Juhana c/o	0	F	: 	0
1495419250	32056	IND0000323	Babi kecap	163350	0	2229		Dadan Juhana c/o	0	F	: 	0
1505583290	58842	IND0000264	Heineken	66550	1	6305		Taher Azizi	0	F	: 	0
1497268007	34716	IND0000292	Bebek Betutu	192390	0	5516		Tian Fuyou	0	F	: 	0
1497281165	34584	IND0000368	Aneka Be Pasih Megoreng	284350	0	2223		Edmond Chan	0	F	: 	0
1497281177	34584	IND0000368	Aneka Be Pasih Megoreng	284350	0	2223		Edmond Chan	0	F	: 	0
1497281232	34584	IND0000368	Aneka Be Pasih Megoreng	284350	0	2223		Edmond Chan	0	F	: 	0
1497366555	34698	IND0000295	Beer Promotion	180290	4	5112		Zhu Li	0	F	: 	0
1500300366	42577	IND0000351	Cramcam ayam	66550	1	2326		Alex Moscow	0	F	: 	0
1497885073	35367	IND0000294	French Fries	42350	2	5522		Lokeshwar Reddy	0	F	: 	0
1500300754	42238	IND0000018	Aglio e Olio	83490	1	3125		Alita Widyasari (pre)	0	F	: 	0
1499588347	40491	IND0000010	Lumpia Sayur Semarang	66550	1	6511		Kemal Anshori	0	F	: 	0
1497540923	35189	IND0000387	fish and chip	121000	1	5307		Chheang Virak	0	F	: 	0
1504261556	54492	IND1000028	Steak Sandwich	180290	1	5222		Jane Hammacott	0	F	: 	0
1497585833	35119	IND0000001	Nasi Goreng Kampoeng	139150	1	3107		Liana Liana	0	F	: 	0
1498230383	36097	IND0000368	Aneka Be Pasih Megoreng	284350	0	2119		Ailin Sumimoto	0	F	: 	0
1498231503	36204	IND0000420	Indonesian Sahur Menu	0	0	2309		Stephanie Karunia Mulia	0	F	: 	0
1502106161	47643	IND1000035	Nasi Goreng Kampung	139150	2	2532		Isabelle Barth	0	F	: 	0
1497419862	34930	IND0000019	Bolognaise Meat Sauce	102850	1	6115		Joe Macapili	0	F	: 	0
1497419883	34930	IND0000020	Carbonara Sauce	102850	4	6115		Joe Macapili	0	F	: 	0
1497419917	34930	IND0000387	fish and chip	121000	1	6115		Joe Macapili	0	F	: 	0
1497419973	34930	IND0000012	Creamy Mushroom Soup	71390	2	6115		Joe Macapili	0	F	: 	0
1497420015	34930	IND0000051	Vanilla - Milk Shake & Smoothies	59290	3	6115		Joe Macapili	0	F	: 	0
1497420046	34930	IND0000057	Honey Dew Melon Juice	54450	1	6115		Joe Macapili	0	F	: 	0
1506261857	60899	IND0000292	Bebek Betutu	192390	0	5215		Wang Weilin	0	F	: 	0
1504854408	56398	IND0000351	Cramcam ayam	66550	1	3124		Woonjung Kim	0	F	: 	0
1497432546	35048	IND0000291	Bebek Goreng Kunyit	192390	0	5307		Goh Albert	0	F	: 	0
1497433197	35048	IND0000291	Bebek Goreng Kunyit	192390	0	5307		Goh Albert	0	F	: 	0
1499605886	40581	IND0000292	Bebek Betutu	192390	0	5318		Shelly	0	F	: 	0
1498042378	35870	IND0000387	fish and chip	121000	1	1310		Michael Patterson	0	F	: 	0
1498042447	35870	IND0000071	Coca - Cola	35090	2	1310		Michael Patterson	0	F	: 	0
1498049005	35633	IND0000319	Be siap sambal matah	156090	0	5319		Zhang Lidong	0	F	: 	0
1499606549	37298	IND0000023	Panna Cotta	83490	1	6509		Filip Hagen	0	F	: 	0
1497454693	35102	IND0000322	Ayam panggang kalas	156090	1	2238		Gerardo Tommasiello	0	F	: 	0
1497454773	35102	IND0000014	Steak Sandwiches	180290	1	2238		Gerardo Tommasiello	0	F	: 	0
1497454829	35102	IND0000387	fish and chip	121000	1	2238		Gerardo Tommasiello	0	F	: 	0
1501772862	46547	IND0000019	Bolognaise Meat Sauce	102850	1	3523		Li Hui	0	F	: 	0
1500113253	41998	IND0000078	Americano	36300	0	6107		Phiet In	0	F	: 	0
1501861763	47210	IND0000010	Lumpia Sayur Semarang	66550	1	1509		Teck chuan Sieu	0	F	: 	0
1497597843	34600	IND0000019	Bolognaise Meat Sauce	102850	1	6310		Hu Rong	0	F	: 	0
1497597898	34600	IND0000010	Lumpia Sayur Semarang	66550	1	6310		Hu Rong	0	F	: 	0
1497598027	34600	IND0000020	Carbonara Sauce	102850	1	6310		Hu Rong	0	F	: 	0
1497610290	35143	IND0000024	Tiramisu Cake	102850	1	2230		Saurabh Manisha Shekhar	0	F	: 	0
1497610318	35143	IND0000377	Chocolate Summer Cake	78650	1	2230		Saurabh Manisha Shekhar	0	F	: 	0
1497613857	35352	IND0000295	Beer Promotion	180290	0	6211		Sally Baxley	0	F	: 	0
1497614228	35352	IND0000295	Beer Promotion	180290	1	6211		Sally Baxley	0	F	: 	0
1498390595	35912	IND0000015	Beef Burger With Cheese	151250	1	2336		Jason Coetzer	0	F	: 	0
1499170329	38458	IND0000010	Lumpia Sayur Semarang	66550	1	3510		Yann Rudermann	0	F	: 	0
1497710700	35496	IND0000317	Be celeng menyatnyat	163350	0	5206		Fabian Chew Keng Teck	0	F	: 	0
1502689006	49824	IND0000051	Vanilla Milkshake & Smoothies	54450	1	2141		Rebecca Mizzi	0	F	: 	0
1498120160	35965	IND0000015	Beef Burger With Cheese	151250	1	6105		Brian Salim	0	F	: 	0
1498279587	35982	IND0000025	Pisang Goreng	66550	0	2201		Andre Sucahya	0	F	: 	0
1497720782	35546	IND0000002	Mie Goreng Jawa	139150	1	6317		Tang Yi Ting	0	F	: 	0
1497721222	35546	IND0000002	Mie Goreng Jawa	139150	0	6317		Tang Yi Ting	0	F	: 	0
1498731484	37535	IND0000303	Soto Ayam Lamongan	151250	1	6212		Danniel Chandra Adisura (pre)	0	F	: 	0
1498739855	37314	IND0000303	Soto Ayam Lamongan	151250	0	3111		Sukaryo Subiyakto	0	F	: 	0
1497539292	35151	IND0000296	Ikan Bakar Jimbaran	272250	0	5221		Truong Thanh Minh	0	F	: 	0
1497789470	35274	IND0000322	Ayam panggang kalas	156090	1	2121		Dian	0	F	: 	0
1497539438	35169	IND0000292	Bebek Betutu	192390	1	6210		Nguyen Thuy Phuong Hang	0	F	: 	0
1497796988	35250	IND0000020	Carbonara Sauce	102850	1	6510		Mansa Kapoor	0	F	: 	0
1497539489	35208	IND0000292	Bebek Betutu	192390	2	2530		Tran Thi Cam	0	F	: 	0
1498147906	36034	IND0000386	club sandwich	127050	1	2340		Matsuoka Takaomi	0	F	: 	0
1497797049	35250	IND0000012	Creamy Mushroom Soup	71390	2	6510		Mansa Kapoor	0	F	: 	0
1497797217	35250	IND0000018	Aglio e Olio	83490	1	6510		Mansa Kapoor	0	F	: 	0
1497797264	35250	IND0000072	Diet Coke	35090	1	6510		Mansa Kapoor	0	F	: 	0
1497797451	35250	IND0000063	Orange  Juice	54450	1	6510		Mansa Kapoor	0	F	: 	0
1497797474	35250	IND0000063	Orange  Juice	54450	0	6510		Mansa Kapoor	0	F	: 	0
1497800125	35250	IND0000025	Pisang Goreng	66550	1	6510		Mansa Kapoor	0	F	: 	0
1498755704	37308	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	6302		Aditi Patel (pre)	0	F	: 	0
1498310711	35836	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	6302		Yahyapournourani Saman	0	F	: 	0
1498318622	36076	IND0000386	club sandwich	127050	0	2512		Kelly Ann Borton	0	F	: 	0
1503562344	52875	IND0000386	club sandwich	127050	2	2137		Khan	0	F	: 	0
1502106246	47643	IND1000044	Panacotta	78650	2	2532		Isabelle Barth	0	F	: 	0
1499588376	40491	IND0000003	Sop Buntut	211750	1	6511		Kemal Anshori	0	F	: 	0
1498820741	37805	IND0000071	Coca - Cola	35090	0	2217		Parveen Chugani	0	F	: 	0
1498821688	37891	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	1219		Kristiana Wulandari	0	F	: 	0
1498482572	36797	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	2529		Gregory Rineberg	0	F	: 	0
1498482620	36797	IND0000019	Bolognaise Meat Sauce	102850	1	2529		Gregory Rineberg	0	F	: 	0
1498482775	36797	IND0000024	Tiramisu Cake	102850	1	2529		Gregory Rineberg	0	F	: 	0
1498821822	37891	IND0000015	Beef Burger With Cheese	151250	0	1219		Kristiana Wulandari	0	F	: 	0
1498822446	37891	IND0000015	Beef Burger With Cheese	151250	1	1219		Kristiana Wulandari	0	F	: 	0
1498822566	37891	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	1219		Kristiana Wulandari	0	F	: 	0
1498822733	37891	IND0000051	Vanilla - Milk Shake & Smoothies	59290	1	1219		Kristiana Wulandari	0	F	: 	0
1498823040	37314	IND0000001	Nasi Goreng Kampoeng	139150	0	3111		Sukaryo Subiyakto	0	F	: 	0
1498823148	37314	IND0000001	Nasi Goreng Kampoeng	139150	2	3111		Sukaryo Subiyakto	0	F	: 	0
1498487638	36386	IND0000009	Gado-Gado	90750	1	3102		Gebby Srihardjo	0	F	: 	0
1502132247	48076	IND0000276	Mojito Mint Ice Tea	42350	2252000	2542		Sri Mulyati Clausen	0	F	: 	0
1504265884	54695	IND0000011	Soup of the Day	66550	1	3131		Soviani Tanujaya	0	F	: 	0
1501342788	45988	IND0000015	Beef Burger With Cheese	151250	1	5510		Jeremy Rip	0	F	: 	0
1498558665	37100	IND0000015	Beef Burger With Cheese	151250	1	2503		Wesly	0	F	: 	0
1503801891	53435	IND0000381	beringer classic	786500	0	2243		Henry Susanto	0	F	: 	0
1499606681	37298	IND0000275	Green Apple Ice Tea	42350	2	6509		Filip Hagen	0	F	: 	0
1504277946	54785	IND0000087	Ice Coffee	36300	0	2525		Wu Jung Ta	0	F	: 	0
1498826419	37419	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	3322		Agus Witjaksono	0	F	: 	0
1504323167	54935	IND0000370	Apple Crumble	66550	0	1205		Mohammad Zarghami	0	F	: 	0
1498826466	37419	IND0000313	Sate lilit ikan	114950	1	3322		Agus Witjaksono	0	F	: 	0
1501071416	45276	IND0000001	Nasi Goreng Kampoeng	139150	1	3106		Derragh Dotson	0	F	: 	0
1499615670	39925	IND0000020	Carbonara Sauce	102850	1	2333		Mikael Kaldegard	0	F	: 	0
1503836909	53800	IND0000363	Potato Wedges	42350	1	3205		Iwan Pontjowinoto	0	F	: 	0
1501842649	47245	IND0000018	Aglio e Olio	83490	1	2136		Gunawan Parlindungan Hutauruk	0	F	: 	0
1499672529	40739	IND0000376	Raspberry Eclair	47190	0	3301		DavinderPal Singh	0	F	: 	0
1499166704	38309	IND0000021	Napolitana Sauce	83490	1	2503		Nicholas Cannon	0	F	: 	0
1499170364	38458	IND0000021	Napolitana Sauce	83490	1	3510		Yann Rudermann	0	F	: 	0
1501861804	47210	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	1509		Teck chuan Sieu	0	F	: 	0
1498564344	36913	IND0000020	Carbonara Sauce	102850	1	2505		Vincent Angdrean	0	F	: 	0
1499684321	40378	IND0000002	Mie Goreng Jawa	139150	1	1311		Fellycia Tobing	0	F	: 	0
1498740429	37314	IND0000002	Mie Goreng Jawa	139150	1	3111		Sukaryo Subiyakto	0	F	: 	0
1498833352	37674	IND0000020	Carbonara Sauce	102850	1	2109		Puti Limbak Tjayo MPM	0	F	: 	0
1498744599	37294	IND0000024	Tiramisu Cake	102850	1	2511		Ary Prasetyo	0	F	: 	0
1498755676	37308	IND0000018	Aglio e Olio	83490	1	6302		Aditi Patel (pre)	0	F	: 	0
1500132860	42142	IND0000386	club sandwich	127050	1	1518		Denis Ibrahim Perdana	0	F	: 	0
1498810160	37793	IND0000064	Aqua Reflection	42350	0	5215		James Kudakuthiyil Chacko	0	F	: 	0
1498810735	37805	IND0000071	Coca - Cola	35090	0	2217		Parveen Chugani	0	F	: 	0
1498812960	37774	IND0000292	Bebek Betutu	192390	0	2510		Hifi Puspa Kirana	0	F	: 	0
1499319118	38035	IND0000386	club sandwich	127050	1	2524		Jillian Kelberg	0	F	: 	0
1499360383	38035	IND0000015	Beef Burger With Cheese	151250	1	2524		Jillian Kelberg	0	F	: 	0
1501505544	45945	IND0000386	club sandwich	127050	1	1512		Xin Yu Wang	0	F	: 	0
1503934779	54177	IND1000040	Bolognaise	102850	1	2236		Alamdeep Singh	0	F	: 	0
1498907041	38045	IND0000304	The Anvaya Prawn Laksa	114950	1	5118		Yulan Qiao	0	F	: 	0
1504010307	54281	IND0000292	Bebek Betutu	192390	1	2210		Kok Leong Wee	0	F	: 	0
1499447669	40012	IND0000082	Cappucino	42350	1	3116		Ankit Malhotra	0	F	: 	0
1498914955	38051	IND0000303	Soto Ayam Lamongan	151250	2	2516		Erwin Santoso	0	F	: 	0
1498915038	38051	IND0000019	Bolognaise Meat Sauce	102850	1	2516		Erwin Santoso	0	F	: 	0
1498923153	37847	IND0000386	club sandwich	127050	2	6523		Philip Punnoose Pachikara	0	F	: 	0
1498923200	37847	IND0000262	Bintang Radler	59290	1	6523		Philip Punnoose Pachikara	0	F	: 	0
1498923215	37847	IND0000262	Bintang Radler	59290	1	6523		Philip Punnoose Pachikara	0	F	: 	0
1501324443	45616	IND0000294	French Fries	42350	4	3158		Natalie Imeson	0	F	: 	0
1501642719	46164	IND1000012	American Breakfast	242000	0	2230		Metib Alresheed	0	F	: 	0
1499569313	40408	IND0000082	Cappucino	42350	1	5122		Katherine Jane Dames	0	F	: 	0
1498998713	37339	IND0000291	Bebek Goreng Kunyit	192390	1	2215		Eka Santoso	0	F	: 	0
1499001828	38457	IND0000002	Mie Goreng Jawa	139150	1	3223		Denny Wibisono P	0	F	: 	0
1499001902	38457	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	3223		Denny Wibisono P	0	F	: 	0
1499057832	38086	IND0000001	Nasi Goreng Kampoeng	139150	1	1102		Yohanes Siemon	0	F	: 	0
1500300436	42577	IND0000064	Aqua Reflection	42350	1	2326		Alex Moscow	0	F	: 	0
1499687105	40800	IND0000077	Hot Tea	36300	1	2537		Biswarup chakraborti	0	F	: 	0
1499687145	40800	IND0000084	Machiato	42350	1	2537		Biswarup chakraborti	0	F	: 	0
1500301184	42238	IND0000020	Carbonara Sauce	102850	1	3125		Alita Widyasari (pre)	0	F	: 	0
1502110660	48051	IND1000031	French Fries	42350	0	1310		Mohammad Bolkhi	0	F	: 	0
1503224606	50692	IND0000001	Nasi Goreng Kampoeng	139150	1	6105		Ann Marie Love	0	F	: 	0
1500088329	41761	IND0000387	fish and chip	121000	0	3308		Fariza Octavia	0	F	: 	0
1503762601	52895	IND1000030	Potato Wedges	42350	0	2220		Adhika Bhatara Syahrial	0	F	: 	0
1504850205	56753	IND0000276	Mojito Mint Ice Tea	42350	1	1215		Natasha Warnock Lai	0	F	: 	0
1499691446	40802	IND0000386	club sandwich	127050	1	5316		Paul D Mate	0	F	: 	0
1500692469	43779	IND0000002	Mie Goreng Jawa	139150	1	2511		Ngatai Tui Rata	0	F	: 	0
1504267900	54697	IND0000292	Bebek Betutu	192390	0	3316		Binawati	0	F	: 	0
1499877205	41447	IND0000377	Chocolate Summer Cake	78650	1	2528		Sonoo	0	F	: 	0
1499877287	41447	IND0000376	Raspberry Eclair	47190	1	2528		Sonoo	0	F	: 	0
1504278061	54785	IND0000091	Ice Chocolate	42350	0	2525		Wu Jung Ta	0	F	: 	0
1499759581	40704	IND0000274	Strawberry Ice Tea	42350	0	3302		Divpreet Pruthi	0	F	: 	0
1504854516	56398	IND0000297	Nasi Goreng Kampoeng	139150	1	3124		Woonjung Kim	0	F	: 	0
1505400964	58068	IND0000018	Aglio e Olio	83490	0	2216		Wonyoung Park	0	F	: 	0
1499936202	41626	IND0000386	club sandwich	127050	1	6205		Jason Fuentes	0	F	: 	0
1499936234	41626	IND0000015	Beef Burger With Cheese	151250	1	6205		Jason Fuentes	0	F	: 	0
1501861327	47039	IND0000297	Nasi Goreng Kampoeng	139150	1	1511		Eri Nakamura	0	F	: 	0
1501429121	45855	IND0000001	Nasi Goreng Kampoeng	139150	1	2242		Carmel Puma Wibowo c/o	0	F	: 	0
1501875669	47222	IND1000035	Nasi Goreng Kampung	139150	1	2316		Chanade Marcell Morley	0	F	: 	0
1499942623	40408	IND0000018	Aglio e Olio	83490	1	6110		Katherine Jane Dames	0	F	: 	0
1499781539	40810	IND0000015	Beef Burger With Cheese	151250	1	2229		Ankita Sohal	0	F	: 	0
1499781788	40810	IND0000015	Beef Burger With Cheese	151250	1	2229		Ankita Sohal	0	F	: 	0
1500133009	42142	IND0000363	Potato Wedges	42350	1	1518		Denis Ibrahim Perdana	0	F	: 	0
1500206672	42089	IND0000066	Equil Natural 380 ml	47190	0	2103		Lin Chia Hua	0	F	: 	0
1500206699	42089	IND0000066	Equil Natural 380 ml	47190	0	2103		Lin Chia Hua	0	F	: 	0
1500716263	43779	IND0000315	Aneka be pasih panggang	284350	0	2511		Ngatai Tui Rata	0	F	: 	0
1501502277	46288	IND0000294	French Fries	42350	2	6111		Meiko Ikezawa	0	F	: 	0
1501167828	45450	IND0000321	Sate campur	139150	0	3206		Liu Wan Yu	0	F	: 	0
1499853209	41375	IND0000081	Cafe Latte	42350	1	3507		Umesh Padia	0	F	: 	0
1500207051	42089	IND0000292	Bebek Betutu	192390	0	2103		Lin Chia Hua	0	F	: 	0
1500207218	42089	IND0000292	Bebek Betutu	192390	32244458	2103		Lin Chia Hua	0	F	: 	0
1501169771	45265	IND0000006	Iga Bakar Bumbu Ketumbar	204490	1	2108		Shelby Nugraha Rachman	0	F	: 	0
1500740136	44148	IND0000018	Aglio e Olio	83490	1	2339		Wan Yin Har	0	F	: 	0
1500740279	44148	IND0000292	Bebek Betutu	192390	0	2339		Wan Yin Har	0	F	: 	0
1505560301	58857	IND0000305	Mie Rebus	114950	0	6308		Kadek Subudi	0	F	: 	0
1505563321	58341	IND0000306	Tipat cantok	66550	0	3128		Lisa Faunce	0	F	: 	0
1501308550	45215	IND0000323	Babi kecap	163350	1	6322		Russell Hodson	0	F	: 	0
1500799145	44695	IND0000363	Potato Wedges	42350	1	3132		Angela Chang	0	F	: 	0
1500799165	44695	IND0000294	French Fries	42350	1	3132		Angela Chang	0	F	: 	0
1500799337	44695	IND0000294	French Fries	42350	0	3132		Angela Chang	0	F	: 	0
1500476558	43271	IND0000292	Bebek Betutu	192390	2	2306		Wiwit Andi Kristiyanto	0	F	: 	0
1500480144	43141	IND0000317	Be celeng menyatnyat	163350	1	2336		Raja Rajan	0	F	: 	0
1501641718	46480	IND0000321	Sate campur	139150	0	2324		Rian	0	F	: 	0
1500535516	43331	IND0000020	Carbonara Sauce	102850	1	2321		See Chun Chiongwinston	0	F	: 	0
1500535555	43331	IND0000014	Steak Sandwiches	180290	1	2321		See Chun Chiongwinston	0	F	: 	0
1500549110	40503	IND0000305	Mie Rebus	114950	1	5218		Savvas Savva	0	F	: 	0
1500549167	40503	IND0000024	Tiramisu Cake	102850	1	5218		Savvas Savva	0	F	: 	0
1500551207	43582	IND0000015	Beef Burger With Cheese	151250	2	6117		Kerrin Girando	0	F	: 	0
1500551316	43582	IND0000045	Frozen Orange, Mint, Ginger	54450	1	6117		Kerrin Girando	0	F	: 	0
1500551353	43582	IND0000049	Passion Cooler	54450	1	6117		Kerrin Girando	0	F	: 	0
1500905438	44999	IND0000019	Bolognaise Meat Sauce	102850	1	2235		Liu Yan	0	F	: 	0
1500905452	44999	IND0000020	Carbonara Sauce	102850	1	2235		Liu Yan	0	F	: 	0
1500905489	44999	IND0000363	Potato Wedges	42350	1	2235		Liu Yan	0	F	: 	0
1500905538	44999	IND0000091	Ice Chocolate	42350	1	2235		Liu Yan	0	F	: 	0
1500905839	44999	IND0000021	Napolitana Sauce	83490	1	2235		Liu Yan	0	F	: 	0
1500641966	43878	IND0000293	Bebek Garang Asem	192390	1	1520		Heidi Mikalsen	0	F	: 	0
1500642020	43878	IND0000019	Bolognaise Meat Sauce	102850	1	1520		Heidi Mikalsen	0	F	: 	0
1500642087	43878	IND0000064	Aqua Reflection	42350	2	1520		Heidi Mikalsen	0	F	: 	0
1500642200	43878	IND0000022	Seasonal Fruit Slices	66550	1	1520		Heidi Mikalsen	0	F	: 	0
1500644377	43948	IND0000292	Bebek Betutu	192390	0	2519		Surin	0	F	: 	0
1500983913	45136	IND0000072	Diet Coke	30250	4	2136		Ian Mckan	0	F	: 	0
1502105632	47643	IND1000018	Bubur Ayam	60500	0	2532		Isabelle Barth	0	F	: 	0
1502130374	48083	IND1000024	Fresh Fruit	60500	1	2222		Yeung Pik Kin Sandy	0	F	: 	0
1503766363	53300	IND1000041	Carbonara	102850	1	3308		Ikhsan Kamil	0	F	: 	0
1503813990	53428	IND0000071	Coca - Cola	30250	0	2512		Supangat Bin Munggoh	0	F	: 	0
1505401067	58068	IND0000302	Aglio e Olio	83490	0	2216		Wonyoung Park	0	F	: 	0
1502198889	47900	IND0000064	Aqua Reflection	42350	0	2208		Vivi Untari	0	F	: 	0
1503228663	50694	IND0000084	Machiato	42350	1	6221		Ghassan Zlitni	0	F	: 	0
1502630501	50104	IND0000384	Chateau Subercaseaux	845790	1	5319		Dalila Bachir	0	F	: 	0
1503574750	52884	IND0000003	Sop Buntut	211750	1	3126		Nurvita sari	0	F	: 	0
1502202936	48207	IND0000305	Mie Rebus	114950	0	3118		Dian Sepertiani Safitri	0	F	: 	0
1503836976	53800	IND0000022	Seasonal Fruit Slices	66550	1	3205		Iwan Pontjowinoto	0	F	: 	0
1503607092	52670	IND1000025	Gado-Gado	90750	0	2242		Detty Rosita	0	F	: 	0
1502659530	49098	IND1000029	Beef Burger	151250	1	6305		Finco Bernardo	0	F	: 	0
1503651932	52927	IND0000015	Beef Burger With Cheese	151250	1	1216		Wang Chen	0	F	: 	0
1502699252	50101	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	3129		Shams Effendi	0	F	: 	0
1503239868	52056	IND0000298	Mie Goreng Jawa	139150	1	3327		Zoelfikri Haroen	0	F	: 	0
1502870036	50685	IND0000387	fish and chip	121000	1	3128		Sagar Makhija	0	F	: 	0
1502718982	50110	IND0000291	Bebek Goreng Kunyit	192390	0	1217		Chienchang Lo	0	F	: 	0
1502870072	50685	IND0000298	Mie Goreng Jawa	139150	1	3128		Sagar Makhija	0	F	: 	0
1502338062	48114	IND0000001	Nasi Goreng Kampoeng	139150	1	3318		Wawan Burhanuddin	0	F	: 	0
1502725517	49789	IND0000294	French Fries	42350	1	2524		Amit Grover	0	F	: 	0
1502870112	50685	IND0000010	Lumpia Sayur Semarang	66550	1	3128		Sagar Makhija	0	F	: 	0
1502881910	50441	IND0000386	club sandwich	127050	1	6102		Ellie Love	0	F	: 	0
1502769475	50054	IND0000292	Bebek Betutu	192390	0	1215		Pamela Hewett	0	F	: 	0
1502782087	50054	IND0000292	Bebek Betutu	192390	0	1215		Pamela Hewett	0	F	: 	0
1502350203	47895	IND0000015	Beef Burger With Cheese	151250	1	2526		Vedant Shrestha	0	F	: 	0
1502350252	47895	IND0000276	Mojito Mint Ice Tea	42350	1	2526		Vedant Shrestha	0	F	: 	0
1502350273	47895	IND0000274	Strawberry Ice Tea	42350	1	2526		Vedant Shrestha	0	F	: 	0
1503240148	52056	IND0000298	Mie Goreng Jawa	139150	3327	3327		Zoelfikri Haroen	0	F	: 	0
1502020426	47728	IND0000384	Chateau Subercaseaux	845790	0	1310		Brent Chandler	0	F	: 	0
1503660088	53240	IND0000001	Nasi Goreng Kampoeng	139150	1	2201		Li Jie	0	F	: 	0
1502804061	50478	IND0000019	Bolognaise Meat Sauce	102850	1	3118		Raoul Fernandes	0	F	: 	0
1502034652	47353	IND0000057	Honey Dew Melon Juice	42350	1	6522		Margaux Kaunang	0	F	: 	0
1502034797	47353	IND0000057	Honey Dew Melon Juice	42350	0	6522		Margaux Kaunang	0	F	: 	0
1502048931	47707	IND1000029	Beef Burger	151250	1	3153		Ahmed Al jaberi	0	F	: 	0
1502048957	47707	IND1000029	Beef Burger	151250	0	3153		Ahmed Al jaberi	0	F	: 	0
1502049010	47707	IND1000040	Bolognaise	102850	0	3153		Ahmed Al jaberi	0	F	: 	0
1502074551	47683	IND1000033	Soup Buntut	211750	0	2122		Gang Li	0	F	: 	0
1502074610	47683	IND1000033	Soup Buntut	211750	0	2122		Gang Li	0	F	: 	0
1502076957	47683	IND1000032	Mushroom Soup	47190	0	2122		Gang Li	0	F	: 	0
1503299603	52134	IND0000299	Napolitana Sauce	83490	1	3328		Sunghoon Jeong	0	F	: 	0
1502954482	51111	IND0000292	Bebek Betutu	192390	0	3222		Sophy Wikanta	0	F	: 	0
1502961477	51141	IND0000305	Mie Rebus	114950	0	2532		Aisyawati Suseno	0	F	: 	0
1502961518	51141	IND0000305	Mie Rebus	114950	0	2532		Aisyawati Suseno	0	F	: 	0
1502961518	51141	IND0000305	Mie Rebus	114950	0	2532		Aisyawati Suseno	0	F	: 	0
1503320832	51854	IND0000019	Bolognaise Meat Sauce	102850	1	2117		Ait Hamou walid	0	F	: 	0
1503331553	52011	IND0000260	Bali Hai	59290	2	2216		Gabriele Altrocchi	0	F	: 	0
1502435196	49183	IND0000015	Beef Burger With Cheese	151250	0	2335		Nitin Ram Potdar	0	F	: 	0
1503375444	52149	IND0000015	Beef Burger With Cheese	151250	2	6116		Philippe Bondon	0	F	: 	0
1503402715	52056	IND0000018	Aglio e Olio	83490	0	3327		Zoelfikri Haroen	0	F	: 	0
1502985583	50479	IND1000041	Carbonara	102850	1	2122		Gegee Namchangcorpa (pre)	0	F	: 	0
1502986993	51313	IND1000027	Lumpia Sayur	66550	2140	2140		Seo Hyoung Won	0	F	: 	0
1502551031	49637	IND0000363	Potato Wedges	42350	1	2241		Ayushi Pandey	0	F	: 	0
1502554747	49789	IND1000031	French Fries	42350	1	3107		Amit Grover	0	F	: 	0
1503477533	52358	IND0000292	Bebek Betutu	192390	0	5303		Yunus Satyaputra	0	F	: 	0
1503019494	50645	IND1000012	American Breakfast	242000	0	3322		Chen Yuanyang	0	F	: 	0
1503040958	51105	IND0000387	fish and chip	121000	2	6108		Dyllan Pickavance Clarke	0	F	: 	0
1503041017	51105	IND0000064	Aqua Reflection	42350	2	6108		Dyllan Pickavance Clarke	0	F	: 	0
1503043616	49097	IND0000051	Vanilla Milkshake & Smoothies	54450	1	6301		Finco Rocco Lorenzo	0	F	: 	0
1503483902	51366	IND0000019	Bolognaise Meat Sauce	102850	1	1316		Thomas Rodgers	0	F	: 	0
1503057413	50990	IND0000291	Bebek Goreng Kunyit	192390	0	2229		Anton Wijaya	0	F	: 	0
1503494700	52421	IND0000387	fish and chip	121000	0	2537		Leo Taruna	0	F	: 	0
1503494749	52421	IND0000001	Nasi Goreng Kampoeng	139150	1	2537		Leo Taruna	0	F	: 	0
1503497648	52688	IND0000291	Bebek Goreng Kunyit	192390	0	6507		Pashaei Mehdi	0	F	: 	0
1503766430	53300	IND1000046	Pisang Goreng	66550	1	3308		Ikhsan Kamil	0	F	: 	0
1504276803	54718	IND0000393	Talamonte	786500	0	2512		Gunawan Gunawan	0	F	: 	0
1504850244	56753	IND0000010	Lumpia Sayur Semarang	66550	1	1215		Natasha Warnock Lai	0	F	: 	0
1503842207	52886	IND0000294	French Fries	42350	1	6215		Andrew Bruce	0	F	: 	0
1503851597	52427	IND1000041	Carbonara	102850	1	6312		Lukasz Witschenbach	0	F	: 	0
1505452626	58524	IND0000370	Apple Crumble	66550	9	2140		Lepa divjakoska	0	F	: 	0
1505738548	59033	IND0000311	Ares bebek	83490	1	6103		Aaron Anthony Kovacevic	0	F	: 	0
1504355683	54461	IND1000028	Steak Sandwich	180290	0	2123		Bu Khader Mohammed Essa A	0	F	: 	0
1504355768	54783	IND1000028	Steak Sandwich	180290	0	2533		Wu Long Chi	0	F	: 	0
1503664293	53244	IND0000292	Bebek Betutu	192390	0	2241		Saeed Alghamdi	0	F	: 	0
1503934745	54177	IND0000298	Mie Goreng Jawa	139150	1	2236		Alamdeep Singh	0	F	: 	0
1503935165	53552	IND0000072	Diet Coke	30250	1	5101		Liu Danxia	0	F	: 	0
1505751437	59366	IND1000029	Beef Burger	151250	1	5103		Raquel Martins	0	F	: 	0
1504361023	54478	IND0000297	Nasi Goreng Kampoeng	139150	1	1303		Fendik Oktafianto ,Kapten Inf (PRE)	0	F	: 	0
1504011310	54281	IND0000292	Bebek Betutu	192390	0	2210		Kok Leong Wee	0	F	: 	0
1504012106	53589	IND0000302	Aglio e Olio	83490	0	2121		Sun Guanjin	0	F	: 	0
1505564048	58560	IND0000305	Mie Rebus	114950	0	6509		Tan Selfita Nurcahya	0	F	: 	0
1504019491	54318	IND1000031	French Fries	42350	1	2539		Jane Armstrong	0	F	: 	0
1505564434	58899	IND0000307	Jukut urab	54450	1	6223		Dina Martiany	0	F	: 	0
1504025026	53724	IND1000033	Soup Buntut	211750	1	2520		Maria Mercè Isern Subich	0	F	: 	0
1504413596	54543	IND0000019	Bolognaise Meat Sauce	102850	1	1210		Rhaema	0	F	: 	0
1504413657	54543	IND0000302	Aglio e Olio	83490	1	1210		Rhaema	0	F	: 	0
1504071182	54029	IND0000010	Lumpia Sayur Semarang	66550	1	1209		Akshay Reddy Thimma	0	F	: 	0
1505652594	58648	IND1000029	Beef Burger	151250	1	3521		Ongko Wardjojo	0	F	: 	0
1504097850	53630	IND0000293	Bebek Garang Asem	192390	0	2234		Wong Chiyuan	0	F	: 	0
1505652928	57122	IND1000028	Steak Sandwich	180290	1	2126		Tania Treacy	0	F	: 	0
1504101882	54282	IND0000387	fish and chip	121000	1	2138		Anna Diong	0	F	: 	0
1504108020	54391	IND1000040	Bolognaise	102850	1	3221		Bianca Carina Sauer	0	F	: 	0
1504108131	54391	IND1000030	Potato Wedges	42350	1	3221		Bianca Carina Sauer	0	F	: 	0
1504108200	54391	IND1000030	Potato Wedges	42350	0	3221		Bianca Carina Sauer	0	F	: 	0
1504110206	54215	IND1000040	Bolognaise	102850	1	6120		Fares Almayan	0	F	: 	0
1504110245	54215	IND1000025	Gado-Gado	90750	1	6120		Fares Almayan	0	F	: 	0
1504110329	54215	IND1000025	Gado-Gado	90750	1	6120		Fares Almayan	0	F	: 	0
1504116052	54399	IND1000034	Mixed sate	139150	1	3205		The Phuc Nguyen	0	F	: 	0
1504154687	53434	IND0000295	Beer Promotion	180290	1	2106		Garycharles Saxild	0	F	: 	0
1504177759	53120	IND0000299	Napolitana Sauce	83490	1	6315		Glenn Alan Pratt	0	F	: 	0
1504540868	55874	IND1000029	Beef Burger	151250	1	2538		Maryam Albuainain	0	F	: 	0
1504550544	55939	IND1000029	Beef Burger	151250	1	2134		Mark Ian Johnstone	0	F	: 	0
1504550616	55939	IND1000031	French Fries	42350	1	2134		Mark Ian Johnstone	0	F	: 	0
1504550775	55939	IND1000029	Beef Burger	151250	1	2134		Mark Ian Johnstone	0	F	: 	0
1504234915	54642	IND0000019	Bolognaise Meat Sauce	102850	1	1307		Nicolas Boily	0	F	: 	0
1504254240	54638	IND1000031	French Fries	42350	1	3156		Michael	0	F	: 	0
1504254342	54638	IND0000297	Nasi Goreng Kampoeng	139150	1	3156		Michael	0	F	: 	0
1504588225	55858	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	2206		Sofian Handani	0	F	: 	0
1504588286	55858	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	0	2206		Sofian Handani	0	F	: 	0
1504588308	55858	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	0	2206		Sofian Handani	0	F	: 	0
1504596507	56224	IND0000089	Ice Coffee Latte	42350	1	5220		Amanda Murphy	0	F	: 	0
1504596603	56224	IND0000010	Lumpia Sayur Semarang	66550	1	5220		Amanda Murphy	0	F	: 	0
1504596703	56224	IND1000029	Beef Burger	151250	1	5220		Amanda Murphy	0	F	: 	0
1504596754	56224	IND0000299	Napolitana Sauce	83490	1	5220		Amanda Murphy	0	F	: 	0
1504596868	56224	IND0000022	Seasonal Fruit Slices	66550	1	5220		Amanda Murphy	0	F	: 	0
1504596986	56224	IND0000010	Lumpia Sayur Semarang	66550	1	5220		Amanda Murphy	0	F	: 	0
1504597068	56224	IND0000018	Aglio e Olio	83490	1	5220		Amanda Murphy	0	F	: 	0
1504617711	55920	IND0000087	Ice Coffee	36300	0	3312		Yu Jie	0	F	: 	0
1504617767	55920	IND0000089	Ice Coffee Latte	42350	0	3312		Yu Jie	0	F	: 	0
1504623807	56546	IND1000033	Soup Buntut	211750	0	5302		Agnieszka Zukowska	0	F	: 	0
1504771562	56658	IND1000028	Steak Sandwich	180290	1	2320		Ahmadi Amirali pre	0	F	: 	0
1504771577	56658	IND1000029	Beef Burger	151250	0	2320		Ahmadi Amirali pre	0	F	: 	0
1504771605	56658	IND1000029	Beef Burger	151250	1	2320		Ahmadi Amirali pre	0	F	: 	0
1504771655	56658	IND0000020	Carbonara Sauce	102850	1	2320		Ahmadi Amirali pre	0	F	: 	0
1504771714	56658	IND0000363	Potato Wedges	42350	1	2320		Ahmadi Amirali pre	0	F	: 	0
1504771751	56658	IND0000071	Coca - Cola	30250	0	2320		Ahmadi Amirali pre	0	F	: 	0
1504771771	56658	IND0000071	Coca - Cola	30250	1	2320		Ahmadi Amirali pre	0	F	: 	0
1504934995	57262	IND0000020	Carbonara Sauce	102850	1	2124		Alicia Labour	0	F	: 	0
1505738817	59033	IND0000311	Ares bebek	83490	1	6103		Aaron Anthony Kovacevic	0	F	: 	0
1505480290	58646	IND0000295	Beer Promotion	180290	1	2232		Mijin Kim	0	F	: 	0
1505502460	58728	IND1000033	Soup Buntut	211750	1	3507		Dong Qinglong	0	F	: 	0
1505751382	59366	IND1000039	Aglio e Olio	83490	1	5103		Raquel Martins	0	F	: 	0
1505751465	59366	IND1000030	Potato Wedges	42350	1	5103		Raquel Martins	0	F	: 	0
1505810679	59466	IND0000299	Napolitana Sauce	83490	1	6121		Muhammad Fikri	0	F	: 	0
1504964412	55939	IND0000020	Carbonara Sauce	102850	1	2134		Mark Ian Johnstone	0	F	: 	0
1505051545	57599	IND0000324	Pisang rai	66550	1	3124		Rengga Temenggung	0	F	: 	0
1505053361	56980	IND0000292	Bebek Betutu	192390	0	2523		Herman Daeng Kuma	0	F	: 	0
1505652623	58648	IND0000386	Club Sandwich	127050	1	3521		Ongko Wardjojo	0	F	: 	0
1505115816	57832	IND0000293	Bebek Garang Asem	192390	0	6501		Hidayat Rachmat	0	F	: 	0
1505926656	59608	IND1000027	Lumpia Sayur	66550	1	2509		Hartana Yessica	0	F	: 	0
1505926680	59608	IND1000035	Nasi Goreng Kampung	139150	1	2509		Hartana Yessica	0	F	: 	0
1506002903	60088	IND0000010	Lumpia Sayur Semarang	66550	1	1512		Chris Ashford	0	F	: 	0
1506002955	60088	IND0000363	Potato Wedges	42350	1	1512		Chris Ashford	0	F	: 	0
1505188543	57905	IND0000303	Soto Ayam Lamongan	151250	1	2138		Bara Frontasia	0	F	: 	0
1505193595	57863	IND0000386	Club Sandwich	127050	1	3128		Deo Riyanto	0	F	: 	0
1505198117	57728	IND0000017	Pan Seared Norwegian Salmon	175450	1	3156		Olesya Abertasova	0	F	: 	0
1505198277	57728	IND0000018	Aglio e Olio	83490	1	3156		Olesya Abertasova	0	F	: 	0
1505206823	58025	IND0000020	Carbonara Sauce	102850	1	3526		Mai Dinh	0	F	: 	0
1505221877	57800	IND1000029	Beef Burger	151250	2	6222		Wioletta Miller	0	F	: 	0
1505222018	57800	IND0000262	Bintang Radler	59290	2	6222		Wioletta Miller	0	F	: 	0
1505222295	57800	IND0000018	Aglio e Olio	83490	0	6222		Wioletta Miller	0	F	: 	0
1506071073	58531	IND0000009	Gado-Gado	90750	0	2118		Carolyn Dundon	0	F	: 	0
1505227315	57819	IND1000029	Beef Burger	151250	1	2517		Charaf Zehani	0	F	: 	0
1505227401	57819	IND0000041	Healthy Life	66550	1	2517		Charaf Zehani	0	F	: 	0
1506074551	59644	IND1000029	Beef Burger	151250	2	6124		Geoffrey Slocum	0	F	: 	0
1506074593	59644	IND0000020	Carbonara Sauce	102850	1	6124		Geoffrey Slocum	0	F	: 	0
1506086233	59270	IND0000386	Club Sandwich	127050	1	2110		Canterry Tep	0	F	: 	0
1506099626	60413	IND0000054	Watermelon Juice	42350	1	3519		Kunal Parikh	0	F	: 	0
1506099650	60413	IND1000031	French Fries	42350	1	3519		Kunal Parikh	0	F	: 	0
1506143903	59599	IND1000029	Beef Burger	151250	1	1306		Jamie Chamberlain	0	F	: 	0
1506143926	59599	IND0000386	Club Sandwich	127050	1	1306		Jamie Chamberlain	0	F	: 	0
1506143980	59599	IND0000091	Ice Chocolate	42350	2	1306		Jamie Chamberlain	0	F	: 	0
1505386803	58341	IND0000018	Aglio e Olio	83490	0	3128		Lisa Faunce	0	F	: 	0
1506164222	59956	IND0000386	Club Sandwich	127050	1	6116		Teguh Tjahjono	0	F	: 	0
1506183936	60531	IND1000029	Beef Burger	151250	1	2520		Novi Sari	0	F	: 	0
1506252560	60677	IND0000387	fish and chip	121000	1	2311		Zhao Yining	0	F	: 	0
\.


--
-- Name: guest_baskets_guest_basket_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_baskets_guest_basket_id_seq', 1, false);


--
-- Data for Name: guest_bills; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_bills (guest_bill_id, guest_reservation_id, guest_bill_date, guest_bill_category, guest_bill_description, guest_bill_remark, guest_bill_reference, guest_bill_debit, guest_bill_credit, guest_bill_balance, guest_bill_quantity, guest_bill_price) FROM stdin;
\.


--
-- Name: guest_bills_guest_bill_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_bills_guest_bill_id_seq', 18, true);


--
-- Data for Name: guest_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_groups (guest_groups_id, guest_groups_code, guest_groups_name, guest_groups_enabled) FROM stdin;
1	632	KALBE	0
3	526	PT.Smart Tbk	0
4	607	SUN PHARMA	0
5	589	BSP - Group Meeting	1
6	754	MONIK &amp; SURYA WEDDING	1
2	821	WINGS	1
\.


--
-- Data for Name: guest_groups_detail; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_groups_detail (guest_groups_detail_id, guest_groups_detail_content, guest_groups_info_id, guest_groups_detail_order) FROM stdin;
80	GM&amp;HMMEETING	7	1
81	schedule1	7	2
82	schedule2	7	3
83	schedule3	7	4
489	1s	14	1
490	2s	14	2
491	2bs	14	3
13	GM&amp;HMMEETING	5	1
14	schedule1	5	2
15	schedule2	5	3
16	schedule3	5	4
17	schedule1	6	1
18	schedule2	6	2
19	schedule3	6	3
492	3s	14	4
493	4s	14	5
28	GM&amp;HMMEETING	8	1
29	schedule1	8	2
30	schedule2	8	3
31	schedule3	8	4
470	a1	13	1
471	a2	13	2
472	a3	13	3
473	a4	13	4
507	hypermart-01	16	1
508	hypermart-02	16	2
509	hypermart-03	16	3
510	hypermart-04	16	4
511	hypermart-05	16	5
512	hypermart-06	16	6
513	hypermart-07	16	7
514	hypermart-08	16	8
515	hypermart-01	17	1
516	hypermart-02	17	2
517	hypermart-03	17	3
127	scheduleGMHM-GM1	10	1
60	schedule1	9	1
61	schedule2	9	2
62	schedule3	9	3
63	GM&amp;HMMEETING	9	4
128	scheduleGMHM-GM2	10	2
129	scheduleGMHM-GM3	10	3
130	scheduleGMHM-HM1	10	4
131	scheduleGMHM-HM2	10	5
68	GM&amp;HMMEETING	4	1
69	schedule1	4	2
70	schedule2	4	3
71	schedule3	4	4
132	scheduleGMHM-HM3	10	6
133	MEMOGMHM1	10	7
134	MEMOGMHM2	10	8
135	MEMOGMHM3	10	9
518	hypermart-04	17	4
519	hypermart-05	17	5
520	hypermart-06	17	6
521	hypermart-07	17	7
522	hypermart-08	17	8
523	kalbe1	18	1
524	kalbe2	18	2
539	dulux1	21	1
541	duluxbig	22	1
546	wedding01	23	1
548	wings	24	1
549	schedulewings	24	2
450	a1	12	1
451	a2	12	2
452	a3	12	3
453	a4	12	4
\.


--
-- Name: guest_groups_detail_guest_groups_detail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_groups_detail_guest_groups_detail_id_seq', 549, true);


--
-- Data for Name: guest_groups_info; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_groups_info (guest_groups_info_id, guest_groups_info_title, guest_groups_info_logo, guest_groups_info_welcome, guest_groups_info_type, guest_groups_info_enabled, guest_groups_code) FROM stdin;
10	GM's and HM's Annual Meeting	hslogo	It is a great pleasure to welcome you on the journey of The ANVAYA Beach Resorts Bali, part of Santika Indonesia Hotels and Resorts.&lt;br&gt;\nWe invite you to immerse yourself in Bali extraordinary rich culture which is represented in three periods in our resort. Indulge in The ANVAYA tantalizing cuisine by our Chef, whether exploring the Balinese &amp; Indonesian specialty at Kunyit Restaurant or discovering the Mediterranean &amp; Californian inspired cuisine at Sands Restaurant. We are delighted to have you stay with us and look forward to making your stay a most memorable one.&lt;br&gt;\nYou will find the meeting itineraries on your IPTV. In it, we hope to have included all of the information you could want or need during your stay with us. The resort information is also available on the IPTV and again our Guest Service will be available at any time should you need useful and interesting information on this beautiful island of Gods, its culture and people.&lt;br&gt;\nFinally, I invite you to contact me personally should there be anything that I or our team can do to make your stay entirely memorable. We are here to help and remain at your service. &lt;br&gt;\nBest wishes,&lt;br&gt;\nHelmy Shaukany\n&lt;br&gt;Resident Manager	image	1	0
5	GM&amp;HM	hslogo	Welcome GM's and HM's Annual Meeting in The ANVAYA Bali	image	1	0
6	GM&amp;HM	hslogo	Welcome GM's and HM's Annual Meeting in The ANVAYA bali	image	1	0
8	GM&amp;HM	hslogo	Welcome GM's and HM's Annual Meeting to The ANVAYA Resort Bali	image	0	0
9	GM and HM Annual Meeting	hslogo	Welcome GM's and HM's Annual Meeting to The ANVAYA Resort Bali	image	1	287
4	GM's and HM's Annual Meeting	hslogo	Welcome GM's and HM's Annual Meeting to The ANVAYA Resort Bali	image	0	0
7	GM's &amp; HM's Annual Meeting	hslogo	Welcome GM's and HM.s Annual Meeting to The ANVAYA Resort Bali	image	1	478
19	SUN  PHARMA GROUP	sun	Dear Sun Pharma Group,&lt;br&gt;\nIt is with great pleasure to welcome you to The Anvaya Beach Resort- Bali and thank you for choosing us for as a place to stay during your holiday in Bali.&lt;br&gt;\nWe are delighted to invite you to enjoy the Balinese &amp; Indonesian delicacies at Kunyit Restaurant, discovering inspired Mediterranean &amp; Californian cuisine at Sands Restaurant, pampering yourself at Sakanti Spa and indulge yourself in our swimming pools and resort facilities.&lt;br&gt;\nPleased to inform that your stay is inclusive of daily breakfast at Sands Restaurant, complimentary Wi-Fi access throughout the resort, free access to the swimming pools, Kids Club and Fitness Center. Any additional request e.g. room service, laundry, spa treatment and other services will be based on cash basis.&lt;br&gt;\nKindly contact our Guest Service should you need further information and wishing you a pleasant stay with us!&lt;br&gt;&lt;br&gt;\nBest regards,\nResort Management	1	1	607
12	Bank Indonesia Institute	logoBI		2	1	0
11	GM and HM National Annual Meeting	hslogo	It is a great pleasure to welcome you on the journey of The ANVAYA Beach Resorts Bali.&lt;br&gt;We invite you to immerse yourself in Bali extraordinary rich culture which is represented in three periods of Bali history in our resort. Indulge in The ANVAYA's tantalizing cuisine by our Chef, whether exploring the Balinese &amp; Indonesian specialty at Kunyit Restaurant or discovering the Mediterranean &amp; Californian inspired cuisine at Sands Restaurant. Whether just relax in The ANVAYA swimming pools or rejuvenate yourself in the barefoot sanctuary at Sakanti Spa. It is our mission to create a bespoke memories in this island to our inquisitive visitors.&lt;br&gt;&lt;br&gt;You will find the National Annual Meeting 2017 itineraries on your IPTV. In it, we hope all the resort complete information including Bali's culture attractions are available during your business meeting and pleasure. Please do not hesitate to consult freely with Guest Service by dialing 0 on your in-room telephone or kindly contact me personally should there be anything we can do to make your stay entirely memorable.&lt;br&gt;&lt;br&gt;Best wishes,&lt;br&gt;Helmy Shaukany		0	0
13	Bank Indonesia Institute	logoBI		2	1	531
14	SMPC 2017	iconlogo_smart-01		2	0	0
16	HYPERMART	hypermart		2	1	418
17	HYPERMART	hypermart		2	1	481
18	The 5th Kalbe International Meeting Expert	kalbe		2	1	632
21	DULUX	delux4		2	1	0
22		delux4		2	1	589
23	MONIK &amp; SURYA WEDDING ITINERARY	default		2	1	754
24	LIONWINGS	wings		2	1	821
\.


--
-- Name: guest_groups_info_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_groups_info_seq', 24, true);


--
-- Name: guest_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_groups_seq', 6, true);


--
-- Data for Name: guest_messages; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_messages (guest_message_id, guest_reservation_id, guest_message_subject, guest_message_content, guest_message_date, guest_message_importance, guest_message_read, guest_message_ref_id, guest_message_from, room_name, guest_message_to) FROM stdin;
494	0	Need wake up call at 07.00AM	Need wake up call at 07.00AM	1469448183	\N	1	\N	Hotel	2123	128
496	0	Need Celebrate For his Son< Name is Agusta 17 thn/ Aldi	Need Celebrate For his Son< Name is Agusta 17 thn/ Aldi	1469452822	\N	0	\N	Hotel	2117	136
497	0	Need wake up call at 08.00Am on 26/7/16	Need wake up call at 08.00Am on 26/7/16	1469453210	\N	1	\N	Hotel	2241	109
501	0	Need booking for spa!!! please booking to spa / aldi	Need booking for spa!!! please booking to spa / aldi	1469457226	\N	0	\N	Hotel	2236	113
524	0	Dear Guest\n\nWelcome To The Anvaya	Dear Guest\n\nWelcome To The Anvaya	1470281312	\N	1	\N	Hotel	2103	409
525	0	Dear Guest\n\nPak Swastika\n\nWelcome To The Anvaya \n\nWish you have a pleasant stay with us	Dear Guest\n\nPak Swastika\n\nWelcome To The Anvaya \n\nWish you have a pleasant stay with us	1470282143	\N	1	\N	Hotel	2103	409
526	0	Dear Guest,\n\nWelcome to The Anvaya Beach Resort Bali\n\nWish you have a pleasant stay with us.\n\nPlease do not hesitate to contact us for further assistance.\n\n\n\nThank You	Dear Guest,\n\nWelcome to The Anvaya Beach Resort Bali\n\nWish you have a pleasant stay with us.\n\nPlease do not hesitate to contact us for further assistance.\n\n\n\nThank You	1470543103	\N	1	\N	Hotel	2107	418
528	0	Dear Mr.Alawami,\n\nKindly be informed that Ibu Yuli left a message for you regarding Bounty Cruise pick up service will pick you up around 16:15-16:30.\n\nBest Regards,\n\nRatih\nFO Supervisor	Dear Mr.Alawami,\n\nKindly be informed that Ibu Yuli left a message for you regarding Bounty Cruise pick up service will pick you up around 16:15-16:30.\n\nBest Regards,\n\nRatih\nFO Supervisor	1473148797	\N	0	\N	Hotel	2126	229
503	0	26/07/2016\n\nreq w/call on 27/07/2016 @06.00. already inform  optr\n\nThank you	26/07/2016\n\nreq w/call on 27/07/2016 @06.00. already inform  optr\n\nThank you	1469518778	\N	0	\N	Hotel	2305	170
504	0	the guest lost luggage in the airport, please f/u	the guest lost luggage in the airport, please f/u	1469535393	\N	0	\N	Hotel	2232	197
529	0	Please prepare a birthday cake for his daughter on 17th September 2016, please surpraise them at the sand restaurant during breakfast.Purwa/AFOM/070916	Please prepare a birthday cake for his daughter on 17th September 2016, please surpraise them at the sand restaurant during breakfast.Purwa/AFOM/070916	1473745942	\N	0	\N	Hotel	2542	548
506	0	Bapaknya ada booking Spa, Balinese massage 60 minutes at 9 am//Gede	Bapaknya ada booking Spa, Balinese massage 60 minutes at 9 am//Gede	1469576564	\N	1	\N	Hotel	2307	205
530	0	Ada titipan 2 Box dari Krisna kept at Concierge.	Ada titipan 2 Box dari Krisna kept at Concierge.	1475959109	\N	0	\N	Hotel	2137	2014
509	0	W/C at 06.15	W/C at 06.15	1469615103	\N	0	\N	Hotel	2239	261
510	0	W/C at 05.30 am	W/C at 05.30 am	1469617589	\N	0	\N	Hotel	2221	255
511	0	W/C at 06.30	W/C at 06.30	1469620363	\N	0	\N	Hotel	2536	244
513	0	Need wake up call at 07.00AM	Need wake up call at 07.00AM	1469624985	\N	0	\N	Hotel	2522	286
514	0	W/C at 08.00	W/C at 08.00	1469629881	\N	0	\N	Hotel	2510	265
523	0	Selamat Datang di The Anvaya Beach Resorts Bali\nPlease enjoy your stay	Selamat Datang di The Anvaya Beach Resorts Bali\nPlease enjoy your stay	1470025535	\N	1	\N	Hotel	2118	378
515	0	Need Wake up call at 05.00 am	Need Wake up call at 05.00 am	1469631270	\N	0	\N	Hotel	2210	292
508	0	27/07/2016\n\nReq w/u call on 28/07/2016 @07.00	27/07/2016\n\nReq w/u call on 28/07/2016 @07.00	1469600727	\N	1	\N	Hotel	2534	237
516	0	W/C at 04.00	W/C at 04.00	1469678252	\N	0	\N	Hotel	2134	284
517	0	Need wake up call at 06.00Am	Need wake up call at 06.00Am	1469713275	\N	1	\N	Hotel	2512	338
499	0	Guest req birthday cake for celebrate his son bday on 25/7/16 .	Guest req birthday cake for celebrate his son bday on 25/7/16 .	1469454179	\N	1	\N	Hotel	2205	68
522	0	tidak boleh di c/o  kan sebelum info ke mbk Astrin	tidak boleh di c/o  kan sebelum info ke mbk Astrin	1469857974	\N	1	\N	Hotel	3212	371
518	0	test	test	1469774187	\N	1	\N	Hotel	3108	367
521	0	KAMAR INI DIGUNAKAN UNTUK TEST IPTV AND ROOM SERVICE\n\nASTRIN	KAMAR INI DIGUNAKAN UNTUK TEST IPTV AND ROOM SERVICE\n\nASTRIN	1469782371	\N	1	\N	Hotel	3108	367
512	0	Ditunggu Pak Gwendy di Lobby lounge pukul 10 Pagi besok ( 28 July )	Ditunggu Pak Gwendy di Lobby lounge pukul 10 Pagi besok ( 28 July )	1469620541	\N	1	\N	Hotel	2133	103
495	0	Need Wake up cal at 07.00am	Need Wake up cal at 07.00am	1469450707	\N	1	\N	Hotel	2526	88
527	0	Please be ready at Lobby at 06:00 am for suttle to Bali Safari	Please be ready at Lobby at 06:00 am for suttle to Bali Safari	1470794047	\N	1	\N	Hotel	2108	423
500	0	He lost 1 luggage in airport\nLuggage dtail : Colour (Brown), Hard case, Medium Size, it will come in 25/7/16 at 15.00>>>>SC is Found, keep at Luggage Room\n\nGuest Ignore Pork and Beef for BF	He lost 1 luggage in airport\nLuggage dtail : Colour (Brown), Hard case, Medium Size, it will come in 25/7/16 at 15.00>>>>SC is Found, keep at Luggage Room\n\nGuest Ignore Pork and Beef for BF	1469454948	\N	1	\N	Hotel	2230	70
498	0	25/07/2016\n\nGuest keep key @reception ( di drawer kiri komputer 23)\n\nThank you	25/07/2016\n\nGuest keep key @reception ( di drawer kiri komputer 23)\n\nThank you	1469453847	\N	1	\N	Hotel	2209	72
502	0	Need booking for spa!!! please booking to spa / aldi	Need booking for spa!!! please booking to spa / aldi	1469491218	\N	1	\N	Hotel	2238	112
505	0	Strong Request late chec-out!!!! / Aldi	Strong Request late chec-out!!!! / Aldi	1469537088	\N	1	\N	Hotel	2228	176
507	0	27/07/2016\n\nReq w/u call on 28/07/2016 @06.30\n\nThank you	27/07/2016\n\nReq w/u call on 28/07/2016 @06.30\n\nThank you	1469596295	\N	1	\N	Hotel	2530	229
531	0	Dear Mr. Saraf Piyush,\n\nWe would like to inform you that your suitcase has been found and now we keep in luggage store. thank you for your attention.\n\n\n\n l	Dear Mr. Saraf Piyush,\n\nWe would like to inform you that your suitcase has been found and now we keep in luggage store. thank you for your attention.\n\n\n\n l	1477048156	\N	0	\N	Hotel	2117	2809
532	0	Dear Mr/s. Stevanof, \n\nKindly to inform you that the Wi-Fi is working now.\nWe do apoligize for the inconvenience caused.\n\nThank you for your good attention.	Dear Mr/s. Stevanof, \n\nKindly to inform you that the Wi-Fi is working now.\nWe do apoligize for the inconvenience caused.\n\nThank you for your good attention.	1477332621	\N	0	\N	Hotel	2324	3421
533	0	Dear Mr. Dody, \n\nKindly to inform you that the Wi-Fi is working now.\nWe do apoligize for the inconvenience caused.\n\nThank you for your good attention.	Dear Mr. Dody, \n\nKindly to inform you that the Wi-Fi is working now.\nWe do apoligize for the inconvenience caused.\n\nThank you for your good attention.	1477365520	\N	0	\N	Hotel	2336	3395
551	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489414162	\N	0	\N	Hotel	5109	22288
552	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489471990	\N	0	\N	Hotel	5116	22250
553	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489553575	\N	0	\N	Hotel	5120	22279
534	0	Dear Valued Guest,\n\nini hanyalah test comm IPTV\n\nuntuk The Anvaya Beach Resort Bali.\n\n\nregards,\n\nManagement	Dear Valued Guest,\n\nini hanyalah test comm IPTV\n\nuntuk The Anvaya Beach Resort Bali.\n\n\nregards,\n\nManagement	1481180799	\N	1	\N	Hotel	5310	9107
535	0	Test SPB IPTV	Test SPB IPTV	1485246183	\N	1	\N	Hotel	5202	14625
536	0	this message is to test.. just test,, nothing more....	this message is to test.. just test,, nothing more....	1485262513	\N	1	\N	Hotel	2141	12920
554	0	Dear Mr. Kim,\n\nWe just have called from Expedia in regard of your next stay, kindly to call back to the expedia.\n\nThank you.\nReceptionist.	Dear Mr. Kim,\n\nWe just have called from Expedia in regard of your next stay, kindly to call back to the expedia.\n\nThank you.\nReceptionist.	1491258892	\N	0	\N	Hotel	2110	24792
537	0	Test test	Test test	1488189344	\N	1	\N	Hotel	6503	20499
538	0	Dear Mr/Mrs. Ashok Mehta\n\nI would like to inform you that tomorrow you will be picked up at 12 noon in the lobby by a panorama destination.\nIf I can be of any assistance, please do not hesitate to press 0 number.\n\nHave a nice day	Dear Mr/Mrs. Ashok Mehta\n\nI would like to inform you that tomorrow you will be picked up at 12 noon in the lobby by a panorama destination.\nIf I can be of any assistance, please do not hesitate to press 0 number.\n\nHave a nice day	1488864918	\N	0	\N	Hotel	6502	21056
539	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489324811	\N	1	\N	Hotel	6109	22275
541	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489325646	\N	0	\N	Hotel	6110	22243
542	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489326173	\N	0	\N	Hotel	5220	22282
543	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489327316	\N	0	\N	Hotel	6112	22285
544	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489330887	\N	0	\N	Hotel	2136	22292
546	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489332800	\N	0	\N	Hotel	3324	22296
547	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489333505	\N	0	\N	Hotel	6111	22247
548	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489333518	\N	0	\N	Hotel	5316	22230
549	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489333880	\N	0	\N	Hotel	6303	22339
540	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489325273	\N	1	\N	Hotel	2226	22267
550	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489413786	\N	0	\N	Hotel	5308	22271
545	0	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	Bagi seluruh peserta NMM PT. APL agar berkumpul di lobby jam 9.00 pagi pada hari Senin, 13 Maret 2017	1489332642	\N	1	\N	Hotel	5310	22236
556	0	Selamat Sore Bp. Dipo Satrio..\n\nKami ingin menginformasikan bahwa ada titipan barang berupa Printer Epson, dan barangnya masih di simpan di bell desk. \n\nUntuk lebih jelasnya Bapak bisa hubungi Operator (0).\nTerimakasih..	Selamat Sore Bp. Dipo Satrio..\n\nKami ingin menginformasikan bahwa ada titipan barang berupa Printer Epson, dan barangnya masih di simpan di bell desk. \n\nUntuk lebih jelasnya Bapak bisa hubungi Operator (0).\nTerimakasih..	1495209888	\N	0	\N	Hotel	6106	31795
555	0	Selamat Sore Bp. Albert \n\nKami ingin menginformasikan bahwa pesanan bapak berupa Pie susu (3 Dus) masih disimpan di Bell Desk. \n\nUntuk lebih jelasnya bisa hubungi Operator (0)\nTerimakasih..	Selamat Sore Bp. Albert \n\nKami ingin menginformasikan bahwa pesanan bapak berupa Pie susu (3 Dus) masih disimpan di Bell Desk. \n\nUntuk lebih jelasnya bisa hubungi Operator (0)\nTerimakasih..	1495190561	\N	1	\N	Hotel	6111	31436
557	0	Selamat Malam Ibu Martini,,\n\nDengan ini kami ingin menginformasikan bahwa Luggage (Bagasi) berwarna hitam milik Ibu sudah kami simpan di Bell desk hotel.\n\nUntuk informasi lebih jelasnya harap hubungi Operator di ext (0)\nTerimakasih..:)	Selamat Malam Ibu Martini,,\n\nDengan ini kami ingin menginformasikan bahwa Luggage (Bagasi) berwarna hitam milik Ibu sudah kami simpan di Bell desk hotel.\n\nUntuk informasi lebih jelasnya harap hubungi Operator di ext (0)\nTerimakasih..:)	1495294726	\N	0	\N	Hotel	3117	31675
559	0	Test test 123\n\nGEDE P	Test test 123\n\nGEDE P	1495436962	\N	1	\N	Hotel	3130	32380
558	0	test test test	test test test	1495436639	\N	1	\N	Hotel	3130	32380
560	0	Dear Ms. Khausik,\nWarmest greeting from Front Office,\nPlease reply the email from Bali Diving this evening for confirmation your booking.\nThank you and have a pleasant stay with us :)	Dear Ms. Khausik,\nWarmest greeting from Front Office,\nPlease reply the email from Bali Diving this evening for confirmation your booking.\nThank you and have a pleasant stay with us :)	1497525844	\N	1	\N	Hotel	6301	34843
561	0	To Mr.Sunita Sharma\n\nRegarding of your request for indian food while the breakfast tomorrow  , that will be handle  by the chef. We do appologize for the  inconvenience.	To Mr.Sunita Sharma\n\nRegarding of your request for indian food while the breakfast tomorrow  , that will be handle  by the chef. We do appologize for the  inconvenience.	1497854788	\N	1	\N	Hotel	6519	35323
562	0	Dear Mr. Patrick,\n\nKindly to infor you that we got a call from Potato Head Seminyak, informed us that your driving license is not found.\n\nRegards,\nEsa/Concierge Supervisor	Dear Mr. Patrick,\n\nKindly to infor you that we got a call from Potato Head Seminyak, informed us that your driving license is not found.\n\nRegards,\nEsa/Concierge Supervisor	1502962352	\N	1	\N	Hotel	6121	49950
563	0	Dear Mr,Wakita,\n\n\nThe Warmest Greetings from ANVAYA..\n\n\nFor kintamani and volcano tour tomorrow will pick up at 08.00 am at hotel lobby. thank yoyu	Dear Mr,Wakita,\n\n\nThe Warmest Greetings from ANVAYA..\n\n\nFor kintamani and volcano tour tomorrow will pick up at 08.00 am at hotel lobby. thank yoyu	1503657977	\N	1	\N	Hotel	5316	52032
564	0	Dear Mr. Ahmed Fathallah,\n\nWarm regards from operator !\n\nWe would like to inform you that you will be pick up at 12.00 to Bayan Tree Ungasan,\n\nIf you need more information, kindly dial 0\n\nThank you\n\nTommy (Operator)	Dear Mr. Ahmed Fathallah,\n\nWarm regards from operator !\n\nWe would like to inform you that you will be pick up at 12.00 to Bayan Tree Ungasan,\n\nIf you need more information, kindly dial 0\n\nThank you\n\nTommy (Operator)	1505103609	\N	0	\N	Hotel	3210	57691
565	0	Dear Ms.Lisa.\n\nWARMEST GREETINGS FROM THE ANVAYA\n\nRegarding yourbooking at La Luciola Restaurant, available only at 18.45 pm.\nNot available at 19.00 pm.  booking code k 24.  thank you.	Dear Ms.Lisa.\n\nWARMEST GREETINGS FROM THE ANVAYA\n\nRegarding yourbooking at La Luciola Restaurant, available only at 18.45 pm.\nNot available at 19.00 pm.  booking code k 24.  thank you.	1506047609	\N	1	\N	Hotel	6103	59033
520	0	Dery	Dery ditunggu di room 3211	1469779141	\N	0	\N	Hotel	Spare	111
\.


--
-- Name: guest_messages_guest_message_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_messages_guest_message_id_seq', 565, true);


--
-- Data for Name: guest_orders; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_orders (guest_order_id, guest_reservation_id, guest_order_roomname, guest_order_guestname, guest_order_received, guest_order_received_date, guest_order_approved, guest_order_type) FROM stdin;
\.


--
-- Data for Name: guest_orders_detail; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_orders_detail (guest_orders_detail_id, guest_order_id, guest_order_code, guest_order_item, guest_order_price, guest_order_qty, guest_order_note) FROM stdin;
\.


--
-- Name: guest_orders_detail_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_orders_detail_seq', 1, false);


--
-- Name: guest_orders_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_orders_seq', 1, false);


--
-- Data for Name: guest_request_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_request_translations (translation_id, guest_request_id, language_id, translation_title, translation_description) FROM stdin;
\.


--
-- Name: guest_request_translations_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_request_translations_seq', 13, true);


--
-- Data for Name: guest_requests; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_requests (guest_request_id, guest_request_value, guest_request_enabled) FROM stdin;
\.


--
-- Name: guest_requests_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_requests_seq', 1, true);


--
-- Data for Name: guest_services; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_services (guest_service_id, guest_reservation_id, guest_service_roomname, guest_service_code, guest_service_note, guest_service_qty, guest_service_guestname, guest_service_item, guest_service_received, guest_service_approved, guest_service_received_date, guest_service_type, guest_service_posted) FROM stdin;
1506245140	25813	5515	\N	\N	\N	Wouter van der Bij	\N	1	1	1506245212	F	0
1506300012	60938	3321	\N	\N	\N	Sansao Gomes	\N	1	1	1506300109	F	0
1506059987	25813	5515	\N	\N	\N	Wouter van der Bij	\N	1	1	1506060181	F	0
1506072429	25813	5515	\N	\N	\N	Wouter van der Bij	\N	1	1	1506072521	F	0
\.


--
-- Data for Name: guest_services_detail; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guest_services_detail (guest_services_detail_id, guest_service_id, guest_service_code, guest_service_item, guest_service_price, guest_service_qty, guest_service_note) FROM stdin;
217	1470994884	IND0000032	Bellini	151250	4	
218	1470994884	IND0000059	Mango Juice	54450	3	
219	1470994962	IND0000032	Bellini	151250	7	
220	1470994962	IND0000061	Apple Juice	54450	1	
221	1471061988	IND0000059	Mango Juice	54450	2	
222	1471061988	IND0000032	Bellini	151250	1	
553	1488630956	IND0000048	Kuta Sunset	54450	1	
554	1488630956	IND0000049	Passion Cooler	54450	1	
555	1488630956	IND0000003	Sop Buntut	211750	1	
556	1488630956	IND0000015	Beef Burger With Cheese	151250	1	
227	1471316032	IND0000005	Bebek Lengkuas	102850	2	
228	1471317758	IND0000012	Creamy Mushroom Soup	71390	1	
742	1492000622	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
230	1471317758	IND0000020	Carbonara Sauce	102850	1	
745	1492097195	IND0000015	Beef Burger With Cheese	151250	1	
232	1471331612	IND0000005	Bebek Lengkuas	102850	1	
746	1492097195	IND0000019	Bolognaise Meat Sauce	102850	1	
751	1492164449	IND0000300	Carbonara Sauce	102850	1	
752	1492164449	IND0000301	Bolognaise Meat Sauce	102850	1	
757	1492317316	IND0000304	The Anvaya Prawn Laksa	114950	0	
1702	1499752971	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
490	1486047713	IND0000297	Nasi Goreng Kampoeng	139150	1	
246	1477352962	IND0000002	Mie Goreng Jawa	127050	1	
422	1484486546	IND0000304	The Anvaya Prawn Laksa	114950	1	
249	1477402493	IND0000063	Orange  Juice	54450	1	
250	1477402493	IND0000055	Pineapple Juice	54450	1	
424	1484489945	IND0000001	Nasi Goreng Kampoeng	139150	1	
425	1484562300	IND0000019	Bolognaise Meat Sauce	102850	1	
169	1469756891	IND0000062	Banana Juice	45000	1	
170	1469758426	IND0000062	Banana Juice	54450	2	
171	1469758426	IND0000062	Banana Juice	54450	1	
172	1469759416	IND0000062	Banana Juice	54450	1	
173	1469773475	IND0000062	Banana Juice	54450	1	
253	1478250356	IND0000015	Beef Burger With Cheese	151250	1	
254	1478356990	IND0000001	Nasi Goreng Kampoeng	139150	1	
176	1470886074	IND0000062	Banana Juice	54450	2	
177	1470886074	IND0000001	Nasi Goreng Kampoeng	139150	1	
178	1470888410		Aglio e Olio	83490	3	
179	1470888410		Aglio e Olio	83490	3	
255	1478839632	IND0000003	Sop Buntut	211750	1	
256	1478839632	IND0000007	Nasi Campur Bali ( Signature Dish)	119790	1	
182	1470888410	IND0000004	Gurami Goreng/ Bakar Sambal Sari Kuring	114950	2	
183	1470899495	IND0000004	Gurami Goreng/ Bakar Sambal Sari Kuring	114950	1	
184	1470904596	IND0000062	Banana Juice	54450	5	
185	1470904596	IND0000004	Gurami Goreng/ Bakar Sambal Sari Kuring	114950	1	
186	1470985976	IND0000062	Banana Juice	54450	2	
187	1470985976	IND0000002	Mie Goreng Jawa	127050	1	
257	1478839632	IND0000273	Lychee Ice Tea	42350	1	
258	1478848698	IND0000007	Nasi Campur Bali ( Signature Dish)	119790	1	
259	1478848698	IND0000005	Bebek Lengkuas	102850	1	
260	1478853742	IND0000260	Bali Hai	54450	1	
261	1478853742	IND0000002	Mie Goreng Jawa	127050	1	
262	1478853742	IND0000010	Lumpia Sayur Semarang	66550	1	
194	1470987398	IND0000062	Banana Juice	54450	5	
195	1470987398	IND0000001	Nasi Goreng Kampoeng	139150	4	
263	1478854894	IND0000022	Seasonal Fruit Slices	66550	1	
264	1478854894	IND0000019	Bolognaise Meat Sauce	102850	1	
265	1478930978	IND0000019	Bolognaise Meat Sauce	102850	1	
266	1478930978	IND0000019	Bolognaise Meat Sauce	102850	1	
426	1484562378	IND0000297	Nasi Goreng Kampoeng	139150	1	
427	1484562453	IND0000015	Beef Burger With Cheese	151250	1	
575	1488960535	IND0000060	Strawberry Juice	54450	1	
576	1488960535	IND0000019	Bolognaise Meat Sauce	102850	1	
577	1488960535	IND0000015	Beef Burger With Cheese	151250	1	
578	1488960535	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
579	1488960535	IND0000260	Bali Hai	54450	2	
580	1488970030	IND0000295	Beer Promotion	180290	1	
584	1489123829	IND0000018	Aglio e Olio	83490	1	
350	1482721785	IND0000001	Nasi Goreng Kampoeng	139150	1	
588	1489195587	IND0000291	Bebek Goreng Kunyit	192390	1	
589	1489218996	IND0000020	Carbonara Sauce	102850	1	
590	1489229492	IND0000304	The Anvaya Prawn Laksa	114950	1	
591	1489229492	IND0000015	Beef Burger With Cheese	151250	1	
291	1480402582	IND0000025	Pisang Goreng	66550	1	
292	1480402582	IND0000009	Gado-Gado	90750	1	
293	1480403247	IND0000065	Aqua Reflection Sparkling	47190	2	
294	1480403247	IND0000060	Strawberry Juice	54450	2	
295	1480403247	IND0000015	Beef Burger With Cheese	151250	1	
449	1484985518	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	0	
450	1484985518	IND0000291	Bebek Goreng Kunyit	192390	0	
300	1480598865	IND0000025	Pisang Goreng	66550	1	
531	1487844022	IND0000020	Carbonara Sauce	102850	1	
466	1485245036	IND0000297	Nasi Goreng Kampoeng	139150	9	
467	1485245036	IND0000051	Vanilla - Milk Shake & Smoothies	59290	3	
468	1485245036	IND0000089	Ice Coffee Latte	42350	2	
532	1487850945	IND0000019	Bolognaise Meat Sauce	102850	1	
536	1488084322	IND0000015	Beef Burger With Cheese	151250	1	
537	1488084322	IND0000025	Pisang Goreng	66550	1	
538	1488084322	IND0000054	Watermelon Juice	54450	1	
539	1488084322	IND0000291	Bebek Goreng Kunyit	192390	2	
540	1488292166	IND0000055	Pineapple Juice	54450	0	
541	1488292166	IND0000063	Orange  Juice	54450	1	
542	1488292166	IND0000001	Nasi Goreng Kampoeng	139150	1	
543	1488292166	IND0000002	Mie Goreng Jawa	139150	1	
1703	1499752971	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
747	1492156681	IND0000089	Ice Coffee Latte	42350	2	
748	1492156681	IND0000089	Ice Coffee Latte	42350	0	
753	1492231180	IND0000003	Sop Buntut	211750	1	
607	1489585767	IND0000294	French Fries	42350	1	
608	1489585767	IND0000010	Lumpia Sayur Semarang	66550	1	
609	1489595040	IND0000022	Seasonal Fruit Slices	66550	1	
610	1489595040	IND0000001	Nasi Goreng Kampoeng	139150	1	
611	1489595040	IND0000009	Gado-Gado	90750	1	
612	1489595040	IND0000020	Carbonara Sauce	102850	1	
754	1492231180	IND0000002	Mie Goreng Jawa	139150	1	
2180	1502807842	IND0000075	Soda	30250	1	
920	1493814221	IND0000379	Vanilla Creme Brule	59290	1	
921	1493814221	IND0000001	Nasi Goreng Kampoeng	139150	1	
763	1492417369	IND0000296	Ikan Bakar Jimbaran	272250	2	
618	1489738935	IND0000305	Mie Rebus	114950	1	
619	1489738935	IND0000297	Nasi Goreng Kampoeng	139150	1	
779	1492667376	IND0000272	Peach Ice Tea	42350	1	
780	1492667376	IND0000276	Mojito Mint Ice Tea	42350	1	
781	1492667376	IND0000022	Seasonal Fruit Slices	66550	1	
627	1489917576	IND0000025	Pisang Goreng	66550	1	
628	1489917576	IND0000050	Green Garden	54450	1	
629	1489917576	IND0000024	Tiramisu Cake	102850	1	
630	1489917576	IND0000010	Lumpia Sayur Semarang	66550	1	
631	1489917576	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
785	1492672911	IND0000089	Ice Coffee Latte	42350	1	
786	1492672911	IND0000375	Tiramisu	151250	1	
787	1492672911	IND0000010	Lumpia Sayur Semarang	66550	1	
788	1492672911	IND0000297	Nasi Goreng Kampoeng	139150	1	
636	1490008733	IND0000050	Green Garden	54450	1	
637	1490008733	IND0000020	Carbonara Sauce	102850	1	
638	1490008733	IND0000001	Nasi Goreng Kampoeng	139150	1	
639	1490008733	IND0000010	Lumpia Sayur Semarang	66550	1	
640	1490097043	IND0000001	Nasi Goreng Kampoeng	139150	1	
641	1490097043	IND0000010	Lumpia Sayur Semarang	66550	1	
642	1490097043	IND0000009	Gado-Gado	90750	1	
643	1490264243	IND0000003	Sop Buntut	211750	1	
644	1490264243	IND0000001	Nasi Goreng Kampoeng	139150	1	
645	1490266576	IND0000022	Seasonal Fruit Slices	66550	1	
646	1490266576	IND0000303	Soto Ayam Lamongan	151250	1	
647	1490267624	IND0000002	Mie Goreng Jawa	139150	0	
648	1490419897	IND0000291	Bebek Goreng Kunyit	192390	1	
649	1490419897	IND0000297	Nasi Goreng Kampoeng	139150	1	
650	1490419897	IND0000301	Bolognaise Meat Sauce	102850	1	
789	1492672911	IND0000273	Lychee Ice Tea	42350	1	
652	1490430560	IND0000020	Carbonara Sauce	102850	1	
653	1490430560	IND0000010	Lumpia Sayur Semarang	66550	1	
654	1490508645	IND0000010	Lumpia Sayur Semarang	66550	1	
655	1490508645	IND0000003	Sop Buntut	211750	1	
656	1490615765	IND0000304	The Anvaya Prawn Laksa	114950	1	
657	1490615765	IND0000291	Bebek Goreng Kunyit	192390	1	
658	1490615765	IND0000001	Nasi Goreng Kampoeng	139150	1	
659	1490616829	IND0000304	The Anvaya Prawn Laksa	114950	1	
663	1490699423	IND0000363	Potato Wedges	42350	1	
664	1490699423	IND0000265	Corona	107690	2	
665	1490699423	IND0000024	Tiramisu Cake	102850	2	
666	1490699423	IND0000001	Nasi Goreng Kampoeng	139150	1	
667	1490699423	IND0000002	Mie Goreng Jawa	139150	1	
668	1490699423	IND0000012	Creamy Mushroom Soup	71390	1	
669	1490703474	IND0000363	Potato Wedges	42350	1	
670	1490703474	IND0000089	Ice Coffee Latte	42350	1	
671	1490703474	IND0000018	Aglio e Olio	83490	2	
675	1490784566	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
676	1490797560	IND0000061	Apple Juice	54450	1	
677	1490797560	IND0000024	Tiramisu Cake	102850	1	
678	1490797560	IND0000015	Beef Burger With Cheese	151250	1	
679	1490797560	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
680	1490853054	IND0000276	Fresh Mint Ice Tea	42350	1	
681	1490853054	IND0000022	Seasonal Fruit Slices	66550	1	
682	1490853054	IND0000009	Gado-Gado	90750	1	
683	1490873770	IND0000065	Aqua Reflection Sparkling	47190	1	
684	1490873770	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
685	1490954654	IND0000298	Mie Goreng Jawa	139150	1	
686	1490954654	IND0000297	Nasi Goreng Kampoeng	139150	1	
687	1490963258	IND0000019	Bolognaise Meat Sauce	102850	1	
688	1491027750	IND0000003	Sop Buntut	211750	1	
689	1491034225	IND0000009	Gado-Gado	90750	1	
690	1491041772	IND0000015	Beef Burger With Cheese	151250	1	
691	1491041772	IND0000020	Carbonara Sauce	102850	1	
697	1491107465	IND0000003	Sop Buntut	211750	1	
698	1491107465	IND0000006	Iga Bakar Bumbu Ketumbar	204490	1	
699	1491197806	IND0000025	Pisang Goreng	66550	1	
700	1491197806	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
701	1491209388	IND0000019	Bolognaise Meat Sauce	102850	1	
702	1491216661	IND0000276	Fresh Mint Ice Tea	42350	2	
703	1491216661	IND0000291	Bebek Goreng Kunyit	192390	1	
704	1491220039	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
705	1491220039	IND0000015	Beef Burger With Cheese	151250	1	
706	1491220039	IND0000012	Creamy Mushroom Soup	71390	1	
711	1491373685	IND0000297	Nasi Goreng Kampoeng	139150	2	
712	1491405741	IND0000294	French Fries	42350	1	
713	1491405741	IND0000020	Carbonara Sauce	102850	1	
714	1491463493	IND0000015	Beef Burger With Cheese	151250	1	
715	1491564394	IND0000020	Carbonara Sauce	102850	1	
718	1491650049	IND0000363	Potato Wedges	42350	1	
719	1491650049	IND0000015	Beef Burger With Cheese	151250	1	
744	1492084566	IND0000021	Napolitana Sauce	83490	1	
1203	1496314771	IND0000386	club sandwich	127050	1	
1204	1496314771	IND0000015	Beef Burger With Cheese	151250	1	
755	1492302428	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
726	1491730200	IND0000082	Cappucino	42350	1	
727	1491730200	IND0000293	Bebek Garang Asem	192390	1	
756	1492302428	IND0000015	Beef Burger With Cheese	151250	1	
729	1491746899	IND0000297	Nasi Goreng Kampoeng	139150	1	
730	1491885619	IND0000276	Fresh Mint Ice Tea	42350	1	
731	1491885619	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
732	1491885619	IND0000009	Gado-Gado	90750	1	
733	1491899396	IND0000297	Nasi Goreng Kampoeng	139150	1	
1704	1499768486	IND0000058	Papaya Juice	54450	1	
1705	1499768486	IND0000303	Soto Ayam Lamongan	151250	1	
923	1493901801	IND0000010	Lumpia Sayur Semarang	66550	1	
924	1493901801	IND0000020	Carbonara Sauce	102850	1	
925	1493901801	IND0000009	Gado-Gado	90750	1	
2386	1504079068	IND0000351	Cramcam ayam	66550	0	
2387	1504079068	IND0000294	French Fries	42350	1	
741	1491927942	IND0000306	Tipat cantok	66550	1	
1216	1496418105	IND0000386	club sandwich	127050	1	
929	1494068711	IND0000294	French Fries	42350	1	
930	1494086672	IND0000294	French Fries	42350	0	
931	1494150022	IND0000015	Beef Burger With Cheese	151250	1	
1217	1496418105	IND0000015	Beef Burger With Cheese	151250	1	
1728	1499952803	IND0000020	Carbonara Sauce	102850	1	
1729	1499952803	IND0000291	Bebek Goreng Kunyit	192390	1	
2388	1504079068	IND0000019	Bolognaise Meat Sauce	102850	1	
1748	1500027157	IND0000015	Beef Burger With Cheese	151250	1	
1749	1500027157	IND0000058	Papaya Juice	54450	1	
1750	1500027157	IND0000320	Kambing menyatnyat	175450	1	
1249	1496940857	IND0000051	Vanilla - Milk Shake & Smoothies	59290	1	
795	1492698087	IND0000368	Aneka Be Pasih Megoreng	284350	0	
796	1492698087	IND0000379	Vanilla Creme Brule	59290	1	
797	1492698087	IND0000294	French Fries	42350	1	
941	1494255858	IND0000389	Mosco Mule	119790	1	
942	1494255858	IND0000394	Tequila Sunrise	119790	1	
943	1494255858	IND0000021	Napolitana Sauce	83490	1	
944	1494255858	IND0000370	Apple Crumble	66550	1	
803	1492784220	IND0000020	Carbonara Sauce	102850	1	
945	1494255858	IND0000370	Apple Crumble	66550	0	
946	1494255858	IND0000020	Carbonara Sauce	102850	1	
806	1492788360	IND0000001	Nasi Goreng Kampoeng	139150	1	
807	1492790654	IND0000019	Bolognaise Meat Sauce	102850	1	
961	1494420696	IND0000324	Pisang rai	66550	1	
962	1494420696	IND0000373	Panna Cotta	78650	1	
963	1494420696	IND0000048	Kuta Sunset	54450	1	
964	1494420696	IND0000294	French Fries	42350	1	
965	1494420696	IND0000021	Napolitana Sauce	83490	1	
966	1494420696	IND0000002	Mie Goreng Jawa	139150	1	
967	1494420696	IND0000382	blue lagoon	119790	1	
968	1494426834	IND0000018	Aglio e Olio	83490	1	
969	1494428918	IND0000020	Carbonara Sauce	102850	1	
973	1494479372	IND0000363	Potato Wedges	42350	1	
974	1494484135	IND0000052	Chocolate - Milk Shake & Smoothies	59290	0	
975	1494484135	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
976	1494484135	IND0000386	club sandwich	127050	1	
840	1493044348	IND0000019	Bolognaise Meat Sauce	102850	1	
841	1493044348	IND0000021	Napolitana Sauce	83490	1	
847	1493210227	IND0000313	Sate lilit ikan	114950	1	
850	1493271102	IND0000002	Mie Goreng Jawa	139150	1	
855	1493296998	IND0000380	30 Mile	786500	1	
856	1493299349	IND0000045	Frozen Orange, Mint, Ginger	54450	1	
857	1493299349	IND0000045	Frozen Orange, Mint, Ginger	54450	1	
858	1493299349	IND0000379	Vanilla Creme Brule	59290	1	
859	1493299349	IND0000377	Chocolate Summer Cake	78650	1	
860	1493299494	IND0000294	French Fries	42350	1	
861	1493299494	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
868	1493307620	IND0000393	Talamonte	786500	1	
872	1493376826	IND0000273	Lychee Ice Tea	42350	1	
873	1493376826	IND0000293	Bebek Garang Asem	192390	1	
874	1493376826	IND0000294	French Fries	42350	1	
875	1493376826	IND0000308	Ayam pelalah	71390	1	
876	1493376826	IND0000314	Udang bakar bumbu merah	260150	1	
880	1493470536	IND0000327	Es podeng	66550	1	
881	1493470536	IND0000048	Kuta Sunset	54450	1	
882	1493470536	IND0000047	Blue Fairy	54450	1	
883	1493470536	IND0000015	Beef Burger With Cheese	151250	1	
884	1493470536	IND0000296	Ikan Bakar Jimbaran	272250	1	
885	1493480064	IND0000010	Lumpia Sayur Semarang	66550	1	
886	1493480064	IND0000010	Lumpia Sayur Semarang	66550	0	
887	1493480064	IND0000021	Napolitana Sauce	83490	1	
891	1493530713	IND0000054	Watermelon Juice	54450	0	
892	1493530713	IND0000054	Watermelon Juice	54450	0	
893	1493530713	IND0000363	Potato Wedges	42350	1	
894	1493530713	IND0000015	Beef Burger With Cheese	151250	1	
895	1493530713	IND0000386	club sandwich	127050	1	
896	1493535853	IND0000261	Bintang	54450	1	
897	1493535853	IND0000261	Bintang	54450	0	
898	1493535853	IND0000261	Bintang	54450	1	
899	1493550074	IND0000370	Apple Crumble	66550	1	
900	1493550074	IND0000379	Vanilla Creme Brule	59290	1	
901	1493550074	IND0000376	Raspberry Eclair	47190	1	
902	1493550074	IND0000363	Potato Wedges	42350	1	
903	1493550074	IND0000010	Lumpia Sayur Semarang	66550	1	
906	1493557024	IND0000260	Bali Hai	54450	2	
977	1494484135	IND0000294	French Fries	42350	1	
2389	1504096560	IND0000072	Diet Coke	30250	3	
1212	1496407400	IND0000001	Nasi Goreng Kampoeng	139150	1	
980	1494501897	IND0000264	Heineken	66550	2	
981	1494511089	IND0000074	Ginger Ale	35090	1	
982	1494511089	IND0000363	Potato Wedges	42350	1	
1213	1496407400	IND0000091	Ice Chocolate	42350	1	
1218	1496471305	IND0000387	fish and chip	121000	1	
985	1494517634	IND0000021	Napolitana Sauce	83490	1	
986	1494562809	IND0000386	club sandwich	127050	1	
987	1494580739	IND0000294	French Fries	42350	1	
988	1494580739	IND0000021	Napolitana Sauce	83490	1	
989	1494580739	IND0000305	Mie Rebus	114950	1	
1219	1496471305	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
1220	1496471305	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1221	1496471305	IND0000015	Beef Burger With Cheese	151250	1	
993	1494594586	IND0000370	Apple Crumble	66550	1	
994	1494649949	IND0000300	Carbonara Sauce	102850	1	
995	1494650973	IND0000295	Beer Promotion	180290	1	
996	1494661319	IND0000386	club sandwich	127050	1	
997	1494666789	IND0000295	Beer Promotion	180290	1	
998	1494671608	IND0000304	The Anvaya Prawn Laksa	114950	1	
999	1494671608	IND0000301	Bolognaise Meat Sauce	102850	1	
1000	1494673347	IND0000056	Carrot Juice	54450	1	
1001	1494673347	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
1002	1494673347	IND0000002	Mie Goreng Jawa	139150	1	
1003	1494673347	IND0000001	Nasi Goreng Kampoeng	139150	2	
1004	1494679582	IND0000002	Mie Goreng Jawa	139150	1	
1225	1496586693	IND0000294	French Fries	42350	1	
1226	1496586693	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
2390	1504096560	IND0000294	French Fries	42350	1	
1719	1499871271	IND0000015	Beef Burger With Cheese	151250	1	
1730	1499956959	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1010	1494736040	IND0000379	Vanilla Creme Brule	59290	1	
1011	1494736040	IND0000297	Nasi Goreng Kampoeng	139150	1	
1012	1494736040	IND0000301	Bolognaise Meat Sauce	102850	1	
1013	1494736040	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1240	1496759382	IND0000022	Seasonal Fruit Slices	66550	1	
1241	1496759382	IND0000323	Babi kecap	163350	1	
1016	1494758736	IND0000379	Vanilla Creme Brule	59290	1	
1017	1494758736	IND0000386	club sandwich	127050	1	
1018	1494758736	IND0000019	Bolognaise Meat Sauce	102850	1	
1025	1494775892	IND0000021	Napolitana Sauce	83490	1	
1026	1494819097	IND0000014	Steak Sandwiches	139150	1	
1027	1494819097	IND0000275	Green Apple Ice Tea	42350	1	
1028	1494819097	IND0000295	Beer Promotion	180290	2	
1029	1494832896	IND0000370	Apple Crumble	66550	2	
1030	1494832896	IND0000298	Mie Goreng Jawa	139150	1	
1031	1494832896	IND0000297	Nasi Goreng Kampoeng	139150	1	
1036	1494851639	IND0000386	club sandwich	127050	1	
1037	1494851639	IND0000003	Sop Buntut	211750	1	
1038	1494865675	IND0000001	Nasi Goreng Kampoeng	139150	1	
1039	1494865675	IND0000089	Ice Coffee Latte	42350	1	
1044	1494913685	IND0000021	Napolitana Sauce	83490	1	
1045	1494924699	IND0000297	Nasi Goreng Kampoeng	139150	1	
1048	1494942410	IND0000089	Ice Coffee Latte	42350	1	
1049	1494942410	IND0000001	Nasi Goreng Kampoeng	139150	1	
1050	1494947758	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
1059	1495028681	IND0000002	Mie Goreng Jawa	139150	1	
1060	1495028681	IND0000295	Beer Promotion	180290	1	
1061	1495029362	IND0000348	Megibung tenganan	429550	1	
1062	1495040725	IND0000297	Nasi Goreng Kampoeng	139150	1	
1063	1495040725	IND0000082	Cappucino	42350	2	
1064	1495086536	IND0000064	Aqua Reflection	42350	1	
1065	1495086536	IND0000043	Green Machine	66550	1	
1066	1495086536	IND0000319	Be siap sambal matah	156090	1	
1067	1495086536	IND0000322	Ayam panggang kalas	156090	1	
1071	1495113172	IND0000020	Carbonara Sauce	102850	1	
1073	1495193605	IND0000322	Ayam panggang kalas	156090	1	
1081	1495198808	IND0000019	Bolognaise Meat Sauce	102850	1	
1083	1495262554	IND0000299	Napolitana Sauce	83490	1	
1084	1495262554	IND0000386	club sandwich	127050	1	
1085	1495262554	IND0000305	Mie Rebus	114950	1	
1086	1495276472	IND0000368	Aneka Be Pasih Megoreng	284350	0	
1087	1495276472	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
1088	1495276472	IND0000020	Carbonara Sauce	102850	1	
1089	1495285260	IND0000003	Sop Buntut	211750	1	
1093	1495341031	IND0000019	Bolognaise Meat Sauce	102850	1	
1094	1495342166	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1099	1495374408	IND0000052	Chocolate - Milk Shake & Smoothies	59290	0	
1100	1495374408	IND0000064	Aqua Reflection	42350	2	
1101	1495374408	IND0000327	Es podeng	66550	2	
1102	1495374408	IND0000292	Bebek Betutu	192390	1	
1103	1495374408	IND0000322	Ayam panggang kalas	156090	1	
1109	1495463142	IND0000015	Beef Burger With Cheese	151250	1	
1110	1495554500	IND0000015	Beef Burger With Cheese	151250	0	
1111	1495554865	IND0000001	Nasi Goreng Kampoeng	139150	1	
1112	1495554865	IND0000009	Gado-Gado	90750	1	
1113	1495554865	IND0000294	French Fries	42350	1	
1114	1495554865	IND0000391	Sababay Pink Blossom	544500	1	
1115	1495556825	IND0000022	Seasonal Fruit Slices	66550	1	
1117	1495606810	IND0000010	Lumpia Sayur Semarang	66550	1	
1124	1495631545	IND0000014	Steak Sandwiches	180290	1	
1125	1495631545	IND0000304	The Anvaya Prawn Laksa	114950	1	
1126	1495676911	IND0000295	Beer Promotion	180290	1	
1127	1495692039	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1128	1495692039	IND0000291	Bebek Goreng Kunyit	192390	1	
1129	1495701216	IND0000015	Beef Burger With Cheese	151250	1	
1206	1496367901	IND0000012	Creamy Mushroom Soup	71390	1	
1214	1496417706	IND0000024	Tiramisu Cake	102850	1	
1215	1496417706	IND0000377	Chocolate Summer Cake	78650	1	
1222	1496484789	IND0000297	Nasi Goreng Kampoeng	139150	1	
1134	1495720764	IND0000363	Potato Wedges	42350	1	
1135	1495726634	IND0000295	Beer Promotion	180290	0	
1136	1495726634	IND0000295	Beer Promotion	180290	1	
1137	1495726634	IND0000019	Bolognaise Meat Sauce	102850	1	
1138	1495726634	IND0000322	Ayam panggang kalas	156090	1	
1139	1495726634	IND0000010	Lumpia Sayur Semarang	66550	1	
1140	1495773727	IND0000363	Potato Wedges	42350	1	
1708	1499775100	IND0000001	Nasi Goreng Kampoeng	139150	0	
1709	1499775100	IND0000001	Nasi Goreng Kampoeng	139150	2	
1143	1495790447	IND0000387	fish and chip	121000	1	
1144	1495790447	IND0000386	club sandwich	127050	1	
1145	1495802383	IND0000295	Beer Promotion	180290	3	
1146	1495802383	IND0000019	Bolognaise Meat Sauce	102850	1	
1227	1496663192	IND0000380	30 Mile	786500	1	
1150	1495856675	IND0000363	Potato Wedges	42350	1	
1151	1495856675	IND0000015	Beef Burger With Cheese	151250	1	
1152	1495874034	IND0000055	Pineapple Juice	54450	2	
1153	1495874034	IND0000294	French Fries	42350	1	
1154	1495874034	IND0000012	Creamy Mushroom Soup	71390	1	
1155	1495874034	IND0000304	The Anvaya Prawn Laksa	114950	1	
1228	1496663192	IND0000020	Carbonara Sauce	102850	1	
1229	1496663192	IND0000019	Bolognaise Meat Sauce	102850	1	
1158	1495881482	IND0000387	fish and chip	121000	2	
1159	1495881482	IND0000363	Potato Wedges	42350	1	
1163	1495886362	IND0000055	Pineapple Juice	54450	1	
1164	1495886362	IND0000418	Middle East Sahur Menu	0	1	
1165	1495886362	IND0000272	Peach Ice Tea	42350	1	
1166	1495886362	IND0000018	Aglio e Olio	83490	1	
1167	1495901958	IND0000260	Bali Hai	54450	2	
1168	1495901958	IND0000015	Beef Burger With Cheese	151250	1	
1169	1495901958	IND0000014	Steak Sandwiches	180290	1	
1174	1495971833	IND0000274	Strawberry Ice Tea	42350	1	
1175	1495971833	IND0000351	Cramcam ayam	66550	1	
1176	1495971833	IND0000323	Babi kecap	163350	1	
1177	1495971833	IND0000322	Ayam panggang kalas	156090	1	
1178	1495985939	IND0000420	Indonesian Sahur Menu	0	1	
1179	1495985939	IND0000002	Mie Goreng Jawa	139150	1	
1180	1495993904	IND0000019	Bolognaise Meat Sauce	102850	1	
1181	1495993904	IND0000021	Napolitana Sauce	83490	1	
1188	1496167559	IND0000363	Potato Wedges	42350	1	
1189	1496167559	IND0000015	Beef Burger With Cheese	151250	1	
1191	1496214970	IND0000310	Gedang mekuah	54450	1	
1192	1496214970	IND0000386	club sandwich	127050	1	
1193	1496221147	IND0000020	Carbonara Sauce	102850	1	
1196	1496233530	IND0000015	Beef Burger With Cheese	151250	2	
1197	1496240205	IND0000295	Beer Promotion	180290	1	
1198	1496241435	IND0000025	Pisang Goreng	66550	1	
1199	1496241435	IND0000363	Potato Wedges	42350	2	
1235	1496755499	IND0000054	Watermelon Juice	54450	1	
1236	1496755499	IND0000386	club sandwich	127050	1	
1237	1496755499	IND0000012	Creamy Mushroom Soup	71390	1	
1238	1496755499	IND0000067	Equil Sparkling 380 ml	54450	1	
1252	1497015484	IND0000015	Beef Burger With Cheese	151250	1	
1253	1497023936	IND0000019	Bolognaise Meat Sauce	102850	1	
1254	1497023936	IND0000261	Bintang	54450	1	
1255	1497072801	IND0000063	Orange  Juice	54450	1	
1256	1497072801	IND0000057	Honey Dew Melon Juice	54450	1	
1257	1497072801	IND0000061	Apple Juice	54450	1	
1258	1497072801	IND0000002	Mie Goreng Jawa	139150	1	
1259	1497072801	IND0000010	Lumpia Sayur Semarang	66550	1	
1260	1497072801	IND0000292	Bebek Betutu	192390	1	
1261	1497075120	IND0000019	Bolognaise Meat Sauce	102850	1	
1262	1497082163	IND0000010	Lumpia Sayur Semarang	66550	1	
1263	1497091294	IND0000047	Blue Fairy	54450	2	
1264	1497091294	IND0000052	Chocolate - Milk Shake & Smoothies	59290	2	
1265	1497091294	IND0000368	Aneka Be Pasih Megoreng	284350	1	
1266	1497091294	IND0000387	fish and chip	121000	1	
1267	1497091294	IND0000015	Beef Burger With Cheese	151250	1	
1268	1497091294	IND0000020	Carbonara Sauce	102850	1	
1281	1497190283	IND0000305	Mie Rebus	114950	0	
1282	1497190283	IND0000305	Mie Rebus	114950	1	
1283	1497190283	IND0000386	club sandwich	127050	1	
1284	1497190283	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
1285	1497190283	IND0000024	Tiramisu Cake	102850	1	
1286	1497261757	IND0000387	fish and chip	121000	1	
1287	1497261757	IND0000387	fish and chip	121000	0	
1289	1497268241	IND0000051	Vanilla - Milk Shake & Smoothies	59290	1	
1290	1497268241	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
1291	1497268241	IND0000376	Raspberry Eclair	47190	1	
1292	1497268241	IND0000387	fish and chip	121000	1	
1293	1497268241	IND0000012	Creamy Mushroom Soup	71390	1	
1294	1497268241	IND0000386	club sandwich	127050	1	
1295	1497272107	IND0000386	club sandwich	127050	1	
1296	1497272107	IND0000386	club sandwich	127050	0	
1297	1497272107	IND0000387	fish and chip	121000	1	
1298	1497320764	IND0000082	Cappucino	42350	2	
1299	1497365862	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1300	1497367541	IND0000294	French Fries	42350	1	
1301	1497367541	IND0000261	Bintang	54450	2	
1302	1497367541	IND0000322	Ayam panggang kalas	156090	1	
1303	1497420158	IND0000021	Napolitana Sauce	83490	1	
1304	1497441841	IND0000264	Heineken	66550	2	
1305	1497441841	IND0000387	fish and chip	121000	1	
1306	1497441841	IND0000010	Lumpia Sayur Semarang	66550	1	
1710	1499775100	IND0000001	Nasi Goreng Kampoeng	139150	0	
1711	1499775100	IND0000052	Chocolate - Milk Shake & Smoothies	59290	2	
1309	1497501632	IND0000002	Mie Goreng Jawa	139150	1	
1310	1497501632	IND0000386	club sandwich	127050	1	
1311	1497511472	IND0000294	French Fries	42350	1	
1312	1497511472	IND0000019	Bolognaise Meat Sauce	102850	1	
1313	1497511472	IND0000020	Carbonara Sauce	102850	1	
1314	1497511472	IND0000392	Sex On The Beach	119790	1	
1315	1497511472	IND0000388	Gin Fizz	119790	1	
1316	1497522708	IND0000387	fish and chip	121000	1	
1317	1497522708	IND0000305	Mie Rebus	114950	1	
1318	1497522708	IND0000018	Aglio e Olio	83490	1	
1731	1499956959	IND0000386	club sandwich	127050	2	
1324	1497537447	IND0000386	club sandwich	127050	1	
1732	1499956959	IND0000387	fish and chip	121000	1	
1326	1497539701	IND0000260	Bali Hai	54450	3	
1327	1497539701	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	2	
1328	1497539701	IND0000072	Diet Coke	35090	2	
1329	1497539701	IND0000072	Diet Coke	35090	0	
1330	1497539701	IND0000019	Bolognaise Meat Sauce	102850	2	
2446	1504781858	IND0000297	Nasi Goreng Kampoeng	139150	1	
2468	1504956624	IND0000322	Ayam panggang kalas	156090	1	
1336	1497540608	IND0000073	Sprite	35090	0	
1337	1497540608	IND0000045	Frozen Orange, Mint, Ginger	54450	0	
1338	1497540608	IND0000315	Aneka be pasih panggang	284350	0	
2469	1504956624	IND0000323	Babi kecap	163350	1	
2484	1505122929	IND0000052	Chocolate  Milkshake & Smoothies	54450	1	
2485	1505122929	IND0000091	Ice Chocolate	42350	1	
1342	1497587394	IND0000067	Equil Sparkling 380 ml	54450	1	
1343	1497587394	IND0000379	Vanilla Creme Brule	59290	1	
1344	1497587394	IND0000294	French Fries	42350	1	
1345	1497587394	IND0000019	Bolognaise Meat Sauce	102850	1	
1346	1497587394	IND0000296	Ikan Bakar Jimbaran	272250	1	
1347	1497587394	IND0000321	Sate campur	139150	1	
1348	1497624021	IND0000057	Honey Dew Melon Juice	54450	2	
1349	1497624057	IND0000063	Orange  Juice	54450	2	
1350	1497694878	IND0000319	Be siap sambal matah	156090	1	
2499	1505234170	IND0000260	Bali Hai	59290	1	
1353	1497712007	IND0000055	Pineapple Juice	54450	2	
1354	1497712055	IND0000061	Apple Juice	54450	2	
1780	1500042218	IND0000386	club sandwich	127050	1	
1360	1497783663	IND0000054	Watermelon Juice	54450	1	
1361	1497783663	IND0000319	Be siap sambal matah	156090	1	
1362	1497783663	IND0000001	Nasi Goreng Kampoeng	139150	1	
2551	1505554832	IND0000381	beringer classic	786500	1	
2552	1505554832	IND0000381	beringer classic	786500	1	
1367	1497799859	IND0000386	club sandwich	127050	1	
1368	1497799859	IND0000019	Bolognaise Meat Sauce	102850	1	
1369	1497844007	IND0000015	Beef Burger With Cheese	151250	2	
1370	1497844540	IND0000001	Nasi Goreng Kampoeng	139150	1	
1371	1497884726	IND0000294	French Fries	42350	2	
1372	1497889630	IND0000294	French Fries	42350	1	
1379	1497964000	IND0000386	club sandwich	127050	1	
1382	1498060419	IND0000012	Creamy Mushroom Soup	71390	1	
1383	1498060419	IND0000020	Carbonara Sauce	102850	1	
1384	1498060419	IND0000052	Chocolate - Milk Shake & Smoothies	59290	2	
1388	1498111017	IND0000060	Strawberry Juice	54450	1	
1389	1498111017	IND0000063	Orange  Juice	54450	1	
1390	1498111017	IND0000296	Ikan Bakar Jimbaran	272250	1	
1391	1498111017	IND0000020	Carbonara Sauce	102850	1	
1392	1498111017	IND0000292	Bebek Betutu	192390	1	
1393	1498111017	IND0000319	Be siap sambal matah	156090	1	
1394	1498111017	IND0000010	Lumpia Sayur Semarang	66550	1	
1395	1498112867	IND0000056	Carrot Juice	54450	1	
1396	1498112867	IND0000063	Orange  Juice	54450	1	
1397	1498114314	IND0000387	fish and chip	121000	1	
1398	1498114314	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1399	1498114314	IND0000292	Bebek Betutu	192390	1	
1400	1498114314	IND0000319	Be siap sambal matah	156090	1	
1405	1498130634	IND0000294	French Fries	42350	1	
1406	1498130634	IND0000020	Carbonara Sauce	102850	1	
1407	1498130634	IND0000015	Beef Burger With Cheese	151250	2	
1408	1498130780	IND0000091	Ice Chocolate	42350	1	
1409	1498130780	IND0000305	Mie Rebus	114950	1	
1410	1498206120	IND0000025	Pisang Goreng	66550	2	
1411	1498206120	IND0000294	French Fries	42350	1	
1412	1498206120	IND0000091	Ice Chocolate	42350	1	
1413	1498206120	IND0000015	Beef Burger With Cheese	151250	1	
1414	1498216682	IND0000014	Steak Sandwiches	180290	1	
1415	1498228758	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1416	1498228758	IND0000020	Carbonara Sauce	102850	1	
1419	1498240235	IND0000018	Aglio e Olio	83490	1	
1420	1498240235	IND0000014	Steak Sandwiches	180290	1	
1421	1498240235	IND0000386	club sandwich	127050	1	
1422	1498240235	IND0000386	club sandwich	127050	0	
1423	1498240235	IND0000072	Diet Coke	35090	5	
1424	1498247927	IND0000319	Be siap sambal matah	156090	1	
1712	1499787755	IND0000021	Napolitana Sauce	83490	1	
1724	1499904905	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1431	1498287913	IND0000276	Mojito Mint Ice Tea	42350	1	
1432	1498287913	IND0000294	French Fries	42350	1	
1433	1498287913	IND0000025	Pisang Goreng	66550	2	
1434	1498289243	IND0000295	Beer Promotion	180290	1	
1435	1498289886	IND0000296	Ikan Bakar Jimbaran	272250	1	
1436	1498297158	IND0000091	Ice Chocolate	42350	1	
1437	1498297158	IND0000048	Kuta Sunset	54450	1	
1438	1498297158	IND0000291	Bebek Goreng Kunyit	192390	1	
1439	1498297158	IND0000320	Kambing menyatnyat	175450	0	
1440	1498297158	IND0000304	The Anvaya Prawn Laksa	114950	1	
1441	1498297158	IND0000020	Carbonara Sauce	102850	1	
1442	1498307190	IND0000305	Mie Rebus	114950	1	
1445	1498309325	IND0000296	Ikan Bakar Jimbaran	272250	1	
1446	1498309325	IND0000002	Mie Goreng Jawa	139150	1	
2405	1504351043	IND0000377	Chocolate Summer Cake	78650	1	
2406	1504351043	IND0000383	cape code	102850	1	
1449	1498311623	IND0000014	Steak Sandwiches	180290	1	
2407	1504351043	IND0000382	blue lagoon	102850	1	
2408	1504351043	IND0000019	Bolognaise Meat Sauce	102850	1	
2409	1504351043	IND1000031	French Fries	42350	1	
1453	1498319671	IND0000001	Nasi Goreng Kampoeng	139150	1	
1454	1498319671	IND0000319	Be siap sambal matah	156090	1	
1455	1498374210	IND0000058	Papaya Juice	54450	1	
1456	1498374210	IND0000025	Pisang Goreng	66550	2	
2410	1504351043	IND1000029	Beef Burger	151250	1	
1458	1498384281	IND0000294	French Fries	42350	1	
1459	1498384281	IND0000015	Beef Burger With Cheese	151250	1	
1462	1498387115	IND0000023	Panna Cotta	83490	1	
1463	1498387115	IND0000001	Nasi Goreng Kampoeng	139150	1	
1464	1498387115	IND0000020	Carbonara Sauce	102850	1	
1465	1498388125	IND0000002	Mie Goreng Jawa	139150	1	
1466	1498388125	IND0000305	Mie Rebus	114950	1	
1469	1498389658	IND0000003	Sop Buntut	211750	1	
1470	1498389658	IND0000018	Aglio e Olio	83490	1	
1471	1498389658	IND0000001	Nasi Goreng Kampoeng	139150	1	
1472	1498389658	IND0000305	Mie Rebus	114950	1	
1473	1498389658	IND0000313	Sate lilit ikan	114950	1	
1474	1498389730	IND0000003	Sop Buntut	211750	1	
1475	1498390966	IND0000003	Sop Buntut	211750	1	
1476	1498395759	IND0000015	Beef Burger With Cheese	151250	1	
1477	1498397472	IND0000304	The Anvaya Prawn Laksa	114950	1	
1478	1498400629	IND0000317	Be celeng menyatnyat	163350	1	
1482	1498462895	IND0000002	Mie Goreng Jawa	139150	1	
1483	1498462895	IND0000020	Carbonara Sauce	102850	1	
1484	1498466232	IND0000061	Apple Juice	54450	1	
1485	1498466232	IND0000025	Pisang Goreng	66550	1	
1486	1498469854	IND0000387	fish and chip	121000	1	
1487	1498469854	IND0000025	Pisang Goreng	66550	1	
1488	1498470755	IND0000294	French Fries	42350	1	
1489	1498470755	IND0000002	Mie Goreng Jawa	139150	1	
1490	1498472433	IND0000063	Orange  Juice	54450	1	
1491	1498472433	IND0000054	Watermelon Juice	54450	1	
1492	1498486594	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
1493	1498491259	IND0000091	Ice Chocolate	42350	1	
1494	1498559358	IND0000020	Carbonara Sauce	102850	1	
1495	1498562123	IND0000003	Sop Buntut	211750	1	
1496	1498562123	IND0000001	Nasi Goreng Kampoeng	139150	1	
1497	1498563253	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1498	1498563253	IND0000001	Nasi Goreng Kampoeng	139150	1	
1499	1498563253	IND0000303	Soto Ayam Lamongan	151250	1	
1500	1498563253	IND0000305	Mie Rebus	114950	1	
1501	1498563669	IND0000294	French Fries	42350	2	
1502	1498564050	IND0000370	Apple Crumble	66550	1	
1503	1498564090	IND0000377	Chocolate Summer Cake	78650	1	
1504	1498564201	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1505	1498564201	IND0000001	Nasi Goreng Kampoeng	139150	1	
1506	1498564730	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
1507	1498564730	IND0000387	fish and chip	121000	1	
1508	1498569533	IND0000019	Bolognaise Meat Sauce	102850	1	
1509	1498571441	IND0000015	Beef Burger With Cheese	151250	1	
1781	1500042218	IND0000381	beringer classic	786500	1	
1789	1500111350	IND0000292	Bebek Betutu	192390	2	
1790	1500111350	IND0000001	Nasi Goreng Kampoeng	139150	1	
1791	1500111350	IND0000003	Sop Buntut	211750	1	
1794	1500114742	IND0000060	Strawberry Juice	54450	1	
1517	1498646344	IND0000001	Nasi Goreng Kampoeng	139150	1	
1518	1498646344	IND0000021	Napolitana Sauce	83490	1	
1519	1498646344	IND0000003	Sop Buntut	211750	1	
1520	1498647248	IND0000022	Seasonal Fruit Slices	66550	1	
1521	1498647248	IND0000015	Beef Burger With Cheese	151250	1	
1522	1498647248	IND0000305	Mie Rebus	114950	1	
1523	1498647500	IND0000073	Sprite	35090	1	
1524	1498647500	IND0000015	Beef Burger With Cheese	151250	1	
1525	1498647500	IND0000002	Mie Goreng Jawa	139150	1	
2486	1505138078	IND0000387	fish and chip	121000	1	
2487	1505138078	IND0000295	Beer Promotion	180290	1	
1535	1498708926	IND0000015	Beef Burger With Cheese	151250	1	
1536	1498708926	IND0000387	fish and chip	121000	1	
1537	1498713629	IND0000019	Bolognaise Meat Sauce	102850	1	
1538	1498713629	IND0000019	Bolognaise Meat Sauce	102850	1	
1539	1498728342	IND0000303	Soto Ayam Lamongan	151250	1	
1540	1498729804	IND0000294	French Fries	42350	1	
1541	1498729804	IND0000305	Mie Rebus	114950	1	
1542	1498729804	IND0000317	Be celeng menyatnyat	163350	1	
1543	1498733670	IND0000294	French Fries	42350	1	
1544	1498733670	IND0000019	Bolognaise Meat Sauce	102850	1	
1545	1498733670	IND0000021	Napolitana Sauce	83490	1	
1546	1498735090	IND0000015	Beef Burger With Cheese	151250	1	
1547	1498735090	IND0000014	Steak Sandwiches	180290	1	
1548	1498735291	IND0000091	Ice Chocolate	42350	1	
1549	1498735291	IND0000022	Seasonal Fruit Slices	66550	1	
1550	1498735291	IND0000291	Bebek Goreng Kunyit	192390	1	
1551	1498735291	IND0000303	Soto Ayam Lamongan	151250	1	
1552	1498737043	IND0000292	Bebek Betutu	192390	1	
1553	1498737839	IND0000273	Lychee Ice Tea	42350	1	
1554	1498737839	IND0000303	Soto Ayam Lamongan	151250	1	
1555	1498737839	IND0000296	Ikan Bakar Jimbaran	272250	1	
1713	1499827607	IND0000091	Ice Chocolate	42350	1	
1714	1499827607	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
1715	1499827607	IND0000386	club sandwich	127050	2	
1725	1499940443	IND0000386	club sandwich	127050	1	
1736	1500004288	IND0000053	Strawberry - Milk Shake & Smoothies	59290	0	
1737	1500004288	IND0000073	Sprite	35090	1	
1570	1498815451	IND0000001	Nasi Goreng Kampoeng	139150	1	
1571	1498816934	IND0000051	Vanilla - Milk Shake & Smoothies	59290	1	
1572	1498816934	IND0000051	Vanilla - Milk Shake & Smoothies	59290	0	
1573	1498816934	IND0000015	Beef Burger With Cheese	151250	2	
1574	1498816934	IND0000294	French Fries	42350	1	
1575	1498824676	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1576	1498824676	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1577	1498824676	IND0000020	Carbonara Sauce	102850	2	
1578	1498824676	IND0000019	Bolognaise Meat Sauce	102850	1	
1579	1498826746	IND0000063	Orange  Juice	54450	1	
1580	1498826746	IND0000024	Tiramisu Cake	102850	1	
1581	1498826746	IND0000296	Ikan Bakar Jimbaran	272250	1	
1582	1498826746	IND0000019	Bolognaise Meat Sauce	102850	1	
1583	1498826746	IND0000291	Bebek Goreng Kunyit	192390	1	
1584	1498827425	IND0000052	Chocolate - Milk Shake & Smoothies	59290	3	
1585	1498827425	IND0000001	Nasi Goreng Kampoeng	139150	2	
1586	1498827425	IND0000001	Nasi Goreng Kampoeng	139150	1	
1587	1498827651	IND0000363	Potato Wedges	42350	2	
1588	1498827651	IND0000294	French Fries	42350	1	
1589	1498829639	IND0000012	Creamy Mushroom Soup	71390	1	
1590	1498829639	IND0000294	French Fries	42350	1	
1591	1498835933	IND0000001	Nasi Goreng Kampoeng	139150	1	
1592	1498838316	IND0000055	Pineapple Juice	54450	2	
1596	1498902695	IND0000015	Beef Burger With Cheese	151250	1	
1597	1498909807	IND0000020	Carbonara Sauce	102850	1	
1598	1498909807	IND0000020	Carbonara Sauce	102850	1	
1599	1498909807	IND0000379	Vanilla Creme Brule	59290	1	
1600	1498909807	IND0000303	Soto Ayam Lamongan	151250	1	
1601	1498909807	IND0000015	Beef Burger With Cheese	151250	1	
1602	1498909807	IND0000020	Carbonara Sauce	102850	1	
1603	1498910975	IND0000020	Carbonara Sauce	102850	1	
1607	1498923865	IND0000386	club sandwich	127050	1	
1618	1499009473	IND0000071	Coca - Cola	35090	1	
1619	1499009473	IND0000015	Beef Burger With Cheese	151250	1	
1620	1499009923	IND0000313	Sate lilit ikan	114950	1	
1621	1499009923	IND0000091	Ice Chocolate	42350	1	
1622	1499009923	IND0000305	Mie Rebus	114950	1	
1623	1499012248	IND0000305	Mie Rebus	114950	1	
1624	1499076494	IND0000021	Napolitana Sauce	83490	1	
1625	1499076494	IND0000002	Mie Goreng Jawa	139150	1	
1626	1499076494	IND0000025	Pisang Goreng	66550	1	
1627	1499079500	IND0000002	Mie Goreng Jawa	139150	1	
1628	1499079500	IND0000010	Lumpia Sayur Semarang	66550	2	
1629	1499084251	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1630	1499084251	IND0000063	Orange  Juice	54450	2	
1631	1499084251	IND0000319	Be siap sambal matah	156090	1	
1632	1499084251	IND0000294	French Fries	42350	1	
1633	1499084251	IND0000020	Carbonara Sauce	102850	1	
1634	1499141033	IND0000023	Panna Cotta	83490	1	
1635	1499141033	IND0000025	Pisang Goreng	66550	1	
1636	1499141033	IND0000054	Watermelon Juice	54450	1	
1637	1499141033	IND0000063	Orange  Juice	54450	2	
1638	1499141033	IND0000350	Tuna sambal matah	78650	2	
1642	1499172479	IND0000025	Pisang Goreng	66550	1	
1643	1499172479	IND0000081	Cafe Latte	42350	1	
1644	1499172479	IND0000081	Cafe Latte	42350	1	
1647	1499249856	IND0000058	Papaya Juice	54450	1	
1648	1499249856	IND0000002	Mie Goreng Jawa	139150	1	
1649	1499251704	IND0000304	The Anvaya Prawn Laksa	114950	1	
1650	1499251704	IND0000002	Mie Goreng Jawa	139150	1	
1652	1499352115	IND0000020	Carbonara Sauce	102850	1	
1653	1499352115	IND0000010	Lumpia Sayur Semarang	66550	1	
1654	1499352115	IND0000015	Beef Burger With Cheese	151250	1	
1655	1499422486	IND0000060	Strawberry Juice	54450	1	
1656	1499422486	IND0000003	Sop Buntut	211750	1	
1657	1499442712	IND0000294	French Fries	42350	2	
1658	1499443193	IND0000001	Nasi Goreng Kampoeng	139150	1	
1659	1499443193	IND0000002	Mie Goreng Jawa	139150	1	
1660	1499507063	IND0000389	Mosco Mule	119790	1	
1661	1499507063	IND0000392	Sex On The Beach	119790	1	
1664	1499522979	IND0000002	Mie Goreng Jawa	139150	1	
1665	1499532974	IND0000363	Potato Wedges	42350	0	
1666	1499532974	IND0000363	Potato Wedges	42350	1	
1667	1499532974	IND0000020	Carbonara Sauce	102850	1	
2395	1504185278	IND0000072	Diet Coke	30250	3	
1726	1499940497	IND0000060	Strawberry Juice	54450	1	
1727	1499940497	IND0000002	Mie Goreng Jawa	139150	1	
1738	1500004288	IND0000071	Coca - Cola	35090	2	
1739	1500004288	IND0000072	Diet Coke	35090	1	
1740	1500004288	IND0000387	fish and chip	121000	1	
1741	1500004288	IND0000022	Seasonal Fruit Slices	66550	1	
1747	1500020025	IND0000002	Mie Goreng Jawa	139150	1	
2411	1504356804	IND0000089	Ice Coffee Latte	42350	1	
2412	1504356804	IND0000292	Bebek Betutu	192390	1	
1768	1500037809	IND0000377	Chocolate Summer Cake	78650	1	
1769	1500037809	IND0000370	Apple Crumble	66550	1	
1770	1500037809	IND0000015	Beef Burger With Cheese	151250	1	
1771	1500037809	IND0000386	club sandwich	127050	1	
1772	1500037809	IND0000305	Mie Rebus	114950	1	
1773	1500037809	IND0000304	The Anvaya Prawn Laksa	114950	1	
2413	1504356804	IND1000029	Beef Burger	151250	1	
1690	1499660207	IND0000051	Vanilla - Milk Shake & Smoothies	59290	1	
1691	1499660207	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1692	1499660207	IND0000386	club sandwich	127050	1	
1693	1499660207	IND0000015	Beef Burger With Cheese	151250	1	
1694	1499673165	IND0000072	Diet Coke	35090	2	
1695	1499673165	IND0000015	Beef Burger With Cheese	151250	2	
1696	1499682518	IND0000001	Nasi Goreng Kampoeng	139150	1	
1697	1499684687	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1698	1499684687	IND0000053	Strawberry - Milk Shake & Smoothies	59290	1	
1699	1499684687	IND0000019	Bolognaise Meat Sauce	102850	1	
1700	1499684687	IND0000002	Mie Goreng Jawa	139150	1	
2433	1504526644	IND0000061	Apple Juice	42350	1	
1782	1500052351	IND0000386	club sandwich	127050	1	
1783	1500052351	IND0000020	Carbonara Sauce	102850	1	
1784	1500052351	IND0000019	Bolognaise Meat Sauce	102850	2	
1786	1500093400	IND0000055	Pineapple Juice	54450	1	
1787	1500093400	IND0000319	Be siap sambal matah	156090	1	
1788	1500093400	IND0000322	Ayam panggang kalas	156090	1	
2451	1504794210	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
2452	1504794210	IND0000064	Aqua Reflection	42350	1	
1795	1500114742	IND0000001	Nasi Goreng Kampoeng	139150	1	
1796	1500115686	IND0000052	Chocolate - Milk Shake & Smoothies	59290	1	
1797	1500115686	IND0000020	Carbonara Sauce	102850	1	
1798	1500115686	IND0000386	club sandwich	127050	1	
1806	1500119958	IND0000387	fish and chip	121000	1	
1807	1500119958	IND0000019	Bolognaise Meat Sauce	102850	1	
1808	1500123994	IND0000295	Beer Promotion	180290	1	
1809	1500123994	IND0000020	Carbonara Sauce	102850	1	
1810	1500123994	IND0000018	Aglio e Olio	83490	1	
1811	1500123994	IND0000001	Nasi Goreng Kampoeng	139150	1	
1812	1500125484	IND0000081	Cafe Latte	42350	1	
1813	1500125484	IND0000303	Soto Ayam Lamongan	151250	1	
1814	1500125484	IND0000001	Nasi Goreng Kampoeng	139150	1	
1818	1500130461	IND0000387	fish and chip	121000	0	
1820	1500136725	IND0000021	Napolitana Sauce	83490	1	
1821	1500136725	IND0000002	Mie Goreng Jawa	139150	3	
1825	1500204728	IND0000394	Tequila Sunrise	119790	4	
1836	1500276601	IND0000020	Carbonara Sauce	102850	0	
1837	1500276601	IND0000020	Carbonara Sauce	102850	1	
1838	1500276601	IND0000386	club sandwich	127050	1	
1839	1500276601	IND0000091	Ice Chocolate	42350	1	
1842	1500286275	IND0000001	Nasi Goreng Kampoeng	139150	1	
1843	1500286275	IND0000060	Strawberry Juice	54450	1	
1844	1500299317	IND0000295	Beer Promotion	180290	2	
1846	1500350701	IND0000054	Watermelon Juice	54450	1	
1847	1500350701	IND0000001	Nasi Goreng Kampoeng	139150	1	
1848	1500352727	IND0000293	Bebek Garang Asem	192390	1	
1849	1500352727	IND0000293	Bebek Garang Asem	192390	1	
1850	1500352727	IND0000293	Bebek Garang Asem	192390	1	
1851	1500359009	IND0000273	Lychee Ice Tea	42350	1	
1852	1500359009	IND0000386	club sandwich	127050	1	
1853	1500359490	IND0000386	club sandwich	127050	1	
1854	1500371342	IND0000018	Aglio e Olio	83490	1	
1855	1500371342	IND0000009	Gado-Gado	90750	1	
1856	1500381002	IND0000295	Beer Promotion	180290	2	
1859	1500385761	IND0000002	Mie Goreng Jawa	139150	1	
1860	1500385761	IND0000047	Blue Fairy	54450	1	
1864	1500460172	IND0000074	Ginger Ale	35090	2	
1865	1500460172	IND0000014	Steak Sandwiches	180290	1	
1866	1500469737	IND0000295	Beer Promotion	180290	2	
1867	1500469831	IND0000390	Plaga Rose - Bottle	434390	1	
1868	1500545391	IND0000015	Beef Burger With Cheese	151250	1	
1869	1500545391	IND0000322	Ayam panggang kalas	156090	1	
1870	1500551596	IND0000061	Apple Juice	54450	1	
1871	1500551596	IND0000015	Beef Burger With Cheese	151250	1	
1872	1500552781	IND0000074	Ginger Ale	35090	1	
1873	1500552781	IND0000015	Beef Burger With Cheese	151250	1	
1874	1500555844	IND0000071	Coca - Cola	35090	1	
1875	1500626280	IND0000020	Carbonara Sauce	102850	1	
1880	1500644552	IND0000071	Coca - Cola	30250	1	
1881	1500644552	IND0000303	Soto Ayam Lamongan	151250	1	
1882	1500647402	IND0000386	club sandwich	127050	1	
1883	1500647674	IND0000292	Bebek Betutu	192390	0	
1884	1500647674	IND0000055	Pineapple Juice	42350	1	
1885	1500647674	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1886	1500649150	IND0000304	The Anvaya Prawn Laksa	114950	1	
1887	1500649150	IND0000020	Carbonara Sauce	102850	1	
1888	1500653856	IND0000056	Carrot Juice	42350	1	
1889	1500653856	IND0000305	Mie Rebus	114950	1	
1890	1500655307	IND0000014	Steak Sandwiches	180290	1	
1891	1500655307	IND0000022	Seasonal Fruit Slices	66550	1	
1892	1500655307	IND0000009	Gado-Gado	90750	1	
2414	1504364701	IND0000275	Green Apple Ice Tea	42350	1	
1895	1500706487	IND0000260	Bali Hai	59290	1	
1896	1500706487	IND0000386	club sandwich	127050	1	
1897	1500706487	IND0000001	Nasi Goreng Kampoeng	139150	1	
1898	1500712342	IND0000262	Bintang Radler	59290	0	
1899	1500712342	IND0000262	Bintang Radler	59290	3	
1900	1500712342	IND0000262	Bintang Radler	59290	2	
1901	1500716775	IND0000071	Coca - Cola	30250	1	
1902	1500716775	IND0000002	Mie Goreng Jawa	139150	1	
2415	1504364701	IND0000001	Nasi Goreng Kampoeng	139150	1	
1906	1500731960	IND0000386	club sandwich	127050	1	
1907	1500731960	IND0000001	Nasi Goreng Kampoeng	139150	1	
1908	1500733875	IND0000390	Plaga Rose - Bottle	434390	1	
1909	1500742422	IND0000363	Potato Wedges	42350	1	
1910	1500742422	IND0000054	Watermelon Juice	42350	1	
1911	1500742422	IND0000055	Pineapple Juice	42350	1	
1912	1500785020	IND0000055	Pineapple Juice	42350	2	
1913	1500785020	IND0000386	club sandwich	127050	1	
1914	1500805138	IND0000071	Coca - Cola	30250	1	
1915	1500805138	IND0000015	Beef Burger With Cheese	151250	1	
1916	1500805138	IND0000058	Papaya Juice	42350	1	
1917	1500821121	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1918	1500821121	IND0000002	Mie Goreng Jawa	139150	1	
1919	1500821121	IND0000294	French Fries	42350	1	
1920	1500821121	IND0000295	Beer Promotion	180290	1	
1921	1500866247	IND0000053	Strawberry - Milk Shake & Smoothies	54450	1	
1922	1500866247	IND0000053	Strawberry - Milk Shake & Smoothies	54450	1	
1923	1500979368	IND0000054	Watermelon Juice	42350	1	
1924	1500979368	IND0000015	Beef Burger With Cheese	151250	1	
1925	1500985589	IND0000294	French Fries	42350	1	
1926	1500985589	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	2	
2472	1504971775	IND0000066	Equil Natural 380 ml	47190	0	
2473	1504971775	IND0000091	Ice Chocolate	42350	1	
1930	1500995299	IND0000294	French Fries	42350	1	
2488	1505188561	IND0000063	Orange  Juice	42350	1	
2489	1505188561	IND0000091	Ice Chocolate	42350	1	
2490	1505188561	IND0000386	Club Sandwich	127050	1	
1934	1500999606	IND0000054	Watermelon Juice	42350	1	
1935	1500999606	IND0000351	Cramcam ayam	66550	1	
1936	1500999606	IND0000001	Nasi Goreng Kampoeng	139150	1	
1937	1500999606	IND0000020	Carbonara Sauce	102850	1	
1938	1500999606	IND0000273	Lychee Ice Tea	42350	1	
1939	1501055990	IND0000078	Americano	36300	1	
2491	1505188561	IND0000386	Club Sandwich	127050	1	
1943	1501058901	IND0000390	Plaga Rose - Bottle	434390	1	
1944	1501062739	IND0000058	Papaya Juice	42350	1	
1945	1501062739	IND0000303	Soto Ayam Lamongan	151250	1	
1946	1501068944	IND0000019	Bolognaise Meat Sauce	102850	2	
1947	1501070364	IND0000363	Potato Wedges	42350	1	
1948	1501070364	IND0000390	Plaga Rose - Bottle	434390	1	
1949	1501070667	IND0000260	Bali Hai	59290	1	
1950	1501070667	IND0000294	French Fries	42350	1	
1951	1501070667	IND0000308	Ayam pelalah	71390	1	
1955	1501082829	IND0000363	Potato Wedges	42350	1	
1956	1501082829	IND0000294	French Fries	42350	1	
1957	1501137750	IND0000260	Bali Hai	59290	2	
1958	1501153287	IND0000060	Strawberry Juice	42350	1	
1959	1501153287	IND0000303	Soto Ayam Lamongan	151250	1	
1961	1501159487	IND0000305	Mie Rebus	114950	2	
1962	1501167936	IND0000273	Lychee Ice Tea	42350	1	
1963	1501167936	IND0000294	French Fries	42350	1	
1964	1501167936	IND0000305	Mie Rebus	114950	1	
2553	1505554832	IND1000028	Steak Sandwich	180290	1	
2560	1505560498	IND0000022	Seasonal Fruit Slices	66550	1	
2561	1505560498	IND0000001	Nasi Goreng Kampoeng	139150	1	
1968	1501243280	IND0000292	Bebek Betutu	192390	1	
2562	1505560498	IND0000305	Mie Rebus	114950	1	
1970	1501245130	IND0000002	Mie Goreng Jawa	139150	1	
1971	1501245130	IND0000295	Beer Promotion	180290	1	
1972	1501246895	IND0000002	Mie Goreng Jawa	139150	1	
1973	1501246895	IND0000387	fish and chip	121000	1	
2574	1505587879	IND0000265	Corona	107690	1	
2588	1505658583	IND0000019	Bolognaise Meat Sauce	102850	1	
2599	1505735446	IND1000045	Tiramisu	102850	2	
2600	1505735446	IND1000029	Beef Burger	151250	2	
2601	1505735446	IND1000029	Beef Burger	151250	2	
2602	1505735446	IND0000020	Carbonara Sauce	102850	1	
1982	1501307109	IND0000002	Mie Goreng Jawa	139150	1	
1983	1501318885	IND0000002	Mie Goreng Jawa	139150	1	
1984	1501318885	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
1985	1501318885	IND0000266	Ikan Kakap Bakar Sambal Matah	114950	1	
1986	1501328927	IND0000060	Strawberry Juice	42350	1	
1987	1501328927	IND0000015	Beef Burger With Cheese	151250	1	
1988	1501333442	IND0000015	Beef Burger With Cheese	151250	1	
1989	1501333442	IND0000386	club sandwich	127050	1	
1990	1501333442	IND0000394	Tequila Sunrise	102850	1	
1991	1501333442	IND0000383	cape code	102850	1	
1992	1501424227	IND0000015	Beef Burger With Cheese	151250	1	
1994	1501476940	IND0000043	Green Machine	66550	1	
1995	1501476940	IND0000015	Beef Burger With Cheese	151250	1	
1996	1501489350	IND0000363	Potato Wedges	42350	1	
1997	1501489350	IND0000294	French Fries	42350	1	
2000	1501505688	IND0000304	The Anvaya Prawn Laksa	114950	1	
2001	1501505688	IND0000015	Beef Burger With Cheese	151250	1	
2002	1501506105	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
2003	1501506105	IND0000020	Carbonara Sauce	102850	1	
2397	1504190398	IND0000321	Sate campur	139150	1	
2416	1504370901	IND1000035	Nasi Goreng Kampung	139150	1	
2006	1501509504	IND0000024	Tiramisu Cake	102850	1	
2007	1501509504	IND0000326	Coconut pudding	66550	1	
2008	1501509504	IND0000386	club sandwich	127050	1	
2009	1501509504	IND0000304	The Anvaya Prawn Laksa	114950	1	
2417	1504370901	IND1000039	Aglio e Olio	83490	1	
2011	1501559990	IND0000260	Bali Hai	59290	1	
2012	1501559990	IND0000015	Beef Burger With Cheese	151250	1	
2013	1501578039	IND0000079	Espresso	36300	2	
2014	1501578223	IND0000294	French Fries	42350	1	
2015	1501590110	IND0000305	Mie Rebus	114950	1	
2016	1501595199	IND0000260	Bali Hai	59290	2	
2021	1501611883	IND0000294	French Fries	42350	2	
2474	1504974990	IND1000035	Nasi Goreng Kampung	139150	1	
2475	1504974990	IND1000029	Beef Burger	151250	1	
2476	1504974990	IND0000072	Diet Coke	30250	2	
2026	1501670772	IND0000303	Soto Ayam Lamongan	151250	0	
2027	1501670772	IND0000303	Soto Ayam Lamongan	151250	1	
2028	1501678999	IND0000315	Aneka be pasih panggang	284350	1	
2029	1501681696	IND0000294	French Fries	42350	1	
2032	1501687708	IND0000295	Beer Promotion	180290	1	
2033	1501694255	IND1000032	Mushroom Soup	47190	1	
2034	1501694255	IND1000031	French Fries	42350	1	
2035	1501694255	IND1000034	Mixed sate	139150	1	
2036	1501694255	IND1000041	Carbonara	102850	1	
2037	1501700919	IND0000305	Mie Rebus	114950	1	
2524	1505406954	IND1000041	Carbonara	102850	2	
2525	1505406954	IND1000035	Nasi Goreng Kampung	139150	1	
2043	1501783288	IND1000031	French Fries	42350	1	
2044	1501783288	IND1000033	Soup Buntut	211750	1	
2045	1501783288	IND1000043	Seasonal Fruit slice	66550	1	
2537	1505480212	IND0000386	Club Sandwich	127050	1	
2047	1501851978	IND0000018	Aglio e Olio	83490	1	
2048	1501892296	IND1000017	Nasi Goreng	108900	1	
2049	1501931083	IND0000019	Bolognaise Meat Sauce	102850	1	
2050	1501931083	IND0000304	The Anvaya Prawn Laksa	114950	1	
2051	1501932092	IND0000003	Sop Buntut	211750	1	
2052	1501943115	IND0000387	fish and chip	121000	1	
2053	1501943115	IND0000297	Nasi Goreng Kampoeng	139150	1	
2054	1501943115	IND0000015	Beef Burger With Cheese	151250	1	
2538	1505480212	IND0000386	Club Sandwich	127050	1	
2539	1505480212	IND1000029	Beef Burger	151250	1	
2540	1505480212	IND1000029	Beef Burger	151250	1	
2554	1505559879	IND0000386	Club Sandwich	127050	1	
2555	1505559879	IND0000386	Club Sandwich	127050	1	
2563	1505560624	IND0000304	The Anvaya Prawn Laksa	114950	1	
2564	1505560624	IND0000019	Bolognaise Meat Sauce	102850	1	
2565	1505560624	IND0000019	Bolognaise Meat Sauce	102850	1	
2575	1505625910	IND0000297	Nasi Goreng Kampoeng	139150	1	
2064	1501996105	IND0000002	Mie Goreng Jawa	139150	1	
2065	1501996105	IND0000010	Lumpia Sayur Semarang	66550	1	
2066	1501996105	IND0000294	French Fries	42350	1	
2067	1501996105	IND0000300	Carbonara Sauce	102850	1	
2576	1505625910	IND0000300	Carbonara Sauce	102850	1	
2070	1502002108	IND0000323	Babi kecap	163350	1	
2071	1502002108	IND0000020	Carbonara Sauce	102850	1	
2603	1505740459	IND0000001	Nasi Goreng Kampoeng	139150	1	
2612	1505905894	IND0000304	The Anvaya Prawn Laksa	114950	1	
2079	1502020697	IND0000299	Napolitana Sauce	83490	1	
2080	1502031770	IND1000046	Pisang Goreng	66550	1	
2081	1502031770	IND0000276	Mojito Mint Ice Tea	42350	2	
2082	1502031770	IND1000042	Napolitana	83490	1	
2083	1502031770	IND1000027	Lumpia Sayur	66550	1	
2084	1502031770	IND1000036	Mi Goreng	108900	1	
2643	1506090442	IND0000303	Soto Ayam Lamongan	151250	1	
2088	1502103380	IND1000041	Carbonara	102850	1	
2089	1502103380	IND1000035	Nasi Goreng Kampung	139150	1	
2092	1502194605	IND0000091	Ice Chocolate	42350	1	
2093	1502194605	IND0000015	Beef Burger With Cheese	151250	1	
2094	1502194605	IND0000019	Bolognaise Meat Sauce	102850	1	
2097	1502265751	IND0000014	Steak Sandwiches	180290	1	
2098	1502265981	IND0000015	Beef Burger With Cheese	151250	1	
2099	1502265981	IND0000301	Bolognaise Meat Sauce	102850	1	
2659	1506245140	IND0000042	Purple Booster	66550	1	
2660	1506245140	IND0000386	Club Sandwich	127050	1	
2102	1502283884	IND0000298	Mie Goreng Jawa	139150	2	
2103	1502286275	IND0000294	French Fries	42350	1	
2104	1502286275	IND0000052	Chocolate  Milkshake & Smoothies	54450	1	
2105	1502286275	IND0000022	Seasonal Fruit Slices	66550	1	
2106	1502286275	IND0000020	Carbonara Sauce	102850	1	
2107	1502294285	IND0000022	Seasonal Fruit Slices	66550	1	
2108	1502353962	IND0000055	Pineapple Juice	42350	1	
2109	1502353962	IND0000060	Strawberry Juice	42350	1	
2110	1502353962	IND0000020	Carbonara Sauce	102850	1	
2111	1502353962	IND0000014	Steak Sandwiches	180290	1	
2661	1506245140	IND0000386	Club Sandwich	127050	1	
2398	1504194705	IND1000041	Carbonara	102850	1	
2418	1504375566	IND0000262	Bintang Radler	59290	1	
2419	1504375566	IND0000260	Bali Hai	59290	1	
2420	1504375566	IND1000035	Nasi Goreng Kampung	139150	1	
2125	1502385084	IND1000035	Nasi Goreng Kampung	139150	2	
2126	1502385084	IND1000040	Bolognaise	102850	1	
2129	1502425923	IND0000018	Aglio e Olio	83490	1	
2130	1502425923	IND0000063	Orange  Juice	42350	2	
2131	1502425923	IND0000387	fish and chip	121000	1	
2132	1502428996	IND0000015	Beef Burger With Cheese	151250	1	
2136	1502453585	IND0000022	Seasonal Fruit Slices	66550	1	
2137	1502453585	IND0000392	Sex On The Beach	102850	1	
2138	1502453585	IND0000020	Carbonara Sauce	102850	1	
2139	1502453585	IND0000015	Beef Burger With Cheese	151250	1	
2143	1502509253	IND0000054	Watermelon Juice	42350	1	
2144	1502509253	IND0000057	Honey Dew Melon Juice	42350	1	
2145	1502509253	IND0000001	Nasi Goreng Kampoeng	139150	1	
2151	1502605436	IND0000010	Lumpia Sayur Semarang	66550	1	
2152	1502605436	IND0000291	Bebek Goreng Kunyit	192390	1	
2159	1502702078	IND0000384	Chateau Subercaseaux	845790	1	
2160	1502706973	IND0000292	Bebek Betutu	192390	1	
2526	1505407251	IND1000046	Pisang Goreng	66550	1	
2527	1505407251	IND1000035	Nasi Goreng Kampung	139150	1	
2163	1502712279	IND0000386	club sandwich	127050	1	
2164	1502712279	IND0000022	Seasonal Fruit Slices	66550	1	
2528	1505407251	IND0000384	Chateau Subercaseaux	845790	1	
2169	1502733710	IND0000054	Watermelon Juice	42350	1	
2170	1502733710	IND0000063	Orange  Juice	42350	1	
2173	1502784919	IND0000386	club sandwich	127050	1	
2566	1505563541	IND0000324	Pisang rai	66550	1	
2567	1505563541	IND0000370	Apple Crumble	66550	1	
2568	1505563541	IND0000386	Club Sandwich	127050	1	
2177	1502793979	IND0000261	Bintang	59290	1	
2178	1502793979	IND0000072	Diet Coke	30250	1	
2179	1502793979	IND0000002	Mie Goreng Jawa	139150	1	
2569	1505563541	IND0000386	Club Sandwich	127050	1	
2570	1505563541	IND0000020	Carbonara Sauce	102850	1	
2604	1505801126	IND0000002	Mie Goreng Jawa	139150	1	
2605	1505801126	IND0000001	Nasi Goreng Kampoeng	139150	1	
2606	1505801126	IND0000010	Lumpia Sayur Semarang	66550	1	
2628	1505976279	IND0000054	Watermelon Juice	42350	1	
2644	1506092919	IND1000027	Lumpia Sayur	66550	1	
2645	1506092919	IND0000260	Bali Hai	59290	2	
2646	1506092919	IND0000298	Mie Goreng Jawa	139150	2	
2654	1506158116	IND0000018	Aglio e Olio	83490	1	
2181	1502807842	IND0000323	Babi kecap	163350	1	
2182	1502807842	IND0000292	Bebek Betutu	192390	1	
2183	1502811702	IND0000262	Bintang Radler	59290	1	
2421	1504443037	IND0000304	The Anvaya Prawn Laksa	114950	1	
2187	1502859213	IND0000392	Sex On The Beach	102850	1	
2188	1502859213	IND0000389	Mosco Mule	102850	1	
2422	1504443037	IND0000370	Apple Crumble	66550	1	
2423	1504443037	IND0000066	Equil Natural 380 ml	47190	1	
2424	1504443037	IND0000020	Carbonara Sauce	102850	1	
2193	1502861248	IND0000392	Sex On The Beach	102850	1	
2194	1502861248	IND0000386	club sandwich	127050	1	
2195	1502861248	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
2196	1502877251	IND0000386	club sandwich	127050	1	
2197	1502877251	IND0000020	Carbonara Sauce	102850	1	
2462	1504948579	IND0000052	Chocolate  Milkshake & Smoothies	54450	1	
2463	1504948579	IND0000052	Chocolate  Milkshake & Smoothies	54450	1	
2205	1502895756	IND0000260	Bali Hai	59290	2	
2206	1502898670	IND0000295	Beer Promotion	180290	1	
2207	1502898670	IND1000039	Aglio e Olio	83490	1	
2208	1502898670	IND1000035	Nasi Goreng Kampung	139150	1	
2213	1502970889	IND0000020	Carbonara Sauce	102850	1	
2214	1502973492	IND0000001	Nasi Goreng Kampoeng	139150	1	
2215	1502978943	IND0000275	Green Apple Ice Tea	42350	1	
2216	1502978943	IND0000387	fish and chip	121000	1	
2217	1502981467	IND0000304	The Anvaya Prawn Laksa	114950	1	
2218	1502981467	IND0000363	Potato Wedges	42350	1	
2221	1503000080	IND1000035	Nasi Goreng Kampung	139150	1	
2224	1503053958	IND0000363	Potato Wedges	42350	1	
2225	1503064583	IND0000323	Babi kecap	163350	1	
2226	1503064583	IND0000304	The Anvaya Prawn Laksa	114950	1	
2227	1503119994	IND0000015	Beef Burger With Cheese	151250	1	
2228	1503119994	IND0000370	Apple Crumble	66550	1	
2229	1503119994	IND0000072	Diet Coke	30250	2	
2571	1505571408	IND0000262	Bintang Radler	59290	2	
2232	1503151072	IND0000024	Tiramisu Cake	102850	1	
2233	1503151072	IND0000377	Chocolate Summer Cake	78650	1	
2234	1503213256	IND0000317	Be celeng menyatnyat	163350	1	
2235	1503232140	IND0000020	Carbonara Sauce	102850	1	
2236	1503232140	IND0000072	Diet Coke	30250	2	
2237	1503232140	IND0000370	Apple Crumble	66550	1	
2238	1503232140	IND0000300	Carbonara Sauce	102850	1	
2240	1503236134	IND0000002	Mie Goreng Jawa	139150	1	
2241	1503236609	IND0000370	Apple Crumble	66550	1	
2242	1503237043	IND0000014	Steak Sandwiches	180290	1	
2243	1503237043	IND0000021	Napolitana Sauce	83490	1	
2244	1503237043	IND0000260	Bali Hai	59290	4	
2245	1503240475	IND0000071	Coca - Cola	30250	2	
2246	1503240475	IND0000061	Apple Juice	42350	1	
2247	1503240475	IND0000386	club sandwich	127050	1	
2248	1503240475	IND0000018	Aglio e Olio	83490	1	
2249	1503240475	IND0000010	Lumpia Sayur Semarang	66550	1	
2250	1503240874	IND0000261	Bintang	59290	3	
2251	1503240874	IND0000023	Panna Cotta	83490	1	
2252	1503240874	IND0000022	Seasonal Fruit Slices	66550	1	
2253	1503240874	IND0000377	Chocolate Summer Cake	78650	4	
2254	1503240874	IND0000002	Mie Goreng Jawa	139150	3	
2255	1503240874	IND0000010	Lumpia Sayur Semarang	66550	1	
2256	1503240874	IND0000015	Beef Burger With Cheese	151250	3	
2257	1503293618	IND0000054	Watermelon Juice	42350	2	
2258	1503293618	IND0000297	Nasi Goreng Kampoeng	139150	2	
2259	1503293618	IND0000300	Carbonara Sauce	102850	1	
2263	1503334733	IND0000053	Strawberry  Milkshake & Smoothies	54450	2	
2264	1503334733	IND1000043	Seasonal Fruit slice	66550	1	
2265	1503334733	IND1000041	Carbonara	102850	2	
2266	1503398740	IND0000327	Es podeng	66550	1	
2267	1503398740	IND0000295	Beer Promotion	180290	1	
2268	1503398740	IND0000293	Bebek Garang Asem	192390	1	
2269	1503398740	IND0000323	Babi kecap	163350	1	
2272	1503476386	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
2274	1503490161	IND0000018	Aglio e Olio	83490	0	
2275	1503490161	IND0000295	Beer Promotion	180290	1	
2276	1503490161	IND0000014	Steak Sandwiches	180290	1	
2277	1503490161	IND0000019	Bolognaise Meat Sauce	102850	1	
2279	1503494036	IND0000019	Bolognaise Meat Sauce	102850	1	
2280	1503496607	IND0000304	The Anvaya Prawn Laksa	114950	1	
2281	1503497817	IND0000071	Coca - Cola	30250	2	
2282	1503500772	IND0000018	Aglio e Olio	83490	1	
2283	1503503302	IND0000387	fish and chip	121000	1	
2287	1503514969	IND0000054	Watermelon Juice	42350	1	
2288	1503514969	IND0000001	Nasi Goreng Kampoeng	139150	1	
2289	1503514969	IND0000020	Carbonara Sauce	102850	1	
2639	1506059987	IND0000310	Gedang mekuah	54450	1	
2647	1506103402	IND1000035	Nasi Goreng Kampung	139150	1	
2655	1506177145	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
2401	1504291963	IND1000034	Mixed sate	139150	1	
2425	1504460205	IND1000027	Lumpia Sayur	66550	1	
2426	1504460205	IND0000262	Bintang Radler	59290	2	
2427	1504460205	IND0000295	Beer Promotion	180290	1	
2298	1503601858	IND0000273	Lychee Ice Tea	42350	4	
2299	1503601858	IND1000041	Carbonara	102850	1	
2300	1503601858	IND1000035	Nasi Goreng Kampung	139150	4	
2498	1505227131	IND0000071	Coca - Cola	30250	4	
2531	1505473469	IND0000273	Lychee Ice Tea	42350	1	
2319	1503671178	IND0000003	Sop Buntut	211750	1	
2320	1503683086	IND1000033	Soup Buntut	211750	1	
2321	1503690741	IND1000027	Lumpia Sayur	66550	1	
2322	1503690741	IND1000029	Beef Burger	151250	1	
2326	1503723786	IND0000015	Beef Burger With Cheese	151250	1	
2327	1503723786	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	1	
2328	1503723786	IND0000007	Nasi Campur Bali ( Signature Dish)	151250	0	
2329	1503736057	IND0000302	Aglio e Olio	83490	1	
2330	1503749870	IND0000003	Sop Buntut	211750	1	
2331	1503752158	IND0000058	Papaya Juice	42350	1	
2332	1503752158	IND0000386	club sandwich	127050	1	
2333	1503752158	IND0000063	Orange  Juice	42350	1	
2334	1503752865	IND0000014	Steak Sandwiches	180290	1	
2335	1503752865	IND0000021	Napolitana Sauce	83490	1	
2336	1503752865	IND0000363	Potato Wedges	42350	1	
2337	1503760085	IND0000020	Carbonara Sauce	102850	1	
2338	1503815874	IND0000351	Cramcam ayam	66550	1	
2339	1503815874	IND0000291	Bebek Goreng Kunyit	192390	1	
2547	1505547444	IND0000020	Carbonara Sauce	102850	1	
2548	1505547444	IND1000028	Steak Sandwich	180290	1	
2549	1505547444	IND1000028	Steak Sandwich	180290	0	
2550	1505547444	IND0000307	Jukut urab	54450	1	
2572	1505575132	IND0000019	Bolognaise Meat Sauce	102850	1	
2346	1503820590	IND0000322	Ayam panggang kalas	156090	1	
2573	1505575132	IND0000019	Bolognaise Meat Sauce	102850	0	
2353	1503842544	IND0000304	The Anvaya Prawn Laksa	114950	1	
2354	1503844853	IND1000029	Beef Burger	151250	1	
2581	1505649732	IND0000091	Ice Chocolate	42350	0	
2582	1505649732	IND0000061	Apple Juice	42350	1	
2357	1503920612	IND0000303	Soto Ayam Lamongan	151250	1	
2358	1503921539	IND0000018	Aglio e Olio	83490	1	
2359	1503921539	IND0000319	Be siap sambal matah	156090	1	
2360	1503926144	IND0000363	Potato Wedges	42350	1	
2361	1503926144	IND0000272	Peach Ice Tea	42350	1	
2362	1503926144	IND0000072	Diet Coke	30250	3	
2363	1503927693	IND0000020	Carbonara Sauce	102850	2	
2364	1503974817	IND0000019	Bolognaise Meat Sauce	102850	1	
2365	1503974817	IND0000294	French Fries	42350	1	
2583	1505649732	IND0000260	Bali Hai	59290	0	
2584	1505649732	IND0000260	Bali Hai	59290	0	
2368	1504000607	IND1000029	Beef Burger	151250	1	
2369	1504005764	IND0000091	Ice Chocolate	42350	1	
2370	1504005764	IND0000387	fish and chip	121000	1	
2371	1504005764	IND0000072	Diet Coke	30250	3	
2585	1505649732	IND0000019	Bolognaise Meat Sauce	102850	1	
2586	1505649732	IND0000351	Cramcam ayam	66550	2	
2376	1504015533	IND1000028	Steak Sandwich	180290	1	
2377	1504016358	IND0000363	Potato Wedges	42350	1	
2378	1504020095	IND0000295	Beer Promotion	180290	1	
2379	1504020095	IND1000031	French Fries	42350	1	
2380	1504068331	IND0000294	French Fries	42350	1	
2381	1504068331	IND0000016	Pan Seared Beef Medalion with Creamy Mushroom	168190	1	
2587	1505649732	IND0000010	Lumpia Sayur Semarang	66550	1	
2625	1505920058	IND0000019	Bolognaise Meat Sauce	102850	1	
2632	1506004772	IND0000020	Carbonara Sauce	102850	1	
2640	1506072429	IND0000060	Strawberry Juice	42350	1	
2641	1506072429	IND0000386	Club Sandwich	127050	1	
2642	1506072429	IND0000386	Club Sandwich	127050	1	
2648	1506147745	IND0000386	Club Sandwich	127050	1	
2649	1506147745	IND0000386	Club Sandwich	127050	1	
2656	1506235886	IND0000305	Mie Rebus	114950	1	
2657	1506235886	IND1000029	Beef Burger	151250	1	
2658	1506235886	IND1000029	Beef Burger	151250	1	
2664	1506300012	IND1000017	Nasi Goreng	108900	2	
\.


--
-- Name: guest_services_detail_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('guest_services_detail_seq', 2664, true);


--
-- Data for Name: guests; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY guests (guest_reservation_id, guest_arrival_date, guest_departure_date, guest_firstname, guest_lastname, guest_fullname, guest_salutation, guest_groupname, guest_room_share, room_name, guest_message, guest_checkin_type, guest_payment_method, guest_language, guest_resv_no, guest_resv_line_no, guest_bill_request, guest_field5, guest_field6, guest_allow_post, guest_group, guest_vip, guest_honeymoon, guest_sync_status, guest_connect_room, guest_allow_viewbill, guest_compliment, guest_house_use, guest_permanent, guest_bill_lastupdate) FROM stdin;
60289	1506053177	\N			Thorsten Kirchner	Mr.		0	5310	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60521	1506145490	\N			Yanwen Lim			0	3122	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60524	1506145522	\N			Yanwen Lim			0	3524	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60525	1506146116	\N			Mohammad Ali Jahed Tabrizi (pre)	Mr.		1	3232	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60780	1506185531	\N			Popper John Dela Paz	Mr.	GREAT JOURNEYS	1	6224	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60291	1506054553	\N			Adria Chen	Mrs.		0	2112	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60430	1506106833	\N			Sepehr Ashrafi	Mr.		1	5216	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60432	1506106927	\N			Amin Sharifpour	Mr.		0	6324	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60433	1506107240	\N			Marzieh Aghajani	Ms.		0	5202	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60434	1506107366	\N			Soheila Javadi			1	6223	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60783	1506185625	\N			Jerome Santos	Mr.	GREAT JOURNEYS	1	6315	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60787	1506185719	\N			Lowell Avenido	Mr.	GREAT JOURNEYS	1	6301	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60436	1506107460	\N			Hamidreza Ghasemichamtaghi	Mr.		0	5218	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60437	1506107616	\N			Afrooz Tavakoli Darkani	Mr.		0	6222	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60438	1506107773	\N			Babak Shabani radi			0	5520	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60440	1506108147	\N			Hossein Shareiosquei			0	1509	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60441	1506108273	\N			Hossein Shareiosquei			0	1505	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60790	1506185875	\N			Ricardo Javison	Mr.	GREAT JOURNEYS	1	6218	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60793	1506185968	\N			Romulus James Popez	Mr.	GREAT JOURNEYS	1	2105	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60797	1506186033	\N			Glenn Kay Guce	Mr.	GREAT JOURNEYS	1	2319	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60957	1506309307	\N			Juni Permatasari	Ms.		0	2122	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60800	1506186127	\N			Jason Paul Medina	Mr.	GREAT JOURNEYS	1	6316	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60803	1506186315	\N			Corazon Abuel		GREAT JOURNEYS	1	6516	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60806	1506186378	\N			Frederick Tan	Mr.	GREAT JOURNEYS	1	6323	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60809	1506186440	\N			Leila Marta Roxane Reyes	Ms.	GREAT JOURNEYS	1	6306	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60814	1506186722	\N			Anna Liza Virtucio	Mrs.	GREAT JOURNEYS	1	6522	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60534	1506229889	\N			Sen Wang			1	1511	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60817	1506186785	\N			Jimmy Lim	Mr.	GREAT JOURNEYS	1	6309	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60820	1506186941	\N			Arsenia Cruz	Mr.	GREAT JOURNEYS	1	6518	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60960	1506309901	\N			Jessica McGahey			0	3224	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60823	1506187004	\N			Enrico Ignacio	Mr.	GREAT JOURNEYS	1	6512	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60826	1506187098	\N			Lagrimas Ong		GREAT JOURNEYS	1	6307	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60829	1506187160	\N			Ethelinda Gay Moreno		GREAT JOURNEYS	1	6510	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60849	1506232326	\N			Julio Varela	Mr.		0	3120	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60298	1506057247	\N			Vera Elise Theunissen			0	5208	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60961	1506312970	\N			In Sung Song	Mr.		0	2126	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60530	1506146683	\N			Wu Zhigang	Mr.		0	2333	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60339	1506237152	\N			Kenneth Mason	Mr.		1	6106	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59600	1505886349	\N			Jamie Chamberlain	Mr.		0	1305	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60855	1506239931	\N			Totok Yulianto	Mr.		0	2130	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59599	1505886412	\N			Jamie Chamberlain	Mr.		0	1306	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60313	1506061347	\N			Mahsa Shalileh	Ms.		1	6217	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60487	1506141140	\N			Thierry Lopez			0	3151	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60494	1506141735	\N			Elzenbaumer Michael Alois	Mr.		0	3316	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59244	1505706133	\N			Neil Cameron			0	2542	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60962	1506313938	\N			Aamera Ghuman			0	2116	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60847	1506243031	\N			Rachel McFadyen pre			1	2124	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60958	1506314282	\N			Mohammad Ahmadi	Mr.		1	2342	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60963	1506314595	\N			Kendall Collins			0	6115	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60564	1506149904	\N			Bronwyn Brown PRE			0	3202	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59674	1505889107	\N			Mark Howe	Mr.		1	6121	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60334	1506064760	\N			Matthew Mason	Mr.		1	6102	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60337	1506066324	\N			Jack Mason			1	6105	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60860	1506244569	\N			Chen Yulin	Mr.	CSHMNJYY170921D	0	2216	0	0	0	en	\N	\N	0	\N	\N	0	1094	0	0	0		0	0	0	0	\N
60858	1506244569	\N			Wang Sheng	Mr.	CSHMNJYY170921D	0	2226	0	0	0	en	\N	\N	0	\N	\N	0	1094	0	0	0		0	0	0	0	\N
60862	1506244600	\N			Xu Xiaoying	Ms.	CSHMNJYY170921D	0	2218	0	0	0	en	\N	\N	0	\N	\N	0	1094	0	0	0		0	0	0	0	\N
60866	1506244600	\N			Guan Haitao	Mr.	CSHMNJYY170921D	0	2220	0	0	0	en	\N	\N	0	\N	\N	0	1094	0	0	0		0	0	0	0	\N
60864	1506244600	\N			Shen Tainrui	Mr.	CSHMNJYY170921D	0	2224	0	0	0	en	\N	\N	0	\N	\N	0	1094	0	0	0		0	0	0	0	\N
59252	1505709356	\N			Linda Colman	Ms.		1	1310	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60965	1506316320	\N			Amruthraj Chaitanya	Ms.		1	2328	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60271	1506150846	\N			Abdulkader Hage	Mr.		0	3116	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60968	1506319131	\N			George Sutiono	Mr.		0	2507	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60567	1506151878	\N			Bronwyn Brown	Mr.		0	3201	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60601	1506153758	\N			Javier San Jose	Mr.	Media Tribun	0	6206	0	0	0	en	\N	\N	0	\N	\N	0	1091	0	0	0		0	0	0	0	\N
60875	1506246318	\N			Liu Chunxia	Ms.	0924 MM TLN-WH	0	5517	0	0	0	en	\N	\N	0	\N	\N	0	978	0	0	0		0	0	0	0	\N
60873	1506246318	\N			Li Shaoqi	Mr.	0924 MM TLN-WH	0	5519	0	0	0	en	\N	\N	0	\N	\N	0	978	0	0	0		0	0	0	0	\N
60603	1506153789	\N			Jose Luis Cordoba	Mr.	Media Tribun	0	6208	0	0	0	en	\N	\N	0	\N	\N	0	1091	0	0	0		0	0	0	0	\N
60871	1506246318	\N			Chen Sheng	Mr.	0924 MM TLN-WH	0	5521	0	0	0	en	\N	\N	0	\N	\N	0	978	0	0	0		0	0	0	0	\N
60879	1506246349	\N			Wang Hui	Ms.	0924 MM TLN-WH	0	5508	0	0	0	en	\N	\N	0	\N	\N	0	978	0	0	0		0	0	0	0	\N
60877	1506246349	\N			Miao Xiaoli	Ms.	0924 MM TLN-WH	0	5511	0	0	0	en	\N	\N	0	\N	\N	0	978	0	0	0		0	0	0	0	\N
60967	1506321480	\N			Laurice Artates	Ms.		0	3112	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60970	1506322167	\N			Olivia Lollino	Ms.		0	2110	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60350	1506322355	\N			Kau Tshireletso Getrude c/o	Ms.		1	3522	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60605	1506153820	\N			Julita Sjafudin	Ms.	Media Tribun	1	6207	0	0	0	id	\N	\N	0	\N	\N	0	1091	0	0	0		0	0	0	0	\N
60881	1506248513	\N			Han Bin	Mr.	0924 MM TLN	0	5101	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60608	1506153882	\N			Khattak Gulmeena			0	2331	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60883	1506248669	\N			Zhou Changjiang	Mr.	0924 MM TLN	0	5510	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60611	1506154102	\N			Leticia Sina	Ms.	Media Tribun	1	6202	0	0	0	en	\N	\N	0	\N	\N	0	1091	0	0	0		0	0	0	0	\N
60614	1506154290	\N			Lorna David	Ms.	Media Tribun	1	6310	0	0	0	en	\N	\N	0	\N	\N	0	1091	0	0	0		0	0	0	0	\N
60972	1506323020	\N			Yenny Juliana Oemar Oei	Mrs.		0	2242	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60974	1506326172	\N			Bintang Hidayat	Mr.		0	1518	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60885	1506248700	\N			Hou Fengyuan	Mr.	0924 MM TLN	0	5102	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60617	1506154320	\N			Karin Inazumi			0	2526	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60618	1506154414	\N			Pramod Venugopal Satya			0	3157	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60619	1506154446	\N			Pramod Venugopal Satya			0	3153	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60374	1506077405	\N			Demitris Hernandez			0	5212	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60887	1506248700	\N			Hou Rui	Ms.	0924 MM TLN	0	5105	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60889	1506248732	\N			Liu Changshan	Mr.	0924 MM TLN	0	5107	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60623	1506154758	\N			Geng Si	Mr.	0923 MM TLN-A	0	5307	0	0	0	en	\N	\N	0	\N	\N	0	855	0	0	0		0	0	0	0	\N
60625	1506154790	\N			Liu Yuqing	Ms.	0923 MM TLN-A	0	5305	0	0	0	en	\N	\N	0	\N	\N	0	855	0	0	0		0	0	0	0	\N
60891	1506248732	\N			Liu Qiang	Ms.	0924 MM TLN	0	5121	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60893	1506248763	\N			Mu Xiaoxuan	Ms.	0924 MM TLN	0	5122	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
59575	1505825278	\N			Danuta Dudkiewics Zimny	Mrs.		1	6318	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59577	1505825497	\N			Izabela Pasinska	Mrs.		1	6321	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59579	1505825559	\N			Magdalena Wlodarska Muska	Ms.		1	6305	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59581	1505825716	\N			Kornelia Nosek	Mrs.		1	6308	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60895	1506248763	\N			Wang Qun	Ms.	0924 MM TLN	0	5203	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60897	1506248794	\N			Wang Shiyu	Mr.	0924 MM TLN	0	5207	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60899	1506248826	\N			Wang Weilin	Mr.	0924 MM TLN	0	5215	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60901	1506248826	\N			Yu Xiang	Mr.	0924 MM TLN	0	5512	0	0	0	en	\N	\N	0	\N	\N	0	976	0	0	0		0	0	0	0	\N
60685	1506250512	\N			Li Jiamin	Ms.	0922 MM TLN-WH	0	5502	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60689	1506250544	\N			Liu Yang	Mr.	0922 MM TLN-WH	0	5501	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
111	1506324720	\N			Guest			0	Spare	0	0	0	\N	\N	\N	0	\N	\N	0	0	0	0	0	\N	0	0	0	1	\N
60905	1506254050	\N			Shanmin Zhang			0	6216	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59588	1505828439	\N			Jyri Tapani Kullervo Aaltio	Mr.		0	6511	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60906	1506254144	\N			Li Zhang			0	6205	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60907	1506254237	\N			Changxin Zhu			0	6209	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60908	1506254362	\N			Ruiyang Zhang			0	6203	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60635	1506157420	\N			Gu Zhining	Mr.	GZLZX170923A	0	2205	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60637	1506157451	\N			Liu Li	Mr.	GZLZX170923A	0	2212	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60639	1506157483	\N			Mo Wentai	Mr.	GZLZX170923A	0	2215	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60641	1506157514	\N			Peng Yuanjin	Mr.	GZLZX170923A	0	2323	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60644	1506157545	\N			Sun Xiaoju	Ms.	GZLZX170923A	0	2219	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60646	1506157577	\N			Wang Xiaoqing	Ms.	GZLZX170923A	0	2222	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60648	1506157608	\N			Xu Qinhua	Mr.	GZLZX170923A	0	2223	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60650	1506157639	\N			Zhai Yonglang	Mr.	GZLZX170923A	0	2229	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60652	1506157639	\N			Zhong Changyong	Mr.	GZLZX170923A	0	2232	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60654	1506157670	\N			Zhu Wanling	Ms.	GZLZX170923A	0	2202	0	0	0	en	\N	\N	0	\N	\N	0	1028	0	0	0		0	0	0	0	\N
60381	1506078346	\N			Masuda Daisuke	Mr.		1	2334	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59690	1505982991	\N			Stacey Hammel			0	2140	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
58320	1505366326	\N			Lukasz Piotr Mietkowski	Mr.		0	6311	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
58366	1505370394	\N			Nathan George Seldon			0	2324	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60975	1506326651	\N			Caracas Marilyn Navales	Ms.		0	6211	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60909	1506254464	\N			Zhu Lingling			0	6302	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60976	1506326683	\N			Caracas Marilyn Navales	Ms.		0	6212	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60663	1506161365	\N			Syelli Yulianty Sukirman	Mrs.		0	2516	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60910	1506254745	\N			Wang Tiankuo	Mr.	0922 CA VB	0	5217	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60912	1506254745	\N			Guan Qigang	Mr.	0922 CA VB	0	5318	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60916	1506254776	\N			Dong Yanling	Mrs.	0922 CA VB	0	5222	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60973	1506326714	\N			Nirav Vithalani			0	6507	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60667	1506163897	\N			Ratna Suryani	Mrs.		0	2338	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60914	1506254776	\N			Shu Jingxuan	Mr.	0922 CA VB	0	5311	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60918	1506254808	\N			Dong Jikui	Mr.	0922 CA VB	0	5112	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60920	1506254808	\N			Sun Heyao	Ms.	0922 CA VB	0	5317	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60922	1506254808	\N			Jia Changsong	Mr.	0922 CA VB	0	5320	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60924	1506254839	\N			Liu Zhaoming	Mr.	0922 CA VB	0	5301	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60926	1506254839	\N			Wang Jiaxing	Mr.	0922 CA VB	0	5319	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60928	1506254870	\N			Gong Ye	Mr.	0922 CA VB	0	5312	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60930	1506254902	\N			Gaoge	Mr.	0922 CA VB	0	5316	0	0	0	en	\N	\N	0	\N	\N	0	1093	0	0	0		0	0	0	0	\N
60932	1506254995	\N			Christelle Nasse	Ms.		0	6210	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60933	1506257087	\N			Ellen Chandrayani	Mrs.		0	2541	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60934	1506257430	\N			Soonji Lee	Mr.		0	5506	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60977	1506327618	\N			Richy Ricardo Sembiring	Mr.		0	2536	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60978	1506328368	\N			Suwandi Kisono	Mr.		0	6219	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60979	1506328929	\N			Chun Ying Chang	Mrs.		0	2134	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59169	1505667313	\N			Moldoveanu Adrian	Mr.		0	6509	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
59033	1505630064	\N			Aaron Anthony Kovacevic	Mr.		0	6103	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60669	1506165308	\N			Fan Jia Yi			0	2336	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60670	1506165340	\N			Fan Jia Yi			0	2330	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60903	1506258876	\N			Jurianz Shalee			0	3310	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60388	1506088677	\N			Vahdettin Akcinar	Mr.		0	6508	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60937	1506259407	\N			Li QiuFeng			0	2340	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60935	1506259595	\N			Fanny Lokanta			0	3126	0	0	0	id	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60735	1506261564	\N			Evelyn Agno	Ms.	GREAT JOURNEYS	1	6312	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
59887	1505913121	\N			Huia Haeata			0	6110	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60938	1506262351	\N			Sansao Gomes			0	3321	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60679	1506170567	\N			Gong Yanke	Mr.	0922 MM TLN-WH	0	5321	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
59888	1505913184	\N			Anaru Timutimu			0	6109	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60681	1506170598	\N			Han Baonan	Mr.	0922 MM TLN-WH	0	5322	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60683	1506170629	\N			Huang Hui	Mr.	0922 MM TLN-WH	0	5109	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60687	1506170754	\N			Liu Yadong	Mr.	0922 MM TLN-WH	0	5115	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60692	1506170848	\N			Ren Guozhong	Mr.	0922 MM TLN-WH	0	5201	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60694	1506170880	\N			Wang Xing	Mr.	0922 MM TLN-WH	0	5303	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60941	1506263164	\N			Umar Irshad	Mr.		1	6322	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60939	1506263164	\N			Ali Saleem	Mr.		1	6506	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60696	1506170911	\N			Xu He	Mr.	0922 MM TLN-WH	0	5205	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60698	1506170911	\N			Yang Senlin	Mr.	0922 MM TLN-WH	0	5315	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60700	1506170942	\N			Zhao Yongzhi	Mr.	0922 MM TLN-WH	0	5219	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60702	1506171005	\N			Zhu Chengchao	Mr.	0922 MM TLN-WH	0	5221	0	0	0	en	\N	\N	0	\N	\N	0	928	0	0	0		0	0	0	0	\N
60943	1506267139	\N			Samantha Frost			0	6221	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60723	1506174793	\N			Chui Ling Saw	Mr.		0	2317	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60315	1506268668	\N			Young Ho Han	Mr.		0	2326	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60724	1506174887	\N			Yu Hao Tan			0	2329	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60725	1506174949	\N			Chin Hwa Lim			0	2235	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60726	1506175074	\N			Ai Tin Ng			0	2239	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60727	1506175168	\N			Hock Ho Kwan			0	2315	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
58031	1505208486	\N			Karl Rodenkirchen	Mr.		0	1311	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
58031	1505208486	\N			Karl Rodenkirchen	Mr.		0	1311	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
58031	1505208486	\N			Karl Rodenkirchen	Mr.		0	1311	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
58755	1505484158	\N			Rifat Kesgin			0	2537	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
58322	1505366357	\N			Ewelina Szot	Mrs.		0	6220	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60728	1506175233	\N			Yu Jee Tan			0	2309	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60946	1506270114	\N			Zhiqiao Chen ( PRE )			0	5516	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60732	1506175609	\N			Mieczyslaw Fabisiak	Mr.		1	6523	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60416	1506097660	\N			Zhu Jiaru	Mr.	0923 MM TLN-A	0	5308	0	0	0	en	\N	\N	0	\N	\N	0	855	0	0	0		0	0	0	0	\N
60418	1506097786	\N			Li Huaiming	Mr.	0923 MM TLN-A	0	5210	0	0	0	en	\N	\N	0	\N	\N	0	855	0	0	0		0	0	0	0	\N
59379	1505792064	\N			Malika Lebbihi	Ms.		0	6118	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60730	1506175609	\N			Arkadiusz Polak	Mr.		1	6524	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60420	1506097817	\N			Suo Guo	Mr.	0923 MM TLN-A	0	5211	0	0	0	en	\N	\N	0	\N	\N	0	855	0	0	0		0	0	0	0	\N
60947	1506271332	\N			Christopher Ruby			0	3118	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60264	1506001868	\N			Zofia Korczynska	Mrs.		0	6503	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60265	1506001899	\N			Katarzyna Helena Korczynska	Mrs.		1	6502	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
58324	1505366419	\N			Jacek Sieracki	Mr.		0	6215	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60948	1506273057	\N			Krishan Kumar Bhuttra			0	5108	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60442	1506176046	\N			Hossein Shareiosquei			0	1515	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60738	1506177800	\N			Corazon Villalva	Mr.	GREAT JOURNEYS	1	6521	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60741	1506177956	\N			Efren Reyes		GREAT JOURNEYS	1	6515	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60744	1506178019	\N			Evelyn Anthonette Hilario	Ms.	GREAT JOURNEYS	1	6505	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60747	1506178144	\N			Carmencita Leyble		GREAT JOURNEYS	1	6517	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60750	1506178238	\N			Hermogenes Masangkay Jr	Mr.	GREAT JOURNEYS	1	6319	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60753	1506178332	\N			Ramona Nerissa Lobaton	Ms.	GREAT JOURNEYS	1	6303	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60756	1506178363	\N			Vincent Davis Tayag	Mr.	GREAT JOURNEYS	1	6123	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
59332	1505735183	\N			Helge Jorgensen			1	2106	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60759	1506178426	\N			Russel Ramos	Mr.	GREAT JOURNEYS	1	6124	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60762	1506178676	\N			Emilia Alberto	Mrs.	GREAT JOURNEYS	1	6501	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60428	1506106614	\N			Alieh Soleimaniamiri	Mr.		1	6520	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60765	1506179021	\N			Harold Nanquil	Mr.	GREAT JOURNEYS	1	6320	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60768	1506179053	\N			Janette Tolentino		GREAT JOURNEYS	1	6317	0	0	0	en	\N	\N	0	\N	\N	0	1090	0	0	0		0	0	0	0	\N
60949	1506277469	\N			Daehyun Park			0	2512	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60775	1506181993	\N			Alexandra Daniel	Ms.		0	3324	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60951	1506277939	\N			Zhang Yinglu			0	5503	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
60952	1506277939	\N			Zhang Yinglu			0	5505	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
25813	1501494139	\N			Wouter van der Bij	Mr.		0	5515	0	0	0	en	\N	\N	0	\N	\N	0	0	0	0	0		0	0	0	0	\N
\.


--
-- Data for Name: hotspots; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY hotspots (hotspot_id, room_name, hotspot_password, hotspot_rule) FROM stdin;
1	701	153857	1
2	702	145369	1
3	703	131381	1
4	705	117393	1
5	706	103405	1
6	707	189417	1
7	708	275429	1
8	709	361441	1
9	710	447453	1
10	711	533465	1
11	712	619477	1
12	715	705489	1
13	716	791501	1
14	717	877513	1
15	718	963525	1
16	719	159369	1
17	720	158745	1
18	721	456578	1
19	722	156612	1
20	723	789153	1
21	801	145369	1
22	802	147583	1
23	803	511325	1
24	805	365412	1
25	806	698262	1
26	807	154263	1
27	808	987452	1
28	809	258963	1
29	810	147852	1
30	811	123654	1
31	812	654789	1
32	815	852963	1
33	816	741159	1
34	817	159741	1
35	818	963573	1
36	819	254589	1
37	820	584213	1
38	821	159741	1
39	822	258785	1
40	823	145632	1
41	901	789654	1
42	902	652369	1
43	903	987523	1
44	905	145236	1
45	906	458963	1
46	907	123987	1
47	908	456258	1
48	909	741963	1
49	910	789321	1
50	911	145698	1
51	912	502415	1
52	915	103265	1
53	916	102548	1
54	917	201354	1
55	918	302156	1
56	919	402132	1
57	920	501235	1
58	921	401235	1
59	922	402315	1
60	923	602123	1
62	1002	802219	1
63	1003	702563	1
64	1005	602907	1
65	1006	503251	1
66	1007	403595	1
67	1008	303939	1
68	1009	204283	1
69	1010	104627	1
70	1011	902543	1
71	1012	876522	1
72	1015	850501	1
73	1016	824480	1
74	1017	798459	1
75	1018	772438	1
76	1019	746417	1
77	1020	720396	1
78	1021	694375	1
79	1022	668354	1
80	1023	642333	1
81	1101	616312	1
82	1102	590291	1
83	1103	564270	1
84	1105	538249	1
85	1106	512228	1
86	1107	486207	1
87	1108	460186	1
88	1109	434165	1
89	1110	408144	1
90	1111	382123	1
91	1112	356102	1
92	1115	330081	1
93	1116	304060	1
94	1117	278039	1
95	1118	252018	1
96	1119	225997	1
97	1120	199976	1
98	1121	173955	1
99	1122	147934	1
100	1123	121913	1
101	1201	786954	1
102	1202	968542	1
103	1203	893692	1
104	1205	818842	1
105	1206	743992	1
106	1207	669142	1
107	1208	594292	1
108	1209	519442	1
109	1210	444592	1
110	1211	369742	1
111	1212	294892	1
112	1215	220042	1
113	1216	145192	1
114	1217	702596	1
115	1218	689643	1
116	1219	676690	1
117	1220	663737	1
118	1221	650784	1
119	1222	637831	1
120	1223	624878	1
121	1501	611925	1
122	1502	598972	1
123	1503	586019	1
124	1505	573066	1
125	1506	560113	1
126	1507	547160	1
127	1508	534207	1
128	1509	521254	1
129	1510	508301	1
130	1511	495348	1
131	1512	482395	1
132	1515	469442	1
133	1516	456489	1
134	1517	443536	1
135	1518	430583	1
136	1519	417630	1
137	1520	404677	1
138	1521	391724	1
139	1522	378771	1
140	1523	365818	1
141	1601	352865	1
142	1602	339912	1
143	1603	326959	1
144	1605	314006	1
145	1606	301053	1
146	1607	288100	1
147	1608	275147	1
148	1609	262194	1
149	1610	249241	1
150	1611	236288	1
151	1612	223335	1
152	1615	210382	1
153	1616	197429	1
154	1617	184476	1
155	1618	171523	1
156	1619	158570	1
157	1620	145617	1
158	1621	132664	1
159	1622	119711	1
160	1623	106758	1
161	1701	901456	1
162	1702	872563	1
163	1703	843670	1
164	1705	814777	1
165	1706	785884	1
166	1707	756991	1
167	1708	728098	1
168	1709	699205	1
169	1710	670312	1
170	1711	641419	1
171	1712	612526	1
172	1715	583633	1
173	1716	554740	1
174	1717	525847	1
175	1718	496954	1
176	1719	468061	1
177	1720	439168	1
178	1721	410275	1
179	1722	381382	1
180	1723	352489	1
181	1801	323596	1
182	1802	294703	1
183	1803	265810	1
184	1805	236917	1
185	1806	208024	1
186	1807	179131	1
187	1808	150238	1
188	1809	121345	1
189	1810	854630	1
190	1811	730256	1
191	1812	605882	1
192	1815	481508	1
193	1816	357134	1
194	1817	232760	1
195	1818	108386	1
196	1819	776320	1
197	1820	601254	1
198	1821	426188	1
199	1822	251122	1
200	1823	990073	1
201	1901	813695	1
202	1902	637317	1
203	1903	460939	1
204	1905	284561	1
205	1906	108183	1
206	1907	953026	1
207	1908	807026	1
208	1909	661026	1
209	1910	515026	1
210	1911	369026	1
211	1912	223026	1
212	1915	559102	1
213	1916	103652	1
214	1917	893620	1
215	1918	702583	1
216	1919	511546	1
217	1920	320509	1
218	1921	129472	1
219	1922	951258	1
220	2001	802561	1
221	2002	653864	1
222	2003	505167	1
223	2005	356470	1
224	2006	207773	1
225	2007	109653	1
226	2008	883690	1
227	2009	701598	1
228	2010	519506	1
229	2011	337414	1
230	2012	155322	1
231	2015	880269	1
232	2016	712536	1
233	2017	544803	1
234	2018	377070	1
235	2019	209337	1
236	2020	901230	1
237	2021	604563	1
238	2022	307896	1
239	2023	856320	1
240	2101	700596	1
241	2102	544872	1
242	2103	389148	1
243	2105	233424	1
244	2106	503695	1
245	2107	400223	1
246	2108	296751	1
247	2109	193279	1
248	2110	661036	1
249	2111	559801	1
250	2112	458566	1
251	2115	357331	1
252	2116	256096	1
253	2117	154861	1
254	2118	301533	1
255	2119	290136	1
256	2120	278739	1
257	2121	267342	1
258	2122	255945	1
259	2201	244548	1
260	2202	233151	1
261	2203	221754	1
262	2205	210357	1
263	2206	198960	1
264	2207	187563	1
265	2208	176166	1
266	2209	164769	1
267	2210	153372	1
268	2211	141975	1
269	2212	130578	1
270	2215	119181	1
271	2216	107784	1
272	701	203598	2
273	702	802219	2
274	703	702563	2
275	705	602907	2
276	706	503251	2
277	707	403595	2
278	708	303939	2
279	709	204283	2
280	710	104627	2
281	711	902543	2
282	712	876522	2
283	715	850501	2
284	716	824480	2
285	717	798459	2
286	718	772438	2
287	719	746417	2
288	720	720396	2
289	721	694375	2
290	722	668354	2
291	723	642333	2
292	801	616312	2
293	802	590291	2
294	803	564270	2
295	805	538249	2
296	806	512228	2
297	807	486207	2
298	808	460186	2
299	809	434165	2
300	810	408144	2
301	811	382123	2
302	812	356102	2
303	815	330081	2
304	816	304060	2
305	817	278039	2
306	818	252018	2
307	819	225997	2
308	820	199976	2
309	821	173955	2
310	822	147934	2
311	823	121913	2
312	901	786954	2
313	902	968542	2
314	903	893692	2
315	905	818842	2
316	906	743992	2
317	907	669142	2
318	908	594292	2
319	909	519442	2
320	910	444592	2
321	911	369742	2
322	912	294892	2
323	915	220042	2
324	916	145192	2
325	917	702596	2
326	918	689643	2
327	919	676690	2
328	920	663737	2
329	921	650784	2
330	922	637831	2
331	923	624878	2
333	1002	294703	2
334	1003	265810	2
335	1005	236917	2
336	1006	208024	2
337	1007	179131	2
338	1008	150238	2
339	1009	121345	2
340	1010	854630	2
341	1011	730256	2
342	1012	605882	2
343	1015	481508	2
344	1016	357134	2
345	1017	232760	2
346	1018	108386	2
347	1019	776320	2
348	1020	601254	2
349	1021	426188	2
350	1022	251122	2
351	1023	990073	2
352	1101	813695	2
353	1102	637317	2
354	1103	460939	2
355	1105	284561	2
356	1106	108183	2
357	1107	953026	2
358	1108	807026	2
359	1109	661026	2
360	1110	515026	2
361	1111	369026	2
362	1112	223026	2
363	1115	559102	2
364	1116	103652	2
365	1117	893620	2
366	1118	702583	2
367	1119	511546	2
368	1120	320509	2
369	1121	129472	2
370	1122	951258	2
371	1123	802561	2
372	1201	653864	2
373	1202	505167	2
374	1203	356470	2
375	1205	207773	2
376	1206	109653	2
377	1207	883690	2
378	1208	701598	2
379	1209	519506	2
380	1210	337414	2
381	1211	155322	2
382	1212	880269	2
383	1215	712536	2
384	1216	544803	2
385	1217	377070	2
386	1218	209337	2
387	1219	901230	2
388	1220	604563	2
389	1221	307896	2
390	1222	856320	2
391	1223	700596	2
392	1501	712536	2
393	1502	544803	2
394	1503	377070	2
395	1505	209337	2
396	1506	901230	2
397	1507	604563	2
398	1508	307896	2
399	1509	856320	2
400	1510	700596	2
401	1511	544872	2
402	1512	389148	2
403	1515	233424	2
404	1516	503695	2
405	1517	400223	2
406	1518	296751	2
407	1519	193279	2
408	1520	661036	2
409	1521	559801	2
410	1522	458566	2
411	1523	357331	2
412	1601	256096	2
413	1602	154861	2
414	1603	301533	2
415	1605	290136	2
416	1606	278739	2
417	1607	267342	2
418	1608	255945	2
419	1609	244548	2
420	1610	233151	2
421	1611	221754	2
422	1612	210357	2
423	1615	198960	2
424	1616	187563	2
425	1617	176166	2
426	1618	164769	2
427	1619	153372	2
428	1620	141975	2
429	1621	130578	2
430	1622	119181	2
431	1623	107784	2
432	1701	199976	2
433	1702	173955	2
434	1703	147934	2
435	1705	121913	2
436	1706	786954	2
437	1707	968542	2
438	1708	893692	2
439	1709	818842	2
440	1710	743992	2
441	1711	669142	2
442	1712	594292	2
443	1715	519442	2
444	1716	444592	2
445	1717	369742	2
446	1718	294892	2
447	1719	220042	2
448	1720	145192	2
449	1721	702596	2
450	1722	689643	2
451	1723	676690	2
452	1801	663737	2
453	1802	650784	2
454	1803	637831	2
455	1805	624878	2
456	1806	611925	2
457	1807	598972	2
458	1808	586019	2
459	1809	573066	2
460	1810	560113	2
461	1811	547160	2
462	1812	534207	2
463	1815	521254	2
464	1816	508301	2
465	1817	495348	2
466	1818	482395	2
467	1819	469442	2
468	1820	456489	2
469	1821	443536	2
470	1822	430583	2
471	1823	417630	2
472	1901	404677	2
473	1902	391724	2
474	1903	378771	2
475	1905	365818	2
476	1906	352865	2
477	1907	339912	2
478	1908	326959	2
479	1909	314006	2
480	1910	301053	2
481	1911	288100	2
482	1912	275147	2
483	1915	262194	2
484	1916	249241	2
485	1917	236288	2
486	1918	223335	2
487	1919	210382	2
488	1920	197429	2
489	1921	184476	2
490	1922	171523	2
491	2001	158570	2
492	2002	145617	2
493	2003	132664	2
494	2005	119711	2
495	2006	106758	2
496	2007	901456	2
497	2008	872563	2
498	2009	843670	2
499	2010	814777	2
500	2011	785884	2
501	2012	756991	2
502	2015	728098	2
503	2016	699205	2
504	2017	670312	2
505	2018	641419	2
506	2019	612526	2
507	2020	583633	2
508	2021	554740	2
509	2022	525847	2
510	2023	496954	2
511	2101	468061	2
512	2102	439168	2
513	2103	410275	2
514	2105	381382	2
515	2106	352489	2
516	2107	323596	2
517	2108	294703	2
518	2109	265810	2
519	2110	236917	2
520	2111	208024	2
521	2112	179131	2
522	2115	150238	2
523	2116	121345	2
524	2117	854630	2
525	2118	730256	2
526	2119	605882	2
527	2120	481508	2
528	2121	357134	2
529	2122	232760	2
530	2201	108386	2
531	2202	776320	2
532	2203	601254	2
533	2205	426188	2
534	2206	251122	2
535	2207	990073	2
536	2208	813695	2
537	2209	637317	2
538	2210	460939	2
539	2211	284561	2
540	2212	108183	2
541	2215	953026	2
542	2216	807026	2
543	701	791501	3
544	702	877513	3
545	703	963525	3
546	705	159369	3
547	706	158745	3
548	707	456578	3
549	708	156612	3
550	709	789153	3
551	710	145369	3
552	711	147583	3
553	712	511325	3
554	715	365412	3
555	716	698262	3
556	717	154263	3
557	718	987452	3
558	719	258963	3
559	720	147852	3
560	721	123654	3
561	722	654789	3
562	723	852963	3
563	801	741159	3
564	802	159741	3
565	803	963573	3
566	805	254589	3
567	806	584213	3
568	807	159741	3
569	808	258785	3
570	809	145632	3
571	810	789654	3
572	811	652369	3
573	812	987523	3
574	815	145236	3
575	816	458963	3
576	817	123987	3
577	818	456258	3
578	819	741963	3
579	820	789321	3
580	821	145698	3
581	822	502415	3
582	823	103265	3
583	901	102548	3
584	902	201354	3
585	903	302156	3
586	905	402132	3
587	906	501235	3
588	907	401235	3
589	908	402315	3
590	909	602123	3
591	910	203598	3
592	911	802219	3
593	912	702563	3
594	915	602907	3
595	916	503251	3
596	917	403595	3
597	918	303939	3
598	919	204283	3
599	920	104627	3
600	921	902543	3
601	922	876522	3
602	923	850501	3
604	1002	798459	3
605	1003	772438	3
606	1005	746417	3
607	1006	720396	3
608	1007	694375	3
609	1008	668354	3
610	1009	642333	3
611	1010	616312	3
612	1011	590291	3
613	1012	564270	3
614	1015	538249	3
615	1016	512228	3
616	1017	486207	3
617	1018	460186	3
618	1019	434165	3
619	1020	408144	3
620	1021	382123	3
621	1022	356102	3
622	1023	330081	3
623	1101	304060	3
624	1102	278039	3
625	1103	252018	3
626	1105	225997	3
627	1106	199976	3
628	1107	173955	3
629	1108	147934	3
630	1109	121913	3
631	1110	786954	3
632	1111	968542	3
633	1112	893692	3
634	1115	818842	3
635	1116	743992	3
636	1117	669142	3
637	1118	594292	3
638	1119	519442	3
639	1120	444592	3
640	1121	369742	3
641	1122	294892	3
642	1123	220042	3
643	1201	145192	3
644	1202	702596	3
645	1203	689643	3
646	1205	676690	3
647	1206	663737	3
648	1207	650784	3
649	1208	637831	3
650	1209	624878	3
651	1210	611925	3
652	1211	598972	3
653	1212	586019	3
654	1215	573066	3
655	1216	560113	3
656	1217	547160	3
657	1218	534207	3
658	1219	521254	3
659	1220	508301	3
660	1221	495348	3
661	1222	482395	3
662	1223	469442	3
663	1501	456489	3
664	1502	443536	3
665	1503	430583	3
666	1505	417630	3
667	1506	404677	3
668	1507	391724	3
669	1508	378771	3
670	1509	365818	3
671	1510	352865	3
672	1511	339912	3
673	1512	326959	3
674	1515	314006	3
675	1516	301053	3
676	1517	288100	3
677	1518	275147	3
678	1519	262194	3
679	1520	249241	3
680	1521	236288	3
681	1522	223335	3
682	1523	210382	3
683	1601	197429	3
684	1602	184476	3
685	1603	171523	3
686	1605	158570	3
687	1606	145617	3
688	1607	132664	3
689	1608	119711	3
690	1609	106758	3
691	1610	901456	3
692	1611	872563	3
693	1612	843670	3
694	1615	814777	3
695	1616	785884	3
696	1617	756991	3
697	1618	728098	3
698	1619	699205	3
699	1620	670312	3
700	1621	641419	3
701	1622	612526	3
702	1623	583633	3
703	1701	554740	3
704	1702	525847	3
705	1703	496954	3
706	1705	468061	3
707	1706	439168	3
708	1707	410275	3
709	1708	381382	3
710	1709	352489	3
711	1710	323596	3
712	1711	294703	3
713	1712	265810	3
714	1715	236917	3
715	1716	208024	3
716	1717	179131	3
717	1718	150238	3
718	1719	121345	3
719	1720	854630	3
720	1721	730256	3
721	1722	605882	3
722	1723	481508	3
723	1801	357134	3
724	1802	232760	3
725	1803	108386	3
726	1805	776320	3
727	1806	601254	3
728	1807	426188	3
729	1808	251122	3
730	1809	990073	3
731	1810	813695	3
732	1811	637317	3
733	1812	460939	3
734	1815	284561	3
735	1816	108183	3
736	1817	953026	3
737	1818	807026	3
738	1819	661026	3
739	1820	515026	3
740	1821	369026	3
741	1822	223026	3
742	1823	559102	3
743	1901	103652	3
744	1902	893620	3
745	1903	702583	3
746	1905	511546	3
747	1906	320509	3
748	1907	129472	3
749	1908	951258	3
750	1909	802561	3
751	1910	653864	3
752	1911	505167	3
753	1912	356470	3
754	1915	207773	3
755	1916	109653	3
756	1917	883690	3
757	1918	701598	3
758	1919	519506	3
759	1920	337414	3
760	1921	155322	3
761	1922	880269	3
762	2001	712536	3
763	2002	544803	3
764	2003	377070	3
765	2005	209337	3
766	2006	901230	3
767	2007	604563	3
768	2008	307896	3
769	2009	856320	3
770	2010	700596	3
771	2011	544872	3
772	2012	389148	3
773	2015	233424	3
774	2016	503695	3
775	2017	400223	3
776	2018	296751	3
777	2019	193279	3
778	2020	661036	3
779	2021	559801	3
780	2022	458566	3
781	2023	357331	3
782	2101	256096	3
783	2102	154861	3
784	2103	301533	3
785	2105	290136	3
786	2106	278739	3
787	2107	267342	3
788	2108	255945	3
789	2109	244548	3
790	2110	233151	3
791	2111	221754	3
792	2112	210357	3
793	2115	198960	3
794	2116	187563	3
795	2117	176166	3
796	2118	164769	3
797	2119	153372	3
798	2120	141975	3
799	2121	130578	3
800	2122	119181	3
801	2201	203598	3
802	2202	802219	3
803	2203	702563	3
804	2205	602907	3
805	2206	503251	3
806	2207	403595	3
807	2208	303939	3
808	2209	204283	3
809	2210	104627	3
810	2211	902543	3
811	2212	876522	3
812	2215	850501	3
813	2216	824480	3
814	701	702583	4
815	702	511546	4
816	703	320509	4
817	705	129472	4
818	706	951258	4
819	707	802561	4
820	708	653864	4
821	709	505167	4
822	710	356470	4
823	711	207773	4
824	712	109653	4
825	715	883690	4
826	716	701598	4
827	717	519506	4
828	718	337414	4
829	719	155322	4
830	720	880269	4
831	721	712536	4
832	722	544803	4
833	723	377070	4
834	801	209337	4
835	802	901230	4
836	803	604563	4
837	805	307896	4
838	806	856320	4
839	807	700596	4
840	808	544872	4
841	809	389148	4
842	810	233424	4
843	811	503695	4
844	812	400223	4
845	815	296751	4
846	816	193279	4
847	817	661036	4
848	818	559801	4
849	819	458566	4
850	820	357331	4
851	821	256096	4
852	822	154861	4
853	823	301533	4
854	901	290136	4
855	902	278739	4
856	903	267342	4
857	905	255945	4
858	906	244548	4
859	907	233151	4
860	908	221754	4
861	909	210357	4
862	910	198960	4
863	911	187563	4
864	912	176166	4
865	915	164769	4
866	916	153372	4
867	917	141975	4
868	918	130578	4
869	919	119181	4
870	920	203598	4
871	921	802219	4
872	922	702563	4
873	923	602907	4
875	1002	403595	4
876	1003	303939	4
877	1005	204283	4
878	1006	104627	4
879	1007	902543	4
880	1008	876522	4
881	1009	850501	4
882	1010	824480	4
883	1011	616312	4
884	1012	590291	4
885	1015	564270	4
886	1016	538249	4
887	1017	512228	4
888	1018	486207	4
889	1019	460186	4
890	1020	434165	4
891	1021	408144	4
892	1022	382123	4
893	1023	356102	4
894	1101	330081	4
895	1102	304060	4
896	1103	278039	4
897	1105	252018	4
898	1106	225997	4
899	1107	199976	4
900	1108	173955	4
901	1109	147934	4
902	1110	121913	4
903	1111	786954	4
904	1112	968542	4
905	1115	893692	4
906	1116	818842	4
907	1117	743992	4
908	1118	669142	4
909	1119	594292	4
910	1120	519442	4
911	1121	444592	4
912	1122	369742	4
913	1123	294892	4
914	1201	220042	4
915	1202	145192	4
916	1203	702596	4
917	1205	689643	4
918	1206	676690	4
919	1207	663737	4
920	1208	650784	4
921	1209	637831	4
922	1210	624878	4
923	1211	323596	4
924	1212	294703	4
925	1215	265810	4
926	1216	236917	4
927	1217	208024	4
928	1218	179131	4
929	1219	150238	4
930	1220	121345	4
931	1221	854630	4
932	1222	730256	4
933	1223	605882	4
934	1501	481508	4
935	1502	357134	4
936	1503	232760	4
937	1505	108386	4
938	1506	776320	4
939	1507	601254	4
940	1508	426188	4
941	1509	251122	4
942	1510	990073	4
943	1511	813695	4
944	1512	637317	4
945	1515	460939	4
946	1516	284561	4
947	1517	108183	4
948	1518	953026	4
949	1519	807026	4
950	1520	661026	4
951	1521	515026	4
952	1522	369026	4
953	1523	223026	4
954	1601	559102	4
955	1602	103652	4
956	1603	893620	4
957	1605	702583	4
958	1606	511546	4
959	1607	320509	4
960	1608	129472	4
961	1609	951258	4
962	1610	802561	4
963	1611	653864	4
964	1612	505167	4
965	1615	356470	4
966	1616	207773	4
967	1617	109653	4
968	1618	883690	4
969	1619	701598	4
970	1620	519506	4
971	1621	337414	4
972	1622	155322	4
973	1623	880269	4
974	1701	712536	4
975	1702	544803	4
976	1703	377070	4
977	1705	209337	4
978	1706	901230	4
979	1707	604563	4
980	1708	307896	4
981	1709	856320	4
982	1710	700596	4
983	1711	712536	4
984	1712	544803	4
985	1715	377070	4
986	1716	209337	4
987	1717	901230	4
988	1718	604563	4
989	1719	307896	4
990	1720	856320	4
991	1721	700596	4
992	1722	544872	4
993	1723	389148	4
994	1801	233424	4
995	1802	503695	4
996	1803	400223	4
997	1805	296751	4
998	1806	193279	4
999	1807	661036	4
1000	1808	559801	4
1001	1809	458566	4
1002	1810	357331	4
1003	1811	256096	4
1004	1812	154861	4
1005	1815	301533	4
1006	1816	290136	4
1007	1817	278739	4
1008	1818	267342	4
1009	1819	255945	4
1010	1820	244548	4
1011	1821	233151	4
1012	1822	221754	4
1013	1823	210357	4
1014	1901	198960	4
1015	1902	187563	4
1016	1903	176166	4
1017	1905	164769	4
1018	1906	153372	4
1019	1907	141975	4
1020	1908	130578	4
1021	1909	119181	4
1022	1910	107784	4
1023	1911	199976	4
1024	1912	173955	4
1025	1915	147934	4
1026	1916	121913	4
1027	1917	786954	4
1028	1918	968542	4
1029	1919	893692	4
1030	1920	818842	4
1031	1921	743992	4
1032	1922	669142	4
1033	2001	594292	4
1034	2002	519442	4
1035	2003	444592	4
1036	2005	369742	4
1037	2006	294892	4
1038	2007	220042	4
1039	2008	145192	4
1040	2009	702596	4
1041	2010	689643	4
1042	2011	676690	4
1043	2012	663737	4
1044	2015	650784	4
1045	2016	637831	4
1046	2017	624878	4
1047	2018	611925	4
1048	2019	598972	4
1049	2020	586019	4
1050	2021	573066	4
1051	2022	560113	4
1052	2023	547160	4
1053	2101	534207	4
1054	2102	521254	4
1055	2103	508301	4
1056	2105	495348	4
1057	2106	482395	4
1058	2107	469442	4
1059	2108	456489	4
1060	2109	443536	4
1061	2110	430583	4
1062	2111	417630	4
1063	2112	404677	4
1064	2115	391724	4
1065	2116	378771	4
1066	2117	365818	4
1067	2118	352865	4
1068	2119	339912	4
1069	2120	326959	4
1070	2121	314006	4
1071	2122	301053	4
1072	2201	288100	4
1073	2202	275147	4
1074	2203	262194	4
1075	2205	249241	4
1076	2206	236288	4
1077	2207	223335	4
1078	2208	210382	4
1079	2209	197429	4
1080	2210	184476	4
1081	2211	171523	4
1082	2212	158570	4
1083	2215	145617	4
1084	2216	132664	4
603	1001	824480	3
874	1001	503251	4
61	1001	203598	1
332	1001	323596	2
1089	2	21	\N
1090	2	22	\N
1091	2	23	\N
1092	2	24	\N
1093	2	21	\N
1094	2		\N
1095	2		\N
1096	2		\N
\.


--
-- Name: hotspots_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('hotspots_seq', 1100, true);


--
-- Data for Name: inhouse_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY inhouse_translations (translation_id, inhouses_id, language_id, translation_title, translation_description) FROM stdin;
1	2	  		
2	2	  		
4	2	  		
6	2	jp	ハウス	
7	2	  		
8	2	  		
9	2	  		
10	2	  		
12	2	  		
14	2	  		
15	2	  		
11	2	cn	在众议院	
3	2	en	In House	
5	2	id	Internal	
16	2	  		
13	2	kr	집에서	
\.


--
-- Name: inhouse_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('inhouse_translations_translation_id_seq', 16, true);


--
-- Data for Name: inhouses; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY inhouses (inhouses_id, inhouses_image, inhouses_image_enabled, inhouses_clip, inhouses_clip_enabled, inhouses_enabled, inhouses_order) FROM stdin;
2	telephone-directory-01	0		0	1	1
\.


--
-- Name: inhouses_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('inhouses_seq', 2, true);


--
-- Data for Name: interest_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY interest_translations (translation_id, interest_id, language_id, translation_title, translation_description) FROM stdin;
10	2	  		
12	2	  		
14	2	jp	Interest	
15	2	  		
16	2	  		
17	2	  		
11	2	en	&lt;font size=&quot;4&quot;&gt;Making a big splash – Waterbom Bali&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt; Head to Asia’s number one waterpark and number three most popular waterpark in the world. One super fun thing that you can do with your friends and family. Scream, laugh and challenge yourself with the fabulous slide and race all the way down! Described as an oasis in the middle of the famous KUta strectch, Waterbom sets itself in lush tropical garden with many great rides and attractions. Exciting water slides slice through 3.8 hectares of landscaped tropical parks providing hours of fun and entertainment for the young and the young at heart! There are 101 ways to fill 24 hours each day with thrilling activities on land and in water.&lt;/font&gt;
18	2	  		
19	3	  		
22	3	  		
23	4	  		
26	4	  		
31	3	kr	&lt;font size=&quot;4&quot;&gt;자연과 릴리스 아기 바다 거북 가기 보내기&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;해변은 모두 모두 동물과 인간 에 의해 공유 되어 있지만 우리의 큰 존재는 때때로 좋은 보다 동물 에게 해를 더 할 수 있습니다. 그러나 여기에 바다 거북 사회 에서 , 자연과 인간의 삶 사이의 균형 이 중단 되지 않습니다. 당신이 그들의 자연 서식지 로 다시 저장 한 아기 바다 거북 을 해제 할 수 있습니다 당신의 역할을 할 수있는 기회 가있다. 귀여운 아기 거북 다시 바다로 뒤뚱 거리며 자신의 새로운 삶을 시작 으로 시계 . 그것의 끝에서 , 거대한 바다 거북 사진을 취함으로써 환경을 만든다.&lt;/font&gt;
32	4	cn	&lt;font size=&quot;4&quot;&gt;購物，吃飯和享受在海灘步道商場與Discovery購物中心&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;西班牙品牌Pull and Bear, Zara，甚至Bath 和的BodyWorks只是其中一種的眾多備受喜愛的品牌，你可以找到在這些時尚的購物商店。嘗試一些美食在頂樓的美食廣場，供應廣泛的亞洲印尼美食。通過逛街的同時， 您會學習到當地蠟染布的歷史。 博物館裡也展示當地設計的蠟染布&lt;/font&gt;
24	4	en	&lt;font size=&quot;4&quot;&gt;Shop, Eat and Have Fun at Beachwalk and Discovery Shopping Center&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Pull and Bear, Zara and even Bath and Bodyworks are just a few of the various well-loved brands you can find at these trendy shopping spots. Take a bite at Eat &amp; Eat food court on the top floor, which serves a wide range of Aisan cuisine including Indonesian favorites. Though an interactive walk, you will learn all about the history of Batik. The museum also showcases handmade Batik pieces that are exquisitely designed by the locals.&lt;/font&gt;
27	2	  		
20	3	en	&lt;font size=&quot;4&quot;&gt;Give Back to Nature and Release Baby Sea Turtles&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;The beach is shared by both animals and humans alike, but our large presence can sometimes do the animals more harm than good. But here at The Sea Turtle Society, the balance between nature and human life is not interrupted. There is a chance to play your part that you can release the baby sea turtles that have been saved back to their natural habitat. Watch as the cute baby turtles waddle back to the sea and start their new life. At the end of it, make the experience by taking a photo with the huge sea turtle.&lt;/font&gt;
9	2	cn	&lt;font size=&quot;4&quot;&gt;製作一個大水花 – 巴里島水上世界&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;前往亞洲第一名和世界排名第三名的水上樂園。一個超好趣的事情，你可以與朋友和家人做的事。尖叫，一起歡笑，挑戰自己在每個完美滑水道！在著名的庫塔延伸區的中間是一片綠洲，水上設置本身有許多很棒的遊樂設施和綠意茂密的熱帶花園。刺激的滑水道遍佈3.8公頃的熱帶公園提供年輕人長時間的發自內心樂趣和娛樂！有101種方式水上與陸地活動讓您一天二十四小時都很充實。&lt;/font&gt;
30	3	  		
29	3	cn	&lt;font size=&quot;4&quot;&gt;回饋自然和放生小海龜&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;海灘是屬於動物和人類，但人類大量存在有時反而會弊大於利。但是，在此間舉行的海龜社會，自然與人類生活之間的平衡也不會中斷。還有就是要發揮自己的作用，你可以釋放保育的海龜回到其自然棲息地的小海龜。看著可愛的小海龜蹣跚回大海，並開始他們的新生活。在活動結束，會有與大海龜拍照片的經驗。&lt;/font&gt;
25	4	id	&lt;font size=&quot;4&quot;&gt;Berbelanja, makan dan bersenang-senang di Beachwalk dan Discovery Shopping Mall&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Pull and Bear, Zara and dan Bath and Bodyworks adalah beberapa dari berbagai merek yang sangat dicintai yang dapat anda temukan di pusat perbelanjaan yang trendi di daerah pusat Kuta ini. Cicipi berbagai makanan di Pusat makanan Eat &amp; Eat yany terletak di lantai paling atas, yang menyajikan berbagai macam masakan khas Asia dan Indonesia. Dengan melakukan perjalanan yang interaktif, anda akan belajar tentang sejarah Batik. Museum ini juga menampilkan potongan-potongan Batik buatan tangan yang indah yang dirancang oleh penduduk setempat.&lt;/font&gt;
33	4	  		
21	3	id	&lt;font size=&quot;4&quot;&gt;Ucapkan Terima Kasih pada alam dengan melepas anak kura-kura&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Demi melestarikan alam beserta isinya, The Sea Turtle Society memperkenalkan program melepas bayi kura-kura untuk kembali ke habitat asli mereka agar eseimbangan antara alam dan kehidupan manusia tidak terganggu. Anda berkesempatan untuk melepaskan bayi kura-kura yang sudah diselamatkan kembali ke habitat alami mereka. Melihat bagaimana lucunya bayi kura-kura berenang kembali ke laut dan memulai kehidupan baru mereka. Dan di akhir aktifitas ini Anda dapat mengambil foto dengan kura – kura laut yang besar dan dan membuat ini menjadi pengalaman berharga yang tidak terlupakan.&lt;/font&gt;
35	2	  		
36	3	  		
37	4	  		
53	3	  		
41	5	  		
28	2	kr	&lt;font size=&quot;4&quot;&gt;큰 스플래시 만들기 - 워터 봄 발리&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;세계에서 아시아 의 번호를 하나의 워터 파크 와 세 번째 로 가장 인기있는 워터 파크 에 머리. 당신은 당신의 친구 및 가족과 함께 할 수있는 하나의 슈퍼 재미 것 . 비명 웃음 과 멋진 슬라이드 와 함께 자신을 도전하고 끝까지 경주 ! 유명한 쿠타 strectch 의 중간에 오아시스 설명 , 워터 봄 은 많은 훌륭한 놀이기구와 관광 명소 와 무성한 열대 정원에서 자신을 설정합니다. 신나는 워터 슬라이드 는 어린 마음 에 젊은 재미 와 오락 의 시간 을 제공하는 열대 공원 의 3.8 헥타르 를 통해 슬라이스 ! 24시간 땅 에 물 에 스릴 넘치는 활동을 매일 작성 하는 101 가지 방법이 있습니다.&lt;/font&gt;
44	5	  		
57	3	  		
43	5	  		
50	3	  		
45	5	  		
47	5	  		
48	5	  		
56	5	  		
62	3	  		
46	5	  		
51	2	  		
49	5	  		
38	5	cn	&lt;font size=&quot;4&quot;&gt;世界各地3D藝術巴厘島夢幻博物館區&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;3D一直以來，3D電視體驗誕生的趨勢。在夢想館區巴厘島，你可以成為這個運動的一部分，並與各種互動式的背景創造你自己的樂趣。從入口處的埃及金字塔迷宮，和想像世界的創造會帶領你到一個全新的世界，你從來沒有期望看到的。我們邀請您來我們的驚喜和刺激的空間，感受這個世界充滿了樂趣和喜悅，可以通過特殊的3D想像藝術。在博物館裡，你將享受來自韓國的創意知名藝術家創作的120藝術作品。&lt;/font&gt;
52	4	  		
86	9	cn	&lt;font size=&quot;4&quot;&gt;藏在金巴蘭灣的海鮮寶藏&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;金巴蘭海灣是有大約五十間燒烤海鮮餐廳，全部環繞著海灘。在沙灘上擺放桌子。迎面而來的海風，伴隨著美麗日落，天黑後沙灘上點起一盞盞的燭光。一切都是新鮮捕獲的海鮮，金巴蘭仍然是一個漁村。不要錯過機會跟漁民一起捕魚的機會，挑選自己喜歡的魚，並與廚師一起做飯。道地的巴厘島之旅即將開始！&lt;/font&gt;
54	2	  		
55	4	  		
34	4	kr	&lt;font size=&quot;4&quot;&gt;쇼핑 , 먹고 Beachwalk 및 검색 쇼핑 센터 에서 재미를&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;차와 곰 , 자라 , 심지어 목욕 및 Bodyworks 은 당신 이 최신 유행의 쇼핑 명소 에서 찾을 수있는 다양한 잘 사랑받는 브랜드 의 몇 가지 있습니다 . 식사 및 인도네시아어 즐겨 찾기를 포함 AISAN 요리 의 넓은 범위 를 제공 꼭대기 층 에 푸드 코트 를 먹어 에 물린 하십시오. 대화 형 거리에 있지만, 모든 바틱 의 역사에 대해 배울 것입니다. 박물관은 또한 정교 지역 주민에 의해 설계되어 손으로 만든 바틱 조각을 전시한다 .&lt;/font&gt;
13	2	id	&lt;font size=&quot;4&quot;&gt;Membuat Percikan Besar – Waterbom Bali&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Waterbom Bali merupakan taman wisata air nomor satu di Asia dan nomor tiga paling populer di Dunia. Tempat ini adalah salah satu tempat yang menawarkan kegiatan paling menyenangkan untuk liburan bersama teman-teman dan keluarga Anda. Menjerit, tertawa dan menantang diri anda sendiri dengan pilihan wahana seluncuran hebat dan berlomba turun ke bawah! Waterbom sebagai sebuah oase di tengah Kuta yang terkenal dengan wisata pantai dan pusat perbelanjaan, Waterbom memiliki desain taman tropis yang rimbun dengan banyak wahana besar dan berbagai atraksi. Dengan luas total sebesar 3.8 hektar, taman hiburan ini dapat memberikan pengalaman yang berkesan dan tak terlupakan. Tersedia 101 pilihan wahana untuk mengisi hari Anda dengan aktifitas yang ditawarkan di Waterbom Bali.&lt;/font&gt;
58	2	  		
60	4	  		
59	2	  		
84	8	  		
61	5	  		
63	4	  		
40	5	id	&lt;font size=&quot;4&quot;&gt;Pengalaman 3D Trick di Dream Museum Zone Bali&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;3D sudah menjadi tren semenjak televise pertama 3D di perkenalkan. Di Dream Museum Bali, Anda dapat menjadi bagian dari gerakan ini dan miliki kesenangan tersendiri dengan berbagai latar belakang lukisan tiga dimensi yang interaktif. Dari seni ilusi tipu daya yang terletak di pintu masuk labirin Piramida Mesir, dan berlanjut ke dunia imajinasi yang akan memandu Anda ke dunia baru yang belum pernah anda saksikan sebelumnya. Di museum, anda akan menikmati sekitar 120 karya seni yang dibuat oleh seniman Korea dengan berbagai ilusi yang telah dikenal di seluruh dunia.&lt;/font&gt;
64	2	  		
65	5	  		
39	5	en	&lt;font size=&quot;4&quot;&gt;3D Trick Art around the world at Dream Museum Zone Bali&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;3D has been trend since the birth of 3D experience television. At the Dream Museum Zone Bali, you can be a part of this movement and have your own fun with various interactive background. From the illusion trickery art at the entrance to the labyrinth of Egyptian pyramid, and the world of imaginations afterwards will guide you to a whole new world you have never expected to see. We invite you to come to our space of surprises and excitements, and experience the world full of fun and joy that could be only brought to you through 3D special illusion art. In the museum, you will enjoy about 120 art pieces created by worldly renowned illusion artists from Korea.&lt;/font&gt;
66	3	  		
67	5	  		
76	7	cn	&lt;font size=&quot;4&quot;&gt;南灣水上運動&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;南灣水上運動從09:00開始 到 14:00，14：00以後潮汐變很低，不適合水上活動後。安全和客戶滿意是每個巴厘島水上運動運營商優先考慮的主要事情。為了確保客戶安全，南灣水上運動公司訓練他們的工作人員充分了解安全和應急的標準和程序。不僅工作人員，所有的設備必須通過水上活動安全的國際標準的批准。並包含保險，保險由您選擇的水上運動公司提供。&lt;/font&gt;
68	4	  		
69	2	  		
70	3	  		
74	6	  		
79	7	  		
78	7	id	&lt;font size=&quot;4&quot;&gt;Ayo Bersenang-senang di Tanjung Benoa Watersport&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Kegiatan olahraga air Tanjung Benoa mulai dari jam 9:00-14:00, setelah pukul 14:00 siang air laut di Tanjung Benoa akan surut dan tidak cocok untuk kegiatan olahraga air. Keselamatan dan kepuasan pelanggan adalah hal yang menjadi prioritas utama setiap penyedia jasa olahraga air di Bali. Untuk memastikan keselamatan pelanggan, penyedia jasa Watersport di Tanjung Benoa melatih pegawai mereka agar memenuhi syarat dan paham tentang standar dan prosedur keselamatan maupun ketika berada dalam keadaan darurat. Tidak hanya pegawai, namun semua peralatan harus sesuai dengan standar keselamatan internasional olahraga air.&lt;/font&gt;
73	6	id	&lt;font size=&quot;4&quot;&gt;Surf the Waves at Odysseys Surf School&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Kuta beach is also known as the surfing paradise – evident from the huge waves and the crowd of surfers with their tan and colorful surf boards. It’s also the locals’ favorite pastime and a sport that you should definitely pick up if you love water and sports. Odysseys Surf School has trained professional local surf instructors who are fluent in English to provide you a good surfing experience. Lessons start at USD 35 inclusive of shower facilities, towel, lockers, insurance, a certificate and surfing equipment.&lt;/font&gt;
42	5	kr	&lt;font size=&quot;4&quot;&gt;꿈 박물관 존 발리 에서 전 세계 3D 트릭 아트&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;3D 는 3D 경험을 텔레비전 의 탄생 이후 추세 였다. 꿈 박물관 존 발리 에서, 당신은 이 운동 의 한 부분이 될 다양한 대화 형 배경으로 자신 만의 재미를 가질 수 있습니다. 이집트 피라미드의 미로 , 그리고 상상 의 세계 의 입구 에서 환상 의 속임수 의 예술 에서 나중에 당신 이 볼 것으로 예상 적이없는 완전히 새로운 세계로 여러분을 안내 할 것입니다 . 우리는 놀라움 과 감동이 우리의 공간 에 와서 , 단지 3D 특수 환상 예술 을 통해 당신에게 가져 수있는 재미와 기쁨 의 전체 세계를 경험하는 여러분을 초대합니다 . 박물관 에서는 한국 에서 세상 유명한 환상 의 예술가 에 의해 만들어진 약 120 예술 작품 을 즐길 수 있습니다.&lt;/font&gt;
72	6	en	&lt;font size=&quot;4&quot;&gt;Surf the Waves at Odysseys Surf School&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Kuta beach is also known as the surfing paradise – evident from the huge waves and the crowd of surfers with their tan and colorful surf boards. It’s also the locals’ favorite pastime and a sport that you should definitely pick up if you love water and sports. Odysseys Surf School has trained professional local surf instructors who are fluent in English to provide you a good surfing experience. Lessons start at USD 35 inclusive of shower facilities, towel, lockers, insurance, a certificate and surfing equipment.&lt;/font&gt;
77	7	en	&lt;font size=&quot;4&quot;&gt;Make some fun at Tanjung Benoa Watersport&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Water sport Tanjung Benoa activities start from 09:00 – 14:00, after 14:00 noon the seawater at Tanjung Benoa will be low and not suitable for water sports activities. Safety and customer satisfactions are thing that becomes the main priority of each water sports operator in Bali. To make sure safety for customers, Tanjung Benoa watersports operator companies trained their staff to qualified and know about safety and emergency standard and procedure. Not only the staff, all the equipment must be approved by international standard of water sports safety. Insurance is must, because all rate that you pay is already include with life insurance and provide by the water sports operator that you choose.&lt;/font&gt;
71	6	cn	&lt;font size=&quot;4&quot;&gt;冲浪波在奥德赛冲浪学校&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;库塔海滩也被称为的冲浪天堂 - 显而易见的，从巨大的海浪并与他们的棕褐色和多彩的冲浪板冲浪的人群。这也是当地人最喜欢的消遣和运动，如果你喜欢水和运动，你一定要拿起。奥德赛冲浪学校已培养当地专业讲师冲浪谁一口流利的英语，为您提供一个良好的冲浪体验。吸取35美元包容淋浴设施，毛巾，储物柜，保险，证书和冲浪设备的启动。&lt;/font&gt;
75	6	kr	&lt;font size=&quot;4&quot;&gt;Odysseys 서핑 학교 에서 파도 를 서핑&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;거대한 파도 분명 자신의 황갈색과 화려한 서핑 보드와 서퍼 의 군중 - 쿠타 해변 은 서핑 의 천국 으로 알려져있다. 또한 지역 주민 좋아하는 취미 및 물과 스포츠 를 사랑한다면 당신은 확실히 픽업 한다 스포츠 입니다. Odysseys 서핑 학교 는 당신에게 좋은 서핑 환경을 제공하기 위해 영어 에 능통 한 전문 지역 서핑 강사 를 훈련했다 . 수업은 샤워 시설 , 수건, 사물함 , 보험, 인증서 및 서핑 장비 포함 USD 35 부터 시작 .&lt;/font&gt;
89	9	  		
94	10	  		
83	8	id	&lt;font size=&quot;4&quot;&gt;Matahari terbenam yang menakjubkan dan irama Tari Kecak di Pura Uluwatu&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Jika Anda mencari tempat terbaik untuk menikmati langit Bali saat matahari terbenam, maka Anda maka Pura Uluwatu dapat menjadi salah satu pilihan terbaik dan matahari terbenam dapat dengan indah dilihat dari tebing tertinggi. Anda akan terpesona oleh pemandangan menakjubkan matahari terbenam di Pura Uluwatu yang cantik dengan latar belakang laut  Samudera Hindia yang berkilauan. Tari Kecak yang spektakuler dijadwalkan setiap hari selama waktu matahari terbenam yang akan membawa Anda ke salah satu acara yang ini menawarkan pemandangan terbaik untuk melihat matahari terbenam yang menakjubkan.&lt;/font&gt;
100	7	  		
101	6	  		
96	10	  		
82	8	en	&lt;font size=&quot;4&quot;&gt;Breathtaking Sunset and Mesmerising Kecak Dance at Uluwatu Temple&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;If you are looking for the best spot to enjoy Bali’s sky during sunset, come to the Uluwatu temple where the sunset can be beautifully captured from the highest cliff. Be mesmerized by the awe-inspiring sight of the setting sun against the beautiful Uluwatu Temple with the shimmering Indian Ocean as the backdrop. Balinese’s spectacular Kecak dance is scheduled daily during sunset time which will lead you to one of the most epic show in the world. Dropped in the majestic cliff of Uluwatu, the location offers its best to watch the breathtaking sunset.&lt;/font&gt;
97	8	  		
93	10	id	&lt;font size=&quot;4&quot;&gt;Kuta Karnival di Bulan October&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Ambil bagian dalam perayaan tahunan Kuta Karnival yang pertama kali diadakan!\nSelama satu pekan, kegembiraan di Kuta meningkat dengan berbagai kegiatan seperti pemutaran film, kompetisi istana pasir, parade budaya yang menampilkan kostum rakyat Bali and masih banyak lagi. Beberapa warung juga tersebar di sepanjang pantai dan menawarkan  berbagai masakan favorit khas Indonesia, masakan khas internasional dan aneka bir. Tandai kalender Anda karena acara menarik ini akan dimulai pada Oktober 2016!\n&lt;/font&gt;
92	10	en	&lt;font size=&quot;4&quot;&gt;Kuta Karnival in October&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Join in the whole of Kuta in yearly Kuta Karnival celebrations! For one weekend only, the fun in Kuta intensifies with various activities such as movie screenings, sand castle competitions, cultural parades showcasing Bali’s folk costumes and many more. Food stalls will be scattered along the beach, serving up your favorite Indonesian cuisine, Western dishes and various beers. Mark your calendar because this fascinating event will be starting their first launching this October 2016!&lt;/font&gt;
98	9	  		
88	9	id	&lt;font size=&quot;4&quot;&gt;Surga Seafood di Jimbaran&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Jimbaran Bay adalah pusat bagi sekitar lima puluh restoran yang menyajikan hidangan laut bakar. Hampir semua restoran berlokasi di tepi pantai dan meja – meja di tempatkan di atas pasir sepanjang pantai Jimbaran. Angin laut yang sejuk, matahari terbenam yang indah dan penerangan tradisional menggunakan obor merupakan salah satu pengalaman yang di tawarkan ketika menikmati hidangan di pantai ini dan semua hidangan lautnya adalah hasil tangkapan langsung dari para nelayan di desa Jimbaran. Jangan lewatkan juga kegiatan memancing bersama Nelayan dan memilih sendiri ikan yang akan dimasak oleh Chef. Pengalaman liburan dengan nuansa budaya Anda di Bali akan segera di mulai!&lt;/font&gt;
91	10	cn	&lt;font size=&quot;4&quot;&gt;庫塔十月嘉年華&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;加入每年在庫塔舉辦的嘉年華慶典！在這個週末，您可以找到充滿樂趣的各種活動，如電影放映，沙雕比賽，文化遊行裡展示巴厘島的民族服飾，還有更多的活動。沿這沙灘邊有不同的食品攤位，提供了您最喜歡的印尼美食，西式菜餚和各種啤酒。立即空下您的日程表，一同參與這個迷人的活動在2016年10月！&lt;/font&gt;
81	8	cn	&lt;font size=&quot;4&quot;&gt;烏魯瓦圖神廟 壯麗的日落和迷人的營火舞&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt; 如果您正在尋找在巴厘島何處可以享受到美麗天空，來到懸崖邊的烏魯瓦圖神廟 。您的目光移不優美的烏魯瓦圖神廟的夕陽伴隨著波光粼粼的印度洋。在日落時間巴厘壯觀的營火舞蹈，享受這個文化饗宴及著迷般的旋律。烏魯瓦度神廟壯闊的懸崖風景,是您觀賞落日最好的選擇。&lt;/font&gt;
106	7	  		
99	10	  		
102	4	  		
110	8	  		
111	3	  		
103	8	  		
90	9	kr	&lt;font size=&quot;4&quot;&gt;해산물 보물 로 짐바란 베이&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;짐바란 베이 는 약 오십 구운 해산물 레스토랑, 해변 주위의 모든 설정 곳입니다. 테이블 은 바로 모래 를 설정합니다. 바다 바람 은 석양 이 아름다운 전체 영역은 어두운 후 횃불 의 기름 에 의해 점화 되어 , 시원하다 . 짐바란 여전히 작동 물고기 마을 로 모든 갓 잡은 된다. 절대로 어부 와 함께 낚시 를 결합 도 그리워 하고 자신의 물고기를 선택하고 요리사 와 함께 요리 . 정통 발리 여행은 시작됩니다 !&lt;/font&gt;
104	9	  		
105	10	  		
107	4	  		
108	6	  		
109	5	  		
87	9	en	&lt;font size=&quot;4&quot;&gt;Jimbaran Bay as the Seafood Treasure&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Jimbaran Bay is home to about fifty grilled seafood restaurants, all set around the beach. Tables are set up right the sand. The sea breeze is cool, the sunsets are beautiful and the whole area is lit by oil of torches after dark. Everything is freshly caught as Jimbaran is still a functioning fish village. Never miss also joining fishing together with the fisherman and choose your own fish and cook it with the Chef. The authentic Balinese journey is about to begin!&lt;/font&gt;
112	9	  		
113	8	  		
114	3	  		
115	9	  		
116	10	  		
117	7	  		
118	2	  		
119	4	  		
120	6	  		
121	8	  		
122	9	  		
123	10	  		
124	7	  		
125	6	  		
126	5	  		
127	8	  		
128	3	  		
129	9	  		
130	10	  		
131	7	  		
85	8	kr	&lt;font size=&quot;4&quot;&gt;울루와 투 사원에서 아름다운 일몰 매혹적인 Kecak 댄스&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;당신은 일몰 동안 발리의 하늘 을 즐길 수있는 최적의 장소 를 찾고 있다면 , 석양 이 아름답게 가장 높은 절벽 에서 캡처 할 수있는 울루와 투 사원 에 온다. 을 배경 으로 반짝이는 인도양 과 아름다운 울루와 투 사원 에 대한 석양의 장엄한 광경 에 푹 될 수있다. 발리 의 아름다운 Kecak 댄스 는 세계에서 가장 장엄한 쇼 중 하나에 당신을 이끌 것입니다 일몰 시간 동안 매일 예정이다. 울루와 투 의 장엄한 절벽 에서 떨어 위치 는 아름다운 일몰 을보기 위해 최선을 제공합니다.&lt;/font&gt;
95	10	kr	&lt;font size=&quot;4&quot;&gt;10 월 쿠타 카니발&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt; 연간 꾸따 Karnival 행사 에서 쿠타 의 전체 에 가입하세요! 하나의 주말 , 쿠타 의 재미 는 영화 상영 , 모래 성 대회 , 발리의 민속 의상과 더 많은 을 보여주는 문화 퍼레이드 등 다양한 활동을 강화한다 . 포장 마차 가 좋아하는 인도네시아 요리 , 서양 요리와 다양한 맥주 를 제공 , 해변을 따라 흩어져 됩니다. 이 흥미로운 이벤트가 처음 출시 10 월 2016 시작 되기 때문에 일정 을 표시 !&lt;/font&gt;
132	2	  		
133	4	  		
134	6	  		
135	6	  		
136	7	  		
206	12	cn	&lt;font size=&quot;4&quot;&gt;與太平洋島文化博物館玩藝術&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;太平洋島文化博物館，位於努沙杜瓦，巴厘島，成立一個永久機構，以展示評測這些樣式和形式為全人類學習和享受。擁有超過600件作品永久陳列，博物館是在巴厘島和地區的公共博物館的成績的一個重要補充。博物館有11個展示房，其中亞太地區的藝術品收藏。&lt;/font&gt;
137	5	  		
138	3	  		
139	7	  		
207	12	en	&lt;font size=&quot;4&quot;&gt;Play with Arts at Museum Fasifika&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Museum Pasifika, located in Nusa Dua, Bali, was established as a permanent institution to  showcase these styles and forms for all humanity to study and enjoy. With over 600 works on permanent display, the museum is an important complement to the scores of public museums in Bali and the region. The museum has 11 rooms with collections of art objects among Asia Pasific.&lt;/font&gt;
140	2	  		
141	4	  		
142	6	  		
143	10	  		
144	10	  		
145	9	  		
146	8	  		
147	5	  		
148	6	  		
149	9	  		
150	9	  		
151	7	  		
180	11	  		
152	4	  		
153	3	  		
154	6	  		
155	9	  		
156	3	  		
157	9	  		
158	9	  		
159	10	  		
160	2	  		
161	5	  		
162	4	  		
163	7	  		
80	7	kr	&lt;font size=&quot;4&quot;&gt;탄중 베노아 수상 스포츠 에 재미 를 확인&lt;font/&gt;	&lt;font size=&quot;3&quot;&gt;탄중 베노아 에 해수 가 낮은 물 스포츠 활동 에 적합하지 않은 것입니다 14시 정오 이후 14:00 - 수상 스포츠 탄중 베노아 활동 09:00 에서 시작합니다. 안전 및 고객 만족 발리에서 각각 수상 스포츠 운영자 의 주요 우선 순위 가됩니다 것 입니다. 고객에 대한 확인 안전 을 위해 , 탄중 베노아 의 수상 스포츠 사업자 회사 는 자격을 갖춘 자신의 직원 훈련 과 안전 및 비상 표준 및 절차 에 대해 알고 . 뿐만 아니라 직원 , 모든 장비 는 수상 스포츠 안전 의 국제 표준 승인을 받아야한다. 당신 이 지불하는 모든 요금은 이미 생명 보험 에 포함 하고 선택하는 수상 스포츠 운영자가 제공하기 때문에 보험 은 필수입니다 .&lt;/font&gt;
164	8	  		
165	9	  		
166	9	  		
167	9	  		
168	9	  		
169	10	  		
170	3	  		
171	6	  		
172	9	  		
173	10	  		
177	11	  		
181	11	  		
208	12	id	&lt;font size=&quot;4&quot;&gt;Play with Arts at Museum Fasifika&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;Museum Pasifika, located in Nusa Dua, Bali, was established as a permanent institution to  showcase these styles and forms for all humanity to study and enjoy. With over 600 works on permanent display, the museum is an important complement to the scores of public museums in Bali and the region. The museum has 11 rooms with collections of art objects among Asia Pasific.&lt;/font&gt;
213	12	  		
179	11	  		
178	11	kr	TES	
214	12	  		
182	6	  		
183	6	  		
174	11	cn	TES	
175	11	en	TES	
176	11	id	TES	
184	11	  		
185	11	  		
186	6	  		
187	6	  		
188	5	  		
189	5	  		
190	4	  		
191	4	  		
192	3	  		
193	3	  		
194	8	  		
195	8	  		
196	9	  		
197	9	  		
198	10	  		
199	10	  		
200	8	  		
201	8	  		
202	2	  		
203	2	  		
204	6	  		
205	6	  		
209	12	  		
210	12	  		
215	6	  		
216	6	  		
211	12	  		
212	12	  		
217	12	  		
218	12	  		
219	12	  		
220	12	  		
224	13	  		
225	13	  		
223	13	id	&lt;font size=&quot;4&quot;&gt;Immerse at the Cultural Heart of Bali – Ubud Monkey Forest&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;The Sacred Monkey Forest Sanctuary (Monkey Forest Ubud) is not just a tourist attractions or important component in the spiritual and economic life of the local community, but also an important spot for research and conservation programs. The presence of sacred forest is a demonstration of the harmonious coexistence of humans and nature. In Bali, sanctuaries such as the Monkey Forest are usually in sacred village areas, often surrounded by temples. These cultural sanctuaries are not only an important part of Balinese heritage, but also an important part of everyday live. The travelers can purchase bananas on-site to feed the monkeys, make sure to carefully conceal the fruit in a backpack because the monkeys will at random, jump at the visitors for a free meals.&lt;/font&gt;
226	13	  		
227	13	  		
230	13	  		
228	13	  		
229	13	  		
221	13	cn	&lt;font size=&quot;4&quot;&gt;薰陶在巴厘島的文化中心 - 烏布猴林&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;聖猴森林保護區（烏布猴林）不僅僅是一個旅遊景點，更是在當地社區的精神和經濟生活中的重要的角色，同時也是研究和保護計劃的重要位置。神聖森林是人與自然的和諧共存最好的示範。在巴厘島，保護區如猴子森林通常是神聖的地區，通常被寺廟包圍。這些文化保護區不僅是巴厘遺產，也是每天當地生活的體現。旅客可以在現場購買香蕉餵猴子，請務必仔細將水果放在背包裡，因為猴子會很機靈的，從您的手上得到一頓免費餐食。&lt;/font&gt;
222	13	en	&lt;font size=&quot;4&quot;&gt;Immerse at the Cultural Heart of Bali – Ubud Monkey Forest&lt;/font&gt;	&lt;font size=&quot;3&quot;&gt;The Sacred Monkey Forest Sanctuary (Monkey Forest Ubud) is not just a tourist attractions or important component in the spiritual and economic life of the local community, but also an important spot for research and conservation programs. The presence of sacred forest is a demonstration of the harmonious coexistence of humans and nature. In Bali, sanctuaries such as the Monkey Forest are usually in sacred village areas, often surrounded by temples. These cultural sanctuaries are not only an important part of Balinese heritage, but also an important part of everyday live. The travelers can purchase bananas on-site to feed the monkeys, make sure to carefully conceal the fruit in a backpack because the monkeys will at random, jump at the visitors for a free meals.&lt;/font&gt;
231	13	  		
232	5	  		
233	5	  		
234	8	  		
235	8	  		
236	3	  		
237	3	  		
238	9	  		
239	9	  		
240	10	  		
241	10	  		
242	7	  		
243	7	  		
244	2	  		
245	2	  		
246	4	  		
247	4	  		
248	6	  		
249	6	  		
250	10	  		
251	10	  		
252	8	  		
253	8	  		
\.


--
-- Name: interest_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('interest_translations_translation_id_seq', 253, true);


--
-- Data for Name: interests; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY interests (interest_id, interest_image, interest_image_enabled, interest_clip, interest_clip_enabled, interest_enabled, interest_order) FROM stdin;
11		0		0	0	11
12	museumpasifika	0		0	1	10
13	monkeyforest	0		0	1	11
5	3D	0		0	1	1
3	bulus	0		0	1	2
9	Jimbaran	0		0	1	5
7	Tanjung	0		0	1	6
2	waterbom	0		0	1	3
4	discovery	0		0	1	4
6	Odysseys	0		0	1	9
10	Kuta	0		0	0	8
8	Kecak	0		0	1	7
\.


--
-- Name: interests_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('interests_seq', 13, true);


--
-- Data for Name: languages; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY languages (language_id, language_name, language_enabled, language_flag) FROM stdin;
id	Bahasa	1	id.png
cn	Chinese	1	cn.png
en	English	1	en.png
jp	Japanese	0	jp.png
kr	Korean	1	kr.png
\.


--
-- Data for Name: laundry; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY laundry (laundry_id, laundry_image, laundry_image_enabled, laundry_clip, laundry_clip_enabled, laundry_enabled, laundry_order) FROM stdin;
1	laundry1	0		0	1	1
\.


--
-- Name: laundry_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('laundry_seq', 1, true);


--
-- Data for Name: laundry_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY laundry_translations (translation_id, laundry_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
6	1	jp	ランドリー＆ドライクリーニング	
7	1	  		
8	1	  		
10	1	  		
9	1	cn	洗衣和干洗	
3	1	en	Laundry &amp; Dry Clean	
5	1	id	Laundry &amp; Dry Clean	
12	1	  		
11	1	kr	세탁 및 드라이 클리닝	
\.


--
-- Name: laundry_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('laundry_translations_translation_id_seq', 12, true);


--
-- Data for Name: logs; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY logs (log_time, log_action, log_data, log_user, log_module, log_mac, log_browser) FROM stdin;
1388035548	READ	testing testing	admin	Dashboard	crot	Firefox
1388035742	READ	holy crap	admin	Dashboard	crot	Firefox
1388032144	VIEW	lhadalah	Localhost	FE: Main Menu	crot	Firefox
1388376832	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388377496	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388377555	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388384858	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385059	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385436	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385502	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388035763	READ	wadawww	admin	Dashboard	crot	Firefox
1388035923	READ	bullseye	admin	Dashboard	crot	Firefox
1388035927	READ	yesss	admin	Dashboard	crot	Firefox
1388377029	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388377539	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388384853	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385057	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385188	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385493	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385749	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/31.0.1650.63 Chrome/31.0.1650.63 Safari/537.36
1388385757	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385772	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388385795	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388436	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388441	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388461	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388475	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388478	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388602	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388693	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388919	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388933	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388388975	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389056	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389273	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389275	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389317	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389348	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389370	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389404	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389489	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389501	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389505	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389696	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389816	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389896	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389995	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388389996	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388390099	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388390210	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388390211	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388390350	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388390498	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388390499	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391068	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391160	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391213	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391437	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391489	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391532	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391548	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391611	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388391733	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388392115	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388392287	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388392608	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388392694	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388397479	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388397492	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388632879	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388632883	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388634013	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388634047	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388634051	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388636569	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388636573	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388641939	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642313	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642348	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642766	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642776	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642783	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642791	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642793	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642795	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642796	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642798	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642799	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388642800	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643018	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643069	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643086	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643087	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643088	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643089	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643091	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643092	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643096	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643101	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643103	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643105	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643118	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643600	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388643602	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388644087	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388644222	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388644323	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388644325	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388644402	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388644426	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388644476	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388644478	READ		Navicom Administrator, admin	Logs	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388649908	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388649969	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388649974	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388652862	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388656391	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388656500	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388656542	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388656667	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1388656691	READ		Navicom Administrator, admin	Dashboard	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1389846969	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/31.0.1650.63 Chrome/31.0.1650.63 Safari/537.36
1389925918	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1390118022	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0
1391419630	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/31.0.1650.63 Chrome/31.0.1650.63 Safari/537.36
1393474111	VIEW					
1393474118	VIEW					
1393474119	VIEW					
1393474120	VIEW					
1393474121	VIEW					
1393474122	VIEW					
1393474123	VIEW					
1393474160	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393474389	VIEW			FE: Main Menu	3c:97:0e:34:74:7b	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1393475261	VIEW			FE: Main Menu	10:bf:48:36:be:cc	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475278	VIEW			FE: Main Menu	00:00:a2:00:06:e3	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1393475290	VIEW			FE: Main Menu	00:00:a2:00:06:e3	
1393475310	VIEW			FE: Main Menu	00:00:a2:00:06:e3	
1393475433	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475434	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475447	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475448	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475476	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475477	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475503	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475533	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475546	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475549	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475564	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475579	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475602	VIEW			FE: Main Menu	10:bf:48:36:be:cc	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0
1393475611	VIEW			FE: Main Menu	00:00:a2:00:06:e3	
1393476430	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393476433	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393476496	VIEW			FE: Main Menu	b8:b4:2e:6c:fb:3a	Mozilla/5.0 (Android; Mobile; rv:24.0) Gecko/24.0 Firefox/24.0
1393476735	VIEW			FE: Main Menu	b8:b4:2e:6c:fb:3a	Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; POLYTRON W2500 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30
1393476847	VIEW			FE: Main Menu	b8:b4:2e:6c:fb:3a	Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; POLYTRON W2500 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30
1393476904	VIEW			FE: Main Menu	10:bf:48:36:be:cc	Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36
1393476910	VIEW			FE: Main Menu	b8:b4:2e:6c:fb:3a	Mozilla/5.0 (Android; Mobile; rv:24.0) Gecko/24.0 Firefox/24.0
1393476943	VIEW			FE: Main Menu	b8:b4:2e:6c:fb:3a	Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; POLYTRON W2500 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30
1393476954	VIEW			FE: Main Menu	10:bf:48:36:be:cc	Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko
1393477096	VIEW			FE: Main Menu	88:9b:39:31:b6:dd	Mozilla/5.0 (Linux; Android 4.2.2; en-us; SAMSUNG GT-I9152 Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Version/1.0 Chrome/18.0.1025.308 Mobil
1393477214	VIEW			FE: Main Menu	88:9b:39:31:b6:dd	Mozilla/5.0 (Linux; Android 4.2.2; GT-I9152 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Mobile Safari/537.36
1393477302	VIEW			FE: Main Menu	00:21:00:00:51:51	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0
1393477312	VIEW			FE: Main Menu	00:21:00:00:51:51	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0
1393477581	VIEW			FE: Main Menu	00:1a:34:d6:09:38	Mozilla/4.08 (compatible;EIS iPanel 2.0;Linux2.4.26/mips;win32; BCM9746x)
1393477727	VIEW			FE: Main Menu	00:00:a2:00:06:e3	
1393477741	VIEW			FE: Main Menu	00:00:a2:00:06:e3	
1393477771	VIEW			FE: Main Menu	00:00:a2:00:06:e3	
1393484805	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393484807	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393490123	VIEW			FE: Main Menu	3c:97:0e:34:74:7b	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1393490138	VIEW			FE: Main Menu	3c:97:0e:34:74:7b	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1393491880	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1393494554	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0
1394093661	VIEW			FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394093739	VIEW			FE: Main Menu	10:bf:48:36:be:cc	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0
1394093918	VIEW			FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394094227	VIEW			FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394094235	VIEW			FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394094251	VIEW			FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394094321	VIEW			FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394094328	VIEW			FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394094334	VIEW		Sendy	FE: Main Menu	10:bf:48:36:be:cc	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0
1394094506	VIEW		STB Uji Coba	FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394094626	VIEW		STB Uji Coba	FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394095342	VIEW		Sendy	FE: Main Menu	10:bf:48:36:be:cc	Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36
1394162401	VIEW			FE: Main Menu	6c:62:6d:2e:62:92	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1394162489	VIEW			FE: Main Menu	6c:62:6d:2e:62:92	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1394162858	VIEW			FE: Main Menu	6c:62:6d:2e:62:92	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1394162860	VIEW			FE: Main Menu	6c:62:6d:2e:62:92	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1394187008	VIEW			FE: Main Menu	00:16:e8:01:7d:92	Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; Trident/4.0; QQDownload 645; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET C
1394187009	VIEW			FE: Main Menu	00:16:e8:01:7d:92	Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; Trident/4.0; QQDownload 645; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET C
1394187091	VIEW			FE: Main Menu	6c:62:6d:2e:62:92	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1394187219	VIEW			FE: Main Menu	00:16:e8:01:7d:92	Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; Trident/4.0; QQDownload 645; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET C
1394187221	VIEW			FE: Main Menu	00:16:e8:01:7d:92	Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; Trident/4.0; QQDownload 645; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET C
1394507834	VIEW			FE: Main Menu	00:16:e8:01:7d:92	Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; Trident/4.0; QQDownload 645; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET C
1394507835	VIEW			FE: Main Menu	00:16:e8:01:7d:92	Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; Trident/4.0; QQDownload 645; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET C
1394507860	VIEW			FE: Main Menu	6c:62:6d:2e:62:92	Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0
1394508288	VIEW			FE: Main Menu	00:16:e8:01:7d:92	Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; Trident/4.0; QQDownload 645; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET C
1394508289	VIEW			FE: Main Menu	00:16:e8:01:7d:92	Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; Trident/4.0; QQDownload 645; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET C
1394535337	VIEW			FE: Main Menu	b8:b4:2e:6c:fb:3a	Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; POLYTRON W2500 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30
1394535724	VIEW			FE: Main Menu	b8:b4:2e:6c:fb:3a	Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; POLYTRON W2500 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30
1394537400	VIEW		STB Uji Coba	FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394538464	VIEW		STB Uji Coba	FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394700168	VIEW			FE: Main Menu	94:db:c9:9d:3a:fe	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0
1394700944	VIEW			FE: Main Menu	00:00:a2:00:06:e3	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394700949	VIEW			FE: Main Menu	00:00:a1:00:01:c9	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1394702681	VIEW		STB Uji Coba 2	FE: Main Menu	00:00:a1:00:01:c9	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1395910465	VIEW			FE: Main Menu	entries	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:28.0) Gecko/20100101 Firefox/28.0
1397638491	VIEW			FE: Main Menu	00:00:a1:00:01:bf	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1397638976	VIEW		STB Uji Coba 4	FE: Main Menu	00:00:a1:00:01:bf	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1397699972	VIEW			FE: Main Menu	8c:c5:e1:1d:15:da	Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; POLYTRON_R3500 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30
1397704148	VIEW			FE: Main Menu	94:db:c9:9d:3a:fe	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:28.0) Gecko/20100101 Firefox/28.0
1397704602	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/33.0.1750.152 Chrome/33.0.1750.152 Safari/537.36
1398156055	VIEW			FE: Main Menu	00:00:a2:00:06:c9	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1398156185	VIEW		STB-25	FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1398156203	VIEW			FE: Main Menu	00:00:a2:00:06:c9	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1398157198	VIEW		STB-25	FE: Main Menu	00:00:a2:00:00:fe	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1398416279	VIEW			FE: Main Menu	74:2f:68:d4:fb:08	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:28.0) Gecko/20100101 Firefox/28.0
1398654867	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/33.0.1750.152 Chrome/33.0.1750.152 Safari/537.36
1398839176	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1398839193	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0
1402996509	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1405563716	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Linux; U; Android 4.2.2;en-us; Lenovo B8000-H/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2.2 Mobile Safari/534.30
1405565632	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/34.0.1847.116 Chrome/34.0.1847.116 Safari/537.36
1405565809	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Linux; U; Android 4.2.2;en-us; Lenovo B8000-H/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2.2 Mobile Safari/534.30
1405566394	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Linux; U; Android 4.2.2;en-us; Lenovo B8000-H/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2.2 Mobile Safari/534.30
1407926273	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1407929045	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1407929480	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1409301247	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0
1409301339	VIEW			FE: Main Menu	20:68:9d:f6:78:40	Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0
1409301684	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0
1409542725	VIEW		Localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0
1424763164	VIEW		localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0
1424763227	VIEW			FE: Main Menu	28:d2:44:f4:b4:0a	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0
1424763372	VIEW		localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0
1424763377	VIEW		localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0
1424763379	VIEW		localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0
1424763383	VIEW			FE: Main Menu	28:d2:44:f4:b4:0a	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0
1424763384	VIEW			FE: Main Menu	28:d2:44:f4:b4:0a	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0
1424763395	VIEW			FE: Main Menu	28:d2:44:f4:b4:0a	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0
1424763396	VIEW			FE: Main Menu	28:d2:44:f4:b4:0a	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0
1425540695	VIEW		localhost	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/40.0.2214.111 Chrome/40.0.2214.111 Safari/537.36
1427957103	VIEW					Mozilla/5.0 (Linux; Android 4.2.2; R831K Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96 Mobile Safari/537.36
1428841147	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841193	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841194	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841195	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841196	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841197	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841335	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841340	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841341	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1428841342	VIEW					Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1429444180	VIEW		L		28:d2:44:f4:b4:0a	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0
1429699072	VIEW					Mozilla/5.0 (Linux; U; Android 4.2.2;en-us; Lenovo B8000-H/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2.2 Mobile Safari/534.30
1433734588	VIEW		Laptop Agnes		a4:17:31:5f:fa:0d	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1434092371	VIEW		Testing	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1434092514	VIEW		Testing	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1434092800	VIEW		Testing	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0
1434095086	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1434095137	VIEW		919	FE: Main Menu	00:00:A1:00:05:C5	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1434688971	VIEW		919		00:00:A1:00:05:C5	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1434997987	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36
1434998137	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36
1435009101	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1435009116	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1435009128	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1435009129	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1435009147	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0
1435017144	VIEW		821	FE: Main Menu	00:0A:BC:00:08:0A	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN
1435017655	VIEW		821	FE: Main Menu	00:0A:BC:00:08:0A	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN
1435807230	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN
1436165640	VIEW		L	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0
1437555263	VIEW		701		00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0
1437555527	VIEW		701		00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0
1438328855	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0
1438328907	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0
1438331624	VIEW		701	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0
1438345745	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0
1438395856	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36
1438479237	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36
1439890839	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36
1439891174	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36
1439960047	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36
1440043532	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36
1440566899	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0
1440922063	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36
1441173444	VIEW		716	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0
1442123542	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0
1442371262	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0
1442371264	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0
1442371266	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0
1442821994	VIEW		716	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0
1443496574	VIEW		823	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0
1469428827	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1469698154	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1469698979	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1469709420	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1469753371	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1469779627	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1469834444	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1470213819	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470213948	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470214673	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470214705	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470214709	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470214735	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470214750	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470215015	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470215564	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470216258	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470216284	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470216961	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470216987	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470221864	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470222606	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470224269	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470224598	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470387155	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470392269	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470392283	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470392529	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470392533	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470392534	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470392582	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470392616	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470392708	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470392823	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470393370	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470393917	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470394000	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470394012	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470641121	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470643736	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470645232	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470731348	VIEW		spa-tes2	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470732551	VIEW		Spare 50	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470732857	VIEW		Spare 50	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470733258	VIEW		Spare 50	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470735107	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470736112	VIEW		Spare 50	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470736123	VIEW		Spare 50	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0
1470815038	VIEW		Spare 50	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1470815107	VIEW		Spare 50	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36
1471225937	VIEW		3212	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0
1473563456	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1473761030	VIEW		3212	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0
1473768103	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0
1473848072	VIEW		3212	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0
1474087655	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0
1474611747	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36
1475029867	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36
1475722525	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36
1476176179	VIEW		6319	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36
1476245197	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36
1476245284	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36
1476255550	VIEW		5221	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36
1477396494	VIEW		6323	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0
1479313546	VIEW		6323	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36
1479827593	VIEW			FE: Main Menu		Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.100 Safari/537.36
1480395681	VIEW			FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0
1480409546	VIEW			FE: Main Menu		Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.100 Safari/537.36
1480496282	VIEW			FE: Main Menu		Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.100 Safari/537.36
1480834587	VIEW			FE: Main Menu		Mozilla/5.0 (Linux; U; Android 6.0; en-US; Lenovo A7000-a Build/MRA58K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/11.0.8.855 U3/0.
1481882451	VIEW		6303	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0
1482132399	VIEW		6303	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0
1482985956	VIEW		IT	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36
1483783105	VIEW		3328	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.100 Safari/537.36
1484698665	VIEW		3328	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0
1484901679	VIEW		3123	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36
1487653656	VIEW		6302	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36
1488444431	VIEW		6324	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; rv:51.0) Gecko/20100101 Firefox/51.0
1494303866	VIEW		pc ird	FE: Main Menu		Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36
1494304075	VIEW		PCITTENGAH	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36
1501496282	VIEW		3320	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0
1506323268	VIEW		6302	FE: Main Menu	00:00:00:00:00:00	Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36
\.


--
-- Data for Name: massage_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY massage_translations (translation_id, massage_id, language_id, translation_title, translation_description) FROM stdin;
2	1	  		
4	1	  		
6	1	jp	室内でのマッサージ	
7	1	  		
8	1	  		
12	2	  		
13	2	  		
17	3	  		
18	3	  		
1	1	cn	客房内按摩	
3	1	en	In-Room Massage	
5	1	id	In-Room Massage	
19	1	  		
20	1	  		
24	4	  		
25	4	  		
29	5	  		
30	5	  		
34	6	  		
35	6	  		
39	7	  		
40	7	  		
10	2	en	ANVAYA RE-TREAT	Mo-De/ Mother &amp; Daughter’s\nA moment of pampering mother &amp; daughter will never forget.\nFather &amp; Son’s\nA moment of pampering father &amp; son will never forget.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial '0' to our Guest Service. Sakanti Spa is available from 09.00 AM until 09.00 PM.
26	5	cn	美甲與美趾	美容美甲護理治療特別適用於指甲，自然指甲的生長和保護。讓我們來清潔與拋光以及我們使用OPI品牌來未你的指甲上色，這樣你看起來會是豐富多彩當你完成療程離開時。&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
41	7	  		
42	7	  		
36	7	cn	URUT觸覺	URUT是巴厘島語代表按摩的意思。在巴厘島，放鬆和治療的按摩療法結合傳   統URUT按摩的啟發。&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
38	7	id	SENTUHAN URUT	Urut merupakan Bahasa Bali yang berarti ‘pijatan’. Terinspirasi dari pijatan tradisional khas Bali,&lt;br/&gt;Urut merupakan kombinasi dari terapi penyegaran dan penyembuhan.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
43	6	  		
44	6	  		
37	7	en	URUT OF TOUCH	Urut is Balinese languange with meaning massage . Inspired by signature traditional massages in Bali, &lt;br/&gt;combination awakening and healing therapy massage.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
23	4	id	KECANTIKAN ELEMIS	Elemis telah berpengalaman selama 25 tahun dalam melayani Spa professional baik untuk wanita dan pria. &lt;br/&gt;Mengacu pada bahan – bahan herbal dari alam serta formula medis dari beberapa penelitian, para ahli telah menyediakan terapi khusus untuk kecantikan kulit.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
21	4	cn	艾麗美BEAUTY	艾麗美具有超過25年的經驗專業的SPA對於男女雙方的獨特配方，醫療級公式和專門的研究都結合起來，提供一系列按摩療法，提供科學的解決方案&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
45	4	  		
46	4	  		
28	5	id	MANICURE &amp; PEDICURE	Perawatan kecantikan kuku dengan bahan alami dan proteksi khusus untuk kesehatan kuku Anda.  &lt;br/&gt; natural nail growth and protection. &lt;br/&gt;Biarkan tim kami membentuk kuku Anda dan mengaplikasikan cat kuku OPI agar kuku Anda terlihat lebih cantik dan menawan.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
14	3	cn	極致阿育吠陀	身心靈和精神的深度放鬆 - 溫暖的草本精油待配阿原嘎按摩 隨後有二十分鐘的印度按摩。&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
33	6	id	MOMEN KEGEMBIRAAN	Menggabungkan teknik kuno dan kontemporer dengan pengetahuan ahli dari seluruh dunia dan terapis yang ahli di bidangnya serta memberikan pelayanan dari hati, kami akan menciptakan pengalaman yang berkesan bagi Anda. &lt;br/&gt;\nNikmati waktu dan manjakan diri Anda.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
47	2	  		
48	2	  		
15	3	en	BEST AYURVEDHA	Combination of Abyangga herbal warm oil massage followed by 20 minutes Shirodara, &lt;br/&gt;deep relaxation of body mind and spirit. &lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
49	5	  		
50	5	  		
57	4	  		
58	4	  		
51	3	  		
52	3	  		
53	2	  		
54	2	  		
55	3	  		
56	3	  		
59	5	  		
60	5	  		
61	6	  		
62	6	  		
63	7	  		
64	7	  		
65	2	  		
66	2	  		
67	3	  		
68	3	  		
69	4	  		
70	4	  		
71	5	  		
72	5	  		
9	2	cn	安娜雅療程	MO-DE /母親與女兒的 - 母親的呵護與女兒的那一刻將永遠不會忘記。媽媽將享受寧靜的足底按摩，微型迷你美甲與美趾，而女兒會有一個專屬她的按摩，花式美甲和閃爍的美趾。&lt;br/&gt;Father &amp; Son’s/父與子的 - 父親呵護兒子的那一刻將永遠不會忘記。爸爸將享受背部按摩與足底按摩，而兒子會有一個專屬他的寧靜柔和足部按摩。&lt;br/&gt;&lt;br
123	5	  		
73	6	  		
74	6	  		
75	7	  		
76	7	  		
77	3	  		
78	3	  		
93	2	  		
79	2	  		
80	2	  		
107	5	  		
81	4	  		
82	4	  		
94	2	  		
95	3	  		
83	2	  		
84	2	  		
85	5	  		
86	5	  		
117	2	  		
118	2	  		
87	6	  		
88	6	  		
89	7	  		
90	7	  		
108	5	  		
91	2	  		
92	2	  		
96	3	  		
97	3	  		
98	3	  		
119	3	  		
99	4	  		
100	4	  		
124	5	  		
101	4	  		
102	4	  		
103	5	  		
104	5	  		
109	6	  		
105	5	  		
106	5	  		
125	6	  		
110	6	  		
126	6	  		
111	6	  		
112	6	  		
113	7	  		
114	7	  		
115	7	  		
116	7	  		
131	3	  		
120	3	  		
133	4	  		
121	4	  		
122	4	  		
147	6	  		
137	6	  		
139	7	  		
127	7	  		
128	7	  		
31	6	cn	瞬間光彩	結合具有來自世界各地專業知識及古代和當代的技術和訓練有素的治療師和從   內心深處服務創造獨特經驗。讓你的時間靜止和沉浸按摩享受中。&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
129	2	  		
130	2	  		
132	3	  		
143	4	  		
134	4	  		
145	5	  		
135	5	  		
136	5	  		
16	3	id	AYURVEDA	Kombinasi dari pijatan menggunakan minyak herbal Abbyangga diikuti dengan 20 menit Shirodara – relaksasi untuk tubuh dan pikiran. &lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
138	6	  		
140	7	  		
32	6	en	MOMENT DELIGHT	Combining ancient and contemporary techniques with expert  knowledge from around the world  and highly trained therapist and service from the heart to creating exceptional experience.&lt;br/&gt;\nEscape your time  and immerse yourself.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
141	3	  		
142	3	  		
144	4	  		
146	5	  		
27	5	en	MANICURE &amp; PEDICURE	Is the beauty  nail care treatment is specially for fingernails, &lt;br/&gt; natural nail growth and protection. &lt;br/&gt;Allow us to shape clean, and polish your nails using OPI colors so you’ll leave looking sophisticated and colorful.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
148	6	  		
149	7	  		
150	7	  		
151	3	  		
152	3	  		
153	2	  		
154	2	  		
155	2	  		
156	2	  		
157	2	  		
158	2	  		
159	2	  		
160	2	  		
161	3	  		
162	3	  		
163	4	  		
164	4	  		
165	5	  		
166	5	  		
167	6	  		
168	6	  		
169	7	  		
170	7	  		
171	6	  		
172	6	  		
173	7	  		
174	7	  		
175	4	  		
176	4	  		
177	6	  		
178	6	  		
179	5	  		
180	5	  		
181	2	  		
182	2	  		
183	3	  		
184	3	  		
185	6	  		
186	6	  		
187	2	  		
188	2	  		
189	3	  		
190	3	  		
191	6	  		
192	6	  		
193	7	  		
194	7	  		
22	4	en	ELEMIS BEAUTY	Elemis has over 25 years experience in treating both men and women in the professional spa inamic ingredients , &lt;br/&gt;medical grade formulas and dedicated research are all combined to provide a range of spa – therapies taht offer scientific solutions.&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;&lt;br/&gt;For reservation please dial  '80285' or '0' for Operator, available from 09.00 AM until 09.00 PM. Thank you
195	4	  		
196	4	  		
197	6	  		
198	6	  		
199	5	  		
200	5	  		
201	2	  		
202	2	  		
203	3	  		
204	3	  		
11	2	id	ANVAYA RETREAT	Ibu &amp; Putri – Pengalaman memanjakan diri yang Ibu dan putri kesayangannya tidak akan pernah terlupakan. Ibu akan menikmati pijatan kaki, manicure dan pedicure, sementara putri Anda akan menerima pijatan khusus untuk anak-anak dan mini manicure dan pedicure untuk mempercantik jari – jari mungil.&lt;br/&gt;Ayah &amp; Anak - Pengalaman memanjakan diri yang Ayah dan putra kesayangannya tidak akan pernah terlupakan. Ayah akan menikmati pijatan di bagain punggung dan pijatan kaki yang menenangkan sementara putra Anda akan menerima pijatan khusus untuk anak-anak dan pijatan kaki yang menenangkan.&lt;br/&gt;&lt;br/&gt;Untuk reservasi silahkan hubungi Pelayanan Tamu dengan menekan '0' dari telepon Anda. Sakanti Spa tersedia dari pukul 9 pagi hingga 9 malam.
205	2	  		
206	2	  		
207	7	  		
208	7	kr		
\.


--
-- Name: massage_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('massage_translations_translation_id_seq', 208, true);


--
-- Data for Name: massages; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY massages (massage_id, massage_image, massage_image_enabled, massage_clip, massage_clip_enabled, massage_enabled, massage_order) FROM stdin;
1	massage	0		0	0	1
4	ELEMISBEAUTY	0		0	1	3
6	MOMENTDELIGHT	0		0	1	5
5	MANICUREPEDICURE	0		0	1	4
3	BESTAYURVEDHA	0		0	1	2
2	ANVAYARETREAT	0		0	1	1
7	URUTOFTOUCH	0		0	1	6
\.


--
-- Name: massages_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('massages_seq', 7, true);


--
-- Data for Name: meetingevent_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY meetingevent_translations (translation_id, meetingevents_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
7	1	  		
8	1	  		
9	2	  		
10	2	  		
12	2	  		
15	2	  		
16	2	  		
17	1	  		
18	1	  		
19	1	  		
20	1	  		
21	1	  		
22	2	  		
23	2	  		
24	2	  		
25	2	  		
26	2	  		
28	1	  		
29	1	  		
6	1	jp	ミーティング	私たちの宴会のすべては、フルスケールの会議や結婚披露宴に小規模のミーティングから、イベントのあらゆる種類に対応するように設計されています。&lt;br/&gt;\n液晶プロジェクターやオーディオ機器は、すべての会議室でご利用いただけます。&lt;br/&gt;\n&lt;br/&gt;\n設備：&lt;br/&gt;\n画面|サウンドシステム|マイク|フリップチャート|ボードマーカー|レーザーポインター|会議キット（ノートとペン）|水とキャンディー|フラワーアレンジメント
30	1	  		
31	1	  		
33	2	  		
34	2	  		
14	2	jp	イベント	ホテルサンティカプレミアハヤムウルクでバタビアグランドボールルーム - ジャカルタは、あなたの排他的な結婚式のイベントのための最も理想的な会場の一つです。その7メートルの天井の高い広々としたボールルームは、快適にパーティーを立って1300名様まで収容することができます。
35	2	  		
36	2	  		
37	1	  		
38	1	  		
39	2	  		
40	2	  		
41	1	  		
48	1	kr	그랜드 볼룸	세 부분으로 공간을 분할하는 기능을 천명 극장 스타일까지 수용하는 것은. &lt;br/&gt; 시청각 기술의 최신 제공.
13	2	id	Ruang Meeting	Sembilan ruang pertemuan berbagai kapasitas terinspirasi oleh periode Bali Aga terinspirasi dari kata &quot;Kunyit&quot; setiap ruangan meeting dinamakan dengan berbagai bumbu dan rempah-rempah yang digunakan dalam obat-obatan berkhasiat tradisional Bali seperti:\n- Pucuk\n- Jepun \n- Celagi\n- Cepaka\n- Kelapa\n- Kesuna\n- Cemara\n- Kemiri\n- Kemangi
42	1	  		
43	2	  		
54	1	  		
44	2	  		
45	1	  		
60	2	  		
49	1	  		
46	1	  		
61	2	  		
27	1	cn	ANVAYA 大宴会厅	最多可容纳1000，用以将空间划分成三个部分的能力，人的剧院式。&lt;br/&gt;在提供视听技术的最新。
55	2	  		
47	1	  		
3	1	en	The ANVAYA Ballroom	Accommodating up to 1000 people theatre style with the ability to divide the space into three sections.&lt;br/&gt;&lt;br/&gt;Providing the latest in audio visual technology.
5	1	id	The ANVAYA Ballroom	Menampung hingga 1.000 orang dengan tipe teater, The ANVAYA Ballroom juga dapat dibagi ruang menjadi tiga bagian. &lt;br/&gt;&lt;br/&gt; Memberikan teknologi terbaru dalam audio visual.
62	1	  		
63	1	  		
50	2	  		
64	2	  		
65	2	  		
57	2	  		
52	2	  		
51	2	kr	회의실	다양한 허브와 발리 전통 치료하는 의약품 에 사용되는 향신료 를 반영 각 객실 이름 에 &quot; Kunyit &quot;을 통합 발리 아가 기간 에서 영감을 다양한 용량 의 나인 회의실 .
56	1	  		
53	1	  		
58	1	  		
59	1	  		
32	2	cn	会议室	九各种容量的会议室通过将“ Kunyit ”到每个房间的名字反映各种草药和传统的巴厘补救药品的香料巴厘岛阿迦时期汲取了灵感。
11	2	en	Meeting Room	Nine meeting rooms of various capacities inspired by the Bali Aga period incorporating “Kunyit” into each rooms names reflecting the various herbs and spices used in traditional Balinese remedial medicines such as:\n- Pucuk\n- Jepun \n- Celagi\n- Cepaka\n- Kelapa\n- Kesuna\n- Cemara\n- Kemiri\n- Kemangi
\.


--
-- Name: meetingevent_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('meetingevent_translations_translation_id_seq', 65, true);


--
-- Data for Name: meetingevents; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY meetingevents (meetingevents_id, meetingevents_image, meetingevents_image_enabled, meetingevents_clip, meetingevents_clip_enabled, meetingevents_enabled, meetingevents_order) FROM stdin;
1	ballroom1	0		0	1	1
2	meeting-room	0		0	1	2
\.


--
-- Name: meetingevents_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('meetingevents_seq', 2, true);


--
-- Data for Name: menu_group_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY menu_group_translations (translation_id, menu_group_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	de	Commerce	
4	1	fr	Commerce	
6	1	  		
7	1	  		
8	1	ru	Commerce	
9	2	  		
14	2	  		
15	2	  		
17	3	  		
18	3	de	Watch	
20	3	fr	Watch	
22	3	  		
23	3	  		
24	3	ru	Watch	
25	4	  		
30	4	  		
31	4	  		
33	4	  		
34	4	  		
35	4	  		
36	4	  		
26	4	de	Spa	
28	4	fr	Spa	
37	4	  		
38	4	  		
32	4	ru	Spa	
39	2	  		
10	2	de	Hotel Info	
12	2	fr	Hotel Info	
41	2	  		
16	2	ru	Hotel Info	
42	5	  		
48	5	  		
50	5	  		
43	5	de	Testing	
44	5	en	Testing	
45	5	fr	Testing	
46	5	id	Testing	
47	5	jp	Testing	
51	5	  		
49	5	ru	Testing	
52	1	  		
53	1	  		
54	1	  		
56	1	  		
57	1	  		
58	4	  		
59	4	  		
27	4	en	Optional Tour	
60	4	  		
29	4	id	Pilihan Tur	
61	4	jp	オプショナルツアー	
62	4	  		
63	4	  		
64	3	  		
65	3	  		
132	8	  		
66	3	  		
133	8	  		
68	3	  		
69	3	  		
70	3	  		
71	3	  		
72	3	  		
134	8	  		
154	7	  		
73	3	  		
74	3	  		
75	3	  		
76	3	  		
77	3	  		
135	8	  		
136	8	  		
78	3	  		
79	3	  		
80	2	  		
81	2	  		
137	9	  		
82	2	  		
138	9	  		
83	2	  		
84	2	  		
85	6	  		
86	6	  		
88	6	  		
91	6	  		
92	6	  		
93	2	  		
94	2	  		
11	2	en	Souvenirs	
95	2	  		
13	2	id	Oleh Oleh	
40	2	jp	お土産	
96	2	  		
97	2	  		
98	3	  		
99	3	  		
19	3	en	Spa	
100	3	  		
21	3	id	Spa	
67	3	jp	スパ	
101	3	  		
102	3	  		
103	6	  		
104	6	  		
147	8	  		
105	6	  		
148	8	  		
118	8	en	Text Message	
106	6	  		
107	6	  		
108	7	  		
109	7	  		
111	7	  		
114	7	  		
115	7	  		
116	8	  		
117	8	  		
119	8	  		
122	8	  		
123	8	  		
124	9	  		
125	9	  		
127	9	  		
130	9	  		
131	9	  		
139	9	  		
140	9	  		
141	9	  		
142	6	  		
143	6	  		
144	6	  		
145	6	  		
146	6	  		
149	8	  		
120	8	id	Pesan Teks	
121	8	jp	テキストメッセージ	
150	8	  		
151	8	  		
152	7	  		
153	7	  		
155	7	  		
156	7	  		
157	7	  		
158	7	  		
159	7	  		
160	7	  		
161	7	  		
162	6	  		
163	6	  		
164	6	  		
165	6	  		
166	6	  		
167	10	  		
168	10	  		
170	10	  		
173	10	  		
55	1	jp	言語	
174	10	  		
175	10	  		
176	10	  		
177	10	  		
178	10	  		
179	10	  		
180	10	  		
181	10	  		
182	10	  		
183	10	  		
184	10	  		
129	9	jp	テレビのチャンネル	
90	6	jp	ダイニングルーム	
185	11	  		
186	11	  		
126	9	en	TV Channels	
128	9	id	Saluran TV	
188	11	  		
191	11	  		
192	11	  		
193	12	  		
194	12	  		
196	12	  		
199	12	  		
200	12	  		
201	12	  		
202	12	  		
203	12	  		
204	12	  		
205	12	  		
206	12	  		
207	12	  		
208	12	  		
209	12	  		
210	12	  		
212	13	  		
214	13	  		
217	13	  		
218	13	  		
220	7	  		
221	7	  		
222	7	  		
223	7	  		
225	10	  		
226	10	  		
227	10	  		
228	10	  		
230	9	  		
231	9	  		
232	9	  		
233	9	  		
235	6	  		
236	6	  		
237	6	  		
238	6	  		
240	12	  		
241	12	  		
242	12	  		
243	12	  		
245	11	  		
246	11	  		
247	11	  		
248	11	  		
250	1	  		
251	1	  		
252	1	  		
253	1	  		
254	10	  		
255	10	  		
256	10	  		
257	10	  		
258	11	  		
259	11	  		
260	11	  		
261	11	  		
262	6	  		
263	6	  		
264	6	  		
265	6	  		
266	12	  		
267	12	  		
198	12	jp	何がです	
268	12	  		
269	12	  		
270	7	  		
271	7	  		
113	7	jp	ホテルディレクトリー	ホームディレクトリは、ホテルが提供するサービスのすべてが含まれています
272	7	  		
273	7	  		
274	10	  		
275	10	  		
276	10	  		
277	10	  		
278	10	  		
279	10	  		
280	10	  		
281	10	  		
282	13	  		
283	13	  		
216	13	jp	ユーザーガイド	
284	13	  		
285	13	  		
286	11	  		
287	11	  		
190	11	jp	私たちのサービス	
288	11	  		
289	11	  		
290	10	  		
291	10	  		
172	10	jp	電話帳	
292	10	  		
293	10	  		
294	6	  		
295	6	  		
296	6	  		
297	6	  		
298	9	  		
299	9	  		
300	9	  		
301	9	  		
302	6	  		
303	6	  		
304	6	  		
305	6	  		
5	1	id	Bahasa	
306	1	  		
195	12	en	What's Happening	
197	12	id	What's Happening	
333	10	  		
308	13	  		
112	7	id	Direktori&amp;nbsp;Hotel	Direktori home berisi semua layanan yang disediakan oleh hotel
311	7	kr	호텔 디렉토리	
329	1	  		
310	7	  		
171	10	id	Direktori&amp;nbsp;Telepon	
313	10	kr	전화 번호부	
335	9	  		
312	10	  		
336	9	  		
314	9	  		
89	6	id	Layanan Kamar	
322	6	  		
317	6	kr	룸 서비스	
316	6	  		
319	12	kr	무슨 일이야	
239	12	cn	什么是在	
318	12	  		
187	11	en	Our Services	
189	11	id	Pelayanan Kami	
339	6	  		
320	11	  		
321	11	kr	우리의 서비스	
327	7	  		
323	6	  		
249	1	cn	语	
229	9	cn	电视频道	
324	6	  		
325	6	  		
326	6	  		
234	6	cn	客房服务	
328	7	  		
3	1	en	Language	
307	1	kr	언어	
330	1	  		
331	13	  		
332	13	  		
169	10	en	Phone&amp;nbsp;Directory	
334	10	  		
341	9	  		
337	11	  		
244	11	cn	我们的服务	
338	11	  		
87	6	en	Room Service	
340	6	  		
219	7	cn	酒店目录	
224	10	cn	电话目录	
211	13	cn	用户指南	
213	13	en	User Guide	
215	13	id	Panduan Pengguna	
315	9	kr	TV 채널	
110	7	en	Hotel&amp;nbsp;Directory	Home directory contains all of services that provided by the hotel
342	7	  		
343	6	  		
344	1	  		
345	10	  		
346	13	  		
309	13	kr	사용자 설명서	
347	12	  		
348	14	cn		
349	14	en	Group	
350	14	id	Grup	
351	14	  		
352	14	kr		
353	12	  		
\.


--
-- Name: menu_group_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('menu_group_translations_translation_id_seq', 353, true);


--
-- Data for Name: menu_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY menu_groups (menu_group_id, menu_group_thumbnail, menu_group_enabled, menu_group_order, menu_group_runningtext_enabled, menu_group_in_mobile, menu_group_in_stb, menu_group_in_empty_room) FROM stdin;
4	tour.png	0	2	1	1	1	1
3	spa-group.png	0	3	1	1	1	0
2	souvenir.png	0	4	1	1	1	0
8	sendmessage.png	0	7	1	1	1	0
11	ourservices.png	1	8	1	1	1	1
9	tv.png	1	1	1	0	1	1
7	directory.png	1	2	1	1	1	1
6	roomservice.png	1	3	1	1	1	1
1	language.png	1	4	1	1	1	1
10	telephone_directory.png	1	5	1	1	1	1
13	remote.png	1	6	1	1	1	1
14	default	1	2	1	0	1	0
12	whatson.png	1	7	1	1	1	1
\.


--
-- Name: menu_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('menu_groups_seq', 14, true);


--
-- Data for Name: menu_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY menu_translations (translation_id, menu_id, language_id, translation_title, translation_description) FROM stdin;
128	8			
94	11			
68	9			
69	9			
70	9			
99	11			
71	6			
10	5	cn	天气预报	
72	6			
73	6			
54	5	jp	天気予報	
55	5	kr	일기 예보	
140	3			
137	5			
74	3			
30	7	kr	언어	
100	11			
146	4			
131	7			
75	3			
76	3			
143	2			
77	4			
50	6	kr	사용 설명서	
57	6			
102	11			
111	12			
58	6			
59	6			
60	9			
65	9			
66	9			
78	4			
79	4			
149	4			
80	9			
123	9			
124	9			
125	10			
81	9			
82	9			
83	10			
88	10			
89	10			
91	10			
126	10			
92	10			
93	10			
103	11			
104	11			
105	11			
116	12			
117	12			
106	11			
107	11			
108	11			
122	9			
109	11			
110	11			
119	11			
120	11			
121	11			
127	10			
129	8			
130	8			
132	7			
133	7			
134	6			
135	6			
136	6			
138	5			
139	5			
141	3			
142	3			
147	4			
148	4			
144	2			
145	2			
150	4			
151	4			
152	2			
153	2			
48	6	fr	Guide de l'utilisateur	
27	7	de	Sprache	
28	7	fr	Langue	
31	7	ru	язык	
154	2			
155	10			
156	10			
157	10			
52	5	de	Wettervorhersage	
11	5	en	Weather	
53	5	fr	Prévisions météo	
12	5	id	Prakiraan Cuaca	
56	5	ru	Прогноз погоды	
158	3			
159	3			
160	3			
161	7			
162	7			
163	7			
114	12	fr	Home	
118	12	ru	Home	
42	4	de	TV-Kanäle	
43	4	fr	Chaînes TV	
96	11	en	Connectivity	
22	2	de	Hotel Verzeichnis	Home-Verzeichnis enthält alle Services, die vom Hotel bereitgestellt
23	2	fr	Annuaire Hôtel	Répertoire d'accueil contient tous les services que fournis par l'hôtel
26	2	ru	Каталог гостиниц	
32	3	de	Movie on Demand	
33	3	fr	Film à la demande	
34	3	jp	オンデマンドの映画	
35	3	kr	주문형 영화	
36	3	ru	Фильм по требованию	
37	8	de	Zimmerservice	
38	8	fr	Service en chambre	
67	9	ru	Посмотреть Билл	
84	10	de	Posteingang	
86	10	fr	Boîte de réception	
90	10	ru	входящие	
98	11	id	Konektivitas	
101	11	ru	Связь	
95	11	de	Connectivity	
164	5			
165	5			
166	5			
167	12			
168	12			
169	12			
170	7			
171	7			
172	7			
113	12	en	Home	
115	12	id	Beranda	
29	7	jp	言語	
44	4	jp	テレビのチャンネル	
173	13			
178	13			
179	13			
39	8	jp	ルームサービス	
181	13			
182	13			
183	13			
49	6	jp	ユーザー·ガイド	
184	2			
185	2			
7	4	cn	電視頻道	
8	4	en	TV Channels	
40	8	kr	룸 서비스	
17	7	en	Language	
20	8	en	Room Service	
21	8	id	Layanan Kamar	
14	6	en	User Guide	
15	6	id	Panduan Pengguna	
4	3	cn	电影点播	
5	3	en	Movies	
45	4	kr	TV 채널	
19	8	cn	客房服务	
186	2			
187	6			
188	6			
189	6			
190	5			
191	5			
192	5			
193	11			
194	11			
195	11			
196	11			
197	11			
198	11			
199	11			
200	11			
201	11			
202	11			
203	11			
204	11			
205	13			
206	13			
207	13			
208	14			
213	14			
214	14			
216	14			
217	14			
218	14			
219	14			
220	14			
221	14			
222	14			
223	14			
224	14			
225	14			
226	14			
227	14			
228	15			
233	15			
234	15			
236	15			
237	15			
238	15			
239	15			
240	15			
241	15			
242	16			
247	16			
248	16			
250	16			
280	13			
251	16			
252	16			
253	16			
281	13			
282	13			
283	16			
254	16			
255	16			
256	16			
257	16			
258	16			
259	6			
47	6	de	Benutzerhandbuch	
260	6			
261	6			
51	6	ru	Руководство пользователя	
262	7			
263	7			
264	7			
265	8			
266	8			
267	8			
268	10			
269	10			
270	10			
271	9			
272	9			
273	9			
274	11			
275	11			
276	11			
277	14			
278	14			
279	14			
284	16			
285	16			
286	17			
291	17			
292	17			
294	17			
295	17			
296	17			
297	9			
298	9			
299	9			
300	10			
301	10			
302	10			
303	11			
304	11			
305	11			
306	15			
307	15			
308	15			
309	18			
314	18			
315	18			
317	18			
318	18			
319	18			
323	18			
320	18			
321	18			
322	18			
324	18			
325	18			
326	18			
327	18			
328	18			
329	4			
330	4			
331	4			
332	3			
333	3			
334	3			
335	8			
288	17	en	Promo	
289	17	fr	Promo	
290	17	id	Promo	
293	17	ru	Pекламный	
243	16	de	Flugplan	
244	16	en	Flight Schedule	
245	16	fr	Horaires des Vols	
249	16	ru	Расписание авиарейсов	
310	18	de	Spa	
312	18	fr	Spa	
230	15	en	Send Message	
316	18	ru	Cпа	
63	9	fr	Voir le Projet de loi	
229	15	de	Send Message	
232	15	id	Kirim Pesan	
231	15	fr	Send Message	
311	18	en	Spa	
235	15	ru	Send Message	
209	14	de	Digital Signage	
210	14	en	Digital Signage	
212	14	id	Digital Signage	
215	14	ru	Digital Signage	
174	13	de	Smart Home	
175	13	en	Smart Home	
176	13	fr	Smart Home	
177	13	id	Smart Home	
180	13	ru	Smart Home	
313	18	id	Spa	
336	8			
337	8			
338	18			
339	18			
340	18			
341	3			
342	3			
343	3			
344	11			
345	11			
346	11			
347	11			
348	11			
349	11			
350	4			
351	4			
352	4			
432	2			
353	19			
358	19			
359	19			
361	20			
366	20			
367	20			
369	20			
433	2			
434	2			
435	17			
370	20			
371	20			
436	17			
372	19			
437	17			
438	18			
439	18			
440	18			
373	19			
374	19			
441	4			
375	20			
442	4			
443	4			
444	4			
376	20			
377	20			
445	4			
378	19			
446	4			
379	19			
380	19			
381	19			
382	19			
383	19			
384	20			
385	20			
386	20			
387	19			
388	19			
389	19			
390	9			
391	9			
392	9			
393	11			
394	11			
395	11			
396	11			
397	11			
398	11			
399	13			
400	13			
401	13			
402	15			
403	15			
404	15			
405	14			
406	14			
407	14			
408	10			
409	10			
410	10			
411	14			
412	14			
413	14			
414	10			
415	10			
416	10			
417	5			
418	5			
419	5			
420	4			
421	4			
422	4			
423	14			
424	14			
425	14			
426	15			
427	15			
428	15			
429	20			
430	20			
431	20			
112	12	de	Home	
449	12	kr	홈	
97	11	fr	Connectivité	
450	17	cn	促銷	
287	17	de	Promo	
451	17	jp	プロモ	
452	17	kr	프로모션	
453	16	cn	航班時刻表	
246	16	id	Jadwal Penerbangan	
454	16	jp	運航計画	
455	16	kr	운항 스케줄	
456	18	cn	온천	
458	18	kr	온천	
41	8	ru	Обслуживание в номерах	
459	19	cn	遊	
354	19	de	Tour	
460	19	jp	ツアー	
356	19	fr	Tour	
461	19	kr	순회 공연	
360	19	ru	Tур	
462	20	cn	禮品店	
362	20	de	Geschenkboutique	
365	20	id	Butik Souvenir	
364	20	fr	Cadeaux	
463	20	jp	ギフトショップ	
464	20	kr	선물 가게	
368	20	ru	Сувениры	
61	9	de	Bill Anzeigen	
474	15	cn	發送短消息	
476	15	kr	메시지 보내기	
477	14	cn	數字標牌	
211	14	fr	Digital Signage	
478	14	jp	電子看板	
479	14	kr	디지털 사이 니지	
480	13	cn	智能家居	
481	13	jp	スマートホーム	
482	13	kr	스마트 홈	
46	4	ru	Телеканалы	
472	11	jp	接続性	
473	11	kr	연결	
483	4			
471	11	cn	連接	
484	4			
357	19	id	Wisata	
363	20	en	Gift Shop	
355	19	en	Tour	
475	15	jp	メッセージの送信	
457	18	jp	スパ	
485	4			
486	4			
487	4			
488	4			
489	4			
490	4			
491	4			
492	4			
493	4			
494	4			
495	4			
496	4			
497	4			
498	3			
499	3			
500	3			
501	3			
502	3			
503	6			
504	6			
505	6			
506	6			
507	6			
508	2			
509	2			
510	2			
511	2			
512	2			
513	7			
466	9	jp	ビュービル	
514	7			
515	7			
516	7			
517	7			
518	8			
519	8			
520	8			
521	8			
522	8			
467	9	kr	보기 빌	
9	4	id	Saluran TV	
523	18			
524	18			
525	18			
526	18			
527	18			
528	19			
529	19			
530	19			
531	19			
532	19			
533	20			
534	20			
535	20			
536	20			
537	20			
538	19			
539	19			
540	19			
541	19			
542	19			
543	9			
544	9			
545	9			
546	9			
547	9			
548	10			
549	10			
550	10			
551	10			
552	10			
553	15			
554	15			
555	15			
556	15			
557	15			
558	18			
559	18			
560	18			
561	18			
562	18			
563	2			
564	2			
565	2			
566	2			
567	2			
568	2			
569	2			
570	2			
571	2			
572	2			
573	21			
574	21			
576	21			
579	21			
580	21			
581	22			
582	22			
584	22			
587	22			
588	22			
589	23			
590	23			
592	23			
595	23			
596	23			
597	24			
598	24			
600	24			
603	24			
604	24			
605	25			
606	25			
608	25			
611	25			
612	25			
613	2			
614	2			
615	2			
616	2			
617	2			
618	2			
619	2			
620	2			
621	2			
622	2			
623	2			
624	2			
625	2			
626	2			
627	2			
628	22			
629	22			
630	22			
631	22			
632	22			
633	26			
634	26			
636	26			
639	26			
640	26			
641	26			
642	26			
643	26			
672	27			
667	26			
644	26			
645	26			
646	27			
647	27			
649	27			
652	27			
653	27			
654	28			
655	28			
657	28			
660	28			
661	28			
662	26			
663	26			
664	26			
665	26			
666	26			
668	26			
669	26			
670	26			
671	26			
673	27			
674	27			
675	27			
676	27			
677	28			
678	28			
679	28			
680	28			
681	28			
682	29			
683	29			
685	29			
688	29			
689	29			
690	29			
691	29			
692	29			
578	21	jp	ダイニング	
638	26	jp	ハウス電話で	
594	23	jp	レクリエーションの	
651	27	jp	公衆の場電話	
24	2	jp	ルーム＆スイート	
610	25	jp	お問い合わせ	
693	29			
694	29			
695	30			
696	30			
698	30			
701	30			
702	30			
703	31			
704	31			
706	31			
709	31			
710	31			
711	32			
601	24	id	Galeri	
607	25	en	Contact Us	
609	25	id	Hubungi Kami	
577	21	id	Restoran	
635	26	en	In&amp;nbsp;House&amp;nbsp;Phone	
637	26	id	Telepon&amp;nbsp;Internal	
648	27	en	Public&amp;nbsp;Place&amp;nbsp;Phone	
650	27	id	Tempat&amp;nbsp;Umum	
3	2	id	Kamar	
593	23	id	Rekreasi	
658	28	id	Lupa&amp;nbsp;Sesuatu?	
591	23	en	Recreation	
712	32			
714	32			
717	32			
718	32			
719	33			
720	33			
722	33			
725	33			
726	33			
727	34			
728	34			
730	34			
733	34			
734	34			
735	35			
736	35			
738	35			
741	35			
742	35			
743	36			
744	36			
746	36			
749	36			
750	36			
751	7			
752	7			
753	7			
754	7			
755	6			
756	6			
757	6			
758	6			
447	12	cn	家	
759	12			
760	12			
448	12	jp	ホーム	
761	12			
762	12			
763	7			
764	7			
765	7			
766	7			
767	6			
768	6			
769	6			
770	6			
771	2			
772	2			
773	2			
774	2			
776	21			
777	21			
778	21			
779	21			
781	22			
782	22			
783	22			
784	22			
786	23			
787	23			
788	23			
789	23			
791	24			
792	24			
793	24			
794	24			
796	25			
797	25			
798	25			
799	25			
801	26			
802	26			
803	26			
804	26			
806	27			
807	27			
808	27			
809	27			
810	4			
811	4			
812	4			
813	4			
814	8			
815	8			
816	8			
817	8			
819	35			
820	35			
821	35			
822	35			
824	28			
825	28			
826	28			
827	28			
829	29			
830	29			
831	29			
832	29			
834	30			
835	30			
836	30			
837	30			
839	31			
840	31			
841	31			
842	31			
844	32			
845	32			
846	32			
847	32			
731	34	id	Bantuan&amp;nbsp;Kesehatan	
833	30	cn	降及提货	
697	30	en	Drop&amp;nbsp;&amp;&amp;nbsp;Pick&amp;nbsp;Up	
699	30	id	Drop&amp;nbsp;&amp;&amp;nbsp;Pick&amp;nbsp;Up	
705	31	en	Business&amp;nbsp;Center	
707	31	id	Pusat&amp;nbsp;Bisnis	
708	31	jp	ビジネスセンター	
729	34	en	Medical&amp;nbsp;Assistance	
716	32	jp	コールモーニングコール	
721	33	en	Car Rental	
723	33	id	Rental Mobil	
724	33	jp	レンタカー	
732	34	jp	医療扶助	
740	35	jp	何がです	
790	24	cn	画廊	
602	24	jp	ギャラリー	
795	25	cn	联系我们	
838	31	cn	商务中心	
849	34			
850	34			
851	34			
852	34			
854	33			
855	33			
856	33			
857	33			
858	7			
859	7			
860	7			
861	7			
863	36			
862	36	cn		
748	36	jp	接続性	
864	36			
865	36			
866	36			
867	21			
868	21			
869	21			
870	21			
871	22			
575	21	en	Restaurant	
805	27	cn	公共场所电话	
739	35	id	What's Happening	
823	28	cn	难道你忘了什么东西？	
843	32	cn	叫醒服务	
828	29	cn	洗衣及干洗	
686	29	id	Laundry &amp; DryClean	
713	32	en	Wake Up Call	
715	32	id	Wake Up Call	
818	35	cn	什么是在	
16	7	cn	语	
737	35	en	What's Happening	
785	23	cn	娱乐	
18	7	id	Bahasa	Pilihan Bahasa
2	2	en	Room Category	
872	22			
873	22			
874	22			
875	23			
876	23			
877	23			
878	23			
879	28			
880	28			
881	28			
882	28			
883	29			
884	29			
885	29			
886	29			
887	30			
888	30			
889	30			
890	30			
891	31			
892	31			
893	31			
894	31			
895	32			
896	32			
897	32			
898	32			
853	33	cn	汽车出租	
899	33			
900	33			
901	33			
902	33			
903	9			
904	9			
905	9			
906	9			
907	26			
908	26			
909	26			
910	26			
911	27			
912	27			
913	27			
914	27			
915	8			
916	8			
917	8			
918	8			
919	10			
920	10			
921	10			
922	10			
923	10			
924	10			
925	10			
926	10			
927	10			
928	10			
929	10			
930	10			
931	35			
932	35			
933	35			
934	35			
935	24			
936	24			
937	24			
938	24			
939	22			
940	22			
586	22	jp	ミーティング＆イベント	
941	22			
942	22			
943	26			
944	26			
945	26			
946	26			
947	27			
948	27			
949	27			
950	27			
951	26			
952	26			
953	26			
954	26			
955	27			
956	27			
957	27			
958	27			
999	25			
959	34			
960	34			
961	34			
962	34			
963	31			
964	31			
965	31			
966	31			
967	29			
968	29			
969	29			
970	29			
971	30			
972	30			
973	30			
974	30			
975	28			
976	28			
977	28			
978	28			
979	28			
980	28			
659	28	jp	あなたが何かを忘れていますか？	
981	28			
982	28			
983	29			
984	29			
985	29			
986	29			
987	30			
988	30			
700	30	jp	ドロップ＆ピックアップ	
989	30			
990	30			
991	2			
992	2			
993	2			
994	2			
848	34	cn	提供医疗救助	
995	34			
996	34			
997	34			
998	34			
1000	25			
1001	25			
1002	25			
1004	37			
1006	37			
1008	37	jp	Point Of Interest	
1009	37			
1010	37			
1011	10			
1012	10			
1013	10			
1014	10			
1015	36			
745	36	en	Connectivity	
1016	36			
1017	36			
1018	36			
1019	36			
747	36	id	Konektivitas	
1020	36			
1021	36			
1022	36			
1023	36			
1024	36			
1025	36			
1026	36			
1027	36			
1028	36			
1029	36			
1030	36			
1031	29			
1032	29			
1007	37	id	Hal-Hal Yang Menarik	
465	9	cn	查看比爾	
62	9	en	View Bill	
800	26	cn	在众议院电话	
684	29	en	Laundry &amp; DryClean	
1003	37	cn	点兴趣点	
1005	37	en	Point Of Interest	
64	9	id	Lihat Tagihan	
656	28	en	Forget&amp;nbsp;Something?	
687	29	jp	ランドリー＆ドライクリーニング	
1033	29			
1034	29			
1035	6			
1036	6			
1037	6			
1038	6			
1039	10			
1040	10			
469	10	jp	受信トレイ	
1041	10			
1042	10			
1044	38			
1046	38			
1048	38	jp	室内でのマッサージ	
1049	38			
1050	38			
1051	10			
1052	10			
1053	10			
1152	10			
1120	38			
1054	10			
1055	3			
1056	3			
1057	3			
1121	38			
1058	3			
1059	10			
1122	7			
1123	7			
1060	10			
1061	24			
599	24	en	Gallery	
1062	24			
1063	3			
1124	6			
1064	3			
1065	3			
468	10	cn	收件箱	
1066	3			
1067	25			
1068	25			
1069	21			
1070	21	kr	식당	
1071	22			
1072	22	kr	회의 및 이벤트	
1073	37			
1075	26			
1076	26	kr	집 전화에서	
1077	27			
1078	27	kr	공공 장소의 전화	
13	6	cn	远程手动	
1125	6			
1126	2			
1079	10			
1080	8			
1081	35			
1083	28			
1084	28	kr	뭔가를 잊어?	
1085	29			
1086	29	kr	세탁 및 드라이 클리닝	
1087	32			
1088	32	kr	모닝콜	
1	2	cn	客房与套房	首页目录包含了所有由酒店提供的服务
1127	2			
1128	21			
1089	10			
775	21	cn	餐饮	
1090	9			
1091	9			
1092	9			
1093	8			
1094	37			
1074	37	kr	관심의 포인트	
1095	2			
25	2	kr	호텔 디렉토리	홈 디렉토리는 호텔에서 제공하는 서비스를 모두 포함
1099	39			
1129	21			
1130	22			
780	22	cn	会议与活动	
1101	39			
583	22	en	Meeting&amp;nbsp;&amp;&amp;nbsp;Events	
1096	39	cn	度假旅游	
1097	39	en	Resort Maps	
1098	39	id	Resort Maps	
1102	39			
1100	39	kr	리조트지도	
1103	10			
470	10	kr	받은 편지함	
1104	9			
1105	23			
1106	23	kr	휴양	
1107	8			
585	22	id	Pertemuan&amp;nbsp;&amp;&amp;nbsp;Acara	
1108	21			
1109	21			
1131	22			
1110	21			
1111	21			
1132	38			
85	10	en	Inbox	
87	10	id	Kotak Pesan	
1112	38			
1113	38			
1153	10			
1154	4			
1155	40	cn		
1114	22			
1115	22			
1156	40	en	Group	
1116	21			
1117	21			
1157	40	id	Grup	
1118	2			
1119	2			
1158	40			
1159	40	kr		
1043	38	cn	客房内按摩	
1045	38	en	Sakanti Spa	
1047	38	id	Sakanti Spa	
1133	38			
1134	23			
1135	23			
1136	37			
1137	37			
1138	3			
6	3	id	Depot Film	
1139	3			
1140	4			
1141	4			
1142	8			
1143	8			
1144	35			
1145	35			
1146	9			
1147	9			
1148	28			
1149	28			
1150	32			
1151	32			
1160	35			
1082	35	kr	무슨 일이야	
\.


--
-- Name: menu_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('menu_translations_translation_id_seq', 1160, true);


--
-- Data for Name: menus; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY menus (menu_id, menu_thumbnail, menu_url, menu_enabled, menu_order, menu_runningtext_enabled, menu_in_mobile, menu_in_stb, menu_in_empty_room, menu_group_id) FROM stdin;
34	doctor.png	doctor.php	0	20	1	1	1	1	11
15	sendmessage.png	sendmessage.php	0	16	1	1	1	0	8
19	tour.png	tour.php	0	11	1	1	1	0	4
2	roomsuites.png	roomsuites.php	1	2	1	1	1	1	7
24	gallery.png	gallery.php	1	7	1	1	1	1	7
25	contactus.png	contactus.php	0	8	1	1	1	0	7
8	roomservice.png	roomservice.php	1	12	1	1	1	0	6
39	resortmaps.png	resortmaps.php	1	9	1	0	1	1	7
3	movie.png	vod.php	0	12	1	1	1	1	9
40	default	guestgroup.php	0	2	1	0	1	0	14
35	whatson.png	whatson.php	1	13	1	1	1	1	12
31	business.png	business_center.php	0	17	1	1	1	1	11
33	carrental.png	car_rental.php	0	19	1	1	1	1	11
36	connectivity.png	connectivity.php	0	30	0	0	1	0	7
30	drop.png	drop_pickup.php	0	16	1	1	1	1	11
20	souvenir.png	shop.php	0	12	1	1	1	0	2
18	spa.png	spa.php	0	10	1	1	1	0	3
26	inhouse.png	inhouse.php	1	9	1	1	1	1	10
27	public.png	publicplace.php	1	10	1	1	1	1	10
7	language.png	language.php	1	1	1	1	1	1	1
29	laundry.png	laundry.php	1	15	1	1	1	1	11
12	home.png	index.php	1	0	1	1	0	1	0
21	dining.png	dining.php	1	3	1	1	1	1	7
22	meeting.png	meetingevent.php	1	4	1	1	1	1	7
38	massage.png	massage.php	1	5	1	1	1	1	7
23	recreational.png	recreational.php	1	6	1	1	1	1	7
37	interest.png	interest.php	1	8	1	1	1	1	7
9	view-bill.png	viewbill.php	1	13	1	0	1	0	11
28	forget.png	forget.php	1	14	1	1	1	1	11
32	wakeupcall.png	wakeup_call.php	1	18	1	1	1	1	11
10	inbox.png	inbox.php	1	39	1	0	1	0	11
4	tv.png	tv_channel.php	1	11	1	0	1	1	9
6	remote.png	remote.php	1	2	1	0	1	1	13
\.


--
-- Name: menus_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('menus_seq', 40, true);


--
-- Data for Name: modules; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY modules (module_id, module_name, module_file, module_description, module_in_admin, module_enabled, module_order) FROM stdin;
6	_FandB_	fnb	Foods and Beverages	1	0	0
8	_Internet_	internet	List of available websites	1	0	0
9	Advertising	ads		0	0	5
2	Control Panel	node	Containing Nodes, Languages, List Modules and Its Category, User and Previledges, Styles, etc	1	1	1
1	Dashboard	index	Logging, monitoring and statistics	1	1	0
7	Digital Signage	signage/signage	Digital Signage and Ads	1	1	3
5	FE: Main Menu	main	IPTV Homepage. Main Menu crot	0	1	1
3	Features	tv	Front End of Navicom IPTV application	1	1	2
4	PMS Integration	pms	Navicom IPTV - PMS Integration Module	1	1	4
\.


--
-- Name: modules_child_cat_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('modules_child_cat_seq', 14, true);


--
-- Name: modules_child_module_child_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('modules_child_module_child_id_seq', 96, true);


--
-- Data for Name: modules_detail; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY modules_detail (module_detail_id, module_detail_name, module_detail_desc, module_detail_file, module_id, module_detail_cat_id, module_detail_enabled) FROM stdin;
42	Templates		signage_template	7	4	1
44	Data		ads	9	1	1
39	Regions		signage_region	7	11	1
35	Clips		signage_clip	7	12	1
36	Images		signage_image	7	12	1
43	Texts		signage_text	7	12	1
37	Master Signage		signage_master	7	11	1
7	Privileges	User Privileges	priviledge	2	3	1
5	Groups	Group Modules	group	2	3	1
4	Users	User Modules	user	2	3	1
9	Languages	Languages Modules	lang	2	1	1
6	Logs	Navicom IPTV Logs	log	1	1	1
10	Modules	List of Modules and would be generated into menus	module	2	4	1
13	Styles	Skins/Templates/Styles and schedules	style	2	5	1
1	Dashboard	IPTV stats and logs.	index	1	1	1
12	Module Categories	Contain Categories of module and shown as sub title menu in the left of ACP	module_cat	2	4	1
11	Sub Modules	Modules Child / Sub Modules. The Hyperlinks will be shown in left side of ACP	module_sub	2	4	1
3	VoD	Stats of VoD	stat_vod	1	2	0
14	Style Schedule	Schedule of styles management	style_schedule	2	5	1
16	Page	Article feature using text editor	page	3	1	1
17	Front End Menus	Front End menus management	fe_menu	3	1	1
19	TV Channels		tv	3	7	1
20	TV Groups		tv_group	3	7	1
22	Movie Category		movie_group	3	8	1
21	Movies		movie	3	8	1
23	Directory		directory	3	1	1
28	Room Services		service	3	9	1
27	Room Service Groups		servicegroup	3	9	1
25	Running Text		runningtext	3	1	1
18	File Manager	Navicom File Manager	filemanager	2	1	0
29	PMS Info	Hotel and Property Management System Information	pms	4	1	1
30	Guest		guest	4	1	1
32	Occupancy		occupancy	4	1	1
26	Rooms	List of Rooms	room	2	10	1
33	Zones		zone	2	10	1
15	_Advert_Monitor_	dasdasd	#	1	2	0
2	TV Channel	Stats of TV Channel	stat_tv	1	2	0
38	Playlist		signage_playlist	7	4	1
40	Schedules		signage_schedule	7	4	1
41	Signages		signage	7	4	1
47	Gates		signage_gate	7	11	1
48	Target Directions		signage_target_direction	7	11	1
49	Urgencies		signage_urgency	7	11	1
46	Emergencies		signage_emergency	7	11	1
50	RSS		signage_rss	7	12	1
52	Airports		airport	3	11	1
24	Weather	Weather source: weather.com	weather	3	11	1
53	Configuration		configuration.php	2	1	1
54	TV Promo		tv_promo	3	7	1
51	Signage Skins		signage_skin	7	5	1
55	General		signage_general	7	4	1
56	Directory Promo		directory_promo	3	1	1
58	Spa Category		spagroup	3	9	1
57	Spa Item		spa	3	9	1
61	Shops		shop	3	9	1
59	Tours		tour	3	9	1
62	Shop Groups		shopgroup	3	9	1
60	Tour Groups		tourgroup	3	9	1
63	Transportations		transportation	3	11	1
64	Teraphists		teraphist	3	11	1
8	Nodes/STB	List of Nodes, Rooms, Clients etc	node	2	10	1
68	Front End Menu Groups		fe_menu_group	3	1	1
45	Message from Guest		message_from_guest	4	14	1
34	Room Service Buffer		roomservice_buffer	4	14	1
69	Guest Requests	Guest Request master table for guest message to FO	request	3	11	1
86	Room Service Sync		roomservice_sync	4	1	1
85	Guest Group		guest_group	3	11	1
89	Pop Up Promo		popup_promo	3	11	1
90	Pop Up Promo Schedule		popup_promo_schedule	3	7	1
71	Dining		dining	3	12	1
72	Meeting &amp; Events		meetingevent	3	12	1
70	Room &amp; Suites		roomsuite	3	12	1
80	Business Center		business_center	3	12	1
82	Car Rental		car_rental	3	12	1
88	Contact Us		contactus	3	12	1
83	Doctor / Medical Assistance		doctor	3	12	1
79	Drop &amp; Pick Up		drop_pickup	3	12	1
77	Forget Something		forget	3	12	1
74	Gallery		gallery	3	12	1
84	What's On		whatson	3	12	1
75	In House Phone		inhouse	3	12	1
91	Point Of Interest		interest	3	12	1
78	Laundry &amp; Dry Clean		laundry	3	12	1
76	Public Place Phone		publicplace	3	12	1
73	Recreational		recreational	3	12	1
81	Wake Up Call		wakeup_call	3	12	1
65	Shop Buffer		shop_buffer	4	14	0
66	Tour Buffer		tour_buffer	4	14	0
67	Spa Buffer		spa_buffer	4	14	0
93	Room Service Buffer Detail		roomservice_buffer_detail	9	6	1
94	Hotspot Information	Hotspot Username and Password	hotspot	3	11	1
31	PMS Sync	Updating Guest DB of Navicom IPTV to the newest Guest DB in PMS	pms_sync	4	1	1
95	Resort Maps		resortmap	3	12	1
92	Spa		massage	3	12	1
96	Group Information		group_info	3	12	1
\.


--
-- Data for Name: modules_detail_cat; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY modules_detail_cat (module_detail_cat_id, module_detail_cat_name) FROM stdin;
1	General
2	Statistics
3	Users and Groups
4	Modules
5	Skins
6	_Njajal Om_
7	TV Broadcast
8	Movies
10	Clients
11	Masters
12	Contents
13	Spa
9	Commerce
14	Buffers
\.


--
-- Name: modules_module_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('modules_module_id_seq', 9, true);


--
-- Data for Name: movie_group_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY movie_group_translations (translation_id, movie_group_id, language_id, translation_title) FROM stdin;
13	5	cn	动画
16	5	de	Animation
14	5	en	Animation
17	5	fr	Animation
15	5	id	Animasi
18	5	jp	アニメーション
19	5	kr	생기
20	5	ru	анимация
1	1	cn	行动
21	1	de	Aktion
2	1	en	Action
22	1	fr	Action
3	1	id	Laga
23	1	jp	アクション
24	1	kr	활동
25	1	ru	действие
4	2	cn	戏剧
26	2	de	Drama
5	2	en	Drama
27	2	fr	Drame
6	2	id	Drama
28	2	jp	ドラマ
29	2	kr	드라마
30	2	ru	драма
7	3	cn	喜剧
31	3	de	Komödie
8	3	en	Comedy
32	3	fr	Comédie
9	3	id	Komedi
33	3	jp	コメディ
34	3	kr	코메디
35	3	ru	комедия
10	4	cn	恐怖
36	4	de	Horror
11	4	en	Horror
37	4	fr	Horreur
12	4	id	Horor
38	4	jp	ホラー
39	4	kr	공포
40	4	ru	ужас
41	6	  	
42	6	de	Science Fiction
43	6	en	Science Fiction
44	6	fr	Science Fiction
45	6	id	Science Fiction
46	6	  	
47	6	  	
48	6	ru	Science Fiction
49	7	  	
50	7	de	Thriller
51	7	en	Thriller
52	7	fr	Thriller
53	7	id	Thriller
54	7	  	
55	7	  	
56	7	ru	Thriller
57	8	  	
58	8	de	War
59	8	en	War
60	8	fr	War
61	8	id	Perang
62	8	  	
63	8	  	
64	8	ru	War
65	9	  	
66	9	de	Komedi Romantis
67	9	en	Romantoc Comedy
68	9	fr	Komedi Romantis
69	9	id	Komedi Romantis
70	9	  	
71	9	  	
72	9	ru	Komedi Romantis
73	10	  	
78	10	  	
79	10	  	
81	10	cn	記錄片
74	10	de	Dokumentarfilm
75	10	en	Documentary
76	10	fr	Documentaire
77	10	id	Dokumenter
82	10	jp	ドキュメンタリー
83	10	kr	다큐멘터리
80	10	ru	Документальные
\.


--
-- Name: movie_group_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('movie_group_translations_translation_id_seq', 83, true);


--
-- Data for Name: movie_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY movie_groupings (movie_grouping_id, movie_id, movie_group_id) FROM stdin;
99	6	10
109	14	10
110	4	10
111	7	10
112	13	10
113	8	10
114	15	10
115	10	10
116	9	10
117	3	10
118	5	10
119	11	10
120	12	10
\.


--
-- Name: movie_groupings_movie_grouping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('movie_groupings_movie_grouping_id_seq', 120, true);


--
-- Data for Name: movie_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY movie_groups (movie_group_id, movie_group_description, movie_group_enabled) FROM stdin;
6		1
7		1
5	Film corek	1
1	Film eksyen ini om	1
2	Film keluargaaaaaa	1
3	Film kok guyonan tok	1
4	Medeni	1
8		1
9		1
10		1
\.


--
-- Name: movie_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('movie_groups_seq', 10, true);


--
-- Data for Name: movie_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY movie_translations (translation_id, movie_id, language_id, translation_title, translation_description) FROM stdin;
152	12	  		
26	6	de	Wunderbare Indonesien - East Java	
164	5	  		
153	12	  		
154	12	  		
191	6	  		
25	6	cn	我的老板我的学生	
28	6	fr	Magnifique Indonésie - East Java	
29	6	id	Wonderful Indonesia - East Java	
32	6	ru	Замечательный Индонезия - East Java	
30	6	jp	私の上司ボスマイ	
31	6	kr	내 보스 내 학생	
174	12	  		
175	12	  		
179	9	  		
197	13	  		
158	7	  		
173	12	  		
159	7	  		
160	7	  		
185	3	  		
165	5	  		
166	5	  		
167	7	  		
168	7	  		
169	7	  		
180	9	  		
181	9	  		
186	3	  		
187	3	  		
27	6	en	Wonderful Indonesia - East Java	
192	6	  		
193	6	  		
198	13	  		
199	13	  		
203	14	  		
155	12	  		
156	12	  		
157	12	  		
161	9	  		
162	9	  		
163	9	  		
143	7	  		
144	7	  		
145	7	  		
146	11	  		
147	11	  		
148	11	  		
11	4	en	Wonderful Indonesia - Bunaken	
12	4	fr	Magnifique Indonésie - Bunaken	
13	4	id	Wonderful Indonesia - Bunaken	
15	4	kr	멋진 인도네시아 - Bunaken	
16	4	ru	Замечательный Индонезия - Bunaken	
33	7	cn	精彩的印尼 - 雅加達	
34	7	de	Wunderbare Indonesien - Jakarta	
35	7	en	Wonderful Indonesia - Jakarta	
36	7	fr	Magnifique Indonésie - Jakarta	
37	7	id	Wonderful Indonesia - Jakarta	
39	7	kr	멋진 인도네시아 - 자카르타	
40	7	ru	Замечательный Индонезия - Jakarta	
81	13	cn	精彩的印尼 - 克里穆圖火山	
83	13	en	Wonderful Indonesia - Kelimutu	
84	13	fr	Magnifique Indonésie - Kelimutu	
85	13	id	Wonderful Indonesia - Kelimutu	
86	13	jp	ワンダフルインドネシア - クリムトゥ山	
87	13	kr	멋진 인도네시아 - Kelimutu 파노라마	
41	8	cn	精彩的印尼 - 科莫多	
42	8	de	Wunderbare Indonesien - Komodo	
43	8	en	Wonderful Indonesia - Komodo	
44	8	fr	Magnifique Indonésie - Komodo	
45	8	id	Wonderful Indonesia - Komodo	
46	8	jp	ワンダフルインドネシア - コモド	
47	8	kr	멋진 인도네시아 - 코모도	
57	10	cn	精彩的印尼 - 北蘇門答臘	
58	10	de	Wunderbare Indonesien - North Sumatra	
59	10	en	Wonderful Indonesia - North Sumatra	
60	10	fr	Magnifique Indonésie - North Sumatra	
61	10	id	Wonderful Indonesia - North Sumatra	
62	10	jp	ワンダフルインドネシア - 北スマトラ	
63	10	kr	멋진 인도네시아 - 북 수마트라	
49	9	cn	精彩的印尼 - 拉賈安帕	
50	9	de	Wunderbare Indonesien - Raja Ampat	
51	9	en	Wonderful Indonesia - Raja Ampat	
52	9	fr	Magnifique Indonésie - Raja Ampat	
53	9	id	Wonderful Indonesia - Raja Ampat	
54	9	jp	ワンダフルインドネシア - ラジャアンパット	
55	9	kr	멋진 인도네시아 - 라자 Ampat	
4	3	de	Wunderbare Indonesien - Tana Toraja	
2	3	en	Wonderful Indonesia - Tana Toraja	
5	3	fr	Magnifique Indonésie - Tana Toraja	
3	3	id	Wonderful Indonesia - Tana Toraja	
7	3	kr	멋진 인도네시아 - 타나 토라 자	
8	3	ru	Замечательный Индонезия - Tana Toraja	
17	5	cn	精彩的印尼 - 丹戎思想促進	
18	5	de	Wunderbare Indonesien - Tanjung Puting	
19	5	en	Wonderful Indonesia - Tanjung Puting	
20	5	fr	Magnifique Indonésie - Tanjung Puting	
21	5	id	Wonderful Indonesia - Tanjung Puting	
23	5	kr	멋진 인도네시아 - 탄중 푸팅	
24	5	ru	Замечательный Индонезия - Tanjung Puting	
65	11	cn	精彩的印尼 - Wakatobi	
66	11	de	Wunderbare Indonesien - Wakatobi	
67	11	en	Wonderful Indonesia - Wakatobi	
68	11	fr	Magnifique Indonésie - Wakatobi	
69	11	id	Wonderful Indonesia - Wakatobi	
70	11	jp	ワンダフルインドネシア - ワカトビ	
72	11	ru	Замечательный Индонезия - Wakatobi	
73	12	cn	精彩的印尼 - 日惹	
74	12	de	Wunderbare Indonesien - Yogyakarta	
75	12	en	Wonderful Indonesia - Yogyakarta	
76	12	fr	Magnifique Indonésie - Yogyakarta	
77	12	id	Wonderful Indonesia - Yogyakarta	
79	12	kr	멋진 인도네시아 - 족 자카르타	
80	12	ru	Замечательный Индонезия - Yogyakarta	
149	11	  		
150	11	  		
151	11	  		
170	7	  		
171	7	  		
172	7	  		
176	11	  		
177	11	  		
178	11	  		
182	5	  		
183	5	  		
184	5	  		
188	4	  		
189	4	  		
190	4	  		
194	10	  		
195	10	  		
196	10	  		
200	8	  		
201	8	  		
202	8	  		
208	14	  		
209	14	  		
211	15	  		
216	15	  		
217	15	  		
219	14	  		
220	14	  		
221	14	  		
222	4	  		
223	4	  		
224	4	  		
225	6	  		
226	6	  		
227	6	  		
228	13	  		
229	13	  		
230	13	  		
231	8	  		
232	8	  		
233	8	  		
234	15	  		
235	15	  		
236	15	  		
237	10	  		
238	10	  		
239	10	  		
240	9	  		
241	9	  		
242	9	  		
243	3	  		
244	3	  		
245	3	  		
246	5	  		
247	5	  		
248	5	  		
249	11	  		
250	11	  		
251	11	  		
252	12	  		
253	12	  		
254	12	  		
255	14	cn	精彩的印尼 - 巴厘島	
204	14	de	Wunderbare Indonesien - Bali	
205	14	en	Wonderful Indonesia - Bali	
206	14	fr	Magnifique Indonésie - Bali	
207	14	id	Wonderful Indonesia - Bali	
256	14	jp	ワンダフルインドネシア - バリ	
257	14	kr	멋진 인도네시아 - 발리	
210	14	ru	Замечательный Индонезия - Bali	
9	4	cn	精彩的印尼 - 布納肯	
10	4	de	Wunderbare Indonesien - Bunaken	
14	4	jp	ワンダフルインドネシア - ブナケン	
38	7	jp	ワンダフルインドネシア - ジャカルタ	
82	13	de	Wunderbare Indonesien - Kelimutu	
88	13	ru	Замечательный Индонезия - Kelimutu	
48	8	ru	Замечательный Индонезия - Komodo	
258	15	cn	精彩的印尼 - 龍目島	
212	15	de	Wunderbare Indonesien - Lombok	
213	15	en	Wonderful Indonesia - Lombok	
214	15	fr	Magnifique Indonésie - Lombok	
215	15	id	Wonderful Indonesia - Lombok	
259	15	jp	ワンダフルインドネシア - ロンボク	
260	15	kr	멋진 인도네시아 - 롬복	
218	15	ru	Замечательный Индонезия - Lombok	
64	10	ru	Замечательный Индонезия - North Sumatra	
56	9	ru	Замечательный Индонезия - Raja Ampat	
1	3	cn	精彩的印尼 - 塔納托拉佳	
6	3	jp	ワンダフルインドネシア - タナトラジャ	
22	5	jp	ワンダフルインドネシア - タンジュン·プティン	
71	11	kr	멋진 인도네시아 - Wakatobi	
78	12	jp	ワンダフルインドネシア - ジャカルタ	
\.


--
-- Name: movie_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('movie_translations_translation_id_seq', 260, true);


--
-- Data for Name: movies; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY movies (movie_id, movie_price, movie_casts, movie_director, movie_enabled, movie_url, movie_thumbnail, movie_trailer, movie_allow_ads, movie_code) FROM stdin;
6	0		Indonesia Tourism	1	wi-east-java.mp4	east-java	wi-east-java.mp4	0	1113
14	0		Indonesia Tourism	1	wi-bali.mp4	bali	wi-bali.mp4	0	1111
4	0		Indonesia Tourism	1	wi-bunaken.mp4	bunaken	wi-bunaken.mp4	0	1112
7	0		Indonesia Tourism	1	wi-jakarta.mp4	jakarta	wi-jakarta.mp4	0	2014
13	0		Indonesia Tourism	1	wi-kelimutu.mp4	kelimutu	wi-kelimutu.mp4	0	1115
8	0		Indonesia Tourism	1	wi-komodo.mp4	komodo	wi-komodo.mp4	0	1116
15	0		Indonesia Tourism	1	wi-lombok.mp4	lombok	wi-lombok.mp4	0	1117
10	0		Indonesia Tourism	1	wi-north-sumatra.mp4	north-sumatra	wi-north-sumatra.mp4	0	1118
9	1		Indonesia Tourism	1	wi-raja-ampat.mp4	raja-ampat	wi-raja-ampat.mp4	0	2011
3	0		Indonesia Tourism	1	wi-tana-toraja.mp4	tana-toraja	wi-tana-toraja.mp4	0	1119
5	0		Indonesia Tourism	1	wi-tanjung-puting.mp4	tanjung-puting	wi-tanjung-puting.mp4	0	2012
11	0		Indonesia Tourism	1	wi-wakatobi.mp4	wakatobi	wi-wakatobi.mp4	0	1120
12	0		Indonesia Tourism	1	wi-jogja.mp4	jogja	wi-jogja.mp4	0	250
\.


--
-- Name: movies_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('movies_seq', 15, true);


--
-- Data for Name: node_target_gate_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY node_target_gate_groupings (node_target_gate_grouping_id, target_gate_name, node_id, direction) FROM stdin;
1	1	18	EA
2	2	18	WE
3	3	18	SW
\.


--
-- Name: node_target_gate_groupings_node_target_gate_grouping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('node_target_gate_groupings_node_target_gate_grouping_id_seq', 12, false);


--
-- Data for Name: nodes; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY nodes (node_id, node_name, node_mac, node_description, node_enabled, node_url, node_lang_id, room_id, node_welcome_screen, node_last_url, node_ip) FROM stdin;
427	6302	00:00:00:00:00:00	Room 6302 Deluxe Lantai 3	1	\N	en	427	0	\N	172.10.5.192
615	IT	00:00:00:00:00:00	IT	1		en	408	0	\N	172.10.4.5
426	6301	00:00:00:00:00:00	Room 6301 Deluxe Lantai 3	1	\N	en	426	0	\N	172.10.5.191
435	6311	00:00:00:00:00:00	Room 6311 Deluxe Lantai 3	1	\N	en	435	0	\N	172.10.5.200
424	5221	00:00:00:00:00:00	Room 5221 Deluxe Lantai 2	1	\N	cn	424	0	\N	172.10.5.189
439	6317	00:00:00:00:00:00	Room 6317 Deluxe Lantai 3	1	\N	en	439	0	\N	172.10.5.204
417	5212	00:00:00:00:00:00	Room 5212 Deluxe Lantai 2	1	\N	en	417	0	\N	172.10.5.182
243	3320	00:00:00:00:00:00	Room 3320 Premiere Lantai 3	1	\N	en	243	0	\N	172.10.5.8
416	5211	00:00:00:00:00:00	Room 5211 Deluxe Lantai 2	1	\N	en	416	0	\N	172.10.5.181
443	6321	00:00:00:00:00:00	Room 6321 Deluxe Lantai 3	1	\N	en	443	0	\N	172.10.5.208
429	6305	00:00:00:00:00:00	Room 6305 Deluxe Lantai 3	1	\N	en	429	0	\N	172.10.5.194
667	3157A	00:00:00:00:00:00	3157A	1		en	590	0	\N	172.10.6.75
421	5218	00:00:00:00:00:00	Room 5218 Deluxe Lantai 2	1	\N	en	421	0	\N	172.10.5.186
251	3328	00:00:00:00:00:00	Room 3328 Premiere Lantai 3	1	\N	en	251	0	\N	172.10.5.16
423	5220	00:00:00:00:00:00	Room 5220 Deluxe Lantai 2	1	\N	id	423	0	\N	172.10.5.188
574	Spare 25	00:00:00:00:00:00	Spare 25	1	\N	en	550	0	\N	172.10.6.85
447	5301	00:00:00:00:00:00	Room 5301 Deluxe Lantai 3	1	\N	en	447	0	\N	172.10.5.212
597	Spare 48	00:00:00:00:00:00	Spare 48	1	\N	en	550	0	\N	172.10.6.108
155	3225	00:00:00:00:00:00	Room 3225 Premiere Lantai 2	1	\N	en	155	0	\N	172.10.4.174
430	6306	00:00:00:00:00:00	Room 6306 Deluxe Lantai 3	1	\N	en	430	0	\N	172.10.5.195
433	6309	00:00:00:00:00:00	Room 6309 Deluxe Lantai 3	1	\N	en	433	0	\N	172.10.5.198
62	3123	00:00:00:00:00:00	Room 3123 Premiere Lantai 1	1	\N	en	62	0	\N	172.10.4.81
144	3212	00:00:00:00:00:00	Room 3212 Premiere Lantai 2	1	\N	en	144	0	\N	172.10.4.163
600	2122	00:00:00:00:00:00	Room 2122 Premiere Lantai 1	1		id	19	0	\N	172.10.6.111
418	5215	00:00:00:00:00:00	Room 5215 Deluxe Lantai 2	1	\N	en	418	0	\N	172.10.5.183
444	6322	00:00:00:00:00:00	Room 6322 Deluxe Lantai 3	1	\N	en	444	0	\N	172.10.5.209
599	Spare 50	00:00:00:00:00:00	Spare 50	1	\N	id	550	0	\N	172.10.6.110
634	pc ird		pc ird	1		id	346	0	\N	10.201.59.34
420	5217	00:00:00:00:00:00	Room 5217 Deluxe Lantai 2	1	\N	cn	420	0	\N	172.10.5.185
619	1509A	00:00:00:00:00:00	Room 1509B Premiere Lantai 5	1		en	307	0	\N	172.10.5.72
436	6312	00:00:00:00:00:00	Room 6312 Deluxe Lantai 3	1	\N	en	436	0	\N	172.10.5.201
438	6316	00:00:00:00:00:00	Room 6316 Deluxe Lantai 3	1	\N	en	438	0	\N	172.10.5.203
419	5216	00:00:00:00:00:00	Room 5216 Deluxe Lantai 2	1	\N	en	419	0	\N	172.10.5.184
431	6307	00:00:00:00:00:00	Room 6307 Deluxe Lantai 3	1	\N	en	431	0	\N	172.10.5.196
422	5219	00:00:00:00:00:00	Room 5219 Deluxe Lantai 2 //172.10.5.187	1		cn	422	0	\N	172.10.6.240
432	6308	00:00:00:00:00:00	Room 6308 Deluxe Lantai 3	1	\N	en	432	0	\N	172.10.5.197
445	6323	00:00:00:00:00:00	Room 6323 Deluxe Lantai 3	1	\N	en	445	0	\N	172.10.5.210
425	5222	00:00:00:00:00:00	Room 5222 Deluxe Lantai 2	1	\N	en	425	0	\N	172.10.5.190
617	STB control room	00:00:00:00:00:00		1		en	550	0	\N	172.10.4.6
441	6319	00:00:00:00:00:00	Room 6319 Deluxe Lantai 3	1	\N	en	441	0	\N	172.10.5.206
414	5209	00:00:00:00:00:00	Room 5209 Deluxe Lantai 2	1	\N	id	414	0	\N	172.10.5.179
636	IRD	00:00:00:00:00:00	IRD	1		en	72	0	\N	10.201.59.30
633	vpnq	00:00:00:00:00:00	vpnq	1		en	373	0	\N	10.201.59.200
446	6324	00:00:00:00:00:00	Room 6324 Deluxe Lantai 3	1	\N	en	446	0	\N	172.10.5.211
624	PCITTENGAH	00:00:00:00:00:00	PCITTENGAH	1		en	239	0	\N	10.201.59.15
448	5302	00:00:00:00:00:00	Room 5302 Deluxe Lantai 3	1	\N	en	448	0	\N	172.10.5.213
428	6303	00:00:00:00:00:00	Room 6303 Deluxe Lantai 3	1	\N	en	428	0	\N	172.10.5.193
415	5210	00:00:00:00:00:00	Room 5210 Deluxe Lantai 2	1	\N	cn	415	0	\N	172.10.5.180
637	Villa LA	00:00:00:00:00:00	Villa LA	0		en	0	0	\N	172.10.6.25
627	Bagus	00:00:00:00:00:00	Bagus Laptop	1		en	262	0	\N	10.201.59.64
442	6320	00:00:00:00:00:00	Room 6320 Deluxe Lantai 3	1	\N	en	442	0	\N	172.10.5.207
413	5208	00:00:00:00:00:00	Room 5208 Deluxe Lantai 2	1	\N	en	413	0	\N	172.10.5.178
440	6318	00:00:00:00:00:00	Room 6318 Deluxe Lantai 3	1	\N	en	440	0	\N	172.10.5.205
610	1510B	00:00:00:00:00:00	Room 1510B Premiere Lantai 5	1		id	305	0	\N	172.10.5.71
437	6315	00:00:00:00:00:00	Room 6315 Deluxe Lantai 3	1	\N	en	437	0	\N	172.10.5.202
629	laptopIT	00:00:00:00:00:00	laptopIT	1		en	468	0	\N	192.168.4.106
434	6310	00:00:00:00:00:00	Room 6310 Deluxe Lantai 3	1	\N	en	434	0	\N	172.10.5.199
483	6521	00:00:00:00:00:00	Room 6521 Deluxe Lantai 5	1	\N	en	483	0	\N	172.10.5.248
467	6502	00:00:00:00:00:00	Room 6502 Deluxe Lantai 5	1	\N	en	467	0	\N	172.10.5.232
491	5506	00:00:00:00:00:00	Room 5506 Deluxe Lantai 5	1	\N	kr	491	0	\N	172.10.6.2
464	5321	00:00:00:00:00:00	Room 5321 Deluxe Lantai 3	1	\N	cn	464	0	\N	172.10.5.229
480	6518	00:00:00:00:00:00	Room 6518 Deluxe Lantai 5	1	\N	en	480	0	\N	172.10.5.245
472	6508	00:00:00:00:00:00	Room 6508 Deluxe Lantai 5	1	\N	en	472	0	\N	172.10.5.237
638	Villa LB	00:00:00:00:00:00	Villa LB	0		en	0	0	\N	172.10.6.26
466	6501	00:00:00:00:00:00	Room 6501 Deluxe Lantai 5	1	\N	en	466	0	\N	172.10.5.231
280	2532	00:00:00:00:00:00	Room 2532 Premiere Lantai 5	1	\N	en	280	0	\N	172.10.5.45
497	5512	00:00:00:00:00:00	Room 5512 Deluxe Lantai 5	1	\N	en	497	0	\N	172.10.6.8
481	6519	00:00:00:00:00:00	Room 6519 Deluxe Lantai 5	1	\N	en	481	0	\N	172.10.5.246
500	5517	00:00:00:00:00:00	Room 5517 Deluxe Lantai 5	1	\N	en	500	0	\N	172.10.6.11
459	5316	00:00:00:00:00:00	Room 5316 Deluxe Lantai 3	1	\N	en	459	0	\N	172.10.5.224
477	6515	00:00:00:00:00:00	Room 6515 Deluxe Lantai 5	1	\N	en	477	0	\N	172.10.5.242
471	6507	00:00:00:00:00:00	Room 6507 Deluxe Lantai 5	1	\N	en	471	0	\N	172.10.5.236
488	5502	00:00:00:00:00:00	Room 5502 Deluxe Lantai 5	1	\N	en	488	0	\N	172.10.5.253
493	5508	00:00:00:00:00:00	Room 5508 Deluxe Lantai 5	1	\N	en	493	0	\N	172.10.6.4
498	5515	00:00:00:00:00:00	Room 5515 Deluxe Lantai 5	1	\N	en	498	0	\N	172.10.6.9
458	5315	00:00:00:00:00:00	Room 5315 Deluxe Lantai 3	1	\N	en	458	0	\N	172.10.5.223
449	5303	00:00:00:00:00:00	Room 5303 Deluxe Lantai 3	1	\N	en	449	0	\N	172.10.5.214
501	5518	00:00:00:00:00:00	Room 5518 Deluxe Lantai 5	1	\N	en	501	0	\N	172.10.6.12
487	5501	00:00:00:00:00:00	Room 5501 Deluxe Lantai 5	1	\N	en	487	0	\N	172.10.5.252
490	5505	00:00:00:00:00:00	Room 5505 Deluxe Lantai 5	1	\N	en	490	0	\N	172.10.6.1
186	2327	00:00:00:00:00:00	Room 2327 Premiere Lantai 3	1	\N	en	186	0	\N	172.10.4.205
463	5320	00:00:00:00:00:00	Room 5320 Deluxe Lantai 3	1		en	463	0	\N	172.10.5.228
486	6524	00:00:00:00:00:00	Room 6524 Deluxe Lantai 5	1	\N	en	486	0	\N	172.10.5.251
455	5310	00:00:00:00:00:00	Room 5310 Deluxe Lantai 3	1	\N	en	455	0	\N	172.10.5.220
452	5307	00:00:00:00:00:00	Room 5307 Deluxe Lantai 3	1	\N	en	452	0	\N	172.10.5.217
475	6511	00:00:00:00:00:00	Room 6511 Deluxe Lantai 5	1	\N	en	475	0	\N	172.10.5.240
450	5305	00:00:00:00:00:00	Room 5305 Deluxe Lantai 3	1	\N	en	450	0	\N	172.10.5.215
476	6512	00:00:00:00:00:00	Room 6512 Deluxe Lantai 5	1	\N	en	476	0	\N	172.10.5.241
39	2142	00:00:00:00:00:00	Room 2142 Premiere Lantai 1	1	\N	id	39	0	\N	172.10.4.58
451	5306	00:00:00:00:00:00	Room 5306 Deluxe Lantai 3	1	\N	en	451	0	\N	172.10.5.216
456	5311	00:00:00:00:00:00	Room 5311 Deluxe Lantai 3	1	\N	en	456	0	\N	172.10.5.221
385	5122	00:00:00:00:00:00	Room 5122 Deluxe Lantai 1	1	\N	en	385	0	\N	172.10.5.150
620	PaWahyu_Room	00:00:00:00:00:00		1		id	306	0	\N	172.10.6.254
478	6516	00:00:00:00:00:00	Room 6516 Deluxe Lantai 5	1	\N	en	478	0	\N	172.10.5.243
462	5319	00:00:00:00:00:00	Room 5319 Deluxe Lantai 3	1	\N	cn	462	0	\N	172.10.5.227
499	5516	00:00:00:00:00:00	Room 5516 Deluxe Lantai 5	1	\N	cn	499	0	\N	172.10.6.10
484	6522	00:00:00:00:00:00	Room 6522 Deluxe Lantai 5	1	\N	en	484	0	\N	172.10.5.249
479	6517	00:00:00:00:00:00	Room 6517 Deluxe Lantai 5	1	\N	en	479	0	\N	172.10.5.244
502	5519	00:00:00:00:00:00	Room 5519 Deluxe Lantai 5	1	\N	en	502	0	\N	172.10.6.13
496	5511	00:00:00:00:00:00	Room 5511 Deluxe Lantai 5	1	\N	en	496	0	\N	172.10.6.7
503	5520	00:00:00:00:00:00	Room 5520 Deluxe Lantai 5	1	\N	en	503	0	\N	172.10.6.14
668	3157B	00:00:00:00:00:00	3157B	1		en	590	0	\N	172.10.6.76
492	5507	00:00:00:00:00:00	Room 5507 Deluxe Lantai 5	1	\N	id	492	0	\N	172.10.6.3
618	PCEDP	00:00:00:00:00:00	PCEDP	1		en	433	0	\N	172.10.4.9
485	6523	00:00:00:00:00:00	Room 6523 Deluxe Lantai 5	1	\N	en	485	0	\N	172.10.5.250
474	6510	00:00:00:00:00:00	Room 6510 Deluxe Lantai 5	1	\N	en	474	0	\N	172.10.5.239
489	5503	00:00:00:00:00:00	Room 5503 Deluxe Lantai 5	1	\N	en	489	0	\N	172.10.5.254
82	2212	00:00:00:00:00:00	Room 2212 Premiere Lantai 2	1	\N	en	82	0	\N	172.10.4.101
469	6505	00:00:00:00:00:00	Room 6505 Deluxe Lantai 5	1	\N	en	469	0	\N	172.10.5.234
482	6520	00:00:00:00:00:00	Room 6520 Deluxe Lantai 5	1	\N	en	482	0	\N	172.10.5.247
465	5322	00:00:00:00:00:00	Room 5322 Deluxe Lantai 3	1	\N	en	465	0	\N	172.10.5.230
457	5312	00:00:00:00:00:00	Room 5312 Deluxe Lantai 3	1	\N	en	457	0	\N	172.10.5.222
453	5308	00:00:00:00:00:00	Room 5308 Deluxe Lantai 3	1	\N	en	453	0	\N	172.10.5.218
468	6503	00:00:00:00:00:00	Room 6503 Deluxe Lantai 5	1	\N	en	468	0	\N	172.10.5.233
494	5509	00:00:00:00:00:00	Room 5509 Deluxe Lantai 5	1	\N	id	494	0	\N	172.10.6.5
454	5309	00:00:00:00:00:00	Room 5309 Deluxe Lantai 3	1	\N	en	454	0	\N	172.10.5.219
635	IRD	00:00:00:00:00:00	IRD	1		en	0	0	\N	10.201.59.30
470	6506	00:00:00:00:00:00	Room 6506 Deluxe Lantai 5	1	\N	en	470	0	\N	172.10.5.235
116	1215A	00:00:00:00:00:00	Room 1215A Premiere Lantai 2	1	\N	id	116	0	\N	172.10.4.135
473	6509	00:00:00:00:00:00	Room 6509 Deluxe Lantai 5	1	\N	en	473	0	\N	172.10.5.238
115	1216	00:00:00:00:00:00	Room 1216 Premiere Lantai 2	1	\N	en	115	0	\N	172.10.4.134
78	2208	00:00:00:00:00:00	Room 2208 Premiere Lantai 2	1	\N	en	78	0	\N	172.10.4.97
27	2130	00:00:00:00:00:00	Room 2130 Premiere Lantai 1	1	\N	id	27	0	\N	172.10.4.46
626	PC	00:00:00:00:00:00	PC	1		id	98	0	\N	10.201.59.98
126	1209	00:00:00:00:00:00	Room 1209 Premiere Lantai 2	1	\N	en	126	0	\N	172.10.4.145
112	1219	00:00:00:00:00:00	Room 1219 Premiere Lantai 2	1	\N	en	112	0	\N	172.10.4.131
201	2342	00:00:00:00:00:00	Room 2342 Premiere Lantai 3	1	\N	en	201	0	\N	172.10.4.220
68	3129A	00:00:00:00:00:00	Room 3129A Premiere Lantai 1	1	\N	en	68	0	\N	172.10.4.87
69	3129B	00:00:00:00:00:00	Room 3129B Premiere Lantai 1	1	\N	id	68	0	\N	172.10.4.88
121	1212C	00:00:00:00:00:00	Room 1212C Premiere Lantai 2	1	\N	id	119	0	\N	172.10.4.140
97	2229	00:00:00:00:00:00	Room 2229 Premiere Lantai 2	1	\N	en	97	0	\N	172.10.4.116
284	2536	00:00:00:00:00:00	Room 2536 Premiere Lantai 5	1	\N	id	284	0	\N	172.10.5.49
495	5510	00:00:00:00:00:00	Room 5510 Deluxe Lantai 5	1	\N	en	495	0	\N	172.10.6.6
21	2124	00:00:00:00:00:00	Room 2124 Premiere Lantai 1	1	\N	en	21	0	\N	172.10.4.40
113	1218	00:00:00:00:00:00	Room 1218 Premiere Lantai 2	1	\N	en	113	0	\N	172.10.4.132
100	2232	00:00:00:00:00:00	Room 2232 Premiere Lantai 2	1	\N	en	100	0	\N	172.10.4.119
118	1215C	00:00:00:00:00:00	Room 1215C Premiere Lantai 2	1	\N	id	116	0	\N	172.10.4.137
117	1215B	00:00:00:00:00:00	Room 1215B Premiere Lantai 2	1	\N	id	116	0	\N	172.10.4.136
119	1212A	00:00:00:00:00:00	Room 1212A Premiere Lantai 2	1	\N	id	119	0	\N	172.10.4.138
122	1211A	00:00:00:00:00:00	Room 1211A Premiere Lantai 2	1	\N	id	122	0	\N	172.10.4.141
38	2141	00:00:00:00:00:00	Room 2141 Premiere Lantai 1	1	\N	en	38	0	\N	172.10.4.57
26	2129	00:00:00:00:00:00	Room 2129 Premiere Lantai 1	1	\N	en	26	0	\N	172.10.4.45
124	1211C	00:00:00:00:00:00	Room 1211C Premiere Lantai 2	1	\N	id	122	0	\N	172.10.4.143
461	5318	00:00:00:00:00:00	Room 5318 Deluxe Lantai 3	1	\N	en	461	0	\N	172.10.5.226
639	Villa LA 01 A	00:00:00:00:00:00	Villa LA 01 A	0		en	0	0	\N	172.10.6.27
101	2233	00:00:00:00:00:00	Room 2233 Premiere Lantai 2	1	\N	en	101	0	\N	172.10.4.120
114	1217	00:00:00:00:00:00	Room 1217 Premiere Lantai 2	1	\N	en	114	0	\N	172.10.4.133
83	2215	00:00:00:00:00:00	Room 2215 Premiere Lantai 2	1	\N	en	83	0	\N	172.10.4.102
120	1212B	00:00:00:00:00:00	Room 1212B Premiere Lantai 2	1	\N	id	119	0	\N	172.10.4.139
95	2227	00:00:00:00:00:00	Room 2227 Premiere Lantai 2	1	\N	en	95	0	\N	172.10.4.114
73	2202	00:00:00:00:00:00	Room 2202 Premiere Lantai 2	1	\N	en	73	0	\N	172.10.4.92
380	5117	00:00:00:00:00:00	Room 5117 Deluxe Lantai 1	1	\N	en	380	0	\N	172.10.5.145
71	3130B	00:00:00:00:00:00	Room 3130B Premiere Lantai 1	1	\N	en	70	0	\N	172.10.4.90
125	1210	00:00:00:00:00:00	Room 1210 Premiere Lantai 2	1	\N	en	125	0	\N	172.10.4.144
72	2201	00:00:00:00:00:00	Room 2201 Premiere Lantai 2	1	\N	en	72	0	\N	172.10.4.91
123	1211B	00:00:00:00:00:00	Room 1211B Premiere Lantai 2	1	\N	id	122	0	\N	172.10.4.142
568	Spare 19	00:00:00:00:00:00	Spare 19	1	\N	en	550	0	\N	172.10.6.79
20	2123	00:00:00:00:00:00	Room 2123 Premiere Lantai 1	1	\N	en	20	0	\N	172.10.4.39
669	3150A	00:00:00:00:00:00	3150A	1		id	591	0	\N	172.10.6.61
460	5317	00:00:00:00:00:00	Room 5317 Deluxe Lantai 3	1	\N	en	460	0	\N	172.10.5.225
103	2235	00:00:00:00:00:00	Room 2235 Premiere Lantai 2	1	\N	en	103	0	\N	172.10.4.122
649	3151A	00:00:00:00:00:00	3151A	1		en	581	0	\N	172.10.6.63
33	2136	00:00:00:00:00:00	Room 2136 Premiere Lantai 1	1	\N	en	33	0	\N	172.10.4.52
611	spare22	00:00:00:00:00:00	spare22	1		id	0	0	\N	172.10.7.10
29	2132	00:00:00:00:00:00	Room 2132 Premiere Lantai 1	1	\N	id	29	0	\N	172.10.4.48
4	2105	00:00:00:00:00:00	Room 2105 Premiere Lantai 1	1	\N	en	4	0	\N	172.10.4.23
23	2126	00:00:00:00:00:00	Room 2126 Premiere Lantai 1	1	\N	en	23	0	\N	172.10.4.42
111	1220	00:00:00:00:00:00	Room 1220 Premiere Lantai 2	1	\N	en	111	0	\N	172.10.4.130
12	2115	00:00:00:00:00:00	Room 2115 Premiere Lantai 1	1	\N	id	12	0	\N	172.10.4.31
625	OkaPC	00:00:00:00:00:00	Oka PC	1		id	82	0	\N	10.201.59.65
590	Spare 41	00:00:00:00:00:00	Spare 41	1		en	550	0	\N	172.10.6.101
70	3130A	00:00:00:00:00:00	Room 3130A Premiere Lantai 1	1	\N	en	70	0	\N	172.10.4.89
19	spare23	00:00:00:00:00:00	spare23 pengganti 2122	1		en	550	0	\N	172.10.4.38
37	2140	00:00:00:00:00:00	Room 2140 Premiere Lantai 1	1	\N	en	37	0	\N	172.10.4.56
44	3102	00:00:00:00:00:00	Room 3102 Premiere Lantai 1	1		en	44	0	\N	172.10.4.63
40	1101	00:00:00:00:00:00	Room 1101 Premiere Lantai 1	1		id	40	0	\N	172.10.4.59
166	2305	00:00:00:00:00:00	Room 2305 Premiere Lantai 3	1	\N	cn	166	0	\N	172.10.4.185
102	2234	00:00:00:00:00:00	Room 2234 Premiere Lantai 2	1	\N	id	102	0	\N	172.10.4.121
25	2128	00:00:00:00:00:00	Room 2128 Premiere Lantai 1	1	\N	id	25	0	\N	172.10.4.44
567	Control Room	00:00:00:00:00:00	Spare 18	1		en	399	0	\N	172.10.6.80
96	2228	00:00:00:00:00:00	Room 2228 Premiere Lantai 2	1	\N	en	96	0	\N	172.10.4.115
56	3117	00:00:00:00:00:00	Room 3117 Premiere Lantai 1	1	\N	id	56	0	\N	172.10.4.75
273	2525	00:00:00:00:00:00	Room 2525 Premiere Lantai 5	1	\N	id	273	0	\N	172.10.5.38
650	3151B	00:00:00:00:00:00	3151B	1		en	581	0	\N	172.10.6.64
378	5115	00:00:00:00:00:00	Room 5115 Deluxe Lantai 1	1	\N	en	378	0	\N	172.10.5.143
182	2323	00:00:00:00:00:00	Room 2323 Premiere Lantai 3	1	\N	en	182	0	\N	172.10.4.201
47	3106	00:00:00:00:00:00	Room 3106 Premiere Lantai 1	1	\N	en	47	0	\N	172.10.4.66
598	Spare 49	00:00:00:00:00:00	Spare 49	1	\N	en	550	0	\N	172.10.6.109
34	2137	00:00:00:00:00:00	Room 2137 Premiere Lantai 1	1	\N	en	34	0	\N	172.10.4.53
14	2117	00:00:00:00:00:00	Room 2117 Premiere Lantai 1	1	\N	en	14	0	\N	172.10.4.33
52	3111	00:00:00:00:00:00	Room 3111 Premiere Lantai 1	1	\N	en	52	0	\N	172.10.4.71
128	1207	00:00:00:00:00:00	Room 1207 Premiere Lantai 2	1	\N	id	128	0	\N	172.10.4.147
92	2224	00:00:00:00:00:00	Room 2224 Premiere Lantai 2	1	\N	en	92	0	\N	172.10.4.111
57	3118	00:00:00:00:00:00	Room 3118 Premiere Lantai 1	1	\N	en	57	0	\N	172.10.4.76
84	2216	00:00:00:00:00:00	Room 2216 Premiere Lantai 2	1	\N	cn	84	0	\N	172.10.4.103
32	2135	00:00:00:00:00:00	Room 2135 Premiere Lantai 1	1	\N	en	32	0	\N	172.10.4.51
43	3101	00:00:00:00:00:00	Room 3101 Premiere Lantai 1	1		en	43	0	\N	172.10.4.62
206	1316	00:00:00:00:00:00	Room 1316 Premiere Lantai 3	1	\N	en	206	0	\N	172.10.4.225
42	1103	00:00:00:00:00:00	Room 1103 Premiere Lantai 1	1		en	42	0	\N	172.10.4.61
260	2510	00:00:00:00:00:00	Room 2510 Premiere Lantai 5	1	\N	id	260	0	\N	172.10.5.25
17	2120	00:00:00:00:00:00	Room 2120 Premiere Lantai 1	1	\N	id	17	0	\N	172.10.4.36
90	2222	00:00:00:00:00:00	Room 2222 Premiere Lantai 2	1	\N	cn	90	0	\N	172.10.4.109
98	2230	00:00:00:00:00:00	Room 2230 Premiere Lantai 2	1	\N	id	98	0	\N	172.10.4.117
18	2121	00:00:00:00:00:00	Room 2121 Premiere Lantai 1	1	\N	id	18	0	\N	172.10.4.37
5	2106	00:00:00:00:00:00	Room 2106 Premiere Lantai 1	1	\N	en	5	0	\N	172.10.4.24
132	1202	00:00:00:00:00:00	Room 1202 Premiere Lantai 2	1	\N	en	132	0	\N	172.10.4.151
10	2111	00:00:00:00:00:00	Room 2111 Premiere Lantai 1	1	\N	en	10	0	\N	172.10.4.29
77	2207	00:00:00:00:00:00	Room 2207 Premiere Lantai 2	1	\N	en	77	0	\N	172.10.4.96
46	3105	00:00:00:00:00:00	Room 3105 Premiere Lantai 1	1	\N	cn	46	0	\N	172.10.4.65
24	2127	00:00:00:00:00:00	Room 2127 Premiere Lantai 1	1	\N	id	24	0	\N	172.10.4.43
85	2217	00:00:00:00:00:00	Room 2217 Premiere Lantai 2	1	\N	en	85	0	\N	172.10.4.104
7	2108	00:00:00:00:00:00	Room 2108 Premiere Lantai 1	1	\N	en	7	0	\N	172.10.4.26
74	2203	00:00:00:00:00:00	Room 2203 Premiere Lantai 2	1	\N	cn	74	0	\N	172.10.4.93
670	3150B	00:00:00:00:00:00	3150B	1		id	591	0	\N	172.10.6.62
45	3103	00:00:00:00:00:00	Room 3103 Premiere Lantai 1	1	\N	en	45	0	\N	172.10.4.64
36	2139	00:00:00:00:00:00	Room 2139 Premiere Lantai 1	1	\N	en	36	0	\N	172.10.4.55
207	1315	00:00:00:00:00:00	Room 1315 Premiere Lantai 3	1	\N	id	207	0	\N	172.10.4.226
1	2101	00:00:00:00:00:00	Room 2101 Premiere Lantai 1	1	\N	id	1	0	\N	172.10.4.20
50	3109	00:00:00:00:00:00	Room 3109 Premiere Lantai 1	1	\N	en	50	0	\N	172.10.4.69
640	Villa LB 01 B	00:00:00:00:00:00	Villa LB 01 B	0		en	0	0	\N	172.10.6.28
104	2236	00:00:00:00:00:00	Room 2236 Premiere Lantai 2	1	\N	en	104	0	\N	172.10.4.123
58	3119	00:00:00:00:00:00	Room 3119 Premiere Lantai 1	1	\N	cn	58	0	\N	172.10.4.77
131	1203	00:00:00:00:00:00	Room 1203 Premiere Lantai 2	1	\N	en	131	0	\N	172.10.4.150
86	2218	00:00:00:00:00:00	Room 2218 Premiere Lantai 2	1	\N	en	86	0	\N	172.10.4.105
16	2119	00:00:00:00:00:00	Room 2119 Premiere Lantai 1	1	\N	id	16	0	\N	172.10.4.35
35	2138	00:00:00:00:00:00	Room 2138 Premiere Lantai 1	1	\N	id	35	0	\N	172.10.4.54
187	2328	00:00:00:00:00:00	Room 2328 Premiere Lantai 3	1	\N	en	187	0	\N	172.10.4.206
80	2210	00:00:00:00:00:00	Room 2210 Premiere Lantai 2	1	\N	en	80	0	\N	172.10.4.99
133	1201	00:00:00:00:00:00	Room 1201 Premiere Lantai 2	1	\N	en	133	0	\N	172.10.4.152
108	2240	00:00:00:00:00:00	Room 2240 Premiere Lantai 2	1	\N	en	108	0	\N	172.10.4.127
127	1208	00:00:00:00:00:00	Room 1208 Premiere Lantai 2	1	\N	en	127	0	\N	172.10.4.146
87	2219	00:00:00:00:00:00	Room 2219 Premiere Lantai 2	1	\N	cn	87	0	\N	172.10.4.106
41	1102	00:00:00:00:00:00	Room 1102 Premiere Lantai 1	1		id	41	0	\N	172.10.4.60
79	2209	00:00:00:00:00:00	Room 2209 Premiere Lantai 2	1	\N	cn	79	0	\N	172.10.4.98
204	1318	00:00:00:00:00:00	Room 1318 Premiere Lantai 3	1	\N	id	204	0	\N	172.10.4.223
169	2308	00:00:00:00:00:00	Room 2308 Premiere Lantai 3	1	\N	id	169	0	\N	172.10.4.188
189	2330	00:00:00:00:00:00	Room 2330 Premiere Lantai 3	1	\N	en	189	0	\N	172.10.4.208
136	3203	00:00:00:00:00:00	Room 3203 Premiere Lantai 2	1	\N	en	136	0	\N	172.10.4.155
91	2223	00:00:00:00:00:00	Room 2223 Premiere Lantai 2	1	\N	en	91	0	\N	172.10.4.110
76	2206	00:00:00:00:00:00	Room 2206 Premiere Lantai 2	1	\N	en	76	0	\N	172.10.4.95
143	3211	00:00:00:00:00:00	Room 3211 Premiere Lantai 2	1	\N	en	143	0	\N	172.10.4.162
154	3224	00:00:00:00:00:00	Room 3224 Premiere Lantai 2	1	\N	en	154	0	\N	172.10.4.173
162	3232	00:00:00:00:00:00	Room 3232 Premiere Lantai 2	1	\N	en	162	0	\N	172.10.4.181
150	3220	00:00:00:00:00:00	Room 3220 Premiere Lantai 2	1	\N	en	150	0	\N	172.10.4.169
651	3152A	00:00:00:00:00:00	3152A	1		en	582	0	\N	172.10.6.65
167	2306	00:00:00:00:00:00	Room 2306 Premiere Lantai 3	1	\N	en	167	0	\N	172.10.4.186
89	2221	00:00:00:00:00:00	Room 2221 Premiere Lantai 2	1	\N	en	89	0	\N	172.10.4.108
178	2319	00:00:00:00:00:00	Room 2319 Premiere Lantai 3	1	\N	en	178	0	\N	172.10.4.197
146	3216	00:00:00:00:00:00	Room 3216 Premiere Lantai 2	1	\N	en	146	0	\N	172.10.4.165
184	2325	00:00:00:00:00:00	Room 2325 Premiere Lantai 3	1	\N	id	184	0	\N	172.10.4.203
179	2320	00:00:00:00:00:00	Room 2320 Premiere Lantai 3	1	\N	en	179	0	\N	172.10.4.198
347	6102	00:00:00:00:00:00	Room 6102 Deluxe Lantai 1	1	\N	en	347	0	\N	172.10.5.112
134	3201	00:00:00:00:00:00	Room 3201 Premiere Lantai 2	1	\N	en	134	0	\N	172.10.4.153
152	3222	00:00:00:00:00:00	Room 3222 Premiere Lantai 2	1	\N	en	152	0	\N	172.10.4.171
107	2239	00:00:00:00:00:00	Room 2239 Premiere Lantai 2	1	\N	en	107	0	\N	172.10.4.126
191	2332	00:00:00:00:00:00	Room 2332 Premiere Lantai 3	1	\N	id	191	0	\N	172.10.4.210
109	2241	00:00:00:00:00:00	Room 2241 Premiere Lantai 2	1	\N	en	109	0	\N	172.10.4.128
138	3206	00:00:00:00:00:00	Room 3206 Premiere Lantai 2	1	\N	en	138	0	\N	172.10.4.157
137	3205	00:00:00:00:00:00	Room 3205 Premiere Lantai 2	1	\N	en	137	0	\N	172.10.4.156
197	2338	00:00:00:00:00:00	Room 2338 Premiere Lantai 3	1	\N	id	197	0	\N	172.10.4.216
163	2301	00:00:00:00:00:00	Room 2301 Premiere Lantai 3	1	\N	id	163	0	\N	172.10.4.182
205	1317	00:00:00:00:00:00	Room 1317 Premiere Lantai 3	1	\N	id	205	0	\N	172.10.4.224
88	2220	00:00:00:00:00:00	Room 2220 Premiere Lantai 2	1	\N	en	88	0	\N	172.10.4.107
160	3230	00:00:00:00:00:00	Room 3230 Premiere Lantai 2	1	\N	id	160	0	\N	172.10.4.179
175	2316	00:00:00:00:00:00	Room 2316 Premiere Lantai 3	1	\N	id	175	0	\N	172.10.4.194
165	2303	00:00:00:00:00:00	Room 2303 Premiere Lantai 3	1	\N	en	165	0	\N	172.10.4.184
159	3229	00:00:00:00:00:00	Room 3229 Premiere Lantai 2	1	\N	en	159	0	\N	172.10.4.178
161	3231	00:00:00:00:00:00	Room 3231 Premiere Lantai 2	1	\N	id	161	0	\N	172.10.4.180
290	2542	00:00:00:00:00:00	Room 2542 Premiere Lantai 5	1	\N	en	290	0	\N	172.10.5.55
177	2318	00:00:00:00:00:00	Room 2318 Premiere Lantai 3	1	\N	id	177	0	\N	172.10.4.196
142	3210	00:00:00:00:00:00	Room 3210 Premiere Lantai 2	1	\N	en	142	0	\N	172.10.4.161
145	3215	00:00:00:00:00:00	Room 3215 Premiere Lantai 2	1	\N	en	145	0	\N	172.10.4.164
168	2307	00:00:00:00:00:00	Room 2307 Premiere Lantai 3	1	\N	en	168	0	\N	172.10.4.187
194	2335	00:00:00:00:00:00	Room 2335 Premiere Lantai 3	1	\N	en	194	0	\N	172.10.4.213
188	2329	00:00:00:00:00:00	Room 2329 Premiere Lantai 3	1	\N	en	188	0	\N	172.10.4.207
172	2311	00:00:00:00:00:00	Room 2311 Premiere Lantai 3	1	\N	cn	172	0	\N	172.10.4.191
94	2226	00:00:00:00:00:00	Room 2226 Premiere Lantai 2	1	\N	en	94	0	\N	172.10.4.113
93	2225	00:00:00:00:00:00	Room 2225 Premiere Lantai 2	1	\N	en	93	0	\N	172.10.4.112
147	3217	00:00:00:00:00:00	Room 3217 Premiere Lantai 2	1	\N	en	147	0	\N	172.10.4.166
135	3202	00:00:00:00:00:00	Room 3202 Premiere Lantai 2	1	\N	en	135	0	\N	172.10.4.154
176	2317	00:00:00:00:00:00	Room 2317 Premiere Lantai 3	1	\N	en	176	0	\N	172.10.4.195
171	2310	00:00:00:00:00:00	Room 2310 Premiere Lantai 3	1	\N	id	171	0	\N	172.10.4.190
285	2537	00:00:00:00:00:00	Room 2537 Premiere Lantai 5	1	\N	en	285	0	\N	172.10.5.50
151	3221	00:00:00:00:00:00	Room 3221 Premiere Lantai 2	1	\N	en	151	0	\N	172.10.4.170
156	3226	00:00:00:00:00:00	Room 3226 Premiere Lantai 2	1	\N	en	156	0	\N	172.10.4.175
203	1319	00:00:00:00:00:00	Room 1319 Premiere Lantai 3	1	\N	id	203	0	\N	172.10.4.222
75	2205	00:00:00:00:00:00	Room 2205 Premiere Lantai 2	1	\N	en	75	0	\N	172.10.4.94
105	2237	00:00:00:00:00:00	Room 2237 Premiere Lantai 2	1	\N	en	105	0	\N	172.10.4.124
164	2302	00:00:00:00:00:00	Room 2302 Premiere Lantai 3	1	\N	id	164	0	\N	172.10.4.183
180	2321	00:00:00:00:00:00	Room 2321 Premiere Lantai 3	1	\N	en	180	0	\N	172.10.4.199
174	2315	00:00:00:00:00:00	Room 2315 Premiere Lantai 3	1	\N	en	174	0	\N	172.10.4.193
148	3218	00:00:00:00:00:00	Room 3218 Premiere Lantai 2	1	\N	en	148	0	\N	172.10.4.167
190	2331	00:00:00:00:00:00	Room 2331 Premiere Lantai 3	1	\N	en	190	0	\N	172.10.4.209
106	2238	00:00:00:00:00:00	Room 2238 Premiere Lantai 2	1	\N	en	106	0	\N	172.10.4.125
149	3219	00:00:00:00:00:00	Room 3219 Premiere Lantai 2	1	\N	en	149	0	\N	172.10.4.168
631	Kantin 01	00:00:00:00:00:00	kantin	1		id	550	0	\N	172.10.6.112
223	1305C	00:00:00:00:00:00	Room 1305C Premiere Lantai 3	1	\N	en	221	0	\N	172.10.4.242
228	3302	00:00:00:00:00:00	Room 3302 Premiere Lantai 3	1	\N	en	228	0	\N	172.10.4.247
616	Admin19	00:00:00:00:00:00		1		en	550	0	\N	172.10.4.19
632	Kantin 02	00:00:00:00:00:00	kantin	1		en	550	0	\N	172.10.6.113
213	1311C	00:00:00:00:00:00	Room 1311C Premiere Lantai 3	1	\N	en	211	0	\N	172.10.4.232
238	3315	00:00:00:00:00:00	Room 3315 Premiere Lantai 3	1	\N	en	238	0	\N	172.10.5.3
212	1311B	00:00:00:00:00:00	Room 1311B Premiere Lantai 3	1	\N	en	211	0	\N	172.10.4.231
211	1311A	00:00:00:00:00:00	Room 1311A Premiere Lantai 3	1	\N	en	211	0	\N	172.10.4.230
219	1307	00:00:00:00:00:00	Room 1307 Premiere Lantai 3	1	\N	id	219	0	\N	172.10.4.238
215	1310B	00:00:00:00:00:00	Room 1310B Premiere Lantai 3	1	\N	en	214	0	\N	172.10.4.234
195	2336	00:00:00:00:00:00	Room 2336 Premiere Lantai 3	1	\N	cn	195	0	\N	172.10.4.214
221	1305A	00:00:00:00:00:00	Room 1305A Premiere Lantai 3	1	\N	en	221	0	\N	172.10.4.240
157	3227	00:00:00:00:00:00	Room 3227 Premiere Lantai 2	1	\N	en	157	0	\N	172.10.4.176
237	3312	00:00:00:00:00:00	Room 3312 Premiere Lantai 3	1	\N	en	237	0	\N	172.10.5.2
652	3152B	00:00:00:00:00:00	3152B	1		en	582	0	\N	172.10.6.66
226	1301	00:00:00:00:00:00	Room 1301 Premiere Lantai 3	1	\N	en	226	0	\N	172.10.4.245
236	3311	00:00:00:00:00:00	Room 3311 Premiere Lantai 3	1		en	236	0	\N	172.10.5.1
588	Spare 39	00:00:00:00:00:00	Spare 39	1	\N	en	550	0	\N	172.10.6.99
209	1312B	00:00:00:00:00:00	Room 1312B Premiere Lantai 3	1	\N	en	208	0	\N	172.10.4.228
231	3306	00:00:00:00:00:00	Room 3306 Premiere Lantai 3	1	\N	cn	231	0	\N	172.10.4.250
141	3209	00:00:00:00:00:00	Room 3209 Premiere Lantai 2	1	\N	en	141	0	\N	172.10.4.160
233	3308	00:00:00:00:00:00	Room 3308 Premiere Lantai 3	1	\N	en	233	0	\N	172.10.4.252
216	1310C	00:00:00:00:00:00	Room 1310C Premiere Lantai 3	1	\N	en	214	0	\N	172.10.4.235
210	1312C	00:00:00:00:00:00	Room 1312C Premiere Lantai 3	1	\N	en	208	0	\N	172.10.4.229
592	Spare 43	00:00:00:00:00:00	Spare 43	1	\N	en	550	0	\N	172.10.6.103
183	2324	00:00:00:00:00:00	Room 2324 Premiere Lantai 3	1	\N	en	183	0	\N	172.10.4.202
247	3324	00:00:00:00:00:00	Room 3324 Premiere Lantai 3	1	\N	en	247	0	\N	172.10.5.12
181	2322	00:00:00:00:00:00	Room 2322 Premiere Lantai 3	1	\N	en	181	0	\N	172.10.4.200
193	2334	00:00:00:00:00:00	Room 2334 Premiere Lantai 3	1	\N	en	193	0	\N	172.10.4.212
250	3327	00:00:00:00:00:00	Room 3327 Premiere Lantai 3	1	\N	en	250	0	\N	172.10.5.15
242	3319	00:00:00:00:00:00	Room 3319 Premiere Lantai 3	1	\N	en	242	0	\N	172.10.5.7
370	5105	00:00:00:00:00:00	Room 5105 Deluxe Lantai 1	1	\N	en	370	0	\N	172.10.5.135
217	1309	00:00:00:00:00:00	Room 1309 Premiere Lantai 3	1	\N	id	217	0	\N	172.10.4.236
234	3309	00:00:00:00:00:00	Room 3309 Premiere Lantai 3	1	\N	en	234	0	\N	172.10.4.253
225	1302	00:00:00:00:00:00	Room 1302 Premiere Lantai 3	1	\N	en	225	0	\N	172.10.4.244
224	1303	00:00:00:00:00:00	Room 1303 Premiere Lantai 3	1	\N	id	224	0	\N	172.10.4.243
139	3207	00:00:00:00:00:00	Room 3207 Premiere Lantai 2	1		en	139	0	\N	172.10.4.158
229	3303	00:00:00:00:00:00	Room 3303 Premiere Lantai 3	1	\N	en	229	0	\N	172.10.4.248
222	1305B	00:00:00:00:00:00	Room 1305B Premiere Lantai 3	1	\N	en	221	0	\N	172.10.4.241
227	3301	00:00:00:00:00:00	Room 3301 Premiere Lantai 3	1	\N	en	227	0	\N	172.10.4.246
170	2309	00:00:00:00:00:00	Room 2309 Premiere Lantai 3	1	\N	en	170	0	\N	172.10.4.189
208	1312A	00:00:00:00:00:00	Room 1312A Premiere Lantai 3	1	\N	en	208	0	\N	172.10.4.227
153	3223	00:00:00:00:00:00	Room 3223 Premiere Lantai 2	1	\N	en	153	0	\N	172.10.4.172
235	3310	00:00:00:00:00:00	Room 3310 Premiere Lantai 3	1	\N	en	235	0	\N	172.10.4.254
214	1310A	00:00:00:00:00:00	Room 1310A Premiere Lantai 3	1	\N	en	214	0	\N	172.10.4.233
671	3132	00:00:00:00:00:00	3132	1		en	592	0	\N	172.10.6.26
140	3208	00:00:00:00:00:00	Room 3208 Premiere Lantai 2	1	\N	en	140	0	\N	172.10.4.159
240	3317	00:00:00:00:00:00	Room 3317 Premiere Lantai 3	1	\N	en	240	0	\N	172.10.5.5
249	3326	00:00:00:00:00:00	Room 3326 Premiere Lantai 3	1	\N	en	249	0	\N	172.10.5.14
246	3323	00:00:00:00:00:00	Room 3323 Premiere Lantai 3	1	\N	cn	246	0	\N	172.10.5.11
218	1308	00:00:00:00:00:00	Room 1308 Premiere Lantai 3.172.10.4.237	1		en	218	0	\N	172.10.4.237
239	3316	00:00:00:00:00:00	Room 3316 Premiere Lantai 3	1	\N	en	239	0	\N	172.10.5.4
173	2312	00:00:00:00:00:00	Room 2312 Premiere Lantai 3	1	\N	id	173	0	\N	172.10.4.192
230	3305	00:00:00:00:00:00	Room 3305 Premiere Lantai 3	1	\N	en	230	0	\N	172.10.4.249
241	3318	00:00:00:00:00:00	Room 3318 Premiere Lantai 3	1	\N	en	241	0	\N	172.10.5.6
248	3325	00:00:00:00:00:00	Room 3325 Premiere Lantai 3	1	\N	en	248	0	\N	172.10.5.13
220	1306	00:00:00:00:00:00	Room 1306 Premiere Lantai 3	1	\N	en	220	0	\N	172.10.4.239
158	3228	00:00:00:00:00:00	Room 3228 Premiere Lantai 2	1	\N	en	158	0	\N	172.10.4.177
252	2501	00:00:00:00:00:00	Room 2501 Premiere Lantai 5	1	\N	en	252	0	\N	172.10.5.17
232	3307	00:00:00:00:00:00	Room 3307 Premiere Lantai 3	1	\N	en	232	0	\N	172.10.4.251
304	1511B	00:00:00:00:00:00	Room 1511B Premiere Lantai 5	1	\N	en	303	0	\N	172.10.5.69
321	3501	00:00:00:00:00:00	Room 3501 Premiere Lantai 5	1	\N	en	321	0	\N	172.10.5.86
316	1505B	00:00:00:00:00:00	Room 1505B Premiere Lantai 5	1	\N	en	315	0	\N	172.10.5.81
261	2511	00:00:00:00:00:00	Room 2511 Premiere Lantai 5	1	\N	en	261	0	\N	172.10.5.26
314	1506	00:00:00:00:00:00	Room 1506 Premiere Lantai 5	1	\N	id	314	0	\N	172.10.5.79
324	3505	00:00:00:00:00:00	Room 3505 Premiere Lantai 5	1	\N	cn	324	0	\N	172.10.5.89
298	1516B	00:00:00:00:00:00	Room 1516B Premiere Lantai 5	1	\N	en	297	0	\N	172.10.5.63
271	2523	00:00:00:00:00:00	Room 2523 Premiere Lantai 5	1	\N	en	271	0	\N	172.10.5.36
317	1505C	00:00:00:00:00:00	Room 1505C Premiere Lantai 5	1	\N	en	315	0	\N	172.10.5.82
291	1522	00:00:00:00:00:00	Room 1522 Premiere Lantai 5	1	\N	en	291	0	\N	172.10.5.56
323	3503	00:00:00:00:00:00	Room 3503 Premiere Lantai 5	1	\N	en	323	0	\N	172.10.5.88
293	1520	00:00:00:00:00:00	Room 1520 Premiere Lantai 5	1	\N	id	293	0	\N	172.10.5.58
329	3510	00:00:00:00:00:00	Room 3510 Premiere Lantai 5	1	\N	en	329	0	\N	172.10.5.94
332	3515	00:00:00:00:00:00	Room 3515 Premiere Lantai 5	1	\N	en	332	0	\N	172.10.5.97
309	1509C	00:00:00:00:00:00	Room 1509C Premiere Lantai 5	1	\N	en	307	0	\N	172.10.5.74
299	1515A	00:00:00:00:00:00	Room 1515A Premiere Lantai 5	1	\N	en	299	0	\N	172.10.5.64
315	1505A	00:00:00:00:00:00	Room 1505A Premiere Lantai 5	1	\N	en	315	0	\N	172.10.5.80
328	3509	00:00:00:00:00:00	Room 3509 Premiere Lantai 5	1	\N	en	328	0	\N	172.10.5.93
322	3502	00:00:00:00:00:00	Room 3502 Premiere Lantai 5	1	\N	id	322	0	\N	172.10.5.87
311	1507A	00:00:00:00:00:00	Room 1507A Premiere Lantai 5	1	\N	en	311	0	\N	172.10.5.76
254	2503	00:00:00:00:00:00	Room 2503 Premiere Lantai 5	1	\N	id	254	0	\N	172.10.5.19
253	2502	00:00:00:00:00:00	Room 2502 Premiere Lantai 5	1	\N	id	253	0	\N	172.10.5.18
272	2524	00:00:00:00:00:00	Room 2524 Premiere Lantai 5	1	\N	en	272	0	\N	172.10.5.37
312	1507B	00:00:00:00:00:00	Room 1507B Premiere Lantai 5	1	\N	en	311	0	\N	172.10.5.77
327	3508	00:00:00:00:00:00	Room 3508 Premiere Lantai 5	1	\N	en	327	0	\N	172.10.5.92
256	2506	00:00:00:00:00:00	Room 2506 Premiere Lantai 5	1	\N	en	256	0	\N	172.10.5.21
294	1519	00:00:00:00:00:00	Room 1519 Premiere Lantai 5	1	\N	en	294	0	\N	172.10.5.59
653	3153A	00:00:00:00:00:00	3153A	1		en	583	0	\N	172.10.6.67
320	1501	00:00:00:00:00:00	Room 1501 Premiere Lantai 5	1	\N	en	320	0	\N	172.10.5.85
282	2534	00:00:00:00:00:00	Room 2534 Premiere Lantai 5	1	\N	en	282	0	\N	172.10.5.47
325	3506	00:00:00:00:00:00	Room 3506 Premiere Lantai 5	1	\N	id	325	0	\N	172.10.5.90
330	3511	00:00:00:00:00:00	Room 3511 Premiere Lantai 5	1	\N	en	330	0	\N	172.10.5.95
318	1503	00:00:00:00:00:00	Room 1503 Premiere Lantai 5	1	\N	id	318	0	\N	172.10.5.83
300	1515B	00:00:00:00:00:00	Room 1515B Premiere Lantai 5	1	\N	en	299	0	\N	172.10.5.65
263	2515	00:00:00:00:00:00	Room 2515 Premiere Lantai 5	1	\N	en	263	0	\N	172.10.5.28
296	1517	00:00:00:00:00:00	Room 1517 Premiere Lantai 5	1	\N	en	296	0	\N	172.10.5.61
319	1502	00:00:00:00:00:00	Room 1502 Premiere Lantai 5	1	\N	id	319	0	\N	172.10.5.84
297	1516A	00:00:00:00:00:00	Room 1516A Premiere Lantai 5	1	\N	en	297	0	\N	172.10.5.62
292	1521	00:00:00:00:00:00	Room 1521 Premiere Lantai 5	1	\N	en	292	0	\N	172.10.5.57
302	1512B	00:00:00:00:00:00	Room 1512B Premiere Lantai 5	1	\N	id	301	0	\N	172.10.5.67
310	1508	00:00:00:00:00:00	Room 1508 Premiere Lantai 5	1	\N	en	310	0	\N	172.10.5.75
264	2516	00:00:00:00:00:00	Room 2516 Premiere Lantai 5	1	\N	en	264	0	\N	172.10.5.29
199	2340	00:00:00:00:00:00	Room 2340 Premiere Lantai 3	1	\N	en	199	0	\N	172.10.4.218
308	1509B	00:00:00:00:00:00	Room 1509B Premiere Lantai 5	1	\N	en	307	0	\N	172.10.5.73
255	2505	00:00:00:00:00:00	Room 2505 Premiere Lantai 5	1	\N	en	255	0	\N	172.10.5.20
198	2339	00:00:00:00:00:00	Room 2339 Premiere Lantai 3	1	\N	en	198	0	\N	172.10.4.217
257	2507	00:00:00:00:00:00	Room 2507 Premiere Lantai 5	1	\N	id	257	0	\N	172.10.5.22
278	2530	00:00:00:00:00:00	Room 2530 Premiere Lantai 5	1	\N	en	278	0	\N	172.10.5.43
258	2508	00:00:00:00:00:00	Room 2508 Premiere Lantai 5	1	\N	en	258	0	\N	172.10.5.23
313	1507C	00:00:00:00:00:00	Room 1507C Premiere Lantai 5	1	\N	en	311	0	\N	172.10.5.78
275	2527	00:00:00:00:00:00	Room 2527 Premiere Lantai 5	1	\N	id	275	0	\N	172.10.5.40
303	1511A	00:00:00:00:00:00	Room 1511A Premiere Lantai 5	1	\N	cn	303	0	\N	172.10.5.68
305	1510A	00:00:00:00:00:00	Room 1510A Premiere Lantai 5	1	\N	id	305	0	\N	172.10.5.70
266	2518	00:00:00:00:00:00	Room 2518 Premiere Lantai 5	1	\N	en	266	0	\N	172.10.5.31
265	2517	00:00:00:00:00:00	Room 2517 Premiere Lantai 5	1	\N	id	265	0	\N	172.10.5.30
301	`1512A	00:00:00:00:00:00	Room `1512A Premiere Lantai 5	1	\N	en	301	0	\N	172.10.5.66
279	2531	00:00:00:00:00:00	Room 2531 Premiere Lantai 5	1	\N	en	279	0	\N	172.10.5.44
326	3507	00:00:00:00:00:00	Room 3507 Premiere Lantai 5	1	\N	en	326	0	\N	172.10.5.91
295	1518	00:00:00:00:00:00	Room 1518 Premiere Lantai 5	1	\N	id	295	0	\N	172.10.5.60
281	2533	00:00:00:00:00:00	Room 2533 Premiere Lantai 5	1	\N	en	281	0	\N	172.10.5.46
196	2337	00:00:00:00:00:00	Room 2337 Premiere Lantai 3	1	\N	en	196	0	\N	172.10.4.215
604	pcIT	00:00:00:00:00:00	pcIT	1		en	0	0	\N	172.10.4.12
342	3525	00:00:00:00:00:00	Room 3525 Premiere Lantai 5	1	\N	en	342	0	\N	172.10.5.107
270	2522	00:00:00:00:00:00	Room 2522 Premiere Lantai 5	1	\N	en	270	0	\N	172.10.5.35
366	6124	00:00:00:00:00:00	Room 6124 Deluxe Lantai 1	1	\N	en	366	0	\N	172.10.5.131
362	6120	00:00:00:00:00:00	Room 6120 Deluxe Lantai 1	1	\N	en	362	0	\N	172.10.5.127
654	3153B	00:00:00:00:00:00	3153B	1		en	583	0	\N	172.10.6.68
381	5118	00:00:00:00:00:00	Room 5118 Deluxe Lantai 1	1	\N	en	381	0	\N	172.10.5.146
384	5121	00:00:00:00:00:00	Room 5121 Deluxe Lantai 1	1	\N	en	384	0	\N	172.10.5.149
333	3516	00:00:00:00:00:00	Room 3516 Premiere Lantai 5	1	\N	en	333	0	\N	172.10.5.98
345	3528	00:00:00:00:00:00	Room 3528 Premiere Lantai 5	1	\N	id	345	0	\N	172.10.5.110
340	3523	00:00:00:00:00:00	Room 3523 Premiere Lantai 5	1	\N	en	340	0	\N	172.10.5.105
356	6112	00:00:00:00:00:00	Room 6112 Deluxe Lantai 1	1	\N	en	356	0	\N	172.10.5.121
337	3520	00:00:00:00:00:00	Room 3520 Premiere Lantai 5	1	\N	en	337	0	\N	172.10.5.102
341	3524	00:00:00:00:00:00	Room 3524 Premiere Lantai 5	1	\N	id	341	0	\N	172.10.5.106
386	6201	00:00:00:00:00:00	Room 6201 Deluxe Lantai 2	1	\N	en	386	0	\N	172.10.5.151
369	5103	00:00:00:00:00:00	Room 5103 Deluxe Lantai 1	1	\N	cn	369	0	\N	172.10.5.134
379	5116	00:00:00:00:00:00	Room 5116 Deluxe Lantai 1	1	\N	en	379	0	\N	172.10.5.144
360	6118	00:00:00:00:00:00	Room 6118 Deluxe Lantai 1	1	\N	en	360	0	\N	172.10.5.125
339	3522	00:00:00:00:00:00	Room 3522 Premiere Lantai 5	1	\N	en	339	0	\N	172.10.5.104
277	2529	00:00:00:00:00:00	Room 2529 Premiere Lantai 5	1	\N	id	277	0	\N	172.10.5.42
354	6110	00:00:00:00:00:00	Room 6110 Deluxe Lantai 1	1	\N	en	354	0	\N	172.10.5.119
268	2520	00:00:00:00:00:00	Room 2520 Premiere Lantai 5	1	\N	id	268	0	\N	172.10.5.33
336	3519	00:00:00:00:00:00	Room 3519 Premiere Lantai 5	1	\N	en	336	0	\N	172.10.5.101
376	5111	00:00:00:00:00:00	Room 5111 Deluxe Lantai 1	1	\N	en	376	0	\N	172.10.5.141
387	6202	00:00:00:00:00:00	Room 6202 Deluxe Lantai 2	1	\N	en	387	0	\N	172.10.5.152
363	6121	00:00:00:00:00:00	Room 6121 Deluxe Lantai 1	1	\N	en	363	0	\N	172.10.5.128
358	6116	00:00:00:00:00:00	Room 6116 Deluxe Lantai 1	1	\N	en	358	0	\N	172.10.5.123
346	6101	00:00:00:00:00:00	Room 6101 Deluxe Lantai 1	1	\N	en	346	0	\N	172.10.5.111
374	5109	00:00:00:00:00:00	Room 5109 Deluxe Lantai 1	1	\N	en	374	0	\N	172.10.5.139
349	6105	00:00:00:00:00:00	Room 6105 Deluxe Lantai 1	1	\N	en	349	0	\N	172.10.5.114
371	5106	00:00:00:00:00:00	Room 5106 Deluxe Lantai 1	1	\N	en	371	0	\N	172.10.5.136
352	6108	00:00:00:00:00:00	Room 6108 Deluxe Lantai 1	1	\N	en	352	0	\N	172.10.5.117
375	5110	00:00:00:00:00:00	Room 5110 Deluxe Lantai 1	1	\N	en	375	0	\N	172.10.5.140
365	6123	00:00:00:00:00:00	Room 6123 Deluxe Lantai 1	1	\N	en	365	0	\N	172.10.5.130
351	6107	00:00:00:00:00:00	Room 6107 Deluxe Lantai 1	1	\N	en	351	0	\N	172.10.5.116
289	2541	00:00:00:00:00:00	Room 2541 Premiere Lantai 5	1	\N	en	289	0	\N	172.10.5.54
672	3131	00:00:00:00:00:00	3131	1		id	593	0	\N	172.10.6.25
262	2512	00:00:00:00:00:00	Room 2512 Premiere Lantai 5	1	\N	kr	262	0	\N	172.10.5.27
383	5120	00:00:00:00:00:00	Room 5120 Deluxe Lantai 1	1	\N	en	383	0	\N	172.10.5.148
269	2521	00:00:00:00:00:00	Room 2521 Premiere Lantai 5	1	\N	en	269	0	\N	172.10.5.34
373	5108	00:00:00:00:00:00	Room 5108 Deluxe Lantai 1	1	\N	en	373	0	\N	172.10.5.138
355	6111	00:00:00:00:00:00	Room 6111 Deluxe Lantai 1	1	\N	en	355	0	\N	172.10.5.120
372	5107	00:00:00:00:00:00	Room 5107 Deluxe Lantai 1	1	\N	en	372	0	\N	172.10.5.137
361	6119	00:00:00:00:00:00	Room 6119 Deluxe Lantai 1	1	\N	en	361	0	\N	172.10.5.126
286	2538	00:00:00:00:00:00	Room 2538 Premiere Lantai 5	1	\N	id	286	0	\N	172.10.5.51
368	5102	00:00:00:00:00:00	Room 5102 Deluxe Lantai 1	1	\N	en	368	0	\N	172.10.5.133
350	6106	00:00:00:00:00:00	Room 6106 Deluxe Lantai 1	1	\N	en	350	0	\N	172.10.5.115
353	6109	00:00:00:00:00:00	Room 6109 Deluxe Lantai 1	1	\N	en	353	0	\N	172.10.5.118
388	6203	00:00:00:00:00:00	Room 6203 Deluxe Lantai 2	1	\N	en	388	0	\N	172.10.5.153
334	3517	00:00:00:00:00:00	Room 3517 Premiere Lantai 5	1	\N	en	334	0	\N	172.10.5.99
348	6103	00:00:00:00:00:00	Room 6103 Deluxe Lantai 1	1	\N	en	348	0	\N	172.10.5.113
343	3526	00:00:00:00:00:00	Room 3526 Premiere Lantai 5	1	\N	en	343	0	\N	172.10.5.108
287	2539	00:00:00:00:00:00	Room 2539 Premiere Lantai 5	1	\N	id	287	0	\N	172.10.5.52
377	5112	00:00:00:00:00:00	Room 5112 Deluxe Lantai 1	1	\N	en	377	0	\N	172.10.5.142
382	5119	00:00:00:00:00:00	Room 5119 Deluxe Lantai 1	1	\N	en	382	0	\N	172.10.5.147
364	6122	00:00:00:00:00:00	Room 6122 Deluxe Lantai 1	1	\N	en	364	0	\N	172.10.5.129
357	6115	00:00:00:00:00:00	Room 6115 Deluxe Lantai 1	1	\N	en	357	0	\N	172.10.5.122
283	2535	00:00:00:00:00:00	Room 2535 Premiere Lantai 5	1	\N	en	283	0	\N	172.10.5.48
338	3521	00:00:00:00:00:00	Room 3521 Premiere Lantai 5	1	\N	cn	338	0	\N	172.10.5.103
335	3518	00:00:00:00:00:00	Room 3518 Premiere Lantai 5	1	\N	en	335	0	\N	172.10.5.100
359	6117	00:00:00:00:00:00	Room 6117 Deluxe Lantai 1	1	\N	en	359	0	\N	172.10.5.124
344	3527	00:00:00:00:00:00	Room 3527 Premiere Lantai 5	1	\N	en	344	0	\N	172.10.5.109
589	Spare 40	00:00:00:00:00:00	Spare 40 pengganti 3101	1		en	0	0	\N	172.10.6.100
535	Meeting Room Celagi I	00:00:00:00:00:00	Meeting Room Celagi I	1		en	535	0	\N	172.10.6.46
537	Meeting Room 2 C	00:00:00:00:00:00	Meeting Room Cepaka	1		en	537	0	\N	172.10.6.48
543	Meeting Room 3 C	00:00:00:00:00:00	Meeting Room 3 C	1	\N	en	543	0	\N	172.10.6.54
276	2528	00:00:00:00:00:00	Room 2528 Premiere Lantai 5	1	\N	en	276	0	\N	172.10.5.41
536	Meeting Room 2 B	00:00:00:00:00:00	Meeting Room Cempaka	1		en	536	0	\N	172.10.6.47
544	Meeting Room 3 D	00:00:00:00:00:00	Meeting Room 3 D	1	\N	en	544	0	\N	172.10.6.55
192	2333	00:00:00:00:00:00	Room 2333 Premiere Lantai 3	1	\N	cn	192	0	\N	172.10.4.211
288	2540	00:00:00:00:00:00	Room 2540 Premiere Lantai 5	1	\N	id	288	0	\N	172.10.5.53
59	3120	00:00:00:00:00:00	Room 3120 Premiere Lantai 1	1	\N	en	59	0	\N	172.10.4.78
367	5101	00:00:00:00:00:00	Room 5101 Deluxe Lantai 1	1	\N	en	367	0	\N	172.10.5.132
53	3112	00:00:00:00:00:00	Room 3112 Premiere Lantai 1	1	\N	en	53	0	\N	172.10.4.72
9	2110	00:00:00:00:00:00	Room 2110 Premiere Lantai 1	1	\N	en	9	0	\N	172.10.4.28
532	Meeting Room 1 D	00:00:00:00:00:00	Meeting Room 1 D	1	\N	en	532	0	\N	172.10.6.43
533	Meeting Room 1 E	00:00:00:00:00:00	Meeting Room 1 E	1	\N	en	533	0	\N	172.10.6.44
534	Meeting Room 1 F	00:00:00:00:00:00	Meeting Room 1 F	1	\N	en	534	0	\N	172.10.6.45
538	Meeting Room 2 D	00:00:00:00:00:00	Meeting Room 2 D	1	\N	en	538	0	\N	172.10.6.49
539	Meeting Room 2 E	00:00:00:00:00:00	Meeting Room 2 E	1	\N	en	539	0	\N	172.10.6.50
540	Meeting Room 2 F	00:00:00:00:00:00	Meeting Room 2 F	1	\N	en	540	0	\N	172.10.6.51
545	Meeting Room 3 E	00:00:00:00:00:00	Meeting Room 3 E	1	\N	en	545	0	\N	172.10.6.56
546	Meeting Room 3 F	00:00:00:00:00:00	Meeting Room 3 F	1	\N	en	546	0	\N	172.10.6.57
547	Meeting Room 3 G	00:00:00:00:00:00	Meeting Room 3 G	1	\N	en	547	0	\N	172.10.6.58
548	Meeting Room 3 H	00:00:00:00:00:00	Meeting Room 3 H	1	\N	en	548	0	\N	172.10.6.59
549	Bussines Center	00:00:00:00:00:00	Bussines Center	1	\N	en	549	0	\N	172.10.6.60
603	Meeting Room 3 A	00:00:00:00:00:00	Meeting Room 3 A	1		en	541	0	\N	172.10.6.52
49	3108	00:00:00:00:00:00	Room 3108 Premiere Lantai 1	1	\N	en	49	0	\N	172.10.4.68
674	2143	00:00:00:00:00:00	2143	1		en	595	0	\N	172.10.6.17
67	3128	00:00:00:00:00:00	Room 3128 Premiere Lantai 1	1	\N	id	67	0	\N	172.10.4.86
2	2102	00:00:00:00:00:00	Room 2102 Premiere Lantai 1	1	\N	id	2	0	\N	172.10.4.21
550	2211	00:00:00:00:00:00	Room 2211 Premiere Lantai 2	1	\N	en	81	0	\N	172.10.4.100
646	3233	00:00:00:00:00:00	3233	1		en	556	0	\N	172.10.6.27
200	2341	00:00:00:00:00:00	Room 2341 Premiere Lantai 3	1	\N	en	200	0	\N	172.10.4.219
657	3155A	00:00:00:00:00:00	3155A	1		en	585	0	\N	172.10.6.71
64	3125	00:00:00:00:00:00	Room 3125 Premiere Lantai 1	1	\N	en	64	0	\N	172.10.4.83
675	2145	00:00:00:00:00:00	2145	1		en	596	0	\N	172.10.6.18
63	3124	00:00:00:00:00:00	Room 3124 Premiere Lantai 1	1	\N	id	63	0	\N	172.10.4.82
15	2118	00:00:00:00:00:00	Room 2118 Premiere Lantai 1	1	\N	en	15	0	\N	172.10.4.34
54	3115	00:00:00:00:00:00	Room 3115 Premiere Lantai 1	1	\N	id	54	0	\N	172.10.4.73
61	3122	00:00:00:00:00:00	Room 3122 Premiere Lantai 1	1	\N	id	61	0	\N	172.10.4.80
48	3107	00:00:00:00:00:00	Room 3107 Premiere Lantai 1	1	\N	id	48	0	\N	172.10.4.67
66	3127	00:00:00:00:00:00	Room 3127 Premiere Lantai 1	1	\N	id	66	0	\N	172.10.4.85
3	2103	00:00:00:00:00:00	Room 2103 Premiere Lantai 1	1	\N	cn	3	0	\N	172.10.4.22
99	2231	00:00:00:00:00:00	Room 2231 Premiere Lantai 2	1	\N	cn	99	0	\N	172.10.4.118
13	2116	00:00:00:00:00:00	Room 2116 Premiere Lantai 1	1	\N	en	13	0	\N	172.10.4.32
51	3110	00:00:00:00:00:00	Room 3110 Premiere Lantai 1	1	\N	en	51	0	\N	172.10.4.70
581	Spare 32	00:00:00:00:00:00	Spare 32	1	\N	en	550	0	\N	172.10.6.92
591	Spare 42	00:00:00:00:00:00	Spare 42	1	\N	en	550	0	\N	172.10.6.102
31	2134	00:00:00:00:00:00	Room 2134 Premiere Lantai 1	1	\N	cn	31	0	\N	172.10.4.50
658	3155B	00:00:00:00:00:00	3155B	1		en	585	0	\N	172.10.6.72
11	2112	00:00:00:00:00:00	Room 2112 Premiere Lantai 1	1	\N	en	11	0	\N	172.10.4.30
6	2107	00:00:00:00:00:00	Room 2107 Premiere Lantai 1	1	\N	id	6	0	\N	172.10.4.25
30	2133	00:00:00:00:00:00	Room 2133 Premiere Lantai 1	1		id	30	0	\N	172.10.4.49
22	2125	00:00:00:00:00:00	Room 2125 Premiere Lantai 1	1	\N	en	22	0	\N	172.10.4.41
60	3121	00:00:00:00:00:00	Room 3121 Premiere Lantai 1	1	\N	id	60	0	\N	172.10.4.79
55	3116	00:00:00:00:00:00	Room 3116 Premiere Lantai 1	1	\N	en	55	0	\N	172.10.4.74
65	3126	00:00:00:00:00:00	Room 3126 Premiere Lantai 1	1	\N	id	65	0	\N	172.10.4.84
676	2243	00:00:00:00:00:00	2243	1		id	597	0	\N	172.10.6.19
582	Spare 33	00:00:00:00:00:00	Spare 33	1	\N	en	550	0	\N	172.10.6.93
583	Spare 34	00:00:00:00:00:00	Spare 34	1	\N	en	550	0	\N	172.10.6.94
584	Spare 35	00:00:00:00:00:00	Spare 35	1	\N	en	550	0	\N	172.10.6.95
585	Spare 36	00:00:00:00:00:00	Spare 36	1	\N	en	550	0	\N	172.10.6.96
586	Spare 37	00:00:00:00:00:00	Spare 37	1	\N	en	550	0	\N	172.10.6.97
587	Spare 38	00:00:00:00:00:00	Spare 38	1	\N	en	550	0	\N	172.10.6.98
593	Spare 44	00:00:00:00:00:00	Spare 44	1	\N	en	550	0	\N	172.10.6.104
594	Spare 45	00:00:00:00:00:00	Spare 45	1	\N	en	550	0	\N	172.10.6.105
28	2131	00:00:00:00:00:00	Room 2131 Premiere Lantai 1	1	\N	en	28	0	\N	172.10.4.47
595	Spare 46	00:00:00:00:00:00	Spare 46	1	\N	en	550	0	\N	172.10.6.106
596	Spare 47	00:00:00:00:00:00	Spare 47	1	\N	en	550	0	\N	172.10.6.107
601	Meeting Room 3 B	00:00:00:00:00:00	Meeting Room 3 B	1		en	542	0	\N	172.10.6.53
659	3154A	00:00:00:00:00:00	3154A	1		en	586	0	\N	172.10.6.69
677	2245	00:00:00:00:00:00	2245	1		en	598	0	\N	172.10.6.20
129	1206	00:00:00:00:00:00	Room 1206 Premiere Lantai 2	1	\N	en	129	0	\N	172.10.4.148
130	1205	00:00:00:00:00:00	Room 1205 Premiere Lantai 2	1	\N	en	130	0	\N	172.10.4.149
660	3154B	00:00:00:00:00:00	3154B	1		en	586	0	\N	172.10.6.70
202	1320	00:00:00:00:00:00	Room 1320 Premiere Lantai 3	1	\N	id	202	0	\N	172.10.4.221
661	3156A	00:00:00:00:00:00		1		en	587	0	\N	172.10.6.73
245	3322	00:00:00:00:00:00	Room 3322 Premiere Lantai 3	1	\N	id	245	0	\N	172.10.5.10
244	3321	00:00:00:00:00:00	Room 3321 Premiere Lantai 3	1	\N	en	244	0	\N	172.10.5.9
662	3156B	00:00:00:00:00:00		1		en	587	0	\N	172.10.6.74
331	3512	00:00:00:00:00:00	Room 3512 Premiere Lantai 5	1	\N	en	331	0	\N	172.10.5.96
410	5205	00:00:00:00:00:00	Room 5205 Deluxe Lantai 2	1	\N	en	410	0	\N	172.10.5.175
406	6224	00:00:00:00:00:00	Room 6224 Deluxe Lantai 2	1	\N	en	406	0	\N	172.10.5.171
665	3158A	00:00:00:00:00:00	3158A	1		id	589	0	\N	172.10.6.77
400	6218	00:00:00:00:00:00	Room 6218 Deluxe Lantai 2	1	\N	en	400	0	\N	172.10.5.165
395	6211	00:00:00:00:00:00	Room 6211 Deluxe Lantai 2	1	\N	en	395	0	\N	172.10.5.160
396	6212	00:00:00:00:00:00	Room 6212 Deluxe Lantai 2	1	\N	en	396	0	\N	172.10.5.161
401	6219	00:00:00:00:00:00	Room 6219 Deluxe Lantai 2	1	\N	en	401	0	\N	172.10.5.166
409	5203	00:00:00:00:00:00	Room 5203 Deluxe Lantai 2	1	\N	en	409	0	\N	172.10.5.174
412	5207	00:00:00:00:00:00	Room 5207 Deluxe Lantai 2	1	\N	en	412	0	\N	172.10.5.177
398	6216	00:00:00:00:00:00	Room 6216 Deluxe Lantai 2	1	\N	en	398	0	\N	172.10.5.163
389	6205	00:00:00:00:00:00	Room 6205 Deluxe Lantai 2	1	\N	en	389	0	\N	172.10.5.154
397	6215	00:00:00:00:00:00	Room 6215 Deluxe Lantai 2	1	\N	en	397	0	\N	172.10.5.162
394	6210	00:00:00:00:00:00	Room 6210 Deluxe Lantai 2	1	\N	en	394	0	\N	172.10.5.159
399	6217	00:00:00:00:00:00	Room 6217 Deluxe Lantai 2	1	\N	en	399	0	\N	172.10.5.164
391	6207	00:00:00:00:00:00	Room 6207 Deluxe Lantai 2	1	\N	en	391	0	\N	172.10.5.156
393	6209	00:00:00:00:00:00	Room 6209 Deluxe Lantai 2	1	\N	cn	393	0	\N	172.10.5.158
403	6221	00:00:00:00:00:00	Room 6221 Deluxe Lantai 2	1	\N	en	403	0	\N	172.10.5.168
411	5206	00:00:00:00:00:00	Room 5206 Deluxe Lantai 2	1	\N	en	411	0	\N	172.10.5.176
408	5202	00:00:00:00:00:00	Room 5202 Deluxe Lantai 2	1	\N	en	408	0	\N	172.10.5.173
405	6223	00:00:00:00:00:00	Room 6223 Deluxe Lantai 2	1	\N	en	405	0	\N	172.10.5.170
404	6222	00:00:00:00:00:00	Room 6222 Deluxe Lantai 2	1	\N	en	404	0	\N	172.10.5.169
390	6206	00:00:00:00:00:00	Room 6206 Deluxe Lantai 2	1	\N	en	390	0	\N	172.10.5.155
510	3133 A	00:00:00:00:00:00	3133 A	1		en	510	0	\N	172.10.6.21
512	3133 A1	00:00:00:00:00:00	3133 A1	1		en	510	0	\N	172.10.6.23
511	3133 B	00:00:00:00:00:00	3133 B	1		en	510	0	\N	172.10.6.22
392	6208	00:00:00:00:00:00	Room 6208 Deluxe Lantai 2	1	\N	en	392	0	\N	172.10.5.157
407	5201	00:00:00:00:00:00	Room 5201 Deluxe Lantai 2	1	\N	en	407	0	\N	172.10.5.172
402	6220	00:00:00:00:00:00	Room 6220 Deluxe Lantai 2	1	\N	en	402	0	\N	172.10.5.167
576	Spare 27	00:00:00:00:00:00	Spare 27	1	\N	en	550	0	\N	172.10.6.87
577	Spare 28	00:00:00:00:00:00	Spare 28	1	\N	en	550	0	\N	172.10.6.88
578	Spare 29	00:00:00:00:00:00	Spare 29	1	\N	en	550	0	\N	172.10.6.89
579	Spare 30	00:00:00:00:00:00	Spare 30	1	\N	en	550	0	\N	172.10.6.90
580	Spare 31	00:00:00:00:00:00	Spare 31	1	\N	en	550	0	\N	172.10.6.91
571	Gym 2	00:00:00:00:00:00	Gym 2	1		en	571	0	\N	172.10.6.82
519	Early Breakfast	00:00:00:00:00:00	Early Breakfast	1	\N	en	519	0	\N	172.10.6.30
526	Kunyit Resto A	00:00:00:00:00:00	Kunyit Resto A	1	\N	en	526	0	\N	172.10.6.37
527	Kunyit Resto B	00:00:00:00:00:00	Kunyit Resto B	1	\N	en	527	0	\N	172.10.6.38
528	Kunyit Resto C	00:00:00:00:00:00	Kunyit Resto C	1	\N	en	528	0	\N	172.10.6.39
522	Ballroom C	00:00:00:00:00:00	Ballroom C	1	\N	en	522	0	\N	172.10.6.33
517	3234	00:00:00:00:00:00	3234	1		id	579	0	\N	172.10.6.28
666	3158B	00:00:00:00:00:00	3158B	1		id	589	0	\N	172.10.6.78
8	2109	00:00:00:00:00:00	Room 2109 Premiere Lantai 1	1	\N	id	8	0	\N	172.10.4.27
531	Meeting Room 1 C	00:00:00:00:00:00	Meeting Room 1 C	1	\N	en	531	0	\N	172.10.6.42
572	Gym 3	00:00:00:00:00:00	Gym 3	1		id	571	0	\N	172.10.6.83
259	2509	00:00:00:00:00:00	Room 2509 Premiere Lantai 5	1	\N	en	259	0	\N	172.10.5.24
274	2526	00:00:00:00:00:00	Room 2526 Premiere Lantai 5	1	\N	en	274	0	\N	172.10.5.39
518	Departure Lounge	00:00:00:00:00:00	Departure Lounge	1	\N	en	518	0	\N	172.10.6.29
520	Ballroom A	00:00:00:00:00:00	Ballroom A	1	\N	en	520	0	\N	172.10.6.31
525	Meeting Room lt 2 Celagi 6	00:00:00:00:00:00	Meeting Room lt 2 Celagi 6\n//Ballroom F	1		en	525	0	\N	172.10.6.36
509	GM Macbook	00:00:00:00:00:00	GM Macbook	1		en	72	0	\N	10.201.59.235
504	5521	00:00:00:00:00:00	Room 5521 Deluxe Lantai 5	1	\N	en	504	0	\N	172.10.6.15
530	Meeting Room 1 B	00:00:00:00:00:00	pucuk	1		en	530	0	\N	172.10.6.41
602	Senlei19	00:00:00:00:00:00	Senlei19	1		id	530	0	\N	172.10.4.17
185	2326	00:00:00:00:00:00	Room 2326 Premiere Lantai 3	1	\N	en	185	0	\N	172.10.4.204
521	Meeting Room lt 2 Celagi 4	00:00:00:00:00:00	Meeting Room lt 2 Celagi 4\n//Ballroom B	1		en	521	0	\N	172.10.6.32
523	Meeting Room lt 2 Celagi 5	00:00:00:00:00:00	Meeting Room lt 2 Celagi 5\n//Ballroom D	1		en	523	0	\N	172.10.6.34
505	5522	00:00:00:00:00:00	Room 5522 Deluxe Lantai 5	1	\N	en	505	0	\N	172.10.6.16
524	Ballroom E	00:00:00:00:00:00	Ballroom E	1	\N	en	524	0	\N	172.10.6.35
570	Gym 1	00:00:00:00:00:00	Gym 1	1		en	571	0	\N	172.10.6.81
110	2242	00:00:00:00:00:00	Room 2242 Premiere Lantai 2	1	\N	id	110	0	\N	172.10.4.129
267	2519	00:00:00:00:00:00	Room 2519 Premiere Lantai 5	1	\N	en	267	0	\N	172.10.5.32
513	3133 B1	00:00:00:00:00:00	3133 B1	1		en	510	0	\N	172.10.6.24
569	Spare 20	00:00:00:00:00:00	Spare 20	1	\N	en	550	0	\N	172.10.6.80
573	Spare 24	00:00:00:00:00:00	Spare 24	1	\N	en	550	0	\N	172.10.6.84
529	Meeting Room 1 A	00:00:00:00:00:00	Jepun	1		en	529	0	\N	172.10.6.40
575	Spare 26	00:00:00:00:00:00	Spare 26	1	\N	en	550	0	\N	172.10.6.86
\.


--
-- Name: nodes_node_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('nodes_node_id_seq', 677, true);


--
-- Data for Name: occupancy_daily; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY occupancy_daily (occupancy_daily_id, occupancy_daily_date, occupancy_daily_totalroom, occupancy_daily_nonpaying, occupancy_daily_time, occupancy_daily_code) FROM stdin;
\.


--
-- Name: occupancy_daily_occupancy_daily_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('occupancy_daily_occupancy_daily_id_seq', 3, true);


--
-- Data for Name: occupancy_detail; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY occupancy_detail (occupancy_detail_id, occupancy_detail_room, occupancy_detail_guestname, occupancy_detail_nonpaying, occupancy_detail_date, occupancy_detail_time) FROM stdin;
\.


--
-- Name: occupancy_detail_occupancy_detail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('occupancy_detail_occupancy_detail_id_seq', 1, true);


--
-- Data for Name: outlet_indirect_buffer; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY outlet_indirect_buffer (outlet_indirect_buffer_id, guest_reservation_id, guest_order_roomname, guest_order_guestname, guest_order_received, guest_order_received_date, guest_order_approved, guest_order_type, guest_order_code, guest_order_item, guest_order_price, guest_order_qty, guest_order_note, guest_order_time, guest_order_equip) FROM stdin;
8	19	A101	Navicom Indonesia	0	1429054381	0	S	S004	Refreshing Body Treatment	245000	2		1429142400	Nyoman Masayu
9	19	A101	Navicom Indonesia	0	1429054441	0	S	S002	Sport Massage	175000	2		1429135200	Nyoman Masayu
10	19	A101	Ta-ke Maruyama	1	1429061339	1	T	F02005	Navicom Besakih Tour	500000	2	on time	1429164000	Alphard
11	19	A101	Ta-ke Maruyama	0	1429061419	0	S	S004	Refreshing Body Treatment	245000	1		1429153200	Nyoman Masayu
12	19	A101	Ta-ke Maruyama	1	1429065062	1	T	F0001	Navicom Kintamani Tour	300000	2	9hqpfe	1429074000	Alphard
13	19	A101	Ta-ke Maruyama	0	1429065254	0	S	S002	Sport Massage	175000	2	9pg	1429178400	Nyoman Masayu
14	19	A101	Ta-ke Maruyama	0	1429067511	0	S	S006	Business Spa Package	330000	5	tambah lulur	1429369200	Nyoman Masayu
15	19	A101	Navicom Indonesia	0	1430983779	0	S	S001	Traditional Massage	175000	2		1431086400	Nyoman Masayu
16	19	A101	Navicom Indonesia	0	1430983934	0	T	F0001	Navicom Kintamani Tour	300000	10		1431046800	Bus
\.


--
-- Name: outlet_indirect_buffer_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('outlet_indirect_buffer_seq', 16, true);


--
-- Data for Name: page_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY page_translations (page_translation_id, page_id, page_translation_title, page_translation_content, language_id) FROM stdin;
7	2	遥控器使用指南	遥控器使用指南&amp;nbsp;遥控器使用指南&amp;nbsp;遥控器使用指南	cn
10	2	Benutzerhandbuch		de
8	2	Remote Control User Guide	asdasdad	en
11	2	Guide de l'utilisateur		fr
9	2	Panduan Pengguna	asdasd	id
12	2	ユーザー·ガイド		jp
13	2	사용 설명서		kr
14	2	Руководство пользовател		ru
49	3			  
48	3	Panduan untuk pengguna Tablet	&lt;span class=&quot;hps&quot;&gt;Tangkap&lt;/span&gt; kode &lt;span class=&quot;hps&quot;&gt;QR&lt;/span&gt; berikut &lt;span class=&quot;hps&quot;&gt;menggunakan&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;Tablet&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;Anda&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;akan&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;diteruskan ke&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;sistem&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;IPTV&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;kami&lt;/span&gt;&lt;span class=&quot;&quot;&gt;.&lt;/span&gt;	id
51	3	Yчебное пособие для планшета пользователь	&lt;span class=&quot;hps&quot;&gt;Захват&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;этого&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;следующий&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;QR-код&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;с помощью&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;планшета.&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;Вы&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;будете перенаправлены&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;к нашей системе&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;IPTV&lt;/span&gt;&lt;span class=&quot;&quot;&gt;.&lt;/span&gt;	ru
50	3			  
24	1			  
20	1			  
25	1			  
29	1			  
21	1			  
22	1			  
23	1			  
38	1			  
58	1			  
26	1			  
33	1			  
34	1			  
27	1			  
28	1			  
52	3			  
30	1			  
31	1			  
39	1			  
32	1			  
40	1			  
35	1			  
42	1			  
43	1			  
36	1			  
37	1			  
45	3	Das Handbuch für Tablet-Nutzer	&lt;span class=&quot;hps&quot;&gt;Nehmen Sie&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;diese&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;folgenden&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;QR Code&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;mit&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;Ihrem Tablet&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;Sie werden zu unserem&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;IPTV-System&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;umzuleiten.&lt;/span&gt;	de
41	1			  
59	1			  
44	3			  
53	3			  
54	3			  
55	1			  
60	1			  
56	1			  
57	1			  
62	1			  
64	1			  
46	3	The Manual for Tablet User	Capture this following QR Code using your tablet. You will redirect to our IPTV system.	en
61	1			  
63	1			  
77	1			  
78	1			  
47	3	Le manuel de l'utilisateur de la tablette	&lt;span class=&quot;hps&quot;&gt;Capturez&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;ce QR Code&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;suivant à l'aide&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;de votre tablette&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;Vous&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;rediriger&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;à notre&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;système IPTV&lt;/span&gt;&lt;span class=&quot;&quot;&gt;.&lt;/span&gt;	fr
65	1			  
66	1			  
67	1			  
73	1			  
68	1			  
69	1			  
70	1			  
71	1			  
72	1			  
74	1			  
75	1			  
76	1			  
79	3			  
80	3			  
81	3			  
82	1			  
83	1			  
84	1			  
88	1			  
85	1			  
86	1			  
87	1			  
89	1			  
90	1			  
91	1			  
92	1			  
93	1			  
94	1			  
95	1			  
96	1			  
97	1			  
98	1			  
99	1			  
100	1			  
101	1			  
102	1			  
103	1			  
104	1			  
105	1			  
106	1			  
158	1			  
171	1			  
159	1			  
178	1			  
160	1			  
164	1			  
165	1			  
166	1			  
179	1			  
167	1			  
188	1			  
16	1	Bienvenue à Watermark Hôtel &amp; Spa	&lt;p id=&quot;gt-src-c&quot; class=&quot;g-unit&quot;&gt;&lt;/p&gt;&lt;p id=&quot;gt-src-p&quot;&gt;&lt;/p&gt;&lt;p class=&quot;&quot; id=&quot;gt-src-wrap&quot;&gt;&lt;/p&gt;&lt;p id=&quot;gt-src-tools&quot;&gt;&lt;/p&gt;&lt;span class=&quot;hps&quot;&gt;Notre personnel&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;se soucient de&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;vos besoins&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;et&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;nous ferons en sorte&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;que votre visite&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;est très&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;agréable et mémorable&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;br&gt;&lt;span class=&quot;hps&quot;&gt;Profitez de votre séjour&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;sur&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;l'île&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;des dieux&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;br&gt;&lt;br&gt;&lt;span class=&quot;hps&quot;&gt;directeur général&lt;/span&gt;&lt;p&gt;&lt;/p&gt;	fr
15	1	Willkommen bei Watermark Hotel &amp; Spa	&lt;p id=&quot;gt-src-c&quot; class=&quot;g-unit&quot;&gt;&lt;/p&gt;&lt;p id=&quot;gt-src-p&quot;&gt;&lt;/p&gt;&lt;p class=&quot;&quot; id=&quot;gt-src-wrap&quot;&gt;&lt;/p&gt;&lt;p id=&quot;gt-src-tools&quot;&gt;&lt;/p&gt;&lt;p id=&quot;gt-src-tools-l&quot;&gt;&lt;/p&gt;&lt;p style=&quot;display: inline-block;&quot; id=&quot;gt-input-tool&quot;&gt;&lt;span class=&quot;hps&quot;&gt;Unsere Mitarbeiter&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;kümmern uns um Ihre&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;Bedürfnisse&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;und wir werden sicherstellen&lt;/span&gt;&lt;span class=&quot;&quot;&gt;, dass Ihr Besuch&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;ist ein sehr angenehmer&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;und unvergesslich&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;br&gt;&lt;span class=&quot;hps&quot;&gt;Genießen Sie Ihren Aufenthalt&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;auf der Insel&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;der Götter&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;br&gt;&lt;br&gt;&lt;span class=&quot;hps&quot;&gt;Hauptgeschäftsführer&lt;/span&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;/p&gt;	de
19	1	Добро пожаловать в Water	&lt;p id=&quot;gt-res-content&quot; class=&quot;almost_half_cell&quot;&gt;&lt;p dir=&quot;ltr&quot; style=&quot;zoom:1&quot;&gt;&lt;span class=&quot;hps&quot;&gt;Наши сотрудники&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;заботятся&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;о ваших потребностях&lt;/span&gt;&lt;span&gt;, и мы гарантируем&lt;/span&gt;&lt;span class=&quot;&quot;&gt;, что Ваш визит&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;является очень&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;приятным и запоминающимся&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;br&gt;&lt;span class=&quot;hps&quot;&gt;Желаем вам приятного отдыха&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;на острове&lt;/span&gt; &lt;span class=&quot;hps&quot;&gt;богов&lt;/span&gt;&lt;span&gt;.&lt;/span&gt; &lt;br&gt;&lt;br&gt;&lt;span class=&quot;hps&quot;&gt;Генеральный директор&lt;/span&gt;&lt;/p&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;	ru
107	1			  
108	1			  
109	1			  
110	1			  
111	1			  
112	1			  
113	1			  
114	1			  
115	1			  
116	1			  
117	1			  
118	1			  
119	1			  
120	1			  
121	1			  
122	1			  
123	1			  
124	1			  
125	1			  
126	1			  
127	1			  
128	1			  
129	1			  
130	1			  
131	1			  
132	1			  
133	1			  
134	1			  
135	1			  
144	1			  
136	1			  
153	1			  
137	1			  
138	1			  
139	1			  
154	1			  
140	1			  
161	1			  
141	1			  
142	1			  
155	1			  
143	1			  
145	1			  
146	1			  
162	1			  
147	1			  
156	1			  
148	1			  
169	1			  
149	1			  
150	1			  
163	1			  
151	1			  
170	1			  
152	1			  
177	1			  
157	1			  
168	1			  
172	1			  
173	1			  
174	1			  
175	1			  
176	1			  
180	1			  
181	1			  
182	1			  
183	1			  
184	1			  
185	1			  
186	1			  
187	1			  
189	1			  
190	1			  
191	1			  
17	1	ウォーターマークホテル＆スパへようこそ	IT는 Anvaya 비치 리조트 - 발리에 오신 것을 환영하는 큰 기쁨이며 우리가 8 월에 우리의 부드러운 개방 기간을 입력하기 전에 우리는 2016 년 &lt;br/&gt; &lt;br/&gt; 목표는 가장 고급스러운되기 위해 우리의 임상 시험에 참여 주셔서 감사합니다 수 있습니다 쿠타의 라이프 스타일 대상은 서비스와 시설에 대한 당신의 의견은 당신이 머무시는이를 달성하는 데 매우 중요하다 동안 경험하게 될 것입니다. 우리는 당신이 Anvaya 리조트 미세 조정으로 우리를 돕기 위해 자신이 사용할 것을 매우 기쁘게 생각한다 -. 쿠타와 우리가 우리의 서비스와 시설에 대한 모든 건설적인 피드백 및 권장 사항에 대한 사전에 감사 할 수 &lt;br/&gt; &lt;br/&gt;하지만 무엇보다도, 우리는 당신이 우리와 함께 즐거운 숙박을 희망한다. &lt;br/&gt; &lt;br/&gt; 최고의 소원은 호텔 경영을 &lt;br/&gt;	jp
4	1	歡迎 Anvaya海灘度假村 - 巴厘島	Dear Valued Guest,&lt;br&gt;&lt;br&gt; \nIt is great pleasure to welcome you and thank you for choosing The ANVAYA Beach Resort Bali, part of Santika Indonesia Hotels and Resorts as your holiday destination in Bali. &lt;br&gt;&lt;br&gt;\nWe invite you to immerse yourself in Bali’s extraordinary cultures represent through the three periods; Bali Aga, Hindu Bali and Bali Modern in our resort, indulge in Sands and Kunyit’s appealing cuisine and relax and feel rejuvenated at Sakanti Spa. &lt;br&gt;&lt;br&gt;\nPlease allow us take this opportunity to reassure you that The ANVAYA Beach Resort Bali team will continue to exceeding your expectation and we will remain at your disposal for any assistance and service you may need. &lt;br&gt;&lt;br&gt;\nWishing you an enjoyable stay with us. &lt;br&gt;\nBest wishes, &lt;br&gt;\nThe Management	cn
192	1			  
193	1			  
194	1			  
200	1			  
198	1			  
195	1			  
205	1			  
196	1			  
203	1			  
201	1			  
197	1			  
213	1			  
199	1			  
208	1			  
225	1			  
206	1			  
202	1			  
204	1			  
214	1			  
223	1			  
215	1			  
207	1			  
209	1			  
210	1			  
227	1			  
211	1			  
212	1			  
216	1			  
229	1			  
217	1			  
218	1			  
224	1			  
219	1			  
220	1			  
221	1			  
222	1			  
5	1	Welcome to The ANVAYA Beach Resort - Bali	Dear Valued Guest,&lt;br&gt;&lt;br&gt; \nIt is great pleasure to welcome you and thank you for choosing The ANVAYA Beach Resort Bali, part of Santika Indonesia Hotels and Resorts as your holiday destination in Bali. &lt;br&gt;&lt;br&gt;\nWe invite you to immerse yourself in Bali’s extraordinary cultures represent through the three periods; Bali Aga, Hindu Bali and Bali Modern in our resort, indulge in Sands and Kunyit’s appealing cuisine and relax and feel rejuvenated at Sakanti Spa. &lt;br&gt;&lt;br&gt;\nPlease allow us take this opportunity to reassure you that The ANVAYA Beach Resort Bali team will continue to exceeding your expectation and we will remain at your disposal for any assistance and service you may need. &lt;br&gt;&lt;br&gt;\nWishing you an enjoyable stay with us. &lt;br&gt;\nBest wishes, &lt;br&gt;\nThe Management	en
226	1			  
228	1			  
233	1			  
235	1			  
230	1			  
231	1			  
6	1	Welcome to The ANVAYA Beach Resort - Bali	Tamu yang terhormat, &lt;br&gt;&lt;br&gt;\nTerima kasih telah memilih The ANVAYA Beach Resort Bali sebagai tempat menginap selama liburan Anda di Bali. &lt;br&gt;&lt;br&gt;\nKami mengajak Anda untuk mengeksplorasi lebih jauh kebudayaan Bali dalam tiga period; Bali Aga, Hindu Bali dan Bali Modern. Nikmati makanan khas Bali &amp; Indonesia serta hidangan Mediterranean &amp; Californian di Kunyit dan Sands Restaurant dan manjakan diri di Sakanti Spa. &lt;br&gt;&lt;br&gt;\nMohon jangan segan menghubungi staff kami jika ada hal-hal yang dapat kami lakukan untuk membuat pengalaman menginap Anda menyenangkan. &lt;br&gt;&lt;br&gt;\n\nHormat kami, &lt;br&gt;&lt;br&gt;\nManajemen	id
232	1			  
234	1			  
237	1			  
236	1			  
238	1			  
239	1			  
240	1			  
241	1			  
242	1			  
243	1			  
244	1			  
245	1			  
246	1			  
247	1			  
18	1	발리 - ANVAYA 비치 리조트에 오신 것을 환영합니다	Dear Valued Guest,&lt;br&gt;&lt;br&gt;숙소를 이용하시는 고객님께,&lt;br&gt;&lt;br&gt;\n고객님을 진심으로 환영하며, 고객님의 발리에서의 휴가를 Santika Indonesia Hotels and Resorts의 일부인 The ANVAYA beach Resort Bali를 선택해 주셔서 감사 드립니다. &lt;br&gt;&lt;br&gt;\n저희는 발리 아가 (Bali Aga), 힌두 발리 (Hindu Bali), 모던 발리 (Modern Bali) 세 가지를 통해 발리의 특별한 문화를 표현하는 저희 Resort에 고객님을 초대하며, Sands와 Kunyit의 매력적인 요리를 즐기며 여유를 가지시기를 바라며, Sakanti Spa에서 활기를 되 찾으시기를 바랍니다. &lt;br&gt;&lt;br&gt;\nThe ANVAYA Beach Resort Bali 팀이 고객님의 기대치를 계속해서 높여드릴 수 있도록 최선을 다할 수 있도록 허락해주시길 바라며, 저희는 고객님이 필요로 하는 도움과 서비스를 제공할 수 있도록 최선을 다할 것입니다. &lt;br&gt;&lt;br&gt;\n\n고객님께서 저희와 함께 즐거운 시간을 보내시기를 바랍니다. &lt;br&gt;&lt;br&gt;\n고객 님의 최고의 선택이 되기를 바랍니다. &lt;br&gt;\nThe Management	kr
\.


--
-- Name: page_translations_page_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('page_translations_page_translation_id_seq', 247, true);


--
-- Data for Name: pages; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY pages (page_id, page_thumbnail, page_clip, page_clip_enabled, page_in_menu, page_enabled, page_allow_ads) FROM stdin;
2			0	1	0	0
3			0	1	1	0
1			0	0	1	1
\.


--
-- Name: pages_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('pages_seq', 3, true);


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY permissions (permission_id, permission_user_id, permission_module_id, permission_value) FROM stdin;
82	1	20	111
83	5	20	000
148	1	34	111
91	5	25	000
89	1	24	111
90	1	25	111
92	1	26	111
59	1	10	111
60	1	11	111
61	1	12	111
86	1	21	111
87	1	22	111
62	1	13	111
63	1	14	111
51	1	2	111
52	1	3	111
80	1	15	000
84	1	19	111
85	1	20	111
53	1	4	111
54	1	5	111
56	1	7	111
93	1	27	111
94	1	28	111
50	1	1	111
55	1	6	111
57	1	8	111
58	1	9	111
78	1	16	111
79	1	17	111
81	1	18	111
88	1	23	111
160	5	45	111
180	5	65	111
181	5	66	111
182	5	67	111
66	5	8	111
103	5	26	111
113	5	33	111
96	5	28	111
172	5	57	111
173	5	58	111
174	5	59	111
177	5	62	111
176	5	61	111
183	5	68	111
150	5	35	111
151	5	36	111
158	5	43	111
220	5	70	111
221	5	71	111
224	5	72	111
225	5	73	111
226	5	74	111
227	5	75	111
228	5	76	111
229	5	77	111
230	5	78	111
231	5	79	111
233	5	81	111
234	5	82	111
235	5	83	111
236	5	84	111
239	5	88	111
64	5	1	111
65	5	6	111
67	5	9	111
97	5	16	111
98	5	17	111
100	5	23	111
102	5	25	111
109	5	29	111
110	5	30	111
111	5	31	111
112	5	32	000
159	5	44	111
168	5	53	111
171	5	56	111
237	5	85	111
101	5	24	111
152	5	37	111
154	5	39	111
161	5	46	111
162	5	47	111
163	5	48	111
164	5	49	111
167	5	52	111
178	5	63	111
179	5	64	111
108	5	20	111
68	5	10	111
69	5	11	111
70	5	12	111
153	5	38	111
155	5	40	111
156	5	41	111
157	5	42	111
170	5	55	111
104	5	21	111
71	5	13	111
72	5	14	111
166	5	51	111
73	5	2	111
74	5	3	111
106	5	15	111
107	5	19	111
75	5	4	111
169	5	54	111
77	5	7	111
192	6	60	000
116	6	33	100
114	6	8	111
189	6	57	000
191	6	59	000
256	7	34	000
194	6	62	000
193	6	61	000
119	6	1	000
195	6	35	000
196	6	36	111
197	6	43	111
223	6	71	111
120	6	6	000
122	6	16	110
123	6	17	000
124	6	18	000
125	6	23	111
127	6	25	110
115	6	26	111
129	6	30	000
131	6	32	000
199	6	44	000
200	6	53	000
175	5	60	111
187	6	66	000
188	6	67	000
118	6	28	111
248	6	80	111
250	6	82	111
251	6	83	111
252	6	84	111
254	6	88	111
130	6	31	110
205	6	46	000
253	6	86	110
140	6	3	000
255	6	85	110
243	6	75	111
244	6	76	111
263	7	33	000
245	6	77	111
246	6	78	111
264	7	27	000
265	7	28	000
266	7	57	000
267	7	58	000
268	7	59	000
269	7	60	000
270	7	61	000
271	7	62	000
272	7	35	000
273	7	36	000
274	7	43	000
292	7	70	000
293	7	71	000
294	7	72	000
295	7	73	000
296	7	74	000
297	7	75	000
298	7	76	000
299	7	77	000
300	7	78	000
301	7	79	000
303	7	81	000
304	7	82	000
305	7	83	000
306	7	84	000
308	7	88	000
276	7	1	000
277	7	6	000
278	7	9	000
279	7	16	000
280	7	17	000
282	7	23	000
283	7	25	000
284	7	29	000
285	7	30	000
286	7	31	000
287	7	32	000
288	7	44	000
289	7	53	000
290	7	56	000
291	7	68	000
309	7	24	000
310	7	37	000
311	7	39	000
312	7	46	000
313	7	47	000
314	7	48	000
315	7	49	000
316	7	52	000
317	7	63	000
318	7	64	000
320	7	85	000
321	7	10	000
322	7	11	000
323	7	12	000
324	7	38	000
325	7	40	000
326	7	41	000
327	7	42	000
328	7	55	000
329	7	21	000
331	7	13	000
332	7	14	000
333	7	51	000
334	7	2	000
335	7	3	000
336	7	15	000
337	7	19	110
338	7	20	000
339	7	54	000
340	7	4	000
342	7	7	000
343	8	34	110
344	8	45	000
345	8	65	000
346	8	66	000
347	8	67	000
348	8	8	000
349	8	26	000
350	8	33	000
351	8	27	110
353	8	57	000
354	8	58	000
355	8	59	000
356	8	60	000
357	8	61	000
358	8	62	000
359	8	35	000
360	8	36	000
361	8	43	000
436	6	92	111
437	6	93	000
441	9	93	000
442	9	34	111
443	9	45	000
444	9	65	000
445	9	66	000
446	9	67	000
447	9	8	000
448	9	26	000
449	9	33	000
450	9	27	000
451	9	28	000
452	9	57	000
453	9	58	000
454	9	59	000
455	9	60	000
456	9	61	000
457	9	62	000
458	9	35	000
459	9	36	000
460	9	43	000
461	9	50	000
462	9	70	000
463	9	71	000
464	9	72	000
465	9	73	000
466	9	74	000
467	9	75	000
468	9	76	000
469	9	77	000
470	9	78	000
471	9	79	000
472	9	80	000
473	9	81	000
474	9	82	000
475	9	83	000
476	9	84	000
477	9	88	000
478	9	91	000
479	9	92	000
480	9	1	000
481	9	6	000
482	9	9	000
483	9	16	000
484	9	17	000
485	9	18	000
486	9	23	000
487	9	25	000
488	9	29	000
489	9	30	000
490	9	31	000
491	9	32	000
492	9	44	000
493	9	53	000
494	9	56	000
495	9	68	000
496	9	86	000
497	9	24	000
498	9	37	000
499	9	39	000
500	9	46	000
501	9	47	000
502	9	48	000
503	9	49	000
504	9	52	000
505	9	63	000
506	9	64	000
507	9	69	000
508	9	85	000
509	9	89	000
510	9	10	000
511	9	11	000
512	9	12	000
513	9	38	000
514	9	40	000
515	9	41	000
516	9	42	000
517	9	55	000
518	9	21	000
519	9	22	000
520	9	13	000
521	9	14	000
522	9	51	000
523	9	2	000
524	9	3	000
525	9	15	000
526	9	19	000
527	9	20	000
528	9	54	000
529	9	90	000
530	9	4	000
531	9	5	000
532	9	7	000
533	5	94	111
534	5	93	000
149	5	34	111
165	5	50	111
232	5	80	111
432	5	91	111
435	5	92	111
535	5	95	111
99	5	18	111
238	5	86	111
184	5	69	111
430	5	89	111
536	5	94	000
105	5	22	111
431	5	90	111
240	6	72	111
247	6	79	111
249	6	81	111
439	6	91	111
440	6	92	000
128	6	29	100
201	6	56	000
126	6	24	000
204	6	39	000
210	6	63	000
213	6	38	000
136	6	22	000
218	6	51	000
143	6	20	110
198	6	50	000
539	10	93	000
540	10	34	000
541	10	45	000
542	10	65	000
543	10	66	000
544	10	67	000
545	10	8	000
546	10	26	000
547	10	33	000
548	10	27	000
549	10	28	000
551	10	58	000
552	10	59	000
553	10	60	000
554	10	61	000
555	10	62	000
556	10	35	110
557	10	36	110
558	10	43	110
559	10	50	110
190	6	58	000
537	6	95	111
438	6	93	000
203	6	37	110
206	6	47	000
207	6	48	000
208	6	49	000
211	6	64	000
212	6	69	000
433	6	89	110
538	6	94	000
132	6	10	000
133	6	11	000
134	6	12	000
214	6	40	000
215	6	41	110
216	6	42	110
135	6	21	000
137	6	13	000
138	6	14	000
139	6	2	000
141	6	15	000
142	6	19	110
145	6	5	000
219	6	54	000
434	6	90	110
146	6	7	000
121	6	9	000
95	5	27	111
117	6	27	111
76	5	5	111
222	6	70	111
550	10	57	000
560	10	70	000
561	10	71	000
562	10	72	000
563	10	73	000
564	10	74	000
565	10	75	000
566	10	76	000
567	10	77	000
568	10	78	000
569	10	79	000
570	10	80	000
571	10	81	000
572	10	82	000
573	10	83	000
574	10	84	000
575	10	88	000
576	10	91	000
577	10	92	000
578	10	95	000
579	10	1	000
580	10	6	000
581	10	9	000
582	10	16	000
583	10	17	000
584	10	18	000
585	10	23	000
586	10	25	000
587	10	29	000
588	10	30	000
589	10	31	000
590	10	32	000
591	10	44	000
592	10	53	000
593	10	56	000
594	10	68	000
595	10	86	000
596	10	24	000
597	10	37	110
598	10	39	110
599	10	46	110
600	10	47	110
601	10	48	110
602	10	49	110
603	10	52	000
604	10	63	000
605	10	64	000
606	10	69	000
607	10	85	000
608	10	89	000
609	10	94	000
610	10	10	000
611	10	11	000
612	10	12	000
613	10	38	110
614	10	40	110
615	10	41	110
616	10	42	110
617	10	55	110
618	10	21	000
619	10	22	000
620	10	13	000
621	10	14	000
622	10	51	110
623	10	2	000
624	10	3	000
625	10	15	000
626	10	19	000
627	10	20	000
628	10	54	000
629	10	90	000
630	10	4	000
631	10	5	000
632	10	7	000
633	11	93	000
634	11	34	110
635	11	45	000
636	11	65	000
637	11	66	000
638	11	67	000
639	11	8	000
640	11	26	000
641	11	33	000
642	11	27	110
643	11	28	110
644	11	57	000
645	11	58	000
646	11	59	000
647	11	60	000
648	11	61	000
649	11	62	000
650	11	35	000
651	11	36	000
652	11	43	000
653	11	50	000
654	11	70	000
655	11	71	000
656	11	72	000
185	6	45	000
242	6	74	111
209	6	52	000
217	6	55	000
144	6	4	000
147	6	34	111
657	11	73	000
658	11	74	000
659	11	75	000
660	11	76	000
661	11	77	000
662	11	78	000
663	11	79	000
664	11	80	000
665	11	81	000
666	11	82	000
667	11	83	000
668	11	84	000
669	11	88	000
670	11	91	000
671	11	92	000
672	11	95	000
673	11	1	000
674	11	6	000
675	11	9	000
676	11	16	000
677	11	17	000
678	11	18	000
679	11	23	000
680	11	25	000
681	11	29	000
682	11	30	000
683	11	31	000
684	11	32	000
685	11	44	000
686	11	53	000
687	11	56	000
688	11	68	000
689	11	86	000
690	11	24	000
691	11	37	000
692	11	39	000
693	11	46	000
694	11	47	000
695	11	48	000
696	11	49	000
697	11	52	000
698	11	63	000
699	11	64	000
700	11	69	000
701	11	85	000
702	11	89	000
703	11	94	000
704	11	10	000
705	11	11	000
706	11	12	000
707	11	38	000
708	11	40	000
709	11	41	000
710	11	42	000
711	11	55	000
712	11	21	000
713	11	22	000
714	11	13	000
715	11	14	000
716	11	51	000
717	11	2	000
718	11	3	000
719	11	15	000
720	11	19	000
721	11	20	000
722	11	54	000
723	11	90	000
724	11	4	000
725	11	5	000
726	11	7	000
727	7	93	000
257	7	45	000
258	7	65	000
259	7	66	000
260	7	67	000
261	7	8	100
262	7	26	100
275	7	50	000
302	7	80	000
728	7	91	000
729	7	92	000
730	7	95	000
281	7	18	000
307	7	86	000
319	7	69	000
731	7	89	000
732	7	94	000
330	7	22	000
733	7	90	000
341	7	5	000
734	8	93	000
352	8	28	110
362	8	50	000
379	8	70	000
380	8	71	000
381	8	72	000
382	8	73	000
383	8	74	000
384	8	75	000
385	8	76	000
386	8	77	000
387	8	78	000
388	8	79	000
389	8	80	000
390	8	81	000
391	8	82	000
392	8	83	000
393	8	84	000
395	8	88	000
735	8	91	000
736	8	92	000
737	8	95	000
363	8	1	000
364	8	6	000
365	8	9	000
366	8	16	000
367	8	17	000
368	8	18	000
369	8	23	000
370	8	25	000
371	8	29	000
372	8	30	000
373	8	31	000
374	8	32	000
375	8	44	000
376	8	53	000
377	8	56	000
378	8	68	000
394	8	86	000
396	8	24	000
397	8	37	000
398	8	39	000
399	8	46	000
400	8	47	000
401	8	48	000
402	8	49	000
403	8	52	000
404	8	63	000
405	8	64	000
406	8	69	000
407	8	85	000
738	8	89	000
739	8	94	000
408	8	10	000
409	8	11	000
410	8	12	000
411	8	38	000
412	8	40	000
413	8	41	000
414	8	42	000
415	8	55	000
416	8	21	000
417	8	22	000
418	8	13	000
419	8	14	000
420	8	51	000
421	8	2	000
422	8	3	000
423	8	15	000
424	8	19	000
425	8	20	000
426	8	54	000
740	8	90	000
427	8	4	000
428	8	5	000
429	8	7	000
241	6	73	111
742	6	96	111
741	5	96	111
186	6	65	000
202	6	68	000
\.


--
-- Name: permissions_permission_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('permissions_permission_id_seq', 742, true);


--
-- Data for Name: popup_promo_schedule; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY popup_promo_schedule (popup_schedule_id, popup_schedule_time, popup_schedule_duration, popup_id) FROM stdin;
17	1420128000	25	0
35	1420066800	25	12
36	1420070400	25	9
37	1420074000	40	3
38	1420077600	25	8
3	1420077600	25	8
39	1420081200	25	11
4	1420081200	25	11
40	1420084800	40	21
5	1420084800	40	21
41	1420088400	40	21
6	1420088400	40	21
42	1420092000	40	20
7	1420092000	40	20
43	1420095600	40	20
8	1420095600	40	20
44	1420099200	25	15
9	1420099200	25	15
45	1420102800	40	12
10	1420102800	40	12
46	1420106400	40	21
11	1420106400	40	21
47	1420110000	25	21
12	1420110000	25	21
2	1420110000	25	21
48	1420113600	40	8
13	1420113600	40	8
1	1420113600	40	8
49	1420117200	25	21
14	1420117200	25	21
50	1420120800	25	21
15	1420120800	25	21
51	1420124400	30	15
16	1420124400	30	15
\.


--
-- Name: popup_promo_schedule_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('popup_promo_schedule_id_seq', 51, true);


--
-- Data for Name: popup_promos; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY popup_promos (popup_id, popup_title, popup_description, popup_image, popup_enabled) FROM stdin;
4	spa3		spa3.jpg	1
5	pro3		pro3.jpg	1
6	spa1		spa1.jpg	1
2	spa2		spa2.jpg	1
3	barong		barong-01.jpg	1
8	mojito		mojito.jpg	1
7	romantiqBBQ-02		romantiqBBQ-02.jpg	1
9	romantiqBBQ-01		romantiqBBQ-01.jpg	1
11	BaliBagusPromo		BaliBagus.jpg	1
12	SpaHH		SkanatiHappy.jpg	1
10	brunch		brunch.jpg	1
1	IPTVweeklyNight-01		IPTVweeklyNight-01.jpg	1
13	IPTVweeklyNight-02		IPTVweeklyNight-02.jpg	1
14	IPTVweeklyNight-03		IPTVweeklyNight-03.jpg	1
15	IPTVweeklyNight-04		IPTVweeklyNight-04.jpg	1
16	IPTVweeklyNight-05		IPTVweeklyNight-05.jpg	1
17	iptvanniversary01		iptvanniversary01.jpg	1
18	KunyitMerdeka		kunyitmerdeka.jpg	1
19	SandsMerdeka		sandsmerdeka.jpg	1
20	RoyalHighTea		Royal High Tea-01.jpg	1
21	Volcano		volcano.jpg	1
\.


--
-- Name: popup_promos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('popup_promos_id_seq', 21, true);


--
-- Data for Name: publicplace_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY publicplace_translations (translation_id, publicplaces_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
7	1	  		
8	1	  		
9	1	  		
10	1	  		
11	1	  		
6	1	jp	公共の場	
12	1	  		
13	1	  		
14	1	  		
15	1	  		
17	1	  		
16	1	cn	公共场所	
3	1	en	Public Place	
5	1	id	Tempat Umum	
19	1	  		
18	1	kr	공공 장소	
20	2	cn	公共场所	
21	2	en	Public Place	
22	2	id	Tempat Umum	
23	2	  		
24	2	kr	공공 장소	
25	3	cn	公共场所	
26	3	en	Public Place	
27	3	id	Tempat Umum	
28	3	  		
29	3	kr	공공 장소	
\.


--
-- Name: publicplace_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('publicplace_translations_translation_id_seq', 29, true);


--
-- Data for Name: publicplaces; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY publicplaces (publicplaces_id, publicplaces_image, publicplaces_image_enabled, publicplaces_clip, publicplaces_clip_enabled, publicplaces_enabled, publicplaces_order) FROM stdin;
1	public places directory-01	0		0	1	1
2	public places directory-02	0		0	1	2
3	public places directory-03	0		0	1	3
\.


--
-- Name: publicplaces_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('publicplaces_seq', 3, true);


--
-- Data for Name: recreational_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY recreational_translations (translation_id, recreationals_id, language_id, translation_title, translation_description) FROM stdin;
1	2	  		
2	2	  		
4	2	  		
7	2	  		
8	2	  		
9	3	  		
10	3	  		
12	3	  		
15	3	  		
16	3	  		
18	2	  		
19	2	  		
6	2	jp	フィットネスセンター	5階に位置するホテルサンティカプレミアハヤムウルクは - ジャカルタには、有酸素運動、健康、プール施設とのご宿泊のお客様のレクリエーションのニーズを先取り&lt;br/&gt;。\n&lt;br/&gt;\n06.00から21.00までオープン
20	2	  		
21	2	  		
23	3	  		
24	3	  		
14	3	jp	スイミングプール	5階に位置するホテルサンティカプレミアハヤムウルクは - ジャカルタには、有酸素運動、健康、プール施設とのご宿泊のお客様のレクリエーションのニーズを先取り&lt;br/&gt;。\n&lt;br/&gt;\n06.00から21.00までオープン
25	3	  		
26	3	  		
28	2	kr	SAKANTI SPA	Sakanti는, 여성의 아이의 아름다운 광택을 의미하는 고대 산스크리트어, Sakanti 스파는 가장 신비로운 섬에 스파 및 미용 의식의 궁극적 인 맨발의 성역이라고 할 수 있습니다. 발리 문화와 전통에서 영감을하고 엘레 미스의 럭셔리 브랜드 스킨 케어 제품으로 칭찬, Sakanti 스파의 전문적 훈련을받은 치료는 특별한 경험을 제공하기 위해 각 스파 및 미용 의식을 맞추어, 각각의 손님을 협의한다. 새로 고침 및 갱신, Sakanti 스파는 매일 오후 9시에 오전 9시에서 당신을 기다립니다 신들의 섬에 평온의 오아시스입니다.
35	4	kr	스포츠 레크리에이션 및 피트니스 센터	ANVAYA 비치 리조트 발리 여섯 풀과 소형 피트니스 센터에 의해 보완 레저 및 오락 시설과 서비스의 무수을 제공합니다. 레크리에이션 승무원의 우리의 잘 훈련 된 팀은 ANVAYA 비치 리조트 발리는 모두를 위해 뭔가를 가지고 일상적인 활동, 수업과 개인 여가 추적의 다양한 프로그램을 제공합니다. 매일 오후 9시에 오전 6시에서 열고 ANVAYA 체육관은 운동을위한 최선 제공합니다.
27	2	  		
30	3	kr	ANVAYA 키즈 클럽	매일 오후 6시에서 오전 9시까지에서 열기는 ANVAYA 키즈 클럽 발리 손 공예 제작을 통해 발리의 문화 유산에 대한 당신의 아이들을 소개 할 수 있도록, 드레스와 댄스 세션, 음악, 인도네시아어 한국어 수업. 아이들은 또한, 자전거로 ANVAYA 비치 리조트 발리를 탐험 우리의 숙련 된 아이 친화적 인 요리사와 요리 또는 아침 요가 수업을 즐길 수 배울 수 있습니다.
22	3	cn	该ANVAYA儿童俱乐部	从上午9时至下午6点每天开放，允许该ANVAYA儿童俱乐部通过巴厘手工工艺制作介绍您的孩子到巴厘岛的文化和遗产，扮靓舞蹈课程，音乐和印尼文的经验教训。孩子们还可以探索ANVAYA海滩度假村巴厘岛自行车，学会与我们熟练的儿童友好厨师烹调或享受清晨瑜伽课程。
32	4	en	Sports Recreation and Fitness Centre	The ANVAYA Beach Resort- Bali offers a myriad of leisure and recreational facilities and services, complemented by six pools and a compact Fitness Centre. &lt;br/&gt;&lt;br/&gt;Our well-trained team of recreational attendants offer a diverse program of daily activities, classes and individual leisure pursuits where The ANVAYA Beach Resorts Bali has something for everyone. \n&lt;br/&gt;&lt;br/&gt;Open from 6.00 am to 9.00 pm daily, The ANVAYA Gym provides its best for workout.
29	3	  		
34	4	  		
5	2	id	SAKANTI SPA	Sakanti, yang berasal dari Bahasa Sansekerta yang memiliki makna kemilau dari seorang anak gadis. Sakanti Spa dapat digambarkan seperti kesejukan di pulau Bali yang begitu menawan. \n&lt;br/&gt;&lt;br/&gt;Terinspirasi dari warisan dan tradisi Bali dan di padu padankan dengan produk perawatan kulit dari Elemis, terapis ahli dari Sakanti Spa akan membuat spa dan perawatan tersendiri dan membuat pengalaman paling menenangkan bagi para tamu. \n&lt;br/&gt;&lt;br/&gt;Oasis di Sakanti Spa tersedia dari pukul 9 pagi hingga pukul 8 malam untuk keheningan yang selalu kami ingin tawarkan.
3	2	en	SAKANTI SPA	Sakanti, in ancient Sanskrit meaning the beautiful sheen of a women’s child, Sakanti Spa can be best described as the ultimate barefoot Sanctuary for Spa and Beauty rituals on a mystical island. \n&lt;br/&gt;&lt;br/&gt;Inspired by Balinese Heritage and Traditions and complimented by the luxury brand skincare products of Elemis, Sakanti Spa’s expertly trained Therapists will consult each guest, tailoring each Spa and Beauty ritual to create an exceptional experience.\n&lt;br/&gt;&lt;br/&gt;Refreshed and renewed, Sakanti Spa is an oasis of serenity on the Island of the Gods that awaits you from 9.00 am to 8.00 pm daily.
13	3	id	The ANVAYA Kids Club	The ANVAYA Kids Club akan memperkenalkan putra – putri Anda lebih dekat dengan budaya dan warisan leluhur Bali melalui kelas membuat kerajinan tangan, bersolek dan menari Bali, kelas musik dan belajar Bahasa Indonesia. \n&lt;br/&gt;&lt;br/&gt;Kids Club kami melayani Anda dari pukul 9 pagi hingga pukul 6 sore juga ingin mengajak putra – putri Anda mengelilingi The ANVAYA Beach Resorts Bali dengan bersepeda dan juga belajar memasak bersama Koki kami yang ramah atau menikmati kelas Yoga bersama pelatih kami.
36	4	  		
11	3	en	The ANVAYA Kids Club	Open from 9.00 am to 6.00 pm daily, allow The ANVAYA Kid’s Club to introduce your children to Bali’s culture and heritage through Balinese Hand craft making, Dress up and Dance sessions, Music and Indonesian Bahasa lessons. \n&lt;br/&gt;&lt;br/&gt;Children can also explore The ANVAYA Beach Resort- Bali  by Bicycle, learn to Cook with our skilled child friendly chefs or enjoy morning Yoga classes.
37	2	  		
38	3	  		
39	4	  		
40	2	  		
41	4	  		
42	3	  		
43	2	  		
44	3	  		
45	4	  		
46	2	  		
47	2	  		
17	2	cn	SAKANTI SPA  光澤水療	Sakanti，在古梵文意思是妇女儿童的美丽的光泽，Sakanti温泉可以最好的描述为一个神秘的岛屿最终赤脚圣所为水疗和美容仪式。由巴厘文化遗产和优良传统的启发和Elemis水的奢侈品牌护肤品称赞，Sakanti Spa的专业培训治疗师会征询每一位客人，每剪裁水疗和美容礼仪创造一个特殊的体验。装修一新的和更新，Sakanti水疗中心是一个宁静的，每天等待着你，从上午9时至晚上8时众神之岛的绿洲。
48	2	  		
49	2	  		
31	4	cn	体育康乐及健身中心	ANVAYA海灘度假村巴厘島提供多種類的休閒娛樂設施和服務，由六個游泳池和一個小型完善健身中心。我們訓練有素的服務員休閒團隊提供的日常活動，課程和個人的休閒活動多樣化的節目，ANVAYA海灘度假村巴厘島為每位客人提供不一樣的服務。 營業早上六時開始至晚上九點，ANVAYA健身房提供了最好的訓練。
33	4	id	Sports Recreation and Fitness Centre	The ANVAYA Beach Resorts Bali menawarkan begitu banyak fasilitas rekreasi bagi Anda dan keluarga. \n&lt;br/&gt;&lt;br/&gt;Dilengkapi dengan enam kolam renang dan area fitness kami yang simpel namun elegan, pelatih dari team kami menawarkan program yang beragam untuk kegiatan sehari – hari Anda selama menginap. Kelas dan kegiatan individu dimana The ANVAYA Beach Resorts Bali selalu memiliki sesuatu yang dapat ditawarkan.\n&lt;br/&gt;&lt;br/&gt;Buka dari pukul 6 pagi hingga pukul 9 malam The ANVAYA Gym mencoba memberikan yang terbaik untuk program latihan Anda.
50	4	  		
51	4	  		
52	3	  		
53	3	  		
\.


--
-- Name: recreational_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('recreational_translations_translation_id_seq', 53, true);


--
-- Data for Name: recreationals; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY recreationals (recreationals_id, recreationals_image, recreationals_image_enabled, recreationals_clip, recreationals_clip_enabled, recreationals_enabled, recreationals_order) FROM stdin;
2	sakantispa	0		0	0	1
4	sportsrecreation	0		0	1	3
3	kidsclub	0		0	1	2
\.


--
-- Name: recreationals_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('recreationals_seq', 4, true);


--
-- Data for Name: resortmap_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY resortmap_translations (translation_id, resortmaps_id, language_id, translation_title, translation_description) FROM stdin;
4	1	  		
6	2	cn		
7	2	en		
8	2	id		
9	2	  		
10	2	kr		
11	5	cn		
12	5	en		
13	5	id		
14	5	  		
15	5	kr		
16	3	cn		
17	3	en		
18	3	id		
19	3	  		
20	3	kr		
24	2	  		
26	2	  		
46	3	  		
27	1	  		
47	1	  		
35	3	cn	Anvaya	
28	2	  		
36	3	en	Anvaya	
37	3	id	Anvaya	
48	3	  		
39	3	kr	Anvaya	
29	2	  		
49	2	  		
30	2	  		
21	2	cn	Anvaya1	
22	2	en	Anvaya1	
23	2	id	Anvaya1	
31	2	  		
50	2	  		
25	2	kr	Anvaya1	
32	1	  		
51	1	  		
52	4	cn	tes	
33	2	  		
53	4	en	tes	
54	4	id		
55	4	  		
56	4	kr		
34	1	  		
38	3	  		
60	5	  		
40	3	  		
1	1	cn	Anvaya	
2	1	en	Anvaya	
3	1	id	Anvaya	
41	3	  		
62	1	  		
42	3	  		
43	1	  		
5	1	kr	Anvaya	
57	5	cn	Anvaya	Anvaya
58	5	en	Anvaya	Anvaya
44	2	  		
59	5	id	Anvaya	Anvaya
45	2	  		
63	5	  		
61	5	kr	Anvaya	Anvaya
67	6	  		
69	6	  		
68	6	kr	a	a
64	6	cn	a	a
65	6	en	a	a
66	6	id	a	a
70	6	  		
71	6	  		
\.


--
-- Name: resortmap_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('resortmap_translations_translation_id_seq', 71, true);


--
-- Data for Name: resortmaps; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY resortmaps (resortmaps_id, resortmaps_image, resortmaps_image_enabled, resortmaps_clip, resortmaps_clip_enabled, resortmaps_enabled, resortmaps_order) FROM stdin;
1	anvaya	0		0	1	1
6	Background_resortmap_2	0		0	1	2
\.


--
-- Name: resortmaps_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('resortmaps_seq', 6, true);


--
-- Data for Name: rooms; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY rooms (room_id, room_name, room_description, room_enabled, room_key, zone_id) FROM stdin;
551	1510B	Room 1510B Premiere Lantai 5	1	\N	4
380	5117	Room 5117 Deluxe Lantai 1	1		5
386	6201	Room 6201 Deluxe Lantai 2	1		6
462	5319	Room 5319 Deluxe Lantai 3	1	10dae45961266af385e9e36d490de568	7
289	2541	Room 2541 Premiere Lantai 5	1	71e5f98c7d64422a3c883261e376a936	4
571	gym	Gym	1	\N	10
184	2325	Room 2325 Premiere Lantai 3	1		3
52	3111	Room 3111 Premiere Lantai 1	1		1
481	6519	Room 6519 Deluxe Lantai 5	1		8
471	6507	Room 6507 Deluxe Lantai 5	1	e72154416ab4add858e5b6146705987f	8
190	2331	Room 2331 Premiere Lantai 3	1	0198fc502c8534de4c9d83f13a216c91	3
581	3151	3151	1	4d16132c9ae495e65ed0f86adf53b4a5	11
284	2536	Room 2536 Premiere Lantai 5	1	1e70d20b59a7a6fedfc9d70c8cdbe00c	4
432	6308	Room 6308 Deluxe Lantai 3	1	a74a19f26bb6a3a5806831cf0a05310a	7
195	2336	Room 2336 Premiere Lantai 3	1	8ef8a7e97b6abfe25dbc4fbab9643ba2	3
374	5109	Room 5109 Deluxe Lantai 1	1	afe0d63c5bedd6d22f176f9aad4e85f4	5
513	3133	3133	1		9
511	3133	Villa K B	1		9
407	5201	Room 5201 Deluxe Lantai 2	1	0b08c81a0a41a9285a5eccabc8d5e454	6
485	6523	Room 6523 Deluxe Lantai 5	1	fa6c2618006e900f61fa14b00715b467	8
200	2341	Room 2341 Premiere Lantai 3	1		3
366	6124	Room 6124 Deluxe Lantai 1	1	c904f34853863b7aac347b54aaf970fc	5
442	6320	Room 6320 Deluxe Lantai 3	1	6dc3d8a7ed6cc4fa1b3bf39502568e1d	7
433	6309	Room 6309 Deluxe Lantai 3	1	67f41dda80f725fa968034306486e303	7
435	6311	Room 6311 Deluxe Lantai 3	1	2ea9a6fba1bd5fc9faf8d48318cbd9c2	7
183	2324	Room 2324 Premiere Lantai 3	1	d89916d559d5a3d73e211699070c5519	3
446	6324	Room 6324 Deluxe Lantai 3	1	fc0a6ff23327f9d46828cac54f0e7339	7
20	2123	Room 2123 Premiere Lantai 1	1		1
267	2519	Room 2519 Premiere Lantai 5	1		4
336	3519	Room 3519 Premiere Lantai 5	1		4
177	2318	Room 2318 Premiere Lantai 3	1		3
595	2143	2143	1		9
268	2520	Room 2520 Premiere Lantai 5	1		4
138	3206	Room 3206 Premiere Lantai 2	1		2
114	1217	Room 1217 Premiere Lantai 2	1		2
27	2130	Room 2130 Premiere Lantai 1	1	a6c5a1efbc4f08a58cfde259b421dfcc	1
94	2226	Room 2226 Premiere Lantai 2	1	9957cdbc76388f8feb6620670aa15545	2
82	2212	Room 2212 Premiere Lantai 2	1	243546aa4e715851485711397c2a7710	2
188	2329	Room 2329 Premiere Lantai 3	1	5b6ffcbecdb1cc800522af30e86d3b45	3
569	Test	Test	1	\N	10
439	6317	Room 6317 Deluxe Lantai 3	1	8ac5417527ad518149f4a5ce48bdc653	7
96	2228	Room 2228 Premiere Lantai 2	1		2
329	3510	Room 3510 Premiere Lantai 5	1		4
140	3208	Room 3208 Premiere Lantai 2	1		2
113	1218	Room 1218 Premiere Lantai 2	1		2
596	2145	2145	1		9
347	6102	Room 6102 Deluxe Lantai 1	1	dd650df44606f96cfb91ccf00fa15368	5
419	5216	Room 5216 Deluxe Lantai 2	1	7347afb93db930c51abec56ddc2dde54	6
350	6106	Room 6106 Deluxe Lantai 1	1	19a6075416436cad2042f9bab6178c44	5
269	2521	Room 2521 Premiere Lantai 5	1		4
582	3152	3152	1		11
86	2218	Room 2218 Premiere Lantai 2	1	008a3f119eb6dfe184e74144aa263d34	2
157	3227	Room 3227 Premiere Lantai 2	1		2
583	3153	3153	1	db1e352325478679abd8761179ddcd2c	11
570	Laptop-test		1	\N	10
443	6321	Room 6321 Deluxe Lantai 3	1	d1481d2874aab496e4c24e9c3ec7d610	7
143	3211	Room 3211 Premiere Lantai 2	1		2
67	3128	Room 3128 Premiere Lantai 1	1		1
258	2508	Room 2508 Premiere Lantai 5	1		4
119	1212	Room 1212A Premiere Lantai 2	1		2
217	1309	Room 1309 Premiere Lantai 3	1		3
399	6217	Room 6217 Deluxe Lantai 2	1	86685b4c4c8db08731f0623d9d6e9e1c	6
333	3516	Room 3516 Premiere Lantai 5	1		4
242	3319	Room 3319 Premiere Lantai 3	1		3
597	2243	2243	1		9
2	2102	Room 2102 Premiere Lantai 1	1		1
487	5501	Room 5501 Deluxe Lantai 5	1	8d9db1848cd5ed2fc3286b5f5d37285a	8
444	6322	Room 6322 Deluxe Lantai 3	1	2ef0650abd93363404e4aa00df20db42	7
233	3308	Room 3308 Premiere Lantai 3	1		3
282	2534	Room 2534 Premiere Lantai 5	1		4
357	6115	Room 6115 Deluxe Lantai 1	1	b80ce8236d1049a613ad4f99b43fe898	5
207	1315	Room 1315 Premiere Lantai 3	1		3
55	3116	Room 3116 Premiere Lantai 1	1	e37443956983e43b90af4f0a3c4e609d	1
479	6517	Room 6517 Deluxe Lantai 5	1	9ece2bf525bd82aedc04d459af710857	8
476	6512	Room 6512 Deluxe Lantai 5	1	6cfb589fc16beff6988ebcb39af554cb	8
232	3307	Room 3307 Premiere Lantai 3	1		3
349	6105	Room 6105 Deluxe Lantai 1	1	1bfd965922be7ccae05ebf0ebebadbbb	5
473	6509	Room 6509 Deluxe Lantai 5	1	e1e9f2886e675420395f214f9d49fc1d	8
287	2539	Room 2539 Premiere Lantai 5	1		4
475	6511	Room 6511 Deluxe Lantai 5	1	dee162babd831af626eb00b9a3782367	8
54	3115	Room 3115 Premiere Lantai 1	1		1
236	3311	Room 3311 Premiere Lantai 3	1		3
598	2245	2245	1		9
342	3525	Room 3525 Premiere Lantai 5	1		4
251	3328	Room 3328 Premiere Lantai 3	1		3
327	3508	Room 3508 Premiere Lantai 5	1		4
162	3232	Room 3232 Premiere Lantai 2	1	18626583d00a2ac4e12cc82cb7c85a0f	2
470	6506	Room 6506 Deluxe Lantai 5	1	6cb7875ea88434ea36ce8c2b98012401	8
499	5516	Room 5516 Deluxe Lantai 5	1	ab05db1e5349048b0a579950690f8a61	8
57	3118	Room 3118 Premiere Lantai 1	1	077db6820e627f8c65f8102700be9d0d	1
501	5518	Room 5518 Deluxe Lantai 5	1		8
324	3505	Room 3505 Premiere Lantai 5	1		4
326	3507	Room 3507 Premiere Lantai 5	1		4
58	3119	Room 3119 Premiere Lantai 1	1		1
148	3218	Room 3218 Premiere Lantai 2	1		2
585	3155	3155	1	\N	11
450	5305	Room 5305 Deluxe Lantai 3	1	9b4a4ecb08414e0225abdeaf6abb28b5	7
378	5115	Room 5115 Deluxe Lantai 1	1	cd53b9a147f3c560eb1ed12a94a3585d	5
424	5221	Room 5221 Deluxe Lantai 2	1	cd879e377dfc188b3de1eaadd78a05b9	6
56	3117	Room 3117 Premiere Lantai 1	1		1
321	3501	Room 3501 Premiere Lantai 5	1		4
332	3515	Room 3515 Premiere Lantai 5	1		4
219	1307	Room 1307 Premiere Lantai 3	1		3
579	3234	3234	1		9
370	5105	Room 5105 Deluxe Lantai 1	1	fc004c2517ab20e790fcb46bdeb10764	5
348	6103	Room 6103 Deluxe Lantai 1	1	fb3fadd3c986a931e4ccaa75ab485af1	5
307	1509	Room 1509A Premiere Lantai 5	1	78a256098c37a895d36d41773dfba637	4
235	3310	Room 3310 Premiere Lantai 3	1	45c5fc0545f7725512238ee06d0847ca	3
154	3224	Room 3224 Premiere Lantai 2	1	b07455e55817c6b1a82d8e16cf5f7665	2
505	5522	Room 5522 Deluxe Lantai 5	1		8
89	2221	Room 2221 Premiere Lantai 2	1		2
354	6110	Room 6110 Deluxe Lantai 1	1	0c3b6797d54c79ec41c2ea8f69792c94	5
396	6212	Room 6212 Deluxe Lantai 2	1	714d808f8769648fc3720cabf0004d4f	6
66	3127	Room 3127 Premiere Lantai 1	1		1
229	3303	Room 3303 Premiere Lantai 3	1		3
8	2109	Room 2109 Premiere Lantai 1	1		1
127	1208	Room 1208 Premiere Lantai 2	1		2
246	3323	Room 3323 Premiere Lantai 3	1		3
240	3317	Room 3317 Premiere Lantai 3	1		3
266	2518	Room 2518 Premiere Lantai 5	1		4
586	3154	3154	1		11
259	2509	Room 2509 Premiere Lantai 5	1		4
290	2542	Room 2542 Premiere Lantai 5	1	c2bd2fd3e62810a6c262f31dd4c594ae	4
323	3503	Room 3503 Premiere Lantai 5	1		4
493	5508	Room 5508 Deluxe Lantai 5	1	eb558978176c5f81406deb9f7c6b72c3	8
337	3520	Room 3520 Premiere Lantai 5	1		4
358	6116	Room 6116 Deluxe Lantai 1	1		5
187	2328	Room 2328 Premiere Lantai 3	1	266b5da46c18fa69a54792a2da10926e	3
179	2320	Room 2320 Premiere Lantai 3	1		3
364	6122	Room 6122 Deluxe Lantai 1	1		5
587	3156	3156	1		11
108	2240	Room 2240 Premiere Lantai 2	1		2
112	1219	Room 1219 Premiere Lantai 2	1		2
286	2538	Room 2538 Premiere Lantai 5	1		4
368	5102	Room 5102 Deluxe Lantai 1	1	3fc77ff25abae816bab01ba34b07e8a8	5
385	5122	Room 5122 Deluxe Lantai 1	1	b85d7fd6e2c01e495c61a464642b2f70	5
224	1303	Room 1303 Premiere Lantai 3	1		3
202	1320	Room 1320 Premiere Lantai 3	1		3
158	3228	Room 3228 Premiere Lantai 2	1		2
339	3522	Room 3522 Premiere Lantai 5	1	3047fb7ad6951f987d7eb31738af9d8d	4
341	3524	Room 3524 Premiere Lantai 5	1	b8222fc89a5357d066f9ef89bbc56ba3	4
181	2322	Room 2322 Premiere Lantai 3	1		3
33	2136	Room 2136 Premiere Lantai 1	1		1
72	2201	Room 2201 Premiere Lantai 2	1		2
78	2208	Room 2208 Premiere Lantai 2	1		2
98	2230	Room 2230 Premiere Lantai 2	1		2
106	2238	Room 2238 Premiere Lantai 2	1		2
14	2117	Room 2117 Premiere Lantai 1	1		1
81	2211	Room 2211 Premiere Lantai 2	1		2
160	3230	Room 3230 Premiere Lantai 2	1		2
29	2132	Room 2132 Premiere Lantai 1	1		1
30	2133	Room 2133 Premiere Lantai 1	1		1
32	2135	Room 2135 Premiere Lantai 1	1		1
87	2219	Room 2219 Premiere Lantai 2	1	fcf6746b580a2e019c4fb1f4f1b920c4	2
79	2209	Room 2209 Premiere Lantai 2	1		2
556	3233	3233	1		9
37	2140	Room 2140 Premiere Lantai 1	1	07945b6766785c6ac2b24edfb0248ebc	1
105	2237	Room 2237 Premiere Lantai 2	1		2
39	2142	Room 2142 Premiere Lantai 1	1		1
90	2222	Room 2222 Premiere Lantai 2	1	9fad5709a099e289e6983f3fa9ef6086	2
101	2233	Room 2233 Premiere Lantai 2	1		2
11	2112	Room 2112 Premiere Lantai 1	1	81ceb53e16ba763b5e7066bd69990d4b	1
92	2224	Room 2224 Premiere Lantai 2	1	1d48edf27888012c654fbcc4a8420493	2
44	3102	Room 3102 Premiere Lantai 1	1		1
43	3101	Room 3101 Premiere Lantai 1	1		1
102	2234	Room 2234 Premiere Lantai 2	1		2
28	2131	Room 2131 Premiere Lantai 1	1		1
1	2101	Room 2101 Premiere Lantai 1	1		1
85	2217	Room 2217 Premiere Lantai 2	1		2
74	2203	Room 2203 Premiere Lantai 2	1		2
31	2134	Room 2134 Premiere Lantai 1	1	81bb0f04932a89ac5dfd04aa5196b131	1
589	3158	3158	1		11
10	2111	Room 2111 Premiere Lantai 1	1		1
12	2115	Room 2115 Premiere Lantai 1	1		1
107	2239	Room 2239 Premiere Lantai 2	1	4657a9f996dfa744207ce045a3047974	2
46	3105	Room 3105 Premiere Lantai 1	1		1
24	2127	Room 2127 Premiere Lantai 1	1		1
42	1103	Room 1103 Premiere Lantai 1	1		1
49	3108	Room 3108 Premiere Lantai 1	1		1
50	3109	Room 3109 Premiere Lantai 1	1		1
83	2215	Room 2215 Premiere Lantai 2	1	6603b99f0b004fb59e0e6c4e4edbfffb	2
3	2103	Room 2103 Premiere Lantai 1	1		1
26	2129	Room 2129 Premiere Lantai 1	1		1
36	2139	Room 2139 Premiere Lantai 1	1		1
41	1102	Room 1102 Premiere Lantai 1	1		1
38	2141	Room 2141 Premiere Lantai 1	1		1
16	2119	Room 2119 Premiere Lantai 1	1		1
73	2202	Room 2202 Premiere Lantai 2	1	258980240890f0bbfa5f5475e7b83ce6	2
99	2231	Room 2231 Premiere Lantai 2	1		2
7	2108	Room 2108 Premiere Lantai 1	1		1
91	2223	Room 2223 Premiere Lantai 2	1	c3be7f2597f4a91bc92778e3782973b4	2
19	2122	Room 2122 Premiere Lantai 1	1	3563c493fbb24d48d36617190495e33d	1
4	2105	Room 2105 Premiere Lantai 1	1	99d40dbd15aef10a10dc0b393984100f	1
48	3107	Room 3107 Premiere Lantai 1	1		1
93	2225	Room 2225 Premiere Lantai 2	1		2
75	2205	Room 2205 Premiere Lantai 2	1	9d5303262c4e61ab5c5203def19be2d9	2
97	2229	Room 2229 Premiere Lantai 2	1	dd969010a03c25fcb7391a1f91dd31f1	2
47	3106	Room 3106 Premiere Lantai 1	1		1
17	2120	Room 2120 Premiere Lantai 1	1		1
5	2106	Room 2106 Premiere Lantai 1	1	f0a26afb1fde74a97f83125ec1cf2879	1
103	2235	Room 2235 Premiere Lantai 2	1	2f1d0d0f07d1fafbeb08a80a9b62e0bf	2
23	2126	Room 2126 Premiere Lantai 1	1	5f492e56a7d04356878f30d9924c137f	1
13	2116	Room 2116 Premiere Lantai 1	1	c078db13cd98430f9176c637ec797a2e	1
35	2138	Room 2138 Premiere Lantai 1	1		1
104	2236	Room 2236 Premiere Lantai 2	1		2
34	2137	Room 2137 Premiere Lantai 1	1		1
15	2118	Room 2118 Premiere Lantai 1	1		1
77	2207	Room 2207 Premiere Lantai 2	1		2
45	3103	Room 3103 Premiere Lantai 1	1		1
135	3202	Room 3202 Premiere Lantai 2	1	60df9401dccd33956519eecb1af023d1	2
120	1212B	Room 1212B Premiere Lantai 2	1	\N	2
204	1318	Room 1318 Premiere Lantai 3	1		3
590	3157	3157	1	c640651059f63c5d68c298d890192ddf	11
164	2302	Room 2302 Premiere Lantai 3	1		3
137	3205	Room 3205 Premiere Lantai 2	1		2
63	3124	Room 3124 Premiere Lantai 1	1		1
121	1212C	Room 1212C Premiere Lantai 2	1	\N	2
62	3123	Room 3123 Premiere Lantai 1	1		1
185	2326	Room 2326 Premiere Lantai 3	1	2f7f945032b46d383982fe3f2c51b845	3
203	1319	Room 1319 Premiere Lantai 3	1		3
136	3203	Room 3203 Premiere Lantai 2	1		2
125	1210	Room 1210 Premiere Lantai 2	1		2
126	1209	Room 1209 Premiere Lantai 2	1		2
180	2321	Room 2321 Premiere Lantai 3	1		3
128	1207	Room 1207 Premiere Lantai 2	1		2
131	1203	Room 1203 Premiere Lantai 2	1		2
173	2312	Room 2312 Premiere Lantai 3	1		3
147	3217	Room 3217 Premiere Lantai 2	1		2
196	2337	Room 2337 Premiere Lantai 3	1		3
206	1316	Room 1316 Premiere Lantai 3	1		3
68	3129	Room 3129A Premiere Lantai 1	1		1
186	2327	Room 2327 Premiere Lantai 3	1		3
214	1310	Room 1310A Premiere Lantai 3	1	df2e7d25d64afc233413c5febc6235bf	3
199	2340	Room 2340 Premiere Lantai 3	1	5ffe9d3c042a9c0084a437687b5a83a1	3
193	2334	Room 2334 Premiere Lantai 3	1	8901269f4b4bc06ff6d8842e7e4b255d	3
170	2309	Room 2309 Premiere Lantai 3	1	d10e0b043d4bf613753d935dc3ba4ce1	3
18	2121	Room 2121 Premiere Lantai 1	1		1
109	2241	Room 2241 Premiere Lantai 2	1		2
116	1215	Room 1215A Premiere Lantai 2	1		2
165	2303	Room 2303 Premiere Lantai 3	1		3
176	2317	Room 2317 Premiere Lantai 3	1	c619223ffc308075770a1c34f29accb4	3
132	1202	Room 1202 Premiere Lantai 2	1		2
194	2335	Room 2335 Premiere Lantai 3	1		3
130	1205	Room 1205 Premiere Lantai 2	1		2
64	3125	Room 3125 Premiere Lantai 1	1		1
61	3122	Room 3122 Premiere Lantai 1	1	538fd9c14b541381d9a91ae3ce777a8b	1
65	3126	Room 3126 Premiere Lantai 1	1	6a8669445761c52438c2f28aa9ae514b	1
122	1211	Room 1211A Premiere Lantai 2	1		2
168	2307	Room 2307 Premiere Lantai 3	1		3
60	3121	Room 3121 Premiere Lantai 1	1		1
71	3130B	Room 3130B Premiere Lantai 1	1	\N	1
111	1220	Room 1220 Premiere Lantai 2	1		2
134	3201	Room 3201 Premiere Lantai 2	1	bd26119620a429e7ad49df3edfb2bc03	2
146	3216	Room 3216 Premiere Lantai 2	1		2
139	3207	Room 3207 Premiere Lantai 2	1		2
53	3112	Room 3112 Premiere Lantai 1	1	0715ef5850ef7a04505151ac8410436c	1
9	2110	Room 2110 Premiere Lantai 1	1	13a007a8f117272851b4f894a9d4ce1e	1
174	2315	Room 2315 Premiere Lantai 3	1	119556208d5af4463394f85d46e55c84	3
124	1211C	Room 1211C Premiere Lantai 2	1	\N	2
163	2301	Room 2301 Premiere Lantai 3	1		3
197	2338	Room 2338 Premiere Lantai 3	1	484aa4584aa39c699e72148efe9a9dc4	3
205	1317	Room 1317 Premiere Lantai 3	1		3
211	1311	Room 1311A Premiere Lantai 3	1	cae1ef28d17e8d82c316a3164c17adcc	3
212	1311B	Room 1311B Premiere Lantai 3	1	\N	3
213	1311C	Room 1311C Premiere Lantai 3	1	\N	3
141	3209	Room 3209 Premiere Lantai 2	1		2
198	2339	Room 2339 Premiere Lantai 3	1		3
145	3215	Room 3215 Premiere Lantai 2	1		2
129	1206	Room 1206 Premiere Lantai 2	1		2
118	1215C	Room 1215C Premiere Lantai 2	1	\N	2
117	1215B	Room 1215B Premiere Lantai 2	1	\N	2
69	3129B	Room 3129B Premiere Lantai 1	1	\N	1
110	2242	Room 2242 Premiere Lantai 2	1	9247b8d94365e08cb8c92675e3af572d	2
115	1216	Room 1216 Premiere Lantai 2	1		2
208	1312	Room 1312A Premiere Lantai 3	1		3
209	1312B	Room 1312B Premiere Lantai 3	1	\N	3
144	3212	Room 3212 Premiere Lantai 2	1		2
59	3120	Room 3120 Premiere Lantai 1	1	b87281d0dfd95f1847ab17fba189cb40	1
201	2342	Room 2342 Premiere Lantai 3	1	b3a914771c9e2d03944523a16fa21ac5	3
270	2522	Room 2522 Premiere Lantai 5	1		4
260	2510	Room 2510 Premiere Lantai 5	1		4
156	3226	Room 3226 Premiere Lantai 2	1		2
238	3315	Room 3315 Premiere Lantai 3	1		3
250	3327	Room 3327 Premiere Lantai 3	1		3
320	1501	Room 1501 Premiere Lantai 5	1		4
153	3223	Room 3223 Premiere Lantai 2	1		2
276	2528	Room 2528 Premiere Lantai 5	1		4
296	1517	Room 1517 Premiere Lantai 5	1		4
271	2523	Room 2523 Premiere Lantai 5	1		4
278	2530	Room 2530 Premiere Lantai 5	1		4
280	2532	Room 2532 Premiere Lantai 5	1		4
274	2526	Room 2526 Premiere Lantai 5	1	3c03f753553fbf3a3d83717092efc174	4
252	2501	Room 2501 Premiere Lantai 5	1		4
298	1516B	Room 1516B Premiere Lantai 5	1	\N	4
227	3301	Room 3301 Premiere Lantai 3	1		3
308	1509B	Room 1509B Premiere Lantai 5	1	\N	4
279	2531	Room 2531 Premiere Lantai 5	1		4
257	2507	Room 2507 Premiere Lantai 5	1	d0771342cd0f5b13cad955e2de10b95c	4
281	2533	Room 2533 Premiere Lantai 5	1		4
293	1520	Room 1520 Premiere Lantai 5	1		4
228	3302	Room 3302 Premiere Lantai 3	1		3
294	1519	Room 1519 Premiere Lantai 5	1		4
295	1518	Room 1518 Premiere Lantai 5	1	6570cd06ec37663254e12ecee64ac4dc	4
319	1502	Room 1502 Premiere Lantai 5	1		4
152	3222	Room 3222 Premiere Lantai 2	1		2
265	2517	Room 2517 Premiere Lantai 5	1		4
303	1511	Room 1511A Premiere Lantai 5	1	37393a383b0cff8a8a9bc7571d73954a	4
283	2535	Room 2535 Premiere Lantai 5	1		4
315	1505	Room 1505A Premiere Lantai 5	1	48f7e4616de3f3239b2df7136ca9a993	4
263	2515	Room 2515 Premiere Lantai 5	1		4
155	3225	Room 3225 Premiere Lantai 2	1		2
159	3229	Room 3229 Premiere Lantai 2	1		2
264	2516	Room 2516 Premiere Lantai 5	1	9b9ca1ccb1f1bd5b45046dead0da9d9d	4
288	2540	Room 2540 Premiere Lantai 5	1		4
285	2537	Room 2537 Premiere Lantai 5	1	f0b80f2b62aeb240fb0124a0fb0203ef	4
234	3309	Room 3309 Premiere Lantai 3	1		3
149	3219	Room 3219 Premiere Lantai 2	1		2
239	3316	Room 3316 Premiere Lantai 3	1	3935224cd1d052ba729fd219cebdb24a	3
301	1512	Room `1512A Premiere Lantai 5	1		4
247	3324	Room 3324 Premiere Lantai 3	1	283fd8c6748b09374a4e1f8b3a3ba5dd	3
311	1507	Room 1507A Premiere Lantai 5	1		4
309	1509C	Room 1509C Premiere Lantai 5	1	\N	4
151	3221	Room 3221 Premiere Lantai 2	1		2
299	1515	Room 1515A Premiere Lantai 5	1	0d6b30078fef186628018023d1c11d7e	4
231	3306	Room 3306 Premiere Lantai 3	1		3
291	1522	Room 1522 Premiere Lantai 5	1		4
297	1516	Room 1516A Premiere Lantai 5	1		4
310	1508	Room 1508 Premiere Lantai 5	1		4
300	1515B	Room 1515B Premiere Lantai 5	1	\N	4
150	3220	Room 3220 Premiere Lantai 2	1		2
591	3150	3150	1		11
318	1503	Room 1503 Premiere Lantai 5	1		4
292	1521	Room 1521 Premiere Lantai 5	1		4
215	1310B	Room 1310B Premiere Lantai 3	1	\N	3
216	1310C	Room 1310C Premiere Lantai 3	1	\N	3
253	2502	Room 2502 Premiere Lantai 5	1		4
302	1512B	Room 1512B Premiere Lantai 5	1	\N	4
248	3325	Room 3325 Premiere Lantai 3	1		3
244	3321	Room 3321 Premiere Lantai 3	1	f643e3eb34a82f69802ab13c82cda575	3
304	1511B	Room 1511B Premiere Lantai 5	1	\N	4
305	1510	Room 1510A Premiere Lantai 5	1		4
316	1505B	Room 1505B Premiere Lantai 5	1	\N	4
245	3322	Room 3322 Premiere Lantai 3	1		3
312	1507B	Room 1507B Premiere Lantai 5	1	\N	4
313	1507C	Room 1507C Premiere Lantai 5	1	\N	4
317	1505C	Room 1505C Premiere Lantai 5	1	\N	4
314	1506	Room 1506 Premiere Lantai 5	1		4
243	3320	Room 3320 Premiere Lantai 3	1		3
237	3312	Room 3312 Premiere Lantai 3	1		3
241	3318	Room 3318 Premiere Lantai 3	1		3
376	5111	Room 5111 Deluxe Lantai 1	1		5
422	5219	Room 5219 Deluxe Lantai 2	1	52f49f5ff0cdb6e0abb271654c77812a	6
390	6206	Room 6206 Deluxe Lantai 2	1	2a97ce3c383a855289c8a75b59312240	6
404	6222	Room 6222 Deluxe Lantai 2	1	618a60fda6d77e35454388445f5e05db	6
356	6112	Room 6112 Deluxe Lantai 1	1		5
355	6111	Room 6111 Deluxe Lantai 1	1		5
221	1305	Room 1305A Premiere Lantai 3	1	2bb792b5e26360b270e3eba42b8140ab	3
375	5110	Room 5110 Deluxe Lantai 1	1		5
360	6118	Room 6118 Deluxe Lantai 1	1	4a9a78e9ca4674723bf60d201968faf7	5
397	6215	Room 6215 Deluxe Lantai 2	1	869e19fe6b877883e4d317ebc7a6b848	6
428	6303	Room 6303 Deluxe Lantai 3	1	07add636953cba2e3dca2474902e13dd	7
371	5106	Room 5106 Deluxe Lantai 1	1		5
363	6121	Room 6121 Deluxe Lantai 1	1	51ea5b5e6a3c293d40b0ead3afd480da	5
335	3518	Room 3518 Premiere Lantai 5	1		4
410	5205	Room 5205 Deluxe Lantai 2	1	1b1d40c5d6b061622af64f02fc93cdec	6
365	6123	Room 6123 Deluxe Lantai 1	1	c3d7ebce47ff5ff0d84986ad62195cf6	5
411	5206	Room 5206 Deluxe Lantai 2	1		6
414	5209	Room 5209 Deluxe Lantai 2	1		6
220	1306	Room 1306 Premiere Lantai 3	1	87a0c6e0dc528f8231792a18654028e2	3
377	5112	Room 5112 Deluxe Lantai 1	1	07021c5fb8c225441e7f553b79f608d0	5
322	3502	Room 3502 Premiere Lantai 5	1		4
409	5203	Room 5203 Deluxe Lantai 2	1	742ffb531855a4113db12dcadc2124a0	6
398	6216	Room 6216 Deluxe Lantai 2	1	666e89df1214a14cd534fa7ba8b00415	6
352	6108	Room 6108 Deluxe Lantai 1	1		5
345	3528	Room 3528 Premiere Lantai 5	1		4
391	6207	Room 6207 Deluxe Lantai 2	1	e93903cc2c868ce51f5aa5491f1a3a58	6
394	6210	Room 6210 Deluxe Lantai 2	1	01d0fa12085cf17fa5862bfe58c063c7	6
392	6208	Room 6208 Deluxe Lantai 2	1	6b4d9af2e3c9e72ba5012018e90b1363	6
359	6117	Room 6117 Deluxe Lantai 1	1		5
406	6224	Room 6224 Deluxe Lantai 2	1	25677c5b3568652636d6a9f38179b4d8	6
325	3506	Room 3506 Premiere Lantai 5	1		4
417	5212	Room 5212 Deluxe Lantai 2	1	8ac705be5a303ec5f746f8997fe0930c	6
338	3521	Room 3521 Premiere Lantai 5	1		4
222	1305B	Room 1305B Premiere Lantai 3	1	\N	3
426	6301	Room 6301 Deluxe Lantai 3	1	e306581b5f6fb525f42608ef5c0b4332	7
413	5208	Room 5208 Deluxe Lantai 2	1	da9b37f5eb2965d704c1a72bb867b1ac	6
223	1305C	Room 1305C Premiere Lantai 3	1	\N	3
418	5215	Room 5215 Deluxe Lantai 2	1	c64c1fecc90950e7de10d7c823ce7773	6
402	6220	Room 6220 Deluxe Lantai 2	1	bf2e34f58ddb87db3522df5d454cad74	6
405	6223	Room 6223 Deluxe Lantai 2	1	59013de331e6ab54002dd0d21e13d56c	6
334	3517	Room 3517 Premiere Lantai 5	1		4
421	5218	Room 5218 Deluxe Lantai 2	1	e718ab80c6526ec2fca2d32990aa92f5	6
225	1302	Room 1302 Premiere Lantai 3	1		3
415	5210	Room 5210 Deluxe Lantai 2	1	33f29f6da4f9f58a54304337a4c991e9	6
408	5202	Room 5202 Deluxe Lantai 2	1	bcd2cf65f9aca20d91a1bd12acaee0ac	6
393	6209	Room 6209 Deluxe Lantai 2	1	8b7c8612822277de0d2ed4398c78babc	6
423	5220	Room 5220 Deluxe Lantai 2	1		6
382	5119	Room 5119 Deluxe Lantai 1	1		5
343	3526	Room 3526 Premiere Lantai 5	1		4
362	6120	Room 6120 Deluxe Lantai 1	1		5
379	5116	Room 5116 Deluxe Lantai 1	1		5
344	3527	Room 3527 Premiere Lantai 5	1		4
340	3523	Room 3523 Premiere Lantai 5	1		4
425	5222	Room 5222 Deluxe Lantai 2	1	6ce1cd90213fbd153979d9acff5cce91	6
330	3511	Room 3511 Premiere Lantai 5	1		4
373	5108	Room 5108 Deluxe Lantai 1	1	fdbc988b862ac54a3b5514c47bf84ba4	5
388	6203	Room 6203 Deluxe Lantai 2	1	057cf456fd1503c4d733053b566c1bb4	6
346	6101	Room 6101 Deluxe Lantai 1	1		5
416	5211	Room 5211 Deluxe Lantai 2	1	4ed412227621fc0e9b051547c7f196bc	6
395	6211	Room 6211 Deluxe Lantai 2	1	e09c96622ab6adca5d0c8ce5a5309fd0	6
353	6109	Room 6109 Deluxe Lantai 1	1	7dd302168e9314ed886e70a0144bc721	5
369	5103	Room 5103 Deluxe Lantai 1	1		5
403	6221	Room 6221 Deluxe Lantai 2	1	167e2b3c41d4b72f7824c899382e0dca	6
383	5120	Room 5120 Deluxe Lantai 1	1		5
387	6202	Room 6202 Deluxe Lantai 2	1	47d0d731a557f1f319bafe9fa3873d3f	6
361	6119	Room 6119 Deluxe Lantai 1	1		5
381	5118	Room 5118 Deluxe Lantai 1	1		5
400	6218	Room 6218 Deluxe Lantai 2	1	ab5790f54aa0afcbc4e9a45c2304d49a	6
592	3132	3132	1		9
384	5121	Room 5121 Deluxe Lantai 1	1	390802fef9251a302c366898a60f85d1	5
401	6219	Room 6219 Deluxe Lantai 2	1	0fa6c81e87032688ee42a7e4e789da24	6
440	6318	Room 6318 Deluxe Lantai 3	1	75d1be227f1af059c17085217a16a8bf	7
495	5510	Room 5510 Deluxe Lantai 5	1	20bd35ec5eb3354ede581c7a64952833	8
467	6502	Room 6502 Deluxe Lantai 5	1	ce0b0da7f4d7d71e15196ab55542a321	8
510	3133	3133	1		9
459	5316	Room 5316 Deluxe Lantai 3	1	37bbd8a60bd699ac9575dfaa67ebd476	7
441	6319	Room 6319 Deluxe Lantai 3	1	309cf1cd9d0bbd8d43c67f86f57d2611	7
458	5315	Room 5315 Deluxe Lantai 3	1	9533c82dddb1f18ca2284f9825e5d9db	7
451	5306	Room 5306 Deluxe Lantai 3	1		7
486	6524	Room 6524 Deluxe Lantai 5	1	6279d7d1a4e9ef2b002c73bf6e5efb27	8
494	5509	Room 5509 Deluxe Lantai 5	1		8
328	3509	Room 3509 Premiere Lantai 5	1		4
434	6310	Room 6310 Deluxe Lantai 3	1	0496bb73b99c6702b54c6c0ffe05f4bf	7
489	5503	Room 5503 Deluxe Lantai 5	1	0e6e1b1d1f0e177297a5bbf7561e4eba	8
438	6316	Room 6316 Deluxe Lantai 3	1	324e41fa7cd060eda4fd3ef12ada96f1	7
455	5310	Room 5310 Deluxe Lantai 3	1	53b5b5f91f059752ec645f287ebbf3e8	7
531	MeetingRoom1C	Meeting Room 1 C	1	\N	10
478	6516	Room 6516 Deluxe Lantai 5	1	630c7a36401ecb8fde43679bb9a43921	8
491	5506	Room 5506 Deluxe Lantai 5	1	87f772bff3409db82cff0279edeb8009	8
466	6501	Room 6501 Deluxe Lantai 5	1	7f2d9a6f1cf8a486433adb3bb9db6a8c	8
460	5317	Room 5317 Deluxe Lantai 3	1	f067cd7705f9c9ef93fb1eddb7fc8718	7
437	6315	Room 6315 Deluxe Lantai 3	1	6934457c251d66ed7db017242934efe4	7
530	MeetingRoom1B	Meeting Room 1 B	1	\N	10
483	6521	Room 6521 Deluxe Lantai 5	1	efc0f8e9dea1c393da145c73ee89e388	8
523	BallroomD	Ballroom D	1	\N	10
518	DepartureLounge	Departure Lounge	1	\N	10
519	EarlyBreakfast	Early Breakfast	1	\N	10
526	KunyitRestoA	Kunyit Resto A	1	\N	10
527	KunyitRestoB	Kunyit Resto B	1	\N	10
528	KunyitRestoC	Kunyit Resto C	1	\N	10
532	MeetingRoom1D	Meeting Room 1 D	1	\N	10
533	MeetingRoom1E	Meeting Room 1 E	1	\N	10
534	MeetingRoom1F	Meeting Room 1 F	1	\N	10
538	MeetingRoom2D	Meeting Room 2 D	1	\N	10
482	6520	Room 6520 Deluxe Lantai 5	1	a1e3e3255a032137d0e55790ecc6a2f7	8
445	6323	Room 6323 Deluxe Lantai 3	1	837e91fe384b2bbb8571da5624d328ae	7
477	6515	Room 6515 Deluxe Lantai 5	1	af0e23d4ae1458a549059c1c8ee50c70	8
436	6312	Room 6312 Deluxe Lantai 3	1	5308e806163679dabf9d07b2c094eae2	7
492	5507	Room 5507 Deluxe Lantai 5	1		8
480	6518	Room 6518 Deluxe Lantai 5	1	770db8314ec452849cbb00488677d92f	8
472	6508	Room 6508 Deluxe Lantai 5	1	e9ea5c4066fc9e58da15081a13c2d702	8
500	5517	Room 5517 Deluxe Lantai 5	1	6cd8c85393a4b287d3c2fa9cb1eeba0b	8
490	5505	Room 5505 Deluxe Lantai 5	1	bea623ba903af19f16e4345040111aa6	8
484	6522	Room 6522 Deluxe Lantai 5	1	48daa03c5c88d4d81ecd518e6f485b1e	8
502	5519	Room 5519 Deluxe Lantai 5	1	68043eac5a636d992ff196ab56b76905	8
454	5309	Room 5309 Deluxe Lantai 3	1		7
521	BallroomB	Ballroom B	1	\N	10
429	6305	Room 6305 Deluxe Lantai 3	1	6e10721d88dd4f6c880153090ea64da0	7
497	5512	Room 5512 Deluxe Lantai 5	1	892860544d9015ea084de5deb228410e	8
535	MeetingRoom2A	Meeting Room 2 A	1	\N	10
254	2503	Room 2503 Premiere Lantai 5	1		4
452	5307	Room 5307 Deluxe Lantai 3	1	49597ba2d9edb3367377a770710cdd43	7
461	5318	Room 5318 Deluxe Lantai 3	1	09eceb1844dca7a4056af7fbf0feccfc	7
537	MeetingRoom2C	Meeting Room 2 C	1	\N	10
464	5321	Room 5321 Deluxe Lantai 3	1	d71e7b7d13d11c16e183b45ff3e08609	7
498	5515	Room 5515 Deluxe Lantai 5	1	ec12e3eba023fb8c73f0c6d2377cc5cb	8
504	5521	Room 5521 Deluxe Lantai 5	1	5333bc46d8c9201fdec7c08ece8e56c4	8
474	6510	Room 6510 Deluxe Lantai 5	1	a9eaa340d6699c5c254bcc96bb6696be	8
431	6307	Room 6307 Deluxe Lantai 3	1	7e57285d5c5fa046782405bf6477d697	7
463	5320	Room 5320 Deluxe Lantai 3	1	7a64743484a17b3029c0ca40d1d37937	7
453	5308	Room 5308 Deluxe Lantai 3	1	3186f0dad7130a74757f1d0ffdbd236d	7
536	MeetingRoom2B	Meeting Room 2 B	1	\N	10
469	6505	Room 6505 Deluxe Lantai 5	1	b820be29ae7127bd9b3262603c14eb7d	8
593	3131	3131	1		9
520	BallroomA	Ballroom A	1	\N	10
529	MeetingRoom1A	Meeting Room 1 A	1	\N	10
456	5311	Room 5311 Deluxe Lantai 3	1	2c94c62a4ab03e34657439863674707f	7
457	5312	Room 5312 Deluxe Lantai 3	1	026710aeaaa731c1184173b854db0198	7
524	BallroomE	Ballroom E	1	\N	10
503	5520	Room 5520 Deluxe Lantai 5	1	ddc58bdd206a1c396a47d46ea23c67f2	8
465	5322	Room 5322 Deluxe Lantai 3	1	80321a32c6e1c6536c0045689d52df98	7
449	5303	Room 5303 Deluxe Lantai 3	1	0ee26c9bd72c3d33861d283a2269cc7e	7
496	5511	Room 5511 Deluxe Lantai 5	1	c35ea7dd70adaae8b5e2d1300ad53498	8
525	BallroomF	Ballroom F	1	\N	10
545	MeetingRoom3E	Meeting Room 3 E	1	\N	10
546	MeetingRoom3F	Meeting Room 3 F	1	\N	10
547	MeetingRoom3G	Meeting Room 3 G	1	\N	10
548	MeetingRoom3H	Meeting Room 3 H	1	\N	10
549	BussinesCenter	Bussines Center	1	\N	10
539	MeetingRoom2E	Meeting Room 2 E	1	\N	10
540	MeetingRoom2F	Meeting Room 2 F	1	\N	10
255	2505	Room 2505 Premiere Lantai 5	1		4
277	2529	Room 2529 Premiere Lantai 5	1		4
21	2124	Room 2124 Premiere Lantai 1	1	619aac11259106beced16e7419b709f6	1
273	2525	Room 2525 Premiere Lantai 5	1		4
427	6302	Room 6302 Deluxe Lantai 3	1	97e3507bc2b1190fb6c26401b43c72a2	7
226	1301	Room 1301 Premiere Lantai 3	1		3
430	6306	Room 6306 Deluxe Lantai 3	1	977c48932effff181e9122ef34752dd0	7
272	2524	Room 2524 Premiere Lantai 5	1		4
142	3210	Room 3210 Premiere Lantai 2	1		2
80	2210	Room 2210 Premiere Lantai 2	1		2
133	1201	Room 1201 Premiere Lantai 2	1		2
84	2216	Room 2216 Premiere Lantai 2	1	174d1765dccbce48a0eff2f391216f3b	2
542	MeetingRoom3B	Meeting Room 3 B	1	\N	10
541	MeetingRoom3A	Meeting Room 3 A	1	\N	10
543	MeetingRoom3C	Meeting Room 3 C	1	\N	10
189	2330	Room 2330 Premiere Lantai 3	1	b2c39a9ca43eee222365a43aaebd50b2	3
544	MeetingRoom3D	Meeting Room 3 D / Kemiri	1	\N	10
6	2107	Room 2107 Premiere Lantai 1	1		1
522	BallroomC	Ballroom C	1	\N	10
88	2220	Room 2220 Premiere Lantai 2	1	bcac7e51bc780012ef09eb2ea12fdd9d	2
420	5217	Room 5217 Deluxe Lantai 2	1	42de6ea7622236176c8ce98e6f26a82d	6
512	3133	Villa K 01 A	1		9
100	2232	Room 2232 Premiere Lantai 2	1	8a4f9bd3797b5426ef9b6d89800d094d	2
218	1308	Room 1308 Premiere Lantai 3	1		3
22	2125	Room 2125 Premiere Lantai 1	1		1
192	2333	Room 2333 Premiere Lantai 3	1	0f38a543bf8682791ad94d1c1498dd3a	3
256	2506	Room 2506 Premiere Lantai 5	1		4
447	5301	Room 5301 Deluxe Lantai 3	1	6c8fc138c1dc9c73f256fdb26e459865	7
262	2512	Room 2512 Premiere Lantai 5	1	d3930e2ef1e89201777bf8ee3120fe81	4
40	1101	Room 1101 Premiere Lantai 1	1		1
550	Spare	Spare	1	c609e3abfc549cd88ed8fea62d3f4c28	10
25	2128	Room 2128 Premiere Lantai 1	1		1
331	3512	Room 3512 Premiere Lantai 5	1		4
171	2310	Room 2310 Premiere Lantai 3	1		3
367	5101	Room 5101 Deluxe Lantai 1	1	5b1524d661ec17a443c1e1d2eb45f4ec	5
123	1211B	Room 1211B Premiere Lantai 2	1	\N	2
210	1312C	Room 1312C Premiere Lantai 3	1	\N	3
191	2332	Room 2332 Premiere Lantai 3	1		3
182	2323	Room 2323 Premiere Lantai 3	1	658cf429164f8fff8cc543a938b80abf	3
161	3231	Room 3231 Premiere Lantai 2	1		2
468	6503	Room 6503 Deluxe Lantai 5	1	020ca0e2ddf7e6e17f153e855b20bf29	8
306	1510B	Room 1510B Premiere Lantai 5	1	\N	4
166	2305	Room 2305 Premiere Lantai 3	1		3
178	2319	Room 2319 Premiere Lantai 3	1	bc2e02ec65c0dbb14c3ca4e0a440daf7	3
372	5107	Room 5107 Deluxe Lantai 1	1	47dd62c2ebef337537e8b0a1e6ba1892	5
448	5302	Room 5302 Deluxe Lantai 3	1		7
351	6107	Room 6107 Deluxe Lantai 1	1		5
230	3305	Room 3305 Premiere Lantai 3	1		3
275	2527	Room 2527 Premiere Lantai 5	1		4
70	3130	Room 3130A Premiere Lantai 1	1		1
95	2227	Room 2227 Premiere Lantai 2	1		2
76	2206	Room 2206 Premiere Lantai 2	1		2
172	2311	Room 2311 Premiere Lantai 3	1		3
249	3326	Room 3326 Premiere Lantai 3	1		3
412	5207	Room 5207 Deluxe Lantai 2	1	7e434c44ac3ff3bd5fa867708a20b9c6	6
167	2306	Room 2306 Premiere Lantai 3	1		3
51	3110	Room 3110 Premiere Lantai 1	1		1
175	2316	Room 2316 Premiere Lantai 3	1		3
261	2511	Room 2511 Premiere Lantai 5	1		4
488	5502	Room 5502 Deluxe Lantai 5	1	3aab3d2197cbe30364d1a45ba91dd7c0	8
169	2308	Room 2308 Premiere Lantai 3	1		3
389	6205	Room 6205 Deluxe Lantai 2	1	bf691bce93687a732d49ef52fc84e599	6
\.


--
-- Name: rooms_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('rooms_seq', 598, true);


--
-- Data for Name: roomsuite_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY roomsuite_translations (translation_id, roomsuites_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
7	1	  		
8	1	  		
9	2	  		
10	2	  		
12	2	  		
15	2	  		
16	2	  		
17	1	  		
18	1	  		
19	1	  		
20	1	  		
21	1	  		
22	2	  		
23	2	  		
24	2	  		
25	2	  		
26	2	  		
27	3	  		
28	3	  		
30	3	  		
33	3	  		
34	3	  		
35	4	  		
36	4	  		
38	4	  		
41	4	  		
42	4	  		
44	1	  		
45	1	  		
53	2	  		
46	1	  		
47	1	  		
48	1	  		
49	1	  		
50	1	  		
51	1	  		
54	2	  		
55	2	  		
56	2	  		
58	3	  		
59	3	  		
60	3	  		
61	3	  		
63	4	  		
64	4	  		
65	4	  		
66	4	  		
67	3	  		
68	3	  		
32	3	jp	エグゼクティブ	エグゼクティブルームは、各部屋には引き出しを含む文具セットで快適なソファ、ワークデスクが、クイーンベッド（180センチメートル×200センチ）またはツインベッド（110センチメートル×200センチ）から成ると、モダンなミニマリストのスタイルで設計されています。ベッドルームには、60以上のチャンネル付きのインタラクティブIPTV、セーフティボックス、ミニバー、コーヒー＆ティーメーカーを備えています。部屋は私達のゲストを甘やかすためのバスアメニティの広い範囲で完全なスタンディングシャワー付きのモダンなバスルームのデザインが施されています。&lt;br/&gt;\n\nご宿泊のお客様は、22階の上の私たちのクラブプレミアラウンジへの無料アクセスを提供しています。あなたのビジネスニーズのために、客室には、無料の無線高速インターネット接続が備わっています。
69	3	  		
70	3	  		
71	1	  		
72	1	  		
73	1	  		
74	1	  		
37	4	en	Deluxe Suites	Expansive open plan suites with all modern comforts while embracing the Hindu Bali culture in their design. &lt;br/&gt;&lt;br/&gt;All 8 deluxe suites feature King beds, separate bath and shower with panoramic garden and pool views.&lt;br/&gt;&lt;br/&gt;All rooms feature; Air-conditioning with climate control, Complimentary high speed Wi-Fi internet, 40”IPTV with over 90 channels available, Complimentary bottled drinking water, Mini Bar fridge, In - room safety box, Laundry and Dry cleaning services and  Complimentary tea and coffee making services.
57	3	cn	房間類別	豪華客房\n超值奢華的一百六十間好萊塢雙床房設計，三十點五平方房間面積，尋求現代化的舒適，而在房間的設計融入巴厘島阿迦文化。泳池景觀房與可以直接享受游泳池的通道
29	3	en	Deluxe Room	&lt;font size=&quot;4&quot;&gt;Affordable yet luxurious 160 Hollywood twin rooms designed to cater for those seeking modern comforts while embracing the Bali Aga culture in their design. &lt;br/&gt;&lt;br/&gt;All rooms enjoy pool views.\n&lt;br/&gt;&lt;br/&gt;All 30.5 square meter rooms feature; Air-conditioning with climate control, Complimentary high speed Wi-Fi internet, 40”IPTV with over 90 channels available, Complimentary bottled drinking water, Mini Bar fridge, In - room safety box, Laundry and Dry Cleaning services and Complimentary tea and coffee making services.&lt;/font&gt;
31	3	id	Deluxe Room	&lt;font size=&quot;4&quot;&gt;160 kamar Deluxe yang terjangkau dan berkesan mewah dan di desain secara khusus untuk Anda yang menyukai kebudayaan Bali Aga – Bali kuno yang kental.&lt;br/&gt;&lt;br/&gt;Fasilitas yang di tawarkan kamar berukuran 30,5 meter persegi ini adalah AC dengan pengaturan suhu otomatis, Wi-Fi, IPTV 40 inch dengan lebih dari 90 saluran TV, air minum kemasan, mini bar, safety box, layanan bantu dan mesin pembuat kopi.&lt;/font&gt;
62	4	cn	豪華套房	八間廣闊的開放式套房，而在他們的設計結合巴厘印度教文化的現代設施。所有豪華套房配備特大號床，獨立的浴缸，眺望亭園與泳池景色的衛浴設施。
39	4	id	Deluxe Suites	Kamar dengan ukuran lebih luas dan bernuansa Hindu Bali. &lt;br/&gt;&lt;br/&gt;Semua kamar dengan tipe ini dilengkapi dengan tempat tidur kualitas terbaik, kamar mandi yang terpisah dengan pemandangan spektakuler dari taman dan kolam renang. &lt;br/&gt;&lt;br/&gt;Fasilitas yang di tawarkan kamar berukuran 65,8 meter persegi ini adalah AC dengan pengaturan suhu otomatis, Wi-Fi, IPTV 40 inch dengan lebih dari 90 saluran TV, air minum kemasan, mini bar, safety box, layanan bantu dan mesin pembuat kopi.
75	2	  		
76	2	  		
77	2	  		
78	2	  		
79	2	  		
80	2	  		
6	1	jp	サンティカスイーツ	ホテルの最上階に位置し、私たちのサンティカスイートは、豪華さと甘さの異なるクラスを提供しています。広々とした快適なリビングルームでは、サンティカスイートはエレガンス、洗練、豪華さと個人的なサービスの最高レベルをお求めのお客様のために設計されています。 &lt;/br&gt;\n\nマスターベッドルームには60以上のチャンネル付きのインタラクティブIPTV、セーフティボックス、ミニバー、ラウンジチェア、ドレッシングエリア、テレビ視聴、または単にコーヒーや軽食を楽しむのに居心地の良いソファが装備されています。バスルームには、お客様を甘やかすためのバスアメニティの広い範囲での完全なレインシャワーを備えています。 &lt;/br&gt;\n\nご宿泊のお客様は、22階の上の私たちのクラブプレミアラウンジへの無料アクセスを提供しています。無料の無線高速インターネット接続がご滞在中ご利用いただけます。 &lt;/br&gt;
81	2	  		
82	2	  		
83	2	  		
84	2	  		
14	2	jp	プレミアスイート	私たちの70平方メートルの客室にはキングサイズのベッドを使用したモダンなミニマリストスタイルで設計されています。客室には、壮大なジャカルタの街並みの景色を眺めることができます。豪華な枕をのせた贅沢な、非常に魅力的なベッドは夜の最も安らかを保証するために設計されています。ベッドルームには、60以上のチャンネル、セーフティボックス、ミニバー、コーヒー＆ティーメーカー、インタラクティブIPTVが装備されています。バスルームには、お客様を甘やかすためのバスアメニティの広い範囲での完全なレインシャワーを備えています。 &lt;br/&gt;\n\nご宿泊のお客様は、22階の上の私たちのクラブプレミアラウンジへの無料アクセスを提供しています。あなたのビジネスニーズのために、客室には、無料の無線高速インターネット接続が備わっています。
85	2	  		
86	2	  		
87	4	  		
88	4	  		
40	4	jp	デラックス	私たちのデラックスルームは、各部屋は快適なソファ、ワークデスクが、クイーンベッド（180センチメートル×200センチ）またはツインベッド（110センチメートル×200センチ）から成ると、モダンなミニマリストのスタイルで設計されています。ベッドルームには、60以上のチャンネル付きのインタラクティブIPTV、セーフティボックス、ミニバー、コーヒー＆ティーメーカーを備えています。部屋は私達のゲストを甘やかすためにバスアメニティの広い範囲で完全なスタンディングシャワー付きのモダンなバスルームのデザインが施されています。あなたのビジネスニーズのために、客室には、無料の無線高速インターネット接続が備わっています。
89	4	  		
90	4	  		
91	1	  		
92	1	  		
93	2	  		
94	2	  		
95	3	  		
96	3	  		
97	4	  		
98	4	  		
99	1	  		
5	1	id	The Anvaya Suites	&lt;font size=&quot;4&quot;&gt; Kamar berbentuk suites yang di desain secara duplex (konsep kamar atas dan bawah) dengan luas 117 meter persegi. \n&lt;br/&gt;&lt;br/&gt; Dilengkapi dengan fasilitas kamar mandi terpisah dengan kamar tidur dan juga kamar tamu yang nyaman untuk bersantai,.\n &lt;br/&gt;&lt;br/&gt; Kamar ini juga memiliki akses langsung ke kolam lagoon.&lt;br/&gt;&lt;br/&gt;Semua kamar di tipe Anvaya Suites ini dilengkapi AC dengan pengaturan suhu otomatis, Wi-Fi, IPTV 40 inch dengan lebih dari 90 saluran TV, air minum kemasan, mini bar, safety box, layanan bantu dan mesin pembuat kopi.&lt;/font&gt;
13	2	id	Beach Front Private Suites	&lt;font size=&quot;4&quot;&gt;Untuk Anda yang lebih menyukai privasi, tipe kamar berukuran 95 meter persegi ini sangatlah cocok untuk Anda. &lt;br/&gt;&lt;br/&gt;Dilengkapi dengan fasilitas kolam renang di luar kamar, bulan madu ataupun wisata bersama keluarga akan menjadi lebih menyenangkan. &lt;br/&gt;&lt;br/&gt;Kamar mandi yang lebih luas dengan akses langsung ke kolam renang dan juga pemandangan laut yang spektakuler dari teras kamar.\n&lt;br/&gt;&lt;br/&gt;Semua kamar di tipe Beach Front Suite ini dilengkapi AC dengan pengaturan suhu otomatis, Wi-Fi, IPTV 40 inch dengan lebih dari 90 saluran TV, air minum kemasan, mini bar, safety box, layanan bantu dan mesin pembuat kopi.&lt;/font&gt;
43	1	cn	ANVAYA套房	十間豪華複式風格的套房。納入所有配備獨立浴缸，淋浴間，衛生間和客廳的現代設施。所有套房均設有私人陽台花園與美麗連接湖和游泳池的景色。
52	2	cn	海滨私人套房	百分之百的隱私，八間九十五平方米的套房配有各種現代化的元素以及私人游泳池。雙花灑淋浴，獨立的浴缸和衛生間用額外私人的休息室和游泳池以及海灘私人通道。
100	1	  		
101	2	  		
102	2	  		
103	3	  		
104	3	  		
105	4	  		
106	4	  		
107	5	  		
110	5	  		
111	6	  		
114	6	  		
115	7	  		
118	7	  		
139	1	  		
119	1	  		
141	1	  		
121	2	  		
123	3	  		
125	4	  		
120	1	kr	Anvaya 스위트	117m2의 고급스러운 이중 스타일의 스위트 룸. 별도의 욕조, 샤워 실 및 거실과 모든 현대적인 편의 시설을 통합. 10 개의 스위트 룸은 넓은 아직 전용 발코니에서 정원, 라군과 수영장의 멋진 전망을 갖추고 있습니다.
126	4	kr	디럭스 스위트	모든 현대적인 편의 시설과 넓은 오픈 플랜 스위트 룸은 설계에서 힌두 발리의 문화를 수용하면서. 모든 8 디럭스 스위트 룸은 킹 사이즈 침대, 탁 트인 정원과 수영장 전망을 갖춘 별도의 욕조와 샤워 시설을 갖추고 있습니다.
128	5	  		
112	6	en	Premiere Suites	Simply lavish in their style and comfort, incorporating all the modern touches one could wish for. &lt;br/&gt;&lt;br/&gt;The six, 85 square meter suites feature King beds, private balcony and stunning garden, pool and lagoon views. &lt;br/&gt;&lt;br/&gt;All rooms feature; Air-conditioning with climate control, Complimentary high speed Wi-Fi internet, 40”IPTV with over 90 channels available, Complimentary bottled drinking water, Mini Bar fridge, In - room safety box, Laundry and Dry cleaning services and  Complimentary tea and coffee making services.
124	3	kr	디럭스 룸	자신의 디자인에있는 발리 아가 문화를 포용하면서 현대적인 편안함을 추구하는 사람들을 위해 수용하도록 설계 저렴한 아직 고급스러운 160 할리우드 트윈 룸. 모든 객실은 수영장 전망을 즐길 수 있습니다.
131	6	  		
117	7	id	The Anvaya Villa	Di desain secara khusus untuk Anda yang mencari kemewahan berkelas, kamar berukuran 440 meter persegi ini memiliki dua kamar tidur dengan desain villa yang menawan.&lt;br/&gt;&lt;br/&gt;Villa yang luas dengan fasilitas kamar mandi serta Bale dengan pemandangan laut yang begitu menakjubkan. Dengan kenyamanan tamu sebagai prioritas utama, kami menyediakan asisten selama Anda menginap di Anvaya Villa. &lt;br/&gt;&lt;br/&gt;Semua kamar di tipe The ANVAYA Villa ini dilengkapi AC dengan pengaturan suhu otomatis, Wi-Fi, IPTV 40 inch dengan lebih dari 90 saluran TV, air minum kemasan, mini bar, safety box, layanan bantu dan mesin pembuat kopi.
108	5	en	Premiere Room	302 Spaciously designed twin and king bedded rooms incorporating the Hindu Bali culture with all the modern comforts. &lt;br/&gt;&lt;br/&gt;All ground floor rooms with direct access to the gardens and lagoons while all upper floor rooms feature balconies with garden and lagoon views.&lt;br/&gt;&lt;br/&gt;All 35.5 square meter rooms feature; Air-conditioning with climate control, Complimentary high speed Wi-Fi internet, 40”IPTV with over 90 channels available, Complimentary bottled drinking water, Mini Bar fridge, In - room safety box, Laundry and Dry cleaning services and  Complimentary tea and coffee making services.
134	7	  		
109	5	id	Premiere Room	302 kamar premier yang luas mengangkat konsep Hindu Bali dengan kenyamanan yang khas bernuansa modern. &lt;br/&gt;&lt;br/&gt;Kamar-kamar yang terletak di lantai bawah memiliki akses langsung ke kolam renang yang berbentuk lagoon sedangkan kamar yang terletak di lantai atas memiliki pemandangan ke taman hotel yang rindang.&lt;br/&gt;&lt;br/&gt;Fasilitas yang di tawarkan kamar berukuran 35,5 meter persegi ini adalah AC dengan pengaturan suhu otomatis, Wi-Fi, IPTV 40 inch dengan lebih dari 90 saluran TV, air minum kemasan, mini bar, safety box, layanan bantu dan mesin pembuat kopi.
136	2	  		
129	5	kr	프리미어 룸	(302)은 넓고 트윈 설계 왕은 모든 현대적인 편의 시설 힌두 발리의 문화를 통합 객실을 침대. 정원과 라군에 직접 액세스 할 수있는 모든 층의 객실은 모두 위층 객실은 정원과 라군 전망 발코니를 갖추고있다.
137	1	  		
140	1	  		
138	1	  		
142	1	  		
143	1	  		
144	1	  		
145	1	  		
146	1	  		
147	1	  		
130	6	cn	總理套房	極簡豪華的風格與舒適，結合所有的現代元素人們渴望的。 六間，八十五平方米套房設有特大號床，獨立的浴缸，淋浴和衛生間，私人陽台和迷人的花園，泳池和連接湖美景。
148	3	  		
113	6	id	Premiere Suites	Di desain secara khusus dengan kenyamanan kualitas terbaik namun masih dalam tampilan modern. &lt;br/&gt;&lt;br/&gt;6 Premier Suites dengan ukuran 85 meter persegi di desain dengan Kasur berukuran besar, kamar mandi dan balkon dengan pemandangan kolam renang, lagoon dan taman. &lt;br/&gt;&lt;br/&gt;Fasilitas yang di tawarkan di kamar ini adalah AC dengan pengaturan suhu otomatis, Wi-Fi, IPTV 40 inch dengan lebih dari 90 saluran TV, air minum kemasan, mini bar, safety box, layanan bantu dan mesin pembuat kopi.
149	4	  		
132	6	kr	프리미어 스위트	하나의 소원을 수있는 모든 현대적인 접촉을 통합, 자신의 스타일과 편안함을 단순히 호화로운. 여섯 85 평방 미터의 스위트 룸은 킹 사이즈 침대, 전용 발코니와 아름다운 정원, 수영장과 라군 전망을 제공합니다.
133	7	cn	该Anvaya别墅	专为那些谁寻求纯粹的豪华，这440平方米两间卧室的别墅，有独立的卫生间和广阔的私人阳台，一张沙发床，享受精致的海景。与每一个可以想象的舒适设计，它是由你自己的私人管家服务。
150	5	  		
151	6	  		
152	7	  		
153	1	  		
154	1	  		
155	3	  		
156	4	  		
157	5	  		
158	6	  		
159	7	  		
160	7	  		
192	1	  		
161	6	  		
162	5	  		
163	4	  		
164	6	  		
165	7	  		
205	1	  		
166	6	  		
167	5	  		
168	4	  		
169	3	  		
170	3	  		
171	1	  		
172	3	  		
173	3	  		
174	1	  		
175	3	  		
176	5	  		
177	4	  		
178	6	  		
179	1	  		
180	2	  		
181	2	  		
193	1	  		
182	1	  		
183	1	  		
184	2	  		
201	2	  		
185	2	  		
195	3	  		
186	3	  		
187	4	  		
188	5	  		
189	5	  		
190	6	  		
191	7	  		
209	1	  		
194	2	  		
122	2	kr	비치 프론트 스위트	완벽한 개인 정보 보호를 위해 8 개의 95m2의 스위트 룸은 하나가 할 수있는 모든 현대적인 접촉을 통합 자신의 개인 수영장을 갖추고 있습니다. 아름다운 바다 전망과 함께 추가로 별도의 아직 서비스 라운지와 수영장에 개인 액세스 할 수있는 듀얼 레인 샤워와 목욕.
196	4	  		
127	5	cn	尊貴客房	三百零二間房間設 計寬敞雙人房和特大號床間結合了巴厘印度教文化與所有的現代設施。所有地面樓層的客房可直接進入花園和連接湖，而所有上部樓層的客房設有帶花園和連接湖景色的陽台。\n所有三十點五平方米客房均配備;空調與氣候控制，免費高速無線網絡連接，40“IPTV有超過90個頻道，免費瓶裝飲用水，迷你酒吧冰箱，在 - 室內保險箱，洗衣及乾洗服務和免費的茶水和咖啡 服務。
197	5	  		
198	6	  		
202	2	  		
199	7	  		
11	2	en	Beach Front Private Suites	&lt;font size=&quot;4&quot;&gt;For complete privacy, the 8 (eight), 95 square meter suites feature their own private pool with all the modern touches one could wish for. &lt;br/&gt;&lt;br/&gt; Dual rain shower, separate  bath and toilet  with private access to an additional separate yet serviced lounge and pool with spectacular ocean views.\n&lt;br/&gt;&lt;/br&gt;All rooms feature; Air-conditioning with climate control, Complimentary high speed Wi-Fi internet, 40”IPTV with over 90 channels available, Complimentary bottled drinking water, Mini Bar fridge, In - room safety box, Laundry and Dry cleaning services and  Complimentary tea and coffee making services.&lt;/font&gt;
200	7	  		
135	7	kr	Anvaya 빌라	순수한 고급 스러움을 추구하는 사람들, 별도의 욕실과 아름다운 바다 전망을 즐길 수있는 넓은 전용 발코니에서 하루 침대이 440m2 두 베드룸 빌라 설계되었습니다. 상상할 수있는 모든 편의를 설계, 그것은 자신의 개인 집사에 의해 서비스됩니다.
206	1	  		
203	2	  		
204	2	  		
210	1	  		
116	7	en	The ANVAYA Villa	Designed for those who seek pure luxury, this 440 square meter two bedroom villa with separate bathrooms and a day bed on the expansive private balcony to enjoy exquisite ocean views. &lt;br/&gt;&lt;br/&gt;Designed with every comfort imaginable, it is serviced by your own private butler. &lt;br/&gt;&lt;br/&gt;Features of the Anvaya Villa include;   24 hour full butler service, Air-conditioning with climate control, Complimentary high speed Wi-Fi internet access, 40”IPTV with over 90 channels available, Docking station with quality Hi Fi standard speakers, Complimentary bottled drinking water, Mini Bar fridge, In - room safety box, Laundry and Dry cleaning services and Complimentary tea and coffee making services.
207	7	  		
208	7	  		
3	1	en	The ANVAYA Suites	&lt;font size=&quot;4&quot;&gt;Luxurious duplex style suites of 117 square meters. &lt;br/&gt;&lt;br/&gt;Incorporating all the modern comforts with separate bath, shower and living room. &lt;br/&gt;&lt;br/&gt;All ten suites feature stunning views of the garden, lagoons and pools from their expansive yet private balconies.&lt;br/&gt;&lt;br/&gt;All rooms feature; Air-conditioning with climate control, Complimentary high speed Wi-Fi internet, 40”IPTV with over 90 channels available, Complimentary bottled drinking water, Mini Bar fridge, In - room safety box, Laundry and Dry cleaning services and  Complimentary tea and coffee making services.&lt;/font&gt;
\.


--
-- Name: roomsuite_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('roomsuite_translations_translation_id_seq', 210, true);


--
-- Data for Name: roomsuites; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY roomsuites (roomsuites_id, roomsuites_image, roomsuites_image_enabled, roomsuites_clip, roomsuites_clip_enabled, roomsuites_enabled, roomsuites_order) FROM stdin;
3	deluxe-room	0		0	1	3
4	deluxe-suites	0		0	1	4
5	premiere-room	0		0	1	5
6	premiere-suites	0		0	1	6
2	beach-front-suites	0		0	1	2
7	the-anvaya-villa	0		0	1	7
1	anvaya-suites	0		0	1	1
\.


--
-- Name: roomsuites_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('roomsuites_seq', 7, true);


--
-- Data for Name: runningtext_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY runningtext_groupings (message_id, room_id, message_grouping_id) FROM stdin;
1	4	7050
1	5	7051
1	8	7052
1	9	7053
1	11	7054
1	12	7055
1	51	7056
16	61	14989
16	62	14990
16	63	14991
16	64	14992
16	65	14993
16	66	14994
16	67	14995
16	68	14996
16	69	14997
16	70	14998
16	71	14999
16	72	15000
16	73	15001
16	74	15002
16	75	15003
16	76	15004
16	77	15005
16	78	15006
16	79	15007
16	80	15008
16	81	15009
16	82	15010
16	83	15011
16	84	15012
16	85	15013
16	86	15014
16	87	15015
16	88	15016
16	89	15017
16	90	15018
16	91	15019
16	92	15020
16	93	15021
16	94	15022
16	95	15023
16	96	15024
16	97	15025
16	98	15026
16	99	15027
16	100	15028
16	101	15029
16	102	15030
16	103	15031
16	104	15032
16	105	15033
16	106	15034
16	107	15035
16	108	15036
16	109	15037
16	110	15038
16	111	15039
16	112	15040
16	113	15041
16	114	15042
16	115	15043
16	116	15044
16	117	15045
16	118	15046
16	119	15047
16	120	15048
16	161	15049
16	162	15050
16	163	15051
16	35	15052
16	36	15053
7	36	15054
6	61	14706
6	62	14707
6	63	14708
6	64	14709
6	65	14710
6	66	14711
6	67	14712
6	68	14713
6	69	14714
6	70	14715
6	71	14716
6	72	14717
6	73	14718
6	74	14719
6	75	14720
6	76	14721
6	77	14722
6	78	14723
6	79	14724
6	80	14725
6	81	14726
6	82	14727
6	83	14728
6	84	14729
6	85	14730
6	86	14731
6	87	14732
6	88	14733
6	89	14734
6	90	14735
6	91	14736
6	92	14737
6	93	14738
6	94	14739
6	95	14740
6	96	14741
6	97	14742
6	98	14743
6	99	14744
6	100	14745
6	101	14746
6	102	14747
6	103	14748
6	104	14749
6	105	14750
6	106	14751
6	107	14752
6	108	14753
6	109	14754
6	110	14755
6	111	14756
6	112	14757
6	113	14758
6	114	14759
6	115	14760
6	116	14761
6	117	14762
6	118	14763
6	119	14764
6	120	14765
6	161	14766
6	162	14767
6	163	14768
6	164	14769
6	165	14770
6	166	14771
6	167	14772
6	168	14773
6	169	14774
6	170	14775
6	171	14776
6	172	14777
6	173	14778
6	174	14779
6	175	14780
6	176	14781
6	177	14782
6	178	14783
6	179	14784
6	180	14785
6	181	14786
6	182	14787
6	183	14788
6	184	14789
6	185	14790
6	186	14791
6	187	14792
6	188	14793
6	189	14794
6	190	14795
6	191	14796
6	192	14797
6	193	14798
6	194	14799
6	195	14800
6	196	14801
6	197	14802
6	198	14803
6	199	14804
6	200	14805
6	201	14806
6	202	14807
6	203	14808
6	204	14809
6	205	14810
6	206	14811
6	207	14812
6	208	14813
6	209	14814
6	210	14815
6	211	14816
6	212	14817
6	213	14818
6	214	14819
6	215	14820
6	217	14821
6	218	14822
6	219	14823
6	220	14824
6	221	14825
6	222	14826
6	223	14827
6	224	14828
6	225	14829
6	226	14830
6	227	14831
6	228	14832
6	229	14833
6	230	14834
6	231	14835
6	232	14836
6	233	14837
6	234	14838
6	235	14839
6	236	14840
6	237	14841
6	238	14842
6	239	14843
6	240	14844
6	241	14845
6	242	14846
6	243	14847
6	244	14848
6	245	14849
6	246	14850
6	247	14851
6	248	14852
6	249	14853
6	250	14854
6	251	14855
6	252	14856
6	253	14857
6	254	14858
6	255	14859
6	256	14860
6	257	14861
6	258	14862
6	259	14863
6	260	14864
6	261	14865
6	262	14866
6	263	14867
6	264	14868
6	265	14869
6	266	14870
6	267	14871
6	268	14872
6	269	14873
6	270	14874
6	271	14875
6	272	14876
6	273	14877
6	274	14878
6	275	14879
6	276	14880
6	277	14881
6	278	14882
6	279	14883
6	280	14884
6	121	14885
6	122	14886
6	123	14887
6	124	14888
6	125	14889
6	126	14890
6	127	14891
6	128	14892
6	129	14893
6	130	14894
6	131	14895
6	132	14896
6	133	14897
6	134	14898
6	135	14899
6	136	14900
6	137	14901
6	138	14902
6	139	14903
6	140	14904
6	141	14905
6	142	14906
6	143	14907
6	144	14908
6	145	14909
6	146	14910
6	147	14911
6	148	14912
6	149	14913
6	150	14914
6	151	14915
6	152	14916
6	153	14917
6	154	14918
6	155	14919
6	156	14920
6	157	14921
6	158	14922
6	159	14923
6	160	14924
6	1	14925
6	2	14926
6	3	14927
6	4	14928
6	5	14929
6	6	14930
6	7	14931
6	8	14932
6	9	14933
6	10	14934
6	11	14935
6	12	14936
6	13	14937
6	14	14938
6	15	14939
6	16	14940
6	17	14941
6	18	14942
6	19	14943
6	20	14944
6	21	14945
6	22	14946
6	23	14947
6	24	14948
6	25	14949
6	26	14950
6	27	14951
6	28	14952
6	29	14953
6	30	14954
6	31	14955
6	32	14956
6	33	14957
6	34	14958
6	35	14959
6	36	14960
6	37	14961
6	38	14962
6	39	14963
6	40	14964
6	41	14965
6	42	14966
6	43	14967
6	44	14968
6	45	14969
6	46	14970
6	47	14971
6	48	14972
6	49	14973
6	50	14974
6	51	14975
6	52	14976
6	53	14977
6	54	14978
6	55	14979
6	56	14980
6	57	14981
6	58	14982
6	59	14983
6	60	14984
6	282	14985
6	281	14986
6	284	14987
6	283	14988
47	569	19643
55	433	57942
56	433	58467
57	433	58468
58	475	60566
50	30	30458
\.


--
-- Name: runningtext_groupings_message_grouping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('runningtext_groupings_message_grouping_id_seq', 1, false);


--
-- Name: runningtext_groupings_message_grouping_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('runningtext_groupings_message_grouping_id_seq1', 86872, true);


--
-- Data for Name: runningtext_logs; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY runningtext_logs (runningtext_log_time, runningtext_log_user, runningtext_log_browser, message_id, message_text) FROM stdin;
1502175893	Roberto Tonjaw, tonjaw	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0	870	Test
\.


--
-- Data for Name: runningtext_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY runningtext_translations (message_id, language_id, translation_message, translation_description, translation_id) FROM stdin;
1				17
1				18
1				19
1039				6433
371	cn	tes		3027
371	en	tes		3028
1				23
821				5803
1				53
1				131
1				24
1				25
371	id	tes		3029
371				3030
371	kr	tes		3031
1				54
1				55
1				56
1				32
1035				6676
1				57
1				58
1				33
1				34
1				113
1				35
1039	cn	SAKANTI SPA PROMOTION &quot;BUY1GET1&quot; FREE of ‘60 minutes Awakening full body massage “. Available from 9AM–12PM or call ext.80285		6430
1039	en	SAKANTI SPA PROMOTION &quot;BUY1GET1&quot; FREE of ‘60 minutes Awakening full body massage “. Available from 9AM–12PM or call ext.80285		6431
1039	id	SAKANTI SPA PROMOTION &quot;BUY1GET1&quot; FREE of ‘60 minutes Awakening full body massage “. Available from 9AM–12PM or call ext.80285		6432
1039	kr	SAKANTI SPA PROMOTION &quot;BUY1GET1&quot; FREE of ‘60 minutes Awakening full body massage “. Available from 9AM–12PM or call ext.80285		6434
1				36
1				37
1				38
1				39
1				40
1				101
1				41
1				42
1				43
1				44
934				5908
1				125
1				114
1				45
1				46
1				102
1				103
870	cn			5577
870	en	Test		5578
1				115
870	id			5579
870				5580
870	kr			5581
1				132
1				133
1				89
1039				6595
1				126
1				127
1				107
1				90
1				91
1				92
1				93
1				94
1				108
1				109
1				119
1				120
1				121
1				137
1				155
1				138
1				139
1				149
1				143
1				144
1				145
1				150
1				151
1				156
1				157
1				161
1				162
1				163
1	de	Willkommen bei Watermark Hotel &amp; Spa		2
1	fr	Bienvenue à Watermark Hôtel &amp; Spa		4
1	kr	워터 마크 호텔 &amp; 스파에 오신 것을 환영합니다		7
1	ru	Добро пожаловать в Watermark Hotel &amp; Spa		8
1				167
1				168
1				169
1				170
1				171
1				172
1				173
1				174
1				175
1				176
1				177
1				178
1				179
1				180
5				182
5				184
5				187
5				188
1				189
1				190
1				191
1				192
5				193
5				194
5				195
5				196
1				197
1				198
1				199
1				200
5				201
5				202
5				203
5				204
1				205
1				206
1				207
1				208
5				209
5				210
5				211
5				212
1				213
1				214
1				215
1				216
1				217
1				218
1				219
1				220
5				221
5				222
5				223
5				224
5				225
5				226
5				227
5				228
5				229
5				230
5				231
5				232
1	jp	ウォーターマークホテル＆スパへようこそ		6
5				233
1				263
5				234
1				264
5				235
5				236
5				237
5				238
5				239
5				240
1				241
1				242
1				243
1				244
5				245
5				246
5				247
5				248
1				249
1				250
1				251
1				252
1				253
1				254
1				255
1				256
1				257
1				258
1				259
1				260
1	cn	歡迎水印溫泉酒店		1
1				261
1				262
6				299
5				265
5				283
5				266
5				284
6				300
5				267
5				268
5				285
5				269
5				270
5				286
5				301
5				271
5				272
5				315
5				273
5				287
5				274
5				288
6				312
5				275
5				276
5				289
5				277
5				278
5				290
5				302
5				279
5				280
5				316
5				281
5				318
5				282
5				303
6				307
6				308
5				291
5				292
6				294
6				296
5				304
6				305
5				313
6				306
6				309
6				310
6				311
5				314
5				319
1	en	Welcome to Santika Premiere Hayam Wuruk Jakartaa		3
5				317
1	id	Selamat Datang di Santika Premiere Hayam Wuruk Jakarta		5
5				320
6				321
6				322
6				323
6				324
5				325
5				326
5				327
5				328
5				329
5				330
5				331
5				332
6				333
6				334
5				488
6				335
6				336
6				337
6				338
6				339
6				340
7				342
7				344
5	jp	[GUEST],私たちはあなたに私たちとの素晴らしい夜を望む...22階に私たちのレストランやクラブプレミアラウンジでは素晴らしい食べ物や飲み物であなたを提供する準備が整いました		186
6	en	Good morning [GUEST], start your day with breakfast at our Restaurant..Have a great day !		295
5	id	[GUEST], Selamat menikmati malam bersama kami..Restaurant dan Lounge kami di lantai 22 siap melayani Anda dengan berbagai pilihan makanan dan minuman		185
7				347
7				348
5				349
5				350
5				351
5				352
1				431
259	id	Dear [GUEST], We would like to inform that some area in hotel, such as  Sands, kunyit, main gate and beach front side there will be no lighting from 11 PM to 3 AM due to village ceremonial ritual		2440
5				361
5				362
5				363
5				364
6				365
6				366
6				367
6				368
6				369
6				370
821	cn	Dear [GUEST], Our Sakanti Spa have special ‘ Happy Hours  from 9.00AM – 12.00AM everyday BUY 1 GET 1 FREE FOR 60 MINUTES RELAXING MASSAGE ‘ For reservation please dial '80285' or '0'		5314
1				432
821	en	Dear [GUEST], Our Sakanti Spa have special ‘ Happy Hours  from 9.00AM – 12.00AM everyday BUY 1 GET 1 FREE FOR 60 MINUTES RELAXING MASSAGE ‘ For reservation please dial '80285' or '0'		5315
259	en	Dear [GUEST], We would like to inform that some area in hotel, such as  Sands, kunyit, main gate and beach front side there will be no lighting from 11 PM to 3 AM due to village ceremonial ritual		2439
5				377
5				378
5				379
5				380
5				381
5				382
7				383
7				384
1				433
7				385
1				434
7				386
7				387
7				388
7				389
7				390
1				435
7				391
1				436
7				392
7				393
7				394
5				401
5				402
5				403
5				404
5				405
5				406
6				407
6				408
6				409
6				410
6				411
6				412
5				413
5				414
5				415
5				416
5				417
5				418
6				419
6				420
6				421
6				422
6				423
6				424
7				425
7				426
7				463
7				427
7				428
7				429
7				430
1039				6677
5				443
5				444
5				445
5				446
5				447
5				448
6				449
6				450
6				451
6				452
6				453
6				454
7				455
7				456
6				467
7				457
6				468
7				458
7				459
7				460
7				461
7				462
7				464
7				465
7				466
6				469
6				470
6				471
6				472
6				473
6				474
6				475
6				476
259				2441
7				481
7				482
7				483
7				484
5				485
5				486
5				487
5				489
5				490
5				491
5				492
5				493
5				494
5				495
5				496
5				497
5				498
5				499
5				500
5				501
9				550
5				502
7	cn	晚安 [GUEST], 恭喜休息......如果你还需要帮助，请联系我们的值班经理在EXT.2		341
7	id	Selamat malam [GUEST], selamat beristirahat...apabila Anda masih membutuhkan bantuan silahkan menghubungi Duty Manager kami di ext.2		345
7	jp	おやすみ [GUEST], それでもサポートが必要な場合お祝いレスト... ext.2で私達のデューティ·マネージャにお問い合わせください		346
5				503
5				504
7				505
7				506
7				507
7				508
7				509
7				583
7				510
7				511
7				512
5				517
9				552
5				518
5				519
5				520
5				521
5				611
5				522
5				523
5				524
8				526
8				528
8				531
8				532
8				533
8				534
9				555
9				556
8				535
8				536
10	cn	[Guest], 由于技术问题，目前我们无法正常播放我们的电视频道....我们真的很抱歉造成不便。		569
8				537
10				577
8				538
10	en	[Guest], due to technical problem, at the moment we cannot broadcast our TV channels properly....we are really sorry for inconvenience caused.		571
10				578
8				539
8				540
127				1703
127	en	Dear [GUEST], may this New Year brings you a peace filled life, warmth and togetherness in your family and much prosperity! HAPPY NEW YEAR 2017...		1701
127	id	Dear [GUEST], may this New Year brings you a peace filled life, warmth and togetherness in your family and much prosperity! HAPPY NEW YEAR 2017...		1702
127	kr	Dear [GUEST], may this New Year brings you a peace filled life, warmth and togetherness in your family and much prosperity! HAPPY NEW YEAR 2017...		1704
8	id	[GUEST], Lewati malam Anda dengan menikmati berbagai minuman di lantai atas (22) dan indahnya pemandangan kota Jakarta di waktu malam.		529
8				561
8	jp	[GUEST], 街のスカイラインの絶景（ - 22日最上階）を楽しみながらリラックスして、私たちのプレミアラウンジでいくつかの飲み物を持っています		530
8				562
8				599
8				563
8				564
9				565
9				566
9				567
9				568
10				570
10				572
10				575
10				576
10	id	[Guest], karena masalah teknis, saat ini kami tidak dapat menyiarkan saluran TV kami .... kami mohon maaf atas ketidaknyamanannya		573
10	jp	[Guest], 技術的な問題のために、我々は適切に私たちのテレビチャンネルを放送することはできません現時点では....私たちは不便が生じたために、本当に申し訳ありません。		574
10				579
10				580
7				581
7				595
7				582
7				584
7				585
7				596
7				586
7				587
7				588
6				589
6				590
6				591
6				592
7				593
7				594
8	cn	[GUEST], 放松心情，有一些饮料在我们的首映休息室一边欣赏城市天际线的美景（顶楼 - 22日）		525
8				597
8	en	[GUEST], Relax and have some drinks in our Premiere Lounge while enjoying the superb view of the city skyline (top floor - 22nd)		527
8				598
8				600
9				601
9				602
9				603
9				604
127	cn	Dear [GUEST], may this New Year brings you a peace filled life, warmth and togetherness in your family and much prosperity! HAPPY NEW YEAR 2017...		1700
5				609
5				610
5				612
7	en	Good night [GUEST], have a good sleep...should you need any help please do not hesitate to contact our Duty Manager at Ext.2		343
9	cn	[GUEST]，您可以在室内按摩服务......请联系分机。 6获得有吸引力的优惠，从我们。		549
9	en	[GUEST], Enjoy in-room massage services ... please contact ext. 6 to get great offers from us.		551
259				5804
5	cn	[GUEST], 我们希望您有一个美好的夜晚与我们...我们的餐厅和俱乐部首映酒廊22楼随时准备为您提供美味的食品和饮料		181
6	id	Selamat pagi [GUEST], selamat menikmati makan pagi di Restaurant kami.....Selamat beraktifitas dan semoga hari Anda menyenangkan.		297
6	jp	早上好 [GUEST], 私たちのレストラン.....おめでとう活動、うまくいけば良い一日に朝の食事をお楽しみください。		298
5	en	[GUEST], we wish you a great evening with us...Our Restaurant and Club Premiere Lounge at 22nd floor are ready to serve you with great food and drinks		183
9	id	[GUEST], Nikmati layanan massage dalam kamar...segera hubungi ext. 6 untuk mendapatkan penawaran menarik dari kami.		553
9	jp	[GUEST]、室内マッサージサービスをお楽しみください...内線にお問い合わせください。図6は、私たちから魅力的なオファーを取得します。		554
6	cn	早上好 [GUEST], 享受你早上吃饭在我们餐厅.....祝贺活动，希望美好的一天。		293
15	cn			629
15	en	Test 2		630
15	id	Tes 2		631
15	jp			632
14	cn			625
14	en	Test 1		626
14	id	Tes 1		627
14	jp			628
16	cn			633
16	en	Running text jam 5		634
16	id	Running text jam 5		635
16	jp			636
1035				6678
1035	id	Dear valued [GUEST], Berkaitan dengan fenomena peningkatan aktivitas vulkanik dan gempa secara terus-menerus maka status Gunung Agung di Kabupaten Karangasem Provinsi Bali dinaikkan dari Siaga (Level 3) menjadi Awas (Level 4).   Gunung Agung terletak kira-kira 75 KM dari Kuta-Bali. Pemerintah daerah menghimbau untuk menunda berbagai kegiatan seperti melakukan pendakian, untuk tidak berkemah di dalam area kawah Gunung Agung dan di seluruh area dalam radius 9 kilometer dari kawah puncak Gunung Agung. Sedangkan untuk kegiatan pariwisata di daerah Bali Selatan tetap berjalan seperti biasa dan jadwal penerbangan dipantau dengan ketat.  Hotel Manajemen		6411
1035	kr	Dear valued [GUEST], As you may heard in the news over the past days, increased volcano activities from Mount Agung has led to an increase in the alert level to level 4. Mount Agung is situated approx. 75 km from Kuta.  Local authorities have temporarily suspended all outdoor activities such as hiking and camping activities in proximity to the crater.  As for south Bali and Kuta business remains as usual and flights are as per schedule while closely monitored. Your management		6413
1035				6412
821				5317
821	id	Dear [GUEST], Our Sakanti Spa have special ‘ Happy Hours  from 9.00AM – 12.00AM everyday BUY 1 GET 1 FREE FOR 60 MINUTES RELAXING MASSAGE ‘ For reservation please dial '80285' or '0'		5316
821	kr	Dear [GUEST], Our Sakanti Spa have special ‘ Happy Hours  from 9.00AM – 12.00AM everyday BUY 1 GET 1 FREE FOR 60 MINUTES RELAXING MASSAGE ‘ For reservation please dial '80285' or '0'		5318
259	kr	Dear [GUEST], We would like to inform that some area in hotel, such as  Sands, kunyit, main gate and beach front side there will be no lighting from 11 PM to 3 AM due to village ceremonial ritual		2442
1035	cn	Dear valued [GUEST], As you may heard in the news over the past days, increased volcano activities from Mount Agung has led to an increase in the alert level to level 4. Mount Agung is situated approx. 75 km from Kuta.  Local authorities have temporarily suspended all outdoor activities such as hiking and camping activities in proximity to the crater.  As for south Bali and Kuta business remains as usual and flights are as per schedule while closely monitored. Your management		6409
1035	en	Dear valued [GUEST], As you may heard in the news over the past days, increased volcano activities from Mount Agung has led to an increase in the alert level to level 4. Mount Agung is situated approx. 75 km from Kuta.  Local authorities have temporarily suspended all outdoor activities such as hiking and camping activities in proximity to the crater.  As for south Bali and Kuta business remains as usual and flights are as per schedule while closely monitored. Your management		6410
47	cn			893
47	en	Good evening		894
47	id	Selamat sore		895
47				896
47				897
50				979
50				980
50	cn	Welcome to The Anvaya Beach Resorts Bali		976
50				983
50				984
50	en	Welcome to The Anvaya Beach Resorts Bali		977
50	id	Selamat Datang di The Anvaya Beach Resorts Bali		978
50				987
50				988
127				1706
50				1005
50				1006
50				1007
50				1008
50				1009
50				1010
50				1011
50				1012
50				1013
50				1014
50				1015
50				1016
50				1017
50				1018
1035				6414
868	cn			5567
868	en	NAVICOM IPTV		5568
868	id			5569
868				5570
868	kr			5571
127				1707
370	cn	tes		3022
370	en	tes		3023
370	id	tes		3024
370				3025
370	kr	tes		3026
259				5802
259	cn	Dear [GUEST], We would like to inform that some area in hotel, such as  Sands, kunyit, main gate and beach front side there will be no lighting from 11 PM to 3 AM due to village ceremonial ritual		2438
55	cn			1209
55	en	Welcome [GUEST]		1210
55	id	Selamat Datang [GUEST]		1211
55				1212
55				1213
56	cn			1216
56	en	Welcome [GUEST]		1217
56	id	Selamat Datang [GUEST]		1218
56				1219
56				1220
57	cn			1221
57	en	Welcome [GUEST]		1222
57	id	Selamat Datang [GUEST]		1223
57				1224
57				1225
259				2448
934				5906
934	cn	Dear [GUEST], please be informed we are currently having some issues with our telephone system. Please accept our sincere apology for the inconvenience caused.		5903
869	cn			5572
869	en	Test		5573
869	id			5574
869				5575
58				1241
58				1242
58	cn	Welcome to The Anvaya		1238
58	en	Welcome to The Anvaya		1239
58	id	Welcome to The Anvaya		1240
58				1243
58				1244
869	kr			5576
934	en	Dear [GUEST], please be informed we are currently having some issues with our telephone system. Please accept our sincere apology for the inconvenience caused.		5904
934	id	Dear [GUEST], please be informed we are currently having some issues with our telephone system. Please accept our sincere apology for the inconvenience caused.		5905
934	kr	Dear [GUEST], please be informed we are currently having some issues with our telephone system. Please accept our sincere apology for the inconvenience caused.		5907
\.


--
-- Name: runningtext_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('runningtext_translations_translation_id_seq', 9, true);


--
-- Name: runningtext_translations_translation_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('runningtext_translations_translation_id_seq1', 6678, true);


--
-- Data for Name: runningtext_zone_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY runningtext_zone_groupings (message_zone_grouping_id, message_id, zone_id) FROM stdin;
221	1	2
225	16	4
226	16	5
227	16	6
228	16	7
229	16	8
230	16	9
231	16	10
232	16	11
233	16	12
234	16	13
235	16	14
236	16	1
237	16	2
238	16	3
239	7	4
240	7	5
241	7	6
242	7	7
243	7	8
244	7	9
245	7	10
246	7	11
247	7	12
248	7	13
249	7	14
250	7	1
251	7	2
252	7	3
6329	1035	5
6330	1035	6
6331	1035	7
6332	1035	8
6333	1035	1
6334	1035	2
6146	934	5
6147	934	6
6148	934	7
6149	934	8
6150	934	1
6151	934	2
6152	934	3
6153	934	4
6154	934	10
6155	934	9
6156	934	11
6335	1035	3
6336	1035	4
6337	1035	10
6338	1035	9
6339	1035	11
3279	127	5
3280	127	6
3281	127	7
3282	127	8
3283	127	1
3284	127	2
3285	127	3
3286	127	4
3287	127	10
3288	127	9
3289	127	11
\.


--
-- Name: runningtext_zone_groupings_runningtext_zone_grouping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('runningtext_zone_groupings_runningtext_zone_grouping_id_seq', 6339, true);


--
-- Data for Name: runningtexts; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY runningtexts (message_global, message_enabled, message_id, message_schedule_start, message_schedule_end, message_daily, message_order) FROM stdin;
1	0	127	1483189200	1483261200	0	4
1	0	259	1502841600	1502942400	1	1
1	0	821	1502928000	1502938800	1	2
1	0	934	1503115200	1503122400	0	1
1	0	1039	1505347200	1506744000	1	1
1	1	1035	1506268800	1509462000	0	1
\.


--
-- Name: runningtexts_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('runningtexts_seq', 1087, true);


--
-- Data for Name: service_group_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY service_group_translations (translation_id, service_group_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
7	1	  		
8	1	  		
9	2	  		
10	2	  		
12	2	  		
15	2	  		
16	2	  		
18	2	  		
19	2	  		
143	6	  		
105	6	  		
20	2	  		
21	2	  		
23	1	  		
24	1	  		
6	1	jp		
25	1	  		
26	1	  		
28	3	  		
30	3	  		
33	3	  		
34	3	  		
36	4	  		
38	4	  		
41	4	  		
42	4	  		
44	5	  		
46	5	  		
49	5	  		
50	5	  		
52	6	  		
54	6	  		
57	6	  		
58	6	  		
60	7	  		
62	7	  		
65	7	  		
66	7	  		
67	2	  		
144	6	  		
68	2	  		
69	2	  		
70	2	  		
71	3	  		
72	3	  		
73	3	  		
74	3	  		
75	5	  		
155	4	  		
76	5	  		
156	4	  		
77	5	  		
78	5	  		
106	6	  		
79	6	  		
129	7	  		
80	6	  		
107	6	  		
130	7	  		
81	6	  		
82	6	  		
108	6	  		
83	6	  		
145	6	  		
84	6	  		
131	7	  		
109	6	  		
85	6	  		
86	6	  		
110	6	  		
87	6	  		
146	6	  		
88	6	  		
111	6	  		
132	7	  		
89	6	  		
90	6	  		
112	6	  		
91	6	  		
92	6	  		
147	4	  		
113	6	  		
93	6	  		
94	6	  		
114	6	  		
95	6	  		
133	7	  		
96	6	  		
115	6	  		
134	7	  		
97	6	  		
98	6	  		
116	6	  		
99	6	  		
100	6	  		
135	7	  		
101	6	  		
102	6	  		
136	7	  		
103	6	  		
104	6	  		
117	6	  		
118	6	  		
119	6	  		
151	5	  		
120	6	  		
152	5	  		
121	6	  		
122	6	  		
137	7	  		
123	7	  		
138	7	  		
124	7	  		
148	4	  		
125	7	  		
126	7	  		
127	7	  		
159	5	  		
128	7	  		
139	2	  		
140	2	  		
141	2	  		
142	2	  		
149	4	  		
150	4	  		
153	5	  		
154	5	  		
157	4	  		
158	4	  		
160	5	  		
161	5	  		
162	5	  		
163	6	  		
164	6	  		
165	6	  		
166	6	  		
167	7	  		
168	7	  		
169	7	  		
170	7	  		
171	3	  		
172	3	  		
173	3	  		
174	3	  		
175	2	  		
176	2	  		
177	2	  		
178	2	  		
179	7	  		
180	7	  		
14	2	jp	飲料	
40	4	jp	インドネシアデライト	
56	6	jp	グリルから	
64	7	jp	簡単バイツ	
48	5	jp	サラダとスープ	
32	3	jp	デザート	
181	7	  		
182	7	  		
183	7	  		
184	7	  		
185	7	  		
39	4	id	Indonesian Delight	Available from 11.00 AM - 11.00 PM
13	2	id	Fresh Juices	Available 24 Hours
31	3	id	Dessert	Available from 07:00 AM - 10:00 PM
27	3	cn	甜点	Available from 07:00 AM - 10:00 PM
55	6	id	Pasta	Available from 11.00 AM - 11.00 PM
186	7	  		
187	2	  		
188	2	  		
189	2	  		
190	2	  		
191	2	  		
192	2	  		
193	2	  		
194	2	  		
195	4	  		
196	4	  		
197	4	  		
198	4	  		
199	6	  		
200	6	  		
201	6	  		
202	6	  		
203	7	  		
204	7	  		
205	7	  		
206	7	  		
207	5	  		
208	5	  		
209	5	  		
210	5	  		
211	3	  		
212	3	  		
213	3	  		
214	3	  		
215	2	  		
216	2	  		
217	2	  		
218	2	  		
219	5	  		
220	5	  		
221	4	  		
222	4	  		
223	4	  		
224	4	  		
225	7	  		
320	12	en	dimsum	Available from 07.00 AM - 01.00 AM
226	7	  		
227	5	  		
228	5	  		
229	5	  		
277	5	  		
230	5	  		
231	8	  		
234	8	  		
235	2	  		
304	10	  		
236	2	  		
237	2	  		
238	2	  		
239	4	  		
278	1	  		
296	1	  		
241	5	  		
243	6	  		
279	3	  		
247	8	kr		Available 24 Hours
246	8	  		
248	1	  		
250	1	  		
280	4	  		
251	6	  		
310	11	cn	Side Dishes	Available from 11.00 AM - 11.00 PM
242	5	kr		Available from 11.00 AM - 11.00 PM
321	12	id	dimsum	Available from 07.00 AM - 01.00 AM
295	10	kr	Signature Cocktail	Available from 07.00 AM - 01.00 AM
252	8	  		
22	1	cn		
268	9	cn	便餐	
269	9	en	Light Bites	
270	9	id	Light Bites	
253	7	  		
255	6	  		
281	9	  		
256	3	  		
258	2	  		
260	3	  		
286	1	  		
261	1	  		
272	9	kr	라이트 바이 츠	
262	1	  		
333	6	  		
263	1	  		
297	4	  		
282	6	  		
5	1	id		
313	11	  		
264	7	  		
265	4	  		
283	5	  		
291	10	cn	Signature Cocktail	Available from 07.00 AM - 01.00 AM
287	3	  		
266	7	  		
323	12	kr	dimsum	Available from 07.00 AM - 01.00 AM
59	7	cn	易咬伤	
61	7	en	Light Bites	
63	7	id	Light Bites	
267	7	  		
254	7	kr	라이트 바이 츠	
271	9	  		
259	2	kr	Fresh Juices	Available 24 Hours
337	3	  		
305	5	  		
273	9	  		
288	1	  		
314	11	kr	Side Dishes	Available from 11.00 AM - 11.00 PM
274	6	  		
298	1	  		
284	1	  		
306	3	  		
292	10	en	Signature Cocktail	Available from 07.00 AM - 01.00 AM
275	5	  		
289	1	  		
276	4	  		
318	11	  		
319	12	cn	dimsum	Available from 07.00 AM - 01.00 AM
299	1	  		
307	1	  		
285	1	  		
233	8	id	Juice	Available 24 Hours
290	1	  		
341	2	  		
294	10	  		
308	2	  		
249	1	kr		
245	8	cn	Juice	Available 24 Hours
300	1	  		
257	3	kr	디저트	Available from 07:00 AM - 10:00 PM
315	11	  		
3	1	en		
301	1	  		
339	12	  		
302	4	  		
303	4	  		
327	12	  		
309	10	  		
316	1	  		
325	1	  		
317	11	  		
322	12	  		
324	4	  		
326	1	  		
328	12	  		
329	3	  		
330	3	  		
331	4	  		
332	4	  		
334	6	  		
335	5	  		
336	5	  		
338	3	  		
340	12	  		
342	2	  		
343	4	  		
344	4	  		
345	8	  		
346	8	  		
347	11	  		
348	11	  		
349	6	  		
350	6	  		
351	5	  		
352	5	  		
353	10	  		
354	10	  		
355	1	  		
356	1	  		
357	5	  		
358	5	  		
443	4	  		
359	6	  		
360	6	  		
361	3	  		
362	3	  		
363	12	  		
364	12	  		
365	8	  		
366	8	  		
367	3	  		
368	3	  		
369	2	  		
370	2	  		
444	4	  		
371	6	  		
372	6	  		
373	10	  		
374	10	  		
375	3	  		
376	3	  		
377	5	  		
378	5	  		
37	4	en	Indonesian Delight	Available from 11.00 AM - 11.00 PM
379	6	  		
380	6	  		
381	3	  		
382	3	  		
383	11	  		
384	11	  		
385	3	  		
386	3	  		
387	5	  		
388	5	  		
389	3	  		
390	3	  		
391	3	  		
392	3	  		
393	4	  		
394	4	  		
395	11	  		
396	11	  		
312	11	id	Side Dishes	Available from 11.00 AM - 11.00 PM
397	6	  		
398	6	  		
399	5	  		
400	5	  		
445	11	  		
401	6	  		
402	6	  		
403	5	  		
404	5	  		
405	3	  		
406	3	  		
407	4	  		
408	4	  		
409	11	  		
410	11	  		
446	11	  		
411	6	  		
412	6	  		
413	3	  		
414	3	  		
490	15	kr	Healthy Drink	Available from 11.00 AM - 11.00 PM
447	3	  		
415	4	  		
416	4	  		
448	3	  		
35	4	cn	印尼喜悦	Available from 11.00 AM - 11.00 PM
417	11	  		
418	11	  		
449	3	  		
450	3	  		
419	6	  		
420	6	  		
451	12	  		
421	3	  		
422	3	  		
452	12	  		
423	3	  		
424	3	  		
453	8	  		
425	4	  		
426	4	  		
454	8	  		
479	14	en	BEER	Available 24 Hours
427	4	  		
428	4	  		
429	3	  		
430	3	  		
311	11	en	Side Dishes	Available from 11.00 AM - 11.00 PM
470	13	  		
431	11	  		
432	11	  		
482	14	kr	BEER	Available 24 Hours
433	6	  		
434	6	  		
435	3	  		
436	3	  		
455	5	  		
437	3	  		
438	3	  		
456	5	  		
439	3	  		
440	3	  		
471	13	  		
441	3	  		
442	3	  		
45	5	en	Soup	Available from 11.00 AM - 11.00 PM
461	13	cn	Cold	Available 24 Hours
457	10	  		
458	10	  		
459	2	  		
460	2	  		
464	13	  		
465	13	  		
466	2	  		
467	2	  		
474	6	  		
476	6	  		
468	13	  		
469	13	  		
293	10	id	Signature Cocktail	Available from 07.00 AM - 01.00 AM
472	2	  		
473	2	  		
53	6	en	Pasta	Available from 11.00 AM - 11.00 PM
475	6	  		
477	6	  		
487	15	en	Healthy Drink	Available from 11.00 AM - 11.00 PM
481	14	  		
484	13	kr	Cold	Available 24 Hours
483	13	  		
478	14	cn	BEER	Available 24 Hours
485	14	  		
51	6	cn	意大利面和意大利面条	Available from 11.00 AM - 11.00 PM
489	15	  		
29	3	en	Dessert	Available from 07:00 AM - 10:00 PM
480	14	id	BEER	Available 24 Hours
488	15	id	Healthy Drink	Available from 11.00 AM - 11.00 PM
463	13	id	Cold	Available 24 Hours
232	8	en	Juice	Available 24 Hours
17	2	cn	饮料	Available 24 Hours
43	5	cn	沙拉和汤	Available from 11.00 AM - 11.00 PM
462	13	en	Cold	Available 24 Hours
494	16	  		
499	17	  		
504	18	  		
506	15	  		
510	19	  		
515	20	  		
517	14	  		
629	6	  		
547	20	  		
579	6	  		
518	18	  		
564	16	  		
511	19	kr	Hot	Available 24 Hours
565	6	  		
599	22	  		
519	18	  		
596	22	  		
520	14	  		
521	13	  		
522	3	  		
523	2	  		
593	22	  		
524	15	  		
566	18	  		
531	21	cn	Flavored Ice Tea	Available 24 Hours
567	14	  		
525	16	  		
568	13	  		
569	3	  		
605	15	  		
486	15	cn	Healthy Drink	Available from 11.00 AM - 11.00 PM
526	17	  		
244	6	kr	파스타 및 스파게티	Available from 11.00 AM - 11.00 PM
570	21	  		
548	17	  		
502	18	en	Soft Drink	Available 24 Hours
527	19	  		
571	2	  		
528	13	  		
529	13	  		
509	19	id	Hot	Available 24 Hours
549	16	  		
530	20	  		
590	22	id	Promo	Promo from 12:00 PM - 06:00 PM Get Free Ice Tea
534	21	  		
550	6	  		
533	21	id	Flavored Ice Tea	Available 24 Hours
580	18	  		
536	21	  		
615	14	  		
551	18	  		
581	13	  		
606	19	  		
537	20	  		
572	15	  		
538	14	  		
539	13	  		
540	3	  		
600	14	  		
601	13	  		
624	4	  		
541	21	  		
573	19	  		
542	2	  		
594	22	  		
543	15	  		
574	4	  		
575	11	  		
544	19	  		
597	22	  		
545	4	  		
546	11	  		
607	4	  		
602	3	  		
552	14	  		
553	13	  		
554	3	  		
576	20	  		
507	19	cn	Hot	Available 24 Hours
595	22	  		
555	21	  		
620	21	  		
582	6	  		
613	17	  		
583	5	  		
556	21	  		
503	18	id	Soft Drink	Available 24 Hours
557	2	  		
609	20	  		
558	15	  		
589	22	en	Promo	Promo from 12:00 PM - 06:00 PM Get Free Ice Tea
584	19	  		
505	18	kr	Soft Drink	Available 24 Hours
559	19	  		
616	14	  		
560	4	  		
561	11	  		
617	14	  		
618	13	  		
585	17	  		
562	20	  		
619	3	  		
508	19	en	Hot	Available 24 Hours
498	17	id	Water	Available 24 Hours
513	20	en	Milk Shake &amp; Smoothies	Available from 07:00 AM - 10:00 PM
563	17	  		
586	20	  		
611	6	  		
621	2	  		
577	17	  		
598	4	  		
630	5	  		
514	20	id	Milk Shake &amp; Smoothies	Available from 07:00 AM - 10:00 PM
535	21	kr	Flavored Ice Tea	Available 24 Hours
578	16	  		
587	13	  		
591	22	  		
610	16	  		
496	17	cn	Water	Available 24 Hours
497	17	en	Water	Available 24 Hours
603	21	  		
516	20	kr	Milk Shake &amp; Smoothies	Available from 07:00 AM - 10:00 PM
604	2	  		
622	15	  		
625	11	  		
608	11	  		
493	16	id	Non Alcoholic Cocktails	Available from 07:00 AM - 01:00 AM
495	16	kr	Non Alcoholic Cocktails	Available from 07:00 AM - 01:00 AM
588	22	cn	Promo	Promo from 12:00 PM - 06:00 PM Get Free Ice Tea
612	18	  		
592	22	kr	Promo	Promo from 12:00 PM - 06:00 PM Get Free Ice Tea
614	5	  		
240	4	kr	Indonesian Delight	Available from 11.00 AM - 11.00 PM
532	21	en	Flavored Ice Tea	Available 24 Hours
501	18	cn	Soft Drink	Available 24 Hours
623	19	  		
491	16	cn	Non Alcoholic Cocktails	Available from 07:00 AM - 01:00 AM
492	16	en	Non Alcoholic Cocktails	Available from 07:00 AM - 01:00 AM
626	20	  		
627	16	  		
628	18	  		
500	17	kr	Water	Available 24 Hours
512	20	cn	Milk Shake &amp; Smoothies	Available from 07:00 AM - 10:00 PM
631	17	  		
632	22	  		
633	14	  		
634	14	  		
635	13	  		
636	3	  		
637	21	  		
638	2	  		
639	15	  		
640	19	  		
641	4	  		
642	11	  		
643	20	  		
644	16	  		
645	6	  		
646	18	  		
647	5	  		
648	17	  		
649	14	  		
650	14	  		
651	13	  		
652	3	  		
653	21	  		
654	2	  		
655	15	  		
656	19	  		
657	4	  		
658	11	  		
659	20	  		
660	16	  		
661	6	  		
662	18	  		
663	5	  		
664	17	  		
665	22	  		
666	14	  		
667	13	  		
668	3	  		
669	12	  		
670	21	  		
671	2	  		
672	15	  		
673	19	  		
674	4	  		
675	8	  		
676	11	  		
677	20	  		
678	16	  		
679	6	  		
680	22	  		
681	10	  		
682	18	  		
683	5	  		
684	17	  		
685	14	  		
686	13	  		
687	3	  		
688	21	  		
751	14	  		
689	2	  		
690	15	  		
691	19	  		
692	4	  		
693	11	  		
694	20	  		
695	16	  		
696	6	  		
697	22	  		
698	18	  		
744	24	  		
699	5	  		
700	17	  		
701	22	  		
702	22	  		
703	22	  		
704	14	  		
705	13	  		
706	3	  		
707	21	  		
770	14	  		
708	2	  		
709	15	  		
710	19	  		
711	4	  		
712	11	  		
713	20	  		
714	16	  		
715	6	  		
716	22	  		
717	18	  		
729	24	kr	Salad	Available 24 Hours
718	5	  		
719	17	  		
723	23	  		
728	24	  		
733	25	  		
752	2	  		
740	23	  		
735	25	  		
725	24	cn	Salad	Available 24 Hours
726	24	en	Salad	Available 24 Hours
745	24	  		
760	26	kr	Western	Available 24 Hours
736	23	  		
731	25	en	MOCKTAIL	Available from 07.00 AM - 10.00 PM
732	25	id	MOCKTAIL	Available from 07.00 AM - 10.00 PM
734	25	kr	MOCKTAIL	Available from 07.00 AM - 10.00 PM
753	15	  		
737	24	  		
754	8	  		
746	25	  		
756	26	cn	Western	Available 24 Hours
928	38	en	Main Courses Nite	Available from 23.00 - 06.00
738	25	  		
772	23	  		
774	14	  		
747	23	  		
739	25	  		
741	23	  		
755	11	  		
742	23	  		
759	26	  		
763	11	  		
764	11	  		
743	25	  		
765	3	  		
761	26	  		
775	27	cn	WINE	Available 24 Hours
748	5	  		
780	28	cn	Cocktail Promotion	Available from 06.00 PM - 09:00 PM
749	5	  		
750	22	  		
776	27	en	WINE	Available 24 Hours
768	26	  		
779	27	kr	WINE	Available 24 Hours
762	26	  		
766	11	  		
720	23	cn	Signature Dishes	Available from 11.00 AM - 11.00 PM
724	23	kr	Signature Dishes	Available from 11.00 AM - 11.00 PM
11	2	en	Fresh Juices	Available 24 Hours
767	26	  		
769	26	  		
757	26	en	Western	Available 24 Hours
771	26	  		
773	3	  		
778	27	  		
783	28	  		
758	26	id	Western	Available 24 Hours
721	23	en	Signature Dishes	Available from 11.00 AM - 11.00 PM
730	25	cn	MOCKTAIL	Available from 07.00 AM - 10.00 PM
782	28	id	Cocktail Promotion	Available from 06.00 PM - 09:00 PM
784	28	kr	Cocktail Promotion	Available from 06.00 PM - 09:00 PM
777	27	id	WINE	Available 24 Hours
939	40	id	Appetizer Nite	Available from 23.00 - 06.00
940	40	  		
727	24	id	Salad	Available 24 Hours
941	40	kr	Appetizer Nite	Available from 23.00 - 06.00
942	40	  		
943	36	  		
944	37	  		
785	28	  		
786	27	  		
895	21	  		
787	28	  		
788	15	  		
789	15	  		
790	15	  		
791	25	  		
792	26	  		
796	29	  		
896	19	  		
897	4	  		
872	32	  		
798	29	  		
898	8	  		
840	30	  		
799	29	  		
793	29	cn	MIDDLE EAST SAHUR MENU	Available from 01:00 AM - 05:00 AM
794	29	en	MIDDLE EAST SAHUR MENU	Available from 01:00 AM - 05:00 AM
795	29	id	MIDDLE EAST SAHUR MENU	Available from 01:00 AM - 05:00 AM
800	29	  		
797	29	kr	MIDDLE EAST SAHUR MENU	Available from 01:00 AM - 05:00 AM
804	30	  		
809	31	  		
873	32	  		
841	30	  		
925	37	  		
811	30	  		
874	5	  		
842	28	  		
843	14	  		
844	13	  		
812	30	  		
845	3	  		
846	21	  		
847	2	  		
848	19	  		
813	30	  		
849	4	  		
850	8	  		
851	6	  		
801	30	cn	Sahur Menu Specially for Moslem Guest	Available from 07:00 PM - 04:00 AM
814	30	  		
802	30	en	Sahur Menu Specially for Moslem Guest	Available from 07:00 PM - 04:00 AM
803	30	id	Sahur Menu Specially for Moslem Guest	Available from 07:00 PM - 04:00 AM
852	30	  		
805	30	kr	Sahur Menu Specially for Moslem Guest	Available from 07:00 PM - 04:00 AM
815	30	  		
853	18	  		
806	31	cn	INDONESIAN SAHUR MENU	Available from 01:00 AM - 05:00 AM
807	31	en	INDONESIAN SAHUR MENU	Available from 01:00 AM - 05:00 AM
808	31	id	INDONESIAN SAHUR MENU	Available from 01:00 AM - 05:00 AM
816	31	  		
810	31	kr	INDONESIAN SAHUR MENU	Available from 01:00 AM - 05:00 AM
854	11	  		
855	5	  		
856	17	  		
817	30	  		
875	15	  		
818	14	  		
819	14	  		
820	14	  		
821	13	  		
822	3	  		
823	21	  		
824	2	  		
825	15	  		
826	19	  		
827	4	  		
828	8	  		
829	20	  		
830	6	  		
831	24	  		
832	11	  		
833	18	  		
834	5	  		
835	17	  		
836	26	  		
837	27	  		
838	27	  		
839	30	  		
857	26	  		
858	27	  		
865	32	id		
859	28	  		
860	20	  		
861	4	  		
862	4	  		
866	32	  		
879	33	  		
867	32	kr		
868	32	  		
922	37	cn	Light Bite Nite	Available from 23.00 - 06.00
863	32	cn		
899	32	  		
864	32	en		
869	32	  		
900	6	  		
870	1	  		
871	1	  		
901	11	  		
881	33	  		
902	23	  		
876	33	cn	Supper Food	
877	33	en	Supper Food	
878	33	id	Supper Food	
882	33	  		
880	33	kr	Supper Food	
886	34	  		
888	14	  		
883	34	cn	Food Menu	
884	34	en	Food Menu	
885	34	id	Food Menu	
889	34	  		
887	34	kr	Food Menu	
890	14	  		
891	12	  		
892	12	  		
893	14	  		
894	2	  		
903	18	  		
904	5	  		
905	17	  		
906	26	  		
907	27	  		
908	13	  		
909	3	  		
910	20	  		
914	35	  		
916	4	  		
920	36	  		
930	38	  		
935	39	  		
921	36	kr	Dessert Nite	Available from 23.00 - 06.00
924	37	id	Light Bite Nite	Available from 23.00 - 06.00
926	37	kr	Light Bite Nite	Available from 23.00 - 06.00
911	35	cn	Breakfast	Available from 07.00 AM - 10.00 AM
929	38	id	Main Courses Nite	Available from 23.00 - 06.00
931	38	kr	Main Courses Nite	Available from 23.00 - 06.00
933	39	en	Soup Nite	Available from 23.00 - 06.00
934	39	id	Soup Nite	Available from 23.00 - 06.00
781	28	en	Cocktail Promotion	Available from 06.00 PM - 09:00 PM
917	36	cn	Dessert Nite	Available from 23.00 - 06.00
918	36	en	Dessert Nite	Available from 23.00 - 06.00
913	35	id	Breakfast	Available from 07.00 AM - 10.00 AM
945	38	  		
946	39	  		
947	40	  		
948	36	  		
949	40	  		
912	35	en	Breakfast	Available from 07.00 AM - 10.00 AM
950	35	  		
915	35	kr	Breakfast	Available from 07.00 AM - 10.00 AM
951	5	  		
952	14	  		
953	13	  		
954	21	  		
955	2	  		
956	19	  		
957	4	  		
958	15	  		
722	23	id	Signature Dishes	Available from 11.00 AM - 11.00 PM
959	23	  		
960	6	  		
961	11	  		
962	39	  		
919	36	id	Dessert Nite	Available from 23.00 - 06.00
963	36	  		
964	37	  		
927	38	cn	Main Courses Nite	Available from 23.00 - 06.00
965	38	  		
932	39	cn	Soup Nite	Available from 23.00 - 06.00
966	39	  		
936	39	kr	Soup Nite	Available from 23.00 - 06.00
47	5	id	Soup	Available from 11.00 AM - 11.00 PM
967	5	  		
971	41	  		
973	1	  		
974	41	  		
975	41	  		
976	8	  		
977	19	  		
978	21	  		
979	14	  		
980	2	  		
981	13	  		
982	26	  		
983	26	  		
984	28	  		
985	10	  		
986	32	  		
987	10	  		
988	40	  		
989	40	  		
990	40	  		
991	24	  		
992	24	  		
993	24	  		
994	24	  		
995	24	  		
937	40	cn	Appetizer Nite	Available from 23.00 - 06.00
938	40	en	Appetizer Nite	Available from 23.00 - 06.00
996	40	  		
1000	42	  		
1002	42	  		
1003	42	  		
1004	32	  		
1005	32	  		
997	42	cn	Light Bite	Available from 11.00 AM - 11.00 PM
998	42	en	Light Bite	Available from 11.00 AM - 11.00 PM
999	42	id	Light Bite	Available from 11.00 AM - 11.00 PM
1006	42	  		
1001	42	kr	Light Bite	Available from 11.00 AM - 11.00 PM
968	41	cn		
969	41	en		
970	41	id		
1007	41	  		
972	41	kr		
1008	24	  		
923	37	en	Light Bite Nite	Available from 23.00 - 06.00
1009	37	  		
1010	24	  		
1011	24	  		
1012	20	  		
\.


--
-- Name: service_group_translations_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('service_group_translations_seq', 1012, true);


--
-- Data for Name: service_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY service_groups (service_group_id, service_group_description, service_group_enabled, service_group_thumbnail, service_group_allow_ads, service_group_order, service_group_clip) FROM stdin;
32	\N	0		0	0	\N
41	\N	0		0	0	\N
40	\N	0	gadogado	0	1	\N
14	\N	1	BintangBeer	0	11	\N
35	\N	0	AmericanBreakfast	0	1	\N
28	\N	1	tequilasunrise	0	14	\N
13	\N	1	IcedChocolate	0	15	\N
36	\N	0	Slicefruit	0	4	\N
3	\N	1	Tiramisucake	0	9	\N
12	\N	0		0	6	\N
21	\N	1	FreshMint	0	11	\N
34	\N	0		0	1	\N
2	\N	1	smallorangejuice	0	12	\N
15	\N	1	GreenMachine	0	13	\N
19	\N	1	TEA	0	11	\N
4	\N	1	nasicampurbali	0	2	\N
31	\N	0	indonesian	0	3	\N
8	\N	0	beverages	0	14	\N
37	\N	0	BeefBurger	0	3	\N
42	\N	1	BeefBurger	0	1	\N
38	\N	0	NasiGoreng	0	2	\N
29	\N	0	middle_east	0	1	\N
20	\N	1	chocolate	0	20	\N
25	\N	1	FrozenOrangeMintGinger	0	10	\N
16	\N	0	PassionCooler	0	8	\N
6	\N	1	SpagettiAioli	0	2	\N
22	\N	1	NasiGoreng	0	5	\N
30	\N	0	middle_east	0	2	\N
24	\N	0	gadogado	0	1	\N
11	\N	1	FrenchFries	0	8	\N
10	\N	0	signaturecocktail	0	9	\N
23	\N	1	BebekBetutu	0	1	\N
18	\N	1	smalldietcoke	0	10	\N
39	\N	0	Soupbuntut	0	2	\N
5	\N	1	Soupbuntut	0	3	\N
17	\N	1	EquilSparkling	0	9	\N
26	\N	0	BeefBurger	0	5	\N
27	\N	1	yellowtail	0	13	\N
\.


--
-- Name: service_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('service_groups_seq', 42, true);


--
-- Data for Name: service_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY service_translations (translation_id, service_id, language_id, translation_title, translation_description) FROM stdin;
257	250	en	Apple Chilled Juices	
258	251	en	Aqua Reflection Natural	
259	252	en	Aqua Reflection Sparkling	
272	265	en	Bolognaise	
274	267	en	Caesar Salad with Smoked Chicken	
276	269	en	Campari	
277	270	en	Canadian Club	
278	271	en	Capcay	
279	272	en	Cappuccino	
280	273	en	Carbonara	
282	275	en	Chamomile Tea	
283	276	en	Chicken in Chinese Wine Vinegar with Steamed Rice	
285	278	en	Chinese Sweet Corn Soup with Chicken	
286	279	en	Chivas Regal	
287	280	en	Chocolate Milk Shakes	
289	282	en	Classic Ice Tea	
290	283	en	Coca-Cola	
291	284	en	Cointreau	
294	287	en	Cream Of Mushroom	
295	288	en	Crispy Squids [Calamari] with Tartar Sauce	
298	291	en	Earl Grey Tea	
299	292	en	English Breakfast Tea	
301	294	en	Espresso Macchiato	
302	295	en	Flavored Ice Tea Lemon	
303	296	en	Flavored Ice Tea Lychee	
304	297	en	Flavored Ice Tea Mixed Berries	
305	298	en	Flavored Ice Tea Strawberry	
306	299	en	Fresh Brewed Coffee	
308	301	en	Galliano Yellow	
309	302	en	Ginger Ale	
310	303	en	Gordon	
311	304	en	Green Tea	
313	306	en	Guinness	
314	307	en	Heineken	
315	308	en	Hot and Sour Soup	
317	310	en	Ice Café Latte	
318	311	en	Ice Cappuccino	
319	312	en	Ice Coffee	
320	313	en	Iced Tea	
321	314	en	Ikan Bawal Bakar Atau Ayam Bakar Sambal Matah	
323	316	en	Jack Daniels	
324	317	en	Jasmine Tea	
325	318	en	Jose Cuervo	
326	319	en	Jw Black Label	
327	320	en	Jw Red Label	
328	321	en	Kahlua	
330	323	en	Long Island Iced Tea	
332	325	en	Lychee Chilled Juices	
333	326	en	Mango Chilled Juices	
334	327	en	Margarita	
335	328	en	Martini Dry	
336	329	en	Martini Rosso	
337	330	en	Melon Fresh Juices	
338	331	en	Mie / Bihun Goreng atau Mie Rebus	
339	332	en	Milk Shake	
340	333	en	Mojito	
341	334	en	Napolitana	
345	338	en	Nasi Rames	
347	340	en	Nestle Pure Life	
350	343	en	Old Bushmill	
351	344	en	Open Beverage	
352	345	en	Open Food	
354	347	en	Orange Chilled Juices	
355	348	en	Orange Fresh Juices	
356	349	en	Papaya Fresh Juices	
358	351	en	Peppermint Tea	
359	352	en	Pineapple Chilled Juices	
360	353	en	Pineapple Fresh Juices	
362	355	en	Pocari Sweat	
364	357	en	Red Wine	
368	361	en	Single Espresso	
369	362	en	Smirnoif	
370	363	en	Soda Water	
374	367	en	Southern Comfort	
375	368	en	Sprite	
376	369	en	Strawberry Milk Shakes	
378	371	en	The Mixers	
379	372	en	Tia Maria	
381	374	en	Tonic Water	
383	376	en	Triple Decker	
384	377	en	Triple Sec	
385	378	en	Vanilla Milk Shakes	
387	380	en	Watermelon Fresh Juices	
388	381	en	White Wine	
316	309	en	Hot Tea	Hot Tea
312	305	en	Guava Chilled Juices	
297	290	en	Double Espresso	
264	257	en	Baileys	
275	268	en	Café Latte	
389	382	en	Wok  Fried Beef in Black Pepper Sauce	
391	364	  		
392	364	  		
269	262	en	Bintang	
395	364	  		
396	364	  		
398	339	  		
399	339	  		
402	339	  		
353	346	en	Opera Cake	Opera cake
363	356	en	Red Sour Honey	Watermelon, Lemon, And Honey
365	358	en	Revitalizer	Carrots, Citrus Fruits, and Papaya
367	360	en	Selection Ice cream	
377	370	en	Sweet Milky Way	Pineapple Juice With Fresh Milk And Lychee Flavor Syrup
382	375	en	Traditional Banana Fritter with Cheese	Traditional fried bananas served with cheese
271	264	en	Blueberry Cheese Cake	Cheese cake with blueberries
288	281	en	Choux a la Cream with Fruits	Eclairs with cream
296	289	en	Devil Cake	
403	339	  		
405	337	  		
406	337	  		
409	337	  		
410	337	  		
412	322	  		
413	322	  		
416	322	  		
349	342	en	NORWEGIAN SALMON	Norwegian salmon served with boiled potato, french bean and creamy mustard sauce
366	359	en	SATE MADURA	Traditional chicken skewer with spicy peanut sauce served with rice cake
380	373	en	TOM YAM GOONG	Spicy seafood soup with coriander and lemon grass
267	260	en	BEEF or CHEESE BURGER	Beef or cheese burger served with fresh vegetables and french fries
417	322	  		
419	315	  		
420	315	  		
423	315	  		
270	263	en	Banana Juice	
393	364	id	SOP BUNTUT	Sop Buntut atau Buntut Goreng sapi dengan sayuran dan kentang disajikan dengan nasi putih
372	365	en	Sop Buntut Goreng	
343	336	en	Nasi Campur	
424	315	  		
426	335	  		
427	335	  		
430	335	  		
431	335	  		
433	258	  		
434	258	  		
437	258	  		
438	258	  		
440	366	  		
441	366	  		
444	366	  		
445	366	  		
447	359	  		
448	359	  		
451	359	  		
452	359	  		
454	266	  		
455	266	  		
458	266	  		
459	266	  		
461	341	  		
462	341	  		
465	341	  		
466	341	  		
468	277	  		
469	277	  		
472	277	  		
473	277	  		
475	373	  		
476	373	  		
479	373	  		
480	373	  		
482	255	  		
483	255	  		
486	255	  		
487	255	  		
489	254	  		
490	254	  		
493	254	  		
494	254	  		
496	342	  		
497	342	  		
500	342	  		
501	342	  		
503	261	  		
504	261	  		
507	261	  		
508	261	  		
510	354	  		
511	354	  		
514	354	  		
515	354	  		
517	350	  		
518	350	  		
521	350	  		
522	350	  		
524	324	  		
525	324	  		
528	324	  		
529	324	  		
531	375	  		
532	375	  		
535	375	  		
536	375	  		
538	253	  		
539	253	  		
542	253	  		
543	253	  		
467	277	cn	Chinese Healthy Soup	蔬菜汤用草药和香料中国
348	341	en	NICOISE SALAD	Nicoise Salad with chunk tuna, egg, potato served with French dressing
471	277	jp	Chinese Healthy Soup	ハーブやスパイス中国と野菜スープ
477	373	id	TOM YAM GOONG	Sup pedas isi seafood dengan daun ketumbar dan daun sereh
446	359	cn	Sate Madura	马都拉鸡肉沙爹与花生酱有年糕
415	322	jp	Krengsengan Daging Kambing	ヤギの肉料理はLontongとネギでスパイシーな調味料を添えます
373	366	en	SOTO BETAWI / SOTO AYAM	Batavian traditional beef broth or Traditional Chiken Soup served with steamed rice
429	335	jp	Nasi Bebek Goreng	スラバヤ風揚げアヒルはチリペーストと新鮮な野菜を添えて
435	258	id	BAKMI GORENG atau REBUS	Bakmi goreng atau rebus tradisional, dengan potongan Ayam goreng, telur dan kerupuk
404	337	cn	Nasi Goreng Tradisional	炒饭爪哇与煎鸡，虾，煎鸡蛋，咸菜和饼干
408	337	jp	Nasi Goreng Tradisional	ナシゴレンジャワはフライドチキン、エビ、揚げ卵、漬物、そしてクラッカー添え
346	339	en	NASI RAWON BUNTUT	Beef with Indonesian black nuts herb and bean sprout served with steamed rice
397	339	cn	Nasi Rawon Buntut	Rawon牛肉香料kluwak配上白米饭
401	339	jp	Nasi Rawon Buntut	スパイスRawonビーフはホワイトライス添えkluwak
400	339	id	NASI RAWON BUNTUT	Rawon daging sapi dengan bumbu kluwak disajikan dengan nasi putih
394	364	jp	Sop Buntut atau Buntut Goreng	白米添え野菜とジャガイモとオックステール牛肉
463	341	id	NICOISE SALAD	Selada nicoise dengan ikan tuna,telur dan kentang dengan saus salad Perancis
470	277	id	Chinese Healthy Soup	Sup sayuran dengan bumbu dan rempah china
450	359	jp	Sate Madura	ピーナッツソースとマドゥラチキンサテは餅を添えて
456	266	id	CAESAR SALAD	Selada caesar dengan selada roman dan roti bawang kering disajikan dengan saus caesar
474	373	cn	Tom Yam Gong	内容辣味海鲜汤与香菜和柠檬草的叶子
449	359	id	SATE MADURA	Sate ayam madura dengan saus kacang disajikan dengan lontong
439	366	cn	Soto Betawi / Soto Ayam	チキンスープは、白いご飯を添えて
442	366	id	SOTO BETAWI / SOTO AYAM	Soto sapi ala betawi atau Soto Ayam disajikan dengan nasi putih
443	366	jp	Soto Betawi / Soto Ayam	チキンスープは、白いご飯を添えて
478	373	jp	Tom Yam Gong	コリアンダーとレモングラス葉コンテンツスパイシーなシーフードスープ
460	341	cn	Nicoise Salad	生菜Niçoise大厦金枪鱼，鸡蛋和土豆沙拉配法式沙拉酱
432	258	cn	Bakmi Goreng atau Rebus	传统的炒面或者煮，炒鸡肉，鸡蛋和饼干件
453	266	cn	Caesar Salad	凯撒生菜罗马生菜，干燥大蒜面包佐以撒敷
407	337	id	NASI GORENG TRADISIONAL	Nasi goreng Jawa disajikan dengan ayam goreng,udang,telur goreng,acar dan kerupuk
545	289	  		
546	289	  		
549	289	  		
550	289	  		
552	346	  		
553	346	  		
556	346	  		
557	346	  		
559	286	  		
560	286	  		
563	286	  		
564	286	  		
566	281	  		
567	281	  		
411	322	cn	Tongseng	羊肉烹饪配上香辣调料Lontong和韭菜
414	322	id	Tongseng	Daging kambing masak pedas bumbu disajikan dengan lontong dan daun bawang
425	335	cn		泗水式炸鸭佐以辣椒酱和新鲜蔬菜
428	335	id	NASI BEBEK GORENG	Bebek goreng ala surabaya disajikan dengan sambal terasi dan lalapan
570	281	  		
571	281	  		
573	264	  		
574	264	  		
577	264	  		
578	264	  		
580	293	  		
581	293	  		
584	293	  		
585	293	  		
587	259	  		
588	259	  		
591	259	  		
592	259	  		
594	300	  		
595	300	  		
598	300	  		
599	300	  		
601	360	  		
602	360	  		
605	360	  		
606	360	  		
576	264	jp	Blueberry Cheese Cake	ブルーベリーチーズケーキ
568	281	id	Choux a la Cream with Fruits	Kue sus dengan krim
603	360	id	Selection Ice cream	
600	360	cn	Selection Ice cream	
604	360	jp	Selection Ice cream	
533	375	id	Traditional Banana Fritter with Cheese	Pisang goreng tradisional disajikan dengan keju
590	259	jp	Banana Split	
586	259	cn	Banana Split	
589	259	id	Banana Split	
575	264	id	Blueberry Cheese Cake	Kue keju dengan blueberry
572	264	cn	Blueberry Cheese Cake	芝士蛋糕与蓝莓
565	281	cn	Choux a la Cream with Fruits	小饼奶油
569	281	jp	Choux a la Cream with Fruits	クリームエクレア
607	285	cn	Cold Strawberry Souffles with Assorted Fruit	冷冻草莓奶油配上各种新鲜水果
561	286	id	Cream Caramel	Kue karamel
558	286	cn	Cream Caramel	焦糖蛋糕
293	286	en	Cream Caramel	caramel cake
562	286	jp	Cream Caramel	キャラメルケーキ
547	289	id	Devil Cake	
544	289	cn	Devil Cake	
548	289	jp	Devil Cake	
582	293	id	Es Poddeng	Shorbet, avocado, chocolate, dan setwned milk
579	293	cn	Es Poddeng	Shorbet，鳄梨，巧克力和牛奶setwned
583	293	jp	Es Poddeng	Shorbet、アボカド、チョコレート、ミルクsetwned
596	300	id	Fried Pineapple Caramel with Vanila Ice Cream	Goreng nanas karamel disajikan dengan es krim vanili
593	300	cn	Fried Pineapple Caramel with Vanila Ice Cream	焦糖炒菠萝送达香草冰淇淋
554	346	id	Opera Cake	Kue Opera
551	346	cn	Opera Cake	歌剧蛋糕
555	346	jp	Opera Cake	オペラケーキ
530	375	cn	Traditional Banana Fritter with Cheese	传统的炸香蕉配上奶酪
534	375	jp	Traditional Banana Fritter with Cheese	伝統的な揚げバナナ、チーズを添えて
541	253	jp	Assorted Seasonal Fruit Slices	盛り合わせ新鮮な果実片
608	285	  		
609	285	  		
612	285	  		
613	285	  		
615	356	  		
616	356	  		
619	356	  		
620	356	  		
622	358	  		
623	358	  		
626	358	  		
627	358	  		
629	379	  		
630	379	  		
633	379	  		
634	379	  		
636	370	  		
637	370	  		
640	370	  		
641	370	  		
642	274	cn	胡萝卜新鲜果汁	选择新鲜的果汁，西瓜，香瓜，橘子，菠萝，苹果，胡萝卜，木瓜
643	274	  		
281	274	en	Carrot Fresh Juices	Selection of fresh juices, watermelon, cantaloupe, oranges, pineapples, apples, carrots, papaya
644	274	  		
523	324	cn	Lumpia Durian	Lumpia内容榴莲雪糕配上香草和调料榴莲
527	324	jp	Lumpia Durian	Lumpiaの内容はドリアンアイスクリームはバニラとドリアンソース添え
526	324	id	LUMPIA DURIAN	Lumpia isi durian disajikan dengan  es krim vanilla dan  saus durian
516	350	cn	Pasta	意大利面，fettucini，Fussilie或PENE
498	342	id	NORWEGIAN SALMON	Ikan salmon disajikan dengan kentang  rebus,sayuran,dan saus mustard
520	350	jp	Pasta	スパゲッティ、fettucini、FussilieまたはPENE
519	350	id	Pasta	Spaghetti, Fettucini, Fussilie or Pene
331	324	en	LUMPIA DURIAN	Rolled of durian fruit served with vanilla ice cream and durian sauce.
509	354	cn	Pizza Meat Lover	比萨熏牛肉，熏鸡，牛肉，鸡肉的内容\n烤，香肠和马苏里拉奶酪
513	354	jp	Pizza Meat Lover	スモークビーフ、スモークチキン、牛挽肉、鶏肉の内容でピザ\nロースト、ソーセージとモッツァレラチーズ
495	342	cn	Norwegian Salmon	鲑鱼，配上煮土豆，蔬菜和芥末酱
488	254	cn	Australian Rib Eye	澳大利亚烤牛肉配上土豆泥和蔬菜辣椒酱
357	350	en	Pasta	with choice sauce: bolognesse, carbonara, marinarra or aglio e olio
506	261	jp	Beef or Cheese Burger	野菜とフライドポテト添えミンチ肉やチーズバーガー
499	342	jp	Norwegian Salmon	サーモンはゆでたジャガイモ、野菜とマスタードソース添え
645	274	id	Carrot Fresh Juices	Pilihan jus segar, semangka, melon, jeruk, nanas, apel, wortel, pepaya
646	274	jp	ニンジンフレッシュジュース	フレッシュジュース、スイカ、メロン、オレンジ、パイナップル、リンゴ、ニンジン、パパイヤの選択
647	274	  		
648	274	  		
649	309	cn	热茶	热茶
650	309	  		
651	309	  		
652	309	id	Hot Tea	Teh Hangat
653	309	jp	熱いお茶	熱いお茶
654	309	  		
655	309	  		
656	305	cn	番石榴果汁冷硬	
537	253	cn	Assorted Seasonal Fruit Slices	各种新鲜水果片
657	305	  		
658	305	  		
659	305	id	Guava Chilled Juices	
660	305	jp	グアバチルドジュース	
661	305	  		
662	305	  		
663	290	cn	双咖啡	
664	290	  		
665	290	  		
666	290	id	Double Espresso	
667	290	jp	ダブルエスプレッソ	
668	290	  		
669	290	  		
671	262	  		
672	262	  		
675	262	  		
676	262	  		
677	256	cn		
678	256	  		
679	256	  		
681	256	jp		
682	256	  		
683	256	  		
684	257	cn		
685	257	  		
686	257	  		
687	257	id		
688	257	jp		
689	257	  		
690	257	  		
691	263	cn		
692	263	  		
693	263	  		
695	263	jp		
696	263	  		
697	263	  		
698	268	cn		
699	268	  		
700	268	  		
701	268	id		
702	268	jp		
703	268	  		
704	268	  		
670	262	cn	Bintang	
673	262	id	Bintang	
674	262	jp	Bintang	
714	383	cn		
715	383	  		
705	383	en	Chilled Juices	
716	383	  		
717	383	id		
718	383	jp		
719	383	  		
720	383	  		
721	354	  		
722	354	  		
723	354	  		
724	354	  		
725	354	  		
726	354	  		
727	354	  		
728	354	  		
730	392	  		
732	392	  		
735	392	  		
736	392	  		
729	392	cn	汽水	
737	392	  		
731	392	en	Soft Drink	
738	392	  		
733	392	id	Minuman Ringan	
734	392	jp	ソフトドリンク	
739	392	  		
740	392	  		
742	391	  		
307	300	en	Fried Pineapple Caramel with Vanila Ice Cream	Fried caramelized pineapple served with vanilla ice cream
617	356	id	Red Sour Honey	Semangka, Jeruk lemon, Dan Madu
614	356	cn	Red Sour Honey	西瓜，柠檬和蜂蜜
618	356	jp	Red Sour Honey	スイカ、レモン、蜂蜜
624	358	id	Revitalizer	Wortel, Buah Jeruk, Dan Pepaya
621	358	cn	Revitalizer	胡萝卜，柑橘类水果，木瓜
625	358	jp	Revitalizer	ニンジン、柑橘類、及びパパイヤ
638	370	id	Sweet Milky Way	Jus Nanas Dengan Susu Segar Dan Sirup Rasa Leci
635	370	cn	Sweet Milky Way	菠萝汁，新鲜牛奶和荔枝味糖浆
639	370	jp	Sweet Milky Way	フレッシュミルク＆ライチフレーバーシロップとパイナップルジュース
631	379	id	Virgin Mojito	Jus jeruk nipis dengan daun mint, sirup dan air soda
628	379	cn	Virgin Mojito	青柠汁与薄荷叶，糖浆和苏打水
386	379	en	Virgin Mojito	Lime juice with mint leaves, syrup and soda water
632	379	jp	Virgin Mojito	ミントの葉、シロップとソーダ水とライムジュース
610	285	id	Cold Strawberry Souffles with Assorted Fruit	Krim stroberi dingin disajikan dengan aneka buah segar
611	285	jp	Cold Strawberry Souffles with Assorted Fruit	チルドイチゴクリームは、新鮮な果物の様々な添え
300	293	en	Es Poddeng	Shorbet, avocado, chocolate, and milk setwned
743	391	  		
746	391	  		
747	391	  		
751	396	en	Test Item	
753	262	  		
754	262	  		
755	262	  		
756	262	  		
757	315	  		
758	315	  		
759	315	  		
760	315	  		
762	390	  		
800	342	  		
763	390	  		
766	390	  		
767	390	  		
266	259	en	Banana Split	
768	390	  		
769	390	  		
770	390	  		
771	390	  		
708	386	en	Fresh Water	
709	387	en	Hot or Iced Tea (flavour)	
749	394	en	ES TELER	Assorted fresh fruit with avocado, coconut milk and sweetened milk
752	397	en	TIRAMISU	Cake with cream and coffee syrup served with chocolate sauce
706	384	en	Espresso, Cappucino, Black Coffe, Cafe Late	
273	266	en	CAESAR SALAD	Caesar salad with romain lettuce and garlic bread served with caesar dressing
707	385	en	Fresh Juice	
772	261	  		
773	261	  		
774	261	  		
775	261	  		
776	350	  		
777	350	  		
778	350	  		
779	350	  		
780	350	  		
781	350	  		
782	350	  		
783	350	  		
784	354	  		
785	354	  		
786	354	  		
787	354	  		
788	254	  		
789	254	  		
790	254	  		
791	254	  		
792	390	  		
793	390	  		
794	390	  		
795	390	  		
801	342	  		
802	342	  		
803	342	  		
804	390	  		
805	390	  		
806	390	  		
807	390	  		
292	285	en	Cold Strawberry Souffles with Assorted Fruit	Chilled strawberry cream served with a variety of fresh fruit
597	300	jp	Fried Pineapple Caramel with Vanila Ice Cream	バニラアイスクリーム添え揚げカラメルパイナップル
796	254	  		
797	254	  		
798	254	  		
799	254	  		
512	354	id	PIZZA MEAT LOVER	Pizza dengan isi daging sapi asap,daging ayam asap, daging giling,daging ayam panggang, sosis dan keju mozzarella
830	261	  		
422	315	jp	Ikan Gurame Goreng atau Ayam Bakar Sambal Matah	ホワイトライス添えまたは焼いたチキンサンバル典型的なバリを揚げGurame魚
761	390	cn	Shakes	
814	399	en	TIRAMISU	Cake with cream and coffee syrup served with chocolate sauce
765	390	jp	Shakes	
712	390	en	Shakes	
764	390	id	Shakes	
741	391	cn	Soft Drink	
815	399	jp	Tiramisu	
812	399	id	TIRAMISU	Kue dengan krim dan sirup kopi disajikan dengan saus coklat
710	388	en	Imported Beer	
481	255	cn	Australian Tenderloin Steak	肉类在澳大利亚送达烤土豆，蔬菜和辣椒酱
809	398	cn	Aneka Buah Segar	
811	398	jp	Aneka Buah Segar	
820	255	  		
261	254	en	AUSTRALIAN RIB EYE	Australian beef steak served with mash potato, mix  vegetables and black pepper sauce
821	255	  		
485	255	jp	Australian Tenderloin Steak	肉はオーストラリアで焼いたジャガイモ、野菜、コショウソース添えました
822	255	  		
823	255	  		
436	258	jp	Bakmi Goreng atau Rebus	伝統的なフライドチキン、卵、クラッカーの作品で、麺を油で揚げたり煮
826	258	  		
836	393	cn		
843	277	  		
845	277	  		
711	389	en	Local Beer	
344	337	en	NASI GORENG TRADISIONAL	Traditional fried rice served with fried chicken, shrimp, fried egg, pickles and cracker
265	258	en	BAKMI GORENG atau REBUS	Fried Noodle or with broth, served with shredded fried chicken, egg and crackers
464	341	jp	Nicoise Salad	フレンチドレッシングとマグロ、卵とポテトサラダとレタスのニース風の
745	391	jp	Soft Drink	
713	391	en	Soft Drink	
816	254	  		
817	254	  		
484	255	id	Australian Tenderloin Steak	Daging has dalam Australia disajikan dengan kentang panggang,sayur dan saus merica
492	254	jp	Australian Rib Eye	オーストラリアのローストビーフは、マッシュポテトと野菜ペッパーソース添え
818	254	  		
284	277	en	Chinese Healthy Soup	Traditional healthy soup with Chinese herbs
824	258	  		
744	391	id	Soft Drink	
491	254	id	AUSTRALIAN RIB EYE	Sapi panggang Australia disajikan dengan bubur kentang sayuran  dan saus merica
813	399	cn	Tiramisu	
819	254	  		
825	258	  		
827	258	  		
828	261	  		
829	261	  		
831	261	  		
832	266	  		
833	266	  		
457	266	jp	Caesar Salad	レタスローマンレタス、乾燥したガーリックブレッドとシーザーはシーザードレッシング添え
834	266	  		
835	266	  		
837	393	  		
748	393	en	Chilled Juices	
838	393	  		
839	393	id		
840	393	jp		
841	393	  		
842	393	  		
262	255	en	Australian Tenderloin Steak	Australian beef steak served with baked potato, vegetables and black pepper sauce
844	277	  		
846	277	  		
847	384	cn		
848	384	  		
849	384	  		
850	384	id		
851	384	jp		
852	384	  		
853	384	  		
854	394	cn		
855	394	  		
856	394	  		
858	394	jp		
859	394	  		
860	394	  		
861	385	cn		
862	385	  		
863	385	  		
864	385	id		
865	385	jp		
866	385	  		
867	385	  		
868	386	cn		
869	386	  		
870	386	  		
871	386	id		
872	386	jp		
873	386	  		
874	386	  		
875	387	cn		
876	387	  		
877	387	  		
878	387	id		
879	387	jp		
880	387	  		
881	387	  		
371	364	en	SOP BUNTUT	Traditional oxtail soup or Fried with vegetables and potato served with steamed rice
322	315	en	Iga Panggang	Deep fried Gurami – fresh water fish or Grilled Chiken with Balinese chili salsa served with steamed rice
421	315	id	Iga Panggang	Ikan Gurame Goreng atau Ayam bakar dengan sambal khas Bali disajikan dengan nasi putih
329	322	en	Tongseng	Spiced mutton with pepper and sweet soy sauce
502	261	cn	Beef Burger With Cheese	汉堡肉末或奶酪配上蔬菜和薯条
882	359	  		
883	359	  		
884	359	  		
885	359	  		
886	335	  		
887	335	  		
888	335	  		
889	335	  		
890	337	  		
891	337	  		
892	337	  		
893	337	  		
894	339	  		
895	339	  		
896	339	  		
897	339	  		
898	364	  		
899	364	  		
900	364	  		
901	364	  		
902	324	  		
903	324	  		
904	324	  		
905	324	  		
906	397	cn		
907	397	  		
908	397	  		
910	397	jp		
911	397	  		
912	397	  		
913	399	  		
914	399	  		
915	399	  		
916	399	  		
917	373	  		
918	373	  		
919	373	  		
920	373	  		
921	388	cn		
922	388	  		
923	388	  		
924	388	id		
925	388	jp		
926	388	  		
927	388	  		
928	389	cn		
929	389	  		
930	389	  		
931	389	id		
932	389	jp		
933	389	  		
934	389	  		
935	390	  		
936	390	  		
937	390	  		
938	390	  		
939	391	  		
940	391	  		
941	391	  		
942	391	  		
943	350	  		
944	350	  		
945	350	  		
946	350	  		
947	354	  		
948	354	  		
949	354	  		
950	354	  		
951	341	  		
952	341	  		
953	341	  		
954	341	  		
955	342	  		
956	342	  		
957	342	  		
958	342	  		
959	315	  		
960	315	  		
961	315	  		
962	315	  		
963	322	  		
964	322	  		
965	322	  		
966	322	  		
967	395	cn		
968	395	  		
969	395	  		
971	395	jp		
972	395	  		
973	395	  		
974	398	  		
975	398	  		
976	398	  		
977	398	  		
978	398	  		
979	398	  		
980	253	  		
981	253	  		
982	253	  		
983	253	  		
984	253	  		
985	253	  		
986	254	  		
987	254	  		
988	254	  		
989	254	  		
990	254	  		
991	254	  		
992	255	  		
993	255	  		
994	255	  		
995	255	  		
996	255	  		
997	255	  		
998	258	  		
999	258	  		
1000	258	  		
1001	258	  		
1002	258	  		
1003	258	  		
1004	260	  		
1005	260	  		
1006	260	  		
1007	260	id	BEEF or CHEESE BURGER	Burger dengan daging cincang atau keju disajikan dengan sayuran dan kentang goreng
1008	260	  		
1009	260	  		
1010	260	  		
1011	364	  		
1012	364	  		
1013	364	  		
1014	364	  		
1015	364	  		
1016	364	  		
1017	337	  		
1018	337	  		
1019	337	  		
1020	337	  		
1021	337	  		
1022	337	  		
1023	339	  		
1024	339	  		
909	397	id	TIRAMISU	Kue dengan krim dan sirup kopi disajikan dengan saus coklat
857	394	id	ES TELER	Aneka buah - buahan dengan alpukat, santan dan susu kental manis
970	395	id	ES TELER	Aneka buah - buahan dengan alpukat, santan dan susu kental manis
1025	339	  		
1026	339	  		
1027	339	  		
1028	339	  		
1029	322	  		
1030	322	  		
1031	322	  		
1032	322	  		
1033	322	  		
1034	322	  		
1035	315	  		
1036	315	  		
1037	315	  		
1038	315	  		
1039	315	  		
1040	315	  		
1041	315	  		
1042	315	  		
1043	315	  		
1044	315	  		
1045	315	  		
1046	315	  		
1047	335	  		
1048	335	  		
1049	335	  		
1050	335	  		
1051	335	  		
1052	335	  		
1053	258	  		
1054	258	  		
1055	258	  		
1056	258	  		
1057	258	  		
1058	258	  		
1059	366	  		
1060	366	  		
1061	366	  		
1062	366	  		
1063	366	  		
1064	366	  		
1065	359	  		
1066	359	  		
1067	359	  		
1068	359	  		
1069	359	  		
1070	359	  		
1071	266	  		
1072	266	  		
1073	266	  		
1074	266	  		
1075	266	  		
1076	266	  		
1077	341	  		
1078	341	  		
1079	341	  		
1080	341	  		
1081	341	  		
1082	341	  		
1083	277	  		
1084	277	  		
1085	277	  		
1086	277	  		
1087	277	  		
1088	277	  		
1089	373	  		
1090	373	  		
1091	373	  		
1092	373	  		
1093	373	  		
1094	373	  		
1095	255	  		
1096	255	  		
1097	255	  		
1098	255	  		
1099	255	  		
1100	255	  		
1101	254	  		
1102	254	  		
1103	254	  		
1104	254	  		
1105	254	  		
1106	254	  		
1107	342	  		
1108	342	  		
1109	342	  		
1110	342	  		
1111	342	  		
1112	342	  		
1113	261	  		
1114	261	  		
1115	261	  		
1116	261	  		
1117	261	  		
1118	261	  		
1119	354	  		
1120	354	  		
361	354	en	PIZZA MEAT LOVER	Pizza with beef salami, chicken salami, minced beef, roasted chicken, sausage and mozzarella cheese
1121	354	  		
1122	354	  		
1123	354	  		
1124	354	  		
1125	350	  		
1126	350	  		
1127	350	  		
1128	350	  		
1129	350	  		
1130	350	  		
1131	324	  		
1132	324	  		
1133	324	  		
1134	324	  		
1135	324	  		
1136	324	  		
1137	399	  		
1138	399	  		
1139	399	  		
1140	399	  		
1141	399	  		
1142	399	  		
1143	397	  		
1144	397	  		
1145	397	  		
1146	397	  		
1147	397	  		
1148	397	  		
1149	394	  		
1150	394	  		
1151	394	  		
1152	394	  		
1153	394	  		
1154	394	  		
1155	395	  		
1156	395	  		
750	395	en	ES TELER	Assorted fresh fruit with avocado, coconut milk and sweetened milk
1157	395	  		
1158	395	  		
1159	395	  		
1160	395	  		
1161	398	  		
1162	398	  		
1163	398	  		
1164	398	  		
1165	398	  		
1166	398	  		
1167	400	  		
1170	400	  		
1171	400	  		
1172	400	  		
1173	400	  		
1174	400	  		
1175	398	  		
808	398	id	Sop Ikan Nusantara	Aneka potongan  buah segar disajikan dengan saus jeruk
1176	398	  		
1177	253	  		
1178	253	  		
1179	261	  		
1180	261	  		
1181	256	  		
1182	256	  		
1183	253	  		
810	398	en	Sop Ikan Nusantara	Fresh local fish soup with vegetable served with steamed rice
268	261	en	Beef Burger With Cheese	A sandwich consisting of a bun, a cooked beef patty, and often other ingredients such as cheese, onion slices, lettuce, or condiments
1184	253	  		
1185	400	  		
1168	400	en	Nasi Campur Bali	Steamed rice served with chicken satay, shredded chicken with sambal matah, fried chicken sausage, beancurd and beancake in balado sauce, watercress and sambal bajak
1186	400	  		
1187	261	  		
540	253	id	Gurami Bakar	Grilled 'gurame' fish served with steamed rice, fresh garden vegetables 'lalapan', sambal bajak and sambal colo-colo
680	256	id	Triple Fresh	Vodka, pineapple liqueur, orange juice, cranberry juice and lime cordial. Cranberry juice, Sunkist, lime cordial and topped with ginger ale. Whiskey, pineapple juice, orange juice topped with sprite and splash grena-dine
260	253	en	Gurami Bakar	Grilled 'gurame' fish served with steamed rice, fresh garden vegetables 'lalapan', sambal bajak and sambal colo-colo
1169	400	id	Nasi Campur Bali	Steamed rice served with chicken satay, shredded chicken with sambal matah, fried chicken sausage, beancurd and beancake in balado sauce, watercress and sambal bajak
263	256	en	Triple Fresh	Vodka, pineapple liqueur, orange juice, cranberry juice and lime cordial. Cranberry juice, Sunkist, lime cordial and topped with ginger ale. Whiskey, pineapple juice, orange juice topped with sprite and splash grena-dine
1320	421	cn	Curry Udon with Seafood  &amp; Vegetable	濃厚咖哩海鮮蔬菜烏冬麵
1322	421	kr	Curry Udon with Seafood  &amp; Vegetable	
1188	261	  		
1189	256	  		
1190	256	  		
1191	256	  		
1192	256	  		
1193	256	  		
1194	256	  		
1195	253	  		
1196	253	  		
1197	398	  		
1198	398	  		
1199	400	  		
1200	400	  		
1201	261	  		
1202	261	  		
1203	263	  		
1204	263	  		
1205	263	  		
1206	263	  		
1207	263	  		
1254	400	  		
1208	263	  		
1209	256	  		
1210	256	  		
1211	263	  		
1212	263	  		
1213	263	  		
1277	411	en	Mango Juice	
1214	263	  		
1215	263	  		
1317	420	en	Creamy Mushroom Soup	Mushroom Soup with Cream
1216	263	  		
1318	420	kr	Creamy Mushroom Soup	Mushroom Soup with Cream
1256	405	  		
1291	415	id	Soup of the Day	Sup Special yang disajikan Chef Hari ini
1247	336	cn		
1248	336	id	Nasi Campur	
1257	336	  		
1250	336	kr		
1253	400	cn		
1258	400	  		
1255	400	kr		
694	263	id	Banana Juice	
1283	413	id	Nectar Mojito	
1294	415	kr	Soup of the Day	
1311	419	id	Bolognaise Meat Sauce	Saus Daging &amp; Tomat
1217	401	id	Bellini	
1218	401	en	Bellini	
1259	407	id	Aglio e Olio	
1260	407	cn	Aglio e Olio	
1261	407	en	Aglio e Olio	
1262	407	kr	Aglio e Olio	
1227	406	id	Banana Juice	
1228	406	en	Banana Juice	
505	261	id	Beef Burger With Cheese	A sandwich consisting of a bun, a cooked beef patty, and often other ingredients such as cheese, onion slices, lettuce, or condiments
1219	402	id	Gurami Goreng/ Bakar Sambal Sari Kuring	
1237	402	cn	Gurami Goreng/ Bakar Sambal Sari Kuring	
1220	402	en	Gurami Goreng/ Bakar Sambal Sari Kuring	
1239	402	kr	Gurami Goreng/ Bakar Sambal Sari Kuring	
390	364	cn	Sop Buntut atau Buntut Goreng	牛尾牛肉与蔬菜和土豆佐以白米饭
1229	364	  		
1230	364	kr		
1231	365	cn		
1232	365	id	Sop Buntut Goreng	
1233	365	  		
1234	365	kr		
1235	253	  		
1236	253	kr		
1221	403	id	Lychee Ginger Cooler	
1222	403	en	Lychee Ginger Cooler	
1238	402	  		
418	315	cn		Gurame鱼油炸或烤鸡肉峇典型的巴厘岛送达白米
1240	315	  		
1241	315	kr		
1242	322	  		
1243	322	kr		
1263	408	id	Mie Goreng Jawa	
1264	408	cn	Mie Goreng Jawa	
1245	405	  		
1249	336	  		
342	335	en	NASI BEBEK GORENG	Authentic Surabayanese marinated local duck served with sambal and vegetables
1251	335	  		
1252	335	kr		
1280	412	cn	Nasi Campur Bali ( Signature Dish)	巴厘傳統飯調搭配雞肉與蔬菜
1316	420	cn	Creamy Mushroom Soup	濃濃奶香的蘑菇濃湯
1269	409	en	Bellini	
1267	409	id	Bellini	
1265	408	en	Mie Goreng Jawa	
1266	408	kr	Mie Goreng Jawa	
1223	404	id	Mix Berry Spritz	
1224	404	en	Mix Berry Spritz	
1225	405	id	Nasi Goreng Kampoeng	
1244	405	cn	Nasi Goreng Kampoeng	
1226	405	en	Nasi Goreng Kampoeng	
1246	405	kr	Nasi Goreng Kampoeng	
1281	412	en	Nasi Campur Bali ( Signature Dish)	Balinese Traditional Rice with Condiments
1274	410	kr	Apple Juice	
1272	410	cn	Pineapple Juice	
1279	412	id	Nasi Campur Bali ( Signature Dish)	Balinese Traditional Rice with Condiments
1290	414	kr	Sop Buntut atau Buntut Goreng	
1273	410	en	Pineapple Juice	
1286	413	kr	Nectar Mojito	
1299	410	  		
1307	418	id	Beef Burger With Cheese	Burger Daging Sapi dihidangkan dengan Keju, Sayuran dan Kentang Goreng
1271	410	id	Pineapple Juice	
1301	409	  		
1304	417	cn	Bebek Lengkuas	道地的薑汁炸鴨與調味料
1288	414	cn	Sop Buntut	牛尾湯或油炸牛尾飯搭配蔬菜與馬鈴薯
1313	419	en	Bolognaise Meat Sauce	Saus Daging &amp; Tomat
1312	419	cn	Bolognaise Meat Sauce	番茄肉醬
1282	412	kr	Nasi Campur Bali ( Signature Dish)	
1314	419	kr	Bolognaise Meat Sauce	
1298	416	kr	Steak Sandwiches	
1306	417	kr	Bebek Lengkuas	
1285	413	en	Nectar Mojito	
1296	416	cn	Steak Sandwiches	意大利口袋麵包，香煎牛肉，生菜，煎雞蛋，煙薰牛肉，蕃茄和法式薯條
1278	411	kr	Mango Juice	
1300	410	  		
1302	411	  		
1268	409	cn	Bellini	
1284	413	cn	Nectar Mojito	
1275	411	id	Mango Juice	
1276	411	cn	Mango Juice	
1270	409	kr	Bellini	
1345	427	en	Napolitana Sauce	Saus Tomat &amp; Cabai kering
1366	432	kr	Pana Cotta	
1395	430	  		
1355	430	id	Pan Seared Beef Medalion with Creamy Mushroom	Pan Seared Beef Medalion with Mix Vegetable, Creamy Mushroom and Baked Potato
1327	423	id	Gurami Goreng/ Bakar Sambal Sari Kuring	Fried or Grilled Fish Gurami with Sambal Sari Kuring &amp; Condiments
1338	425	kr	Lumpia Sayur Semarang	
1364	432	cn	Panna Cotta	傳統意大利奶油甜品搭配水果
1396	431	  		
1362	431	kr	Pan Seared Salmon a la Sand	
1397	419	  		
1361	431	en	Pan Seared Norwegian Salmon	Pan Seared Norwegian Salmon with Mixed Green Salad, Lemon Teriyaki and Boiled Potato
1329	423	en	Gurami Bakar Sambal Sari Kuring	Fried or Grilled Fish Gurami with Sambal Sari Kuring &amp; Condiments
1398	427	  		
1415	414	  		
1336	425	cn	Lumpia Sayur Semarang	中爪瓦島潤餅搭配當地醬料
1330	423	kr	Gurami Goreng/ Bakar Sambal Sari Kuring	
1374	434	kr	Seasonal Fruit Slices	
1399	434	  		
1344	427	cn	Napolitana Sauce	特製拿坡里辣醬汁
1408	428	  		
1337	425	en	Lumpia Sayur Semarang	Lumpia Goreng Saus Bawang ala Semarang
1409	412	  		
1368	433	cn	Pisang Goreng	巴厘島炸香蕉搭配椰絲與芝麻
1350	428	kr	Nasi Goreng Kampoeng	
1347	428	id	Nasi Goreng Kampoeng	Nasi Goreng Tradisional disajikan dengan Ayam Goreng, Sate Ayam, Telur Goreng dan Empal Sapi
1400	432	  		
1378	435	kr	Tiramisu Cake	
1324	422	cn	Gado-Gado	
1343	427	id	Napolitana Sauce	Saus Tomat &amp; Cabai kering
1331	424	id	Iga Bakar Bumbu Ketumbar	Traditional Marinated Beef Rib with Coriander Sauce &amp; Condiments
1419	412	  		
1401	435	  		
1376	435	cn	Tiramisu Cake	意大利咖啡口味的甜點
1373	434	en	Seasonal Fruit Slices	Slice of Local Fruit
1410	424	  		
1332	424	cn	Iga Bakar Bumbu Ketumbar	傳統風味牛肋排與香菜醬與調味料
1420	429	  		
1370	433	kr	Pisang Goreng	
1547	438	cn	Aglio e Olio	羅勒葉，辣椒與蒜
1411	423	  		
1335	425	id	Lumpia Sayur Semarang	Lumpia Goreng Saus Bawang ala Semarang
1412	418	  		
1315	420	id	Creamy Mushroom Soup	Mushroom Soup with Cream
1287	414	id	Sop Buntut	Sop Buntut atau Buntut Goreng sapi dengan Sayuran dan Kentang disajikan dengan Nasi Putih
1342	426	kr	Mie Goreng Jawa	
1356	430	cn	Pan Seared Beef Medalion with Creamy Mushroom	香煎牛肉與綜合蔬菜搭配奶油蘑菇醬與烤馬鈴薯
1413	428	  		
1367	433	id	Pisang Goreng	Fried Balinese Banana with Grated Coconut and Sesame Seed
1352	429	cn	Nasi Putih	
1326	422	kr	Gado-Gado	
1358	430	kr	Pan Seared Beef Medalion with Creamy Mushroom	
1414	426	  		
1375	435	id	Tiramisu Cake	Kue Keju Khas Italia dengan taburan Coffee
1416	423	  		
1354	429	kr	Nasi Putih	
1417	417	  		
1379	428	  		
1333	424	en	Iga Bakar Bumbu Ketumbar	Traditional Marinated Beef Rib with Coriander Sauce &amp; Condiments
1310	418	kr	Beef Burger With Cheese	
1360	431	cn	Pan Seared Norwegian Salmon	香煎挪威三文魚與綜合綠色沙拉，日式檸檬醬汁和水煮馬鈴薯
1418	424	  		
1380	426	  		
1353	429	en	Nasi Putih	White Rice
1381	414	  		
1334	424	kr	Iga Bakar Bumbu Ketumbar	
1421	422	  		
1328	423	cn	Gurami Bakar Sambal Sari Kuring	
1382	423	  		
1293	415	en	Soup of the Day	Sup Special yang disajikan Chef Hari ini
1383	417	  		
1348	428	cn	Nasi Goreng Kampoeng	傳統炒飯搭配雞肉烤肉串 雞腿肉與牛肉片
1341	426	en	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, shredded fired Chicken, Vegetable and Crackers
1384	424	  		
1325	422	en	Gado-Gado	Boiled mixed Local Vegetables in Peanut Sauce
1365	432	en	Panna Cotta	Dessert Khas Italia disajikan dengan irisan buah segar
1346	427	kr	Napolitana Sauce	
1422	425	  		
1385	424	  		
1321	421	en	Curry Udon with Seafood  &amp; Vegetable	Creamy Udon Noodle with Seafood
1386	412	  		
1423	415	  		
1387	422	  		
1424	420	  		
1319	421	id	Curry Udon with Seafood  &amp; Vegetable	Creamy Udon Noodle with Seafood
1323	422	id	Gado-Gado	Boiled mixed Local Vegetables in Peanut Sauce
1425	421	  		
1388	429	  		
1426	416	  		
1372	434	cn	Seasonal Fruit Slices	當地新鮮水果切片
1389	425	  		
1427	416	  		
1390	415	  		
1391	420	  		
1428	418	  		
1351	429	id	Nasi Putih	White Rice
1392	421	  		
1393	416	  		
1394	418	  		
1339	426	id	Mie Goreng Jawa	Bakmi Goreng Tradisional, dengan potongan Ayam Goreng, Telur, Sayuran dan Kerupuk
1340	426	cn	Mie Goreng Jawa	雞蛋蔬菜炒麵與開胃脆餅
1402	433	  		
1403	410	  		
1404	409	  		
1405	411	  		
1406	413	  		
1407	427	  		
1429	430	  		
1430	431	  		
1431	419	  		
1432	427	  		
1433	434	  		
1434	432	  		
1435	435	  		
1436	433	  		
1552	439	en	Banana Juice	
1526	417	  		
1466	410	  		
1527	418	  		
1528	423	  		
1467	417	  		
1529	424	  		
1530	412	  		
1437	417	  		
1438	418	  		
1439	419	  		
1440	420	  		
1441	421	  		
1442	422	  		
1443	423	  		
1444	424	  		
1445	425	  		
1446	426	  		
1447	427	  		
1448	412	  		
1449	428	  		
1450	429	  		
1451	432	  		
1452	430	  		
1453	431	  		
1454	433	  		
1536	433	  		
1455	434	  		
1456	414	  		
1457	415	  		
1458	416	  		
1500	417	  		
1459	435	  		
1460	418	  		
1501	418	  		
1461	430	  		
1462	416	  		
1463	416	  		
1464	418	  		
1502	419	  		
1465	430	  		
1363	432	id	Panna Cotta	Dessert Khas Italia disajikan dengan irisan buah segar
1537	434	  		
1473	417	  		
1474	418	  		
1472	417	  		
1475	419	  		
1538	415	  		
1503	436	  		
1371	434	id	Seasonal Fruit Slices	Aneka Lokal Buah Potong
1476	436	  		
1504	420	  		
1477	420	  		
1478	421	  		
1479	422	  		
1480	423	  		
1481	424	  		
1482	425	  		
1483	426	  		
1484	427	  		
1485	412	  		
1486	428	  		
1487	429	  		
1531	428	  		
1488	432	  		
1505	421	  		
1489	430	  		
1532	414	  		
1506	422	  		
1507	423	  		
1508	424	  		
1509	425	  		
1510	426	  		
1511	427	  		
1512	412	  		
1513	428	  		
1514	429	  		
1539	435	  		
1515	432	  		
1490	431	  		
1359	431	id	Pan Seared Norwegian Salmon	Bistik Ikan Salem Bakar dari Norwegia dengan Saus Teriyaki, Sayuran dan Kentang Rebus
1491	433	  		
1559	441	cn	Mix Berry Spritz	
1492	434	  		
1493	414	  		
1494	415	  		
1495	416	  		
1560	441	en	Mix Berry Spritz	
1496	435	  		
1516	430	  		
1497	417	  		
1498	418	  		
1499	418	  		
1546	438	id	Aglio e Olio	Daun BasiL, Bawang Putih &amp; Cabai
1557	440	kr	Lychee Ginger Cooler	
1561	441	kr	Mix Berry Spritz	
1549	438	kr	Aglio e Olio	
1305	417	en	Bebek Lengkuas	Fried Duck in Traditional Galangal Sauce &amp; Condiments
1551	439	cn	Banana Juice	
1517	431	  		
1543	437	  		
1518	433	  		
1519	434	  		
1520	414	  		
1521	415	  		
1522	416	  		
1541	437	en	ROOM SERVICE	Our Sincere apology that during the soft opening period this menu is not yet available.\nShould you need further information kindly contact our Front Desk by dialling ext.0
1523	435	  		
1524	416	  		
1525	416	  		
1542	437	id	ROOM SERVICE	Our Sincere apology that during the soft opening period this menu is not yet available.\nShould you need further information kindly contact our Front Desk by dialling ext.0
1533	420	  		
1534	421	  		
1357	430	en	Pan Seared Beef Medalion with Creamy Mushroom	Pan Seared Beef Medalion with Mix Vegetable, Creamy Mushroom and Baked Potato
1535	432	  		
1544	437	kr	ROOM SERVICE	Our Sincere apology that during the soft opening period this menu is not yet available.\nShould you need further information kindly contact our Front Desk by dialling ext.0
1545	437	  		
1303	417	id	Bebek Lengkuas	Fried Duck in Traditional Galangal Sauce &amp; Condiments
1471	436	kr	Carbonara Sauce	
1554	440	id	Lychee Ginger Cooler	
1369	433	en	Pisang Goreng	Fried Balinese Banana with Grated Coconut and Sesame Seed
1550	439	id	Banana Juice	
1469	436	cn	Carbonara Sauce	奶油燉煮搭配肉醬
1377	435	en	Tiramisu Cake	Layer Coffee flavored Italian Desserts
1553	439	kr	Banana Juice	
1470	436	en	Carbonara Sauce	Saus Krim dengan Daging Asap
1468	436	id	Carbonara Sauce	Saus Krim dengan Daging Asap
1555	440	cn	Lychee Ginger Cooler	
1556	440	en	Lychee Ginger Cooler	
1548	438	en	Aglio e Olio	Daun BasiL, Bawang Putih &amp; Cabai
1558	441	id	Mix Berry Spritz	
1540	437	cn	ROOM SERVICE	Our Sincere apology that during the soft opening period this menu is not yet available.\nShould you need further information kindly contact our Front Desk by dialling ext.0
1566	437	  		
1597	430	  		
1567	442	  		
1667	429	  		
1668	429	  		
1568	442	  		
1607	420	  		
1563	442	cn	Room Service	Our Sincere apology that during the soft opening period this menu is not yet available.\nShould you need further information kindly contact our Front Desk by dialling ext.0
1564	442	en	Room Service	Our Sincere apology that during the soft opening period this menu is not yet available.\nShould you need further information kindly contact our Front Desk by dialling ext.0
1562	442	id	Room Service	Our Sincere apology that during the soft opening period this menu is not yet available.\nShould you need further information kindly contact our Front Desk by dialling ext.0
1569	442	  		
1565	442	kr	Room Service	Our Sincere apology that during the soft opening period this menu is not yet available.\nShould you need further information kindly contact our Front Desk by dialling ext.0
1608	421	  		
1577	443	  		
1609	434	  		
1574	443	  		
1610	433	  		
1611	432	  		
1639	443	  		
1578	443	  		
1575	443	  		
1598	420	  		
1582	438	  		
1583	439	  		
1576	443	  		
1579	443	  		
1584	409	  		
1585	420	  		
1586	421	  		
1587	440	  		
1588	441	  		
1580	438	  		
1581	438	  		
1599	421	  		
1600	415	  		
1601	432	  		
1602	432	  		
1589	432	  		
1590	433	  		
1591	434	  		
1612	435	  		
1640	443	  		
1592	443	  		
1619	443	  		
1593	435	  		
1594	418	  		
1595	418	  		
1596	430	  		
1603	434	  		
1604	435	  		
1605	433	  		
1620	443	  		
1621	438	  		
1643	444	en	Iga Asam Pedas	
1606	443	  		
1622	438	  		
1613	417	  		
1614	438	  		
1615	438	  		
1616	438	  		
1617	438	  		
1618	420	  		
1623	419	  		
1624	419	  		
1625	436	  		
1626	436	  		
1627	420	  		
1628	420	  		
1629	421	  		
1630	421	  		
1631	427	  		
1632	427	  		
1633	432	  		
1634	432	  		
1635	415	  		
1636	415	  		
1637	436	  		
1638	436	  		
1641	444	id	Iga Asam Pedas	
1644	445	id	Ikan Kakap Bakar Sambal Matah	Ikan bakar dengan sambal matah disajikan dengan nasi putih
1570	443	id	Room Service	Our Sincere apology that during the soft opening period this menu is not yet available.&lt;br/&gt;Should you need further information kindly contact our Front Desk by dialling ext.0
1677	434	  		
1647	412	  		
1648	412	  		
1649	438	  		
1650	438	  		
1651	419	  		
1652	419	  		
1653	436	  		
1654	436	  		
1655	427	  		
1656	427	  		
1657	427	  		
1658	427	  		
1659	417	  		
1660	417	  		
1661	422	  		
1662	422	  		
1642	444	cn	Iga Asam Pedas	
1572	443	en	Room Service	Our Sincere apology that during the soft opening period this menu is not yet available.&lt;br/&gt;Should you need further information kindly contact our Front Desk by dialling ext.0
1663	444	  		
1664	444	  		
1665	424	  		
1666	424	  		
1669	420	  		
1670	420	  		
1671	415	  		
1672	415	  		
1673	430	  		
1674	430	  		
1295	416	id	Steak Sandwiches	with Seared Beef, Lettuce, Fried Egg, Smoked Beef, Tomato &amp; French fries\nRoti Ciabatta diisi dengan Daging, Selada, Telur Goreng, Daging asap, tomat dan kentang goreng
1675	416	  		
1676	416	  		
1678	434	  		
1679	435	  		
1680	435	  		
1681	418	  		
1682	418	  		
1683	436	  		
1684	436	  		
1685	420	  		
1686	420	  		
1687	423	  		
1688	423	  		
1689	426	  		
1690	426	  		
1691	427	  		
1692	427	  		
1693	431	  		
1694	431	  		
1695	434	  		
1696	434	  		
1697	414	  		
1698	414	  		
1699	438	  		
1700	438	  		
1701	419	  		
1702	419	  		
1703	435	  		
1704	435	  		
1705	418	  		
1706	418	  		
1707	438	  		
1708	438	  		
1709	420	  		
1710	420	  		
1711	414	  		
1712	414	  		
1713	435	  		
1714	435	  		
1715	418	  		
1716	418	  		
1717	428	  		
1718	428	  		
1719	426	  		
1720	426	  		
1721	414	  		
1722	414	  		
1723	445	  		
1724	445	  		
1725	420	  		
1726	420	  		
1727	418	  		
1728	418	  		
1729	431	  		
1730	431	  		
1731	438	  		
1732	438	  		
1733	419	  		
1734	419	  		
1735	436	  		
1736	436	  		
1737	427	  		
1738	427	  		
1739	434	  		
1740	434	  		
1741	435	  		
1742	435	  		
1309	418	en	Beef Burger With Cheese	Beef Burger, Cheese served with Vegetable and Fried Potato
1743	438	  		
1744	438	  		
1745	436	  		
1746	436	  		
1747	438	  		
1748	438	  		
1749	428	  		
1750	428	  		
1751	414	  		
1752	414	  		
1819	432	  		
1820	432	  		
1753	445	  		
1754	445	  		
1755	420	  		
1756	420	  		
1821	435	  		
1822	435	  		
1757	445	  		
1758	445	  		
1823	434	  		
1824	434	  		
1759	445	  		
1760	445	  		
1761	428	  		
1762	428	  		
1825	433	  		
1826	433	  		
1763	445	  		
1764	445	  		
1827	410	  		
1828	410	  		
1765	428	  		
1766	428	  		
1767	426	  		
1768	426	  		
1769	414	  		
1770	414	  		
1771	445	  		
1772	445	  		
1773	426	  		
1774	426	  		
1775	424	  		
1776	424	  		
1777	412	  		
1778	412	  		
1779	422	  		
1780	422	  		
1781	415	  		
1782	415	  		
1783	420	  		
1784	420	  		
1785	421	  		
1786	421	  		
1787	431	  		
1788	431	  		
1789	438	  		
1790	438	  		
1791	419	  		
1792	419	  		
1793	436	  		
1794	436	  		
1795	438	  		
1796	438	  		
1797	427	  		
1798	427	  		
1799	434	  		
1800	434	  		
1801	432	  		
1802	432	  		
1803	435	  		
1804	435	  		
1805	433	  		
1806	433	  		
1807	420	  		
1808	420	  		
1809	424	  		
1810	424	  		
1811	435	  		
1812	435	  		
1813	433	  		
1814	433	  		
1815	432	  		
1816	432	  		
1817	433	  		
1818	433	  		
1840	449	en	Watermelon Juice	
1834	447	en	Diet Coke	
1836	448	cn	Orange  Juice	
1841	435	  		
1842	435	  		
1831	446	en	Coca - Cola	
1829	446	id	Coca - Cola	
1833	447	cn	Diet Coke	
1843	449	  		
1844	449	  		
1835	448	id	Orange  Juice	
1845	447	  		
1846	447	  		
1839	449	cn	Watermelon Juice	
1837	448	en	Orange  Juice	
1832	447	id	Diet Coke	
1847	446	  		
1848	446	  		
1571	443	cn	Room Service	我们真诚的道歉，在试营业期间，这一菜单尚未公布。&lt;br/&gt;如果您需要进一步的信息，敬请拨打ext.0联系我们的接待台
1830	446	cn	Coca - Cola	
1838	449	id	Watermelon Juice	
1849	448	  		
1850	448	  		
1851	438	  		
1852	438	  		
1853	438	  		
1854	438	  		
1855	417	  		
1856	417	  		
1857	418	  		
1858	418	  		
1859	419	  		
1860	419	  		
1861	436	  		
1862	436	  		
1863	420	  		
1864	420	  		
1865	422	  		
1866	422	  		
1867	444	  		
1868	444	  		
1869	445	  		
1870	445	  		
1871	425	  		
1872	425	  		
1873	426	  		
1874	426	  		
1875	427	  		
1876	427	  		
1877	428	  		
1878	428	  		
1879	426	  		
1880	426	  		
1881	414	  		
1882	414	  		
1297	416	en	Steak Sandwiches	with Seared Beef, Lettuce, Fried Egg, Smoked Beef, Tomato &amp; French fries\nRoti Ciabatta diisi dengan Daging, Selada, Telur Goreng, Daging asap, tomat dan kentang goreng
1645	445	cn	Ikan Kakap Bakar Sambal Matah	烤紅鯛魚搭配巴里島辣醬
1883	445	  		
1884	445	  		
1885	417	  		
1886	417	  		
1887	424	  		
1888	424	  		
1889	444	  		
1890	444	  		
1891	412	  		
1892	412	  		
1893	429	  		
1894	429	  		
1895	422	  		
1896	422	  		
1897	415	  		
1898	415	  		
1899	421	  		
1900	421	  		
1901	416	  		
1902	416	  		
1903	418	  		
1904	418	  		
1905	430	  		
1906	430	  		
1907	431	  		
1908	431	  		
1909	431	  		
1910	431	  		
1911	438	  		
1912	438	  		
1913	419	  		
1914	419	  		
1915	436	  		
1916	436	  		
1917	427	  		
1918	427	  		
1919	434	  		
1920	434	  		
1921	432	  		
1922	432	  		
1923	435	  		
1924	435	  		
1925	433	  		
1926	433	  		
1646	445	en	Ikan Kakap Bakar Sambal Matah	Grilled Snapper Served with balinese chili sambal
1976	416	  		
1977	435	  		
1990	450	kr	Aglio e Olio	Basil Leaf, Garlic &amp; Chili
1929	434	  		
1930	434	  		
1927	433	  		
1928	433	  		
1931	432	  		
1932	432	  		
1933	435	  		
1934	435	  		
1935	433	  		
1936	433	  		
1937	410	  		
1938	410	  		
1939	410	  		
1940	410	  		
1941	410	  		
1942	410	  		
1978	449	  		
1979	449	kr		
1980	444	  		
1961	444	kr		
1981	417	  		
1982	424	  		
1943	443	  		
1573	443	kr	Room Service	소프트 오프닝 기간 동안 이 메뉴 는 아직 제공되지 않습니다 것을 진심으로 사과 .&lt;br/&gt;당신이 추가 정보가 필요 할까요 친절 ext.0 전화를 걸어 우리의 프론트 데스크 에 문의
1944	417	  		
1945	417	  		
1946	438	  		
1947	438	  		
1948	417	  		
1949	415	  		
1308	418	cn	Beef Burger With Cheese	牛肉漢堡配起司搭配綜合蔬菜與烤馬鈴薯
1950	418	  		
1951	419	  		
1952	436	  		
1953	446	  		
1954	446	kr		
1955	420	  		
1956	421	  		
1957	447	  		
1958	447	kr		
1959	422	  		
1960	444	  		
1962	424	  		
1963	425	  		
1964	426	  		
1965	412	  		
1966	429	  		
1349	428	en	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drumstick
1967	428	  		
1968	448	  		
1969	448	kr		
1970	431	  		
1971	430	  		
1972	432	  		
1973	433	  		
1974	434	  		
1289	414	en	Sop Buntut	Traditional Oxtail Soup or Fried with Vegetable and Potato served with Steamed Rice
1975	414	  		
1983	422	  		
1984	429	  		
1985	425	  		
1986	438	  		
2009	454	id	Coca - Cola	
2010	454	cn	Coca - Cola	
2007	453	kr	Pisang Goreng	
1999	433	  		
2000	433	  		
2001	433	  		
2002	433	  		
1994	451	kr	Bebek Lengkuas	
2004	453	id	Pisang Goreng	
1997	452	en	Beef Burger With Cheese	Beef Burger, Cheese served with Vegetable and Fried Potato
2003	433	  		
2011	454	en	Coca - Cola	
1991	451	id	Bebek Lengkuas	
2006	453	en	Pisang Goreng	
1988	450	cn	Aglio e Olio	Basil Leaf, Garlic &amp; Chili
1993	451	en	Bebek Lengkuas	
1987	450	id	Aglio e Olio	Basil Leaf, Garlic &amp; Chili
2012	454	kr	Coca - Cola	
2008	453	  		
1989	450	en	Aglio e Olio	Basil Leaf, Garlic &amp; Chili
1992	451	cn	Bebek Lengkuas	
2017	450	  		
2096	475	en	Tiramisu Cake	
2053	464	kr	Iga Bakar Bumbu Ketumbar	
2073	469	kr	Pan Seared Beef Medalion with Creamy Mushroom	
2094	475	id	Tiramisu Cake	
2046	463	id	Iga Asam Pedas	
2076	470	en	Pan Seared Norwegian Salmon	
2049	463	kr	Iga Asam Pedas	
2093	474	kr	Steak Sandwiches	
2095	475	cn	Tiramisu Cake	
2115	470	  		
2029	458	kr	Nasi Putih	
2079	471	cn	Panna Cotta	
2024	457	en	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drum Stick
2111	472	  		
2068	468	en	Orange  Juice	
2112	453	  		
2066	468	id	Orange  Juice	
2028	458	en	Nasi Putih	
2016	455	kr	Diet Coke	
2098	476	id	Watermelon Juice	
2097	475	kr	Tiramisu Cake	
2069	468	kr	Orange  Juice	
2099	476	cn	Watermelon Juice	
2062	467	id	Napolitana Sauce	
2126	459	  		
2091	474	cn	Steak Sandwiches	
2113	465	  		
2082	472	id	Seasonal Fruit Slices	
2074	470	id	Pan Seared Norwegian Salmon	
2102	450	  		
2084	472	en	Seasonal Fruit Slices	
2064	467	en	Napolitana Sauce	
2013	455	id	Diet Coke	
2103	466	  		
2044	462	en	Gado-Gado	Mix Vegetables Salad with Peanut Sauce
2038	461	id	Carbonara Sauce	
2056	465	en	Ikan Kakap Bakar Sambal Matah	
2031	459	cn	Bolognaise Meat Sauce	
2104	458	  		
2015	455	en	Diet Coke	
2105	452	  		
2057	465	kr	Ikan Kakap Bakar Sambal Matah	
2142	453	  		
2149	453	  		
2106	471	  		
2048	463	en	Iga Asam Pedas	
2081	471	kr	Panna Cotta	
2127	461	  		
2052	464	en	Iga Bakar Bumbu Ketumbar	
2133	477	id	Pineapple Juice	Fresh Pineapple, Mint Leave, Brown Sugar, Pineapple Juice
2067	468	cn	Orange  Juice	
2033	459	kr	Bolognaise Meat Sauce	
2030	459	id	Bolognaise Meat Sauce	
2122	463	  		
2134	477	cn	Pineapple Juice	Fresh Pineapple, Mint Leave, Brown Sugar, Pineapple Juice
2080	471	en	Panna Cotta	
2123	451	  		
2061	466	kr	Lumpia Sayur Semarang	Fried Vegetable Spring Roll a la Semarang
2077	470	kr	Pan Seared Norwegian Salmon	
2129	467	  		
2047	463	cn	Iga Asam Pedas	
2042	462	id	Gado-Gado	Mix Vegetables Salad with Peanut Sauce
2032	459	en	Bolognaise Meat Sauce	
2065	467	kr	Napolitana Sauce	
2107	420	  		
2108	421	  		
2125	457	  		
2101	476	kr	Watermelon Juice	
2014	455	cn	Diet Coke	
2109	460	  		
2026	458	id	Nasi Putih	
2039	461	cn	Carbonara Sauce	
2041	461	kr	Carbonara Sauce	
2063	467	cn	Napolitana Sauce	
2110	475	  		
2020	456	en	Nasi Campur Bali ( Signature Dish)	Balinese Rice with Satay, Boiled Egg, Prawn, &quot;Ayam Betutu'' &amp; ''Lawar''
2040	461	en	Carbonara Sauce	
2085	472	kr	Seasonal Fruit Slices	
2114	469	  		
2060	466	en	Lumpia Sayur Semarang	Fried Vegetable Spring Roll a la Semarang
2075	470	cn	Pan Seared Norwegian Salmon	
2055	465	cn	Ikan Kakap Bakar Sambal Matah	
2050	464	id	Iga Bakar Bumbu Ketumbar	
2034	460	id	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, Shredded fired Chicken, Vegetable and Creakers
2116	474	  		
2035	460	cn	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, Shredded fired Chicken, Vegetable and Creakers
2051	464	cn	Iga Bakar Bumbu Ketumbar	
2054	465	id	Ikan Kakap Bakar Sambal Matah	
2059	466	cn	Lumpia Sayur Semarang	Fried Vegetable Spring Roll a la Semarang
2117	468	  		
2021	456	kr	Nasi Campur Bali ( Signature Dish)	Balinese Rice with Satay, Boiled Egg, Prawn, &quot;Ayam Betutu'' &amp; ''Lawar''
2090	474	id	Steak Sandwiches	
2027	458	cn	Nasi Putih	
2118	455	  		
2072	469	en	Pan Seared Beef Medalion with Creamy Mushroom	
2119	454	  		
2043	462	cn	Gado-Gado	Mix Vegetables Salad with Peanut Sauce
2078	471	id	Panna Cotta	
2100	476	en	Watermelon Juice	
2120	456	  		
2092	474	en	Steak Sandwiches	
2071	469	cn	Pan Seared Beef Medalion with Creamy Mushroom	
2121	473	  		
2124	460	  		
2128	462	  		
2130	415	  		
2132	476	  		
2131	476	  		
2137	477	  		
2138	450	  		
2139	450	  		
2140	467	  		
2141	471	  		
2143	475	  		
2144	472	  		
2145	459	  		
2146	461	  		
2147	467	  		
2148	471	  		
2150	472	  		
2151	475	  		
2245	498	kr	Healthy Life	Spinach, Pineapple, Cucumber, Green Apple
2187	484	cn	Aqua Reflection Sparkling	
2190	485	id	Banana Juice	
2206	489	id	Double Espresso	
2168	479	  		
2233	495	kr	Frozen Orange, Mint, Ginger	Mint Leave, Ginger, Orange Juice, Lime Juice, Mojito Mint
2162	480	en	Bintang Radler	
2186	484	id	Aqua Reflection Sparkling	
2248	499	en	Hot Tea	
2169	478	  		
2188	484	en	Aqua Reflection Sparkling	
2251	500	cn	Ice Chocolate	
2234	496	id	Ginger Ale	
2156	479	id	Bintang	
2170	480	  		
2158	479	en	Bintang	
2235	496	cn	Ginger Ale	
2252	500	en	Ice Chocolate	
2257	501	kr	Ice Coffee	
2171	481	  		
2254	501	id	Ice Coffee	
2172	461	  		
2173	467	  		
2174	471	  		
2175	453	  		
2221	492	kr	Espresso	
2176	472	  		
2177	475	  		
2153	478	cn	Bali Hai	
2180	482	en	Americano	
2222	493	id	Flat White	
2256	501	en	Ice Coffee	
2255	501	cn	Ice Coffee	
2167	481	kr	Corona	
2163	480	kr	Bintang Radler	
2223	493	cn	Flat White	
2179	482	cn	Americano	
2253	500	kr	Ice Chocolate	
2194	486	id	Cafe Latte	
2241	497	kr	Green Machine	Green Apple, Fennel, Kale, Mint Leave, Cucumber, lime ginger, honey
2224	493	en	Flat White	
2231	495	cn	Frozen Orange, Mint, Ginger	Mint Leave, Ginger, Orange Juice, Lime Juice, Mojito Mint
2230	495	id	Frozen Orange, Mint, Ginger	Mint Leave, Ginger, Orange Juice, Lime Juice, Mojito Mint
2166	481	en	Corona	
2238	497	id	Green Machine	Green Apple, Fennel, Kale, Mint Leave, Cucumber, lime ginger, honey
2243	498	cn	Healthy Life	Spinach, Pineapple, Cucumber, Green Apple
2242	498	id	Healthy Life	Spinach, Pineapple, Cucumber, Green Apple
2154	478	en	Bali Hai	
2198	487	id	Cappucino	
2232	495	en	Frozen Orange, Mint, Ginger	Mint Leave, Ginger, Orange Juice, Lime Juice, Mojito Mint
2164	481	id	Corona	
2197	486	kr	Cafe Latte	
2225	493	kr	Flat White	
2208	489	en	Double Espresso	
2244	498	en	Healthy Life	Spinach, Pineapple, Cucumber, Green Apple
2246	499	id	Hot Tea	
2157	479	cn	Bintang	
2209	489	kr	Double Espresso	
2239	497	cn	Green Machine	Green Apple, Fennel, Kale, Mint Leave, Cucumber, lime ginger, honey
2191	485	cn	Banana Juice	
2183	483	cn	Aqua Reflection	
2178	482	id	Americano	
2210	490	id	Equil Natural 380 ml	
2211	490	cn	Equil Natural 380 ml	
2155	478	kr	Bali Hai	
2247	499	cn	Hot Tea	
2192	485	en	Banana Juice	
2240	497	en	Green Machine	Green Apple, Fennel, Kale, Mint Leave, Cucumber, lime ginger, honey
2083	472	cn	Seasonal Fruit Slices	
2199	487	cn	Cappucino	
2250	500	id	Ice Chocolate	
2227	494	cn	Flavored Ice Tea	
2203	488	cn	Chocolate  Milkshake & Smoothies	
2182	483	id	Aqua Reflection	
2193	485	kr	Banana Juice	
2201	487	kr	Cappucino	
2212	490	en	Equil Natural 380 ml	
2160	480	id	Bintang Radler	
2195	486	cn	Cafe Latte	
2181	482	kr	Americano	
2196	486	en	Cafe Latte	
2236	496	en	Ginger Ale	
2185	483	kr	Aqua Reflection	
2200	487	en	Cappucino	
2202	488	id	Chocolate  Milkshake & Smoothies	
2204	488	en	Chocolate  Milkshake & Smoothies	
2165	481	cn	Corona	
2249	499	kr	Hot Tea	
2217	491	kr	Equil Sparkling 380 ml	
2205	488	kr	Chocolate  Milkshake & Smoothies	
2228	494	en	Flavored Ice Tea	
2226	494	id	Flavored Ice Tea	
2229	494	kr	Flavored Ice Tea	
2207	489	cn	Double Espresso	
2213	490	kr	Equil Natural 380 ml	
2216	491	en	Equil Sparkling 380 ml	
2159	479	kr	Bintang	
2237	496	kr	Ginger Ale	
2214	491	id	Equil Sparkling 380 ml	
2215	491	cn	Equil Sparkling 380 ml	
2189	484	kr	Aqua Reflection Sparkling	
2070	469	id	Pan Seared Beef Medalion with Creamy Mushroom	
2184	483	en	Aqua Reflection	
2152	478	id	Bali Hai	
2161	480	cn	Bintang Radler	
2218	492	id	Espresso	
2219	492	cn	Espresso	
2220	492	en	Espresso	
2302	450	  		
2303	482	  		
2304	483	  		
2305	484	  		
2306	478	  		
2307	479	  		
2308	480	  		
2309	459	  		
2310	486	  		
2311	487	  		
2312	461	  		
2313	488	  		
2314	481	  		
2315	489	  		
2316	490	  		
2317	491	  		
2318	492	  		
2319	493	  		
2320	494	  		
2321	495	  		
2322	496	  		
2323	497	  		
2324	498	  		
2325	499	  		
2326	500	  		
2327	501	  		
2404	515	id	Carrot Juice	
2298	512	id	Vanilla Milkshake & Smoothies	
2405	515	cn	Carrot Juice	
2328	502	  		
2291	510	cn	Sprite	
2399	513	kr	Apple Juice	
2275	506	cn	Machiato	
2300	512	en	Vanilla Milkshake & Smoothies	
2329	503	  		
2276	506	en	Machiato	
2272	505	en	Lemon Mint Lemonade	Fresh Lemon, Mint Leave, Mint Syrup, Lemonade
2261	502	kr	Ice Coffee Latte	
2289	509	kr	Soda	
2330	504	  		
2367	512	  		
2402	514	en	Blue Fairy	Guava Juice, Peach Syrup, Blue Curacao Syrup
2368	498	  		
2263	503	cn	Ice Tea	
2331	505	  		
2406	515	en	Carrot Juice	
2398	513	en	Apple Juice	
2369	508	  		
2393	510	  		
2332	506	  		
2370	497	  		
2333	467	  		
2334	471	  		
2371	478	  		
2372	479	  		
2373	480	  		
2335	507	  		
2374	481	  		
2411	516	kr	Green Garden	Kiwi, Honey Dew Melon, Pineapple Juice, Lychee, Passion
2336	453	  		
2403	514	kr	Blue Fairy	Guava Juice, Peach Syrup, Blue Curacao Syrup
2407	515	kr	Carrot Juice	
2294	511	id	Strawberry  Milkshake & Smoothies	
2337	508	  		
2284	508	en	Purple Booster	Carrot, Green Apple, Beetroot, Ginger, Celery, Lemon
2338	472	  		
2375	499	  		
2376	483	  		
2377	484	  		
2339	509	  		
2378	451	  		
2379	487	  		
2380	482	  		
2381	491	  		
2340	510	  		
2382	495	  		
2383	496	  		
2384	497	  		
2385	498	  		
2341	511	  		
2386	500	  		
2342	475	  		
2388	505	  		
2280	507	en	Passion Cooler	Passion Puree, Passion Syrup, Lime, Mint Leave, Top Ginger
2264	503	en	Ice Tea	
2343	512	  		
2396	513	id	Apple Juice	
2344	482	  		
2345	492	  		
2346	489	  		
2347	487	  		
2348	486	  		
2287	509	cn	Soda	
2292	510	en	Sprite	
2262	503	id	Ice Tea	
2349	506	  		
2005	453	cn	Pisang Goreng	
2350	454	  		
2351	455	  		
2282	508	id	Purple Booster	Carrot, Green Apple, Beetroot, Ginger, Celery, Lemon
2352	510	  		
2353	496	  		
2394	499	  		
2395	476	  		
2354	509	  		
2355	483	  		
2356	484	  		
2357	490	  		
2358	491	  		
2286	509	id	Soda	
2390	508	  		
2273	505	kr	Lemon Mint Lemonade	Fresh Lemon, Mint Leave, Mint Syrup, Lemonade
2359	505	  		
2391	470	  		
2360	495	  		
2361	477	  		
2413	517	cn	Honey Dew Melon Juice	
2389	507	  		
2290	510	id	Sprite	
2362	504	  		
2270	505	id	Lemon Mint Lemonade	Fresh Lemon, Mint Leave, Mint Syrup, Lemonade
2281	507	kr	Passion Cooler	Passion Puree, Passion Syrup, Lime, Mint Leave, Top Ginger
2277	506	kr	Machiato	
2392	509	  		
2363	507	  		
2271	505	cn	Lemon Mint Lemonade	Fresh Lemon, Mint Leave, Mint Syrup, Lemonade
2364	497	  		
2365	488	  		
2260	502	en	Ice Coffee Latte	
2283	508	cn	Purple Booster	Carrot, Green Apple, Beetroot, Ginger, Celery, Lemon
2301	512	kr	Vanilla Milkshake & Smoothies	
2366	511	  		
2259	502	cn	Ice Coffee Latte	
2274	506	id	Machiato	
2288	509	en	Soda	
2293	510	kr	Sprite	
2387	504	  		
2297	511	kr	Strawberry  Milkshake & Smoothies	
2296	511	en	Strawberry  Milkshake & Smoothies	
2397	513	cn	Apple Juice	
2412	517	id	Honey Dew Melon Juice	
2295	511	cn	Strawberry  Milkshake & Smoothies	
2414	517	en	Honey Dew Melon Juice	
2265	503	kr	Ice Tea	
2428	505	  		
2429	495	  		
2430	514	  		
2431	504	  		
2432	507	  		
2433	516	  		
2434	488	  		
2435	511	  		
2436	512	  		
2437	483	  		
2438	484	  		
2439	490	  		
2440	491	  		
2441	490	  		
2442	454	  		
2443	455	  		
2444	499	  		
2445	482	  		
2446	450	  		
2447	459	  		
2448	486	  		
2449	487	  		
2450	461	  		
2451	489	  		
2452	492	  		
2453	493	  		
2454	500	  		
2455	501	  		
2532	521	cn	30 Mile - Bottle	
2456	502	  		
2457	503	  		
2458	506	  		
2459	467	  		
2460	471	  		
2461	453	  		
2462	472	  		
2463	475	  		
2464	513	  		
2465	486	  		
2466	515	  		
2467	490	  		
2468	492	  		
2469	489	  		
2470	505	  		
2471	517	  		
2527	504	  		
2472	506	  		
2530	494	  		
2473	519	  		
2528	504	  		
2549	525	en	Lychee Ice Tea	
2474	520	  		
2550	525	kr	Lychee Ice Tea	
2475	500	  		
2476	501	  		
2555	527	id	San Pellegrino 500ml	
2477	502	  		
2478	494	  		
2479	516	  		
2480	514	  		
2481	494	  		
2541	523	en	Green Apple Ice Tea	
2529	504	  		
2420	519	id	Papaya Juice	
2268	504	en	Kuta Sunset	Mango Juice, Orange Juice, Cranberry Juice, Lemon Juice, Grenadine Syrup
2559	528	id	Strawberry Ice Tea	
2533	521	en	30 Mile - Bottle	
2558	527	kr	San Pellegrino 500ml	
2423	519	kr	Papaya Juice	
2269	504	kr	Kuta Sunset	Mango Juice, Orange Juice, Cranberry Juice, Lemon Juice, Grenadine Syrup
2419	518	kr	Mango Juice	
2537	522	en	Mojito Mint Ice Tea	
2482	450	  		
2483	482	  		
2484	483	  		
2485	484	  		
2486	514	  		
2487	459	  		
2488	486	  		
2489	454	  		
2490	461	  		
2491	487	  		
2492	455	  		
2493	489	  		
2494	490	  		
2495	491	  		
2496	492	  		
2497	495	  		
2498	495	  		
2499	516	  		
2500	499	  		
2501	500	  		
2502	501	  		
2503	502	  		
2504	503	  		
2505	504	  		
2506	505	  		
2507	506	  		
2508	467	  		
2509	471	  		
2510	507	  		
2511	453	  		
2512	472	  		
2513	475	  		
2514	507	  		
2515	495	  		
2516	462	  		
2517	488	  		
2518	511	  		
2421	519	cn	Papaya Juice	
2519	512	  		
2520	466	  		
2521	450	  		
2522	471	  		
2523	474	  		
2524	514	  		
2525	494	  		
2526	504	  		
2425	520	cn	Strawberry Juice	
2560	528	cn	Strawberry Ice Tea	
2542	523	kr	Green Apple Ice Tea	
2535	522	id	Mojito Mint Ice Tea	
2561	528	en	Strawberry Ice Tea	
2551	526	id	Peach Ice Tea	
2563	521	  		
2546	524	kr	Kratingdaeng Tonic	
2564	450	  		
2565	482	  		
2566	483	  		
2556	527	cn	San Pellegrino 500ml	
2534	521	kr	30 Mile - Bottle	
2299	512	cn	Vanilla Milkshake & Smoothies	
2539	523	id	Green Apple Ice Tea	
2544	524	cn	Kratingdaeng Tonic	
2426	520	en	Strawberry Juice	
2422	519	en	Papaya Juice	
2415	517	kr	Honey Dew Melon Juice	
2562	528	kr	Strawberry Ice Tea	
2540	523	cn	Green Apple Ice Tea	
2417	518	cn	Mango Juice	
2266	504	id	Kuta Sunset	Mango Juice, Orange Juice, Cranberry Juice, Lemon Juice, Grenadine Syrup
2545	524	en	Kratingdaeng Tonic	
2538	522	kr	Mojito Mint Ice Tea	
2543	524	id	Kratingdaeng Tonic	
2416	518	id	Mango Juice	
2418	518	en	Mango Juice	
2531	521	id	30 Mile - Bottle	
2548	525	cn	Lychee Ice Tea	
2547	525	id	Lychee Ice Tea	
2552	526	cn	Peach Ice Tea	
2557	527	en	San Pellegrino 500ml	
2424	520	id	Strawberry Juice	
2427	520	kr	Strawberry Juice	
2567	484	  		
2568	514	  		
2569	459	  		
2570	486	  		
2571	487	  		
2572	461	  		
2573	488	  		
2574	454	  		
2575	455	  		
2576	489	  		
2577	490	  		
2578	491	  		
2579	492	  		
2580	522	  		
2581	495	  		
2582	523	  		
2583	516	  		
2584	499	  		
2585	500	  		
2586	502	  		
2587	524	  		
2588	504	  		
2589	505	  		
2590	466	  		
2591	525	  		
2592	506	  		
2593	467	  		
2594	471	  		
2595	507	  		
2596	526	  		
2597	453	  		
2598	527	  		
2599	472	  		
2600	528	  		
2601	511	  		
2602	475	  		
2603	512	  		
2604	507	  		
2605	505	  		
2606	495	  		
2607	477	  		
2608	514	  		
2609	507	  		
2610	516	  		
2554	526	kr	Peach Ice Tea	
2400	514	id	Blue Fairy	Guava Juice, Peach Syrup, Blue Curacao Syrup
2611	516	  		
2135	477	en	Pineapple Juice	Fresh Pineapple, Mint Leave, Brown Sugar, Pineapple Juice
2627	530	en	Beer Promotion	
2612	507	  		
2613	498	  		
2614	508	  		
2615	497	  		
2616	499	  		
2617	499	  		
2618	451	  		
2619	475	  		
2620	450	  		
2628	530	kr	Beer Promotion	
2668	532	  		
2635	532	en	Heineken	Price one bottle
2669	501	  		
2670	502	  		
2285	508	kr	Purple Booster	Carrot, Green Apple, Beetroot, Ginger, Celery, Lemon
2681	453	  		
2682	527	  		
2683	472	  		
2553	526	en	Peach Ice Tea	
2279	507	cn	Passion Cooler	Passion Puree, Passion Syrup, Lime, Mint Leave, Top Ginger
2692	498	  		
2637	521	  		
2638	450	  		
2639	482	  		
2640	513	  		
2641	483	  		
2642	484	  		
2646	530	  		
2705	459	  		
2671	503	  		
2643	529	  		
2644	451	  		
2697	533	kr	Ikan Bakar Jimbaran	Grilled Fish with Condiment Jimbaran Style
2634	532	cn	Heineken	Price one bottle
2622	529	cn	Bebek Goreng Kunyit	Fried Crispy Duck with Turmeric Sauce
2645	529	  		
2672	504	  		
2684	528	  		
2647	532	  		
2685	511	  		
2631	531	en	French Fries	
2267	504	cn	Kuta Sunset	Mango Juice, Orange Juice, Cranberry Juice, Lemon Juice, Grenadine Syrup
2648	514	  		
2649	459	  		
2650	486	  		
2651	487	  		
2652	461	  		
2653	488	  		
2654	454	  		
2655	420	  		
2656	455	  		
2657	489	  		
2658	490	  		
2659	491	  		
2660	492	  		
2661	493	  		
2624	529	kr	Bebek Goreng Kunyit	Fried Crispy Duck with Turmeric Sauce
2662	522	  		
2663	495	  		
2664	523	  		
2401	514	cn	Blue Fairy	Guava Juice, Peach Syrup, Blue Curacao Syrup
2689	516	  		
2691	508	  		
2665	516	  		
2666	499	  		
2667	500	  		
2630	531	cn	French Fries	
2629	531	id	French Fries	
2673	505	  		
2674	525	  		
2675	506	  		
2676	518	  		
2677	467	  		
2678	471	  		
2632	531	kr	French Fries	
2696	533	en	Ikan Bakar Jimbaran	Grilled Fish with Condiment Jimbaran Style
2679	507	  		
2258	502	id	Ice Coffee Latte	
2680	526	  		
2686	475	  		
2687	512	  		
2688	458	  		
2636	532	kr	Heineken	Price one bottle
2278	507	id	Passion Cooler	Passion Puree, Passion Syrup, Lime, Mint Leave, Top Ginger
2690	497	  		
2698	521	  		
2693	456	  		
2136	477	kr	Pineapple Juice	Fresh Pineapple, Mint Leave, Brown Sugar, Pineapple Juice
2625	530	id	Beer Promotion	
2621	529	id	Bebek Goreng Kunyit	Fried Crispy Duck with Turmeric Sauce
2626	530	cn	Beer Promotion	
2623	529	en	Bebek Goreng Kunyit	Fried Crispy Duck with Turmeric Sauce
2633	532	id	Heineken	Price one bottle
2699	450	  		
2700	482	  		
2701	483	  		
2702	484	  		
2703	529	  		
2704	514	  		
2706	486	  		
2707	485	  		
2708	487	  		
2709	461	  		
2710	515	  		
2711	488	  		
2712	454	  		
2713	454	  		
2714	420	  		
2715	455	  		
2716	489	  		
2717	490	  		
2718	491	  		
2719	492	  		
2720	493	  		
2721	522	  		
2722	495	  		
2723	523	  		
2724	516	  		
2725	499	  		
2726	500	  		
2727	501	  		
2728	502	  		
2729	503	  		
2730	463	  		
2731	504	  		
2732	505	  		
2733	525	  		
2734	506	  		
2735	467	  		
2736	471	  		
2737	507	  		
2738	526	  		
2739	453	  		
2740	527	  		
2741	472	  		
2742	528	  		
2743	511	  		
2744	475	  		
2745	512	  		
2746	488	  		
2747	533	  		
2748	450	  		
2749	450	  		
2750	450	  		
2751	421	  		
2752	450	  		
2837	454	  		
2821	473	  		
2822	529	  		
2823	514	  		
2824	454	  		
2753	494	  		
2825	455	  		
2826	495	  		
2815	542	cn	The Anvaya Prawn Laksa	
2827	516	  		
2828	504	  		
2778	534	  		
2829	505	  		
2816	542	en	The Anvaya Prawn Laksa	
2817	542	kr	The Anvaya Prawn Laksa	
2811	541	cn	Soto Ayam Lamongan	
2779	539	  		
2785	534	  		
2763	536	cn	Carbonara Sauce	
2780	537	  		
2786	534	  		
2787	529	  		
2781	535	  		
2788	514	  		
2789	454	  		
2790	455	  		
2791	495	  		
2782	536	  		
2864	543	kr	Potato Wedges	
2783	467	  		
2792	522	  		
2793	523	  		
2812	541	en	Soto Ayam Lamongan	
2784	538	  		
2765	536	kr	Carbonara Sauce	
2794	516	  		
2795	503	  		
2796	504	  		
2797	505	  		
2798	525	  		
2799	471	  		
2800	507	  		
2801	526	  		
2802	453	  		
2803	472	  		
2804	528	  		
2805	475	  		
2762	536	id	Carbonara Sauce	
2755	534	cn	Aglio e Olio	Basil Leaf, Garlic &amp; Chili
2845	523	  		
2846	471	  		
2847	507	  		
2768	537	en	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, Shredded fired Chicken, Vegetable and Creakers
2754	534	id	Aglio e Olio	Basil Leaf, Garlic &amp; Chili
2806	540	id	Mie Rebus	
2808	540	en	Mie Rebus	
2809	540	kr	Mie Rebus	
2536	522	cn	Mojito Mint Ice Tea	
2838	455	  		
2839	495	  		
2770	538	id	Napolitana Sauce	
2855	450	  		
2818	541	  		
2840	516	  		
2865	420	  		
2835	529	  		
2836	514	  		
2819	540	  		
2841	504	  		
2842	505	  		
2830	471	  		
2810	541	id	Soto Ayam Lamongan	
2813	541	kr	Soto Ayam Lamongan	
2771	538	cn	Napolitana Sauce	
2807	540	cn	Mie Rebus	
1292	415	cn	Soup of the Day	今日主廚特選湯品
2756	534	en	Aglio e Olio	Basil Leaf, Garlic &amp; Chili
2757	534	kr	Aglio e Olio	Basil Leaf, Garlic &amp; Chili
2843	525	  		
2772	538	en	Napolitana Sauce	
2820	542	  		
2831	507	  		
2832	472	  		
2833	453	  		
2834	475	  		
2764	536	en	Carbonara Sauce	
2773	538	kr	Napolitana Sauce	
2775	539	cn	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drum Stick
2777	539	kr	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drum Stick
2861	543	id	Potato Wedges	
2758	535	id	Bolognaise Meat Sauce	
2759	535	cn	Bolognaise Meat Sauce	
2760	535	en	Bolognaise Meat Sauce	
2761	535	kr	Bolognaise Meat Sauce	
2863	543	en	Potato Wedges	
2814	542	id	The Anvaya Prawn Laksa	
2844	522	  		
2848	453	  		
2849	526	  		
2850	472	  		
2851	528	  		
2852	475	  		
2853	473	  		
2854	516	  		
2856	450	  		
2857	484	  		
2858	484	  		
2859	420	  		
2860	420	  		
2866	531	  		
2867	464	  		
2868	463	  		
2869	465	  		
2870	469	  		
2871	470	  		
2872	543	  		
2873	474	  		
2874	522	  		
2875	523	  		
2876	525	  		
2877	526	  		
2878	528	  		
2879	455	  		
2880	454	  		
2881	495	  		
2882	514	  		
2883	516	  		
2884	504	  		
2885	505	  		
2886	471	  		
2887	529	  		
2888	507	  		
2889	453	  		
2890	472	  		
2891	475	  		
2892	452	  		
2921	516	  		
2922	503	  		
2893	452	  		
2923	504	  		
2924	505	  		
2925	525	  		
2926	471	  		
2927	472	  		
2928	507	  		
2929	453	  		
2930	475	  		
2931	528	  		
2932	526	  		
2933	473	  		
2934	503	  		
2904	546	en	Nyepi Promo Gegodoh Biu & Coffee or Tea	
2905	546	kr	Nyepi Promo Gegodoh Biu & Coffee or Tea	
2862	543	cn	Potato Wedges	
2992	559	en	Cramcam ayam	Chicken Soup with Shallot Balinese Style
2947	548	cn	Aneka Be Pasih Megoreng	Fried Seafood Platter
2995	560	cn	Es podeng	
2996	560	en	Es podeng	
2910	544	  		
2911	547	  		
2912	546	  		
3002	562	id	Jukut urab	
2955	550	cn	Ares bebek	Balinese Duck Soup with Banana Trunk
2902	546	id	Nyepi Promo Gegodoh Biu & Coffee or Tea	
2913	545	  		
2914	529	  		
2915	514	  		
2916	454	  		
2917	455	  		
2918	522	  		
2919	495	  		
2920	523	  		
2953	549	kr	Aneka be pasih panggang	Grilled Mixed Seafood; Prawn, Fish Fillet, and Squid
2994	560	id	Es podeng	
2957	550	kr	Ares bebek	Balinese Duck Soup with Banana Trunk
2959	551	cn	Ayam panggang kalas	Roasted Chicken in Spices Coconut Milk
2998	561	id	Gedang mekuah	Green Papaya Soup
3000	561	en	Gedang mekuah	Green Papaya Soup
3004	562	en	Jukut urab	
2956	550	en	Ares bebek	Balinese Duck Soup with Banana Trunk
2984	557	en	Bebek Garang Asem	Stewed Duck Balinese Style
2935	529	  		
2936	514	  		
2937	455	  		
2938	495	  		
2939	516	  		
2940	504	  		
2941	505	  		
2942	507	  		
2943	472	  		
2944	453	  		
2945	475	  		
2908	547	en	Nyepi Promo Gado - Gado & Young Coconut	
2965	552	kr	Ayam pelalah	Shredded Chicken with Lemongrass Relish Balinese Style
2983	557	cn	Bebek Garang Asem	Stewed Duck Balinese Style
2986	558	id	Coconut pudding	
2903	546	cn	Nyepi Promo Gegodoh Biu & Coffee or Tea	
2909	547	kr	Nyepi Promo Gado - Gado & Young Coconut	
2979	556	cn	Bebek Betutu	Roasted Duck in Balinese Spices
2968	553	en	Babi kecap	Stewed Pork with Sweet Soy Sauce
2969	553	kr	Babi kecap	Stewed Pork with Sweet Soy Sauce
2961	551	kr	Ayam panggang kalas	Roasted Chicken in Spices Coconut Milk
2895	544	cn	Nyepi Promo Beef Burger & Soft drink	
2899	545	cn	Nyepi Promo Beer Bucket & French Fries	
2898	545	id	Nyepi Promo Beer Bucket & French Fries	
2900	545	en	Nyepi Promo Beer Bucket & French Fries	
2997	560	kr	Es podeng	
2952	549	en	Aneka be pasih panggang	Grilled Mixed Seafood; Prawn, Fish Fillet, and Squid
2980	556	en	Bebek Betutu	Roasted Duck in Balinese Spices
2958	551	id	Ayam panggang kalas	Roasted Chicken in Spices Coconut Milk
2987	558	cn	Coconut pudding	
2972	554	en	Be celeng menyatnyat	Stewed Pork in Turmeric Sauce and Balinese Tradisional Sausage
2951	549	cn	Aneka be pasih panggang	Grilled Mixed Seafood; Prawn, Fish Fillet, and Squid
2985	557	kr	Bebek Garang Asem	Stewed Duck Balinese Style
2978	556	id	Bebek Betutu	Roasted Duck in Balinese Spices
2967	553	cn	Babi kecap	Stewed Pork with Sweet Soy Sauce
2989	558	kr	Coconut pudding	
3003	562	cn	Jukut urab	
2964	552	en	Ayam pelalah	Shredded Chicken with Lemongrass Relish Balinese Style
2976	555	en	Be siap sambal matah	Roasted Chicken with Sambal Matah
2977	555	kr	Be siap sambal matah	Roasted Chicken with Sambal Matah
1995	452	id	Beef Burger With Cheese	Beef Burger, Cheese served with Vegetable and Fried Potato
2988	558	en	Coconut pudding	
3001	561	kr	Gedang mekuah	Green Papaya Soup
2896	544	en	Nyepi Promo Beef Burger & Soft drink	
2897	544	kr	Nyepi Promo Beef Burger & Soft drink	
2901	545	kr	Nyepi Promo Beer Bucket & French Fries	
2906	547	id	Nyepi Promo Gado - Gado & Young Coconut	
2907	547	cn	Nyepi Promo Gado - Gado & Young Coconut	
3046	552	  		
3047	562	  		
3031	569	cn	Sate lilit ikan	Traditional Balinese White Fish Satay with Condiment
3098	574	en	Bienenstich	
3087	462	  		
3088	562	  		
3048	570	  		
3034	570	id	Tipat cantok	
3130	582	en	Vanilla Creme Brule	Its French desserts consisting of a rich egg custard base, topped with a constrating layer of hard caramel
3099	574	kr	Bienenstich	
3093	573	cn	Apple Crumble	Its Apple filling over a shortcrust pastry and topped with Cinnamon Crumble.
3049	571	  		
3050	558	  		
3051	560	  		
3105	576	cn	Lemon Tart	Its a lemon pudding over a shortcrust pastry and last minute caramelized on topped.
3045	572	kr	Udang bakar bumbu merah	Grilled River Prawn in Sweet &amp; Hot Sauce with Condiment
3012	564	en	Kuah iga celeng	Stewed Pork Spare Ribs
3052	566	  		
3100	575	id	Chocolate Summer Cake	Its a layer of Chocolate Cake, with berries jelly, cover with pistachio-chocolate glazed
2990	559	id	Cramcam ayam	Chicken Soup with Shallot Balinese Style
2949	548	kr	Aneka Be Pasih Megoreng	Fried Seafood Platter
3005	562	kr	Jukut urab	
3053	567	  		
3006	563	id	Kambing menyatnyat	Stewed Lamb Balinese Style
3035	570	cn	Tipat cantok	
3036	570	en	Tipat cantok	
3037	570	kr	Tipat cantok	
3054	563	  		
3040	571	en	Tuna sambal matah	Pan Seared Tuna with Lemongrass and Shallot Sambal
3055	555	  		
3056	554	  		
2974	555	id	Be siap sambal matah	Roasted Chicken with Sambal Matah
3008	563	en	Kambing menyatnyat	Stewed Lamb Balinese Style
3009	563	kr	Kambing menyatnyat	Stewed Lamb Balinese Style
3057	568	  		
3044	572	en	Udang bakar bumbu merah	Grilled River Prawn in Sweet &amp; Hot Sauce with Condiment
3041	571	kr	Tuna sambal matah	Pan Seared Tuna with Lemongrass and Shallot Sambal
3058	564	  		
3059	551	  		
3060	553	  		
3089	456	  		
3090	469	  		
3061	565	  		
3091	470	  		
3062	548	  		
3063	549	  		
3064	569	  		
3101	575	cn	Chocolate Summer Cake	Its a layer of Chocolate Cake, with berries jelly, cover with pistachio-chocolate glazed
3065	572	  		
3132	452	  		
3066	556	  		
3067	557	  		
3068	550	  		
3069	559	  		
3070	561	  		
2409	516	cn	Green Garden	Kiwi, Honey Dew Melon, Pineapple Juice, Lychee, Passion
3071	565	  		
3095	573	kr	Apple Crumble	Its Apple filling over a shortcrust pastry and topped with Cinnamon Crumble.
3007	563	cn	Kambing menyatnyat	Stewed Lamb Balinese Style
3072	559	  		
3073	462	  		
3074	463	  		
3075	471	  		
3076	453	  		
3077	475	  		
3078	472	  		
3079	522	  		
3080	523	  		
3081	525	  		
3082	526	  		
3083	528	  		
3084	452	  		
3085	473	  		
3133	531	  		
3134	471	  		
3135	453	  		
3086	570	  		
3096	574	id	Bienenstich	
3097	574	cn	Bienenstich	
3021	566	kr	Pisang rai	
3108	577	id	Matcha Mille Cake	
3112	578	id	PanCo Cake	
3010	564	id	Kuah iga celeng	Stewed Pork Spare Ribs
3114	578	en	PanCo Cake	
3113	578	cn	PanCo Cake	
3011	564	cn	Kuah iga celeng	Stewed Pork Spare Ribs
3115	578	kr	PanCo Cake	
3116	579	id	Panna Cotta	Is Italian desserts of sweetened cream thickened with gelatin, topping with marinated strawberry.
3018	566	id	Pisang rai	
3023	567	cn	Puding Sereh Bakar	
3022	567	id	Puding Sereh Bakar	
3107	576	kr	Lemon Tart	Its a lemon pudding over a shortcrust pastry and last minute caramelized on topped.
3109	577	cn	Matcha Mille Cake	
3024	567	en	Puding Sereh Bakar	
3136	543	  		
3137	475	  		
3110	577	en	Matcha Mille Cake	
3030	569	id	Sate lilit ikan	Traditional Balinese White Fish Satay with Condiment
3019	566	cn	Pisang rai	
3138	573	  		
3020	566	en	Pisang rai	
3111	577	kr	Matcha Mille Cake	
3025	567	kr	Puding Sereh Bakar	
3122	580	en	Raspberry Eclair	Is an Oblong pastry made with choux dough filled with Raspberry Cream
3139	574	  		
3028	568	en	Sate campur	Beef, Chicken, Fish and Minced Pork Satay
3029	568	kr	Sate campur	Beef, Chicken, Fish and Minced Pork Satay
2894	544	id	Nyepi Promo Beef Burger & Soft drink	
3140	579	  		
3141	576	  		
3142	581	  		
3143	580	  		
3144	575	  		
3145	582	  		
3146	573	  		
3147	579	  		
3148	576	  		
3149	581	  		
3150	580	  		
3151	575	  		
3152	582	  		
3153	466	  		
3154	559	  		
3155	457	  		
3156	539	  		
3157	460	  		
3158	537	  		
3159	473	  		
3160	549	  		
3161	565	  		
3162	548	  		
3163	551	  		
3164	552	  		
3178	586	cn	cape code	Vodka, Cranberry Juice
3179	586	en	cape code	Vodka, Cranberry Juice
3191	589	en	fish and chip	
3180	586	kr	cape code	Vodka, Cranberry Juice
3186	588	cn	Club Sandwich	
2058	466	id	Lumpia Sayur Semarang	Fried Vegetable Spring Roll a la Semarang
2023	457	cn	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drum Stick
2963	552	cn	Ayam pelalah	Shredded Chicken with Lemongrass Relish Balinese Style
3094	573	en	Apple Crumble	Its Apple filling over a shortcrust pastry and topped with Cinnamon Crumble.
3177	586	id	cape code	Vodka, Cranberry Juice
3118	579	en	Panna Cotta	Is Italian desserts of sweetened cream thickened with gelatin, topping with marinated strawberry.
3119	579	kr	Panna Cotta	Is Italian desserts of sweetened cream thickened with gelatin, topping with marinated strawberry.
3120	580	id	Raspberry Eclair	Is an Oblong pastry made with choux dough filled with Raspberry Cream
3121	580	cn	Raspberry Eclair	Is an Oblong pastry made with choux dough filled with Raspberry Cream
3123	580	kr	Raspberry Eclair	Is an Oblong pastry made with choux dough filled with Raspberry Cream
2089	473	kr	Sop Buntut	Traditional Oxtail Soup or Fried with Vegetable and Potato served with Steamed Rice
2086	473	id	Sop Buntut	Traditional Oxtail Soup or Fried with Vegetable and Potato served with Steamed Rice
3124	581	id	Tiramisu	Is popular Coffee Flavored Italian desserts made of Laddy Fingers dipped in Coffee, layered with Mascarpone Cheese mixture.
3128	582	id	Vanilla Creme Brule	Its French desserts consisting of a rich egg custard base, topped with a constrating layer of hard caramel
3125	581	cn	Tiramisu	Is popular Coffee Flavored Italian desserts made of Laddy Fingers dipped in Coffee, layered with Mascarpone Cheese mixture.
2950	549	id	Aneka be pasih panggang	Grilled Mixed Seafood; Prawn, Fish Fillet, and Squid
3131	582	kr	Vanilla Creme Brule	Its French desserts consisting of a rich egg custard base, topped with a constrating layer of hard caramel
3129	582	cn	Vanilla Creme Brule	Its French desserts consisting of a rich egg custard base, topped with a constrating layer of hard caramel
3176	585	kr	blue lagoon	Vodka, Lemon Juice, Monin Blue Curacao, Sprite
3165	583	id	30 Mile	Sauvignon Blanc,  South Australia - Australia |  Available by Glass IDR 135.000
2962	552	id	Ayam pelalah	Shredded Chicken with Lemongrass Relish Balinese Style
2774	539	id	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drum Stick
2948	548	en	Aneka Be Pasih Megoreng	Fried Seafood Platter
2776	539	en	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drum Stick
3189	589	id	fish and chip	
2960	551	en	Ayam panggang kalas	Roasted Chicken in Spices Coconut Milk
3103	575	kr	Chocolate Summer Cake	Its a layer of Chocolate Cake, with berries jelly, cover with pistachio-chocolate glazed
3117	579	cn	Panna Cotta	Is Italian desserts of sweetened cream thickened with gelatin, topping with marinated strawberry.
3190	589	cn	fish and chip	
3169	584	id	beringer classic	Pinot Grigio, California - USA |  Available by Glass IDR 135.000
3181	587	id	Chateau Subercaseaux	Cabernet Sauvignon, Central Valley - Chile  Available by Glass IDR 135.000
3172	584	kr	beringer classic	Pinot Grigio,  California - USA |  Available by Glass IDR 135.000
2766	537	id	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, Shredded fired Chicken, Vegetable and Creakers
3175	585	en	blue lagoon	Vodka, Lemon Juice, Monin Blue Curacao, Sprite
3193	590	id	Gin Fizz	Gin, Lemon Juice, Sugar Syrup, Egg White, Soda Water
3192	589	kr	fish and chip	
3185	588	id	Club Sandwich	
3168	583	kr	30 Mile	Sauvignon Blanc,  South Australia - Australia |  Available by Glass IDR 135.000
2946	548	id	Aneka Be Pasih Megoreng	Fried Seafood Platter
2769	537	kr	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, Shredded fired Chicken, Vegetable and Creakers
2087	473	cn	Sop Buntut	Traditional Oxtail Soup or Fried with Vegetable and Potato served with Steamed Rice
3106	576	en	Lemon Tart	Its a lemon pudding over a shortcrust pastry and last minute caramelized on topped.
2036	460	en	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, Shredded fired Chicken, Vegetable and Creakers
2037	460	kr	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, Shredded fired Chicken, Vegetable and Creakers
2022	457	id	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drum Stick
3092	573	id	Apple Crumble	Its Apple filling over a shortcrust pastry and topped with Cinnamon Crumble.
2025	457	kr	Nasi Goreng Kampoeng	Traditional Fried Rice with Chicken, Chicken Satay, Fried Egg, Beef Empal and Chicken Drum Stick
3188	588	kr	Club Sandwich	
3187	588	en	Club Sandwich	
3260	587	  		
2993	559	kr	Cramcam ayam	Chicken Soup with Shallot Balinese Style
3218	596	cn	Talamonte	Trebbiano, Sicilia - Italy |  Available by Glass IDR 135.000
3215	595	en	Sex On The Beach	Vodka, Bols Peach, Cranberry Juice, Orange Juice
3219	596	en	Talamonte	Trebbiano, Sicilia - Italy |  Available by Glass IDR 135.000
3261	593	  		
3224	597	kr	Tequila Sunrise	Tequila, Orange Juice, Monin Grenadine
3232	599	kr	Yellow Tail	Pinot Noir, South East Australia - Australia | Available by Glass IDR 135.000
3220	596	kr	Talamonte	Trebbiano, Sicilia - Italy |  Available by Glass IDR 135.000
3221	597	id	Tequila Sunrise	Tequila, Orange Juice, Monin Grenadine
3233	583	  		
3234	584	  		
3235	585	  		
3236	587	  		
3237	585	  		
3273	553	  		
3238	592	  		
3274	554	  		
3275	555	  		
3239	593	  		
3276	559	  		
3262	594	  		
2767	537	cn	Mie Goreng Jawa	Traditional Fried Noodles served with Fried Egg, Shredded fired Chicken, Vegetable and Creakers
3214	595	cn	Sex On The Beach	Vodka, Bols Peach, Cranberry Juice, Orange Juice
3211	594	en	Sababay White Velvet	Dry Muscat, Singaraja -Bali | Available by Glass IDR 99.000
3225	598	id	Two Island	Shiraz, Singaraja, Bali - Indonesia  |  Available by Glass IDR 99.000
3263	592	  		
3227	598	en	Two Island	Shiraz, Singaraja, Bali - Indonesia  |  Available by Glass IDR 99.000
3230	599	cn	Yellow Tail	Pinot Noir, South East Australia - Australia | Available by Glass IDR 135.000
2982	557	id	Bebek Garang Asem	Stewed Duck Balinese Style
3206	593	cn	Sababay Pink Blossom	Alphonse-Levalee, Singaraja - Bali | Available by Glass IDR 99.000
3264	596	  		
3171	584	en	beringer classic	Pinot Grigio, California - USA |  Available by Glass IDR 135.000
3013	564	kr	Kuah iga celeng	Stewed Pork Spare Ribs
2975	555	cn	Be siap sambal matah	Roasted Chicken with Sambal Matah
3197	591	id	Mosco Mule	Vodka, Sweet Sour, Ginger Beer
3212	594	kr	Sababay White Velvet	Dry Muscat, Singaraja -Bali | Available by Glass IDR 99.000
3222	597	cn	Tequila Sunrise	Tequila, Orange Juice, Monin Grenadine
3208	593	kr	Sababay Pink Blossom	Alphonse-Levalee, Singaraja - Bali | Available by Glass IDR 99.000
3265	598	  		
3229	599	id	Yellow Tail	Pinot Noir, South East Australia - Australia | Available by Glass IDR 135.000
2981	556	kr	Bebek Betutu	Roasted Duck in Balinese Spices
2970	554	id	Be celeng menyatnyat	Stewed Pork in Turmeric Sauce and Balinese Tradisional Sausage
2966	553	id	Babi kecap	Stewed Pork with Sweet Soy Sauce
3266	599	  		
3267	450	  		
3268	534	  		
3269	556	  		
3270	557	  		
3271	529	  		
3272	556	  		
2695	533	cn	Ikan Bakar Jimbaran	Grilled Fish with Condiment Jimbaran Style
3277	462	  		
3278	533	  		
3279	563	  		
3280	564	  		
3240	594	  		
3281	583	  		
3170	584	cn	beringer classic	Pinot Grigio,  California - USA |  Available by Glass IDR 135.000
3241	596	  		
3282	584	  		
3216	595	kr	Sex On The Beach	Vodka, Bols Peach, Cranberry Juice, Orange Juice
3283	593	  		
3284	594	  		
3242	598	  		
3104	576	id	Lemon Tart	Its a lemon pudding over a shortcrust pastry and last minute caramelized on topped.
2991	559	cn	Cramcam ayam	Chicken Soup with Shallot Balinese Style
3468	619	en	Carbonara	
3210	594	cn	Sababay White Velvet	Dry Muscat, Singaraja -Bali | Available by Glass IDR 99.000
3243	599	  		
3209	594	id	Sababay White Velvet	Dry Muscat, Singaraja -Bali | Available by Glass IDR 99.000
3244	586	  		
3245	590	  		
3201	592	id	Plaga Rose - Bottle	Shiraz Rose, Bali - Indonesia | Available by Glass IDR 79.000
3469	619	kr	Carbonara	
3470	620	id	Cereal	
3102	575	en	Chocolate Summer Cake	Its a layer of Chocolate Cake, with berries jelly, cover with pistachio-chocolate glazed
3246	591	  		
3199	591	en	Mosco Mule	Vodka, Sweet Sour, Ginger Beer
2045	462	kr	Gado-Gado	Mix Vegetables Salad with Peanut Sauce
3202	592	cn	Plaga Rose - Bottle	Shiraz Rose, Bali - Indonesia | Available by Glass IDR 79.000
3247	595	  		
3203	592	en	Plaga Rose - Bottle	Shiraz Rose, Bali - Indonesia | Available by Glass IDR 79.000
3205	593	id	Sababay Pink Blossom	Alphonse-Levalee, Singaraja - Bali | Available by Glass IDR 99.000
3207	593	en	Sababay Pink Blossom	Alphonse-Levalee, Singaraja - Bali | Available by Glass IDR 99.000
3248	597	  		
3471	620	cn	Cereal	
2971	554	cn	Be celeng menyatnyat	Stewed Pork in Turmeric Sauce and Balinese Tradisional Sausage
3249	594	  		
2694	533	id	Ikan Bakar Jimbaran	Grilled Fish with Condiment Jimbaran Style
3250	588	  		
3251	474	  		
3252	589	  		
3253	522	  		
3254	523	  		
3255	525	  		
3256	526	  		
3257	528	  		
3258	583	  		
3259	584	  		
3285	596	  		
3286	587	  		
3287	583	  		
3288	584	  		
3289	599	  		
3290	565	  		
3291	456	  		
3292	568	  		
3293	571	  		
3294	572	  		
3295	569	  		
3296	550	  		
3297	420	  		
3298	561	  		
3299	452	  		
3043	572	cn	Udang bakar bumbu merah	Grilled River Prawn in Sweet &amp; Hot Sauce with Condiment
3198	591	cn	Mosco Mule	Vodka, Sweet Sour, Ginger Beer
3342	604	id	Sababay Pink Blossom - Glass	
3300	565	  		
3301	598	  		
3302	586	  		
3303	592	  		
3304	595	  		
3305	585	  		
3306	590	  		
3307	597	  		
3308	591	  		
3309	588	  		
3310	516	  		
3321	471	  		
3322	532	  		
3311	516	  		
3314	516	  		
3315	497	  		
3312	516	  		
3323	532	  		
3324	475	  		
3313	516	  		
3325	469	  		
1998	452	kr	Beef Burger With Cheese	Beef Burger, Cheese served with Vegetable and Fried Potato
3316	516	  		
3204	592	kr	Plaga Rose - Bottle	Shiraz Rose, Bali - Indonesia | Available by Glass IDR 79.000
3032	569	en	Sate lilit ikan	Traditional Balinese White Fish Satay with Condiment
3317	516	  		
3318	583	  		
3319	559	  		
3320	473	  		
3196	590	kr	Gin Fizz	Gin, Lemon Juice, Sugar Syrup, Egg White, Soda Water
3326	600	id	Beringer Classic - Glass	
3167	583	en	30 Mile	Sauvignon Blanc,  South Australia - Australia |  Available by Glass IDR 135.000
3327	600	cn	Beringer Classic - Glass	
2410	516	en	Green Garden	Kiwi, Honey Dew Melon, Pineapple Juice, Lychee, Passion
3016	565	en	Megibung tenganan	Sate Ikan, Sate Sapi, Sate Ayam | Komoh Ikan | Ayam Panggang Kalas, Ikan Bakar, Udang Bakar, Gorengan, Rambak, Lawar Campur, Sambel Bongkot, Sambel Mbe, Nasi Putih, Nasi Merah | Dessert Plater
3017	565	kr	Megibung tenganan	Sate Ikan, Sate Sapi, Sate Ayam | Komoh Ikan | Ayam Panggang Kalas, Ikan Bakar, Udang Bakar, Gorengan, Rambak, Lawar Campur, Sambel Bongkot, Sambel Mbe, Nasi Putih, Nasi Merah | Dessert Plater
3200	591	kr	Mosco Mule	Vodka, Sweet Sour, Ginger Beer
3343	604	cn	Sababay Pink Blossom - Glass	
3027	568	cn	Sate campur	Beef, Chicken, Fish and Minced Pork Satay
2018	456	id	Nasi Campur Bali ( Signature Dish)	Balinese Rice with Satay, Boiled Egg, Prawn, &quot;Ayam Betutu'' &amp; ''Lawar''
2019	456	cn	Nasi Campur Bali ( Signature Dish)	Balinese Rice with Satay, Boiled Egg, Prawn, &quot;Ayam Betutu'' &amp; ''Lawar''
3033	569	kr	Sate lilit ikan	Traditional Balinese White Fish Satay with Condiment
3213	595	id	Sex On The Beach	Vodka, Bols Peach, Cranberry Juice, Orange Juice
3217	596	id	Talamonte	Trebbiano, Sicilia - Italy |  Available by Glass IDR 135.000
3223	597	en	Tequila Sunrise	Tequila, Orange Juice, Monin Grenadine
3038	571	id	Tuna sambal matah	Pan Seared Tuna with Lemongrass and Shallot Sambal
3039	571	cn	Tuna sambal matah	Pan Seared Tuna with Lemongrass and Shallot Sambal
3226	598	cn	Two Island	Shiraz, Singaraja, Bali - Indonesia  |  Available by Glass IDR 99.000
3228	598	kr	Two Island	Shiraz, Singaraja, Bali - Indonesia  |  Available by Glass IDR 99.000
3042	572	id	Udang bakar bumbu merah	Grilled River Prawn in Sweet &amp; Hot Sauce with Condiment
3340	603	en	Asian Sahur Menu	Tom Ka Ghai, Wok Fried Chicken Kung Pao, Capsicum and Chasew Nut, served with Jasmine Rice
3231	599	en	Yellow Tail	Pinot Noir, South East Australia - Australia | Available by Glass IDR 135.000
3173	585	id	blue lagoon	Vodka, Lemon Juice, Monin Blue Curacao, Sprite
3166	583	cn	30 Mile	Sauvignon Blanc, South Australia - Australia |  Available by Glass IDR 135.000
3183	587	en	Chateau Subercaseaux	Cabernet Sauvignon, Central Valley - Chile  Available by Glass IDR 135.000
2999	561	cn	Gedang mekuah	Green Papaya Soup
3338	603	id	Asian Sahur Menu	Tom Ka Ghai, Wok Fried Chicken Kung Pao, Capsicum and Chasew Nut, served with Jasmine Rice
3329	600	kr	Beringer Classic - Glass	
2954	550	id	Ares bebek	Balinese Duck Soup with Banana Trunk
1996	452	cn	Beef Burger With Cheese	Beef Burger, Cheese served with Vegetable and Fried Potato
3336	602	en	Cold Mezze	
3334	602	id	Cold Mezze	
3337	602	kr	Cold Mezze	
3328	600	en	Beringer Classic - Glass	
3331	601	cn	Chicken Kung Pao	
3332	601	en	Chicken Kung Pao	
3330	601	id	Chicken Kung Pao	
3333	601	kr	Chicken Kung Pao	
3335	602	cn	Cold Mezze	
3174	585	cn	blue lagoon	Vodka, Lemon Juice, Monin Blue Curacao, Sprite
3339	603	cn	Asian Sahur Menu	Tom Ka Ghai, Wok Fried Chicken Kung Pao, Capsicum and Chasew Nut, served with Jasmine Rice
3341	603	kr	Asian Sahur Menu	Tom Ka Ghai, Wok Fried Chicken Kung Pao, Capsicum and Chasew Nut, served with Jasmine Rice
3182	587	cn	Chateau Subercaseaux	Cabernet Sauvignon, Central Valley - Chile  Available by Glass IDR 135.000
3195	590	en	Gin Fizz	Gin, Lemon Juice, Sugar Syrup, Egg White, Soda Water
2408	516	id	Green Garden	Kiwi, Honey Dew Melon, Pineapple Juice, Lychee, Passion
3350	606	id	Salmon Tarator	
3351	606	cn	Salmon Tarator	
3352	606	en	Salmon Tarator	
3353	606	kr	Salmon Tarator	
3389	583	  		
3347	605	cn	Sababay White Velvet - Glass	
3430	473	  		
3370	607	  		
3348	605	en	Sababay White Velvet - Glass	
3371	602	  		
3367	610	cn	Tom Ka Ghai	
3368	610	en	Tom Ka Ghai	
3366	610	id	Tom Ka Ghai	
3372	610	  		
3369	610	kr	Tom Ka Ghai	
3373	601	  		
3390	608	  		
3431	471	  		
3391	603	  		
3374	608	  		
3349	605	kr	Sababay White Velvet - Glass	
3375	602	  		
3026	568	id	Sate campur	Beef, Chicken, Fish and Minced Pork Satay
3447	614	cn	Beef Burger	
3392	607	  		
3362	609	id	Talamonte - Glass	
3393	585	  		
3394	549	  		
3395	559	  		
3396	478	  		
3397	479	  		
3398	480	  		
3399	513	  		
3400	513	  		
3401	515	  		
3402	477	  		
3403	476	  		
3404	519	  		
3405	519	  		
3406	518	  		
3407	468	  		
3408	505	  		
3409	454	  		
3410	455	  		
3411	496	  		
3412	524	  		
3449	614	kr	Beef Burger	
3413	509	  		
3414	510	  		
3415	585	  		
3416	586	  		
3432	475	  		
3433	473	  		
3376	603	  		
3436	611	en	Aglio e Olio	
3365	609	kr	Talamonte - Glass	
3377	607	  		
3434	611	id	Aglio e Olio	
3450	615	id	Bicher Muesli	
3442	613	id	Bakeries	
3458	617	id	Bubur Ayam	
3378	608	  		
3423	474	  		
3379	452	  		
3380	588	  		
3381	471	  		
3382	469	  		
3383	470	  		
3384	453	  		
3385	474	  		
3386	475	  		
3387	474	  		
3388	521	  		
3417	591	  		
3418	590	  		
3419	591	  		
3420	595	  		
3421	595	  		
3422	597	  		
3358	608	id	Middle East Sahur Menu	Cold Mezze,  Salmon Tarator typical Middle East Salmon with Walnut, Parsley, Sumac, and Hummus served with Arabic rice
3359	608	cn	Middle East Sahur Menu	Cold Mezze,  Salmon Tarator typical Middle East Salmon with Walnut, Parsley, Sumac, and Hummus served with Arabic rice
3360	608	en	Middle East Sahur Menu	Cold Mezze,  Salmon Tarator typical Middle East Salmon with Walnut, Parsley, Sumac, and Hummus served with Arabic rice
3361	608	kr	Middle East Sahur Menu	Cold Mezze,  Salmon Tarator typical Middle East Salmon with Walnut, Parsley, Sumac, and Hummus served with Arabic rice
3344	604	en	Sababay Pink Blossom - Glass	
3345	604	kr	Sababay Pink Blossom - Glass	
3346	605	id	Sababay White Velvet - Glass	
3437	611	kr	Aglio e Olio	
3424	452	  		
3425	469	  		
3426	470	  		
3427	588	  		
3428	589	  		
3429	559	  		
3440	612	en	American Breakfast	
3438	612	id	American Breakfast	
3444	613	en	Bakeries	
3443	613	cn	Bakeries	
3441	612	kr	American Breakfast	
3446	614	id	Beef Burger	
3435	611	cn	Aglio e Olio	
2088	473	en	Sop Buntut	Traditional Oxtail Soup or Fried with Vegetable and Potato served with Steamed Rice
3445	613	kr	Bakeries	
3454	616	id	Bolognaise	
3452	615	en	Bicher Muesli	
3363	609	cn	Talamonte - Glass	
3448	614	en	Beef Burger	
3439	612	cn	American Breakfast	
3456	616	en	Bolognaise	
3455	616	cn	Bolognaise	
3453	615	kr	Bicher Muesli	
3462	618	id	Caesar Salad	
3460	617	en	Bubur Ayam	
3459	617	cn	Bubur Ayam	
3457	616	kr	Bolognaise	
3466	619	id	Carbonara	
3464	618	en	Caesar Salad	
3463	618	cn	Caesar Salad	
3461	617	kr	Bubur Ayam	
3451	615	cn	Bicher Muesli	
3355	607	cn	Indonesian Sahur Menu	Soup Kimlo, Nasi Goreng Istimewa/The Anvaya Special Fried Rice
3467	619	cn	Carbonara	
3465	618	kr	Caesar Salad	
3357	607	kr	Indonesian Sahur Menu	Soup Kimlo, Nasi Goreng Istimewa/The Anvaya Special Fried Rice
3364	609	en	Talamonte - Glass	
3356	607	en	Indonesian Sahur Menu	Soup Kimlo, Nasi Goreng Istimewa/The Anvaya Special Fried Rice
3015	565	cn	Megibung tenganan	Sate Ikan, Sate Sapi, Sate Ayam | Komoh Ikan | Ayam Panggang Kalas, Ikan Bakar, Udang Bakar, Gorengan, Rambak, Lawar Campur, Sambel Bongkot, Sambel Mbe, Nasi Putih, Nasi Merah | Dessert Plater
3549	639	kr	Pisang Goreng	
3485	623	kr	French Fries	
3551	640	cn	Potato Wedges	
3574	639	  		
3556	641	en	Seasonal Fruit slice	
3579	620	  		
3478	622	id	Egg cook any style	
3476	621	en	Continental Breakfast	
3480	622	en	Egg cook any style	
3479	622	cn	Egg cook any style	
3477	621	kr	Continental Breakfast	
3487	624	cn	Fresh Fruit	
3486	624	id	Fresh Fruit	
3553	640	kr	Potato Wedges	
3481	622	kr	Egg cook any style	
3490	625	id	Gado-Gado	
3488	624	en	Fresh Fruit	
3489	624	kr	Fresh Fruit	
3491	625	cn	Gado-Gado	
3194	590	cn	Gin Fizz	Gin, Lemon Juice, Sugar Syrup, Egg White, Soda Water
3492	625	en	Gado-Gado	
3493	625	kr	Gado-Gado	
3494	626	id	Indonesian Breakfast	
3354	607	id	Indonesian Sahur Menu	Soup Kimlo, Nasi Goreng Istimewa/The Anvaya Special Fried Rice
3495	626	cn	Indonesian Breakfast	
3496	626	en	Indonesian Breakfast	
3497	626	kr	Indonesian Breakfast	
3507	629	cn	Mi Goreng	
3498	627	id	Lumpia Sayur	
3499	627	cn	Lumpia Sayur	
3500	627	en	Lumpia Sayur	
3501	627	kr	Lumpia Sayur	
3511	630	cn	Mixed sate	
3014	565	id	Megibung tenganan	Sate Ikan, Sate Sapi, Sate Ayam | Komoh Ikan | Ayam Panggang Kalas, Ikan Bakar, Udang Bakar, Gorengan, Rambak, Lawar Campur, Sambel Bongkot, Sambel Mbe, Nasi Putih, Nasi Merah | Dessert Plater
3502	628	id	Mi Goreng	
3503	628	cn	Mi Goreng	
3550	640	id	Potato Wedges	
3504	628	en	Mi Goreng	
3505	628	kr	Mi Goreng	
3474	621	id	Continental Breakfast	
3506	629	id	Mi Goreng	
3508	629	en	Mi Goreng	
3514	631	id	Mushroom Soup	
3509	629	kr	Mi Goreng	
3510	630	id	Mixed sate	
3512	630	en	Mixed sate	
3526	634	id	Nasi Goreng Kampung	
3516	631	en	Mushroom Soup	
3515	631	cn	Mushroom Soup	
3513	630	kr	Mixed sate	
3519	632	cn	Napolitana	
3517	631	kr	Mushroom Soup	
3518	632	id	Napolitana	
3520	632	en	Napolitana	
3522	633	id	Nasi Goreng	
3524	633	en	Nasi Goreng	
3523	633	cn	Nasi Goreng	
3521	632	kr	Napolitana	
3530	635	id	Pan Seared Beef Medallion	
3528	634	en	Nasi Goreng Kampung	
3527	634	cn	Nasi Goreng Kampung	
3525	633	kr	Nasi Goreng	
3546	639	id	Pisang Goreng	
3532	635	en	Pan Seared Beef Medallion	
3531	635	cn	Pan Seared Beef Medallion	
3529	634	kr	Nasi Goreng Kampung	
3534	636	id	Pan Seared Norwegian Salmon	
3536	636	en	Pan Seared Norwegian Salmon	
3535	636	cn	Pan Seared Norwegian Salmon	
3533	635	kr	Pan Seared Beef Medallion	
3541	637	kr	Panacotta	
3538	637	id	Panacotta	
3540	637	en	Panacotta	
3537	636	kr	Pan Seared Norwegian Salmon	
3542	638	id	Pancake	
3544	638	en	Pancake	
3543	638	cn	Pancake	
3568	644	en	Tiramisu Cake	
3552	640	en	Potato Wedges	
3548	639	en	Pisang Goreng	
3547	639	cn	Pisang Goreng	
3545	638	kr	Pancake	
3539	637	cn	Panacotta	
3555	641	cn	Seasonal Fruit slice	
3484	623	en	French Fries	
3554	641	id	Seasonal Fruit slice	
3558	642	id	Soup Buntut	
3560	642	en	Soup Buntut	
3559	642	cn	Soup Buntut	
3557	641	kr	Seasonal Fruit slice	
3483	623	cn	French Fries	
3473	620	kr	Cereal	
3565	643	kr	Steak Sandwich	
3561	642	kr	Soup Buntut	
3566	644	id	Tiramisu Cake	
3569	644	kr	Tiramisu Cake	
3567	644	cn	Tiramisu Cake	
3127	581	kr	Tiramisu	Is popular Coffee Flavored Italian desserts made of Laddy Fingers dipped in Coffee, layered with Mascarpone Cheese mixture.
3570	645	id	Yogurt	
3564	643	en	Steak Sandwich	
3571	645	cn	Yogurt	
3126	581	en	Tiramisu	Is popular Coffee Flavored Italian desserts made of Laddy Fingers dipped in Coffee, layered with Mascarpone Cheese mixture.
3572	645	en	Yogurt	
3562	643	id	Steak Sandwich	
3472	620	en	Cereal	
3573	645	kr	Yogurt	
3184	587	kr	Chateau Subercaseaux	Cabernet Sauvignon, Central Valley - Chile  Available by Glass IDR 135.000
3575	612	  		
3576	613	  		
3577	615	  		
3578	617	  		
3475	621	cn	Continental Breakfast	
3563	643	cn	Steak Sandwich	
3580	621	  		
3581	622	  		
3582	624	  		
3583	626	  		
3482	623	id	French Fries	
3584	629	  		
3585	633	  		
3586	638	  		
3587	645	  		
3588	627	  		
3589	614	  		
3590	627	  		
3591	627	  		
3592	639	  		
3593	611	  		
3594	611	  		
3595	616	  		
3596	618	  		
3597	619	  		
3598	623	  		
3599	625	  		
3600	628	  		
3601	630	  		
3602	631	  		
3603	632	  		
3604	634	  		
3605	635	  		
3606	636	  		
3607	637	  		
3608	640	  		
3609	641	  		
3610	642	  		
3611	643	  		
3612	644	  		
3613	631	  		
3614	475	  		
3615	457	  		
3616	559	  		
3617	473	  		
3618	585	  		
3619	629	  		
3620	628	  		
3621	469	  		
3622	452	  		
3623	588	  		
3624	470	  		
3625	474	  		
3626	453	  		
3627	471	  		
3628	457	  		
3629	620	  		
3630	588	  		
3631	588	  		
3632	588	  		
3633	460	  		
3634	614	  		
3635	643	  		
3636	473	  		
3637	559	  		
3638	585	  		
3639	537	  		
3640	614	  		
3641	623	  		
3642	640	  		
3643	643	  		
3644	557	  		
2973	554	kr	Be celeng menyatnyat	Stewed Pork in Turmeric Sauce and Balinese Tradisional Sausage
3645	614	  		
3646	643	  		
3647	623	  		
3648	415	  		
3649	421	  		
3650	585	  		
3651	585	  		
3652	614	  		
3653	643	  		
3654	623	  		
3655	643	  		
3656	541	  		
3657	537	  		
3658	643	  		
3659	559	  		
3660	614	  		
3661	614	  		
3662	643	  		
3663	541	  		
3664	473	  		
3665	637	  		
3666	644	  		
3667	644	  		
3668	643	  		
3669	581	  		
3670	614	  		
3674	646	  		
3679	647	  		
3676	647	cn	Club Sandwich	
3677	647	en	Club Sandwich	
3678	647	id	Club Sandwich	
3681	647	  		
3680	647	kr	Club Sandwich	
3671	646	cn	Beef Burger	
3672	646	en	Beef Burger	
3673	646	id	Beef Burger	
3682	646	  		
3675	646	kr	Beef Burger	
3683	469	  		
3684	643	  		
3685	470	  		
3686	470	  		
3687	470	  		
3688	643	  		
3689	462	  		
3690	541	  		
\.


--
-- Name: service_translations_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('service_translations_seq', 3690, true);


--
-- Data for Name: services; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY services (service_id, service_price, service_thumbnail, service_enabled, service_allow_ads, service_order, service_group_id, service_code, service_updated, service_currency) FROM stdin;
532	55000	Beer-Heineken	1	0	0	14	IND0000264	1	IDR
506	35000	Machiato	1	0	0	19	IND0000084	1	IDR
485	35000		0	0	0	2	IND0000062	1	IDR
517	35000	Honeymelon	1	0	0	2	IND0000057	1	IDR
518	35000		0	0	0	2	IND0000059	1	IDR
647	105000	clubsandwich	1	0	1	42	IND0000386	1	IDR
466	55000	lumpia	1	0	0	4	IND0000010	1	IDR
467	69000	Napolitana	1	0	0	6	IND0000021	1	IDR
538	69000	Napolitana	1	0	0	22	IND0000299	1	IDR
500	35000	IcedChocolate	1	0	0	13	IND0000091	1	IDR
460	115000	MieGoreng	1	0	0	4	IND0000002	1	IDR
590	85000	ginfizz	0	0	0	28	IND0000388	1	IDR
630	115000	SateLilit	0	0	0	38	IND1000034	1	IDR
480	49000	BintangRedler	1	0	0	14	IND0000262	1	IDR
514	45000	BlueFairy	1	0	0	25	IND0000047	1	IDR
493	35000		0	0	0	19	IND0000083	1	IDR
565	355000	TengananPackage	1	0	0	4	IND0000348	1	IDR
501	30000		0	0	0	13	IND0000087	1	IDR
502	35000	icelate	1	0	0	13	IND0000089	1	IDR
503	30000		0	0	0	13	IND0000085	1	IDR
465	95000	IkanKakapBakarSambalMatah	0	0	0	4	IND0000266	1	IDR
577	55000		0	0	0	3	IND0000378	1	IDR
646	125000	BeefBurger	1	0	0	42	IND1000029	1	IDR
544	150000	BeefBurgerwithCheese	0	0	0	22	IND0000367	1	IDR
628	90000	MieGoreng	0	0	0	38	IND1000036	1	IDR
540	95000	mierebus	1	0	2	5	IND0000305	1	IDR
522	35000	FreshMint	1	0	0	21	IND0000276	1	IDR
487	35000	Cappucino	1	0	0	19	IND0000082	1	IDR
451	85000	bebeklengkuas	0	0	0	4	IND0000005	1	IDR
516	45000	green garden	0	0	1	25	IND0000050	1	IDR
576	39000	LemonTart	1	0	0	3	IND0000374	1	IDR
536	85000	Carbonara	1	0	0	22	IND0000300	1	IDR
515	35000	Carrot	1	0	0	2	IND0000056	1	IDR
580	39000	RaspberryEclair	0	0	0	3	IND0000376	1	IDR
462	75000	gadogado	1	0	0	24	IND0000009	1	IDR
415	55000	Soupbuntut	0	0	1	5	IND0000011	1	IDR
635	139000	PanSearedBeefMedallionwithCreamyMushroom	1	0	0	38	IND1000037	1	IDR
636	145000	PanSearedNorwegianSalmon	0	0	0	38	IND1000038	1	IDR
526	35000	Peach	1	0	0	21	IND0000272	1	IDR
541	125000	SotoAyamLamongan	1	0	1	39	IND0000303	1	IDR
611	69000	SpagettiAioli	1	0	0	38	IND1000039	1	IDR
616	85000	SpaghettiBolognese	1	0	0	38	IND1000040	1	IDR
619	85000	Carbonara	1	0	0	38	IND1000041	1	IDR
596	650000	talamonte	1	0	0	27	IND0000393	1	IDR
609	135000		0	0	0	27	IND0000401	1	IDR
463	169000	IgaGerangAsem	0	0	0	4	IND0000267	1	IDR
499	30000	TEA	1	0	0	19	IND0000077	1	IDR
551	129000	8AyamPanggangKalas	0	0	0	4	IND0000322	1	IDR
562	45000	JukutUrab	1	0	0	24	IND0000307	1	IDR
627	55000	lumpia	0	0	0	40	IND1000027	1	IDR
511	45000	strawberry	1	0	0	20	IND0000053	1	IDR
512	45000	vanilla	1	0	0	20	IND0000051	1	IDR
610	0		0	0	0	29	IND0000423	1	IDR
472	55000	Slicefruit	1	0	0	3	IND0000022	1	IDR
509	25000	SodaWater	1	0	0	18	IND0000075	1	IDR
641	55000	Slicefruit	1	0	0	36	IND1000043	1	IDR
554	135000	5BeCelengMenyatNyatdanUrutan	1	0	0	4	IND0000317	1	IDR
530	149000	BintangBeer1	1	0	0	14	IND0000295	1	IDR
642	175000	Soupbuntut	1	0	0	39	IND1000033	1	IDR
542	95000	PrawnLaksa	1	0	3	5	IND0000304	1	IDR
598	445000	twoisland	1	0	0	27	IND0000395	1	IDR
626	160000	IndonesianBreakfast	1	0	0	35	IND1000014	1	IDR
589	100000	fishandchip	1	0	0	11	IND0000387	1	IDR
533	225000	guramibakar	1	0	0	4	IND0000296	1	IDR
569	95000	SateLilit	0	0	0	4	IND0000313	1	IDR
572	215000	UdangBakar	1	0	0	4	IND0000314	1	IDR
476	35000	WatermelonJc	1	0	0	2	IND0000054	1	IDR
599	699000	yellowtail	0	0	0	27	IND0000396	1	IDR
478	49000	BaliHaiBeer	1	0	0	14	IND0000260	1	IDR
479	49000	BintangBeer	1	0	0	14	IND0000261	1	IDR
593	450000	sababaypinkblossom	1	0	0	27	IND0000391	1	IDR
474	149000	SteakSandwiches	1	0	0	1	IND0000014	1	IDR
520	35000	Strawberry	1	0	0	2	IND0000060	1	IDR
557	159000	BebekGarangAsem	1	0	0	23	IND0000293	1	IDR
529	159000	bebeklengkuas	1	0	0	23	IND0000291	1	IDR
585	85000	bluelagoon	1	0	0	28	IND0000382	1	IDR
597	85000	tequilasunrise	1	0	0	28	IND0000394	1	IDR
475	85000	Tiramisucake	1	0	0	1	IND0000024	1	IDR
459	85000	SpaghettiBolognese	1	0	0	6	IND0000019	1	IDR
535	85000	SpaghettiBolognese	1	0	0	22	IND0000301	1	IDR
486	35000	CafeLatte	1	0	0	19	IND0000081	1	IDR
484	39000	AquaSparkling	1	0	0	17	IND0000065	1	IDR
545	149000	BintangBeer1	0	0	0	22	IND0000365	1	IDR
574	65000	Bienenstich	0	0	0	3	IND0000372	1	IDR
546	60000	Pisang_Goreng	0	0	0	22	IND0000366	1	IDR
615	35000	Muesli	1	0	0	35	IND1000020	1	IDR
504	45000	KutaSunset	1	0	0	25	IND0000048	1	IDR
524	25000	Kratingdaeng	1	0	0	18	IND0000076	1	IDR
586	85000	capecode	1	0	0	28	IND0000383	1	IDR
461	85000	Carbonara	1	0	0	6	IND0000020	1	IDR
632	69000	Napolitana	1	0	0	38	IND1000042	1	IDR
603	0	asian	1	0	0	1	IND0000419	1	IDR
454	25000	smallcola	1	0	0	18	IND0000071	1	IDR
558	55000	CoconutPudding	0	0	0	3	IND0000326	1	IDR
564	125000	7KuahIgaCeleng	0	0	0	4	IND0000318	1	IDR
481	89000	CoronaBeer	1	0	0	14	IND0000265	1	IDR
608	0	middle_east	1	0	0	1	IND0000418	1	IDR
505	45000	LemonMintLemonade	1	0	0	25	IND0000044	1	IDR
491	45000	EquilSparkling	1	0	0	17	IND0000067	1	IDR
492	30000	Espresso	1	0	0	19	IND0000079	1	IDR
563	145000	2KambingMenyatNyat	1	0	0	4	IND0000320	1	IDR
525	35000	LycheeIceTea	1	0	0	21	IND0000273	1	IDR
452	125000	BeefBurger	1	0	0	1	IND0000015	1	IDR
629	90000	MieGoreng	1	0	0	35	IND1000016	1	IDR
638	35000	Pancake	1	0	0	35	IND1000019	1	IDR
507	45000	PassionCooler	1	0	0	25	IND0000049	1	IDR
591	85000	moscomule	0	0	0	28	IND0000389	1	IDR
578	49000		0	0	0	3	IND0000371	1	IDR
579	65000	PannaCotta	0	0	0	3	IND0000373	1	IDR
477	35000	smallpineapplejuice	1	0	0	2	IND0000055	1	IDR
639	55000	pisanggoreng	1	0	0	36	IND1000046	1	IDR
592	359000	plagarose	1	0	0	27	IND0000390	1	IDR
584	650000	beringerclassic	1	0	0	27	IND0000381	1	IDR
470	145000	PanSearedNorwegianSalmon	0	0	0	42	IND0000017	1	IDR
450	69000	SpagettiAioli	1	0	0	6	IND0000018	1	IDR
534	69000	SpagettiAioli	1	0	0	22	IND0000302	1	IDR
612	200000	AmericanBreakfast	1	0	0	35	IND1000012	1	IDR
482	30000	Coffee	1	0	0	19	IND0000078	1	IDR
573	55000	AppleCrumble	1	0	0	3	IND0000370	1	IDR
552	59000	AyamPelalah	1	0	0	4	IND0000308	1	IDR
539	115000	NasiGoreng	1	0	0	22	IND0000297	1	IDR
617	50000	BuburAyam	1	0	0	35	IND1000018	1	IDR
559	55000	Cramcamayam	1	0	0	5	IND0000351	1	IDR
456	125000	nasicampurbali	1	0	0	4	IND0000007	1	IDR
631	39000	CreamyMushroomSoup	0	0	0	39	IND1000032	1	IDR
469	139000	PanSearedBeefMedallionwithCreamyMushroom	1	0	0	42	IND0000016	1	IDR
614	125000	BeefBurger	1	0	0	37	IND1000029	1	IDR
618	0		0	0	0	40	IND1000026	1	IDR
537	115000	MieGoreng	1	0	0	38	IND0000298	1	IDR
513	35000	Apple	1	0	0	2	IND0000061	1	IDR
555	129000	4AyamPanggangSambalMatah	1	0	0	4	IND0000319	1	IDR
606	0		0	0	0	1	IND0000422	1	IDR
583	650000	30mile	0	0	0	27	IND0000380	1	IDR
531	35000	FrenchFries	1	0	0	11	IND0000294	1	IDR
523	35000	GreenApple	1	0	0	21	IND0000275	1	IDR
625	75000	gadogado	1	0	0	40	IND1000025	1	IDR
495	45000	FrozenOrangeMintGinger	1	0	0	25	IND0000045	1	IDR
624	50000	Slicefruit	1	0	0	35	IND1000024	1	IDR
561	45000	GedangMekuah	1	0	0	5	IND0000310	1	IDR
464	169000	IgaBakarBumbuKetumbar	0	0	0	4	IND0000006	1	IDR
496	25000	GingerAle	1	0	0	18	IND0000074	1	IDR
458	25000		0	0	0	4	IND0000008	1	IDR
497	55000	GreenMachine	1	0	2	15	IND0000043	1	IDR
498	55000	HealthyLife	1	0	4	15	IND0000041	1	IDR
550	69000	AresBebek	1	0	0	5	IND0000311	1	IDR
588	105000	clubsandwich	1	0	0	1	IND0000386	1	IDR
547	90000	Gado_Gado	0	0	0	22	IND0000364	1	IDR
468	35000	smallorangejuice	1	0	0	2	IND0000063	1	IDR
643	149000	SteakSandwiches	1	0	0	42	IND1000028	1	IDR
519	35000	Papaya	1	0	0	2	IND0000058	1	IDR
510	25000	Sprite	1	0	0	18	IND0000073	1	IDR
566	55000	PisangRaiJajeInjin	1	0	0	3	IND0000324	1	IDR
528	35000	StrawberryIceTea	1	0	0	21	IND0000274	1	IDR
471	69000	panacotta	1	0	0	1	IND0000023	1	IDR
508	55000	PurpleBooster	1	0	3	15	IND0000042	1	IDR
613	50000	BakeryBasket	1	0	0	35	IND1000023	1	IDR
556	159000	BebekBetutu	1	0	0	23	IND0000292	1	IDR
527	79000	SPellegrino	1	0	0	17	IND0000070	1	IDR
568	115000	6SateCampur	0	0	0	4	IND0000321	1	IDR
595	85000	sexonthebeach	1	0	0	28	IND0000392	1	IDR
581	125000	Tiramisu	0	0	0	3	IND0000375	1	IDR
570	55000	TipatCantok	1	0	0	24	IND0000306	1	IDR
587	699000	chateausubercaseaux	1	0	0	27	IND0000384	1	IDR
601	0		0	0	0	29	IND0000424	1	IDR
604	85000		0	0	0	27	IND0000399	1	IDR
594	450000	sababaywhitevelvet	1	0	0	27	IND0000397	1	IDR
602	0		0	0	0	29	IND0000421	1	IDR
605	85000		0	0	0	27	IND0000400	1	IDR
421	85000	MieGoreng	0	0	3	5	IND0000013	1	IDR
571	65000	TunaSambalMatah	0	0	0	4	IND0000350	1	IDR
644	85000	Tiramisu_Cake	0	0	0	3	IND1000045	1	IDR
455	25000	smalldietcoke	1	0	0	18	IND0000072	1	IDR
623	35000	FrenchFries	1	0	0	37	IND1000031	1	IDR
560	55000	EsPodeng	1	0	0	3	IND0000327	1	IDR
645	25000	FlavourYogurt	1	0	0	35	IND1000022	1	IDR
633	90000	NasiGoreng	1	0	0	35	IND1000017	1	IDR
634	115000	NasiGoreng	1	0	0	38	IND1000035	1	IDR
622	80000		0	0	0	35	IND1000015	1	IDR
582	49000	VanillaCremeBrule	0	0	0	3	IND0000379	1	IDR
494	35000	FreshMint	1	0	0	13	IND0000086	1	IDR
483	35000	Aqua	1	0	0	17	IND0000064	1	IDR
553	135000	9BabiKecap	0	0	0	4	IND0000323	1	IDR
640	35000	PotatoWedges	1	0	0	37	IND1000030	1	IDR
543	35000	PotatoWedges	1	0	0	11	IND0000363	1	IDR
488	45000	chocolate	1	0	0	20	IND0000052	1	IDR
473	175000	Soupbuntut	1	0	0	5	IND0000003	1	IDR
420	59000	CreamyMushroomSoup	0	0	2	5	IND0000012	1	IDR
620	35000	ChocoFlakes	1	0	0	35	IND1000021	1	IDR
621	150000	ContinentalBreakfast	1	0	0	35	IND1000013	1	IDR
575	65000	ChocolateBerriesCake	0	0	0	3	IND0000377	1	IDR
637	65000	panacotta	1	0	0	3	IND1000044	1	IDR
521	675000		0	0	0	27	IND0000122	1	IDR
548	235000	AnekaBePasihMegoreng	1	0	0	4	IND0000368	1	IDR
600	135000		0	0	0	27	IND0000398	1	IDR
549	235000	AnekaBePasihMepanggang	1	0	0	4	IND0000315	1	IDR
457	115000	NasiGoreng	1	0	0	4	IND0000001	1	IDR
489	35000	Espresso	1	0	0	19	IND0000080	1	IDR
490	39000	EquilNatural	1	0	0	17	IND0000066	1	IDR
567	55000	PudingSerehBakar	0	0	0	3	IND0000369	1	IDR
607	0	indonesian	1	0	0	1	IND0000420	1	IDR
453	55000	pisanggoreng	1	0	0	1	IND0000025	1	IDR
\.


--
-- Name: services_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('services_seq', 647, true);


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY sessions (id, session_id, session_user_id, session_start, session_time, session_ip, session_browser, session_username, session_mac, session_module, session_node_id) FROM stdin;
20	98f13708210194c475687be6106a3b84	\N	1429058293	1429058293	172.16.2.158	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	stb-Outdoor6	00:00:a1:00:06:d6		150
39	d67d8ab4f4c10bf22aa353e27879133c	\N	1430812710	1430812710	192.168.0.251	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	stb-C347	00:00:a1:00:02:29		92
42	a1d0c6e83f027327d8461063f4ac58a6	\N	1434094413	1434094413	192.168.0.14	Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0	Laptop Agnes	a4:17:31:5f:fa:0d		153
58	66f041e16a60928b05a7e228a89c3799	\N	1434094461	1434094461	192.168.0.187	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	Testing	00:00:00:00:00:00	Dashboard	154
152	37a749d808e46495a8da1e5352d03cae	\N	1443496380	1443496380	192.168.0.162	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	710	00:00:A1:00:07:CE		9
324	f2fc990265c712c49d51a18a32b39f0c	\N	1443152444	1443152444	192.168.0.233	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1009	00:00:A1:00:03:2B		68
135	7f1de29e6da19d22b51c68001e7e0e54	\N	1443497075	1443497075	192.168.0.172	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	722	00:00:A1:00:02:25		19
173	f7e6c85504ce6e82442c770f7c8606f0	\N	1443500067	1443500067	192.168.0.189	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	817	00:0A:BC:00:0C:45		34
158	06409663226af2f3114485aa4e0a23b4	\N	1443285672	1443285672	192.168.0.212	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	915	00:00:A2:00:02:98		52
145	2b24d495052a8ce66358eb576b8912c8	\N	1443491482	1443491482	192.168.0.168	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	718	00:00:A2:00:04:55		15
168	006f52e9102a8d3be2fe5614f42ba989	\N	1443356927	1443356927	192.168.0.178	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	803	00:00:A1:00:04:4B		23
174	bf8229696f7a3bb4700cfddef19fa23f	\N	1442273861	1442273861	192.168.0.190	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	818	00:0A:BC:00:08:CA		35
161	bd4c9ab730f5513206b999ec0d90d1fb	\N	1443498884	1443498884	192.168.0.210	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	911	00:00:A1:00:06:F2		50
177	96da2f590cd7246bbde0051047b0d6f7	\N	1443494934	1443494934	192.168.0.194	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	822	00:00:A1:00:01:60		39
143	903ce9225fca3e988c2af215d4e544d3	\N	1443496170	1443496170	192.168.0.207	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	908	00:00:A1:00:05:64		47
151	a8f15eda80c50adb0e71943adc8015cf	\N	1443483652	1443483652	192.168.0.163	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	711	00:00:A1:00:06:36		10
169	3636638817772e42b59d74cff571fbb3	\N	1443498162	1443498162	192.168.0.179	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	805	00:00:A1:00:04:A7		24
139	e00da03b685a0dd18fb6a08af0923de0	\N	1440556268	1440556268	192.168.0.188	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	816	00:0A:BC:00:0B:FA	Dashboard	33
133	9fc3d7152ba9336a670e36d0ed79bc43	\N	1443490875	1443490875	192.168.0.187	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	815	00:0A:BC:00:0B:E9		32
63	03afdbd66e7929b125f8597834fa83a4	\N	1443486508	1443486508	192.168.0.191	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	819	00:00:a2:00:02:eb		36
156	1c9ac0159c94d8d0cbedc973445af2da	\N	1443500016	1443500016	192.168.0.219	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	922	00:00:A2:00:03:37		59
142	a8baa56554f96369ab93e4f3bb068c22	\N	1443497000	1443497000	192.168.0.170	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	720	00:00:A2:00:01:07		17
134	02522a2b2726fb0a03bb19f2d8d9524d	\N	1443464296	1443464296	192.168.0.184	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	810	00:0A:BC:00:0C:01		29
155	2a79ea27c279e471f4d180b08d62b00a	\N	1443429846	1443429846	192.168.0.176	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	709	00:00:A2:00:05:42		8
162	82aa4b0af34c2313a562076992e50aa3	\N	1469708298	1469708298	172.10.4.81	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	2108	00:00:00:00:00:00		7
1	6b4576b5a48de60823b75f09756fedc1	\N	1443361971	1443361971	192.168.0.154	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	701	00:00:00:00:00:00		1
150	7ef605fc8dba5425d6965fbd4c8fbe1f	\N	1443413573	1443413573	192.168.0.215	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	918	00:0A:BC:00:0D:6B		55
179	8f53295a73878494e9bc8dd6c3c7104f	\N	1443500062	1443500062	192.168.0.167	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	717	00:00:A2:00:01:08		14
160	b73ce398c39f506af761d2277d853a92	\N	1443500030	1443500030	192.168.0.211	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	912	00:00:A2:00:05:68		51
268	8f121ce07d74717e0b1f21d122e04521	\N	1443450112	1443450112	192.168.0.241	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1019	00:0A:BC:00:0D:C7	Dashboard	76
191	0aa1883c6411f7873cb83dacb17b0afc	\N	1438253095	1438253095	192.168.0.249	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	Laptop Agnes	00:00:00:00:00		85
144	0a09c8844ba8f0936c20bd791130d6b6	\N	1442850327	1442850327	192.168.1.87	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	716	00:00:00:00:00:00		13
231	9b04d152845ec0a378394003c96da594	\N	1443493900	1443493900	192.168.0.243	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1021	00:0A:BC:00:0F:F8	Dashboard	78
171	a4a042cf4fd6bfb47701cbc8a1653ada	\N	1443500062	1443500062	192.168.0.181	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	807	00:00:A1:00:06:AC		26
228	74db120f0a8e5646ef5a30154e9f6deb	\N	1443500066	1443500066	192.168.0.226	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1001	00:00:A2:00:00:B8		61
129	d1f491a404d6854880943e5c3cd9ca25	\N	1443339731	1443339731	192.168.0.169	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	719	00:00:A1:00:02:68		16
224	13fe9d84310e77f13a6d184dbf1232f3	\N	1443262942	1443262942	192.168.0.236	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1012	00:0A:BC:00:0C:6C		71
176	38af86134b65d0f10fe33d30dd76442e	\N	1443492900	1443492900	192.168.0.193	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	821	00:0A:BC:00:08:0A		38
226	9cfdf10e8fc047a44b08ed031e1f0ed1	\N	1443310023	1443310023	192.168.0.242	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1020	00:0A:BC:00:0A:81		77
8	c9f0f895fb98ab9159f51fd0297e236d	\N	1443500043	1443500043	192.168.0.159	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	707	00:00:A1:00:06:D3		6
236	01161aaa0b6d1345dd8fe4e481144d84	\N	1443479105	1443479105	192.168.0.201	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	901	00:00:A2:00:A4:1A		41
223	115f89503138416a242f40fb7d7f338e	\N	1443486553	1443486553	192.168.0.239	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1017	00:0A:BC:00:0C:2D		74
94	f4b9ec30ad9f68f89b29639786cb62ef	\N	1443500057	1443500057	192.168.0.174	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	723	00:00:a1:00:02:0a		20
153	b3e3e393c77e35a4a3f3cbd1e429b5dc	\N	1443427104	1443427104	192.168.0.204	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	905	00:00:A2:00:01:12		44
244	9188905e74c28e489b44e954ec0b9bca	\N	1443424773	1443424773	192.168.0.231	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1007	00:00:A2:00:05:3C	Dashboard	66
159	140f6969d5213fd0ece03148e62e461e	\N	1443499244	1443499244	192.168.0.225	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	923	00:0A:BC:000B:74		60
132	65ded5353c5ee48d0b7d48c591b8f430	\N	1443487274	1443487274	192.168.0.182	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	808	00:00:A1:00:05:E8		27
157	6c4b761a28b734fe93831e3fb400ce87	\N	1443489941	1443489941	192.168.0.206	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	919	00:00:A1:00:05:C5		56
137	3988c7f88ebcb58c6ce932b957b6f332	\N	1443494819	1443494819	192.168.0.221	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	902	00:00:A2:0A:04:45		42
148	47d1e990583c9c67424d369f3414728e	\N	1443499020	1443499020	192.168.0.164	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	712	00:00:A2:00:03:6C		11
688	f79921bbae40a577928b76d2fc3edc2a	10	1473245316	1473245316	172.10.4.19	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0	signage, signage	00:00:00:00:00:00	Signages	\N
1105	af21d0c97db2e27e13572cbf59eb343d	7	1477187986	1477187986	10.201.59.1	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0	Engineering, engineering		TV Channels	\N
149	f2217062e9a397a1dca429e7d70bc6ca	\N	1443287061	1443287061	192.168.0.214	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	917	00:00:A1:00:06:8A		54
220	ec8ce6abb3e952a85b8551ba726a1227	\N	1443453496	1443453496	192.168.0.244	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	1022	00:00:A1:00:01:03		79
221	060ad92489947d410d897474079c1477	\N	1443424902	1443424902	192.168.0.229	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1005	00:00:A2:00:04:61	Dashboard	64
246	38db3aed920cf82ab059bfccbd02be6a	\N	1443423989	1443423989	192.168.0.238	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	1016	00:0A:BC:00:0C:7A		73
130	9b8619251a19057cff70779273e95aa6	\N	1443498369	1443498369	192.168.0.186	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	812	00:0A:BC:00:06:AF		31
136	42a0e188f5033bc65bf8d78622277c4e	\N	1443486445	1443486445	192.168.0.183	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	809	00:0A:BC:00:0B:17		28
222	bcbe3365e6ac95ea2c0343a2395834dd	\N	1443430615	1443430615	192.168.0.232	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	1008	00:00:A1:00:03:00		67
247	3cec07e9ba5f5bb252d13f5f431e4bbb	\N	1442880576	1442880576	192.168.0.240	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1018	00:0A:BC:00:1C:D0		75
170	149e9677a5989fd342ae44213df68868	\N	1443500024	1443500024	192.168.0.180	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	806	00:00:A1:00:07:EA		25
147	8d5e957f297893487bd98fa830fa6413	\N	1443490783	1443490783	192.168.0.218	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	921	00:00:02:00:01:60		58
146	a5e00132373a7031000fd987a3c9f87b	\N	1443490443	1443490443	192.168.0.216	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	907	00:00:A2:00:03:32	Dashboard	46
225	d1c38a09acc34845c6be3a127a5aacaf	\N	1443435252	1443435252	192.168.0.235	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	1011	00:00:A2:00:05:53	Dashboard	70
167	5878a7ab84fb43402106c575658472fa	\N	1443434099	1443434099	192.168.0.176	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	801	00:0A:BC:00:0F:96		21
163	0777d5c17d4066b82ab86dff8a46af6f	\N	1443489840	1443489840	192.168.0.203	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	903	00:00:A1:00:03:08		43
175	82161242827b703e6acf9c726942a1e4	\N	1443013480	1443013480	192.168.0.192	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	820	00:0A:BC:00:0B:99		37
240	335f5352088d7d9bf74191e006d8e24c	\N	1443499612	1443499612	192.168.0.228	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	1003	00:00:A1:00:07:DB		63
227	705f2172834666788607efbfca35afb3	\N	1443500013	1443500013	192.168.0.245	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1023	00:0A:BC:00:01:8E		80
141	0f28b5d49b3020afeecd95b4009adf4c	\N	1443500043	1443500043	192.168.0.208	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	909	00:00:A2:00:004:53		48
245	0266e33d3f546cb5436a10798e657d97	\N	1443435278	1443435278	192.168.0.237	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1015	00:0A:BC:00:69:11	Dashboard	72
65	fc490ca45c00b1249bbe3554a4fdf6fb	\N	1443497569	1443497569	192.168.0.209	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	910	00:00:02:00:02:2A		49
251	19f3cd308f1455b3fa09a282e0d496f4	\N	1443268920	1443268920	192.168.0.234	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	1010	00:00:A2:00:01:9D		69
138	013d407166ec4fa56eb1e1f8cbe183b9	\N	1443283530	1443283530	192.168.0.213	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	916	00:00:A2:01:05:41		53
140	1385974ed5904a438616ff7bdb3f7439	\N	1443500065	1443500065	192.168.0.177	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	802	00:0A:BC:00:0C:23		22
165	9766527f2b5d3e95d4a733fcfb77bd7e	\N	1443499709	1443499709	192.168.0.156	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	703	00:00:A1:00:04:4F		3
178	8f85517967795eeef66c225f7883bdcb	\N	1443488867	1443488867	192.168.0.217	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	920	00:00:A1:00:03:21		57
243	cb70ab375662576bd1ac5aaf16b3fca4	\N	1443491663	1443491663	192.168.0.230	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	1006	00:00:A1:00:04:EE		65
166	7e7757b1e12abcb736ab9a754ffb617a	\N	1443496158	1443496158	192.168.0.158	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	706	00:0A:BC:00:0E:24		5
96	26657d5ff9020d2abefe558796b99584	\N	1443495163	1443495163	192.168.0.171	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	721	00:00:A1:00:05:89		18
79	d1fe173d08e959397adf34b1d77e88d7	\N	1443464996	1443464996	192.168.0.205	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	906	00:00:A2:00:02:2A		45
59	093f65e080a295f8076b1c5722a46aa2	\N	1443498659	1443498659	192.168.0.165	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	715	00:00:A1:00:06:87		12
485	218a0aefd1d1a4be65601cc6ddc1520e	\N	1443760442	1443760442	192.168.0.16	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0	stb-Dev	00:00:00:00:00		305
1515	bc7316929fe1545bf0b98d114ee3ecb8	\N	1505138207	1505138207	172.10.5.144	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6303	00:00:00:00:00:00		428
9	45c48cce2e2d7fbdea1afc51c7c6ad26	\N	1469429841	1469429841	172.10.4.21	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	2102	00:00:00:00:00:00		2
2483	2c6ae45a3e88aee548c0714fad7f8269	\N	1504842697	1504842697	172.10.4.59	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.95.60 ;0x00000001)	6308	00:00:00:00:00:00		432
2725	4bbdcc0e821637155ac4217bdab70d2e	8	1506329441	1506329441	10.201.59.64	Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36	Roomservice, roomservice	00:00:00:00:00:00	Room Service Buffer	\N
576	a7aeed74714116f3b292a982238f83d2	\N	1475994726	1475994726	172.10.6.65	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	193 A	00:00:00:00:00:00		554
131	1afa34a7f984eeabdbb0a7d494132ee5	\N	1469428811	1469428811	172.10.4.21	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	823	00:00:00:00:00:00		40
1483	bffc98347ee35b3ead06728d6f073c68	\N	1490855870	1490855870	172.10.6.54	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	5210	00:00:00:00:00:00		415
2047	a501bebf79d570651ff601788ea9d16d	\N	1498388029	1498388029	172.10.4.49	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6318	00:00:00:00:00:00		440
164	fa7cdfad1a5aaf8370ebeda47a1ff1c3	\N	1469501036	1469501036	172.10.4.49	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	2105	00:00:00:00:00:00		4
172	1ff8a7b5dc7a7d1f0ed65aaa29c04b1e	\N	1469606487	1469606487	172.10.4.49	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	2133	00:00:00:00:00:00		30
590	08b255a5d42b89b0585260b6f2360bdd	\N	1470732142	1470732142	172.10.4.158	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	spa-tes2	00:00:00:00:00:00		613
2191	71560ce98c8250ce57a6a970c9991a5f	\N	1504156589	1504156589	10.201.59.2	Mozilla/5.0 (iPhone; CPU iPhone OS 10_0 like Mac OS X) AppleWebKit/602.1.38 (KHTML, like Gecko) Version/10.0 Mobile/14A300 Safari/602.1	pc ird		Dashboard	634
1063	6c340f25839e6acdc73414517203f5f0	\N	1495705860	1495705860	10.201.59.65	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0	6315	00:00:00:00:00:00		437
1783	b865367fc4c0845c0682bd466e6ebf4c	\N	1492859646	1492859646	172.10.6.35	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6312	00:00:00:00:00:00		436
613	f29c21d4897f78948b91f03172341b7b	\N	1493981110	1493981110	172.10.6.35	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	3212	00:00:00:00:00:00		144
1482	ab541d874c7bc19ab77642849e02b89f	\N	1490855870	1490855870	172.10.6.54	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	5210	00:00:00:00:00:00		415
597	08c5433a60135c32e34f46a71175850c	\N	1471150714	1471150714	172.10.5.5	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	Spare 50	00:00:00:00:00:00	Dashboard	599
2411	ddeebdeefdb7e7e7a697e1c3e3d8ef54	\N	1498819026	1498819026	172.10.4.140	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;32LX761H-GA ;03.50.10 ;0x00000001)	1510B	00:00:00:00:00:00		610
1431	e11943a6031a0e6114ae69c257617980	\N	1503741004	1503741004	172.10.4.57	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.95.60 ;0x00000001)	5211	00:00:00:00:00:00		416
2119	1b5230e3ea6d7123847ad55a1e06fffd	\N	1490710943	1490710943	172.10.6.33	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	2122	00:00:00:00:00:00		600
2668	5ac8bb8a7d745102a978c5f8ccdb61b8	\N	1504599153	1504599153	172.10.6.47	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	Bagus	00:00:00:00:00:00		627
947	c4b31ce7d95c75ca70d50c19aef08bf1	\N	1475719333	1475719333	10.201.59.1	Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36	PCEDP		Dashboard	618
1422	0ed9422357395a0d4879191c66f4faa2	\N	1480417887	1480417887	172.10.6.35	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	5209	00:00:00:00:00:00		414
2633	fc03d48253286a798f5116ec00e99b2b	\N	1503740910	1503740910	172.10.4.67	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	5218	00:00:00:00:00:00		421
2010	d7a84628c025d30f7b2c52c958767e76	\N	1495023775	1495023775	172.10.5.162	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	laptopIT	00:00:00:00:00:00		629
2484	b4baaff0e2f11b5356193849021d641f	\N	1499870193	1499870193	172.10.4.70	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	1509A	00:00:00:00:00:00		619
789	68053af2923e00204c3ca7c6a3150cf7	11	1473843481	1473843481	172.10.4.16	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0	Roomservice 2, roomservice2	00:00:00:00:00:00	Room Service Buffer	\N
1852	eb1e78328c46506b46a4ac4a1e378b91	\N	1500295552	1500295552	172.10.5.103	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6311	00:00:00:00:00:00		435
2726	b1c00bcd4b5183705c134b3365f8c45e	6	1506322598	1506322598	10.201.59.65	Mozilla/5.0 (Windows NT 6.1; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0	Admin, admin	00:00:00:00:00:00	Running Text	\N
1842	57c0531e13f40b91b3b0f1a30b529a1d	\N	1501494138	1501494138	172.10.5.153	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.95.60 ;0x00000001)	PCITTENGAH	00:00:00:00:00:00		624
2647	0b7e926154c1274e8b602ff0d7c133d7	\N	1504189252	1504189252	172.10.4.34	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.11.41 ;0x00000001)	IRD	00:00:00:00:00:00		636
1891	13168e6a2e6c84b4b7de9390c0ef5ec5	\N	1504447640	1504447640	172.10.5.175	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	5301	00:00:00:00:00:00		447
1340	4f87658ef0de194413056248a00ce009	\N	1500729340	1500729340	172.10.4.129	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.95.60 ;0x00000001)	6305	00:00:00:00:00:00		429
1516	490640b43519c77281cb2f8471e61a71	\N	1505138207	1505138207	172.10.5.144	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6303	00:00:00:00:00:00		428
1520	db1915052d15f7815c8b88e879465a1e	\N	1505138207	1505138207	172.10.5.144	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6303	00:00:00:00:00:00		428
2664	daaaf13651380465fc284db6940d8478	\N	1504448141	1504448141	172.10.6.47	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6316	00:00:00:00:00:00		438
1517	81c8727c62e800be708dbf37c4695dff	\N	1505138207	1505138207	172.10.5.144	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6303	00:00:00:00:00:00		428
930	1cc3633c579a90cfdd895e64021e2163	\N	1497259613	1497259613	172.10.5.206	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6319	00:00:00:00:00:00		441
1444	afe434653a898da20044041262b3ac74	\N	1504870626	1504870626	172.10.4.50	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	6307	00:00:00:00:00:00		431
1617	297fa7777981f402dbba17e9f29e292d	\N	1505493923	1505493923	172.10.5.51	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	6317	00:00:00:00:00:00		439
1439	540ae6b0f6ac6e155062f3dd4f0b2b01	\N	1499576746	1499576746	172.10.5.152	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	5212	00:00:00:00:00:00		417
1865	69d1fc78dbda242c43ad6590368912d4	\N	1506329442	1506329442	172.10.6.101	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6302	00:00:00:00:00:00		427
2118	92bbd31f8e0e43a7da8a6295b251725f	\N	1490710943	1490710943	172.10.6.33	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	2122	00:00:00:00:00:00		600
1332	28e209b61a52482a0ae1cb9f5959c792	\N	1498277239	1498277239	10.201.59.30	Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36	6309	00:00:00:00:00:00		433
1394	f016e59c7ad8b1d72903bb1aa5720d53	\N	1501315264	1501315264	172.10.5.29	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	6321	00:00:00:00:00:00		443
912	2a9d121cd9c3a1832bb6d2cc6bd7a8a7	\N	1475562335	1475562335	172.10.6.67	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	194 A	00:00:00:00:00:00		556
1644	89f03f7d02720160f1b04cf5b27f5ccb	\N	1493119285	1493119285	172.10.5.45	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	5216	00:00:00:00:00:00		419
1518	42d6c7d61481d1c21bd1635f59edae05	\N	1505138207	1505138207	172.10.5.144	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6303	00:00:00:00:00:00		428
1844	06a15eb1c3836723b53e4abca8d9b879	\N	1490068561	1490068561	172.10.5.191	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	5222	00:00:00:00:00:00		425
1892	ca460332316d6da84b08b9bcf39b687b	\N	1493740498	1493740498	172.10.5.195	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	6306	00:00:00:00:00:00		430
1839	728f206c2a01bf572b5940d7d9a8fa4c	\N	1504841352	1504841352	172.10.6.33	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	5217	00:00:00:00:00:00		420
1640	84f0f20482cde7e5eacaf7364a643d33	\N	1498280145	1498280145	172.10.6.2	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.95.60 ;0x00000001)	6320	00:00:00:00:00:00		442
1385	86e8f7ab32cfd12577bc2619bc635690	\N	1503382977	1503382977	172.10.4.55	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	5220	00:00:00:00:00:00		423
233	e165421110ba03099a1c0393373c5b43	\N	1502877852	1502877852	172.10.5.250	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	3123	00:00:00:00:00:00		62
1383	cd0dce8fca267bf1fb86cf43e18d5598	\N	1499225416	1499225416	172.10.4.208	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	5208	00:00:00:00:00:00		413
2665	e727fa59ddefcefb5d39501167623132	\N	1504448141	1504448141	172.10.6.47	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6316	00:00:00:00:00:00		438
783	6e0721b2c6977135b916ef286bcb49ec	9	1473836008	1473836008	172.10.4.16	Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0	Supervisor, spv	00:00:00:00:00:00	Room Service Buffer	\N
1445	b265ce60fe4c5384e622b09eb829b8df	\N	1505136458	1505136458	172.10.5.25	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	6322	00:00:00:00:00:00		444
2666	1102a326d5f7c9e04fc3c89d0ede88c9	\N	1504448141	1504448141	172.10.6.47	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6316	00:00:00:00:00:00		438
2728	5e751896e527c862bf67251a474b3819	5	1506326050	1506326050	172.10.4.19	Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36	Roberto Tonjaw, tonjaw	00:00:00:00:00:00	Guest	\N
660	68264bdb65b97eeae6788aa3348e553c	\N	1506254464	1506254464	172.10.6.48	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	IT	00:00:00:00:00:00		615
1519	5607fe8879e4fd269e88387e8cb30b7e	\N	1505138207	1505138207	172.10.5.144	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6303	00:00:00:00:00:00		428
1962	95f6870ff3dcd442254e334a9033d349	\N	1498902102	1498902102	172.10.5.228	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.95.60 ;0x00000001)	5320	14:C9:13:01:A1:2B		628
2331	273448411df1962cba1db6c05b3213c9	\N	1505356243	1505356243	172.10.6.35	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	vpnq	00:00:00:00:00:00		633
987	df6d2338b2b8fce1ec2f6dda0a630eb0	\N	1502383901	1502383901	172.10.5.25	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	5221	00:00:00:00:00:00		424
1479	dc09c97fd73d7a324bdbfe7c79525f64	\N	1492353470	1492353470	172.10.6.46	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6301	00:00:00:00:00:00		426
2667	7edccc661418aeb5761dbcdc06ad490c	\N	1504448141	1504448141	172.10.6.47	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6316	00:00:00:00:00:00		438
1840	201d7288b4c18a679e48b31c72c30ded	\N	1504841352	1504841352	172.10.6.33	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	5217	00:00:00:00:00:00		420
577	fde9264cf376fffe2ee4ddf4a988880d	\N	1501958878	1501958878	172.10.6.53	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	3320	00:00:00:00:00:00		243
1859	537de305e941fccdbba5627e3eefbb24	\N	1504340671	1504340671	172.10.6.46	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6324	00:00:00:00:00:00		446
1384	5ca3e9b122f61f8f06494c97b1afccf3	\N	1499225416	1499225416	172.10.4.208	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	5208	00:00:00:00:00:00		413
1420	90db9da4fc5414ab55a9fe495d555c06	\N	1502683985	1502683985	172.10.6.41	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	5219	00:00:00:00:00:00		422
1838	d7657583058394c828ee150fada65345	\N	1504841352	1504841352	172.10.6.33	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	5217	00:00:00:00:00:00		420
1782	4a2ddf148c5a9c42151a529e8cbdcc06	\N	1492859646	1492859646	172.10.6.35	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	6312	00:00:00:00:00:00		436
1693	b59a51a3c0bf9c5228fde841714f523a	\N	1502276651	1502276651	172.10.6.33	Mozilla/5.0 (; U; Linux SH4; en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0 (;NavicomIndonesia;ModelN	3328	00:00:00:00:00:00		251
2009	f1981e4bd8a0d6d8462016d2fc6276b3	\N	1504409166	1504409166	172.10.5.251	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	5302	00:00:00:00:00:00		448
2284	80537a945c7aaa788ccfcdf1b99b5d8f	\N	1502687991	1502687991	172.10.5.51	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	3225	00:00:00:00:00:00		155
1065	a2137a2ae8e39b5002a3f8909ecb88fe	\N	1500558390	1500558390	172.10.5.88	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.30 ;0x00000001)	6323	00:00:00:00:00:00		445
2696	dc2b690516158a874dd8aabe1365c6a0	\N	1506248825	1506248825	172.10.4.214	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	5215	00:00:00:00:00:00		418
1658	c0560792e4a3c79e62f76cbf9fb277dd	\N	1504835428	1504835428	172.10.5.199	Mozilla/5.0 (Unknown; Linux armv7l) AppleWebKit/537.1+ PBRM/1.0 ( ;LGE ;43LX761H-GA ;03.50.10 ;0x00000001)	6310	00:00:00:00:00:00		434
\.


--
-- Name: sessions_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('sessions_seq', 2728, true);


--
-- Data for Name: shop_group_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY shop_group_translations (translation_id, shop_group_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	de	Souvernir	
4	1	fr	Souvernir	
6	1	  		
7	1	  		
8	1	ru	Souvernir	
9	1	  		
10	1	  		
11	1	  		
13	1	  		
14	1	  		
15	1	  		
16	1	  		
3	1	en	Souvernir	
17	1	  		
5	1	id	Souvernir	
12	1	jp	お土産	
18	1	  		
19	1	  		
20	2	  		
21	2	  		
22	2	en	test	
23	2	  		
24	2	id	test	
25	2	jp	test	
26	2	  		
27	2	  		
\.


--
-- Name: shop_group_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('shop_group_translations_translation_id_seq', 27, true);


--
-- Data for Name: shop_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY shop_groups (shop_group_id, shop_group_thumbnail, shop_group_order, shop_group_allow_ads, shop_group_enabled, shop_group_clip) FROM stdin;
1	souvernir	1	0	1	\N
2	souvernir	2	0	1	\N
\.


--
-- Name: shop_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('shop_groups_seq', 2, true);


--
-- Data for Name: shop_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY shop_translations (translation_id, shop_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
6	1	  		
7	1	  		
9	1	  		
2	1	de	Barong White T-Shirt	
4	1	fr	Barong White T-Shirt	
10	1	  		
11	1	  		
8	1	ru	Barong White T-Shirt	
12	2	  		
13	2	de	Glass	
15	2	fr	Glass	
17	2	  		
18	2	  		
19	2	ru	Glass	
20	1	  		
21	1	  		
22	1	  		
24	1	  		
25	1	  		
26	2	  		
27	2	  		
14	2	en	Glass	
28	2	  		
16	2	id	Glass	
29	2	jp	Glass	
30	2	  		
31	2	  		
32	1	  		
33	1	  		
34	1	  		
35	1	  		
36	1	  		
37	1	  		
38	1	  		
39	1	  		
40	1	  		
41	1	  		
42	1	  		
43	1	  		
3	1	en	Barong White T-Shirt	
44	1	  		
5	1	id	Barong White T-Shirt	
23	1	jp	バロンホワイトTシャツ	
45	1	  		
46	1	  		
\.


--
-- Name: shop_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('shop_translations_translation_id_seq', 46, true);


--
-- Data for Name: shops; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY shops (shop_id, shop_price, shop_thumbnail, shop_enabled, shop_allow_ads, shop_code, shop_order, shop_group_id, shop_updated, shop_currency) FROM stdin;
2	60000	glass	1	0	G20002	2	1	1	\N
1	124000	barong-white	1	0	B001	0	1	1	IDR
\.


--
-- Name: shops_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('shops_seq', 2, true);


--
-- Data for Name: signage_ads; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_ads (signage_ads_id, signage_ads_name, signage_ads_address, signage_ads_cp, signage_ads_phone, signage_ads_email, signage_ads_enabled) FROM stdin;
1	Hotel Hilton	Jakarta	Anu	012311213	anu@email.com	1
2	Hotel Kempinski	Jakarta	Ani	1931394819	ani@email.com	1
3	Bank BCA	Jakarta	Ane	8829829	ane@email.com	1
4	PT. Garuda Indonesia	Jakarta	Ano	888888	ano@email.com	1
5	Private	Jakarta	Ana	17171771	ana@email.com	1
\.


--
-- Data for Name: signage_ads_logs; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_ads_logs (signage_ads_log_id, signage_ads_id, signage_ads_type, signage_ads_name, playlist_content_id, playlist_content_source, signage_ads_log_time) FROM stdin;
\.


--
-- Name: signage_ads_signage_ads_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_ads_signage_ads_id_seq', 5, true);


--
-- Data for Name: signage_clips; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_clips (signage_clip_id, signage_clip_name, signage_clip_file, signage_ads_id, signage_clip_enabled) FROM stdin;
1	Hilton Profile	promo_hilton.mp4	1	0
2	Kempinski Profile	kempinski2.mp4	2	0
3	Robocop	robocop.mp4	1	1
4	Santika	santika.mp4	5	1
5	Bali	wi-bali.mp4	5	1
6	suzuki	santika.mp4	5	1
\.


--
-- Name: signage_clips_signage_clip_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_clips_signage_clip_id_seq', 6, true);


--
-- Data for Name: signage_content_schedules; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_content_schedules (signage_content_schedule_id, signage_content_schedule_name, signage_content_schedule_start, signage_content_schedule_end, signage_region_grouping_id, signage_content_schedule_enabled, playlist_id, signage_content_schedule_fullscreen) FROM stdin;
1	Hotel profile	1410534000	1410534180	2	1	2	0
2	Promo Garuda Indonesia	1410534000	1410534300	5	1	3	0
3	Food and Beverages	1413799440	1413799560	4	1	7	0
\.


--
-- Name: signage_content_schedules_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_content_schedules_seq', 3, true);


--
-- Data for Name: signage_generals; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_generals (signage_general_id, signage_general_title, signage_general_date, signage_general_remark, signage_general_enabled) FROM stdin;
1	Upacara Bendera	1418371200	Upacara di lapangan utama.	1
3	Birthday Party	1418288400	Ulang tahun Komisaris dirayakan di ruang serbaguna	1
2	Lomba 17 Agustus-an	1429262340	Lomba 17-an seluruh divisi.\nLomba 17-an seluruh divisi.\nLomba 17-an seluruh divisi.\nLomba 17-an seluruh divisi.\nLomba 17-an seluruh divisi.	1
\.


--
-- Name: signage_generals_signage_general_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_generals_signage_general_id_seq', 3, true);


--
-- Data for Name: signage_images; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_images (signage_image_id, signage_image_name, signage_image_file, signage_ads_id, signage_image_enabled) FROM stdin;
116	aai	aai.jpg	5	1
18	4-1	4-1.jpg	5	1
19	4-2	4-2.jpg	5	1
20	5	5.jpg	5	1
21	5-1	5-1.jpg	5	1
22	5-2	5-2.jpg	5	1
23	6	6.jpg	5	1
24	6-1	6-1.jpg	5	1
25	6-2	6-2.jpg	5	1
26	7	7.jpg	5	1
94	CCC	PRUDEN.jpg	5	1
103	INI CEMARA	cemara.jpg	5	1
69	groupcheckin	groupcheckinnu-01.jpg	5	1
36	10-1	10-1.jpg	5	1
72	squislife-01	sequislife-01.jpg	5	1
86	rencana	rencana-02.jpg	5	1
98	INI KELAPA	kelapa.jpg	5	1
99	INI KEMANGI	kemangi.jpg	5	1
7	2	2.jpg	5	1
27	7-1	7-1.jpg	5	1
8	1	1.jpg	5	1
37	10-2	10-2.jpg	5	1
92	KEMANGI-MEETING	DHE.jpg	5	1
57	jsaballroom	jsaballroom.jpg	5	1
10	1-1	1-1.jpg	5	1
12	1-2	1-2.jpg	5	1
1	2-1	2-1.jpg	5	1
2	2-2	2-2.jpg	5	1
82	MUSHOLA	MUSHOLA.jpg	5	1
70	dinner3	dinner-anvaya3.jpg	5	1
6	3	3.jpg	5	1
11	3-1	3-1.jpg	5	1
9	3-2	3-2.jpg	5	1
17	4	4-1.jpg	5	1
28	7-2	7-2.jpg	5	1
29	8	8.jpg	5	1
30	8-1	8-1.jpg	5	1
31	8-2	8-2.jpg	5	1
32	9	9.jpg	5	1
33	9-1	9-1.jpg	5	1
34	9-2	9-2.jpg	5	1
54	JEPUN-PUCUK	MRI.jpg	5	1
90	GRAND-BALLROOM1	STARCLUB.jpg	5	0
39	assemblingpoint	assemblingpoint01.jpg	5	1
58	MONIK &amp; SURYA WEDDING	monik.jpg	5	1
80	bi5	bi5.jpg	5	1
105	BALLROOM 1	ballroom1.jpg	5	1
106	BALLROOM 2	ballroom2.jpg	5	1
76	CELAGI-DOANK	celagiaja.jpg	5	1
114	WINGS2	WINGS2.jpg	5	1
46	smart	smart.jpg	5	1
68	INTOSAI	intosai.jpg	5	1
84	BI	BI-02.jpg	5	1
45	telkomccc	telkomccc.jpg	5	1
79	duluxpucuk	duluxpucuk.jpg	5	1
62	ICBG dan IOSM-02	ICBG dan IOSM-02.jpg	5	1
51	BI-CELAGI	BI-CELAGI.jpg	5	1
64	INDOSAT mega media-01	INDOSAT mega media-01.jpg	5	1
102	INI CELAGI	celagi.jpg	5	1
42	iptv  405x305 assembly point-02	iptv  405x305 assembly point-02.jpg	5	1
43	iptv  405x305 meeting signage-01	iptv  405x305 meeting signage-01.jpg	5	1
44	iptv  405x305 meeting signage-02	iptv  405x305 meeting signage-02.jpg	5	1
93	BALLROOM 1-2	anvaya12.jpg	5	1
47	kiri	kiri.gif	5	1
67	bi6	bi6.jpg	5	1
66	KEMIRI-KESUNA BERSATU	DBEST.jpg	5	1
81	SHALATJUMAT	SHALATJUMAT.jpg	5	1
109	BI2	BI2.jpg	5	1
83	1320BRI	1320BRI.jpg	5	1
112	banki	banki.jpg	5	1
73	SHALATJUMAT	SHALATJUMAT.jpg	5	1
119	JEPUNPUCUK-BERSATU	UTAMA.jpg	5	1
118	SMART-PUCUK	SMARTPUCUK.jpg	5	1
56	PT Collega 24 oktober the ANVAYA Ballroom 3-01	PT Collega 24 oktober the ANVAYA Ballroom 3-01.jpg	5	1
75	bi4	bi4.jpg	5	1
50	PT Siemen-05	PT Siemen-05.jpg	5	1
59	celagicemara-bersatu	ULNKPPK.jpg	5	1
95	Team-01	Team-01.jpg	5	1
63	buput1718	buput1718.jpg	5	1
108	bi1	bi1.jpg	5	1
89	TELKOMSEL 8	telkom8.jpg	5	1
52	terbaru tugure 2016-01	terbaru tugure 2016-01.jpg	5	1
74	SMART-JEPUN	API6JEPUN.jpg	5	1
40	tulisan	tulisan02.jpg	5	1
35	10	10.jpg	5	1
87	CAIPTJEPUN	CAIPTJEPUN.jpg	5	1
113	FIN	FIN.jpg	5	1
85	Api 3	APIMagazine01.jpg	5	0
101	INI KESUNA	kesuna.jpg	5	1
104	INI CEMPAKA	cempaka.jpg	5	1
61	pln11	pln11.jpg	5	1
100	INI KEMIRI	kemiri.jpg	5	1
97	INI JEPUN	jepun.jpg	5	1
91	KEMIRI	kemiri.jpg	5	1
96	INI PUCUK	pucuk.jpg	5	1
41	iptv  405x305 assembly point-01	iptv  405x305 assembly point-01.jpg	5	1
71	ANNIVERSARY	aniversary.jpg	5	1
38	kppu	kppu.jpg	5	1
65	ANVAYA3-LLD	LLD.jpg	5	1
111	Telkomkelapa	Telkomkelapa.jpg	5	1
53	renew	MEETINGJEPPUC.jpg	5	1
55	CAIPT	CAIPT.jpg	5	1
117	S&amp;M	S&amp;M.jpg	5	1
49	bi3	bi3.jpg	5	1
115	kubota	kubota.jpg	5	1
48	BALLROOM 1 KONTEN	anvaya1-rei.jpg	5	1
88	CEPAKA-LLD	LLD CEPAKA.jpg	5	1
60	TESTMODELSIGNAGE	TESTMODELSIGNAGE.jpg	5	1
107	BALLROOM 3	ballroom3.jpg	5	1
77	JEPUNDOANK	jepunaja.jpg	5	1
78	kelapa-kemangi	kelapakemangi.jpg	5	1
110	GRAND-BALLROOM	grandballroom.jpg	5	1
\.


--
-- Name: signage_images_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_images_seq', 119, true);


--
-- Data for Name: signage_playlist_contents; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_playlist_contents (playlist_content_id, playlist_content_source, playlist_id) FROM stdin;
3	promo_hilton.mp4	2
4	kempinski2.mp4	2
5	Promo Garuda Indonesia ticket 10% off	3
6	Enjoy your flight with Garuda Indonesia	3
7	robocop.mp4	4
178	iptv  405x305 assembly point-01.jpg	8
179	iptv  405x305 assembly point-02.jpg	8
180	iptv  405x305 meeting signage-01.jpg	9
181	iptv  405x305 meeting signage-02.jpg	9
43	macdonald-405x305.png	7
44	transcorp-800x100.png	7
56	mandiri-800x100.png	1
57	pertamina-800x100.png	1
148	1.jpg	5
149	10.jpg	5
150	10-1.jpg	5
151	10-2.jpg	5
152	1-1.jpg	5
153	1-2.jpg	5
154	2.jpg	5
155	2-1.jpg	5
156	2-2.jpg	5
157	3.jpg	5
158	3-1.jpg	5
159	3-2.jpg	5
160	4-1.jpg	5
161	4-1.jpg	5
162	4-2.jpg	5
163	5.jpg	5
164	5-1.jpg	5
165	5-2.jpg	5
166	6.jpg	5
167	6-1.jpg	5
168	6-2.jpg	5
169	7.jpg	5
170	7-1.jpg	5
171	7-2.jpg	5
172	8.jpg	5
173	8-1.jpg	5
174	8-2.jpg	5
175	9.jpg	5
176	9-1.jpg	5
177	9-2.jpg	5
\.


--
-- Name: signage_playlist_contents_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_playlist_contents_seq', 181, true);


--
-- Data for Name: signage_playlists; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_playlists (playlist_id, playlist_name, playlist_description, playlist_type, playlist_enabled, playlist_loop, playlist_duration) FROM stdin;
2	Hotel promo	Playlist untuk promo hotel	3	1	0	0
3	Promo Garuda Indonesia	Running text promo Garuda Indonesia	2	1	0	0
4	Film		3	1	0	0
7	F&amp;B Playlist		1	1	0	10
1	Region 1 Sponsor Logo	Menampilkan logo-logo hotel	1	1	0	3
5	Reg 4 Image Playlist		1	1	0	7
8	meeting0610-assembly		1	1	0	5
9	meeting0610-meeting		1	1	0	5
6	Test Running Text Playlist		2	1	0	0
\.


--
-- Name: signage_playlists_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_playlists_seq', 9, true);


--
-- Data for Name: signage_region_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_region_groupings (signage_region_grouping_id, signage_id, region_id, playlist_id, default_source, default_type, signage_region_grouping_name) FROM stdin;
1	1	1	1	logo-bank-bca1.jpg	Image	Default Reg 1
6	2	6	0	DB-airport_fids	Rss	List Reg 1
34	10	2	0	LLD CEPAKA.jpg	Image	Cempaka Top
42	12	2	0	DBEST.jpg	Image	Kemiri Top
54	14	2	0	DBEST.jpg	Image	Kesuna Top
39	12	3	0	kiri.gif	Image	Kemiri Bottom Left
40	12	4	0	assemblingpoint01.jpg	Image	Kemiri Bottom Right
41	12	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Kemiri Running Text
50	15	2	0	DHE.jpg	Image	Kemangi Top
16	6	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Pucuk Running Text
2	1	2	0	santika.mp4	Clip	Default Reg 2
5	1	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Default Reg 5
14	5	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Ballroom Running Text
3	1	3	9	2.jpg	Image	Default Reg 3
4	1	4	8	2.jpg	Image	Default Reg 4
24	8	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Ballroom 3 Running Text
19	7	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Ballroom 2 Running Text
10	4	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Anvaya Running Text
31	10	3	0	kiri.gif	Image	Cempaka Bottom Left
47	15	3	0	kiri.gif	Image	Kemangi Bottom Left
48	15	4	0	assemblingpoint01.jpg	Image	Kemangi Bottom Right
49	15	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Kemangi Running Text
46	13	2	0	DHE.jpg	Image	Kelapa Top
23	8	2	0	pln11.jpg	Image	Ballroom 3 Top
9	4	4	0	assemblypoint-01.jpg	Image	Anvaya Bottom Right
8	4	3	0	kiri.gif	Image	Anvaya Bottom Left
12	5	3	0	kiri.gif	Image	Ballroom Bottom Left
13	5	4	0	assemblypoint-01.jpg	Image	Ballroom Bottom Right
17	6	3	0	kiri.gif	Image	Pucuk Bottom Left
18	6	4	0	assemblypoint-01.jpg	Image	Pucuk Bottom Right
20	7	4	0	assemblypoint-01.jpg	Image	Ballroom 2 Bottom Right
21	7	3	0	kiri.gif	Image	Ballroom 2 Bottom Left
25	8	4	0	assemblypoint-01.jpg	Image	Ballroom 3 Bottom Right
26	8	3	0	kiri.gif	Image	Ballroom 3 Bottom Left
33	10	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Cempaka Running Text
51	14	3	0	kiri.gif	Image	Kesuna Bottom Left
32	10	4	0	assemblypoint-01.jpg	Image	Cempaka Bottom Right
52	14	4	0	assemblingpoint01.jpg	Image	Kesuna Bottom Right
53	14	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Kesuna Running Text
22	7	2	0	ballroom2.jpg	Image	Ballroom 2 Top
11	5	2	0	ballroom1.jpg	Image	Ballroom Top
35	11	3	0	kiri.gif	Image	Cemara Bottom Left
36	11	4	0	assemblypoint-01.jpg	Image	Cemara Bottom Right
37	11	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Cemara Running Text
27	9	3	0	kiri.gif	Image	Celagi Bottom Left
28	9	4	0	assemblypoint-01.jpg	Image	Celagi Bottom Right
29	9	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Celagi Running Text
43	13	3	0	kiri.gif	Image	Kelapa Bottom Left
44	13	4	0	assemblingpoint01.jpg	Image	Kelapa Bottom Right
45	13	5	0	Welcome to The ANVAYA Beach Resort - Bali	Text	Kelapa Running Text
7	4	2	0	UTAMA.jpg	Image	Jepun Top
15	6	2	0	UTAMA.jpg	Image	Pucuk Top
30	9	2	0	ULNKPPK.jpg	Image	Celagi Top
38	11	2	0	ULNKPPK.jpg	Image	Cemara Top
\.


--
-- Name: signage_region_groupings_signage_region_grouping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_region_groupings_signage_region_grouping_id_seq', 54, true);


--
-- Data for Name: signage_regions; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_regions (region_id, region_name, region_description, region_enabled, region_type, region_position) FROM stdin;
1	Region 1	Region untuk menampilkan iklan	1	1	1
6	Region 1 - List	Region 1 untuk template List	1	6	1
2	Region 2	Region untuk menampilkan video/TV channel	1	3	2
3	Region 3	Region untuk menampilkan iklan	1	1	3
4	Region 4	Region untuk menampilkan iklan	1	1	4
5	Region 5	Region untuk menampilkan running text	1	2	5
\.


--
-- Name: signage_regions_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_regions_seq', 6, true);


--
-- Data for Name: signage_room_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_room_groupings (signage_room_grouping_id, signage_id, room_id) FROM stdin;
10	3	7
29	2	12
30	2	7
31	2	2
6935	9	535
6941	14	542
6884	7	522
6954	10	537
6942	15	544
6950	8	520
6955	11	536
6926	6	530
6940	13	543
6943	12	541
6913	4	529
6952	5	524
6953	5	525
\.


--
-- Name: signage_room_groupings_signage_room_grouping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_room_groupings_signage_room_grouping_id_seq', 6955, true);


--
-- Data for Name: signage_rss; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_rss (signage_rss_id, signage_rss_name, signage_rss_file, signage_ads_id, signage_rss_enabled) FROM stdin;
13	FIDS	fids.xml	5	0
14	FIDS Schedule	DB-airport_fids	5	1
15	General Info	DB-signage_generals	5	1
\.


--
-- Data for Name: signage_templates; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_templates (template_id, template_name, template_description, template_enabled) FROM stdin;
11	1	1	1
8	2	2	1
3	Anvaya	Template for Digital Signage in Anvaya	1
4	Ballroom	Ballroom	1
6	Ballroom2	Ballroom2	1
7	Ballroom3	Ballroom3	1
9	Cempaka	Cempaka	1
10	Cepaka	Cepaka	1
1	Default	Template default digital signage	1
2	List	Template berbentuk table list.	1
5	Pucuk	Pucuk	1
12	Celagi	Celagi	1
\.


--
-- Name: signage_templates_template_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_templates_template_id_seq', 12, true);


--
-- Data for Name: signage_texts; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_texts (signage_text_id, signage_text_name, signage_text_file, signage_ads_id, signage_text_enabled) FROM stdin;
4	Promo Garuda Indonesia	PROMO GARUDA INDONESIA TICKET 10% OFF	4	0
5	Welcome Garuda	Enjoy your flight with Garuda Indonesia	4	0
16	Welcome Greetings	Welcome to The ANVAYA Beach Resort - Bali	5	1
\.


--
-- Data for Name: signage_urgencies; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_urgencies (signage_urgency_id, signage_urgency_duration, signage_urgency_enabled, emergency_code, signage_urgency_airline, signage_urgency_flight_no, signage_urgency_destination, signage_urgency_departure_gate, signage_urgency_departure_time, signage_urgency_message, signage_urgency_priority_order, signage_urgency_flag, signage_urgency_display) FROM stdin;
1	20	0	FI	\N	\N	\N	\N	\N	\N	1	emergency	\N
\.


--
-- Name: signage_urgencies_signage_urgency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_urgencies_signage_urgency_id_seq', 1, true);


--
-- Name: signage_urgency_room_grouping_signage_urgency_room_grouping_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_urgency_room_grouping_signage_urgency_room_grouping_seq', 15, true);


--
-- Data for Name: signage_urgency_room_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_urgency_room_groupings (signage_urgency_room_grouping_id, signage_urgency_id, room_id) FROM stdin;
1	0	2
15	1	1
\.


--
-- Name: signage_urgency_zone_grouping_signage_urgency_zone_grouping_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_urgency_zone_grouping_signage_urgency_zone_grouping_seq', 15, true);


--
-- Data for Name: signage_urgency_zone_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_urgency_zone_groupings (signage_urgency_zone_grouping_id, signage_urgency_id, zone_id) FROM stdin;
1	0	1
15	1	1
\.


--
-- Data for Name: signage_zone_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signage_zone_groupings (signage_zone_grouping_id, signage_id, zone_id) FROM stdin;
5	3	1
12	2	1
\.


--
-- Name: signage_zone_groupings_signage_zone_grouping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signage_zone_groupings_signage_zone_grouping_id_seq', 114, true);


--
-- Data for Name: signages; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY signages (signage_id, signage_name, signage_description, signage_enabled, template_id) FROM stdin;
2	Flight Schedule	Signage showing flight schedule from FIDS	0	2
3	General Info	Signage showing general info schedule	0	2
4	Signage Anvaya	Signage Jepun	1	3
7	Signage Ballroom 2	Signage Ballroom 2	1	6
1	Signage Default	Digital signage khusus Lt.1	1	1
6	Signage Pucuk	Signage Pucuk	1	5
9	Signage Celagi	Signage Celagi	1	5
13	Signage Kelapa	Signage Kelapa	1	3
14	Signage Kesuna	Signage Kesuna	1	3
15	Signage Kemangi	Signage Kemangi	1	3
12	Signage Kemiri	Signage Kemiri	1	3
8	Signage Ballroom 3	Signage Ballroom 3	1	7
5	Signage Ballroom	Signage Ballroom	1	4
10	Signage Cempaka	Signage Cempaka	1	5
11	Signage Cemara	Signage Cemara	1	5
\.


--
-- Name: signages_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('signages_seq', 15, true);


--
-- Data for Name: souvernir_group_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY souvernir_group_translations (translation_id, souvernir_group_id, language_id, translation_title, translation_description) FROM stdin;
\.


--
-- Name: souvernir_group_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('souvernir_group_translations_translation_id_seq', 1, false);


--
-- Data for Name: souvernir_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY souvernir_groups (souvernir_group_id, souvernir_group_thumbnail, souvernir_group_order, souvernir_group_allow_ads, souvernir_group_enabled) FROM stdin;
\.


--
-- Name: souvernir_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('souvernir_groups_seq', 1, false);


--
-- Data for Name: souvernir_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY souvernir_translations (translation_id, souvernir_id, language_id, translation_title, translation_description) FROM stdin;
\.


--
-- Name: souvernir_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('souvernir_translations_translation_id_seq', 1, false);


--
-- Data for Name: souvernirs; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY souvernirs (souvernir_id, souvernir_price, souvernir_thumbnail, souvernir_enabled, souvernir_allow_ads, souvernir_order, souvernir_group_id, souvernir_code) FROM stdin;
\.


--
-- Name: souvernirs_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('souvernirs_seq', 1, false);


--
-- Data for Name: spa_group_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY spa_group_translations (translation_id, spa_group_id, language_id, translation_title, translation_description) FROM stdin;
9	2	  		
14	2	  		
15	2	  		
17	2	  		
18	2	  		
19	2	  		
20	2	  		
21	2	  		
22	2	  		
23	3	  		
28	3	  		
29	3	  		
31	3	  		
32	3	  		
33	3	  		
34	2	  		
35	2	  		
36	2	  		
37	4	  		
42	4	  		
43	4	  		
45	3	  		
24	3	de	Navicom Massage	
26	3	fr	Navicom Massage	
46	3	  		
47	3	  		
30	3	ru	Освежающий Spa	
48	4	  		
38	4	de	Navicom Spa Package	
40	4	fr	Navicom Spa Package	
49	4	  		
50	4	  		
44	4	ru	Navicom Spa Package	
51	2	  		
10	2	de	Navicom Spa Treatment	
12	2	fr	Navicom Spa Treatment	
52	2	  		
53	2	  		
16	2	ru	Navicom Spa Treatment	
54	3	  		
55	3	  		
56	3	  		
58	3	  		
59	3	  		
60	3	  		
61	3	  		
62	3	  		
63	3	  		
64	3	  		
65	4	  		
66	4	  		
67	4	  		
69	4	  		
70	4	  		
71	2	  		
72	2	  		
73	2	  		
75	2	  		
76	2	  		
77	3	  		
78	3	  		
25	3	en	Navicom Massage	
79	3	  		
27	3	id	Navicom Massage	
57	3	jp	Navicom Massage	
80	3	  		
81	3	  		
82	2	  		
83	2	  		
11	2	en	Navicom Spa Treatment	
84	2	  		
13	2	id	Navicom Spa Treatment	
74	2	jp	Navicom Spa Treatment	
85	2	  		
86	2	  		
87	4	  		
88	4	  		
39	4	en	Navicom Spa Package	
89	4	  		
41	4	id	Navicom Spa Package	
68	4	jp	Navicom Spa Package	
90	4	  		
91	4	  		
\.


--
-- Name: spa_group_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('spa_group_translations_translation_id_seq', 91, true);


--
-- Data for Name: spa_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY spa_groups (spa_group_id, spa_group_description, spa_group_thumbnail, spa_group_enabled, spa_group_allow_ads, spa_group_order, spa_group_clip) FROM stdin;
3	\N	massage	1	1	1	\N
2	\N	treatment	1	1	1	\N
4	\N	spa-package	1	0	2	\N
\.


--
-- Name: spa_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('spa_groups_seq', 4, true);


--
-- Data for Name: spa_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY spa_translations (translation_id, spa_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
6	1	  		
7	1	  		
9	1	  		
26	3	fr	Traditional Massage	
82	4	  		
38	4	de	Business Spa Package	
10	1	  		
11	1	  		
40	4	fr	Business Spa Package	
12	1	  		
83	4	  		
84	4	  		
44	4	ru	Бизнес Спа-пакет	
13	1	  		
14	1	  		
85	1	  		
15	2	  		
20	2	  		
21	2	  		
23	3	  		
28	3	  		
29	3	  		
31	2	  		
32	2	  		
33	2	  		
86	1	  		
34	2	  		
87	1	  		
88	2	  		
16	2	de	Erfrischende Körperbehandlung	
35	2	  		
36	2	  		
37	4	  		
42	4	  		
43	4	  		
45	5	  		
50	5	  		
51	5	  		
53	6	  		
58	6	  		
59	6	  		
61	3	  		
18	2	fr	Soin du corps Rafraîchissante	
89	2	  		
90	2	  		
62	3	  		
63	3	  		
22	2	ru	Освежающий по уходу за Tелом	
64	3	  		
101	3	  		
65	3	  		
66	3	  		
67	4	  		
91	6	  		
54	6	de	Simple and Fresh Facial	
56	6	fr	Simple and Fresh Facial	
68	4	  		
69	4	  		
102	3	  		
70	1	  		
30	3	ru	Традиционный Массаж	
103	1	  		
2	1	de	Fußreflexzonenmassage	
3	1	en	Foot Reflexology	
71	1	  		
72	1	  		
4	1	fr	Réflexologie Plantaire	
73	2	  		
5	1	id	Pijat Reflexi	
104	1	  		
105	1	  		
8	1	ru	Cтупней	
74	2	  		
75	2	  		
106	5	  		
76	6	  		
77	6	  		
78	6	  		
107	5	  		
79	4	  		
108	5	  		
109	5	  		
46	5	de	Sport Massage	
80	4	  		
81	4	  		
92	6	  		
93	6	  		
60	6	ru	Простой и свежий лице	
94	5	  		
48	5	fr	Sport Massage	
110	5	  		
95	5	  		
96	5	  		
111	5	  		
97	5	  		
98	5	  		
99	5	  		
100	3	  		
24	3	de	Klassische Massage	
52	5	ru	Спортивный массаж	
112	4	  		
113	4	  		
114	4	  		
145	4	  		
116	4	  		
117	4	  		
118	2	  		
119	2	  		
17	2	en	Refreshing Body Treatment	
120	2	  		
19	2	id	Refreshing Body Treatment	
121	2	jp	Refreshing Body Treatment	
122	2	  		
123	2	  		
124	6	  		
125	6	  		
55	6	en	Simple and Fresh Facial	
126	6	  		
57	6	id	Simple and Fresh Facial	
127	6	jp	Simple and Fresh Facial	
128	6	  		
129	6	  		
130	5	  		
131	5	  		
47	5	en	Sport Massage	
132	5	  		
49	5	id	Sport Massage	
133	5	jp	Sport Massage	
134	5	  		
135	5	  		
136	3	  		
137	3	  		
25	3	en	Traditional Massage	
138	3	  		
27	3	id	Traditional Massage	
139	3	jp	Traditional Massage	
140	3	  		
141	3	  		
142	4	  		
143	4	  		
144	4	  		
146	4	  		
147	4	  		
148	4	  		
39	4	en	Business Spa Package	
149	4	  		
41	4	id	Business Spa Package	
115	4	jp	ビジネススパパッケージ	
150	4	  		
151	4	  		
\.


--
-- Name: spa_translations_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('spa_translations_seq', 151, true);


--
-- Data for Name: spas; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY spas (spa_id, spa_price, spa_thumbnail, spa_enabled, spa_allow_ads, spa_order, spa_group_id, spa_code, spa_clip, spa_currency) FROM stdin;
1	135000	reflexi	0	0	1	2	S003	\N	\N
2	245000	refreshing	1	0	2	2	S004		\N
6	185000	facial	1	0	5	2	S005		\N
5	175000	sport	1	0	2	3	S002		\N
3	175000	traditional	1	0	3	3	S001		\N
4	330000	business	1	0	1	4	S006		IDR
\.


--
-- Name: spas_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('spas_seq', 6, true);


--
-- Data for Name: style_schedules; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY style_schedules (style_schedule_id, style_schedule_start, style_schedule_end, style_id, style_schedule_enabled, style_schedule_node, style_schedule_name) FROM stdin;
1	1419033600	1420475760	5	0		new year
\.


--
-- Name: style_schedules_style_schedule_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('style_schedules_style_schedule_id_seq', 1, true);


--
-- Data for Name: styles; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY styles (style_id, style_name, style_description, style_active, style_admin, style_tablet) FROM stdin;
10	_panghegar_		0	0	0
13	clove		0	0	0
8	fourseasons		0	0	0
14	gds		0	0	0
7	inaya		0	0	0
6	kempinski		0	0	0
5	mercure		0	0	0
4	panghegar		0	0	0
9	regent		0	0	0
11	simplicity-v2		1	1	0
3	xmas		0	0	0
12	signage	Digital signage	0	0	0
1	simplicity	Directory name is in lower case. simplicity.	0	1	0
16	santika	Hotel Santika	0	0	0
2	savannah	Navicom IPTV New Generation	0	0	0
15	watermark	Watermark Hotel &amp; Spa Bali	0	0	0
17	anvaya		1	0	0
\.


--
-- Name: styles_style_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('styles_style_id_seq', 17, true);


--
-- Data for Name: sync_flag; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY sync_flag (sync_id, sync_code, sync_request, sync_status) FROM stdin;
1	SYNC	0	0
4	SVCSYNC	0	0
\.


--
-- Name: sync_flag_sync_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('sync_flag_sync_id_seq', 4, true);


--
-- Data for Name: target_gates; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY target_gates (target_gate_id, target_gate_name, target_gate_description, target_gate_enabled) FROM stdin;
1	1	Gate 1	1
2	2	Gate 2	1
3	3	Gate 3	1
\.


--
-- Name: target_gates_target_gate_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('target_gates_target_gate_id_seq', 3, true);


--
-- Data for Name: teraphist_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY teraphist_translations (translation_id, teraphist_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
6	1	  		
7	1	  		
9	1	  		
2	1	de	Nyoman Masayu	
3	1	en	Nyoman Masayu	High Skill Teraphist
4	1	fr	Nyoman Masayu	
5	1	id	Nyoman Masayu	
10	1	  		
11	1	  		
8	1	ru	Nyoman Masayu	
\.


--
-- Name: teraphist_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('teraphist_translations_translation_id_seq', 11, true);


--
-- Data for Name: teraphists; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY teraphists (teraphist_id, teraphist_thumbnail, teraphist_enabled) FROM stdin;
1	masayu.jpg	1
\.


--
-- Name: teraphists_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('teraphists_seq', 1, true);


--
-- Data for Name: themes; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY themes (theme_id, theme_start, theme_end, theme_name, theme_description, theme_enabled) FROM stdin;
\.


--
-- Name: themes_theme_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('themes_theme_id_seq', 1, false);


--
-- Data for Name: tour_group_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tour_group_translations (translation_id, tour_group_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	de	Navicom Tagestouren	
4	1	fr	Navicom Full Day Tours	
6	1	  		
7	1	  		
8	1	ru	NAVICOM целый день Экскурсии	
9	1	  		
10	1	  		
11	1	  		
13	1	  		
14	1	  		
15	1	  		
16	1	  		
3	1	en	Navicom Full Day Tours	
17	1	  		
5	1	id	Navicom Full Day Tours	
12	1	jp	Navicom Full Day Tours	
18	1	  		
19	1	  		
\.


--
-- Name: tour_group_translations_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tour_group_translations_seq', 19, true);


--
-- Data for Name: tour_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tour_groups (tour_group_id, tour_group_description, tour_group_thumbnail, tour_group_enabled, tour_group_allow_ads, tour_group_order, tour_group_clip) FROM stdin;
1	\N	full-day	1	0	1	\N
\.


--
-- Name: tour_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tour_groups_seq', 1, true);


--
-- Data for Name: tour_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tour_translations (translation_id, tour_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
6	1	  		
7	1	  		
9	1	  		
2	1	de	Navicom Kintamani Tour	
4	1	fr	Navicom Kintamani Tour	
10	1	  		
11	1	  		
8	1	ru	Navicom Kintamani Tour	
12	2	  		
13	2	de	Navicom Besakih Tour	
15	2	fr	Navicom Besakih Tour	
17	2	  		
18	2	  		
19	2	ru	Navicom Besakih Tour	
20	1	  		
21	1	  		
22	1	  		
24	1	  		
25	1	  		
26	2	  		
27	2	  		
28	2	  		
30	2	  		
31	2	  		
32	2	  		
33	2	  		
34	2	  		
35	2	  		
36	2	  		
37	1	  		
38	1	  		
39	1	  		
40	1	  		
41	1	  		
42	1	  		
43	1	  		
44	1	  		
45	1	  		
46	1	  		
47	1	  		
48	1	  		
49	1	  		
50	1	  		
51	1	  		
52	1	  		
53	1	  		
54	1	  		
55	1	  		
56	1	  		
57	1	  		
58	1	  		
59	1	  		
60	1	  		
61	1	  		
62	1	  		
63	1	  		
3	1	en	Navicom Kintamani Tour	
64	1	  		
5	1	id	Navicom Kintamani Tour	
23	1	jp	Navicom Kintamani Tour	
65	1	  		
66	1	  		
67	2	  		
68	2	  		
14	2	en	Navicom Besakih Tour	
69	2	  		
16	2	id	Navicom Besakih Tour	
29	2	jp	Navicom Besakih Tour	
70	2	  		
71	2	  		
\.


--
-- Name: tour_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tour_translations_translation_id_seq', 71, true);


--
-- Data for Name: tours; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tours (tour_id, tour_price, tour_thumbnail, tour_enabled, tour_clip, tour_order, tour_group_id, tour_code, tour_allow_ads, tour_currency) FROM stdin;
1	300000	kintamani	1		1	1	F0001	0	\N
2	500000	besakih	1		2	1	F02005	0	IDR
\.


--
-- Name: tours_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tours_seq', 2, true);


--
-- Data for Name: tv_channel_group_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tv_channel_group_translations (translation_id, tv_channel_group_id, language_id, translation_title) FROM stdin;
194	6	cn	所有
195	6	  	
196	6	kr	모든
203	3	  	
207	5	  	
212	11	  	
211	11	cn	记录
92	11	id	Dokumenter
213	11	kr	기록한 것
35	6	en	All
37	6	id	All
197	7	cn	本地
58	7	en	Local
60	7	id	Local
64	8	  	\N
65	8	  	\N
67	8	  	\N
69	8	  	\N
70	8	  	\N
71	8	  	\N
72	9	  	\N
73	9	  	\N
75	9	  	\N
77	9	  	\N
78	9	  	\N
79	9	  	\N
80	10	  	\N
81	10	  	\N
83	10	  	\N
85	10	  	\N
86	10	  	\N
87	10	  	\N
88	11	  	\N
89	11	  	\N
91	11	  	\N
93	11	  	\N
94	11	  	\N
95	11	  	\N
96	12	  	\N
97	12	  	\N
99	12	  	\N
101	12	  	\N
102	12	  	\N
103	12	  	\N
104	8	  	\N
105	8	  	\N
146	3	  	\N
106	8	  	\N
147	3	  	\N
107	8	  	\N
108	8	  	\N
109	8	  	\N
110	3	  	\N
111	3	  	\N
112	3	  	\N
155	10	  	\N
113	3	  	\N
114	3	  	\N
115	3	  	\N
116	9	  	\N
117	9	  	\N
118	9	  	\N
148	3	  	\N
119	9	  	\N
120	9	  	\N
1	2	cn	当地
15	2	jp	ローカル
16	2	kr	국  부  의
20	3	jp	ニュース
25	5	jp	スポーツの
7	4	cn	电影
30	4	jp	作品
31	4	kr	영화
33	6	  	\N
38	6	  	\N
39	6	  	\N
41	6	  	\N
34	6	de	All
36	6	fr	All
42	6	  	\N
43	6	  	\N
40	6	ru	All
44	3	  	\N
18	3	de	Nachrichten
19	3	fr	Nouvelles
45	3	  	\N
46	3	  	\N
22	3	ru	Hовости
47	4	  	\N
28	4	de	Kino
29	4	fr	Films
48	4	  	\N
49	4	  	\N
32	4	ru	кино
50	5	  	\N
23	5	de	Sport
24	5	fr	Sport
51	5	  	\N
52	5	  	\N
27	5	ru	спорт
53	2	  	\N
13	2	de	Science
2	2	en	Science
14	2	fr	Science
3	2	id	Ilmu Pengetahuan
54	2	  	\N
55	2	  	\N
17	2	ru	Science
56	7	  	\N
57	7	de	Local
59	7	fr	Local
61	7	  	\N
62	7	  	\N
63	7	ru	Local
121	9	  	\N
122	5	  	\N
123	5	  	\N
124	5	  	\N
125	5	  	\N
126	5	  	\N
127	5	  	\N
128	7	  	\N
129	7	  	\N
130	7	  	\N
131	7	  	\N
132	7	  	\N
133	7	  	\N
134	8	  	\N
135	8	  	\N
136	8	  	\N
137	8	  	\N
138	8	  	\N
139	8	  	\N
140	9	  	\N
141	9	  	\N
142	9	  	\N
143	9	  	\N
144	9	  	\N
145	9	  	\N
149	3	  	\N
150	3	  	\N
151	3	  	\N
152	10	  	\N
153	10	  	\N
154	10	  	\N
156	10	  	\N
157	10	  	\N
158	11	  	\N
159	11	  	\N
160	11	  	\N
161	11	  	\N
162	11	  	\N
163	11	  	\N
164	12	  	\N
165	12	  	\N
166	12	  	\N
167	12	  	\N
168	12	  	\N
169	12	  	\N
170	4	  	\N
171	4	  	\N
8	4	en	Entertainment
172	4	  	\N
9	4	id	Hiburan
173	4	  	\N
198	7	  	
199	7	kr	노동 조합 지부
66	8	en	Kids
4	3	cn	新闻
5	3	en	News
6	3	id	Berita
21	3	kr	뉴스
204	9	cn	国外
76	9	id	Foreign
10	5	cn	体育
11	5	en	Sports
12	5	id	Olah Raga
26	5	kr	스포츠의
82	10	en	Movie
84	10	id	Film
98	12	en	Music
100	12	id	Musik
174	4	  	\N
175	4	  	\N
176	11	  	\N
177	11	  	\N
178	11	  	\N
179	11	  	\N
180	11	  	\N
181	11	  	\N
182	10	  	\N
183	10	  	\N
184	10	  	\N
185	10	  	\N
186	10	  	\N
187	10	  	\N
188	10	  	\N
189	10	  	\N
190	10	  	\N
191	10	  	\N
192	10	  	\N
193	10	  	\N
200	8	cn	童装
68	8	id	Anak-Anak
201	8	  	
202	8	kr	아이
74	9	en	Foreign
205	9	  	
206	9	kr	외국의
208	10	cn	电影
209	10	  	
210	10	kr	영화
214	12	cn	音乐
215	12	  	
216	12	kr	음악
90	11	en	Documentary
217	11	  	
\.


--
-- Name: tv_channel_group_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tv_channel_group_translations_translation_id_seq', 217, true);


--
-- Data for Name: tv_channel_groupings; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tv_channel_groupings (tv_channel_grouping_id, tv_channel_group_id, tv_channel_id) FROM stdin;
750	6	30
751	7	30
755	6	61
756	7	61
1091	6	144
1092	7	144
777	6	126
778	8	126
1097	6	129
1098	9	129
795	6	135
796	3	135
1109	6	119
1110	3	119
807	6	8
808	9	8
813	6	114
814	5	114
825	6	148
826	10	148
843	6	151
844	11	151
1017	6	1
1018	10	1
863	6	111
864	4	111
869	6	133
870	4	133
1035	6	92
1036	7	92
897	6	112
898	9	112
1041	6	105
1042	10	105
1142	6	106
1143	4	106
915	6	123
916	4	123
1148	6	104
1149	10	104
1077	6	118
1078	3	118
1089	6	100
1090	10	100
752	7	95
763	6	147
764	7	147
773	6	26
774	7	26
779	6	150
780	8	150
1093	6	116
1094	5	116
1099	6	134
1007	6	5
229	2	35
230	2	13
231	2	15
232	2	44
236	2	48
237	2	49
306	1	80
238	2	51
239	2	52
241	2	54
242	2	55
176	2	56
177	2	57
180	2	33
247	2	31
315	1	87
320	3	90
321	2	72
322	3	24
324	2	88
325	3	91
327	2	75
328	4	73
329	2	74
330	3	12
200	2	40
332	3	23
334	3	19
335	3	86
337	2	46
342	3	83
343	3	84
344	2	63
347	3	71
348	2	67
349	2	68
350	2	70
351	2	77
352	2	60
123	2	27
356	3	81
357	2	43
358	2	82
359	2	85
135	2	39
362	3	45
137	2	41
138	2	42
363	2	62
365	2	79
368	2	59
369	2	69
370	2	89
371	3	47
373	3	78
374	2	76
390	6	2
391	3	2
402	6	28
403	7	28
859	6	110
409	6	16
410	3	16
411	5	53
415	6	38
416	3	20
417	3	32
1008	3	5
860	4	110
420	6	22
421	3	64
422	6	58
425	7	29
430	3	14
431	6	17
432	3	17
438	6	25
439	3	25
440	6	4
441	3	4
865	6	136
866	4	136
461	6	50
462	3	50
1100	12	134
1105	6	101
628	6	142
468	7	18
629	7	142
630	6	139
1019	6	124
631	7	139
1020	11	124
1106	10	101
475	7	93
1111	6	127
1112	8	127
1117	6	103
636	6	137
1031	6	36
637	7	137
638	6	138
639	7	138
1032	9	36
1118	5	103
642	6	145
643	7	145
644	6	141
645	7	141
646	6	143
647	7	143
899	6	65
900	7	65
1133	1	3
1138	6	132
1139	3	132
1144	6	125
1145	4	125
1150	6	108
941	6	94
942	7	94
1151	4	108
546	7	6
551	7	66
558	7	98
981	6	97
845	6	7
846	12	7
861	6	131
862	4	131
1095	6	122
1096	11	122
1101	6	130
1102	9	130
1003	6	109
1004	3	109
1107	6	149
1108	8	149
889	6	146
890	7	146
1015	6	113
1016	5	113
1113	6	34
1114	3	34
1119	6	107
1120	4	107
1033	6	21
1034	7	21
1134	6	140
1051	6	102
1052	10	102
1057	6	117
1058	3	117
1135	7	140
753	6	96
754	7	96
793	6	120
794	3	120
799	6	37
800	9	37
835	6	121
836	11	121
847	6	128
848	12	128
953	6	99
954	7	99
969	6	115
970	5	115
\.


--
-- Name: tv_channel_groupings_tv_channel_grouping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tv_channel_groupings_tv_channel_grouping_id_seq', 1151, true);


--
-- Data for Name: tv_channel_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tv_channel_groups (tv_channel_group_id, tv_channel_group_description, tv_channel_group_enabled, tv_channel_group_thumbnail, tv_channel_group_order) FROM stdin;
6		1	all	0
11	Channel Dokumenter	1	documentary	7
4	TV kok isine ming pilem tok	1	entertainment	10
9		1	foreign	4
8	TV ANAK-ANAK	1	kids	2
7		1	local	1
10	Channel Film	1	movies	6
12	Channel Musik	1	music	8
3	TV Berita ini om...	1	news	3
2	TV Lokal euy	0	science	4
5	TV kok isine ming olah raga tok	1	sports	5
\.


--
-- Name: tv_channel_groups_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tv_channel_groups_seq', 13, false);


--
-- Data for Name: tv_channels; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tv_channels (tv_channel_id, tv_channel_name, tv_channel_url_http, tv_channel_thumbnail, tv_channel_order, tv_channel_url_udp, tv_channel_allow_ads, tv_channel_enabled) FROM stdin;
9	jh	\N	fox	9	\N	0	1
10	jh	\N	fox	9	\N	0	1
11	jh	\N	fox	9	\N	0	1
80	STYLE 360	\N	style360.png	43	225.0.0.44	0	1
87	PERVIY KANAL	\N	perviy.png	52	225.0.0.53	0	0
122	CRIME INVESTIGATION		ci.png	48	225.1.1.28	0	1
65	SCTV		sctv.png	12	225.1.1.11	0	0
126	DISNEY XD HD		disnepxd.png	18	225.1.1.65	0	1
22	DW ASIA	\N	dwasia.png	24	225.1.1.44	0	0
53	U CHANNEL	\N	u.png	15	225.1.1.35	0	0
132	IDX CHANNEL		IDXCHANNELTENAN.png	28	225.1.1.76	0	1
18	TV ONE	\N	tvone.png	6	225.1.1.6	0	0
124	FOOD NETWORK		foodnetwork.png	49	225.1.1.96	0	1
36	BBC EARTH		bbcearth.png	25	225.1.1.56	0	1
99	KOMPAS TV		kompas.png	1	225.1.1.91	0	0
145	INDOSIAR	\N	indosiar.png	14	225.1.1.90	0	1
139	METRO TV	\N	metro.png	7	225.1.1.83	0	1
32	AL JAZEERA	\N	aljazeera.png	21	225.1.1.41	0	0
144	TVRI		tvri.png	9	225.1.1.23	0	1
131	LIFE		life.png	60	225.1.1.75	0	1
107	FASHION TV		fashiontv.png	56	225.1.1.8	0	1
114	FOX SPORT 2		foxsport2.png	36	225.1.1.49	0	1
136	MNC LIFESTYLE		mnc-lifestyle.png	62	225.1.1.80	0	1
38	CHANNEL V	\N	v.png	19	225.1.1.39	0	0
64	LOTUS MACAU	\N	lotus.png	25	225.1.1.45	0	0
58	SUN TV	\N	suntv.png	26	225.1.1.46	0	0
125	WAKU-WAKU		WAKUWAKU.png	55	225.1.1.148	0	1
92	KOMPAS TV		kompas.png	1	225.1.1.15	0	1
95	MNC TV		mnc.png	10	225.1.1.2	0	0
29	O CHANNEL	\N	ochannel.png	29	225.1.1.49	0	0
149	CBEEBIES		cbeebies.png	17	225.1.1.2	0	1
112	KIX		kix.png	34	225.1.1.47	0	1
5	FRANCE 24		france24.png	30	225.1.1.74	0	1
146	TV ONE		tvone.png	13	225.1.1.16	0	1
115	BEIN 2		bein2.png	38	225.1.1.92	0	1
128	NATGEO Music		nat-geo-music.png	53	225.1.1.69	0	1
100	HBO HITS		hbo-hits.png	40	225.1.1.25	0	1
66	GLOBAL TV	\N	globaltv.png	3	225.1.1.3	0	0
103	BEIN 1		bein1.png	37	225.1.1.7	0	1
138	SCTV	\N	sctv.png	12	225.1.1.82	0	1
116	SOCCER CHANNEL		soccerr.png	38	225.1.1.26	0	1
118	FOX NEWS CHANNEL		fox-news.png	22	225.1.1.53	0	1
121	HISTORY		history.png	47	225.1.1.58	0	1
106	STAR WORLD		starworld.png	50	225.1.1.41	0	1
109	BLOOMBERG		bloomberg.png	58	225.1.1.44	0	1
97	M On D			68	225.1.1.5	0	0
151	NATGEO		natgeo.png	51	225.1.1.63	0	1
110	E! ENTERTAINMENT		e.png	59	225.1.1.45	0	1
61	INDOSIAR		indosiar.png	13	225.1.1.7	0	0
147	TRANS 7		trans7.png	5	225.1.1.85	0	1
141	MNC  TV	\N	mnc.png	15	225.1.1.86	0	1
104	CELESTIAL MOVIE		celestial-movie.png	44	225.1.1.6	0	1
102	AXN		axn.png	46	225.1.1.36	0	1
137	RCTI	\N	rcti.png	11	225.1.1.81	0	1
123	LIFETIME	225.1.1.60	lifetime.png	63	225.1.1.60	0	1
120	CNN International		cnn.png	26	225.1.1.57	0	1
28	JAK TV	\N	jaktv.png	11	225.1.1.31	0	0
140	TRANS TV		trans.png	2	225.1.1.84	0	1
129	AUSTRALIA PLUS		australiaplus.png	31	225.1.1.29	0	1
3	CNBC	../../../../../vod/rcti.mp4	cnbc.png	2	225.1.1.23	0	0
111	AFC		afc.png	61	225.1.1.46	0	1
26	RCTI		rcti.png	11	225.1.1.9	0	0
50	PHOENIX	../../../../../vod/luxetv.mp4	phoenix.png	4	225.1.1.24	0	0
98	TRANS 7	\N	trans7.png	5	225.1.1.4	0	0
130	TVN		tvn1.png	32	225.1.1.31	0	0
25	RAI	../../../../../vod/rai.mp4	rai.png	5	225.1.1.25	0	0
21	KOMPAS TV		kompas.png	1	225.1.1.1	0	0
4	TVE	../../../../../vod/cnbc.mp4	tve.png	6	225.1.1.26	0	0
142	GLOBAL TV	\N	globaltv.png	6	225.1.1.87	0	1
117	BBC WORLD NEWS		bbcworld.png	21	225.1.1.52	0	1
6	METRO TV	\N	metro.png	8	225.1.1.8	0	0
17	NTV VIR	\N	ntv.png	8	225.1.1.28	0	0
94	TVRI		tvri.png	9	225.1.1.12	0	0
96	NET TV		net.png	8	225.1.1.13	0	1
2	RTP	\N	rtp.png	9	225.1.1.29	0	0
108	SONY CHANNEL		sony-entertainment.png	57	225.1.1.24	0	1
30	BALI TV		balitv.png	10	225.1.1.10	0	1
93	ANTV	\N	antv.png	14	225.1.1.14	0	0
1	HBO HD		hbo.png	39	225.1.1.62	0	1
143	ANTV	\N	antv.png	16	225.1.1.88	0	1
7	CHANNEL V		v.png	52	225.1.1.68	0	1
150	DISNEY JUNIOR		disneyjr.png	19	225.1.1.66	0	1
119	AL JAZEERA INTERNATIONAL		aljazeera.png	24	225.1.1.50	0	1
14	XING KONG	\N	xingkong.png	18	225.1.1.38	0	0
20	RUSSIA TODAY	\N	rt.png	20	225.1.1.40	0	0
101	HBO FAMILY		hbo-family.png	41	225.1.1.22	0	1
113	FOX SPORT		fox-sport.png	35	225.1.1.95	0	1
127	NICKELODEON		nickelodeon.png	20	225.1.1.4	0	1
134	MNC MUSIC		mnc-music.png	54	225.1.1.32	0	1
37	DW TV		dw.png	29	225.1.1.70	0	1
8	NHK WORLD		nhk.png	33	225.1.1.71	0	1
148	HBO SIGNATURE		hbo-sig.png	42	225.1.1.40	0	1
16	AL MANAR	\N	almanar.png	14	225.1.1.34	0	0
105	FOX MOVIE PREMIUM HD		foxpremium.png	45	225.1.1.39	0	1
34	CHANNEL NEWS ASIA		channel-newsasia.png	23	225.1.1.5	0	1
135	MNC NEWS		mnc-news.png	27	225.1.1.79	0	1
133	MNC ENTERTAINMENT		mnc-entertainment.png	64	225.1.1.77	0	1
\.


--
-- Name: tv_channels_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tv_channels_seq', 152, false);


--
-- Data for Name: tv_promos; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY tv_promos (tv_promo_id, tv_promo_title, tv_promo_description, tv_promo_thumbnail, tv_promo_start, tv_promo_end, tv_promo_default, tv_promo_enabled) FROM stdin;
1	Starbucks	Buy 1 get 1	starbuck-405x305.png	1418191200	1418191260	0	1
2	McDonald's	\N	macdonald-405x305.png	1418198400	1418198400	0	1
\.


--
-- Name: tv_promos_tv_promo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('tv_promos_tv_promo_id_seq', 3, false);


--
-- Data for Name: user_groups; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY user_groups (user_group_id, user_group_name, user_group_description, user_group_enabled) FROM stdin;
1	Administrators		1
2	Guests		1
3	Front Desks		0
4	Tukang Dapur	Food and Beverage Officers	0
\.


--
-- Name: user_groups_user_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('user_groups_user_group_id_seq', 4, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY users (user_id, user_name, user_fullname, user_password, user_description, user_group_id, language_id, user_enabled, user_lastvisit) FROM stdin;
6	admin	Admin	f9e5ff15960e596b510140b3eecfebce		1	en	1	\N
2	guest	Anonymous			2	en	0	\N
1	root	Navicom Root	2c8a7adc892664c4f5ff4f624c62f50f	Super User.	1	en	1	1387556548
10	signage	Admin Signage	7a67950506f53c3cbf29e468ebcd5224		1	en	0	\N
11	roomservice2	Roomservice 2	bc7a897d5ccb77a737a89dab8077120f		1	en	1	\N
9	spv	Supervisor	ffddd864fe985d09beee83375429ab8d		1	en	1	\N
7	engineering	Engineering	a8bddc09c6cabd862e025d173b43c901	Enginering Santika Hotel	1	en	1	\N
8	roomservice	Roomservice	4404935d5f7e4971d878ed199dbeabbc	Roomservice Santika Hotel	1	en	1	\N
5	tonjaw	Roberto Tonjaw	4021e43ba174730d91b9eca862f9aa97	Halo mr Tonjaw	1	en	1	\N
\.


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('users_user_id_seq', 11, true);


--
-- Data for Name: wakeup_call_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY wakeup_call_translations (translation_id, wakeup_calls_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
6	1	jp	コールモーニングコール	
7	1	  		
8	1	  		
9	1	  		
3	1	en	Wake Up Call	
5	1	id	Wake Up Call	
10	1	  		
\.


--
-- Name: wakeup_call_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('wakeup_call_translations_translation_id_seq', 10, true);


--
-- Data for Name: wakeup_calls; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY wakeup_calls (wakeup_calls_id, wakeup_calls_image, wakeup_calls_image_enabled, wakeup_calls_clip, wakeup_calls_clip_enabled, wakeup_calls_enabled, wakeup_calls_order) FROM stdin;
1	pleasecall-ext2	0		0	1	1
\.


--
-- Name: wakeup_calls_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('wakeup_calls_seq', 1, true);


--
-- Data for Name: weather; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY weather (weather_id, weather_city, weather_enabled, weather_city_full, weather_country_icon, weather_today_text, weather_today_condition, weather_today_icon, weather_today_icon_url, weather_today_temp_f_min, weather_today_temp_f_max, weather_today_temp_c_min, weather_today_temp_c_max, weather_day1_text, weather_day1_condition, weather_day1_icon, weather_day1_icon_url, weather_day1_temp_f_min, weather_day1_temp_f_max, weather_day1_temp_c_min, weather_day1_temp_c_max, weather_day2_text, weather_day2_condition, weather_day2_icon, weather_day2_icon_url, weather_day2_temp_f_min, weather_day2_temp_f_max, weather_day2_temp_c_min, weather_day2_temp_c_max, weather_day3_text, weather_day3_condition, weather_day3_icon, weather_day3_icon_url, weather_day3_temp_f_min, weather_day3_temp_f_max, weather_day3_temp_c_min, weather_day3_temp_c_max, weather_exist) FROM stdin;
8	Kuala Lumpur	1	Kuala Lumpur, Malaysia	\N	Friday	Chance of a Thunderstorm	chancetstorms	http://icons-ak.wxug.com/i/c/k/chancetstorms.gif	75	91	24	33	Saturday	Chance of a Thunderstorm	chancetstorms	http://icons-ak.wxug.com/i/c/k/chancetstorms.gif	75	93	24	34	Sunday	Chance of a Thunderstorm	chancetstorms	http://icons-ak.wxug.com/i/c/k/chancetstorms.gif	77	91	25	33	Monday	Chance of a Thunderstorm	chancetstorms	http://icons-ak.wxug.com/i/c/k/chancetstorms.gif	77	90	25	32	1
11	Moscow	0	Moscow, Russia	\N	Friday	Clear	clear	http://icons-ak.wxug.com/i/c/k/clear.gif	36	59	2	15	Saturday	Partly Cloudy	partlycloudy	http://icons-ak.wxug.com/i/c/k/partlycloudy.gif	39	54	4	12	Sunday	Overcast	cloudy	http://icons-ak.wxug.com/i/c/k/cloudy.gif	46	63	8	17	Monday	Mostly Cloudy	mostlycloudy	http://icons-ak.wxug.com/i/c/k/mostlycloudy.gif	46	61	8	16	1
5	Singapore	1	Singapore, Singapore	\N	Friday	Mostly Cloudy	mostlycloudy	http://icons-ak.wxug.com/i/c/k/mostlycloudy.gif	81	90	27	32	Saturday	Thunderstorm	tstorms	http://icons-ak.wxug.com/i/c/k/tstorms.gif	79	90	26	32	Sunday	Chance of a Thunderstorm	chancetstorms	http://icons-ak.wxug.com/i/c/k/chancetstorms.gif	81	90	27	32	Monday	Chance of a Thunderstorm	mostlycloudy	http://icons-ak.wxug.com/i/c/k/mostlycloudy.gif	81	88	27	31	1
7	Tokyo	0	Tokyo, Japan	\N	Friday	Partly Cloudy	partlycloudy	http://icons-ak.wxug.com/i/c/k/partlycloudy.gif	55	68	13	20	Saturday	Clear	clear	http://icons-ak.wxug.com/i/c/k/clear.gif	55	68	13	20	Sunday	Mostly Cloudy	mostlycloudy	http://icons-ak.wxug.com/i/c/k/mostlycloudy.gif	57	66	14	19	Monday	Mostly Cloudy	mostlycloudy	http://icons-ak.wxug.com/i/c/k/mostlycloudy.gif	57	66	14	19	1
6	Sydney	0	Sydney, New South Wales	\N	Thursday	Clear	clear	http://icons.wxug.com/i/c/k/clear.gif	51	69	11	20	Friday	Partly Cloudy	partlycloudy	http://icons.wxug.com/i/c/k/partlycloudy.gif	57	69	14	21	Saturday	Chance of Rain	chancerain	http://icons.wxug.com/i/c/k/chancerain.gif	48	66	9	19	Sunday	Clear	clear	http://icons.wxug.com/i/c/k/clear.gif	51	63	11	17	1
9	Beijing	1	Beijing, Beijing	\N	Friday	Mostly Cloudy	mostlycloudy	http://icons-ak.wxug.com/i/c/k/mostlycloudy.gif	54	81	12	27	Saturday	Mostly Cloudy	mostlycloudy	http://icons-ak.wxug.com/i/c/k/mostlycloudy.gif	52	68	11	20	Sunday	Partly Cloudy	partlycloudy	http://icons-ak.wxug.com/i/c/k/partlycloudy.gif	52	77	11	25	Monday	Clear	clear	http://icons-ak.wxug.com/i/c/k/clear.gif	50	82	10	28	1
10	Hong Kong	1	Hong Kong, Hong Kong	\N	Friday	Chance of a Thunderstorm	chancetstorms	http://icons-ak.wxug.com/i/c/k/chancetstorms.gif	75	82	24	28	Saturday	Chance of Rain	chancerain	http://icons-ak.wxug.com/i/c/k/chancerain.gif	75	82	24	28	Sunday	Mostly Cloudy	mostlycloudy	http://icons-ak.wxug.com/i/c/k/mostlycloudy.gif	75	84	24	29	Monday	Chance of a Thunderstorm	chancetstorms	http://icons-ak.wxug.com/i/c/k/chancetstorms.gif	73	84	23	29	1
1	New York	0	New York, NY	\N	Thursday	Chance of Rain	chancerain	http://icons.wxug.com/i/c/k/chancerain.gif	67	74	19	23	Friday	Thunderstorm	tstorms	http://icons.wxug.com/i/c/k/tstorms.gif	66	80	19	27	Saturday	Partly Cloudy	partlycloudy	http://icons.wxug.com/i/c/k/partlycloudy.gif	60	77	16	25	Sunday	Clear	clear	http://icons.wxug.com/i/c/k/clear.gif	62	79	17	26	1
4	Surabaya	1	Surabaya, Indonesia	\N	Thursday	Chance of a Thunderstorm	chancetstorms	http://icons.wxug.com/i/c/k/chancetstorms.gif	78	88	26	31	Friday	Clear	clear	http://icons.wxug.com/i/c/k/clear.gif	79	85	26	29	Saturday	Clear	clear	http://icons.wxug.com/i/c/k/clear.gif	79	85	26	29	Sunday	Chance of Rain	chancerain	http://icons.wxug.com/i/c/k/chancerain.gif	80	85	27	29	1
2	Jakarta	1	Jakarta, Indonesia	\N	Tuesday	Rain	rain	http://icons.wxug.com/i/c/k/rain.gif	76	90	24	32	Wednesday	Clear	clear	http://icons.wxug.com/i/c/k/clear.gif	76	94	24	34	Thursday	Clear	clear	http://icons.wxug.com/i/c/k/clear.gif	75	94	24	34	Friday	Chance of a Thunderstorm	chancetstorms	http://icons.wxug.com/i/c/k/chancetstorms.gif	76	93	24	34	1
3	Kuta	1	Denpasar, Indonesia	\N	Thursday	Chance of Rain	cloudy	http://icons.wxug.com/i/c/k/chancerain.gif	78	86	26	29	Friday	Partly Cloudy	partlycloudy	http://icons.wxug.com/i/c/k/partlycloudy.gif	78	83	26	28	Saturday	Partly Cloudy	partlycloudy	http://icons.wxug.com/i/c/k/partlycloudy.gif	79	83	26	28	Sunday	Partly Cloudy	partlycloudy	http://icons.wxug.com/i/c/k/partlycloudy.gif	78	84	26	29	1
\.


--
-- Name: weather_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('weather_seq', 11, true);


--
-- Data for Name: whatson; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY whatson (whatson_id, whatson_image, whatson_image_enabled, whatson_clip, whatson_clip_enabled, whatson_enabled, whatson_order) FROM stdin;
8	FULL_PAGE_weekly_activity	0		0	1	1
1	FULL_PAGE_Monday_sunrise_yoga	0		0	1	2
2	FULL_PAGE_cycling_tour	0		0	1	3
3	FULL_PAGE_powerwalking	0		0	1	4
4	FULL_PAGE_waterpolo	0		0	1	5
5	FULL_PAGE_aquaerobic	0		0	1	6
6	FULL_PAGE_boccaball	0		0	1	7
7	FULL_PAGE_volleyball	0		0	1	8
\.


--
-- Name: whatson_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('whatson_seq', 8, true);


--
-- Data for Name: whatson_translations; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY whatson_translations (translation_id, whatson_id, language_id, translation_title, translation_description) FROM stdin;
1	1	  		
2	1	  		
4	1	  		
7	1	  		
8	1	  		
10	1	  		
11	1	  		
6	1	jp	何がです	
12	1	  		
13	1	  		
15	2	  		
17	2	  		
20	2	  		
21	2	  		
23	3	  		
25	3	  		
28	3	  		
29	3	  		
31	4	  		
33	4	  		
36	4	  		
37	4	  		
38	3	  		
39	3	  		
27	3	jp		
40	3	  		
41	3	  		
42	4	  		
43	4	  		
35	4	jp		
44	4	  		
45	4	  		
46	2	  		
47	2	  		
19	2	jp	何がです	
48	2	  		
49	2	  		
50	1	  		
51	1	  		
92	6	  		
52	1	  		
54	3	  		
93	6	  		
73	6	kr		
56	2	  		
58	4	  		
94	8	  		
83	8	kr		
60	1	  		
95	7	  		
78	7	kr		
61	2	  		
79	8	cn	什么是在	
80	8	en	What's On	
81	8	id	What's On	
96	8	  		
62	3	  		
97	8	  		
9	1	cn	什么是在	
3	1	en	What's On	
5	1	id	What's On	
63	4	  		
98	1	  		
67	5	  		
72	6	  		
77	7	  		
82	8	  		
99	1	  		
14	2	cn	什么是在	
16	2	en	What's On	
84	1	  		
18	2	id	What's On	
85	1	  		
53	1	kr		
86	2	  		
57	2	kr		
87	3	  		
55	3	kr		
100	2	  		
101	2	  		
22	3	cn		
88	4	  		
24	3	en	What's On	
26	3	id	What's On	
102	3	  		
103	3	  		
89	4	  		
30	4	cn	什么是在	
90	4	  		
59	4	kr		
91	5	  		
68	5	kr		
32	4	en	What's On	
34	4	id	What's On	
104	4	  		
105	4	  		
64	5	cn	什么是在	
65	5	en	What's On	
66	5	id	What's On	
106	5	  		
107	5	  		
69	6	cn	什么是在	
70	6	en	What's On	
71	6	id	What's On	
108	6	  		
109	6	  		
74	7	cn	什么是在	
75	7	en	What's On	
76	7	id	What's On	
110	7	  		
111	7	  		
\.


--
-- Name: whatson_translations_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('whatson_translations_translation_id_seq', 111, true);


--
-- Data for Name: zones; Type: TABLE DATA; Schema: public; Owner: navicom
--

COPY zones (zone_id, zone_name, zone_description, zone_enabled) FROM stdin;
12	Adit	Adit	0
6	Deluxe Lantai 2	Deluxe Lantai 2	1
7	Deluxe Lantai 3	Deluxe Lantai 3	1
8	Deluxe Lantai 5	Deluxe Lantai 5	1
1	Premiere Lantai 1	Premiere Lantai 1	1
2	Premiere Lantai 2	Premiere Lantai 2	1
3	Premiere Lantai 3	Premiere Lantai 3	1
4	Premiere Lantai 5	Premiere Lantai 5	1
10	Public Area	Public Area	1
9	Villa	Villa	1
11	Villa Suite	Villa Suite	1
5	Deluxe Lantai 1	Deluxe Lantai 1	1
\.


--
-- Name: zones_zone_id_seq; Type: SEQUENCE SET; Schema: public; Owner: navicom
--

SELECT pg_catalog.setval('zones_zone_id_seq', 12, true);


--
-- Name: Tabletv_channel_group_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY tv_channel_group_translations
    ADD CONSTRAINT "Tabletv_channel_group_translations_pkey" PRIMARY KEY (translation_id);


--
-- Name: ads_counter_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY ads_counter
    ADD CONSTRAINT ads_counter_pkey PRIMARY KEY (ads_counter_id);


--
-- Name: ads_locations_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY ads_locations
    ADD CONSTRAINT ads_locations_pkey PRIMARY KEY (ads_location_id);


--
-- Name: ads_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY ads
    ADD CONSTRAINT ads_pkey PRIMARY KEY (ads_id);


--
-- Name: airport_fids_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY airport_fids
    ADD CONSTRAINT airport_fids_pkey PRIMARY KEY (fids_id);


--
-- Name: airports_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY airports
    ADD CONSTRAINT airports_pkey PRIMARY KEY (airport_id);


--
-- Name: browsers_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY browsers
    ADD CONSTRAINT browsers_pkey PRIMARY KEY (browsers_id);


--
-- Name: business_center_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY business_center_translations
    ADD CONSTRAINT business_center_translations_pkey PRIMARY KEY (translation_id);


--
-- Name: business_centers_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY business_centers
    ADD CONSTRAINT business_centers_pkey PRIMARY KEY (business_centers_id);


--
-- Name: car_rental_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY car_rental_translations
    ADD CONSTRAINT car_rental_translations_pkey PRIMARY KEY (translation_id);


--
-- Name: car_rentals_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY car_rentals
    ADD CONSTRAINT car_rentals_pkey PRIMARY KEY (car_rentals_id);


--
-- Name: contactus_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY contactus
    ADD CONSTRAINT contactus_pkey PRIMARY KEY (contactus_id);


--
-- Name: contactus_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY contactus_translations
    ADD CONSTRAINT contactus_translations_pkey PRIMARY KEY (translation_id);


--
-- Name: dining_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY dining_translations
    ADD CONSTRAINT dining_translations_pkey PRIMARY KEY (translation_id);


--
-- Name: guest_groups_detail_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY guest_groups_detail
    ADD CONSTRAINT guest_groups_detail_pkey PRIMARY KEY (guest_groups_detail_id);


--
-- Name: guest_groups_info_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY guest_groups_info
    ADD CONSTRAINT guest_groups_info_pkey PRIMARY KEY (guest_groups_info_id);


--
-- Name: hotspots_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY hotspots
    ADD CONSTRAINT hotspots_pkey PRIMARY KEY (hotspot_id);


--
-- Name: interest_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY interest_translations
    ADD CONSTRAINT interest_translations_pkey PRIMARY KEY (translation_id);


--
-- Name: interests_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY interests
    ADD CONSTRAINT interests_pkey PRIMARY KEY (interest_id);


--
-- Name: massage_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY massage_translations
    ADD CONSTRAINT massage_translations_pkey PRIMARY KEY (translation_id);


--
-- Name: massages_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY massages
    ADD CONSTRAINT massages_pkey PRIMARY KEY (massage_id);


--
-- Name: popup_promo_schedule_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY popup_promo_schedule
    ADD CONSTRAINT popup_promo_schedule_pkey PRIMARY KEY (popup_schedule_id);


--
-- Name: popup_promos_pkey; Type: CONSTRAINT; Schema: public; Owner: navicom; Tablespace: 
--

ALTER TABLE ONLY popup_promos
    ADD CONSTRAINT popup_promos_pkey PRIMARY KEY (popup_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

