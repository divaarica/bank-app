@extends('layoutAdmin')
@section('asset')
<link href="{{ asset('Admin/css/steps.css') }}" rel="stylesheet">
@endsection
@section('sidebar')

<li class="sidebar-item active">
	<a class="sidebar-link" href="{{route('admins.index')}}">
		<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
	</a>
</li>

<li class="sidebar-item">
	<a class="sidebar-link" href="{{route('admins.create')}}">
		<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
	</a>
</li>

<li class="sidebar-header">
	Staff
</li>

<li class="sidebar-item">
	<a class="sidebar-link" href="{{route('guichetiers.create')}}">
		<i class="align-middle fa fa-users"></i><span class="align-middle">Ajouter</span>
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
		<i class="align-middle fa fa-users"></i><span class="align-middle">Ajouter</span>
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
		<i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Tout les comptes<span>
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
		<i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Liste des Transactions<span>
	</a>
</li>
<br><br><br>
@endsection
@section('content')

<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

		<br>
		@if(session('success'))
		<div class="text-danger">
			{{ session('success') }}
		</div>
		<br>
		<br>
		@endif

		<div class="containerxd text-center">
			<div class="cardxd bg-info ">
				<a href="{{ route('admins.clients') }}">
					<h4><i class="fa fa-users"></i> Nombre de clients</h4>
					<br>
					<h2> {{ $nbClients }} </h2>
					<br>

				</a>
			</div>
			<div class="cardxd bg-muted">
				<a href="{{ route('guichetiers.index') }}">
					<h4><i class="fa fa-users"></i> Nombre de guichetiers</h4>
					<br>
					<h2> {{ $nbGuichetiers }} </h2>
					<br>
				</a>
			</div>
			<div class="cardxd bg-info">

				<a href="{{ route('admins.comptes') }}">
					<h4><i class="fa fa-dollar"></i> Nombre de comptes</h4>
					<br>
					<h2> {{ $nbComptes }} </h2>
					<br>
				</a>
			</div>
		</div>
		<div class="containerxd text-center">
			<div class="cardxd bg-muted">
				<a href="{{ route('transactions.liste') }}">
					<h4><i class="fa fa-dollar"></i> Total Depots du mois </h4>
					<br>
					<h2> {{ $totalDepot  }} F</h2>
					<br>
				</a>
			</div>
			<div class="cardxd bg-info">
				<a href="{{ route('transactions.liste') }}">
					<h4><i class="fa fa-dollar"></i> Total Retraits du mois</h4>
					<br>
					<h2>{{ $totalRetrait }} F</h2>
					<br>
				</a>
			</div>
			<div class="cardxd bg-muted">

				<!-- <a href="{{ route('transactions.compteEpargne') }}"> -->
				<h4><i class="fa fa-dollar"></i> Gains (AGIOS)</h4>
				<br>
				<h2> {{ $gainAgios }} F</h2>
				<br>
				<!-- </a> -->
			</div>
		</div>

		<hr><br>

		<div class="row">
			<div class="col-md-6">
				<div class="card flex-fill">
					<div class="card-header">

						<h5 class="card-title mb-0">Calendar</h5>
					</div>
					<div class="card-body d-flex">
						<div class="align-self-center w-100">
							<div class="chart">
								<div id="datetimepicker-dashboard"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card-header">
					<br>
					<h5 class="card-title mb-0">Analyse du nombre de transcations sur 3 mois</h5>
					<br>
				</div>
				<div class="card-body d-flex">
					<div class="align-self-center w-100">
						<div class="py-3">
							<div class="chart chart-xs">
								<canvas id="chartjs-dashboard-pie"></canvas>
							</div>
						</div>

						<br>
						<table class="table mb-0">
							<tbody>
								<tr>
									<td>Transactions mois d'avant le mois précédent</td>
									<td class="text-end">{{ $transMoisPrecedentPrecedent }}</td>
								</tr>
								<tr>
									<td>Transactions mois precedant</td>
									<td class="text-end">{{ $transMoisPrecedent }}</td>
								</tr>
								<tr>
									<td>Transaction de ce mois</td>
									<td class="text-end">{{ $transCeMois }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<hr><br>

		<h1 class="h4 mb-4"><strong>Dernieres transactions</strong></h1>
		<div style="overflow-x:auto;">
			<table class="table table-striped table-light">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Code transaction</th>
						<th scope="col">Type </th>
						<th scope="col">De </th>
						<th scope="col">Vers </th>
						<th scope="col">Montant</th>
						<th scope="col">Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $trans as $t)
					<tr>
						<th scope="row">{{ $loop->index + 1 }}</th>
						<td>{{ $t-> code }}</td>
						<td>{{ $t-> type_transaction -> libelle }}</td>
						@if($t -> id_compte_emetteur != 1)
						<td>{{ $t-> emetteur -> nom }} {{ $t-> emetteur-> nom }}</td>
						@else
						<td>Agence</td>
						@endif
						<td>{{ $t-> recepteur -> nom }} {{ $t-> recepteur-> nom }}</td>
						<td>{{ $t-> montant }}</td>
						<td>{{ $t-> created_at }}</td>

					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<br>
		<a href="{{ route('transactions.liste') }}" type="button" class="btn btn btn-primary text-light" style="font-size: 15px;"> <i class="fa fa-eye"></i> Voir toutes</a>

		<br><br>
		<hr><br>
		<h1 class="h4 mb-4"><strong>Decrementation des comptes en fonction du type de compte</strong></h1>
		<div class="container ">
			<br>
			<div class="row">
				<div class="col-md-5 p-4" style="background-color: rgba(245, 158, 108, 0.8);">

					<h4>Debiter des comptes en fonction du type de compte </h4>
					<br>
					<h6 class="text-danger">Attention tout les comptes seront Debite du montant de leur Agios</h6>
					<br>
					<br>
					@if($okAgio == 0)
					<!-- quand n va clique les comptes seront debiter en faisant une transaction pour chaque comptes -->
					<div class="text-center">
						<form action="{{route('transactions.agio')}}" method="post">
							@csrf
							@method('PUT')
							<button type="submit" class="btn btn-lg btn-danger text-white" style="font-size: 20px;"> Debiter</button>
						</form>
					</div>
					@else

					<h6 class="text-danger">Retrait Agio deja effectuer</h6>

					@endif

				</div>
				<div class="col-md-2">

				</div>
				<div class="col-md-5 p-4" style="background-color: rgba(177, 170, 142, 0.29);">
					<br>
					<br>
					<h6 class="text-danger">Si vous avez fais une erreur en debitant tout les comptes , vous pouvez faire un Rollback avec le boutton, si dessous pour anuler</h6>
					<br><br>
					@if($okAgio != 0)
					<div class="text-center">
						<form action="{{route('transactions.erreurAgio')}}" method="post">
							@csrf
							@method('PUT')
							<button type="submit" class="btn btn-lg btn-secondary text-white" style="font-size: 20px;"> Rollback</button>

						</form>

					</div>
					@else

					<h6 class="text-danger">Impossible de faire un rollback les retraits pour Agios n'ont pas encore ete effectuer</h6>

					@endif

				</div>
			</div>
		</div>

		<br>
		<br>
		<br>

	</div>
	<br>
	<br>
	<br>
</main>

@endsection
@section('js')

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("chartjs-dashboard-pie"), {
			type: "pie",
			data: {
				labels: ["Transactions mois d'avant le mois précédent", "Transactions mois precedant", "Transaction de ce mois"],
				datasets: [{
					data: ['{{$transMoisPrecedentPrecedent}}', '{{ $transMoisPrecedent }}', '{{ $transCeMois }}'],
					// data: ['{{ $transMoisPrecedentPrecedent }}', '{{ $transMoisPrecedent }}', '{{ $transCeMois }}'],

					backgroundColor: [
						window.theme.primary,
						window.theme.warning,
						window.theme.danger,

					],
					borderWidth: 5
				}]
			},
			options: {
				responsive: !window.MSInputMethodContext,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				cutoutPercentage: 75
			}
		});
	});
</script>

@endsection