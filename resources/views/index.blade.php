<!DOCTYPE html>
<html>
<head>
    <title>Hospital Homepage</title>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="{{ url('/patients') }}">Patients</a></li>
            <li><a href="{{ url('/doctors') }}">Doctors</a></li>
            <li><a href="{{ url('/nurses') }}">Nurses</a></li>
        </ul>
    </nav>

    <h1>Welcome to the Hospital</h1>

    <div class="content">
        <!-- Add your homepage content here -->
    </div>

    <style>
        /* CSS styles */
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            display: inline;
            margin-right: 10px;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
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
        }
    </style>
</body>
</html>
