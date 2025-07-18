<?php

class DatabaseHelper {
    private static $db = null;

    public static function init() {
        if (self::$db === null) {
            self::$db = Database::getInstance();
        }
    }

    // Pagination helper
    public static function getPaginationData($table, $page = 1, $perPage = 10, $conditions = '') {
        self::init();
        $where = $conditions ? " WHERE $conditions" : '';
        $countQuery = "SELECT COUNT(1) as total FROM $table $where";
        $result = self::$db->fetchRow($countQuery);
        $total = $result['total'];
        
        $totalPages = ceil($total / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        
        return [
            'total' => $total,
            'perPage' => $perPage,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'offset' => $offset
        ];
    }

    // Safe data fetching with prepared statements
    public static function fetchWithParams($query, $params = [], $types = '') {
        self::init();
        $db = self::$db->getConnection();
        $stmt = $db->prepare($query);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Transaction wrapper
    public static function transaction($callback) {
        self::init();
        $db = self::$db->getConnection();
        
        try {
            $db->begin_transaction();
            $result = $callback(self::$db);
            $db->commit();
            return $result;
        } catch (Exception $e) {
            $db->rollback();
            throw $e;
        }
    }

    // Safe data insertion
    public static function insert($table, $data) {
        self::init();
        $fields = array_keys($data);
        $values = array_values($data);
        $placeholders = str_repeat('?,', count($fields) - 1) . '?';
        
        $query = "INSERT INTO $table (" . implode(',', $fields) . ") VALUES ($placeholders)";
        
        return self::fetchWithParams($query, $values);
    }

    // Safe data update
    public static function update($table, $data, $where, $whereParams = [], $whereTypes = '') {
        self::init();
        $set = [];
        foreach ($data as $field => $value) {
            $set[] = "$field = ?";
        }
        
        $query = "UPDATE $table SET " . implode(',', $set) . " WHERE $where";
        $params = array_merge(array_values($data), $whereParams);
        $types = str_repeat('s', count($data)) . $whereTypes;
        
        return self::fetchWithParams($query, $params, $types);
    }

    // Safe delete
    public static function delete($table, $where, $params = [], $types = '') {
        self::init();
        $query = "DELETE FROM $table WHERE $where";
        return self::fetchWithParams($query, $params, $types);
    }

    // Get database connection
    public static function getConnection() {
        self::init();
        return self::$db->getConnection();
    }
}
