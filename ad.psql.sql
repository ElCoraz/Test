PGDMP         #    
            y            ad    13.2    13.2     ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            ?           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            ?           1262    16407    ad    DATABASE     _   CREATE DATABASE ad WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Russian_Russia.1251';
    DROP DATABASE ad;
                postgres    false                        2615    16408    ad    SCHEMA        CREATE SCHEMA ad;
    DROP SCHEMA ad;
                postgres    false            ?            1259    16488    images    TABLE     ?   CREATE TABLE ad.images (
    id character varying(255) NOT NULL,
    id_main character varying(255),
    url character varying(255),
    "isMain" boolean
);
    DROP TABLE ad.images;
       ad         heap    postgres    false    4            ?            1259    16496    main    TABLE     ?   CREATE TABLE ad.main (
    price numeric,
    created_by date,
    id character varying(255) NOT NULL,
    description text,
    name character varying(255),
    images character varying(255)
);
    DROP TABLE ad.main;
       ad         heap    postgres    false    4            ?          0    16488    images 
   TABLE DATA           8   COPY ad.images (id, id_main, url, "isMain") FROM stdin;
    ad          postgres    false    201   ?	       ?          0    16496    main 
   TABLE DATA           L   COPY ad.main (price, created_by, id, description, name, images) FROM stdin;
    ad          postgres    false    202   *       (           2606    16495    images images_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY ad.images
    ADD CONSTRAINT images_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY ad.images DROP CONSTRAINT images_pkey;
       ad            postgres    false    201            *           2606    16503    main main_pkey 
   CONSTRAINT     H   ALTER TABLE ONLY ad.main
    ADD CONSTRAINT main_pkey PRIMARY KEY (id);
 4   ALTER TABLE ONLY ad.main DROP CONSTRAINT main_pkey;
       ad            postgres    false    202            ?   (  x???݊?0????b????ײ ?̤+????b#??x?҃B??:@$???ZT?*?\?????ןi??????r??q???ש\????ez}:??M??Q;l?vف}8M??|Z?mx	????z?9I???a??p?D?#g??HU??<?{?Û?|?c=?
?U?P"??dH9?.?	=?W?d?.??
zѦ?ͬz?BN?KAGR?J) ?ABF???Z?eQ??q(??/T??W׵.TU/??ʽ??&?<o??,?q???ޚ?zAD??? ????0T??????`?\?шx??0?g-?1      ?   3  x?u?Kj?0??????I?e?]v?'̦-?ޟ?&M?Y?χ?#^???.?Ѵی?R.o????ǽ}߾~n?/?????T??!UJ???"]NA<??$????:?????CF(Y?H\Gq???!?20ǎޞl?]U??<??????m????H???s?g$??|t???e?ԝ??gGW{?@?)?Ԟ?p??????Z??93?b?O?
?]? W??q????-?Ď?\??Ν#?>J????0??8??l6=?ں yo`+?1:???${i?????3?eY?soh?)?e???? ?0Q'     