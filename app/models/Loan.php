<?php
namespace App\Models;

use App\Core\Model;

class Loan extends Model
{
    public function all() 
    {
        $stmt = $this->getConnection()->query("SELECT * FROM loan_applications");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM loan_applications WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function registerLoan($data)
    {
        try {
            $stmt = $this->getConnection()->prepare("INSERT INTO loan_applications (
                full_name, 
                mykad_no, 
                email, 
                mobile_phone, 
                financing_amount, 
                loan_purpose
            ) VALUES (
                :full_name, 
                :mykad_no, 
                :email, 
                :mobile_phone, 
                :financing_amount, 
                :loan_purpose
            )");

            $stmt->execute([
                ':full_name' => $data['full_name'],
                ':mykad_no' => $data['mykad_no'],
                ':email' => $data['email'],
                ':mobile_phone' => $data['mobile_phone'],
                ':financing_amount' => $data['financing_amount'],
                ':loan_purpose' => $data['loan_purpose']
            ]);

            return $stmt;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function findByIcNumber($icNumber)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM loan_applications WHERE ic_number = :ic_number");
        $stmt->bindParam(':ic_number', $icNumber);
        $stmt->execute();
        return $stmt->fetch();
    }
}
