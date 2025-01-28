<?php
get_leadbook_header($title);
list_header('Dashboard', 'dashboard');
$income = get_total_credit_amount();
$expense = get_total_debit_amount();
$balance = $income - $expense;
?>
<div class="row text-center">
    <div class="col-4">
        <div class="bg bg-success text-light rounded py-3">
            <h6>Total Income</h6>
            <h1><?php echo $income ?? 0; ?></h1>
        </div>
    </div>
    <div class="col-4">
        <div class="bg bg-danger text-light rounded py-3">
            <h6>Total Expense</h6>
            <h1><?php echo $expense ?? 0; ?></h1>
        </div>
    </div>
    <div class="col-4">
        <div class="bg bg-warning text-dark rounded py-3">
            <h6>Balance Amount</h6>
            <h1><?php echo $balance; ?></h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php card_ui(function () {
            return '
                Latest Leads | 
                <a href="' . leadbook_navigate('leads', ['action' => 'add']) . '">Add New</a>
            ';
        }, lead_list_for_dashboard()); ?>
    </div>
    <div class="col-md-6">
        <?php card_ui(function () {
            return '
                Latest Deals | 
                <a href="' . leadbook_navigate('deals', ['action' => 'add']) . '">Add New</a>
            ';
        }, deal_list_for_dashboard()); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <?php card_ui(function () {
            return '
                Latest Followups | 
                <a href="' . leadbook_navigate('followups', ['action' => 'add']) . '">Add New</a>
            ';
        }, followup_list_for_dashboard()); ?>
    </div>
    <div class="col-md-4">
        <?php card_ui(function () {
            return '
                Latest Transections | 
                <a href="' . leadbook_navigate('transections', ['action' => 'add']) . '">Add New</a>
            ';
        }, transection_list_for_dashboard()); ?>
    </div>
    <div class="col-md-3">
        <?php card_ui(function () {
            return '
                All Business | 
                <a href="' . leadbook_navigate('businesses', ['action' => 'add']) . '">Add New</a>
            ';
        }, business_list_for_dashboard()); ?>
    </div>
</div>