@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="AddClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un Client </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Nom</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Prenom</label>
                            <input type="text" class="form-control" name="lname" required>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="inputAddress" name="adresse">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Tel</label>
                            <input type="text" class="form-control" name="tel">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Function</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                @foreach ($functions as $function)
                                    <option value="{{ $function->id }}">{{ $function->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Clients
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#AddClient">Ajouter un client </button>
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
