(function ($) {
    $.fn.bekeyProgressbar = function (options) {
        options = $.extend(
            {
                animate: true,
                animateText: true,
            },
            options
        );

        var $this = $(this);

        var $progressBar = $this;
        var $progressCount = $progressBar.find(
            ".ProgressBar-percentage--count"
        );
        var $circle = $progressBar.find(".ProgressBar-circle");
        var percentageProgress = $progressBar.attr("data-progress");
        var percentageRemaining = 100 - percentageProgress;
        var percentageText = $progressCount.parent().attr("data-progress");

        //Calcule la circonférence du cercle
        var radius = $circle.attr("r");
        var diameter = radius * 2;
        var circumference = Math.round(Math.PI * diameter);

        //Calcule le pourcentage d'avancement
        var percentage = (circumference * percentageRemaining) / 100;

        $circle.css({
            "stroke-dasharray": circumference,
            "stroke-dashoffset": percentage,
        });

        //Animation de la barre de progression
        if (options.animate === true) {
            $circle
                .css({
                    "stroke-dashoffset": circumference,
                })
                .animate(
                    {
                        "stroke-dashoffset": percentage,
                    },
                    3000
                );
        }

        //Animation du texte (pourcentage)
        if (options.animateText == true) {
            $({ Counter: 0 }).animate(
                { Counter: percentageText },
                {$(".progress").each(function(){
  
                  var $bar = $(this).find(".bar");
                  var $val = $(this).find("span");
                  var perc = parseInt( $val.text(), 10);
                
                  $({p:0}).animate({p:perc}, {
                    duration: 3000,
                    easing: "swing",
                    step: function(p) {
                      $bar.css({
                        transform: "rotate("+ (45+(p*1.8)) +"deg)", // 100%=180° so: ° = % * 1.8
                        // 45 is to add the needed rotation to have the green borders at the bottom
                      });
                      $val.text(p|0);
                    }
                  });
                }),
                    duration: 3000,
                    step: function () {
                        $progressCount.text(Math.ceil(this.Counter) + "%");
                    },
                }
            );
        } else {
            $progressCount.text(percentageText + "%");
        }
    };
})(jQuery);

$(document).ready(function () {
    $(".ProgressBar--animateNone").bekeyProgressbar({
        animate: false,
        animateText: false,
    });

    $(".ProgressBar--animateCircle").bekeyProgressbar({
        animate: true,
        animateText: false,
    });

    $(".ProgressBar--animateText").bekeyProgressbar({
        animate: false,
        animateText: true,
    });

    $(".ProgressBar--animateAll").bekeyProgressbar();
});
