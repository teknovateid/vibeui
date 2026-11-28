# Vibe UI Component & Props Reference

Always write components using `<vibe:name>` (not `<x-vibe::name>`). Compound subcomponents use dot notation (`<vibe:card.header>`, `<vibe:modal.footer>`, etc.).

## Layout & Navigation

| Component | Subcomponents | Key Props |
| :--- | :--- | :--- |
| `<vibe:header>` | `.heading`, `.subheading`, `.actions` | `variant` (`default`, `header`, `muted`, `card`, `sticky`), `size` (`sm`, `default`, `lg`), `sticky`, `scrolledClass`, `unscrolledClass`, `threshold` |
| `<vibe:sheet>` | `.header`, `.content`, `.footer`, `.close` | `id`, `variant` (`default`, `card`, `muted`, `sidebar`), `layout` (`fixed`, `relative`, `sticky`, `absolute`), `position` (`left`, `right`, `top`, `bottom`), `behavior` (`collapsible`, `static`, `minify`), `resizable`, `size`, `defaultSize`, `mobileSize`, `minSize`, `maxSize`, `minifiedSize`, `persist`, `defaultState`, `backdrop`, `teleport`, `dismissible`, `dismissibleButton` |
| `<vibe:nav>` | `.label`, `.item`, `.group`, `.pinned`, `.history` | `id`, `variant` (`sidebar`, `primary`, `subtle`, `line`), `density` (`compact`, `default`, `relaxed`), `indicator`, `collapsed`, `pinnable`, `maxpin` |
| `<vibe:nav.item>` | — | `href`, `active`, `badge`, `badgeColor`, `collapsed`, `pinnable`, `id`, `variant`, `density`, `indicator`, `navigate`; slot `icon` |
| `<vibe:nav.group>` | — | `title`, `active`, `open`, `persist`, `id`, `pinnable`, `variant`, `density`, `indicator`; slot `icon` |
| `<vibe:breadcrumb>` | `.item` | `title`, `separator`, `wrap`, `titleClass`, `titleTag`; item: `href`, `active`, `navigate` |
| `<vibe:tabs>` | `.list`, `.tab`, `.panels`, `.panel`, `.content`, `.item` | `selected`, `default`, `layout`, `orientation`, `variant`, `size`, `persist`, `id`, `syncUrl`, `mobileMode` |
| `<vibe:stepper>` | `.header`, `.step`, `.panels`, `.panel`, `.actions`, `.previous`, `.next`, `.finish` | `step`, `value`, `default`, `linear`, `orientation`, `variant`, `size`, `clickable`, `persist`, `syncUrl`, `id` |
| `<vibe:toc>` | `.item` | `title`, `selector`, `levels`, `offset`, `collapsible`, `bordered`, `id` |
| `<vibe:pagination>` | — | `scrollTo` (styled Tailwind pagination links view) |
| `<vibe:separator>` | — | `text`, `orientation` |

## Actions, Menus & Overlays

| Component | Subcomponents | Key Props |
| :--- | :--- | :--- |
| `<vibe:button>` | `.group`, `.edit`, `.delete`, `.show`, `.swipe` | `variant` (`primary`, `secondary`, `outline`, `ghost`, `surface`, `destructive`/`danger`, `success`, `warning`, `info`, `link`, `default`), `size` (`xs`, `sm`, `md`, `lg`, `xl`, `icon-xs`..`icon-2xl`, `icon-10`, `icon-12`, `auto`, `none`), `type`, `href`, `loading`, `disabled`, `pulse`, `animation`, `navigate`. **Use `class="rounded-full"` instead of `pill`.** |
| `<vibe:button.delete>` | — | `variant`, `size`, `title`, `message`, `confirmText`, `cancelText`, `action`, `url` (also accepts `wire:click` / `@click`; shows confirmation alert before executing) |
| `<vibe:button.edit>` | — | `variant`, `size`, `href`, `url`, `target`, `action`, `data`, `onSuccess`, `onError`, `resetErrors`, `title` |
| `<vibe:button.show>` | — | `variant`, `size`, `url`, `target`, `method`, `title` |
| `<vibe:swipe>` | — | `name`, `value`, `id`, `type`, `size`, `variant`, `label`, `confirmedLabel`, `loadingLabel`, `threshold`, `autoReset`, `disabled`, `readonly`, `loading`, `haptic` |
| `<vibe:dropdown>` | `.trigger`, `.content`, `.items`, `.item`, `.label`, `.divider`, `.sub`, `.sub-trigger`, `.sub-items` | `id`, `keyboard`; content: `align`, `width`; item: `href`, `type`, `destructive`, `variant` |
| `<vibe:context>` | `.menu`, `.label`, `.item`, `.item.delete`, `.divider`, `.sub` | `menu` (matches `<vibe:context.menu id="...">`); menu: `id`, `width`, `closeOnClick` |
| `<vibe:modal>` | `.header`, `.content`, `.footer`, `.close` | Native `<dialog>` top-layer: `id`, `persist`, `dismissible`, `dismissibleButton`, `show`, `position` (`top`, `center`, `bottom`), `maxWidth`/`size` (`sm`..`7xl`, `full`), `teleport`, `variant`, `animation`, `containerClass`, `backdropClass` |

