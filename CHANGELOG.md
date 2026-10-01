# Changelog

All notable changes to **Vibe UI** (`teknovate/vibeui`) will be documented in this file.

## [0.2.34] - 2026-10-01

### 🚀 Features
- feat: add mobileSize and dismissibleButton support to sheet component with responsive constraints (2b37a33)


## [0.2.33] - 2026-10-01

### 🐛 Bug Fixes
- fix: prevent duplicate parentheses in wire:click expressions for button edit component (d6b3a8b)


## [0.2.32] - 2026-10-01

### 🐛 Bug Fixes
- fix: clear single-page confirmation and route session keys in RequirePasswordConfirmation middleware (c053db9)


## [0.2.31] - 2026-10-01

### 🚀 Features
- feat: add vibe:button.edit component and corresponding documentation (3287889)


## [0.2.30] - 2026-10-01

### 🚀 Features
- feat: add edit button component with translations and feature tests (2770c76)


## [0.2.29] - 2026-10-01

### 🐛 Bug Fixes
- fix: enhance form submission handling and fix password confirmation route matching for parameterized paths (1dba0ea)


## [0.2.28] - 2026-10-01

### 🐛 Bug Fixes
- fix: safely handle null or undefined selectedItems in datatable components using optional chaining (9f7583b)

### ⚡ Performance & Refactoring
- refactor: extract inline outside-click logic into a dedicated handleOutsideClick method (8433875)


## [0.2.27] - 2026-10-01

### 🐛 Bug Fixes
- fix: store URL path in session for password confirmation and prevent sheet closure on overlay clicks (25f245a)


## [0.2.26] - 2026-10-01

### 🚀 Features
- feat: add demo user auto-login middleware and enhance session expiration handling for form confirmations (15ecb1f)
- feat: add passkey verification support for password confirmation flow (ff0be6d)


## [0.2.25] - 2026-10-01

### ⚡ Performance & Refactoring
- refactor: replace inline locale checks with translation keys in filepond controller and search modal (3938ba3)
- refactor: iterate over supported locales array for language switchers (8fc9cdd)


## [0.2.24] - 2026-10-01

### 🚀 Features
- feat: add internationalization support for form error messages and password confirmation (5683c43)
- feat: implement password confirmation modal and HTTP 423 response handling for form component (b1523c8)
- feat: add form submission on enter key and refine validation error and toast handling (8e9ba03)
- feat: add dismissibleButton prop to sheet component and update close button attributes (943563a)
- feat: add dismissibleButton prop to automatically render close buttons in sheet components (aea1fa1)

### 🐛 Bug Fixes
- fix: allow cross-page navigation within password confirmation timeout window (2250ef7)

### ⚡ Performance & Refactoring
- refactor: streamline HTTP error parsing with dictionary lookup and dynamic locale resolution (db09f46)


## [0.2.23] - 2026-10-01

### 🚀 Features
- feat: add clean numeric value mode with hidden input support to phone component (38c737b)


## [0.2.22] - 2026-10-01

### 🐛 Bug Fixes
- fix: capture Alpine proxy in closure to preserve form context during submit callbacks (65e1e40)


## [0.2.21] - 2026-10-01

### 🚀 Features
- feat: add status notifications, error parsing, and post-submit actions to form component (9600a54)


## [0.2.20] - 2026-10-01

### 🐛 Bug Fixes
- fix: improve form handling with CSRF support, method spoofing, and sheet layout styling (6dc62df)


## [0.2.19] - 2026-09-30

### 🚀 Features
- feat: add DemoShowDispatch Livewire component and update sheet component persistence and login redirect (022a664)


## [0.2.18] - 2026-09-30

### 🚀 Features
- feat: add robust target element resolution with retry logic for delayed rendering (dde25fc)

### 🐛 Bug Fixes
- fix: update default post-login redirect path to root (e106ff3)


## [0.2.17] - 2026-09-30

### 🚀 Features
- feat: add teleport support to sheet component and update demo markup with sub-components (d97281e)
- feat: add vibe:show event handler to support Livewire and Alpine integration (e5269a0)


