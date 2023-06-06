@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="clientForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientModalLabel">modifier Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input fields for creating or updating a client -->
                        @csrf
                        <input type="hidden" name="id" value="{{ $client->id }}">
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control form-control-sm" id="nameInput" name="name"
                                    value="{{ $client->name }}" required>
                            </div>
                            <div class="col-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control form-control-sm" id="lnameInput" name="lname"
                                    value="{{ $client->lname }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="function_id" class="form-label">Function</label>
                                <select class="form-control form-control-sm" id="function_idInput" name="function_id"
                                    required>
                                    <!-- Options for selecting a function -->
                                    @foreach ($functions as $function)
                                        <option value="{{ $function->id }}"
                                            {{ $client->function_id == $function->id ? 'selected' : '' }}>
                                            {{ $function->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Telephone</label>
                                <input type="text" class="form-control form-control-sm" id="telInput" name="tel"
                                    value="{{ $client->tele }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label ">Address</label>
                                <input type="text" class="form-control form-control-sm" id="adresseInput" name="adresse"
                                    value="{{ $client->adresse }}" required>
                            </div>


                        </div>
                        <div class="col-12 mb-2">Les Tailles</div>

                        <div class="row border border-primary rounded py-2">
                            <div class="col-4">
                                <label for="taille_pontallon" class="form-label">Pontallon</label>
                                <input type="text" class="form-control form-control-sm" id="taille_pontallonInput"
                                    name="taille_pontallon" value="{{ $client->taille_pontallon }}" required>
                            </div>
                            <div class="col-4">
                                <label for="taille_costume" class="form-label">Costume</label>
                                <input type="text" class="form-control form-control-sm" id="taille_costumeInput"
                                    name="taille_costume" value="{{ $client->taille_costume }}" required>
                            </div>
                            <div class="col-4">
                                <label for="taille_chemise" class="form-label">Chemise</label>
                                <input type="text" class="form-control form-control-sm" id="taille_chemiseInput"
                                    name="taille_chemise" value="{{ $client->taille_chemise }}" required>
                            </div>
                            <div class="col-4">
                                <label for="taille_tshurt" class="form-label">T-shurt</label>
                                <input type="text" class="form-control form-control-sm" id="taille_tshurtInput"
                                    name="taille_tshurt" value="{{ $client->taille_tshurt }}" required>
                            </div>
                            <div class="col-4">
                                <label for="taille_ceinture" class="form-label">Ceinture</label>
                                <input type="text" class="form-control form-control-sm" id="taille_ceintureInput"
                                    name="taille_ceinture" value="{{ $client->taille_ceinture }}" required>
                            </div>
                            <div class="col-4">
                                <label for="taille_chausseur" class="form-label">Chausseur</label>
                                <input type="text" class="form-control form-control-sm" id="taille_chausseurInput"
                                    name="taille_chausseur" value="{{ $client->taille_chausseur }}" required>
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
                data-bs-target="#clientModal">Modifier </button>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($client->toArray() as $key => $value)
                @if($key=="function_id")@continue @endif

                    <div class="col-6 {{ $key }}">{{ $key }}</div>

                        <div class="col-6">@if ($key != 'function'){{ $value }}@else {{$value["name"]}} @endif @if (str_starts_with($key, 'taille')&& !empty($value) )
                                CM
                            @endif
                        </div>

                    <hr>
                @endforeach
            </div>


        </div>
    </div>
    <script>
        var myModalEl = document.getElementById('clientModal')
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
    </script>
@endsection
