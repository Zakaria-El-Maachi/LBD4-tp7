<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <body>
                <h2 style="text-align:center;">Book Store</h2>
                <br/><br/><br/>
                <div style="display: flex; justify-content: space-around; align-items: center; width: 1000px; flex-wrap: wrap; row-gap:10px; margin:auto;">
                    <xsl:apply-templates select="bookstore/book" >
                        <xsl:sort select="price" data-type="number" />
                    </xsl:apply-templates>
                </div>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="book">
        <xsl:choose>

            <xsl:when test="category = 'cooking'">
                <div style="width:250px; border-radius: 10px; border: 2px solid black; padding: 0px 15px;background-color:green;">
                    <h3 style="color:grey; text-decoration:underline;"><xsl:value-of select="title" /></h3>
                    <ul>
                        <li><span style="font-weight:bold; font-size:large;">Author : </span><xsl:for-each select="author"><xsl:value-of select="text()" />, </xsl:for-each></li>
                        <li><span style="font-weight:bold; font-size:large;">Year : </span><xsl:value-of select="year" /></li>
                        <li><span style="font-weight:bold; font-size:large;">Publisher : </span><xsl:value-of select="publisher" /></li>
                    </ul>
                    <span style="font-weight:bolder; font-size:larger; float:right;"><xsl:value-of select="price" /> $</span>
                </div>
            </xsl:when>
            
            <xsl:when test="category = 'children'">
                <div style="width:250px; border-radius: 10px; border: 2px solid black; padding: 0px 15px;background-color:violet;">
                    <h3 style="color:grey; text-decoration:underline;"><xsl:value-of select="title" /></h3>
                    <ul>
                        <li><span style="font-weight:bold; font-size:large;">Author : </span><xsl:for-each select="author"><xsl:value-of select="text()" />, </xsl:for-each></li>
                        <li><span style="font-weight:bold; font-size:large;">Year : </span><xsl:value-of select="year" /></li>
                        <li><span style="font-weight:bold; font-size:large;">Publisher : </span><xsl:value-of select="publisher" /></li>
                    </ul>
                    <span style="font-weight:bolder; font-size:larger; float:right;"><xsl:value-of select="price" /> $</span>
                </div>
            </xsl:when>
            
            <xsl:when test="category = 'web'">
                <div style="width:250px; border-radius: 10px; border: 2px solid black; padding: 0px 15px;background-color:#adb9cc;">
                    <h3 style="color:grey; text-decoration:underline;"><xsl:value-of select="title" /></h3>
                    <ul>
                        <li><span style="font-weight:bold; font-size:large;">Author : </span><xsl:for-each select="author"><xsl:value-of select="text()" />, </xsl:for-each></li>
                        <li><span style="font-weight:bold; font-size:large;">Year : </span><xsl:value-of select="year" /></li>
                        <li><span style="font-weight:bold; font-size:large;">Publisher : </span><xsl:value-of select="publisher" /></li>
                    </ul>
                    <span style="font-weight:bolder; font-size:larger; float:right;"><xsl:value-of select="price" /> $</span>
                </div>
            </xsl:when>
            
            <xsl:otherwise>
                <div style="width:250px; border-radius: 10px; border: 2px solid black; padding: 0px 15px;background-color:#6395e6;">
                    <h3 style="color:grey; text-decoration:underline;"><xsl:value-of select="title" /></h3>
                    <ul>
                        <li><span style="font-weight:bold; font-size:large;">Author : </span><xsl:for-each select="author"><xsl:value-of select="text()" />, </xsl:for-each></li>
                        <li><span style="font-weight:bold; font-size:large;">Year : </span><xsl:value-of select="year" /></li>
                        <li><span style="font-weight:bold; font-size:large;">Publisher : </span><xsl:value-of select="publisher" /></li>
                    </ul>
                    <span style="font-weight:bolder; font-size:larger; float:right;"><xsl:value-of select="price" /> $</span>
                </div>
            </xsl:otherwise>
            
        </xsl:choose>
    </xsl:template>
</xsl:stylesheet>