## [0.2.16] - 2026-09-30

### 🚀 Features
- feat: add mobile sidebar backdrop and datatable bulk actions customization support (2496d9d)


## [0.2.15] - 2026-09-30

### ⚡ Performance & Refactoring
- refactor: support flexible argument order in populate function and update blade directives (bdd2f0a)


## [0.2.14] - 2026-09-30

### 🚀 Features
- feat: enhance sheet component with smart overlay defaults and expand documentation for auth and UI features (6dad0cd)


## [0.2.13] - 2026-09-29

### 🚀 Features
- feat: add robust error handling to action callbacks and enhance avatar component with fallback and auto-coloring features (adc293a)


## [0.2.12] - 2026-09-29


## [0.2.11] - 2026-09-28

### ⚡ Performance & Refactoring
- refactor: migrate qrcode script to ES module and dispatch ready event for rendering (f6516ef)


## [0.2.10] - 2026-09-28

### 🚀 Features
- feat: add widescreen and ultrawide screen layout scaling support (dc85997)

### ⚡ Performance & Refactoring
- refactor: update UI layout structures and navigation icons across views and stubs (5285584)

### 🧰 Maintenance & Documentation
- style: remove max-w-7xl from settings container layouts (a528bd9)
- style: update SVG icon paths and stroke attributes across UI components (f1f8737)


## [0.2.9] - 2026-09-28

### 🚀 Features
- feat: add Vibe UI component definitions to VS Code HTML data and snippets (0ee04fd)
- feat: support wire:click without parentheses in delete components (6755cd3)
- feat: add global passkey toggle configuration and conditional UI rendering (f999497)

### 🐛 Bug Fixes
- fix: use substring instead of split for relative path extraction in vite config (95e345d)
- fix: check if prefixes is an array and conditionally log exceptions in debug mode (e222f24)
- fix: use right instead of left positioning for right-positioned sheet component (f66a1fd)

### ⚡ Performance & Refactoring
- refactor: update SVG icons across UI components (b13d689)
- refactor: pass element directly to vibeFetchAndShow to support special characters in button attributes (8a1fb6f)
- refactor: simplify passkeys config logic and format code spacing (4178ff1)
- refactor: remove accent variant from components and documentation (5fbe9a9)

### 🧰 Maintenance & Documentation
- chore: add package description and update livewire dependency constraints (f1ce084)


## [0.2.8] - 2026-09-22

### 🚀 Features
- feat: add show component and data binding engine with views, tests, and documentation (5e2ceff)


## [0.2.7] - 2026-09-21

### 🚀 Features
- feat: add datatable JS component bundle and simple pagination view (cf74af8)
- feat: add feature tests and custom styling support for breadcrumb component (f3a5e9b)


## [0.2.6] - 2026-09-19

### 🚀 Features
- feat: add loading states and text support to button component with tests and translations (3cd21e9)

### ⚡ Performance & Refactoring
- refactor: replace manual loading indicators with :loading attribute on button components in auth views (1783433)


## [0.2.5] - 2026-09-19

### ⚡ Performance & Refactoring
- refactor: dynamically publish stubs from directories in Auth and Layout commands (6ed7567)


## [0.2.4] - 2026-09-18

### 🐛 Bug Fixes
- fix: harden authentication security with 2FA session expiration, TOTP replay protection, and user enumeration prevention (39c6dc6)


## [0.2.3] - 2026-09-18

### 🚀 Features
- feat: add rate limiting and security enhancements to authentication workflows (47524a3)

### ⚡ Performance & Refactoring
- refactor: replace settings template stub with modular Livewire settings components (ea51fa2)
- refactor: improve switch component value handling and update appearance settings UI and theme logic (1dfda34)
- refactor: migrate settings module to Livewire components and add feature tests (38a9468)


## [0.2.2] - 2026-09-17

### 🧰 Maintenance & Documentation
- config: trust all proxies in application bootstrap (4f7737c)


## [0.2.1] - 2026-09-17


## [0.2.0] - 2026-09-16

