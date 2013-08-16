#Update Shaming

In this file you'll find a general overview of how the plugin works.

####Goal
Shaming content editors into updating page content that has not been touched in a long time, while simultaneously providing an overview of the oldest pages on a site.

##Major Design Decisions
* **Break pages down by last update** - All pages are split by modified date. Pages more than five years old are lumped together. Pages updated in the last six months don't display. If all pages have been touched in the last six months, you're winning the internet.

* **Last update check** - This is being done by a separate function for each check. There's a [Trac ticket](https://core.trac.wordpress.org/ticket/18694) open for 3.7 that will add a set of new WP_Query parameters to do a list by date range, which is really what I'm going for here, but since that's not possible right now, I have to use this somewhat hacky solution instead.

* **Reaction Gifs** - The core tenet of the plugin. It's not called 'shaming' for no reason, these attempt to call greater attention to how long it's been since these pages have been touched as well as being (or trying to be) funny.

* **External Sources & Licensing** Based on [this](https://twitter.com/Ipstenu/status/368183356694876160) Twitter conversation, I'm going under the assumption that externally linking to the reaction gifs and displaying their sources is kosher for inclusion in WordPress.org. I hope so, since [last time](http://wordpress.org/support/topic/bannermodal-option-doesnt-set-right?replies=3#post-4377860), I had to include the image files in the plugin assets -- if that was the case here, I don't know that the licensing would fall under the GPL and the previously-mentioned "core tenet" of the plugin would be broken. I tried as best I could to consolidate the sources to as few as possible, pulling most of the images from reactiongifs.com with a few from imgur.com (particularly [this archive](http://reactiongifsarchive.imgur.com/)) and a few from elsewhere. Whenever possible, I tried to use [reactiongifs.com](http://reactiongifs.com) partially to keep things consistent but also just because it's a WordPress-powered site.

* **Captions** - The captions are there to make the images more universally funny and recognizable. Some caption meanings may be lost in translation, but that leads to...

* **Translations** - Translators should feel free to make the captions their own in a way that makes the most sense in their language. There should not be any requirement (or assumption of a requirement) that the captions are "set in stone" and can't be different than their source. All other translatable strings should be handled normally.

* **Global Definitions** - Global definitions are used so as to not keep runing the same code to set variables for various year checks.

##Code Organization
* Plugin framework pulled from Tom McFarlin's [WordPress Plugin Boilerplate](https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate), with most of the code living in `class-update-shaming.php`.
* Admin page is located in `views/admin.php`.
* Only one custom stylesheet is used for some minor admin styles and that lives in `css/admin.css`.
* Translations are in `lang/`.

##Backend
* The main class is `Update_Shaming`. Probably some of the functions should start getting split out into other files.
* Dashboard page is under Pages, at `edit.php?post_type=page&page=update-shaming` and is restricted to anyone who can `publish_page`.

##TODO
* It would be nice to have an numeric icon with a count of the total out-of-date pages that appears next to the menu title.