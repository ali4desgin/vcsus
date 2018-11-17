@extends("FrontEnd.Layout.profile")


@section("title")
    الملف الشخصي | 
    @if(empty($info['student']['stud_name']))
        {{ $info['student']['stud_email'] }} 
    @else

        {{ $info['student']['stud_name'] }}
    @endif
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

<?php
$current_id = \Session::get('id');
$cover_image =  url('usersdata/profile_images/') .'/'.$info['profile']['stud_cover_image'];


if(is_file('usersdata/profile_images/'.$info['student']['id'].'/'.$info['profile']['stud_profile_img'])){

    $profile_image = url('usersdata/profile_images').'/'.$info['student']['id'].'/'.$info['profile']['stud_profile_img'];
}else{


    $profile_image =  url('usersdata/profile_images/avatar.png') ;
}





?>
<style>
.cover{
    color: rgb(255, 255, 255);
    position: relative;
    min-height: 400px;
    background: url({{  $cover_image }}) center center no-repeat;
    background-size: cover;
}
</style>



<div class="cover">
    <div class="container toMaxHeight">
        <div class="profile_img_cover">
            <img src="{{$profile_image}} " class="profile_image" />
        </div>



        
        <section class="profile_tab_bar" class="d-none d-lg-block">
            <div class="container clearfix">
            <div class="social-links float-right">
                
                <a href="#" class="tablinks active" onclick="viewTap(event, 'posts')"> <i class="fa fa-share-alt"></i> المنشورات <?php 
                    echo count($info['posts']);
                
                ?></a>
                <a href="#" class="tablinks" onclick="viewTap(event, 'followers')"> <i class="fa fa-users"></i> المتابعين <?php 
                    echo count($info['followers']);
                
                ?> </a>
                <a href="#" class="tablinks" onclick="viewTap(event, 'followings')"> <i class="fab fa-twitch"></i> يتابع <?php 
                    echo count($info['followings']);
                
                ?></a>
                <!-- <a href="#" class="tablinks" onclick="viewTap(event, 'files')"> <i class="fa fa-file"></i> الملفات <?php 
                    echo count($info['posts']);
                
                ?></a> -->
            <a href="#" class="tablinks" class="btn btn-sm btn-primary create-post-button" data-toggle="modal" data-target="#myModal" style="">
                    <i class="fa fa-plus-circle "></i>  نشر حالة
                </a>
                
            
            
            </div>
            </div>
        </section>
        <?php
        
        if($current_id==$info['student']['id']){
            ?>

            <a href="{{ url('/editprofile') }}" class="btn btn-warning follow_profile_button"> تعديل البيانات <i class="fa fa-edit"></i></a>
            <?php
        }else{
            $check_follw = \App\Follower::check_follow($current_id,$info['student']['id']);
            if(!$check_follw){
            ?>
            <a href="{{ url('/follow').'/'.$info['student']['id'] }}" class="btn btn-primary follow_profile_button"> متابعة <i class="fab fa-gratipay"></i></a>

            <?php
            } 
             else {

        
            ?>
            <a href="{{ url('/unfollow').'/'.$info['student']['id'] }}" class="btn btn-danger follow_profile_button"> الغاء المتابعة <i class="fas fa-thumbs-down"></i></a>

        <?php
            }
        }
    ?>




    </div>


</div>





  
<div class="container">
    <div class="row">
        <!-- <div class="col-sm-1"></div> -->
        <div class="col-sm-8">

            <!-- Tab content -->
            <div id="followers" class="tabcontent ">


                @if(!empty($info['followers']))
                    <h3 style="    color: #AAA;
    padding: 12px;
    border-bottom: 1px solid #e4e1e1;
    text-align: center !important;
    margin-top: 11px;
    font-size: 23px;">المتابعين <i class="fa fa-users"></i></h3>

                    <div class="row">
                    @foreach($info['followers'] as $follower)

                    
                       <?php
