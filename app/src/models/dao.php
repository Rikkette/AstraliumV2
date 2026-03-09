<?php
// Inclure config.php en utilisant un chemin relatif
require_once '/var/www/require/config.php';

class dao {
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_password;

    public function __construct($_dbname, $env = 'dev') {
        $this->db_host = constant('DB_HOST_' . strtoupper($env));
        $this->db_name = $_dbname;
        $this->db_user = $env === 'dev' ? DB_USER_DEV : DB_USER_PROD;
        $this->db_password = $env === 'dev' ? DB_PASSWORD_DEV : DB_PASSWORD_PROD;
    }

    public function connect() {
        $dsn = "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO($dsn, $this->db_user, $this->db_password, $options);
    }


    // Méthode pour effectuer une requête SELECT sur une table donnée
    public function select($table, $where = '', $params = array(), $order_by = '', $limit = '', $class = '')
    {
        $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        if (!empty($order_by)) {
            $sql .= " ORDER BY $order_by";
        }
        if (!empty($limit)) {
            $sql .= " LIMIT $limit";
        }

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($params);

        if (!empty($class)) {
            //return $stmt->fetchAll(PDO::FETCH_CLASS,$class);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $objects = [];

            foreach ($results as $result) {
                $obj = new $class(); // Création de l'objet avec la classe spécifiée en paramêtre

                foreach ($result as $key => $value) {
                    // Vérifie que la propriété existe et utilise set pour la remplir
                    $method = 'set' . ucfirst($key); // Convertir le nom de la propriété en méthode set
                    if (method_exists($obj, $method)) {
                        $obj->$method($value); // Appel de la méthode set appropriée
                    }
                }

                $objects[] = $obj;
            }

            return $objects;
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Méthode pour effectuer une requête INSERT sur une table donnée
    public function insert($table, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $sql = "INSERT INTO $table (" . implode(',', $keys) . ") VALUES (" . implode(',', array_fill(0, count($values), '?')) . ")";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute($values);
    }

    // Méthode pour effectuer une requête UPDATE sur une table donnée
    public function update($table, $data, $where = '', $params = array())
    {
        $sql = "UPDATE $table SET ";
        $set_values = array();
        foreach ($data as $key => $value) {
            $set_values[] = "$key = ?";
        }
        $sql .= implode(',', $set_values);
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        $values = array_values($data);
        $values = array_merge($values, $params);
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute($values);
    }

    // Méthode pour effectuer une requête DELETE sur une table donnée
    public function delete($table, $where = '', $params = array())
    {
        $sql = "DELETE FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute($params);
    }
}