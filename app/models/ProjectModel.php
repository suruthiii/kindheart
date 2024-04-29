<?php
class ProjectModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    /*-------------------------------Admin and Super Admin---------------------------------*/
    public function getAllPendingProjects() {
        $this->db->query('SELECT projectID, title, (budget - receivedAmount) AS amount, description FROM project WHERE status = 0; ');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllConfirmedProjects() {
        $this->db->query('SELECT projectID, title, budget AS amount, description FROM project WHERE status = 1; ');
        
        $result = $this->db->resultSet();
        
        return $result;
    }

    public function getAllOngoingProjects() {
        $this->db->query('SELECT projectID, title, budget AS amount, description FROM project WHERE status = 3; ');
        
        $result = $this->db->resultSet();
        
        return $result;
    }

    public function getProjectDetails($project_ID) {
        $this->db->query('SELECT p.title, p.budget, p.receivedAmount, p.description, o.orgID, o.orgName FROM project p JOIN organization o ON p.orgID = o.orgID WHERE p.projectID = :projectID;');
        $this->db->bind(':projectID', $project_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getAllComments($project_ID) {
        $this->db->query("SELECT c.postID, c.comment, a.adminName FROM comment c JOIN admin a ON c.adminID = a.adminID WHERE c.postID = :postID AND c.postType = 'project' ORDER BY time DESC;");
        $this->db->bind(':postID', $project_ID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function addComment($data) {
        $this->db->query("INSERT INTO comment (postID, adminID, time, postType, comment) VALUES (:postID, :adminID, :time, 'project', :comment);");
        $this->db->bind(':postID', $data['project_ID']);
        $this->db->bind(':adminID', $_SESSION['user_id']);
        $this->db->bind(':time', date("Y-m-d H:i:s"));
        $this->db->bind(':comment', $data['comment']);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function getUserType($user_ID) {
        $this->db->query('SELECT userType FROM user WHERE userID = :userID;');
        $this->db->bind(':userID', $user_ID);

        $row = $this->db->single();

        return $row->userType;
    }

    public function restrictProject($project_ID) {
        $this->db->query('UPDATE project SET status = 5 WHERE projectID = :projectID;');
        $this->db->bind(':projectID', $project_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function getMilestoneCardDetails($project_ID) {
        $this->db->query('SELECT milestoneID, milestoneName, amount, status FROM milestone WHERE projectID = :projectID');
        $this->db->bind(':projectID', $project_ID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getMilestoneDetails($project_ID) {
        $this->db->query('SELECT milestoneName, description, amount, receivedAmount,  ');
    }

    public function getOrganizationID($project_ID) {
        $this->db->query('SELECT orgID FROM project WHERE projectID = :projectID');
        $this->db->bind(':projectID', $project_ID);

        $orgID = $this->db->single()->orgID;

        return $orgID;
    }

    /*---------------------------------------------------------------------------------*/

    public function dettheeachprojecthaddonationcount($projectID){
        $this->db->query("SELECT COUNT(*) AS donationCount FROM fund
            WHERE fund.projectID = :projectID");
            $this->db->bind(':projectID', $projectID);

        $donationCountResult = $this->db->single();

        return $donationCountResult->donationCount;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //chnage state if the milestone got a donation
    public function changeStateforProjectasone(){
        $this->db->query("SELECT project.*, milestone.* FROM project JOIN milestone ON project.projectID = milestone.projectID WHERE project.status = 0 AND project.orgID = :doneeID");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
    
        foreach($result as $project){
            $this->db->query("SELECT COUNT(*) AS donationCount FROM fund WHERE fund.projectID = :projectID");
            $this->db->bind(':projectID', $project->projectID);
            $donationCountResult = $this->db->single();
    
            if($donationCountResult->donationCount > 0){
                // Use parameterized query to prevent SQL injection
                $this->db->query("UPDATE project SET status = 1 WHERE projectID = :projectID");
                $this->db->bind(':projectID', $project->projectID);
                $this->db->execute();
            }
        }
    }

    //change the verificationstate if the donor submit a bankslip
    public function changeVerificationstateoffunds(){
        $this->db->query("SELECT fund.*, project.*, milestone.* FROM fund 
                      JOIN project ON fund.projectID = project.projectID 
                      JOIN milestone ON project.projectID = milestone.projectID 
                      WHERE project.status = 1 AND project.orgID = :doneeID");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
    
        foreach($result as $project){
            if ($project->paymentSlip !== NULL) {
                // Update verification status to 'Verified'
                $this->db->query("UPDATE fund SET verificationStatus = 3 WHERE fund.paymentSlip IS NOT NULL AND projectID = :projectID");
                $this->db->bind(':projectID', $project->projectID);
                $this->db->execute();
            }
        }
    }

    public function getaddedongoingprojects(){
        // state check
        $this->changeStateforProjectasone();
        $this->changeVerificationstateoffunds();

        $this->db->query('SELECT projectID, title, budget, description FROM project WHERE status = 0; ');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getstaeoneprojects(){
        $this->db->query('SELECT projectID, title, budget, description FROM project WHERE status = 1; ');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getaddedcompletedprojects(){
        $this->db->query('SELECT projectID, title, budget, description FROM project WHERE status = 2; ');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getallProjectDetilsstateone($projectID){
        $this->db->query("SELECT fund.*, project.*, milestone.*, user.username,
                    fund.amount AS fund_amount,
                    project.description AS project_description,
                    milestone.description AS milestone_description
                    FROM fund 
                    JOIN project ON fund.projectID = project.projectID 
                    JOIN milestone ON project.projectID = milestone.projectID 
                    JOIN donor ON fund.donorID = donor.donorID 
                    JOIN user ON donor.donorID = user.userID
                    WHERE project.status = 1 AND project.orgID = :doneeID AND project.projectId = $projectID");

        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();

        return $result;
    }

    public function getprojectdetailsbyID($projectID){
        $this->db->query("SELECT * FROM project WHERE projectID = :projectID");
        $this->db->bind(':projectID', $projectID);
        $result = $this->db->single(); // Assuming you expect only one result
    
        return $result;
    }

    public function projectsentacknowlagement($data){
        $this->db->query('UPDATE fund SET acknowledgement = 1 WHERE fundID = :fundID');
        $this->db->bind(':fundID', $data['fundID']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function donorsdonatedtoprojects($projectID){
        $this->db->query("SELECT u.username, f.amount, f.verificationStatus,f.fundID, f.acknowledgement  
                        FROM fund f
                        JOIN donor d ON f.donorID = d.donorID
                        JOIN user u ON d.donorID = u.userID
                        JOIN project p ON f.projectID = p.projectID
                        WHERE f.projectID = :projectID AND p.status = 1");
        $this->db->bind(':projectID', $projectID);
        $result = $this->db->resultSet(); // Since multiple donors can donate to a project
    
        return $result;
    }

    

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    

    public function addprojectstodb($data){
        //sql statement for adding projects to projects table
        $this->db->query('INSERT INTO project(title,budget,status,description,orgID) 
        VALUES (:title, :budget, :status, :description, :doneeID)');

        // Binding values with array value
        $this->db->bind(':title', $data['projectTitle']);
        $this->db->bind(':budget', $data['totalMilestoneBudget']);
        $this->db->bind(':description', $data['projectDescription']);
        $this->db->bind(':status', 0);
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        //execute querry to add project
        $result = $this->db->execute();

        if($result){
            //get the last Inserted Id from the database
            $result1 = $this->db->query('SELECT LAST_INSERT_ID() as last_id;');
            $row = $this->db->single();
            $projectID  = $row->last_id;

            echo $projectID;
            //store monetaryId in the session
            $_SESSION['projectID'] = $projectID ;

            foreach ($data['projectsmilestones'] as $key => $projectsmilestones){
                //sql statement for adding monetary necessity, money table
                $this->db->query('INSERT INTO milestone(milestoneName ,description,amount,img1,img2,status,projectID ) 
                VALUES (:milestoneName, :description, :amount, :img1, :img2, :status, :projectID)');

                // Binding values with array value
                $this->db->bind(':milestoneName', $projectsmilestones);
                $this->db->bind(':description', $data['milestonedescription'][$key]);
                $this->db->bind(':amount', $data['milestonebudget'][$key]);
                $this->db->bind(':img1', $data['firstprojectImagesPath'][$key]);
                $this->db->bind(':img2', $data['seconprojectImagesPath'][$key]);
                $this->db->bind(':status', 0);
                $this->db->bind(':projectID', $_SESSION['projectID']);

                $result2 = $this->db->execute();

                if (!$result2) {
                    // Print error message for debugging
                    printf("Error: %s\n", $this->db->getError());
                    return false;
                }
            }
            
            return true;
        }else{
            return false;
        }
     
    }

    // Deleting projects
    public function deleteProjects($projectID){
        // Query statement
        $this->db->query('UPDATE project SET status = 10 WHERE projectID = :projectID');
        $this->db->bind(':projectID', $projectID);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function editprojectdetailstodb($data){
        $this->db->query("UPDATE project SET  title = :title ,description = :description WHERE projectID = :projectID");
        $this->db->bind(':title', $data['projectTitle']);
        $this->db->bind(':description', $data['projectDescription']);
        $this->db->bind(':projectID', $data['projectID']);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getallProjectDetils($projectID){
        $this->db->query("SELECT project.projectID, project.title, project.budget, project.budget, project.receivedAmount, project.status AS project_status, project.description AS project_description
                        FROM project WHERE project.status = 0 AND project.projectID = :projectID");
        $this->db->bind(':projectID', $projectID);

        $result = $this->db->single();
        return $result;

    }

    public function getallCompletedProjectDetils($projectID){
        $this->db->query("SELECT project.projectID, project.title, project.budget, project.budget, project.receivedAmount, project.status AS project_status, project.description AS project_description
                        FROM project WHERE project.status = 2 AND project.projectID = :projectID");
        $this->db->bind(':projectID', $projectID);

        $result = $this->db->single();
        return $result;

    }

    public function getAllMilestoneDetails($projectID){
        $this->db->query("SELECT milestone.milestoneID, milestone.milestoneName, milestone.description AS milestone_description, milestone.amount, milestone.img1, milestone.img2, milestone.status AS milestone_status
                        FROM milestone WHERE milestone.projectID = :projectID");
        $this->db->bind(':projectID', $projectID);

        $result = $this->db->resultSet();
        return $result;
        var_dump($result);
    }

    
}    