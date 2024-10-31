=== Preload Fullpage Cache ===
Contributors: pothi
Donate link: https://paypal.me/pothi
Tags: preload, cache, fullpage cache, mobile, amp
Requires at least: 3.0
Tested up to: 6.7
Stable tag: 1.0.2
License: GPLv3
Requires PHP: 5.3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Preloads any new or recently updated post into fullpage cache. Requires a fullpage caching layer or plugin, such as Varnish or WP Super Cache.

== Description ==

Preload Fullpage Cache plugin is created to address a unique scenario in high traffic sites where the visitors rush to the website upon publishing the new post, even before the cached version of the post is ready to serve the initial traffic spike.

= What this plugin does: =

* Whenever you publish a new post, this plugin fetches the post using WordPress HTTP API. If your site has a fullpage caching, then its cache would have the newly published post, so that the post is served instantly from the cache when a real visitor arrives.
* This plugin works when a post is updated too.
* This plugin fetches a maximum of three version of the post... desktop version, mobile version and the AMP version.

= What this plugin doesn't do (yet): =

* This plugin doesn't work as a caching layer. Use Varnish or a plugin like WP Super Cache.
* This plugin doesn't work on Custom Post Type.

= Compatibility: =

* This plugin is compatible with WP Super Cache and WP Rocket plugins.
* This plugin has known issues when used with LiteSpeed and LiteSpeed Cache plugin. Please see [this thread](https://wordpress.org/support/topic/not-working-with-litespeed-cache-2/) for details.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/preload-fullpage-cache` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Sit back and relax!

== Frequently Asked Questions ==

= Where can I change the settings? =

This plugin doesn't come with any settings screen on purpose. Settings screen may be included in the future, depending on the feedback from the users.

= How do I test, if this plugin works? =

Usually, you can check if a post is served from the cache or not by looking at the headers info. So, create a new blog post or update an existing post and look for its headers info. For example, if your site is behind Varnish, you may see the 'Age' information that is greater than zero. Uncached posts (for example, a search query such as example.com/s=test) will have 'Age' as zero.

= Does this work with custom post types? =

Unfortunately, no. But, there is a workaround that requires some coding skills (such as how to extend a plugin). Please see this support thread for an explanation... https://wordpress.org/support/topic/custom-post-types-313/ . Thanks.

= Why does this plugin slow down publishing and updating posts? =

This plugin needs to fetch the new / updated post thrice in real time over the internet, just after publishing or updating. This is expected to slow down the whole process!

== Screenshots ==

* assets/screenshot-1.jpg

== Upgrade Notice ==
none

== Changelog ==

= 1.0.2 =
* Update user-agents

= 1.0.1 =
* Update readme and inline docs
* Update user-agent/s used by this plugin
* Update the function used by this plugin that causes some issues in some
  installation. - props @saman27
* Include the minimal PHP version required

= 1.0.0 =
* First commit
