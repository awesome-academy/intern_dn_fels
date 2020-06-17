const changeLabel = (label) => {
    $('#follow-btn').text(label);
}

$(document).ready(() => {
    $('#follow-btn').click(() => {

        const id = $('#follow-btn').attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: `/follow`,
            data: {
                id
            },
            success: (result) => {
                changeLabel(result.label);
            },
            error: (xhr) => {
                const res = JSON.parse(xhr.responseText);
                alert(res.message);
            }
        });

    });
});
