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
    id character(50) NOT NULL,
    purchase character(50) NOT NULL
);


ALTER TABLE public.bill OWNER TO postgres;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    code character(50) NOT NULL,
    name character(50) NOT NULL,
    status character(50) NOT NULL
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- Name: images; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.images (
    id character(50) NOT NULL,
    product character(50) NOT NULL,
    route character(200) NOT NULL,
    perspectives character(50) NOT NULL
);


ALTER TABLE public.images OWNER TO postgres;

--
-- Name: incart; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.incart (
    product character(50) NOT NULL,
    shop character(50) NOT NULL,
    amount character(50) NOT NULL,
    id character(50) NOT NULL
);


ALTER TABLE public.incart OWNER TO postgres;

--
-- Name: notifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notifications (
    id character(50) NOT NULL,
    useremail character(50) NOT NULL,
    message character(50) NOT NULL,
    title character(50) NOT NULL
);


ALTER TABLE public.notifications OWNER TO postgres;

--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    code character(50) NOT NULL,
    name character(50) NOT NULL,
    description character(200),
    codecategory character(50),
    price integer NOT NULL,
    stock integer NOT NULL,
    size integer NOT NULL,
    sold integer NOT NULL,
    status character(50) NOT NULL
);


ALTER TABLE public.products OWNER TO postgres;

--
-- Name: shopping; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.shopping (
    id character(50) NOT NULL,
    useremail character(50) NOT NULL,
    price integer,
    status character varying(20) NOT NULL,
    datepurchase date,
    dateend date,
    CONSTRAINT check_shopping_status CHECK (((status)::text = ANY (ARRAY[('pending'::character varying)::text, ('shipped'::character varying)::text, ('cart'::character varying)::text])))
);


ALTER TABLE public.shopping OWNER TO postgres;

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
    signature character(50),
    image character(50),
    CONSTRAINT users_rol_check CHECK (((rol)::text = ANY (ARRAY[('admin'::character varying)::text, ('customer'::character varying)::text])))
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: wishlist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.wishlist (
    useremail character varying(255) NOT NULL,
    productcode character varying(255) NOT NULL
);


ALTER TABLE public.wishlist OWNER TO postgres;

--
-- Data for Name: bill; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bill (id, purchase) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (code, name, status) FROM stdin;
1                                                 	zapatos                                           	enabled                                           
2                                                 	sandalias                                         	enabled                                           
\.


--
-- Data for Name: images; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.images (id, product, route, perspectives) FROM stdin;
\.


--
-- Data for Name: incart; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.incart (product, shop, amount, id) FROM stdin;
PROD-UCT1                                         	1                                                 	1                                                 	1                                                 
PROD-UCT2                                         	1                                                 	1                                                 	2                                                 
PROD-UCT3                                         	2                                                 	1                                                 	3                                                 
PROD-UCT4                                         	2                                                 	1                                                 	4                                                 
PROD-UCT5                                         	2                                                 	1                                                 	5                                                 
PROD-UCT6                                         	2                                                 	1                                                 	6                                                 
\.


--
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notifications (id, useremail, message, title) FROM stdin;
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (code, name, description, codecategory, price, stock, size, sold, status) FROM stdin;
PROD-UCT1                                         	prod1                                             	asdfasdf                                                                                                                                                                                                	1                                                 	50	10	10	2	enabled                                           
PROD-UCT2                                         	prod2                                             	asdfasdf                                                                                                                                                                                                	2                                                 	50	10	10	2	enabled                                           
PROD-UCT3                                         	prod3                                             	asdfasdf                                                                                                                                                                                                	1                                                 	25	10	10	2	enabled                                           
PROD-UCT4                                         	prod4                                             	asdfasdf                                                                                                                                                                                                	2                                                 	25	10	10	2	enabled                                           
PROD-UCT5                                         	prod5                                             	asdfasdf                                                                                                                                                                                                	1                                                 	25	10	10	2	enabled                                           
PROD-UCT6                                         	prod6                                             	asdfasdf                                                                                                                                                                                                	2                                                 	25	10	10	2	enabled                                           
\.


--
-- Data for Name: shopping; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.shopping (id, useremail, price, status, datepurchase, dateend) FROM stdin;
1                                                 	alex.alcala@inslapineda.cat                       	100	pending	2023-12-04	\N
2                                                 	customer@test.com                                 	100	pending	2023-12-04	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (email, phone, name, surnames, address, rol, password, signature, image) FROM stdin;
admin@gmail.com                                   	\N	Admin                                             	Istrator                                          	\N	admin	81dc9bdb52d04dc20036dbd8313ed055                                                                                                                                                                        	\N	\N
alex.alcala@inslapineda.cat                       	123456789	Alex                                              	Alcala Garcia                                     	\N	customer	password                                                                                                                                                                                                	\N	\N
customer@test.com                                 	123456789	customer                                          	test                                              	Carrer de la vila                                 	customer	password                                                                                                                                                                                                	\N	\N
\.


--
-- Data for Name: wishlist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.wishlist (useremail, productcode) FROM stdin;
\.


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
-- Name: images images_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.images
    ADD CONSTRAINT images_pkey PRIMARY KEY (id);


--
-- Name: incart incart_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incart
    ADD CONSTRAINT incart_pkey PRIMARY KEY (id);


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
-- Name: incart incart_product_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incart
    ADD CONSTRAINT incart_product_fkey FOREIGN KEY (product) REFERENCES public.products(code) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: incart incart_shop_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incart
    ADD CONSTRAINT incart_shop_fkey FOREIGN KEY (shop) REFERENCES public.shopping(id) ON UPDATE CASCADE ON DELETE CASCADE;


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

