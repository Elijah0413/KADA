<?php
namespace App\Models;

use App\Core\Model;
use PDOException;
use Exception;
use PDO;

class Loan extends Model
{
    protected $table = 'loan_applications';
    
    public function all() 
    {
        $stmt = $this->getConnection()->query("SELECT * FROM loan_applications");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        try {
            $stmt = $this->getConnection()->prepare("SELECT * FROM loan_applications WHERE id = :id");
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            throw new Exception('Failed to fetch loan details');
        }
    }

    public function registerLoan($data)
    {
        try {
            $sql = "INSERT INTO loan_applications (
                user_id, loan_type, t_amount, period, mon_installment,
                name, no_ic, sex, religion, nationality, DOB,
                add1, postcode1, state1, memberID, PFNo, position,
                add2, postcode2, state2, office_pNo, pNo,
                bankName, bankAcc,
                guarantor_N, guarantor_ic, guarantor_pNo, PFNo1, guarantorMemberID,
                guarantor_N2, guarantor_ic2, guarantor_pNo2, PFNo2, guarantorMemberID2,
                status
            ) VALUES (
                :user_id, :loan_type, :t_amount, :period, :mon_installment,
                :name, :no_ic, :sex, :religion, :nationality, :DOB,
                :add1, :postcode1, :state1, :memberID, :PFNo, :position,
                :add2, :postcode2, :state2, :office_pNo, :pNo,
                :bankName, :bankAcc,
                :guarantor_N, :guarantor_ic, :guarantor_pNo, :PFNo1, :guarantorMemberID,
                :guarantor_N2, :guarantor_ic2, :guarantor_pNo2, :PFNo2, :guarantorMemberID2,
                :status
            )";

            $stmt = $this->db->prepare($sql);
            
            $result = $stmt->execute([
                ':user_id' => $data['user_id'],
                ':loan_type' => $data['loan_type'],
                ':t_amount' => $data['t_amount'],
                ':period' => $data['period'],
                ':mon_installment' => $data['mon_installment'],
                ':name' => $data['name'],
                ':no_ic' => $data['no_ic'],
                ':sex' => $data['sex'],
                ':religion' => $data['religion'],
                ':nationality' => $data['nationality'],
                ':DOB' => $data['DOB'],
                ':add1' => $data['add1'],
                ':postcode1' => $data['postcode1'],
                ':state1' => $data['state1'],
                ':memberID' => $data['memberID'],
                ':PFNo' => $data['PFNo'],
                ':position' => $data['position'],
                ':add2' => $data['add2'],
                ':postcode2' => $data['postcode2'],
                ':state2' => $data['state2'],
                ':office_pNo' => $data['office_pNo'],
                ':pNo' => $data['pNo'],
                ':bankName' => $data['bankName'],
                ':bankAcc' => $data['bankAcc'],
                ':guarantor_N' => $data['guarantor_N'],
                ':guarantor_ic' => $data['guarantor_ic'],
                ':guarantor_pNo' => $data['guarantor_pNo'],
                ':PFNo1' => $data['PFNo1'],
                ':guarantorMemberID' => $data['guarantorMemberID'],
                ':guarantor_N2' => $data['guarantor_N2'],
                ':guarantor_ic2' => $data['guarantor_ic2'],
                ':guarantor_pNo2' => $data['guarantor_pNo2'],
                ':PFNo2' => $data['PFNo2'],
                ':guarantorMemberID2' => $data['guarantorMemberID2'],
                ':status' => 'pending'
            ]);

            if ($result) {
                return $this->db->lastInsertId();
            }
            return false;

        } catch (PDOException $e) {
            error_log("Error in registerLoan: " . $e->getMessage());
            throw new \Exception("Database error occurred: " . $e->getMessage());
        }
    }

    public function getLoansByUserId($userId)
    {
        try {
            $stmt = $this->getConnection()->prepare("
                SELECT * FROM loan_applications 
                WHERE user_id = :user_id 
                ORDER BY created_at DESC
            ");
            
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error in getLoansByUserId: " . $e->getMessage());
            throw new Exception("Error retrieving loan applications");
        }
    }

    public function getApprovedLoanApplication($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM loan_applications 
                WHERE user_id = ? 
                AND status = 'approved'
                ORDER BY created_at DESC 
                LIMIT 1");
                
        $stmt->execute([$user_id]);
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function getAllApprovedLoans($userId) {
        try {
            $query = "SELECT * FROM loan_applications 
                      WHERE user_id = :user_id 
                      AND status = 'APPROVED'
                      AND mon_installment > 0";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $userId]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting approved loans: " . $e->getMessage());
            return [];
        }
    }

}