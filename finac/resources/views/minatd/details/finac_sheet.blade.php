@php
    $activeLink = 'minatd';
        $subactiveLink = 'minatd.fiche'

@endphp
@extends('layouts.backend')

@section('style')
    <style>
    </style>
@endsection

@section('content')
    <div class="row justify-content-between">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-primary text-white-all">
                    <li class="breadcrumb-item"><a href="{{route('minatd.index')}}"><i class="fas fa-building"></i>Minatd</a></li>
                    <li class="breadcrumb-item"><a><i class="fas fa-cubes"></i>Fiche Finac</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="author-box-left mb-5">
                        <img  alt="Profile picture"
                              class="rounded-circle  author-box-picture img-fluid" src="{{asset('http://127.0.0.1:8000/storage/finac/holder_weapons_picture/'.$holderWeapons->photo)}}"  style="width: 100px;height: 100px;object-fit: cover;object-position: center;">
                    </div>

                    <div class="author-box-details author-box-name">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="fullname">{{$holderWeapons->fullname}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Adress</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="adress">Bay Area, San Francisco, CA</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="email">{{$holderWeapons->email}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="phone">{{$holderWeapons->telephone}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Profession</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="profession">{{$holderWeapons->profession}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Type Arme</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="weapon_type">{{$weapon->weaponType->type}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Numero de serie</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="serial_number">{{$weapon->serial_number}}</p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">CNI</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><a  href="{{ env('APP_URL') . 'storage/finac/identity_number/' .$holderWeapons->identity_number }}" target="_blank" class="btn btn-link download-btn">
                                        <i class="fas fa-download"></i>
                                        {{$holderWeapons->identity_number}}
                                    </a></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Permis Armes</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> <a type="button" href="{{ env('APP_URL') . 'storage/finac/buy_permission/' .$holderWeapons->buy_permission }}" target="_blank" class="btn btn-link download-btn">
                                        <i class="fas fa-download"></i>
                                        {{$holderWeapons->buy_permission}}
                                    </a></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Permis Armes</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> <a type="button" href="{{ env('APP_URL') . 'storage/finac/buy_permission/' .$holderWeapons->buy_permission }}" target="_blank" class="btn btn-link download-btn">
                                        <i class="fas fa-download"></i>
                                        {{$holderWeapons->buy_permission}}
                                    </a></p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Certificat Moralite</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><a  href="{{ env('APP_URL') . 'storage/finac/identity_number/' .$holderWeapons->identity_number }}" target="_blank" class="btn btn-link download-btn">
                                        <i class="fas fa-download"></i>
                                        {{$holderWeapons->identity_number}}
                                    </a></p>
                            </div>
                        </div>
                        <input type="hidden" id="codeFinac" value="{{ \App\Http\Controllers\Helpers\HelpersFunction::getCodeFinacFromPermissionPortId($permissionsPort->id) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script>

    function genererPDFetTelecharger() {
        // Récupération du jeton CSRF
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Création d'une nouvelle instance de jsPDF
        var pdf = new jsPDF({
            orientation: 'portrait', // 'portrait' ou 'landscape'
            unit: 'mm',
            format: 'a3',
        });
        pdf.setFontSize(12); // Ajustez la taille de police selon vos besoins


        // Section française de l'en-tête
        pdf.text(10, 20, "République du Cameroun", { maxWidth: 200 });
        pdf.text(10, 30, "Ministère de l'Administration Territoriale et de la Décentralisation", { maxWidth: 200 });
        pdf.text(10, 40, "Fichier National des Armes du Civile (FINAC)", { maxWidth: 200 });


// Reste du code...


        // Ajout du logo FINAC au milieu du document
        var imgLogo = new Image();


        imgLogo.src = "{{env('APP_URL')}}logo_finac/logo_finac.jpg";
        imgLogo.onload = () => {
            pdf.addImage(imgLogo, 'PNG', 15, 40, 180, 180);
            console.log(imgLogo);
        };


        // Section anglaise de l'en-tête
        pdf.text(180, 20, "Republic of Cameroon");
        pdf.text(180, 30, "Ministry of Territorial Administration and Decentralization");
        pdf.text(180, 40, "Civilians National Arms File (FINAC)");


        // Ajout des informations du formulaire en anglais
        var formData = [
            { label: "Full Name", value: document.getElementById('fullname').innerText },
            { label: "Address", value: document.getElementById('adress').innerText },
            { label: "Email", value: document.getElementById('email').innerText },
            { label: "Phone Number", value: document.getElementById('phone').innerText },
            { label: "Profession", value: document.getElementById('profession').innerText },
            { label: "Weapon Type", value: document.getElementById('weapon_type').innerText },
            { label: "Weapon Serial Number", value: document.getElementById('serial_number').innerText },
            { label: "Code Finac ", value: document.getElementById('codeFinac').value },
        ];

        var email =  document.getElementById('email').innerText;

        var xPos = 10;
        var yPos = 60;
        pdf.setFontSize(15); // Ajustez la taille de police selon vos besoins


        // Ajout d'un texte pour décrire le contenu de la fiche
        var contenuText = "This FINAC form contains the following information:";
        pdf.text(40, yPos, contenuText , {align: 'center'});
        yPos += 10;
        pdf.setFontStyle('underline'); // Souligner le texte
        pdf.setFontStyle('normal'); // Réinitialiser le style de police à .normal
        pdf.setFontSize(12); // Ajustez la taille de police selon vos besoins



        // Ajout des informations du formulaire une à une
        for (var i = 0; i < formData.length; i++) {
            pdf.text(xPos, yPos + 10, formData[i].label + ": " + formData[i].value);
            yPos += 10;
        }




        // Convertir le contenu en Data URL
        var pdfData = pdf.output("datauristring");
        //
        // Créer un élément d'ancrage invisible
        var link = document.createElement("a");
        link.href = pdfData;
        link.download = "ficheFinac.pdf";

        // Ajouter l'élément au document
        document.body.appendChild(link);

        // Simuler le clic sur l'élément d'ancrage
        link.click();

        // Retirer l'élément du document
        document.body.removeChild(link);

        // Envoyer le fichier PDF au serveur avec Ajax
        // $.ajax({
        //
        //     url: '/save-pdf', // Assurez-vous que le chemin correspond à votre route Laravel
        //     type: 'POST',
        //     contentType: 'application/json', // Spécifiez que vous envoyez du JSON
        //     headers: {
        //         'X-CSRF-TOKEN': csrfToken, // Ajouter le jeton CSRF dans les en-têtes
        //     },
        //     data: JSON.stringify({ pdfData: pdfData, formData: formData , email: email }), // Convertissez les données en JSON
        //     success: function(response) {
        //         console.log(response);
        //     },
        //     error: function(error) {
        //         console.error('Erreur lors de l\'envoi du fichier PDF au serveur.');
        //         console.error(error);
        //     }
        // });
    }

</script>

<script>
    $(document).ready(function() {
        genererPDFetTelecharger();
    });
</script>