## Forms & Inputs

| Component | Subcomponents | Key Props |
| :--- | :--- | :--- |
| `<vibe:form>` | — | `id`, `ajax` (default `true`), `saveToStorage`, `storageType` (`session`, `local`), `expireHours`, `status` (`toast`, `alert`, `true`, `false`), `delay`, `redirectTo`, `onSuccess`, `onError`, `confirmPassword`, `confirmPasswordUrl`, `locale` |
| `<vibe:input>` | `.currency`, `.number`, `.phone`, `.otp`, `.quantity`, `.generate`, `.multiple`, `.file`, `.tags` | `label`, `id`, `type`, `name`, `description`, `size` (`xs`..`xl`), `variant` (`primary`, `outline`, `filled`, `flush`, `ghost`), `info`, `error`, `errorName`, `wrapperClass`, `icon`, `trailingIcon`, `prefix`, `suffix`, `disabled`, `readonly`, `viewable` (for `type="password"`), `animation`. **Use `class="rounded-full"` instead of `pill`.** |
| `<vibe:textarea>` | — | `label`, `id`, `name`, `rows`, `placeholder`, `size`, `variant`, `autoResize`, `showCount`, `maxlength`, `description`, `info`, `error`, `errorName`, `wrapperClass`, `animation` |
| `<vibe:select>` | `.option`, `.group`, `.remote` | `label`, `id`, `name`, `options`, `value`, `placeholder`, `searchable`, `searchPlaceholder`, `multiple`, `clearable`, `min`, `max`, `separator`, `badgeVariant`, `colorCycle`, `placement`, `keyboard`, `size`, `variant`, `error`, `info`; `.remote` adds `api`, `searchParam`, `minChars`, `debounce`, `headers`, `initialLabel`, `initialAvatar`, `initialIcon` |
| `<vibe:checkbox>` | `.group` | `label`, `id`, `name`, `value`, `checked`, `indeterminate`, `description`, `info`, `error`, `size`, `variant`, `color`, `card`, `indicator`, `hideIndicator`; `.group`: `orientation`, `columns`, `required` |
| `<vibe:radio>` | `.group` | `label`, `id`, `name`, `value`, `checked`, `description`, `size`, `variant`, `color`, `card`, `error`, `indicator`, `hideIndicator`; `.group`: `orientation`, `columns`, `required` |
| `<vibe:switch>` | — | `label`, `id`, `name`, `value`, `checked`, `description`, `size`, `variant`, `labelPlacement`, `disabled`, `error` |
| `<vibe:range>` | — | `label`, `id`, `name`, `min`, `max`, `step`, `value`, `size`, `variant`, `showValue`, `valuePrefix`, `valueSuffix`, `minLabel`, `maxLabel`, `marks`, `checkpoints`, `strict` |
| `<vibe:date-time>` | `.calendar`, `.header`, `.presets`, `.time` | `id`, `name`, `startName`, `endName`, `label`, `type`, `mode`, `value`, `format`, `displayFormat`, `time24`, `minDate`, `maxDate`, `disabledDates`, `disabledDaysOfWeek`, `inline`, `clearable`, `presets`, `dualMonth`, `size`, `variant`, `error` |
| `<vibe:editor>` | — | TinyMCE wrapper: `label`, `name`, `value`, `preset`, `height`, `minHeight`, `maxHeight`, `autoresize`, `menubar`, `toolbar`, `plugins`, `variables`, `uploadUrl`, `uploadDisk`, `uploadFolder` |
| `<vibe:filepond>` | — | `label`, `name`, `multiple`, `maxFiles`, `maxFileSize`, `acceptedFileTypes`, `accept`, `imagePreview`, `imageCrop`, `imageResize`, `avatar`, `server`, `presignUrl`, `chunkUploads`, `files`, `existingFiles`, `instantUpload`, `allowReorder`, `protectUpload` |
| `<vibe:dynamic-form>` | `.item`, `.empty` | Repeater field builder: `id`, `name`, `label`, `min`, `max`, `default`, `value`, `variant`, `allowReorder`, `allowDuplicate`, `collapsible`, `confirmDelete`, `schema`, `addText` |

## Data Display, Feedback & Utilities

