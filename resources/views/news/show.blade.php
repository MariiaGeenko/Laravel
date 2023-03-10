@extends('layouts.main')
 @section('content')
    <div class="row">
     <div class="col-md-8 blog-main">
         <h3 class="pb-3 mb-4 font-italic border-bottom change">
             From the Firehose
         </h3>

         <div class="blog-post">
             <h2 class="blog-post-title">{{ $news['title'] }}</h2>
             <p class="blog-post-meta">{{ $news['created_at'] }} by <a href="#">{{ $news['author'] }}</a></p>

             {!! $news['description'] !!}
         </div><!-- /.blog-post -->


     </div><!-- /.blog-main -->

     <aside class="col-md-4 blog-sidebar">
         <div class="p-3 mb-3 bg-light rounded">
             <h4 class="font-italic">About</h4>
             <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
         </div>

     </aside><!-- /.blog-sidebar -->

     <aside class="col-md-4 blog-sidebar">
        <div class="p-3 mb-3 bg-light rounded">
          <h4 class="font-italic">About</h4>
          <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>

        <div class="p-3">
          <h4 class="font-italic">Archives</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">March 2014</a></li>
            <li><a href="#">February 2014</a></li>
            <li><a href="#">January 2014</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
          </ol>
        </div>

        <div class="p-3">
          <h4 class="font-italic">Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ol>
        </div>
      </aside>

 </div><!-- /.row -->
 @endsection
 @push('js')
     <script>
         $(".change").text("Changed text");
     </script>
 @endpush