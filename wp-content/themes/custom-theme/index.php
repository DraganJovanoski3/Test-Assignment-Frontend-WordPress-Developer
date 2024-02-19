<?php get_header(); ?>

<div id="content">
    <div id="primary">
        <main id="main" class="site-main" role="main">
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_format() );
            endwhile;
            ?>
        </main>
    </div>
</div>

<?php get_footer(); ?>