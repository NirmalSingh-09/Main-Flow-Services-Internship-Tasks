import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DatabaseConnection {

    // UPDATE these to match your local MySQL setup
    private static final String URL = "jdbc:mysql://localhost:3306/inventory";
    private static final String USER = "root"; // or your MySQL username
    private static final String PASSWORD = ""; // or your MySQL password

    public static Connection getConnection() {
        Connection connection = null;
        try {
            // Load MySQL JDBC Driver
            Class.forName("com.mysql.cj.jdbc.Driver");
            // Connect to database
            connection = DriverManager.getConnection(URL, USER, PASSWORD);
            System.out.println("Connected to MySQL database!");
        } catch (ClassNotFoundException | SQLException e) {
            System.err.println("Connection error: " + e.getMessage());
        }
        return connection;
    }

    // Optional main method to test connection directly
    public static void main(String[] args) {
        getConnection();
    }
}
