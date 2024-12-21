<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Checkout Information</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    h1 { color: #4CAF50; text-align: center; }
                    table { width: 80%; border-collapse: collapse; margin: 20px auto; }
                    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
                    th { background-color: #4CAF50; color: white; }
                    tr:nth-child(even) { background-color: #f2f2f2; }
                    .filter-section { text-align: center; margin-bottom: 20px; }
                    select { padding: 6px 12px; }
                </style>
                <script>
                    function filterTable() {
                        var select = document.getElementById("eventType");
                        var selectedValue = select.value;
                        var rows = document.querySelectorAll("table tbody tr");

                        rows.forEach(function(row) {
                            var cell = row.cells[2]; // Assuming the event type is in the third column
                            if (selectedValue === "" || cell.textContent === selectedValue) {
                                row.style.display = ""; // Show row
                            } else {
                                row.style.display = "none"; // Hide row
                            }
                        });
                    }
                </script>
            </head>
            <body>
                <h1>Checkout Information</h1>

                <div class="filter-section">
                    <label for="eventType">Select Event Type:</label>
                    <select name="eventType" id="eventType" onchange="filterTable()">
                        <option value="">All</option>
                        <option value="concert">Concert</option>
                        <option value="cinema">Cinema</option>
                        <option value="theatre">Theatre</option>
                    </select>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Event Type</th>
                            <th>Event Name</th>
                            <th>Quantity</th>
                            <th>Price (MUR)</th>
                            <th>Total Price (MUR)</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="checkoutList/checkout">
                            <xsl:variable name="totalPrice" select="number(quantity) * number(price)"/>
                            <tr>
                                <td><xsl:value-of select="name"/></td>
                                <td><xsl:value-of select="email"/></td>
                                <td><xsl:value-of select="type"/></td>
                                <td><xsl:value-of select="events"/></td>
                                <td><xsl:value-of select="quantity"/></td>
                                <td><xsl:value-of select="price"/></td>
                                <td>
                                    <xsl:value-of select="$totalPrice"/>
                                </td>
                                <td><xsl:value-of select="paymentMethod"/></td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>

                <h2 style="text-align: center;">Summary</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Total Tickets Sold</th>
                            <th>card</th>
                            <th>cash</th>
                            <th>paypal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <xsl:value-of select="sum(checkoutList/checkout/quantity)"/> <!-- Total quantity of tickets sold -->
                            </td> 
                             <td><xsl:value-of select="count(checkoutList/checkout[paymentMethod='Credit Card'])"/></td>
                            <td><xsl:value-of select="count(checkoutList/checkout[paymentMethod='Cash'])"/></td>                         
                            <td><xsl:value-of select="count(checkoutList/checkout[paymentMethod='PayPal'])"/></td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
