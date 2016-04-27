$(document).ready(function() {

    $.get('menuTop.html', function(data) {
        $("#menuTop").html(data);
    });
    $('#back').click(function(event) {
        $('#second-step').fadeOut(400, function() {
            $('#first-step').fadeIn(400);
        });
    });
    $('.first-step').click(function(event) {
        if (this.id === 'asma' || this.id === 'diabetes' || this.id === 'pregnant' || this.id === 'hemorragia') {
            var msg = "";
            if (this.id === 'asma') msg = 'Paciente con asma';
            if (this.id === 'diabetes') msg = 'Paciente con diabetes';
            if (this.id === 'pregnant') msg = 'Paciente Embarazada';
            if (this.id === 'hemorragia') msg = 'Paciente con hemorragia';
            alert(msg);
        } else {
            var paneSlot = generateSlot(this.id);
            $('#first-step').fadeOut(400, function() {
                $('#containerStep').html(paneSlot);
                $('#second-step').fadeIn(400);
            });
        }

    });
});

function generateSlot(typeSlot) {
    var html = '';
    for (var i = 0; i < slots[typeSlot].length; i++) {
        html += '<div class="col s12 m4 waves-effect waves-light">';
        html += '<div id="pane" class="first-step shadow-demo valign-wrapper hoverable">';
        html += '<h5 class="valign center truncate">' + slots[typeSlot][i] + '</h5>';
        html += '</div>';
        html += '</div>';
    }
    return html;
}
