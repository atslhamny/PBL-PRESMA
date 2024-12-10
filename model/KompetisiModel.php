<?php

class KompetisiModel
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Mendapatkan semua data kompetisi
    public function getAllData()
    {
        $query = "SELECT 
                      [id], 
                      [jenis_kompetisi], 
                      [tingkat_kompetisi], 
                      [judul_kompetisi], 
                      [judul_kompetisi_en], 
                      [url_kompetisi], 
                      [tanggal_mulai], 
                      [tanggal_akhir], 
                      [jumlah_pt], 
                      [jumlah_peserta], 
                      [no_surat_tugas], 
                      [tanggal_surat], 
                      [file_surat_tugas], 
                      [file_sertifikat], 
                      [foto_kegiatan], 
                      [file_poster] 
                  FROM [kompetisi]";
        return $this->db->fetchAll($query);
    }

    // Mendapatkan data kompetisi berdasarkan ID
    public function getDataById($id)
    {
        $query = "SELECT * FROM [kompetisi] WHERE [id] = ?";
        return $this->db->fetchOne($query, [$id]);
    }

    // Menyimpan data kompetisi baru
    public function insertData($data)
    {
        $query = "INSERT INTO [kompetisi] 
                  ([jenis_kompetisi], [tingkat_kompetisi], [judul_kompetisi], [judul_kompetisi_en], 
                   [url_kompetisi], [tanggal_mulai], [tanggal_akhir], [jumlah_pt], [jumlah_peserta], 
                   [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], 
                   [foto_kegiatan], [file_poster]) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Mengambil file yang diupload dan mengkonversinya menjadi BLOB
        $file_surat_tugas = isset($data['file_surat_tugas']) ? file_get_contents($data['file_surat_tugas']['tmp_name']) : null;
        $file_sertifikat = isset($data['file_sertifikat']) ? file_get_contents($data['file_sertifikat']['tmp_name']) : null;
        $foto_kegiatan = isset($data['foto_kegiatan']) ? file_get_contents($data['foto_kegiatan']['tmp_name']) : null;
        $file_poster = isset($data['file_poster']) ? file_get_contents($data['file_poster']['tmp_name']) : null;

        // Menyimpan data ke database
        $this->db->execute($query, [
            $data['jenis_kompetisi'],
            $data['tingkat_kompetisi'],
            $data['judul_kompetisi'],
            $data['judul_kompetisi_en'],
            $data['url_kompetisi'],
            $data['tanggal_mulai'],
            $data['tanggal_akhir'],
            $data['jumlah_pt'],
            $data['jumlah_peserta'],
            $data['no_surat_tugas'],
            $data['tanggal_surat'],
            $file_surat_tugas,
            $file_sertifikat,
            $foto_kegiatan,
            $file_poster
        ]);
    }

    // Memperbarui data kompetisi yang ada
    public function updateData($id, $data)
    {
        $query = "UPDATE [kompetisi] 
                  SET 
                      [jenis_kompetisi] = ?, 
                      [tingkat_kompetisi] = ?, 
                      [judul_kompetisi] = ?, 
                      [judul_kompetisi_en] = ?, 
                      [url_kompetisi] = ?, 
                      [tanggal_mulai] = ?, 
                      [tanggal_akhir] = ?, 
                      [jumlah_pt] = ?, 
                      [jumlah_peserta] = ?, 
                      [no_surat_tugas] = ?, 
                      [tanggal_surat] = ?, 
                      [file_surat_tugas] = ?, 
                      [file_sertifikat] = ?, 
                      [foto_kegiatan] = ?, 
                      [file_poster] = ? 
                  WHERE [id] = ?";

        // Mengambil file yang diupload dan mengkonversinya menjadi BLOB
        $file_surat_tugas = isset($data['file_surat_tugas']) ? file_get_contents($data['file_surat_tugas']['tmp_name']) : null;
        $file_sertifikat = isset($data['file_sertifikat']) ? file_get_contents($data['file_sertifikat']['tmp_name']) : null;
        $foto_kegiatan = isset($data['foto_kegiatan']) ? file_get_contents($data['foto_kegiatan']['tmp_name']) : null;
        $file_poster = isset($data['file_poster']) ? file_get_contents($data['file_poster']['tmp_name']) : null;

        // Memperbarui data ke database
        $this->db->execute($query, [
            $data['jenis_kompetisi'],
            $data['tingkat_kompetisi'],
            $data['judul_kompetisi'],
            $data['judul_kompetisi_en'],
            $data['url_kompetisi'],
            $data['tanggal_mulai'],
            $data['tanggal_akhir'],
            $data['jumlah_pt'],
            $data['jumlah_peserta'],
            $data['no_surat_tugas'],
            $data['tanggal_surat'],
            $file_surat_tugas,
            $file_sertifikat,
            $foto_kegiatan,
            $file_poster,
            $id
        ]);
    }

    // Menghapus data kompetisi berdasarkan ID
    public function deleteData($id)
    {
        $query = "DELETE FROM [kompetisi] WHERE [id] = ?";
        $this->db->execute($query, [$id]);
    }
}


