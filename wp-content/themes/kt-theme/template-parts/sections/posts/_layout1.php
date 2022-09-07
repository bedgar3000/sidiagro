<?php
$class = (!empty($args['class']) ? $args['class'] : 'section-posts layout-1');

$posts = [];
$query = new WP_Query([
    'post_status'    => 'publish',
    'post_type'      => 'post',
    'posts_per_page' => 4,
]);
if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
        $posts[] = [
            'title' => get_the_title(),
            'link'  => get_the_permalink(),
            'image' => path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full')),
            'date'  => get_the_date('j') . ' de ' . ucfirst(get_the_date('F Y')),
        ];
    endwhile;
endif; wp_reset_postdata();
?>

<?php if (!empty($posts[0])): ?>
    <section class="<?php echo $class; ?>">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="underline-title"><?php echo __('Ultimas Noticias','ktech'); ?></h1>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="custom-post-grid">
                        <div class="post-big">
                            <a href="<?php echo $posts[0]['link']; ?>" class="card card-custom-post">
                                <div class="card-figure">
                                    <img src="<?php echo $posts[0]['image']; ?>" class="card-img-top" alt="">
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $posts[0]['date']; ?></p>
                                    <h5 class="card-title"><?php echo $posts[0]['title']; ?></h5>
                                </div>
                            </a>
                        </div>

                        <?php if (!empty($posts[1])): ?>
                            <div class="post-small">
                                <?php foreach (array_slice($posts, 1) as $key => $post): ?>
                                    <a href="<?php echo $post['link']; ?>" class="card card-custom-post">
                                        <div class="card-figure">
                                            <img src="<?php echo $post['image']; ?>" class="card-img-top" alt="">
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $post['date']; ?></p>
                                            <h5 class="card-title"><?php echo $post['title']; ?></h5>
                                        </div>
                                    </a>

                                    <?php if (($key + 2) < count($posts)): ?>
                                        <div class="line"></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
