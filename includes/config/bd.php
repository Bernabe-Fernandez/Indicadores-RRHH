<?php
class Database
{
    private $host = "localhost";
    // private $db_name = "rhhmorgall";
    private $username = "root";
    private $password = "";
    public $conexion;

    // Método para abrir la conexión
    public function getConnection()
    {
        $this->conexion = null;

        try {
            $this->conexion = new mysqli($this->host, $this->username, $this->password);
            return $this->conexion;
        } catch (Exception $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    // Método para cerrar la conexión
    public function closeConnection()
    {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}
