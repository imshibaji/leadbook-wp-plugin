<div class="mt-3">
    <div class="row">
        <div class="col-6">
            <h4 class="mb-0"><?php echo esc_html(apply_filters('leadbook_page_title', $title ?? 'Leadbook Dashboard')); ?></h4>
            <small class="mt-0">App name: Leadbook, Version: <?php echo esc_html(LEADBOOK_VERSION); ?></small>
        </div>
        <div class="col-6">
            <div class="text-end pt-2 pe-3">
                <?php 
                $actionsData = apply_filters('leadbook_dashboard_actions', $actions ?? []);
                if(isset($actionsData) && is_array($actionsData)): 
                    foreach ($actionsData as $action): ?>
                        <a href="<?php echo esc_html($action['link']); ?>" class="button-primary"><?php echo esc_html($action['title']); ?></a>
                    <?php endforeach; ?>
                <?php else: echo esc_html($actionsData); endif; ?>
            </div>
        </div>
    </div>
</div>
<hr>
<?php leadbook_display_message(); ?>