@php
    $activeLink = 'minatd';
    $subactiveLink = 'minatd.fiche'
@endphp
    <!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Finac</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .blue-background {
        background-color: #87CEFA; /* Light Sky Blue */
        padding: 20px;
        color: #fff; /* White text */
        text-align: center;
        margin: 0 auto; /* Center the block */
    }

    .infos-content {
        padding: 20px;
        color: black; /* Black text */

        margin: 0 auto; /* Center the block */
    }

    .footer {
        margin-top: 50px;
        text-align: center;
        font-size: 12px;
        color: #aaa; /* Light Gray text */
    }
</style>
<body>
<div class="container">
    <div id="pdf-view">
        <div class="d-flex flex-row mt-5">
            <!-- DEVISE EN FRANCAIS -->
            <div class="text-center" style="margin-bottom:30px; flex:1">
                <div>
                    <h4 class="fw-bold text-uppercase">Republique du Cameroun</h4>
                    <h5><i>Paix - travail - Patrie</i></h5>
                    <h6>- . - . - . -</h6>
                </div>
                <div>
                    <h4 class="fw-bold text-uppercase">Ministere de l'Administration Territoriale</h4>
                    <h5><i>Fichier Nationale des Armes Civiles</i></h5>
                    <h6>- . - . - . -</h6>
                    <h6><i>222 23 45 46 Yaoundé</i></h6>
                </div>
            </div>
            <!-- LOGO UNIVERSITE -->
            <div class="text-center " style="margin-bottom:50px; flex:1">
                <img src="{{ asset('asset/images/logo_finac.jpg') }}" width="90" alt="" srcset="">
            </div>
            <!-- DEVISE EN ANGLAIS -->
            <div class="text-center" style="margin-bottom:30px; flex:1">
                <div>
                    <h4 class="fw-bold text-uppercase">Republic of Cameroon</h4>
                    <h5><i>Peace - Work - Fatherland</i></h5>
                    <h6>- . - . - . -</h6>
                </div>
                <div>
                    <h4 class="fw-bold text-uppercase">Ministry of Territorial Administration</h4>
                    <h5><i>National File of Civil Weapons</i></h5>
                    <h6>- . - . - . -</h6>
                    <h6><i>222 23 45 46 Yaoundé</i></h6>
                </div>
            </div>
        </div>

        <hr style="height: 2px; color: #aaa; background-color: #aaa; border: none;">

        <div class="align-content-center blue-background">
            <h4 class="fw-bold text-uppercase">Vos informations personnelles</h4>
        </div>

        <div class="infos-content">
            <p><strong>Nom:</strong> {{$holderWeapons->fullname}}</p>
            <p id="email"><strong>Email:</strong>{{$holderWeapons->email}}</p>
            <p><strong>Adresse:</strong> 123 Main Street, Cityville</p>
            <p><strong>Telephone:</strong> {{$holderWeapons->telephone}}</p>
            <p><strong>Profession:</strong>{{$holderWeapons->profession}}</p>
            <p><strong>Type d'arme:</strong>{{$weapon->weaponType->type}}</p>
            <p><strong>Numero de serie:</strong> {{$weapon->serial_number}}</p>
            <p><strong>Code
                    FINAC:</strong> {{ \App\Http\Controllers\Helpers\HelpersFunction::getCodeFinacFromPermissionPortId($permissionsPort->id) }}
            </p>
            <p><strong>Numéro de série de l'arme:</strong> XYZ456</p>
        </div>


        <!-- Footer Section -->
        <div class="footer">
            <hr style="height: 2px; color: #aaa; background-color: #aaa; border: none; margin-bottom: 10px;">
            <p>Ce document est une confirmation officielle de l'acceptation de votre demande de port d'arme. Tous droits
                réservés.</p>
            <p>Date d'émission: 4 février 2024</p>
        </div>
    </div>
</div>

</body>
</html>

<!-- Inclure html2pdf.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>


<script>
    $(document).ready(function () {
// Appeler la fonction pour générer le PDF et l'envoyer au serveur
        genererPDFetTelecharger();
    });

    function genererPDFetTelecharger() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const element = document.getElementById('pdf-view');
        const email = 'bayonidris@gmail.com'; // Remplacez ceci par la récupération de l'e-mail si nécessaire

        const options = {
            margin: 2,
            filename: 'ficheFinac.pdf',
            image: {type: 'jpeg', quality: 0.98},
            html2canvas: {scale: 4},
            jsPDF: {unit: 'mm', format: 'a4', orientation: 'portrait'}
        };

        html2pdf().set(options).from(element).toPdf().get('pdf').then(function (pdf) {
            // Convertissez le PDF en une chaîne Base64
            const pdfData = btoa(pdf);

            // Envoyez les données du PDF au serveur avec AJAX
            $.ajax({
                url: '/save-pdf',
                type: 'POST',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Ajouter le jeton CSRF dans les en-têtes
                },
                data: JSON.stringify({pdfData: pdfData, email: email}), // Convertissez les données en JSON
                success: function (response) {
                    console.log(response);
                    window.history.back();
                },
                error: function (error) {
                    console.error('Erreur lors de l\'envoi du fichier PDF au serveur.', error);
                }

            });
        });

    }


</script>




