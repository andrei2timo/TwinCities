<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="xml" omit-xml-declaration="yes"/>
    <xsl:template match="/">
        <rss version="2.0">
            <channel>
                <language>en-gb</language>
                <pubDate><xsl:value-of select="$current_time"/></pubDate>
                <title>The twinning of <xsl:value-of select="twinning/cities/city[1]/name"/> and <xsl:value-of select="twinning/cities/city[2]/name"/></title>
                <link><xsl:value-of select="$base_url"/></link>
                <description><xsl:value-of select="twinning/description"/></description>
                <xsl:for-each select="twinning/cities/city">
                    <xsl:for-each select="places_of_interest/place_of_interest">
                        <item>
                            <title><xsl:value-of select="name"/></title>
                            <category>Point of Interest in <xsl:value-of select="../../name"/></category>
                            <link><xsl:value-of select="$base_url"/>place_of_interest<xsl:value-of select="$url_ending"/>?<xsl:value-of
                                    select="$get_city"/>=<xsl:value-of select="../../name"/>&amp;<xsl:value-of select="$get_place"/>=<xsl:value-of select="translate(name,' ','+')"/></link>
                            <description><xsl:value-of select="short_description"/></description>
                        </item>
                    </xsl:for-each>
                </xsl:for-each>
            </channel>
        </rss>
    </xsl:template>

</xsl:stylesheet>