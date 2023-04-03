@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="clientForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientModalLabel">Créer un nouveau
 Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input fields for creating or updating a client -->
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
                                <label for="function_id" class="form-label">Function</label>
                                <select class="form-control form-control-sm" id="function_idInput" name="function_id"
                                    required>
                                    <!-- Options for selecting a function -->
                                    @foreach ($functions as $function)
                                        <option value="{{ $function->id }}">{{ $function->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Telephone</label>
                                <input type="text" class="form-control form-control-sm" id="telInput" name="tel"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label ">Address</label>
                                <input type="text" class="form-control form-control-sm" id="adresseInput" name="adresse"
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
            Clients
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#clientModal">Ajouter un client </button>
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
                            <th>Fonction</th>
                            <th>Addresse</th>
                            <th style="width: 100px">Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td class="name">{{ $client->name }}</td>
                                <td class="lname">{{ $client->lname }}</td>
                                <td class="tel">{{ $client->tele }}</td>
                                <td class="functionName">{{ $client->function->name }}</td>
                                <td class="adresse">{{ $client->adresse }}</td>
                                <td>
                                    <button class="btn btn-sm text-success" onclick="edit({{ $client->id }},this)"><i
                                            class="fas fa-edit"></i>
                                        <button class="btn btn-sm text-danger"
                                            onclick="deleteClient({{ $client->id }},this)"><i
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
        var myModalEl = document.getElementById('clientModal')
        myModalEl.addEventListener('hide.bs.modal', function(event) {
            $("#hiddenId").remove();
            $('#clientForm').trigger("reset");
        })
        const edit = (id, btn) => {
            var name = $(btn).parent().parent().children(".name").html()
            var lname = $(btn).parent().parent().children(".lname").html()
            var tel = $(btn).parent().parent().children(".tel").html()
            var functionName = $(btn).parent().parent().children(".functionName").html()
            var tail = $(btn).parent().parent().children(".tail").html()
            var adresse = $(btn).parent().parent().children(".adresse").html()
            $("#nameInput").val(name);
            $("#lnameInput").val(lname);
            $("#telInput").val(tel);
            $("#function_idInput").find("option:contains('" + functionName + "')").prop("selected", true);
            $("#adresseInput").val(adresse);
            $("#clientModal").modal("show");
            $("#clientForm").append("<input id='hiddenId' type='hidden' name='id' value='" + id + "'>")
            console.log(id, name);
        }
        const deleteClient = (id, btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            $.get("{{ url('clients/delete') }}" + "/" + id).then(() => {
                $(btn).parent().parent().remove()
            }).always(function(data) {
                alert(data.message);
            });
        }
        $('#clientForm').submit(function(e) {
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
                url: '{{ route('clients.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    alert(response.message);
                    $('#clientModal').modal('hide');

                    // reset the form fields
                    $('#clientForm input, #clientForm select').val('');

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
