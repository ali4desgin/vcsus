@extends("FrontEnd.Layout.master")


<?php
$title = "الصفحة الرئيسية";
?>

@section("title")
{{ $title }}
@endsection



@section("styles") 

 <link href="{{ url('FrontEnd/styles/css/home.css') }}" rel="stylesheet">

 <style>
 .loading-posts-area {
    display:none;
    padding: 100px;
    background: #FFF;
 }
 </style>
@endsection




@section("content")
<!-- main three hread -->
<div class="container">
<div class="row">
    <div class="col-md-3">
        <!-- right part -->
        
        <div id="leftSideBar">
            <ul class="list-group text-right">
                <span class="title">المنتديات العامة</span>
                @foreach($fourms['globals'] as $fourm)
                    <li class="list-group-item">
                        <span class="badge">14</span>
                        <a href="{{ url('fourm/genral').'/'.$fourm->id }}">   {{ $fourm->four_title }} </a>
                        <span class="description">{{ $fourm->four_desc }}</span>
                    </li>
                @endforeach
                <span class="title">المنتدى الاكاديمي</span>
                <li class="list-group-item">
                    <span class="badge">14</span>
                    <a href="{{ url('fourm/department').'/'.$fourms['department']['id'] }}"> {{ $fourms['department']['four_title'] }} </a>
                    <span class="description">{{ $fourms['department']['four_desc'] }}</span>
                </li>
                <span class="title"> مدينتي</span>
                <li class="list-group-item">
                    <span class="badge">14</span>
                    <a href="{{ url('fourm/location').'/'.$fourms['postion']['id'] }}">  {{ $fourms['postion']['four_title'] }} </a>
                    <span class="description">{{ $fourms['department']['four_desc'] }}</span>
                </li>
            </ul>

        </div>

    </div>


    <div class="col-md-9">
        <!-- tab bar area -->
        <section class="tabbar" class="d-none d-lg-block">
            <div class="container clearfix">
            <div class="social-links float-right">
                
                <a href="?view=latest" class="facebook">احدث المنشورات</a>
                <a href="?view=old_first" class="twitter">الاقدم اولاً </a>
                <a href="?view=followers_only" class="instagram">المتابعين فقط</a>
                <a href="?view=high_views" class="google-plus">الاكثر مشاهدة</a>
                <a href="?view=random" class="google-plus">عشوائي</a>
                <!-- Button trigger modal -->
                <a type="" class="btn btn-sm btn-primary create-post-button" data-toggle="modal" data-target="#myModal" style="color:#fff">
                    <i class="fa fa-plus-circle "></i>  نشر حالة
                </a>





            <!-- start create new post form -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                <form action="{{ url('create-post')}} " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fas fa-user"></i></h4>
                </div>
                <div class="modal-body">
                        <div class="input-group">
                            <textarea id="post-text-area" name="content" class="form-control" placeholder="شاركنا بما تملك..." maxlength="200"></textarea>
                        </div>
                        <div class="append-images" id="append-images">
                            <img src="" id="uploaded-image"/>
                        </div>
                </div>
                <div class="modal-footer">

                    <div class="image-uploader-button">

                        <span   id="fake-uploader" class="fake-uploader">اضافة صورة</span>


                        <input type="file" name="image[]" id="post-uploader-file" class="post-uploader-file" onchange="imagesPreview(this);" accept="image/gif, image/jpeg, image/png" multiple>
                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق <i class="fa fa-"></i></button>
                    <button type="submit" id="create_post_submit" class="btn btn-primary btn-sm create-post-button">مشاركة <i class="fa fa-share"></i></button>
                    <span class="pull-left" id='remining-chars' style="color:#AAA">200</span>
                </div>
                </form>

                </div>
            </div>
            </div>
             <!-- end create new post form -->
















            </div>
            </div>
        </section>







            <!-- start edit post form -->
            <div class="modal fade" id="postEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                <form action="{{ url('post/edit')}} " method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="post_id" id="editpostid" value=""/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fas fa-user"></i></h4>
                </div>
                <div class="modal-body">
                        <div class="input-group">
                            <textarea id="post-text-area" name="content" class="editpostcontent form-control" placeholder="شاركنا بما تملك..." maxlength="200"></textarea>
                        </div>
                       
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق <i class="fa fa-"></i></button>
                    <button type="submit" id="create_post_submit" class="btn btn-primary btn-sm create-post-button">تعديل <i class="fa fa-share"></i></button>
                   
                </div>
                </form>

                </div>
            </div>
            </div>



            
             <!-- edit post form -->




        <!-- posts and right  area -->
        <div class="row">
            <div class="col-sm-8 text-center">
                    <!-- display errors -->
                        @if ($errors->any())
                            <div class="errors">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li class="alert alert-danger">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <!--posts -->
                    @if (!empty($posts))
                        <div class="loading-posts-area" id="loading-posts-area">
                            <img src="{{ url('FrontEnd/images/loading.gif') }}" class="img-thumbnail"/>
                        </div>
                        <div class="posts list-group text-right" id="posts">
                        @foreach ($posts as $post)


                            <?php
                                $stud_id = $post->stud_id;
                                $student = \App\Student::getActiveStudent($stud_id);
                              
                                $post_images = \App\Image::where("post_id",'=',$post->id)->get();
                                
                                if(!empty($student)){
                                    $profile = \App\Profile::where('stud_id',"=",$stud_id )->first();

                                    $views  = $post->post_views + 1;
                                    \App\Post::where("id","=",$post->id)->update(["post_views" => $views]);
                            ?>  
                            <div class="post list-group-item">
                                            
                                    <!-- <div class="tab_bar">
                                        <div class="row">
                                            <div class="col-sm-6 text-center  active">المنشور</div>
                                            <div class="col-sm-6 text-center">مرفقات</div>
                                        </div>
                                    </div> -->



                                    <div class="post_info">
                                        <div class="row">
                                                <div class="col-sm-1">



                                                    <img src="<?php echo  'usersdata/profile_images/'.$student->id.'/'.$profile->stud_profile_img ;?>" class="img-responsive img-circle"/>
                                                </div>
                                                <div class="col-sm-11">
                                                    <div class="left">
                                                    <?php 

                                                    if($post->stud_id == Session::get("id")){
                                                     ?>
                                                    <span class="pull-left options">
                                                    <A href="{{ url('post/edit/'. $post->id ) }}" data-toggle="modal" data-target="#postEdit" data-id="{{ $post->id }}" class="postEditBtn"><i class="fa fa-edit"></i></a>
                                                    <span class="postEditBtncontent{{ $post->id }} hiddenAll">{{ $post->content }}</span>
                                                        <A href="{{ url('post/delete/'. $post->id ) }}" class="confirm"><i class="fa fa-remove"></i></a>
                                                        <!-- <A href=""> <i class="fa fa-eye"></i></a> -->
                                                    </span>

                                                    <?php }?>
                                                        <a href="{{ url('/profile/') .'/'. $post->stud_id  }}" class="studentname">
                                                        <?php 
                                                            if($student->stud_name == NULL){
                                                                echo $student->stud_email ;
                                                            }else{

                                                                echo $student->stud_name ;
                                                            }
                                                        ;?>
                                                    </a>
                                                        <Span class="date"><i class="fa fa-clock"></i> {{ $post->created_at }}</span>
                                                        
                                                        
                                                    </div>

                                                </div>

                                        </div>
                                    </div>




                                    <div class="post_content">
                                        <div class="row">
                                                <div class="col-sm-1">
                                                    
                                                </div>
                                                <div class="col-sm-11">
                                                    {{ $post->content }}
                                                </div>  
                                        </div>



                                        <div class="row">
                                            
                                            @if(count($post_images)>=1)
                                            <div class="post-images">
                                                @foreach($post_images as $img)
                                                        
                                                    <img src="{{ url('/usersdata/posts/'.$post->id.'/'.$img->img_path) }}" class="post-img"/>

                                                @endforeach
                                                        </div>
                                            @endif
                                        

                                        </div>
                                    </div>

                                    <div class="toolbar">
                                        <div class="row">
                                            <div class="col-sm-6 text-center"><i class="fa fa-eye"></i> {{ $post->post_views }}</div>
                                            <div class="col-sm-6 text-center"><a href="{{ url('post/'.$post->id) }}"><i class="fa fa-comments"></i> 
                                                            <?php echo \App\Comment::getCommentsCount($post->id);?></a>
                                            </div>
                                            <!-- <div class="col-sm-4 text-center"><i class="fa fa-share"></i></div> -->
                                        </div>
                                    </div>
                            </div>

                                <?php }?>
                        @endforeach
                        </div>
                    @endif
                    <div class="alert text-center">
                     
                    </div>
                    
            </div>



            <div class="col-sm-4">
                    <!--left menu -->
                    @if(!empty($rand_students))
                    <div class="row">  
                    <div class="students_to_follow_title" style="    padding: 10px;
    margin-right: 5px;
    font-size: 14px;
    font-weight: bold;
    color: #777;"> <i class="fa fa-users"></i> اشخاص مقترحين</div>              
                        @foreach($rand_students as $student)
                        <?php 
                            $profile = \App\Profile::where('stud_id',"=",$student->id )->first();
                            if(!empty($profile)){

                                if(is_file('usersdata/profile_images/'.$student->id.'/'.$profile->stud_profile_img)){

                                    $image = 'usersdata/profile_images/'.$student->id.'/'.$profile->stud_profile_img;
                                }else{


                                    $image = 'usersdata/profile_images/avatar.png';
                                }



                                if(empty($profile->stud_about)){

                                        $bio = "لا يوجد وصف حاليا";
                                }else{

                                    $bio = $profile->stud_about;
                                }



                                if(empty($student->stud_name)){

                                    $name = $student->stud_email;
                                    }else{

                                        $name = $student->stud_name;
                                    }
                                ?>



                                <div class="col-sm-12 col-md-12">
                                    <div class="thumbnail" style="    background: #FFF;
    margin: 10px 0px;
    padding: 5px;">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="<?php echo   $image;?>" class="rounded img-thumbnail" style="height:61px"  />
                                        </div>
                                        <div class="col-sm-8" style="    overflow: hidden;
    word-break: break-all;">
                                            <p style="    text-align: right;
    /* margin-left: 24px; */
    color: #1ab9e7;
    font-size: 11px;
    font-weight: bold;"><a href="{{ url('/profile/') .'/'. $student->id  }}"><?php echo $name ;?></a></p>
                                            <p STYLE="    font-size: 10px;
    text-align: center;
    color: #000;"><?php echo $bio;?></p>
                                            <a style="background: #1ab9e7;
    border-color: #1ab9e7;" class="btn btn-primary btn-sm" href="{{ url('/follow').'/'.$student->id }}">متابعة <i class="fab fa-twitter"></i></a>
                                        </div>
                                    </div>
                                        
                                        
                                    </div>
                                </div>


                            <?php
                            }
                            ?>
                        @endforeach
                        </div>
                    @endif

                    
            </div>

            
        </div>
    </div>
