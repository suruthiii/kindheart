<?php
class UserModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Register user
    public function register($data){
        // Prepare statement
        $this->db->query('INSERT INTO user (username, email, password, userType, status, banCount) VALUES (:username, :email, :password, :userType, :status, 0)');

        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':userType', $data['user_type']);

        if($data['user_type'] == 'admin'){
            $this->db->bind(':status', 1);
        }
        else{
            $this->db->bind(':status', 0);
        }

        // Execute
        if ($this->db->execute() && $this->updateUserTable($data)){
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
        if ($data['user_type'] == 'admin'){
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
    public function login($email, $password)
    {
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

    // User Ban Functionality
    public function userBan($user_ID) {
        $this->db->query('UPDATE user SET status = 5, banCount = banCount + 1, bannedTime = :bannedTime WHERE userID = :userID');
        $this->db->bind(':userID', $user_ID);
        $this->db->bind(':bannedTime', date("Y-m-d H:i:s"));

        if($this->db->execute()) {
            return true;
        }

        else
            return false;
    }

    public function getUserType($user_ID) {
        $this->db->query('SELECT userType FROM user WHERE userID = :userID');
        $this->db->bind(':userID', $user_ID);

        $result = $this->db->single();

        return $result->userType;
    }
}
