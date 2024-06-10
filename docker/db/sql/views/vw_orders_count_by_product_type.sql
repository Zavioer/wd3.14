CREATE OR REPLACE VIEW vw_orders_count_by_product_type AS
SELECT 
    extract(YEAR from o.creation_date) AS year,
    extract(month from o.creation_date::TIMESTAMP) AS month,
    pt.name AS product_type_name,
    count(*) AS orders_count 
FROM orders o
JOIN orders_product op ON o.id = op.orders_id
JOIN product p ON p.id = op.product_id
JOIN product_type pt ON p.product_type_id = pt.id
GROUP BY pt.id, pt.name, extract(year from o.creation_date::TIMESTAMP), extract(month from o.creation_date::TIMESTAMP)
ORDER BY 1, 2, 3, 4;