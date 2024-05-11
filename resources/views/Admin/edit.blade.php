@extends('layoutAdmin')
@section('sidebar')
<li class="sidebar-item ">
	<a class="sidebar-link" href="{{route('admins.index')}}">
		<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
	</a>
</li>

<li class="sidebar-item active">
	<a class="sidebar-link" href="{{route('admins.create')}}">
		<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
	</a>
</li>

<li class="sidebar-header">
	Staff
</li>

<li class="sidebar-item">
	<a class="sidebar-link" href="{{route('guichetiers.create')}}">
	<i class="align-middle fa fa-users"></i> <span class="align-middle">Ajouter</span>
	</a>
</li>

<li class="sidebar-item ">
	<a class="sidebar-link" href="{{route('guichetiers.index')}}">
	<i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Liste du staff</span>
	</a>
</li>

<li class="sidebar-header">
	Client
</li>

<li class="sidebar-item ">
	<a class="sidebar-link" href="{{route('admins.clientCreate')}}">
	<i class="align-middle fa fa-users"></i> <span class="align-middle">Ajouter</span>
	</a>
</li>

<li class="sidebar-item ">
	<a class="sidebar-link" href="{{route('admins.clients')}}">
	<i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Liste des clients<span>
	</a>
</li>

<li class="sidebar-header">
	Comptes
</li>
<li class="sidebar-item ">
	<a class="sidebar-link" href="{{route('admins.comptes')}}">
	<i class="align-middle fa fa-list-ul"></i> </i> <span class="align-middle">Tout les comptes<span>
			<!-- mettre un bouton pour fire un depot sur un comtpte et bouton retrait et bouton suuprimer -->
	</a>
</li>
<li class="sidebar-item ">
	<a class="sidebar-link" href="{{route('comptes.openClose')}}">
	<i class="align-middle fa fa-money"></i> <span class="align-middle">Ouvrir un compte<span>
			<!-- faire le stps, genre etapes, il choisis d'abord le type de comte ensuite le client et
			si le client n'a pas encore se type de compte on continue la creation
		 -->
	</a>
</li>

<li class="sidebar-header">
    Categorie
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('categories.packs')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Packs<span>
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('categories.types')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Type de compte<span>
    </a>
</li>
<li class="sidebar-header">
	Transactions
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('transfert.etapeUn')}}">
    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Faire un Tranfert<span>
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('transactions.depotRetrait')}}">
    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Faire un Depot / Retrait<span>
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('transactions.liste')}}">
    <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Listes des Transactions<span>
    </a>
</li>
<br><br><br>
@endsection
@section('content')
<main class="content">

	<div class="container-fluid p-0">
		<div class="">
			<div class="card">
				<div class="card-header pb-0">
					<div class="d-flex align-items-center">
						<h2 class="mb-0">Editer le Profil</h2>
						<button class="btn btn-primary ms-auto float-end" data-toggle="modal" data-target="#changePasswordModal">Changer de mot de passe</button>
					</div>
				</div>
				<div class="card-body">
					@if(session('message'))
					<div class="text-danger">
						{{ session('message') }}
					</div>
					@endif

					<h4 class="text-uppercase text-sm text-primary">Information Admn</h4>
					<br>
					
					<form action="" method="post">
						@csrf
						@method('PUT')
						<div class="row">
							<div class="">
								<div class="form-group">
									<label for="example-text-input" class="form-control-label">Nom</label>
									<br>
									
									<input class="form-control" id="lastName" name="lastName" type="text" value="">
								</div>
								@error('lastName')
								<div class="text-danger">{{ $message }}</div>
								@enderror
							</div>
							<br>
							<br>
							<br>
							<br>
							<div class="">
								<div class="form-group">
									<label for="example-text-input" class="form-control-label">Prenom</label>
									<br>
									
									<input class="form-control" type="text" id="firstName" name="firstName" value="">
								</div>
								@error('firstName')
								<div class="text-danger">{{ $message }}</div>
								@enderror
							</div>
							<br>
							<br>
							<br>
							<br>

							<div class="">
								<div class="form-group">
									<label for="example-text-input" class="form-control-label">Adresse</label>
									<br>
									
									<input class="form-control" id="adress" name="adress" type="text" value="">
								</div>
								@error('adress')
								<div class="text-danger">{{ $message }}</div>
								@enderror
							</div>
							<br>
							<br>
							<br>
							<br>

							<div class="">
								<div class="form-group">
									<label for="example-text-input" class="form-control-label">Telephone</label>
									<br>
									
									<input class="form-control" id="tel" name="tel" type="text" value="">
								</div>
								@error('tel')
								<div class="text-danger">{{ $message }}</div>
								@enderror
							</div>
							<br>
							<br>
							<br>
							<br>
							<div class="">
								<div class="form-group">
									<label for="example-text-input" class="form-control-label">Adresse mail</label>
									<br>
								
									<input class="form-control" id="email" name="email" type="text" value="">
								</div>
								@error('email')
								<div class="text-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<br>
						<br>
						<hr class="horizontal dark">
						<br>
						<button type="submit" class="btn btn-secondary float-end tn-sm">Modifier</button>
					</form>


				</div>
			</div>
		</div>


	</div>

	<!-- modal modifier mot de passe  -->
	<div class="modal" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modifier le mot de passe </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="name">Ancien mot de passe :</label>
							<input type="password" class="form-control" id="password" name="password">
						</div>
						<div class="form-group">
							<label for="name">Nouveau mot de passe:</label>
							<input type="password" class="form-control" id="new_password" name="new_password">
						</div>
						<button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
					</form>
				</div>
			</div>
		</div>
	</div>


</main>


@endsection