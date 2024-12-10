
<?php
include('Model.php');

class UserModel extends Model
{
    protected $db;
    protected $table = 'users';
    protected $driver;

    public function __construct()
    {
        require_once('../lib/Connection.php');
        global $db, $use_driver;
        $this->db = $db;
        $this->driver = $use_driver;
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
}
?>