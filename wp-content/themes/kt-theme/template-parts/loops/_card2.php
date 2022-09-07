<?php
$data = [
    'title' => get_the_title(),
    'link'  => get_the_permalink(),
    'image' => path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full')),
];
?>

<div class="card layout-2">
    <div class="card-figure">
        <img src="<?php echo $data['image']; ?>" class="card-img-top" alt="">
    </div>
    <div class="card-body">
        <div class="card-text"><?php echo $data['title']; ?></div>
    </div>
</div>