--
-- PostgreSQL database dump
--

-- Dumped from database version 16.0
-- Dumped by pg_dump version 16.0

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
-- Name: bill; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bill (
    id integer NOT NULL,
    purchase integer NOT NULL
);


ALTER TABLE public.bill OWNER TO postgres;

--
-- Name: bill_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bill_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.bill_id_seq OWNER TO postgres;

--
-- Name: bill_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bill_id_seq OWNED BY public.bill.id;


--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    code integer NOT NULL,
    name character(50) NOT NULL,
    status character varying(10) NOT NULL,
    CONSTRAINT categories_status_check CHECK (((status)::text = ANY ((ARRAY['enabled'::character varying, 'disabled'::character varying])::text[])))
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- Name: categories_code_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categories_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_code_seq OWNER TO postgres;

--
-- Name: categories_code_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categories_code_seq OWNED BY public.categories.code;


--
-- Name: discountcodes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.discountcodes (
    id integer NOT NULL,
    code character(50) NOT NULL,
    discount integer NOT NULL,
    dateexpiration date NOT NULL
);


ALTER TABLE public.discountcodes OWNER TO postgres;

--
-- Name: discountcodes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.discountcodes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.discountcodes_id_seq OWNER TO postgres;

--
-- Name: discountcodes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.discountcodes_id_seq OWNED BY public.discountcodes.id;


--
-- Name: images; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.images (
    id integer NOT NULL,
    product character(50) NOT NULL,
    route character(200) NOT NULL,
    perspectives character varying(50) NOT NULL,
    color character(50) NOT NULL,
    CONSTRAINT images_perspectives_check CHECK (((perspectives)::text = ANY ((ARRAY['lateralperspective'::character varying, 'aboveperspective'::character varying, 'belowperspective'::character varying, '3dmodel'::character varying])::text[])))
);


ALTER TABLE public.images OWNER TO postgres;

--
-- Name: images_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.images_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.images_id_seq OWNER TO postgres;

--
-- Name: images_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.images_id_seq OWNED BY public.images.id;


--
-- Name: incart; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.incart (
    shop integer NOT NULL,
    product character(200) NOT NULL,
    amount integer NOT NULL
);


ALTER TABLE public.incart OWNER TO postgres;

--
-- Name: notifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notifications (
    id integer NOT NULL,
    useremail character(50) NOT NULL,
    message character(50) NOT NULL,
    title character(50) NOT NULL
);


ALTER TABLE public.notifications OWNER TO postgres;

--
-- Name: notifications_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.notifications_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.notifications_id_seq OWNER TO postgres;

--
-- Name: notifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.notifications_id_seq OWNED BY public.notifications.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    code character(200) NOT NULL,
    name character(50) NOT NULL,
    description character(200) NOT NULL,
    codecategory integer NOT NULL,
    price numeric(10,2) NOT NULL,
    stock integer NOT NULL,
    sold integer NOT NULL,
    status character varying(10) NOT NULL,
    size numeric(10,1) NOT NULL,
    featured boolean,
    CONSTRAINT products_status_check CHECK (((status)::text = ANY ((ARRAY['enabled'::character varying, 'disabled'::character varying])::text[])))
);


ALTER TABLE public.products OWNER TO postgres;

--
-- Name: shippingmethod; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.shippingmethod (
    id integer NOT NULL,
    name character(50) NOT NULL,
    price numeric(10,2) NOT NULL
);


ALTER TABLE public.shippingmethod OWNER TO postgres;

--
-- Name: shippingmethod_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.shippingmethod_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.shippingmethod_id_seq OWNER TO postgres;

--
-- Name: shippingmethod_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.shippingmethod_id_seq OWNED BY public.shippingmethod.id;


--
-- Name: shopping; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.shopping (
    id integer NOT NULL,
    useremail character(50) NOT NULL,
    price integer,
    datepurchase date,
    dateend date,
    status character varying(10),
    CONSTRAINT shopping_status_check CHECK (((status)::text = ANY ((ARRAY['cart'::character varying, 'shipped'::character varying, 'pending'::character varying])::text[])))
);


ALTER TABLE public.shopping OWNER TO postgres;

--
-- Name: shopping_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.shopping_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.shopping_id_seq OWNER TO postgres;

--
-- Name: shopping_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.shopping_id_seq OWNED BY public.shopping.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    email character(50) NOT NULL,
    phone integer,
    name character(50) NOT NULL,
    surnames character(50) NOT NULL,
    address character(50),
    rol character varying(20) NOT NULL,
    password character(200) NOT NULL,
    signature character(200),
    image character(200),
    CONSTRAINT users_rol_check CHECK (((rol)::text = ANY ((ARRAY['admin'::character varying, 'customer'::character varying])::text[])))
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: wishlist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.wishlist (
    useremail character(255) NOT NULL,
    productcode character(255) NOT NULL
);


ALTER TABLE public.wishlist OWNER TO postgres;

--
-- Name: bill id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bill ALTER COLUMN id SET DEFAULT nextval('public.bill_id_seq'::regclass);


