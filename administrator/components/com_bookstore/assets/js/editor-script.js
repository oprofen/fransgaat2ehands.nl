/**
 * Created by Alexander on 26.04.2016.
 */

jQuery(function () {
    
        jQuery("body").append('<div id="iframeModal" class="modal hide fade"><div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">×</button>' +
        '<h3>Editor</h3>' +
        '</div><iframe src="" style="width:100%; height: 600px;"></iframe></div>');
        jQuery('[data-id="foo"]').on('click', function () {
            var href = jQuery(this).data('href');
            var value =jQuery('#' + jQuery(this).data('value')).serialize();
            href += '&' + value;
            var iframe = jQuery('#iframeModal > iframe').attr('src', href);
 
            jQuery('#iframeModal').modal('show');
            jQuery('#iframeModal').on('hide', function () {
                iframe.contents().find('#myForm').submit();
                iframe.attr('src', '');
            });
        });

});

