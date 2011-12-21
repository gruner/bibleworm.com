var BW = window.BW || {};
BW.READ = (function($, window, document, undefined) {

    // Expose contents of APP.
    return {
        go: function() {
            console.log('go');
            for (var i in BW.READ.init) {
                BW.READ.init[i]();
            }
        },
        init: {
            initView: function() {
                
                $('.ui-checkbox').live('click', function(e) {
                    
                    var $reading = $(e.target),
                        $parent = $reading.parents('.ui-collapsible'),
                        $siblings = $reading.siblings(),
                        ref = $reading.find('.ui-btn-text').text();


                    // open reading

                    // mark set as read if all siblings are checked

                    // this input isn't checked yet, it gets checked
                    // as a result of this click, so we count it as checked
                    var checked = !$reading.find('input').is(':checked');

                    if (checked && $parent.find(':checked').length === 3) {
                        $parent.find('.ui-btn').attr('data-theme', 'b');
                        console.log('3');
                    } else {
                        $parent.find('.ui-btn').attr('data-theme', 'c');
                        console.log('!3');
                    }

                    // save state
                });
            }
        }
        

    };

// Alias jQuery, window, document.
})(this.jQuery, this, this.document);

// Automatically calls all functions in BW.GREEK.init
this.jQuery(document).ready(function() {
    BW.READ.go();
});