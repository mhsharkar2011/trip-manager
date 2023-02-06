<script>
    if(AuthUser){
        var editable_tags = jQuery("[data-editable-id]");
        jQuery.map(editable_tags,function(val,i){
            jQuery(val).prepend('<button class="tag_edit" ><i class="fa fa-edit"></i></button>');
        })
    }

    jQuery(document).on("click", "button#txt_cancel_btn" , function() {
        jQuery('#stat-text-iframe-container').css('display','none');
        location.reload(true);
    });

    jQuery(document).on("click", "button.tag_edit" , function(event) {
        event.preventDefault();
        jQuery(this).parent().attr('contentEditable','true');
        var old_id = jQuery(this).parent().data('editable-id');
        
        if(jQuery(this).parent().find('input[type="hidden"]').length === 0 ){
            var old_val = jQuery(this).parent()[0].childNodes[1].nodeValue;
            var hidden_input = '<input type="hidden" name="old_field" id="'+old_id+'" value="'+old_val+'" >';
            jQuery(this).parent().prepend(hidden_input);
        }else{
            var old_val = jQuery(this).parent()[0].childNodes[2].nodeValue;
            jQuery(this).parent().find('input[type="hidden"]')[0].value = old_val;
        }
    });
    
    jQuery(document).on("mouseleave", "[contenteditable=true]" , function(event) {
        var url = "{{ route('textUpdate') }}";
        var csrf_token = "{{ csrf_token() }}";
        var editable_id = jQuery(this).data('editable-id');
        var edited_data = jQuery(this)[0].childNodes[2].nodeValue;
        var original_data = jQuery(this).find('input[type="hidden"]')[0].value;
        var route_name = "<?php echo request()->route()->uri; ?>";
            if(route_name == '/'){
                route_name = 'welcome';
            }
        var pos = jQuery("[data-editable-id]").index(this);

        //related component name and edited text position
        var component_name = '';
        var position_in_component = '';
        if(jQuery(this).closest("[data-edit-template]").length){
            component_name = jQuery(this).closest("[data-edit-template]").data('edit-template');            
            position_in_component =jQuery(this).closest("[data-edit-template]").find("[data-editable-id]").index(this);
        }


        var changes = {
            '_token' : csrf_token,
            'original_text' : original_data,
            'edited_text' : edited_data,
            'editable_id' : editable_id,
            'route_name' : route_name,
            'position' : pos,
            'position_in_component': position_in_component,
            'component' : component_name,            
        }

        var changes_arr = {};
        if(JSON.parse(sessionStorage.getItem('old_data')) !== null){
            changes_arr = JSON.parse(sessionStorage.getItem('old_data'));
        }
        
        if(original_data !== edited_data){
            changes_arr[pos] = changes;
            sessionStorage.setItem('old_data',JSON.stringify(changes_arr));
            if(jQuery(this).find('button').length < 2)
            {
                jQuery(this).append('<button class="text_publish" ><i class="fa fa-check" aria-hidden="true" title="Publish Change"></i></button><button class="text_unpublish" ><i class="fa fa-close" aria-hidden="true" title="Discard Change"></i></button>');
            }
            jQuery('button#publish_all_btn').show();
        }
        jQuery(this).removeAttr('contentEditable');
    });

    jQuery(document).on("click", "button.text_publish", function(event) {
        event.preventDefault();
        changes = JSON.parse(sessionStorage.getItem('old_data'));
        var id = jQuery(this).parent().data('editable-id');
        var pos = jQuery("[data-editable-id]").index(jQuery(this).parent());

        var message = "Are you sure to publish the following changes ? \n\n"+changes[pos].original_text +' => '+ changes[pos].edited_text;
        // var publish = confirm(message);
        // if(publish){
            var url = "{{ route('textUpdate') }}";
            jQuery.post(url,changes[pos]);
            jQuery(this).parent()[0].childNodes[2].nodeValue = changes[pos].edited_text; 
            jQuery(this).parent().find('button[class="text_unpublish"]').remove();
            jQuery(this).remove();
        // }else{
            // jQuery(this).remove();
            // jQuery(this).parent().find('button[class="text_unpublish"]').remove();
        // }
        if(jQuery('button.text_publish').length == 0){
            jQuery('button#publish_all_btn').hide();
        }
    });

    jQuery(document).on("click", "button.text_unpublish", function(event) {
        event.preventDefault();
        var id = jQuery(this).parent().data('editable-id');
        var pos = jQuery("[data-editable-id]").index(jQuery(this).parent());
        changes = JSON.parse(sessionStorage.getItem('old_data'));
        var session_data = changes[pos];
        jQuery(this).parent()[0].childNodes[2].nodeValue = session_data.original_text;
        delete changes[pos];
        sessionStorage.setItem('old_data',JSON.stringify(changes));
        jQuery(this).parent().find('button[class="text_publish"]').remove();
        jQuery(this).remove();
    });

    jQuery(document).on("click", "button#publish_all_btn", function(event) {
        event.preventDefault();
        changes = JSON.parse(sessionStorage.getItem('old_data'));
        csrf_token = "{{ csrf_token() }}";
        var route_name = "<?php echo request()->route()->uri; ?>";

        var data = {};
        data = {
            '_token'    : csrf_token,
            'route_name': route_name,
            'changes'   : changes
        }
        var url = "{{ route('textUpdate') }}";
        jQuery.post(url,data);
        
        jQuery('button.text_unpublish').remove();
        jQuery('button.text_publish').remove();
        jQuery(this).hide();
        sessionStorage.setItem('old_data','null');
    });

</script>