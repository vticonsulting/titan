<?php

namespace omz13;

use Exception;
use Kirby\Cms\Pages;

use const HTMLSITEMAP_CONFIGURATION_PREFIX;
use const HTMLSITEMAP_VERSION;
use const INDENTWITH;

use function array_key_exists;
use function define;
use function file_get_contents;
use function in_array;
use function is_array;
use function is_string;
use function json_encode;
use function kirby;
use function microtime;
use function str_repeat;

define( 'HTMLSITEMAP_VERSION', '0.2.0' );
define( 'HTMLSITEMAP_CONFIGURATION_PREFIX', 'omz13.xmlsitemap' );
define( 'INDENTWITH', '    ' );

/**
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class HTMLSitemap
{
  private static $generatedat; // timestamp when sitemap generated
  private static $debug;
  private static $optionIUWSI; // include unlisted when slug is
  private static $optionXCWTI; // exclude children when template is
  private static $optionLSWTI;  // link (sectional) when template is
  private static $optionXPWTI; // exclude page when template is
  private static $optionXPWSI; // exclude page when slug is
  public static $version = HTMLSITEMAP_VERSION;

  public static function ping() : string {
      return static::class . ' pong ' . static::$version;
  }//end ping()

  public static function isEnabled() : bool {
    if ( self::getConfigurationForKey( 'disable' ) == 'true' ) {
        return false;
    }

    if ( kirby()->site()->content()->has( 'xmlsitemap' ) ) {
      if ( kirby()->site()->content()->get( 'xmlsitemap' ) == 'false' ) {
        return false;
      }
    }

      return true;
  }//end isEnabled()

  public static function getArrayConfigurationForKey( string $key ) : ?array {
    // Try to pick up configuration when provided in an array (vendor.plugin.array(key=>value))
    $o = kirby()->option( HTMLSITEMAP_CONFIGURATION_PREFIX );
    if ( $o != null && is_array( $o ) && array_key_exists( $key, $o ) ) {
      return $o[$key];
    }

    // try to pick up configuration as a discrete (vendor.plugin.key=>value)
    $o = kirby()->option( HTMLSITEMAP_CONFIGURATION_PREFIX . '.' . $key );
    if ( $o != null ) {
      // Guard: somebody provided a single entry as string instead of as string in an arrray
      if ( is_string( $o ) ) {
        return [ $o ];
      }
      if ( is_array( $o ) ) {
        return $o;
      }
    }

    // this should not be reached... because plugin should define defaults for all its options...
    return null;
  }//end getArrayConfigurationForKey()

  public static function getConfigurationForKey( string $key ) : string {
    // Try to pick up configuration when provided in an array (vendor.plugin.array(key=>value))
    $o = kirby()->option( HTMLSITEMAP_CONFIGURATION_PREFIX );
    if ( $o != null && is_array( $o ) && array_key_exists( $key, $o ) ) {
      return $o[$key];
    }

    // try to pick up configuration as a discrete (vendor.plugin.key=>value)
    $o = kirby()->option( HTMLSITEMAP_CONFIGURATION_PREFIX . '.' . $key );
    if ( $o != null ) {
      return $o;
    }

    // this should not be reached... because plugin should define defaults for all its options...
    return "";
  }//end getConfigurationForKey()

  public static function getStylesheet() : string {
      $f = file_get_contents( __DIR__ . '/../assets/slickmap.css' );
    if ( $f == null ) {
        throw new Exception( 'Failed to read slickmap.css', 1 );
    }

      return $f;
  }//end getStylesheet()

  public static function getSitemap( Pages $p, bool $debug = false ) : string {
      return static::generateSitemap( $p, $debug );
  }//end getSitemap()

  private static function generateSitemap( Pages $p, bool $debug = false ) : string {
      $tbeg = microtime( true );
      // set debug if the global kirby option for debug is also set
      static::$debug       = $debug && kirby()->option( 'debug' ) !== null && kirby()->option( 'debug' ) == true;
      static::$optionIUWSI = static::getArrayConfigurationForKey( 'includeUnlistedWhenSlugIs' );
      static::$optionXCWTI = static::getArrayConfigurationForKey( 'excludeChildrenWhenTemplateIs' );
      static::$optionLSWTI = static::getArrayConfigurationForKey( 'linkyChildrenWhenTemplateIs' );
      static::$optionXPWTI = static::getArrayConfigurationForKey( 'excludePageWhenTemplateIs' );
      static::$optionXPWSI = static::getArrayConfigurationForKey( 'excludePageWhenSlugIs' );

      /*
          $r = '<head><link rel="stylesheet" type="text/css" media="screen,print" href="/sitemap.css"></head><body>';
          $r .= "\n";
          $r .= "<div class=\"sitemap\">\n";

          $r .=  "  <nav class=\"utilityNav\">\n";
          $r .=  "      <ul>\n";
          $r .=  "        <li><a href=\"/panel\">Log In</a></li>\n";
          $r .=  "      </ul>\n";
          $r .=  "  </nav>\n";
          $r .= "  <nav class=\"primaryNav\">\n";
          static::addPagesToSitemap($p, $r, 2);
          $r .= "  </nav>\n";
          $r .= "</div>\n";
          $r .= "</body>\n";
      */

      $r = "<body>\n";
      static::addPagesToSitemap( $p, $r, 1 );
      $r .= "</body>\n";

      $tend = microtime( true );

      $r .= "<!-- sitemap generated using https://github.com/omz13/kirby3-htmlsitemap -->\n";

    if ( static::$debug == true ) {
        $elapsed             = ( $tend - $tbeg );
        static::$generatedat = $tend;
        $r                  .= '<!-- v' . static::$version . " -->\n";
        $r                  .= '<!-- That took ' . $elapsed . " microseconds -->\n";
        $r                  .= '<!-- Generated at ' . static::$generatedat . " -->\n";
        $r                  .= '<!--     includeUnlistedWhenSlugIs = ' . json_encode( static::$optionIUWSI ) . " -->\n";
        $r                  .= '<!--     excludePageWhenTemplateIs = ' . json_encode( static::$optionXPWTI ) . " -->\n";
        $r                  .= '<!--         excludePageWhenSlugIs = ' . json_encode( static::$optionXPWSI ) . " -->\n";
        $r                  .= '<!-- excludeChildrenWhenTemplateIs = ' . json_encode( static::$optionXCWTI ) . " -->\n";
        $r                  .= '<!--   linkyChildrenWhenTemplateIs = ' . json_encode( static::$optionLSWTI ) . " -->\n";
    }

      return $r;
  }//end generateSitemap()

    /**
     * @SuppressWarnings("Complexity")
     */
  private static function addPagesToSitemap( Pages $pages, string &$r, int $depth = 0 ) : void {
      $sortedpages = $pages->sortBy( 'num', 'asc' );
      $count       = 0;
    foreach ( $sortedpages as $p ) {
        static::addComment( $r, 'crunching ' . $p->url() . ' [it=' . $p->intendedTemplate() . '] [d=' . $p->depth() . ']' );

        // don't include the error page
      if ( $p->isErrorPage() ) {
        continue;
      }

        // exclude unlisted... unless homepage... or in exclusion list
      if ( $p->status() == 'unlisted' && ! $p->isHomePage() ) {
        if ( isset( static::$optionIUWSI ) && in_array( $p->slug(), static::$optionIUWSI, false ) ) {
          static::addComment( $r, 'including ' . $p->url() . ' because unlisted but in includeUnlistedWhenSlugIs' );
        } else {
            static::addComment( $r, 'excluding ' . $p->url() . ' because unlisted' );
            continue;
        }
      }

        // exclude because template used is in the exclusion list:
      if ( isset( static::$optionXPWTI ) && in_array( $p->intendedTemplate(), static::$optionXPWTI, false ) ) {
          static::addComment( $r, 'excluding ' . $p->url() . ' because excludePageWhenTemplateIs (' . $p->intendedTemplate() . ')' );
          continue;
      }

        // exclude because slug is in the exclusion list:
      if ( isset( static::$optionXPWSI ) && in_array( $p->slug(), static::$optionXPWSI, false ) ) {
            static::addComment( $r, 'excluding ' . $p->url() . ' because excludePageWhenSlugIs (' . $p->slug() . ')' );
            continue;
      }

          // exclude because page content field 'excludefromhtmlsitemap':
      if ( $p->content()->excludefromhtmlsitemap() == 'true' ) {
          static::addComment( $r, 'excluding ' . $p->url() . ' because excludeFromHTMLSitemap' );
          continue;
      }

          // exclude because, if supported, the page is sunset:
      if ( $p->hasMethod( 'issunset' ) ) {
        if ( $p->issunset() ) {
              static::addComment( $r, 'excluding ' . $p->url() . ' because isSunset' );
              continue;
        }
      }

          // exclude because, if supported,  the page is under embargo
      if ( $p->hasMethod( 'isunderembargo' ) ) {
        if ( $p->isunderembargo() ) {
              static::addComment( $r, 'excluding ' . $p->url() . ' because isUnderembargo' );
              continue;
        }
      }

          // yes! we get to add a page...
      if ( $count == 0 ) {
          $r .= str_repeat( INDENTWITH, $depth ) . "<ul>\n";
      }

          $count = 1;

          $r .= str_repeat( INDENTWITH, ( $depth + 1 ) ) . '<li' . ( $p->isHomePage() ? ' id="home"' : '' ) . '><a href="' . $p->url() . '">' . $p->title() . "</a>\n";

      if ( $p->children() !== null ) {
          // jump into the children, unless the current page's template is in the exclude-its-children set
        if ( ( isset( static::$optionXCWTI ) && in_array( $p->intendedTemplate(), static::$optionXCWTI, false ) ) ) {
              static::addComment( $r, 'ignoring children of ' . $p->url() . ' because excludeChildrenWhenTemplateIs (' . $p->template()->name() . ')' );
        } else {
          if ( isset( static::$optionLSWTI ) && in_array( $p->intendedTemplate(), static::$optionLSWTI, false ) ) {
              static::addComment( $r, 'linking to children of ' . $p->url() . ' because linkyChildrenWhenTemplateIs (' . $p->template()->name() . ')' );
              static::addSectionalsToSitemap( $p->children(), $r, ( $depth + 1 ) );
          } else {
              // $r .= str_repeat(".", $depth+1) . "<ul>\n";
              static::addPagesToSitemap( $p->children(), $r, ( $depth + 2 ) );
              // $r .= str_repeat(" ", $depth+1) . "</ul>\n";
          }
        }
      } else {
          $r .= str_repeat( INDENTWITH, $depth ) . "</li>\n";
      }//end if
    }//end foreach

    if ( $count > 0 ) {
        $r .= str_repeat( INDENTWITH, $depth ) . "</ul>\n";
    }
  }//end addPagesToSitemap()

  private static function addComment( string &$r, string $m, int $depth = 0 ) : void {
    if ( static::$debug == true ) {
        $r .= str_repeat( INDENTWITH, $depth ) . '<!-- ' . $m . " -->\n";
    }
  }//end addComment()

  private static function addSectionalsToSitemap( Pages $pages, string &$r, int $depth ) : void {
      $r          .= str_repeat( INDENTWITH, ( $depth + 1 ) ) . "<ul>\n";
      $sortedpages = $pages->sortBy( 'num', 'asc' );
    foreach ( $sortedpages as $p ) {
        static::addComment( $r, 'sectioning ' . $p->url() . ' [t=' . $p->template()->name() . '] [d=' . $p->depth() . ']' );
        $r .= str_repeat( INDENTWITH, ( $depth + 2 ) ) . '<li><a href="' . $p->parent()->url() . '#' . $p->slug() . '">' . $p->title() . "</a></li>\n";
    }

      $r .= str_repeat( INDENTWITH, ( $depth + 1 ) ) . "</ul>\n";
  }//end addSectionalsToSitemap()

  public function getNameOfClass() : string {
      return static::class;
  }//end getNameOfClass()
}//end class
