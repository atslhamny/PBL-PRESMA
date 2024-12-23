<?php
class DatabaseConnection
{
    private $host;
    private $database;
    private $connection;

    public function __construct($host, $database)
    {
        $this->host = $host;
        $this->database = $database;
        $this->connect();
    }

    private function connect()
    {
        $connectionInfo = [
            'Database' => $this->database,
            'CharacterSet' => 'UTF-8',
            'TrustServerCertificate' => true // Tambahkan ini untuk koneksi lokal
        ];

        try {
            $this->connection = sqlsrv_connect($this->host, $connectionInfo);

            if ($this->connection === false) {
                $errors = sqlsrv_errors();
                throw new Exception("Koneksi database gagal: " . ($errors ? $errors[0]['message'] : "Unknown error"));
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            die("Kesalahan koneksi: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection()
    {
        if ($this->connection) {
            sqlsrv_close($this->connection);
        }
    }
}

// Konfigurasi Koneksi
$host = 'BASMAGEZI'; // Nama server Anda
$database = 'presma_fix'; // Nama database Anda

try {
    $dbConnection = new DatabaseConnection($host, $database);
    $db = $dbConnection->getConnection();
} catch (Exception $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
