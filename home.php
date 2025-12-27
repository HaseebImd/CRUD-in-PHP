<?php
include 'config.php';

// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Get all tasks
$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand">Task Manager</span>
            <div>
                <span class="text-white me-3">Hello, <?php echo $_SESSION['user_name']; ?></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Add Task Form -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Add New Task</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="create_task.php">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <input type="text" name="title" class="form-control" placeholder="Task Title" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <input type="text" name="description" class="form-control" placeholder="Description">
                        </div>
                        <div class="col-md-2 mb-2">
                            <select name="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <button type="submit" class="btn btn-success w-100">Add Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tasks List -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">All Tasks</h5>
            </div>
            <div class="card-body">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="row">
                        <?php while ($task = mysqli_fetch_assoc($result)): ?>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($task['title']); ?></h5>
                                        <p class="card-text text-muted">
                                            <?php echo htmlspecialchars($task['description']); ?>
                                        </p>
                                        <span class="badge
                                            <?php
                                                if ($task['status'] == 'completed') echo 'bg-success';
                                                elseif ($task['status'] == 'in_progress') echo 'bg-warning';
                                                else echo 'bg-secondary';
                                            ?>">
                                            <?php echo ucfirst($task['status']); ?>
                                        </span>
                                        <p class="small text-muted mt-2 mb-0">
                                            <?php echo date('M d, Y', strtotime($task['created_at'])); ?>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <a href="delete_task.php?id=<?php echo $task['id']; ?>"
                                           class="btn btn-danger btn-sm w-100"
                                           onclick="return confirm('Are you sure?')">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center text-muted">No tasks found. Add your first task!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
