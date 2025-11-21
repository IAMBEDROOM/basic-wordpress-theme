# Custom WordPress Theme Plan: Personal Blog

## 1. File Structure
This structure follows WordPress best practices for a "Classic" theme using standard PHP.

```text
basic-wordpress-theme/
├── style.css               # Main theme stylesheet & Theme Information header
├── index.php               # Main template file (fallback for everything)
├── functions.php           # Theme logic, enqueues, and setup
├── header.php              # HTML head, opening body, navigation
├── footer.php              # Closing body, scripts, copyright
├── sidebar.php             # Sidebar widget area
├── single.php              # Single post template
├── page.php                # Static page template
├── 404.php                 # Error page
├── comments.php            # Comments template
├── screenshot.png          # Theme preview in WP Admin (1200x900px)
├── assets/
│   ├── css/
│   │   └── main.css        # Additional styles (if keeping style.css clean for meta)
│   ├── js/
│   │   └── main.js         # Vanilla JS for interactions (mobile menu, etc.)
│   └── images/
│       └── logo.svg        # Theme assets
└── template-parts/         # Reusable code snippets
    ├── content.php         # Standard post loop output
    ├── content-single.php  # Single post content
    ├── content-page.php    # Page content
    └── content-none.php    # Fallback when no content is found
```

## 2. Functional Requirements (functions.php)

The `functions.php` file will handle the following core functionality:

### A. Theme Setup (`after_setup_theme` hook)
- **Title Tag:** Enable `add_theme_support('title-tag')` to let WordPress manage the document title.
- **Post Thumbnails:** Enable `add_theme_support('post-thumbnails')` for featured images.
- **Navigation Menus:** Register locations using `register_nav_menus()`:
  - `primary`: Main header navigation.
  - `footer`: Footer links.
- **HTML5 Support:** Enable support for search form, comment form, comment list, gallery, and caption.

### B. Asset Enqueueing (`wp_enqueue_scripts` hook)
- **Styles:**
  - Enqueue the main `style.css`.
  - Enqueue `assets/css/main.css` (if used for layout styles).
- **Scripts:**
  - Enqueue `assets/js/main.js` (dependent on 'jquery' only if necessary, otherwise vanilla).
  - Enqueue `comment-reply` script (conditionally, only on single posts with comments open).

### C. Widget Areas (`widgets_init` hook)
- Register a dynamic sidebar for the blog (e.g., "Main Sidebar") to allow users to add widgets via the Customizer.

## 3. Step-by-Step Implementation Plan

### Phase 1: The Bare Minimum (Activation)
*Goal: Get the theme recognized and activatable in WordPress.*
1.  Create `style.css` with the required WordPress comment header (Theme Name, Author, Description, Version).
2.  Create `index.php` with a simple `<h1>Hello World</h1>` to verify it loads.
3.  Create `screenshot.png` (placeholder) so it looks decent in the dashboard.

### Phase 2: Core Structure & Assets
*Goal: Establish the HTML skeleton and load assets.*
1.  Create `functions.php` and set up the `wp_enqueue_scripts` action.
2.  Create `header.php`:
    - Add `<!DOCTYPE html>`, `<html>`, `<head>`, `wp_head()`.
    - Add `<body>` open tag and site branding/nav placeholder.
3.  Create `footer.php`:
    - Add footer content (copyright).
    - Add `wp_footer()` and `</body>` closing tag.
4.  Update `index.php` to include `get_header()` and `get_footer()`.

### Phase 3: The Loop & Content Display
*Goal: Display actual posts from the database.*
1.  Implement the WordPress Loop in `index.php`:
    - `if ( have_posts() ) : while ( have_posts() ) : the_post(); ...`
2.  Create `template-parts/content.php` to define how a post looks in a list (Title, Excerpt, Meta).
3.  Add basic CSS to `style.css` to handle layout (container, grid/flex for sidebar).

### Phase 4: Templates & Navigation
*Goal: Handle single views and menus.*
1.  Create `single.php` for viewing full articles.
2.  Create `page.php` for static pages (About, Contact).
3.  Register menus in `functions.php`.
4.  Update `header.php` to use `wp_nav_menu()`.

### Phase 5: Polish & Comments
*Goal: Finalize functionality.*
1.  Create `comments.php` and include it in `single.php`.
2.  Add `sidebar.php` and register the widget area in `functions.php`.
3.  Refine CSS for responsiveness.