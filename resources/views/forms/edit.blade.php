@include('layout.navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .navbar-dark {
            background-color: #242424;
        }

        .navbar-brand,
        .nav-link {
            color: #fff;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #f8f9fa;
        }

        .container {
            max-width: 900px;
            margin-top: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .form-container {
            background-color: #1e1e1e;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .form-label {
            color: #e0e0e0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            margin-top: 20px;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            margin-top: 20px;
        }

        .form-control,
        .form-select {
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
        }

        .form-check-input {
            background-color: #333;
            border: 1px solid #555;
        }

        .form-check-label {
            color: #e0e0e0;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .file-upload {
            margin-top: 15px;
        }

        .file-preview img {
            height: auto;
            max-width: 150px;
            max-height: 150px;
            border-radius: 5px;
            object-fit: contain;
            border: 1px solid #555;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="container">
        <h1>Edit Form</h1>

        <!-- Form Container -->
        <div class="form-container">
            <form id="formData" enctype="multipart/form-data">
                @csrf

                <!-- Hidden ID Field -->
                <input type="hidden" id="formId" value="{{ $form->id }}">

                <!-- Name Input -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $form->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $form->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Country Dropdown -->
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select id="country" name="country" class="form-select @error('country') is-invalid @enderror"
                        required>
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ old('country', $form->country_id) == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- State Dropdown -->
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <select id="state" name="state" class="form-select @error('state') is-invalid @enderror"
                        required>
                        <option value="">Select State</option>
                    </select>
                    @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- City Dropdown -->
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <select id="city" name="city" class="form-select @error('city') is-invalid @enderror"
                        required>
                        <option value="">Select City</option>
                    </select>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Checkbox -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms"
                        name="terms" {{ old('terms', $form->terms) ? 'checked' : '' }}>
                    <label for="terms" class="form-check-label">I agree to the terms and conditions</label>
                    @error('terms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Radio Buttons -->
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                            id="male" name="gender" value="male"
                            {{ old('gender', $form->gender) == 'male' ? 'checked' : '' }}>
                        <label for="male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                            id="female" name="gender" value="female"
                            {{ old('gender', $form->gender) == 'female' ? 'checked' : '' }}>
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date Picker -->
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                        id="birthdate" name="birthdate" value="{{ old('birthdate', $form->birthdate) }}" required>
                    @error('birthdate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- File Upload -->
                <div class="mb-3 file-upload">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                        name="file">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <!-- File Preview -->
                    <div id="filePreview" class="file-preview mt-3">
                        @if ($form->file)
                            <img src="{{ asset('profile_pictures/' . $form->file) }}" alt="File Preview">
                        @endif
                    </div>
                    <!-- Dynamic File Preview -->
                    <div class="file-preview mt-3" id="filePreview"></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
                {{-- <button type="button" id="deleteButton" class="btn btn-danger">Delete</button> --}}
            </form>
        </div>

        <!-- Response Message -->
        <div id="responseMessage"></div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for dynamic dropdowns and AJAX form submission -->
    <script>
        $(document).ready(function() {
            // Load states based on country selection
            $('#country').change(function() {
                let countryId = $(this).val();
                $('#state').empty().append('<option value="">Select State</option>');
                $('#city').empty().append('<option value="">Select City</option>');

                if (countryId) {
                    $.ajax({
                        url: '/states/' + countryId,
                        method: 'GET',
                        success: function(data) {
                            $('#state').append('<option value="">Select State</option>');
                            data.states.forEach(state => {
                                $('#state').append('<option value="' + state.id + '">' +
                                    state.name + '</option>');
                            });
                            // Set selected state value
                            $('#state').val('{{ old('state', $form->state_id) }}');
                            $('#state').trigger('change'); // Trigger change to load cities
                        }
                    });
                }
            });

            // Load cities based on state selection
            $('#state').change(function() {
                let stateId = $(this).val();
                $('#city').empty().append('<option value="">Select City</option>');

                if (stateId) {
                    $.ajax({
                        url: '/cities/' + stateId,
                        method: 'GET',
                        success: function(data) {
                            $('#city').append('<option value="">Select City</option>');
                            data.cities.forEach(city => {
                                $('#city').append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });
                            // Set selected city value
                            $('#city').val('{{ old('city', $form->city_id) }}');
                        }
                    });
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#formData').submit(function(event) {
                event.preventDefault();

                let formData = new FormData(this);
                console.log('formData ', formData);
                let id = $('#formId').val();

                $.ajax({
                    url: '/forms/' + id,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#responseMessage').html(
                            '<div class="alert alert-success">Form updated successfully!</div>'
                        );
                        setTimeout(function() {
                            window.location.href = '/';
                        }, 2000);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<div class="alert alert-danger">';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p>' + value[0] + '</p>';
                        });
                        errorHtml += '</div>';
                        $('#responseMessage').html(errorHtml);
                    }
                });
            });

            // File preview
            $('#file').change(function(event) {
                let file = event.target.files[0];
                let filePreview = $('#filePreview');

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        filePreview.html('<img src="' + e.target.result + '" alt="File Preview">');
                    };
                    reader.readAsDataURL(file);
                } else {
                    filePreview.empty();
                }
            });

            // Trigger initial state and city loading
            $('#country').trigger('change');
        });
    </script>
</body>

</html>
