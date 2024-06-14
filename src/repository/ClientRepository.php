<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Client.php';

class ClientRepository extends Repository
{

    public function getClientById(int $id, $raw=false)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM client c 
            WHERE c.id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }

        if ($raw) {
            return $result;
        }

        $client = new Client(
            $result['first_name'],
            $result['last_name'],
            $result['city'],
            $result['street'],
            $result['house_number'],
            $result['postal_code'],
            $result['phone'],
            $result['email'],
            $result['id']
        );

        return $client;
    }

    public function addClient(Client $client)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO client (
                first_name, last_name, city, street, house_number, postal_code,
                phone, email
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $client->getFirstName(),
            $client->getLastName(),
            $client->getCity(),
            $client->getStreet(),
            $client->getHouseNumber(),
            $client->getPostalCode(),
            $client->getPhone(),
            $client->getEmail(),
        ]);
    }

    public function getOrAddClient(Client $client)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM get_or_insert_client(?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $client->getFirstName(),
            $client->getLastName(),
            $client->getCity(),
            $client->getStreet(),
            $client->getHouseNumber(),
            $client->getPostalCode(),
            $client->getCompanyName()
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Client(
            $result['first_name'],
            $result['last_name'],
            $result['city'],
            $result['street'],
            $result['house_number'],
            $result['postal_code'],
            $result['phone'],
            $result['email'],
            $result['id']
        );
    }


    public function updateClient(Client $client)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE client SET
            first_name = ?,
            last_name = ?,
            city = ?,
            street = ?,
            house_number = ?,
            postal_code = ?,
            phone = ?,
            email = ?,
            WHERE id = ?
        ');
        $stmt->execute([
            $client->getFirstName(),
            $client->getLastName(),
            $client->getCity(),
            $client->getStreet(),
            $client->getHouseNumber(),
            $client->getPostalCode(),
            $client->getPhone(),
            $client->getEmail()
        ]);
    }

    public function getClients() {
        $stmt = $this->database->connect()->prepare('
            SELECT c.* 
            FROM client c 
        ');
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $clients = []; 

        foreach ($result as $client) {
            $newClient = new Client(
                $client['first_name'],
                $client['last_name'],
                $client['city'],
                $client['street'],
                $client['house_number'],
                $client['postal_code'],
                $client['phone'],
                $client['email'],
                $client['id']
            );
            array_push($clients, $newClient);
        } 

        return $clients;
    }

    public function deleteClientById(int $id) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM client
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}