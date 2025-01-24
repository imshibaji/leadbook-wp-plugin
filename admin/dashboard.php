<?php 
get_leadbook_header($title);
list_header();
?>

<div class="row">
    <div class="col-md">
        <?php card_ui('All Leads', lead_list_for_dashboard(get_all_leads())); ?>
    </div>
    <div class="col-md">
        <?php card_ui('All Followups', followup_list_for_dashboard(get_all_followups())); ?>
    </div>
    <div class="col-md">
        <?php card_ui('All Deals', business_list_for_dashboard(get_all_businesses())); ?>
    </div>
    <div class="col-md">
        <?php card_ui('All Business', business_list_for_dashboard(get_all_businesses())); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <?php card_ui('All Transections', lead_list_for_dashboard(get_all_leads())); ?>
    </div>
    <div class="col-md-4">
        <?php card_ui('All Business', business_list_for_dashboard(get_all_businesses())); ?>
    </div>
</div>