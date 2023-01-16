<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('connection.php');

if(isset($_POST['send'])){


  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $course = $_POST['course'];
  $batch_year = $_POST['batch_year'];
  $alumni_services = $_POST['alumni_services'];
  $message = $_POST['message'];



  
  if(empty($fullname) || empty($email) ||empty($course) ||empty($batch_year) || empty($alumni_services) || empty($message)){
    echo '<script>alert("Please Fill out all fields")</script>';
  }

else{
  $sql = "INSERT INTO services (full_name, email, course, batch_year, alumni_services, message) VALUES 
  ('$fullname', '$email', ' $course', '$batch_year', '$alumni_services', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'gisalumniassociationucc@gmail.com';                 // SMTP username
$mail->Password = 'bvvfvcesjozrcfda';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port       = 587;  

  $mail->setFrom($email, $fullname);
  $mail->addAddress('gisalumniassociationucc@gmail.com', 'Alumni Service');
  $mail->Subject = 'Contact Form Submission';
  $mail->Body = "Name: $fullname\nEmail: $email\nCourse: $course\nBatch Year: $batch_year\n Service: $alumni_services\nMessage: $message";

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<script>alert("Message has been sent")</script>';
    
}
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
    <section class="pt-5">
        <div class="container">
            <h2 class="text-center">Welcome to Alumni Services</h2>
     
            <form class="py-5" style="border: none; background-color: #F7F7F7; border-radius: 1rem;" method="post">
                <div class="row">
                        <div class="col-md form-group  d-flex justify-content-center align-items-center align-items-baseline ">
                                <label for="exampleFormControlInput1" class="mr-5">Full Name</label>
                                <input type="text" name="fullname" class="form-control w-50" id="">
                            
                    </div>
                </div>

                <div class="row">
                        <div class="col-md form-group  d-flex justify-content-center align-items-center align-items-baseline ">
                                <label for="exampleFormControlInput1" class="mr-5">Email</label>
                                <input type="email" name="email" class="form-control w-50 ml-5" id="">
                            
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md form-group d-flex justify-content-center align-items-center align-items-baseline">
                        <label for="exampleFormControlInput1" class="mr-5">Course</label>
                        <select  class="form-control w-50 ml-4" name="course" id="">
                          <option value="BSIS">Bachelor of Science in Information System</option>
                          <option value="BSIT">Bachelor of Science in Information Technology</option>
                          <option value="BSCS">Bachelor of Science in Computer Science</option>
                          <option value="BSEMC">Bachelor of Science in Entertainment and Multimedia Computing</option>
                        </select>
                      </div>
                </div>
               
                <div class="row">
                    <div class="col-md form-group d-flex justify-content-center align-items-center align-items-baseline">
                        <label for="exampleFormControlInput1" class="mr-5">Batch Year</label>
                        <select  class="form-control w-50 " name="batch_year" id="">
                            <option>2014-2015</option>
                          <option>2016-2017</option>
                          <option>2018-2019</option>
                          <option>2020-2021</option>
                          <option>2022-2023</option>
                        </select>
                      </div>     
                </div>

                <div class="row">
                    <div class="col-md form-group d-flex justify-content-center align-items-center align-items-baseline">
                        <label for="exampleFormControlInput1" class="mr-2">Alumni Services</label>
                        <select  class="form-control w-50" name="alumni_services" id="">
                          <option>Alumni ID</option>
                          <option>Events</option>
                          <option>Request of Documents</option> 
                        </select>
                      </div>
                </div>

                <div class="row">
                    <div class="col-md form-group d-flex justify-content-center align-items-center align-items-baseline">
                        <textarea class="form-control w-50" id="" rows="3" name="message" placeholder="Compose Message"></textarea>
                      </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary" type="submit" name="send">Send Message</button>
                </div>
                
              </form>
     
    </div>
    </section>
</body>
</html>
