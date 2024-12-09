-- Sp Tambah Data Kompetisi --
CREATE PROCEDURE spTambahKompetisi
    @IdJenisKompetisi INT,
    @IdTingkatKompetisi INT,
    @IdDosen INT,
    @JudulKompetisi VARCHAR(255),
    @JudulKompetisiEn VARCHAR(255),
    @TempatKompetisi VARCHAR(255),
    @TempatKompetisiEn VARCHAR(255),
    @UrlKompetisi VARCHAR(255),
    @TanggalMulai DATE,
    @TanggalAkhir DATE,
    @JumlahPT INT,
    @JumlahPeserta INT,
    @NoSuratTugas VARCHAR(255),
    @TanggalSuratTugas DATE,
    @FileSuratTugas VARBINARY(MAX),
    @FileSertifikat VARBINARY(MAX),
    @FotoKegiatan VARBINARY(MAX),
    @FilePoster VARBINARY(MAX),
    @Validasi BIT = 0,
    @Catatan TEXT
AS
BEGIN
    INSERT INTO kompetisi (
        id_jenis_kompetisi, id_tingkat_kompetisi, id_dosen, 
        judul_kompetisi, judul_kompetisi_en, tempat_kompetisi, tempat_kompetisi_en, 
        url_kompetisi, tanggal_mulai, tanggal_akhir, jumlah_pt, jumlah_peserta, 
        no_surat_tugas, tanggal_surat_tugas, file_surat_tugas, file_sertifikat, 
        foto_kegiatan, file_poster, validasi, catatan
    )
    VALUES (
        @IdJenisKompetisi, @IdTingkatKompetisi, @IdDosen, 
        @JudulKompetisi, @JudulKompetisiEn, @TempatKompetisi, @TempatKompetisiEn, 
        @UrlKompetisi, @TanggalMulai, @TanggalAkhir, @JumlahPT, @JumlahPeserta, 
        @NoSuratTugas, @TanggalSuratTugas, @FileSuratTugas, @FileSertifikat, 
        @FotoKegiatan, @FilePoster, @Validasi, @Catatan
    );
END;

-- Sp Ambil Data Kompetisi --

create procedure spambilkompetisi
    @id int = null
as
begin
    if @id is null
        select * from kompetisi;
    else
        select * from kompetisi where id = @id;
end;




exec sp_help kompetisi;

-- Sp Update Komp --
CREATE PROCEDURE spUpdateKompetisi
    @ID INT,
    @IdJenisKompetisi INT,
    @IdTingkatKompetisi INT,
    @IdDosen INT,
    @JudulKompetisi VARCHAR(255),
    @JudulKompetisiEn VARCHAR(255),
    @TempatKompetisi VARCHAR(255),
    @TempatKompetisiEn VARCHAR(255),
    @UrlKompetisi VARCHAR(255),
    @TanggalMulai DATE,
    @TanggalAkhir DATE,
    @JumlahPT INT,
    @JumlahPeserta INT,
    @NoSuratTugas VARCHAR(255),
    @TanggalSuratTugas DATE,
    @FileSuratTugas VARBINARY(MAX),
    @FileSertifikat VARBINARY(MAX),
    @FotoKegiatan VARBINARY(MAX),
    @FilePoster VARBINARY(MAX),
    @Validasi BIT,
    @Catatan TEXT
AS
BEGIN
    UPDATE kompetisi
    SET id_jenis_kompetisi = @IdJenisKompetisi,
        id_tingkat_kompetisi = @IdTingkatKompetisi,
        id_dosen = @IdDosen,
        judul_kompetisi = @JudulKompetisi,
        judul_kompetisi_en = @JudulKompetisiEn,
        tempat_kompetisi = @TempatKompetisi,
        tempat_kompetisi_en = @TempatKompetisiEn,
        url_kompetisi = @UrlKompetisi,
        tanggal_mulai = @TanggalMulai,
        tanggal_akhir = @TanggalAkhir,
        jumlah_pt = @JumlahPT,
        jumlah_peserta = @JumlahPeserta,
        no_surat_tugas = @NoSuratTugas,
        tanggal_surat_tugas = @TanggalSuratTugas,
        file_surat_tugas = @FileSuratTugas,
        file_sertifikat = @FileSertifikat,
        foto_kegiatan = @FotoKegiatan,
        file_poster = @FilePoster,
        validasi = @Validasi,
        catatan = @Catatan
    WHERE id = @ID;
END;



-- Sp Hapus Data Komp --
CREATE PROCEDURE spHapusKompetisi
    @ID INT
AS
BEGIN
    DELETE FROM kompetisi WHERE id = @ID;
END;


