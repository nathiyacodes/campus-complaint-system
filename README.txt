CAMPUSCARE - SMART CAMPUS COMPLAINT MANAGEMENT SYSTEM
Stack: PHP 8+, MySQL/MariaDB, HTML, CSS, JavaScript, XAMPP.

INSTALLATION
1. Extract this folder into C:\xampp\htdocs\smart_campus
2. Start Apache and MySQL in the XAMPP Control Panel.
3. Open http://localhost/phpmyadmin/
4. Import schema.sql using the Import tab.
5. Open db.php and check database credentials. Default XAMPP is user root, blank password.
6. Open http://localhost/smart_campus/
7. Create the first administrator at http://localhost/smart_campus/admin_setup.php
8. Sign in at http://localhost/smart_campus/admin_login.php
9. After creating the first administrator, remove admin_setup.php from the web folder.

FEATURES
- Student registration and private complaint history.
- Staff registration with admin approval required before login.
- Admin approves/rejects pending staff and assigns complaints to approved staff.
- Staff can view/update only complaints assigned to their own account.
- Staff dashboard does not display student names or emails.
- Admin can view identity for complaint administration.
- Prepared statements, password_hash/password_verify, role checks, session regeneration,
  HTML output escaping and CSRF tokens on POST forms.

NOT INCLUDED
Email verification, password reset, uploads, rate limiting, audit log, production HTTPS setup.
This is a local hackathon starter. Do not expose it directly to the public internet.
