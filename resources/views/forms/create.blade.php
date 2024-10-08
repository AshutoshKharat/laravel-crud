@include('layout.navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Form</title>
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

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="container">
        <h1>Create New Form</h1>

        <!-- Form Container -->
        <div class="form-container">
            <form id="formData" enctype="multipart/form-data">
                @csrf

                <!-- Name Input -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required>
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
                            <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>
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
                        name="terms" {{ old('terms') ? 'checked' : '' }} required>
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
                            {{ old('gender') == 'male' ? 'checked' : '' }}>
                        <label for="male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                            id="female" name="gender" value="female"
                            {{ old('gender') == 'female' ? 'checked' : '' }}>
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date Picker -->
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate"
                        name="birthdate" value="{{ old('birthdate') }}" required>
                    @error('birthdate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- File Upload -->
                <div class="mb-3 file-upload">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                        name="file" required>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div id="responseMessage" class="mt-3"></div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for dynamic dropdowns and AJAX form submission -->
    <script>
        $(document).ready(function() {
            // Load states based on country selection
            $('#country').change(function() {
                let countryId = $(this).val();
                console.log('countryId ', countryId);
                $('#state').empty().append('<option value="">Select State</option>');
                $('#city').empty().append('<option value="">Select City</option>');

                if (countryId) {
                    $.ajax({
                        url: '/states/' + countryId,
                        method: 'GET',
                        success: function(data) {
                            data.states.forEach(state => {
                                $('#state').append('<option value="' + state.id + '">' +
                                    state.name + '</option>');
                            });
                        }
                    });
                }
            });

            // Load cities based on state selection
            $('#state').change(function() {
                let stateId = $(this).val();
                console.log('stateId ', stateId);
                $('#city').empty().append('<option value="">Select City</option>');

                if (stateId) {
                    $.ajax({
                        url: '/cities/' + stateId,
                        method: 'GET',
                        success: function(data) {
                            data.cities.forEach(city => {
                                $('#city').append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });
                        }
                    });
                }
            });

            // Handle form submission via AJAX
            $('#formData').validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    country: "required",
                    state: "required",
                    city: "required",
                    fileUpload: "required"
                },
                messages: {
                    name: "Please enter your name",
                    email: "Please enter a valid email address",
                    country: "Please select a country",
                    state: "Please select a state",
                    city: "Please select a city",
                    fileUpload: "Please upload a file"
                },
                submitHandler: function(form) {
                    let formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('forms.store') }}',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#responseMessage').html(
                                '<div class="alert alert-success">Form submitted successfully!</div>'
                            );
                            $('#formData')[0].reset(); // Clear form
                            $('#state').empty().append(
                                '<option value="">Select State</option>');
                            $('#city').empty().append(
                                '<option value="">Select City</option>');
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
                }
            });
        });
    </script>
</body>

</html>
