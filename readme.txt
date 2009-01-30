=== Plugin Name ===
Contributors: jamessocol
Donate link: http://jamessocol.com/
Tags: advertising, revenue
Requires at least: 2.3.1
Tested up to: 2.7
Stable tag: trunk

Insert Ad Code automatically places HTML for advertisements inline in your posts.

== Description ==

Insert Ad Code automatically inserts HTML into your posts. By default, it adds this code by the `<!--more-->` tag (though this can be changed).

That's all. It doesn't do anything else. Read the FAQ or visit the [website](http://jamessocol.com/projects/insert_ad_code.php "jamessocol.com &raquo; Insert Ad Code").

== Installation ==


1. Upload `insert_ad_code.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure through 'Options' menu.

== Frequently Asked Questions ==

= What code should go into Insert Ad Code? =

Any text can go in. I like to use AdSense code or Openads code, both of which will rotate ads for me.

= Will Insert Ad Code do ad rotation? =

No.

= Do you ever plan to add ad rotation? =

No.

= Why not? =

Rotating ads is a complicated process, and I'd also have to start keeping track of things like impressions, clicks, and conversions. It's not my goal to add a full-featured ad manager to WordPress, there are plenty of good choices out there, like Openads, AdSense, Doubleclick, and Yahoo! Publisher Network, that already do that.

I wanted to keep Insert Ad Code simple. (In the first versions, it didn't even have an admin page.) I also didn't want to reinvent the wheel, just add a few impressions to my AdSense account.

= Why the &lt;!--more--&gt; tag? =

1. I don't want to break up very short posts with ads.
1. I don't want to go back and insert a new tag into all my old posts.
1. I want the ads to appear once, after a couple of paragraphs, just like the `<!--more-->` tag.
1. I want the tag to be easy to add via the WordPress TinyMCE editor.

= Translations =

Translations contributed by...

* nl_NL: Jeroen Heymans <jeroen.heymans@live.be>

== License ==

Copyright 2009  James Socol  (email: me@jamessocol.com)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
