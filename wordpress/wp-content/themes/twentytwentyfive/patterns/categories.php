<?php
/**
 * Title: Categories
 * Slug: twentytwentyfive/categories
 * Categories: text, sidebar
 * Description: Custom Categories list card with striped divider and yellow bullet dots (Module #9).
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

if (function_exists('tdc_categories_render_html')) {
    echo tdc_categories_render_html();
} else {
    $categories = get_categories(array(
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => false,
        'exclude'    => array(1),
    ));

    if (empty($categories)) {
        $categories = get_categories(array(
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => false,
        ));
    }
    ?>
    <div class="tdc-categories-card">
        <h3 class="tdc-categories-title"><?php echo esc_html__('Categories', 'twentytwentyfive'); ?></h3>
        <div class="tdc-stripe-divider"></div>
        <ul class="tdc-categories-list">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <li>
                        <span class="tdc-bullet"></span>
                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" title="<?php echo esc_attr($cat->name); ?>">
                            <?php echo esc_html($cat->name); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>
                    <span class="tdc-bullet"></span>
                    <span><?php echo esc_html__('Chưa có chuyên mục', 'twentytwentyfive'); ?></span>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
}
