<?php
require 'server/config.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - User Management</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="dashboard-page">
        <div class="sidebar">
            <h2 class="sidebar-title">Admin Dashboard</h2>
            <ul>
                <li><a href="#" onclick="showSection('viewUsers')">View Users</a></li>
                <li><a href="#" onclick="showSection('addUsers')">Add Users</a></li>
                <li><a href="#" onclick="showSection('editUsers')">Edit Users</a></li>
                <li><a href="#" onclick="showSection('deleteUsers')">Delete Users</a></li>
            </ul>
        </div>

        <div class="main-content">
            <section id="viewUsers" class="user-section">
                <h2>View Users</h2>
                <table id="userTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, firstname, lastname, username, password FROM users"; 
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($users as $user) {
                            echo "<tr>
                                    <td>{$user['firstname']}</td>
                                    <td>{$user['lastname']}</td>
                                    <td>{$user['username']}</td> 
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="table-buttons">
                    <button class="action-btn" onclick="showSection('addUsers')">Add User</button>
                    <button class="action-btn" onclick="showSection('editUsers')">Edit User</button>
                    <button class="action-btn" onclick="showSection('deleteUsers')">Delete User</button>
                </div>
            </section>

            <!-- Add Users Section -->
            <section id="addUsers" class="user-section" style="display: none;">
                <h2>Add New User</h2>
                <form id="addUserForm" action="server/signup.php" method="post" class="styled-form">
                <input type="hidden" name="form_type" value="add_user">

                    <div class="form-group">
                        <input id="firstname" type="text" name="firstname" required placeholder="Enter First Name" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input id="lastname" type="text" name="lastname" required placeholder="Enter Last Name" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input id="username" type="text" name="username" required placeholder="Enter Username" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" name="password" required placeholder="Enter Password" minlength="6">
                    </div>

                    <div class="form-group">
                        <input id="confirm-password" type="password" name="confirm-password" required placeholder="Confirm Password" minlength="6">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="login-btn">Add User</button>
                        <button type="button" class="cancel-btn" onclick="showSection('viewUsers')">Cancel</button>
                    </div>

                </form>
            </section>

            <section id="editUsers" class="user-section" style="display: none;">
                <h2>Edit Users</h2>
                <p>Select a user from the table to edit.</p>
                <button type="button" class="cancel-btn" onclick="showSection('viewUsers')">Cancel</button>
            </section>

            <section id="deleteUsers" class="user-section" style="display: none;">
                <h2>Delete Users</h2>
                <p>Select a user from the table to delete.</p>
                <button type="button" class="cancel-btn" onclick="showSection('viewUsers')">Cancel</button>
            </section>
        </div>
    </div>
</body>

</html>