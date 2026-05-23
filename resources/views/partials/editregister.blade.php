<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Runner</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #eaf5ea;
            padding: 25px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        h2 {
            color: #1b5e20;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .full {
            grid-column: span 2;
        }

        label {
            font-size: 13px;
            color: #1b4332;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 2px solid #a5d6a7;
            border-radius: 8px;
            outline: none;
        }

        input:focus, select:focus {
            border-color: #2e7d32;
        }

        .btn {
            width: 100%;
            background: #2e7d32;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: 0.2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background: #1b5e20;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #495057;
        }

        .btn-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: span 1;
            }

            .btn-group {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Edit Runner</h2>

    <form action="{{ route('partials.update', $registration->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div style="background:#d4edda;color:#155724;padding:10px;border-radius:8px;margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Name -->
        <div>
            <label>Name</label>
            <input type="text"
                   name="full_name"
                   value="{{ old('full_name', $registration->full_name) }}"
                   oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                   required>
        </div>

        <!-- Age -->
        <div>
            <label>Age</label>
            <input type="number"
                   name="age"
                   value="{{ old('age', $registration->age) }}"
                   min="1"
                   max="120"
                   required>
        </div>

        <!-- Gender -->
        <div>
            <label>Gender</label>
            <select name="gender" required>
                <option value="">Select gender</option>
                <option value="Male" {{ old('gender', $registration->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $registration->gender) == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <!-- Phone -->
        <div>
            <label>Phone</label>
            <input type="text"
                   name="phone"
                   value="{{ old('phone', $registration->phone) }}"
                   inputmode="numeric"
                   pattern="\d{11}"
                   minlength="11"
                   maxlength="11"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                   title="Phone must be exactly 11 digits"
                   required>
        </div>

        <!-- Email -->
        <div class="full">
            <label>Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $registration->email) }}"
                   required>
        </div>

        <!-- Address -->
        <div class="full">
            <label>Address</label>
            <input type="text"
                   name="address"
                   value="{{ old('address', $registration->address) }}"
                   required>
        </div>

        <!-- Registration Date -->
        <div>
            <label>Registration Date</label>
            <input type="date"
                   name="registration_date"
                   value="{{ old('registration_date', $registration->registration_date) }}"
                   required>
        </div>

        <!-- Category -->
        <div>
            <label>Category</label>
            <select name="marathon_category" required>
                <option value="">Select category</option>
                <option value="3K" {{ old('marathon_category', $registration->marathon_category) == '3K' ? 'selected' : '' }}>3K</option>
                <option value="5K" {{ old('marathon_category', $registration->marathon_category) == '5K' ? 'selected' : '' }}>5K</option>
                <option value="10K" {{ old('marathon_category', $registration->marathon_category) == '10K' ? 'selected' : '' }}>10K</option>
                <option value="21K" {{ old('marathon_category', $registration->marathon_category) == '21K' ? 'selected' : '' }}>21K</option>
            </select>
        </div>

        <!-- Emergency Name -->
        <div>
            <label>Emergency Contact Name</label>
            <input type="text"
                   name="emergency_contact_name"
                   value="{{ old('emergency_contact_name', $registration->emergency_contact_name) }}"
                   oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                   required>
        </div>

        <!-- Emergency Phone -->
        <div>
            <label>Emergency Contact Phone</label>
            <input type="text"
                   name="emergency_contact_phone"
                   value="{{ old('emergency_contact_phone', $registration->emergency_contact_phone) }}"
                   inputmode="numeric"
                   pattern="\d{11}"
                   minlength="11"
                   maxlength="11"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                   title="Emergency number must be exactly 11 digits"
                   required>
        </div>

        <!-- Level -->
        <div>
            <label>Level</label>
            <select name="experience_level" required>
                <option value="">Select level</option>
                <option value="Beginner" {{ old('experience_level', $registration->experience_level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="Intermediate" {{ old('experience_level', $registration->experience_level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                <option value="Advanced" {{ old('experience_level', $registration->experience_level) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
            </select>
        </div>

        <!-- Shirt -->
        <div>
            <label>Shirt Size</label>
            <select name="shirt_size" required>
                <option value="">Select shirt size</option>
                <option value="XS" {{ old('shirt_size', $registration->shirt_size) == 'XS' ? 'selected' : '' }}>XS</option>
                <option value="S" {{ old('shirt_size', $registration->shirt_size) == 'S' ? 'selected' : '' }}>S</option>
                <option value="M" {{ old('shirt_size', $registration->shirt_size) == 'M' ? 'selected' : '' }}>M</option>
                <option value="L" {{ old('shirt_size', $registration->shirt_size) == 'L' ? 'selected' : '' }}>L</option>
                <option value="XL" {{ old('shirt_size', $registration->shirt_size) == 'XL' ? 'selected' : '' }}>XL</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="full btn-group">
            <a href="{{ route('partials.index') }}" class="btn btn-secondary">Back to List</a>
            <button type="submit" class="btn">Update Runner</button>
        </div>

    </form>

</div>

</body>
</html>