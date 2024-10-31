jQuery(document).ready(function($) {
  
    $('#add_slide_button').click(function() {
        var index = $('#slider-slides .slide-container').length;
        $.ajax({
            url: ova_elems_template_script.ajaxurl,
            type: 'POST',
            data: {
                action: 'ova_elems_get_posts_for_slider'
            },
            success: function(response) {
                var newSlideHtml = `
                    <div class="slide-container mb-4 p-3 border rounded" data-index="${index}">
                        <h3>Slide ${index + 1}</h3>
                        <div class="form-group">
                            <label for="select_post_${index}">Select Post</label>
                            <select id="select_post_${index}" name="selected_posts[]" class="form-control">
                                ${response}
                            </select>
                        </div>
                        <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                    </div>
                `;
                $('#slider-slides').append(newSlideHtml);
            }
        });
    });

    // Remove slide functionality
    $(document).on('click', '.remove_slide_button', function() {
        $(this).closest('.slide-container').remove();
    });
});
