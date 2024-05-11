@extends('layoutAdmin')
@section('asset')
<link href="{{ asset('Admin/css/choose.css') }}" rel="stylesheet">
<!-- modal modifier mot de passe  -->
<link href="{{ asset('Admin/css/generate.css') }}" rel="stylesheet">

@endsection
@section('sidebar')


<!-- changer en clients.edit avec l'id du client -->
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('clients.index')}}">
        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
    </a>
</li>

<li class="sidebar-header">
    Mes Comptes(s)
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('client.compteCourant')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Compte Courant<span>
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('client.compteEpargne')}}">
        <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Compte Epargne<span>
    </a>
</li>

<li class="sidebar-header">
    Transactions
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="{{route('transactions.choixTransfert')}}">
        <i class="align-middle fa fa-users"></i><span class="align-middle">Tranfert</span>
    </a>
</li>


<!-- <li class="sidebar-item ">
	<a class="sidebar-link" href="{{route('clients.index')}}">
		<i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Contacts Favoris<span>
	</a>
</li> -->

<li class="sidebar-header">
    Carte(s)
</li>
<li class="sidebar-item active">
    <a class="sidebar-link" href="{{route('client.cartes')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Generer une cartes<span>
                <!-- mettre un bouton pour fire un depot sur un comtpte et bouton retrait et bouton suuprimer -->
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('client.mesCartes')}}">
        <i class="align-middle fa fa-money"></i> <span class="align-middle">Mes cartes<span>
                <!-- faire le stps, genre etapes, il choisis d'abord le type de comte ensuite le client et
			si le client n'a pas encore se type de compte on continue la creation
		 -->
    </a>
</li>

<br><br><br>
@endsection
@section('content')
<main class="content">
    @if($c == 'visa')
    <h1 class="h3 mb-3"><strong>Carte:</strong> Visa</h1>
    @elseif($c == "masterCard")
    <h1 class="h3 mb-3"><strong>Carte:</strong> Mastercard</h1>

    @else
    <h1 class="h3 mb-3"><strong>Carte:</strong> American express</h1>
    @endif

    @if(session('success'))
    <div class="text-danger">
        {{ session('message') }}
    </div>
    @endif

    <br>
    <br>

    <div class="container">


        <div class="card-container">

            <div class="front">
                <div class="image">
                    <img src="{{ asset('Admin/img/chip.png') }}" alt="">
                    @if($c == 'visa')
                    <img src="{{ asset('Admin/img/visa.png') }}" alt="">
                    @elseif($c == 'masterCard')
                    <img src="{{ asset('Admin/img/logo.png') }}" alt="">
                    @else
                    <img src="{{ asset('Admin/img/americanExpress.png') }}" alt="">
                    @endif


                </div>
                <div class="card-number-box">################</div>
                <div class="flexbox">
                    <div class="box">
                        <span>card holder</span>
                        <div class="card-holder-name">full name</div>
                    </div>
                    <div class="box">
                        <span>expires</span>
                        <div class="expiration">
                            <span class="exp-month"></span>
                            <span class="exp-year"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="back">
                <div class="stripe"></div>
                <div class="box">
                    <span>cvv</span>
                    <div class="cvv-box"></div>
                    @if($c == 'visa')
                    <img src="{{ asset('Admin/img/visa.png') }}" alt="">
                    @elseif($c == 'masterCard')
                    <img src="{{ asset('Admin/img/logo.png') }}" alt="">
                    @else
                    <img src="{{ asset('Admin/img/americanExpress.png') }}" alt="">
                    @endif
                </div>
            </div>

        </div>

        <form action="{{ route('client.validerCarte', $c) }}" method="post">
            @csrf
            @method('PUT')
            <div class="inputBox">
                <span>card number</span>
                <input type="text" maxlength="16" value="{{ $numero }}" name="numero" class="card-number-input" readonly>
            </div>
            <div class="inputBox">
                <span>card holder</span>
                <input type="text" class="card-holder-input" value="{{ $user ->nom }} {{ $user ->prenom }}" readonly>
            </div>
            <div class="inputBox">
                <span>Montant</span>
                <input type="number" name="montant" class="card-holder-input" value="" required>
                @error('montant')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flexbox">
                <div class="inputBox">
                    <span>Expiration mm</span>
                    <select name="expiration_month" id="expiration_month" name="expiration_month" class="month-input">
                        <!-- Options de mois -->
                    </select>
                </div>
                <div class="inputBox">
                    <span>Expiration yy</span>
                    <select name="expiration_year" id="expiration_year" name="expiration_year" class="year-input">
                        <!-- Options d'année -->
                    </select>
                </div>
                <div class="inputBox">
                    <span>cvv</span>
                    <input type="text" maxlength="3" class="cvv-input" name="cvv">
                    @error('cvv')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <input type="submit" value="submit" class="submit-btn">
        </form>

    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Récupérer la valeur de l'input readonly
            var cardNumber = document.querySelector('.card-number-input').value;
            // Mettre à jour la div correspondante avec la valeur récupérée
            document.querySelector('.card-number-box').innerText = cardNumber;

            // Récupérer la valeur de l'input pour le titulaire de la carte
            var cardHolder = document.querySelector('.card-holder-input').value;
            // Mettre à jour l'attribut value de l'input correspondant avec la valeur récupérée
            document.querySelector('.card-holder-name').innerText = cardHolder;
        });
        document.querySelector('.card-number-input').oninput = () => {
            document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
        }

        document.querySelector('.card-holder-input').oninput = () => {
            document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
        }

        document.querySelector('.month-input').oninput = () => {
            document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
        }

        document.querySelector('.year-input').oninput = () => {
            document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
        }

        document.querySelector('.cvv-input').onmouseenter = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
        }

        document.querySelector('.cvv-input').onmouseleave = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
        }

        document.querySelector('.cvv-input').oninput = () => {
            document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
        }
    </script>
    <script>
        // Obtenir la date actuelle
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth() + 1; // Les mois sont indexés à partir de 0, donc nous ajoutons 1 pour obtenir le mois actuel

        // Sélectionner les éléments de liste déroulante
        var monthSelect = document.getElementById('expiration_month');
        var yearSelect = document.getElementById('expiration_year');





        // Remplir les options du mois
        for (var i = currentMonth; i <= 12; i++) {
            var option = document.createElement('option');
            option.value = (i < 10 ? '0' + i : i); // Ajouter un 0 devant les mois de 1 à 9
            option.textContent = (i < 10 ? '0' + i : i);
            monthSelect.appendChild(option);
        }

        // Remplir les options de l'année
        for (var year = currentYear; year <= currentYear + 10; year++) {
            var option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }

        // Récupérer les valeurs sélectionnées par défaut dans les menus déroulants
        var defaultMonth = document.getElementById('expiration_month').value;
        var defaultYear = document.getElementById('expiration_year').value;

        document.querySelector('.exp-month').textContent = defaultMonth;
        document.querySelector('.exp-year').textContent = defaultYear.substring(2); // Prendre les deux derniers chiffres de l'année
    </script>




</main>




@endsection