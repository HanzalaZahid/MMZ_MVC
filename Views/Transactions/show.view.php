<?php
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Transaction</h2>
            <div class="options">
                <a href="/edit-transaction">Edit Transaction</a>
            </div>
        </div>
        <div class="details_container">
            <div class="details_group">
                <label for="account_used">Account Used</label>
                <span>Mirza Muhammad Zahid HBL-0755</span>
            </div>
            <div class="details_group">
                <label for="date">Date</label>
                <span>May 28, 2020</span>
            </div>
            <div class="details_group">
                <label for="Intermidiate">Intermidiate</label>
                <span>Hanzala Zahid</span>
            </div>
            <div class="details_group">
                <label for="destination">Destination</label>
                <span>Riaz Carpenter</span>
            </div>
            <div class="details_group">
                <label for="amount">Amount</label>
                <span>10000</span>
            </div>
            <div class="details_group">
                <label for="type">Type</label>
                <span>Online</span>
            </div>
            <div class="details_group">
                <label for="project">Project</label>
                <span>NDURE Rahim Yar Khan</span>
            </div>
            <div class="details_group">
                <label for="project">Category</label>
                <span>Transport</span>
            </div>
            <div class="details_group">
                <label for="description">Description</label>
                <span>Sargodha to Rahim Yar Khan</span>
            </div>
            <div class="details_group">
                <label for="bank">Account Title</label>
                <span>Hanzala Zahid</span>
            </div>
            <div class="details_group">
                <label for="account_number">Account Number</label>
                <span>53587000050851</span>
            </div>
        </div>
        <table class="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Cluster</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>May 28, 2022</td>
                    <td>5000</td>
                    <td>5</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>