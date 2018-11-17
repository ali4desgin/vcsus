@extends("FrontEnd.Layout.Login.master")

<?php
$title = "الصفحة الرئيسية | VCSUS | منصة كل الطلاب";
?>

@section("title")
{{ $title }}
@endsection

@section("content")

		<span id="base_url" style="display:none">{{ url('/') }}</span>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>{{ $title }}</h1>
                            <div class="description">
								<?php


								if(!empty($data['errors'])){?>
                            	<p style="    color: #cc1c1c;
						font-weight: bold;
						font-size: 17px;
						background: #fff;
						PADDING: 11px;">
										<?php
										foreach($data['errors'] as $error){

											echo $error."<br/>";
										}
?>
								</p>
								
									<?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left text-center">
	                        			<h3>سجل دخولك للموقع</h3>
	                        		</div>
	                        		<div class="form-top-right text-center">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="{{ url('login') }}" method="post" class="login-form">

                                        @csrf
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">البريد الالكتروني </label>
				                        	<input type="email" name="email" placeholder=" البريد الالكتروني او اسم المستخدم" class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" autocomplete="new-password" name="password" placeholder="كلمة المرور" class="form-password form-control" id="form-password">
				                        </div>
				                        <button type="submit" class="btn">تسجيل دخول</button>
				                    </form>
			                    </div>
		                    </div>
		                
		                	<div class="social-login">
	                        	<h3>نشر الموقع على</h3>
	                        	<div class="social-login-buttons">
		                        	<a class="btn btn-link-1 btn-link-1-facebook" href="http://www.facebook.com/sharer.php?u=https://vcsus.net" target="_blank">
		                        		<i class="fa fa-facebook"></i> Facebook
		                        	</a>
		                        	<a class="btn btn-link-1 btn-link-1-twitter" target="_blank"   href="http://twitter.com/share?text=https://vcsus.net">
		                        		<i class="fa fa-twitter"></i> Twitter
		                        	</a>
		                        	<!-- <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
		                        		<i class="fa fa-google-plus"></i> Google Plus
		                        	</a> -->
	                        	</div>
	                        </div>
	                        
                        </div>
                        
                        <div class="col-sm-1 middle-border md-visiable"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left text-center">
	                        			<h3>إنضم الي المجتمع الجامعي</h3>
	                            	
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-user"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
									<form role="form" action="{{ url('/register/start') }}" method="post" class="registration-form">
									
                                        @csrf 
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">البريد  الالكتروني</label>
				                        	<input type="email"  placeholder="البريد الالكتروني" class="form-first-name form-control" name="stud_email" id="form-first-name" required="required">
				                        </div>
				                        <!--<div class="form-group">
				                        	<label class="sr-only" for="form-last-name">رقم الهاتف</label>
				                        	<input type="number" min="0"  placeholder="رقم الهاتف" class="form-last-name form-control" name="phone" id="form-last-name "  required="required">
				                        </div>-->
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">الجامعة</label>
											<!--<input type="text" name="form-email" placeholder="الجامعة" class="form-email form-control" id="form-email">-->
											<select  required="required" class="form-email form-control   select-university" name="university_id" id="form-email">
												 <?php
													if(!empty($data['universities'] )){


														foreach($data['universities']  as $university){

															echo "<option class='form-control' value=".$university['id'].">".$university['uni_name']."</option>";

														}
													}

												?> 
                                        	</select>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-about-yourself">الرقم الجامعي</label>
				                        	<!--<textarea name="form-about-yourself" placeholder="About yourself..." 
														class="form-about-yourself form-control" id="form-about-yourself"></textarea>-->

											<input type="number" name="stud_number" min="0" placeholder="الرقم الجامعي" class="form-email form-control" id="form-email"  required="required">
										
				                        </div>
				                        <button type="submit" class="btn">انشاء حساب</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>


@endsection