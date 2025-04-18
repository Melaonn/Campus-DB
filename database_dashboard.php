<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .container {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 200px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            overflow-y: auto;
        }
        .tables {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        .table-btn {
            display: block;
            background-color: #3498db;
            color: #ecf0f1;
            border: none;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            text-align: left;
            transition: background-color 0.3s ease;
        }
        .table-btn:hover {
            background-color: #2980b9;
        }
        .dashboard-header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 15px 0;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin-bottom: 20px;
        }
        .table-wrapper {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }
        .logout-btn {
            display: block;
            background-color: #e74c3c;
            color: #ecf0f1;
            border: none;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }

        .download-btn {
            display: block;
            background-color: #3498db;
            color: #ecf0f1;
            border: none;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .download-btn:hover {
            background-color: #00FF00;
        }
        .add-table-btn {
            background-color: #3498db;
            color: #ecf0f1;
            border: none;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .add-table-btn:hover {
            background-color: #2980b9;
        }
        .insert-form {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .insert-form h3 {
            margin-bottom: 20px;
        }
        .insert-form label {
            display: block;
            margin-bottom: 10px;
        }
        .insert-form input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .insert-form button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .insert-form button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="sidebar">
            <h3 style="margin-bottom: 20px;">My Contents</h3>
            <!-- Static buttons for table names -->
            <button class='table-btn' onclick='showTable("department")'>College Departments</button>
            <button class='table-btn' onclick='showTable("dept_locations")'>Department Location</button>
            <button class='table-btn' onclick='showTable("faculty")'>Faculty Profiles</button>
            <button class='table-btn' onclick='showTable("handles")'>Faculty Positions</button>
            <button class='table-btn' onclick='showTable("subject")'>Academic Subjects</button>
            <!-- Download button -->
            <br>
      
            <h3 style="margin-bottom: 20px;">Add College Data</h3>
         
            <button class="add-table-btn" onclick="showAddDepartmentForm()">Add Department</button>
            <button class="add-table-btn" onclick="showAddDepartmentlocForm()">Add  Department Location</button>
            <button class="add-table-btn" onclick="showAddFacultyForm()">Add Faculty</button>
            <button class="add-table-btn" onclick="showAddHandlesForm()">Add Role </button>
            <button class="add-table-btn" onclick="showAddSubjectForm()">Add Subject </button>
            <button class="download-btn" onclick="downloadTables()">Export Tables as CSV</button>
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>

        <div class="tables" id="tables-container">
            <div class="dashboard-header">
                <h1 style="margin-bottom: 10px;">PA College of Engineering</h1>
                <h2>Administrator Dashboard</h2>
            </div>
            <div class="table-wrapper" id="table-wrapper">
            </div>
            <div class="footer">
                &copy; <?php echo date("Y"); ?> PA College of Engineering
            </div>
        </div>
    </div>
    <script>
        function showTable(tableName) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("table-wrapper").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "get_table.php?table=" + tableName, true);
            xhttp.send();
            console.log("Displaying table: " + tableName);
        }

        function showAddDepartmentForm() {
            var formHTML = `
                <div class="insert-form" style="margin-bottom: 20px;">
                    <h3>Add New Department</h3>
                    <form id="addDepartmentForm" action="insert_department.php" method="POST">
                        <label for="dno">Department Number:</label>
                        <input type="text" id="dno" name="dno" required><br><br>
                        <label for="d_name">Department Name:</label>
                        <input type="text" id="d_name" name="d_name" required><br><br>
                        <label for="hod_id">HOD ID:</label>
                        <input type="text" id="hod_id" name="hod_id" required><br><br>
                        <button type="submit">Add Department</button>
                    </form>
                </div>
            `;
            document.getElementById("tables-container").innerHTML += formHTML;
        }


        function showAddDepartmentlocForm() {
            var formHTML = `
                <div class="insert-form" style="margin-bottom: 20px;">
                    <h3>Add New Department Location</h3>
                    <form id="addDepartmentlocForm" action="insert_departmentloc.php" method="POST">
                        <label for="dno">Department Number:</label>
                        <input type="text" id="dno" name="dno" required><br><br>
                        <label for="dlocation">Department Location:</label>
                        <input type="text" id="dlocation" name="dlocation" required><br><br>
                       
                        <button type="submit">Add Department location</button>
                    </form>
                </div>
            `;
            document.getElementById("tables-container").innerHTML += formHTML;
        }

        function showAddFacultyForm() {
    var formHTML = `
        <div class="insert-form" style="margin-bottom: 20px;">
            <h3>Add New Faculty</h3>
            <form id="addFacultyForm" action="insert_faculty.php" method="POST">
                <label for="FAC_ID">Faculty ID:</label>
                <input type="text" id="FAC_ID" name="FAC_ID" required><br><br>
                <label for="F_NAME">First Name:</label>
                <input type="text" id="F_NAME" name="F_NAME" required><br><br>
                <label for="L_NAME">Last Name:</label>
                <input type="text" id="L_NAME" name="L_NAME" required><br><br>
                <label for="BDATE">Birth Date:</label>
                <input type="text" id="BDATE" name="BDATE" required><br><br>
                <label for="ADDRESS">Address:</label>
                <input type="text" id="ADDRESS" name="ADDRESS" required><br><br>
                <label for="SEX">Sex:</label>
                <input type="text" id="SEX" name="SEX" required><br><br>
                <label for="SALARY">Salary:</label>
                <input type="text" id="SALARY" name="SALARY" required><br><br>
                <label for="HEAD_ID">Head ID:</label>
                <input type="text" id="HEAD_ID" name="HEAD_ID" required><br><br>
                <label for="dno">Department Number:</label>
                <input type="text" id="dno" name="dno" required><br><br>
                <button type="submit">Add Faculty</button>
            </form>
        </div>
    `;
    document.getElementById("tables-container").innerHTML += formHTML;
}

function showAddHandlesForm() {
            var formHTML = `
                <div class="insert-form" style="margin-bottom: 20px;">
                    <h3>Add New Role</h3>
                    <form id="AddHandlesForm" action="insert_role.php" method="POST">
                        <label for="fac_id">Faculty ID:</label>
                        <input type="text" id="fac_id" name="fac_id" required><br><br>
                        <label for="dno">Department Number:</label>
                        <input type="text" id="dno" name="dno" required><br><br>
                        <label for="role">Role:</label>
                        <input type="text" id="role" name="role" required><br><br>
                        <button type="submit">Add Department</button>
                    </form>
                </div>
            `;
            document.getElementById("tables-container").innerHTML += formHTML;
        }

        function showAddSubjectForm() {
    var formHTML = `
        <div class="insert-form" style="margin-bottom: 20px;">
            <h3>Add New Subject</h3>
            <form id="addSubjectForm" action="insert_subject.php" method="POST">
                <label for="sub_code">Subject Code:</label>
                <input type="text" id="sub_code" name="sub_code" required><br><br>
                <label for="fac_id">Faculty ID:</label>
                <input type="text" id="fac_id" name="fac_id" required><br><br>
                <label for="sub_name">Subject Name:</label>
                <input type="text" id="sub_name" name="sub_name" required><br><br>
                <label for="hours">Hours:</label>
                <input type="text" id="hours" name="hours" required><br><br>
                <button type="submit">Add Subject</button>
            </form>
        </div>
    `;
    document.getElementById("tables-container").innerHTML += formHTML;
}




    </script>
     <script>
        function downloadTables() {
            // Fetch tables dynamically and generate CSV content
            var tables = document.querySelectorAll('table');
            var csvContent = "";

            tables.forEach(function(table) {
                var rows = table.querySelectorAll('tr');
                rows.forEach(function(row) {
                    var rowData = [];
                    var cells = row.querySelectorAll('th, td');
                    cells.forEach(function(cell) {
                        rowData.push(cell.textContent.trim());
                    });
                    csvContent += rowData.join(',') + '\n';
                });
                csvContent += '\n';
            });

            // Trigger download
            var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            var link = document.createElement("a");
            if (link.download !== undefined) {
                var url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", "tables.csv");
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
            console.log("Downloading tables...");
        }
    </script>
     <script>
        function logout() {
            // Perform logout actions here
            // For example, redirect to the logout page
            window.location.href = "login.php";
            console.log("Logging out...");
        }
    </script>
</body>
</html>
