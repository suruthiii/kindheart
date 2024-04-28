<?php
class StudentModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }


    public function getStudentDetails($user_ID) {
        $this->db->query('SELECT s.studentID, s.fName, s.lName, s.gender, s.dateOfBirth, s.nicNumber, s.institutionName, s.institutionNameVisibility, s.caregiverNameVisibility, s.caregiverTypeVisibility, s.caregiverRelationshipVisibility, s.caregiverOccupationVisibility, s.studyingYearVisibility, s.studentType, s.caregiverName, s.caregiverType, s.caregiverRelationship, s.caregiverOccupation, s.studyingYear, d.phoneNumber, d.branchName, d.bankName, d.accNumber, d.accountHoldersName, d.address, s.receivingScholarships FROM student s JOIN donee d ON s.studentID = d.doneeID WHERE studentID = :studentID;');
        $this->db->bind(':studentID', $user_ID);

        $row = $this->db->single();

        return $row;
    }


    public function editProfileDetails($data){
       
           // Prepare statement
           $this->db->query('UPDATE student SET fName = :fName, lName = :lName, gender = :gender, dateOfBirth = :dateOfBirth, nicNumber = :nicNumber, institutionName = :institutionName, institutionNameVisibility = :institutionNameVisibility, caregiverNameVisibility = :caregiverNameVisibility, caregiverTypeVisibility= :caregiverTypeVisibility,  caregiverRelationshipVisibility = :caregiverRelationshipVisibility,  caregiverOccupationVisibility = :caregiverOccupationVisibility,  studyingYearVisibility = :studyingYearVisibility, studentType = :studentType, caregiverName = :caregiverName, caregiverType = :caregiverType, caregiverRelationship = :caregiverRelationship, caregiverOccupation = :caregiverOccupation, studyingYear = :studyingYear, receivingScholarships = :receivingScholarships WHERE studentID = :studentID;
           UPDATE donee SET phoneNumber = :phoneNumber, branchName= :branchName, bankName = :bankName, accNumber = :accNumber , accountHoldersName = :accountHoldersName, address = :address WHERE doneeID = :doneeID;');
           
   
           // Bind values
           $this->db->bind(':fName', $data['fName']);
           $this->db->bind(':lName', $data['lName']);
           $this->db->bind(':gender', $data['gender']);
           $this->db->bind(':dateOfBirth', $data['dateOfBirth']);
           $this->db->bind(':nicNumber', $data['nicNumber']);
           $this->db->bind(':institutionName', $data['institutionName']);
           $this->db->bind(':institutionNameVisibility', $data['institutionNameVisibility']);
           $this->db->bind(':caregiverNameVisibility', $data['caregiverNameVisibility']);
           $this->db->bind(':caregiverTypeVisibility', $data['caregiverTypeVisibility']);
           $this->db->bind(':caregiverRelationshipVisibility', $data['caregiverRelationshipVisibility']);
           $this->db->bind(':caregiverOccupationVisibility', $data['caregiverOccupationVisibility']);

           $this->db->bind(':studentType', $data['studentType']);
           $this->db->bind(':caregiverName', $data['caregiverName']);
           $this->db->bind(':caregiverType', $data['caregiverType']);
           $this->db->bind(':caregiverRelationship', $data['caregiverRelationship']);
           $this->db->bind(':caregiverOccupation', $data['caregiverOccupation']);
           $this->db->bind(':studyingYear', $data['studyingYear']);
           $this->db->bind(':studyingYearVisibility', $data['studyingYearVisibility']);
           $this->db->bind(':studentID', $_SESSION['user_id']);
           
           $this->db->bind(':phoneNumber', $data['phoneNumber']);
           $this->db->bind(':branchName', $data['branchName']);
           $this->db->bind(':bankName', $data['bankName']);
           $this->db->bind(':accNumber', $data['accNumber']);
           $this->db->bind(':accountHoldersName', $data['accountHoldersName']);
           $this->db->bind(':address', $data['address']);
           $this->db->bind(':doneeID', $_SESSION['user_id']);
           $this->db->bind(':receivingScholarships', $_SESSION['receivingScholarships']);
           
   
           // Execute
           if ($this->db->execute()) {
               return true;
           } else {
               return false;
           }
    }

}
    

    


   

    

    
    



    

