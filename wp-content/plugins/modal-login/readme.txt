=== Modal Log-in for WordPress ===
Author: RightHere LLC (Alberto Lau)
Author URL: http://plugins.righthere.com/modal-login/
Tags: WordPress, Modal login, Log in, Log-in, Twitter Bootstrap, jQuery, rewrite login, rewrite wp-admin, rewrite wp-login.php, .htaccess
Requires at least: 3.1
Tested up to: 3.5.1
Stable tag: 1.2.7 rev35508


======== CHANGELOG ========
Version 1.2.7 rev35508 - March 27, 2013
* Bug Fixed: If redirect Url is not set, and it is the login page, redirect to admin (if you use the login link in the menu or the login shortcode button in the content and you don't specify a redirect URL you will stay on the page where the login was triggered)

Version: 1.2.6 rev35428 - March 26, 2013
* Bug Fixed: Panic key not working when rewrite rules are active
* Bug Fixed: When no redirect URL is specified, login should reload the page, so that the login button get refreshed. 
* New Feature: Added support for alternate templates with different styles of Social Network icons.

Version 1.2.5 rev35116 - March 13, 2013
* Bug Fixed: Rolled back Bootstrap from version 2.3.1 to 2.2.1 due to bug. Will investigate bug.

Version 1.2.4 rev35113 - March 13, 2013
* Bug Fixed: Saving the main options was resetting the custom link settings
* Bug Fixed: When the URL is not specified the loginout shortcode should not redirect to admin by default, instead it should stay in the same window
* Update: Replace depreciated live jQuery method

Version 1.2.3 rev33940 - February 12, 2013
* New Feature: Admin gui to change links, and add up to 5 custom links
* New Feature: Update Options Panel with Auto Update
* Update: Added option to specify an alternate ajax url
* Update: Added filter hook to allow exceptions to forced login or maintenance mode
* Bug Fixed: Compatibility fix, a img tag without src attributes was breaking a third party javascript
* Bug Fixed: Declare Auto Update on one instance of options panel module. When multiple plugins use pop, only one shows update info
* Bug Fixed: Space removed when custom links are saved
* Bug Fixed: Escaped quotes

Version 1.2.2 rev33728 - February 5, 2013
* New Feature: Added 2 templates one with swapped buttons, and one with all four buttons in the footer of the Modal Log In. And added option to enable the templates.
* New Feature: Added option to add raw CSS Styles.
* Bug Fixed: Modal Log In Styles not loaded related to WordPress 3.5.1

Version 1.2.1 rev33597 - February 3, 2013
* Bug Fixed: Strength meter not working in reset password
* Bug Fixed: Reset password
* Bug Fixed: Compatibility fix with CSS Editor in our plugin Bootstrap Menu Replacement
* Update: Interoperability fix: Disable WLB login form customization
* Update: Avoid sending duplicate styles, when using other plugins with our CSS Editor
* Update: Modify rewrite rules a bit to avoid urn query strings from being escaped and not loading scripts and styles on some site.

Version 1.2.0 rev32358 - January 15, 2013
* New Feature: Implement support for the oneall.com API. Supports 20+ social networks and consolidates the most powerful social features in a single solution. Special discount offered to RightHere customers.
* New Feature: Allow changing the pre-loader image URL, size and position
* Improvement: Implement new script registration procedure so that Twitter Bootstrap is not loaded more than once within any plugins from RightHere
* Bug Fixed: When a login or logout link had HTML inside the a tag, the logout was not working
* Bug Fixed: Increased tab index of forms. Set focus on username after opening login form

Version 1.0.2 rev31322 - December 18, 2012
* New Feature: Compatibility mode. Added a workaround to problems related to jQuery plugins that overwrite some of the Bootstrap common names, like modal.
* Update: WordPress 3.5 compatibility
* Update: Added php version to debug script
* Bug Fixed: removed debugging code
* Bug Fixed: Suppress some php warnings
* Bug Fixed: Modified the frontend implementation to avoid conflicts with other plugins

Version 1.0.1 rev30421 - November 26, 2012
* Bug Fixed: Background image added to website using Modal Log In from the menu, or login button. Also added option to disable the login background for users that want to show the website as the background for the Modal Log In form.
* Bug Fixed: Typo in function returns a php warning when using the disable right click option
* New Feature: Provide an option to demonstrate the CSS Editor tool and not letting user apply changes
* New Feature: Added support for responsive Modal Log In form for mobile devices
* New Feature : Added support for accepting keyboard "return/enter" as submit
* Update: Modified behavior of press return/enter action, so that it only submit if it is the last input field.
* New Feature: Disable rewrite if wp-login.php and wp-admin rewrite has been set to the same (accidentally by the user)
* Update: Uncreased CSS version to force new load.


Version 1.0.0 rev30352 - November 23, 2012
* First release.


======== DESCRIPTION ========
Modal Log-in for WordPress provides you with a beautiful alternative log-in for your WordPress powered website based on the popular Twitter Boostrap.

When creating our popular White Label Branding for WordPress our idea was never to hide the fact the website is powered by WordPress. We firmly believe that it is a positive thing that your website is built using WordPress. However we received a lot of feedback from customers asking for an alternative to the normal WordPress plugin and also a way to hide the wp-login.php and wp-admin for increased security. And also for not obviously giving away that the website is powered by WordPress.

With this in mind we have created Modal Log-in for WordPress, which is a powerful plugin that lets you easily create stunning looking Log-in, Log-out, Register, Lost your password and Maintenance message for your WordPress powered website.

The editor works perfectly in all modern browsers like Firefox, Chrome, Safari, Opera and IE 10. The final result (login screen) will also work in older browsers like IE7, IE8 and IE9.

We hope you will like it!


The Main Features:

* Replace the default WordPress login with Twitter Boostrap powered Modal Login
* Log In, Log Out, Lost Your Password and Register all integrated in Modal Login
* Set Redirect after login by User Role
* Enable Maintenance Screen feature
* Enable Forced Login
* Optional re-write of .htaccess allowing to block access to wp-login.php and wp-admin and set alternate login URL's.
* Troubleshooting and Debug mode for faster and easier support.
* Set Panic Key (optional). If login screen is broken you can skip the Modal Log-in by using the Panic Key

== INSTALLATION ==

1. Upload the 'modal-login folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. In the menu you will find Settings > Modal Login

== FREQUENTLY ASKED QUESTIONS ==
If you have any questions or trouble using this plugin you are welcome to contact us through our profile on Codecanyon (http://codecanyon.net/user/RightHere)

Or visit our HelpDesk at http://support.righthere.com


== SOURCES - CREDITS & LICENSES ==

We have used the following open source projects, graphics, fonts, API's or other files as listed. Thanks to the author for the creative work they made.

1) Twitter Bootstrap, Modal Javascript, version 2.2.2
	
	http://twitter.github.com/bootstrap/javascript.html#modals

2) jQuery Minicolors
	https://github.com/claviska/jquery-miniColors/

3) TinyColor (library for color conversion)
	https://github.com/bgrins/TinyColor

4) Subtle Patterns
	We have used 20 patterns from Subtle Patterns. If you need more, visit www.subtlepatterns.com

5) Alternative Facebook Ui Free PSD
	http://365psd.com/day/3-303/ (Artur Kasimov). We have used his Alternative Facebook Ui Free PSD as a base for our alternate Social Media Network icons.