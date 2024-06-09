CREATE OR REPLACE VIEW vw_role_permission AS 
SELECT 
    r.id AS role_id,
    r.name AS role_name,
    string_agg(p.name, ', ' ORDER BY p.name) AS permission
FROM role r
JOIN role_permission rp ON r.id = rp.role_id
JOIN permission p ON rp.permission_id = p.id
GROUP BY r.id
ORDER by r.id;