# Changelog

All notable changes to **Vibe UI** (`teknovate/vibeui`) will be documented in this file.

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

