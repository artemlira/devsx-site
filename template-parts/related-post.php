<article class="related-post">
  <?php if (has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('large'); ?>
      </a>
    </div>
  <?php endif; ?>
  <div class="entry-content-wrapper">
    <div class="entry-meta">
      <span class="posted-on"><?php echo get_the_date(); ?></span>
    </div>

    <h2 class="entry-title">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>

    <div class="entry-content">
      <?php the_excerpt(); ?>
    </div>

    <div class="read-more">
      <a href="<?php the_permalink(); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M7 17L17 7M17 7H8M17 7V16" stroke="#F0F3FA" stroke-width="2" stroke-linecap="square"/>
        </svg>
      </a>
    </div>
  </div>
</article>