CREATE OR REPLACE FUNCTION get_or_insert_client(
    p_first_name VARCHAR,
    p_last_name VARCHAR,
    p_city VARCHAR,
    p_street VARCHAR,
    p_house_number VARCHAR,
    p_postal_code VARCHAR,
    p_phone VARCHAR,
    p_email VARCHAR
)
RETURNS TABLE(id INT, first_name VARCHAR, last_name VARCHAR, city VARCHAR, street VARCHAR, house_number VARCHAR, postal_code VARCHAR, phone VARCHAR, email VARCHAR) AS $$
BEGIN
    RETURN QUERY
    WITH inserted AS (
        INSERT INTO client (first_name, last_name, city, street, house_number, postal_code, phone, email)
        VALUES (p_first_name, p_last_name, p_city, p_street, p_house_number, p_postal_code, p_phone, p_email)
        ON CONFLICT DO NOTHING
        RETURNING *
    )
    SELECT *
    FROM inserted i

    UNION ALL

    SELECT *
    FROM client c
    WHERE c.first_name = p_first_name
      AND c.last_name = p_last_name
      AND c.city = p_city
      AND c.street = p_street
      AND c.house_number = p_house_number
      AND c.postal_code = p_postal_code
      AND c.phone = p_phone
      AND c.email = p_email
    LIMIT 1;
END;
$$ LANGUAGE plpgsql;
