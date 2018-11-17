@extends("FrontEnd.Layout.Login.master")

@section("title")
    البيانات الثانوية | منصة فيكسوس

@endsection



@section("content")
   
<span id="base_url" style="display:none">{{ url("/") }}</span>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                           <div class="description">
								<!-- <?php


// 								if(!empty($data['errors'])){?>
//                             	<p style="    color: #cc1c1c;
// 						font-weight: bold;
// 						font-size: 17px;
// 						background: #fff;
// 						PADDING: 11px;">
// 										<?php
// 										foreach($data['errors'] as $error){

// 											echo $error."<br/>";
// 										}
// ?>
// 								</p>
								
// 									<?php //} ?> -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-sm-8 col-sm-offset-2">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left text-center">
	                        			<h3> البيانات الاساسية  </h3>
	                        		</div>
	                        		<div class="form-top-right text-center">
	                        			<i class="fa fa-info-circle"></i>
                                    </div>
                                    
                                    
                                </div>
	                            <div class="form-bottom">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
				                    <form role="form" action="{{ url('/register/final') }}" method="post" class="login-form">

				

                                    @csrf

									<div class="form-group">
				                        	<label class="sr-only" for="form-email">الكلية</label>
											<!--<input type="text" name="form-email" placeholder="الجامعة" class="form-email form-control" id="form-email">-->
											<select  required="required" class="form-email form-control   select-university" name="faculty_id" id="form-email">
												<?php
													if(!empty($data['faculties'] )){


														foreach($data['faculties']  as $faculty){

															echo "<option class='form-control' value=".$faculty['id'].">".$faculty['facl_name']."</option>";

														}
													}

												?>
                                        	</select>
				                        </div>





										<div class="form-group">
				                        	<label class="sr-only" for="form-email">المدينة</label>
											<!--<input type="text" name="form-email" placeholder="الجامعة" class="form-email form-control" id="form-email">-->
											<select  required="required" class="form-email form-control   select-university" name="city_id" id="form-email">
												<?php
													if(!empty($data['cities'] )){


														foreach($data['cities']  as $city){

															echo "<option class='form-control' value=".$city['id'].">".$city['pos_name']."</option>";

														}
													}

												?>
                                        	</select>
				                        </div>




				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Code</label>
				                        	<input type="password" autocomplete="new-password" name="password"  value=""placeholder="كلمة المرور" class="form-password form-control" id="form-password">
				                        </div>

										<div class="form-group">
				                        	<label class="sr-only" for="form-password">Code</label>
				                        	<input type="password" autocomplete="new-password"  value="" name="confrim_password" placeholder="تآكيد كلمة المرور " class="form-password form-control" id="form-password">
				                        </div>


				                        <button type="submit" class="btn">اكمال التسجيل</button>
				                    </form>
			                    </div>
		                    </div>
		                
		                	
	                        
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
            
        </div>


@endsection