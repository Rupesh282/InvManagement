--
-- PostgreSQL database dump
--

-- Dumped from database version 12.5 (Ubuntu 12.5-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.5 (Ubuntu 12.5-0ubuntu0.20.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: accesses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.accesses (
    access_type character varying(100) NOT NULL
);


ALTER TABLE public.accesses OWNER TO postgres;

--
-- Name: category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.category (
    category_id character varying(100) NOT NULL,
    category_name character varying(100) NOT NULL
);


ALTER TABLE public.category OWNER TO postgres;

--
-- Name: customer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.customer (
    contact_no character varying(20) NOT NULL,
    first_name character varying(100),
    last_name character varying(100)
);


ALTER TABLE public.customer OWNER TO postgres;

--
-- Name: dealers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dealers (
    dealer_id character varying(100) NOT NULL,
    dealer_name character varying(100) NOT NULL,
    dealer_contact_no character varying(20)
);


ALTER TABLE public.dealers OWNER TO postgres;

--
-- Name: employee; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employee (
    employee_id character varying(100) NOT NULL,
    employee_password character varying(100),
    first_name character varying(100),
    last_name character varying(100),
    contact_no character varying(100),
    access_type character varying(100)
);


ALTER TABLE public.employee OWNER TO postgres;

--
-- Data for Name: accesses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.accesses (access_type) FROM stdin;
owner
casheir
manager
\.


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.category (category_id, category_name) FROM stdin;
\.


--
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.customer (contact_no, first_name, last_name) FROM stdin;
\.


--
-- Data for Name: dealers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dealers (dealer_id, dealer_name, dealer_contact_no) FROM stdin;
\.


--
-- Data for Name: employee; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.employee (employee_id, employee_password, first_name, last_name, contact_no, access_type) FROM stdin;
1	123	test1	\N	\N	owner
\.


--
-- Name: accesses accesses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accesses
    ADD CONSTRAINT accesses_pkey PRIMARY KEY (access_type);


--
-- Name: category category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (category_id);


--
-- Name: customer customer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customer
    ADD CONSTRAINT customer_pkey PRIMARY KEY (contact_no);


--
-- Name: dealers dealers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dealers
    ADD CONSTRAINT dealers_pkey PRIMARY KEY (dealer_id);


--
-- Name: employee employee_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_pkey PRIMARY KEY (employee_id);


--
-- Name: employee employee_access_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_access_type_fkey FOREIGN KEY (access_type) REFERENCES public.accesses(access_type);


--
-- PostgreSQL database dump complete
--

