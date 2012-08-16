=== mojoLive Profile Widget ===
Contributors: jblotus
Donate Link: http://www.jblotus.com
Tags: mojolive, social networking, career, resume, linkedin
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 0.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a simple widget that displays your mojoLive (http:://mojolive.com) profile picture and score.

== Installation ==

1. Upload mojolive-wordpress-plugin to /wp-content/plugins/
2. Add the "mojoLive Profile Widget" to your sidebar
3. Enter your mojolive username into the widget settings

== Frequently Asked Questions ==

= This looks weird on my blog =

I have made my best attempt to make this widget look good on the default templates that ship with WordPress.
Still, you might need to tweak the css to make things look just right.

Take a look at `{mojolive_widget_install_dir}/css/widget.css`

I've noticed that some templates will tend to conflict with the css in the widget. Careful use of the `!important` tag might help here.

= How does it work? =

Well it's pretty simple actually. Mojolive has a public API that offers access to any users public profile data.
Once the sidebar is rendered the first time, it is cached for about 1200 seconds or until your edit the widget settings again.

== Support ==
This plugin is developed on GitHub at [here]( https://github.com/jblotus/mojolive-wordpress-plugin
                                                        "mojoLive widget github page")
If you have any issues, would like to contribute or have feature requests please do it there.

== Author ==
* Twitter via [@j_blotus](https://twitter.com/j_blotus/, "James Fuller (@j_blotus) twitter profile")
* My Blog - [Explosive Programming w/ j_blotus]( http://www.jblotus.com,                                    "James Fuller's Programming Blog")

== Screenshots ==

1. This is an example of the mojoLive profile widget on the default twentyeleven theme.

== Changelog ==

= 0.1.1 =
* README.txt fixes

= 0.1 =
* Initial Release

== Upgrade Notice ==

= 0.1 =
* Initial Release

== Credits ==

* Tom McFarlin - [WordPress Widget Boilerplate][wordpress widget boilerplate]
* Adam Culp (Testing Help) - [Adam's Blog][adam culp blog]

[wordpress widget boilerplate]: http://tommcfarlin.com/wordpress-widget-boilerplate/
                                "Tom created the very awesome WordPress Widget Boilerplate"

[adam culp blog]: http://www.geekyboy.com/
                                "Adam Culp's Tech Blog"
