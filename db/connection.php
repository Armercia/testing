<?php

$databaseName = "Abari";
$servername = "localhost";
$username = "root";
$password = "";
$conn;

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "CREATE DATABASE IF NOT EXISTS Abari";
    $sql = file_get_contents(basePath('db/tables.sql'));
    $conn->exec($sql);
    // $conn->exec("USE Abari");
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}



function query(string $sql, array $params, int $limit = 10, int $page = 1)
{
    global $conn;

    try {
        // Calculate offset for pagination
        $offset = ($page - 1) * $limit;

        // Append LIMIT and OFFSET to the SQL query
        $sqlWithLimit = $sql . " LIMIT :limit OFFSET :offset";

        // Prepare the statement with the modified SQL
        $stmt = $conn->prepare($sqlWithLimit);

        // Bind limit and offset parameters
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        // Execute the query with provided parameters
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();

        // Fetch the results
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get the total number of results for the original query (without LIMIT)
        $totalStmt = $conn->prepare("SELECT COUNT(*) FROM (" . $sql . ") as count_query");
        foreach ($params as $key => $value) {
            $totalStmt->bindValue($key, $value);
        }
        $totalStmt->execute();
        $total_results = $totalStmt->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
        $total_pages = ceil($total_results / $limit);

        // Prepare the result
        $result = [
            'data' => $data,
            'total' => $total_results,
            'total_pages' => $total_pages,
            'current_page' => $page,
            'limit' => $limit,
            'error' => false
        ];

        return $result;
    } catch (PDOException $e) {
        echo '<pre>' . "<br>" . $e->getMessage() . '</pre>';
        return ['error' => true, 'message' => $e->getMessage()];
    }
}


function query_create(string $sql, array $params)
{
    global $conn;
    try {
        $stmt =  $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo '<pre>' . "<br>" . $e->getMessage() . '</pre>';
        throw new Exception($e->getMessage());
    }
}
