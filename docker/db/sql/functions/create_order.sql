CREATE OR REPLACE FUNCTION create_order(
    p_client_id INT,
    p_salesman_id INT,
    p_product_id INT,
    p_amount INT,
    p_discount NUMERIC
) RETURNS VOID AS $$
DECLARE
    v_new_order orders%ROWTYPE;
BEGIN
    WITH new_order AS (
        INSERT INTO orders (
            client_id, salesman_id, creation_date, discount, state
        )
        VALUES (
            p_client_id, p_salesman_id, NOW(), p_discount, 'NEW'
        )
        RETURNING *
    )
    SELECT * INTO v_new_order FROM new_order;
    
    INSERT INTO orders_product (product_id, orders_id, amount)
    VALUES (p_product_id, v_new_order.id, p_amount);

    UPDATE orders SET
        total_price = x.total_price * x.discount,
        state = 'PENDING'
    FROM (
        SELECT sum(p.price * op.amount) AS total_price, (1.0 - no.discount) AS discount
        FROM orders no
        JOIN orders_product op ON no.id = op.orders_id
        JOIN product p ON op.product_id = p.id
        WHERE no.id = v_new_order.id
        GROUP BY no.id
    ) x
    WHERE id = v_new_order.id;

    UPDATE warehouse SET quantity = quantity - p_amount
    WHERE product_id = p_product_id;
END$$ LANGUAGE plpgsql;
