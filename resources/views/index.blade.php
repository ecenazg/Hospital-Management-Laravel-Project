<!DOCTYPE html>
<html>
<head>
    <title>Hospital Management</title>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="{{ url('/patients') }}">Patients</a></li>
            <li><a href="{{ url('/doctors') }}">Doctors</a></li>
            <li><a href="{{ url('/nurses') }}">Nurses</a></li>
            <li><a href="{{ url('/management') }}">Management</a></li>
        </ul>
    </nav>

    <h1>Welcome to the ECE's Hospital</h1>
    <h2>The #1 hospital service in Ankara</h2>
    <div class="content">
        <img src="https://m.media-amazon.com/images/M/MV5BMTcyOTIyMjg5N15BMl5BanBnXkFtZTcwNDc1Nzc0NA@@._V1_.jpg" alt="Hospital Image">
    </div>

    <style>
        /* CSS styles */
        body {
            background-color: #ffdfdf;
            font-family: Arial, sans-serif;
            color: #680747;
        }

        .navbar {
            background-color: #f12b6b;
            color: #35013f;
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
            color: #35013f;
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
