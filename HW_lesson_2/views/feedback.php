<h2>Отзывы</h2>
<hr>

<?php foreach ($feedback as $item):?>
    <p><?=$item['userName']?></p>
    <p><?=$item['text']?></p>

<?php endforeach;?>