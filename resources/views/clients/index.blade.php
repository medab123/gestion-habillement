@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="clientForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientModalLabel">Create New Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input fields for creating or updating a client -->
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" required>
                        </div>
                        <div class="mb-3">
                            <label for="function_id" class="form-label">Function</label>
                            <select class="form-control" id="function_id" name="function_id" required>
                                <!-- Options for selecting a function -->
                                @foreach ($functions as $function)
                                    <option value="{{ $function->id }}">{{ $function->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Address</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
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
                data-bs-target="#clientModal">Ajouter un client </button>
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
    <script>
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
