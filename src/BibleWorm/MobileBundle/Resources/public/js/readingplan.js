var BW = window.BW || {};
BW.READ = (function($, window, document, undefined) {
    
    var completedReadings,
        selectedTheme = 'b',
        unselectedTheme = 'c';
    
    function supportsLocalStorage() {
        try {
            return 'localStorage' in window && window['localStorage'] !== null;
        } catch (e) {
            return false;
        }
    }

    // Expose contents of APP.
    return {
        go: function() {
            console.log('go');
            for (var i in BW.READ.init) {
                BW.READ.init[i]();
            }
        },
        init: {
            
            resume: function() {
                if (!supportsLocalStorage()) { return false; }
                
                if (localStorage["bw.read.progress"]) {
                    completedReadings = localStorage["bw.read.progress"].split(',');

                    // Set the completed state on completed readings
                    for (var i = completedReadings.length - 1; i >= 0; i--) {
                        $('#' + completedReadings[i]).attr('data-theme', selectedTheme);

                        // TODO: need to mark entire group as completed
                    };
                } else {
                    completedReadings = Array();
                }
                
                return true;
            },
            
            initView: function() {
                
                $('.reference').live('click', function(e) {
                    
                    var $reading = $(e.target).parents('.reading_link'),
                        $container = $reading.parents('.readings_container'),
                        $readings = $container.find('.reading_link'),
                        ref = $reading.find('.reference').text();
                    
                    // has selected state
                    if ($reading.attr('data-theme') == selectedTheme) {
                        // show unselected state
                        $reading.attr('data-theme', unselectedTheme);
                        
                        // track progress
                        BW.READ.removeProgress($reading.attr('id'));
                    } else {
                        // show selected state
                        $reading.attr('data-theme', selectedTheme);
                        
                        // track progress
                        BW.READ.addProgress($reading.attr('id'));
                    }
                    
                    // mark as read if all siblings are checked
                    
                    var $checkedReadings = $container.find('li[data-theme="' + selectedTheme + '"]');

                    if ($checkedReadings.length === $readings.length) {
                        $container.attr('data-theme', selectedTheme);
                    } else {
                        $container.attr('data-theme', unselectedTheme);
                    }
                    
                    // refresh the appearance
                    $container.find('ul').listview('refresh');
                    
                    // save progress to local storage
                    BW.READ.save();
                });
            }
        },
        
        addProgress: function(id) {
            completedReadings.push(id);
            completedReadings.sort();
            completedReadings = _.uniq(completedReadings, true);
        },
        
        removeProgress: function(id) {
            completedReadings = _.without(completedReadings, id);
        },
        
        save: function() {
            if (!supportsLocalStorage()) { return false; }
            
            localStorage["bw.read.progress"] = completedReadings.join(',');
            
            return true;
        }
    };

// Alias jQuery, window, document.
})(this.jQuery, this, this.document);

// Automatically calls all functions in BW.GREEK.init
this.jQuery(document).ready(function() {
    BW.READ.go();
});