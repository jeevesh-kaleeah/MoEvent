<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:html="http://www.w3.org/1999/xhtml">
  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <xsl:template match="/events">
    <html>
    <head>
    </head>
      <body>
        <section class="events">
          <div class="card-container">
            <xsl:for-each select="cinema/event | concerts/event | theatreShows/event">
              <xsl:sort select="position() mod 6" data-type="number" order="ascending"/>
              <xsl:if test="position() &lt;= 6">
                <div class="card" data-category="{local-name()}">
                  <div class="image">
                    <img src="{cardImage}" alt="Event Image"/>
                  </div>
                  <div class="card-content">
                    <div class="overlay"></div>
                    <div class="event-info">
                      <p class="title"><xsl:value-of select="name"/></p>
                      <div class="separator"></div>
                      <xsl:choose>
                        <xsl:when test="parent::cinema">
                          <p class="info"><xsl:value-of select="genre"/></p>
                        </xsl:when>
                        <xsl:when test="parent::theatreShows">
                          <p class="info"><xsl:value-of select="genre"/></p>
                        </xsl:when>
                        <xsl:otherwise>
                          <p class="info"> </p>
                        </xsl:otherwise>
                      </xsl:choose>
                      <p class="duration"><xsl:value-of select="duration"/></p>
                      <div class="info-details">
                        <p class="info">
                          <i class="fas fa-map-marker-alt"></i>
                          <xsl:value-of select="location"/>
                        </p>
                        <p class="info">
                          <i class="far fa-calendar-alt"></i>
                          Time: <xsl:value-of select="time"/>
                        </p>
                      </div>
                    </div>
                    <button class="action">
                      <a href="eventpage.php?event_id={@id}&amp;category={local-name(parent::*)}" target="_blank">BOOK NOW</a>
                    </button>

                  </div>
                </div>
              </xsl:if>
            </xsl:for-each>
          </div>
          <!--<button class="cta-button" id="load-more">Load More</button>-->
        </section>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
