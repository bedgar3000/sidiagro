<?php
$title  = (!empty($args['title']) ? $args['title'] : null);

if (empty($title)) {
    if ( is_home() ) {
        $title = __('Noticias', 'ktech');
    } else {
        $title = get_the_title();
    }
}
?>

<?php if (!empty($title)): ?>
    <section class="section-banner banner-1">
        <?php if (!empty($title)): ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="info">
                            <h1><?php echo $title; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>