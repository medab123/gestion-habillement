@extends('layouts.app')

@section('content')
    <div class="modal fade" id="functionModal" tabindex="-1" aria-labelledby="functionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="functionForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="functionModalLabel">Créer un nouveau
 User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input fields for creating or updating a fournisseur -->
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control form-control-sm" id="nameInput" name="name"
                                    required>
                            </div>
 
                            <div class="mb-3">
                                <label for="adresse" class="form-label ">Email</label>
                                <input type="email" class="form-control form-control-sm" id="emailInput" name="email"
                                    required>
                            </div>
                            <div class="col-6">
                                <label for="adresse" class="form-label ">Password</label>
                                <input type="password" class="form-control form-control-sm" id="passwordInput" name="password"
                                    required>
                            </div>
                            <div class="col-6">
                                <label for="adresse" class="form-label ">Conferm Password</label>
                                <input type="password" class="form-control form-control-sm" id="confpasswordInput" name="comfermpassword"
                                    required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Clients
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#functionModal">Ajouter un utilisateur </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>



        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
@endsection
