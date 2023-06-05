<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (is_logged_in()) {
            check_logged_in_user_type();
        } else {
            $this->signin();
        }
    }

    public function signin()
    {
        if (is_logged_in()) {
            check_logged_in_user_type();
        }

        $data['title'] = 'Sign In - DepEd Online Appointment System';
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('signin', $data);
    }

    public function authenticate()
    {
        $this->load->model('Auth_model', 'auth_model');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            ];

            if (!$this->auth_model->is_user_verified($data['email'])) {
                $this->session->set_flashdata('danger', 'Account not yet verified. Check your email or forgot your password.');
                redirect('signin');
            }

            $user = $this->auth_model->get(['email' => $data['email']]);

            if ($user) {
                if (passwordverify($data['password'], $user->password)) {
                    $this->session->set_userdata(array(
                        'logged_in' => true,
                        'email' => $user->email,
                        'user_id' => $user->user_id,
                        'user_type' => $user->user_type
                    ));

                    if (is_logged_in()) {
                        check_logged_in_user_type();
                    }
                } else {
                    $this->session->set_flashdata('danger', 'Invalid email or password');
                    $this->signin();
                }
            } else {
                $this->session->set_flashdata('danger', 'Invalid email or password');
                $this->signin();
            }
        } else {
            $this->session->set_flashdata('danger', 'Invalid email or password');
            $this->signin();
        }
    }

    public function signup()
    {
        if (is_logged_in()) {
            check_logged_in_user_type();
        }

        $data['title'] = 'Sign Up - DepEd Online Appointment System';
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('signup', $data);
    }

    public function register()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]|min_length[8]');

        if ($this->form_validation->run()) {
            $data = [
                'email' => $this->input->post('email'),
                'password' => passwordhash($this->input->post('password')),
                'token' => random_string('alnum', 25)
            ];

            $this->load->model('Auth_model', 'auth_model');

            if ($this->auth_model->insert($data)) {
                if ($this->send_token($data['email'], $data['token'])) {
                    redirect('/');
                }
            } else {
                $this->session->set_flashdata('danger', 'Please check the details you provided and try again.');
                $this->signup();
            }
        } else {
            $this->session->set_flashdata('danger', 'Please check the details you provided and try again.');
            $this->signup();
        }
    }

    public function send_token($email, $token)
    {
        $config = [
            'mailtype' => 'html'
        ];

        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('no-reply@deped-appointment-system.com', 'DepEd Online Appointment System');
        $this->email->to($email);
        $this->email->subject('Email Verification');
        $message = '<p>Thank you for signing up!</p>';
        $message .= '<p>Please click the link below to verify your email address:</p>';
        $message .= '<p><a href="' . base_url() . 'verify/' . $token . '">Verify Email</a></p>';
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata('success', 'Registration successful. Please check your email for verification.');
            return true;
        } else {
            $this->session->set_flashdata('error', 'There was an error sending the email. Please try again later.');
            return false;
        }
    }

    public function verify($token)
    {
        $this->load->model('Auth_model', 'auth_model');

        $user = $this->auth_model->get(['token' => $token]);

        if ($user) {
            $data = array('token' => random_string('alnum', 25), 'is_verified' => 1);
            $this->auth_model->update($user->user_id, $data);
            $this->session->set_flashdata('success', 'Email verified. You can now login.');
            redirect('signin');
        } else {
            $this->session->set_flashdata('danger', 'Email verification failed. Invalid or expired token.');
            redirect('signup', 'refresh');
        }
    }

    public function forgot()
    {
        $data['title'] = 'Forgot Password - DepEd Online Appointment System';
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('forgot', $data);
    }

    public function newpass($token)
    {
        $data['title'] = 'Set New Password - DepEd Online Appointment System';
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->load->model('Auth_model', 'auth_model');

        $user = $this->auth_model->get(['token' => $token]);

        $token = random_string('alnum', 25);
        $data['token'] = $token;
        if ($user) {
            $this->auth_model->update($user->user_id, array('token' => $token));

            $this->load->view('newpass', $data);
        } else {
            $this->session->set_flashdata('danger', 'Password Reset Failed. Invalid email or expired token.');
            redirect('forgot');
        }
    }

    public function setpass()
    {
        $this->load->model('Auth_model', 'auth_model');

        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('token', 'Token', 'required');

        $token = $this->input->post('token');

        if ($this->form_validation->run()) {
            $data = [
                'password' => passwordhash($this->input->post('password')),
                'token' => $token,
                'new_token' => random_string('alnum', 25)
            ];

            $this->load->model('Auth_model', 'auth_model');

            $result = $this->auth_model->update_pass($data);

            if ($result) {
                $this->session->set_flashdata('success', 'Password has been changed. Try to access your account now with your newly created password.');
                redirect('signin');
            } else {
                $this->session->set_flashdata('danger', 'Password reset failed!');
                redirect('newpass/' . $token);
            }
        } else {
            redirect('newpass/' . $token);
        }
    }

    public function reset()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');

            $this->load->model('Auth_model', 'auth_model');

            $user = $this->auth_model->is_user_verified($email);

            if (!empty($user)) {
                $user = $this->auth_model->is_user_verified($email);

                if ($this->send_password_reset_link($email, $user->token)) {
                    redirect('/');
                } else {
                    redirect('forgot');
                }
            }
        } else {
            redirect('forgot');
        }
    }

    public function send_password_reset_link($email, $token)
    {
        $config = [
            'mailtype' => 'html'
        ];

        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('no-reply@deped-appointment-system.com', 'DepEd Online Appointment System');
        $this->email->to($email);
        $this->email->subject('Password Reset');

        $root_dir = realpath(APPPATH . '../');
        $template_file = $root_dir . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'email-confirmation.html';
        $template = file_get_contents($template_file);

        $search = array('{PASSWORD_RESET_LINK}');
        $replace = array(base_url() . 'newpass/' . $token);
        $template = str_replace($search, $replace, $template);

        $this->email->message($template);

        if ($this->email->send()) {
            $this->session->set_flashdata('success', 'Forgot password successful. Please check your email for the password reset link.');
            return true;
        } else {
            $this->session->set_flashdata('error', 'There was an error sending the email. Please try again later.');
            return false;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(
            array(
                'logged_in',
                'user_id',
                'email',
                'user_type'
            )
        );
        $this->session->sess_destroy();
        redirect('signin');
    }
}
