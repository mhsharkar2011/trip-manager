<script>
    if(AuthUser){
        var img_arr =  jQuery('img').not('img[img-type="dynamic"]');
        jQuery.map(img_arr,function(val,i){
            jQuery(val).parent().prepend('<button class="edit_form" ><i class="fa fa-edit"></i></button>');
        });
    }

    jQuery(document).on("click", "button.edit_form" , function(event) {
        event.preventDefault();
        var element = jQuery(this).parent().find('img');

        if(element.attr('srcset') != undefined){

        var img_src = element.attr('srcset');
        var img_arr = img_src.split(',');
        }else{
            var img_src = element.attr('src');
        }

        var input_field = '<input type="hidden" name="file_name"  value="'+img_src+'"/>';

        jQuery('#img-iframe-container').css('display','block');
        var iframe_doc = jQuery("#img-iframe")[0].contentWindow.document;
        var $body = jQuery('body',iframe_doc);
        var form_elem = $body.find('form');

        if(element.attr('srcset') != undefined){
            $body.find('img#orig_img')[0].srcset = img_src;
            $body.find('img#orig_img').removeAttr('src');
        }else{
            $body.find('img#orig_img')[0].src = img_src;
            $body.find('img#orig_img').removeAttr('srcset');
        }

        if($body.find('input[name="file_name"]').length === 0){
            form_elem.append(input_field);
        }else{
            $body.find('input[name="file_name"]')[0].value = img_src;
       }
       $body.find('#image_info').text('Width: '+element.width()+', Height: '+element.height());       
    });

    jQuery(document).on("click", "button#cancel_btn" , function() {
        jQuery('#img-iframe-container').css('display','none');
        location.reload(true);
    });    
</script>