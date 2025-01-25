<?php
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        
        try {
            // Configure SMTP settings
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.gmail.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'elijahshe04@gmail.com';
            $this->mailer->Password = 'mqdp jjgo mwcj usua';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = 587;
            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->isHTML(true);
            
            // Set default sender
            $this->mailer->setFrom('elijahshe04@gmail.com', 'KADA System');

            // Enable debug output
            $this->mailer->SMTPDebug = 2; // Remove this in production
            $this->mailer->Debugoutput = function($str, $level) {
                error_log("SMTP DEBUG: $str");
            };
        } catch (Exception $e) {
            error_log("Email configuration error: " . $e->getMessage());
        }
    }
    public function sendPasswordResetEmail($email, $token)
    {
        try {
            $this->mailer->clearAddresses();
            
            // Update this URL to match your application's base URL
            $resetLink = "http://localhost:8000/reset-password?token=" . $token;
            
            $this->mailer->setFrom('elijahshe04@gmail.com', 'KADA System');
            $this->mailer->addAddress($email);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Reset Your Password';
            $this->mailer->Body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                    <h2 style='color: #00796b;'>Password Reset Request</h2>
                    <p>You have requested to reset your password. Click the link below to set a new password:</p>
                    <p>
                        <a href='{$resetLink}' 
                           style='background-color: #00796b; 
                                  color: white; 
                                  padding: 10px 20px; 
                                  text-decoration: none; 
                                  border-radius: 5px;
                                  display: inline-block;'>
                            Reset Password
                        </a>
                    </p>
                    <p>If you didn't request this, please ignore this email.</p>
                    <p>This link will expire in 1 hour.</p>
                    <p>Or copy and paste this link in your browser:</p>
                    <p>{$resetLink}</p>
                </div>
            ";

            // Debug log
            error_log("Sending reset password email with link: " . $resetLink);

            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Failed to send password reset email: " . $e->getMessage());
            throw $e;
        }
    }

    // Original verification email method (keep this)
    public function sendVerificationEmail($email, $token)
    {
        try {
            $this->mailer->clearAddresses();
            
            // Update verification link to use port 8000
            $verificationLink = "http://localhost:8000/kada/verify-email?token=" . $token;
            $verificationLink = str_replace('///', '//', $verificationLink);
            
            error_log("Generated verification link: " . $verificationLink);

            $this->mailer->addAddress($email);
            $this->mailer->Subject = 'Verify Your Email Address';
            $this->mailer->Body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                    <h2 style='color: #00796b;'>Welcome to KADA System!</h2>
                    <p>Thank you for registering. Please verify your email address by clicking the link below:</p>
                    <p>
                        <a href='{$verificationLink}' 
                           style='background-color: #00796b; 
                                  color: white; 
                                  padding: 10px 20px; 
                                  text-decoration: none; 
                                  border-radius: 5px;
                                  display: inline-block;'>
                            Verify Email
                        </a>
                    </p>
                    <p>If the button doesn't work, copy and paste this link into your browser:</p>
                    <p>{$verificationLink}</p>
                </div>
            ";

            $result = $this->mailer->send();
            error_log("Email sent with verification link: " . $verificationLink);
            return $result;
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            throw $e;
        }
    }

    // New method for sending custom emails
    public function sendCustomEmail($to, $subject, $body)
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Failed to send custom email: " . $e->getMessage());
            throw $e;
        }
    }

    // Loan approval email
    public function sendLoanApprovalEmail($to, $loanDetails)
    {
        $subject = "Status Permohonan Pinjaman KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Pinjaman KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Dengan sukacitanya kami ingin memaklumkan bahawa permohonan pinjaman anda telah <strong style='color: #4CAF50;'>DILULUSKAN</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Butiran Pinjaman:</strong></p>
                    <p>Jenis Pinjaman: {$loanDetails['loan_type']}</p>
                    <p>Jumlah Pinjaman: RM" . number_format($loanDetails['t_amount'], 2) . "</p>
                    <p>Tempoh: {$loanDetails['period']} bulan</p>
                </div>
                <p>Sila pastikan pembayaran ansuran dibuat sebelum tarikh yang ditetapkan setiap bulan.</p>
                <p>Sekiranya terdapat sebarang pertanyaan, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->sendCustomEmail($to, $subject, $body);
    }

    // Loan rejection email
    public function sendLoanRejectionEmail($to, $loanDetails, $remark)
    {
        $subject = "Status Permohonan Pinjaman KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Pinjaman KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Kami mohon maaf untuk memaklumkan bahawa permohonan pinjaman anda telah <strong style='color: #f44336;'>DITOLAK</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Sebab Penolakan:</strong><br>{$remark}</p>
                </div>
                <p>Anda boleh mengemukakan permohonan baharu.</p>
                <p>Untuk sebarang pertanyaan lanjut, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->sendCustomEmail($to, $subject, $body);
    }

    // Member approval email
    public function sendMemberApprovalEmail($to, $memberDetails)
    {
        $subject = "Status Permohonan Keahlian KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Keahlian KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Tahniah! Permohonan keahlian anda telah <strong style='color: #4CAF50;'>DILULUSKAN</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Butiran Keahlian:</strong></p>
                    <p>Nama: {$memberDetails['name']}</p>
                    <p>No. Ahli: {$memberDetails['member_number']}</p>
                </div>
                <p>Anda kini boleh:</p>
                <ul>
                    <li>Mengakses semua kemudahan ahli KADA</li>
                    <li>Memohon pinjaman</li>
                    <li>Membuat simpanan</li>
                    <li>Menikmati faedah-faedah keahlian</li>
                </ul>
                <p>Selamat datang ke keluarga besar KADA!</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->sendCustomEmail($to, $subject, $body);
    }

    // Member rejection email
    public function sendMemberRejectionEmail($to, $memberDetails, $remark)
    {
        $subject = "Status Permohonan Keahlian KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Keahlian KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Kami mohon maaf untuk memaklumkan bahawa permohonan keahlian anda telah <strong style='color: #f44336;'>DITOLAK</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Sebab Penolakan:</strong><br>{$remark}</p>
                </div>
                <p>Anda boleh mengemukakan permohonan baharu dengan memastikan semua dokumen dan maklumat yang diperlukan lengkap.</p>
                <p>Untuk sebarang pertanyaan lanjut, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->sendCustomEmail($to, $subject, $body);
    }

    // Transfer approval email
    public function sendTransferApprovalEmail($to, $transferDetails)
    {
        $subject = "Status Permohonan Pindahan Wang KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Pindahan Wang KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Dengan sukacitanya kami memaklumkan bahawa permohonan pindahan wang anda telah <strong style='color: #4CAF50;'>DILULUSKAN</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Butiran Pindahan:</strong></p>
                    <p>Jumlah: RM" . number_format($transferDetails['amount'], 2) . "</p>
                    <p>Tarikh Permohonan: {$transferDetails['formatted_date']}</p>
                </div>
                <p>Wang akan dipindahkan ke akaun anda dalam masa 3 hari bekerja.</p>
                <p>Sekiranya terdapat sebarang pertanyaan, sila hubungi pihak kami.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->sendCustomEmail($to, $subject, $body);
    }

    // Transfer rejection email
    public function sendTransferRejectionEmail($to, $transferDetails, $remark)
    {
        $subject = "Status Permohonan Pindahan Wang KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Status Permohonan Pindahan Wang KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Kami mohon maaf untuk memaklumkan bahawa permohonan pindahan wang anda telah <strong style='color: #f44336;'>DITOLAK</strong>.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Sebab Penolakan:</strong><br>{$remark}</p>
                    <p>Jumlah Dipohon: RM" . number_format($transferDetails['amount'], 2) . "</p>
                </div>
                <p>Sila semak semula baki akaun dan had pengeluaran anda sebelum membuat permohonan baharu.</p>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        return $this->sendCustomEmail($to, $subject, $body);
    }

    // Inquiry response notification
    public function sendInquiryResponseNotification($to, $inquiryDetails)
    {
        // Debug log
        error_log("Received inquiry details in email service: " . print_r($inquiryDetails, true));

        $subject = "Maklum Balas Pertanyaan KADA";
        $body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #00796b;'>Maklum Balas Pertanyaan KADA</h2>
                <p>Assalamualaikum dan Salam Sejahtera,</p>
                <p>Pihak kami telah menjawab pertanyaan anda.</p>
                <div style='background-color: #f5f5f5; padding: 15px; margin: 10px 0;'>
                    <p><strong>Pertanyaan Asal:</strong><br>{$inquiryDetails['mesej']}</p>
                    <p><strong>Maklum Balas Admin:</strong><br>{$inquiryDetails['admin_reply']}</p>
                    <p><strong>Tarikh Maklum Balas:</strong><br>{$inquiryDetails['reply_date']}</p>
                </div>
                <p>Untuk sebarang pertanyaan lanjut, sila:</p>
                <ol>
                    <li>Log masuk ke akaun KADA anda</li>
                    <li>Pergi ke bahagian 'Perkhidmatan Pelanggan'</li>
                    <li>Skrol ke bahagian 'Sejarah Mesej'</li>
                    <li>Atau hubungi kami di talian +60 97455388</li>
                </ol>
                <br>
                <p>Yang benar,<br>Pihak Pengurusan KADA</p>
            </div>";

        // Debug log
        error_log("Generated email body: " . $body);

        return $this->sendCustomEmail($to, $subject, $body);
    }
}