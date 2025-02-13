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
            // Ensure required fields are not null
            $data['nationality'] = $data['nationality'] ?? 'Chinese';
            
            // Validate and clean data before insertion
            $cleanData = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $data);
            
            // Ensure required fields have default values
            $cleanData['nationality'] = $cleanData['nationality'] ?? 'Chinese';

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
            
            // Debug log the data being inserted
            error_log("Inserting loan application with data: " . print_r($cleanData, true));
            
            $result = $stmt->execute([
                ':user_id' => $cleanData['user_id'],
                ':loan_type' => $cleanData['loan_type'],
                ':t_amount' => $cleanData['t_amount'],
                ':period' => $cleanData['period'],
                ':mon_installment' => $cleanData['mon_installment'],
                ':name' => $cleanData['name'],
                ':no_ic' => $cleanData['no_ic'],
                ':sex' => $cleanData['sex'],
                ':religion' => $cleanData['religion'],
                ':nationality' => $cleanData['nationality'],
                ':DOB' => $cleanData['DOB'],
                ':add1' => $cleanData['add1'],
                ':postcode1' => $cleanData['postcode1'],
                ':state1' => $cleanData['state1'],
                ':memberID' => $cleanData['memberID'],
                ':PFNo' => $cleanData['PFNo'],
                ':position' => $cleanData['position'],
                ':add2' => $cleanData['add2'],
                ':postcode2' => $cleanData['postcode2'],
                ':state2' => $cleanData['state2'],
                ':office_pNo' => $cleanData['office_pNo'],
                ':pNo' => $cleanData['pNo'],
                ':bankName' => $cleanData['bankName'],
                ':bankAcc' => $cleanData['bankAcc'],
                ':guarantor_N' => $cleanData['guarantor_N'],
                ':guarantor_ic' => $cleanData['guarantor_ic'],
                ':guarantor_pNo' => $cleanData['guarantor_pNo'],
                ':PFNo1' => $cleanData['PFNo1'],
                ':guarantorMemberID' => $cleanData['guarantorMemberID'],
                ':guarantor_N2' => $cleanData['guarantor_N2'],
                ':guarantor_ic2' => $cleanData['guarantor_ic2'],
                ':guarantor_pNo2' => $cleanData['guarantor_pNo2'],
                ':PFNo2' => $cleanData['PFNo2'],
                ':guarantorMemberID2' => $cleanData['guarantorMemberID2'],
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