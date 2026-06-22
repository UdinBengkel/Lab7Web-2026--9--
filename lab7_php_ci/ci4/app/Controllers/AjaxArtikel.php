<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class AjaxArtikel extends BaseController
{
    // Halaman utama AJAX
    public function index()
    {
        return view('ajax/index');
    }

    // Ambil semua data artikel → return JSON
    public function getData()
    {
        $model = new ArtikelModel();
        $data  = $model->findAll();
        return $this->response->setJSON($data);
    }

    // Hapus artikel → return JSON
    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        return $this->response->setJSON([
            'status'  => 'OK',
            'message' => 'Data berhasil dihapus.',
        ]);
    }

    // Tambah artikel baru → return JSON
    public function add()
    {
        $model = new ArtikelModel();
        $model->insert([
            'judul'  => $this->request->getPost('judul'),
            'isi'    => $this->request->getPost('isi'),
            'slug'   => url_title($this->request->getPost('judul')),
            'status' => $this->request->getPost('status') ?? 0,
        ]);
        return $this->response->setJSON([
            'status'  => 'OK',
            'message' => 'Data berhasil ditambahkan.',
        ]);
    }

    // Update artikel → return JSON
    public function update($id)
    {
        $model = new ArtikelModel();
        $model->update($id, [
            'judul'  => $this->request->getPost('judul'),
            'isi'    => $this->request->getPost('isi'),
            'status' => $this->request->getPost('status') ?? 0,
        ]);
        return $this->response->setJSON([
            'status'  => 'OK',
            'message' => 'Data berhasil diubah.',
        ]);
    }
}