$(function () {
    var selectedQuals = [];

    var $qualificationsList = $('#qualifications-list');

    if ($qualificationsList.children().length > 0) {
        $qualificationsList.removeClass('d-none');
    }

    $('.qualification-button').each(function (index, elem) {
        selectedQuals.push({
            id: $(elem).data('id'),
            text: $(elem).text().trim(),
        });
    });

    $('#qualifications').on('select2:select', function (event) {
        const data = {
            id: event.params.data.id,
            text: event.params.data.text,
        }

        const found = selectedQuals.find((elem) => {
            return elem.id == data.id;
        });

        if (found || event.params.data.id == 0) {
            return;
        }

        selectedQuals.push(data);

        $qualificationsList.removeClass('d-none');

        var $button = $('<button>', {
            type: 'button',
            class: 'me-1 mb-1 btn btn-sm btn-primary',
            'data-id': data.id,
            text: data.text,
        });

        var $icon = $('<span>', {
            class: 'ms-1 align-text-bottom',
        });

        $icon.append(feather.icons.x.toSvg());
        $button.append($icon);

        $qualificationsList.append($button);

        $(this).val('0').trigger('change');
    });

    $('#qualifications-list').on('click', 'button', function () {
        var id = $(this).data('id');

        selectedQuals = selectedQuals.filter(function (item) {
            return item.id != id;
        });

        if (selectedQuals.length === 0) {
            $qualificationsList.addClass('d-none');
        }

        $(this).remove();
    });

    $('#qualifications-form').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            url: '@php echo route("programs.qualifications.store", $program); @endphp',
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
            },
            type: 'POST',
            data: { qualificationIds: selectedQuals },
            success: function (response) {
                $('body').html(response);
            }
        });

    });
});