--
-- Name: categories code; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN code SET DEFAULT nextval('public.categories_code_seq'::regclass);


--
-- Name: discountcodes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.discountcodes ALTER COLUMN id SET DEFAULT nextval('public.discountcodes_id_seq'::regclass);


--
-- Name: images id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.images ALTER COLUMN id SET DEFAULT nextval('public.images_id_seq'::regclass);


--
-- Name: notifications id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notifications ALTER COLUMN id SET DEFAULT nextval('public.notifications_id_seq'::regclass);


--
-- Name: shippingmethod id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.shippingmethod ALTER COLUMN id SET DEFAULT nextval('public.shippingmethod_id_seq'::regclass);


--
-- Name: shopping id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.shopping ALTER COLUMN id SET DEFAULT nextval('public.shopping_id_seq'::regclass);


--
-- Data for Name: bill; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bill (id, purchase) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (code, name, status) FROM stdin;
1	zapatos                                           	enabled
2	sandalias                                         	enabled
4	deportivas                                        	enabled
5	elegantes                                         	enabled
6	simples                                           	enabled
7	botas                                             	enabled
8	heels                                             	enabled
9	sandals                                           	enabled
10	sneakers                                          	enabled
11	man                                               	enabled
12	woman                                             	enabled
13	kid                                               	enabled
\.


--
-- Data for Name: discountcodes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.discountcodes (id, code, discount, dateexpiration) FROM stdin;
\.


--
-- Data for Name: images; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.images (id, product, route, perspectives, color) FROM stdin;
\.


--
-- Data for Name: incart; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.incart (shop, product, amount) FROM stdin;
1	PROD-UCT1                                                                                                                                                                                               	5
1	PROD-UCT2                                                                                                                                                                                               	5
2	PROD-UCT3                                                                                                                                                                                               	10
2	PROD-UCT4                                                                                                                                                                                               	10
2	PROD-UCT5                                                                                                                                                                                               	10
2	PROD-UCT6                                                                                                                                                                                               	10
\.


--
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notifications (id, useremail, message, title) FROM stdin;
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (code, name, description, codecategory, price, stock, sold, status, size, featured) FROM stdin;
za123-za                                                                                                                                                                                                	zapatos PREMIUM                                   	zapatos muy comodos                                                                                                                                                                                     	1	25.00	10	102	enabled	42.0	f
za321-za                                                                                                                                                                                                	zapatos LIMITED                                   	zapatos muy incomodos                                                                                                                                                                                   	1	30.00	20	100	enabled	41.0	f
sa789-sa                                                                                                                                                                                                	sandalias PREMIUM                                 	sandalias muy comodos                                                                                                                                                                                   	2	35.00	10	99	enabled	43.0	f
sa987-sa                                                                                                                                                                                                	sandalias LIMITED                                 	sandalias muy incomodos                                                                                                                                                                                 	2	30.00	20	100	enabled	41.0	f
de789-ba                                                                                                                                                                                                	bambas PREMIUM                                    	bambas muy comodas                                                                                                                                                                                      	4	45.00	10	99	enabled	41.0	f
de835-ba                                                                                                                                                                                                	bambas LIMITED                                    	bambas muy incomodas                                                                                                                                                                                    	4	45.00	20	100	enabled	42.0	f
el826-za                                                                                                                                                                                                	zapatos elegantes PREMIUM                         	zapatos elegantes muy comodas                                                                                                                                                                           	5	50.00	10	99	enabled	44.0	f
el917-za                                                                                                                                                                                                	zapatos LIMITED                                   	zapatos elegantes muy incomodas                                                                                                                                                                         	5	45.00	20	100	enabled	43.0	f
si989-za                                                                                                                                                                                                	zapatos simples PREMIUM                           	zapatos simples muy comodas                                                                                                                                                                             	6	20.00	10	99	enabled	43.0	f
si911-za                                                                                                                                                                                                	zapatos simples LIMITED                           	zapatos simples muy incomodas                                                                                                                                                                           	6	15.00	20	100	enabled	42.0	f
bo110-bo                                                                                                                                                                                                	botas PREMIUM                                     	botas muy comodas                                                                                                                                                                                       	7	30.00	10	99	enabled	42.0	f
bo911-bo                                                                                                                                                                                                	botas LIMITED                                     	botas muy incomodas                                                                                                                                                                                     	7	35.00	20	100	enabled	42.0	f
he224-ta                                                                                                                                                                                                	tacones PREMIUM                                   	tacones muy comodas                                                                                                                                                                                     	8	33.00	10	99	enabled	42.0	f
he236-ta                                                                                                                                                                                                	tacones LIMITED                                   	tacones muy incomodas                                                                                                                                                                                   	8	35.00	20	100	enabled	40.0	f
sa457-sa                                                                                                                                                                                                	sandalias PREMIUM                                 	sandalias muy comodas                                                                                                                                                                                   	9	32.00	10	99	enabled	41.0	f
sa231-sa                                                                                                                                                                                                	sandalias LIMITED                                 	sandalias muy incomodas                                                                                                                                                                                 	9	30.00	20	100	enabled	41.0	f
sn901-za                                                                                                                                                                                                	zapatillas PREMIUM                                	zapatillas muy comodas                                                                                                                                                                                  	10	30.00	15	99	enabled	42.0	f
sn980-za                                                                                                                                                                                                	zapatillas LIMITED                                	zapatillas muy incomodas                                                                                                                                                                                	10	30.00	20	100	enabled	41.0	f
ma901-za                                                                                                                                                                                                	zapatos de hombre PREMIUM                         	zapatos de hombre muy comodas                                                                                                                                                                           	11	30.00	15	99	enabled	42.0	f
ma980-za                                                                                                                                                                                                	zapatos de hombre LIMITED                         	zapatos de hombre muy incomodas                                                                                                                                                                         	11	30.00	20	100	enabled	41.0	f
wo901-za                                                                                                                                                                                                	zapatos de mujer PREMIUM                          	zapatos de mujer muy comodas                                                                                                                                                                            	12	30.00	15	99	enabled	42.0	f
wo124-za                                                                                                                                                                                                	zapatos de mujer LIMITED                          	zapatos de mujer muy incomodas                                                                                                                                                                          	12	30.00	20	100	enabled	41.0	f
ki919-za                                                                                                                                                                                                	zapatos para crios PREMIUM                        	zapatos de crios muy comodas                                                                                                                                                                            	13	30.00	15	99	enabled	42.0	f
ki190-za                                                                                                                                                                                                	zapatos de crios LIMITED                          	zapatos de crios muy incomodas                                                                                                                                                                          	13	30.00	20	100	enabled	41.0	f
\.