### 🚀 Features
- feat: add autofill styling and enhance checkbox component state handling and icon transitions (8796072)
- feat: add animations to card alert components across auth views and stubs (49465a6)
- feat: add interactive animations to alert components with styling, tests, and documentation (adcc753)
- feat: add SSR support to tabs and relocate SetLocale middleware to vibe package (1662cfc)

### ⚡ Performance & Refactoring
- refactor: update auth layout views and stubs with seo stack and asset adjustments (3ad9a62)


## [0.1.22] - 2026-09-16

### 🚀 Features
- feat: add passkeys support to authentication scaffolding (a4e1f25)


## [0.1.21] - 2026-09-16

### 🚀 Features
- feat: add idle and qrcode JavaScript assets to installation command (1b840c7)


## [0.1.20] - 2026-09-16

### 🚀 Features
- feat: localize security settings stubs and add auth command tests (b20c6fb)


## [0.1.19] - 2026-09-16

### 🚀 Features
- feat: add settings page stubs, routes, and localized translation files (b235dac)
- feat: add modular authentication language files for English and Indonesian and update stub references (7b4566c)
- feat: require password confirmation for sensitive 2FA actions with configurable options (a2fba0f)
- feat: add two-factor authentication support for user settings, stubs, and localization (444f00d)
- feat: implement comprehensive multi-method two-factor authentication (2FA) support (dc5cd24)
- feat: add QR code display and input components for OTP, phone, and currency (e2b52dc)
- feat: add documentation pages, routes, and sidebar translations for authentication features (5556b42)

### ⚡ Performance & Refactoring
- refactor: migrate settings navigation to vibe components and enhance 2FA secret sanitization (4bf7115)


## [0.1.18] - 2026-09-15

### 🚀 Features
- feat: add English and Indonesian localization files and language switcher component to authentication layouts (0e02dd8)


## [0.1.17] - 2026-09-15

### 🚀 Features
- feat: require email verification for security settings and clean up User model attributes (dcf8c7c)
- feat: add alert card component with documentation and translations (69694cc)

### ⚡ Performance & Refactoring
- refactor: replace inline SVG logos with asset images and update passkey icon paths in auth layouts (cba0680)
- refactor: replace inline alerts with vibe:card.alert components across auth views and stubs (0adb033)


## [0.1.16] - 2026-09-15

### 🚀 Features
- feat: support dynamic URL resolution for idle timeouts and password confirmation redirection (a51af9f)
- feat: add security middleware and account settings views with idle timeout and password confirmation (ab3fa17)


## [0.1.15] - 2026-09-15

### 🚀 Features
- feat: add authentication scaffolding with Livewire and passkeys support (eb1d935)
- feat: add url parameter and dynamic form submission to delete button (6e46f4b)
- feat(filepond): make entire card draggable for reorder, not just grip icon (1e731d3)
- feat(filepond): add drag & drop reorder with FLIP animation, translucent clone, arrow controls, and input order sync (454edbe)
- feat: add remote select component with API integration, controller, routes, and documentation (3298d83)

### 🐛 Bug Fixes
- fix(filepond): fix drag reorder by using pointer events with capture:true + pointer-events:none trick (f89f098)
- fix(filepond): rewrite drag reorder using HTML5 drag API to match dynamic-form.js behavior (9a8b093)

### ⚡ Performance & Refactoring
- refactor: remove custom FilePond CSS styling and theme overrides (a3e1464)

### 🧰 Maintenance & Documentation
- docs: update component properties and documentation layout for form inputs (3b90ad1)


## [0.1.14] - 2026-09-11

### ⚡ Performance & Refactoring
- refactor: enhance FilePond UI with improved progress indicator positioning, status state styling, and robust avatar image preview handling. (ca582d9)


## [0.1.13] - 2026-09-11

### 🧰 Maintenance & Documentation
- chore: remove debug dump from FilepondController request test method (1cb8ea7)


## [0.1.12] - 2026-09-11

### 🚀 Features
- feat: add support for preloaded files and update Filepond backend validation with 50MB limit (48c7294)

