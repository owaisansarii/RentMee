--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

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
-- Name: bungalow; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bungalow (
    id integer NOT NULL,
    oid integer NOT NULL,
    no_of_room integer NOT NULL,
    no_of_floor integer NOT NULL,
    no_of_bathroom integer NOT NULL,
    area integer NOT NULL,
    locality character varying(50) NOT NULL,
    address text NOT NULL,
    city character varying(50) NOT NULL,
    rent integer NOT NULL,
    deposit integer NOT NULL,
    negotiable boolean DEFAULT false NOT NULL,
    more text NOT NULL,
    images character varying(80)[] NOT NULL,
    status boolean DEFAULT true
);


ALTER TABLE public.bungalow OWNER TO postgres;

--
-- Name: bungalow_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bungalow_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bungalow_id_seq OWNER TO postgres;

--
-- Name: bungalow_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bungalow_id_seq OWNED BY public.bungalow.id;


--
-- Name: flat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.flat (
    id integer NOT NULL,
    oid integer NOT NULL,
    bhk integer NOT NULL,
    floor integer NOT NULL,
    locality character varying NOT NULL,
    address text NOT NULL,
    city character varying NOT NULL,
    rent integer NOT NULL,
    deposit integer NOT NULL,
    more text NOT NULL,
    balcony boolean DEFAULT false NOT NULL,
    parking boolean DEFAULT false NOT NULL,
    negotiable boolean DEFAULT false NOT NULL,
    images character varying(300)[] NOT NULL,
    status boolean DEFAULT true
);


ALTER TABLE public.flat OWNER TO postgres;

--
-- Name: flat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.flat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.flat_id_seq OWNER TO postgres;

--
-- Name: flat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.flat_id_seq OWNED BY public.flat.id;


--
-- Name: owner; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.owner (
    id integer NOT NULL,
    uid bigint NOT NULL,
    name character varying(50) NOT NULL,
    city character varying(50) NOT NULL,
    phno bigint
);


ALTER TABLE public.owner OWNER TO postgres;

--
-- Name: rowhouse; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rowhouse (
    id integer NOT NULL,
    oid integer NOT NULL,
    no_of_room integer NOT NULL,
    no_of_floor integer NOT NULL,
    no_of_bathroom integer NOT NULL,
    area integer NOT NULL,
    locality character varying(50) NOT NULL,
    address text NOT NULL,
    city character varying(50) NOT NULL,
    rent integer NOT NULL,
    deposit integer NOT NULL,
    balcony boolean DEFAULT false NOT NULL,
    parking boolean DEFAULT false NOT NULL,
    negotiable boolean DEFAULT false NOT NULL,
    more text NOT NULL,
    images character varying(80)[] NOT NULL,
    status boolean DEFAULT true
);


ALTER TABLE public.rowhouse OWNER TO postgres;

--
-- Name: rowhouse_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rowhouse_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rowhouse_id_seq OWNER TO postgres;

--
-- Name: rowhouse_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rowhouse_id_seq OWNED BY public.rowhouse.id;


--
-- Name: tenant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tenant (
    id integer NOT NULL,
    uid bigint NOT NULL,
    name character varying(50) NOT NULL,
    city character varying(50) NOT NULL
);


ALTER TABLE public.tenant OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(50) NOT NULL,
    password character varying(50) NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: bungalow id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bungalow ALTER COLUMN id SET DEFAULT nextval('public.bungalow_id_seq'::regclass);


--
-- Name: flat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.flat ALTER COLUMN id SET DEFAULT nextval('public.flat_id_seq'::regclass);


