# New Project Setup

Step-by-step checklist for starting a new project from this starter theme.

---

## 1. Rename the theme folder

Rename the theme directory from `theme-starter-laravel` to your project slug (e.g. `project-name`).

---

## 2. Find & replace across the entire project

Run these replacements in order (VS Code: `Ctrl+Shift+H`, check "Match Case"):

| Find | Replace with | Where |
|------|-------------|-------|
| `theme-starter-laravel` | `project-name` | Theme folder references |
| `Theme Starter Laravel` | `Project Name` | Human-readable theme name |
| `digid` | `project_prefix` | Text domain & function prefix |

> **Note:** Keep the prefix short and lowercase with underscores (e.g. `meinprojekt`).

---

## 3. `style.css` — update theme metadata

```css
Theme Name:  Project Name
Theme URI:   #
Author:      dig.id
Author URI:  https://dig.id
Description: Custom WordPress theme for Project Name
Version:     1.0.0
Text Domain: project_prefix
```

---

## 4. `webpack.mix.js` — update local dev URL

```js
target: "https://project-name.digid/",
```

---

## 5. `assets/sass/_vars.sass` — define project colours and fonts

```sass
--color-primary: #______
--color-secondary: #______
--font-primary: 'FontName', sans-serif
--font-secondary: 'FontName', sans-serif
```

---

## 6. `assets/sass/enqueue.php` — update Google Fonts URL

Replace the Inter import with the project font URL.

---

## 7. `tailwind.config.js` — update font families and colours

```js
fontFamily: {
  primary: ['FontName', 'sans-serif'],
  secondary: ['FontName', 'sans-serif'],
},
colors: {
  'brand-primary': '#______',
},
```

---

## 8. `inc/theme-setup.php` — review nav menus

Add or remove nav menus to match the project's navigation structure.

---

## 9. Install dependencies

```bash
npm install
```

---


## 10. First build

```bash
npm run dev
```
or
```bash
npx mix --production
```

---

## Done. Start building.
