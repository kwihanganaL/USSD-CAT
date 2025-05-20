<?php

class Util {

    static $GO_BACK = "98";
    static $GO_TO_MAIN_MENU = "99";

    static $HOST = "localhost";
    static $DBNAME = "bmi";
    static $USERNAME = "root";
    static $PASSWORD = "";

    private $pdo;

    public function __construct() {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => true,
        ];

        try {
            $this->pdo = new PDO(
                "mysql:host=" . self::$HOST . ";dbname=" . self::$DBNAME,
                self::$USERNAME,
                self::$PASSWORD,
                $options
            );
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function isUserRegistered($phone) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        return $stmt->rowCount() > 0;
    }

    public function registerUser($fullname, $phone, $pin) {
        $stmt = $this->pdo->prepare("INSERT INTO users(fullname, phone, pin) VALUES (?, ?, ?)");
        return $stmt->execute([$fullname, $phone, $pin]);
    }
}
?>
