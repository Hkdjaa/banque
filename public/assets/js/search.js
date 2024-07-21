$(document).ready(function() {
    $('#search-form').on('submit', function(event) {
        event.preventDefault();
        const searchQuery = $('#query').val();

        $.ajax({
            url: 'php/liste_clients_controller.php',
            type: 'GET',
            data: { search: searchQuery },
            dataType: 'json',
            success: function(results) {
                let output = '';

                if (results.message) {
                    output = `<p>${results.message}</p>`;
                } else {
                    output = '<ul>';
                    results.forEach(client => {
                        output += `<li><a href='detailclient.php?id=${client.ID_client}'>${client.Nom_client} ${client.Prenom_client} - Identifiant: ${client.ID_client}</a></li>`;
                    });
                    output += '</ul>';
                }

                $('#search-results').html(output);
            }
        });
    });
});
