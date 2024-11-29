<?php
/**
 * Mở kết nối đến CSDL sử dụng PDO
 */
// Mở kết nối đến CSDL sử dụng PDO, sử dụng Singleton Pattern để tái sử dụng kết nối
function pdo_get_connection(){
    static $conn = null;
    if ($conn === null) {
        $dburl = "mysql:host=localhost;dbname=project_1;charset=utf8";
        $username = 'root';
        $password = '';
        try {
            $conn = new PDO($dburl, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }
    }
    return $conn;
}


/**
 * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_execute($sql, ...$args){
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($args);
    } catch (PDOException $e) {
        throw new Exception("Lỗi thực thi câu lệnh SQL: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng các bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query($sql, ...$args){
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($args);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // Đảm bảo luôn trả về mảng liên kết
        return $rows;
    } catch (PDOException $e) {
        throw new Exception("Lỗi truy vấn dữ liệu: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một bản ghi
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array|null mảng chứa bản ghi hoặc null nếu không có kết quả
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query_one($sql, ...$args){
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row : null; // Trả về null nếu không có kết quả
    } catch (PDOException $e) {
        throw new Exception("Lỗi truy vấn một bản ghi: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một giá trị
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return mixed giá trị hoặc null nếu không có kết quả
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query_value($sql, ...$args){
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? array_values($row)[0] : null; // Trả về giá trị đầu tiên hoặc null
    } catch (PDOException $e) {
        throw new Exception("Lỗi truy vấn giá trị: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}

