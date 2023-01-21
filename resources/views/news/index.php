<?php foreach($news as $n): ?>
    <div style="border: 1px solid green">
        <h2><?=$n['title']?></h2>
        <p><?=$n['description']?></p>
        <div><strong><?=$n['author']?>(<?=$n['created_at']?>)</strong>
            <a href="<?=route('news.show', ['id' => $n['id']])?>">More</a>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach($catigory as $a): ?>
    <div style="border: 1px solid green">
        <h2><?=$a['title']?></h2>
        <p><?=$a['description']?></p>
        <div><strong><?=$a['author']?>(<?=$a['created_at']?>)</strong>
            <a href="<?=route('news.show', ['id' => $a['id']])?>">More</a>
        </div>
    </div>
<?php endforeach; ?>