--
-- Name: rowhouse id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rowhouse ALTER COLUMN id SET DEFAULT nextval('public.rowhouse_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: bungalow; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bungalow (id, oid, no_of_room, no_of_floor, no_of_bathroom, area, locality, address, city, rent, deposit, negotiable, more, images, status) FROM stdin;
4	15	5	1	2	900	Kanchan Bagh	110/05, MHB Colony,Modern Rd	Hyderabad	30000	275000	t	All families will love this apartment in Kanchan Bagh as it has all that you need in a home & more. This 900 sqft & comes with ample dedicated parking area and a small garden. This lovely bungalow for rent is only 30,000 rupees & could be your new home. This home faces the East direction.	{982image_search_1622625143315.jpg,112image_search_1622625463265.jpg,2598image_search_1622626437035.jpg}	t
\.


--
-- Data for Name: flat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.flat (id, oid, bhk, floor, locality, address, city, rent, deposit, more, balcony, parking, negotiable, images, status) FROM stdin;
9	15	3	1	Charminar, Alijah kotla	Kotla Alijah near Alijah Kotla Masjid	Hyderabad	8500	30000	If u are looking for spacious flat then it is available near Charminar ,alijah kotla . Your search for a 3 BHK in Alijah kotla ends here, this home is conveniently located & comes at just 8,500 rupees. This DK facing 1200 sqft. home comes with a convenient parking lot for a bike. If you are looking for an apartment to rent ideal for families, you need to check out this home. This home is on the 1st floor & brings in light & air to the home.	t	t	t	{1634image_search_1622625628813.jpg,3845image_search_1622625642798.jpg,1699image_search_1622626359964.jpg}	t
10	16	4	25	Hebbal	NH 44	Bangalore	25000	150000	Located right on NH 44, Hebbal, Century Ethos enjoys quick connectivity to MG Road and KIA. Century Ethos boasts of spacious residences. Housing one of the largest residential clubhouse of North Bengaluru at 50,000 sq. ft. which is filled with decadent indulgences. From a double height lobby which extends seamlessly to the co-working spaces and the business center, from squash court to an indoor heated swimming pool to a 100-seater banquet hall, this magnificent clubhouse has enough room to cater to your every whim. Come experience life just the way you like it.	t	t	t	{3554image_search_1622625117301.jpg,7416image_search_1622625491098.jpg,510image_search_1622626289954.jpg}	t
11	17	3	15	Gangapur Rd	Gangapur Rd	Nashik	25000	175000	Lavish 3 BHK Luxurious flats available for rent near Wisdom Highschool. Project is RERA registered and loaded with all modern amenities. Contact Today. Lavish2 & 3BHK homes in the heart of the city.	t	t	t	{4600image_search_1622625103120.jpg,8703image_search_1622625501626.jpg,775image_search_1622626429110.jpg}	t
12	18	2	4	Ashok Nagar	Colony	Nashik	3500	30000	description	t	t	t	{1525image_search_1622625103120.jpg,6759image_search_1622625501626.jpg,7896image_search_1622626429110.jpg}	t
\.


--
-- Data for Name: owner; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.owner (id, uid, name, city, phno) FROM stdin;
14	2121212	Owais	8668201034	8945567213
15	454545	Abhishek	Hyderabad	9578561235
16	75235	Sanjyot	Bangalore	8457123690
17	652142	Sohail	Nashik	8456213652
18	566552	Abhishek W	NASHIK	8654123523
\.


--
-- Data for Name: rowhouse; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rowhouse (id, oid, no_of_room, no_of_floor, no_of_bathroom, area, locality, address, city, rent, deposit, balcony, parking, negotiable, more, images, status) FROM stdin;
3	16	3	1	1	812	Malad	Malad West	Mumbai	5000	30000	f	t	t	Choose to rent this rowhouse that is ideal for families & enjoy all that this home has to offer. Finding a semi furnished house in Chincholi Bunder at just 30,000 rupees is pretty tough and this home could be just what you are looking for. This South facing home is over 812 sqft. You get ample & dedicated parking space for car and bike with this home.	{2109image_search_1622625125758.jpg,3876image_search_1622625522175.jpg,3862image_search_1622626368251.jpg}	t
\.


--
-- Data for Name: tenant; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tenant (id, uid, name, city) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, email, password) FROM stdin;
14	owais	owaisansari1112@gmail.com	owais
15	Abhishek	abhiwaje123@gmail.com	abhishek123
16	Sanjyot	sanjyot123@gmail.com	sanjyot
17	Sohail	sohail@gmail.com	sohail
18	Abhishek W	abhishekw12@gmail.com	abhishek123
\.


--
-- Name: bungalow_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bungalow_id_seq', 5, true);


--
-- Name: flat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.flat_id_seq', 12, true);


--
-- Name: rowhouse_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rowhouse_id_seq', 3, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 18, true);


--
-- Name: bungalow bungalow_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bungalow
    ADD CONSTRAINT bungalow_pkey PRIMARY KEY (id);


--
-- Name: flat flat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.flat
    ADD CONSTRAINT flat_pkey PRIMARY KEY (id);


--
-- Name: owner owner_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.owner
    ADD CONSTRAINT owner_id_key UNIQUE (id);


--
-- Name: owner owner_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.owner
    ADD CONSTRAINT owner_pkey PRIMARY KEY (uid);


--
-- Name: rowhouse rowhouse_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rowhouse
    ADD CONSTRAINT rowhouse_pkey PRIMARY KEY (id);


--
-- Name: tenant tenant_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tenant
    ADD CONSTRAINT tenant_id_key UNIQUE (id);


--
-- Name: tenant tenant_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tenant
    ADD CONSTRAINT tenant_pkey PRIMARY KEY (uid);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: bungalow bungalow_oid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bungalow
    ADD CONSTRAINT bungalow_oid_fkey FOREIGN KEY (oid) REFERENCES public.owner(id);


--
-- Name: flat flat_oid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.flat
    ADD CONSTRAINT flat_oid_fkey FOREIGN KEY (oid) REFERENCES public.owner(id);


--
-- Name: owner owner_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.owner
    ADD CONSTRAINT owner_id_fkey FOREIGN KEY (id) REFERENCES public.users(id);


--
-- Name: rowhouse rowhouse_oid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rowhouse
    ADD CONSTRAINT rowhouse_oid_fkey FOREIGN KEY (oid) REFERENCES public.owner(id);


--
-- Name: tenant tenant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tenant
    ADD CONSTRAINT tenant_id_fkey FOREIGN KEY (id) REFERENCES public.users(id);


--
-- PostgreSQL database dump complete
--