//echo $follower->follwer_id .'<br/>';
                            $data = \App\Student::getStudentWithProfile($follower->follwer_id );
                           //echo  $data['profile']['stud_id'].'<br/>';
                          //if(!empty($data['profile'])){
                                $profile = $data['profile'];
                                $basic = $data['student'];

                                if(is_file(url('usersdata/profile_images/').'/'.$basic->id.'/'.$profile->stud_profile_img)){

                                    $image =  url('usersdata/profile_images/').'/'.$basic->id.'/'.$profile->stud_profile_img;
                                }else{

                                   // die(url('usersdata/profile_images/avatar.png'));
                                    $image = url('usersdata/profile_images/avatar.png');
                                }
                              
                               // var_dump($profile->id);
                                //var_dump($profile->id);
                                $details = $info['city']['pos_name'].' - '.$info['university']['uni_name'];
                                $name = (empty($basic->stud_name)) ? $basic->stud_email : $basic->stud_name; // $r is set to 'Yes'
                                $description = (empty($profile->stud_about)) ?  $details : $profile->stud_about . '<br/>'.$details; 



                                

                                $follow = \App\Follower::check_follow($current_id,$basic->id);
                                //var_dump( $follow);
                            ?>
                            <div class="col-sm-6  follower">
                                <div class="card">
                                    <div class="row ">
                                        <div class="col-sm-4 ">
                                            <img class="card-img-top" src="{{ $image }} " alt="Card image cap">
                                        </div>
                                        <div class="col-sm-8">
                                            <h5 class="card-title"><a href='{{ url('/profile').'/'.$basic->id }}'><i class="fa fa-user"></i> {{  $name }}</a></h5>
                                            <p class="card-text">{{  $description }}</p>
                                            <?php
                                                if($follow){
                                            ?>
                                                    <a href="{{ url('/profile').'/'.$basic->id }}" class="btn btn-success btn-sm"><i class='fa fa-user'></i> الملف الشخصي</a>
                                            <?php   
                                                }else{
                                            ?>
                                                    <a href="{{ url('/follow').'/'.$basic->id }}" class="btn follow btn-primary btn-sm"><i class='fab fa-twitter'></i> متابعة</a>


                                                    
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        
                                    </div> -->
                                </div>
                            </div> 
                            <?php
                            
                           //}    
                        ?>

                    @endforeach
                    </div>
                @endif



            </div>







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






            <div id="followings" class="tabcontent">


                @if(!empty($info['followings']))
                    <h3 style="    color: #AAA;
    padding: 12px;
    border-bottom: 1px solid #e4e1e1;
    text-align: center !important;
    margin-top: 11px;
    font-size: 23px;">يتابع <i class="fa fa-users"></i></h3>

                    <div class="row">
                    @foreach($info['followings'] as $follower)

                    
                       <?php
//echo $follower->follwer_id .'<br/>';
                            $data = \App\Student::getStudentWithProfile($follower['follwing_id'] );
                           //echo  $data['profile']['stud_id'].'<br/>';
                          //if(!empty($data['profile'])){
                                $profile = $data['profile'];
                                $basic = $data['student'];

                                if(is_file(url('usersdata/profile_images/').'/'.$basic->id.'/'.$profile->stud_profile_img)){

                                    $image =  url('usersdata/profile_images/').'/'.$basic->id.'/'.$profile->stud_profile_img;
                                }else{


                                    $image = url('usersdata/profile_images/avatar.png');
                                }

                               // var_dump($profile->id);
                                //var_dump($profile->id);
                                $details = $info['city']['pos_name'].' - '.$info['university']['uni_name'];
                                $name = (empty($basic->stud_name)) ? $basic->stud_email : $basic->stud_name; // $r is set to 'Yes'
                                $description = (empty($profile->stud_about)) ?  $details : $profile->stud_about . '<br/>'.$details; 



                                $current_id = \Session::get('id');

                                $follow = \App\Follower::check_follow($current_id,$basic->id);
                                //var_dump( $follow);
                            ?>
                            <div class="col-sm-6  follower">
                                <div class="card">
                                    <div class="row ">
                                        <div class="col-sm-4 ">
                                            <img class="card-img-top" src="{{ $image }} " alt="Card image cap">
                                        </div>
                                        <div class="col-sm-8">
                                            <h5 class="card-title"><a href='{{ url('/profile').'/'.$basic->id }}'><i class="fa fa-user"></i> {{  $name }}</a></h5>
                                            <p class="card-text">{{  $description }}</p>
                                            <?php
                                                if($follow || \Session::get('id') == $basic->id){
                                            ?>
                                                    <a href="{{ url('/profile').'/'.$basic->id }}" class="btn btn-success btn-sm"><i class='fa fa-user'></i> الملف الشخصي</a>
                                            <?php   
                                                }else{
                                            ?>
                                                    <a href="{{ url('/follow').'/'.$basic->id }}" class="btn follow btn-primary btn-sm"><i class='fab fa-twitter'></i> متابعة</a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        
                                    </div> -->
                                </div>
                            </div> 
                            <?php
                            
                           //}    
                        ?>

                    @endforeach
                    </div>
                @endif


            </div>





























            <div id="posts" class="tabcontent" style="display: block;">
            
                    <!--posts -->
                    @if (!empty($info['posts']))
                        <div class="posts list-group text-right">
                        @foreach ($info['posts'] as $post)


                            <?php
                                $stud_id = $post->stud_id;
                                $student = \App\Student::getActiveStudent($stud_id);
                                $post_images = \App\Image::where("post_id",'=',$post->id)->get();
                                    $profile = $info['profile'];
                                    $views  = $post->post_views + 1;
                                    \App\Post::where("id","=",$post->id)->update(["post_views" => $views]);
                            ?>  
                            <div class="post list-group-item">

                                    

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



                                    <!-- <div class="post_content">
                                        <div class="row">
                                                <div class="col-sm-1">
                                                    
                                                </div>
                                                <div class="col-sm-11">
                                                    {{ $post->content }}
                                                </div>  
                                        </div>



                                    </div>
 -->



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

                        @endforeach
                        </div>
                    @endif


                    <div class="alert text-center">
{{ $info['posts']->links() }}
                    </div>



            </div>


























           
        </div>





        <div class="col-sm-4">
            <ul class="list-group">
                <?php
                    if(!empty(($info['student']['stud_name']))){

                        ?>
                        <li class="list-group-item"><i class="fa fa-user"></i> {{ $info['student']['stud_name']  }} </li>
                        <?php
                    }
                ?>
                  <?php
                    if(!empty(($info['student']['stud_email']))){

                        ?>
                        <li class="list-group-item"><i class="fas fa-at"></i> {{ $info['student']['stud_email']  }}</li>
                        <?php
                    }
                ?>
                  <?php
                    if(!empty(( $info['university']['uni_name'] ))){

                        ?>
                        <li class="list-group-item"><i class="fas fa-university"></i> {{ $info['university']['uni_name']  }}</li>
                        <?php
                    }
                ?>
                  <?php
                    if(!empty(($info['fauclty']['facl_name'] ))){

                        ?>
                        <li class="list-group-item"><i class="fas fa-universal-access"></i> {{ $info['fauclty']['facl_name']  }}</li>
                        <?php
                    }
                ?>
                  <?php
                    if(!empty(($info['student']['stud_name']))){

                        ?>
                        <li class="list-group-item"><i class="fas fa-map-marker-alt"></i>   {{ $info['city']['pos_name']  }}</li>
                        <?php
                    }
                ?>
                  <?php
                    if(!empty(($info['student']['stud_name']))){

                        ?>
                        <li class="list-group-item"><i class="fa fa-user"></i> {{ $info['student']['stud_name']  }} </li>
                        <?php
                    }
                ?>
                  <?php
                    if(!empty(($info['student']['stud_name']))){

                        ?>
                        <li class="list-group-item"><i class="fa fa-user"></i> {{ $info['student']['stud_name']  }} </li>
                        <?php
                    }
                ?>
                  <?php
                    if(!empty(($info['student']['stud_name']))){

                        ?>
                        <li class="list-group-item"><i class="fa fa-user"></i> {{ $info['student']['stud_name']  }} </li>
                        <?php
                    }
                ?>
                  <?php
                    if(!empty(($info['student']['stud_name']))){

                        ?>
                        <li class="list-group-item"><i class="fa fa-user"></i> {{ $info['student']['stud_name']  }} </li>
                        <?php
                    }
                ?>
            
            
            
            
            
            <li class="list-group-item"><i class="fab fa-uniregistry"></i> {{ $info['student']['stud_number']  }}</li>
            <li class="list-group-item"><i class="fas fa-birthday-cake"></i> {{ $info['profile']['stud_brith_day']  }}</li>
            <li class="list-group-item"><i class="fas fa-genderless"></i> {{ $info['student']['stud_gender']  }}</li>
            <li class="list-group-item"><i class="fas fa-mobile-alt"></i> {{ $info['student']['stud_phone']  }}</li>
            
            <li class="list-group-item"><i class="fas fa-glass-martini"></i> {{ \App\Helper::getSocialStatus($info['profile']['stud_social_status']) }}</li>
            <li class="list-group-item"><i class="fas fa-info-circle"></i> {{ $info['profile']['stud_about']  }}</li>
            <li class="list-group-item"><i class="fas fa-calendar-alt"></i> {{ $info['student']['created_at']  }}</li>   
            </ul>                                          



<div>
                                        @if(count($info['images'])>=1)
                                            <div class="post-images">
                                                @foreach($info['images'] as $img)
                                                        
                                                    <img src="{{ url('/usersdata/posts/'.$img->post_id.'/'.$img->img_path) }}" class="post-img"  style="width: 154px;
    height: 154px;"/>

                                                @endforeach
                                                        </div>
                                            @endif
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