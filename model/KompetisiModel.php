<?php

class KompetisiModel
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Mendapatkan semua data kompetisi dengan relasi
    public function getAllData()
    {
        $query = "SELECT 
                      k.[id], 
                      k.[jenis_kompetisi], 
                      k.[tingkat_kompetisi], 
                      k.[judul_kompetisi], 
                      k.[judul_kompetisi_en], 
                      k.[url_kompetisi], 
                      k.[tanggal_mulai], 
                      k.[tanggal_akhir], 
                      k.[jumlah_pt], 
                      k.[jumlah_peserta], 
                      k.[no_surat_tugas], 
                      k.[tanggal_surat], 
                      k.[file_surat_tugas], 
                      k.[file_sertifikat], 
                      k.[foto_kegiatan], 
                      k.[file_poster],
                      jk.[jenis_kompetisi] AS jenis_kompetisi,
                      tk.[tingkat_kompetisi] AS tingkat_kompetisi
                  FROM [kompetisi] k
                  INNER JOIN [jenis_kompetisi] jk ON k.[id_jenis_kompetisi] = jk.[id]
                  INNER JOIN [tingkat_kompetisi] tk ON k.[id_tingkat_kompetisi] = tk.[id]";
        return $this->db->fetchAll($query);
    }

    // Mendapatkan data kompetisi berdasarkan ID dengan relasi
    public function getDataById($id)
    {
        $query =
        "SELECT 
                      k.*, 
                      jk.[jenis_kompetisi] AS jenis_kompetisi,
                      tk.[tingkat_kompetisi] AS tingkat_kompetisi
                      FROM [kompetisi] k
                 INNER JOIN [jenis_kompetisi] jk ON k.[id_jenis_kompetisi] = jk.[id]
                  INNER JOIN [tingkat_kompetisi] tk ON k.[id_tingkat_kompetisi] = tk.[id]
                  WHERE k.[id] = ?";

        $kompetisi = $this->db->fetchOne($query, [$id]);

        // Mendapatkan relasi peserta untuk kompetisi
        $pesertaQuery = "SELECT 
                             m.[id], m.[nama], m.[nim], mk.[peran_mahasiswa]
                         FROM [mhs_kompetisi] mk
                         JOIN [mahasiswa] m ON mk.[id_mahasiswa] = m.[id]
                         WHERE mk.[id_kompetisi] = ?";
        $kompetisi['peserta'] = $this->db->fetchAll($pesertaQuery, [$id]);

        return $kompetisi;
    }

    // Menyimpan data kompetisi baru dengan relasi
    public function insertData($data)
    {
        $query = "INSERT INTO [kompetisi] 
                  ([id_jenis_kompetisi], [id_tingkat_kompetisi], [judul_kompetisi], [judul_kompetisi_en], 
                   [url_kompetisi], [tanggal_mulai], [tanggal_akhir], [jumlah_pt], [jumlah_peserta], 
                   [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], 
                   [foto_kegiatan], [file_poster]) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->execute($query, [
            $data['id_jenis_kompetisi'],
            $data['id_tingkat_kompetisi'],
            $data['judul_kompetisi'],
            $data['judul_kompetisi_en'],
            $data['url_kompetisi'],
            $data['tanggal_mulai'],
            $data['tanggal_akhir'],
            $data['jumlah_pt'],
            $data['jumlah_peserta'],
            $data['no_surat_tugas'],
            $data['tanggal_surat'],
            $data['file_surat_tugas'],
            $data['file_sertifikat'],
            $data['foto_kegiatan'],
            $data['file_poster']
        ]);

        $kompetisiId = $this->db->lastInsertId();

        // Simpan relasi peserta (jika ada)
        if (!empty($data['peserta'])) {
            foreach ($data['peserta'] as $peserta) {
                $this->db->execute("INSERT INTO [mhs_kompetisi] ([id_mahasiswa], [id_kompetisi], [peran_mahasiswa]) VALUES (?, ?, ?)", [
                    $peserta['id_mahasiswa'],
                    $kompetisiId,
                    $peserta['peran_mahasiswa']
                ]);
            }
        }

        return $kompetisiId;
    }

    // Memperbarui data kompetisi yang ada dengan relasi
    public function updateData($id, $data)
    {
        $query = "UPDATE [kompetisi] 
                  SET 
                      [id_jenis_kompetisi] = ?, 
                      [id_tingkat_kompetisi] = ?, 
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

        $this->db->execute($query, [
            $data['id_jenis_kompetisi'],
            $data['id_tingkat_kompetisi'],
            $data['judul_kompetisi'],
            $data['judul_kompetisi_en'],
            $data['url_kompetisi'],
            $data['tanggal_mulai'],
            $data['tanggal_akhir'],
            $data['jumlah_pt'],
            $data['jumlah_peserta'],
            $data['no_surat_tugas'],
            $data['tanggal_surat'],
            $data['file_surat_tugas'],
            $data['file_sertifikat'],
            $data['foto_kegiatan'],
            $data['file_poster'],
            $id
        ]);

        // Perbarui relasi peserta (hapus lama, tambahkan baru)
        $this->db->execute("DELETE FROM [mhs_kompetisi] WHERE [id_kompetisi] = ?", [$id]);

        if (!empty($data['peserta'])) {
            foreach ($data['peserta'] as $peserta) {
                $this->db->execute("INSERT INTO [mhs_kompetisi] ([id_mahasiswa], [id_kompetisi], [peran_mahasiswa]) VALUES (?, ?, ?)", [
                    $peserta['id_mahasiswa'],
                    $id,
                    $peserta['peran_mahasiswa']
                ]);
            }
        }
    }

    // Menghapus data kompetisi berdasarkan ID
    public function deleteData($id)
    {
        // Hapus relasi peserta terlebih dahulu
        $this->db->execute("DELETE FROM [mhs_kompetisi] WHERE [id_kompetisi] = ?", [$id]);

        // Hapus data kompetisi
        $query = "DELETE FROM [kompetisi] WHERE [id] = ?";
        $this->db->execute($query, [$id]);
    }
}
