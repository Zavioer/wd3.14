CREATE TRIGGER before_delete_client
BEFORE DELETE ON client
FOR EACH ROW
EXECUTE FUNCTION backup_and_delete_client();