@extends("FrontEnd.Layout.Login.master")

<?php
$title = "VCSUS | تأكيد الحساب";
?>

@section("title")
{{ $title }}
@endsection

@section("content")

		  <span id="base_url" style="display:none">{{  url("/") }}</span>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>{{ $title }}</h1>
                            <div class="description">
								<?php


						// 		if(!empty($data['errors'])){?>
                        <!-- //     	<p style="    color: #cc1c1c;
						// font-weight: bold;
						// font-size: 17px;
						// background: #fff;
						// PADDING: 11px;"> -->
										<?php
						// 				foreach($data['errors'] as $error){

						// 					echo $error."<br/>";
						// 				}
?>
								</p>
								
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-sm-8 col-sm-offset-2">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left text-center">
	                        			<h3>ارسلنا لك رمز تاكيد علي هاتفك {{ $phone }}</h3>
	                        		</div>
	                        		<div class="form-top-right text-center">
	                        			<i class="fa fa-lock"></i>
                                    </div>
                                    
                                    
                                </div>
                                <!-- <div class="" style="background:white">ارسلنا لك رمز تاكيد علي هاتفك {{ $phone }}</div> -->

									@if ($errors->any())
										<div class="alert alert-danger">
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									@endif

	                            <div class="form-bottom">
				                    <form role="form" action="{{ url('register/verify') }}" method="post" class="login-form">

										@csrf
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Code</label>
				                        	<input type="text" autocomplete="new-password" name="verification_code" placeholder="رمز التاكيد" class="form-password form-control" id="form-password">
				                        </div>
				                        <button type="submit" class="btn">تاكيد</button>
				                    </form>
			                    </div>
		                    </div>
		                
		                	
	                        
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
            
        </div>



@endsection