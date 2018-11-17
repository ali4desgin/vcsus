@extends("FrontEnd.Layout.Login.master")

@section("title")
     بيانات الملف الشخصي | منصة فيكسوس

@endsection



@section("content")
    	  <span id="base_url" style="display:none">{{ url('/') }}</span>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                           <div class="description">
								<?php


								if(!empty($data['errors'])){?>
                            	<p style="    color: #cc1c1c;
						font-weight: bold;
						font-size: 17px;
						background: #fff;
						PADDING: 11px;">
										<?php
										// foreach($data['errors'] as $error){

										// 	echo $error."<br/>";
										// }
?>
								</p>
								
									<?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-sm-8 col-sm-offset-2">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left text-center">
	                        			<h3>بيانات الملف الشخصي</h3>
	                        		</div>
	                        		<div class="form-top-right text-center">
	                        			<img src=" {{ url('FrontEnd/images/avatar.png') }}" class="img-responsive img-circle" id="blah" width="100" height="100px" style="height:100px;width:100px" />
                                    </div>
                                    
                                    
                                </div>
	                            <div class="form-bottom">
				                    <form role="form" action="{{ url('/register/last') }}" method="post" class="login-form" enctype="multipart/form-data">

				
                                    @csrf

									<div class="form-group">
				                        	<label class="sr-only" for="form-email">تاريخ الميلاد</label>
											<!--<input type="text" name="form-email" placeholder="الجامعة" class="form-email form-control" id="form-email">-->
											<div class="row">
												<div class="col-sm-3">
													<select  required="required" class="form-email form-control   select-university" name="day" id="form-day">
													
													</select>
												</div>

												<div class="col-sm-4">
													<select  required="required" class="form-email form-control   select-university" name="month" id="form-month">
													
													</select>
												</div>


												<div class="col-sm-5">
													<select  required="required" class="form-email form-control   select-university" name="year" id="form-year">
													
													</select>
												</div>
											</div>
				                        </div>




										<div class="form-group">
				                        	<label class="sr-only" for="form-email">الحالة الاجتماعية</label>
											<!--<input type="text" name="form-email" placeholder="الجامعة" class="form-email form-control" id="form-email">-->
											<select  required="required" class="form-email form-control   select-university" name="social_status" id="form-email">
												<?php

                                                
													for($i = 0; $i <= 4; $i++){

														echo "<option value='".$i."'>". \App\Helper::getSocialStatus($i) ."</option>";

													}
												?>
                                        	</select>
				                        </div>




				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">صورة البروفايل</label>
				                        	<input type="file" accept="image/gif, image/jpeg, image/png"  name="profile_image"  placeholder="كلمة المرور" class="form-password form-control" id="form-password" onchange="readURL(this);" >
				                        </div>

				                        <input type="submit" class="pull-right btn btn-primary" value="اكمال التسجيل"/>
                                        <a href="{{ url('/home') }}"
                                     class="btn btn-default">تخطي </a>
				                    </form>
			                    </div>
		                    </div>
		                
		                	
	                        
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
            
        </div>




    @endsection



    @section("script")

	<script type="text/javascript">
	function daysInMonth (year,month) {
		return new Date(year, month, 0).getDate();
	}


	function getMonthName(number){
			var month = new Array();
			month[1] = "يناير ";
			month[2] = "فبراير";
			month[3] = "مارس";
			month[4] = "ابريل";
			month[5] = "مايو";
			month[6] = "يونيو";
			month[7] = "يوليو";
			month[8] = "اغسطس";
			month[9] = "سبتمبر";
			month[10] = "اكتوبر";
			month[11] = "نوفمبر";
			month[12] = "ديسمبر";


			return month[number];
	}
	

		var day;
		for (day = 1; day <= 30; day++) { 
				$("#form-day").append("<option value='"+ day +"'>"+day+"</option>");
				
			}

	$("#form-month").change(function(){

	$("#form-day").html("");
		var day;
		var month = $(this).val();
	var year = $("#form-year").val();
		var days = daysInMonth (year,month);
		for (day = 1; day <= days; day++) { 
				$("#form-day").append("<option value='"+ day +"'>"+day+"</option>");
				
			}

	})

	var month;
	for (month = 1; month < 13; month++) { 
			$("#form-month").append("<option value='"+ month +"'>"+getMonthName(month)+"</option>");
			
		}


		var year;
		var max_year = new Date().getFullYear() - 10;
		for (year= 1980; year < max_year; year++) { 
			$("#form-year").append("<option value='"+ year +"'>"+year+"</option>");
		}


		function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

	</script>
    @endsection