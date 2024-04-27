<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require APPROOT.'/libraries/vendor/autoload.php';

class RequestModel{
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

    public function getAllUnassignedStudentRequests() {
        $this->db->query("SELECT u.userID, u.username FROM user u JOIN donee d ON u.userID = d.doneeID WHERE u.status = 0 AND d.adminID = 0 AND d.doneeType = 'student';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllAssignedStudentRequests() {
        $this->db->query("SELECT u.userID, u.username, d.adminID, a.adminName FROM user u JOIN donee d ON u.userID = d.doneeID LEFT JOIN admin a ON d.adminID = a.adminID WHERE u.status = 0 AND d.adminID != 0 AND d.doneeType = 'student';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllUnassignedOrganizationRequests() {
        $this->db->query("SELECT u.userID, u.username FROM user u JOIN donee d ON u.userID = d.doneeID WHERE u.status = 0 AND d.adminID = 0 AND d.doneeType = 'organization';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllAssignedOrganizationRequests() {
        $this->db->query("SELECT u.userID, u.username, d.adminID, a.adminName FROM user u JOIN donee d ON u.userID = d.doneeID LEFT JOIN admin a ON d.adminID = a.adminID WHERE u.status = 0 AND d.adminID != 0 AND d.doneeType = 'organization';");

        $result = $this->db->resultSet();

        return $result;
    }

    // Student Registration Requests Assigned to Admin himself
    public function getAssignedStudentRequests() {
        $this->db->query("SELECT u.userID, u.username, a.adminName FROM user u JOIN donee d ON u.userID = d.doneeID LEFT JOIN admin a ON d.adminID = a.adminID WHERE u.status = 0 AND d.doneeType = 'student' AND d.adminID = :adminID;");
        $this->db->bind(':adminID', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        return $result;
    }

    // Organization Registration Requests Assigned to Admin himself
    public function getAssignedOrganizationRequests() {
        $this->db->query("SELECT u.userID, u.username, a.adminName FROM user u JOIN donee d ON u.userID = d.doneeID LEFT JOIN admin a ON d.adminID = a.adminID WHERE u.status = 0 AND d.doneeType = 'organization' AND d.adminID = :adminID;");
        $this->db->bind(':adminID', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getStudent($student_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, s.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN student s ON d.doneeID = s.studentID WHERE studentID = :studentID;');
        $this->db->bind(':studentID', $student_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getOrganization($org_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, o.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN organization o ON d.doneeID = o.orgID WHERE orgID = :orgID;');
        $this->db->bind(':orgID', $org_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getDoneeType($donee_ID) {
        $this->db->query('SELECT doneeType FROM donee WHERE doneeID = :doneeID;');
        $this->db->bind(':doneeID', $donee_ID);

        $result = $this->db->single();

        return $result->doneeType;
    }

    public function unassignAdmin($donee_ID) {
        $this->db->query('UPDATE donee SET adminID = 0 WHERE doneeID = :doneeID');
        $this->db->bind(':doneeID', $donee_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function assignAdmin($admin_ID, $donee_ID) {
        $this->db->query('UPDATE donee SET adminID = :adminID WHERE doneeID = :doneeID;');
        $this->db->bind(':adminID', $admin_ID);
        $this->db->bind(':doneeID', $donee_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function assignMe($donee_ID) {
        $this->db->query('UPDATE donee SET adminID = :adminID WHERE doneeID = :doneeID;');
        $this->db->bind(':adminID', $_SESSION['user_id']);
        $this->db->bind(':doneeID', $donee_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function acceptDonee($donee_ID) {
        $this->db->query('UPDATE user SET status = 1 WHERE userID = :userID');
        $this->db->bind(':userID', $donee_ID);

        $name = 'Suruthi';
        $email = 'suruthi0611@gmail.com';

        $message = '
        <div id="overview" style="margin: auto; width: 80%; font-size: 13px">
            <p style="color: black">
                Dear '.$name.',<br><br>
        
                Your land  is now verified. You can now login to your account and start using it.<br>
                <br>
                Best regards,<br>
                eZpark Team
            </p>
        </div>';

        $this->sendEmail($email, $name, 'Your Account Has Been Verified', $message, 'KindHeart');

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function rejectDonee($donee_ID) {
        $this->db->query('UPDATE user SET status = 10 WHERE userID = :userID');
        $this->db->bind(':userID', $donee_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }
}    