</div>


</div>

@endsection



@section("scripts")


<script>
$("#search_top_input").keyup(function(){
   var text = $(this).val(),
        posts_area = $("#posts"),
        loading  = $("#loading-posts-area");
        posts_area.html("");
        loading.fadeIn();
    $.ajax({
        'url':'ajax/search/posts',
        'type': "POST",
        'data':{keyword:text},
        'success':function(data){
                 objs = data;
                for (i = 0; i < objs.posts.length; i++) {
                   
                    console.log( objs.posts[i].content);
                        var content  = objs.posts[i].content,
                         created_at = objs.posts[i].created_at,
                        four_id = objs.posts[i].four_id,
                        img_id = objs.posts[i].img_id,
                        post_created_date = objs.posts[i].post_created_date,
                        post_privacy = objs.posts[i].post_privacy,
                        post_status = objs.posts[i].post_status,
                        post_type = objs.posts[i].post_type,
                        post_views = objs.posts[i].post_views,
                        stud_id = objs.posts[i].stud_id,
                        updated_at = objs.posts[i].updated_at;

                        // get student data
                        $.ajax({
                            'url':'ajax/get/student',
                            'type': "POST",
                            'data':{stud_id:stud_id},
                            'success':function(student){
                                  
                                    loading.fadeOut();

                                     var post_row  = "<div class=\"post list-group-item\"><div class=\"\"</div>";
                                // post_row. = content;
                                // post_row.= "</div>";

                                     posts_area.append(post_row);

                                


                            },
                            'error':function(error){
                                console.log(error);
                            }

                        });

                        // endstudent data
                        




                }
        },
        'error':function(error){
            console.log(error);
        }

    });

});
</script>



@endsection