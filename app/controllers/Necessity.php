<?php
class Necessity extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        // $this->middleware->checkAccess(['admin']);
    }

    public function viewAdminNecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('necessity/viewAdminNecessity', $data);
    }

    
}