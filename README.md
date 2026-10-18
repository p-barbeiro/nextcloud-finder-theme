# Finder Theme for Nextcloud

A Nextcloud app that gives the **Files** app a macOS Finder-style look.

- Floating, rounded sidebar with the native folder tree, always visible on desktop
- Sidebar collapses to an icons-only rail (state remembered in the browser)
- Full-width file list in a rounded panel, zebra stripes, muted columns
- Thin status bar pinned to the bottom of the list
- Details panel styled like the sidebar
- Header in the style of the Immich web UI: logo left, search right
- Light and dark mode, accent `#50a3e8`

Tested on **Nextcloud 35.0.2**.

## Install

Clone into your apps directory as `finder_theme` and enable it. Example for
the official `nextcloud` Docker image (service `app`, apps in `custom_apps`):

```sh
docker compose exec -u www-data app sh -c \
  'git clone https://github.com/p-barbeiro/nextcloud-finder-theme /var/www/html/custom_apps/finder_theme'
docker compose exec -u www-data app php occ app:enable finder_theme
```

No git in the container? Copy the folder in instead:

```sh
git archive --format=tar --prefix=finder_theme/ HEAD | \
  docker compose exec -T -u www-data app tar x -C /var/www/html/custom_apps
```

### Recommended settings

```sh
# Accent and plain background used by the theme
occ theming:config primary_color "#50a3e8"
occ theming:config background backgroundColor
occ theming:config background_color "#1c1c1e"

# Finder shows no folder description above the list
occ config:app:set text workspace_available --value=false --type=boolean
```

Hard-refresh the browser afterwards. After changing the CSS or JS, bump
`<version>` in `appinfo/info.xml` so browsers fetch the new files, then run
`occ upgrade` right away: until then Nextcloud answers 503 (upgrade needed).

## Layout

| Path | What it is |
|------|------------|
| `css/finder.css` | All styling |
| `js/rail.js` | Sidebar rail toggle |
| `lib/` | Loads the CSS and script on logged-in pages |

## Known limitations

- **Row height stays at 44px.** The Files virtual list hardcodes a 44px item
  height for its scroll math; smaller rows leave gaps in large folders.
- **Toast position** matches Nextcloud's CSS-module class prefix
  `_toastContainer_`; if an update renames it, toasts fall back to the native
  position (nothing breaks).
- The header search keeps Nextcloud's placeholder text.

## License

[MIT](LICENSE)
