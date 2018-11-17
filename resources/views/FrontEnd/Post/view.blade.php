@extends("FrontEnd.Layout.master")



@section("styles")
@endsection






@section("content")
<?php
$stud_id = $post->stud_id;
$student = \App\Student::getActiveStudent($stud_id);

$post_images = \App\Image::where("post_id",'=',$post->id)->get();

    $profile = \App\Profile::where('stud_id',"=",$stud_id )->first();

    $views  = $post->post_views + 1;
    \App\Post::where("id","=",$post->id)->update(["post_views" => $views]);
?>  
<div class="card" style="text-align:right">
<div class="container">
  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
  <div class="card-body">
  <div class="row">
        <div class="col-sm-1">
                <img src="{{    url('usersdata/profile_images/'.$post->stud_id.'/'.$profile->stud_profile_img) }}" class="img-thumbnail img-responsive img-circle" width="100px"/>
        </div>
        <div class="col-sm-11">
        {{ $student->stud_name }}
        </div>
    </div>
    <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-11">
    <h5 class="card-title" style="text-align:right">{{ $post->content }}</h5>
    <p class="card-text">{{ $post->created_at }}</p>
    <a href="#" id="addCommentButton" class="btn btn-primary">كتابة تعليق</a>

    <form  id="addcommentForm" method="post" action="{{ url('post/'.$post->id.'/addcomment') }}" >

    @csrf
        <div class="form-group">
            <input type="text" name="content" class="form-control input-lg" placeholder=" ضع تعليقك هنا .."/>
        </div>
        <div class="form-group">
            <button type="submit"  class="btn btn-primary btn-block"> <i class="fa fa-pen"></i> كتابة</a>
        </div>
    </form>

    </div>
    </div>
  </div>












<div class="">
    <div class="row">
        <div class="comments col-md-12" id="comments">
            <h3 class="mb-2">التعليقات <i class="fa fa-comments"></i></h3>

            @if($comments_count >= 1)

            @foreach($comments as $comment)
<?php
            $stud_id = $comment->stud_id;
$student = \App\Student::getActiveStudent($stud_id);

$post_images = \App\Image::where("post_id",'=',$post->id)->get();

    $profile = \App\Profile::where('stud_id',"=",$stud_id )->first();

?>  

            <!-- comment -->
            <div class="comment mb-2 row">

                <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                    <a href=""><img class="mx-auto rounded img-fluid" src="{{    url('usersdata/profile_images/'.$post->stud_id.'/'.$profile->stud_profile_img) }}" alt="avatar"></a>
                </div>
                
                
                <div class="comment-content col-md-11 col-sm-10">
                    <h6 class="small comment-meta"><a href="{{ url('profile/'.$comment->stud_id ) }}">{{ $student->stud_name }}</a> {{ $comment->created_at }}</h6>
                    <div class="comment-body">
                        <p>
                        {{ $comment->content     }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

            @else
            <div class="alert alert-danger tetx-center">لا توجد تعليقات</div>

        @endif

        </div>
    
</div>






  </div>

</div>
  












</div>





@endsection

@section("scripts")
@endsection