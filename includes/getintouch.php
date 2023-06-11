<link rel="stylesheet" href="fonts/fontawesome-free-6.2.1-web/css/all.min.css">

<div class="touch-section">
					<div class="container">
						<h3>Liên Hệ</h3>
						<div class="touch-grids">
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
							<div class="col-md-4 touch-grid">
								<h4>Follow Us</h4>
								<a href="#"></a><i class="fa-brands fa-facebook" style="font-size: x-large;"></i></a>
								<a href="#"></a><i class="fa-brands fa-twitter" style="font-size: x-large;"></i></a>
								<a href="#"></a><i class="fa-brands fa-instagram" style="font-size: x-large;"></i></i></a>
								</br>
								</br>
								</br>
								<h4>Địa Chỉ</h4>
								<h5><a href="#"></a><i class="fa-solid fa-location-dot"></i></a>
									<?php  echo htmlentities($row->PageDescription);?></h5>	
							</div>

							<div class="col-md-4 touch-grid">
								<h4>Hottline Góp Ý</h4>
								<br>
								<p><a href="#"></a><i class="fa-solid fa-phone"></i> </a>Số Điện Thoại  : <?php  echo htmlentities($row->MobileNumber);?></p>
							<p><a href="#"></a><i class="fa-solid fa-envelope"></i> </a>E-mail : <?php  echo htmlentities($row->Email);?></p></br>
							</div><?php $cnt=$cnt+1;}} ?>
							<div class="col-md-4 touch-grid">
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
							<h4><?php  echo htmlentities($row->PageTitle);?></h4>
									
								<p><?php  echo htmlentities($row->PageDescription);?></p>		
							</div><?php $cnt=$cnt+1;}} ?>
							<div class="clearfix"></div>
						</div>
					</div>
					</div>
				<!--GET IN TOUCH-->