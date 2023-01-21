<?php foreach($catigory as $a): ?>
    <div style="border: 1px solid green">
        <h2><?=$a['title']?></h2>
        <p><?=$a['description']?></p>
        <div><strong><?=$a['author']?>(<?=$a['created_at']?>)</strong>
            <a href="<?=route('news.show', ['id' => $a['id']])?>">More</a>
        </div>
    </div>
<?php endforeach; ?>