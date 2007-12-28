=== Plugin Name ===
Contributors: jamessocol
Donate link: http://jamessocol.com/
Tags: advertising, revenue
Requires at least: 2.3.1
Tested up to: 2.3.1
Stable tag: trunk

Insert Ad Code automatically places HTML for advertisements inline in your posts.

== Description ==

Insert Ad Code automatically inserts HTML into your posts. By default, it adds this code by the `<!--more-->` tag (though this can be changed).

That's all. It doesn't do anything else. Read the FAQ or visit the [website](http://jamessocol.com/blog/2007/12/wordpress-plugin-insert-ad-code.php "jamessocol.com Insert Ad Code post").

== Installation ==


1. Upload `insert_ad_code.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure through 'Options' menu.

== Frequently Asked Questions ==

= What code should go into Insert Ad Code? =

Any text can go in. I like to use AdSense code or Openads code, which will both rotate ads for me.

= Will Insert Ad Code do ad rotation? =

No.

= Do you ever plan to add ad rotation? =

No.

= Why not? =

Rotating ads is a complicated process, and I'd also have to start keeping track of things like impressions, clicks, and conversions. It's not my goal to add a full-featured ad manager to WordPress, there are plenty of good choices out there, like Openads, AdSense, Doubleclick, and Yahoo! Publisher Network, that already do that.

I wanted to keep Insert Ad Code simple. (In the first versions, it didn't even have an admin page.) I also didn't want to reinvent the wheel, just add a few impressions to my AdSense account.

= Why the `<!--more-->` tag? =

1. I don't want to break up very short posts with ads.
1. I don't want to go back and insert a new tag into all my old posts.
1. I want the ads to appear once, after a couple of paragraphs, just like the `<!--more-->` tag.
1.I want the tag to be easy to add via the WordPress editor.

== License ==

Copyright 2007  James Socol  (email : me@jamessocol.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
