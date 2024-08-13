# Simple-Author-Box

# Author Box Plugin

## Description

The Author Box Plugin is a customizable WordPress plugin that adds a professional author box to your posts and pages. It allows you to showcase author details, including an image, name, description, social media links, and a "Book a Consultation" button. The plugin is fully customizable via the WordPress admin panel, enabling you to adjust styles and content easily.

## Features

- **Author Image**: Display an author's image with adjustable size and border settings.
- **Author Details**: Include the author's name and description with support for basic HTML formatting.
- **Social Media Links**: Display social media icons with customizable URLs, sizes, and hover effects.
- **Consultation Button**: Add a "Book a Consultation" button with customizable text, URL, background color, font size, border, and hover effects.
- **Responsive Design**: The author box is responsive, ensuring it looks great on all devices.
- **Accessibility**: Fully accessible with keyboard navigation and focus states.

## Installation

1. **Upload the Plugin Files**: Upload the `author-box` folder to the `/wp-content/plugins/` directory of your WordPress installation.
   
2. **Activate the Plugin**: Go to the Plugins page in the WordPress admin dashboard and activate the "Author Box" plugin.

3. **Configure the Settings**: Navigate to the "Author Box" settings page under the WordPress admin menu to customize the author box's appearance and content.

## Usage

To display the author box on your site, use the shortcode `[author_box]` in your posts or pages.

### Shortcode Example

Add the following shortcode to the WordPress editor:

[author_box]

This shortcode will render the author box based on the settings configured in the admin panel.

## Customization Options

The plugin provides several customization options available via the WordPress admin panel:

### Author Box Settings

- **Author Image**: Upload an image for the author.
- **Author Name**: Set the author's name.
- **Author Description**: Provide a description of the author.
- **Social Links**: Enter URLs for LinkedIn, Facebook, Gmail, Twitter, and Instagram.
- **Image Width (%)**: Set the width of the author image as a percentage of its container.
- **Left Container Width (%)**: Set the width percentage for the left container containing the author image.
- **Background Color**: Choose a background color for the author box.
- **Box Border Radius**: Set the border radius for the author box.
- **Box Border Color**: Choose the border color for the author box.
- **Box Border Size**: Set the border size for the author box.

### Consultation Button Settings

- **Button Text**: Set the text for the "Book a Consultation" button.
- **Button URL**: Enter the URL for the consultation link.
- **Show Consultation Link**: Toggle the display of the consultation button.
- **Button Background Color**: Choose the background color for the consultation button.
- **Button Font Size**: Set the font size for the button text.
- **Button Padding**: Adjust the padding for the consultation button.
- **Button Border Color**: Set the border color for the consultation button.
- **Button Border Size**: Define the border size for the consultation button.
- **Button Border Radius**: Set the border radius for the consultation button.
- **Button Width**: Set the width for the consultation button (e.g., `200px` or `auto`).

## Styling

Custom CSS is included to ensure a consistent and professional appearance. You can further customize the styling by editing the plugin's `style.css` file or adding custom CSS to your theme.

### CSS Highlights

- **Flexbox Layout**: Ensures responsive and aligned content.
- **Hover Effects**: Smooth transitions for interactive elements.
- **Focus Styles**: Accessibility improvements with keyboard navigation support.

## Accessibility

The Author Box Plugin adheres to accessibility standards, providing:

- Keyboard navigable elements with focus states.
- Text descriptions for social media links.

## Contributing

We welcome contributions from the community. To contribute:

1. **Fork the Repository**: Create a fork of this repository on GitHub.

2. **Create a Branch**: Make a new branch for your changes.

   ```bash
   git checkout -b feature/your-feature-name
Make Changes: Implement your changes and commit them with descriptive messages.

Submit a Pull Request: Open a pull request to the main repository with a detailed explanation of your changes.

License
This plugin is licensed under the MIT License. See the LICENSE file for more details.

Acknowledgements
The Author Box Plugin uses Font Awesome for social media icons.
Contact
For questions or support, please contact Khushwant Parihar at [kgpkhushwant1@gmail.com].

### Explanation

- **Installation and Usage**: Provides step-by-step instructions on how to install and use the plugin, including shortcode usage.
- **Customization Options**: Lists all available settings and their purposes, making it easy for users to understand how to customize the plugin.
- **Styling and Accessibility**: Describes the default styling and accessibility features of the plugin.
- **Contributing**: Provides guidance for contributing to the project on GitHub.
- **License and Acknowledgements**: Includes licensing information and credits for resources used in the plugin.
