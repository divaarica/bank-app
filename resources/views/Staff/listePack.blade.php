@extends('layoutAdmin')
@section('sidebar')
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('admins.index')}}">
        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
    </a>
</li>

<li class="sidebar-item ">
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

<li class="sidebar-item">
    <a class="sidebar-link" href="{{route('guichetiers.index')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Liste du staff</span>
    </a>
</li>

<li class="sidebar-header">
    Client
</li>

<li class="sidebar-itemx">
    <a class="sidebar-link" href="{{route('admins.clientCreate')}}">
        <i class="align-middle fa fa-users"></i> <span class="align-middle">Ajouter</span>
    </a>
</li>

<li class="sidebar-item">
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
<li class="sidebar-item active">
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
        <h1 class="h3 mb-3"><strong>Pack(s)</strong></h1>
        <br>
        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        @endif
        <a href="" type="button" class="btn btn-primary float-end padding-right-10px" data-toggle="modal" data-target="#addClasseModal"><i class="fa fa-plus"></i> Ajouter</a>
        <br />
        <br>
        <div style="overflow-x: auto;">
            <table id="myTable" class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Cout mensuel(Agios)</th>
                        <th scope="col">Plafond</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packs as $p)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $p -> libelle }}</td>
                        <td>{{ $p -> agios}}</td>
                        <td>
                            @if ($p->plafond == 0)
                            illimitee
                            @else
                            {{ $p -> plafond }}
                            @endif
                        </td>
                        <td class="d-flex ">
                            <a href="" type="button" class="btn btn-success custom-btn" data-toggle="modal" data-target="#editType{{$p->id}}">
                                Modifier</a>&nbsp;&nbsp;&nbsp;

                            <form action="{{ route('categories.destroyPack', $p -> id)}} " method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce pack?');" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger custom-btn">Supprimer</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>



    </div>

    <!-- Modal ajouter -->
    <div class="modal" id="addClasseModal" tabindex="-1" role="dialog" aria-labelledby="addClasseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClasseModalLabel">Ajouter un nouveau Pack</h5>
                    <button type="button" class="close" aria-label="Fermer" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.createPack') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nomZone">Libelle:</label>
                            <input type="text" class="form-control" id="libelle" name="libelle">
                        </div>
                        <div class="form-group">
                            <label for="nomZone">Agios:</label>
                            <input type="number" class="form-control" id="agios" name="agios">
                        </div>
                        <div class="form-group">
                            <label for="nomZone">Plafond:</label>
                            <input type="number" class="form-control" id="plafond" name="plafond">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal modifier -->
    @foreach( $packs as $p)
    <div class="modal fade" id="editType{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le Type de compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.updatePack', ['pack' => $p->id]) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="nomZone">Libelle:</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" value="{{$p->libelle}}">
                        </div>
                        <div class="form-group">
                            <label for="nomZone">Agios:</label>
                            <input type="text" class="form-control" id="agios" name="agios" value="{{$p->agios}}">
                        </div>
                        <div class="form-group">
                            <label for="nomZone">Plafond:</label>
                            <input type="text" class="form-control" id="plafond" name="plafond" value="{{$p->plafond}}">
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


</main>


@endsection