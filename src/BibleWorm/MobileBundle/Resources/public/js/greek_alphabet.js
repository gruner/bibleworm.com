var BW = window.BW || {};
BW.GREEK = (function($, window, document, undefined) {
    
    var $nameField,
        $entityField,
        $answerBtn
        ;
    
    var greekAlphabet = [
        {name:'Alpha', upper:'&Alpha;', lower:'&alpha;'},
        {name:'Beta', upper:'&Beta;', lower:'&beta;'},
        {name:'Gamma', upper:'&Gamma;', lower:'&gamma;'},
        {name:'Delta', upper:'&Delta;', lower:'&delta;'},
        {name:'Epsilon', upper:'&Epsilon;', lower:'&epsilon;'},
        {name:'Zeta', upper:'&Zeta;', lower:'&zeta;'},
        {name:'Eta', upper:'&Eta;', lower:'&eta;'},
        {name:'Theta', upper:'&Theta;', lower:'&theta;'},
        {name:'Iota', upper:'&Iota;', lower:'&iota;'},
        {name:'Kappa', upper:'&Kappa;', lower:'&kappa;'},
        {name:'Lambda', upper:'&Lambda;', lower:'&lambda;'},
        {name:'Mu', upper:'&Mu;', lower:'&mu;'},
        {name:'Nu', upper:'&Nu;', lower:'&nu;'},
        {name:'Xi', upper:'&Xi;', lower:'&xi;'},
        {name:'Omicron', upper:'&Omicron;', lower:'&omicron;'},
        {name:'Pi', upper:'&Pi;', lower:'&pi;'},
        {name:'Rho', upper:'&Rho;', lower:'&rho;'},
        {name:'Sigma', upper:'&Sigma;', lower:'&sigma;&sigmaf;'},
        {name:'Tau', upper:'&Tau;', lower:'&tau;'},
        {name:'Upsilon', upper:'&Upsilon;', lower:'&upsilon;'},
        {name:'Phi', upper:'&Phi;', lower:'&phi;'},
        {name:'Chi', upper:'&Chi;', lower:'&chi;'},
        {name:'Psi', upper:'&Psi;', lower:'&psi;'},
        {name:'Omega', upper:'&Omega;', lower:'&omega;'}
    ];

    // Expose contents of APP.
    return {
        go: function() {
            for (var i in BW.GREEK.init) {
                BW.GREEK.init[i]();
            }
        },
        init: {
            
            randomSortUpperAndLower: function() {
                var randOrd = function() {
                    return (Math.round(Math.random())-0.5);
                };

                var randomSortedArr = Array();

                // expand the original array so that upper and lowercase letters
                // are separate objects
                for (var j = greekAlphabet.length - 1; j >= 0; j--) {
                    var letter = greekAlphabet[j],
                        upper = {name:letter['name'], entity:letter['upper']},
                        lower = {name:letter['name'], entity:letter['lower']}
                        ;

                    randomSortedArr.push(upper, lower);
                }

                greekAlphabet = randomSortedArr.sort(randOrd);
            },
            
            initView: function() {
                $nameField = $('#flash_card_answer');
                $entityField = $('#flash_card_question');
                $answerBtn = $('#flash_card_answer_btn');
                
                BW.GREEK.showLetter(greekAlphabet[0]);
            },
            
            initClickEvents: function() {
                
                $('#flash_card_prev').click(function() {
                    $nameField.html('&nbsp;');
                    $answerBtn.show();
                    BW.GREEK.showPrevLetter();
                    $(this).removeClass('ui-btn-active');
                });
                
                $('#flash_card_next').click(function() {
                    $nameField.html('&nbsp;');
                    $answerBtn.show();
                    BW.GREEK.showNextLetter();
                    $(this).removeClass('ui-btn-active');
                });
                
                $answerBtn.click(function() {
                    $nameField.html(greekAlphabet[0].name);
                });
            }
        },
        
        showLetter: function(letter) {
            $entityField.html(letter['entity']);
        },
        
        showNextLetter: function() {
            greekAlphabet.push(greekAlphabet.shift());
            BW.GREEK.showLetter(greekAlphabet[0]);
        },
        
        showPrevLetter: function() {
            greekAlphabet.unshift(greekAlphabet.pop());
            BW.GREEK.showLetter(greekAlphabet[0]);
        }
    };

// Alias jQuery, window, document.
})(this.jQuery, this, this.document);

// Automatically calls all functions in BW.GREEK.init
this.jQuery(document).ready(function() {
    BW.GREEK.go();
});