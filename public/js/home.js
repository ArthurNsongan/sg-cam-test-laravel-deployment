const getBanqueClients = (id) => {
    var clientSelect = $("#ClientSelect");
    var compteSelect = $("#CompteSelect");
    compteSelect.html("");
    compteSelect.prop('disabled', true);
    clientSelect.html("");
    clientSelect.prop('disabled', true);
    $("#saveButton").prop('disabled', true);
    $("#clientLoader").toggleClass('visually-hidden');
    $.ajax({
        url: `/api/banque/${id}/clients`,
        method: "GET",
        dataType : "json",
    })
    .done(function(response){
        $("#clientLoader").toggleClass('visually-hidden');
        clientSelect.prop('disabled', false);
        console.log(response);
        response.forEach(element => {
            clientSelect.append(`<option value='${element.id}'>${element.nom}</option>`);
        });
    })
}

const getBanqueClientComptes = (banque_id, client_id) => {
    var compteSelect = $("#CompteSelect");
    compteSelect.html("");
    compteSelect.prop('disabled', true);
    $("#saveButton").prop('disabled', true);
    $("#compteLoader").toggleClass('visually-hidden');
    $.ajax({
        url: `/api/banque/${banque_id}/clients/${client_id}/comptes`,
        method: "GET",
        dataType : "json",
    })
    .done(function(response){
        $("#compteLoader").toggleClass('visually-hidden');
        console.log(response);
        compteSelect.prop('disabled', false);
        response.forEach(element => {
            compteSelect.append(`<option value='${element.id}'>${element.libelle}</option>`);
        });
        $("#saveButton").prop('disabled', false);
    })
}

const updateSolde = () => {
    // $('#dataTable').modal('show');
    $.post({
        url: `/api/update-compte`,
        data: {
            "id" : $("#CompteSelect").val(),
            "solde": $("#Solde").val()
        },
    })
    .done(function(response){
        console.log(response);
        alert("Success");
    })
    .fail(function(response){
        console.log(JSON.stringify(response));
        alert("Error");
    })
}

$(document).ready(function() {

    $("#saveButton").prop('disabled', true);

    $("#BanqueSelect").on('change', function() {
        console.log($(this).val());
        getBanqueClients($(this).val());
    });

    $("#ClientSelect").on('change', function() {
        console.log($(this).val());
        getBanqueClientComptes($("#BanqueSelect").val(), $(this).val());
    });

    $("#Solde").on('keyup',function(){
        v = parseFloat($(this).val());
        min = parseFloat($(this).attr('min'));

        if (v < min){
            $(this).val(0);
        }
    })

    document.getElementById("updateSoldeForm").addEventListener("submit", function(event){
        event.preventDefault();
        updateSolde();
    });
});