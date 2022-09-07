<?php
$data = [
    'title' => get_the_title(),
    'link'  => get_the_permalink(),
    'image' => path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full')),
    'date'  => get_the_date('j') . ' de ' . ucfirst(get_the_date('F Y')),
];
?>

<div class="card layout-3">
    <a href="<?php echo $data['link']; ?>" class="card-figure">
        <img src="<?php echo $data['image']; ?>" class="card-img-top" alt="">
    </a>
    <div class="card-body">
        <p class="card-text"><?php echo $data['date']; ?></p>
        <a href="<?php echo $data['link']; ?>" class="card-title"><?php echo $data['title']; ?></a>
        <div class="card-action">
            <a href="<?php echo $data['link']; ?>">
                <span><?php echo __('Leer más','ktech'); ?></span>
                <i class="icon icon-btn-go-alt-primary"></i>
            </a>
        </div>
    </div>
</div>