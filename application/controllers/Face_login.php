<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Face_login extends CI_Controller {
public function __construct()
    {
        parent::__construct();
        $this->load->library('facebook');
    }

    public function index() 
    {
        
        $this->data['login_url'] = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('face_login/flogin'), 
            'scope' => array("email")));
        $this->load->view('f_login',$this->data);
    }

    public function flogin()
    {
        $user = "";
        $userId = $this->facebook->getUser();
        if ($userId) {
            try {
                $user = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = "";
            }
        }
        else {
            echo 'Please try again.'; exit;
        }
        if($user!="") :
           echo '<pre>'; print_r($user); exit;  
           //Write here login script    
        else :
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('face_login/flogin'), 
                'scope' => array("email") // permissions here
            ));
        endif;
        
    }
}

