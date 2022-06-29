<?php
require_once 'header_Amh.php';
require '../controller/validator.php';

$server="localhost";
$user="root";
$password="";
$db_name="edir";


// Create connection
$connection = new mysqli($server, $user, $password, $db_name);
// Check connection
if ($connection->connect_error) {
 die("Connection Failed: " . $connection->connect_error);
}



//   if(isset($_POST['register']))

if($_SERVER["REQUEST_METHOD"]=="POST"){

	$name= test_input($_POST ['cname']);
	$email=test_input($_POST['cemail']);
	$subject=test_input($_POST['csubject']);
	$message=test_input($_POST['cmessage']);
	

	$query="INSERT INTO contact (name, email, subject, message) VALUES('$name' ,'$email','$subject','$message')";

	if(mysqli_query($connection, $query))
	{
		echo "Form Inserted Succesfully!";
	}
	else{
		echo "Submission UNSUCCESSFUL. Please try again!";
	}
	mysqli_close($connection);
}

?>
   
        <main class="main">
            <div class="container">
	        	<div class="page-header page-header-big text-center" style="background-image: url('../resources/images/mesob.JPG')">
        			<h1 class="page-title text-white">አግኙን<span class="text-white">Keep in touch with us</span></h1>
	        	</div><!-- End .page-header -->
            </div><!-- End .container -->

            <div class="page-content pb-0 mt-2">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-6 mb-2 mb-lg-0">
                			<h2 class="title mb-1">የመገኛ አድራሻ</h2><!-- End .title mb-2 -->
                			<p class="mb-3">ማንኛውም ጥያቄ ካለዎት ያነጋግሩን, አስተያየት, ማመስገን, እና ስለ ኢዲር-ጣቢያው ያለዎት ማንኛውም ሀሳብ። የኛ አስተዳዳሪዎች በሚያስገቡት ኢሜል ያገኙዎታል። የቀደመ ምስጋና!</p>
                			<div class="row">
                				<div class="col-sm-7">
                					<div class="contact-info">
                						<h3>የ እድር ቢሮ</h3>

                						<ul class="contact-list">
                							<li>
                								<i class="icon-map-marker"></i>
	                							አለምገና ቀበሌ 08, ኦሮሚያ, ኢትዮጵያ
	                						</li>
                							<li>
                								<i class="icon-phone"></i>
                								<a href="tel:#">+251911428051</a>
                							</li>
                							<li>
                								<i class="icon-envelope"></i>
                								<a href="mailto:#">edir92057@gmail.com</a>
                							</li>
											<li>
                								<i class="icon-clock-o"></i>
                								<span class="text-dark">እሁድ</span> <br>6am-10pm
                							</li>
                						</ul><!-- End .contact-list -->
                					</div><!-- End .contact-info -->
                				</div><!-- End .col-sm-7 -->

                				<div class="col-sm-5">
                					<div class="contact-info">
                						<h3>የ እድር ቢሮ</h3>

                						<ul class="contact-list">
                							
										<li>
                								<i class="icon-map-marker"></i>
	                							አለምገና ቀበሌ 08, ኦሮሚያ, ኢትዮጵያ
	                						</li>
                							<li>
                								<i class="icon-phone"></i>
                								<a href="tel:#">+251911428051</a>
                							</li><li>
                								<i class="icon-clock-o"></i>
	                							<span class="text-dark">ሰኞ - ቅዳሜ</span> <br>11am-7pm 
	                						</li>
                							<li>
                								<i class="icon-calendar"></i>
                								<span class="text-dark">ሰኞ - ቅዳሜ</span> <br>8:30am-10:30pm ET <br> እሁድ - 8:30am- 12:00pm

                							</li>
                						</ul><!-- End .contact-list -->
                					</div><!-- End .contact-info -->
                				</div><!-- End .col-sm-5 -->
                			</div><!-- End .row -->
                		</div><!-- End .col-lg-6 -->
                		<div class="col-lg-6">
                			<h2 class="title mb-1">ጥያቄዎች አሉዎት?</h2><!-- End .title mb-2 -->
                			<p class="mb-2">ከሽያጭ ቡድኑ ጋር ለመገናኘት ከዚህ በታች ያለውን ቅጽ ይጠቀሙ</p>

                			<form  method = "POST" class="contact-form mb-3">
                				<div class="row">
                					<div class="col-sm-6">
                                        <label for="cname" class="sr-only">ስም</label>
                						<input type="text" class="form-control" id="cname" name="cname" placeholder="ስም *" required>
                					</div><!-- End .col-sm-6 -->

                					<div class="col-sm-6">
                                        <label for="cemail" class="sr-only">ኢሜይል</label>
                						<input type="email" name="cemail" class="form-control" id="cemail" placeholder="ኢሜይል *" required>
                					</div><!-- End .col-sm-6 -->
                				</div><!-- End .row -->

                				<div class="row">
                					
                					<div class="col-sm-6">
                                        <label for="csubject"  class="sr-only">ርዕሰ ጉዳይ</label>
                						<input type="text" name="csubject" class="form-control" id="csubject" placeholder="ርዕሰ ጉዳይ">
                					</div><!-- End .col-sm-6 -->
                				</div><!-- End .row -->

                                <label for="cmessage"  class="sr-only">መልእክት</label>
                				<textarea class="form-control" name="cmessage" cols="30" rows="4" id="cmessage" required placeholder="መልእክት *"></textarea>

                				<button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                					<span>አስገባ</span>
            						<i class="icon-long-arrow-right"></i>
                				</button>
                			</form><!-- End .contact-form -->
                		</div><!-- End .col-lg-6 -->
                	</div><!-- End .row -->
					<div class = "bg-light-2">
                	<hr class="mt-4  mb-5">

                	<div class="stores mb-4 mb-lg-5 bg-light-2">
	                	<h2 class="title text-center mb-3">አድራሻ</h2><!-- End .title text-center mb-2 -->

	                	<div class="row">
	                		<div class="col-lg-6">
	                			<div class="store">
	                				<div class="row">
	                					<div class="col-sm-5 col-xl-6">
	                						<figure class="store-media mb-2 mb-lg-0">
	                							<img src="../resources/images/location.PNG" alt="Map image">
	                						</figure><!-- End .store-media -->
	                					</div><!-- End .col-xl-6 -->
	                					<div class="col-sm-7 col-xl-6">
	                						<div class="store-content">
	                							<h3 class="store-title">ሰላም መረዳጃ እድር</h3><!-- End .store-title -->
	                							<address>አለምገና ቀበሌ 08, ኦሮሚያ, ኢትዮጵያ</address>
	                							<div><a href="tel:#">+251911428051</a></div>

	                							<h4 class="store-subtitle">የቢሮ ሰዓቶች:</h4><!-- End .store-subtitle -->
                								
                								<div>ሁልጊዜ እሁድ ከ 6am እስከ 4am</div>

                								<a href="https://www.google.com/maps/@8.9338932,38.6709879,19.25z" class="btn btn-link" target="_blank"><span>ካርታ ይመልከቱ</span><i class="icon-long-arrow-right"></i></a>
	                						</div><!-- End .store-content -->
	                					</div><!-- End .col-xl-6 -->
	                				</div><!-- End .row -->
	                			</div><!-- End .store -->
	                		</div><!-- End .col-lg-6 -->

	                		<div class="col-lg-6">
	                			<div class="store">
	                				<div class="row">
	                					<div class="col-sm-5 col-xl-6">
	                						<figure class="store-media mb-2 mb-lg-0">
	                						
	                						</figure><!-- End .store-media -->
	                					</div><!-- End .col-xl-6 -->

	                					<div class="col-sm-7 col-xl-6">
	                						<div class="store-content">
	                							<h3 class="store-title">ሰላም መረዳጃ እድር</h3><!-- End .store-title -->
	                							<address>አለምገና ቀበሌ 08, ኦሮሚያ, ኢትዮጵያ</address>

	                							<div><a href="tel:#">+251911428051</a></div>

	                							<h4 class="store-subtitle">Edir Store Hours:</h4><!-- End .store-subtitle -->
												<div>ሰኞ - ቅዳሜ ከ 8am እስከ 5pm</div>
												<div>ቅዳሜ ከ 8am እስከ 1:30pm</div>
												<div>እሁድ ከ 6am እስከ 4am</div>

                								<a href="https://www.google.com/maps/@8.9338932,38.6709879,19.25z" class="btn btn-link" target="_blank"><span>ካርታ ይመልከቱ</span><i class="icon-long-arrow-right"></i></a>
	                						</div><!-- End .store-content -->
	                					</div><!-- End .col-xl-6 -->
	                				</div><!-- End .row -->
	                			</div><!-- End .store -->
	                		</div><!-- End .col-lg-6 -->
	                	</div><!-- End .row -->
                	</div><!-- End .stores -->
					</div>
                </div><!-- End .container -->
        
            </div><!-- End .page-content -->
        </main><!-- End .main -->
<?php


require_once 'footer_Amh.php';

?>

    