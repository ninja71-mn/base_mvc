<?php


class UsersController extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $_SESSION['nav'] = "users";

        $notifications = $this->userModel->allNotify();
        global $notify;
        $notify = [
            'notifications' => $notifications
        ];

    }

    public function dashboard()
    {
        if (!$this->adminIsLoggedIn() && !$this->Master() && !$this->userIsLoggedIn()) {
            redirect('users/login');
            exit();
        }

            $user = $this->userModel->userInfo($_SESSION['user_id']);
            $paid = $this->userModel->paidBalanceLimit($_SESSION['user_id']);
            $balance = $this->userModel->balanceLimit($_SESSION['user_id']);

            $data = [
                'user' => $user,
                'paid'=>$paid,
                'balance'=>$balance
            ];

            $this->view('users/dashboard', $data);

    }

    public function login()
    {
        if ($this->adminIsLoggedIn() || $this->Master() || $this->userIsLoggedIn() || $this->boosterIsLoggedIn()) {
                redirect('users/dashboard');
                exit();
        }
        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];
            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            }
            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            }

            // Check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
                // User found

            } else {
                //User not found
                $data['email_err'] = 'The information entered is incorrect';
                $data['password_err'] = 'The information entered is incorrect';
            }

            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // Create Session
                    if ($loggedInUser->verify == 0) {
                        $data['email_err'] = 'Your account is awaiting approval by Admins';
                        $this->View('users/login', $data);
                    } else {
                        $this->userModel->activityUserByEmail($data['email']);
                        $this->createUserSession($loggedInUser);
                    }
                } else {
                    $data['email_err'] = 'The information entered is incorrect';
                    $data['password_err'] = 'The information entered is incorrect';
                    $this->View('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->View('users/login', $data);
            }

        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            // Load View
            $this->View('users/login', $data);
        }
    }

    public function register()
    {
        if ($this->adminIsLoggedIn() || $this->Master() || $this->userIsLoggedIn()) {
            redirect('users/dashboard');
            exit();
        }
        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'لطفا ایمیل خود را وراد نمایید';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'invalid email';
            } else {
                //check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'این ایمیل قبلا ثبت شده';
                }
            }

            // Validate Username
            if (empty($data['username'])) {
                $data['username_err'] = 'لطفا نام کاربری خود را وراد نمایید';
            } elseif (strlen($data['username']) < 3) {
                $data['username_err'] = 'رمز عبور باید بیش از 3 کاراکتر باشد';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'لطفا رمز عبور خود را وراد نمایید';
            } elseif (strlen($data['password']) < 7) {
                $data['password_err'] = 'رمز عبور باید بیش از 7 کاراکتر باشد';
            }

            // Validate confirm_password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'لطفا تایید رمز عبور خود را وراد نمایید';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'رمز عبور با تایید رمز عبور یکسان نیست';
            }
            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['username_err']) && empty($data['password_err']) && empty
                ($data['confirm_password_err'])) {
                // Validated
                //hash password
                $data['password'] = password_hash(md5($data['password']), PASSWORD_DEFAULT);
                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'ثبت نام شما موفق بود، میتوانید وارد شوید');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->View('users/register', $data);
            }
        } else {

            // Init data
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // Load View
            $this->View('users/register', $data);
        }
    }




}