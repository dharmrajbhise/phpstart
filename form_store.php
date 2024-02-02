<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./form.css"> 
</head>
<body>

<!-- navbar -->
<nav class="navbar">
		<a href="#" class="logo1">CodeWithDharma</a>
		<ul class="nav-items">
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="/phpstart/form_store.php">Add New</a></li>
		</ul>
		<div class="burger">
			<div class="line"></div>
			<div class="line"></div>
			<div class="line"></div>
		</div>
	</nav>
<!-- navbar ends -->


<!-- form -->

<div class="container">
		<div class="logo">
			<!-- <img src="logo.png" alt="Company Logo"> -->
			<h1>Welcome to <br>Code With Dharma Tech Blog</h1>
		</div>
		<div class="login-form">
			<form action="/phpstart/form_store.php" method="post">
				<label for="Firstname">Firstname</label>
				<input type="text" id="firstname" name="firstname">
				<label for="Lastname">Lastname</label>
				<input type="text" id="lastname" name="lastname">
				<label for="email">Email</label>
				<input type="email" id="email" name="email">
				<button type="submit">Submit</button>
				<p><a href="#">Enter Correct Details?</a></p>
			</form>
		</div>
	</div>

    <!-- form ends -->

    <!-- php code -->
    <?php

    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname = "phpstart";

    //create connection
    $conn = new mysqli($servername,$username,$password,$dbname);

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];

        //check connection
        if($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        }

        //insert data
        $sql = "INSERT INTO myfriends(firstname,lastname,email) values('$firstname','$lastname','$email')";
        $result = mysqli_query($conn,$sql);

        //check if data is inserted
        if($result){
            echo "<div class='alert alert-warning' role='alert'>
            Data inserted Successfully!
          </div>";
        }else{
            echo "<div class='alert alert-warning' role='alert'>
            Error inserting data: " . $conn->error . "
            </div>";
        }
    }
   

   //get data from database
    $sql2 = "SELECT * FROM myfriends";
    $result2 = mysqli_query($conn,$sql2);

    if($result2){
        $row = mysqli_fetch_all($result2,MYSQLI_ASSOC);
        // print_r($row);
        
        echo "<div class='container'>";
        echo "<h1 class='text-center'>Subsciber's list</h1>";
        echo "<div class='row'>";

        foreach ($row as $key => $value) {
            echo "<div class='col-md-4'>
                <div class='card' style='width: 18rem;'>
                    <div class='card-body'>
                      <h5 class='card-title'>" . $value['firstname']." ".$value['lastname']. "</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>" . $value['email'] . "</h6>
                        <a href='/phpstart/form_store.php?id=".$value['id']."' class='btn btn-primary'>Delete</a>
                         
                    </div>
                  </div>
                  </div>";
        }

        //create a function
        function deleteRecord($id){
            global $conn;
            $sql3 = 'DELETE FROM myfriends WHERE id = '.$id;
            $result3 = mysqli_query($conn,$sql3);
        }


        echo "</div>";
        echo "<div>";
    }

 ?>

    <!-- cards ends -->

 <!-- footer -->

 <footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <h3>About Us</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
          </li>
        </ul>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <h3>Contact Us</h3>
        <ul class="list-unstyled">
          <li>123 Main St.</li>
          <li>Anytown, USA</li>
          <li>Phone: (123) 456-7890</li>
          <li>Email: info@example.com</li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <p class="text-muted small">Copyright &copy; 2022 Your Company</p>
      </div>
    </div>
  </div>
</footer>

 <!-- footer ends -->


    <script>

const navSlide = () => {
	const burger = document.querySelector('.burger');
	const nav = document.querySelector('.nav-items');
	const navItems = document.querySelectorAll('.nav-items li');

	burger.addEventListener('click', () => {
		nav.classList.toggle('nav-active');

		navItems.forEach((item, index) => {
			item.style.animation ? item.style.animation = '' : item.style.animation = `navItemFade 0.5s ease forwards ${index / 7 + 0.5}s`;
		});

		burger.classList.toggle('toggle');
	});
}

navSlide();

    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>