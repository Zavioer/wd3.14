<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Client.php';

class ClientRepository extends Repository
{

    public function getClientById(int $id): ?Client
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM clietn c 
            WHERE c.id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client == false) {
            return null;
        }

        return new Client(
            $client['first_name'],
            $client['last_name'],
            $client['city'],
            $client['street'],
            $client['house_number'],
            $client['postal_code'],
            $client['company_name'],
            $client['id']
        );
    }

    public function addClient(Client $client)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO client (
                first_name, last_name, city, street, house_number, postal_code,
                company_name
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)
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
            company_name = ?,
            WHERE id = ?
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
                $client['company_name'],
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