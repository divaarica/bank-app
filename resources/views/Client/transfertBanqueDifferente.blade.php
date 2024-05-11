@extends('layoutAdmin')
@section('sidebar')
<!-- changer en clients.edit avec l'id du client -->
<li class="sidebar-item">
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

<li class="sidebar-item active">
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
<li class="sidebar-item ">
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

</li>
<br><br><br>
@endsection
@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Tranfert</strong> D'argent</h1>

        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        <br><br>
        @endif
        <br>
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; ">
            <i class="fa fa-user" style="font-size: 60px; margin-bottom: 20px;"></i>
            <form action="{{ route('transactions.DobanqueDifferente') }}" method="post" style="display: flex; flex-direction: column; align-items: center;">
                @csrf
                @method('PUT')

                <label class="labels">Veuillez saisir l'IBAN(International Bank Account Number) du destinataire </label>
                <input type="text" class="form-control" name="iban" value="" style="width: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px; box-sizing: border-box;">
                @error('iban')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <label class="labels">Veuillez saisir le BIC (Bank Identifier Code) du destinataire</label>
                <input type="text" name="bic" class="form-control" value="" style="width: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px; box-sizing: border-box;">
                @error('bic')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <label class="labels">Veuillez la clef RIB du destinataire</label>
                <input type="number" name="cle" class="form-control" value="" style="width: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px; box-sizing: border-box;">
                @error('cle')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <label class="labels">Veuillez saisir le numero Compte destinataire</label>
                <input name="numero" type="text" class="form-control" value="" style="width: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px; box-sizing: border-box;">
                @error('numero')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <button type="submit" class="btn btn-sm btn-primary" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Valider</button>
            </form>
        </div>


</main>


@endsection