--
-- Data for Name: shippingmethod; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.shippingmethod (id, name, price) FROM stdin;
\.


--
-- Data for Name: shopping; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.shopping (id, useremail, price, datepurchase, dateend, status) FROM stdin;
1	alex.alcala@inslapineda.cat                       	100	\N	\N	pending
2	customer@gmail.com                                	100	\N	\N	pending
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (email, phone, name, surnames, address, rol, password, signature, image) FROM stdin;
alex.alcala@inslapineda.cat                       	123456789	alex                                              	alcala garcia                                     	calle berenjena                                   	customer	1234                                                                                                                                                                                                    	\N	\N
customer@gmail.com                                	124456789	custo                                             	mer                                               	\N	customer	1234                                                                                                                                                                                                    	\N	\N
\.


--
-- Data for Name: wishlist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.wishlist (useremail, productcode) FROM stdin;
\.


--
-- Name: bill_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bill_id_seq', 1, false);


--
-- Name: categories_code_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_code_seq', 13, true);


--
-- Name: discountcodes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.discountcodes_id_seq', 1, false);


--
-- Name: images_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.images_id_seq', 1, false);


--
-- Name: notifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.notifications_id_seq', 1, false);


--
-- Name: shippingmethod_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.shippingmethod_id_seq', 1, false);


--
-- Name: shopping_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.shopping_id_seq', 2, true);


--
-- Name: bill bill_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bill
    ADD CONSTRAINT bill_pkey PRIMARY KEY (id);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (code);


--
-- Name: discountcodes discountcodes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.discountcodes
    ADD CONSTRAINT discountcodes_pkey PRIMARY KEY (id);


--
-- Name: images images_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.images
    ADD CONSTRAINT images_pkey PRIMARY KEY (id);


--
-- Name: incart incart_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incart
    ADD CONSTRAINT incart_pkey PRIMARY KEY (shop, product);


--
-- Name: notifications notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (code);


--
-- Name: shippingmethod shippingmethod_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.shippingmethod
    ADD CONSTRAINT shippingmethod_pkey PRIMARY KEY (id);


--
-- Name: shopping shopping_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (email);


--
-- Name: wishlist wishlist_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wishlist
    ADD CONSTRAINT wishlist_pkey PRIMARY KEY (useremail, productcode);


--
-- Name: bill bill_purchase_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bill
    ADD CONSTRAINT bill_purchase_fkey FOREIGN KEY (purchase) REFERENCES public.shopping(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: images images_product_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.images
    ADD CONSTRAINT images_product_fkey FOREIGN KEY (product) REFERENCES public.products(code) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: notifications notifications_useremail_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_useremail_fkey FOREIGN KEY (useremail) REFERENCES public.users(email) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: products products_codecategory_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_codecategory_fkey FOREIGN KEY (codecategory) REFERENCES public.categories(code) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: shopping shopping_useremail_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_useremail_fkey FOREIGN KEY (useremail) REFERENCES public.users(email) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: wishlist wishlist_productcode_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wishlist
    ADD CONSTRAINT wishlist_productcode_fkey FOREIGN KEY (productcode) REFERENCES public.products(code) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: wishlist wishlist_useremail_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.wishlist
    ADD CONSTRAINT wishlist_useremail_fkey FOREIGN KEY (useremail) REFERENCES public.users(email) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

