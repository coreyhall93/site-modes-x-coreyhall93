# coreyhall93 Site Modes

A WordPress plugin that displays maintenance, coming soon, white page, or custom mode pages with WordPress-styled UI.

## Features

- **Maintenance Mode**: Display a maintenance message during site updates
- **Coming Soon Mode**: Show a coming soon page for new sites
- **White Page Mode**: Display a message for unpaid/suspended sites
- **Custom Mode**: Create fully customized messages with HTML editor
- **WordPress-styled UI**: Matches the native WordPress critical error page styling
- **Admin Bypass**: Administrators always see the site normally
- **503 Status Code**: Properly returns HTTP 503 (Service Unavailable) to search engines

## Installation

### Manual Installation

1. Download or clone this repository
2. Upload the `coreyhall93-site-modes` folder to `/wp-content/plugins/`
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Go to Settings > Site Modes to configure

### Alternative Method

1. Zip the `coreyhall93-site-modes` folder
2. In WordPress admin, go to Plugins > Add New > Upload Plugin
3. Upload the zip file and activate

## Usage

1. Navigate to **Settings > Site Modes** in your WordPress admin
2. Select your desired mode:
   - **None**: Site operates normally
   - **Maintenance Mode**: Shows maintenance message
   - **Coming Soon Mode**: Shows coming soon message
   - **White Page Mode**: Shows unavailable/contact host message
   - **Custom Mode**: Shows your custom HTML message

3. Customize the messages for each mode
4. Click "Save Settings"

### Important Notes

- Administrators (users with `manage_options` capability) will always see the site normally
- Non-admin users will see the selected mode page on ALL URLs
- The plugin returns a 503 HTTP status code when a mode is active
- Search engines will know the site is temporarily unavailable

## Customization

### Custom Mode

The Custom Mode includes:
- **Custom Page Title**: Set your own title
- **Rich Text Editor**: Full WordPress editor with HTML support
- Use HTML, paragraphs, links, and basic formatting

### Default Messages

Each mode comes with default messages you can customize:

- **Maintenance**: "This site is currently undergoing scheduled maintenance. Please check back soon."
- **Coming Soon**: "Something awesome is coming soon. Stay tuned!"
- **White Page**: "This website is currently unavailable. If you are the owner of this site, please contact your website host."

## Technical Details

- **Version**: 1.0.0
- **Requires WordPress**: 5.0+
- **Tested up to**: 6.4
- **PHP Version**: 7.4+
- **License**: GPL v2 or later

## File Structure

```
coreyhall93-site-modes/
├── coreyhall93-site-modes.php    # Main plugin file
└── README.md                      # This file
```

## Changelog

### 1.0.0
- Initial release
- Maintenance mode
- Coming soon mode
- White page mode
- Custom mode with HTML editor
- WordPress-styled error page design

## Support

For issues, questions, or contributions, please contact the plugin author.

## License

This plugin is licensed under GPL v2 or later.
