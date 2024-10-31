jQuery(document).ready(function($) {
    function initializeImageUpload(buttonClass) {
        $(document).on('click', buttonClass, function(e) {
            e.preventDefault();

            const button = $(this);
            const file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select or Upload an Image',
                library: { type: 'image' },
                button: { text: 'use these image' },
                multiple: false
            });

            file_frame.on('select', function() {
                const attachment = file_frame.state().get('selection').first().toJSON();
                button.siblings('input[type="hidden"]').val(attachment.id);
                button.siblings('img').attr('src', attachment.url).show();
            });

            file_frame.open();
        });
    }

    initializeImageUpload('.upload_image_button');

    $('#add_slide_button').click(function() {
        const slideCount = $('.slide-container').length;
        const newSlide = `
            <div class="slide-container mb-4 p-3 border rounded" data-index="${slideCount}">
                <h3>Slide ${slideCount + 1}</h3>
                <div class="form-group">
                    <label for="slide_image_${slideCount}">Image</label>
                    <input type="hidden" id="slide_image_${slideCount}" name="slide_images[]" />
                    <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                    <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Image</button>
                </div>
                <div class="form-group">
                    <label for="slide_title_${slideCount}">Title</label>
                    <input type="text" id="slide_title_${slideCount}" name="slide_titles[]" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="slide_description_${slideCount}">Description</label>
                    <textarea id="slide_description_${slideCount}" name="slide_descriptions[]" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="slide_button_text_${slideCount}">Button Text</label>
                    <input type="text" id="slide_button_text_${slideCount}" name="slide_button_texts[]" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="slide_button_url_${slideCount}">Button URL</label>
                    <input type="url" id="slide_button_url_${slideCount}" name="slide_button_urls[]" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="slide_thumbnail_image_${slideCount}">Thumbnail Image</label>
                    <input type="hidden" id="slide_thumbnail_image_${slideCount}" name="slide_thumbnail_images[]" />
                    <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                    <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Thumbnail Image</button>
                </div>

                <div class="form-group">
                    <label for="slide_thumbnail_title_${slideCount}">Thumbnail Title</label>
                    <input type="text" id="slide_thumbnail_title_${slideCount}" name="slide_thumbnail_titles[]" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="slide_head_tag_${slideCount}">Head Tag</label>
                    <input type="text" id="slide_head_tag_${slideCount}" name="slide_head_tags[]" class="form-control" />
                </div>


                <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
            </div>`;
        $('#slider-slides').append(newSlide);

        // initializeImageUpload('.upload_image_button');
    });

    $(document).on('click', '.remove_slide_button', function() {
        $(this).closest('.slide-container').remove();
    });
});