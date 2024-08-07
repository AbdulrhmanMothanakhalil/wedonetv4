<?php
// Database credentials
$host = 'localhost';
$db = 'project_brief';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST data exists
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $position = isset($_POST['position']) ? $_POST['position'] : null;
    $number = isset($_POST['number']) ? $_POST['number'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $salary = isset($_POST['salary']) ? $_POST['salary'] : null;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO submissions (name, position, number, email, salary) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $position, $number, $email, $salary);

    // Execute statement


    // Handle file upload
    if (isset($_FILES['documents'])) {
        $files = $_FILES['documents'];

        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $file_name = $files['name'][$key];
            $file_tmp = $files['tmp_name'][$key];
            $file_dest = 'uploads/' . $file_name;

            // Check for upload errors
            if ($files['error'][$key] === UPLOAD_ERR_OK) {
                if (move_uploaded_file($file_tmp, $file_dest)) {
                  
                } else {
                    echo "Failed to move file " . $file_name . ".<br>";
                }
            } else {
                echo "File upload error for " . $file_name . ": " . $files['error'][$key] . "<br>";
            }
        }
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Status - WeDonet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100">

    <!-- Header Section -->
    <header class="bg-white border-b">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold"><span class="text-blue-800">WE</span>DONET.</h1>
            <nav class="hidden md:flex space-x-4">
                <a href="index.html" class="text-gray-700 hover:text-black">Home</a>
                <a href="about.html" class="text-gray-700 hover:text-black">About</a>
                <a href="talent.html" class="text-gray-700 hover:text-black">Hire talents</a>
                <a href="blog.html" class="text-gray-700 hover:text-black">Blog</a>
                <a href="register.html" class="bg-blue-800 text-white px-4 py-2 rounded">Register</a>
            </nav>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md text-center">
            <h2 class="text-2xl font-bold mb-6">Submission Status</h2>
            <p class="text-lg mb-4">Form submitted successfully.</p>
            <a href="index.html" class="inline-block py-2 px-4 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Back to Home
            </a>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-blue-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <!-- Add Logo Image Here -->
            <img src="logo.jpg" alt="WEDONET Logo" class="w-24 mx-auto mb-4">
    
            <h2 class="text-2xl font-bold mb-4">WEDONET.</h2>
            <p class="mb-4">We're a diverse and passionate team that takes ownership of your design and empowers you to execute the roadmap. We stay light on our feet and truly enjoy delivering great work.</p>
            <div class="flex justify-center space-x-4 mb-4">
                <a href="#"><i class="fab fa-facebook-f w-5"></i></a>
                <a href="#"><i class="fab fa-twitter w-5"></i></a>
                <a href="#"><i class="fab fa-linkedin-in w-5"></i></a>
                <a href="#"><i class="fab fa-instagram w-5"></i></a>
            </div>
            
            <p>&copy; 2024 WEDONET. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
