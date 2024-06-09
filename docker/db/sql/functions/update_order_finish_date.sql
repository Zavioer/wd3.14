CREATE OR REPLACE FUNCTION update_order_finish_date()
RETURNS TRIGGER AS $$
BEGIN
    IF UPPER(NEW.state) = 'FINISHED' THEN
        NEW.finish_date = NOW();
    END IF;

    RETURN NEW;
END$$ LANGUAGE plpgsql;