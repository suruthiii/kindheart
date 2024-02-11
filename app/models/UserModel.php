<?php
class UserModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Register user
    public function register($data){
        // Prepare statement
        $this->db->query('INSERT INTO user (email, password) VALUES (:email, :password)');

        // Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()){
            return true;
        }
        else {
            return false;
        }

        // if ($this->db->execute() && $this->updateUserTable($data)){
        //     return true;
        // }
        // else {
        //     return false;
        // }
    }
    
    // // Update User Table
    // public function updateUserTable($data){

    //     // Prepare statement
    //     $this->db->query('SELECT userID FROM user WHERE email = :email AND password = :password');

    //     // Bind values
    //     $this->db->bind(':email', $data['email']);        
    //     $this->db->bind(':password', $data['password']);

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

    public function createAccount($data){

        // Prepare statement
        $this->db->query('INSERT INTO donee (address) VALUES (:address)');

        // Bind values
        $this->db->bind(':address', $data['address']);

        // Execute
        if ($this->db->execute()){
            return true;
        }
        else {
            return false;
        }

        // Prepare statement
        $this->db->query('INSERT INTO student (fName, lname, dateOfBirth, gender, studentType) VALUES (:firstName, :lastName, :dob, :gender, :studentType)');

        // Bind values

        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':studentType', $data['studentType']);

        // Execute
        if ($this->db->execute()){
            return true;
        }
        else {
            return false;
        }
    }


    // // Update Student Table
    // public function updateStudentTable($data){
        
    //     // Prepare statement
    //     $this->db->query('SELECT studentID FROM student WHERE fName = :firstName AND lname = :lastName AND dateOfBirth = :dob AND gender = :gender AND studentType = :studentType');

    //     $this->db->query('SELECT doneeID FROM donee WHERE address = :address');
    //     // Bind values

    //     $this->db->bind(':firstName', $data['firstName']);
    //     $this->db->bind(':lastName', $data['lastName']);
    //     $this->db->bind(':address', $data['address']);
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

    // Login user
    public function login($email, $password){
        $this->db->query('SELECT * FROM user WHERE (email = :email OR username = :username) AND status = 1;');
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
    public function findUserByUsername($username): bool
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
        $this->db->query('SELECT admin.* FROM admin JOIN user ON user.userid = admin.adminid WHERE user.status != 10 ORDER BY adminName');

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
    public function deleteAdmin($admin_ID) {
        $this->db->query('UPDATE user SET status = 10 WHERE userID = :userID;');
        $this->db->bind(':userID', $admin_ID);

        if($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
}
