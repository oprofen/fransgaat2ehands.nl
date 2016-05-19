jQuery(function () {
    function disappear() {
        setTimeout(function () {
            jQuery('#system-message-container').children().remove();
            jQuery('#system-message-container').siblings('form').each(function(){
                jQuery(this).css('margin-bottom', 0)
            });
        }, 5000);
    }

    jQuery.fn.extend({
        observe: function (fn, config) {
            return this.each(function () {
                try {
                    var observer = new MutationObserver(fn);
                    observer.observe(this, config);
                } catch (e) {
                    console.log(e)
                }

            });

        },
    });

    jQuery('#system-message-container').observe(function () {
            disappear();
        },
        {childList: true}
    );
    if (jQuery('#system-message-container').children().length) {

        disappear();
    }
    ;
});
