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
					<h2 class="type">Chi Tiết Đặt Phòng</h2>
				</div>
				
				<div class="bs-docs-example">
					<?php
                  $vid=$_GET['viewid'];

$sql="SELECT tblbooking.BookingNumber,tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tblbooking.ID as tid,tblbooking.IDType,tblbooking.Gender,tblbooking.Address,tblbooking.CheckinDate,tblbooking.CheckoutDate,tblbooking.BookingDate,tblbooking.Remark,tblbooking.Status,tblbooking.UpdationDate,tblcategory.CategoryName,tblcategory.Description,tblcategory.Price,tblroom.RoomName,tblroom.MaxAdult,tblroom.MaxChild,tblroom.RoomDesc,tblroom.NoofBed,tblroom.Image,tblroom.RoomFacility 
from tblbooking 
join tblroom on tblbooking.RoomId=tblroom.ID 
join tblcategory on tblcategory.ID=tblroom.RoomType 
join tbluser on tblbooking.UserID=tbluser.ID  
where tblbooking.ID=:vid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                            	<tr>
  <th colspan="4" style="color: black;font-weight: bold;text-align: center;font-size: 20px"> Booking Number: <?php echo $row->BookingNumber;?></th>
</tr>
<tr>
  <th colspan="4" style="color: black;font-weight: bold;font-size: 15px">Chi Tiết Đặt Phòng</th>
</tr>
<tr>
    <th>Họ Tên</th>
    <td><?php  echo $row->FullName;?></td>
    <th>Số Điện Thoại</th>
    <td><?php  echo $row->MobileNumber;?></td>
  </tr>
  

  <tr>
    
   <th>Email</th>
    <td><?php  echo $row->Email;?></td>
    <th>ID Type</th>
    <td><?php  echo $row->IDType;?></td>
  </tr>
  <tr>
    
   <th>Giới Tính</th>
    <td><?php  echo $row->Gender;?></td>
    <th>Địa Chỉ</th>
    <td><?php  echo $row->Address;?></td>
  </tr>
  <tr>
    <th>Check in Date</th>
    <td><?php  echo $row->CheckinDate;?></td>
    <th>Check out Date</th>
    <td><?php  echo $row->CheckoutDate;?></td>
  </tr>
  
   <tr>
    <tr>
  <th colspan="4" style="color: black;font-weight: bold;font-size: 15px">Chi Tiết Phòng</th>
</tr>
    <th>Loại Phòng</th>
    <td><?php  echo $row->CategoryName;?></td>
    <th>Giá Phòng</th>
    <td><?php echo number_format($row->Price)?> VND</td>
  </tr>
 
 <tr>
    
    <th>Tên Phòng</th>
    <td><?php  echo $row->RoomName;?></td>
    <th>Mô Tả Phòng</th>
    <td><?php  echo $row->RoomDesc;?></td>
  </tr>
   <tr>
    
    <th>Người Lớn</th>
    <td><?php  echo $row->MaxAdult;?></td>
    <th>Trẻ Em</th>
    <td><?php  echo $row->MaxChild;?></td>
  </tr>
<tr>
    
    <th>Số Giường</th>
    <td><?php  echo $row->NoofBed;?></td>
    <th>Ảnh Phòng</th>
    <td><img src="admin/images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"></td>
  </tr>
   <tr>
    
    <th>Room Facility</th>
    <td><?php  echo $row->RoomFacility;?></td>
    <th>Ngày Đặt Phòng</th>
    <td><?php  echo $row->BookingDate;?></td>
  </tr>
   <tr>
  <th colspan="4" style="color: black;font-weight: bold;font-size: 15px">ADMIN Phê Duyệt</th>
</tr>
  <tr>
    
     <th>Trạng Thái Đặt Phòng</th>

    <td> <?php  $status=$row->Status;
    
if($row->Status=="Approved")
{
  echo "Đặt Phòng Của Bạn Đã Được Phê Duyệt";
}

if($row->Status=="Cancelled")
{
 echo "Đặt Phòng Của Bạn Đã Bị Hủy";
}


if($row->Status=="")
{
  echo "Chưa Phản Hồi";
}


     ;?></td>
     <th >ADMIN Phê Duyệt</th>
    <?php if($row->Status==""){ ?>

                     <td><?php echo "Chưa Cập Nhật"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Status);?>
                  </td>
                  <?php } ?>
  </tr>
  
 
<?php $cnt=$cnt+1;}} ?>

</table> 
<a href="invoice.php?invid=<?php echo htmlentities ($row->tid);?>" class="btn btn-success">Hóa Đơn</a>
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
</html><?php }  ?>
