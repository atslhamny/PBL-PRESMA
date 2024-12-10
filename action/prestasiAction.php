<!-- prestasiAction -->

<?php
include('../lib/Session.php');
$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/PrestasiModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $buku = new PrestasiModel();
    $data = $buku->getData();
    $result = [];
    $i = 1;

    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row['buku_kode'],
            $row['buku_nama'],
            $row['kategori_id'],
            $row['jumlah'],
            $row['deskripsi'],
            '<img src="' . $row['gambar'] . '" alt="Gambar Buku" style="width: 100px; height: auto;">',
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['buku_id'] . ')"><i class="fa fa-edit"></i></button>
         <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['buku_id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }

    echo json_encode($result);
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $buku = new PrestasiModel();
    $data = $buku->getDataById($id);

    if (empty($data['deskripsi'])) {
        $data['deskripsi'] = 'Tidak ada deskripsi';
    }

    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'buku_kode' => antiSqlInjection($_POST['buku_kode']),
        'buku_nama' => antiSqlInjection($_POST['buku_nama']),
        'kategori_id' => (int)antiSqlInjection($_POST['kategori_id']),
        'jumlah' => (int)antiSqlInjection($_POST['jumlah']),
        'deskripsi' => antiSqlInjection($_POST['deskripsi']),
        'gambar' => antiSqlInjection($_POST['gambar'])
    ];
    $buku = new PrestasiModel();
    $buku->insertData($data);
    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'buku_kode' => antiSqlInjection($_POST['buku_kode']),
        'buku_nama' => antiSqlInjection($_POST['buku_nama']),
        'kategori_id' => (!empty($_POST['kategori_id'])) ? (int)antiSqlInjection($_POST['kategori_id']) : null,
        'jumlah' => (!empty($_POST['jumlah'])) ? (int)antiSqlInjection($_POST['jumlah']) : 0,
        'deskripsi' => (!empty($_POST['deskripsi'])) ? antiSqlInjection($_POST['deskripsi']) : 'Tidak ada deskripsi',
        'gambar' => antiSqlInjection($_POST['gambar'])
    ];

    if (is_null($data['kategori_id'])) {
        echo json_encode([
            'status' => false,
            'message' => 'Kategori tidak boleh kosong.'
        ]);
        exit;
    }

    $buku = new PrestasiModel();
    $buku->updateData($id, $data);
    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $buku = new PrestasiModel();
    $buku->deleteData($id);
    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}
