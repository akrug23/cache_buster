# Cache Buster

An ExpressionEngine plugin that adds a simple cache buster to your flat file references

## Compatibility

* ExpressionEngine 3.x
* ExpressionEngine 4.x

## Installation

* _ExpressionEngine 3.x:_ Upload the <code>/system/user/addons/cache_buster</code> directory to the <code>system/user/addons</code> directory.
* _ExpressionEngine 4.x:_ Upload the <code>/system/user/addons/cache_buster</code> directory to the <code>system/user/addons</code> directory.

## Purpose

Using ExpressionEngine's CSS template provides a nice cache buster string of the most recent time
the template was saved to the database. This is quite handy but still requires EE to process the template.

This plugin will take a file path and use PHP to check the modification time returning a cache busting
string like ExpressionEngine's. This allows you to server flat files from your server without having
ExpressionEngine's template parser run through the code first. It is very simple to use.

## Usage

There are 3 parameters. One is required and the other two are optional.

```
{exp:cache_buster file="/css/style.css"}
```

This will return

```
/css/style.css?v=1266264101
```

Where "1266264101" is the UNIX timestamp of the last time /css/style.css was saved to the server.

You can change the separator between the file and the timestamp with the use of separator="" in the tag.

```
{exp:cache_buster file="/css/style.css" separator="?"}
```

This will return

```
/css/style.css?1266264101
```

_Server Root_

If your file isn't being read by the plugin then the server root might not be the right path. The plugin assumes that your file will reside on your server's DOCUMENT_ROOT variable. If this is not accurate you can manually define the root with the root_path parameter.

```
{exp:cache_buster file="/css/style.css" root_path="/home/mysite/subdirectory/templates"}
```

## Change Log

**_Mar 27th, 2018: 3.0.0_**

* Feature: EE4.x compatibility added

**_Apr 28th, 2017: 2.0.0_**

* Feature: EE3.x compatibility added
* Feature: Cleaned up file path with realpath()
* Deprecated: EE2 and below support

_Feb 17th, 2011: 1.1.1_

* Bug: Fixed bug where root_path wasn't set correctly

_Mar 27th, 2010: 1.1.0_

* Feature: added root_path parameter for manually entering server root
* Feature: EE2.x compatibility added

_Mar 27th, 2010: 1.0.1_

* Assigned license to add-on: "Creative Commons Attribution-No Derivative Works 3.0 Unported":http://creativecommons.org/licenses/by-nd/3.0/

_Feb 15th, 2010: 1.0.0_

* Initial Release
