<?php
// Cek jika kelas Session sudah ada, jika belum maka deklarasikan
if (!class_exists('Session')) {
    class Session
    {
        // Konstruktor untuk memulai session jika belum dimulai
        public function __construct()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }

        // Menyimpan data dalam session
        public function set($key, $value)
        {
            $_SESSION[$key] = $value;
        }

        // Mengambil data dari session
        public function get($key)
        {
            return (isset($_SESSION[$key])) ? $_SESSION[$key] : null;
        }

        // Mengecek apakah data session ada
        public function exist($key)
        {
            return (isset($_SESSION[$key])) ? true : false;
        }

        // Menghapus data dari session
        public function delete($key)
        {
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }

        // Mengatur flash message dalam session
        public function setFlash($key, $value)
        {
            $_SESSION['flash'][$key] = $value;
        }

        // Mengambil flash message dari session
        public function getFlash($key)
        {
            $value = (isset($_SESSION['flash'][$key])) ? $_SESSION['flash'][$key] : null;
            $this->deleteFlash($key); // Menghapus flash setelah diambil
            return $value;
        }

        // Menghapus satu flash message
        public function deleteFlash($key)
        {
            if (isset($_SESSION['flash'][$key])) {
                unset($_SESSION['flash'][$key]);
            }
        }

        // Menghapus semua flash messages
        public function deleteAllFlash()
        {
            if (isset($_SESSION['flash'])) {
                unset($_SESSION['flash']);
            }
        }

        // Menghancurkan session
        public function deleteAll()
        {
            session_destroy();
        }

        // Menyelesaikan session
        public function commit()
        {
            session_commit();
        }
    }
}
