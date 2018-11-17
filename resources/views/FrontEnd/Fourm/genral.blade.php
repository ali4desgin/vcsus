@extends("FrontEnd.Layout.fourm")


@section("fourm_title")
   المنتديات العامة | {{ $fourm->four_title }}
@endsection
 

 @section("talbar2")
 
 <div style=" height: 55.75px;
background-color: rgb(2.......55, 255, 255);
text-align: center;
margin-left: 300px;
margin-right: 108px;
z-index: 100;
margin-bottom: 13px;
margin-top: -59px;
margin: -59px 230px 13px 264px;" class="sticky-wrapper" id="sticky-wrapper" style="">
    <div style="width: 825px
    margin: 6px 87px -3px -3px;
    margin-right: 87px;
    font-size:13pt;" class="tabbar">
            <div class="container clearfix">
            <div class="social-links float-right" style="margin: 15px;">
                
                <a href="?view=latest" class="facebook">احدث المنشورات</a>|
                <a href="?view=old_first" class="twitter">الاقدم اولاً </a>|
                 
                <a href="?view=high_views" class="google-plus">الاكثر مشاهدة</a>|
                
                <!-- Button trigger modal -->
                <a type="" class="btn btn-sm btn-primary create-post-button" data-toggle="modal" data-target="#myModal" style="color:#fff">
                    <i class="fa fa-plus-circle "></i>  نشر حالة
                </a>





            <!-- start create new post form -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                <form action="{{ url('fourmpost')}}" method="POST" enctype="multipart/form-data">
     
     @csrf

     <input type="hidden" name="frm_id" value="{{  $fourm->id }}"> 
<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fas fa-user"></i></h4>
                </div>
                <div class="modal-body">
                        <div class="input-group">
                            <textarea id="post-text-area" name="content" class="form-control" placeholder="شاركنا بما تملك..." maxlength="200"></textarea>
                        </div>
                                      </div>
                <div class="modal-footer">

                    

                    <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق <i class="fa fa-"></i></button>
                    <button type="submit" id="create_post_submit" class="btn btn-primary btn-sm create-post-button">مشاركة <i class="fa fa-share"></i></button>
                    <span class="pull-left" id="remining-chars" style="color:#AAA">200</span>
                </div>
                </form>

                </div>
            </div>
            </div>
             <!-- end create new post form -->

            </div>
            </div>
         </div>
     </div>
 @endsection

@section("content")
<div class="container">
<div class="row">
    
     
                    @foreach($posts as $post)
                    <?php
                        $views = $post->post_views + 1;
                        \App\Post::where("id","=",$post->id)->update(["post_views" => $views]);
                        $student = \App\Student::where("id",$post->stud_id)->first();
                        $profile = \App\Profile::where("stud_id",$post->stud_id)->first();
                        $comments = \App\Comment::where("post_id",$post->id)->count();
                       // var_dump($profile->stud_profile_img);
                        $images_ids =  $post->img_id;
                        //$post_images = [];
                        $image = "";
                        if($images_ids!=NULL){
                                $ids_area = explode(",",$images_ids);
                                $image = \App\Image::where("id",end($ids_area))->first();


                              // var_dump($image);
                                // foreach($ids_area as $id){
                                //         $image = \App\Image::where("id",$id)->first();
                                    
                                //         $post_images[] = $image;
            // }
    }

//echo url('usersdata/profile_images/'.$post->stud_id.'/'.$profile->stud_profile_img);

//echo url('usersdata/profile_images').'/'.$post->stud_id.'/'.$profile->stud_profile_img;
    if(!empty($profile->stud_profile_img)){

        $profile_image = url('usersdata/profile_images').'/'.$post->stud_id.'/'.$profile->stud_profile_img;
    }else{


        $profile_image = url('usersdata/profile_images/avatar.png');
    }

    //echo $profile_image;
?>

<div class="col-lg-7 col-md-6 sm-12">
    <div class="card h-100">
         

        <div class="single-post post-style-1" style="hover:
        background-color: rgb(222, 222, 204);
    ">
            <a class="avatar" href="#" style="margin-right: -449px;
