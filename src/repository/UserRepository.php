<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Role.php';

class UserRepository extends Repository
{
    private function setUserAdditionalData($user) {
        $this->setUserRole($user);
        $this->setUserPermissions($user);
    }

    private function setUserRole($user) {
        $role = $this->getUserRoleById($user->getRoleId());
        $user->setRole($role);
    }

    private function setUserPermissions($user) {
        $permissions = $this->getUserPermissionsByRoleId($user->getRoleId());
        $user->setPermissions($permissions);
    }

    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_account u 
            WHERE u.email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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
            $result['role_id'],
            $result['id']
        );
        $this->setUserAdditionalData($user);
        return $user;
    }

    public function getUserBySessionId(string $sessionId) {
        $stmt = $this->database->connect()->prepare('
            SELECT u.* 
            FROM user_account u 
            JOIN user_session s on s.user_id = u.id
            WHERE s.session_id = :sessionId
        ');
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
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
            $result['role_id'],
            $result['id']
        );

        $this->setUserAdditionalData($user);
        return $user;
    }

    public function getUserById(int $id): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * 
            FROM user_account u 
            WHERE u.id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
            $result['role_id'],
            $result['id']
        );

        $this->setUserAdditionalData($user);
        return $user;
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
            $role = $this->getUserRoleById($newUser->getRoleId());
            $newUser->setRole($role);
            array_push($users, $newUser);
        } 

        return $users;
    }

    public function getUsers() {
        $stmt = $this->database->connect()->prepare('
            SELECT u.* 
            FROM user_account u 
            JOIN role r ON u.role_id = r.id 
            WHERE r.name <> \'admin\' 
        ');
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
            $role = $this->getUserRoleById($newUser->getRoleId());
            $newUser->setRole($role);
            array_push($users, $newUser);
        } 

        return $users;
    }

    public function addUser(User $user)
    {
        try {
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
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function updateUser(User $user) {
        $stmt = $this->database->connect()->prepare('
            UPDATE user_account SET
            first_name = ?,
            last_name = ?,
            email = ?,
            license_code = ?,
            city = ?,
            street = ?,
            house_number = ?,
            postal_code = ?,
            role_id = ?
            WHERE id = ?
        ');
        $stmt->execute([
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getLicenceCode(),
            $user->getCity(),
            $user->getStreet(),
            $user->getHouseNumber(),
            $user->getPostalCode(),
            $user->getRoleId(),
            $user->getId()
        ]);
    }

    public function deleteUserById(int $id) {
        try {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM user_account
                WHERE id = :userId
            ');
            $stmt->bindParam(':userId', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function registerLoginSession(User $user, string $sessionId) {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_session (session_id, user_id) 
            VALUES (:sessionId, :userId)
        ');

        $values = array(
            ':sessionId' => $sessionId,
            ':userId' => $user->getId()
        );
        $stmt->execute($values);
    }

    public function deleteUserSession(string $session_id) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM user_session 
            WHERE session_id = :sessionId 
        ');
        $stmt->bindParam(':sessionId', $session_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getUserRoleById(int $roleId) {
        $stmt = $this->database->connect()->prepare('
            SELECT r.* 
            FROM role r 
            WHERE r.id = :id
        ');
        $stmt->bindParam(':id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $role = new Role(
            $result['id'],
            $result['name']
        );

        return $role;
    }
    
    public function getUserAvailableRoles() {
        $stmt = $this->database->connect()->prepare('
            SELECT r.* 
            FROM role r 
            WHERE r.name <> \'admin\'
            ORDER BY r.id
        ');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $roles = [];
        foreach ($result as $role) {
            $newRole = new Role(
                $role['id'],
                $role['name']
            );
            array_push($roles, $newRole);
        }
        return $roles;
    }

    public function getUserPermissionsByRoleId(int $id) {
        $stmt = $this->database->connect()->prepare('
            SELECT rp.permission 
            FROM vw_role_permission rp 
            WHERE rp.role_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $permissions = explode(', ', $result['permission']);
        return $permissions;
    }
}