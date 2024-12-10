<!-- kategoriAction -->

<?php
include('../lib/Session.php');

$session = new Session();
if ($session->get('is_login') !== true) {
    header('Location: login.php');
    exit();
}

include_once('../model/KompetisiModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $kompetisi = new KompetisiModel();
    $data = $kompetisi->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row['judul_kompetisi'],
            $row['tempat_kompetisi'],
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
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $kompetisi = new KompetisiModel();
    $data = $kompetisi->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    // Handle file uploads
    $file_surat_tugas = handleFileUpload('file_surat_tugas', 'surat_tugas');
    $file_sertifikat = handleFileUpload('file_sertifikat', 'sertifikat');
    $foto_kegiatan = handleFileUpload('foto_kegiatan', 'foto');
    $file_poster = handleFileUpload('file_poster', 'poster');

    $data = [
        'id_jenis_kompetisi' => antiSqlInjection($_POST['id_jenis_kompetisi']),
        'id_tingkat_kompetisi' => antiSqlInjection($_POST['id_tingkat_kompetisi']),
        'id_dosen' => antiSqlInjection($_POST['id_dosen']),
        'judul_kompetisi' => antiSqlInjection($_POST['judul_kompetisi']),
        'judul_kompetisi_en' => antiSqlInjection($_POST['judul_kompetisi_en']),
        'tempat_kompetisi' => antiSqlInjection($_POST['tempat_kompetisi']),
        'tempat_kompetisi_en' => antiSqlInjection($_POST['tempat_kompetisi_en']),
        'url_kompetisi' => antiSqlInjection($_POST['url_kompetisi']),
        'tanggal_mulai' => antiSqlInjection($_POST['tanggal_mulai']),
        'tanggal_akhir' => antiSqlInjection($_POST['tanggal_akhir']),
        'jumlah_pt' => antiSqlInjection($_POST['jumlah_pt']),
        'jumlah_peserta' => antiSqlInjection($_POST['jumlah_peserta']),
        'no_surat_tugas' => antiSqlInjection($_POST['no_surat_tugas']),
        'tanggal_surat_tugas' => antiSqlInjection($_POST['tanggal_surat_tugas']),
        'file_surat_tugas' => $file_surat_tugas,
        'file_sertifikat' => $file_sertifikat,
        'foto_kegiatan' => $foto_kegiatan,
        'file_poster' => $file_poster,
        'validasi' => isset($_POST['validasi']) ? 1 : 0,
        'catatan' => antiSqlInjection($_POST['catatan']),
        'peran_dosen' => antiSqlInjection($_POST['peran_dosen'])
    ];

    $kompetisi = new KompetisiModel();
    $kompetisi->insertData($data);
    echo json_encode([
        'status' => true,
        'message' => 'Data kompetisi berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    
    // Handle file uploads jika ada file baru
    $data = [
        'id_jenis_kompetisi' => antiSqlInjection($_POST['id_jenis_kompetisi']),
        'id_tingkat_kompetisi' => antiSqlInjection($_POST['id_tingkat_kompetisi']),
        'id_dosen' => antiSqlInjection($_POST['id_dosen']),
        'judul_kompetisi' => antiSqlInjection($_POST['judul_kompetisi']),
        'judul_kompetisi_en' => antiSqlInjection($_POST['judul_kompetisi_en']),
        'tempat_kompetisi' => antiSqlInjection($_POST['tempat_kompetisi']),
        'tempat_kompetisi_en' => antiSqlInjection($_POST['tempat_kompetisi_en']),
        'url_kompetisi' => antiSqlInjection($_POST['url_kompetisi']),
        'tanggal_mulai' => antiSqlInjection($_POST['tanggal_mulai']),
        'tanggal_akhir' => antiSqlInjection($_POST['tanggal_akhir']),
        'jumlah_pt' => antiSqlInjection($_POST['jumlah_pt']),
        'jumlah_peserta' => antiSqlInjection($_POST['jumlah_peserta']),
        'no_surat_tugas' => antiSqlInjection($_POST['no_surat_tugas']),
        'tanggal_surat_tugas' => antiSqlInjection($_POST['tanggal_surat_tugas']),
        'validasi' => isset($_POST['validasi']) ? 1 : 0,
        'catatan' => antiSqlInjection($_POST['catatan']),
        'peran_dosen' => antiSqlInjection($_POST['peran_dosen'])
    ];

    // Update file jika ada upload baru
    if (!empty($_FILES['file_surat_tugas']['name'])) {
        $data['file_surat_tugas'] = handleFileUpload('file_surat_tugas', 'surat_tugas');
    }
    if (!empty($_FILES['file_sertifikat']['name'])) {
        $data['file_sertifikat'] = handleFileUpload('file_sertifikat', 'sertifikat');
    }
    if (!empty($_FILES['foto_kegiatan']['name'])) {
        $data['foto_kegiatan'] = handleFileUpload('foto_kegiatan', 'foto');
    }
    if (!empty($_FILES['file_poster']['name'])) {
        $data['file_poster'] = handleFileUpload('file_poster', 'poster');
    }

    $kompetisi = new KompetisiModel();
    $kompetisi->updateData($id, $data);
    echo json_encode([
        'status' => true,
        'message' => 'Data kompetisi berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $kompetisi = new KompetisiModel();
    $kompetisi->deleteData($id);
    echo json_encode([
        'status' => true,
        'message' => 'Data kompetisi berhasil dihapus.'
    ]);
}

// Function untuk handle upload file
function handleFileUpload($fieldName, $prefix) {
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        return '';
    }

    $file_name = $_FILES[$fieldName]['name'];
    $file_tmp = $_FILES[$fieldName]['tmp_name'];
    $file_size = $_FILES[$fieldName]['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $new_file_name = uniqid() . '.' . $file_ext;
    $new_file_path = '../uploads/' . $prefix . '/' . $new_file_name;

    if (move_uploaded_file($file_tmp, $new_file_path)) {
        return $new_file_name;
    } else {
        return '';
    }
}