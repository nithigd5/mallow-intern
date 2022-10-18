@extends('layouts.app')

@section('title', 'Register')

@section('content')

    <div class="container">
        <h2 class="title">Register Form</h2>

        <form action="/register" id="register-form" class="form" method="post" enctype="multipart/form-data">

            @csrf

            <fieldset class="form-group">

                <div class="form-field">
                    <label class="input-title" for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-input" Minlength="3"
                           Maxlength="100"
                           required>
                    <label class="error"></label>
                </div>

                <div class="form-field">
                    <label class="input-title" for="gender">Gender </label>
                    <select class="form-input" name="gender" id="gender" required>
                        <option selected disabled>Select your Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="secret">Secret</option>
                    </select>
                    <label class="error"></label>
                </div>

            </fieldset>

            <fieldset class="form-group">

                <div class="form-field">
                    <label class="input-title" for="mobile">Mobile</label>
                    <input type="tel" name="mobile" pattern="^((\+91)?|91)?[6789][0-9]{9}" placeholder="Mobile"
                           data-parsley-type="digits" class="form-input" id="mobile"
                           required>
                    <label class="error"></label>
                </div>

                <div class="form-field">
                    <label class="input-title" for="dob">Date Of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-input" required>
                    <label class="error"></label>
                </div>

            </fieldset>

            <div class="form-field">
                <label class="input-title" for="address">Address</label>
                <textarea Minlength="10" name="address" id="address" placeholder="Address" class="form-input"
                          rows="4" required></textarea>
                <label class="error"></label>
            </div>

            <div class="form-field">
                <label class="input-title" for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email"
                       class="form-input" required>
                <label class="error"></label>
            </div>

            <fieldset class="form-group">
                <div class="form-field form-image">
                    <label class="input-title" for="profile">
                        <img src="{{Vite::asset('resources/images/character_icons_4.png')}}"
                             alt="Your Profile Picture here" class="img"
                             id="profile-preview">
                    </label>
                    <input type="file" accept="image/*" name="profile" id="profile" class="form-input" required>
                    <label class="error"></label>
                </div>

            </fieldset>

            <fieldset class="form-section">

                <h3 class="form-section-h">Please Enter your marks:</h3>

                <fieldset class="form-group">

                    <div class="form-field">
                        <label class="input-title" for="mark1">Mark in Subject 1</label>
                        <input type="number" min="0" max="100" name="mark1" placeholder="Subject 1 Mark"
                               class="form-input"
                               id="mark1" data-parsley-type="number" required>
                        <label class="error"></label>
                    </div>

                    <div class="form-field">
                        <label class="input-title" for="mark2">Mark in Subject 2</label>
                        <input type="number" min="0" max="100" name="mark2" placeholder="Subject 2 Mark"
                               class="form-input"
                               id="mark2" data-parsley-type="number" required>
                        <label class="error"></label>
                    </div>

                </fieldset>

                <fieldset class="form-group">

                    <div class="form-field">
                        <label class="input-title" for="mark3">Mark in Subject 3</label>
                        <input type="number" min="0" max="100" name="mark3" placeholder="Subject 3 Mark"
                               class="form-input"
                               id="mark3" data-parsley-type="number" required>
                        <label class="error"></label>
                    </div>

                    <div class="form-field">
                        <label class="input-title" for="mark4">Mark in Subject 4</label>
                        <input type="number" min="0" max="100" name="mark4" placeholder="Subject 4 Mark"
                               class="form-input"
                               id="mark4" data-parsley-type="number" required>
                        <label class="error"></label>
                    </div>

                </fieldset>

                <fieldset class="form-group">
                    <div class="form-field">
                        <label class="input-title" for="mark5">Mark in Subject 5</label>
                        <input type="number" min="0" max="100" name="mark5" placeholder="Subject 5 Mark"
                               class="form-input"
                               id="mark5" data-parsley-type="number" required>
                        <label class="error"></label>
                    </div>
                </fieldset>

            </fieldset>

            <input type="button" id="submit-form" class="sbtn" value="submit">

        </form>
    </div>

@endsection
