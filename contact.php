<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

 if(isset($_POST['submit']))
  {
 	$name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $message=$_POST['message'];

$sql="insert into tblcontact(Name,MobileNumber,Email,Message)values(:name,:phone,:email,:message)";
$query=$dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':phone',$phone,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->execute();
$LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
   		echo "<script>alert('Your message was sent successfully!.');</script>";
		echo "<script>window.location.href ='contact.php'</script>";
  }
  	else
    	{
    		echo '<script>alert("Something Went Wrong. Please try again")</script>';
    	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Hotel Booking Management System | Hotel :: Contact Us</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <script>
    $(function() {
        $("#slider").responsiveSlides({
            auto: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            pager: true,
        });
    });
    </script>

</head>

<body>
    <!--header-->
    <div class="header head-top">
        <div class="container">
            <?php include_once('includes/header.php');?>
        </div>
    </div>
    <!--header-->
    <!--about-->
    <div class="content">
        <div class="contact">
            <div class="container">
                <h2>Liên Hệ</h2>
                <div class="contact-grids">
                    <div class="col-md-6 contact-left">
                        </br>
                        <?php
							$sql="SELECT * from tblpage where PageType='aboutus'";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$cnt=1;
								if($query->rowCount() > 0)
									{
										foreach($results as $row)
									{               
						?>
                        
						<p><?php  echo htmlentities($row->PageDescription);?>.</p><?php $cnt=$cnt+1;
									}
									} 
							?>
                            

                        <?php
							$sql="SELECT * from tblpage where PageType='contactus'";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$cnt=1;
								if($query->rowCount() > 0)
									{
									foreach($results as $row)
								{               
						?>
                        <br>
							<address>
							<p><?php  echo htmlentities($row->PageTitle);?></p>
							<p><a href="#"></a><i class="fa-solid fa-location-dot"></i></a> <?php  echo htmlentities($row->PageDescription);?></p>

							<p><a href="#"></a><i class="fa-solid fa-phone"></i> </a> Số Điện Thoại : <?php  echo htmlentities($row->MobileNumber);?></p>

							<p><a href="#"></a><i class="fa-solid fa-envelope"></i> </a> E-mail : <?php  echo htmlentities($row->Email);?></p>
							</address><?php $cnt=$cnt+1;
								}
									} 
										?>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.31618306319!2d106.63898901446545!3d10.787077792314298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752eb26a96fb61%3A0x979e24a9ca69fdf8!2zw4J1IEPGoSwgVMOibiBQaMO6LCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1671545492426!5m2!1svi!2s" width="500" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </br>                      
                    </div>

                    
                    
                    <div class="col-md-6 contact-right">
                        <form method="post">
                            <h5>Họ Tên</h5>
                            <input type="text" type="text" value="" name="name" required="true">
                            <h5>Số Điện Thoại</h5>
                            <input type="text" name="phone" required="true" maxlength="10" pattern="[0-9]+">
                            <h5>Email</h5>
                            <input type="text" type="email" value="" name="email" required="true">
                            <h5>Message</h5>
                            <textarea rows="10" name="message" required="true"></textarea>
                            <input type="submit" value="Gửi" name="submit">
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php include_once('includes/getintouch.php');?>
    </div>
    <?php include_once('includes/footer.php');?>
</html>