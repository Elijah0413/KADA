<?php
namespace App\Models;

use App\Core\Model;
use PDOException;
use Exception;
use PDO;

class Member extends Model
{
    protected $table = 'pendingregistermember';

    private function redirect($path) {
        header("Location: " . $path);
        exit();
    }

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
            // Get the main member data with termination status
            $stmt = $this->db->prepare("
                SELECT 
                    p.*,
                    mt.status as termination_status,
                    mt.created_at as termination_date
                FROM pendingregistermember p
                LEFT JOIN membership_termination mt ON p.ic_no = mt.ic_no 
                    AND mt.status = 'pending'
                WHERE p.user_id = ? 
                ORDER BY p.created_at DESC 
                LIMIT 1
            ");
            $stmt->execute([$userId]);
            $memberData = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($memberData) {
                // Get family members data
                $familyStmt = $this->db->prepare("
                    SELECT id, name, ic_no, relationship 
                    FROM member_family 
                    WHERE member_ic = ?
                ");
                $familyStmt->execute([$memberData['ic_no']]);
                $memberData['family_members'] = $familyStmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            return $memberData;
        } catch (\PDOException $e) {
            error_log("Error in getPendingRegistration: " . $e->getMessage());
            return null;
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

    public function updateProfile($data, $userId) {
        try {
            $this->db->beginTransaction();

            // First get the member's IC from pendingregistermember
            $stmt = $this->db->prepare("SELECT ic_no FROM pendingregistermember WHERE user_id = ?");
            $stmt->execute([$userId]);
            $memberIc = $stmt->fetchColumn();

            if (!$memberIc) {
                throw new \Exception("Member IC not found");
            }

            error_log("Updating profile for member IC: " . $memberIc); // Debug log

            // Update main profile data in pendingregistermember
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
                    home_city = :home_city,
                    home_state = :home_state,
                    office_address = :office_address,
                    office_postcode = :office_postcode,
                    office_city = :office_city,
                    office_state = :office_state,
                    office_phone = :office_phone,
                    home_phone = :home_phone,
                    fax = :fax,
                    status = 'pending',
                    updated_at = NOW()
                    WHERE user_id = :user_id";

            $stmt = $this->db->prepare($sql);
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
                ':home_city' => $data['home_city'] ?? '',
                ':home_state' => $data['home_state'],
                ':office_address' => $data['office_address'],
                ':office_postcode' => $data['office_postcode'],
                ':office_city' => $data['office_city'] ?? '',
                ':office_state' => $data['office_state'] ?? '',
                ':office_phone' => $data['office_phone'],
                ':home_phone' => $data['home_phone'],
                ':fax' => $data['fax'] ?? '',
                ':user_id' => $userId
            ]);

            if (!$result) {
                throw new \Exception("Failed to update profile");
            }

            // Handle family members
            error_log("Processing family members for IC: " . $memberIc); // Debug log
            
            // First, check if there are any existing family members
            $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM member_family WHERE member_ic = ?");
            $checkStmt->execute([$memberIc]);
            $existingCount = $checkStmt->fetchColumn();
            error_log("Existing family members count: " . $existingCount); // Debug log

            // Delete existing family members
            $deleteStmt = $this->db->prepare("DELETE FROM member_family WHERE member_ic = ?");
            $deleteResult = $deleteStmt->execute([$memberIc]);
            error_log("Delete result: " . ($deleteResult ? 'Success' : 'Failed')); // Debug log

            // Insert new/updated family members
            if (!empty($data['family_members']) && is_array($data['family_members'])) {
                $insertStmt = $this->db->prepare("
                    INSERT INTO member_family 
                    (member_ic, name, ic_no, relationship, created_at, updated_at) 
                    VALUES 
                    (:member_ic, :name, :ic_no, :relationship, NOW(), NOW())
                ");

                foreach ($data['family_members'] as $index => $family) {
                    // Skip empty entries
                    if (empty($family['name']) || empty($family['ic_no']) || empty($family['relationship'])) {
                        error_log("Skipping empty family member at index " . $index);
                        continue;
                    }

                    error_log("Inserting family member: " . print_r($family, true)); // Debug log

                    try {
                        $insertResult = $insertStmt->execute([
                            ':member_ic' => $memberIc,
                            ':name' => $family['name'],
                            ':ic_no' => $family['ic_no'],
                            ':relationship' => $family['relationship']
                        ]);

                        if (!$insertResult) {
                            error_log("Failed to insert family member: " . print_r($insertStmt->errorInfo(), true));
                            throw new \Exception("Failed to insert family member");
                        }
                    } catch (\PDOException $e) {
                        error_log("PDO Error inserting family member: " . $e->getMessage());
                        throw $e;
                    }
                }
            } else {
                error_log("No family members to process");
            }

            $this->db->commit();
            error_log("Transaction committed successfully");
            return true;

        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Database error in updateProfile: " . $e->getMessage());
            throw new \Exception("Database error: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->db->rollBack();
            error_log("Error in updateProfile: " . $e->getMessage());
            throw $e;
        }
    }

    public function getFamilyMembers($memberIc) {
        try {
            $stmt = $this->db->prepare("
                SELECT id, name, ic_no, relationship 
                FROM member_family 
                WHERE member_ic = ?
            ");
            $stmt->execute([$memberIc]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error getting family members: " . $e->getMessage());
            return [];
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
                SELECT 
                    p.*,
                    mt.status as termination_status,
                    mt.created_at as termination_date
                FROM pendingregistermember p
                LEFT JOIN membership_termination mt ON p.ic_no = mt.ic_no 
                    AND mt.status = 'pending'
                WHERE p.user_id = ? 
                ORDER BY p.created_at DESC 
                LIMIT 1
            ");
            $stmt->execute([$userId]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error in getMemberApplication: " . $e->getMessage());
            return null;
        }
    }

    public function submitTerminationRequest($data)
    {
        try {
            $sql = "INSERT INTO membership_termination (
                ic_no, 
                reason, 
                reason_details, 
                status, 
                created_at
            ) VALUES (?, ?, ?, 'pending', NOW())";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                $data['ic_no'],
                $data['reason'],
                $data['reason_details']
            ]);
        } catch (PDOException $e) {
            error_log("Error submitting termination request: " . $e->getMessage());
            return false;
        }
    }

    public function getTerminationRequest($icNo)
    {
        try {
            $sql = "SELECT * FROM membership_termination 
                    WHERE ic_no = ? 
                    ORDER BY created_at DESC 
                    LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$icNo]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting termination request: " . $e->getMessage());
            return null;
        }
    }

    public function termination()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        // Get member data
        $memberModel = new Member();
        $member = $memberModel->findByUserId($_SESSION['user_id']);

        if (!$member) {
            $_SESSION['error'] = 'Member not found';
            header('Location: /members/profile');
            exit();
        }

        // Check if there's already a pending termination request
        $existingRequest = $memberModel->getTerminationRequest($member['ic_no']);
        if ($existingRequest && $existingRequest['status'] === 'pending') {
            $_SESSION['error'] = 'Anda telah mempunyai permohonan penamatan yang masih dalam proses.';
            header('Location: /members/profile');
            exit();
        }

        // Load the termination form view
        // $this->view('members/termination_form', [
        //     'member' => $member
        // ]);
    }

    public function submitTermination()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        // Validate form submission
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /members/profile');
            exit();
        }

