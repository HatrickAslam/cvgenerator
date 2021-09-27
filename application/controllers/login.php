<?php 

    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Login extends CI_Controller
    {
        
        public function __construct()
        {
            parent::__construct();
            $this->load->model('m_login');
        }

        public function index(){
            $this->load->view('v_login');
        }

        public function act_login(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $where = array(
                            'username' => $username,
                            'password' => md5($password)
                        );
            $cek = $this->m_login->cek_login("user", $where)->num_rows();

            if ($cek > 0) {
                
                $data_session = array(
                                        'name' => $username,
                                        'status' => "login" 
                                    );

                $this->session->set_userdata($data_session);

                redirect(base_url("user"));
            }

            else {
                echo "Wrong username and password !";
            }
        }

        public function logout(){
            $this->session->sess_destroy();
            redirect(base_url('login'));
        }
    }
 