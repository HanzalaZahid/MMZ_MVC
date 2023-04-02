<?php 
view('partials', 'head');
view('partials', 'header');
?>
<body class="transactions">
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Projects</h2>
            <div class="options">
                <a href="/add-withdrawal">Add Cash Transaction</a>
                <a href="/add-transfer">Add Online Transaction</a>
            </div>
        </div>
        <table class="list Transaction_list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Beneficiary</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Details</th>
                    <th>Project</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>May 28, 2022</td>
                    <td>100000</td>
                    <td>Ammer Hamza</td>
                    <td>Cash</td>
                    <td>Purchase</td>
                    <td>3x Steel Pipes</td>
                    <td>NDURE Rahim Yar Khan</td>
                    <td>
                        <a href="/delete-transaction" class="danger">Delete</a>
                        <a href="/transaction" class="secondary">Show</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
        $('table.list').DataTable();
        });
    </script>
</body>
</html>