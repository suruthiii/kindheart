<?php
class StudentModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }


    public function getStudentDetails($user_ID) {
        $this->db->query('SELECT s.studentID, s.fName, s.lName, s.gender, s.dateOfBirth, s.nicNumber, s.institutionName, s.studentType, s.caregiverName, s.caregiverType, s.caregiverRelationship, s.caregiverOccupation, s.studyingYear, d.phoneNumber, d.branchName, d.bankName, d.accNumber, d.accountHoldersName, d.address FROM student s JOIN donee d ON s.studentID = d.doneeID WHERE studentID = :studentID;');
        $this->db->bind(':studentID', $user_ID);

        $row = $this->db->single();

        return $row;
    }

}
    

    


   

    

    
    



    

