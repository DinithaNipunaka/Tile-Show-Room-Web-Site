<?php
session_start();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HERATH TILES</title>
	 <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon" />

    
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
 
</head>
<body>
  
   
 <div class="navbar navbar-inverse navbar-fixed-top " id="menu">
        <div class="container">
            <div class="navbar-header">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <a class="navbar-brand" href="index.php" style=" padding: 0;
    font-size: 31px;
    text-transform: uppercase;
    color:#fff;
    letter-spacing: 5px;
    line-height: 25px;
    position: relative;
    bottom:-10px;
    font-weight: bold;"><span style="color: #f90202">HERATH </span>TILES <p style=" text-transform: uppercase;
    letter-spacing: 5.7px;
    font-size: 11px;
    color: #f90202;
    text-shadow: 0px 1px 3px #454a47;
    font-family: 'Lato', sans-serif;
    font-weight: 600;" class="logo_w3l_agile_caption">BEST TILE PROVIDER</p></a></h1>
            
        </div>
    </div>
     
       <div class="home-sec" id="home" >
           <div class="overlay">
 <div class="container">
           <div class="row text-center " >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
                <div class="flexslider set-flexi" id="main-section" >
                  <h2 style="color:Orange">Login For Pre Order System</h2>
                    <ul class="slides move-me">
                        <!-- Slider 01 -->
                        <li>
                              <h3>High Quality  Products</h3>
                           <h1>We know what you love</h1>
                           <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
                          SIGN IN
                      </a>
                             <a  href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                                SIGN UP
                            </a>
							
							
                        </li>
                        <!-- End Slider 01 -->
                        
                        <!-- Slider 02 -->
                        <li>
                            <h3>High Quality Products</h3>
                           <h1>Various attrative different colors</h1>
                           
                           <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
                              SIGN IN
                          </a>
                             <a  href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                                SIGN UP
                            </a>
							
							
                            
                        </li>
                        <!-- End Slider 02 -->
                        
                        <!-- Slider 03 -->
                        <li>
                            <h3>High Quality Products</h3>
                           <h1>Get accommodation today</h1>
                           
                           <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
                            SIGN IN
                        </a>
                             <a  href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                                SIGN UP
                            </a>
							
                            
                        </li>
                        <!-- End Slider 03 -->
                    </ul>
                </div>
                   
     
              
              
            </div>
                
               </div>
                </div>
           </div>
           
       </div>
       <!--HOME SECTION END-->   
    <div  class="tag-line" >
         <div class="container">
           <div class="row  text-center" >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
                   </div>
               </div>
             </div>
        
    </div>
    
     <div class="modal fade" id="su" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#0f2453" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registration Form</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="register.php">
                   <fieldset>
					
							<div class="form-group">
                                <input class="form-control" placeholder="Firstname" name="ruser_firstname" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Lastname" name="ruser_lastname" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Address" name="ruser_address" type="text" required>
							</div>
							
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="ruser_email" type="email" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Password" name="ruser_password" type="password" required>
							</div>
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
              <button class="btn btn-md btn-success btn-block" name="register">Sign Up</button>
				
                <button type="button" class="btn btn-md btn-danger btn-block" data-dismiss="modal">Cancel</button>

				   </form>
              </div>
            </div>
          </div>
        </div>
<!-- Script -->


     <div class="modal fade" id="ln" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#0f2453" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="color:white" class="modal-title" id="myModalLabel">Customer Login</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="userlogin.php">
                   <fieldset>
					
						
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="user_email" type="email" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Password" name="user_password" type="password" required>
							</div>
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
              <button class="btn btn-md btn-primary btn-block" name="user_login">Sign In</button>
				
                <button type="button" class="btn btn-md btn-danger btn-block" data-dismiss="modal">Cancel</button>

				   </form>
				   
              </div>
            </div>
          </div>
        </div>
		
		<div class="modal fade" id="an" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
           <div style="color:white;background-color:#0f2453" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="color:white" class="modal-title" id="myModalLabel">Administrator Credentials</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="adminlogin.php">
                   <fieldset>
					
						
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="admin_username" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Password" name="admin_password" type="password" required>
							</div>
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
              <button class="btn btn-md btn-primary btn-block" name="user_login">Sign In</button>
				
                <button type="button" class="btn btn-md btn-danger btn-block" data-dismiss="modal">Cancel</button>

				   </form>
              </div>
            </div>
          </div>
        </div>
		 <br />
			 <br />
			 <br />
<!-- Script -->
     
   
    <!--  Jquery Core Script -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--  Core Bootstrap Script -->
    <script src="assets/js/bootstrap.js"></script>
    <!--  Flexslider Scripts --> 
         <script src="assets/js/jquery.flexslider.js"></script>
     <!--  Scrolling Reveal Script -->
    <script src="assets/js/scrollReveal.js"></script>
    <!--  Scroll Scripts --> 
    <script src="assets/js/jquery.easing.min.js"></script>
    <!--  Custom Scripts --> 
         <script src="assets/js/custom.js"></script>
         
</body>
</html>
