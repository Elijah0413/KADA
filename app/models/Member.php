<?php
namespace App\Models;

use App\Core\Model;
use PDOException;
use Exception;
use PDO;

class Member extends Model
{
    protected $table = 'pendingregistermember';


    public function findByUserId($userId)
    {
        try {
            $stmt = $this->getConnection()->prepare("
                SELECT 
                    m.*,
                    u.ic_no,
                    u.email
                FROM {$this->table} m
                JOIN users u ON m.user_id = u.id
                WHERE m.user_id = :user_id
            ");
            
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error finding member by user_id: " . $e->getMessage());
            return false;
        }
    }

    public function getPendingRegistration($userId)
    {
        try {
            // First get the pending registration data
            $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            $pendingData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($pendingData) {
                // Get family members for this registration
                $familySQL = "SELECT * FROM member_family WHERE member_ic = :member_ic ORDER BY id ASC";
                $familyStmt = $this->db->prepare($familySQL);
                $familyStmt->execute(['member_ic' => $pendingData['ic_no']]);
                $familyMembers = $familyStmt->fetchAll(PDO::FETCH_ASSOC);

                // Add family members to the pending data
                $pendingData['family_members'] = $familyMembers;
            }

            return $pendingData;

        } catch (\PDOException $e) {
            error_log("Database error in getPendingRegistration: " . $e->getMessage());
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    public function submitInquiry($data) {
        try {
            $stmt = $this->getConnection()->prepare('INSERT INTO inquiries (user_id, subject, message, created_at) VALUES (:user_id, :subject, :message, NOW())');
            
            return $stmt->execute([
                ':user_id' => $data['user_id'],
                ':subject' => $data['subject'],
                ':message' => $data['message']
            ]);
        } catch (PDOException $e) {
            error_log("Error submitting inquiry: " . $e->getMessage());
            return false;
        }
    }

    public function getInquiriesByUserId($userId) {
        try {
            $stmt = $this->getConnection()->prepare('
                SELECT * FROM inquiries 
                WHERE user_id = :user_id 
                ORDER BY created_at DESC
            ');
            
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error getting inquiries: " . $e->getMessage());
            return false;
        }
    }

    public function getSavingAccount($userIc) {
        try {
            // First check if the IC belongs to an approved member
            $memberStmt = $this->getConnection()->prepare("
                SELECT * FROM pendingregistermember 
                WHERE ic_no = :ic_no AND status = 'approved'
            ");
            
            $memberStmt->execute([':ic_no' => $userIc]);
            $member = $memberStmt->fetch(\PDO::FETCH_ASSOC);
            
            if (!$member) {
                return false; // Not an approved member
            }
            
            // If approved member, get their saving account
            $stmt = $this->getConnection()->prepare("
                SELECT * FROM saving_accounts 
                WHERE user_ic = :user_ic
            ");
            
            $stmt->execute([':user_ic' => $userIc]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting saving account: " . $e->getMessage());
            return false;
        }
    }

    // Helper method to get user's IC from their user_id
    public function getUserIc($userId) {
        try {
            error_log("Checking user ID: " . $userId); // Debug log
            
            $stmt = $this->getConnection()->prepare("
                SELECT ic_no FROM pendingregistermember 
                WHERE user_id = :user_id AND status = 'approved'
            ");
            
            $stmt->execute([':user_id' => $userId]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            error_log("Result: " . ($result ? "Found IC: " . $result['ic_no'] : "No IC found")); // Debug log
            
            return $result ? $result['ic_no'] : false;
        } catch (PDOException $e) {
            error_log("Error getting user IC: " . $e->getMessage());
            return false;
        }
    }

    public function getTransactionHistory($accountId) {
        try {
            $stmt = $this->getConnection()->prepare("
                SELECT * FROM saving_transactions 
                WHERE account_id = :account_id 
                ORDER BY transaction_date DESC
            ");
            
            $stmt->execute([':account_id' => $accountId]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting transaction history: " . $e->getMessage());
            return false;
        }
    }

    public function createTransaction($data) {
        try {
            $stmt = $this->getConnection()->prepare("
                INSERT INTO saving_transactions 
                (account_id, transaction_type, amount, description, transaction_date) 
                VALUES (:account_id, :type, :amount, :description, NOW())
            ");
            
            return $stmt->execute([
                ':account_id' => $data['account_id'],
                ':type' => $data['type'],
                ':amount' => $data['amount'],
                ':description' => $data['description']
            ]);
        } catch (PDOException $e) {
            error_log("Error creating transaction: " . $e->getMessage());
            return false;
        }
    }

    public function updateBalance($accountId, $amount, $isDeposit = true) {
        try {
            $sql = "UPDATE saving_accounts 
                   SET balance = balance " . ($isDeposit ? '+' : '-') . " :amount 
                   WHERE id = :account_id";
            
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute([
                ':amount' => $amount,
                ':account_id' => $accountId
            ]);
        } catch (PDOException $e) {
            error_log("Error updating balance: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Process a transaction with balance update
     */
    public function processTransaction($accountId, $type, $amount, $description) {
        try {
            $this->getConnection()->beginTransaction();

            // Create the transaction record
            $transactionData = [
                'account_id' => $accountId,
                'type' => $type,
                'amount' => $amount,
                'description' => $description
            ];
            
            // Add transaction record
            $success = $this->createTransaction($transactionData);
            
            if ($success) {
                // Update account balance
                $isDeposit = ($type === 'deposit');
                $success = $this->updateBalance($accountId, $amount, $isDeposit);
            }

            if ($success) {
                $this->getConnection()->commit();
                return true;
            } else {
                $this->getConnection()->rollBack();
                return false;
            }
        } catch (PDOException $e) {
            $this->getConnection()->rollBack();
            error_log("Error processing transaction: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get account summary including total deposits and withdrawals
     */
    public function getAccountSummary($accountId) {
        try {
            $stmt = $this->getConnection()->prepare("
                SELECT 
                    SUM(CASE WHEN transaction_type = 'deposit' THEN amount ELSE 0 END) as total_deposits,
                    SUM(CASE WHEN transaction_type = 'transfer' THEN amount ELSE 0 END) as total_transfers,
                    COUNT(*) as total_transactions
                FROM saving_transactions 
                WHERE account_id = :account_id
            ");
            
            $stmt->execute([':account_id' => $accountId]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting account summary: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get monthly transaction summary
     */
    public function getMonthlyTransactionSummary($accountId, $year = null, $month = null) {
        try {
            if (!$year) $year = date('Y');
            if (!$month) $month = date('m');

            $stmt = $this->getConnection()->prepare("
                SELECT 
                    transaction_type,
                    COUNT(*) as transaction_count,
                    SUM(amount) as total_amount
                FROM saving_transactions 
                WHERE account_id = :account_id 
                AND YEAR(transaction_date) = :year 
                AND MONTH(transaction_date) = :month
                GROUP BY transaction_type
            ");
            
            $stmt->execute([
                ':account_id' => $accountId,
                ':year' => $year,
                ':month' => $month
            ]);
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting monthly summary: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Validate transaction amount and balance
     */
    public function validateTransaction($accountId, $amount, $type) {
        try {
            if ($type === 'transfer') {
                $stmt = $this->getConnection()->prepare("
                    SELECT balance FROM saving_accounts 
                    WHERE id = :account_id
                ");
                
                $stmt->execute([':account_id' => $accountId]);
                $account = $stmt->fetch(\PDO::FETCH_ASSOC);
                
                if (!$account || $account['balance'] < $amount) {
                    return false; // Insufficient funds
                }
            }
            
            return true;
        } catch (PDOException $e) {
            error_log("Error validating transaction: " . $e->getMessage());
            return false;
        }
    }

    public function processDeposit($userId, $amount, $paymentMethod, $remarks) {
        try {
            $this->db->beginTransaction();

            // Get user's saving account
            $account = $this->getSavingAccount($this->getUserIc($userId));
            if (!$account) {
                throw new \Exception("Saving account not found");
            }

            // Update balance immediately for deposits
            $sql = "UPDATE saving_accounts SET balance = balance + ?, updated_at = NOW() WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$amount, $account['id']]);

            // Record transaction with 'approved' status for deposits
            $sql = "INSERT INTO saving_transactions 
                   (account_id, transaction_type, amount, description, status, transaction_date) 
                   VALUES (?, 'deposit', ?, ?, 'approved', NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$account['id'], $amount, $remarks]);

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Error processing deposit: " . $e->getMessage());
            throw new \Exception("Error processing deposit: " . $e->getMessage());
        }
    }

    public function requestTransfer($accountId, $amount, $purpose, $remarks) {
        try {
            $this->db->beginTransaction();

            // Combine purpose and remarks
            $description = trim($purpose . ': ' . $remarks);
            
            // Record withdrawal request with 'pending' status
            $sql = "INSERT INTO saving_transactions 
                   (account_id, transaction_type, amount, description, status, transaction_date) 
                   VALUES (?, 'transfer', ?, ?, 'pending', NOW())";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$accountId, $amount, $description]);

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Database Error in requestTransfer: " . $e->getMessage());
            throw new \Exception("Database error while processing transfer request: " . $e->getMessage());
        }
    }

    // Add method for admin to approve/reject transfers
    public function updateTransferStatus($transactionId, $status) {
        try {
            $this->db->beginTransaction();

            // Get transaction details
            $sql = "SELECT * FROM saving_transactions WHERE id = ? AND transaction_type = 'transfer'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$transactionId]);
            $transaction = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$transaction) {
                throw new \Exception("Transaction not found");
            }

            // Update transaction status
            $sql = "UPDATE saving_transactions SET status = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$status, $transactionId]);

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
            error_log("Error updating transfer status: " . $e->getMessage());
            return false;
        }
    }

    public function createSavingAccount($userIc) {
        try {
            $this->db->beginTransaction();

            // Get member's deposit_funds value
            $sql = "SELECT deposit_funds FROM pendingregistermember WHERE ic_no = ? AND status = 'approved'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userIc]);
            $memberData = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$memberData) {
                throw new \Exception("Member data not found or not approved");
            }

            // Generate unique account number (SA + Year + 5 random digits)
            $accountNumber = 'SA' . date('Y') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

            // Create saving account with initial balance from deposit_funds
            $sql = "INSERT INTO saving_accounts (
                user_ic, 
                account_number, 
                balance
            ) VALUES (?, ?, ?)";

            $stmt = $this->db->prepare($sql);
            $success = $stmt->execute([
                $userIc,
                $accountNumber,
                $memberData['deposit_funds'] // Set initial balance to deposit_funds
            ]);

            if (!$success) {
                throw new \Exception("Failed to create saving account");
            }

            // Get the new account ID
            $accountId = $this->db->lastInsertId();

            // Record the initial deposit transaction
            if ($memberData['deposit_funds'] > 0) {
                $sql = "INSERT INTO saving_transactions (
                    account_id,
                    transaction_type,
                    amount,
                    description,
                    status,
                    transaction_date
                ) VALUES (?, 'deposit', ?, 'Initial deposit from registration', 'approved', NOW())";

                $stmt = $this->db->prepare($sql);
                $stmt->execute([$accountId, $memberData['deposit_funds']]);
            }

            $this->db->commit();
            return true;

        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Error creating saving account: " . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            $this->db->rollBack();
            error_log("Error in createSavingAccount: " . $e->getMessage());
            return false;
        }
    }

    public function updateProfile($data)
    {
        try {
            $this->db->beginTransaction();

            // Update main profile data
            $sql = "UPDATE pendingregistermember SET 
                    name = :name,
                    gender = :gender,
                    religion = :religion,
                    race = :race,
                    marital_status = :marital_status,
                    member_number = :member_number,
                    pf_number = :pf_number,
                    position = :position,
                    grade = :grade,
                    monthly_salary = :monthly_salary,
                    home_address = :home_address,
                    home_postcode = :home_postcode,
                    home_state = :home_state,
                    office_phone = :office_phone,
                    home_phone = :home_phone,
                    fax = :fax,
                    status = :status,
                    updated_at = NOW()
                    WHERE user_id = :user_id";

            $stmt = $this->db->prepare($sql);
            
            // Execute the main profile update
            $result = $stmt->execute([
                ':name' => $data['name'],
                ':gender' => $data['gender'],
                ':religion' => $data['religion'],
                ':race' => $data['race'],
                ':marital_status' => $data['marital_status'],
                ':member_number' => $data['member_number'],
                ':pf_number' => $data['pf_number'],
                ':position' => $data['position'],
                ':grade' => $data['grade'],
                ':monthly_salary' => $data['monthly_salary'],
                ':home_address' => $data['home_address'],
                ':home_postcode' => $data['home_postcode'],
                ':home_state' => $data['home_state'],
                ':office_phone' => $data['office_phone'],
                ':home_phone' => $data['home_phone'],
                ':fax' => $data['fax'],
                ':status' => $data['status'],
                ':user_id' => $data['user_id']
            ]);

            if (!$result) {
                throw new \Exception("Failed to update main profile data");
            }

            // Update family members
            if (isset($data['family_members'])) {
                // Get member's IC number
                $memberIcStmt = $this->db->prepare("SELECT ic_no FROM pendingregistermember WHERE user_id = :user_id");
                $memberIcStmt->execute([':user_id' => $data['user_id']]);
                $memberData = $memberIcStmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$memberData) {
                    throw new \Exception("Member data not found");
                }

                // First, delete existing family members
                $deleteSql = "DELETE FROM member_family WHERE member_ic = :member_ic";
                $deleteStmt = $this->db->prepare($deleteSql);
                $deleteStmt->execute([':member_ic' => $memberData['ic_no']]);

                // Then insert new family members
                $insertSql = "INSERT INTO member_family (member_ic, name, ic_no, relationship) 
                              VALUES (:member_ic, :name, :ic_no, :relationship)";
                $insertStmt = $this->db->prepare($insertSql);

                foreach ($data['family_members'] as $member) {
                    $insertStmt->execute([
                        ':member_ic' => $memberData['ic_no'],
                        ':name' => $member['name'],
                        ':ic_no' => $member['ic_no'],
                        ':relationship' => $member['relationship']
                    ]);
                }
            }

            $this->db->commit();
            return true;

        } catch (\Exception $e) {
            $this->db->rollBack();
            error_log("Error in updateProfile: " . $e->getMessage());
            throw $e;
        }
    }

    public function getPendingRegisterMember($userId) {
        $query = "SELECT registration_fee, share_capital, fee_capital, welfare_fund, deposit_funds, fixed_deposit 
                  FROM pendingregistermember 
                  WHERE user_id = :user_id 
                  ORDER BY created_at DESC 
                  LIMIT 1";
                  
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateSavingAccount($userId, $amount) {
        $query = "UPDATE savings_account 
                  SET balance = balance + :amount 
                  WHERE user_id = :user_id";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':amount' => $amount,
            ':user_id' => $userId
        ]);
    }

    public function recordPaymentTransaction($userId, $amount, $paymentMethod) {
        $query = "INSERT INTO transactions (user_id, type, amount, payment_method, status) 
                  VALUES (:user_id, 'payment', :amount, :payment_method, 'completed')";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':user_id' => $userId,
            ':amount' => $amount,
            ':payment_method' => $paymentMethod
        ]);
    }

    public function getPaymentDates($userId) {
        try {
            $sql = "SELECT 
                        p.*,
                        COALESCE(
                            (SELECT transaction_date 
                             FROM saving_transactions st 
                             JOIN saving_accounts sa ON st.account_id = sa.id 
                             WHERE sa.user_ic = p.ic_no 
                             AND st.description LIKE '%fee payment%'
                             ORDER BY transaction_date DESC 
                             LIMIT 1), 
                            p.created_at
                        ) as last_payment_date,
                        DATE_ADD(
                            COALESCE(
                                (SELECT transaction_date 
                                 FROM saving_transactions st 
                                 JOIN saving_accounts sa ON st.account_id = sa.id 
                                 WHERE sa.user_ic = p.ic_no 
                                 AND st.description LIKE '%fee payment%'
                                 ORDER BY transaction_date DESC 
                                 LIMIT 1), 
                                p.created_at
                            ), 
                            INTERVAL 1 MONTH
                        ) as next_payment_date
                    FROM pendingregistermember p
                    WHERE p.user_id = :user_id";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting payment dates: " . $e->getMessage());
            return false;
        }
    }

    public function getMemberApplication($userId) {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM pendingregistermember 
                WHERE user_id = ? 
                ORDER BY created_at DESC 
                LIMIT 1
            ");
            $stmt->execute([$userId]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error in getMemberApplication: " . $e->getMessage());
            return null;
        }
    }

}