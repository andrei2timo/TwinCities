<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" omit-xml-declaration="yes"/>

    <xsl:template match="/">
        <xsl:for-each select="/places_of_interest/place_of_interest">
            <xsl:if test="name = $poi_name">
                <h1 class="page_title"><xsl:value-of select="name"/>, <a href="{$base_url}city{$url_ending}?{$get_city}={$city_name}"><xsl:value-of select="$city_name"/></a></h1>
                <img src="{image}" alt="{image_alt}" height="300px"/>
                <h2>About <xsl:value-of select="name"/></h2>
                <p><xsl:value-of select="description"/><a href="{description_source}">[Source]</a></p>
                <div class="place_details">
                    <h3>Details about <xsl:value-of select="name"/></h3>
                    Address: <a href="http://www.google.com/search?q={translate(address,' ','+')}" target="_blank"><xsl:value-of select="address"/>&#160;<span class="glyphicon glyphicon-new-window"></span></a><br/>
                    Category: <xsl:value-of select="@category"/>
                </div>
                <div class="place_links">
                    <br/><p>External Links:</p>
                    <xsl:if test="website != ''">
                        <a href="{website}" target="_blank"><span class="glyphicon glyphicon-globe"></span>&#160;<xsl:value-of select="name"/> website</a><br/>
                    </xsl:if>
                    <a href="https://www.google.com/maps/dir//{latitude},{longitude}" target="_blank"><span class="glyphicon glyphicon-map-marker"></span> Directions to <xsl:value-of
                            select="name"/></a><br/>
                    <xsl:if test="wiki != ''">
                        <a href="{wiki}" target="_blank"><span class="glyphicon glyphicon-link"></span>&#160;<xsl:value-of select="name"/> Wikipedia</a><br/>
                    </xsl:if>
                    <a href="http://www.google.com/search?q={translate(name,' ','+')}" target="_blank"><span class="glyphicon glyphicon-search"></span> Search for more on <xsl:value-of
                            select="name"/></a><br/>
                </div>
            </xsl:if>
        </xsl:for-each>


        <!-- All other places of interest in the city -->
        <br/><strong>All place of interest in <xsl:value-of select="$city_name"/></strong>
        <ul>
        <xsl:for-each select="/places_of_interest/place_of_interest">
            <xsl:if test="name != $poi_name">
                <li><a href="{$base_url}place_of_interest{$url_ending}?{$get_city}={$city_name}&amp;{$get_place}={translate(name,' ','+')}"><xsl:value-of select="name"/> [<xsl:value-of select="@category"/>]</a></li>
            </xsl:if>
        </xsl:for-each>
        </ul>

    </xsl:template>

</xsl:stylesheet>