import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.Statement;

public class InsertActivity {
    public static void main(String[] args) {
        try {
            // Load the JDBC driver
            Class.forName("com.mysql.jdbc.Driver");
            
            // Connect to the database
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/znyl", "root", "123321");
            
            // Create statement
            Statement stmt = con.createStatement();
            
            // Execute SQL insert
            String sql = "INSERT INTO `d_activity` " +
                    "(`id`, `title`, `type`, `activity_date`, `location`, `capacity`, `remaining_spots`, `image`, `description`, `create_time`, `status`) " +
                    "VALUES " +
                    "('test123456789', '测试活动', '健康讲座', '2023-12-20 10:00:00', '社区活动中心', 30, 30, 'https://placekitten.com/300/200', '这是一个测试活动', NOW(), '0');";
            
            int result = stmt.executeUpdate(sql);
            
            System.out.println("Insert result: " + result);
            
            // Close connections
            stmt.close();
            con.close();
            
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
} 