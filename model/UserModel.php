<!-- userModel -->

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
    public function insertData($data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("insert into {$this->table} (username, password) values(?,?)");
            $query->bind_param(
                'ss',
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT)
            );
            $query->execute();
        } else {
            sqlsrv_query($this->db, "insert into {$this->table} (username, password) values(?,?)", array(
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT)
            ));
        }
    }
    public function getData()
    {
        if ($this->driver == 'mysql') {
            // query untuk mengambil data dari tabel
            return $this->db->query("select * from {$this->table} ")->fetch_all(MYSQLI_ASSOC);
        } else {
            // query untuk mengambil data dari tabel
            $query = sqlsrv_query($this->db, "select * from {$this->table}");
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
            // query untuk mengambil data berdasarkan id
            $query = $this->db->prepare("select * from {$this->table} where id = ?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where i =
    ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("update {$this->table} set username = ?, password = ? where id = ?");
            $query->bind_param(
                'ss',
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $id
            );
            // eksekusi query
            $query->execute();
        } else {
            sqlsrv_query($this->db, "update {$this->table} set username = ?, password = ?, role_id = ? where user_id = ?", [
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['role_id'],
                $id
            ]);
        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where id = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query($this->db, "delete from {$this->table} where id = ?", [$id]);
        }
    }
    public function getSingleDataByKeyword($column, $keyword)
    {
        if ($this->driver == 'mysql') {
            // query untuk mengambil data berdasarkan id
            $query = $this->db->prepare("select * from {$this->table} where {$column} = ?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('s', $keyword);
            // eksekusi query
            $query->execute();
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where {$column} =
?", [$keyword]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
}
