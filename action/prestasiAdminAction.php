<?php
include('../lib/Session.php');
$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/KompetisiModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $kompetisi = new PrestasiAdminModel();
    $data = $kompetisi->getData();
    $result = [];
    $i = 1;

    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row['judul_kompetisi'],
            $row['tempat_kompetisi'],
            $row['tanggal_mulai'],
            $row['tanggal_akhir'],
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button>
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }

    echo json_encode($result);
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $kompetisi = new PrestasiAdminModel();
    $data = $kompetisi->getDataById($id);

    if (empty($data['catatan'])) {
        $data['catatan'] = 'Tidak ada catatan';
    }

    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'id_jenis_kompetisi' => (int)antiSqlInjection($_POST['id_jenis_kompetisi']),
        'id_tingkat_kompetisi' => (int)antiSqlInjection($_POST['id_tingkat_kompetisi']),
        'id_dosen' => (int)antiSqlInjection($_POST['id_dosen']),
        'judul_kompetisi' => antiSqlInjection($_POST['judul_kompetisi']),
        'tempat_kompetisi' => antiSqlInjection($_POST['tempat_kompetisi']),
        'tanggal_mulai' => antiSqlInjection($_POST['tanggal_mulai']),
        'tanggal_akhir' => antiSqlInjection($_POST['tanggal_akhir']),
        'catatan' => antiSqlInjection($_POST['catatan']),
        'validasi' => (int)antiSqlInjection($_POST['validasi']),
    ];

    $kompetisi = new PrestasiAdminModel();
    $kompetisi->insertData($data);
    echo json_encode([
        'status' => true,
        'message' => 'Data kompetisi berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'id_jenis_kompetisi' => (int)antiSqlInjection($_POST['id_jenis_kompetisi']),
        'id_tingkat_kompetisi' => (int)antiSqlInjection($_POST['id_tingkat_kompetisi']),
        'id_dosen' => (int)antiSqlInjection($_POST['id_dosen']),
        'judul_kompetisi' => antiSqlInjection($_POST['judul_kompetisi']),
        'tempat_kompetisi' => antiSqlInjection($_POST['tempat_kompetisi']),
        'tanggal_mulai' => antiSqlInjection($_POST['tanggal_mulai']),
        'tanggal_akhir' => antiSqlInjection($_POST['tanggal_akhir']),
        'catatan' => antiSqlInjection($_POST['catatan']),
        'validasi' => (int)antiSqlInjection($_POST['validasi']),
    ];

    $kompetisi = new PrestasiAdminModel();
    $kompetisi->updateData($id, $data);
    echo json_encode([
        'status' => true,
        'message' => 'Data kompetisi berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $kompetisi = new PrestasiAdminModel();
    $kompetisi->deleteData($id);
    echo json_encode([
        'status' => true,
        'message' => 'Data kompetisi berhasil dihapus.'
    ]);
}
