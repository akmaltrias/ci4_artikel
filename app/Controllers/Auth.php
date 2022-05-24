<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $user;
    public function __construct()
    {
        helper(['url', 'form']);
        $this->user = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation(),
        ];

        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
        ];

        return view('auth/register', $data);
    }

    public function save()
    {
        // validasi pengisian form register
        $validation = $this->validate([
            'nama' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[t_users.email]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'Masukan email dengan benar',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[12]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} harus berisi minimal 8 karakter',
                    'max_length' => '{field} tidak lebih dari 12 karakter'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|min_length[8]|max_length[12]|matches[password]',
                'errors' => [
                    'required' => 'konfirmasi password belum diisi',
                    'min_length' => 'password konfirmasi harus berisi minimal 8 karakter',
                    'max_length' => 'password konfirmasi tidak lebih dari 12 karakter',
                    'matches' => 'password konfirmasi tidak sama'
                ]
            ]
        ]);

        if (!$validation) {
            $data = [
                'title' => 'Register',
                'validation' => $this->validator
            ];

            return view('auth/register', $data);
        } else {
            //insert ke database 
            //mengambil data input dari form

            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];

            $query =  $this->user->insert($data);

            if (!$query) {
                return redirect()->back()->with('error', "Tidak Berhasil Melakukan Regist");
            } else {
                return redirect()->to(base_url('/auth'))->with('success', "Berhasil menambahkan User");
            }
        }
    }

    public function check()
    {
        //validasi input
        // validasi pengisian form register
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[t_users.email]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'masukan email dengan benar',
                    'is_not_unique' => "email belum terdaftar, lakukan register"
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ]);

        if (!$validation) {
            return redirect()->to(base_url('/auth'))->withInput();
        } else {
            //jika sudah diisi mari kita check
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            //cari user
            $user = $this->user->where('email', $email)
                ->first();

            //validasi user
            if ($user) {
                //ambil user password user
                $verify_pass = password_verify($password,  $user['password']);

                //validasi password  
                if ($verify_pass) {
                    //buat session jika password benar
                    $session_user = [
                        'id_user' => $user['id_user'],
                        'nama' => $user['nama'],
                        'logged_in' => true
                    ];

                    session()->set('loggedInUser', $session_user);
                    session()->setFlashdata('success', 'Anda Berhasil Login');
                    return redirect()->to(base_url() . '/artikel');
                } else {
                    session()->setFlashdata('fail', 'Password Anda Salah');
                    return redirect()->to(base_url() . '/auth')->withInput();
                }
            }
        }
    }

    public function logout()
    {
        //logout here
        if (session()->has("loggedInUser")) {
            session()->destroy();
            session()->setFlashdata('error', 'Anda Berhasil Logout');
            return redirect()->to(base_url() . "/auth");
        }
    }
}
