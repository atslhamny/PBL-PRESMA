<!-- kategorimodel -->

<?php
include('Model.php');

class KompetisiModel extends Model

{
    protected $db;
    protected $table = 'kompetisi';
    protected $driver;
    public function __construct()
    {
        require_once('../lib/Connection.php');
        global $db, $use_driver;
        $this->db = $db;
        $this->driver = $use_driver;
    }
    public function insertData($data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("INSERT INTO {$this->table} 
                (id_jenis_kompetisi, id_tingkat_kompetisi, id_dosen, judul_kompetisi, 
                judul_kompetisi_en, tempat_kompetisi, tempat_kompetisi_en, url_kompetisi,
                tanggal_mulai, tanggal_akhir, jumlah_pt, jumlah_peserta, 
                no_surat_tugas, tanggal_surat_tugas, file_surat_tugas, 
                file_sertifikat, foto_kegiatan, file_poster, validasi, catatan, peran_dosen) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $query->bind_param('iiisssssssiiissssssss',
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
                $data['peran_dosen']
            );
            $query->execute();
        } else {
            sqlsrv_query($this->db, "INSERT INTO {$this->table} 
                (id_jenis_kompetisi, id_tingkat_kompetisi, id_dosen, judul_kompetisi, 
                judul_kompetisi_en, tempat_kompetisi, tempat_kompetisi_en, url_kompetisi,
                tanggal_mulai, tanggal_akhir, jumlah_pt, jumlah_peserta, 
                no_surat_tugas, tanggal_surat_tugas, file_surat_tugas, 
                file_sertifikat, foto_kegiatan, file_poster, validasi, catatan, peran_dosen)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
                array_values($data));
        }
    }
    public function getData()
    {
        if ($this->driver == 'mysql') {
            return $this->db->query("SELECT * FROM {$this->table}")->fetch_all(MYSQLI_ASSOC);
        } else {
            $query = sqlsrv_query($this->db, "SELECT * FROM {$this->table}");
            $data = [];
            while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function getDataById($id)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $query->bind_param('i', $id);
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            $query = sqlsrv_query($this->db, "SELECT * FROM {$this->table} WHERE id = ?", [$id]);
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("UPDATE {$this->table} SET 
                id_jenis_kompetisi = ?, id_tingkat_kompetisi = ?, id_dosen = ?,
                judul_kompetisi = ?, judul_kompetisi_en = ?, tempat_kompetisi = ?,
                tempat_kompetisi_en = ?, url_kompetisi = ?, tanggal_mulai = ?,
                tanggal_akhir = ?, jumlah_pt = ?, jumlah_peserta = ?,
                no_surat_tugas = ?, tanggal_surat_tugas = ?, file_surat_tugas = ?,
                file_sertifikat = ?, foto_kegiatan = ?, file_poster = ?,
                validasi = ?, catatan = ?, peran_dosen = ?
                WHERE id = ?");

            $query->bind_param('iiisssssssiissssssssi',
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
                $data['peran_dosen'],
                $id
            );
            $query->execute();
        } else {
            $params = array_values($data);
            $params[] = $id;
            sqlsrv_query($this->db, "UPDATE {$this->table} SET 
                id_jenis_kompetisi = ?, id_tingkat_kompetisi = ?, id_dosen = ?,
                judul_kompetisi = ?, judul_kompetisi_en = ?, tempat_kompetisi = ?,
                tempat_kompetisi_en = ?, url_kompetisi = ?, tanggal_mulai = ?,
                tanggal_akhir = ?, jumlah_pt = ?, jumlah_peserta = ?,
                no_surat_tugas = ?, tanggal_surat_tugas = ?, file_surat_tugas = ?,
                file_sertifikat = ?, foto_kegiatan = ?, file_poster = ?,
                validasi = ?, catatan = ?, peran_dosen = ?
                WHERE id = ?", $params);
        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            $query->bind_param('i', $id);
            // eksekusi query
            // eksekusi query
            $query->execute();
        } else {
            sqlsrv_query($this->db, "DELETE FROM {$this->table} WHERE id = ?", [$id]);
        }
    }
}