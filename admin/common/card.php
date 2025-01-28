<?php
function card_ui($title, $content, $footer = '') {

    if(gettype($content) == 'array'){
        $contentData = '<ul class="list-group list-group-flush">'. implode(array_map(function($data){
                return '<li class="list-group-item">'.$data.'</li>';
            },(array) $content)). '</ul>';
    }
    if(gettype($content) == 'object'){
        $contentData = $content();
    }

    // Generate the card HTML
    echo "
        <div class='card' style='padding:0; max-width:none;'>
            <div class='card-header'>" . (gettype($title) == 'object'? $title() : $title) . "</div>
            <div class='card-body' style='height:320px; overflow-y:scroll; margin:8px 0; padding:0px'>" . ($contentData ?? $content) . "</div>
            " . ($footer ? "<div class='card-footer'>" . (gettype($footer) == 'object'? $footer() : $footer) . "</div>" : "") . "
        </div>
    ";
}
