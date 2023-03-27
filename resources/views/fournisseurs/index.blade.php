@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="fournisseurModal" tabindex="-1" aria-labelledby="fournisseurModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="fournisseurForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fournisseurModalLabel">Create New Fournisseur</h5>
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
                            <div class="col-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control form-control-sm" id="lnameInput" name="lname"
                                    required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Telephone</label>
                                <input type="text" class="form-control form-control-sm" id="telInput" name="tel"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label ">Address</label>
                                <input type="text" class="form-control form-control-sm" id="addresseInput" name="addresse"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label ">Email</label>
                                <input type="email" class="form-control form-control-sm" id="emailInput" name="email"
                                    required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Fournisseurs
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#fournisseurModal">Ajouter un fournisseur </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Tel</th>
                            <th>Email</th>
                            <th>Addresse</th>
                            <th style="width: 100px">Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($fournisseurs as $fournisseur)
                            <tr>
                                <td>{{ $fournisseur->id }}</td>
                                <td class="name">{{ $fournisseur->name }}</td>
                                <td class="lname">{{ $fournisseur->lname }}</td>
                                <td class="tel">{{ $fournisseur->tel }}</td>
                                <td class="email">{{ $fournisseur->email }}</td>
                                <td class="addresse">{{ $fournisseur->addresse }}</td>
                                <td>
                                    <button class="btn btn-sm text-success" onclick="edit({{ $fournisseur->id }},this)"><i
                                            class="fas fa-edit"></i>
                                        <button class="btn btn-sm text-danger"
                                            onclick="deleteFournisseur({{ $fournisseur->id }},this)"><i
                                                class="fa-solid fa-trash"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const edit = (id, btn) => {
            var name = $(btn).parent().parent().children(".name").html()
            var lname = $(btn).parent().parent().children(".lname").html()
            var tel = $(btn).parent().parent().children(".tel").html()
            var email = $(btn).parent().parent().children(".email").html()
            //var tail = $(btn).parent().parent().children(".tail").html()
            var addresse = $(btn).parent().parent().children(".addresse").html()
            $("#nameInput").val(name);
            $("#lnameInput").val(lname);
            $("#telInput").val(tel);
            $("#emailInput").val(email);
            $("#addresseInput").val(addresse);
            $("#fournisseurModal").modal("show");
            $("#fournisseurForm").append("<input type='hidden' name='id' value='" + id + "'>")
            console.log(id, name);
        }
        const deleteFournisseur = (id, btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            $.get("{{ url('fournisseurs/delete') }}" + "/" + id).then(() => {
                $(btn).parent().parent().remove()
            }).always(function(data) {
                alert(data.message);
            });
        }
        $('#fournisseurForm').submit(function(e) {
            e.preventDefault(); // prevent the form from submitting normally

            // get the form data
            var formData = $(this).serialize();

            // display a loading indicator
            $('.modal-footer button[type="submit"]').html(
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...'
            ).attr('disabled', true);

            // send the AJAX request
            $.ajax({
                type: 'POST',
                url: '{{ route('fournisseurs.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    alert(response.message);
                    $('#fournisseurModal').modal('hide');

                    // reset the form fields
                    $('#fournisseurForm input, #fournisseurForm select').val('');

                    // reload the page to show the updated data
                    location.reload();
                },
                error: function(response) {
                    // display an error message and re-enable the submit button
                    alert('Error: ' + response.responseJSON.message);
                    $('.modal-footer button[type="submit"]').html('Save changes').attr('disabled',
                        false);
                }
            });
        });
    </script>
@endsection
