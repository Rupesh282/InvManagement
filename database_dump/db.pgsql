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
-- Name: bill_book; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bill_book (
    bill_id integer NOT NULL,
    contact_no character varying,
    net_discount double precision DEFAULT 0,
    total_payment money NOT NULL,
    total_tax double precision DEFAULT 0 NOT NULL,
    datetime timestamp without time zone NOT NULL
);


ALTER TABLE public.bill_book OWNER TO postgres;

--
-- Name: bill_book_bill_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bill_book_bill_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bill_book_bill_id_seq OWNER TO postgres;

--
-- Name: bill_book_bill_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bill_book_bill_id_seq OWNED BY public.bill_book.bill_id;


--
-- Name: category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.category (
    category_id integer NOT NULL,
    category_name character varying(100) NOT NULL
);


ALTER TABLE public.category OWNER TO postgres;

--
-- Name: category_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.category_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.category_category_id_seq OWNER TO postgres;

--
-- Name: category_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.category_category_id_seq OWNED BY public.category.category_id;


--
-- Name: customer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.customer (
    contact_no character varying(20) NOT NULL,
    first_name character varying(100) NOT NULL,
    last_name character varying(100)
);


ALTER TABLE public.customer OWNER TO postgres;

--
-- Name: dealers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dealers (
    dealer_id integer NOT NULL,
    dealer_name character varying(100) NOT NULL,
    dealer_contact_no character varying(20)
);


ALTER TABLE public.dealers OWNER TO postgres;

--
-- Name: dealers_dealer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dealers_dealer_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dealers_dealer_id_seq OWNER TO postgres;

--
-- Name: dealers_dealer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dealers_dealer_id_seq OWNED BY public.dealers.dealer_id;


--
-- Name: employee; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employee (
    employee_id integer NOT NULL,
    employee_password character varying(100) NOT NULL,
    first_name character varying(100) NOT NULL,
    last_name character varying(100),
    contact_no character varying(100),
    access_type character varying(100) NOT NULL
);


ALTER TABLE public.employee OWNER TO postgres;

--
-- Name: employee_employee_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.employee_employee_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employee_employee_id_seq OWNER TO postgres;

--
-- Name: employee_employee_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.employee_employee_id_seq OWNED BY public.employee.employee_id;


--
-- Name: inventory; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.inventory (
    item_id integer NOT NULL,
    item_name character varying NOT NULL,
    category_id integer,
    item_price money NOT NULL,
    item_quantity integer NOT NULL,
    item_discount double precision DEFAULT 0,
    item_tax double precision DEFAULT 0
);


ALTER TABLE public.inventory OWNER TO postgres;

--
-- Name: inventory_item_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.inventory_item_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inventory_item_id_seq OWNER TO postgres;

--
-- Name: inventory_item_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.inventory_item_id_seq OWNED BY public.inventory.item_id;


--
-- Name: purchase_book; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.purchase_book (
    purchase_id integer NOT NULL,
    dealer_id integer,
    net_payment money NOT NULL,
    datetime timestamp without time zone NOT NULL
);


ALTER TABLE public.purchase_book OWNER TO postgres;

--
-- Name: purchase_book_purchase_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.purchase_book_purchase_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.purchase_book_purchase_id_seq OWNER TO postgres;

--
-- Name: purchase_book_purchase_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.purchase_book_purchase_id_seq OWNED BY public.purchase_book.purchase_id;


--
-- Name: purchased_items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.purchased_items (
    purchase_id integer,
    item_id integer,
    item_name character varying NOT NULL,
    item_base_price money NOT NULL,
    item_quantity integer
);


ALTER TABLE public.purchased_items OWNER TO postgres;

--
-- Name: taxes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.taxes (
    tax_name character varying NOT NULL,
    tax_percent double precision NOT NULL
);


ALTER TABLE public.taxes OWNER TO postgres;

--
-- Name: bill_book bill_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bill_book ALTER COLUMN bill_id SET DEFAULT nextval('public.bill_book_bill_id_seq'::regclass);


--
-- Name: category category_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category ALTER COLUMN category_id SET DEFAULT nextval('public.category_category_id_seq'::regclass);


--
-- Name: dealers dealer_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dealers ALTER COLUMN dealer_id SET DEFAULT nextval('public.dealers_dealer_id_seq'::regclass);


--
-- Name: employee employee_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee ALTER COLUMN employee_id SET DEFAULT nextval('public.employee_employee_id_seq'::regclass);


--
-- Name: inventory item_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventory ALTER COLUMN item_id SET DEFAULT nextval('public.inventory_item_id_seq'::regclass);


--
-- Name: purchase_book purchase_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_book ALTER COLUMN purchase_id SET DEFAULT nextval('public.purchase_book_purchase_id_seq'::regclass);


