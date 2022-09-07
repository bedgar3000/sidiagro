<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

if (get_query_var( 'post_type' ) == 'post' || is_home() ) {
    get_template_part('template-parts/archives/post');
}
// elseif (get_query_var( 'post_type' ) == 'proyecto') {
//     get_template_part('template-parts/archives/proyecto');
// }
else {
    get_header();
    ?>  
        <main class="main-general">
            <section class="section-content">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="info">
                                <h1 class="section-title"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="info">
                                <?php
                                // Load posts loop.
                                while ( have_posts() ) {
                                    the_post();
                                    the_content();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    <?php
    get_footer();
}
?>