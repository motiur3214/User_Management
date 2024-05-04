<?php

class User
{
    private PDO $connection;

    public function __construct(Database $db)
    {
        $this->connection = $db->getConnection();
    }

    public function login($email, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user["password"])) {
                    unset($user['password']);
                    return $user;
                } else {
                    return false; // Incorrect password
                }
            } else {
                return false; // User not found
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    public function registration(array $user): bool
    {
        // Prepare SQL statement (using parameterized query for security)
        $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->connection->prepare($sql);
        // Bind values to prevent SQL injection vulnerabilities
        $stmt->bindParam(":name", $user["name"]);
        $stmt->bindParam(":email", $user["email"]);
        $stmt->bindParam(":password", $user["password"]);
        $stmt->bindParam(":role", $user["role"], PDO::PARAM_INT);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            return true; // Registration successful
        } else {
            // Handle registration failure (e.g., log the error)
            error_log("Registration failed: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }

    public function countUsers()
    {
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(*) AS total_users FROM users");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$result['total_users']; // Return total user count
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
