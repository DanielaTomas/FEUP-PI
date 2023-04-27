function getPaginatedData(page) {
    $.ajax({
        url: '/admin/eventsCurrent?page=' + page,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            let tbody = $('#CurrEventTable');
            //let pagination = $('#pageCurr');

            //Clear tbody 
            tbody.empty();

            for (let i = 0; i < data.length ; i++) {
                let tr = $('<tr></tr>');
                let eventNameTd = $('<td></td>').html(data[i].eventname);
                let dateCreatedTd = $('<td></td>').html(data[i].datecreated);
                let requestTypeTd = $('<td></td>').html(data[i].requesttype);
                let requestStatusTd = $('<td></td>').html(data[i].requeststatus);
                let requestActions = $('<td></td>').html(data[i].datereviewed);

                tr.append(eventNameTd);
                tr.append(dateCreatedTd);
                tr.append(requestTypeTd);
                tr.append(requestStatusTd);
                tr.append(requestActions);
               
                tbody.append(tr);
            }
            
            // modify the "Previous" link
            let prev = $("#pageCurr .previous a")
            prev.attr("href", response.prev_page_url);
            prev.attr("class", "page-link");
            prev.html("Previous");

            // modify the "Next" link
            let next = $("#pagePend .next a")
            next.attr("href", response.next_page_url);
            next.attr("class", "page-link");
            next.html("Next");


        },
        error: function(xhr) {
            alert('Error retrieving data.');
        }
    });
}

function getPaginatedDataPend(page) {
    $.ajax({
        url: '/admin/eventsPending?page=' + page,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            let tbody = $('#pendingTable');
            //let pagination = $('#pageCurr');

            //Clear tbody 
            tbody.empty();
           

            console.log(response);

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
            
            // modify the "Previous" link
            let prev = $($("#pagePend .previous a"))
            prev.attr("href", response.prev_page_url);
            prev.attr("class", "page-link");
            prev.html("Previous");

            // modify the "Next" link
            let next = $("#pagePend .next a")
            next.attr("href", response.next_page_url);
            next.attr("class", "page-link");
            next.html("Next");

        },
        error: function(xhr) {
            alert('Error retrieving data.');
        }
    });
}

$(document).ready(function() {
    // Initialize pagination with the first page
    getPaginatedData(1);
    getPaginatedDataPend(1);

    // Handle clicks on pagination links
    $(document).on('click', '#pageCurr li a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPaginatedData(page);
    });

    $(document).on('click', '#pagePend li a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPaginatedDataPend(page);
    });
});
