@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Clients
            <button class="btn btn-sm btn-success float-end text-white">Ajouter un nouveau client </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Tel</th>
                            <th>Fonction</th>
                            <th>Tail</th>
                            <th>Adresse</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td>Mohammed</td>
                            <td>Elabidi</td>
                            <td>0xxxxxxxxxxx</td>
                            <td>Developpeur </td>
                            <td>Xl </td>
                            <td>Rabat</td>

                        </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
