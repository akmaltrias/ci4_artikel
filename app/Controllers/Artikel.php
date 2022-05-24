<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    protected $artikel;
    public function __construct()
    {
        //model di deklarasikan pada contruct agar dapat selalu digunakan
        $this->artikel = new ArtikelModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'artikel' => $this->artikel->getArtikel(),
            'userLog' => session()->get('loggedInUser')
        ];

        return view('artikel/index', $data);
    }

    public function baca($id)
    {
        $data = [
            'title' => 'Judul Artikel',
            'artikel' => $this->artikel->getArtikel($id),
            'user' => session()->get('loggedInUser')
        ];

        return view('artikel/baca', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Artikel',
            'userLog' => session()->get('loggedInUser')
        ];

        // echo \CodeIgniter\CodeIgniter::CI_VERSION;

        return view('artikel/tambah', $data);
    }

    public function save()
    {
        //validation 
        $validation = $this->validate([
            'judul' => [
                'rules' => 'required|min_length[8]|max_length[50]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'isi {field} minimal 8 karakter',
                    'max_length' => 'isi {field} tidak lebih dari 50 karakter'
                ]
            ],
            'isi' => [
                'rules' => 'required|min_length[50]',
                'errors' => [
                    'required' => 'artikel harus diisi',
                    'min_length' => 'isi artikel minimal 50 karakter'
                ]
            ]
        ]);

        if (!$validation) {
            $data = [
                'title' => 'Tambah Artikel',
                'validation' => $this->validator,
                'userLog' => session()->get('loggedInUser')
            ];

            return view('artikel/tambah', $data);
        } else {
            $userLog = session()->get('loggedInUser');


            $data_artikel = [
                'id_user' => intval($userLog['id_user']),
                'judul' => $this->request->getPost('judul'),
                'isi' => htmlspecialchars($this->request->getPost('isi'))
            ];

            // dd($data_artikel);
            $query  = $this->artikel->save($data_artikel);

            if (!$query) {
                return redirect()->to(base_url('/beranda'))->with('error', "Tidak Berhasil Menambahkan Artikel");
            } else {
                return redirect()->to(base_url('/beranda'))->with('success', "Berhasil menambahkan Artikel");
            }
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Artikel',
            'artikel' => $this->artikel->getArtikel($id),
            'user' => session()->get('LoggedInUser')
        ];

        return view('artikel/edit', $data);
    }

    public function simpanUbah($id)
    {
        $validation = $this->validate([
            'judul' => [
                'rules' => 'required|min_length[8]|max_length[50]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'isi {field} minimal 8 karakter',
                    'max_length' => 'isi {field} maksimal 50 karakter'
                ]
            ],
            'isi' => [
                'rules' => 'required|min_length[50]',
                'errors' => [
                    'required' => 'Kolom harus di{field} ',
                    'min_length' => 'Kolom diisi minimal 50 karakter'
                ]
            ]

        ]);

        if (!$validation) {
            $data = [
                'title' => 'Edit Artikel',
                'validation' => $this->validator,
                'artikel' => $this->artikel->getArtikel($id)
            ];

            return view('artikel/edit', $data);
        } else {
            $userLog = session()->get('loggedInUser');

            $data_artikel = [
                'id_artikel' => $id,
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi')
            ];

            $query = $this->artikel->save($data_artikel);

            if (!$query) {
                return redirect()->to(base_url('/beranda'))->with('error', 'Artikel Tidak Berhasil DiUbah');
            } else {
                return redirect()->to(base_url('/beranda'))->with('success', 'Artikel Berhasil Diubah');
            }
        }
    }

    public function hapus($id)
    {
        $query = $this->artikel->delete($id);

        if (!$query) {
            return redirect()->to(base_url('/beranda'))->with("error", "Tidak Berhasil Mengahpus Data");
        } else {
            return redirect()->to(base_url('/beranda'))->with('success', "Berhasil Menghapus Artikel");
        }
    }
}
