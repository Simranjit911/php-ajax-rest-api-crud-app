$(document).ready(function () {
    //debaounce
    function debounce(func, delay) {
        let debounceTimer;
        return function (...args) {
            const context = this;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        };
    }
    // get data
    function loadData(searchVal) {
        console.log(searchVal);
        let url = searchVal ? `http://localhost/php-ajax/api/api.php?s=${searchVal}` : "http://localhost/php-ajax/api/api.php";
    
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                console.log(response);
                let html = "";
                if (response.length > 0) {
                    response.map((row) => {
                        html += `<tr>
                            <td>${row.sname}</td>
                            <td>${row.sphone}</td>
                            <td>${row.saddress}</td>
                            <td><button id="delBtn" data-id='${row.sid}' class="btn btn-danger">Delete</button></td>
                            <td><button id="updateBtn" data-id='${row.sid}' class="btn btn-secondary">Update</button></td>
                        </tr>`;
                    });
                } else {
                    html = "<tr><td colspan='5'>No results found</td></tr>";
                }
    
                $("#tbody").html(html);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Error fetching data:", textStatus, errorThrown);
                $("#tbody").html("<tr><td colspan='5'>Error fetching data</td></tr>");
            }
        });
    }
    

    $("#load-btn").on("click", function (e) {
        loadData();
    });

    // Add new data
    $("#add-btn").click((e) => {
        e.preventDefault();
        let name = $(".name").val();
        let number = $(".number").val();
        let location = $(".location").val();
        let update = $("#updateVal").val();

        if (name == "" || number == "") {
            return alert("Enter something");
        }

        let data = {
            name,
            number,
            location
        };
        if (update == "0") {

            $.ajax({
                type: "POST",
                url: "http://localhost/php-ajax/api/api.php",
                data: JSON.stringify(data),
                success: function (res) {

                    console.log(res);
                    loadData();
                    $("#inpform").trigger("reset");
                }
            });
        } else {

            data.update = update
            $.ajax({
                type: "PUT",
                url: "http://localhost/php-ajax/api/api.php",
                data: JSON.stringify(data),
                success: function (res) {
                    console.log(res);
                    loadData();
                    $("#inpform").trigger("reset");

                }
            });
        }


        console.log(data);
    });

    // Delete
    $(document).on("click", "#delBtn", function (e) {
        let stId = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: `http://localhost/php-ajax/api/api.php?id=${stId}`,
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
    const debouncedLoadData = debounce(loadData, 300);
    //search
    $("#search").on("input", function (e) {
        let val = $(this).val()
        console.log(val)
        debouncedLoadData(val,1000);


    })


    loadData();
});
