<?php
include('../lib/Session.php');
include_once('../lib/Connection.php');
include_once('../lib/Secure.php');
include('../models/KompetisiModel.php');

// Session initialization
$session = new Session();
if ($session->get('is_login') !== true) {
    header('Location: login.php');
    exit();
}

// Initialize model
$kompetisiModel = new KompetisiModel($db);

// Determine action
$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

switch ($act) {
    case 'load':
        $data = $kompetisiModel->getAllData();
        $result = [];
        $i = 1;

        foreach ($data as $row) {
            $result['data'][] = [
                $i,
                htmlspecialchars($row['judul_kompetisi']),
                htmlspecialchars($row['tempat_kompetisi']),
                date('d-m-Y', strtotime($row['tanggal_mulai'])),
                date('d-m-Y', strtotime($row['tanggal_akhir'])),
                $row['jumlah_peserta'],
                $row['validasi'] ? 'Tervalidasi' : 'Belum Validasi',
                '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')">
                    <i class="fa fa-edit"></i>
                 </button>
                 <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')">
                    <i class="fa fa-trash"></i>
                 </button>
                 <button class="btn btn-sm btn-info" onclick="viewDetail(' . $row['id'] . ')">
                    <i class="fa fa-eye"></i>
                 </button>'
            ];
            $i++;
        }

        echo json_encode($result);
        break;

    case 'get':
        $id = isset($_GET['id']) && ctype_digit($_GET['id']) ? intval($_GET['id']) : 0;
        $data = $kompetisiModel->getDataById($id);
        echo json_encode($data);
        break;

    case 'save':
        $data = $_POST;

        // Mengambil file yang diupload sebagai BLOB
        if (isset($_FILES['file_surat_tugas']) && $_FILES['file_surat_tugas']['error'] === UPLOAD_ERR_OK) {
            $data['file_surat_tugas'] = file_get_contents($_FILES['file_surat_tugas']['tmp_name']);
        }

        if (isset($_FILES['file_sertifikat']) && $_FILES['file_sertifikat']['error'] === UPLOAD_ERR_OK) {
            $data['file_sertifikat'] = file_get_contents($_FILES['file_sertifikat']['tmp_name']);
        }

        if (isset($_FILES['foto_kegiatan']) && $_FILES['foto_kegiatan']['error'] === UPLOAD_ERR_OK) {
            $data['foto_kegiatan'] = file_get_contents($_FILES['foto_kegiatan']['tmp_name']);
        }

        if (isset($_FILES['file_poster']) && $_FILES['file_poster']['error'] === UPLOAD_ERR_OK) {
            $data['file_poster'] = file_get_contents($_FILES['file_poster']['tmp_name']);
        }

        // Menyimpan data ke database
        $kompetisiModel->insertData($data);
        echo json_encode(['status' => true, 'message' => 'Data kompetisi berhasil disimpan.']);
        break;

    case 'update':
        $id = isset($_GET['id']) && ctype_digit($_GET['id']) ? intval($_GET['id']) : 0;
        $data = $_POST;

        // Mengambil file yang diupload sebagai BLOB
        if (isset($_FILES['file_surat_tugas']) && $_FILES['file_surat_tugas']['error'] === UPLOAD_ERR_OK) {
            $data['file_surat_tugas'] = file_get_contents($_FILES['file_surat_tugas']['tmp_name']);
        }

        if (isset($_FILES['file_sertifikat']) && $_FILES['file_sertifikat']['error'] === UPLOAD_ERR_OK) {
            $data['file_sertifikat'] = file_get_contents($_FILES['file_sertifikat']['tmp_name']);
        }

        if (isset($_FILES['foto_kegiatan']) && $_FILES['foto_kegiatan']['error'] === UPLOAD_ERR_OK) {
            $data['foto_kegiatan'] = file_get_contents($_FILES['foto_kegiatan']['tmp_name']);
        }

        if (isset($_FILES['file_poster']) && $_FILES['file_poster']['error'] === UPLOAD_ERR_OK) {
            $data['file_poster'] = file_get_contents($_FILES['file_poster']['tmp_name']);
        }

        // Memperbarui data di database
        $kompetisiModel->updateData($id, $data);
        echo json_encode(['status' => true, 'message' => 'Data kompetisi berhasil diperbarui.']);
        break;

    case 'delete':
        $id = isset($_GET['id']) && ctype_digit($_GET['id']) ? intval($_GET['id']) : 0;
        $kompetisiModel->deleteData($id);
        echo json_encode(['status' => true, 'message' => 'Data kompetisi berhasil dihapus.']);
        break;

    default:
        echo json_encode(['status' => false, 'message' => 'Aksi tidak dikenali.']);
        break;
}
