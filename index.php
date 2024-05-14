<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forcast Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .date-div,
        .temperature-div,
        .location-div {
            background-color: #f8f9fa;
        }

        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #location {
            border-radius: 5px;
        }

        #submit-form {
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="forcast-form" name="forcast-form">
                    <div class="form-control">
                        <label for="location" class="form-label">Location</label>
                        <input type="search" name="location" class="form-control" id="location" placeholder="Search Location">
                        <input type="hidden" name="submit" value="submit">
                        <div class="loading"></div>
                        <button type="submit" id="submit-form" class="btn btn-primary mt-3">Search</button>
                </form>

            </div>
        </div>
    </div>



    <div class="container mt-5">



        <div id="replace-all">
            <div class="row mx-auto">
                <div class="col-md-4 card date-div mb-5 p-2 text-center">
                    <h5>Current Day, Date & Time</h5>
                    <p>NA</p>
                </div>

                <div class="col-md-4 card temperat mb-5 p-2 text-center temperature-div">
                    <h5>Temperature</h5>
                    <p>NA</p>
                </div>

                <div class="col-md-4 card mb-5 p-2 text-center location-div">
                    <h5>Location</h4>
                        <p>NA</p>
                </div>
            </div>

            <div class="row mx-auto">
                <div class="col-md-2 card p-3 mb-5 text-center">
                    <h4>Day 1</h4>
                    <p>NA</p>
                </div>

                <div class="col-md-2 card p-3 mb-5 text-center">
                    <h4>Day 2</h4>
                    <p>NA</p>
                </div>

                <div class="col-md-2 card p-3 mb-5 text-center">
                    <h4>Day 3</h4>
                    <p>NA</p>
                </div>

                <div class="col-md-2 card p-3 mb-5 text-center">
                    <h4>Day 4</h4>
                    <p>NA</p>
                </div>

                <div class="col-md-2 card p-3 mb-5 text-center">
                    <h4>Day 5</h4>
                    <p>NA</p>
                </div>

                <div class="col-md-2 card p-3 mb-5 text-center">
                    <h4>Day 6</h4>
                    <p>NA</p>
                </div>

                <div class="col-md-2 card p-3 mb-5 text-center">
                    <h4>Day 7</h4>
                    <p>NA</p>
                </div>
            </div>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>


    <script>
        $(document).ready(function() {

            $('#forcast-form').validate({
                rules: {
                    location: {
                        required: true,
                        minlength: 2,
                    }
                },
                messages: {
                    location: {
                        required: "Please Enter Location",
                        minlength: "Please enter at least 2 characters.",
                    }
                },
                submitHandler(form) {
                    $.ajax({
                        url: 'api.php',
                        type: 'POST',
                        data: $(form).serialize(),
                        beforeSend() {
                            $(".loading").html('<p class="text-warning mt-3">Searching <i class="fa fa-spinner fa-spin"></i> </p>').show();
                        },
                        success(response) {
                            $("#replace-all").html(response);
                            $(".loading").hide();
                        },
                        error(xhr, status, error) {
                            alert('Something Went Wrong');
                            $(".loading").hide();
                        }
                    });
                    return false;
                }
            });
        });
    </script>
</body>

</html>