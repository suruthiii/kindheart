<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require APPROOT.'/libraries/vendor/autoload.php';

class UserModel{
    private $db;
    private $mail;

    public function __construct(){
        $this->db = new Database();
        $this->mail = new PHPMailer(true);
    }

    public function sendEmail($email, $receiverName, $subject, $message, $senderName){
        $this->mail->isSMTP();                             //Send using SMTP
        $this->mail->Host = 'smtp.gmail.com';              //Set the SMTP server to send through
        $this->mail->SMTPAuth = true;                      //Enable SMTP authentication
        $this->mail->Username = 'kindheart.donations.help@gmail.com';   //SMTP username
        $this->mail->Password = 'uwxi cfzp qjrh ofmt';     //SMTP password
        $this->mail->Port = 587;                           //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

        //Recipients
        $this->mail->setFrom('kindheart.donations.help@gmail.com', $senderName); // Sender 
        $this->mail->addAddress($email, $receiverName);            //Add a recipient

        //Content
        $this->mail->isHTML(true);                     //Set email format to HTML
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $this->mail->send();
    }

    // Admin registration
    public function register($data){
        // Prepare statement
        $this->db->query('INSERT INTO user (username, email, password, userType, status) VALUES (:username, :email, :password, :userType, 1)');

        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':userType', $data['userType']);

