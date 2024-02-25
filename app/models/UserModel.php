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
        $this->db->bind(':userType', $data['userType']);

        if($data['userType'] == 'admin'){
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
    public function getUserIDByEmail($email){
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row->userID;
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

        if($this->db->execute()){
            return true;
        }else
            return false;
            
    }

    public function getUserType($user_ID) {
        $this->db->query('SELECT userType FROM user WHERE userID = :userID');
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

    public function userUnban($username) {
        $this->db->query('UPDATE user SET status = 1 WHERE username = :username;');
        $this->db->bind(':username', $username);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }

    }
}
