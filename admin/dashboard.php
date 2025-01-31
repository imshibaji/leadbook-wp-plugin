<?php
get_leadbook_header($title, $actions);
list_header('Dashboard', 'dashboard');
$income = get_total_credit_amount();
$expense = get_total_debit_amount();
$balance = $income - $expense;
?>
<div class="row text-center">
    <div class="col-4">
        <div class="bg bg-success text-light rounded py-3">
            <h6>Total Income</h6>
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
                    <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a2 2 0 0 1-1-.268M1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1" />
                </svg>
                <?php echo leadbook_convert_amount($income ?? 0); ?>
            </h1>
        </div>
    </div>
    <div class="col-4">
        <div class="bg bg-danger text-light rounded py-3">
            <h6>Total Expense</h6>
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                </svg>
                <?php echo leadbook_convert_amount($expense ?? 0); ?>
            </h1>
        </div>
    </div>
    <div class="col-4">
        <div class="bg bg-warning text-dark rounded py-3">
            <h6>Balance Amount</h6>
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 16 16">
                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542s.987-.254 1.194-.542C9.42 6.644 9.5 6.253 9.5 6a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2z" />
                    <path d="M16 6.5h-5.551a2.7 2.7 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5s-1.613-.412-2.006-.958A2.7 2.7 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5z" />
                </svg>
                <?php echo leadbook_convert_amount($balance); ?>
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php card_ui(function () {
            return '
                Latest Leads / Customers | 
                <a href="' . leadbook_navigate('leads', ['action' => 'add']) . '">Add New</a>
            ';
        }, lead_list_for_dashboard()); ?>
    </div>
    <div class="col-md-6">
        <?php card_ui(function () {
            return '
                Latest Invoices / Quatations | 
                <a href="' . leadbook_navigate('deals', ['action' => 'add']) . '">Add New</a>
            ';
        }, deal_list_for_dashboard()); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <?php card_ui(function () {
            return '
                Latest Followups / Notifications | 
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