jQuery(document).ready(function ($) {
    function initializeImageUpload(buttonClass, hiddenInputClass, imgTag) {
        $(document).on('click', buttonClass, function (e) {
            e.preventDefault();

            const button = $(this);
            let fileFrame = button.data('file_frame');

            if (!fileFrame) {
                fileFrame = wp.media({
                    title: 'Select or Upload an Image',
                    library: { type: 'image' },
                    button: { text: 'Use this image' },
                    multiple: false
                });

                fileFrame.on('select', function () {
                    const attachment = fileFrame.state().get('selection').first().toJSON();
                    button.siblings(hiddenInputClass).val(attachment.id);
                    button.siblings(imgTag).attr('src', attachment.url).show();
                });

                button.data('file_frame', fileFrame);
            }

            fileFrame.open();
        });
    }

    // Specific initialization for the corner images button to ensure image display in .corner-images-container
    $(document).on('click', '.upload_corner_images_button', function (e) {
        e.preventDefault();

        const button = $(this);
        let fileFrameCornerImages = button.data('file_frame');

        if (!fileFrameCornerImages) {
            fileFrameCornerImages = wp.media({
                title: 'Select or Upload Corner Images',
                library: { type: 'image' },
                button: { text: 'Use these image' },
                multiple: false
            });

            fileFrameCornerImages.on('select', function () {
                const attachment = fileFrameCornerImages.state().get('selection').first().toJSON();
                const cornerImagesContainer = button.prev('.corner-images-container');
                const hiddenInput = button.prevAll('input[type="hidden"]');

                cornerImagesContainer.empty().append(
                    `<img src="${attachment.url}" style="max-width: 100px; max-height: 100px; display: inline-block; margin-right: 10px;" />`
                );

                hiddenInput.val(attachment.id);
            });

            button.data('file_frame', fileFrameCornerImages);
        }

        fileFrameCornerImages.open();
    });

    // Initialize image upload for other buttons
    initializeImageUpload('.upload_mini_image_1_button', 'input[type="hidden"]', 'img');
    initializeImageUpload('.upload_mini_image_2_button', 'input[type="hidden"]', 'img');
    initializeImageUpload('.upload_image_button', 'input[type="hidden"]', 'img');
    initializeImageUpload('.upload_icon_button', 'input[type="hidden"]', 'img');

    // Add slide functionality with upload button initialization
    $('#add_slide_button').click(function () {
        const slideCount = $('.slide-container').length;
        const newSlide = `
            <div class="slide-container mb-4 p-3 border rounded" data-index="${slideCount}">
                <h3>Slide ${slideCount + 1}</h3>
                <div class="form-group">
                    <label for="slide_image_${slideCount}">Image:</label>
                    <input type="hidden" id="slide_image_${slideCount}" name="slide_images[]" />
                    <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                    <button type="button" class="upload_image_button button mt-2">Upload Image:</button>
                </div>
                <div class="form-group">
                    <label for="slide_title_${slideCount}">Title:</label>
                    <input type="text" id="slide_title_${slideCount}" name="slide_titles[]" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="slide_description_${slideCount}">Description:</label>
                    <textarea id="slide_description_${slideCount}" name="slide_descriptions[]" rows="3" class="form-control"></textarea>
                </div>

                <div class="form-group">
                <label for="slide_head_tag_${slideCount}">Head Tag</label>
                <input type="text" id="slide_head_tag_${slideCount}" name="slide_head_tags[]" class="form-control" />
            </div>
                <div class="form-group">
                    <label for="slide_button_text_${slideCount}">Button Text:</label>
                    <input type="text" id="slide_button_text_${slideCount}" name="slide_button_texts[]" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="slide_button_url_${slideCount}">Button URL:</label>
                    <input type="url" id="slide_button_url_${slideCount}" name="slide_button_urls[]" class="form-control" />
                </div>
                <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
            </div>
        `;
        $('#slider-slides').append(newSlide);
        // initializeImageUpload('.upload_image_button', 'input[type="hidden"]', 'img');
    });

    // Remove slide functionality
    $('#slider-slides').on('click', '.remove_slide_button', function () {
        $(this).closest('.slide-container').remove();
    });
});
