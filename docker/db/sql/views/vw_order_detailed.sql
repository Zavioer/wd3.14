CREATE OR REPLACE VIEW vw_order_detailed AS
SELECT 
    o.id as order_id,
    c.first_name as client_first_name,
    c.last_name as client_last_name,
    u.first_name as salesman_first_name,
    u.last_name as salesman_last_name,
    o.creation_date,
    o.finish_date,
    o.discount,
    o.total_price,
    o.state,
    p.id as product_id,
    p.name as product_name,
    op.amount
FROM orders o
JOIN user_account u ON o.salesman_id = u.id AND u.role_id = 2
JOIN orders_product op ON o.id = op.orders_id
JOIN product p ON op.product_id = p.id
JOIN client c on o.client_id = c.id
ORDER BY o.id, o.creation_date;