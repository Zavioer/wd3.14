CREATE TRIGGER update_finish_date
BEFORE UPDATE ON orders
FOR EACH ROW
EXECUTE FUNCTION update_order_finish_date();