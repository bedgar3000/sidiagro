<section class="section-widgets layout-1">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="underline-title"><?php echo __('Redes Sociales','ktech'); ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="widgets-cards">
                    <?php get_template_part('template-parts/widgets/_instagram', null, []); ?>

                    <?php get_template_part('template-parts/widgets/_twitter', null, []); ?>
                </div>
            </div>
        </div>
    </div>
</section>