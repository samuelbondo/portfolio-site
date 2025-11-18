<?php
session_start();
require_once '../includes/config.php'; // go up one level to includes/

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
$messages = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<style>
body { font-family: Arial, sans-serif; background: #f8f9fa; margin:0; padding:20px; }
h1 { text-align: center; color: #333; }
a.logout { float: right; text-decoration: none; background: #dc3545; color: white; padding: 8px 12px; border-radius: 5px; }
.table-container { overflow-x: auto; margin-top: 30px; }
table { width: 100%; border-collapse: collapse; min-width: 600px; }
th, td { padding: 12px; border: 1px solid #ccc; text-align: left; }
th { background: #007bff; color: white; }
tr:nth-child(even) { background: #f2f2f2; }
@media (max-width: 600px) { th, td { padding: 8px; font-size: 14px; } }
</style>
</head>
<body>
<h1>Admin Dashboard <a href="../logout.php" class="logout">Logout</a></h1>
<div class="table-container">
<table>
<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th>
</tr>
<?php foreach ($messages as $msg): ?>
<tr>
<td><?= $msg['id'] ?></td>
<td><?= htmlspecialchars($msg['name']) ?></td>
<td><?= htmlspecialchars($msg['email']) ?></td>
<td><?= htmlspecialchars($msg['subject']) ?></td>
<td><?= htmlspecialchars($msg['message']) ?></td>
<td><?= date("d M Y H:i", strtotime($msg['created_at'])) ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>
</body>
</html>
