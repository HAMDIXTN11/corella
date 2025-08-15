# Corella Store – WordPress + WooCommerce Theme

Minimal, elegant, fast WooCommerce theme tailored for Tunisia. Bilingual (Arabic RTL + French), WhatsApp ordering, and modern UI.

## Install
1. Zip the `corella-store` folder and upload via WP Admin → Appearance → Themes → Add New → Upload.
2. Activate. Install/activate WooCommerce. Optionally install Polylang or WPML for language switching.
3. Set Home: Pages → Add “Home” with Template “Front Page” (or set as static Front page). Create Shop page via WooCommerce setup.

## Configure
- Appearance → Customize → Corella Store Settings → set WhatsApp phone (`+216…`).
- Menus: assign `Primary` and `Footer` menus.
- Widgets: add to `Footer Column 1/2`.
- Images: replace placeholders in `assets/images/` as noted in `tools/README.txt`.

## Translations
- Arabic and French `.po` files included. Generate `.mo` via Loco Translate or `msgfmt`.

## Notes
- Fast: minimal JS, emoji removed, font preconnect.
- RTL: automatic with `rtl.css`.
- WhatsApp CTA on products and floating button.