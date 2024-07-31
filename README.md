# My WordPress Tweaks<a name="my-wordpress-tweaks"></a>

This is a simple collection of tweaks for WordPress that I use on my own sites. I've decided to package them up and share them with the world. I hope you find them useful.

______________________________________________________________________

<!-- mdformat-toc start --slug=github --maxlevel=6 --minlevel=2 -->

- [Installation](#installation)
- [Tweaks](#tweaks)
  - [Auto Update Mails](#auto-update-mails)
  - [Canonical Link](#canonical-link)
  - [Emoji Support](#emoji-support)
  - [Enfold Debug](#enfold-debug)
  - [Generator Name](#generator-name)
  - [Meta Links Tags](#meta-links-tags)
  - [Login Error Messages](#login-error-messages)
  - [oEmbed Discovery](#oembed-discovery)
  - [Pingback Header](#pingback-header)
  - [Version Strings](#version-strings)
  - [WooCommerce Generator Tag](#woocommerce-generator-tag)
  - [YouTube Embed (no-cookie)](#youtube-embed-no-cookie)

<!-- mdformat-toc end -->

______________________________________________________________________

## Installation<a name="installation"></a>

1. Download the [latest version](https://github.com/ppfeufer/pp-wordpress-tweaks/releases/latest/download/pp-wordpress-tweaks.zip).
1. Go to your WordPress admin area and navigate to `Plugins` → `Add New`.
1. Click on `Upload Plugin` and select the downloaded ZIP file.
1. Click on `Install Now` and then on `Activate`.
1. Done!

## Tweaks<a name="tweaks"></a>

The following tweaks are included in this plugin.

Each tweak can be enabled or disabled in the WordPress admin area under `Settings` →
`WP Tweaks`.

### Auto Update Mails<a name="auto-update-mails"></a>

This tweak disables the mails that WordPress sends out when it updates itself or any
of the plugins or themes. In case the automatic WordPress core update fails, you
will still get an email notifying you about it.

### Canonical Link<a name="canonical-link"></a>

This tweak removed the canonical URL from the head of the HTML document.
This is useful if you want to use a plugin that adds the canonical URL to the head
of the HTML document.

### Emoji Support<a name="emoji-support"></a>

This tweak removes the emoji support from WordPress.
WordPress tends to convert some characters into emojis.
This tweak disables this feature.

### Enfold Debug<a name="enfold-debug"></a>

This tweak removed the Enfold debug information from the HTML document.
The Enfold theme adds some debug information to the HTML document,
which is probably unnecessary on a live site.

### Generator Name<a name="generator-name"></a>

This tweak removes the WordPress generator name from the head of the HTML document.

### Meta Links Tags<a name="meta-links-tags"></a>

This tweak removes the meta-links tags from the head of the HTML document,
like XMLRPC header, RSS feeds, and WLW Manifests.

### Login Error Messages<a name="login-error-messages"></a>

This tweak removes the default login error messages from the login page
and replaces it with a more generic message.

### oEmbed Discovery<a name="oembed-discovery"></a>

This tweak removes the oEmbed discovery links from the head of the HTML document.

### Pingback Header<a name="pingback-header"></a>

This tweak removes the X-Pingback header from the HTTP response.

### Version Strings<a name="version-strings"></a>

This tweak removes the WordPress version from the scripts and styles.

### WooCommerce Generator Tag<a name="woocommerce-generator-tag"></a>

This tweak removes the WooCommerce generator tag from the head of the HTML document.

### YouTube Embed (no-cookie)<a name="youtube-embed-no-cookie"></a>

This tweak changes the YouTube embed URL to the no-cookie version.
