<?php
namespace App\Models;

use App\Core\Model;
use PDOException;
use Exception;

class User extends Model
{
    protected $table = 'users';

    // Update fillable fields to include email
    protected $fillable = ['ic_no', 'password', 'role', 'email', 'verification_token', 'email_verified'];

    // Find user by IC Number (assuming 'ic_number' is equivalent to 'email' in original code)
    public function findByIcNumber($icNumber)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE ic_number = :ic_number LIMIT 1");
        $stmt->execute(['ic_number' => $icNumber]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Find user by IC No (assuming 'ic_no' is equivalent to 'ic_no' in original code)
    public function findByIcNo($icNo)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE ic_no = :ic_no LIMIT 1");
        $stmt->execute(['ic_no' => $icNo]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Register a new user
    public function register($data)
    {
        try {
            // Generate verification token
            $verificationToken = bin2hex(random_bytes(32));
            
            $stmt = $this->db->prepare("
                INSERT INTO {$this->table} (
                    ic_no, 
                    password, 
                    email,
                    verification_token,
                    email_verified,
                    role
                ) VALUES (
                    :ic_no, 
                    :password, 
                    :email,
                    :verification_token,
                    :email_verified,
                    :role
                )
            ");
            
            return $stmt->execute([
                'ic_no' => $data['ic_no'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                'email' => $data['email'],
                'verification_token' => $verificationToken,
                'email_verified' => 0,
                'role' => 'user'
            ]);
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            throw $e;
        }
    }

    // Create a new user with email verification
    public function create($data)
    {
        try {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            
            $stmt = $this->db->prepare("
                INSERT INTO {$this->table} (
                    ic_no, 
                    password, 
                    email, 
                    verification_token, 
                    email_verified, 
                    role
                ) VALUES (
                    :ic_no, 
                    :password, 
                    :email, 
                    :verification_token, 
                    :email_verified, 
                    :role
                )
            ");

            $result = $stmt->execute([
                'ic_no' => $data['ic_no'],
                'password' => $hashedPassword,
                'email' => $data['email'],
                'verification_token' => $data['verification_token'],
                'email_verified' => $data['email_verified'],
                'role' => isset($data['role']) ? $data['role'] : 'user'
            ]);

            if ($result) {
                return $this->db->lastInsertId();
            }
            return false;

        } catch (PDOException $e) {
            error_log("Error creating user: " . $e->getMessage());
            throw $e;
        }
    }

    // Fetch all users (for admin)
    public function all()
    {
        $stmt = $this->db->query("SELECT id, ic_no, role, created_at, updated_at FROM {$this->table}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Find user by ID
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT id, ic_no, role, created_at, updated_at FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function savePendingMemberProfile($data)
    {
        try {
            $this->db->beginTransaction();

            // Remove family members data from main data array
            $familyMembers = $data['family_members'] ?? [];
            unset($data['family_members']);

            // First, insert or update the main member record
            $sql = "INSERT INTO pendingregistermember (
                    name, ic_no, gender, religion, race, marital_status,
                    member_number, pf_number, position, grade, monthly_salary,
                    home_address, home_postcode, home_state, office_address,
                    office_postcode, office_phone, home_phone, fax, status, 
                    user_id, registration_fee, share_capital, fee_capital,
                    deposit_funds, welfare_fund, fixed_deposit
                ) VALUES (
                    :name, :ic_no, :gender, :religion, :race, :marital_status,
                    :member_number, :pf_number, :position, :grade, :monthly_salary,
                    :home_address, :home_postcode, :home_state, :office_address,
                    :office_postcode, :office_phone, :home_phone, :fax, :status,
                    :user_id, :registration_fee, :share_capital, :fee_capital,
                    :deposit_funds, :welfare_fund, :fixed_deposit
                ) ON DUPLICATE KEY UPDATE
                    name = VALUES(name),
                    gender = VALUES(gender),
                    religion = VALUES(religion),
                    race = VALUES(race),
                    marital_status = VALUES(marital_status),
                    member_number = VALUES(member_number),
                    pf_number = VALUES(pf_number),
                    position = VALUES(position),
                    grade = VALUES(grade),
                    monthly_salary = VALUES(monthly_salary),
                    home_address = VALUES(home_address),
                    home_postcode = VALUES(home_postcode),
                    home_state = VALUES(home_state),
                    office_address = VALUES(office_address),
                    office_postcode = VALUES(office_postcode),
                    office_phone = VALUES(office_phone),
                    home_phone = VALUES(home_phone),
                    fax = VALUES(fax),
                    status = VALUES(status),
                    user_id = VALUES(user_id),
                    registration_fee = VALUES(registration_fee),
                    share_capital = VALUES(share_capital),
                    fee_capital = VALUES(fee_capital),
                    deposit_funds = VALUES(deposit_funds),
                    welfare_fund = VALUES(welfare_fund),
                    fixed_deposit = VALUES(fixed_deposit)";

            $stmt = $this->db->prepare($sql);
            
            $result = $stmt->execute([
                ':name' => $data['name'],
                ':ic_no' => $data['ic_no'],
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
                ':office_address' => $data['office_address'] ?? '',
                ':office_postcode' => $data['office_postcode'] ?? '',
                ':office_phone' => $data['office_phone'],
                ':home_phone' => $data['home_phone'],
                ':fax' => $data['fax'] ?? null,
                ':status' => 'pending',
                ':user_id' => $data['user_id'],
                ':registration_fee' => $data['registration_fee'] ?? 0,
                ':share_capital' => $data['share_capital'] ?? 0,
                ':fee_capital' => $data['fee_capital'] ?? 0,
                ':deposit_funds' => $data['deposit_funds'] ?? 0,
                ':welfare_fund' => $data['welfare_fund'] ?? 0,
                ':fixed_deposit' => $data['fixed_deposit'] ?? 0
            ]);

            if (!$result) {
                throw new \Exception("Failed to save member data");
            }

            // Delete existing family members
            $deleteStmt = $this->db->prepare("DELETE FROM member_family WHERE member_ic = :member_ic");
            $deleteStmt->execute([':member_ic' => $data['ic_no']]);

            // Insert new family members
            if (!empty($familyMembers)) {
                $familyStmt = $this->db->prepare("
                    INSERT INTO member_family 
                    (member_ic, name, ic_no, relationship) 
                    VALUES (:member_ic, :name, :ic_no, :relationship)
                ");

                foreach ($familyMembers as $family) {
                    // Skip empty entries
                    if (empty($family['name']) || empty($family['ic_no']) || empty($family['relationship'])) {
                        continue;
                    }

                    $familyResult = $familyStmt->execute([
                        ':member_ic' => $data['ic_no'],
                        ':name' => $family['name'],
                        ':ic_no' => $family['ic_no'],
                        ':relationship' => $family['relationship']
                    ]);

                    if (!$familyResult) {
                        throw new \Exception("Failed to save family member data");
                    }
                }
            }

            $this->db->commit();
            return true;

        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Database error in savePendingMemberProfile: " . $e->getMessage());
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    // Add this new method to check if user has pending registration
    public function hasPendingRegistration($userId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM pendingregistermember WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchColumn() > 0;
    }

    // Find user by email
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Verify email
    public function verifyEmail($token)
    {
        try {
            error_log("Attempting to verify email with token: " . $token);
            
            // First, check if token exists and is valid
            $stmt = $this->db->prepare("
                SELECT id, email 
                FROM {$this->table} 
                WHERE verification_token = :token 
                AND email_verified = 0
            ");
            $stmt->execute([':token' => $token]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user) {
                error_log("No unverified user found with token: " . $token);
                return false;
            }

            // Update user to verified status
            $updateStmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET email_verified = 1,
                    verification_token = NULL
                WHERE id = :id
            ");
            
            $result = $updateStmt->execute([':id' => $user['id']]);
            
            error_log("Verification update result: " . ($result ? 'success' : 'failed'));
            error_log("Rows affected: " . $updateStmt->rowCount());
            
            return $result && $updateStmt->rowCount() > 0;
            
        } catch (PDOException $e) {
            error_log("Database error during verification: " . $e->getMessage());
            return false;
        }
    }

    // Check if email is verified
    public function isEmailVerified($userId)
    {
        $stmt = $this->db->prepare("
            SELECT email_verified 
            FROM {$this->table} 
            WHERE id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return (bool) $stmt->fetchColumn();
    }

    // Add this method to help with debugging
    public function findByToken($token)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM {$this->table} 
                WHERE verification_token = :token
            ");
            $stmt->execute([':token' => $token]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error finding user by token: " . $e->getMessage());
            return false;
        }
    }

    public function debugVerification($token)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM {$this->table} 
                WHERE verification_token = :token
            ");
            $stmt->execute([':token' => $token]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            error_log("Debug - User found: " . ($user ? 'Yes' : 'No'));
            if ($user) {
                error_log("Debug - User data: " . print_r($user, true));
            }
            
            return $user;
        } catch (PDOException $e) {
            error_log("Debug - Database error: " . $e->getMessage());
            return false;
        }
    }

    public function findByIcNoAndEmail($icNo, $email)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM {$this->table} 
                WHERE ic_no = :ic_no AND email = :email
                LIMIT 1
            ");
            $stmt->execute([
                ':ic_no' => $icNo,
                ':email' => $email
            ]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error finding user: " . $e->getMessage());
            return false;
        }
    }

    public function saveResetToken($userId, $token)
    {
        try {
            $stmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET reset_token = :token,
                    reset_token_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR)
                WHERE id = :user_id
            ");
            return $stmt->execute([
                ':token' => $token,
                ':user_id' => $userId
            ]);
        } catch (PDOException $e) {
            error_log("Error saving reset token: " . $e->getMessage());
            return false;
        }
    }

    public function resetPasswordWithToken($token, $newPassword)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id FROM {$this->table}
                WHERE reset_token = :token
                AND reset_token_expires > NOW()
                LIMIT 1
            ");
            $stmt->execute([':token' => $token]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user) {
                return false;
            }

            $stmt = $this->db->prepare("
                UPDATE {$this->table}
                SET password = :password,
                    reset_token = NULL,
                    reset_token_expires = NULL
                WHERE id = :user_id
            ");
            return $stmt->execute([
                ':password' => password_hash($newPassword, PASSWORD_DEFAULT),
                ':user_id' => $user['id']
            ]);
        } catch (PDOException $e) {
            error_log("Error resetting password: " . $e->getMessage());
            return false;
        }
    }

    public function getUserDataByToken($token)
    {
        try {
            error_log("Looking up user data for token: " . $token);
            
            $stmt = $this->db->prepare("
                SELECT id, ic_no, password as current_password
                FROM {$this->table}
                WHERE reset_token = :token
                AND reset_token_expires > NOW()
                LIMIT 1
            ");
            $stmt->execute([':token' => $token]);
            $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            error_log("Query result: " . print_r($userData, true));
            
            if ($userData) {
                $userData['current_password'] = '**';
            } else {
                error_log("No user found for token or token expired");
            }
            
            return $userData;
        } catch (PDOException $e) {
            error_log("Error getting user data: " . $e->getMessage());
            return false;
        }
    }

}