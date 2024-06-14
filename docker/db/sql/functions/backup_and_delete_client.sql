CREATE OR REPLACE FUNCTION backup_and_delete_client()
RETURNS TRIGGER AS $$
BEGIN
    -- Insert the deleted client record into client_archive
    INSERT INTO client_archive (id, first_name, last_name, city, street, house_number, postal_code, phone, email)
    VALUES (OLD.id, OLD.first_name, OLD.last_name, OLD.city, OLD.street, OLD.house_number, OLD.postal_code, OLD.phone, OLD.email);

    -- Return OLD to proceed with the deletion
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;
