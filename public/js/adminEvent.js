function getPaginatedData(page) {
    $.ajax({
        url: '/admin/eventsCurrent/' + page,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            let tbody = $('#CurrEventTable');

            for (let i = 0; i < data.length ; i++) {
                let tr = $('<tr></tr>');
                let eventNameTd = $('<td></td>').html(data[i].eventname);
                let dateCreatedTd = $('<td></td>').html(data[i].datecreated);
                let requestTypeTd = $('<td></td>').html(data[i].requesttype);
                let requestStatusTd = $('<td></td>').html(data[i].requeststatus);

                tr.append(eventNameTd);
                tr.append(dateCreatedTd);
                tr.append(requestTypeTd);
                tr.append(requestStatusTd);
               
                tbody.append(tr);
            }
        },
        error: function(xhr) {
            alert('Error retrieving data.');
        }
    });
}


$(document).ready(function() {
    // Initialize pagination with the first page
    getPaginatedData(1);

    // Handle clicks on pagination links
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPaginatedData(page);
    });
});