### 🐛 Bug Fixes
- fix(filepond): prevent SVG files from freezing during client-side image processing (93d5ea8)


## [0.1.11] - 2026-09-11

### 🐛 Bug Fixes
- fix(ci): trigger GitHub release on production branch push and push tag first (a5bed0e)


## [0.1.10] - 2026-09-11

### 🚀 Features
- feat: add context menu and design system to global search modal with bilingual support (9f40824)


## [0.1.9] - 2026-09-11

### 🧰 Maintenance & Documentation
- ci: add automated GitHub Release workflow on tag push (0a690a3)


## [0.1.8] - 2026-09-11

### 🚀 Features
- feat: add brand logos and update documentation with project overview and feature highlights (ef22008)
- feat: implement context menu component with documentation and multi-language support (e49e92c)
- feat: implement $vibe magic manager for programmatic component control and add feature tests (26c7f63)
- feat: implement Accordion component with sub-components, documentation pages, and language support (97c16ac)

### ⚡ Performance & Refactoring
- refactor: overhaul context delete item component with localized strings, unified JS handlers, and improved variant support (6f938fe)


## [0.1.7] - 2026-09-11

### 🚀 Features
- feat: implement month-only mode and add support for date constraints including min/max range and disabled days of the week (67a18cb)

### ⚡ Performance & Refactoring
- refactor: scope drag handle visibility to group/header to hide drag icons by default (b0d85d3)
- refactor: enhance drag-and-drop interactions by delegating dragging to card headers and ensuring proper event propagation handling (62c9041)


## [0.1.6] - 2026-09-11

### 🚀 Features
- feat: add dynamic command availability check and installation status verification for Vibe CLI (9f14da2)

### ⚡ Performance & Refactoring
- refactor: reorder action options for better visibility in VibeCommand (e53a829)


## [0.1.5] - 2026-09-10

### 🚀 Features
- feat: add skip-npm option to install command, enhance dependency management, and implement dynamic Vite asset registration with feature tests. (9d83fc0)


## [0.1.4] - 2026-09-10

### 🚀 Features
- feat: add Chart.js and FilePond dependencies and implement input validation and reserved path protection for LayoutCommand (f1a75cc)
- feat: add localization publishing and refine asset registration logic in InstallCommand (3b327cc)


## [0.1.3] - 2026-09-10

### 🚀 Features
- feat: improve version detection and automate production branch syncing during release (a844ab1)

### ⚡ Performance & Refactoring
- refactor: update stubs and generator commands to use layout-based wrappers with dynamic SEO and component slots (b1a0031)


## [0.1.2] - 2026-09-10

### 🐛 Bug Fixes
- fix(release): automate subtree split of packages/vibe on git tags for clean composer distribution (583bbc7)

### ⚡ Performance & Refactoring
- refactor: replace tailwind-merge-laravel with tailwind-merge-php and implement custom Blade integration and attribute bag macros (328df9e)

### 🧰 Maintenance & Documentation
- chore: update project configuration and upgrade dependencies to Laravel 13.x (4ec640b)
- chore(release): v0.1.1 (66b1585)


## [0.1.1] - 2026-09-10

### ⚡ Performance & Refactoring
- refactor: replace tailwind-merge-laravel with tailwind-merge-php and implement custom Blade integration and attribute bag macros (328df9e)


## [0.1.0] - 2026-09-10

