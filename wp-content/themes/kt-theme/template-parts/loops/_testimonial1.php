<?php
$detail = (!empty($args['detail']) ? $args['detail'] : false);
?>
<div class="card testimonial-1">
    <div class="card-header">
        <div class="card-image">
            <img src="<?php echo path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title(); ?>" class="img-fluid">
        </div>
        <div class="card-title">
            <div class="name"><?php the_title(); ?></div>
            <div class="job">
                <?php the_field('job'); ?> <br>
                <?php the_field('company'); ?>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <?php the_content(); ?>
        </div>
        <?php if (!$detail): ?>
            <div class="card-action">
                <a class="d-inline-flex align-items-center gap-1" href="<?php echo get_option('home') ?>/testimonios">
                    <?php echo __('Leer mas', 'ktech'); ?>
                    <i class="icon icon-btn-go-primary"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>