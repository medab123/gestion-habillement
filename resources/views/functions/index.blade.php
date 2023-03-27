@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="functionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="functionForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="functionModalLabel">Create New Fournisseur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input fields for creating or updating a function -->
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameInput" name="name" required>
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
            Fournisseurs
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#userModal">Ajouter un function </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th style="width: 100px">Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($functions as $function)
                            <tr>
                                <td>{{ $function->id }}</td>
                                <td class="name">{{ $function->name }}</td>
                                <td>
                                    <button class="btn btn-sm text-success" onclick="edit({{ $function->id }},this)"><i
                                            class="fas fa-edit"></i>
                                        <button class="btn btn-sm text-danger" onclick="deleteFunction({{ $function->id }},this)"><i class="fa-solid fa-trash"></i>
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
            $("#nameInput").val(name);
            $("#functionModal").modal("show");
            $("#functionForm").append("<input type='hidden' name='id' value='" + id + "'>")
            console.log(id, name);
        }
        const deleteFunction = (id,btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);
            
            $.get("{{ url('functions/delete') }}"+"/"+id).then((data)=>{
                $(btn).parent().parent().remove();
                alert(data.message);
            }).always(function(data) {
                alert(data.message);
            });
        }
        $('#functionForm').submit(function(e) {
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
                url: '{{ route('functions.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    //alert(response.message);
                    $('#functionModal').modal('hide');

                    // reset the form fields
                    $('#functionForm input, #functionForm select').val('');

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
