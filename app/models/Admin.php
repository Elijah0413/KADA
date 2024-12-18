<?php
namespace App\Models;

use App\Core\Model;

class Admin extends Model {
    public function all() {
        $stmt = $this->getConnection()->query("SELECT * FROM admins");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->getConnection()->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($data) {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $stmt = $this->getConnection()->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
        $stmt->execute([
            ':username' => $data['username'],
            ':password' => $hashedPassword
        ]);
        return $stmt;
    }

    public function update($id, $data) {
        $sql = "UPDATE admins SET username = :username";
        $params = [':username' => $data['username'], ':id' => $id];
        
        if (isset($data['password'])) {
            $sql .= ", password = :password";
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function delete($id) {
        $stmt = $this->getConnection()->prepare("DELETE FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function usernameExists($username) {
        $stmt = $this->getConnection()->prepare("SELECT COUNT(*) FROM admins WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
    
    public function login($username, $password) {
        $stmt = $this->getConnection()->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }
}