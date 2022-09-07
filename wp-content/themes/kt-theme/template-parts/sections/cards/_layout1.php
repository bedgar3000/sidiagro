<?php
$class = (!empty($args['class']) ? $args['class'] : 'section-cards layout-1');
$content = $args['content'];
?>

<?php if (!empty($content)): ?>
    <section class="<?php echo $class; ?>">
        <div class="container">
            <div class="row row-content">
                <?php foreach ($content as $key => $item): ?>
                    <div class="col-lg-4 col-card">
                        <div class="card layout-1">
                            <a href="<?php echo $item['url']; ?>" class="card-figure">
                                <img src="<?php echo path_upload($item['image']) ?>" class="card-img-top" alt="">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item['title']; ?></h5>
                                <p class="card-text"><?php echo $item['excerpt']; ?></p>
                                <a href="<?php echo $item['url']; ?>" class="underline"><?php echo __('Learn more','ktech'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
