<?php
$data = [
    'title' => get_the_title(),
    'image' => path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full')),
    'url'   => get_field('url'),
];
?>

<a class="card layout-2" data-fancybox="video-gallery" href="https://www.youtube.com/watch?v=z2X2HaTvkl8">
    <div class="card-figure">
        <img src="<?php echo $data['image']; ?>" class="card-img-top" alt="">
        <i class="icon icon-play-solid-primary"></i>
    </div>
    <div class="card-body">
        <div class="card-text"><?php echo $data['title']; ?></div>
    </div>
</a>