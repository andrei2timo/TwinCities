<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" omit-xml-declaration="yes"/>

    <xsl:template match="city">
        <h1 class = "page_title"><xsl:value-of select="name"/></h1>
        <h2><a href="http://www.google.com/search?q={translate(country,' ','+')}" target="_blank"><xsl:value-of select="country"/></a></h2>

        <div class="row">
            <div class="column left">
                <img class="city_image" src="{image}" alt="{image_alt}"/>
                <p><xsl:value-of select="image_alt"/></p>
            </div>
            <div class="column right">
                <div class="desc_city">
                    <h2>Description</h2>
                    <p><xsl:value-of select="description"/><a href="{description_source}">[source]</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column left">
                <a href="https://www.google.com/maps/dir//{latitude},{longitude}" target="_blank">
                <img id="city_static_map" src="https://maps.googleapis.com/maps/api/staticmap?center={latitude},{longitude}&amp;zoom=13&amp;maptype=hybrid&amp;format=png&amp;size=640x640&amp;key={$google_map_key}" alt="Static map of {name}"/></a>
                <p>Picture map of <xsl:value-of select="name"/></p>
            </div>
            <div class="column right">
                <div class="weather">
                <h2><span class="glyphicon glyphicon-cloud"/> Weather</h2>
                    <div id="city_weather"></div>
                </div>
               <a href="javascript:makeGetRequest('{$base_url}','{name}','{country_code}')">Reload Weather</a>
                <div class="stats_city">
                    <h2><span class="glyphicon glyphicon-stats"/> Stats about <xsl:value-of select="name"/></h2>
                        <p>
                          Population: <xsl:value-of select="population"/><br/>
                            Area: <xsl:value-of select="area"/>km<sup>2</sup><br/>
                            Population Density: <xsl:value-of select="population_density"/>/km<sup>2</sup><br/>
                            Currency: <xsl:value-of select="currency"/><br/>
                        </p>
                </div>
                <div class="more_info_city">
                    <h3>More information about <xsl:value-of select="name"/></h3><p>
                    <a href="{website}" target="_blank"><span class="glyphicon glyphicon-globe"/>&#160;<xsl:value-of select="name"/> website</a><br/>
                    <a href="{wiki}" target="_blank"><span class="glyphicon glyphicon-link"/>&#160;<xsl:value-of select="name"/> Wikipedia</a><br/>
                    <a href="{google_maps}" target="_blank"><span class="glyphicon glyphicon-map-marker"/>&#160;<xsl:value-of select="name"/> Google Maps</a><br/></p>
                </div>
            </div>
        </div>
        <div>
        <h3>Places of interest in and around <xsl:value-of select="name"/></h3>
            <div id="city_interactive_map"></div>
            <script>
                //Used google maps documentation for this
                var lat = <xsl:value-of select="latitude"/>;
                var lng = <xsl:value-of select="longitude"/>;
                var position = {lat: lat, lng: lng};
                function initCityMap() {
                var temp_styles = [
                {
                "featureType": "poi",
                "stylers": [
                {
                "visibility": "off"
                }
                ]
                },
                {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [
                {
                "visibility": "on"
                }
                ]
                }
                ];
                var city_map_interactive = new google.maps.Map(document.getElementById('city_interactive_map'), {
                zoom: 13,
                styles: temp_styles,
                center: position
                });
                function addPOIMarker(lat,lng,name,icon, sdesc, link) {
                var temp_poi_position = {lat: lat, lng: lng};
                // Add the marker at the clicked location, and add the next-available label
                // from the array of alphabetical characters.
                var temp_marker = new google.maps.Marker({
                position: temp_poi_position,
                title: name,
                icon: icon,
                map: city_map_interactive
                });
                var temp_marker_infowindow = new google.maps.InfoWindow({
                content: sdesc + link
                });
                temp_marker.addListener('click', function() {
                temp_marker_infowindow.open(city_map_interactive, temp_marker);
                });
                temp_marker.addListener('mouseout', function() {
                window.setTimeout(function(){
                temp_marker_infowindow.close();
                },5500);
                });
                }
                <xsl:for-each select="places_of_interest/place_of_interest">
                    addPOIMarker(
                    <xsl:value-of select="latitude"/>,
                    <xsl:value-of select="longitude"/>,
                    '<xsl:value-of select="name"/>',
                    '<xsl:value-of select="$base_url"/><xsl:value-of select="$image_url"/>map_icons/<xsl:value-of select="map_icon"/>',
                    '<strong><xsl:value-of select="name"/>, <xsl:value-of select="/city/name"/>, <xsl:value-of
                        select="/city/country_code"/></strong><br/><xsl:value-of select="short_description"/>',
                    '<br/> <a href="{$base_url}place_of_interest{$url_ending}?{$get_city}={/city/name}&amp;{$get_place}={translate(name,' ','+')}">More Details about <xsl:value-of
                        select="name"/></a>');
                </xsl:for-each>
                }
            </script>
            <p>Maps Icons Collection <a href="https://mapicons.mapsmarker.com">https://mapicons.mapsmarker.com</a></p>
        </div>

        <br/><h4>Places of interest listed</h4>
        <ul>
        <xsl:for-each select="places_of_interest/place_of_interest">
            <li><a href="{$base_url}place_of_interest{$url_ending}?{$get_city}={/city/name}&amp;{$get_place}={translate(name,' ','+')}"><xsl:value-of select="name"/> [<xsl:value-of select="@category"/>]</a></li>
        </xsl:for-each>
        </ul>


    </xsl:template>
</xsl:stylesheet>