| Component | Subcomponents | Key Props |
| :--- | :--- | :--- |
| `<vibe:card>` | `.header`, `.title`, `.description`, `.content`, `.footer`, `.alert` | `variant` (`default`, `outline`, `ghost`, `flat`, `muted`, `elevated`, `container`); `.alert`: `variant`, `appearance`, `size`, `title`, `description`, `icon`, `dismissible`, `rounded`, `animation` |
| `<vibe:badge>` | — | `variant`, `size`, `icon`, `trailingIcon`, `prefix`, `suffix`, `dot`, `dotPulse`, `pulse`, `animation`, `dismissible`, `href`, `navigate` |
| `<vibe:avatar>` | `.group` | `src`, `alt`, `name`, `initials`, `size`, `shape`, `indicator`, `color`; `.group`: `limit`, `total`, `size`, `overlap` |
| `<vibe:table>` | `.header`, `.column`, `.rows`, `.row`, `.cell`, `.footer`, `.empty` | `variant`, `dense`, `hoverable`, `caption`, `containerClass` |
| `<vibe:datatable>` | — | `component` (Livewire DataTable alias/class), `bordered`, `lazy` |
| `<vibe:grid>` | `.toolbar`, `.item`, `.card` | Resizable/reorderable dashboard grid: `id`, `cols`, `gap`, `responsive`, `persist`, `resizable`, `reorderable`, `storageKey` |
| `<vibe:grid-list>` | `.item`, `.card`, `.empty` | Switchable grid/list container: `id`, `title`, `description`, `badge`, `defaultLayout`, `gridClasses`, `listClasses`, `showSwitcher` |
| `<vibe:todo>` | `.header`, `.title`, `.description`, `.input`, `.group`, `.item`, `.content`, `.subitem`, `.subtask`, `.footer`, `.empty` | `id`, `mode`, `name`, `reorderable`, `persist`, `endpoint`, `wireReorder`, `wireToggle`, `wireDelete`, `wireAdd`, `wireUpdate`, `layout`, `editable`, `quickAdd`, `searchable` |
| `<vibe:chart>` | — | Chart.js wrapper: `id`, `config`, `type`, `data`, `options`, `height`, `sparkline`, `zoom` |
| `<vibe:highlight>` | — | Syntax-highlighted code block: `code`, `language`/`lang`, `title`, `filename`, `theme`, `copyable`, `lineNumbers`, `lines`, `wrap`, `maxHeight` |
| `<vibe:clipboard>` | — | Accessible copy trigger / read-only field: `value`, `target`, `variant` (`outline`, `ghost`, `primary`, `secondary`, `surface`, `default`, `field`, `code`), `size` (`xs`..`xl`), `label`, `description`, `copyLabel`, `copiedLabel`, `failedLabel`, `bubble` (`top`, `bottom`, `left`, `right`, `false`), `duration`, `toast`, `masked`, `prefix`, `ariaLabel`, `disabled` (powered by `VibeClipboard` / `$vibe.copy`) |
| `<vibe:display.qrcode>` | — | `value`, `size`, `level`, `color`, `background`, `margin`, `downloadable`, `copyable`, `label`, `id` |
| `<vibe:image>` | `.gallery`, `.lightbox` | `src`, `alt`, `name`, `initials`, `lazy`, `priority`, `fallback`, `skeleton`, `caption`, `zoom`, `zoomIcon`, `preview`, `previewSrc`, `group` |
| `<vibe:accordion>` | `.item`, `.heading`, `.trigger`, `.content`, `.panel` | `type` (`single`, `multiple`), `collapsible`, `selected`/`value`/`default`, `variant`, `size`, `chevron`, `chevronPosition`, `disabled` |
| `<vibe:alert>` | — | Global alert host: `position` (`center`, `top-right`, `top-left`, `bottom-right`, `bottom-left`, `top-center`, `bottom-center`), `align`, `timeout`, `sound`, `blur`, `closeOnOutside`, `persist`, `animation` |
| `<vibe:toast>` | — | Global toast host: `position`, `timeout`, `sound`, `animation`, `max`, `dedupMs`, `compact` |
| `<vibe:show>` | `.each` | Client-side reactive display for modals/drawers: `key`, `as`, `html`, `attr` |
| `<vibe:preview>` | `.content`, `.code` | Interactive component showcase with code preview and theme/viewport switcher |
| `<vibe:seo>` | `.favicon` | `title`, `titleTemplate`, `siteName`, `description`, `keywords`, `image`, `canonical`, `robots`, `schema`, `breadcrumbs`, `faq`, `socials` |

## Common Usage Patterns

### Modal & Confirmed Delete
```blade
<vibe:button variant="primary" @click="$dispatch('open-modal', 'create-user')">
    Add User
</vibe:button>

<vibe:modal id="create-user" maxWidth="lg">
    <vibe:modal.header>
        <h3 class="text-base font-semibold">Create User</h3>
    </vibe:modal.header>
    <vibe:form action="{{ route('users.store') }}" method="POST" onSuccess="$vibe.modal('create-user').close(); $vibe.toast.success('User saved');">
        @csrf
        <vibe:modal.content class="space-y-4">
            <vibe:input name="name" label="Name" required />
            <vibe:input name="email" type="email" label="Email" required />
        </vibe:modal.content>
        <vibe:modal.footer>
            <vibe:modal.close>
                <vibe:button variant="ghost">Cancel</vibe:button>
            </vibe:modal.close>
            <vibe:button type="submit" variant="primary">Save</vibe:button>
        </vibe:modal.footer>
    </vibe:form>
</vibe:modal>

<vibe:button.delete wire:click="delete({{ $user->id }})" />
```

### Livewire DataTable
Extend `Teknovate\VibeUi\DataTable\VibeDataTableComponent` (generated by `php artisan vibe:table UsersTable --model=User`) and render in Blade with:
```blade
<vibe:datatable component="users-table" />
```
