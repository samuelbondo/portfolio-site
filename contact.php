<?php
// Database connection
$conn = new mysqli("sql105.infinityfree.com", "if0_39669901", "Quewon2025", "if0_39669901_p");
if ($conn->connect_error) die("DB Error: " . $conn->connect_error);

$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact_messages (name,email,subject,message) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    if ($stmt->execute()) $success = true;
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact - Alex Johnson</title>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* Adjust container and form for mobile */
.contact-content {
    padding: 20px;
}
.contact-form input,
.contact-form textarea {
    width: 100%;
}
.contact-form button {
    width: 100%;
}

/* Footer social links */
.footer-social a {
    margin: 0 10px;
    font-size: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .navbar .container {
        flex-wrap: wrap;
    }
    .hamburger {
        display: flex;
        flex-direction: column;
        cursor: pointer;
        gap: 5px;
    }
    .nav-menu {
        display: none;
        flex-direction: column;
        width: 100%;
        background: #fff;
        padding: 10px 0;
        margin: 0;
    }
    .nav-menu.active {
        display: flex;
    }
    .nav-menu li {
        text-align: center;
        padding: 10px 0;
    }
}
</style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">AJ</div>
            <ul class="nav-menu">
                <li><a href="index.html" class="nav-link">Home</a></li>
                <li><a href="about.html" class="nav-link">About</a></li>
                <li><a href="skills.html" class="nav-link">Skills</a></li>
                <li><a href="contact.php" class="nav-link active">Contact</a></li>
                 <li><a href="login.php" class="nav-link">Login</a></li>
            </ul>
            <div class="hamburger"><span></span><span></span><span></span></div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="contact">
        <div class="container contact-content">
            <h2 class="section-title">Contact Me</h2>
            <?php if ($success) echo "<div class='form-message success'>Message sent successfully!</div>"; ?>
            <form class="contact-form" method="POST">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="text" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group">
                    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-social">
                <a href="#" title="GitHub"><i class="fab fa-github"></i></a>
                <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
            </div>
            <p>&copy; 2024 Alex Johnson. All rights reserved.</p>
            <p>Built with HTML & CSS</p>
        </div>
    </footer>

    <!-- JS -->
    <script>
    // Hamburger toggle for mobile menu
    document.addEventListener("DOMContentLoaded", () => {
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');

        if (hamburger && navMenu) {
            hamburger.addEventListener('click', () => {
                navMenu.classList.toggle('active');
            });
        }
    });
    </script>
</body>
</html>