margin-top:8px;"><img src="{{ $profile_image  }}" alt="Profile Image"></a>
           
        <div class="postr_name"  style="margin-right: -325px;
margin-top:-5px;" 
       > {{  $student->stud_name }} 
    <p style="
    margin-left: 81px;
    font-size: 11px;
    color: #968686;">{{  $post->post_created_date }}</p> 
</div>   

            
            <div class="blog-info">

                <h4 class="title">
                    <b id="subpost">
                        {{ \App\Helper::SubStrWithLen($post->content , 1000)}}
                    </b>
                    <p>.......<a  id="postviwe"href="#"style="color: blue;">قراءة المزيد
                         
                       </a>
                       <div id="readpost" style="display:none;">{{$post->content}}</div>
                       
                   </p></h4>

                <ul class="post-footer">
                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                    <li><a href="#"><i class="ion-chatbubble"></i> 
                        {{ $comments }}</a></li>
                    <li><a href="#"><i class="ion-eye"></i>{{ $post->post_views }}</a></li>
                </ul>

            </div>
        </div>

    </div>
  </div>

    
@endforeach
<div>
<div  style="position: absolute;
background-color: fff;
top:0px;"> <div id="leftSideBar">
            <ul class="list-group text-right">
                <span style="font-size: 14px;
padding: 10px;
color: #b3b9bf;
margin-top: 5px;
font-weight: bold;" class="title">المنتديات العامة ... <i style=" background-color: rgb(255, 255, 255);padding: 8px;border-radius: 15px;color:rgb(165, 165, 185);  " class="badge">{{ $fourm0 }}</i></span>
                @foreach($fourms['globals'] as $fourm)
                    <li class="list-group-item">
                       
                        <a style="color:#1ab9e7;" href="{{ url('fourm/genral').'/'.$fourm->id }}">   
                            {{ $fourm->four_title }} </a>
                        
                    </li>
                @endforeach
                <span style="font-size: 14px;
padding: 10px;
color: #b3b9bf;
margin-top: 5px;
font-weight: bold;" class="title"> اكاديمي... <i style="background-color: rgb(255, 255, 255);padding: 8px;border-radius: 15px;" class="badge"></i></span>
               <li class="list-group-item">
                         
                        <a  style="color:#1ab9e7;" href="{{ url('fourm/department').'/'.$fourms['department']['id'] }}"> 
                            {{ $fourms['department']['four_title'] }} </a>
                        
                    </li>
                <span class="title" style="font-size: 14px;
padding: 10px;
color: #b3b9bf;
margin-top: 5px;
font-weight: bold;"> مدينتي... <i style="background-color: rgb(255, 255, 255);padding: 8px;border-radius: 15px;" class="badge"></i></span>
                 
                    <li class="list-group-item">
                         
                       <a style="color:#1ab9e7;" href="{{ url('fourm/location').'/'.$fourms['postion']['id'] }}"> 
                        {{ $fourms['postion']['four_title'] }} </a>
                    
                       

                    
                    </li>
               

            </ul>

        </div>

    </div>
     </div>
 
</div>
</div>
</div>

@endsection
@section("scripts")
<script type="text/javascript">
                        $(document).ready(function () {
                          $("#postviwe").click(function  () {
                              alert("jdhdhhdhdhd");
                        });
                       </script>
@endsection

<!-- <div class="col-lg-4 col-md-6">
    <div class="card h-100">
        <div class="single-post post-style-1">

            <div class="blog-image"><img src="{{ url('FrontEnd/Fourm/images/marion-michele-330691.jpg') }}" alt="Blog Image"></div>

            <a class="avatar" href="#"><img src="{{ url('FrontEnd/Fourm/images/icons8-team-355979.jpg') }}" alt="Profile Image"></a>

            <div class="blog-info">

                <h4 class="title"><a href="#"><b>How Did Van Gogh's Turbulent Mind Depict One of the Most Complex
                Concepts in Physics?</b></a></h4>

                <ul class="post-footer">
                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                </ul>

            </div>
        </div>
    </div>
</div>
       -->
