<?php
try {
    // Connect to database
    $conn = new PDO('mysql:host=localhost;port=3306;dbname=znyl', 'root', '123321');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully\n";
    
    // First check the table structure
    $stmt = $conn->query("SHOW COLUMNS FROM d_activity");
    echo "Table structure:\n";
    while ($row = $stmt->fetch()) {
        echo $row['Field'] . " - " . $row['Type'] . " - " . ($row['Null'] === 'YES' ? 'NULL' : 'NOT NULL') . "\n";
    }
    
    // Insert test activity
    $sql = "INSERT INTO d_activity 
        (id, title, type, activity_date, location, capacity, remaining_spots, image, description, create_time, status) 
        VALUES 
        ('test123456789', '测试活动', '健康讲座', '2023-12-20 10:00:00', '社区活动中心', 30, 30, 'https://placekitten.com/300/200', '这是一个测试活动', NOW(), '0')";
    
    $conn->exec($sql);
    echo "Activity inserted successfully\n";
    
    // Check if the record exists
    $stmt = $conn->query("SELECT * FROM d_activity WHERE id = 'test123456789'");
    $activity = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($activity) {
        echo "Found the inserted activity:\n";
        foreach ($activity as $key => $value) {
            echo "$key: $value\n";
        }
    } else {
        echo "Activity not found after insert!\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 