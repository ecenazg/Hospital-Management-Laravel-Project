<!DOCTYPE html>
<html>
<head>
    <title>Hospital Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.2.3/dist/morph/bootstrap.css">

    <style>
        /* CSS styles */
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .navbar {
            background-color: #f12b6b;
            color: #fff;
            padding: 10px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }

        .navbar ul li {
            margin-left: 10px;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .navbar ul li a:hover {
            background-color: #ca224f;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .content img {
            max-width: 100%;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
        }
        
        .image-container img {
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="{{ url('/patients') }}">Patients</a></li>
            <li><a href="{{ url('/doctors') }}">Doctors</a></li>
            <li><a href="{{ url('/nurses') }}">Nurses</a></li>
            <li><a href="{{ url('/management') }}">Management</a></li>
            <li><a href="{{ url('/departments') }}">Departments</a></li>
            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>
        </ul>
    </nav>

    <h1>Welcome to ECE's Hospital</h1>
    <div class="content">
        <div class="image-container">
            <img src="https://i.pinimg.com/564x/ee/90/c5/ee90c5fc636bcc1e38f10c482b24c871.jpg" alt="Hospital Image 3">
        </div>
        <h2 style="margin-top: 20px;">The #1 Hospital Service in Ankara</h2>
    </div>
</body>
</html>
