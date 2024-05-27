<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_account u 
            WHERE u.email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['first_name'],
            $user['last_name'],
            $user['license_code'],
            $user['city'],
            $user['street'],
            $user['house_number'],
            $user['postal_code'],
            $user['role_id'],
            $user['id']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_account (
                first_name, last_name, email, password, license_code,
                city, street, house_number, postal_code, role_id
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getLicenceCode(),
            $user->getCity(),
            $user->getStreet(),
            $user->getHouseNumber(),
            $user->getPostalCode(),
            $user->getRoleId()
        ]);
    }

    public function deleteUser() {
        echo '';
    }

    public function updateUser() {
        echo '';
    }

    public function registerLoginSession(User $user) {
        if (session_status() == PHP_SESSION_ACTIVE) {
            $stmt = $this->database->connect()->prepare('
                INSERT INTO user_session (session_id, user_id) 
                VALUES (:sessionId, :userId)
            ');

            $values = array(
                ':sessionId' => session_id(),
                ':userId' => $this->getUserIdByEmail($user->getEmail())
            );
            $stmt->execute($values);
            $_SESSION['user_id'] = $this->getUserIdByEmail($user->getEmail());
        }
    }

    public function getUserIdByEmail(string $email) {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_account u 
            WHERE u.email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user['id'];
    }

    public function logout() {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM user_session WHERE session_id = ?
        ');
        $stmt->execute([session_id()]);
        session_regenerate_id(true);
    }

    public function getUsersByRole(string $role) {
        $stmt = $this->database->connect()->prepare('
            SELECT u.* 
            FROM user_account u 
            JOIN role r ON u.role_id = r.id 
            WHERE r.name = :role
        ');
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = []; 

        foreach ($result as $user) {
            $newUser = new User(
                $user['email'],
                $user['password'],
                $user['first_name'],
                $user['last_name'],
                $user['license_code'],
                $user['city'],
                $user['street'],
                $user['house_number'],
                $user['postal_code'],
                $user['role_id'],
                $user['id']
            );
            array_push($users, $newUser);
        } 

        return $users;
    }

    public function getUserBySessionID(string $sessionID) {
        $stmt = $this->database->connect()->prepare('
            SELECT u.* 
            FROM user_account u 
            JOIN user_session s on s.user_id = u.id
            WHERE s.session_id = :sessionID
        ');
        $stmt->bindParam(':sessionID', $sessionID, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }
        
        $user = new User(
            $result['email'],
            $result['password'],
            $result['first_name'],
            $result['last_name'],
            $result['license_code'],
            $result['city'],
            $result['street'],
            $result['house_number'],
            $result['postal_code'],
            $result['role_id']
        );

        return $user;
    }

    public function deleteUserById(int $id) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM user_account
            WHERE id = :userID
        ');
        $stmt->bindParam(':userID', $id, PDO::PARAM_STR);
        $stmt->execute();
    }
}