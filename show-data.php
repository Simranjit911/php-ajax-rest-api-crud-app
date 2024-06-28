<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="text-center bg-primary p-2 text-light">

        <h1 >Ajax CRUD PHP</h1>
        <div class="text-center bg-primary p-2 text-light">

            <a class="text-center text-light m-2 w-full" href="show-data.php">Without API </a>
            <a class="text-center text-light m-2 w-full" href="show-data-with-api.html">With API </a>
        </div>
    </div>
    <div class="container d-flex justify-content-center flex-column">
        <form id="inpform" class="d-flex p-2 bg-secondary justify-content-center">
            <input type="text" class="input name" placeholder="Enter Name" required>
            <input type="number" class="input number" placeholder="Enter Phone" required>
            <input type="text" class="input location" placeholder="Enter Location" required>
            <input type="text" hidden value="0" id="updateVal" />
            <input type="submit" class="btn text-center btn-success" id="add-btn" />
        </form>
        <button class="btn text-center btn-success" id="load-btn">Load Data</button>
        <table class="table table-striped text-center my-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
    <script src="script.js">

    </script>
</body>

</html>