### 🚀 Features
- feat(release): implement automated versioning, sync command, and subtree split workflow (492179c)
- feat: replace FilePond icons with custom crisp SVGs and enhance action button styling and positioning (fc4cbfb)
- feat: improve accessibility and form handling by adding dynamic aria attributes to range and switch components, abstracting hidden input logic for select, and escaping documentation HTML entities. (87df44b)
- feat: enhance dynamic-form with FilePond naming support, improved request formatting, and expanded UI localization. (de59778)
- feat: implement dynamic form repeater component and improve select component initialization logic (dde5c20)
- feat: increase file upload limit to 50MB and add localized validation error messages (043a3a7)
- feat: force HTTPS for application URLs and upgrade insecure FilePond presign requests (5bcde3c)
- feat: refactor FilePond avatar mode for improved layout, styling, and interactivity (b133a97)
- feat: enable native file input syncing and add multipart file handling to Filepond documentation examples (96a7c0c)
- feat: add FilePond test modal component to documentation for payload inspection (8b461fd)
- feat: add color design system documentation, update sidebar navigation, and adjust table header styles (567fd6d)
- feat: implement grid-list component architecture and refine preview UI styling (02ee0dd)
- feat: implement optional components system and add sidebar-classic stubs for LayoutCommand (fbcf4be)
- feat: implement global search modal with keyboard shortcuts and backend integration (631e317)
- feat: integrate FilePond for file uploads with custom Vibe UI styling, backend models, and validation middleware (6c4f7ce)
- feat: implement settings page with tabbed navigation and remove language switcher from sidebar (0de8687)
- feat: add route for settings documentation page (856ae1b)
- feat: implement responsive grid system with CSS variables and disable interactive features for tablet and mobile devices (fa47a15)
- feat: implement eCommerce dashboard module with dynamic page controller and routing (4c8b237)
- feat: implement Date & Time component and add form submission test sandbox (c004eed)
- feat: automate Vite entry point registration within InstallCommand (ca18f6a)
- feat: implement asynchronous form handling with native Alpine component and improve grid component initialization (9693d25)
- feat: implement custom SPA navigation loading bar and migrate form route to controller (c0b989a)
- feat: add sidebar variant to tabs component and update styling for pill variant (f0753d8)
- feat: add checkbox, radio, switch, range, and textarea components with corresponding documentation and localization. (9e0cc27)
- feat: add sticky scroll behavior to header and implement new classic sidebar layout (f652e6d)
- feat: implement tab component system and clean up state management configuration (0d020b6)
- feat: refactor modal state management to support full persistence and rename remember prop to persist (fbf2320)
- feat: add global view transitions, page entrance animations, and persistent Alpine-based form storage utility (25dfd71)
- feat: add configurable titleTag prop to Grid Card component (ed7e6ff)

### 🐛 Bug Fixes
- fix: improve datatable script loading and initialization for Livewire SPA navigation by moving assets to head and implementing dependency observation. (33d12b9)
- fix: improve Chart.js stability and theme switching with robust error handling and Livewire navigation cleanup (4526cea)
- fix: add defensive lifecycle patches and improved cleanup for Chart.js in SPA environments (6a5f453)

### ⚡ Performance & Refactoring
- refactor: internationalize documentation content and add design system language files (5bc2f09)
- refactor: implement dynamic runtime error handling and reactive state management for Filepond components (d52e675)
- refactor: improve FilePond instance stability with per-instance blob URL tracking, enhanced reactive state management, and robust cleanup during navigation (3aeb01a)
- refactor: improve FilePond integration with Zero FOUC, layout shift prevention, and expanded localization support (bdb7de2)
- refactor: standardize code indentation and formatting across all documentation component files (e922d09)
- refactor: standardize card layout styling and update documentation UI components (f258b57)
- refactor: update sidebar toggle icons and optimize header button visibility states (b116338)
- refactor: localize hardcoded strings and expand language support across UI components (23a6eb8)
- refactor: modularize sidebar components and move optional sheets to dedicated partials for improved layout maintainability. (fb705b4)
- refactor: extract notification sheet to a reusable component and update sidebar layouts (1594d9a)
- refactor: restructure modal, sheet, dropdown, and preview components into modular sub-components (109656e)
- refactor: update component variants to primary and standardize focus ring styling across input, select, and textarea components (ef6744a)
- refactor: migrate component scripts to head and improve Alpine initialization patterns (6fd51ba)
- refactor: remove redundant form banners and cleanup documentation component layouts (9be4d4a)
- refactor: replace raw HTML with Vibe components in datatable bulk actions and demo status labels (5f0244c)
- refactor: improve pagination accessibility and update documentation header hierarchy (bdebb8f)

### 🧰 Maintenance & Documentation
- docs: add section for custom tabs design patterns and examples (c33b76e)