        // Validate required fields
        if (empty($_POST['reason_1']) || !isset($_POST['declaration'])) {
            $_SESSION['error'] = 'Sila isi semua maklumat yang diperlukan.';
            header('Location: /members/termination');
            exit();
        }

        try {
            $memberModel = new Member();
            
            // Get member data to verify IC
            $member = $memberModel->findByUserId($_SESSION['user_id']);
            if (!$member) {
                throw new \Exception('Member not found');
            }

            // Prepare data for submission
            $data = [
                'ic_no' => $_POST['ic_no'],
                'reason_1' => $_POST['reason_1'],
                'reason_2' => !empty($_POST['reason_2']) ? $_POST['reason_2'] : null,
                'reason_3' => !empty($_POST['reason_3']) ? $_POST['reason_3'] : null,
                'declaration' => isset($_POST['declaration']) ? 1 : 0,
                'submission_date' => $_POST['submission_date']
            ];

            // Submit termination request
            $memberModel->submitTerminationRequest($data);

            // Set success message
            $_SESSION['success'] = 'Permohonan penamatan keahlian anda telah berjaya dihantar.';
            header('Location: /members/profile');

        } catch (\Exception $e) {
            error_log("Error in submitTermination: " . $e->getMessage());
            $_SESSION['error'] = 'Ralat telah berlaku. Sila cuba lagi.';
            header('Location: /members/termination');
            exit();
        }
    }

}