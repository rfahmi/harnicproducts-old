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
        $stmt = self::$db->prepare($query);
        
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
        try {
            self::$db->beginTransaction();
            $result = $callback(self::$db);
            self::$db->commit();
            return $result;
        } catch (Exception $e) {
            self::$db->rollback();
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
        $stmt = self::$db->prepare($query);
        
        $types = str_repeat('s', count($fields));
        $stmt->bind_param($types, ...$values);
        
        return $stmt->execute();
    }

    // Safe data update
    public static function update($table, $data, $where, $whereParams = [], $whereTypes = '') {
        self::init();
        $set = [];
        foreach ($data as $field => $value) {
            $set[] = "$field = ?";
        }
        
        $query = "UPDATE $table SET " . implode(',', $set) . " WHERE $where";
        $stmt = self::$db->prepare($query);
        
        $params = array_merge(array_values($data), $whereParams);
        $types = str_repeat('s', count($data)) . $whereTypes;
        
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    // Safe delete
    public static function delete($table, $where, $params = [], $types = '') {
        self::init();
        $query = "DELETE FROM $table WHERE $where";
        $stmt = self::$db->prepare($query);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        return $stmt->execute();
    }
}