--
-- Data for Name: accesses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.accesses (access_type) FROM stdin;
owner
manager
cashier
\.


--
-- Data for Name: bill_book; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bill_book (bill_id, contact_no, net_discount, total_payment, total_tax, datetime) FROM stdin;
3	123123	0.02	₹3,045.00	0.2	2017-03-14 00:00:00
4	99999	0.02	₹9,045.00	0.2	2018-03-14 00:00:00
5	99999	0.02	₹4,045.00	0.2	2017-04-24 00:00:00
\.


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.category (category_id, category_name) FROM stdin;
5	shampoo
6	bread
7	Bakery
8	Novelty
9	Dairy
10	Households
\.


--
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.customer (contact_no, first_name, last_name) FROM stdin;
123123	rupesh	kalantre
99999	mark	kalantre
9370333926	joseph	
\.


--
-- Data for Name: dealers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dealers (dealer_id, dealer_name, dealer_contact_no) FROM stdin;
5	Nick	4561237892
6	patrik	4231598456
7	Mickel	7534218961
\.


--
-- Data for Name: employee; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.employee (employee_id, employee_password, first_name, last_name, contact_no, access_type) FROM stdin;
20	123	Davie	\N	\N	owner
22	password	rupesh	kalantre	4545787856	cashier
23	password	Rohan		9638529635	manager
24	password	Rohit		1234124525	cashier
\.


--
-- Data for Name: inventory; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.inventory (item_id, item_name, category_id, item_price, item_quantity, item_discount, item_tax) FROM stdin;
2	Milk200ltr	9	₹200.00	20	0	0
3	Srikhand500g	9	₹399.00	30	0	0
4	Bourbon	7	₹20.00	100	0	0
5	Gooday	7	₹15.00	120	0	0
6	Sai Bread	6	₹10.00	50	0	0
7	Nail Shampoo	5	₹5.00	400	0	0
\.


--
-- Data for Name: purchase_book; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.purchase_book (purchase_id, dealer_id, net_payment, datetime) FROM stdin;
\.


--
-- Data for Name: purchased_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.purchased_items (purchase_id, item_id, item_name, item_base_price, item_quantity) FROM stdin;
\.


--
-- Data for Name: taxes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.taxes (tax_name, tax_percent) FROM stdin;
GST	0.36
CGST	0.2
\.


--
-- Name: bill_book_bill_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bill_book_bill_id_seq', 5, true);


--
-- Name: category_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.category_category_id_seq', 10, true);


--
-- Name: dealers_dealer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dealers_dealer_id_seq', 7, true);


--
-- Name: employee_employee_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.employee_employee_id_seq', 24, true);


--
-- Name: inventory_item_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.inventory_item_id_seq', 7, true);


--
-- Name: purchase_book_purchase_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.purchase_book_purchase_id_seq', 1, false);


--
-- Name: accesses accesses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accesses
    ADD CONSTRAINT accesses_pkey PRIMARY KEY (access_type);


--
-- Name: bill_book bill_book_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bill_book
    ADD CONSTRAINT bill_book_pkey PRIMARY KEY (bill_id);


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
-- Name: inventory inventory_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventory
    ADD CONSTRAINT inventory_pkey PRIMARY KEY (item_id);


--
-- Name: purchase_book purchase_book_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_book
    ADD CONSTRAINT purchase_book_pkey PRIMARY KEY (purchase_id);


--
-- Name: taxes taxes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxes
    ADD CONSTRAINT taxes_pkey PRIMARY KEY (tax_name);


--
-- Name: bill_book bill_book_contact_no_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bill_book
    ADD CONSTRAINT bill_book_contact_no_fkey FOREIGN KEY (contact_no) REFERENCES public.customer(contact_no);


--
-- Name: employee employee_access_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_access_type_fkey FOREIGN KEY (access_type) REFERENCES public.accesses(access_type);


--
-- Name: inventory inventory_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventory
    ADD CONSTRAINT inventory_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.category(category_id);


--
-- Name: purchase_book purchase_book_dealer_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_book
    ADD CONSTRAINT purchase_book_dealer_id_fkey FOREIGN KEY (dealer_id) REFERENCES public.dealers(dealer_id);


--
-- Name: purchased_items purchased_items_item_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchased_items
    ADD CONSTRAINT purchased_items_item_id_fkey FOREIGN KEY (item_id) REFERENCES public.inventory(item_id);


--
-- Name: purchased_items purchased_items_purchase_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchased_items
    ADD CONSTRAINT purchased_items_purchase_id_fkey FOREIGN KEY (purchase_id) REFERENCES public.purchase_book(purchase_id);


--
-- PostgreSQL database dump complete
--

