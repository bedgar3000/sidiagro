<?php
$class = (!empty($args['class']) ? $args['class'] : 'section-contacts layout-1');
$intro = (!empty($args['intro']) ? $args['intro'] : null);
?>

<section class="<?php echo $class; ?>" id="contacto" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-6" data-aos="flip-left">
                <div class="wrapper">
                    <?php get_template_part('template-parts/widgets/_google_maps', null, []); ?>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="wrapper" data-aos="zoom-in">
                    <?php if (!empty($intro)): ?>
                        <div class="intro"><?php echo $intro; ?></div>
                    <?php endif; ?>

                    <?php get_template_part('template-parts/forms/_form1', null, [
                        'class' => 'contact-form form-2',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>