        // Execute
        if ($this->db->execute() && $this->updateUserTable($data)){
            return true;
        }
        else {
            return false;
        }
    }

    // Account creation
    public function accountCreation(){
        $this->db->query('INSERT INTO user (username, email, password, userType, status, banCount) VALUES (:username, :email, :password, :userType, 2, 0)');

        // Bind values
        $this->db->bind(':username', $_SESSION['username']);
        $this->db->bind(':email', $_SESSION['user_email']);
        $this->db->bind(':password', $_SESSION['password']);
        $this->db->bind(':userType', $_SESSION['user_type']);

        // Execute
        if ($this->db->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    // Register user
    public function studentRegister(){
        $result = true;
        // Prepare statement
        $this->db->query('INSERT INTO donee (doneeID, phoneNumber, phoneNumberVisibility, doneeType, branchName, bankName, accNumber, accountHoldersName, letterImage, address, addressVisibility, adminID) VALUES (:doneeID, :phoneNumber, :phoneNumberVisibility, :doneeType, :branchName, :bankName, :accNumber, :accountHoldersName, :letterImage, :address, :addressVisibility, 0)');

        // Bind values
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $this->db->bind(':phoneNumber', $_SESSION['contactNo']);
        $this->db->bind(':phoneNumberVisibility', $_SESSION['remember4']);
        $this->db->bind(':doneeType', "student");
        $this->db->bind(':branchName', $_SESSION['branchName']);
        $this->db->bind(':bankName', $_SESSION['bankName']);
        $this->db->bind(':accNumber', $_SESSION['accNumber']);
        $this->db->bind(':accountHoldersName', $_SESSION['accHolderName']);
        $this->db->bind(':letterImage', $_SESSION['letterimage2']);
        $this->db->bind(':address', $_SESSION['address']);
        $this->db->bind(':addressVisibility', $_SESSION['remember3']);

        $result = $result & $this->db->execute();

        // Prepare statement
        $this->db->query('INSERT INTO student (studentID, fName, lName, gender, dateOfBirth, nicNumber, institutionName, institutionNameVisibility, studentType, caregiverName, caregiverNameVisibility, caregiverType, caregiverTypeVisibility, caregiverRelationship, caregiverRelationshipVisibility, caregiverOccupation, caregiverOccupationVisibility, nicFrontImage, nicBackImage, gsCertificateImage, receivingScholarships, studyingYear, studyingYearVisibility) VALUES (:studentID , :fName, :lName, :gender, :dateOfBirth, :nicNumber, :institutionName, :institutionNameVisibility, :studentType, :caregiverName, :caregiverNameVisibility, :caregiverType, :caregiverTypeVisibility, :caregiverRelationship, :caregiverRelationshipVisibility, :caregiverOccupation, :caregiverOccupationVisibility, :nicFrontImage, :nicBackImage, :gsCertificateImage, :receivingScholarships, :studyingYear, :studyingYearVisibility)');

        // Bind values
        $this->db->bind(':studentID', $_SESSION['user_id']);
        $this->db->bind(':fName', $_SESSION['firstName']);
        $this->db->bind(':lName', $_SESSION['lastName']);
        $this->db->bind(':gender', $_SESSION['gender']);
        $this->db->bind(':dateOfBirth', $_SESSION['dob']);
        $this->db->bind(':nicNumber', $_SESSION['nic']);
        $this->db->bind(':institutionName', $_SESSION['orgName']);
        $this->db->bind(':institutionNameVisibility', $_SESSION['remember1']);
        $this->db->bind(':studentType', $_SESSION['studentType']);
        $this->db->bind(':caregiverName', $_SESSION['careName']);
        $this->db->bind(':caregiverNameVisibility', $_SESSION['remember5']);
        $this->db->bind(':caregiverType', $_SESSION['careType']);
        $this->db->bind(':caregiverTypeVisibility', $_SESSION['remember5']);
        $this->db->bind(':caregiverRelationship', $_SESSION['lastName']);
        $this->db->bind(':caregiverRelationshipVisibility', $_SESSION['remember5']);
        $this->db->bind(':caregiverOccupation', $_SESSION['careOccu']);
        $this->db->bind(':caregiverOccupationVisibility', $_SESSION['remember5']);
        $this->db->bind(':nicFrontImage', $_SESSION['letterimage3']);
        $this->db->bind(':nicBackImage', $_SESSION['letterimage4']);
        $this->db->bind(':gsCertificateImage', $_SESSION['letterimage1']);
        $this->db->bind(':receivingScholarships', $_SESSION['schol']);
        $this->db->bind(':studyingYear', $_SESSION['acaYear']);
        $this->db->bind(':studyingYearVisibility', $_SESSION['remember2']);


        $result = $result & $this->db->execute();


        // Update user status
        $this->db->query('UPDATE user SET status = 0 WHERE userID = :userID');
        $this->db->bind(':userID', $_SESSION['user_id']);

        $result = $result & $this->db->execute();


        // Execute
        if ($result){
            return true;
        }
        else {
            return false;
        }
    }

    // Update user tables
    public function updateUserTable($data){

        $this->db->query('SELECT userID FROM user WHERE username = :username AND password = :password');

        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        $row = $this->db->single();
        $id = $row->userID;

        $result = true;

        // Prepare statement
        if ($data['userType'] == 'admin'){
            // Prepare statement
            $this->db->query('INSERT INTO admin (adminID, adminName) VALUES (:id, :name)');

            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':id', $id);

            $result = $this->db->execute();
        }


        // Execute
        if ($result){
            return true;
        }
        else {
            return false;
        }
    }

    // // Update user tables
    public function updatePassword($data){
         // Prepare statement
         $this->db->query('UPDATE user SET password = :password WHERE userID = :userID');
            
         // Bind values
         $this->db->bind(':password', $_SESSION['password']);

         if ($this->db->execute()){
             return true;
         }
         else {
             return false;
         }        
    }

    // Register user
    public function registerUser($data){
        // Prepare statement
        $this->db->query('INSERT INTO user (email, password, userType) VALUES (:email, :password, :userType)');

        // Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':userType', $data['userType']);

        // Execute
        if ($this->db->execute()){
            return true;
        }
        else {
            return false;
        }
    }

        // // View User
        // public function getUser($user_id){
        //     $this->db->query('SELECT * FROM user WHERE user_id = :user_id;');
        //     $this->db->bind(':user_id', $user_id);
    
        //     $row = $this->db->single();
    
        //     return $row;
        // }

    public function createAccount($data){
        // Donee Table
        // Prepare statement
        $this->db->query('INSERT INTO donee (doneeID, address) VALUES (:doneeID, :address)');

        // Bind values
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':doneeID', $_SESSION['user_id']);

        $result1 = $this->db->execute();


        //Student Table
        // Prepare statement
        $this->db->query('INSERT INTO student (studentID, fName, lname, dateOfBirth, gender, studentType) VALUES (:studentID, :firstName, :lastName, :dob, :gender, :studentType)');

        // Bind values
        $this->db->bind(':studentID', $_SESSION['user_id']);
        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':studentType', $data['studentType']);

        $result2 = $this->db->execute();

        return $result1 && $result2;
    }

        // Update Student Table
        public function updateStudentTable($data){
            
            // Prepare statement
            $this->db->query('UPDATE student SET institutionName = :orgName, studyingYear = :acaYear, receivingScholarships = :schol WHERE studentID = :studentID');
            
            // Bind values
            $this->db->bind(':studentID', $_SESSION['user_id']);
            $this->db->bind(':orgName', $data['orgName']);
            $this->db->bind(':acaYear', $data['acaYear']);
            $this->db->bind(':schol', $data['schol']);

            if ($this->db->execute()){
                return true;
            }
            else {
                return false;
            }
        }

        public function updateStudentTableRemain($data){
            
            // Prepare statement
            $this->db->query('UPDATE student SET caregiverType = :careType, caregiverName = :careName, caregiverOccupation = :careOccu, caregiverRelationship = :careRealat WHERE studentID = :studentID');
            
            // Bind values
            $this->db->bind(':studentID', $_SESSION['user_id']);
            $this->db->bind(':careType', $data['careType']);
            $this->db->bind(':careName', $data['careName']);
            $this->db->bind(':careOccu', $data['careOccu']);
            $this->db->bind(':careRealat', $data['careRealat']);

            if ($this->db->execute()){
                return true;
            }
            else {
                return false;
            }
        }

    // public function createAccount2($data){

    //     //Student Table
    //     // Prepare statement
    //     $this->db->query('INSERT INTO student (studentID, institutionName, studyingYear, receivingScholarships) VALUES (:studentID, :orgName, :acaYear, :schol)');

    //     // Bind values
    //     $this->db->bind(':studentID', $_SESSION['user_id']);
    //     $this->db->bind(':orgName', $data['orgName']);
    //     $this->db->bind(':acaYear', $data['acaYear']);
    //     $this->db->bind(':schol', $data['schol']);

    //     //Execute
    //     if ($this->db->execute()){
    //         return true;
    //     }
    //     else {
    //         return false;
    //     }
    // }


    // Update Student Table
    // public function updateStudentTable($data){
        
    //     // Prepare statement
    //     $this->db->query('SELECT studentID FROM student WHERE fName = :firstName AND lname = :lastName AND dateOfBirth = :dob AND gender = :gender AND studentType = :studentType');
        
    //     // Bind values
    //     $this->db->bind(':firstName', $data['firstName']);
    //     $this->db->bind(':lastName', $data['lastName']);
    //     $this->db->bind(':dob', $data['dob']);
    //     $this->db->bind(':gender', $data['gender']);
    //     $this->db->bind(':studentType', $data['studentType']);

    //     $row = $this->db->single();
    //     $id = $row->userID;

    //     $result = true;

    //     // Execute
    //     if ($result){
    //         return true;
    //     }
    //     else {
    //         return false;
    //     }
    // }

    //     // Update Student Table
    //     public function updateDoneeTable($data){
        
    //         // Prepare statement
    //         $this->db->query('SELECT doneeID FROM donee WHERE address = :address');

    //         // Bind values
    //         $this->db->bind(':address', $data['address']);
    
    //         $row = $this->db->single();
    //         $id = $row->userID;
    
    //         $result = true;
    
    //         // Execute
    //         if ($result){
    //             return true;
    //         }
    //         else {
    //             return false;
    //         }
    //     }

    // Find user
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM user WHERE email = :email OR username = :username');
        $this->db->bind(':email', $email);
        $this->db->bind(':username', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    // Find user
    public function getEmailByUsername($username){
        $this->db->query('SELECT u.email FROM user u WHERE username = :username');
        $this->db->bind(':username', $username);

        // Execute query
        $this->db->execute();

        // Check if a row is returned
        if ($this->db->rowCount() > 0) {
            // Fetch the email from the result set
            $result = $this->db->single();
            return $result->email;
        } else {
            return null; // Return null if no email is found for the username
        }
    }

    // Find user
    public function getUserIDByEmail($email){
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row->userID;
    }

    // Login user
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM user WHERE (email = :email OR username = :username) AND (status = 1 OR status = 2);');
        $this->db->bind(':email', $email);
        $this->db->bind(':username', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        
        if (password_verify($password, $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }

    // Find user by username
    public function findUserByUsername($username)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email OR username = :username');
        $this->db->bind(':email', $username);
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    // View admins
    public function viewAdmins(){
        $this->db->query("SELECT admin.* FROM admin JOIN user ON user.userid = admin.adminid WHERE user.status != 10 AND admin.adminName != 'Super Admin' ORDER BY user.userid DESC;");

        $result =  $this->db->resultSet();

        return $result;
    }

    // View admin
    public function getAdmin($admin_ID){
        $this->db->query('SELECT admin.*, user.email, user.username FROM admin JOIN user ON admin.adminID = user.userID WHERE adminID = :adminID;');
        $this->db->bind(':adminID', $admin_ID);

        $row = $this->db->single();

        return $row;
    }

    // Update Admin
    public function updateAdmin($data){
        // Admin Table Update
        $this->db->query('UPDATE admin SET adminName = :adminName WHERE adminID = :adminID;');
        $this->db->bind(':adminID', $data['user_id']);
        $this->db->bind(':adminName', $data['name']);

        $result1 =  $this->db->execute();

        // User Table Update
        $this->db->query('UPDATE user SET username = :username WHERE userID = :userID;');
        $this->db->bind(':userID', $data['user_id']);
        $this->db->bind(':username', $data['username']);

        $result2 =  $this->db->execute();

        return $result1 && $result2;
    }

    // Delete Admin
    public function deleteUser($user_ID) {
        $this->db->query('UPDATE user SET status = 10 WHERE userID = :userID;');
        $this->db->bind(':userID', $user_ID);

        if($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    // User Ban Functionality
    public function banUser($user_ID) {
        date_default_timezone_set('Asia/Colombo');
        
        $this->db->query('UPDATE user SET status = 5, banCount = banCount + 1, bannedTime = :bannedTime WHERE userID = :userID;');
        $this->db->bind(':userID', $user_ID);
        $this->db->bind(':bannedTime', date("Y-m-d H:i:s"));

        $result = $this->db->execute();

        $this->db->query("SELECT * FROM user WHERE userID = :userID;");
        $this->db->bind(':userID', $user_ID);

        $user = $this->db->single();

        $name = $user->username;
        $email = $user->email;

        $message = '
        <div id="overview" style="margin: auto; width: 80%; font-size: 13px">
            <p style="color: black">
                Dear '.$name.',<br><br>
        
                Your account has been banned due to multiple violations of our terms and conditions. You will not be able to access your account for a certain period of time. If you have any queries, please contact us at
                <br> <br>
                Best regards,<br>
                KindHeart Team
            </p>
        </div>';

        $this->sendEmail($email, $name, 'Your Account has been banned', $message, 'KindHeart');
            
        return $result;
    }

    public function getUserType($user_ID) {
        $this->db->query('SELECT userType FROM user WHERE userID = :userID;');
        $this->db->bind(':userID', $user_ID);

        $result = $this->db->single();

        return $result->userType;
    }

    public function checkStatus($username) {
        $this->db->query('SELECT status FROM user WHERE username = :username;');
        $this->db->bind(':username', $username);

        $result = $this->db->single();

        return $result->status;

    }

    public function bannedDetails($username) {
        $this->db->query('SELECT bannedTime, banCount FROM user WHERE username = :username;');
        $this->db->bind(':username', $username);

        $result = $this->db->single();

        $startTime = $result->bannedTime;

        $dateTime1 = new DateTime($startTime);
        $dateTime2 = new DateTime();

        $interval = $dateTime1->diff($dateTime2);

        $totalDays = $interval->days;

        $data = [
            'totalDays' => $totalDays,
            'banCount' => $result->banCount
        ];

        return $data;
    }

    public function unbanUser($username) {
        $this->db->query('UPDATE user SET status = 1 WHERE username = :username;');
        $this->db->bind(':username', $username);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }

    }

    public function viewOrganizations() {
        $this->db->query('SELECT o.orgID, o.orgName FROM organization o JOIN user u ON u.userID = o.orgID WHERE u.status != 10 ORDER BY orgID;');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getOrganization($org_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, o.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN organization o ON d.doneeID = o.orgID WHERE orgID = :orgID;');
        $this->db->bind(':orgID', $org_ID);

        $row = $this->db->single();

        return $row;
    }

    public function viewStudents() {
        $this->db->query('SELECT s.studentID, CONCAT(s.fName, " ", s.lName) AS name FROM student s JOIN user u ON u.userID = s.studentID WHERE u.status != 10 ORDER BY studentID;');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getStudent($student_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, s.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN student s ON d.doneeID = s.studentID WHERE studentID = :studentID;');
        $this->db->bind(':studentID', $student_ID);

        $row = $this->db->single();

        return $row;
    }

    public function viewDonors() {
        $this->db->query('SELECT c.companyID AS donorID, c.companyName AS donorName, d.donorType FROM company c JOIN donor d ON c.companyID = d.donorID JOIN user u ON d.donorID = u.userID WHERE u.status != 10  
        UNION 
        SELECT i.individualID, CONCAT(i.fName, " ", i.lName), d.donorType FROM individual i JOIN donor d ON i.individualID = d.donorID JOIN user u ON d.donorID = u.userID WHERE u.status  != 10; ');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getDonorType($donor_ID) {
        $this->db->query('SELECT donorType FROM donor WHERE donorID = :donorID;');
        $this->db->bind(':donorID', $donor_ID);

        $result = $this->db->single();

        return $result->donorType;
    }

    public function getDoneeType($donee_ID) {
        $this->db->query('SELECT doneeType FROM donee WHERE doneeID = :doneeID;');
        $this->db->bind(':doneeID', $donee_ID);

        $result = $this->db->single();

        return $result->doneeType;
    }

    public function getDonorInd($donor_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, i.* FROM user u JOIN donor d ON u.userID = d.donorID JOIN individual i ON d.donorID = i.individualID WHERE donorID = :donorID;');
        $this->db->bind(':donorID', $donor_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getDonorCom($donor_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, c.* FROM user u JOIN donor d ON u.userID = d.donorID JOIN company c ON d.donorID = c.companyID WHERE donorID = :donorID;');
        $this->db->bind(':donorID', $donor_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getAdminCount() {
        $this->db->query("SELECT COUNT(*) AS adminCount FROM admin a JOIN user u ON a.adminID = u.userID WHERE u.status != 0 AND u.userType != 'superAdmin';");

        $row = $this->db->single();

        return $row->adminCount;
    }

    public function getRequestCount() {
        $this->db->query('SELECT COUNT(*) AS requestCount FROM donee d JOIN user u ON d.doneeID = u.userID WHERE u.status = 0;');

        $row = $this->db->single();

        return $row->requestCount;
    }

    public function getComplaintCount() {
        $this->db->query('SELECT COUNT(*) AS complaintCount FROM complaint;');

        $row = $this->db->single();

        return $row->complaintCount;
    }

    public function getAdminRequestCount() {
        $this->db->query('SELECT COUNT(*) AS requestCount FROM donee d JOIN user u ON d.doneeID = u.userID WHERE u.status = 0 AND d.adminID = 0 OR d.adminID = :adminID;');
        $this->db->bind(':adminID', $_SESSION['user_id']);

        $row = $this->db->single();

        return $row->requestCount;
    }

    public function getAdminComplaintCount() {
        $this->db->query('SELECT COUNT(*) AS complaintCount FROM complaint WHERE adminID = 0 OR adminID = :adminID;');
        $this->db->bind(':adminID', $_SESSION['user_id']);

        $row = $this->db->single();

        return $row->complaintCount;
    }

    public function sendOTP($email){
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $_SESSION['verification_code'] = $verification_code;
        $message = '<div id="overview" style="margin: auto; width: 80%; font-size: 13px">
        <p style="color: black">
            Dear User,<br><br>
    
            Thank you for choosing eZpark! We\'re excited to have you on board. To ensure the security of your account, we require you to verify your registration by entering the One-Time Password (OTP) provided below.
            <br><br>
            Please enter this code on the registration page to complete the verification process. Please note that this OTP is valid for a limited time, so make sure to use it promptly. Your account security is important to us, and we recommend not sharing this OTP with anyone.
            <br>
        </p>
        <p style="font-size: 18px; text-align: center;"><span style=" background-color: #EAEAEAFF; padding:8px; border-radius: 10px;">'.$verification_code.'</span></p>
        <p>
            Best regards,<br>
            eZpark Team
        </p>
        </div>';

        $this->sendEmail('', '', 'Your Account Has Been Verified', $message, 'KindHeart');

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }
}
