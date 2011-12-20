$(function() {

    var $readings = $('.ui-checkbox');
    
    $readings.click(function() {
        var $reading = $(this),
            $parent = $reading.parents('.ui-collapsible'),
            $siblings = $reading.siblings(),
            ref = $reading.find('.ui-btn-text').text();
        

        // open reading
        
        // mark set as read if all siblings are checked
        
        // this input isn't checked yet, it gets checked
        // as a result of this click, so we count it as checked
        var checked = !$reading.find('input').is(':checked');
        
        if (checked & $parent.find(':checked').length === 2) {
          $parent.find('.ui-btn').attr('data-theme', 'b');
        } else {
          $parent.find('.ui-btn').attr('data-theme', 'c');
        }
        
        // save state
    });
});

// $('div[data-role="content"]').live('pageinit', function(event) {
//     var $reading = $(this);
//     
//     alert( 'This page was just enhanced by jQuery Mobile!' );
// });