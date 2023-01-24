{{-- <?php foreach($category as $a): ?>
    <div style="border: 1px solid green">
        <h2><?=$a['title']?></h2>
        <p><?=$a['description']?></p>
        <div><strong><?=$a['author']?>(<?=$a['created_at']?>)</strong>
            <a href="<?=route('news.show', ['id' => $a['id']])?>">More</a>
        </div>
    </div>
<?php endforeach; ?> --}}

@extends('layouts.main')
 @section('content')
     <div class="row mb-2">
 @forelse($category as $a)
   <div class="col-md-6">
             <div class="card flex-md-row mb-4 box-shadow h-md-250">
                 <div class="card-body d-flex flex-column align-items-start">
                     <strong class="d-inline-block mb-2 text-primary">{{ $a['author'] }}</strong>
                     <h3 class="mb-0">
                         <a class="text-dark" href="{{ route('news.show', ['id' => $a['id']]) }}">{{ $a['title'] }}</a>
                     </h3>
                     <div class="mb-1 text-muted">{{ $a['created_at'] }}</div>
                     <p class="card-text mb-auto">{!! $a['description'] !!}</p>
                     <a href="{{ route('news.show', ['id' => $a['id']]) }}">More</a>
                 </div>
                 <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Card image cap">
             </div>
   </div>
 @empty
     <h2>Don't news</h2>
 @endforelse
     </div>
 @endsection