<?php
namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;
use Exception;

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
        try {
            // Query the users table for admin with matching IC number
            $stmt = $this->getConnection()->prepare("
                SELECT * FROM users 
                WHERE ic_no = :username 
                AND role = 'admin'
            ");
            
            $stmt->execute([':username' => $username]);
            $admin = $stmt->fetch(\PDO::FETCH_ASSOC);

            // Debug log
            error_log("Admin login attempt - IC: " . $username);
            error_log("Admin found: " . ($admin ? 'Yes' : 'No'));

            if ($admin && password_verify($password, $admin['password'])) {
                // Set admin session variables
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_ic'] = $admin['ic_no'];
                $_SESSION['role'] = 'admin';
                
                // Debug log
                error_log("Admin login successful - Session data: " . print_r($_SESSION, true));
                
                return $admin;
            }
            
            error_log("Admin login failed - Invalid credentials");
            return false;
            
        } catch (PDOException $e) {
            error_log("Admin login error: " . $e->getMessage());
            return false;
        }
    }
    public function updateStatus($id, $status, $remark = null)
    {
        try {
            $sql = "UPDATE pendingregistermember 
                    SET status = :status, 
                        admin_remark = :remark,
                        updated_at = NOW() 
                    WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id' => $id,
                ':status' => $status,
                ':remark' => $remark
            ]);
        } catch (PDOException $e) {
            error_log("Error updating member status: " . $e->getMessage());
            return false;
        }
    }

    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM pendingregistermember WHERE id = :id";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            throw new Exception('Failed to fetch user details');
        }
    }
    
    public function getLoansByUserId($id)
    {
        try {
            $sql = "SELECT * FROM loan_applications WHERE id = :id";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            throw new Exception('Failed to fetch user details');
        }
    }
    
    public function getTransferRequests()
    {
        try {
            $sql = "SELECT st.*, sa.account_number, m.name as member_name, m.ic_no 
                    FROM saving_transactions st
                    JOIN saving_accounts sa ON st.account_id = sa.id
                    JOIN pendingregistermember m ON sa.user_ic = m.ic_no
                    WHERE st.transaction_type = 'transfer' 
                    ORDER BY st.transaction_date DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error fetching transfer requests: " . $e->getMessage());
            throw new \Exception("Error fetching transfer requests: " . $e->getMessage());
        }
    }

    public function processTransferRequest($transactionId, $status, $adminRemark, $adminId)
    {
        try {
            $this->db->beginTransaction();

            // Get transaction details
            $sql = "SELECT st.*, sa.balance 
                    FROM saving_transactions st
                    JOIN saving_accounts sa ON st.account_id = sa.id
                    WHERE st.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$transactionId]);
            $transaction = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$transaction) {
                throw new \Exception("Transaction not found");
            }

            // Check sufficient balance for approvals
            if ($status === 'approved' && $transaction['balance'] < $transaction['amount']) {
                throw new \Exception("Insufficient balance");
            }

            // Update transaction status
            $sql = "UPDATE saving_transactions 
                   SET status = ?, 
                       admin_remark = ?,
                       processed_by = ?,
                       processed_at = NOW()
                   WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$status, $adminRemark, $adminId, $transactionId]);

            // If approved, update account balance
            if ($status === 'approved') {
                $sql = "UPDATE saving_accounts 
                       SET balance = balance - ?,
                           updated_at = NOW()
                       WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$transaction['amount'], $transaction['account_id']]);
            }

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Error processing transfer request: " . $e->getMessage());
            throw new \Exception("Error processing transfer request: " . $e->getMessage());
        }
    }

    public function getAllInquiries() {
        try {
            $stmt = $this->getConnection()->prepare('
                SELECT i.*, m.full_name as member_name 
                FROM inquiries i 
                LEFT JOIN member_profile m ON i.user_id = m.user_id 
                ORDER BY i.created_at DESC
            ');
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting inquiries: " . $e->getMessage());
            return false;
        }
    }

    public function replyInquiry($data) {
        try {
            error_log("Attempting to reply to inquiry with data: " . print_r($data, true));

            $stmt = $this->db->prepare('
                UPDATE inquiries 
                SET status = :status, 
                    admin_response = :admin_response, 
                    updated_at = NOW()
                WHERE id = :inquiry_id
            ');
            
            $params = [
                ':inquiry_id' => $data['inquiry_id'],
                ':status' => 'resolved',
                ':admin_response' => $data['admin_response']
            ];

            error_log("Executing query with params: " . print_r($params, true));
            
            $result = $stmt->execute($params);
            
            if (!$result) {
                error_log("PDO Error Info: " . print_r($stmt->errorInfo(), true));
            }
            
            return $result;
            
        } catch (PDOException $e) {
            error_log("PDO Error in replyInquiry: " . $e->getMessage());
            throw new PDOException("Failed to update inquiry: " . $e->getMessage());
        }
    }

    public function getMemberById($id)
    {
        try {
            // Update the SQL query to include new fields
            $sql = "SELECT 
                    id, name, ic_no, gender, religion, race, marital_status,
                    member_number, pf_number, position, grade, monthly_salary,
                    home_address, home_postcode, home_city, home_state,
                    office_address, office_postcode, office_city, office_state,
                    office_phone, home_phone, fax, status, user_id,
                    registration_fee, share_capital, fee_capital,
                    deposit_funds, welfare_fund, fixed_deposit
                    FROM pendingregistermember 
                    WHERE id = :id";
                    
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            $member = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$member) {
                return null;
            }

            // Get family members (unchanged)
            $familySql = "SELECT id, name, ic_no, relationship 
                          FROM member_family 
                          WHERE member_ic = :member_ic
                          ORDER BY id ASC";
            $familyStmt = $this->db->prepare($familySql);
            $familyStmt->execute([':member_ic' => $member->ic_no]);
            $familyMembers = $familyStmt->fetchAll(PDO::FETCH_OBJ);

            $member->family_members = $familyMembers;
            
            return $member;

        } catch (PDOException $e) {
            error_log("Error in getMemberById: " . $e->getMessage());
            throw new Exception("Error fetching member: " . $e->getMessage());
        }
    }

    public function getStatistics() {
        try {
            $stats = [
                'loans' => $this->getLoanStats(),
                'transfers' => $this->getTransferStats(),
                'members' => $this->getMemberStats(),
                'inquiries' => $this->getInquiryStats()
            ];
            
            return $stats;
        } catch (PDOException $e) {
            error_log("Error getting statistics: " . $e->getMessage());
            return false;
        }
    }

    private function getLoanStats() {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved,
                SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected
            FROM loan_applications
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function getTransferStats() {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved,
                SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected
            FROM saving_transactions 
            WHERE transaction_type = 'transfer'
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function getMemberStats() {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved,
                SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected
            FROM pendingregistermember
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function getInquiryStats() {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'resolved' THEN 1 ELSE 0 END) as resolved
            FROM inquiries
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add this new method to handle termination status updates
    public function updateTerminationStatus($id, $status, $adminRemark = null)
    {
        try {
            $this->db->beginTransaction();

            // First update the termination request
            $sql = "UPDATE termination_requests 
                    SET status = :status, 
                        admin_remark = :admin_remark,
                        updated_at = NOW() 
                    WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':status' => $status,
                ':admin_remark' => $adminRemark
            ]);

            // Get the member ID associated with this termination request
            $sql = "SELECT member_id FROM termination_requests WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            $memberId = $stmt->fetchColumn();

            if ($memberId) {
                // Update the member's status in pendingregistermember table
                $memberStatus = ($status === 'approved') ? 'terminated' : 'active';
                
                $sql = "UPDATE pendingregistermember 
                        SET status = :status,
                            updated_at = NOW()
                        WHERE id = :member_id";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':status' => $memberStatus,
                    ':member_id' => $memberId
                ]);
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error updating termination status: " . $e->getMessage());
            throw new Exception("Failed to update termination status: " . $e->getMessage());
        }
    }

}