jQuery(function () {
    jQuery()
    jQuery.updateImages = function (id, images, baseurl) {
        jQuery(id + ' > ul').remove();
        var ul = jQuery('<ul class="thumbnails">');
        jQuery(id).append(ul);
        if (images) {
            for (var i = 0; i < images.length; i++) {
                var li = jQuery('<li class="span3">');
                var a = jQuery('<a tabindex="-1" class="thumbnail modal" href="' + baseurl + images[i] + '">');
                var img = jQuery('<img>');
                img.attr('src', baseurl + images[i]);
                a.append(img);
                li.append(a);
                ul.append(li);
            }
            /*SqueezeBox.initialize({});
            console.log(jQuery(id + ' a.modal'));*/
            SqueezeBox.assign(jQuery(id + ' a.modal').get(), {
                parse: 'rel'
            });

            /*function jModalClose() {
                SqueezeBox.close();
            }*/

        }

    };

});
