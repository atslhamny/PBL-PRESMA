<?php
include('Model.php');

class UserModel extends Model
{
    protected $db;
    protected $table = 'user';
    protected $driver;

    public function __construct($connection)
    {
        $this->db = $connection;
    }

    // Implementasi metode CRUD
    public function insertData($data)
    {
        if ($this->driver == 'sqlsrv') {
            sqlsrv_query($this->db, "INSERT INTO {$this->table} (username, password) VALUES (?, ?)", [
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT)
            ]);
        }
    }

    public function getData()
    {
        $query = sqlsrv_query($this->db, "SELECT * FROM {$this->table}");
        $data = [];
        while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getDataById($id)
    {
        $stmt = sqlsrv_query($this->db, "SELECT * FROM {$this->table} WHERE id = ?", [$id]);
        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

    public function updateData($id, $data)
    {
        if ($this->driver == 'sqlsrv') {
            $query = "UPDATE {$this->table} SET username = ?, password = ? WHERE id = ?";
            sqlsrv_query($this->db, $query, [
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $id
            ]);
        }
    }

    public function deleteData($id)
    {
        if ($this->driver == 'sqlsrv') {
            $query = "DELETE FROM {$this->table} WHERE id = ?";
            sqlsrv_query($this->db, $query, [$id]);
        }
    }

    // Menambahkan fungsi getSingleDataByKeyword ke dalam kelas UserModel
    public function getSingleDataByKeyword($column, $value)
    {
        $query = "SELECT * FROM users WHERE $column = ?";
        $params = [$value];
        $stmt = sqlsrv_prepare($this->db, $query, $params);

        if ($stmt === false) {
            $errors = sqlsrv_errors();
            throw new Exception("Persiapan query gagal: " . $errors[0]['message']);
        }

        $result = sqlsrv_execute($stmt);

        if ($result === false) {
            $errors = sqlsrv_errors();
            throw new Exception("Eksekusi query gagal: " . $errors[0]['message']);
        }

        $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        return $user;
    }

    // Fungsi untuk validasi user
    public function validateUser($username, $password)
    {
        try {
            $user = $this->getSingleDataByKeyword('username', $username);

            if (!$user) {
                return false;
            }

            // Untuk sementara, perbandingan password biasa
            // Nantinya gunakan password_hash() dan password_verify()
            return ($password === $user['password']) ? $user : false;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
