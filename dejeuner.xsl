<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <title>Dejeuner</title>
            </head>
            <body>
                <h2 style="text-align:center;">My breakfast</h2>
                <br/><br/><br/>
                <div style="margin: auto; display: flex; justify-content: space-around; align-items: center; row-gap: 10px; width: 1000px; flex-wrap: wrap;">
                    <xsl:apply-templates select="breakfast_menu/food" />
                </div>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="food">
        <div style="width:250px; border-radius: 10px; border: 2px solid black; padding: 0px 15px;">
            <ul>
                <li><span style="font-weight:bold; font-size:large;">Name : </span><xsl:value-of select="name" /></li>
                <li><span style="font-weight:bold; font-size:large;">Price : </span><xsl:value-of select="price" /> $</li>
                <li><span style="font-weight:bold; font-size:large;">Calories : </span><xsl:value-of select="calories" /></li>
            </ul>
        </div>
    </xsl:template>

</xsl:stylesheet>