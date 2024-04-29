<?php

class SuccessStory extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only students are allowed to access student pages
        $this->middleware->checkAccess(['student', 'organization', 'donor', 'admin', 'superAdmin']);
        $this->successStoryModel = $this->model('SuccessStoryModel');
        $this->userModel = $this->model('UserModel');
        $this->notificationModel = $this->model('NotificationModel');
    }


    public function story($other_data = null){
        $data = [
            'title' => 'Home page',
            'story' => $this->SuccessStoryModel->getStoryEditData()
        ];

        $this->view('student/successstory', $data, $other_data);
    }

    public function imgUpload($file){
        $file_name = $_FILES[$file]['name'];
        $file_size = $_FILES[$file]['size'];
        $tmp_name = $_FILES[$file]['tmp_name'];
        $error = $_FILES[$file]['error'];

        if ($error === 0){
            $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_ex_lc = strtolower($file_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($file_ex_lc, $allowed_exs)){
                // Move into ParkingPhotos folder
                $new_file_name = uniqid("IMG-", true).'.'.$file_ex_lc;
                $file_upload_path = PUBLICROOT.'/uploads/'.$new_file_name;

                move_uploaded_file($tmp_name, $file_upload_path);
                return $new_file_name;
            }

            else{
                $data['err'] = "You can't upload files of this type";
                return $data;
            }
        }
    }

    public function addSuccessStory(){  
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                $data = [
                    'title' => trim($_POST['title']),
                    'storyDescription' => trim($_POST['storyDescription']),
                    'imagePath' => $this->imgUpload('image'),
                    'err' => ''
                ];

                // Make sure errors are empty
                if (empty($data['err'])) {
                    // die(print_r($data));
                
                    // Add Data to DB
                    if ($this->successStoryModel->addSuccessStory($data)) {
                        if($_SESSION['user_type'] == 'student') {
                            redirect('student/successstory');
                        }
                        else if ($_SESSION['user_type'] == 'organization') {
                            redirect('organization/successstory');
                        }
                        else {
                            die('User Type Not Found');
                        }
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    // die('Something went wrong');
                    $this->story($data);
                }
            }else{
                die('incorrect method!');
            }

            // Pass data to the view 
            $successStories = $this->successStoryModel->getSuccessStories();

            if($_SESSION['user_type'] == 'student') {
                $this->view('student/successstory', $successStories); 
            }
            
            else if ($_SESSION['user_type'] == 'organization') {
                $this->view('organization/successstory', $successStories);
            }

            else {
                die('User Type Not Found');
            }
        }
    }

    public function viewSuccessStory(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home page',
                'stories' => $this->successStoryModel->getUserSuccessStories()
            ];
            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            if ($_SESSION['user_type'] == 'student') {
                $this->view('student/viewSuccessStory', $data,$other_data );
            }
            
            else if ($_SESSION['user_type'] == 'organization') {
                $this->view('organization/viewSuccessStory', $data);
            }

            else {
                die('User Type Not Found');
            }
        }
    }


    public function viewOwnSuccessStory($storyID = null){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home page',
                'stories' => $this->successStoryModel->getStoryEditData($storyID)
            ];
            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            if ($_SESSION['user_type'] == 'student') {
                $this->view('student/viewStory', $data, $other_data );
            }
            
            else if ($_SESSION['user_type'] == 'organization') {
                $this->view('organization/viewStory', $data);

            }

            else {
                die('User Type Not Found');
            }
        }
    }

    // view edit successstory page
    public function editStory(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {   
            $storyID = $_GET['storyID'];
            $data = [
                'storyID' => $storyID,
                'title' => 'Home page',
                'storyData' => $this->successStoryModel->getStoryEditData($storyID)
            ];
            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];
          
            
            if ($_SESSION['user_type'] == 'student') {
                $this->view('student/editStory', $data, $other_data);
            }
            
            else if ($_SESSION['user_type'] == 'organization') {
                $this->view('organization/editStory', $data);
            }

            else {
                die('User Type Not Found');
            }
        }
    }


    // edit successstory data
    public function editSuccessStory(){  
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $data = [
                'title' => trim($_POST['title']),
                'storyDescription' => trim($_POST['storyDescription']),
                'imagePath' => $this->imgUpload('image'),
                'storyID' => trim($_POST['storyID']),
                'err' => ''
            ];


            // Make sure errors are empty
            if (empty($data['err'])) {
            
                // Add Data to DB
                if ($this->successStoryModel->editSuccessStory($data)) {
                    if ($_SESSION['user_type'] == 'student') {
                        redirect('student/successstory');
                    }
                    
                    else if ($_SESSION['user_type'] == 'organization') {
                        redirect('organization/successstory');
                    }
        
                    else {
                        die('User Type Not Found');
                    }
                    
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                // die('Something went wrong');
                $backend_data = $this->SuccessStoryModel->getStoryEditData($data['storyID']);

                $story_data = [
                    'title' => 'Edit Admin',
                    'story_details' => [
                        'storyID' => $backend_data->storyID,
                        'title' => $backend_data->title, 
                        'description' => $backend_data->description,
                        'username' => $backend_data->username

                    ],
                    'err' => $data['err']
                ];
                
                if ($_SESSION['user_type'] == 'student') {
                    $this->view('student/editStory', $story_data);
                }
                
                else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/editStory', $story_data);
                }
    
                else {
                    die('User Type Not Found');
                }
            }
        }else{
            die('incorrect method!');
        }

        // Pass data to the view 
        $successStories = $this->successStoryModel->getSuccessStories();

        if ($_SESSION['user_type'] == 'student') {
            $this->view('student/successstory', $successStories); 
        }
        
        else if ($_SESSION['user_type'] == 'organization') {
            $this->view('organization/successstory', $successStories);
        }

        else {
            die('User Type Not Found');
        }   
    }
    
    // delete success story
    public function deleteStory(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'storyID' => $_POST['storyID']
            ];
            
            $this->successStoryModel->deleteStory($data);

            if ($_SESSION['user_type'] == 'student') {
                redirect('successstory/viewSuccessStory');
            }
            
            else if ($_SESSION['user_type'] == 'organization') {
                redirect('successstory/viewSuccessStory');
            }
    
            else {
                die('User Type Not Found');
            }     
        }
    }
}    