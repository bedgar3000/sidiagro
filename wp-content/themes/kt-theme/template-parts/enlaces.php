<?php
$categorias = get_terms( array(
    'taxonomy' => 'categoria-url',
    'hide_empty' => false,
) );

$enlaces = [];
$query_enlaces = new WP_Query([
    'post_status'    => 'publish',
    'post_type'      => 'url',
    'order'          => 'DESC',
    'posts_per_page' => -1,
]);
if ( $query_enlaces->have_posts() ) :
    while ( $query_enlaces->have_posts() ) : $query_enlaces->the_post();
        $title  = get_the_title();
        $url  = get_field('url');

        $terms = get_the_terms(get_the_ID(), 'categoria-url');

        $enlaces[(!empty($terms[0]->slug) ? $terms[0]->slug : '')][] = [
            'title' => $title,
            'url'   => $url,
        ];
    endwhile;
endif; wp_reset_postdata();
?>

<section class="section-urls">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="enlace-escudo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/escudo-gray-line.png" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-lg-4 col-md-5 col-sm-6">
                <div class="item-enlace text-center">
                    <span><?php echo __('Presidencia de la República Dominicana', 'ktech'); ?></span>
                    <a target="_blank" href="https://www.presidencia.gob.do/"><?php echo __('www.presidencia.gob.do', 'ktech'); ?></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6">
                <div class="item-enlace text-center">
                    <span><?php echo __('Vicepresidencia de la República ', 'ktech'); ?></span>
                    <a target="_blank" href="https://vicepresidencia.gob.do/"><?php echo __('www.vicepresidencia.gob.do', 'ktech'); ?></a>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
                <div class="form-categorias-url">
                    <select class="form-select" id="urls-categoria" aria-label="Categorias">
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria->slug; ?>"><?php echo $categoria->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row mt-5" id="urls-items">
            <?php foreach ($enlaces[$categorias[0]->slug] as $key => $enlace): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="item-enlace">
                        <span><?php echo $enlace['title']; ?></span>
                        <a target="_blank" href="<?php echo $enlace['url']; ?>"><?php echo $enlace['url']; ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    var urls_items = <?php echo json_encode($enlaces); ?>;
</script>
