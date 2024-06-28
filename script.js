$(document).ready(function () {
    function getData() {
        console.log("Fetching data...");
        $.ajax({
            url: "https://jsonplaceholder.typicode.com/posts",
            type: "GET",
            // dataType:"json",
            success: function (data) {
                console.log("Data received:", data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Error fetching data:", textStatus, errorThrown);
            }
        });
    }

    function loadData() {
        $.ajax({
            type: "GET",
            url: "ajax-load.php",
            dataType: "json",
            success: function (response) {
                console.log(response);
                let html = "";
                response.map((row) => {
                    html += `<tr>
                        <td>${row.sname}</td>
                        <td>${row.sphone}</td>
                        <td>${row.saddress}</td>
                        <td><button id="delBtn" data-id='${row.sid}' class="btn btn-danger">Delete</button></td>
                        <td><button id="updateBtn" data-id='${row.sid}' class="btn btn-secondary">Update</button></td>
                    </tr>`;
                });

                $("#tbody").html(html);
            }
        });
    }

    $("#load-btn").on("click", function (e) {
        loadData();
    });

    // Add new
    $("#add-btn").click((e) => {
        e.preventDefault();
        let name = $(".name").val();
        let number = $(".number").val();
        let location = $(".location").val();
        let update = $("#updateVal").val();

        if (name == "") {
            return alert("Enter something");
        }

        let data = {
            name,
            number,
            location,
            update
        };

        $.ajax({
            type: "POST",
            url: "add-new.php",
            data: data,
            success: function (res) {
                if (res == 1) {
                    console.log(res);
                    loadData();
                    $("#inpform").trigger("reset");
                } else {
                    alert("Cannot save record");
                }
            }
        });
        console.log(data);
    });

    // Delete
    $(document).on("click", "#delBtn", function (e) {
        let stId = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "add-new.php",
            data: { delId: stId },
            success: function (e) {
                console.log(e);
                loadData();
            }
        });
    });

    // Update
    $(document).on("click", "#updateBtn", function (e) {
        e.preventDefault();
        let stId = $(this).data("id");

        // Assuming the data is in the same row as the button
        let row = $(this).closest("tr");
        let name = row.find("td:nth-child(1)").text();
        let number = row.find("td:nth-child(2)").text();
        let location = row.find("td:nth-child(3)").text();

        // Set the data to the input fields
        $(".name").val(name);
        $(".number").val(number);
        $(".location").val(location);
        $("#updateVal").val(stId);

        // Log data for debugging
        let data = {
            name,
            number,
            location,
        };
        console.log(data, stId);
    });

    getData();
    loadData();
});
