 <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hbmsuid']==0)) {
  header('location:logout.php');
  } else{
      
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Hotel Booking Management System | Hotel :: View Booking Detail</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/responsiveslides.min.js"></script>
 <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}
function f3()
{
window.print(); 
}
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
		<!-- typography -->
	<div class="typography">
			<!-- container-wrap -->
			<div class="container">
				<div class="typography-info">
					<h2 class="type">Hóa Đơn</h2>
				</div>
				<p>Chi Tiết Đặt Phòng Khách Sạn</p>
				<div class="bs-docs-example">
					<?php
$invid=$_GET['invid'];
$sql="SELECT tblbooking.BookingNumber,tbluser.FullName,DATEDIFF(tblbooking.CheckoutDate,tblbooking.CheckinDate) as ddf,tbluser.MobileNumber,tbluser.Email,tblbooking.IDType,tblbooking.Gender,tblbooking.Address,tblbooking.CheckinDate,tblbooking.CheckoutDate,tblbooking.BookingDate,tblbooking.Remark,tblbooking.Status,tblbooking.UpdationDate,tblcategory.CategoryName,tblcategory.Description,tblcategory.Price,tblroom.RoomName,tblroom.MaxAdult,tblroom.MaxChild,tblroom.RoomDesc,tblroom.NoofBed,tblroom.Image,tblroom.RoomFacility 
from tblbooking 
join tblroom on tblbooking.RoomId=tblroom.ID 
join tblcategory on tblcategory.ID=tblroom.RoomType 
join tbluser on tblbooking.UserID=tbluser.ID  
where tblbooking.ID=:invid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':invid', $invid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                            <tr>
    <th colspan="5" style="text-align: center;color: black;font-size: 20px">Booking Number: <?php  echo $row->BookingNumber;?></th>
  </tr>
  

  <tr>
    <th>Tên Khách Hàng</th>
    <td><?php  echo $row->FullName;?></td>
   <th>Số Điện Thoại</th>
    <td colspan="2"><?php  echo $row->MobileNumber;?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?php  echo $row->Email;?></td>
    <th>Ngày Đặt Phòng</th>
    <td colspan="2"><?php  echo $row->BookingDate;?></td>
  </tr>
   <tr>
    <th>Loại Phòng</th>
    <td><?php  echo $row->CategoryName;?></td>
    <th>Ảnh Phòng</th>
    <td><img src="admin/images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"></td>
  </tr>
 <tr>
    <th>Giá Phòng</th>
    <td><?php  echo number_format($row->Price)?> VND</td>
    <th>Tổng Số Ngày Đặt</th>
    <td colspan="2"><?php  echo $row->ddf;?></td>
  </tr>
<table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
  <tr>
    <th colspan="5" style="text-align: center;color: black;font-size: 20px">Chi Tiết Hóa Đơn</th>
  </tr>
  <tr>
    <th style="text-align: center;">Tổng Số Ngày Đặt</th>
  
   <th style="text-align: center;">Giá Phòng</th>
   <th style="text-align: center;">Tổng Giá Phòng</th>
  </tr>
<tr>
  <td style="text-align: center;"><?php  echo $ddf=$row->ddf;?></td>
 
  <td style="text-align: center;"><?php  echo number_format($tp= $row->Price)?> VND</td>
<td style="text-align: center;"><?php  echo number_format ($total= $ddf*$tp)?> VND</td>

  </tr>
  
  <?php 
$grandtotal+=$total;
$cnt=$cnt+1;} ?>
<tr>
  <th colspan="2" style="text-align:center;color: black">Tổng</th>
<td colspan="2" style="text-align: center;"><?php  echo number_format($grandtotal)?> VND</td>
</tr>
 
<?php $cnt=$cnt+1;} ?>
</table>
</table> 
<p style="text-align: center;font-size: 20px">
  <input name="Submit2" type="submit" class="btn btn-success" style="color: black;font-size: 18px" value="In Hóa Đơn" onClick="return f3();" style="cursor: pointer;"  /></p>
				</div>
			
			</div>
			<!-- //container-wrap -->
	</div>
	<!-- //typography -->

			<?php include_once('includes/getintouch.php');?>
			</div>
			<!--footer-->
				<?php include_once('includes/footer.php');?>
</body>
</html>
<?php }  ?>
