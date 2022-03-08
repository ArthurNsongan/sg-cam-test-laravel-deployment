var compteSelect;
var banqueSelect;
var clientSelect;

//Méthode de récupération et d'affichage des clients d'une banque
const getBanqueClients = (id) => {
    if(id === "") {
        return false;
    }
    compteSelect.html("");
    compteSelect.prop('disabled', true);
    clientSelect.html("");
    clientSelect.prop('disabled', true);
    $("#saveButton").prop('disabled', true);
    $("#Solde").prop('disabled', true);
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
        clientSelect.append(`<option value=''>-- Sélectionner un client</option>`);
        response.forEach(element => {
            clientSelect.append(`<option value='${element.id}'>${element.nom}</option>`);
        });
    })
}

//Méthode de récupération et d'affichage des comptes d'un client dans une banque
const getBanqueClientComptes = (banque_id, client_id) => {
    if(banque_id === "" || client_id === "") {
        return false;
    }
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
        compteSelect.append(`<option value=''>-- Sélectionner un compte</option>`);
        response.forEach(element => {
            compteSelect.append(`<option value='${element.id}'>${element.libelle}</option>`);
        });
        $("#saveButton").prop('disabled', false);
        $("#Solde").prop('disabled', false);
        $("#Solde").val('0');
    })
}

//Méthode de mise à jour du solde à partir du compte sélectionné
const updateSolde = () => {

    // $('#dataTable').modal('show');
    $.post({
        url: `/api/update-compte`,
        data: {
            "id" : compteSelect.val(),
            "solde": $("#Solde").val(),
            'user_id' : document.getElementById('updateSoldeForm').elements[0].value
        },
    })
    .done(function(response){
        console.log(response);
        alert("Success");
        updateCompteList();
    })
    .fail(function(response){
        console.log(JSON.stringify(response));
        alert("Error");
    })
}

//Méthode de récupération et de mise à jour de l'état global des comptes
const updateCompteList = () => {
    compteSelect.html("");
    compteSelect.prop('disabled', true);
    clientSelect.html("");
    clientSelect.prop('disabled', true);
    $("#saveButton").prop('disabled', true);
    $("#Solde").prop('disabled', true);
    console.log($("#BanqueSelect").first().html());
    document.getElementById("BanqueSelect").children[0].selected = true;
    var compteTables = $("#compteTableBody");
    compteTables.html("");
    $.ajax({
        url: `/api/comptes`,
        method: "GET",
        dataType : "json",
    })
    .done(function(response){
        console.log(response);
        response.forEach(element => {
            compteTables.append(`<tr>
                <td><span class="d-block text-center" >${ element.id }</span></td>
                <td>${ element.libelle }</td>
                <td>${ element.solde }</td>
                <td>${ element.client.nom }</td>
                <td>${ element.banque.nom }</td>
            </tr>`);
        });
        $("#saveButton").prop('disabled', false);
        $("#compteTableBody")
    })
}

//Méthode de récupération et d'affichage des transactions de l'utilisateur connecté
const showTrans = (userId) => {
    $('#dataTable').modal('show');
    $.ajax({
        url: `/api/transactions/${userId}`,
        method: "GET",
        dataType : "json",
    })
    .done(function(response){
        console.log(response);
        var transTableBody = $("#transTableBody");
        response.forEach(element => {
            transTableBody.append(`<tr>
                <td>${ element.libelle }</td>
                <td><a class='fw-500' href='#'>${ element.url  }</a></td>
                <td>${ new Date( element.created_at).toLocaleDateString('fr') + ' ' + new Date( element.created_at).getHours() + ':' + new Date( element.created_at).getMinutes()  }</td>
            </tr>`);
        });
        $("#saveButton").prop('disabled', false);
        $("#compteTableBody")
    })
}

//Initialisation du processus dès le chargement de la page
$(document).ready(function() {

    compteSelect = $("#CompteSelect");
    banqueSelect = $("#BanqueSelect");
    clientSelect = $("#ClientSelect");

    $("#saveButton").prop('disabled', true);
    $("#Solde").prop('disabled', true);

    $("#showTransBtn").on('click', function() {
        showTrans(document.getElementById('updateSoldeForm').elements[0].value);
    });


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