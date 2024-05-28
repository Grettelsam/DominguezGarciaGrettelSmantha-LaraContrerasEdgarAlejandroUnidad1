<?php
class User {
    private $conn;
    private $table_name = "users";

    public $nombre;
    public $apellido;
    public $correo;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        // Inserción del usuario en la base de datos
        $query = "INSERT INTO " . $this->table_name . " (nombre, apellido, correo, psw) VALUES (:nombre, :apellido, :correo, :psw)";
        
        $stmt = $this->conn->prepare($query);

        // Sanitizar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // Encriptar la contraseña
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

        // Vincular parámetros
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':psw', $hashed_password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($correo, $contraseña) {
        $query = "SELECT id, nombre, apellido, psw FROM " . $this->table_name . " WHERE correo = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $correo);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($contraseña, $row['psw'])) {
                $this->id = $row['id'];
                $this->nombre = $row['nombre'];
                $this->apellido = $row['apellido'];
                return true;
            }
        }
        return false;
    }
}
?>