<?php
include('Model.php');

class UserModel extends Model
{
    protected $db;
    protected $table = 'user';

    public function __construct()
    {
        include('../lib/Connection.php');
        $this->db = $db; // Mengambil koneksi dari Connection.php
    }

    public function insertData($data)
    {
        $query = "INSERT INTO {$this->table} (username, password, role) VALUES (?, ?, ?)";
        $params = [
            $data['username'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['role']
        ];
        $stmt = sqlsrv_query($this->db, $query, $params);
        if (!$stmt) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }
    }

    public function getData()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = sqlsrv_query($this->db, $query);
        if (!$stmt) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        $data = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getDataById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $params = [$id];
        $stmt = sqlsrv_query($this->db, $query, $params);
        if (!$stmt) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }
        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

    public function updateData($id, $data)
    {
        $query = "UPDATE {$this->table} SET username = ?, password = ?, role = ? WHERE id = ?";
        $params = [
            $data['username'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['role'],
            $id
        ];
        $stmt = sqlsrv_query($this->db, $query, $params);
        if (!$stmt) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }
    }

    public function deleteData($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $params = [$id];
        $stmt = sqlsrv_query($this->db, $query, $params);
        if (!$stmt) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }
    }

    public function getSingleDataByKeyword($column, $keyword)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        $params = [$keyword];
        $stmt = sqlsrv_query($this->db, $query, $params);
        if (!$stmt) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }
        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }
}
