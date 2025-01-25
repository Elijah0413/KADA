<?php
$admin_password_plain = 'admin123';
$admin_password_hashed = password_hash($admin_password_plain, PASSWORD_BCRYPT);
echo $admin_password_hashed;
?>