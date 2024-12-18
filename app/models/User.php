<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function all() 
    {
        $stmt = $this->getConnection()->query("SELECT * FROM members");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM members WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function register($data)
    {
    $stmt = $this->getConnection()->prepare("INSERT INTO members (
        name, 
        ic_number, 
        marital_status, 
        monthly_salary, 
        email, 
        phone_number, 
        home_address, 
        postcode, 
        state, 
        post_title, 
        working_address, 
        working_postcode
    ) VALUES (
        :name, 
        :ic_number, 
        :marital_status, 
        :monthly_salary, 
        :email, 
        :phone_number, 
        :home_address, 
        :postcode, 
        :state, 
        :post_title, 
        :working_address, 
        :working_postcode
    )");

    $stmt->execute([
        ':name' => $data['name'],
        ':ic_number' => $data['ic_number'],
        ':marital_status' => $data['marital_status'],
        ':monthly_salary' => $data['monthly_salary'],
        ':email' => $data['email'],
        ':phone_number' => $data['phone_number'],
        ':home_address' => $data['home_address'],
        ':postcode' => $data['postcode'],
        ':state' => $data['state'],
        ':post_title' => $data['post_title'],
        ':working_address' => $data['working_address'],
        ':working_postcode' => $data['working_postcode']
    ]);

    return $stmt;
    }

    public function findByIcNumber($icNumber)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM members WHERE ic_number = :ic_number");
        $stmt->bindParam(':ic_number', $icNumber);
        $stmt->execute();
        return $stmt->fetch();
    }
}
