<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Welcome to the most extraordinary hotel in Boston Massachusetts">
  <meta name="keywords" content="hotel,boston hotel,new england hotel">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Hotel BT | Contact</title>
</head>
<body>
  <header>
    <nav id="navbar">
      <div class="container">
        <h1 class="logo"><a href="index.php">HBT</a></h1>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a class="current" href="contact.php">Contact</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <section id="contact-form" class="py-3">
    <div class="container">
      <h1 class="l-heading"><span class="text-primary">Contact</span> Us</h1>
      <p>Please fill out the form below to contact us</p>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Database connection
        $host = 'localhost';
        $dbname = 'hotel_db';
        $user = 'postgres';
        $pass = 'Nilesh@3304';

        try {
          $dsn = "pgsql:host=$host;dbname=$dbname";
          $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

          // Insert form data into the database
          $sql = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);

          echo "<p class='success'>Thank you, $name! Your message has been sent.</p>";
        } catch (PDOException $e) {
          echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }
      }
      ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email">
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea name="message" id="message"></textarea>
        </div>
        <button type="submit" class="btn">Submit</button>
      </form>
    </div>
  </section>

  <section id="contact-info" class="bg-dark">
    <div class="container">
        <div class="box">
            <i class="fas fa-hotel fa-3x"></i>
            <h3>Location</h3>
            <p>50 Main st, Boston MA</p>
          </div>
          <div class="box">
              <i class="fas fa-phone fa-3x"></i>
              <h3>Phone Number</h3>
              <p>(617) 555-5555</p>
          </div>
          <div class="box">
              <i class="fas fa-envelope fa-3x"></i>
              <h3>Email Address</h3>
              <p>frontdesk@hotelbt.co</p>
          </div>
    </div>
  </section>

  <footer id="main-footer">
    <p>Hotel BT &copy; 2019, All RIghts Reserved</p>
  </footer>
</body>
</html>
