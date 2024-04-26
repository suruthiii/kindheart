<?php
class ProjectModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

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

    public function getaddedongoingprojects(){
        $this->db->query('SELECT projectID, title, budget, description FROM project WHERE status = 0; ');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getaddedcompletedprojects(){
        $this->db->query('SELECT projectID, title, budget, description FROM project WHERE status = 2; ');

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
    }

    public function getMilestoneCardDetails($project_ID) {
        $this->db->query('SELECT milestoneID, milestoneName, amount, status FROM milestone WHERE projectID = :projectID');
        $this->db->bind(':projectID', $project_ID);

        $result = $this->db->resultSet();

        return $result;
    }
}    