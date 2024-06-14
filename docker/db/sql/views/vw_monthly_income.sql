CREATE OR REPLACE VIEW vw_monthly_income AS
WITH all_months AS (
    SELECT
        generate_series(
            date_trunc('year', min(creation_date)),
            date_trunc('year', max(creation_date)) + interval '1 year - 1 month',
            '1 month'
        )::date AS month_start
    FROM orders
), monthly_totals AS (
    SELECT
        EXTRACT(YEAR FROM month_start) AS year,
        EXTRACT(MONTH FROM month_start) AS month,
        COALESCE(SUM(o.total_price), 0) AS total_price
    FROM all_months am
    LEFT JOIN orders o
    ON date_trunc('month', o.creation_date) = am.month_start
    GROUP BY year, month
)
SELECT *
FROM monthly_totals
ORDER BY year, month;