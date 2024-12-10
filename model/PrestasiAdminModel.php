<?php
include('Model.php');

class PrestasiAdminModel extends Model
{
    protected $db;
    protected $table = 'kompetisi'; // Nama tabel
    protected $driver;

    public function __construct()
    {
        include_once('../lib/Connection.php');
        $this->db = $db;
        $this->driver = $use_driver; // Pastikan $use_driver diatur di Connection.php (mysql/sqlsrv)
    }

    public function insertData($data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("INSERT INTO {$this->table} 
                (id_jenis_kompetisi, id_tingkat_kompetisi, id_dosen, judul_kompetisi, judul_kompetisi_en, tempat_kompetisi, tempat_kompetisi_en, url_kompetisi, 
                tanggal_mulai, tanggal_akhir, jumlah_pt, jumlah_peserta, no_surat_tugas, tanggal_surat_tugas, file_surat_tugas, 
                file_sertifikat, foto_kegiatan, file_poster, validasi, catatan) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param(
                'iiisssssisiissssssss',
                $data['id_jenis_kompetisi'],
                $data['id_tingkat_kompetisi'],
                $data['id_dosen'],
                $data['judul_kompetisi'],
                $data['judul_kompetisi_en'],
                $data['tempat_kompetisi'],
                $data['tempat_kompetisi_en'],
                $data['url_kompetisi'],
                $data['tanggal_mulai'],
                $data['tanggal_akhir'],
                $data['jumlah_pt'],
                $data['jumlah_peserta'],
                $data['no_surat_tugas'],
                $data['tanggal_surat_tugas'],
                $data['file_surat_tugas'],
                $data['file_sertifikat'],
                $data['foto_kegiatan'],
                $data['file_poster'],
                $data['validasi'],
                $data['catatan']
            );
            $query->execute();
        } else {
            $sql = "INSERT INTO {$this->table} 
                (id_jenis_kompetisi, id_tingkat_kompetisi, id_dosen, judul_kompetisi, judul_kompetisi_en, tempat_kompetisi, tempat_kompetisi_en, url_kompetisi, 
                tanggal_mulai, tanggal_akhir, jumlah_pt, jumlah_peserta, no_surat_tugas, tanggal_surat_tugas, file_surat_tugas, 
                file_sertifikat, foto_kegiatan, file_poster, validasi, catatan) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $params = [
                $data['id_jenis_kompetisi'],
                $data['id_tingkat_kompetisi'],
                $data['id_dosen'],
                $data['judul_kompetisi'],
                $data['judul_kompetisi_en'],
                $data['tempat_kompetisi'],
                $data['tempat_kompetisi_en'],
                $data['url_kompetisi'],
                $data['tanggal_mulai'],
                $data['tanggal_akhir'],
                $data['jumlah_pt'],
                $data['jumlah_peserta'],
                $data['no_surat_tugas'],
                $data['tanggal_surat_tugas'],
                $data['file_surat_tugas'],
                $data['file_sertifikat'],
                $data['foto_kegiatan'],
                $data['file_poster'],
                $data['validasi'],
                $data['catatan']
            ];
            sqlsrv_query($this->db, $sql, $params);
        }
    }

    public function getData()
    {
        if ($this->driver == 'mysql') {
            return $this->db->query("SELECT * FROM {$this->table}");
        } else {
            $sql = "SELECT * FROM {$this->table}";
            return sqlsrv_query($this->db, $sql);
        }
    }

    public function getDataById($id)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $query->bind_param('i', $id);
            $query->execute();
            return $query->get_result()->fetch_assoc();
        } else {
            $sql = "SELECT * FROM {$this->table} WHERE id = ?";
            $params = [$id];
            $stmt = sqlsrv_query($this->db, $sql, $params);
            return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        }
    }

    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("UPDATE {$this->table} 
                SET id_jenis_kompetisi = ?, id_tingkat_kompetisi = ?, id_dosen = ?, judul_kompetisi = ?, judul_kompetisi_en = ?, 
                tempat_kompetisi = ?, tempat_kompetisi_en = ?, url_kompetisi = ?, tanggal_mulai = ?, tanggal_akhir = ?, 
                jumlah_pt = ?, jumlah_peserta = ?, no_surat_tugas = ?, tanggal_surat_tugas = ?, file_surat_tugas = ?, 
                file_sertifikat = ?, foto_kegiatan = ?, file_poster = ?, validasi = ?, catatan = ? 
                WHERE id = ?");
            $query->bind_param(
                'iiisssssisiissssssssi',
                $data['id_jenis_kompetisi'],
                $data['id_tingkat_kompetisi'],
                $data['id_dosen'],
                $data['judul_kompetisi'],
                $data['judul_kompetisi_en'],
                $data['tempat_kompetisi'],
                $data['tempat_kompetisi_en'],
                $data['url_kompetisi'],
                $data['tanggal_mulai'],
                $data['tanggal_akhir'],
                $data['jumlah_pt'],
                $data['jumlah_peserta'],
                $data['no_surat_tugas'],
                $data['tanggal_surat_tugas'],
                $data['file_surat_tugas'],
                $data['file_sertifikat'],
                $data['foto_kegiatan'],
                $data['file_poster'],
                $data['validasi'],
                $data['catatan'],
                $id
            );
            $query->execute();
        } else {
            $sql = "UPDATE {$this->table} 
                SET id_jenis_kompetisi = ?, id_tingkat_kompetisi = ?, id_dosen = ?, judul_kompetisi = ?, judul_kompetisi_en = ?, 
                tempat_kompetisi = ?, tempat_kompetisi_en = ?, url_kompetisi = ?, tanggal_mulai = ?, tanggal_akhir = ?, 
                jumlah_pt = ?, jumlah_peserta = ?, no_surat_tugas = ?, tanggal_surat_tugas = ?, file_surat_tugas = ?, 
                file_sertifikat = ?, foto_kegiatan = ?, file_poster = ?, validasi = ?, catatan = ? 
                WHERE id = ?";
            $params = [
                $data['id_jenis_kompetisi'],
                $data['id_tingkat_kompetisi'],
                $data['id_dosen'],
                $data['judul_kompetisi'],
                $data['judul_kompetisi_en'],
                $data['tempat_kompetisi'],
                $data['tempat_kompetisi_en'],
                $data['url_kompetisi'],
                $data['tanggal_mulai'],
                $data['tanggal_akhir'],
                $data['jumlah_pt'],
                $data['jumlah_peserta'],
                $data['no_surat_tugas'],
                $data['tanggal_surat_tugas'],
                $data['file_surat_tugas'],
                $data['file_sertifikat'],
                $data['foto_kegiatan'],
                $data['file_poster'],
                $data['validasi'],
                $data['catatan'],
                $id
            ];
            sqlsrv_query($this->db, $sql, $params);
        }
    }

    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            $query->bind_param('i', $id);
            $query->execute();
        } else {
            $sql = "DELETE FROM {$this->table} WHERE id = ?";
            $params = [$id];
            sqlsrv_query($this->db, $sql, $params);
        }
    }
}
