<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes"/>
    
    <xsl:template match="/">
        <html>
            <head>
                <title>User Inquiries</title>
                <style>
                    .inquiry-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }
                    
                    .inquiry-table th, .inquiry-table td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                        font-size: 25px;
                    }
                    
                    .inquiry-table th {
                        background-color: #4CAF50;
                        color: white;
                    }
                    
                    .inquiry-table tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }
                    
                    .inquiry-table tr:hover {
                        background-color: #ddd;
                    }

                    .inquiry-table td {
                        font-size: 20px;
                    }
                </style>
            </head>
            <body>
                <h2>User Inquiries</h2>
                <table class="inquiry-table">
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                    <xsl:for-each select="inquiries/inquiry">
                        <tr>
                            <td><xsl:value-of select="name"/></td>
                            <td><xsl:value-of select="phone"/></td>
                            <td><xsl:value-of select="email"/></td>
                            <td><xsl:value-of select="message"/></td>
                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>

    <xsl:param name="userEmail" select="''"/>
</xsl:stylesheet>
