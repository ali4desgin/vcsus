@extends("FrontEnd.Layout.master")

<?php
$title = "الصفحة الرئيسية | المكتبة";
?>

@section("title")
{{ $title }}

@endsection


@section('styles')

<style type="text/css">

.card{
    width: 230px; 
    margin-top: 40px;
}

.img{

    height: 150px;
    width: 200px;
    margin-left: -14px;
    margin-top: 2px;
    margin-bottom:6px;
}
.body{

	text-align: right;
	font-size: 14px;
    margin-top: 3px;
    margin-right: 19px;
    }
.sub{
	     margin-top: 7px;
    border-color: #235b6b;
    margin-bottom: 10px;
    margin-right: 33px;
}
.header{
 background-color:

}
.sec{
      width: 624px;
    margin-right: 234px;
}
.secc{
  text-align:center;
  font-size: 20px; 
  font-family: fantasy;
  font-weight: bold;
  color: green;

}
</style>

@endsection


@section('content')

<div class="container">
 


        <!-- tab bar area -->
        <section class="tabbar sec" class="d-none d-lg-block "  >
            <div class="container clearfix">
            <div class="social-links float-right">
                
                <a href="?view=latest" class="facebook">الملفات الاحدث</a>
                <a href="?view=word" class="facebook">ملفات ويرد</a> 
                <a href="?view=powr" class="facebook">ملفات بوربوينت</a>
                <a href="?view=book" class="facebook">ملفات صيغة ي دي اف</a>
                <a href="?view=viduo" class="facebook">ملفات فيديو</a>
            



             
                <!-- Button trigger modal -->
                <a type="" class="btn btn-sm btn-primary create-post-button" data-toggle="modal" data-target="#myModal" style="color:#fff">
                    <i class="fa fa-plus-circle "></i>  رفع ملف
                </a>



              



            <!-- start create new post form -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                <form action="{{ url('uplod-file')}} " method="POST" enctype="multipart/form-data">
                @csrf
               
                <div class="modal-body">
                        
                </div>
                <div class="modal-footer">

                    <div class="image-uploader-button">

            <input type="file" name="filename[]" id="post-uploader-file" class="post-uploader-file" onchange="imagesPreview(this);" accept="file/pdf,file/viduo, file/docx,file/pptx,file/doc" multiple >
                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق <i class="fa fa-"></i></button>
                    <button type="submit" id="create_post_submit" class="btn btn-primary btn-sm create-post-button">مشاركة <i class="fa fa-share"></i></button>
      
                </div>
                </form>

                </div>
            </div>
            </div>
             <!-- end create new post form -->


            </div>
            </div>
        </section>
      


            @if(session('success'))
            <div class="alert alert-success secc">
            {{ session('success') }}
           </div> 
            @endif

              @if (count($errors) > 0)
              <div class="alert alert-danger">
                 <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif  







  <div class="row">
@foreach( $libarary as $viwe)
  


<?php 
if( $viwe->file_status == 0){

?>


    <div class="col-sm-3">

      <div class="panel panel-default card ">
        <div class="img">

          <?php 
        if( $viwe->file_type == "pdf"){
 
          ?>
           <img src="/FrontEnd/images/pdf.png" class="img-responsive rounded img-thumbnail img">
     


     <?php
   }else if($viwe->file_type == "docx"){

   ?>
      <img src="/FrontEnd/images/word.jpg" class="img-responsive rounded img-thumbnail img">

   <?php
    }else if($viwe->file_type == "pptx"){

    ?>
    <img src="/FrontEnd/images/powr.png" class="img-responsive rounded img-thumbnail img">

   <?php
    }else if($viwe->file_type == "viduo"){
      ?>
    <img src="/FrontEnd/images/viduo.jpg" class="img-responsive rounded img-thumbnail img">

   <?php
    }else {
      ?>

    <img src="/FrontEnd/images/visa.png" class="img-responsive rounded img-thumbnail img">

   <?php
    }

    ?>   





  



          </div>
          <div class="body">
            الاسم : {{ $viwe->file_title }}
             <br>
            الحجم : {{ $viwe->file_size }}
              <br>
              النوع : {{ $viwe->file_type }}
         
             <br>
                التاريخ : {{ $viwe->file_date }}

            <div class="header">
        
            <a href="/download" class="btn btn-large pull-right sub"><i class="icon-download-alt"> </i> 
   
             <i class="fa fa-arrow-down"></i> تحميل     </a>

          </form>
           </div>
           </div>
         </div>
     </div>

<?php

}
?>
  @endforeach


  </div>


</div>
@endsection