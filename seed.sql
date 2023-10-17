CREATE TABLE question (
    id text PRIMARY KEY,
    category_id text,
    point_category_id text,
    question text,
    r_answer_id text
);

CREATE TABLE category (
    id text PRIMARY KEY,
    name text
);

CREATE TABLE point_category (
    id text PRIMARY KEY,
    point_value integer
);

CREATE TABLE answer (
    id text PRIMARY KEY,
    answer_text text
);