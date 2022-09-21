<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Form Project</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <br>
        <div class="container">
            <form method="post" action="#" class="row-g3">

                <div class="row mb-3" id="nameInput">
                    <div class="col-md-6">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname">
                    </div>
                    <div class="col-md-6">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname">
                    </div>
                </div>

                <div class="row mb-3" id="streetAdressInput">
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address">
                    </div>
                </div>

                <div class="row mb-3" id="otherAddressInput">
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city">
                    </div>
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state">
                            <option value="califoria">California</option>
                            <option value="virginia">Virginia</option>
                            <option value="michigan" selected>Michigan</option>
                            <option value="texas">Texas</option>
                            <option value="main">Main</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="zip" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="zip">
                    </div>
                </div>

                <div class="col-12" id="genderInput">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="genderOptions" id="gender1" value="male">
                        <label class="form-check-label" for="gender1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="genderOptions" id="gender2" value="female">
                        <label class="form-check-label" for="gender2">Female</label>
                    </div>
                </div>

                <div class="col-12 pt-3" id="registerInput">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </body>
</html>