<?php 
$key = (!empty($args['key']) ? $args['key'] : 0); 
?>

<div class="card plan-1 <?php echo ($key % 2 == 0 ? 'active' : ''); ?>" data-aos="fade-up" data-aos-duration="<?php echo ($key * 1000); ?>">
    <div class="card-header">
        <h3 class="card-title"><?php the_title(); ?></h3>
    </div>
    <div class="card-body">
        <div class="card-price">
            <span class="amount"><?php echo the_field('currency'); ?><?php echo the_field('price'); ?></span><span class="time">/<?php echo the_field('time'); ?></span>
            <span class="note"><?php echo the_field('note'); ?></span>
        </div>
        <div class="card-action">
            <a href="<?php echo get_option('siteurl'); ?>/contacto" class="btn btn-outline-primary btn-lg btn-block w-icon">
                <span><?php echo __('Empezar','ktech'); ?></span>
                <icon class="icon icon-btn-go-primary"></icon>
            </a>
        </div>
        <div class="card-text">
            <?php the_content(); ?>
        </div>
    </div>
</div>