#Update Shaming

In this file you'll find a general overview of how the plugin works.

####Goal
Shaming content editors into updating page content that has not been touched in a long time, while simultaneously providing an overview of the oldest pages on a site.

##Major Design Decisions
* **Break pages down by last update** - All pages are split by modified date. Pages more than five years old are lumped together. Pages updated in the last six months don't display. If all pages have been touched in the last six months, you're winning the internet.

* **Last update check** - This is being done by a separate function for each check. There's a [Trac ticket](https://core.trac.wordpress.org/ticket/18694) open for 3.7 that will add a set of new WP_Query parameters to do a list by date range, which is really what I'm going for here, but since that's not possible right now, I have to use this somewhat hacky solution instead.

* **Reaction Gifs** - The core tenet of the plugin. It's not called 'shaming' for no reason, these attempt to call greater attention to how long it's been since these pages have been touched as well as being (or trying to be) funny.

* **Captions** - The captions are there to make the images more universally funny and recognizable. Some caption meanings may be lost in translation, but that leads to...

* **Translations** - Translators should feel free to make the captions their own in a way that makes the most sense in their language. There should not be any requirement (or attempt at a requirement) that the captions are "set in stone" and can't ever change.

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